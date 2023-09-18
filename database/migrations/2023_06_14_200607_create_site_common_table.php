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
        Schema::create('site_common', function (Blueprint $table) {
            $table->increments('site_common_id');
            $table->string('time_zone',100)->nullable();
            $table->string('site_name',100)->nullable();
            $table->string('site_email',100)->nullable();
            $table->string('site_contact',100)->nullable();

            $table->string('site_title',200)->nullable();
            $table->string('site_keyword',300)->nullable();
            $table->string('site_description',500)->nullable();
            $table->string('site_bn_description',500)->nullable();

            $table->string('site_en_open_time',100)->nullable();
            $table->string('site_bn_open_time',100)->nullable();

            $table->string('site_link',200)->nullable();
            $table->string('site_address',200)->nullable();
            $table->string('site_bn_address',200)->nullable();

            $table->string('site_fb_link',300)->nullable();
            $table->string('site_tw_link',300)->nullable();
            $table->string('site_yt_link',300)->nullable();
            $table->string('site_ig_link',300)->nullable();

            $table->string('site_logo',100)->nullable();
            $table->string('site_logo_big',100)->nullable();
            $table->string('site_favicon',100)->nullable();
            $table->string('site_default_img',100)->nullable();


            $table->string('site_about_title',200)->nullable();
            $table->text('site_about_description')->nullable();
            $table->string('site_about_bn_title',200)->nullable();
            $table->text('site_about_bn_description')->nullable();
            $table->string('site_about_img',100)->nullable();


            $table->text('site_privacy_policy')->nullable();
            $table->text('site_terms')->nullable();
            $table->text('site_communication')->nullable();

            $table->text('site_bn_privacy_policy')->nullable();
            $table->text('site_bn_terms')->nullable();
            $table->text('site_bn_communication')->nullable();


            $table->longText('site_map')->nullable();
            $table->longText('site_menu')->nullable();


            $table->string('site_eiin',100)->nullable();
            $table->string('site_institute_code',100)->nullable();
            $table->string('site_center_code',100)->nullable();
            $table->string('site_estd',100)->nullable();
            $table->string('site_student',100)->nullable();



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
        Schema::dropIfExists('site_common');
    }
};
