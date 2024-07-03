<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('task_timers', function (Blueprint $table) {
            $table->id();
            $table->dateTime('started_at');
            $table->dateTime('current_duration')->nullable();
            $table->string('state');
            $table->foreignId('task_id');
            $table->foreignId('user_id');
            $table->foreignId('team_id');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('task_timers');
    }
};
