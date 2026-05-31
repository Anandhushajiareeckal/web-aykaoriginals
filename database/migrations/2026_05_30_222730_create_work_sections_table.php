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
        Schema::create('work_sections', function (Blueprint $table) {
            $table->id();
            $table->string('section_key')->unique();
            $table->text('heading')->nullable();
            $table->text('subheading')->nullable();
            $table->longText('body')->nullable();
            $table->string('media_url')->nullable();
            $table->string('media_type')->nullable(); // 'image' or 'video'
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('work_sections');
    }
};
