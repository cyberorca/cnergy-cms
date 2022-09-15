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
            $table->uuid()->primary();
            $table->enum('is_active', [0, 1]); 
            $table->string('email')->unique();
            $table->string('name');
            $table->string('password');
            $table->timestamp('last_logged_in', 0)->nullable();
            #$table->json('roles');
            $table->softDeletes();
            $table->bigInteger('role_id')->unsigned();
            $table->foreign('role_id')
                    ->references('id')
                    ->on('roles')
                    ->onCascade('delete');
            $table->index(['name', 'email']);
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
