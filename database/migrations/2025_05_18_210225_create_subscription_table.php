<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique();
            $table->foreignId('city_id')->constrained(table: 'cities', indexName: 'subscription_city_id')->onDelete('cascade');
            $table->string('frequency')->default('daily');
            $table->boolean('active')->default(true);
            $table->string('confirmation_token')->nullable();
            $table->string('unsubscribe_token')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscription');
    }
};
