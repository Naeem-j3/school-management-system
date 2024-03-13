<?php
namespace App\Repository\student;

interface PormotionRepositoryInterface {
    public function getPromotion();

    public function store($request);

    public function destroy($request);
}
