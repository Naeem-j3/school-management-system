<?php

namespace App\Repository\student;


interface AttendanceRepositoryInterface
{


    public function show($id);

    public function store($request);
    public function udpate($request);

}
