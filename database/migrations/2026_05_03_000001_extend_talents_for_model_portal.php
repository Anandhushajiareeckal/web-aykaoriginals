<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::table('talents', function (Blueprint $table) {
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete()->after('id');
            $table->string('weight')->nullable()->after('hips');
            $table->string('inseam')->nullable()->after('weight');
            $table->json('social_links')->nullable()->after('bio');
            $table->enum('status', ['draft','pending','approved','rejected'])->default('draft')->after('is_active');
            $table->unsignedTinyInteger('completeness_score')->default(0)->after('status');
            $table->timestamp('last_active_at')->nullable()->after('completeness_score');
        });
    }

    public function down(): void {
        Schema::table('talents', function (Blueprint $table) {
            $table->dropConstrainedForeignId('user_id');
            $table->dropColumn(['weight','inseam','social_links','status','completeness_score','last_active_at']);
        });
    }
};
