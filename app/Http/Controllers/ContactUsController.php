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
     * Dispatches an electronic email notification directly back to the student.
     */
    public function sendReplyEmail(Request $request, $id)
    {
        $request->validate([
            'reply_message' => 'required|string|min:5',
        ]);

        $messageRecord = ContactUs::findOrFail($id);

        try {
            // Dispatch Email Stream
            Mail::to($messageRecord->email)->send(new ContactReplyMail(
                $request->input('reply_message'),
                $messageRecord->message,
                $messageRecord->name
            ));

            // ── AUTOMATICALLY SWAP STATUS VALUE TO SOLVED ON SUCCESS ──
            $messageRecord->update([
                'status' => 'solved'
            ]);

            return redirect()->back()->with('success', 'Reply email dispatched successfully!.' . $messageRecord->email);
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['Failed to send outbound email stream: ' . $e->getMessage()]);
        }
    }
}
