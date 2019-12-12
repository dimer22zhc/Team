<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateThreadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('threads', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('channel_id');
            $table->unsignedBigInteger('team_id');
            $table->text('body');
            $table->string('avatar')->nullable();
            $table->string('type')->default('normal');
            $table->timestamps();

            $table->foreign( 'user_id' )
                ->references( 'id')
                ->on('users')
                ->onDelete( 'cascade' );

            $table->foreign( 'channel_id' )
                ->references( 'id' )
                ->on('channels')
                ->onDelete( 'cascade' );
                
            $table->foreign( 'team_id' )
                ->references( 'id' )
                ->on('teams')
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
        Schema::dropIfExists('threads');
    }
}
