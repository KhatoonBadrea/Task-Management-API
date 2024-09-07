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
        Schema::create('user_tasks', function (Blueprint $table) {
            $table->id('task_id');
            $table->string('title');
            $table->string('description');
            $table->enum('priority', ['low', 'medium', 'height']);
            $table->date('due_date')->nullable();
            $table->date('deadline');
            $table->enum('status', ['in-progress', 'done', 'pending']);
            $table->foreignId('assigned_to')->constrained('users', 'id');
            $table->timestamp('created_on')->nullable();
            $table->timestamp('updated_on')->nullable();

            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
