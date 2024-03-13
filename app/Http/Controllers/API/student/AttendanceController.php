<?php

namespace App\Http\Controllers\api\student;

use App\Http\Controllers\Controller;
use App\Repository\student\AttendanceRepositoryInterface;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    protected $Attendance;

    public function __construct(AttendanceRepositoryInterface $Attendance)
    {
        $this->Attendance = $Attendance;
    }

    public function store(Request $request)
    {
        return $this->Attendance->store($request);
    }


    public function show($id)
    {
        return $this->Attendance->show($id);
    }
    public function update(Request $request){
        return $this->Attendance->udpate($request);
    }


}
