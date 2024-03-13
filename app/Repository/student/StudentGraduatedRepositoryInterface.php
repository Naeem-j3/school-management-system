<?php


namespace App\Repository\student;


interface StudentGraduatedRepositoryInterface
{

    public function index();

    // update Students to SoftDelete
    public function SoftDelete($request);

    // ReturnData Students
    public function ReturnData($request);

    // destroy Students
    public function destroy($request);


}
