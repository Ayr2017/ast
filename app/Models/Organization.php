<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Organization extends Model
{
    use HasFactory;

    protected $casts = [
        'id' => 'string'
    ];

    public function setIdAttribute($value)
    {
        if($value && Str::isUuid($value)){
            $this->attributes['id'] = $value;
        }else{
            $this->attributes['id'] = Str::uuid();
        }
    }

    public function setDeletedAtAttribute($value)
    {
        if($value){
            $this->attributes['deleted_at'] = date("Y-m-d H:i:s");
        }else{
            $this->attributes['deleted_at'] = null;
        }
    }
}
