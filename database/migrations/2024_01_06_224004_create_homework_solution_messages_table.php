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
        Schema::create('homework_solution_messages', function (Blueprint $table) {
            $table->id();
            $table->integer('solution_id');
            $table->integer('author_id');
            $table->text('message');
            $table->timestamps();

            $table->foreign('solution_id')->references('id')->on('homework_solutions');
            $table->foreign('author_id')->references('id')->on('users');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('homework_solution_messages');
    }
};
