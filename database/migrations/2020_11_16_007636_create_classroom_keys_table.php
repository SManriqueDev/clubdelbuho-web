<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClassroomKeysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('classroom_keys', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->foreignId('classroom_id')->nullable()->constrained('classrooms');
            $table->foreignId('student_id')->nullable()->constrained('students');
            $table->foreignId('role_id')->constrained('roles');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('classroom_keys');
    }
}
