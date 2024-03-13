<?php
namespace App\Repository\teacher;

interface TeacherRepositoryInterface {
    public function getAllTeachers();
//    public function getAllSpecializations();
    public function storeTeachers( $request);
    public function updateTeachers( $request,$id);
    public function deleteTeachers( $id);
    public function getStudents();
}
