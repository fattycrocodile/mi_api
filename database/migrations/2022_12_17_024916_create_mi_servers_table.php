<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMiServersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mi_servers', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->json('contact_info')->nullable();
            $table->json('admin_info')->nullable();
            $table->ipAddress('ip');
            $table->json('extra')->nullable();
            $table->boolean('status')->default(true);
            $table->bigInteger('limit')->default(0);
            $table->boolean('is_active')->default(true);
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
        Schema::dropIfExists('mi_servers');
    }
}
