<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f4f6f9;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding-left: 260px;
            /* Adjust if sidebar overlaps */
        }

        h1 {
            color: #333;
        }

        .alert-success {
            background-color: #d4edda;
            color: #155724;
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 4px;
            border: 1px solid #c3e6cb;
        }

        .user-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background: #fff;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
            overflow: hidden;
        }

        .user-table th,
        .user-table td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .user-table th {
            background-color: #343a40;
            color: #fff;
        }

        .user-table tr:hover {
            background-color: #f1f1f1;
        }

        .input-field {
            padding: 6px 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            width: 90%;
        }

        .select-field {
            padding: 6px 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .btn {
            padding: 6px 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-weight: bold;
            text-decoration: none;
            display: inline-block;
        }

        .btn-update {
            background-color: #28a745;
            color: white;
        }

        .btn-update:hover {
            background-color: #218838;
        }

        .btn-delete {
            background-color: #dc3545;
            color: white;
        }

        .btn-delete:hover {
            background-color: #c82333;
        }

        .action-forms {
            display: flex;
            gap: 8px;
        }
    </style>
</head>

<body>
    @include('component.adminSideBar')

    <div class="container">
        <h1>User Management Page</h1>

        @if(session('success'))
        <div class="alert-success">
            {{ session('success') }}
        </div>
        @endif

        <table class="user-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>

                    <form action="{{ route('userManagement.update', $user->id) }}" method="POST" id="update-form-{{ $user->id }}">
                        @csrf
                        @method('PUT')

                        <td>
                            <input type="text" name="name" class="input-field" value="{{ old('name', $user->name) }}" required>
                        </td>
                        <td>
                            <input type="email" name="email" class="input-field" value="{{ old('email', $user->email) }}" required>
                        </td>
                        <td>
                            <select name="role" class="select-field">
                                <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>User (Student)</option>
                                <option value="teacher" {{ $user->role == 'teacher' ? 'selected' : '' }}>Teacher</option>
                                <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                            </select>
                        </td>
                    </form>

                    <td>
                        <div class="action-forms">
                            <button type="submit" form="update-form-{{ $user->id }}" class="btn btn-update">Update</button>

                            <form action="{{ route('userManagement.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this user?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-delete">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" style="text-align: center;">No registered users found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</body>

</html>