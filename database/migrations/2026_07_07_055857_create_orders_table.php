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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            
            // الأطراف المرتبطة
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); 
            $table->foreignId('driver_id')->nullable()->constrained('users')->onDelete('set null'); 
            $table->foreignId('store_id')->nullable()->constrained('stores')->onDelete('set null'); 
            
            // نوع الطلب
            $table->enum('order_type', ['store_order', 'custom_order'])->default('store_order');

            // تفاصيل الاستلام (منين؟)
            $table->string('pickup_address')->nullable(); 

            // تفاصيل التسليم (لفين؟)
            $table->foreignId('address_id')->nullable()->constrained('addresses')->onDelete('set null'); 
            $table->string('dropoff_address')->nullable(); 

            // تفاصيل الأغراض والملاحظات
            $table->text('notes')->nullable(); 

            // الحسابات والماليات
            $table->decimal('items_total', 10, 2)->default(0.00); 
            $table->decimal('delivery_fee', 10, 2)->default(0.00); 
            $table->decimal('total_amount', 10, 2)->default(0.00); 
            
            $table->enum('status', [
                'pending',   
                'accepted',    
                'on_the_way',  
                'delivered'
            ])->default('pending');

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
