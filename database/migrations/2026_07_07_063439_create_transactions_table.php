<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            
            // ربط العملية بالطلب المرتبط بيها
            $table->foreignId('order_id')->constrained('orders')->onDelete('cascade');
            
            // ربط بالمندوب (nullable عشان لو في عمليات تخص الإدارة فقط)
            $table->foreignId('driver_id')->nullable()->constrained('users')->onDelete('set null');
            
            // المبلغ المالي للعملية
            $table->decimal('amount', 10, 2);
            
            // نوع العملية: 
            // delivery_earning = صافي ربح المندوب من التوصيل
            // company_commission = عمولة المنصة أو الشركة
            $table->enum('type', ['delivery_earning', 'company_commission']);
            
            $table->string('description')->nullable(); // وصف اختياري (مثال: عمولة الطلب رقم #10)
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
