<?php

namespace App\Services\Unselected;

interface Unselected
{
    public function getFromSql($value) : \Illuminate\Http\JsonResponse;

    public function  getFromMemory($value) : \Illuminate\Http\JsonResponse;
}
