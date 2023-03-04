<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUnisocRSAKeysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('unisoc_rsa_keys', function (Blueprint $table) {
            $table->id();
            $table->enum('key_type', ['itel', 'lenovo', 'moto', 'nokia', 'normal']);
            $table->text('key');
            $table->text('token')->nullable();
            $table->enum('status', ['pending', 'success', 'failed', 'limit_over'])->default('pending');
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
        Schema::dropIfExists('unisoc_rsa_keys');
    }
}
