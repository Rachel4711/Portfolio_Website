<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEducationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('educations', function (Blueprint $table) {

            $table->id();
            
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            $table->year('year_started');
            $table->year('year_completed');

            $table->month('month_started');
            $table->month('month_completed');

            $table->boolean('currently_studying')->default(false);

            $table->string('institution', 150);

            $table->string('qualification', 100);

            $table->string('field_of_study', 100);

            $table->decimal('cgpa', 3, 2)->nullable();

            $table->string('result', 10)->nullable();

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
        Schema::dropIfExists('educations');
    }
}
