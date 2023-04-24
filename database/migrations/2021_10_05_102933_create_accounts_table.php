<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // TODO: Type? like: food, fun...
        Schema::create('accounts', function (Blueprint $table) {
            $table->id();
            $table->integer('amount')->default(0);
            $table->text('notes')->nullable();
            $table->boolean('income')->default(false);
            $table->boolean('cash')->default(false);
            //$table->date('created_at')->default('now');
            $table->foreignId('user_id')->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('accounts');
    }
}
