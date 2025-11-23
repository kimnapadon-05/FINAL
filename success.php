<?php 
include 'includes/header.php'; 
include 'db_connect.php'; 

// รับค่าจากฟอร์ม
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['reporter_name'];
    $id_code = $_POST['reporter_id'];
    $phone = $_POST['reporter_phone'];
    $email = $_POST['reporter_email'];
    $type = $_POST['device_type'];
    $building = $_POST['building'];
    $room = $_POST['room'];
    $detail = $_POST['problem_detail'];

    // สร้างรหัสติดตามงาน (เช่น REP-20231125-1234)
    $tracking_id = "REP-" . date("Ymd") . "-" . rand(1000, 9999);

    // เตรียมคำสั่ง SQL
    $sql = "INSERT INTO repair_requests (tracking_id, reporter_name, reporter_id, reporter_phone, reporter_email, device_type, building, room, problem_detail) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssssss", $tracking_id, $name, $id_code, $phone, $email, $type, $building, $room, $detail);
    
    if ($stmt->execute()) {
        // --- สร้าง QR Code ---
        // หา URL ปัจจุบันของเว็บไซต์
        $protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
        $domainName = $_SERVER['HTTP_HOST'];
        // ลบ success.php ออกเพื่อให้ได้ path หลัก แล้วเติม track.php
        $path = str_replace("success.php", "", $_SERVER['SCRIPT_NAME']);
        
        // URL ที่จะฝังใน QR Code
        $track_url = $protocol . $domainName . $path . "track.php?tracking_id=" . $tracking_id;
        
        // เรียกใช้ QuickChart API เพื่อสร้างภาพ QR Code
        $qr_api = "https://quickchart.io/qr?text=" . urlencode($track_url) . "&size=300";
        
    } else {
        echo "<div class='alert alert-danger'>เกิดข้อผิดพลาด: " . $conn->error . "</div>";
        exit;
    }
} else {
    // ถ้าไม่ได้ส่งค่ามา ให้กลับหน้าแรก
    header("Location: index.php");
    exit;
}
?>

<div class="row justify-content-center">
    <div class="col-md-7 text-center">
        <div class="card p-4 p-md-5 shadow">
            <div class="alert alert-success" role="alert">
                <h4 class="alert-heading"><i class="bi bi-check-circle-fill"></i> แจ้งซ่อมสำเร็จ!</h4>
                <p>บันทึกข้อมูลลงระบบเรียบร้อยแล้ว เจ้าหน้าที่จะดำเนินการตรวจสอบโดยเร็วที่สุด</p>
            </div>
            
            <h5 class="mt-4 text-muted">รหัสติดตามสถานะของคุณคือ</h5>
            <div class="bg-light border rounded p-3 d-inline-block mt-2">
                <h2 class="text-primary fw-bold m-0"><?php echo $tracking_id; ?></h2>
            </div>
            
            <div class="mt-4">
                <p class="mb-2 fw-bold">สแกน QR Code เพื่อติดตามสถานะ</p>
                <img src="<?php echo $qr_api; ?>" alt="QR Code" class="img-fluid border p-2 rounded bg-white" style="width: 200px;">
            </div>

            <div class="mt-4 d-flex justify-content-center gap-2">
                <a href="print.php?asset=<?php echo $tracking_id; ?>&qrcode=<?php echo urlencode($qr_api); ?>" target="_blank" class="btn btn-outline-secondary">
                    <i class="bi bi-printer"></i> พิมพ์ใบแจ้ง
                </a>
                <a href="index.php" class="btn btn-primary">
                    <i class="bi bi-house-fill"></i> กลับหน้าแรก
                </a>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>