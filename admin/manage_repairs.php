<?php
$statuses = [
    'รอรับเรื่อง' => ['text' => 'รอรับเรื่อง', 'class' => 'warning', 'badge_class' => 'bg-warning text-dark'],
    'กำลังซ่อม' => ['text' => 'กำลังซ่อม', 'class' => 'primary', 'badge_class' => 'bg-primary text-white'],
    'เสร็จสิ้น' => ['text' => 'เสร็จสิ้น', 'class' => 'success', 'badge_class' => 'bg-success text-white'],
];

$technicians = [
    'ช่างนาธาน',
    'ช่างนภดล',
];

// ข้อมูลรายการแจ้งซ่อมจำลอง (อ้างอิงจากรูปภาพ)
$repairs = [
    ['id' => 'SC201', 'title' => 'เครื่องปริ้นเตอร์ สีไม่ออก', 'reporter' => 'สมชาย ใจดี', 'location' => 'ห้อง1444 ตึก8', 'technician' => '-', 'status' => 'รอรับเรื่อง', 'level' => 'สูง', 'date' => '2 พ.ย.'],
    ['id' => 'SC200', 'title' => 'คอมพิวเตอร์เปิดไม่ติด', 'reporter' => 'สมชาย ใจดี', 'location' => 'ห้อง1443 ตึก8', 'technician' => 'ช่างนภดล', 'status' => 'กำลังซ่อม', 'level' => 'ปานกลาง', 'date' => '25 ต.ค.'],
    ['id' => 'SC199', 'title' => 'เครื่องปริ้นเตอร์ไม่ดึงกระดาษ', 'reporter' => 'นิสา สวยงาม', 'location' => 'ห้อง1431 ตึก8', 'technician' => 'ช่างนาธาน', 'status' => 'เสร็จสิ้น', 'level' => 'ปานกลาง', 'date' => '30 ต.ค.'],
    ['id' => 'SC198', 'title' => 'อินเทอร์เน็ตใช้งานไม่ได้', 'reporter' => 'วายุ รักเรียน', 'location' => 'TC202 ตึก 26', 'technician' => 'ช่างนาธาน', 'status' => 'เสร็จสิ้น', 'level' => 'สูง', 'date' => '31 ต.ค.'],
];

// ========================================================================
// 2. ฟังก์ชันช่วย
// ========================================================================
/**
 * คืนค่า CSS class สำหรับ Badge ตามสถานะที่กำหนด
 * @param string $status
 * @return string
 */
function get_status_badge_class($status) {
    global $statuses;
    return $statuses[$status]['badge_class'] ?? 'bg-secondary';
}



?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>จัดการงานซ่อม - ระบบแจ้งซ่อม</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300;400;500;600&display=swap" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Kanit', sans-serif;
            background-color: #F8F9FA;
            transition: opacity 0.5s ease-out;
        }
        body.page-fade-out {
            opacity: 0;
        }
        .sidebar {
            position: fixed; top: 0; left: 0; height: 100vh; width: 260px;
            background-color: #FFFFFF; padding: 1.5rem 1rem; border-right: 1px solid #dee2e6;
            display: flex; flex-direction: column;
        }
        .sidebar-header {
            font-size: 1.5rem; font-weight: 600; color: #333; margin-bottom: 1.5rem; padding-left: 0.5rem;
        }
        .nav-link {
            font-size: 1rem; font-weight: 400; color: #495057; padding: 0.75rem 1rem;
            border-radius: 0.5rem; margin-bottom: 0.25rem;
        }
        .nav-link:hover {
            background-color: #F8F9FA; color: #007BFF;
        }
        /* เปลี่ยน active เป็นหน้าจัดการงานซ่อม */
        .nav-link.active {
            background-color: #E0F7FA; color: #007BFF; font-weight: 500;
        }
        .nav-link i {
            width: 20px; margin-right: 0.75rem;
        }
        .nav-link.special-menu {
            background-color: #007BFF; color: #FFFFFF;
        }
        .nav-link.special-menu:hover {
            background-color: #0056b3;
        }
        .sidebar-footer {
            margin-top: auto;
        }
        .main-content {
            margin-left: 260px; padding: 1.5rem;
        }
        .header {
            background-color: #FFFFFF; border-bottom: 1px solid #dee2e6; padding: 1rem 1.5rem;
            margin-left: 260px; display: flex; justify-content: space-between; align-items: center;
        }
        .header h1 {
            font-size: 1.75rem; font-weight: 500; margin: 0;
        }
        .card {
            border: none; border-radius: 0.75rem; box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        }
        
        /* สไตล์เพิ่มเติมสำหรับหน้าจัดการ */
        .stat-card-mini {
            border: 1px solid #dee2e6;
            border-radius: 0.75rem;
            padding: 1rem 1.5rem;
            text-align: center;
            font-size: 1.25rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s ease;
        }
        .stat-card-mini:hover {
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        .stat-card-mini h2 {
            font-size: 2.25rem;
            font-weight: 600;
            margin-bottom: 0.25rem;
        }
        .stat-card-mini.active-filter {
            border-color: #007BFF;
            background-color: #E0F7FA;
        }
        
        /* สีตามสถานะ */
        .status-warning { color: #FFC107; }
        .status-primary { color: #007BFF; }
        .status-success { color: #28A745; }
        
        /* ปุ่มจัดการในตาราง */
        .action-icon {
            font-size: 1.1rem;
            margin-left: 0.5rem;
            opacity: 0.7;
            transition: opacity 0.2s;
        }
        .action-icon:hover {
            opacity: 1;
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
                    <a class="nav-link" href="dashboard.php"> <i class="bi bi-house-door-fill"></i> หน้าแรก
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="manage_repairs.php"> <i class="bi bi-list-task"></i> จัดการงานซ่อม
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
        <h1>จัดการงานซ่อม 🛠️</h1>
        <div class="user-profile">
            <i class="bi bi-person-circle fs-3"></i>
            <span class="ms-2">Admin</span>
        </div>
    </header>

    <main class="main-content">
        
        <div class="row g-4 mb-4">
            <div class="col-md-3">
                <div class="stat-card-mini bg-white border-primary active-filter" data-filter="">
                    <h2><?= count($repairs) ?></h2>
                    <p class="mb-0">ทั้งหมด</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-card-mini bg-white border-warning" data-filter="รอรับเรื่อง">
                    <h2 class="status-warning"><?= count(array_filter($repairs, fn($r) => $r['status'] == 'รอรับเรื่อง')) ?></h2>
                    <p class="mb-0">รอรับเรื่อง</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-card-mini bg-white border-primary" data-filter="กำลังซ่อม">
                    <h2 class="status-primary"><?= count(array_filter($repairs, fn($r) => $r['status'] == 'กำลังซ่อม')) ?></h2>
                    <p class="mb-0">กำลังซ่อม</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-card-mini bg-white border-success" data-filter="เสร็จสิ้น">
                    <h2 class="status-success"><?= count(array_filter($repairs, fn($r) => $r['status'] == 'เสร็จสิ้น')) ?></h2>
                    <p class="mb-0">เสร็จสิ้น</p>
                </div>
            </div>
        </div>
        
        <div class="card mb-4">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-md-6 mb-3 mb-md-0">
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-search"></i></span>
                            <input type="text" class="form-control" id="searchInput" placeholder="ค้นหาด้วยรหัส, ชื่อเรื่อง, หรือชื่อช่าง...">
                        </div>
                    </div>
                    <div class="col-md-4 mb-3 mb-md-0">
                        <select id="statusFilter" class="form-select">
                            <option value="">ทุกสถานะ</option>
                            <?php foreach ($statuses as $key => $status): ?>
                                <option value="<?= $key ?>"><?= $key ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-2 text-md-end">
                         <button class="btn btn-outline-secondary w-100" onclick="location.reload();">
                            <i class="bi bi-arrow-clockwise"></i> รีเฟรช
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">รายการงานซ่อมทั้งหมด (<?= count($repairs) ?>)</h5>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead>
                            <tr>
                                <th>รหัสเเจ้งซ่อม</th>
                                <th>ชื่อเรื่อง/ปัญหา</th>
                                <th>ผู้แจ้ง</th>
                                <th>สถานที่</th>
                                <th>ช่างผู้รับผิดชอบ</th>
                                <th>สถานะ</th>
                                <th>วันที่</th>
                                <th>จัดการ</th>
                            </tr>
                        </thead>
                        <tbody id="repairTableBody">
                            <?php foreach ($repairs as $repair): ?>
                                <tr data-status="<?= $repair['status'] ?>" class="repair-row">
                                    <td><a href="#" class="text-primary fw-bold"><?= $repair['id'] ?></a></td>
                                    <td>
                                        <strong><?= $repair['title'] ?></strong>
                                        <p class="text-muted small mb-0"><?= $repair['reporter'] ?></p>
                                    </td>
                                    <td><?= $repair['reporter'] ?></td>
                                    <td><?= $repair['location'] ?></td>
                                    <td><?= $repair['technician'] ?></td>
                                    <td><span class="badge <?= get_status_badge_class($repair['status']) ?>"><?= $repair['status'] ?></span></td>
                                    <td><?= $repair['date'] ?></td>
                                    <td>
                                        <button class="btn btn-sm btn-link p-0 text-primary" 
                                                data-bs-toggle="modal" 
                                                data-bs-target="#manageRepairModal"
                                                data-repair-id="<?= $repair['id'] ?>"
                                                data-current-status="<?= $repair['status'] ?>"
                                                data-current-technician="<?= $repair['technician'] ?>"
                                                title="แก้ไข/มอบหมาย">
                                            <i class="bi bi-pencil-square action-icon"></i>
                                        </button>
                                        <button class="btn btn-sm btn-link p-0 text-dark" title="ดูรายละเอียด">
                                            <i class="bi bi-eye action-icon"></i>
                                        </button>
                                        <button class="btn btn-sm btn-link p-0 text-danger" title="ลบ" onclick="return confirm('ยืนยันการลบรายการ <?= $repair['id'] ?>?');">
                                            <i class="bi bi-trash action-icon"></i>
                                        </button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            <?php if (empty($repairs)): ?>
                                <tr>
                                    <td colspan="8" class="text-center text-muted py-4">
                                        <i class="bi bi-exclamation-circle fs-4 d-block mb-2"></i>
                                        ไม่พบรายการแจ้งซ่อม
                                    </td>
                                </tr>
                            <?php endif; ?>
                    </table>
                </div>
            </div>
        </div>
        
    </main>

    <div class="modal fade" id="manageRepairModal" tabindex="-1" aria-labelledby="manageRepairModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="manageRepairModalLabel">จัดการงานซ่อม: <span id="modalRepairId" class="text-primary"></span></h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form id="manageRepairForm" method="POST" action="process_repair.php"> <input type="hidden" name="repair_id" id="hiddenRepairId">
              <div class="modal-body">
                
                <div class="mb-3">
                  <label for="technicianSelect" class="form-label">มอบหมายช่าง</label>
                  <select class="form-select" id="technicianSelect" name="technician_name" required>
                    <option value="" selected>--- เลือกช่างผู้รับผิดชอบ ---</option>
                    <?php foreach ($technicians as $tech): ?>
                        <option value="<?= $tech ?>"><?= $tech ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>

                <div class="mb-3">
                  <label for="statusSelect" class="form-label">อัปเดตสถานะ</label>
                  <select class="form-select" id="statusSelect" name="new_status" required>
                     <?php foreach ($statuses as $key => $status): ?>
                        <option value="<?= $key ?>"><?= $status['text'] ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
                
                <div class="mb-3">
                  <label for="repairNote" class="form-label">บันทึก/หมายเหตุ (ถ้ามี)</label>
                  <textarea class="form-control" id="repairNote" name="note" rows="3"></textarea>
                </div>
                
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ยกเลิก</button>
                <button type="submit" class="btn btn-primary">บันทึกการเปลี่ยนแปลง</button>
              </div>
          </form>
        </div>
      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
    document.addEventListener("DOMContentLoaded", function() {
        // --- 7.1. การจัดการ Modal (เมื่อปุ่มแก้ไขถูกกด) ---
        const manageRepairModal = document.getElementById('manageRepairModal');
        manageRepairModal.addEventListener('show.bs.modal', function (event) {
            // ดึงปุ่มที่ถูกคลิก
            const button = event.relatedTarget;
            // ดึงข้อมูลจาก data-* attributes
            const repairId = button.getAttribute('data-repair-id');
            const currentStatus = button.getAttribute('data-current-status');
            const currentTechnician = button.getAttribute('data-current-technician');
            
            // อัปเดตข้อมูลใน Modal
            const modalTitle = manageRepairModal.querySelector('#modalRepairId');
            const hiddenIdInput = manageRepairModal.querySelector('#hiddenRepairId');
            const statusSelect = manageRepairModal.querySelector('#statusSelect');
            const technicianSelect = manageRepairModal.querySelector('#technicianSelect');
            
            modalTitle.textContent = repairId;
            hiddenIdInput.value = repairId;
            
            // ตั้งค่าสถานะปัจจุบัน
            statusSelect.value = currentStatus;
            
            // ตั้งค่าช่างผู้รับผิดชอบปัจจุบัน
            // ต้องตรวจสอบว่ามีช่างใน dropdown หรือไม่ก่อนตั้งค่า
            if (currentTechnician && technicianSelect.querySelector(`option[value="${currentTechnician}"]`)) {
                technicianSelect.value = currentTechnician;
            } else {
                technicianSelect.value = ''; // เลือก option แรก (--- เลือกช่างผู้รับผิดชอบ ---)
            }
        });
        
        // --- 7.2. การจัดการ Search และ Filter ---
        const searchInput = document.getElementById('searchInput');
        const statusFilter = document.getElementById('statusFilter');
        const statCards = document.querySelectorAll('.stat-card-mini');
        const repairTableBody = document.getElementById('repairTableBody');

        function filterRepairs() {
            const searchText = searchInput.value.toLowerCase().trim();
            const filterStatus = statusFilter.value;
            const rows = repairTableBody.querySelectorAll('.repair-row');

            let visibleCount = 0;

            rows.forEach(row => {
                const rowStatus = row.getAttribute('data-status');
                const rowText = row.textContent.toLowerCase();

                const statusMatch = filterStatus === '' || rowStatus === filterStatus;
                const searchMatch = rowText.includes(searchText);

                if (statusMatch && searchMatch) {
                    row.style.display = '';
                    visibleCount++;
                } else {
                    row.style.display = 'none';
                }
            });
            
            // ซ่อน/แสดง ข้อความ "ไม่พบรายการแจ้งซ่อม" (ถ้ามี)
            // ในการจำลองนี้ ผมไม่ได้สร้างแถว "ไม่พบ" ไว้ แต่ถ้ามีต้องจัดการตรงนี้
        }

        // Event Listeners สำหรับการค้นหาและกรอง
        searchInput.addEventListener('keyup', filterRepairs);
        statusFilter.addEventListener('change', function() {
            // เมื่อเปลี่ยนใน dropdown ให้รีเซ็ต card filter
            statCards.forEach(card => card.classList.remove('active-filter'));
            filterRepairs();
        });

        // Event Listeners สำหรับ Stat Card Filter
        statCards.forEach(card => {
            card.addEventListener('click', function() {
                const filterValue = this.getAttribute('data-filter');
                
                // Toggle active class
                statCards.forEach(c => c.classList.remove('active-filter'));
                this.classList.add('active-filter');
                
                // ตั้งค่า Dropdown Filter ให้ตรงกัน แล้วกรอง
                statusFilter.value = filterValue;
                filterRepairs();
            });
        });
        
        // --- 7.3. Fade Out สำหรับ Logout (ดึงมาจาก dashboard.php) ---
        const logoutButton = document.getElementById("logout-link");

        if (logoutButton) {
            logoutButton.addEventListener("click", function(event) {
                event.preventDefault(); 
                const destinationUrl = this.href; 
                document.body.classList.add("page-fade-out");
                
                setTimeout(function() {
                    window.location.href = destinationUrl;
                }, 500); 
            });
        }
    });
    </script>
</body>
</html>