<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('lastName');
            $table->date('date_of_birth')->nullable();
            $table->string('nikName')->nullable();
            $table->enum('gender', ['female', 'male']);
            $table->string('city');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
            $table->dropColumn('lastName');
            $table->dropColumn('date_of_birth')->nullable();
            $table->dropColumn('nikName');
            $table->dropColumn('gender');
            $table->dropColumn('city');
        });
    }
}
