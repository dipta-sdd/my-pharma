<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->nullable()->constrained();
            $table->foreignId('branch_id')->constrained();
            $table->date('date');
            $table->decimal('total_amount', 10, 2); // Amount before discount
            $table->string('discount_type')->nullable(); // e.g., 'fixed', 'percentage'
            $table->decimal('discount_amount', 10, 2)->nullable();
            $table->decimal('final_amount', 10, 2); // Total amount after discount
            $table->decimal('amount_paid', 10, 2);
            $table->string('payment_method'); // e.g., 'cash', 'card', 'mobile'
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('orders');
    }
};
