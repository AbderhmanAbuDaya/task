<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSponsorOrphansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sponsor_orphans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sponsor_id')->constrained('users');
            $table->foreignId('orphan_id')->constrained('users');
            $table->date('start_warranty_date');
            $table->integer('warranty_period')->comment('month');
            $table->double('warranty_value')->comment('$');
            $table->unique(['orphan_id','sponsor_id','start_warranty_date']);
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
        Schema::dropIfExists('sponsor_orphans');
    }
}
