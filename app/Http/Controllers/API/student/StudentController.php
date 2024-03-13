<?php

namespace App\Http\Controllers\API\student;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorStudentRequest;
use App\Repository\student\StudentRepositoryInterface;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    protected $student;

    public function __construct(StudentRepositoryInterface $student)
    {
        $this->student = $student;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->student->getAllStudent();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorStudentRequest $request)
    {
        return $this->student->storeStudent($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return $this->student->showStudent($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StorStudentRequest $request, string $id)
    {
        return $this->student->updateStudent($request,$id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        return $this->student->deleteStudent($request);
    }

    public function uploadImage(Request $request)
    {
       return  $this->student->uplodeStudentImage($request);
    }

    public function downloadImage($id,$fileName)
    {
       return  $this->student->downloadImageStudentImage($id,$fileName);
    }

    public function deleteImage(Request $request)
    {
       return  $this->student->deleteStudentPhoto($request);
    }
}
