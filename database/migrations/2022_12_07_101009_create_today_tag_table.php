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
        Schema::create('today_tag', function (Blueprint $table) {
            $table->id();
            $table->integer('order_by_no');
            $table->string('title', 255);
            $table->longText('url')->nullable();
            $table->enum('types', ['news_tag', 'sponsorship_tag', 'external_link']);
            $table->json('tag');
            $table->unsignedBigInteger('category_id');
            $table->timestamp('created_at', 0)->nullable();
            $table->uuid('created_by');
            $table->timestamp('updated_at', 0)->nullable();
            $table->uuid('updated_by')->nullable();
            $table->timestamp('deleted_at', 0)->nullable();
            $table->uuid('deleted_by')->nullable();

            $table->index(['title', 'created_by', 'types']);

            $table->foreign('category_id')
            ->references('id')
            ->on('categories')
            ->nullable();

            $table->foreign('created_by')
                ->references('uuid')
                ->on('users')
                ->onCascade('delete');

            $table->foreign('updated_by')
                ->references('uuid')
                ->on('users')
                ->onCascade('delete');

            $table->foreign('deleted_by')
                ->references('uuid')
                ->on('users')
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
        Schema::dropIfExists('today_tag');
    }
};
