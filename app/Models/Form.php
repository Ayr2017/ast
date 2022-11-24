<?php

namespace App\Models;

use App\Http\Filters\QueryFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Form extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = ['id'];

    public function fields()
    {
        return $this->hasMany(FormField::class);
    }
    public function computedFields()
    {
        return $this->hasMany(ComputedFormField::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'creator_id', 'id');
    }

    public function category()
    {
        return $this->belongsTo(FormCategory::class, 'category_id', 'id');
    }

    public function reports()
    {
        return $this->hasMany(Report::class);
    }

    public function scopeFilter(Builder $builder, QueryFilter $filter)
    {
        $filter->apply($builder);
    }
}
