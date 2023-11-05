<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoutesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('routes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('salesman_id');
            $table->foreign('salesman_id')->references('id')->on('salesmen');
            $table->unsignedBigInteger('assigned_by_id');
            $table->foreign('assigned_by_id')->references('id')->on('admins');
            $table->enum('status',['active','inactive','deleted'])->default('inactive');
            $table->enum('visit_day',['monday','tuesday','wednesday','thursday','friday','saturday','sunday'])->default('monday');
            $table->date('deleted_at')->nullable();
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
        Schema::dropIfExists('routes');
    }
}
