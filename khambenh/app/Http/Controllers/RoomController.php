<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Doctor;

class RoomController extends Controller
{
     public function index()
    {
        // Lấy tất cả bác sĩ cùng phòng của họ
        $doctors = Doctor::with('user')->get();

        return view('staffs.rooms.index', compact('doctors'));
    }
}
