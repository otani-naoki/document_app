<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title', '50');  //プロジェクトタイトル
            $table->date('date');
            $table->string('object', '100');   //プロジェクトの目的
            $table->string('memo', '300')->nullable();  //プロジェクトメモ(null ok)
            $table->timestamp('created_at')->nullable();  //作成した時間(null ok)
            $table->timestamp('updated_at')->nullable();  //編集した時間(null ok)
            $table->integer('user_id');   //userテーブルとの結びつき
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('projects');
    }
}
