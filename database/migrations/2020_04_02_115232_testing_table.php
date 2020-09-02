<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TestingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_test_table', function (Blueprint $table) {

            //tinyint vs small in vs bigint
            //https://stackoverflow.com/questions/2991405/what-is-the-difference-between-tinyint-smallint-mediumint-bigint-and-int-in-m

            $table->charset = 'utf8';
            $table->collation = 'utf8_unicode_ci';
            $table->bigIncrements('id');
            $table->bigInteger('votes');
            $table->binary('data');
            $table->boolean('confirmed');
            $table->char('name', 100);
            $table->date('created_at');
            $table->dateTime('created_at1', 0);
            $table->dateTimeTz('created_at2', 0);
            $table->decimal('amount', 8, 2);
            $table->double('amount1', 8, 2);
            $table->enum('level', ['easy', 'hard']);
            $table->float('amount2', 8, 2);
            $table->geometry('positions');
            //$table->increments('id1');
            $table->integer('votess');
            $table->ipAddress('visitor');
            $table->json('options');
            $table->jsonb('optionss');
            $table->lineString('positionsd');
            $table->longText('description');
            $table->macAddress('device');
            //$table->mediumIncrements('id2');
            $table->mediumInteger('votes1');
            $table->mediumText('descriptions');
            $table->multiLineString('positionss');
            $table->multiPoint('positionsdd');
            $table->rememberToken();
            //$table->smallIncrements('id3');
            $table->smallInteger('votesss');
            $table->softDeletes(0);
            //$table->softDeletesTz(0);
            $table->string('name1', 100);
            $table->text('descriptionsss');
            $table->time('sunrise', 0);
            $table->year('birth_year');
            //$table->timestamps(0);
            //$table->timestamps();
        });
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
}
