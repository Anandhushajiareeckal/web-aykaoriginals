<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::create('talents', function(Blueprint $table) {
            $table->id(); $table->string('name'); $table->string('slug')->unique();
            $table->string('gender')->nullable()->index(); $table->string('category')->nullable()->index();
            $table->string('location')->nullable()->index(); $table->string('height')->nullable();
            $table->string('chest_bust')->nullable(); $table->string('waist')->nullable();
            $table->string('hips')->nullable(); $table->string('shoe_size')->nullable();
            $table->string('eye_color')->nullable(); $table->string('hair_color')->nullable();
            $table->text('bio')->nullable(); $table->boolean('is_featured')->default(false)->index();
            $table->boolean('is_active')->default(true)->index(); $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('talents'); }
};
