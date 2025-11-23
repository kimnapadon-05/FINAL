<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300;400;500&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Kanit', sans-serif;
            background-color: #E0F7FA; /* ฟ้าอ่อน */
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }
        .login-card {
            width: 100%;
            max-width: 400px;
            border: none;
            border-radius: 0.75rem;
            box-shadow: 0 8px 24px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>

    <div class="card login-card p-4 p-md-5">
        <h2 class="text-center mb-4">
            <i class="bi bi-tools text-primary"></i>
            ระบบแจ้งซ่อม (สำหรับเจ้าหน้าที่)
        </h2>
        
        <form action="dashboard.php" method="POST">
            <div class="mb-3">
                <label class="form-label">ชื่อผู้ใช้ (Username)</label>
                <input type="text" class="form-control" value="admin">
            </div>
            <div class="mb-3">
                <label class="form-label">รหัสผ่าน (Password)</label>
                <input type="password" class="form-control" value="">
            </div>
            <div class="d-grid mt-4">
                <button type="submit" class="btn btn-primary btn-lg">
                    <i class="bi bi-box-arrow-in-right"></i> เข้าสู่ระบบ
                </button>
            </div>
        </form>
    </div>

</body>
</html>