<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone_number');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->tinyInteger('status')->default(0);
            $table->string('token')->nullable();
            $table->foreignId('province_id')->nullable()->constrained();
            $table->foreignId('regency_id')->nullable()->constrained();
            $table->foreignId('district_id')->nullable()->constrained();
            $table->foreignId('village_id')->nullable()->constrained();
            $table->string('address')->nullable();
            $table->string('rt')->nullable();
            $table->string('rw')->nullable();
            $table->string('point')->nullable()->default(0);
            $table->string('qrcode')->nullable()->unique();
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();

            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
