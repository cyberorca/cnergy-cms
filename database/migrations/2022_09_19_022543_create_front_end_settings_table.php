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
        Schema::create('front_end_settings', function (Blueprint $table) {
            $table->id();
            $table->string('site_title', 100)->nullable();
            $table->string('site_description', 255)->nullable();
            $table->string('address', 255)->nullable();
            $table->string('facebook', 255)->nullable();
            $table->string('facebook_username', 255)->nullable();
            $table->string('facebook_app_id', 255)->nullable();
            $table->string('instagram', 255)->nullable();
            $table->string('instagram_username', 255)->nullable();
            $table->string('twitter', 255)->nullable();
            $table->string('twitter_username', 255)->nullable();
            $table->string('youtube', 255)->nullable();
            $table->string('youtube_username', 255)->nullable();
            $table->string('site_logo', 255)->nullable();
            $table->string('favicon', 255)->nullable();
            $table->json('token')->nullable();
            $table->string('accent_color', 255)->nullable();
            $table->timestamp('created_at', 0)->nullable();
            $table->timestamp('updated_at', 0)->nullable();
            $table->timestamp('deleted_at', 0)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('front_end_settings');
    }
};
