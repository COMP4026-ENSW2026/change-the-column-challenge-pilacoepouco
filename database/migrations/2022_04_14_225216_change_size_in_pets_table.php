<?php

use App\Models\Pet;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class ChangeSizeInPetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $pets = Pet::all()->map(function (Pet $pet) {
            $pet->size = strtoupper($pet->size);
            $pet->save();
            return $pet;
        });

        $pet_nomenclatura = $pets->whereIn('size', ["SMALL", "LARGE", "MEDIUM"]);
        $pet_nomenclatura = $pet_nomenclatura->map(function (Pet $pet) {
            if ($pet->size == "LARGE")
                $pet->size = "L";
            else if ($pet->size == "MEDIUM")
                $pet->size = "M";
            else if ($pet->size == "SMALL")
                $pet->size = "SM";
            $pet->save();

            return $pet;
        });
        Schema::table('pets', function (Blueprint $table) {
            $table->enum('size2', ['XS', 'SM', 'S', 'M', 'L', 'LG', 'XL'])->nullable();
        });

        $pets = Pet::all()->map(function (Pet $pet) {
            $pet->size2 = $pet->size;
            $pet->save();
            return $pet;
        });

        Schema::table('pets', function ($table) {
            $table->dropColumn('size');
        });
        Schema::table('pets', function ($table) {
            $table->renameColumn('size2', 'size');
        });
        
        //small , large , medium
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pets', function (Blueprint $table) {
            //
        });
    }
}
