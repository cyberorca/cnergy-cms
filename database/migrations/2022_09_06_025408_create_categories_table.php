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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->enum('is_active', [0, 1])->default(1);
            $table->string('category', 100)->unique();
            $table->string('common', 100);
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->string('slug', 100);
            $table->json('types');
            $table->timestamp('created_at', 0)->nullable();
            $table->uuid('created_by');
            $table->timestamp('updated_at', 0)->nullable();
            $table->uuid('updated_by')->nullable();
            $table->softDeletes();
            $table->uuid('deleted_by')->nullable();
            $table->index(['category', 'slug']);

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
        Schema::dropIfExists('categories');
    }
};
