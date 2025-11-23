<?php include 'includes/header.php'; ?>

<!-- ส่วนนำเข้า Font และ Style เฉพาะส่วนนี้ (ใส่ไว้ตรงนี้เพื่อให้แสดงผลถูกต้องแม้ Header ไม่มี) -->
<link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300;400;500;600&display=swap" rel="stylesheet">

<style>
    /* กำหนดตัวแปรสีและเงาสำหรับธีมหรูหรา */
    :root {
        --primary-gradient: linear-gradient(135deg, #4e54c8 0%, #8f94fb 100%);
        --secondary-gradient: linear-gradient(135deg, #a18cd1 0%, #fbc2eb 100%);
        --card-shadow: 0 15px 35px rgba(50, 50, 93, 0.1), 0 5px 15px rgba(0, 0, 0, 0.07);
        --input-focus-shadow: 0 0 0 0.25rem rgba(78, 84, 200, 0.25);
    }

    /* ปรับ Font หลักเฉพาะส่วนคอนเทนต์นี้ */
    .luxury-content-wrapper {
        font-family: 'Kanit', sans-serif;
        color: #495057;
    }
    .watermark-bg {
        position: fixed; /* ให้ติดอยู่กับหน้าจอ ไม่เลื่อนตาม Scroll */
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%); /* จัดให้อยู่กึ่งกลางเป๊ะๆ */
        width: 80vw;        /* ความกว้างสูงสุด 80% ของหน้าจอ */
        height: 80vh;       /* ความสูง */
        max-width: 600px;   /* ขนาดสูงสุดไม่เกิน 600px */
        max-height: 600px;
        background-image: url('logo/logo.png'); /* ใช้ไฟล์รูปที่คุณอัปโหลด */
        background-repeat: no-repeat;
        background-position: center;
        background-size: contain;
        opacity: 0.03;      /* ความจาง (ปรับเลขได้ 0.01 - 1.0) */
        z-index: -1;        /* สั่งให้ไปอยู่ข้างหลังสุด */
        pointer-events: none; /* ทะลุการคลิก ไม่บังปุ่ม */
        filter: grayscale(100%); /* (ทางเลือก) ทำให้เป็นขาวดำเพื่อให้ดูเนียนตาขึ้น ลบออกได้ถ้าชอบสีเดิม */
    }
    
    /* --- ปรับปรุง: Glass Card --- */
    .glass-card {
        /* [จุดที่ 3] ปรับพื้นหลังให้ใสขึ้น (จาก 0.92 เหลือ 0.85) เพื่อให้เห็นลายน้ำ */
        background: rgba(255, 255, 255, 0.85);
        
        backdrop-filter: blur(8px);
        -webkit-backdrop-filter: blur(8px);
        border: 1px solid rgba(255, 255, 255, 0.8);
        border-radius: 1.5rem;
        box-shadow: var(--card-shadow);
        transform: translateZ(0);
    }
    
    /* ตกแต่ง Tabs */
    .custom-nav-pills {
        background: #f1f3f5;
        border-radius: 1rem;
        padding: 0.5rem;
    }
    .custom-nav-pills .nav-link {
        border-radius: 0.8rem;
        color: #6c757d;
        font-weight: 500;
        transition: all 0.3s ease;
        border: none;
    }
    .custom-nav-pills .nav-link.active {
        background: var(--primary-gradient);
        color: white;
        box-shadow: 0 4px 15px rgba(78, 84, 200, 0.4);
    }
    
    /* ตกแต่ง Input แบบ Floating Label */
    .form-floating > .form-control,
    .form-floating > .form-select {
        border-radius: 1rem;
        border: 1px solid #e0e0e0;
        background: #f8f9fa;
        transition: all 0.3s;
    }
    .form-floating > .form-control:focus,
    .form-floating > .form-select:focus {
        background: #fff;
        border-color: #8f94fb;
        box-shadow: var(--input-focus-shadow);
    }
    
    /* ปุ่มกดไล่เฉดสี */
    .btn-gradient-primary {
        background: var(--primary-gradient);
        border: none;
        color: white;
        border-radius: 1rem;
        padding: 12px 30px;
        font-weight: 500;
        box-shadow: 0 10px 20px rgba(78, 84, 200, 0.3);
        transition: transform 0.2s;
    }
    .btn-gradient-primary:hover {
        transform: translateY(-2px);
        color: white;
        box-shadow: 0 15px 25px rgba(78, 84, 200, 0.4);
    }
    .btn-gradient-success {
        background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
        border: none;
        color: white;
        border-radius: 1rem;
        padding: 12px 30px;
        box-shadow: 0 10px 20px rgba(17, 153, 142, 0.3);
    }

    /* ข้อความไล่สี */
    .text-gradient {
        background: var(--primary-gradient);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }
    
    /* Animation */
    .tab-pane { animation: fadeIn 0.5s ease-out; }
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>

<div class="luxury-content-wrapper py-4">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-xl-7">

            <!-- Tabs เมนูเลือกโหมด -->
            <ul class="nav nav-pills nav-fill custom-nav-pills mb-5" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active py-3" id="submit-tab" data-bs-toggle="tab" data-bs-target="#submit-pane" type="button" role="tab">
                        <i class="bi bi-send-plus-fill me-2 h5"></i> แจ้งซ่อมใหม่
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link py-3" id="track-tab" data-bs-toggle="tab" data-bs-target="#track-pane" type="button" role="tab">
                        <i class="bi bi-search me-2 h5"></i> ติดตามสถานะ
                    </button>
                </li>
            </ul>
            
            <div class="tab-content" id="myTabContent">
                
                <!-- ส่วนที่ 1: ฟอร์มแจ้งซ่อม -->
                <div class="tab-pane fade show active" id="submit-pane" role="tabpanel">
                    <div class="glass-card p-4 p-md-5">
                        <div class="text-center mb-4">
                            <h2 class="h3 fw-bold text-gradient">แบบฟอร์มแจ้งซ่อม</h2>
                            <p class="text-muted small">กรุณากรอกข้อมูลให้ครบถ้วนเพื่อความรวดเร็ว</p>
                        </div>
                        
                        <form action="success.php" method="POST" enctype="multipart/form-data">
                            
                            <h5 class="mb-3 text-secondary border-bottom pb-2"><i class="bi bi-person-badge me-2"></i>ข้อมูลผู้แจ้ง</h5>
                            <div class="row g-3 mb-4">
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" name="reporter_name" class="form-control" id="floatingName" placeholder="ชื่อ-นามสกุล" required>
                                        <label for="floatingName">ชื่อ-นามสกุล <span class="text-danger">*</span></label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" name="reporter_id" class="form-control" id="floatingID" placeholder="รหัสบุคลากร">
                                        <label for="floatingID">รหัสบุคลากร/นักศึกษา <span class="text-danger">*</span></label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="tel" name="reporter_phone" class="form-control" id="floatingPhone" placeholder="เบอร์โทร" required>
                                        <label for="floatingPhone">เบอร์โทรติดต่อ <span class="text-danger">*</span></label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-group h-100">
                                        <div class="form-floating flex-grow-1">
                                            <input type="text" class="form-control" id="emailUsernameInput" placeholder="Username" required style="border-radius: 1rem 0 0 1rem;">
                                            <label for="emailUsernameInput">Username อีเมล <span class="text-danger">*</span></label>
                                        </div>
                                        <span class="input-group-text bg-light" style="border-radius: 0 1rem 1rem 0;">@lbtech.ac.th</span>
                                    </div>
                                    <input type="hidden" name="email" id="emailInputHidden">
                                </div>
                            </div>

                            <h5 class="mb-3 text-secondary border-bottom pb-2"><i class="bi bi-pc-display me-2"></i>รายละเอียดการซ่อม</h5>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <select class="form-select" name="device_type" id="floatingDevice" required>
                                            <option value="">เลือกประเภท</option>
                                            <option value="Computer">คอมพิวเตอร์</option>
                                            <option value="Projector">โปรเจคเตอร์</option>
                                            <option value="AccessPoint">Access point</option>
                                            <option value="Printer">เครื่องปริ้นเตอร์</option>
                                            <option value="Other">อื่นๆ</option>
                                        </select>
                                        <label for="floatingDevice">อุปกรณ์ที่ชำรุด <span class="text-danger">*</span></label>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <select class="form-select" id="buildingSelect" name="building" required>
                                            <option value="">เลือกตึก</option>
                                            <option value="ตึก 14">ตึก 14</option>
                                            <option value="ตึก 26">ตึก 26</option>
                                            <option value="ตึกอื่นๆ">ตึกอื่นๆ</option>
                                        </select>
                                        <label for="buildingSelect">สถานที่ (ตึก) <span class="text-danger">*</span></label>
                                    </div>
                                </div>

                                <!-- Dropdown ห้อง (ซ่อนอยู่) -->
                                <div class="col-md-6" id="roomDropdownContainer" style="display: none;">
                                    <div class="form-floating">
                                        <select class="form-select" id="roomSelect" name="room">
                                            <option value="">เลือกห้อง</option>
                                        </select>
                                        <label for="roomSelect">ระบุห้อง <span class="text-danger">*</span></label>
                                    </div>
                                </div>  
                                
                                <!-- Input ซ่อนสำหรับเก็บ Location เต็มๆ -->
                                <input type="hidden" name="location" id="locationInput">

                                <div class="col-12">
                                    <div class="form-floating">
                                        <textarea class="form-control" name="problem_detail" id="floatingProblem" style="height: 120px" placeholder="รายละเอียด" required></textarea>
                                        <label for="floatingProblem">รายละเอียดปัญหา (อาการเสีย) <span class="text-danger">*</span></label>
                                    </div>
                                </div>
                                
                                <div class="col-12">
                                    <label class="form-label text-muted small ps-2">รูปภาพประกอบ (ถ้ามี)</label>
                                    <input class="form-control p-3" type="file" name="repair_image" accept="image/*" style="border-radius: 1rem;">
                                </div>
                            </div>

                            <div class="d-grid mt-5">
                                <button type="submit" class="btn btn-gradient-primary btn-lg">
                                    <i class="bi bi-send-fill me-2"></i> ยืนยันการแจ้งซ่อม
                                </button>
                            </div>

                        </form>
                    </div>
                </div>

                <!-- ส่วนที่ 2: ติดตามสถานะ -->
                <div class="tab-pane fade" id="track-pane" role="tabpanel">
                    <div class="glass-card p-4 p-md-5 text-center">
                        <div class="mb-4">
                            <i class="bi bi-search display-4 text-gradient"></i>
                            <h2 class="h3 fw-bold mt-3">ติดตามสถานะ</h2>
                            <p class="text-muted">กรอกรหัส Tracking ID หรือสแกน QR Code</p>
                        </div>
                        
                        <form action="track.php" method="GET">
                            <div class="row justify-content-center">
                                <div class="col-md-8">
                                    <div class="form-floating mb-3">
                                        <input type="text" name="tracking_id" class="form-control text-center fs-5" id="floatingTrack" placeholder="Tracking ID" required style="letter-spacing: 2px; text-transform: uppercase;">
                                        <label for="floatingTrack">รหัสแจ้งซ่อม (เช่น REP-XXXX)</label>
                                    </div>
                                    <div class="d-grid">
                                        <button type="submit" class="btn btn-gradient-success btn-lg">
                                            <i class="bi bi-search me-2"></i> ค้นหาข้อมูล
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</div>

<script>
    // ข้อมูลห้องทั้งหมด
    const roomData = {
        "ตึก 14": [
            "ห้อง 1411", "ห้อง 1412", "ห้อง 1413", "ห้อง 1414", "ห้อง 1415", 
            "ห้อง 1421", "ห้อง 1422", "ห้อง 1423", "ห้อง 1424", "ห้อง 1425", 
            "ห้อง 1431", "ห้อง 1432", "ห้อง 1433", "ห้อง 1434", "ห้อง 1435", 
            "ห้อง 1441", "ห้อง 1442", "ห้อง 1443", "ห้อง 1444", "ห้อง 1445"
        ],
        "ตึก 26": ["ห้อง TC201", "ห้อง TC202", "ห้อง TC203", "ห้อง TC204", "ห้อง TC205"],
        "ตึกอื่นๆ": ["ห้อง IOT"]
    };

    const buildingSelect = document.getElementById('buildingSelect');
    const roomContainer = document.getElementById('roomDropdownContainer');
    const roomSelect = document.getElementById('roomSelect');
    const locationInput = document.getElementById('locationInput');
    
    const form = document.querySelector('form[action="success.php"]');
    const emailUsernameInput = document.getElementById('emailUsernameInput'); 
    const emailInputHidden = document.getElementById('emailInputHidden'); 
    const requiredDomain = '@lbtech.ac.th';

    // ฟังก์ชันอัปเดตค่า Location
    function updateLocation() {
        const building = buildingSelect.value;
        const room = roomSelect.value;
        
        if (building && room) {
            locationInput.value = `${building}, ${room}`; 
            roomSelect.required = true;
        } else if (building) {
            locationInput.value = building; 
            // ถ้าตึกนี้ไม่มีห้องให้เลือก (roomContainer ซ่อนอยู่) ไม่ต้องบังคับเลือกห้อง
            if(roomContainer.style.display === 'none') {
                 roomSelect.required = false;
            }
        } else {
            locationInput.value = "";
            roomSelect.required = false;
        }
    }

    // ฟังก์ชันโหลดห้องเมื่อเลือกตึก
    function loadRooms() {
        const selectedBuilding = buildingSelect.value;
        roomSelect.innerHTML = '<option value="">เลือกห้อง</option>'; 
        
        if (selectedBuilding && roomData[selectedBuilding] && roomData[selectedBuilding].length > 0) {
            roomData[selectedBuilding].forEach(room => {
                const option = document.createElement('option');
                option.value = room;
                option.textContent = room;
                roomSelect.appendChild(option);
            });
            roomContainer.style.display = 'block';
            roomSelect.required = true;
        } else {
            roomContainer.style.display = 'none';
            roomSelect.required = false;
        }
        updateLocation(); 
    }

    // ตรวจสอบก่อนส่งฟอร์ม
    form.addEventListener('submit', function(event) {
        const username = emailUsernameInput.value.trim();

        if (username === '') {
            event.preventDefault();
            alert(`❌ โปรดกรอกชื่อผู้ใช้ (Username)`);
            emailUsernameInput.focus();
            return;
        }

        if (username.includes('@') || username.includes(' ')) {
             event.preventDefault();
            alert(`❌ โปรดกรอกแค่ชื่อผู้ใช้ (Username) เท่านั้น\n\nไม่ต้องใส่ @lbtech.ac.th`);
            emailUsernameInput.focus();
            return;
        }

        // รวม Username กับ Domain
        emailInputHidden.value = username + requiredDomain;
        
        // เช็คว่าเลือกห้องหรือยัง (ถ้าจำเป็น)
        if (buildingSelect.value && roomContainer.style.display !== 'none' && !roomSelect.value) {
            event.preventDefault();
            alert(`❌ โปรดเลือกห้องให้ถูกต้อง`);
            roomSelect.focus();
            return;
        }
    });

    // Event Listeners
    buildingSelect.addEventListener('change', loadRooms);
    roomSelect.addEventListener('change', updateLocation);
    
    document.addEventListener('DOMContentLoaded', () => {
        loadRooms();
    });
</script>

<?php include 'includes/footer.php'; ?>