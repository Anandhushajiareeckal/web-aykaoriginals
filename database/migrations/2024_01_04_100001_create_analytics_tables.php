<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::create('page_views', function(Blueprint $table) {
            $table->id();
            $table->string('page')->nullable();
            $table->string('ip', 45)->nullable();
            $table->string('device')->nullable();
            $table->string('browser')->nullable();
            $table->string('referrer')->nullable();
            $table->timestamp('viewed_at')->useCurrent();
        });
        Schema::create('site_analytics', function(Blueprint $table) {
            $table->id();
            $table->date('date')->unique();
            $table->integer('total_views')->default(0);
            $table->integer('unique_visitors')->default(0);
            $table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('page_views');
        Schema::dropIfExists('site_analytics');
    }
};
