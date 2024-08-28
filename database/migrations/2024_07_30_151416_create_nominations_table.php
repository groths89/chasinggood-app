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
        Schema::create('nominations', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email');
            $table->string('phone_number');
            $table->string('nominating_option');
            $table->string('nominee_organization_name')->nullable();
            $table->string('nominee_first_name')->nullable();
            $table->string('nominee_last_name')->nullable();
            $table->string('nominee_email')->nullable();
            $table->string('category');
            $table->string('county');
            $table->text('story');
            $table->string('uploaded_video')->nullable();
            $table->boolean('disclaimer_agreed');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nominations');
    }
};
