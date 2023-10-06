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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('nom')->nullable();
            $table->string('prenoms')->nullable();
            $table->string('genre')->nullable();
            $table->string('email')->unique();
            $table->string('telephone')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->unique();
            $table->integer('nbr_tickets_achat')->nullable();
            $table->integer('nbr_event_scan')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};
