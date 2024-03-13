<?php

namespace App\Http\Controllers\API\student;

use App\Http\Controllers\Controller;
use App\Repository\student\FeeInvoicesRepositoryInterface;
use Illuminate\Http\Request;

class FeeInvoiceController extends Controller
{

    protected $Fees_Invoices;
    public function __construct(FeeInvoicesRepositoryInterface $Fees_Invoices)
    {
        $this->Fees_Invoices = $Fees_Invoices;
    }

    public function index()
    {
        return $this->Fees_Invoices->index();
    }



    public function store(Request $request)
    {
        return $this->Fees_Invoices->store($request);
    }
    public function update(Request $request,$id)
    {
        return $this->Fees_Invoices->update($request,$id);
    }

    public function show($id)
    {
        return $this->Fees_Invoices->show($id);
    }
    public function destroy($id)
    {
        return $this->Fees_Invoices->destroy($id);
    }

}
