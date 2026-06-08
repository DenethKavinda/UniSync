@extends('component.adminSideBar')

@section('title', 'Inquiry Management')
@section('page_title', 'Inquiry Management')

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
        margin-bottom: 20px;
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

    /* Inquiry Grid Card Layout */
    .inquiry-grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: 16px;
    }

    .inquiry-item {
        background: var(--bg-base);
        border: 1px solid var(--border-color);
        border-radius: 8px;
        padding: 20px;
        transition: border-color 0.15s, transform 0.15s;
        position: relative;
    }

    .inquiry-item:hover {
        border-color: rgba(157, 91, 250, 0.25);
    }

    .inquiry-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        border-bottom: 1px solid var(--border-color);
        padding-bottom: 12px;
        margin-bottom: 14px;
        gap: 16px;
    }

    .inquiry-subject {
        font-size: 15px;
        font-weight: 700;
        color: var(--text-main);
    }

    .inquiry-meta {
        font-size: 12px;
        color: var(--text-muted);
        display: flex;
        align-items: center;
        gap: 4px;
        white-space: nowrap;
    }

    .inquiry-body {
        font-size: 13px;
        color: rgba(255, 255, 255, 0.85);
        line-height: 1.6;
        word-break: break-word;
        white-space: pre-wrap;
    }

    /* Modern Button Styling */
    .btn {
        padding: 8px 14px;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        font-size: 12px;
        font-weight: 500;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        transition: opacity 0.15s;
    }

    .btn:hover {
        opacity: 0.9;
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

    /* ── CUSTOM CENTERED CONFIRMATION POPUP MODAL ── */
    .modal-backdrop {
        position: fixed;
        top: 0;
        left: 0;
        width: 100vw;
        height: 100vh;
        background: rgba(7, 7, 12, 0.75);
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

    .confirm-modal {
        background: var(--bg-surface);
        border: 1px solid var(--border-color);
        border-radius: 12px;
        width: 100%;
        max-width: 400px;
        padding: 24px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
        transform: scale(0.9);
        transition: transform 0.2s ease-in-out;
        text-align: center;
    }

    .modal-backdrop.active .confirm-modal {
        transform: scale(1);
    }

    .modal-icon {
        font-size: 40px;
        color: #dc3545;
        margin-bottom: 14px;
        display: inline-block;
    }

    .modal-heading {
        font-size: 18px;
        font-weight: 700;
        color: var(--text-main);
        margin-bottom: 8px;
    }

    .modal-text {
        font-size: 14px;
        color: var(--text-muted);
        margin-bottom: 24px;
        line-height: 1.5;
    }

    .modal-actions {
        display: flex;
        gap: 12px;
        justify-content: center;
    }

    .btn-cancel {
        background: rgba(255, 255, 255, 0.05);
        border: 1px solid var(--border-color);
        color: var(--text-main);
    }

    .btn-cancel:hover {
        background: rgba(255, 255, 255, 0.1);
    }

    .btn-confirm-delete {
        background: #dc3545;
        color: #ffffff;
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

    <div class="admin-card">
        <h2 class="card-title"><i class="ti ti-message-2"></i> Student Inquiries Inbox</h2>

        <div class="inquiry-grid">
            @forelse($inquiries as $inquiry)
            <div class="inquiry-item">
                <div class="inquiry-header">
                    <div>
                        <div class="inquiry-subject">{{ $inquiry->subject }}</div>
                        <div class="inquiry-meta" style="margin-top: 4px;">
                            <i class="ti ti-calendar-event"></i> Received: {{ $inquiry->created_at->format('M d, Y - h:i A') }}
                        </div>
                    </div>
                    <div>
                        <button type="button" class="btn btn-delete" onclick="openDeleteModal('{{ route('inquiryManagement.destroy', $inquiry->id) }}')">
                            <i class="ti ti-trash"></i> Delete
                        </button>
                    </div>
                </div>
                <div class="inquiry-body">{{ $inquiry->message }}</div>
            </div>
            @empty
            <div style="text-align: center; color: var(--text-muted); padding: 60px 0; background: var(--bg-base); border-radius: 8px; border: 1px dashed var(--border-color);">
                <i class="ti ti-mailbox-off" style="font-size: 32px; color: var(--text-muted); margin-bottom: 8px; display: block;"></i>
                No active student inquiries found in the database.
            </div>
            @endforelse
        </div>
    </div>
</div>

<div class="modal-backdrop" id="deleteModalBackdrop">
    <div class="confirm-modal">
        <div class="modal-icon"><i class="ti ti-alert-circle"></i></div>
        <div class="modal-heading">Delete Inquiry</div>
        <div class="modal-text">Are you sure you want to permanently remove this student inquiry message record from historical log data?</div>

        <div class="modal-actions">
            <button type="button" class="btn btn-cancel" onclick="closeDeleteModal()">Cancel</button>

            <form id="confirmedDeleteForm" method="POST" style="margin: 0;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-confirm-delete">Confirm Delete</button>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    const backdrop = document.getElementById('deleteModalBackdrop');
    const deleteForm = document.getElementById('confirmedDeleteForm');

    function openDeleteModal(deleteActionUrl) {
        if (!backdrop || !deleteForm) return;
        deleteForm.action = deleteActionUrl;
        backdrop.classList.add('active');
    }

    function closeDeleteModal() {
        if (!backdrop) return;
        backdrop.classList.remove('active');
    }

    // Close on backdrop masking click bounds intercept
    backdrop.addEventListener('click', function(e) {
        if (e.target === backdrop) {
            closeDeleteModal();
        }
    });
</script>
@endsection