<?php

namespace App\Http\Controllers\api\subject;

use App\Http\Controllers\Controller;
use App\Repository\subject\SubjectRepositoryInterface;
use Illuminate\Http\Request;

class SubjectController extends Controller
{


    protected $Subject;

    public function __construct(SubjectRepositoryInterface $Subject)
    {
        $this->Subject = $Subject;
    }

    public function index()
    {
        return $this->Subject->index();
    }

    public function store(Request $request)
    {
        return $this->Subject->store($request);
    }


    public function update(Request $request,$id)
    {
        return $this->Subject->update($request,$id);
    }

    public function destroy($id)
    {
        return $this->Subject->destroy($id);
    }
}
