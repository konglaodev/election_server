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
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('phoneNumber')->unique();
            $table->enum("status",["verify","not_verify"])->default("not_verify");

            //$table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->unsignedBigInteger("role_id");
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::table("users",function (Blueprint $table){
            $table->foreign("role_id")->references("id")->on("roles")->onDelete("CASCADE");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['role_id']);
            $table->dropColumn('role_id');
        });
        Schema::dropIfExists('users');
    }
}
