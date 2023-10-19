<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('deals', function (Blueprint $table) {
            $table->string('name')->after('deal_id')->nullable(false);
        });
    }

    public function down(): void
    {
        if (!app()->isProduction()) {
              Schema::table('deals', function (Blueprint $table) {
                  $table->dropColumn('name');
              });
        }
    }
};