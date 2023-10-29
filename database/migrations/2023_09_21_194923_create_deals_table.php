<?php

use Domain\Deal\Enums\Stage;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('deals', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('deal_id')->unique();
            $table->boolean('closed');
            $table->date('close_date');
            $table->boolean('is_new');
            $table->unsignedBigInteger('opportunity');
            $table->enum('stage', Stage::all());
            $table->timestamps();
        });

        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('contact_id');
            $table->unsignedBigInteger('deal_id');
            $table->foreign('deal_id')
                ->references('deal_id')
                ->on('deals')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->integer('sort');
            $table->unsignedBigInteger('role_id');
            $table->boolean('id_primary');
            $table->timestamps();
        });

        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('company_id');
            $table->unsignedBigInteger('deal_id');
            $table->foreign('deal_id')
                ->references('deal_id')
                ->on('deals')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->string('address');
            $table->string('address2')->nullable();
            $table->string('city');
            $table->string('country');
            $table->string('country_code');
            $table->string('postal_code');
            $table->string('province');
            $table->string('region');
            $table->string('banking_details');
            $table->string('email');
            $table->string('phone');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        if (!app()->isProduction()) {
            Schema::dropIfExists('companies');
            Schema::dropIfExists('contacts');
            Schema::dropIfExists('deals');
        }
    }
};
