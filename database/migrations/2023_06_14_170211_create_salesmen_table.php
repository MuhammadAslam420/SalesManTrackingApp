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
        Schema::create('salesmen', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('username')->nullable()->unique();
            $table->string('employee_no')->unique();
            $table->string('email')->unique();
            $table->string('mobile')->unique();
            $table->string('city')->nullable();
            $table->text('address')->nullable();
            $table->double('lng', 18, 15)->nullable();
            $table->double('lat', 18, 15)->nullable();
            $table->string('avatar')->default('user.png');
            $table->enum('status',['active','inactive','block'])->default('inactive');
            $table->enum('online',['online','offline'])->default('offline');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
            $table->date('deleted_at')->nullable();
            $table->foreignId('created_by')->references('id')->on('admins');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('salesmen');
    }
};
