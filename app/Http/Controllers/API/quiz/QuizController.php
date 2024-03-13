<?php
namespace App\Http\Controllers\API\quiz;

use App\Http\Controllers\Controller;

use App\Repository\quizze\QuizzeRepositoryInterface;
use Illuminate\Http\Request;

class QuizController extends Controller
{

    protected $Quizz;

    public function __construct(QuizzeRepositoryInterface $Quizz)
    {
        $this->Quizz =$Quizz;
    }

    public function index()
    {
        return $this->Quizz->index();
    }


    public function store(Request $request)
    {
        return $this->Quizz->store($request);
    }

    public function update(Request $request,$id)
    {
        return $this->Quizz->update($request,$id);
    }

    public function destroy($id)
    {
        return $this->Quizz->destroy($id);
    }
}
