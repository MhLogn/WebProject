<?php

namespace App\Http\Controllers;
use App\Mail\ScheduleNotification;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ScheduleController extends Controller
{
    // Hiển thị form đặt lịch
    public function showForm()
    {
        return view('schedule.form');
    }

    // Xử lý lưu thông tin đặt lịch
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'nullable|email',
            'service' => 'required|string',
            'date' => 'required|date|after_or_equal:today',
            'note' => 'nullable|string',
        ]);

        // Gửi mail cho admin
        Mail::to('daylaaccclone39@gmail.com')->send(new ScheduleNotification($validated));

        // Schedule::create($validated);

        return redirect()->route('schedule.form')->with('success', 'Đặt lịch thành công! Chúng tôi sẽ phản hồi bạn sớm.');
    }
}
