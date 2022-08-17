<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Organization extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];

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

    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    public function district()
    {
        return $this->belongsTo(District::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'creator_id', 'id');
    }


}
