<?php


namespace App\Repository\student;

interface FeeRepositoryInterface
{
    public function index();

    public function store($request);

    public function update($request);

    public function destroy($request);
}
