<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MessageRecipientMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('message_recipients',function(Blueprint $table){
            $table->bigIncrements('id');
            $table->unsignedBigInteger('creator_id');
            $table->unsignedBigInteger('recipient_id')->nullable();
            $table->unsignedBigInteger('message_id');
            // $table->boolean('is_read')->default(false);
            $table->foreign('creator_id')->references('id')->on('users');
            $table->foreign('recipient_id')->references('id')->on('users');
            $table->foreign('message_id')->references('id')->on('messages');
            // $table->foreign('recipient_group_id')->references('id')->on('groups');
        });     
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('message_recipients');
    }
}
