<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
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
        Schema::create('borrowed_books', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->text('stud_num')->nullable();
            $table->text('stud_name')->nullable();
            $table->text('stud_email')->nullable();
            $table->text('stud_phone')->nullable();

            $table->bigInteger('book_id')->unsigned()->nullable();
            $table->string('book_title')->nullable();
            $table->string('book_isbn')->nullable();


            $table->string('returnDate');
            $table->string('status')->default('Pending');

            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('book_id')->references('id')->on('books')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('borrowed_books');
    }
};
