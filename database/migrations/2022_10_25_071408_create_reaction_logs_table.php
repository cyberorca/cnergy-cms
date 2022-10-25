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
        Schema::create('reaction_logs', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('reaction_id')->unsigned();
            $table->bigInteger('news_id')->unsigned();
            $table->timestamp('created_at', 0)->nullable();
            
            $table->foreign('reaction_id')
                    ->references('id')
                    ->on('reactions')
                    ->onCascade('delete');

            $table->foreign('news_id')
                    ->references('id')
                    ->on('news')
                    ->onCascade('delete');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reaction_logs');
    }
};
