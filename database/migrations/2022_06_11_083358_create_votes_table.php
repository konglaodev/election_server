<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVotesTable extends Migration

{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('votes', function (Blueprint $table) {
        
            
            $table->unsignedBigInteger("population_id");
            $table->primary("population_id");
            $table->unsignedBigInteger("candidate_id");
            $table->timestamps();
        });

        Schema::table('votes',function (Blueprint $table){
            $table->foreign("population_id")->references("id")->on("populations")->onDelete("CASCADE");
            $table->foreign("candidate_id")->references("id")->on("candidates")->onDelete("CASCADE");

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table("votes",function (Blueprint $table){
            $table->dropForeign(["population_id"]);
            $table->dropColumn("population_id");
            $table->dropForeign(["candidate_id"]);
            $table->dropColumn("candidate_id");
            
        });
        Schema::dropIfExists('votes');
    }
}
