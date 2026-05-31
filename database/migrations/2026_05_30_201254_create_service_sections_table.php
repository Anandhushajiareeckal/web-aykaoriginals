<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('service_sections', function (Blueprint $table) {
            $table->id();
            $table->string('section_key')->unique();
            $table->string('heading')->nullable();
            $table->string('subheading')->nullable();
            $table->text('body')->nullable();
            $table->text('image_url')->nullable();
            $table->text('video_url')->nullable();
            $table->string('btn1_label')->nullable();
            $table->string('btn1_url')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('service_sections'); }
};
