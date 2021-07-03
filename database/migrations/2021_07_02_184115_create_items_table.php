<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('show_count');
            $table->timestamps();
        });

        // Insert some data

        $handle = fopen(getcwd().'\database\migrations\item.csv', 'r');
        if ($handle) {
            while ($line = fgetcsv($handle,1000,",")) {
                DB::table('items')->insert(
                    array(
                        'name' => $line[0],
                        'show_count' => $line[1]
                    )
                );
            }
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('items');
    }
}
