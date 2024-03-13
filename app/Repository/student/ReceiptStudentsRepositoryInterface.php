<?php


namespace App\Repository\student;


interface ReceiptStudentsRepositoryInterface
{
    public function index();

    public function store($request);

    public function update($request,$id);

    public function destroy($id);
}
