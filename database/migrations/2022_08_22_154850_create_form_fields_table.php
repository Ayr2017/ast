<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('form_fields', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('type');
            $table->string('unit');
            $table->foreignId('form_id');
            $table->foreignId('field_category_id')
                ->references('id')->on('field_categories');
            $table->json('select_fields')->nullable();
            $table->string('operator_a')->default('sum');
            $table->string('operator_b')->default('sum');
            $table->string('operator_c')->default('sum');
            $table->boolean('required')->default(0);
            $table->float('min')->default(0);
            $table->float('max')->default(10000);
            $table->float('step', 5, 4)->default(1);
            $table->string('placeholder')->nullable();
            $table->string('hint')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('form_fields');
    }
};
