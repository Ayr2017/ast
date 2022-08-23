<?php

namespace Database\Seeders;

use App\Models\FieldCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FieldCategorySeeder extends Seeder
{
    const FIELD_CATEGORIES = [
        'Поголовье',
        'Деление по группам',
        'Кормление',
        'Комфорт',
        'Воспроизводство',
        'Продуктивность',
        'Статус здоровья',
        'Молодняк',

    ];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (static::FIELD_CATEGORIES as $category) {
            FieldCategory::firstOrCreate(['name' => $category]);
        }
    }
}
