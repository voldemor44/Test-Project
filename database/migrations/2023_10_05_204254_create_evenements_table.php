<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evenements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('genre_id')->constrained();
            $table->string('nom');
            $table->text('description');
            $table->string('adresse');
            $table->date('date_heure');
            $table->string('contacts')->nullable();
            $table->string('logo_url')->nullable();
            $table->integer('nbr_places_prevu');
            $table->integer('nbr_tickets_achat')->nullable();
            $table->string('statut')->default('à venir');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('evenements');
    }
};
