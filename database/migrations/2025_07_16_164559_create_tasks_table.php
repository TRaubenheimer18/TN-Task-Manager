<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   /*Run the migrations.*/
    public function up(): void
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // creator
            $table->foreignId('assigned_to')->nullable()->constrained('users')->nullOnDelete(); // assignee
            $table->string('title');
            $table->text('description');
            $table->string('category');
            $table->enum('priority', ['high', 'medium', 'low']);
            $table->enum('status', ['pending', 'in-progress', 'completed'])->default('pending');
            $table->date('deadline');
            $table->timestamps();
        });
    }


    /*Reverse the migrations.*/
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
