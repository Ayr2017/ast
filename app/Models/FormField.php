<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FormField extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = ['id'];

    const UNITS = [
        'кг',
        'т',
        'ц',
        'шт',
        'гол.',
        'л',
        'м',
        'см',
        ' ',
    ];

    public function form()
    {
        return $this->belongsTo(Form::class);
    }

    public function setSelectFieldsAttribute($value)
    {
        if($value){
            $itemsArray = explode(',',$value);
            $trimmedArray = array_map('trim', $itemsArray);
            $jsonItems = json_encode($trimmedArray);
            $this->attributes['select_fields'] = $jsonItems;
        }
    }

    public function category()
    {
        return $this->belongsTo(FieldCategory::class, 'field_category_id', 'id');
    }
}
