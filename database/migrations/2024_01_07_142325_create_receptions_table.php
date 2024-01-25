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
        Schema::create('receptions', function (Blueprint $table) {
            $table->id();
            $table->integer('custom_id')->nullable();
            $table->string('equipment_type')->nullable();
            $table->string('brand')->nullable();
            $table->string('model')->nullable();
            $table->string('serie')->nullable();
            $table->string('capability')->nullable();
            $table->string('state')->nullable();
            $table->string('comments')->nullable();
            $table->string('photos')->nullable();
            $table->string('location')->nullable();
            $table->string('specific_location')->nullable();
            $table->string('type_of_job')->nullable();
            $table->string('equipment_owner')->nullable();
            $table->foreignId('client_id')
                    ->nullable()
                    ->constrained()
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
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
        Schema::dropIfExists('receptions');
    }
};
