<?php include 'includes/header.php'; ?>

<?php
// รับค่า ID จาก URL (เพื่อความปลอดภัย ควรมีการ sanitize)
$tracking_id = isset($_GET['tracking_id']) ? htmlspecialchars($_GET['tracking_id']) : 'ไม่มีข้อมูล';
?>

<div class="row justify-content-center">
    <div class="col-lg-7">
        <div class="card p-4 p-md-5">
            <h2 class="h4 mb-4">สถานะงานซ่อม: <span class="text-primary"><?php echo $tracking_id; ?></span></h2>
            
            <div class="mb-3">
                <strong>สถานที่:</strong> ตึก 26 ห้อง TC202
            </div>
            <div class="mb-3">
                <strong>ปัญหา:</strong> เครื่องปริ้นเตอร์ไม่ดึงกระดาษ
            </div>
            <div class="mb-4">
                <strong>ช่างผู้รับผิดชอบ:</strong> (ยังไม่มอบหมาย)
            </div>
            
            <ul class="list-group">
                <li class="list-group-item list-group-item-action list-group-item-success">
                    <i class="bi bi-check-circle-fill"></i>
                    <strong>รอรับเรื่อง</strong> (วันที่ 1 พ.ย. 2568)
                    <small class="d-block">ระบบได้รับข้อมูลการแจ้งซ่อมของคุณแล้ว</small>
                </li>
                <li class="list-group-item list-group-item-action disabled text-muted">
                    <i class="bi bi-person-fill-gear"></i>
                    <strong>กำลังดำเนินการ</strong>
                    <small class="d-block">เจ้าหน้าที่กำลังตรวจสอบ / มอบหมายงาน</small>
                </li>
                 <li class="list-group-item list-group-item-action disabled text-muted">
                    <i class="bi bi-flag-fill"></i>
                    <strong>เสร็จสิ้น</strong>
                </li>
            </ul>

            <div class="text-center mt-4">
                 <a href="index.php" class="btn btn-secondary">
                    <i class="bi bi-search"></i> ค้นหางานอื่น
                </a>
            </div>

        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>