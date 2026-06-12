@extends('component.adminSideBar')

@section('title', 'Contact Messages')
@section('page_title', 'Contact Us Form Submissions')

@section('styles')
<style>
    .flex-layout {
        display: flex;
        flex-direction: column;
        gap: 24px;
        position: relative;
    }

    .admin-card {
        background: var(--bg-surface);
        border: 1px solid var(--border-color);
        border-radius: 10px;
        padding: 24px;
    }

    .card-title {
        font-size: 16px;
        font-weight: 700;
        color: var(--text-main);
        margin-bottom: 16px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .card-title i {
        color: var(--accent);
    }

    /* System Status Feedbacks */
    .alert-success {
        background-color: rgba(40, 167, 69, 0.1);
        color: #28a745;
        padding: 12px 16px;
        border-radius: 6px;
        border: 1px solid rgba(40, 167, 69, 0.2);
        font-size: 14px;
        margin-bottom: 8px;
    }

    .alert-danger {
        background-color: rgba(220, 53, 69, 0.1);
        color: #dc3545;
        padding: 12px 16px;
        border-radius: 6px;
        border: 1px solid rgba(220, 53, 69, 0.2);
        font-size: 14px;
        margin-bottom: 16px;
    }

    /* Modernized Table Design */
    .contact-table {
        width: 100%;
        border-collapse: collapse;
        font-size: 13px;
    }

    .contact-table th {
        color: var(--text-muted);
        font-weight: 500;
        text-align: left;
        padding: 12px 10px;
        border-bottom: 1px solid var(--border-color);
    }

    .contact-table td {
        padding: 14px 10px;
        border-bottom: 1px solid rgba(255, 255, 255, 0.04);
        color: var(--text-main);
        vertical-align: middle;
    }

    .contact-table tr:hover {
        background-color: rgba(255, 255, 255, 0.01);
    }

    .message-text {
        max-width: 320px;
        white-space: pre-wrap;
        color: rgba(255, 255, 255, 0.8);
        line-height: 1.5;
    }

    /* Action Trigger Components */
    .btn {
        padding: 8px 14px;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        font-size: 12px;
        font-weight: 500;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        transition: all 0.15s;
    }

    .btn-reply {
        background-color: rgba(157, 91, 250, 0.12);
        border: 1px solid rgba(157, 91, 250, 0.3);
        color: var(--accent);
    }

    .btn-reply:hover {
        background-color: var(--accent);
        color: white;
    }

    .btn-delete {
        background-color: rgba(220, 53, 69, 0.1);
        border: 1px solid rgba(220, 53, 69, 0.2);
        color: #dc3545;
    }

    .btn-delete:hover {
        background-color: #dc3545;
        color: white;
    }

    /* Status Badges Styling */
    .badge {
        padding: 4px 10px;
        border-radius: 12px;
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        display: inline-flex;
        align-items: center;
        gap: 4px;
    }

    .badge-pending {
        background-color: rgba(255, 193, 7, 0.12);
        border: 1px solid rgba(255, 193, 7, 0.3);
        color: #ffc107;
    }

    .badge-solved {
        background-color: rgba(40, 167, 69, 0.12);
        border: 1px solid rgba(40, 167, 69, 0.3);
        color: #28a745;
    }

    /* Modal Architecture Setup */
    .modal-backdrop {
        position: fixed;
        top: 0;
        left: 0;
        width: 100vw;
        height: 100vh;
        background: rgba(7, 7, 12, 0.8);
        backdrop-filter: blur(4px);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 9999;
        opacity: 0;
        pointer-events: none;
        transition: opacity 0.2s ease-in-out;
    }

    .modal-backdrop.active {
        opacity: 1;
        pointer-events: auto;
    }

    .custom-modal {
        background: var(--bg-surface);
        border: 1px solid var(--border-color);
        border-radius: 12px;
        width: 100%;
        max-width: 550px;
        padding: 24px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.6);
        transform: scale(0.9);
        transition: transform 0.2s ease-in-out;
    }

    .modal-backdrop.active .custom-modal {
        transform: scale(1);
    }

    .modal-title {
        font-size: 16px;
        font-weight: 700;
        color: var(--text-main);
        margin-bottom: 12px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .input-field {
        padding: 10px 12px;
        background: var(--bg-base);
        border: 1px solid var(--border-color);
        border-radius: 6px;
        color: var(--text-main);
        font-family: inherit;
        font-size: 13px;
        width: 100%;
        margin-bottom: 16px;
        resize: vertical;
    }

    .input-field:focus {
        border-color: var(--accent);
        outline: none;
    }

    .modal-actions {
        display: flex;
        gap: 12px;
        justify-content: flex-end;
    }

    .btn-cancel {
        background: rgba(255, 255, 255, 0.05);
        border: 1px solid var(--border-color);
        color: var(--text-main);
    }
</style>
@endsection

@section('content')
<div class="flex-layout">

    @if(session('success'))
    <div class="alert-success">
        <i class="ti ti-circle-check"></i> {{ session('success') }}
    </div>
    @endif

    @if($errors->any())
    <div class="alert-danger">
        <ul style="margin-left: 20px;">
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <div class="admin-card">
        <h2 class="card-title"><i class="ti ti-mail"></i> Student Messages Log Ledger</h2>

        <table class="contact-table">
            <thead>
                <tr>
                    <th>Date / Time</th>
                    <th>Sender Info</th>
                    <th>Message Details</th>
                    <th style="text-align: center;">Status</th>
                    <th style="text-align: center; width: 220px;">Action Trigger Panel</th>
                </tr>
            </thead>
            <tbody>
                @forelse($messages as $msg)
                <tr>
                    <td style="color: var(--text-muted); font-size: 12px;">
                        {{ $msg->created_at ? $msg->created_at->format('Y-m-d H:i') : 'N/A' }}
                    </td>
                    <td>
                        <div style="font-weight: 700; color: var(--text-main);">{{ $msg->name }}</div>
                        <div style="font-size: 12px; color: var(--text-muted); margin-top: 2px;"><i class="ti ti-mail"></i> {{ $msg->email }}</div>
                        <div style="font-size: 12px; color: var(--text-muted);"><i class="ti ti-phone"></i> {{ $msg->mobile_no }}</div>
                    </td>
                    <td>
                        <div class="message-text">{{ $msg->message }}</div>
                    </td>
                    <td style="text-align: center; vertical-align: middle;">
                        @if($msg->status === 'solved')
                        <span class="badge badge-solved"><i class="ti ti-circle-check"></i> Solved</span>
                        @else
                        <span class="badge badge-pending"><i class="ti ti-clock"></i> Pending</span>
                        @endif
                    </td>
                    <td>
                        <div style="display: flex; gap: 8px; justify-content: center; align-items: center; height: 100%;">
                            <button type="button" class="btn btn-reply" onclick="openReplyModal({{ $msg->id }}, '{{ $msg->email }}', `{{ $msg->message }}`)">
                                <i class="ti ti-arrow-back-up"></i> {{ $msg->status === 'solved' ? 'Reply Again' : 'Reply Email' }}
                            </button>
                            <button type="button" class="btn btn-delete" onclick="openDeleteModal('{{ route('contactManagement.destroy', $msg->id) }}')">
                                <i class="ti ti-trash"></i> Delete
                            </button>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" style="text-align: center; color: var(--text-muted); padding: 40px 0;">
                        No form submissions found in database records.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="modal-backdrop" id="replyModalBackdrop">
    <div class="custom-modal">
        <div class="modal-title"><i class="ti ti-message-share" style="color: var(--accent);"></i> Compose Outbound Email Response</div>

        <form id="replyForm" method="POST" enctype="multipart/form-data">
            @csrf
            <div style="font-size: 12px; color: var(--text-muted); margin-bottom: 12px;">
                Sending response to: <strong id="replyTargetEmail" style="color: var(--text-main);"></strong>
            </div>

            <div style="background: rgba(255,255,255,0.02); border: 1px solid var(--border-color); padding: 10px; border-radius: 6px; font-size: 12px; color: var(--text-muted); max-height: 100px; overflow-y: auto; margin-bottom: 14px;">
                <strong>Original Message:</strong>
                <p id="originalMessagePreview" style="white-space: pre-wrap; margin-top: 4px;"></p>
            </div>

            <label style="font-size: 12px; color: var(--text-muted); display: block; margin-bottom: 6px;">Your Reply Message (You can include links directly in the text)</label>
            <textarea name="reply_message" rows="5" class="input-field" placeholder="Type your response or reference links here..." required></textarea>

            <label style="font-size: 12px; color: var(--text-muted); display: block; margin-bottom: 6px;">Attach Document / Reference File (Optional)</label>
            <input type="file" name="attachment_file" class="input-field" style="padding: 8px 12px;" accept=".pdf,.xlsx,.xls,.csv,.doc,.docx,.txt,.png,.jpg,.jpeg">
            <div style="font-size: 11px; color: var(--text-muted); margin-top: -12px; margin-bottom: 16px;">
                Supported systems: PDF, Excel, Documents, Plain Text or Images (Max: 10MB)
            </div>

            <div class="modal-actions">
                <button type="button" class="btn btn-cancel" onclick="closeReplyModal()">Cancel</button>
                <button type="submit" class="btn" style="background-color: var(--accent); color: white;">
                    <i class="ti ti-send"></i> Dispatch Mail
                </button>
            </div>
        </form>
    </div>
</div>

<div class="modal-backdrop" id="deleteModalBackdrop">
    <div class="custom-modal" style="max-width: 400px; text-align: center;">
        <div style="font-size: 40px; color: #dc3545; margin-bottom: 14px;"><i class="ti ti-alert-circle"></i></div>
        <div style="font-size: 18px; font-weight: 700; color: var(--text-main); margin-bottom: 8px;">Delete Contact Record</div>
        <div style="font-size: 14px; color: var(--text-muted); margin-bottom: 24px; line-height: 1.5;">Are you sure you want to permanently delete this form entry? This action cannot be reverted.</div>

        <div class="modal-actions" style="justify-content: center;">
            <button type="button" class="btn btn-cancel" onclick="closeDeleteModal()">Cancel</button>
            <form id="confirmedDeleteForm" method="POST" style="margin: 0;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn" style="background-color: #dc3545; color: white;">Confirm Delete</button>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    const deleteBackdrop = document.getElementById('deleteModalBackdrop');
    const deleteForm = document.getElementById('confirmedDeleteForm');
    const replyBackdrop = document.getElementById('replyModalBackdrop');
    const replyForm = document.getElementById('replyForm');
    const replyTargetEmail = document.getElementById('replyTargetEmail');
    const originalMessagePreview = document.getElementById('originalMessagePreview');

    function openDeleteModal(deleteActionUrl) {
        deleteForm.action = deleteActionUrl;
        deleteBackdrop.classList.add('active');
    }

    function closeDeleteModal() {
        deleteBackdrop.classList.remove('active');
    }

    function openReplyModal(id, email, originalMessage) {
        replyForm.action = `/admin/contactManagement/${id}/reply`;
        replyTargetEmail.innerText = email;
        originalMessagePreview.innerText = originalMessage;
        // Reset file input when opening modal
        const fileInput = replyForm.querySelector('input[type="file"]');
        if (fileInput) fileInput.value = '';
        replyBackdrop.classList.add('active');
    }

    function closeReplyModal() {
        replyBackdrop.classList.remove('active');
    }

    // Dismiss modals when clicking the ambient background layer
    window.addEventListener('click', function(e) {
        if (e.target === deleteBackdrop) closeDeleteModal();
        if (e.target === replyBackdrop) closeReplyModal();
    });
</script>
@endsection