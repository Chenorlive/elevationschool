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
        Schema::create('faculties', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->date('dob')->nullable();
            $table->string('phone')->unique();
            $table->string('email')->unique();
            $table->enum('gender',['male','female','unknown']);
            $table->string('address')->nullable();
            $table->string('photo')->nullable();
            $table->foreignId('user_id')->onDelete('cascade');
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('faculties');
    }
};
