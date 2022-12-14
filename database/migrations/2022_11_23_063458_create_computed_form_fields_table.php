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
        Schema::create('computed_form_fields', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('unit');
            $table->foreignId('form_id');
            $table->foreignId('field_category_id')
                ->references('id')->on('field_categories');
            $table->string('operator_a')->default('sum');
            $table->string('operator_b')->default('sum');
            $table->string('operator_c')->default('sum');
            $table->boolean('required')->default(0);
            $table->string('placeholder')->nullable();
            $table->string('hint')->nullable();
            $table->string('formula')->nullable();
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
        Schema::dropIfExists('computed_form_fields');
    }
};
