<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::table('services', function (Blueprint $table) {
            $table->text('image_url')->nullable()->after('icon');
            $table->text('tag')->nullable()->after('image_url'); // short category label e.g. "Represented"
        });
    }
    public function down(): void {
        Schema::table('services', function (Blueprint $table) {
            $table->dropColumn(['image_url', 'tag']);
        });
    }
};
