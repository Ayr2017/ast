<?php

namespace App\Models;

use App\Models\Traits\HasContacts;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Farm extends Model
{
    use HasFactory, HasContacts, SoftDeletes;
    protected $guarded =['id'];

    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    public function district()
    {
        return $this->belongsTo(District::class);
    }

    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }
}
