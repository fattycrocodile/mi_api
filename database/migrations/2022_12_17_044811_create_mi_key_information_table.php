<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMiKeyInformationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mi_key_informations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('server_id')->nullable();
            $table->string('key');
            $table->enum('key_type', ['reboot', 'flash', 'sideload'])->default('flash');
            $table->string('token')->nullable();
            $table->ipAddress('client_ip')->nullable();
            $table->ipAddress('server_ip')->nullable();
            $table->enum('status', ['success', 'pending', 'error', 'sec_risk', 'limit_over', 'fmi_on'])->default('pending');
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
        Schema::dropIfExists('mi_key_information');
    }
}
