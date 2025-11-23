<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - ระบบแจ้งซ่อม</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300;400;500;600&display=swap" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Kanit', sans-serif;
            background-color: #F8F9FA; /* เทาอ่อน */
            
            /* */
            transition: opacity 0.5s ease-out;
        }
        
        /* */
        body.page-fade-out {
            opacity: 0;
        }
        
        /* === Sidebar Layout === */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh; /* สูงเต็มจอ */
            width: 260px; /* ความกว้าง Sidebar */
            background-color: #FFFFFF;
            padding: 1.5rem 1rem;
            border-right: 1px solid #dee2e6;
            display: flex;
            flex-direction: column;
        }
        
        .sidebar-header {
            font-size: 1.5rem;
            font-weight: 600;
            color: #333;
            margin-bottom: 1.5rem;
            padding-left: 0.5rem;
        }
        
        .nav-link {
            font-size: 1rem;
            font-weight: 400;
            color: #495057;
            padding: 0.75rem 1rem;
            border-radius: 0.5rem; /* มุมโค้งเมนู */
            margin-bottom: 0.25rem;
        }
        
        .nav-link:hover {
            background-color: #F8F9FA;
            color: #007BFF;
        }
        
        .nav-link.active {
            background-color: #E0F7FA; /* สีฟ้าอ่อน */
            color: #007BFF; /* สีฟ้าเข้ม */
            font-weight: 500;
        }
        
        .nav-link i {
            width: 20px;
            margin-right: 0.75rem;
        }
        
        /* เมนูย่อย (เช่น สร้าง QR Code) */
        .nav-link.special-menu {
            background-color: #007BFF;
            color: #FFFFFF;
        }
        .nav-link.special-menu:hover {
            background-color: #0056b3;
        }

        .sidebar-footer {
            margin-top: auto; /* ดันไปล่างสุด */
        }
        
        /* === Main Content === */
        .main-content {
            margin-left: 260px; /* เท่ากับความกว้าง Sidebar */
            padding: 1.5rem;
        }
        
        /* === Header (Top bar) === */
        .header {
            background-color: #FFFFFF;
            border-bottom: 1px solid #dee2e6;
            padding: 1rem 1.5rem;
            margin-left: 260px; /* กันที่สำหรับ Sidebar */
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header h1 {
            font-size: 1.75rem;
            font-weight: 500;
            margin: 0;
        }
        
        /* === Card Styles (ปรับให้เหมือนตัวอย่าง) === */
        .card {
            border: none;
            border-radius: 0.75rem;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        }
        
        .stat-card {
            border-radius: 1rem;
            padding: 1.5rem;
            color: #FFFFFF;
        }
        .stat-card h1 {
            font-size: 2.5rem;
            font-weight: 600;
        }
        .bg-custom-warning { background-color: #FFC107; }
        .bg-custom-primary { background-color: #007BFF; }
        .bg-custom-success { background-color: #28A745; }
        
        /* Quick Action Button */
        .quick-action-card {
            display: flex;
            align-items: center;
            padding: 1rem;
            transition: all 0.2s ease;
        }
        .quick-action-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 15px rgba(0,0,0,0.1);
        }
        .quick-action-card i {
            font-size: 1.5rem;
            padding: 0.75rem;
            border-radius: 50%;
        }

    </style>
</head>
<body>

    <div class="sidebar">
        <div>
            <div class="sidebar-header">
                <i class="bi bi-database"></i>
                ระบบแจ้งซ่อมอุปกรณ์ IT
            </div>
            
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link active" href="/project_final/admin/dashboard.php">
                        <i class="bi bi-house-door-fill"></i> หน้าแรก
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/project_final/admin/manage_repairs.php">
                        <i class="bi bi-list-task"></i> จัดการงานซ่อม
                    </a>
                </li>
            
            <hr>
            
            <ul class="nav flex-column">
                 <li class="nav-item">
                    <a class="nav-link special-menu" href="QR_code.php">
                        <i class="bi bi-qr-code-scan"></i> สร้าง QR Code
                    </a>
                </li>
            </ul>
        </div>
        
        <div class="sidebar-footer">
             <a id="logout-link" class="nav-link text-danger" href="/project_final/index.php"> 
                 <i class="bi bi-box-arrow-left"></i> ออกจากระบบ
             </a>
        </div>
    </div>

    <header class="header">
        <h1>ยินดีต้อนรับ Admin</h1>
        <div class="user-profile">
            <i class="bi bi-person-circle fs-3"></i>
            <span class="ms-2">Admin</span>
        </div>
    </header>

    <main class="main-content">
        
        <div class="row g-4 mb-4">
            <div class="col-md-4">
                <div class="stat-card bg-custom-warning">
                    <p class="mb-2">รอดำเนินการ</p>
                    <h1 class="mb-0">1</h1>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stat-card bg-custom-primary">
                    <p class="mb-2">กำลังซ่อม</p>
                    <h1 class="mb-0">1</h1>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stat-card bg-custom-success">
                    <p class="mb-2">เสร็จสิ้น</p>
                    <h1 class="mb-0">2</h1>
                </div>
            </div>
        </div>
        
        <div class="row g-4">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">รายการแจ้งซ่อมล่าสุด</h5>
                        <a href="#" class="btn btn-sm btn-outline-primary">ดูทั้งหมด &rarr;</a>
                    </div>
                    <div class="card-body p-0">
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th>รหัสเเจ้งซ่อม</th>
                                    <th>ปัญหา</th>
                                    <th>สถานะ</th>
                                    <th>วันที่</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>SC201</td>
                                    <td>เครื่องปริ้นเตอร์ สีไม่ออก</td>
                                    <td><span class="badge bg-warning text-dark">รอรับเรื่อง</span></td>
                                    <td>5/10/2568</td>
                                </tr>
                                <tr>
                                    <td>SC200</td>
                                    <td>คอมพิวเตอร์เปิดไม่ติด</td>
                                    <td><span class="badge bg-primary">กำลังซ่อม</span></td>
                                    <td>35/10/2568</td>
                                   </tr>
                                <tr>
                                    <td>SC199</td>
                                    <td>คีย์บอร์ดพัง</td>
                                    <td><span class="badge bg-success">เสร็จสิ้น</span></td>
                                    <td>30/10/2568</td>
                                </tr>
                                <tr>
                                    <td>SC198</td>
                                    <td>อินเทอร์เน็ตใช้งานไม่ได้</td>
                                    <td><span class="badge bg-success">เสร็จสิ้น</span></td>
                                    <td>31/10/2568</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
    document.addEventListener("DOMContentLoaded", function() {
        // 1. หาปุ่มออกจากระบบด้วย id
        const logoutButton = document.getElementById("logout-link");

        if (logoutButton) {
            // 2. เพิ่ม Event Listener เมื่อคลิก
            logoutButton.addEventListener("click", function(event) {
                
                // 3. หยุดการทำงานปกติของลิงก์ (ไม่ให้เด้งไปทันที)
                event.preventDefault(); 
                
                // 4. เก็บ URL ที่จะไป (ดึงจาก href ของปุ่ม)
                const destinationUrl = this.href; 
                
                // 5. เพิ่ม class 'page-fade-out' ไปที่ body เพื่อเริ่ม transition
                document.body.classList.add("page-fade-out");
                
                // 6. รอ 500ms (เท่ากับเวลา transition ใน CSS) แล้วค่อยสั่ง redirect
                setTimeout(function() {
                    window.location.href = destinationUrl;
                }, 500); // 500ms = 0.5s
            });
        }
    });
    </script>
</body>
</html>