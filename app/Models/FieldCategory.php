<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FieldCategory extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $table = 'field_categories';
    const CATEGORY_COLORS = [
        '#a3cfbb',
        '#a6e9d5',
        '#efadce',
        '#c5b3e6',
        '#c29ffa',
        '#9ec5fe',
    ];
}
