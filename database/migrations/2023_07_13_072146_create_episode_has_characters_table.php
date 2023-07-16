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
        Schema::create('episode_has_characters', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('id_episode');
            $table->unsignedInteger('id_character');

            $table->index('id_episode', 'episode_has_characters_episode_idx');
            $table->index('id_character', 'episode_has_characters_character_idx');

            $table->foreign('id_episode', 'episode_has_characters_episode_fk')
                ->references('id_episode')->on('episodes')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('id_character', 'episode_has_characters_character_fk')
                ->references('id_character')->on('characters')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('episode_has_characters');
    }
};
