<?php

namespace App\Models;

use App\Http\Filters\QueryFilter;
use App\Models\Traits\HasContacts;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

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
        return $this->belongsTo(Organization::class)->withTrashed();
    }

    public function reports()
    {
        return $this->hasMany(Report::class, 'farm_uuid', 'uuid');
    }

    public function scopeFilter(Builder $builder, QueryFilter $filter)
    {
        $filter->apply($builder);
    }

    public static function boot(): void
    {
        parent::boot();
        static::creating(fn(Model $model) => $model->uuid = Str::uuid());
    }
}
