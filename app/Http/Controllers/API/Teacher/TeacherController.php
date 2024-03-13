<?php

namespace App\Http\Controllers\API\Teacher;

use App\Http\Controllers\Controller;
use App\Repository\teacher\TeacherRepositoryInterface;
use Illuminate\Http\Request;

class TeacherController extends Controller
{

    protected $Teacher;

    public function __construct(TeacherRepositoryInterface $Teacher)
    {
        $this->Teacher = $Teacher;
    }

    public function index()
    {
        return $this->Teacher->getAllTeachers();
    }

    public function store(Request $request)
    {
        return $this->Teacher->storeTeachers($request);
    }
    public function update(Request $request,$id)
    {
        return $this->Teacher->updateTeachers($request,$id);
    }
    public function destroy($id)
    {
        return $this->Teacher->deleteTeachers($id);
    }
    public function getOwnstudents(){
        return $this->Teacher->getStudents();
    }

}
