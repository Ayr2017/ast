<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Report extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];

    protected $casts =[
        'data' => 'array',
    ];

//    public function user()
//    {
//        return $this->belongsTo(User::class);
//    }

    public function farm()
    {
        return $this->belongsTo(Farm::class);
    }

    public function form()
    {
        return $this->belongsTo(Form::class);
    }

    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

}
