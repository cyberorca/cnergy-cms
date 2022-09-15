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
        Schema::create('photo_news', function (Blueprint $table) {
            $table->id();
            $table->enum('is_active', [0, 1])->default(1);
            $table->string('title', 255);
            $table->string('url', 255);
            $table->string('image', 255);
            $table->string('description', 255);
            $table->string('keywords', 255);
            $table->string('copyright', 255);
            $table->bigInteger('news_id')->unsigned();
            $table->integer('order_by_no');
            $table->timestamp('created_at', 0)->nullable();
            $table->uuid('created_by');
            $table->timestamp('updated_at', 0)->nullable();
            $table->uuid('updated_by')->nullable();
            $table->softDeletes();
            $table->uuid('deleted_by')->nullable();

            $table->foreign('news_id')
                    ->references('id')
                    ->on('news')
                    ->onCascade('delete');

            $table->index(['title']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('photo_news');
    }
};
