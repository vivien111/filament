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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // Titre du ticket
            $table->text('description'); // Description du ticket
            $table->string('status')->default('open'); // Statut du ticket (open, in_progress, resolved, closed)
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Utilisateur qui a créé le ticket
            $table->foreignId('assigned_to')->nullable()->constrained('users')->onDelete('set null'); // Administrateur ou entreprise assigné
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tickets');
    }
};
