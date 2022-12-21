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
            // General Settings
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
            // Visual Settings
            $table->string('site_logo', 255)->nullable();
            $table->string('favicon', 255)->nullable();
            $table->string('accent_color', 255)->nullable();
            // General Configurations - Domain Settings
            $table->longText('domain_name')->nullable();
            $table->longText('domain_url')->nullable();
            $table->longText('domain_url_mobile')->nullable();
            $table->longText('logo_url')->nullable();
            $table->longText('copyright')->nullable();
            $table->longText('email_domain')->nullable();
            $table->json('image_info')->nullable();
            $table->longText('facebook_fanspage')->nullable();
            $table->longText('advertiser_id')->nullable();
            $table->longText('cse_id')->nullable();
            $table->longText('gtm_id')->nullable();
            $table->longText('robot_txt')->nullable();
            $table->longText('ads_txt')->nullable();
            $table->longText('embed_code_data_studio')->nullable();
            // Generate Token
            $table->json('token')->nullable();
            // Logs
            $table->timestamp('created_at', 0)->nullable();
            $table->uuid('created_by')->nullable();
            $table->timestamp('updated_at', 0)->nullable();
            $table->uuid('updated_by')->nullable();
            $table->timestamp('deleted_at', 0)->nullable();
            $table->uuid('deleted_by')->nullable();
            // Relations
            $table->foreign('created_by')->references('uuid')->on('users')->onCascade('delete');
            $table->foreign('updated_by')->references('uuid')->on('users')->onCascade('delete');
            $table->foreign('deleted_by')->references('uuid')->on('users')->onCascade('delete');
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
