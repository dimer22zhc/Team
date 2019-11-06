<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teams', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('owner_id');
            $table->string('name');
            $table->string('type')->nullable();
            $table->string('description')->nullable();
            $table->timestamps();

             $table->foreign('owner_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
        });

        Schema::create('team_user', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('team_id');
            $table->timestamps();
            $table->foreign( 'user_id' )
                ->references( 'id')
                ->on('users')
                ->onUpdate( 'cascade' )
                ->onDelete( 'cascade' );

            $table->foreign( 'team_id' )
                ->references( 'id' )
                ->on('teams')
                ->onDelete( 'cascade' );
        });

        Schema::create('team_invites', function(Blueprint $table){
            $table->increments('id');
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('team_id')->unsigned();
            $table->enum('type', ['invite', 'request']);
            $table->string('email');
            $table->string('accept_token');
            $table->string('deny_token');
            $table->timestamps();
            $table->foreign( 'team_id' )
                ->references( 'id' )
                ->on('teams' )
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
        
        Schema::dropIfExists('team_user');
        Schema::dropIfExists('team_invites');
        Schema::dropIfExists('teams'); 
        
    }
}
