<?php

namespace App\Http\Controllers\api\student;

use App\Http\Controllers\Controller;
use App\Repository\student\ReceiptStudentsRepositoryInterface;
use Illuminate\Http\Request;

class ReceiptStudentController extends Controller
{

    protected $receipt;

    public function __construct(ReceiptStudentsRepositoryInterface $receipt)
    {
        $this->receipt = $receipt;
    }

    public function index(){
    return  $this->receipt->index();
    }

    public function store(Request $request){
        return  $this->receipt->store($request);
    }

    public function update(Request $request,$id){
        return  $this->receipt->update($request,$id);
    }

    public function destroy($id){
        return  $this->receipt->destroy($id);
    }
}
