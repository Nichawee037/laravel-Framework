<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ระบบแจ้งซ่อม - Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <nav class="navbar navbar-dark bg-dark mb-4 shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ route('dashboard') }}">🔧 ระบบแจ้งซ่อมโรงเรียน (Laravel)</a>
        </div>
    </nav>

    <div class="container">
        <!-- กล่องสถิติ 4 ช่อง -->
        <div class="row g-3 mb-4 text-white">
            <div class="col-md-3">
                <div class="card bg-secondary p-3 shadow-sm border-0">
                    <h6 class="text-white-50">งานทั้งหมด</h6>
                    <h2 class="mb-0 fw-bold">{{ $stats['total'] }}</h2>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-warning p-3 shadow-sm border-0 text-dark">
                    <h6 class="text-black-50">รอดำเนินการ</h6>
                    <h2 class="mb-0 fw-bold">{{ $stats['pending'] }}</h2>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-primary p-3 shadow-sm border-0">
                    <h6 class="text-white-50">กำลังซ่อม</h6>
                    <h2 class="mb-0 fw-bold">{{ $stats['in_progress'] }}</h2>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-success p-3 shadow-sm border-0">
                    <h6 class="text-white-50">ซ่อมเสร็จสิ้น</h6>
                    <h2 class="mb-0 fw-bold">{{ $stats['completed'] }}</h2>
                </div>
            </div>
        </div>

        <!-- ตารางรายการแจ้งซ่อม -->
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                <h5 class="mb-0 fw-bold">รายการแจ้งซ่อมล่าสุด</h5>
                <a href="{{ route('repairs.create') }}" class="btn btn-primary btn-sm px-3">+ แจ้งซ่อมใหม่</a>
            </div>
            <div class="table-responsive">
                <table class="table table-hover mb-0 align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>รหัส</th>
                            <th>สถานที่</th>
                            <th>ปัญหา</th>
                            <th>รูปภาพ</th>
                            <th>ความเร่งด่วน</th>
                            <th>สถานะ</th>
                            <th>ผู้แจ้ง</th>
                            <th>ช่างผู้รับผิดชอบ</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($repairs as $row)
                            <tr>
                                <td><strong>{{ $row->request_no }}</strong></td>
                                <td>{{ $row->building }} {{ $row->room }}</td>
                                <td>{{ $row->description }}</td>
                                <td>
                                    @if($row->images->count() > 0)
                                        <a href="{{ asset($row->images->first()->image_path) }}" target="_blank">
                                            <img src="{{ asset($row->images->first()->image_path) }}" alt="รูปภาพ" width="50"
                                                height="50" class="rounded object-fit-cover">
                                        </a>
                                    @else
                                        <span class="text-muted small">ไม่มีรูป</span>
                                    @endif
                                </td>
                                <td>
                                    <span
                                        class="badge bg-{{ $row->urgency == 'high' ? 'danger' : ($row->urgency == 'medium' ? 'warning' : 'secondary') }}">
                                        {{ $row->urgency }}
                                    </span>
                                </td>
                                <td>
                                    <span
                                        class="badge bg-{{ $row->status == 'completed' ? 'success' : ($row->status == 'in_progress' ? 'primary' : 'warning text-dark') }}">
                                        {{ $row->status }}
                                    </span>
                                </td>
                                <td>{{ $row->user->name ?? 'ไม่ระบุ' }}</td>
                                <td>{{ $row->technician->name ?? 'ยังไม่มอบหมาย' }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center py-4 text-muted">ยังไม่มีข้อมูลการแจ้งซ่อมในระบบ</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @if(session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'สำเร็จ!',
                text: '{{ session("success") }}',
                confirmButtonColor: '#0d6efd'
            });
        </script>
    @endif

</body>

</html>