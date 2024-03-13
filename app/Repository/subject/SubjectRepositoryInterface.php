<?php


namespace App\Repository\subject;



interface SubjectRepositoryInterface
{
    public function index();

    public function store($request);

    public function update($request,$id);

    public function destroy($id);
}
