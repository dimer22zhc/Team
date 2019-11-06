<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateThreadArchivesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('thread_archives', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('channel_id');
            $table->unsignedBigInteger('thread_id');
            $table->unsignedBigInteger('archived_id');
            $table->unsignedInteger('user_id');
            $table->string('create_time',50);
            $table->text('content');
            $table->string('type',50);
            $table->timestamps();

            $table->foreign( 'thread_id' )
                ->references( 'id')
                ->on('threads')
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
        Schema::dropIfExists('thread_archives');
    }
}
