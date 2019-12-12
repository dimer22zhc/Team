<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('posts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('file_id');
            $table->string('url')->nullable();
            $table->string('description')->nullable();
            $table->string('title');
            $table->text('content');
            $table->string('typeFile');
            $table->timestamps();
            $table->foreign( 'file_id' )
                ->references( 'id')
                ->on('files')
                ->onDelete( 'cascade' );
        });

        Schema::create('avatars', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('file_id');
            $table->string('url')->nullable();
            $table->timestamps();
            
            $table->foreign( 'file_id' )
                ->references( 'id')
                ->on('files')
                ->onDelete( 'cascade' );
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
        Schema::dropIfExists('avatars');
    }
}
