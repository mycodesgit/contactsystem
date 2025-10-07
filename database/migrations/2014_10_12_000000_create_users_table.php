<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('company');
            $table->string('phone');
            $table->string('email')->unique();
            $table->integer('role');
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });

        // Insert default admin user
        \DB::table('users')->insert([
            'name' => 'Admin Level',
            'company' => 'FDC',
            'phone' => '09459636047',
            'email' => 'adminlevel@gmail.com',
            'password' => bcrypt('adminp@55'),
            'role' => '0',
            'remember_token' => \Illuminate\Support\Str::random(10),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
