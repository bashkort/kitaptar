<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->text('description');
            $table->string('cover');
            $table->string('language');
            $table->integer('adder_id');
            $table->boolean('active');
            $table->integer('unauthorized_views_count');
            $table->integer('authorized_views_count');
            $table->integer('unauthorized_downloads_count');
            $table->integer('authorized_downloads_count');
            $table->integer('likes_count');
            $table->integer('rating');
            $table->timestamps();
            $table->text('authors_names');
            $table->integer('redirect');
            $table->text('alias');
            $table->integer('reads_count');
            $table->text('preview');
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
