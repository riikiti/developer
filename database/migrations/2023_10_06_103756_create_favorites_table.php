<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('favorites', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('movie_id');


            $table->index('user_id', 'user_idx');
            $table->foreign('user_id', 'user_fk')->on('users')->references('id') ->onUpdate('cascade')
                ->onDelete('cascade');


            $table->index('movie_id', 'movie_idx');
            $table->foreign('movie_id', 'movie_fk')->on('movies')->references('id') ->onUpdate('cascade')
                ->onDelete('cascade');
        });




    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('favorites');
    }
};
