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
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('full_name')->nullable();
            $table->string('cellphone')->nullable();
            $table->string('address')->nullable();
            $table->string('nit')->nullable();
            $table->string('contact')->nullable();
            $table->string('identification')->nullable();
            $table->string('cell')->nullable();
            $table->string('city')->nullable();
            $table->string('email')->nullable();
            $table->string('comments')->nullable();
            $table->foreignId('user_id')
                    ->nullable()
                    ->constrained()
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
