<?php

namespace App\Http\Controllers\api\student;

use App\Http\Controllers\Controller;
use App\Repository\student\StudentGraduatedRepositoryInterface;
use Illuminate\Http\Request;

class GraduatedStudentsController extends Controller

{
    protected $Graduated;

    public function __construct(StudentGraduatedRepositoryInterface $Graduated)
    {
        $this->Graduated = $Graduated;
    }

    public function index()
    {
       return $this->Graduated->index();
    }


    public function store(Request $request)
    {
        return $this->Graduated->SoftDelete($request);
    }

    public function update(Request $request)
    {
        return $this->Graduated->ReturnData($request);
    }

    public function destroy(Request $request)
    {
       return $this->Graduated->destroy($request);
    }
}
