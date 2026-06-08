<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonalParticularsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personal_particulars', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            $table->string('full_name');
            $table->string('title');

            $table->string('email');
            $table->string('phone');
            $table->string('address');
            $table->string('age');
            $table->string('gender');
            $table->string('nationality');
            $table->string('marital_status');

            $table->string('linkedin')->nullable();
            $table->string('github')->nullable();

            $table->text('about_me')->nullable();

            $table->string('profile_image');

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
        Schema::dropIfExists('personal_particulars');
    }
}
