<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehiclesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('brand_id')->constrained('brands');
            $table->string('category');
            $table->string('model');
            $table->string('license_plate');
            $table->string('year');
            $table->string('stnk_number');
            $table->string('bpkb_number');
            $table->string('chassis_number');
            $table->string('engine_number');
            $table->date('stnk_period');
            $table->date('tax_period');
            $table->string('photo')->nullable();
            $table->foreignId('office_id')->constrained('offices');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->tinyInteger('status')->comment('0=tersedia, 1=dipinjam');
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
        Schema::dropIfExists('vehicles');
    }
}
