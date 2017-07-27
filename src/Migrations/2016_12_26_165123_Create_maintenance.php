<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMaintenance extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('maintenances', function (Blueprint $table) {
            $table->increments('id');
            $table->text('message')->nullable();
            $table->integer('user_id')->index()->unsigned();
            $table->foreign('user_id')->references('id')->on('users')
                ->onDelete('cascade');
            $table->string('title')->nullable();
            $table->text('body')->nullable();
            $table->timestamp('begin')->nullable();
            $table->timestamp('end')->nullable();
            $table->boolean('status')->default(0);
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
        Schema::drop('maintenances');
    }
}
