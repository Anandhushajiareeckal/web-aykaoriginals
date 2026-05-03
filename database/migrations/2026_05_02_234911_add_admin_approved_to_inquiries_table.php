<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::table('inquiries', function (Blueprint $table) {
            $table->boolean('admin_approved')->default(false)->after('status');
            $table->timestamp('admin_approved_at')->nullable()->after('admin_approved');
        });
    }
    public function down(): void {
        Schema::table('inquiries', function (Blueprint $table) {
            $table->dropColumn(['admin_approved', 'admin_approved_at']);
        });
    }
};
