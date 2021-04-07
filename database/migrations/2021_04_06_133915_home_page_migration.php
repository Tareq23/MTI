<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class HomePageMigration extends Migration
{
    
    public function up()
    {
        Schema::create('home_page',function(Blueprint $table){
            $table->bigIncrements('id');
            $table->string('name',50);
            $table->string('image',200);
            $table->string('work_position',100);
            $table->text('short_description');
            $table->text('map_link');
            $table->text('footer');
        });
    }


    public function down()
    {
        Schema::dropIfExists('home_page');
    }
}
