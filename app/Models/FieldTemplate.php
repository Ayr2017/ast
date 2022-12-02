<?php

namespace App\Models;

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
        return $this->belongsTo(Form::class);
    }

    public function getFieldsCollectionAttribute()
    {
        $fields = $this->fields;
        return FormField::whereIn('id', $fields)->get()->pluck('name')->join(', ');
    }
}
