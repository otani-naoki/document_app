<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFoldersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('folders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title', '50');  //フォルダタイトル
            $table->integer('user_id');   //userテーブルとの結びつき
            $table->integer('project_id');  //projectテーブルとの結びつき
            $table->timestamp('created_at')->nullable();  //作成した時間(null ok)
            $table->timestamp('updated_at')->nullable();  //編集した時間(null ok)
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('folders');
    }
}
