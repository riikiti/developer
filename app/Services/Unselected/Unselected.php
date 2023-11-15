<?php

namespace App\Service\Unselected;

interface Unselected
{
    public function getFromSql($value);

    public function  getFromMemory($value);

}
