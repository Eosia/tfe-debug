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
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            $table->string('title')->unique();
            $table->text('description');
            $table->string('slug')->unique();
            $table->boolean('status')->default(1);
            //$table->foreignId('category_id')->constrained();
            $table->foreignId('profession_id')->constrained();
            //$table->foreignId('province_id')->constrained();
            $table->foreignId('city_id')->constrained();
            $table->unsignedBigInteger('time');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->boolean('moderate')->default(false);
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
        Schema::dropIfExists('jobs');
    }
};
