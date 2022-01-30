<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrackRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('track_requests', function (Blueprint $table) {
            $table->id();
            $table->string('mail');
            $table->string('game')->nullable();
            $table->string('game_name')->nullable();
            $table->string('url');
            $table->string('token');
            $table->string('currency');
            $table->string('price');
            $table->text('blocked');
            $table->enum('status',array('pending','complete','archive'))->default('pending');
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
        Schema::dropIfExists('track_requests');
    }
}
