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
        Schema::create('evenement_scanners', function (Blueprint $table) {
            $table->id();
            $table->foreignId('evenement_id')->constrained();
            $table->foreignId('user_id')->constrained();
            $table->integer('nbr_total_scan')->nullable()->default(0);
            $table->integer('nbr_success_scan')->nullable()->default(0);
            $table->integer('nbr_failed_scan')->nullable()->default(0);
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
        Schema::dropIfExists('evenement_scanners');
    }
};
