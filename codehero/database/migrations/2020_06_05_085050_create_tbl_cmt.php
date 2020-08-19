<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblCmt extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cmt', function (Blueprint $table) {
            $table->increments('id_cmt');
            $table->string('content_cmt');
            $table->integer('id_blog');
            $table->integer('id_forum');
            $table->integer('id_auth');
            $table->integer('id_parent');
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
        Schema::dropIfExists('cmt');
    }
}
