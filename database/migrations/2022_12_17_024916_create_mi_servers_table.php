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
            $table->string('name')->nullable();
            $table->string('auth_uid')->unique();
            $table->string('pcid')->nullable();
            $table->text('passToken')->nullable();
            $table->string('region')->nullable();
            $table->ipAddress('ip')->nullable();
            $table->enum('job_type', ['frp', 'fastboot', 'flash', 'all'])->default('all');
            $table->enum('status', ['online', 'offline', 'verify'])->default('offline');
            $table->bigInteger('count')->nullable();
            $table->bigInteger('limit')->nullable();
            $table->bigInteger('interval')->nullable();
            $table->enum('interval_type', ['seconds', 'minutes', 'hours', 'daily', 'weekly'])->nullable();
            $table->timestamp('execution_time')->nullable();
            $table->json('extra')->nullable();
            $table->boolean('is_active')->default(false);
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
