<?php

use App\Constants\PaymentConstants;
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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->smallInteger('gateway')->default( PaymentConstants::GATEWAY_SQUARE_UP);
            $table->smallInteger('type')->default(PaymentConstants::TYPE_FULL_PAYMENT);
            $table->string('transaction_id')->nullable();
            $table->double('amount', 6,2)->default(0.00);
            $table->double('gateway_fee', 6,2)->default(0.00);
            $table->double('taxes', 6,2)->default(0.00);
            $table->smallInteger('status')->default(PaymentConstants::STATUS_PENDING);
            $table->softDeletes();
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
        Schema::dropIfExists('payments');
    }
};
