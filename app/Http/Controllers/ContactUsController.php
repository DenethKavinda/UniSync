<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContactUs;
use App\Models\Inquiry;
use App\Mail\ContactReplyMail;
use Illuminate\Support\Facades\Mail;

class ContactUsController extends Controller
{
    public function viewContactUsPage()
    {
        return view('student.contactUs');
    }

    public function submitContactUsForm(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'mobile_no' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'message' => 'required|string',
        ]);

        ContactUs::create([
            'name' => $request->name,
            'mobile_no' => $request->mobile_no,
            'email' => $request->email,
            'message' => $request->message,
        ]);

        return redirect()->back()->with('success', 'Your message has been sent successfully!');
    }

    public function submitInquiryForm(Request $request)
    {
        $request->validate([
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        Inquiry::create([
            'subject' => $request->subject,
            'message' => $request->message,
        ]);

        return redirect()->back()->with('success', 'Your inquiry has been submitted successfully!');
    }


    public function viewAdminContactPage()
    {
        // Get newest entries first
        $messages = ContactUs::orderBy('created_at', 'desc')->get();
        return view('admin.contactManagement', compact('messages'));
    }

    /**
     * Discard an inquiry entry from active system database storage.
     */
    public function destroy($id)
    {
        $message = ContactUs::findOrFail($id);
        $message->delete();

        return redirect()->back()->with('success', 'Contact log entry deleted successfully.');
    }

    /**
     * Dispatches an electronic email notification directly back to the student with file and link support.
     */
    /**
     * Dispatches an electronic email notification directly back to the student with file and link support.
     */
    public function sendReplyEmail(Request $request, $id)
    {
        // Added validation tracking rules for optional attachment file up to 10MB
        $request->validate([
            'reply_message'    => 'required|string|min:5',
            'attachment_file'  => 'nullable|file|mimes:pdf,xlsx,xls,csv,doc,docx,txt,png,jpg,jpeg|max:10240',
        ]);

        $messageRecord = ContactUs::findOrFail($id);

        try {
            $rawMessage = $request->input('reply_message');


            $urlRegex = '/(https?:\/\/[^\s<]+)/';
            $formattedMessage = preg_replace($urlRegex, '$1', $rawMessage);

            // Convert simple line breaks to HTML breaks so formatting displays correctly inside email readers
            $formattedMessage = nl2br($formattedMessage);

            // Initialize the Laravel Mail instance with the dynamic text payload
            $emailInstance = new ContactReplyMail(
                $formattedMessage,
                $messageRecord->message,
                $messageRecord->name
            );

            // Check if a file was uploaded by the admin
            if ($request->hasFile('attachment_file') && $request->file('attachment_file')->isValid()) {
                $uploadedFile = $request->file('attachment_file');

                // Attach file from its temporary path without permanently wasting application disk storage spaces
                $emailInstance->attach($uploadedFile->getRealPath(), [
                    'as'   => $uploadedFile->getClientOriginalName(),
                    'mime' => $uploadedFile->getClientMimeType(),
                ]);
            }

            // Dispatch Email Stream
            Mail::to($messageRecord->email)->send($emailInstance);

            // ── AUTOMATICALLY SWAP STATUS VALUE TO SOLVED ON SUCCESS ──
            $messageRecord->update([
                'status' => 'solved'
            ]);

            return redirect()->back()->with('success', 'Reply email dispatched successfully to ' . $messageRecord->email);
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['Failed to send outbound email stream: ' . $e->getMessage()]);
        }
    }
}
