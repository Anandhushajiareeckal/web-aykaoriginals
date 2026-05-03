<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::create('inquiries', function(Blueprint $table) {
            $table->id(); $table->string('name'); $table->string('email'); $table->string('company')->nullable();
            $table->string('type'); $table->text('message'); $table->string('budget')->nullable();
            $table->foreignId('talent_id')->nullable()->constrained('talents')->nullOnDelete();
            $table->string('status')->default('new')->index(); $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('inquiries'); }
};
