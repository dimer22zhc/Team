<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('files', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('thread_id');
            $table->unsignedBigInteger('user_id');
            $table->string('url');
            $table->string('path');
            $table->string('name');
            $table->string('is_assiged_to');
            $table->string('is_private');
            $table->string('ext',6);
            $table->timestamps();

            $table->foreign( 'user_id' )
                ->references( 'id')
                ->on('users')
                ->onUpdate( 'cascade' )
                ->onDelete( 'cascade' );

        });
        Schema::create('file_user', function (Blueprint $table) {
            $table->unsignedBigInteger('file_id');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();

            $table->foreign( 'file_id' )
                ->references( 'id' )
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
        Schema::dropIfExists('files');
        Schema::dropIfExists('file_user');
    }
}
