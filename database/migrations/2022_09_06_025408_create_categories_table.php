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
            $table->enum('is_active', [0, 1]);
            $table->string('category', 100)->unique();
            $table->string('common', 100);
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->string('slug', 100);
            $table->json('types');
            $table->timestamps();
            $table->index(['category', 'slug']);
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
