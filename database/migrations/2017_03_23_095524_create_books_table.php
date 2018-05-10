<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->text('alias');
            $table->text('description');
            $table->string('cover');
            $table->string('language');
            $table->text('authors_names');
            $table->integer('adder_id');
            $table->boolean('active');
            $table->integer('unauthorized_views_count');
            $table->integer('authorized_views_count');
            $table->integer('reads_count');
            $table->integer('unauthorized_downloads_count');
            $table->integer('authorized_downloads_count');
            $table->integer('likes_count');
            $table->integer('rating');
            $table->integer('redirect');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('books');
    }
}
