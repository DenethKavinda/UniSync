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

    .card-title-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 16px;
        flex-wrap: wrap;
        gap: 12px;
    }

    .card-title {
        font-size: 16px;
        font-weight: 700;
        color: var(--text-main);
        display: flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 0;
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

    /* Filter Panel Section Control Styling */
    .filter-controls-row {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
        gap: 16px;
        margin-bottom: 20px;
        background: rgba(255, 255, 255, 0.01);
        padding: 14px;
        border-radius: 8px;
        border: 1px solid rgba(255, 255, 255, 0.02);
    }

    .search-wrapper,
    .filter-wrapper {
        position: relative;
        display: flex;
        flex-direction: column;
        gap: 6px;
    }

    .search-input-icon {
        position: absolute;
        left: 12px;
        bottom: 11px;
        color: var(--text-muted);
        font-size: 14px;
    }

    .search-wrapper .input-field {
        padding-left: 34px;
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

    .btn-secondary {
        background-color: rgba(255, 255, 255, 0.05);
        border: 1px solid var(--border-color);
        color: var(--text-main);
    }

    .btn-secondary:hover {
        background-color: rgba(255, 255, 255, 0.1);
        border-color: rgba(255, 255, 255, 0.2);
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
        <div style="font-weight: 700; margin-bottom: 4px;"><i class="ti ti-alert-triangle"></i> System Request Failed:</div>
        <ul class="alert-list">
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <div class="admin-card">
        <div class="card-title-row">
            <h2 class="card-title"><i class="ti ti-file-spreadsheet"></i> Bulk Import Users via Excel Sheet</h2>
        </div>

        <form action="{{ route('userManagement.import') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div style="display: flex; gap: 16px; align-items: flex-end; flex-wrap: wrap;">
                <div class="form-group" style="flex: 1; min-width: 280px;">
                    <label class="form-label">Choose Excel/CSV Matrix File</label>
                    <input type="file" name="excel_file" class="input-field" accept=".xlsx, .xls, .csv" required style="padding: 7px 12px;">
                </div>
                <div>
                    <button type="submit" class="btn btn-primary" style="background-color: #28a745; width: 100%;">
                        <i class="ti ti-upload"></i> Upload & Process Sheet
                    </button>
                </div>
            </div>
            <div style="margin-top: 12px; font-size: 11px; color: var(--text-muted); line-height: 1.4;">
                <strong>Required Configuration Rules:</strong> Spreadsheet header row data layout properties must be exactly matched as:
                <code style="color: var(--accent); background: rgba(157,91,250,0.1); padding: 2px 4px; border-radius: 4px;">name</code>,
                <code style="color: var(--accent); background: rgba(157,91,250,0.1); padding: 2px 4px; border-radius: 4px;">email</code>,
                <code style="color: var(--accent); background: rgba(157,91,250,0.1); padding: 2px 4px; border-radius: 4px;">password</code>, and
                <code style="color: var(--accent); background: rgba(157,91,250,0.1); padding: 2px 4px; border-radius: 4px;">role</code> (Accepted roles: user, teacher, admin).
            </div>
        </form>
    </div>

    <div class="admin-card">
        <div class="card-title-row">
            <h2 class="card-title"><i class="ti ti-user-plus"></i> Register New User Record</h2>
        </div>

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
        <div class="card-title-row">
            <h2 class="card-title"><i class="ti ti-users"></i> Registered Users Ledger</h2>
            <a href="{{ route('userManagement.export') }}" id="ledgerExportBtn" class="btn btn-secondary" onclick="appendFilterToExport(this, event)">
                <i class="ti ti-file-download" style="color: var(--accent);"></i> Export Ledger to Excel
            </a>
        </div>

        <div class="filter-controls-row">
            <div class="search-wrapper">
                <label class="form-label">Search Ledger Records</label>
                <i class="ti ti-search search-input-icon"></i>
                <input type="text" id="ledgerSearchInput" class="input-field" placeholder="Search by name or email address..." onkeyup="filterLedgerTable()">
            </div>
            <div class="filter-wrapper">
                <label class="form-label">Filter by System Access Role</label>
                <select id="ledgerRoleFilter" class="select-field" onchange="filterLedgerTable()">
                    <option value="all">All Roles</option>
                    <option value="user">User (Student)</option>
                    <option value="teacher">Teacher</option>
                    <option value="admin">Admin</option>
                </select>
            </div>
        </div>

        <table class="user-table" id="ledgerUserTable">
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
                <tr class="no-records-row">
                    <td colspan="5" style="text-align: center; color: var(--text-muted); padding: 40px 0;">No registered users found in the system database records.</td>
                </tr>
                @endforelse

                <tr id="noMatchesRow" style="display: none;">
                    <td colspan="5" style="text-align: center; color: var(--text-muted); padding: 40px 0;">No matching ledger elements found for current filter criteria.</td>
                </tr>
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

    // Real-time live filtering handler logic
    function filterLedgerTable() {
        const searchVal = document.getElementById('ledgerSearchInput').value.toLowerCase().trim();
        const roleVal = document.getElementById('ledgerRoleFilter').value;
        const table = document.getElementById('ledgerUserTable');
        const rows = table.getElementsByTagName('tbody')[0].getElementsByTagName('tr');

        let visibleCount = 0;
        let originalRecordsExist = true;

        for (let i = 0; i < rows.length; i++) {
            const row = rows[i];

            // Skip helper structure row components
            if (row.id === 'noMatchesRow') continue;
            if (row.classList.contains('no-records-row')) {
                originalRecordsExist = false;
                continue;
            }

            const nameInput = row.querySelector('input[name="name"]');
            const emailInput = row.querySelector('input[name="email"]');
            const roleSelect = row.querySelector('select[name="role"]');

            if (!nameInput || !emailInput || !roleSelect) continue;

            const nameText = nameInput.value.toLowerCase();
            const emailText = emailInput.value.toLowerCase();
            const chosenRole = roleSelect.value;

            const matchesSearch = nameText.includes(searchVal) || emailText.includes(searchVal);
            const matchesRole = (roleVal === 'all') || (chosenRole === roleVal);

            if (matchesSearch && matchesRole) {
                row.style.display = '';
                visibleCount++;
            } else {
                row.style.display = 'none';
            }
        }

        // Handle structural fallback display tracking
        const noMatchesRow = document.getElementById('noMatchesRow');
        if (noMatchesRow && originalRecordsExist) {
            noMatchesRow.style.display = (visibleCount === 0) ? '' : 'none';
        }
    }

    // Appends the current selection to Excel export URL dynamically
    function appendFilterToExport(element, event) {
        event.preventDefault();

        const roleFilter = document.getElementById('ledgerRoleFilter').value;
        const baseRoute = "{{ route('userManagement.export') }}";

        // Append selected role as query string parameter if it isn't 'all'
        if (roleFilter && roleFilter !== 'all') {
            element.href = `${baseRoute}?role=${roleFilter}`;
        } else {
            element.href = baseRoute;
        }

        // Trigger file streaming request download pipeline
        window.location.href = element.href;
    }

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

                // Run live filter update checking in case user changed elements while filtering is live
                filterLedgerTable();
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