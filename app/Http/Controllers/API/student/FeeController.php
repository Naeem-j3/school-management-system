<?php

namespace App\Http\Controllers\api\student;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFeeRequest;
use App\Repository\student\FeeRepositoryInterface;
use Illuminate\Http\Request;

class FeeController extends Controller
{
    protected $Fee;

    public function __construct(FeeRepositoryInterface $Fee)
    {
        $this->Fee = $Fee;
    }

    public function index()
    {
        return $this->Fee->index();
    }


    public function store(StoreFeeRequest $request)
    {
        return $this->Fee->store($request);
    }

    public function update(StoreFeeRequest $request)
    {
        return $this->Fee->update($request);
    }


    public function destroy(Request $request)
    {
        return $this->Fee->destroy($request);
    }
}
