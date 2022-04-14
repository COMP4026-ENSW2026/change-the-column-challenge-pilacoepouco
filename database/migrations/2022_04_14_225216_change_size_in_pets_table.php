<?php

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
        DB::statement("ALTER TABLE pets MODIFY COLUMN size ENUM('XS', 'SM', 'M', 'L', 'LG', 'XL', 'm', 'xl')");
        // Schema::table('pets', function (Blueprint $table) {
        //     $table->enum('size', ['XS', 'SM', 'M', 'L', 'LG', 'XL', 'm', 'xl'])->change();
        // });
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
