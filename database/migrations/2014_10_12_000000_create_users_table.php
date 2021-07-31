<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

/*
            `id` bigint(20) NOT NULL DEFAULT '0',                                                     
            `usuario_id` bigint(20) NOT NULL,                                                         
            `login` varchar(50) NOT NULL,                                                             
            `password` varchar(50) NOT NULL,                                                          
            `ci` int(11) NOT NULL,                                                                    
            `name` varchar(50) NOT NULL,                                                              
            `last_name` varchar(50) NOT NULL DEFAULT '',                                              
            `phone` varchar(50) NOT NULL,                                                             
            `email` varchar(50) NOT NULL, 
*/
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('ci');
            $table->string('email')->unique();
            $table->string('phone');
            $table->boolean('status')->default(true);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->foreignId('role_id')->constrained('roles');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
