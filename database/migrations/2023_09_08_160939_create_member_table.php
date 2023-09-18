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
        Schema::create('member', function (Blueprint $table) {
            $table->increments('member_id');
            $table->string('member_en_name',150);
            $table->string('member_bn_name',260);
            $table->text('member_en_speech')->nullable();
            $table->text('member_bn_speech')->nullable();
            $table->text('member_en_description')->nullable();
            $table->text('member_bn_description')->nullable();
            $table->string('member_image',100)->nullable();
            $table->tinyInteger('member_gender')->nullable();
            $table->string('member_index',100)->nullable();
            $table->integer('position')->default(0);
            $table->tinyInteger('designation_id');
            $table->tinyInteger('period_id');
            $table->timestamp('joining_date')->nullable();
            $table->timestamp('resign_date')->nullable();

            $table->string('whatsapp_number',100)->nullable();
            $table->string('facebook_link',100)->nullable();
            $table->string('email_address',100)->nullable();
            $table->string('phone_number',100)->nullable();
            $table->string('linkedin_link',100)->nullable();
            $table->string('twitter_link',100)->nullable();

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
        Schema::dropIfExists('member');
    }
};
