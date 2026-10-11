<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แจ้งซ่อมใหม่ - ระบบแจ้งซ่อมโรงเรียน</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <nav class="navbar navbar-dark bg-dark mb-4 shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ route('dashboard') }}">🔧 ระบบแจ้งซ่อมโรงเรียน (Laravel)</a>
        </div>
    </nav>

    <div class="container" style="max-width: 720px;">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-primary text-white py-3">
                <h5 class="mb-0 fw-bold">แบบฟอร์มแจ้งซ่อมใหม่</h5>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('repairs.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label fw-bold">อาคาร <span class="text-danger">*</span></label>
                            <input type="text" name="building" class="form-control" required
                                placeholder="เช่น อาคารเรียน 1">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">ห้อง <span class="text-danger">*</span></label>
                            <input type="text" name="room" class="form-control" required
                                placeholder="เช่น ห้อง 101 หรือ Lab 2">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label fw-bold">ประเภทปัญหา <span class="text-danger">*</span></label>
                            <select name="problem_type" class="form-select" required>
                                <option value="electrical">ระบบไฟฟ้า</option>
                                <option value="aircon">เครื่องปรับอากาศ</option>
                                <option value="computer">คอมพิวเตอร์ / อุปกรณ์ไอที</option>
                                <option value="furniture">โต๊ะ / เก้าอี้ / ครุภัณฑ์</option>
                                <option value="other">อื่น ๆ</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">ระดับความเร่งด่วน <span
                                    class="text-danger">*</span></label>
                            <select name="urgency" class="form-select" required>
                                <option value="low">ปกติ</option>
                                <option value="medium" selected>ด่วนปานกลาง</option>
                                <option value="high">ด่วนมาก</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">รายละเอียดปัญหา <span class="text-danger">*</span></label>
                        <textarea name="description" class="form-control" rows="3" required
                            placeholder="อธิบายอาการที่ชำรุดเสียหาย"></textarea>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold">แนบรูปภาพความเสียหาย (ถ้ามี)</label>
                        <input type="file" name="image" class="form-control" accept="image/*">
                    </div>

                    <div class="d-flex justify-content-between align-items-center pt-2">
                        <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary">ย้อนกลับ</a>
                        <button type="submit" class="btn btn-success px-4">บันทึกแจ้งซ่อม</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>