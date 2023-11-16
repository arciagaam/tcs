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
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('user_role_id')->nullable()->constrained('user_roles');
            $table->string('group_code');
            $table->string('consultation_name')->nullable();
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('document_path')->nullable();
            $table->string('video_path')->nullable();
            $table->text('remarks')->nullable();
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->tinyInteger('status')->default(1); //1 pending, 2 approved, 3 declined
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
