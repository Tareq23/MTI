<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UserProfileMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_profiles',function(Blueprint $table){
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->integer('priority_serial')->default(0);
            $table->string('name',50)->nullable();
            $table->string('image',200)->nullable();
            $table->string('email',100)->nullable();
            $table->json('education')->nullable();
            $table->json('social_link')->nullable();
            $table->text('description')->nullable();
            $table->boolean('confirm')->deafult(false);
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('user_profiles');
    }
}
