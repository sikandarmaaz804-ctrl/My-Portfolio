<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('career_applications', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('whatsapp');
            $table->string('education');
            $table->string('expertise');           // primary skill / role
            $table->text('experience');            // years + description
            $table->text('introduction');          // short bio / introduce yourself
            $table->enum('status', ['new', 'reviewed', 'shortlisted', 'rejected'])->default('new');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('career_applications');
    }
};
