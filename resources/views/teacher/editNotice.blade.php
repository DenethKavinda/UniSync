<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Notification</title>
    <style>
        .form-container {
            max-width: 700px;
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            padding: 30px;
            border-radius: 16px;
            margin-top: 20px;
        }

        h1 {
            font-size: 28px;
            margin-bottom: 20px;
            color: #b57bff;
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
        }

        .btn-submit {
            background: linear-gradient(90deg, #ff4fd8, #b57bff);
            border: none;
            padding: 14px 28px;
            color: white;
            font-weight: bold;
            border-radius: 8px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            text-align: center;
        }

        .btn-cancel {
            background: rgba(255, 255, 255, 0.1);
            color: white;
            padding: 14px 28px;
            border-radius: 8px;
            text-decoration: none;
            margin-left: 10px;
            font-weight: bold;
        }

        .current-file {
            font-size: 13px;
            color: #4da3ff;
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
                    <h1>Edit Notification</h1>

                    <div class="form-container">
                        <form action="{{ route('teacherNotify.update', $notice->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            
                            <div class="form-group">
                                <label for="title">Notice Title</label>
                                <input type="text" id="title" name="title" value="{{ $notice->title }}" required>
                            </div>

                            <div class="form-group">
                                <label for="badge_type">Notice Urgency/Priority</label>
                                <select id="badge_type" name="badge_type">
                                    <option value="new" {{ $notice->badge_type == 'new' ? 'selected' : '' }}>NEW</option>
                                    <option value="important" {{ $notice->badge_type == 'important' ? 'selected' : '' }}>IMPORTANT</option>
                                    <option value="urgent" {{ $notice->badge_type == 'urgent' ? 'selected' : '' }}>URGENT</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="message">Detailed Message</label>
                                <textarea id="message" name="message" rows="5" required>{{ $notice->message }}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="pdf_file">Change Attached PDF Document (Leave blank to keep current)</label>
                                <input type="file" id="pdf_file" name="pdf_file" accept=".pdf">
                                @if($notice->pdf_path)
                                    <span class="current-file">Current File: Attached (Uploading a new one will replace it)</span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="link_url">External Resource Link / Google Form URL</label>
                                <input type="text" id="link_url" name="link_url" value="{{ $notice->link_url }}" placeholder="https://forms.gle/...">
                            </div>

                            <button type="submit" class="btn-submit">Update Notice</button>
                            <a href="{{ route('teacherNotify') }}" class="btn-cancel">Cancel</a>
                        </form>
                    </div>
                `;
            }
        });
    </script>

</body>

</html>