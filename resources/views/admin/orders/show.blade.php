@extends('layouts.admin')

@section('title', 'تفاصيل الطلب #' . $order->id)
@section('page-title', 'تفاصيل الطلب #' . $order->id)
@section('page-subtitle', 'عرض تفاصيل الطلب وتحديث حالته')

@section('content')
<style type="text/css" media="print">
    @page { margin: 1cm; }
    body * { visibility: hidden; }
    
    /* Show only the print-invoice element and its children */
    #print-invoice, #print-invoice * { 
        visibility: visible; 
    }
    
    #print-invoice {
        position: absolute;
        left: 0;
        top: 0;
        right: 0;
        width: 100%;
        margin: 0;
        padding: 20px;
        background: white !important;
        color: black !important;
        font-family: Arial, sans-serif;
        direction: rtl;
    }

    /* Professional Black & White styling */
    #print-invoice table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }
    #print-invoice th, #print-invoice td {
        border: 1px solid #000;
        padding: 10px;
        text-align: right;
    }
    #print-invoice th {
        background-color: #f0f0f0 !important;
        -webkit-print-color-adjust: exact;
    }
    #print-invoice h1, #print-invoice h2, #print-invoice h3, #print-invoice p {
        color: #000 !important;
        margin: 5px 0;
    }
    
    .print-hidden { display: none !important; }
</style>

@php
    $invoiceMsg = "";
    $encodedMsg = "";
    if($order->customer && $order->customer->phone) {
        $invoiceMsg = "*رسالة تأكيد الطلب – علي الباب* 🚚\n";
        $invoiceMsg .= "مرحبًا، معك علي الباب لتوصيل الطلبات.\n";
        $invoiceMsg .= "✅ تم تأكيد طلبك بنجاح.\n\n";
        $invoiceMsg .= "*تفاصيل الطلب:*\n";
        $invoiceMsg .= "رقم الطلب: #" . $order->id . "\n";
        $invoiceMsg .= "اسم العميل: " . ($order->customer->name ?? 'عميلنا العزيز') . "\n";
        $invoiceMsg .= "رقم العميل: " . $order->customer->phone . "\n";
        $invoiceMsg .= "قيمة الطلب: " . number_format($order->items_total, 2) . " جنيه\n";
        $invoiceMsg .= "مصاريف الشحن: " . number_format($order->delivery_fee, 2) . " جنيه\n";
        $invoiceMsg .= "الإجمالي المطلوب: *" . number_format($order->total_amount, 2) . " جنيه*\n\n";

        $vodafone = \App\Models\Setting::where('key', 'vodafone_cash_number')->value('value');
        $etisalat = \App\Models\Setting::where('key', 'etisalat_cash_number')->value('value');
        
        if ($vodafone || $etisalat) {
            $invoiceMsg .= "💳 *أرقام الدفع (كاش وواتساب):*\n";
            if ($vodafone) $invoiceMsg .= "فودافون كاش: " . $vodafone . "\n";
            if ($etisalat) $invoiceMsg .= "اتصالات كاش: " . $etisalat . "\n";
            $invoiceMsg .= "\n";
        }
        
        if ($order->driver) {
            $invoiceMsg .= "🛵 *معلومات المندوب:*\n";
            $invoiceMsg .= "الاسم: " . $order->driver->name . "\n\n";
        }
        
        $invoiceMsg .= "سيتم التواصل معك قبل وصول المندوب، ويمكنك متابعة حالة الطلب من خلال موقعنا.\n";
        $invoiceMsg .= "شكرًا لاختيارك علي الباب... كل طلباتك لحد باب بيتك 💙";

        $encodedMsg = urlencode($invoiceMsg);
    }
@endphp

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

    <!-- Order Details Card -->
    <div class="lg:col-span-2 space-y-6">
        <div class="glass-card p-6" data-aos="fade-up">
            <h3 class="text-lg font-bold text-[#0B1536] mb-4 border-b pb-3">معلومات الطلب</h3>
            
            <div class="space-y-4">
                <div class="flex justify-between items-center bg-gray-50 p-3 rounded-lg">
                    <span class="text-sm font-semibold text-gray-500">نوع الطلب</span>
                    <span class="text-sm font-bold text-gray-800">
                        {{ $order->order_type == 'store_order' ? 'طلب من متجر' : 'طلب خاص / منوع' }}
                    </span>
                </div>

                <div class="flex justify-between items-center bg-gray-50 p-3 rounded-lg">
                    <span class="text-sm font-semibold text-gray-500">كود التتبع</span>
                    <span class="text-sm font-mono font-bold text-gray-800" dir="ltr">{{ $order->tracking_code }}</span>
                </div>

                @if($order->order_type == 'store_order' && $order->store)
                <div class="flex justify-between items-center bg-gray-50 p-3 rounded-lg">
                    <span class="text-sm font-semibold text-gray-500">المتجر</span>
                    <span class="text-sm font-bold text-blue-600">{{ $order->store->name }}</span>
                </div>
                @elseif($order->order_type == 'custom_order')
                <div class="flex justify-between items-center bg-gray-50 p-3 rounded-lg">
                    <span class="text-sm font-semibold text-gray-500">عنوان الاستلام (متجر مخصص)</span>
                    <span class="text-sm font-bold text-gray-800">{{ $order->pickup_address }}</span>
                </div>
                @endif

                <div class="bg-gray-50 p-4 rounded-lg">
                    <span class="block text-sm font-semibold text-gray-500 mb-2">الطلبات / الملاحظات</span>
                    <p class="text-sm font-medium text-gray-800 whitespace-pre-line">{{ $order->notes }}</p>
                </div>
                
                <div class="bg-gray-50 p-4 rounded-lg">
                    <span class="block text-sm font-semibold text-gray-500 mb-2">عنوان التوصيل (للعميل)</span>
                    <p class="text-sm font-medium text-gray-800">{{ $order->dropoff_address }}</p>
                </div>
            </div>
        </div>

        <!-- WhatsApp Preview Card -->
        @if($order->customer && $order->customer->phone)
        <div id="invoice-preview-container" class="glass-card p-6" data-aos="fade-up" data-aos-delay="50">
            <h3 class="text-lg font-bold text-[#0B1536] mb-4 border-b pb-3 flex items-center gap-2">
                <svg class="w-5 h-5 text-[#25D366]" fill="currentColor" viewBox="0 0 24 24"><path d="M12.031 0C5.385 0 0 5.385 0 12.031c0 2.12.553 4.148 1.584 5.955L.12 23.514l5.656-1.481c1.748.948 3.705 1.455 5.753 1.455 6.645 0 12.031-5.385 12.031-12.031C24.062 5.385 18.677 0 12.031 0zm-1.127 20.301c-1.802 0-3.568-.485-5.115-1.404l-.367-.218-3.805.996.996-3.805-.218-.367c-1.009-1.696-1.542-3.66-1.542-5.69 0-5.748 4.673-10.422 10.422-10.422 5.749 0 10.422 4.674 10.422 10.422 0 5.748-4.674 10.422-10.422 10.422zm5.74-7.839c-.315-.158-1.861-.92-2.148-1.026-.286-.105-.494-.158-.702.158-.208.315-.811 1.026-.994 1.235-.183.21-.366.236-.681.079-2.145-1.071-3.411-2.094-4.71-4.32-.132-.224.133-.213.444-.834.104-.21.052-.394-.026-.552-.079-.158-.702-1.693-.961-2.316-.252-.606-.508-.524-.702-.533-.183-.008-.393-.008-.602-.008-.21 0-.549.079-.836.394-.287.315-1.096 1.072-1.096 2.613 0 1.54 1.122 3.03 1.278 3.24.158.21 2.215 3.38 5.362 4.66.75.305 1.336.488 1.794.625.753.226 1.44.194 1.98.118.607-.085 1.861-.76 2.123-1.495.261-.735.261-1.365.182-1.495-.078-.13-.286-.21-.601-.367z"/></svg>
                معاينة فاتورة الواتساب
            </h3>
            
            <div class="bg-[#EFEAE2] p-5 rounded-2xl border border-gray-200 relative overflow-hidden flex flex-col mb-4" style="background-image: url('https://user-images.githubusercontent.com/15075759/28719144-86dc0f70-73b1-11e7-911d-60d70fcded21.png'); background-blend-mode: multiply; background-color: rgba(239, 234, 226, 0.9);">
                <div class="relative z-10 bg-white p-4 rounded-2xl rounded-tr-sm shadow-sm inline-block max-w-[90%] text-sm text-gray-800 whitespace-pre-line leading-relaxed font-medium">
{{ $invoiceMsg }}
                    <div class="text-[10px] text-gray-400 text-left mt-2 flex justify-end items-center gap-1">
                        {{ now()->format('h:i A') }}
                        <svg class="w-3 h-3 text-blue-500" fill="currentColor" viewBox="0 0 24 24"><path d="M18.71,7.21a1,1,0,0,0-1.42,0L9.84,14.67,6.71,11.53a1,1,0,1,0-1.42,1.42l3.84,3.84a1,1,0,0,0,1.42,0l8.16-8.16A1,1,0,0,0,18.71,7.21Z"/><path d="M22.71,7.21a1,1,0,0,0-1.42,0L13.84,14.67l-1.13-1.13a1,1,0,0,0-1.42,1.42l1.84,1.84a1,1,0,0,0,1.42,0l8.16-8.16A1,1,0,0,0,22.71,7.21Z"/></svg>
                    </div>
                </div>
            </div>

            <div class="flex gap-3 mt-4 print-hidden">
                <a href="https://wa.me/2{{ $order->customer->phone }}?text={{ $encodedMsg }}" target="_blank" class="flex-1 flex items-center justify-center gap-2 bg-[#25D366] text-white font-bold rounded-xl px-4 py-3.5 hover:bg-[#128C7E] transition-all shadow-lg shadow-green-500/30">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12.031 0C5.385 0 0 5.385 0 12.031c0 2.12.553 4.148 1.584 5.955L.12 23.514l5.656-1.481c1.748.948 3.705 1.455 5.753 1.455 6.645 0 12.031-5.385 12.031-12.031C24.062 5.385 18.677 0 12.031 0zm-1.127 20.301c-1.802 0-3.568-.485-5.115-1.404l-.367-.218-3.805.996.996-3.805-.218-.367c-1.009-1.696-1.542-3.66-1.542-5.69 0-5.748 4.673-10.422 10.422-10.422 5.749 0 10.422 4.674 10.422 10.422 0 5.748-4.674 10.422-10.422 10.422zm5.74-7.839c-.315-.158-1.861-.92-2.148-1.026-.286-.105-.494-.158-.702.158-.208.315-.811 1.026-.994 1.235-.183.21-.366.236-.681.079-2.145-1.071-3.411-2.094-4.71-4.32-.132-.224.133-.213.444-.834.104-.21.052-.394-.026-.552-.079-.158-.702-1.693-.961-2.316-.252-.606-.508-.524-.702-.533-.183-.008-.393-.008-.602-.008-.21 0-.549.079-.836.394-.287.315-1.096 1.072-1.096 2.613 0 1.54 1.122 3.03 1.278 3.24.158.21 2.215 3.38 5.362 4.66.75.305 1.336.488 1.794.625.753.226 1.44.194 1.98.118.607-.085 1.861-.76 2.123-1.495.261-.735.261-1.365.182-1.495-.078-.13-.286-.21-.601-.367z"/></svg>
                    إرسال الفاتورة عبر واتساب
                </a>
                <button type="button" onclick="window.print()" class="flex items-center justify-center gap-2 bg-gray-800 text-white font-bold rounded-xl px-6 py-3.5 hover:bg-gray-900 transition-all shadow-lg shadow-gray-500/30">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/></svg>
                    طباعة / PDF
                </button>
            </div>
        </div>
        @endif

    </div>

    <!-- Sidebar Cards -->
    <div class="space-y-6">
        
        <!-- Status Update Card -->
        <div class="glass-card p-6" data-aos="fade-up" data-aos-delay="100">
            <h3 class="text-lg font-bold text-[#0B1536] mb-4 border-b pb-3">حالة الطلب</h3>
            
            <form action="{{ route('admin.orders.update', $order->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="mb-4">
                    <label class="block text-sm font-bold text-gray-500 mb-2">تحديث الحالة</label>
                    <select name="status" class="w-full bg-gray-50 border border-gray-200 text-gray-900 rounded-xl px-4 py-3 focus:ring-2 focus:ring-[#FFC107] outline-none font-bold">
                        <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>قيد الانتظار</option>
                        <option value="accepted" {{ $order->status == 'accepted' ? 'selected' : '' }}>تم القبول</option>
                        <option value="on_the_way" {{ $order->status == 'on_the_way' ? 'selected' : '' }}>في الطريق</option>
                        <option value="delivered" {{ $order->status == 'delivered' ? 'selected' : '' }}>تم التوصيل</option>
                    </select>
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-bold text-gray-500 mb-2">تعيين مندوب التوصيل</label>
                    <select name="driver_id" class="w-full bg-gray-50 border border-gray-200 text-gray-900 rounded-xl px-4 py-3 focus:ring-2 focus:ring-[#FFC107] outline-none font-bold">
                        <option value="">بدون مندوب</option>
                        @foreach($drivers as $driver)
                            <option value="{{ $driver->id }}" {{ $order->driver_id == $driver->id ? 'selected' : '' }}>
                                {{ $driver->name }} ({{ $driver->phone }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4 bg-gray-50 p-4 rounded-xl space-y-4 border border-gray-100">
                    <h4 class="font-bold text-[#0B1536] border-b pb-2">الحسابات والماليات</h4>
                    
                    <div>
                        <label class="block text-sm font-bold text-gray-500 mb-2">ثمن المشتريات (ج.م)</label>
                        <input type="number" step="0.01" min="0" name="items_total" value="{{ $order->items_total }}" class="w-full bg-white border border-gray-200 text-gray-900 rounded-xl px-4 py-3 focus:ring-2 focus:ring-[#FFC107] outline-none font-bold">
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-500 mb-2">رسوم التوصيل (ج.م)</label>
                        <input type="number" step="0.01" min="0" name="delivery_fee" value="{{ $order->delivery_fee }}" class="w-full bg-white border border-gray-200 text-gray-900 rounded-xl px-4 py-3 focus:ring-2 focus:ring-[#FFC107] outline-none font-bold">
                    </div>

                    <div class="flex justify-between items-center bg-[#0B1536] text-white p-3 rounded-lg mt-2">
                        <span class="text-sm font-semibold">الإجمالي النهائي</span>
                        <span class="text-lg font-black text-[#FFC107]">{{ number_format($order->total_amount, 2) }} ج.م</span>
                    </div>
                </div>

                <button type="submit" class="w-full bg-[#0B1536] text-white font-bold rounded-xl px-4 py-3 hover:bg-blue-900 transition-colors">
                    حفظ التعديلات
                </button>
            </form>
        </div>

        <!-- Customer Info Card -->
        <div class="glass-card p-6" data-aos="fade-up" data-aos-delay="200">
            <h3 class="text-lg font-bold text-[#0B1536] mb-4 border-b pb-3">بيانات العميل</h3>
            
            <div class="space-y-3">
                <div>
                    <span class="block text-xs font-semibold text-gray-400">الاسم</span>
                    <span class="block text-sm font-bold text-gray-800">{{ $order->customer->name ?? 'غير متوفر' }}</span>
                </div>
                <div>
                    <span class="block text-xs font-semibold text-gray-400">رقم الهاتف</span>
                    <span class="block text-sm font-bold text-gray-800" dir="ltr">{{ $order->customer->phone ?? 'غير متوفر' }}</span>
                </div>
                <div>
                    <span class="block text-xs font-semibold text-gray-400">تاريخ الطلب</span>
                    <span class="block text-sm font-bold text-gray-800" dir="ltr">{{ $order->created_at->format('Y-m-d h:i A') }}</span>
                </div>
            </div>
        </div>

    </div>

</div>

<!-- Printable Invoice Container (Hidden on screen) -->
<div id="print-invoice" class="hidden">
    <div style="text-align: center; margin-bottom: 30px;">
        <h1 style="font-size: 24px; font-weight: bold; margin-bottom: 5px;">فاتورة طلب - علي الباب</h1>
        <p>رقم الطلب: #{{ $order->id }}</p>
        <p>تاريخ الطلب: {{ $order->created_at->format('Y-m-d h:i A') }}</p>
    </div>

    <table>
        <tr>
            <th width="30%">بيانات العميل</th>
            <td width="70%">
                الاسم: {{ $order->customer->name ?? 'غير متوفر' }}<br>
                الهاتف: <span dir="ltr">{{ $order->customer->phone ?? 'غير متوفر' }}</span><br>
                العنوان: {{ $order->dropoff_address }}
            </td>
        </tr>
        <tr>
            <th>بيانات الطلب</th>
            <td>
                النوع: {{ $order->order_type == 'store_order' ? 'طلب من متجر' : 'طلب خاص / منوع' }}<br>
                @if($order->order_type == 'store_order' && $order->store)
                المتجر: {{ $order->store->name }}<br>
                @elseif($order->order_type == 'custom_order')
                الاستلام من: {{ $order->pickup_address }}<br>
                @endif
                كود التتبع: <span dir="ltr">{{ $order->tracking_code }}</span>
            </td>
        </tr>
        <tr>
            <th>الطلبات والملاحظات</th>
            <td style="white-space: pre-line;">{{ $order->notes }}</td>
        </tr>
        <tr>
            <th>تفاصيل الحساب</th>
            <td>
                قيمة الطلب: {{ number_format($order->items_total, 2) }} ج.م<br>
                مصاريف الشحن: {{ number_format($order->delivery_fee, 2) }} ج.م<br>
                <strong>الإجمالي المطلوب: {{ number_format($order->total_amount, 2) }} ج.م</strong>
            </td>
        </tr>
        @if($order->driver)
        <tr>
            <th>بيانات المندوب</th>
            <td>الاسم: {{ $order->driver->name }} ({{ $order->driver->phone }})</td>
        </tr>
        @endif
    </table>

    <div style="margin-top: 40px; text-align: center; font-size: 14px;">
        <p>شكرًا لاختيارك علي الباب... كل طلباتك لحد باب بيتك</p>
    </div>
</div>

@endsection
