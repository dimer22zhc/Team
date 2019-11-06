<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name',50);
            $table->timestamps();
        });

        Schema::create('reactables', function (Blueprint $table) {
            // $table->unsignedbigInteger('user_id');
            $table->unsignedbigInteger('reaction_id');
            $table->unsignedbigInteger('reactable_id');
            $table->string('reactable_type',50);
            
            // $table->integer('responder_id');
            // $table->string('responder_type');
            $table->timestamps();

            $table->foreign('reaction_id')
                    ->references('id')
                    ->on('reactions')
                    ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {   Schema::dropIfExists('reactables');
        Schema::dropIfExists('reactions');
       
    }
}
