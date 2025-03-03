<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('ticket_messages', function (Blueprint $table) {
            $table->id();
            $table->text('message'); // Contenu du message
            $table->foreignId('ticket_id')->constrained()->onDelete('cascade'); // Ticket associé
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Utilisateur ou entreprise qui a envoyé le message
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('ticket_messages');
    }
};
