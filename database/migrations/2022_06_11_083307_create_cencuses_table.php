<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCencusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cencuses', function (Blueprint $table) {
            $table->bigIncrements("id");
            $table->string("census_number");
            $table->unsignedBigInteger("village_id");
            $table->timestamps();
        });
        
        Schema::table("cencuses",function (Blueprint $table){
            $table->foreign("village_id")->references("id")->on("village_numbers")->onDelete("CASCADE");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cencuses');
    }
}
