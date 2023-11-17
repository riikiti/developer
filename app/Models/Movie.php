<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use CrudTrait;
    use HasFactory;
    protected $fillable = [
        'name',
        'budgetInMillions',
    ];
}
