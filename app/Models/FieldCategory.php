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

}
