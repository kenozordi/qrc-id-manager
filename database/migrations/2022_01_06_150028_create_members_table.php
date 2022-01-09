<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->uuid('qr_id');
            $table->string('name');
            $table->string('address');
            $table->string('phone_number');
            $table->string('email');
            $table->string('company')->default('freelance');
            $table->string('membership_cadre')->default('student');
            $table->string('dmn');
            $table->string('date_joined');
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
        Schema::dropIfExists('members');
    }
}
