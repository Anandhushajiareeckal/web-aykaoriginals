<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void {
        DB::table('services')->truncate();

        Schema::table('services', function (Blueprint $table) {
            if (!Schema::hasColumn('services', 'slug')) {
                $table->string('slug')->unique()->after('title');
            }
            if (!Schema::hasColumn('services', 'banner_image')) {
                $table->text('banner_image')->nullable()->after('image_url');
            }
        });
    }
    public function down(): void {
        Schema::table('services', function (Blueprint $table) {
            if (Schema::hasColumn('services', 'slug')) {
                $table->dropColumn('slug');
            }
            if (Schema::hasColumn('services', 'banner_image')) {
                $table->dropColumn('banner_image');
            }
        });
    }
};
