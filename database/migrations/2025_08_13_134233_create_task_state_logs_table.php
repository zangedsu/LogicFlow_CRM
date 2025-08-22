<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('task_state_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('task_id');
            $table->enum('state', ['new', 'in_process', 'completed', 'failed']);
            $table->foreignId('status_changed_by');
            $table->text('message')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('task_state_logs');
    }
};
