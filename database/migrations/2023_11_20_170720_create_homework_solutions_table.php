<?php

use App\Http\Enums\SolutionStatus;
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
        Schema::create('homework_solutions', function (Blueprint $table) {
            $table->id();
            $table->integer('homework_id');
            $table->integer('student_id');
            $table->string('status')->default(SolutionStatus::OPENED);
            $table->timestamps();

            $table->foreign('homework_id')->references('id')->on('homeworks');
            $table->foreign('student_id')->references('id')->on('users');

            $table->unique(['homework_id', 'student_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('homework_solutions');
    }
};
