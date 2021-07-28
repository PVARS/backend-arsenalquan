<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('category_id')->unsigned();
            $table->string('title');
            $table->string('short_description')->nullable();
            $table->text('thumbnail')->nullable();
            $table->text('content')->nullable();
            $table->json('key_word')->nullable();
            $table->integer('view')->default(0);
            $table->string('slug')->unique();
            $table->boolean('approve')->default(true);
            $table->string('approved_by')->nullable();
            $table->timestamps();
            $table->bigInteger('created_by')->nullable()->unsigned();
            $table->bigInteger('updated_by')->nullable();
            $table->softDeletes();
            $table->foreign('category_id')->references('id')->on('category')->onDelete('cascade');
            $table->foreign('created_by')->references('id')->on('user')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('news');
    }
}
