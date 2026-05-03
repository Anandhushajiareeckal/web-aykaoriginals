<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::create('homepage_sections', function(Blueprint $table) {
            $table->id();
            $table->string('section_key')->unique(); // hero, clients, about, cta
            $table->string('heading')->nullable();
            $table->string('subheading')->nullable();
            $table->text('body')->nullable();
            $table->string('video_url')->nullable();
            $table->string('btn1_label')->nullable();
            $table->string('btn1_url')->nullable();
            $table->string('btn2_label')->nullable();
            $table->string('btn2_url')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('client_logos', function(Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('homepage_sections');
        Schema::dropIfExists('client_logos');
    }
};
