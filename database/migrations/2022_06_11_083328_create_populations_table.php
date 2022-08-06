<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePopulationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('populations', function (Blueprint $table) {
            $table->bigIncrements("id");
            $table->string("name");
            $table->string('surname');
            $table->string('gender');
            $table->string("phoneNumber");
            $table->date("dateOfBirth");
            $table->string("address");
            $table->string("image");
            $table->unsignedBigInteger("cencus_id");
            $table->timestamps();
        });
        
        Schema::table("populations",function (Blueprint $table){
            $table->foreign("cencus_id")->references("id")->on("cencuses")->onDelete("CASCADE");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table("populations",function (Blueprint $table){
            $table->dropForeign(["cencus_id"]);
            $table->dropColumn("cencus_id");
            
        });
        Schema::dropIfExists('populations');
    }
}
