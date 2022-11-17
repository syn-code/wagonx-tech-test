<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    private string $table = 'city_weather_results';
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable($this->table)) {
            Schema::create($this->table, function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('city_id');
                $table->string('main', 255);
                $table->text('description');
                $table->string('icon',20);
                $table->dateTime('date_time_weather_calculated');
                $table->timestamps();

                $table->foreign('city_id')
                    ->references('id')
                    ->on('cities');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
