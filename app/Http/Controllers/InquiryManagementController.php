<?php

namespace App\Http\Controllers;

use App\Models\Inquiry;

use Illuminate\Http\Request;

class InquiryManagementController extends Controller
{
    public function viewInquiryManagementPage()
    {
        // Fetch all inquiries from descending order (latest first)
        $inquiries = Inquiry::orderBy('created_at', 'desc')->get();
        return view('admin.inquiryManagement', compact('inquiries'));
    }

    /**
     * Remove the specified inquiry from database storage.
     */
    public function destroy($id)
    {
        $inquiry = Inquiry::findOrFail($id);
        $inquiry->delete();

        return redirect()->back()->with('success', 'Inquiry record deleted successfully.');
    }
}
