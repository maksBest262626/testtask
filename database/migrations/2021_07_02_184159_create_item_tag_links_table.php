<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemTagLinksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_tag_links', function (Blueprint $table) {
            $table->id();
            $table->integer('item_id')->unsigned()->index();
            $table->foreign('item_id')->references('id')->on('items')->onDelete('cascade');
            $table->integer('tag_id');
            $table->foreign('tag_id')->references('id')->on('tags')->onDelete('cascade');
            $table->timestamps();
        });

        $handle = fopen(getcwd().'\database\migrations\item_tag.csv', 'r');
        if ($handle) {
            while ($line = fgetcsv($handle,1000,",")) {
                DB::table('item_tag_links')->insert(
                    array(
                        'item_id' => $line[0],
                        'tag_id' => $line[1]
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
        Schema::dropIfExists('item_tag_links');
    }
}
