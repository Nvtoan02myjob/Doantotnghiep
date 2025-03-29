<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chọn Vai Trò</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        /* Background đen mờ */
        body {
            background: rgba(0, 0, 0, 0.8);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        /* Hộp chọn vai trò */
        .role-selection {
            background: white;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0px 5px 15px rgba(255, 255, 255, 0.2);
            text-align: center;
            max-width: 400px;
            width: 100%;
            animation: fadeIn 0.5s ease-in-out;
        }

        /* Hiệu ứng chữ */
        .role-selection h2 {
            font-size: 24px;
            font-weight: bold;
            color: #333;
            margin-bottom: 20px;
        }

        /* Button */
        .role-selection a {
            width: 100%;
            display: block;
            padding: 12px;
            font-size: 18px;
            font-weight: bold;
            text-decoration: none;
            border-radius: 8px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .role-selection a:hover {
            transform: translateY(-3px);
            box-shadow: 0px 3px 10px rgba(0, 0, 0, 0.2);
        }

        .btn-user {
            background: #007bff;
            color: white;
            margin-bottom: 15px;
        }

        .btn-user:hover {
            background: #0056b3;
        }

        .btn-admin {
            background: #dc3545;
            color: white;
        }

        .btn-admin:hover {
            background: #b02a37;
        }

        /* Hiệu ứng fade-in */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<body>
    <div class="role-selection">
        <h2>Bạn muốn vào trang nào?</h2>
        <a href="{{route('home')}}" class="btn btn-user">Người dùng</a>
        <a href="{{route('admin.index')}}" class="btn btn-admin">Admin</a>
    </div>
</body>
</html>
