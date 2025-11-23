<!DOCTYPE html>
<html lang="th">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ระบบสร้าง QR Code - แจ้งซ่อมอุปกรณ์ไอที</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f8f9fa;
    }
    .card {
      border-radius: 15px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }
  </style>
</head>
<body>
<div class="container mt-5">
  <div class="card p-4">
    <h3 class="text-center mb-4">สร้าง QR Code สำหรับอุปกรณ์ไอที</h3>
    <form action="/admin/generate_qr.php" method="POST" enctype="multipart/form-data">
      <div class="row justify-content-center">
        <div class="col-md-6">
          <div class="mb-3">
            <label class="form-label">รหัสครุภัณฑ์</label>
            <input type="text" name="asset_id" class="form-control" placeholder="เช่น 220000007757-0" required>
          </div>
          <div class="mb-3">
            <label class="form-label">ชื่ออุปกรณ์</label>
            <input type="text" name="equipment_name" class="form-control" placeholder="COM-01" required>
          </div>
          <div class="mb-3">
            <label class="form-label">ชื่อรุ่น</label>
            <input type="text" name="model_name" class="form-control" placeholder="เช่น LENOVO ideapad 330 " required>
          </div>
          <div class="mb-3">
            <label class="form-label">ประเภทอุปกรณ์</label>
            <input type="text" name="equipment_type" class="form-control" placeholder="COMPUTER EQUIPMENT" required>
          </div>
          <div class="mb-3">
            <label class="form-label">หมายเลขซีเรียล</label>
            <input type="text" name="serial_no" class="form-control" placeholder="PW0H8E97" required>
          </div>
          <div class="mb-3">
            <label class="form-label">ตำแหน่งที่ตั้ง</label>
            <input type="text" name="location" class="form-control" placeholder="ห้อง IT" required>
          </div>
          <div class="mb-3">
            <label class="form-label">รูปภาพอุปกรณ์</label>
            <input type="file" name="image" class="form-control" accept="image/*" required>
          </div>
          <button type="submit" class="btn btn-primary w-100">Generate QR Code</button>
        </div>
      </div>
    </form>
  </div>
</div>
</body>
</html>
