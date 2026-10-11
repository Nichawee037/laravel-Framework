<?php

namespace App\Http\Controllers;

use App\Models\RepairRequest;
use App\Models\RepairImage;
use Illuminate\Http\Request;

class RepairRequestController extends Controller
{
    // หน้ารวม Dashboard
    public function index()
    {
        $stats = [
            'total' => RepairRequest::count(),
            'pending' => RepairRequest::where('status', 'pending')->count(),
            'in_progress' => RepairRequest::where('status', 'in_progress')->count(),
            'completed' => RepairRequest::where('status', 'completed')->count(),
        ];

        $repairs = RepairRequest::with(['user', 'technician', 'images'])
            ->latest()
            ->get();

        return view('dashboard', compact('stats', 'repairs'));
    }

    // หน้าแบบฟอร์มแจ้งซ่อมใหม่
    public function create()
    {
        return view('create');
    }

    // บันทึกข้อมูลลงฐานข้อมูล
    public function store(Request $request)
    {
        $request->validate([
            'building' => 'required|string|max:100',
            'room' => 'required|string|max:50',
            'problem_type' => 'required|in:electrical,furniture,computer,aircon,other',
            'urgency' => 'required|in:low,medium,high',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
        ]);

        // รันเลขที่ใบแจ้งซ่อมอัตโนมัติ (RP-YYYYMM-XXX)
        $prefix = 'RP-' . date('Ym') . '-';
        $latest = RepairRequest::where('request_no', 'like', "{$prefix}%")
            ->orderByDesc('id')
            ->value('request_no');
        $nextNumber = $latest ? str_pad(((int) substr($latest, -3)) + 1, 3, '0', STR_PAD_LEFT) : '001';
        $requestNo = $prefix . $nextNumber;

        // บันทึกข้อมูลใบแจ้งซ่อม
        $repair = RepairRequest::create([
            'request_no' => $requestNo,
            'user_id' => 2, // กำหนดรหัสผู้แจ้งเริ่มต้น (ครูสมศรี)
            'building' => $request->building,
            'room' => $request->room,
            'problem_type' => $request->problem_type,
            'urgency' => $request->urgency,
            'description' => $request->description,
            'status' => 'pending',
        ]);

        // จัดการอัปโหลดไฟล์รูปภาพถ้ามีการแนบมา
        if ($request->hasFile('image')) {
            $fileName = time() . '_' . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('uploads'), $fileName);

            RepairImage::create([
                'repair_id' => $repair->id,
                'image_type' => 'before',
                'image_path' => 'uploads/' . $fileName,
            ]);
        }

        return redirect()->route('dashboard')->with('success', 'บันทึกข้อมูลการแจ้งซ่อมเรียบร้อยแล้ว');
    }
}
