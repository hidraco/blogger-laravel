<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSupervisorBloggersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('supervisor_bloggers', function (Blueprint $table) {
            $table->unsignedInteger('supervisor_id');
            $table->unsignedInteger('blogger_id');
            $table->foreign('supervisor_id')->references('id')->on('Users')->cascade('delete');
            $table->foreign('blogger_id')->references('id')->on('Users')->cascade('delete');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('supervisor_bloggers');
    }
}
