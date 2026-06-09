<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Notifications</title>
    <style>
        .form-container,
        .table-container {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            padding: 30px;
            border-radius: 16px;
            margin-top: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
        }

        .table-container {
            margin-top: 40px;
            margin-bottom: 50px;
        }

        h1 {
            font-size: 28px;
            margin-bottom: 20px;
            color: #b57bff;
            text-shadow: 0 0 10px rgba(181, 123, 255, 0.2);
        }

        h2 {
            font-size: 22px;
            margin-bottom: 20px;
            color: #4da3ff;
        }

        .form-group {
            margin-bottom: 20px;
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        label {
            font-weight: 500;
            color: #cbd5e1;
            font-size: 14px;
        }

        input[type="text"],
        textarea,
        select,
        input[type="file"] {
            width: 100%;
            padding: 12px;
            background: rgba(0, 0, 0, 0.3);
            border: 1px solid rgba(255, 255, 255, 0.15);
            border-radius: 8px;
            color: white;
            outline: none;
            transition: 0.3s;
        }

        input:focus,
        textarea:focus,
        select:focus {
            border-color: #4da3ff;
            box-shadow: 0 0 10px rgba(77, 163, 255, 0.3);
        }

        .btn-submit {
            background: linear-gradient(90deg, #ff4fd8, #b57bff);
            border: none;
            padding: 14px 28px;
            color: white;
            font-weight: bold;
            border-radius: 8px;
            cursor: pointer;
            transition: 0.3s;
            box-shadow: 0 4px 15px rgba(255, 79, 216, 0.3);
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(255, 79, 216, 0.5);
        }

        .alert-success {
            background: rgba(34, 197, 94, 0.2);
            border: 1px solid #22c55e;
            color: #22c55e;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        /* Table Design Styling */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
            color: #cbd5e1;
        }

        th,
        td {
            padding: 14px;
            text-align: left;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        th {
            background: rgba(0, 0, 0, 0.4);
            color: white;
            font-weight: 600;
        }

        tr:hover {
            background: rgba(255, 255, 255, 0.02);
        }

        .badge {
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: bold;
            text-transform: uppercase;
        }

        .badge.urgent {
            background: #ef4444;
            color: white;
        }

        .badge.important {
            background: #f59e0b;
            color: white;
        }

        .badge.new {
            background: #22c55e;
            color: white;
        }

        .action-btns {
            display: flex;
            gap: 10px;
        }

        .btn-edit {
            background: #4da3ff;
            color: white;
            border: none;
            padding: 6px 12px;
            border-radius: 6px;
            text-decoration: none;
            font-size: 13px;
            font-weight: 600;
            transition: 0.2s;
        }

        .btn-edit:hover {
            background: #1e87ff;
        }

        .btn-delete {
            background: #ef4444;
            color: white;
            border: none;
            padding: 6px 12px;
            border-radius: 6px;
            cursor: pointer;
            font-size: 13px;
            font-weight: 600;
            transition: 0.2s;
        }

        .btn-delete:hover {
            background: #dc2626;
        }
    </style>
</head>

<body>

    @include('component.teacherSideBar')

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const mainContainer = document.querySelector('.main');
            if (mainContainer) {
                mainContainer.innerHTML = `
                    <h1>Notification Management Dashboard</h1>

                    @if(session('success'))
                        <div class="alert-success">{{ session('success') }}</div>
                    @endif

                    <div class="form-container">
                        <h2>Publish New Student Notice</h2>
                        <form action="{{ route('teacherNotify.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="title">Notice Title</label>
                                <input type="text" id="title" name="title" placeholder="e.g., Final Examination Timetable Revised" required>
                            </div>
                            <div class="form-group">
                                <label for="badge_type">Notice Urgency/Priority</label>
                                <select id="badge_type" name="badge_type">
                                    <option value="new">NEW</option>
                                    <option value="important">IMPORTANT</option>
                                    <option value="urgent">URGENT</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="message">Detailed Message</label>
                                <textarea id="message" name="message" rows="4" placeholder="Write down structural info or descriptions here..." required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="pdf_file">Attach PDF Document (Optional)</label>
                                <input type="file" id="pdf_file" name="pdf_file" accept=".pdf">
                            </div>
                            <div class="form-group">
                                <label for="link_url">External Resource Link / Google Form URL (Optional)</label>
                                <input type="text" id="link_url" name="link_url" placeholder="https://forms.gle/... or website link">
                            </div>
                            <button type="submit" class="btn-submit">Publish Notice</button>
                        </form>
                    </div>

                    <div class="table-container">
                        <h2>Active Board Notices</h2>
                        <table>
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Priority</th>
                                    <th>Attachments</th>
                                    <th>Date Posted</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($notices as $notice)
                                    <tr>
                                        <td><strong>{{ $notice->title }}</strong></td>
                                        <td><span class="badge {{ $notice->badge_type }}">{{ $notice->badge_type }}</span></td>
                                        <td>
                                            {{ $notice->pdf_path ? '📄 PDF ' : '' }}
                                            {{ $notice->link_url ? '🔗 Link' : '' }}
                                            {{ !$notice->pdf_path && !$notice->link_url ? 'Text Only' : '' }}
                                        </td>
                                        <td>{{ $notice->created_at->format('d M Y') }}</td>
                                        <td>
                                            <div class="action-btns">
                                                <a href="{{ route('teacherNotify.edit', $notice->id) }}" class="btn-edit">Edit</a>
                                                
                                                <form action="{{ route('teacherNotify.destroy', $notice->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this notice?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn-delete">Delete</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" style="text-align: center; padding: 30px; color: #94a3b8;">No notifications published yet.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                `;
            }
        });
    </script>

</body>

</html>