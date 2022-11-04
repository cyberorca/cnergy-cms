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
        Schema::create('inventory_management', function (Blueprint $table) {
            $table->id();
            $table->string('inventory', 100);
            $table->string('slot_name', 100);
            $table->string('type', 50);
            $table->longText('code');
            $table->string('template_id', 50)->nullable();
            $table->string('placement_id', 50)->nullable();
            $table->string('size', 255)->nullable();
            $table->string('adunit_size', 255)->nullable();
            $table->timestamp('created_at', 0)->nullable();
            $table->uuid('created_by');
            $table->timestamp('updated_at', 0)->nullable();
            $table->uuid('updated_by')->nullable();

            $table->foreign('created_by')
                    ->references('uuid')
                    ->on('users')
                    ->onCascade('delete');

            $table->foreign('updated_by')
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
        Schema::dropIfExists('inventory_management');
    }
};
