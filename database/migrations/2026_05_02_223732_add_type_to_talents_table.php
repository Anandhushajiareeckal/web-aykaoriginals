<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('talents', function (Blueprint $table) {
            $table->string('type')->default('talent')->after('id'); // talent, model
        });
        
        // Update existing talents to 'model' if they have a user_id (registered via portal)
        \Illuminate\Support\Facades\DB::table('talents')->whereNotNull('user_id')->update(['type' => 'model']);
    }

    public function down(): void
    {
        Schema::table('talents', function (Blueprint $table) {
            $table->dropColumn('type');
        });
    }
};
