<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChannelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('channels', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('team_id');
            $table->string('name',30);
            $table->text('description')->nullable();
            $table->enum('type', ['private', 'public'])->default('public');
            $table->timestamps();

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            $table->foreign('team_id')
                ->references('id')
                ->on('teams')
                ->onDelete('cascade');
        });
         Schema::create('channel_user', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('channel_id');
            $table->timestamps();

            $table->foreign( 'user_id' )
                ->references( 'id')
                ->on('users')
                ->onUpdate( 'cascade' )
                ->onDelete( 'cascade' );

            $table->foreign( 'channel_id' )
                ->references( 'id' )
                ->on('channels')
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
        Schema::dropIfExists('channel_user');
        Schema::dropIfExists('channels');

    }
}
