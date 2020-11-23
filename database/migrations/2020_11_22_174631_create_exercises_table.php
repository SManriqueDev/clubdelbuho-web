<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExercisesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('exercises', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->enum('type', ['multiple_unique', 'multiple_multiple', 'true_false', 'relations', 'association', 'synonyms', 'anagrams', 'wordfind', 'crossword']);
            $table->foreignId('knowledge_area_id');
            $table->foreignId('reading_level_id');
            $table->foreignId('text_type_id');
            $table->foreignId('complexity_level_id');
            $table->foreignId('school_id');
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
        Schema::dropIfExists('exercises');
    }
}
