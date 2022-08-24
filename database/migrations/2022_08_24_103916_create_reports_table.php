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
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->uuid();
            $table->foreignId('form_id')->references('id')->on('forms');
            $table->foreignId('farm_id')->references('id')->on('farms');
            $table->foreignId('organization_id')->references('id')->on('organizations');
            $table->foreignId('user_id')->references('id')->on('users');
            $table->json('data');
            $table->date('date');
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
        Schema::dropIfExists('reports');
    }
};
