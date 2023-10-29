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
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->string('group_code');
            $table->string('name');
            $table->string('email');
            $table->string('title');
            $table->date('date');
            $table->text('description');
            $table->string('document_path')->nullable();
            $table->tinyInteger('status')->default(1); //1 pending, 2 approved, 3 declined
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};
