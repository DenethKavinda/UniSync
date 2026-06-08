@extends('component.adminSideBar')

@section('title', 'User Management')
@section('page_title', 'User Management')

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

    /* Form Design for Adding Users */
    .form-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 16px;
        align-items: flex-end;
    }

    .form-group {
        display: flex;
        flex-direction: column;
        gap: 6px;
    }

    .form-label {
        font-size: 12px;
        font-weight: 500;
        color: var(--text-muted);
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

    .alert-list {
        margin-left: 20px;
    }

    /* Modernized Data Table Structure */
    .user-table {
        width: 100%;
        border-collapse: collapse;
        font-size: 13px;
    }

    .user-table th {
        color: var(--text-muted);
        font-weight: 500;
        text-align: left;
        padding: 12px 10px;
        border-bottom: 1px solid var(--border-color);
    }

    .user-table td {
        padding: 10px;
        border-bottom: 1px solid rgba(255, 255, 255, 0.04);
        color: var(--text-main);
        vertical-align: middle;
    }

    .user-table tr:last-child td {
        border-bottom: none;
    }

    .user-table tr:hover {
        background-color: rgba(255, 255, 255, 0.02);
    }

    .input-field,
    .select-field {
        padding: 10px 12px;
        background: var(--bg-base);
        border: 1px solid var(--border-color);
        border-radius: 6px;
        color: var(--text-main);
        font-family: inherit;
        font-size: 13px;
        width: 100%;
        transition: border-color 0.15s, box-shadow 0.15s;
    }

    .input-field:focus,
    .select-field:focus {
        border-color: var(--accent);
        outline: none;
        box-shadow: 0 0 0 2px rgba(157, 91, 250, 0.15);
    }

    .btn {
        padding: 10px 16px;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        font-size: 13px;
        font-weight: 500;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        transition: opacity 0.15s;
    }

    .btn:hover {
        opacity: 0.9;
    }

    .btn-primary {
        background-color: var(--accent);
        color: white;
    }

    .btn-delete {
        background-color: rgba(220, 53, 69, 0.1);
        border: 1px solid rgba(220, 53, 69, 0.2);
        color: #dc3545;
        padding: 8px 12px;
        font-size: 12px;
    }

    .btn-delete:hover {
        background-color: #dc3545;
        color: white;
    }

    /* ── CUSTOM CENTERED POPUP MODAL STYLES ── */
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

    @if($errors->any())
    <div class="alert-danger">
        <div style="font-weight: 700; margin-bottom: 4px;"><i class="ti ti-alert-triangle"></i> Registration Failed:</div>
        <ul class="alert-list">
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <div class="admin-card">
        <h2 class="card-title"><i class="ti ti-user-plus"></i> Register New User Record</h2>

        <form action="{{ route('userManagement.store') }}" method="POST">
            @csrf
            <div class="form-grid">
                <div class="form-group">
                    <label class="form-label">Full Name</label>
                    <input type="text" name="name" class="input-field" placeholder="e.g., Ashan Perera" value="{{ old('name') }}" required>
                </div>

                <div class="form-group">
                    <label class="form-label">Email Address</label>
                    <input type="email" name="email" class="input-field" placeholder="e.g., ashan@example.com" value="{{ old('email') }}" required>
                </div>

                <div class="form-group">
                    <label class="form-label">Account Password</label>
                    <input type="password" name="password" class="input-field" placeholder="••••••••" required>
                </div>

                <div class="form-group">
                    <label class="form-label">System Access Role</label>
                    <select name="role" class="select-field">
                        <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>User (Student)</option>
                        <option value="teacher" {{ old('role') == 'teacher' ? 'selected' : '' }}>Teacher</option>
                        <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                    </select>
                </div>

                <div>
                    <button type="submit" class="btn btn-primary" style="width: 100%;">
                        <i class="ti ti-plus"></i> Add Account
                    </button>
                </div>
            </div>
        </form>
    </div>

    <div class="admin-card">
        <h2 class="card-title"><i class="ti ti-users"></i> Registered Users Ledger</h2>

        <table class="user-table">
            <thead>
                <tr>
                    <th style="width: 60px;">ID</th>
                    <th>Full Name</th>
                    <th>Email Address</th>
                    <th style="width: 180px;">Assigned Role</th>
                    <th style="width: 100px; text-align: center;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                <tr data-user-id="{{ $user->id }}">
                    <td>{{ $user->id }}</td>

                    <td style="padding: 6px 10px;">
                        @csrf
                        <input type="text" name="name" class="input-field" value="{{ old('name', $user->name) }}" onblur="autoSaveUser(this)" required>
                    </td>
                    <td style="padding: 6px 10px;">
                        <input type="email" name="email" class="input-field" value="{{ old('email', $user->email) }}" onblur="autoSaveUser(this)" required>
                    </td>
                    <td style="padding: 6px 10px;">
                        <select name="role" class="select-field" onchange="autoSaveUser(this)">
                            <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>User (Student)</option>
                            <option value="teacher" {{ $user->role == 'teacher' ? 'selected' : '' }}>Teacher</option>
                            <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                        </select>
                    </td>
                    <td>
                        <div style="display: flex; justify-content: center;">
                            <button type="button" class="btn btn-delete" onclick="openDeleteModal('{{ route('userManagement.destroy',$user->id) }}')">
                                <i class="ti ti-trash"></i> Delete
                            </button>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" style="text-align: center; color: var(--text-muted); padding: 40px 0;">No registered users found in the system database records.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="modal-backdrop" id="deleteModalBackdrop">
    <div class="confirm-modal">
        <div class="modal-icon"><i class="ti ti-alert-circle"></i></div>
        <div class="modal-heading">Confirm Account Deletion</div>
        <div class="modal-text">Are you sure you want to permanently delete this user account? This action cannot be undone.</div>

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
    // Global references for popup handling
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

    // Close the popup if user clicks on the dimmed backdrop area
    backdrop.addEventListener('click', function(e) {
        if (e.target === backdrop) {
            closeDeleteModal();
        }
    });

    function autoSaveUser(element) {
        if (element.hasAttribute('required') && !element.value.trim()) {
            element.style.borderColor = '#dc3545';
            return;
        }

        const row = element.closest('tr');
        const userId = row.getAttribute('data-user-id');
        if (!userId) return;

        element.style.opacity = '0.6';

        const nameValue = row.querySelector('input[name="name"]').value;
        const emailValue = row.querySelector('input[name="email"]').value;
        const roleValue = row.querySelector('select[name="role"]').value;
        const token = row.querySelector('input[name="_token"]').value;

        const formData = new FormData();
        formData.append('_token', token);
        formData.append('_method', 'PUT');
        formData.append('name', nameValue);
        formData.append('email', emailValue);
        formData.append('role', roleValue);

        const routeUrl = `/admin/userManagement/${userId}`;

        fetch(routeUrl, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                }
            })
            .then(async response => {
                if (!response.ok) {
                    const errData = await response.json().catch(() => ({}));
                    throw new Error(errData.message || 'Server side validation execution crash.');
                }
                return response.json();
            })
            .then(data => {
                element.style.borderColor = '#28a745';
                setTimeout(() => {
                    element.style.borderColor = 'var(--border-color)';
                }, 1200);
            })
            .catch(error => {
                console.error('AJAX tracking execution breakdown route trace:', error);
                element.style.borderColor = '#dc3545';
                alert(`Failed to save changes: ${error.message}`);
            })
            .finally(() => {
                element.style.opacity = '1';
            });
    }
</script>
@endsection