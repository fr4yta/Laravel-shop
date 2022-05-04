<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->string('session_id', 100)->nullable();
            $table->string('error_description', 2000)->nullable();
            $table->integer('error_code')->nullable();
            $table->enum('status', [\App\Enums\PaymentStatus::TYPES])->default(\App\Enums\PaymentStatus::IN_PROGRESS);
            $table->timestamps();

            $table->foreignId('order_id')->constrained();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payments');
    }
}
