<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * 生成日志数据库表
 * Class CreateLogTables
 */
class CreateLogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $connection = config('bkqw_log.database.connection') ?: config('database.default');
        Schema::connection($connection)->create(config('bkqw_log.database.log_table'), function (Blueprint $table) {
            $table->increments('id');
            $table->string('module', 16)->default('')->comment('模块：api、admin');
            $table->string('type', 16)->default('')->comment('日志类型');
            $table->text('content')->comment('内容');
            $table->integer('created_at')->default(0);
            $table->integer('updated_at')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $connection = config('bkqw_log.database.connection') ?: config('database.default');

        Schema::connection($connection)->dropIfExists(config('bkqw_log.database.system_log_table'));
    }
}
