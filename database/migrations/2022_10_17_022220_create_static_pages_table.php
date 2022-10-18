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
        Schema::create('static_pages', function (Blueprint $table) {
            $table->id();
            $table->enum('is_active', [0, 1])->default(0);
            $table->string('title', 255);
            $table->string('slug', 255);
            $table->longText('content');
            $table->timestamp('created_at', 0)->nullable();
            $table->uuid('created_by');
            $table->timestamp('updated_at', 0)->nullable();
            $table->uuid('updated_by')->nullable();
            $table->softDeletes();
            $table->uuid('deleted_by')->nullable();
            
            $table->index(['title', 'slug']);

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
        Schema::dropIfExists('static_pages');
    }
};
