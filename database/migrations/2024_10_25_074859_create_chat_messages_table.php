<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('chat_messages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sender_id')->constrained('users')->onDelete('cascade'); // ID отправителя
            $table->foreignId('chat_id')->nullable()->constrained()->onDelete('cascade');
//            $table->foreignId('recipient_id')->nullable()->constrained('users')->onDelete('cascade'); // ID получателя (для личных сообщений)
            $table->text('message'); // Сообщение
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('chat_messages');
    }
};
