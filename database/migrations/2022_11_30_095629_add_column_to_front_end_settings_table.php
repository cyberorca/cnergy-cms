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
        Schema::table('front_end_settings', function (Blueprint $table) {
            $table->longText('domain_name')->nullable();
            $table->longText('domain_url')->nullable();
            $table->longText('domain_url_mobile')->nullable();
            $table->longText('logo_url')->nullable();
            $table->longText('copyright')->nullable();
            $table->longText('email_domain')->nullable();
            $table->json('image_info')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('front_end_settings', function (Blueprint $table) {
            //
        });
    }
};
