<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documents', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title', '100');  //文書タイトル
            $table->date('date');   //文書の日付
            $table->string('memo', '250')->nullable();  //文書メモ(null ok)
            $table->integer('user_id');   //userテーブルとの結びつき
            $table->integer('folder_id');  //folderテーブルとの結びつき
            $table->timestamp('created_at')->nullable();  //作成した時間(null ok)
            $table->timestamp('updated_at')->nullable();  //編集した時間(null ok)
            $table->binary('file');   //文書ファイル
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('documents');
    }
}
