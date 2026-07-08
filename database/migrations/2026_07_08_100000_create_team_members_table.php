<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('team_members', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('position');          // e.g. "Lead Developer"
            $table->string('expertise');         // e.g. "Full Stack Development"
            $table->unsignedTinyInteger('experience_years'); // e.g. 5
            $table->text('description');         // short bio shown on card
            $table->string('photo');             // filename in uploads/
            $table->unsignedSmallInteger('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('team_members');
    }
};
