<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMiServerLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mi_server_logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('server_id');
            $table->ipAddress('server_ip');
            $table->string('server_name', 45)->nullable();
            $table->string('logs', 45)->nullable();

            $table->foreign('server_id')->references('id')->on('mi_servers');
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
        Schema::dropIfExists('mi_server_logs');
    }
}
