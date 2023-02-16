<?php

namespace App\Models;

use App\Http\Filters\QueryFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FieldTemplate extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];
    protected $casts = [
        'fields' => 'array',
    ];

    public function form()
    {
        return $this->belongsTo(Form::class)->withTrashed();
    }

    public function scopeFilter(Builder $builder, QueryFilter $filter)
    {
        $filter->apply($builder);
    }


    public function getFieldsCollectionAttribute()
    {
        $fields = $this->fields;
        return FormField::whereIn('id', $fields)->get()->pluck('name')->join(', ');
    }

    public static function boot(): void
    {
        parent::boot();

        self::restored(function (FieldTemplate $fieldTemplate) {
            $fieldTemplate->form()->restore();
        });

    }
}
