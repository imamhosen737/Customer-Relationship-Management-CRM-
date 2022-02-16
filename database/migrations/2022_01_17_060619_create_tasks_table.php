<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('project_id')->unsigned();
            $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->bigInteger('milestone_id')->unsigned();
            $table->foreign('milestone_id')->references('id')->on('milestone')->onUpdate('cascade')->onDelete('cascade');
            $table->string('subject');
            $table->string('duration');
            $table->enum('status', ['pending', 'in_progress','testing','feedback','complete'])->default('pending');
            $table->string('description');
            $table->date('start_date');
            $table->date('end_date');
            $table->enum('priority', ['low', 'medium', 'high'])->default('low');
            $table->enum('visible_to_customer', ['yes', 'no'])->default('no');
            $table->timestamps();


            // $table->id();
            // $table->bigInteger('project_id')->unsigned();
            // $table->foreignId('project_id')->references('id')->on('projects')->onUpdate('cascade')->onDelete('cascade');
            // $table->bigInteger('user_id')->unsigned();
            // $table->foreignId('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            // $table->bigInteger('milestone_id')->unsigned();
            //  $table->foreignId('milestone_id')->references('id')->on('milestone')->onUpdate('cascade')->onDelete('cascade');
            // $table->string('subject');
            // $table->string('duration');
            // $table->enum('status', ['pending', 'in_progress','testing','feedback','complete'])->default('pending');
            // $table->string('description');
            // $table->date('start_date');
            // $table->date('end_date');
            // $table->enum('priority', ['low', 'medium', 'high'])->default('low');
            // $table->enum('visible_to_customer', ['yes', 'no'])->default('no');
            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tasks');
    }
}
