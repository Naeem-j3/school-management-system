<?php
namespace App\Repository\student;

interface StudentRepositoryInterface {
    public function getAllStudent();
    public function showStudent($id);
    public function storeStudent( $request);
    public function updateStudent( $request,$id);
    public function deleteStudent( $request);
    public function uplodeStudentImage( $request);
    public function downloadImageStudentImage($id,$fileName);
    public function deleteStudentPhoto($request) ;

    
}
