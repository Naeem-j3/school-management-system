<?php

namespace App\Http\Controllers\api\student;

use App\Http\Controllers\Controller;
use App\Models\Pormotion;
use App\Models\Student;
use App\Repository\student\PormotionRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PormotionController extends Controller
{
    protected $promotion;

    public function __construct(PormotionRepositoryInterface $promotion)
    {
        $this->promotion = $promotion;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(){
        return $this->promotion->getPromotion();
    }
    public function store(Request $request)
    {
       return $this->promotion->store($request);
    }

    public function destroy(Request $request)
    {
        return $this->promotion->destroy($request);
    }

}
