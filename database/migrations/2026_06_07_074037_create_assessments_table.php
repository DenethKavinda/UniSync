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
        Schema::create('assessments', function (Blueprint $table) {
            $table->id();
            $table->string('title');

            $table->enum('type', [
                'quiz',
                'mid_exam',
                'final_exam',
                'assignment'
            ]);

            $table->string('subject');

            $table->text('description')->nullable();

            $table->date('assessment_date')->nullable();

            $table->integer('duration')->nullable();

            $table->integer('total_marks')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assessments');
    }
};
