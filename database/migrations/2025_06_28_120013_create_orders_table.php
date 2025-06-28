<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('course_id')->constrained()->onDelete('cascade');
            $table->decimal('price', 8, 2);

            // العنوان
            $table->string('address');
            $table->string('city');
            $table->string('state');
            $table->string('postal_code');

            // معلومات الدفع (اختياري تخزينها)
            $table->string('card_name');
            $table->string('card_number');
            $table->string('expiry');
            $table->string('cvc');

            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
