<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notice', function (Blueprint $table) {
            $table->increments('notice_id');
            $table->string('notice_en_title',200);
            $table->string('notice_bn_title',350);
            $table->text('notice_en_description')->nullable();
            $table->text('notice_bn_description')->nullable();
            $table->string('notice_link',300)->nullable();
            $table->string('notice_file',100)->nullable();

            $table->tinyInteger('notice_type_id')->default(1);
            $table->tinyInteger('notice_department_id')->default(1);
            $table->tinyInteger('status')->default(1);
            $table->integer('creator');
            $table->integer('modifier');
            $table->timestamp('created_date')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('modified_date')->default(DB::raw('CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notice');
    }
};
