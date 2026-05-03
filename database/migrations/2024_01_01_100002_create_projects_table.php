<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::create('projects', function(Blueprint $table) {
            $table->id(); $table->string('brand'); $table->string('slug')->unique();
            $table->year('year')->nullable(); $table->string('service_type')->nullable()->index();
            $table->text('description')->nullable(); $table->boolean('is_featured')->default(false)->index();
            $table->boolean('is_active')->default(true)->index(); $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('projects'); }
};
