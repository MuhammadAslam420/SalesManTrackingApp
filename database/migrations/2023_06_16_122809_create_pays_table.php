<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pays', function (Blueprint $table) {
            $table->id();
            $table->foreignId('salesman_id')->references('id')->on('salesmen');
            $table->double('basic',15,4)->default(10000);
            $table->double('medical',15,4)->default(2000);
            $table->double('transport',15,4)->default(2000);
            $table->double('annual_bonus',15,4)->default(20000)->comment('one basic pay on eid in terms of bonus');
            $table->double('annual_increment')->default(10)->comment('In term of percentage');
            $table->double('commission_on_sales')->default(5)->comment('In term of percentage');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pays');
    }
};
