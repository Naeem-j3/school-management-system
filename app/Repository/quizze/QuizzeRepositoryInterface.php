<?php

namespace App\Repository\quizze;

interface QuizzeRepositoryInterface
{
    public function index();

    public function store($request);

    public function update($request,$id);

    public function destroy($id);
}
