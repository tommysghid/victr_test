<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVictrTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('victr', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('repo_id');
            $table->text('name');
            $table->text('repo_url');
            $table->datetime('created_date');
            $table->datetime('last_push_date');
            $table->longtext('description');
            $table->integer('num_of_stars');
            $table->timestamp('created_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('victr');
    }
}
