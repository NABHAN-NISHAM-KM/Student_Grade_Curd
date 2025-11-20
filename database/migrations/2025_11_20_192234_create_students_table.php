<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('mst_students', function (Blueprint $table) {
            $table->id('student_key');
            $table->string('student_name');
            $table->foreignId('subject_key')->constrained('mst_subjects', 'subject_key');
            $table->integer('grade');
            $table->string('remarks');
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mst_student');
    }
};
