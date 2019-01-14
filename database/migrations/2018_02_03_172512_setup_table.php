<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SetupTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->enum('gender', ['1', '2'])->comments('1 = male, 2 = female');
            $table->string('email')->unique();
            $table->string('phone');
            $table->text('address');
            // $table->string('avatar')->default('public/img/default.jpg');
            $table->string('username')->unique();
            $table->string('password');
            $table->unsignedInteger('role_id');
            // $table->text('permission')->nullable();
            $table->rememberToken();

            // $table->foreign('role_id')->references('id')->on('role')->onDelete('cascade');
        });

        Schema::create('role', function (Blueprint $table) {
            $table->increments('id');
            $table->string('role')->unique();
        });

        Schema::create('mail_type', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type');
        });

        Schema::create('mail', function (Blueprint $table) {
            $table->string('id')->unique();
            $table->date('incoming_at');
            $table->string('mail_code')->unique();
            $table->timestamp('mail_date')->useCurrent();
            $table->string('mail_from')->nullable();
            $table->string('mail_to')->nullable();
            $table->string('mail_subject')->nullable();
            $table->text('mail_content');
            $table->enum('in_out', ['1', '2'])->comments('1 = SM, 2 = SK');

            $table->unsignedInteger('user_id')->default('2');
            // $table->foreign('user_id')->references('id')->on('user');
        });

        Schema::create('disposition', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamp('disposition_at')->useCurrent();
            $table->timestamp('reply_at')->nullable();
            $table->text('description')->nullable();
            $table->enum('status', ['1', '2', '3'])->comments('1 = important, 2 = secret, 3 = ordinary');
            $table->enum('read_unread', ['0', '1'])->default('0')->comments('1 = read');

            $table->integer('user_id')->default('2');
            $table->string('mail_id');

            // $table->foreign('mail_id')->references('id')->on('mail')->onDelete('cascade');
            // $table->foreign('user_id')->references('id')->on('user')->onDelete('cascade');
        });

        Schema::create('file', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            // $table->string('size');
            $table->string('file');

            $table->string('mail_id');
            // $table->foreign('mail_id')->references('id')->on('mail')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user');
        Schema::dropIfExists('mail');
        Schema::dropIfExists('disposition');
        Schema::dropIfExists('file');
    }
}
