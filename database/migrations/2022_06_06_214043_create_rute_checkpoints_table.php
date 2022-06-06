<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRuteCheckpointsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rute_checkpoints', function (Blueprint $table) {
            $table->string('checkpoint_code');
            $table->unsignedBigInteger('rute_id');
            $table->unsignedBigInteger('terminal_id');
            $table->integer('waktu');

            $table->primary(['checkpoint_code', 'rute_id']);
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
        Schema::dropIfExists('rute_checkpoints');
    }
}
