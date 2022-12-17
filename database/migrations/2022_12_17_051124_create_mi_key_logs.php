<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMiKeyLogs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mi_key_logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('key_id');
            $table->string('key', 45);
            $table->text('logs', 2000)->nullable();
            $table->ipAddress('client_ip')->nullable();
            $table->ipAddress('server_ip')->nullable();

            $table->foreign('key_id')->references('id')->on('mi_key_informations');
            $table->index('key_id', 'key_id_idx');
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
        Schema::dropIfExists('mi_key_logs');
    }
}
