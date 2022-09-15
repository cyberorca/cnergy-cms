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
        Schema::create('tags', function (Blueprint $table) {
            $table->id();
            $table->enum('is_active', [1, 0]);
            $table->string('tags', 100);
            $table->string('slug', 100);
            $table->timestamp('created_at', 0)->nullable();
            $table->uuid('created_by');
            $table->timestamp('updated_at', 0)->nullable();
            $table->uuid('updated_by')->nullable();
            $table->timestamp('deleted_at', 0)->nullable();
            $table->uuid('deleted_by')->nullable();
            $table->index(['tags', 'slug', 'created_by', 'is_active']);

            $table->foreign('deleted_by')
                ->references('uuid')
                ->on('users')
                ->onCascade('delete');

            $table->foreign('updated_by')
                ->references('uuid')
                ->on('users')
                ->onCascade('delete');

            $table->foreign('created_by')
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
        Schema::dropIfExists('tags');
    }
};
