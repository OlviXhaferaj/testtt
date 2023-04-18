<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->string('image');
            $table->enum('eventType', ['Death','Birth','Other'])->default('Birth');
            $table->integer('day')->nullable();
            $table->integer('month')->nullable();
            $table->integer('year')->nullable();
            $table->enum('epoce', ['BC','AC'])->default('AC');
            $table->date('event_trigger_date')->nullable();
            $table->timestamps();

            $table->foreignId('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
                // On delete('cascade') deletes every event if the user that has created the envets
                // gets deleted
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('events');
    }
}
