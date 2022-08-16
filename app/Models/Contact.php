<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function getTypeAttribute($value)
    {

        switch ($value) {
            case 'phone':
                return 'Телефон';
            case 'mobile':
                return 'Мобильный';
            case 'email':
                return 'Email';
        }
    }
}
