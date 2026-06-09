<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notice;
use Illuminate\Support\Facades\File;

class NoticeController extends Controller
{
    public function viewNoticePage()
    {
        $notices = Notice::latest()->get();
        return view('student.notice', [
            'notices' => $notices,
            'totalNotices' => $notices->count(),
            'importantCount' => $notices->where('badge_type', 'important')->count(),
            'urgentCount' => $notices->where('badge_type', 'urgent')->count()
        ]);
    }

    // Student View: Display notices
    public function index(Request $request)
    {
        $query = Notice::latest();

        // Simple search functionality
        if ($request->has('search') && $request->search != '') {
            $query->where('title', 'like', '%' . $request->search . '%')
                ->orWhere('message', 'like', '%' . $request->search . '%');
        }

        $notices = $query->get();

        // Count metrics for the template stats
        $totalNotices = $notices->count();
        $importantCount = $notices->where('badge_type', 'important')->count();
        $urgentCount = $notices->where('badge_type', 'urgent')->count();

        return view('student.notice', compact('notices', 'totalNotices', 'importantCount', 'urgentCount'));
    }

    // // Teacher View: Show creation form
    // public function create()
    // {
    //     return view('teacher.teacherNotify');
    // }

    // Teacher Action: Save notice to DB
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'message' => 'required|string',
            'badge_type' => 'required|in:new,important,urgent',
            'pdf_file' => 'nullable|mimes:pdf|max:10000',
            'link_url' => 'nullable|url'
        ]);

        $noticeData = $request->only(['title', 'message', 'badge_type', 'link_url']);

        // Handle PDF Upload if exists
        if ($request->hasFile('pdf_file')) {
            $fileName = time() . '_' . $request->file('pdf_file')->getClientOriginalName();
            $request->file('pdf_file')->move(public_path('uploads/notices'), $fileName);
            $noticeData['pdf_path'] = 'uploads/notices/' . $fileName;
        }

        Notice::create($noticeData);

        return redirect()->back()->with('success', 'Notification published successfully!');
    }

    // 4. Teacher View: Fetch notice data and display the Edit Page
    public function edit($id)
    {
        $notice = Notice::findOrFail($id);
        return view('teacher.editNotice', compact('notice'));
    }

    // Teacher Action: Update Notice
    public function update(Request $request, $id)
    {
        $notice = Notice::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'message' => 'required|string',
            'badge_type' => 'required|in:new,important,urgent',
            'pdf_file' => 'nullable|mimes:pdf|max:10000',
            'link_url' => 'nullable|url'
        ]);

        $noticeData = $request->only(['title', 'message', 'badge_type', 'link_url']);

        if ($request->hasFile('pdf_file')) {
            // Delete old PDF file if it exists
            if ($notice->pdf_path && File::exists(public_path($notice->pdf_path))) {
                File::delete(public_path($notice->pdf_path));
            }

            $fileName = time() . '_' . $request->file('pdf_file')->getClientOriginalName();
            $request->file('pdf_file')->move(public_path('uploads/notices'), $fileName);
            $noticeData['pdf_path'] = 'uploads/notices/' . $fileName;
        }

        $notice->update($noticeData);

        return redirect()->route('teacherNotify')->with('success', 'Notification updated successfully!');
    }

    // Teacher Action: Delete Notice
    public function destroy($id)
    {
        $notice = Notice::findOrFail($id);

        // Delete associated PDF from storage folder if it exists
        if ($notice->pdf_path && File::exists(public_path($notice->pdf_path))) {
            File::delete(public_path($notice->pdf_path));
        }

        $notice->delete();

        return redirect()->back()->with('success', 'Notification deleted successfully!');
    }
}
