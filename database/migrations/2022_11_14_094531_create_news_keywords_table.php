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
        Schema::create('news_keywords', function (Blueprint $table) {
            $table->id();
            $table->enum('is_active', [0, 1])->default(1);
            $table->foreignId('news_id')->constrained('news');
            $table->foreignId('keywords_id')->constrained('keywords');
            $table->timestamp('created_at', 0);
            $table->uuid('created_by');
            $table->timestamp('updated_at', 0)->nullable();
            $table->uuid('updated_by')->nullable();
            $table->softDeletes();
            $table->uuid('deleted_by')->nullable();

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
        Schema::dropIfExists('news_keywords');
    }
};
