<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TypeOccasion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('type_occasions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('restaurent_id');
            $table->foreign('restaurent_id')->references('id')->on('restaurants')->onDelete('cascade');
            $table->string('name');
            $table->integer('review_count')->default(0);
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
        Schema::dropIfExists('type_occasions');
    }
}
