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
        Schema::create('integrations', function (Blueprint $table) {
            $table->id(); // Identifiant unique
            $table->string('service_name'); // Nom du service
            $table->string('api_key'); // Clé API pour l'intégration
            $table->enum('status', ['active', 'inactive'])->default('inactive'); // Statut de l'intégration
            $table->string('logo')->nullable(); // Logo du service (enregistrement de l'URL de l'image)
            $table->timestamps(); // Colonnes created_at et updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('integrations');
    }
};
