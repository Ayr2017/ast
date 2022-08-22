<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Form extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = ['id'];

    public function fields()
    {
//        return $this->hasMany(Field::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'creator_id', 'id');
    }
}
