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
        Schema::table('users', function (Blueprint $table) {
            // Ajout des colonnes nécessaires pour Stripe
            $table->string('stripe_id')->nullable(); // Identifiant de l'utilisateur sur Stripe
            $table->string('stripe_status')->nullable(); // Statut de l'abonnement Stripe (actif, annulé, etc.)
            $table->string('stripe_subscription')->nullable(); // ID de l'abonnement Stripe
            $table->timestamp('trial_ends_at')->nullable(); // Date de fin d'essai
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            // Retirer les colonnes ajoutées pour Stripe
            $table->dropColumn('stripe_id');
            $table->dropColumn('stripe_status');
            $table->dropColumn('stripe_subscription');
            $table->dropColumn('trial_ends_at');
        });
    }
};
