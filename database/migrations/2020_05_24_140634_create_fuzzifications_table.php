<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFuzzificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fuzzifications', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('herb_id');
            $table->unsignedBigInteger('criteria_id');
            $table->double('less');
            $table->double('medium');
            $table->double('good');
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
        Schema::dropIfExists('fuzzifications');
    }
}
