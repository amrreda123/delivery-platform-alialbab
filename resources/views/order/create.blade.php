@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-6 py-12">
    <div class="bg-white rounded-[30px] shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-gray-100 p-8 md:p-12" data-aos="fade-up">
        
        <div class="text-center mb-10">
            <span class="inline-block text-xs font-bold tracking-[0.2em] text-[#FFC107] uppercase mb-3">طلب جديد</span>
            <h2 class="text-3xl font-black text-[#0B1536] mb-4">قسم {{ $category->name }}</h2>
            <p class="text-gray-500 text-base max-w-lg mx-auto">
                اطلب كل ما تحتاجه وسنقوم بتوصيله لباب بيتك في أسرع وقت.
            </p>
        </div>

        @if ($errors->any())
            <div class="bg-red-50 text-red-600 p-4 rounded-xl mb-8 border border-red-100">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('order.store', $category->id) }}" method="POST" class="space-y-6">
            @csrf

            <!-- Personal Info -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-bold text-[#0B1536] mb-2">الاسم</label>
                    <input type="text" name="customer_name" value="{{ old('customer_name') }}" required
                           class="w-full bg-gray-50 border border-gray-200 text-gray-900 rounded-xl px-4 py-3 focus:ring-2 focus:ring-[#FFC107] focus:border-transparent transition-all outline-none"
                           placeholder="اكتب اسمك الكامل">
                </div>
                <div>
                    <label class="block text-sm font-bold text-[#0B1536] mb-2">رقم الهاتف</label>
                    <input type="text" name="customer_phone" value="{{ old('customer_phone') }}" required
                           class="w-full bg-gray-50 border border-gray-200 text-gray-900 rounded-xl px-4 py-3 focus:ring-2 focus:ring-[#FFC107] focus:border-transparent transition-all outline-none"
                           placeholder="رقم للتواصل (مثال: 010...)">
                </div>
            </div>

            <!-- Store Selection -->
            <div>
                <label class="block text-sm font-bold text-[#0B1536] mb-2">اختر المتجر</label>
                <select name="store_id" id="store_id"
                        class="w-full bg-gray-50 border border-gray-200 text-gray-900 rounded-xl px-4 py-3 focus:ring-2 focus:ring-[#FFC107] focus:border-transparent transition-all outline-none">
                    <option value="">-- اختر من القائمة --</option>
                    @foreach($stores as $store)
                        <option value="{{ $store->id }}" {{ old('store_id') == $store->id ? 'selected' : '' }}>
                            {{ $store->name }}
                        </option>
                    @endforeach
                    <option value="other" {{ old('store_id') == 'other' ? 'selected' : '' }}>متجر آخر (اكتب العنوان بنفسك)</option>
                </select>
            </div>

            <!-- Custom Store Address -->
            <div id="custom_store_address" class="hidden transition-all duration-300">
                <label class="block text-sm font-bold text-[#0B1536] mb-2">اسم المتجر وعنوانه</label>
                <input type="text" name="pickup_address" value="{{ old('pickup_address') }}"
                       class="w-full bg-white border border-yellow-300 text-gray-900 rounded-xl px-4 py-3 focus:ring-2 focus:ring-[#FFC107] focus:border-transparent transition-all outline-none"
                       placeholder="مثال: مطعم سيتي كريب - شارع المحطة">
            </div>

            <!-- Order Details -->
            <div>
                <label class="block text-sm font-bold text-[#0B1536] mb-2">الطلبات والملاحظات</label>
                <textarea name="notes" rows="4" required
                          class="w-full bg-gray-50 border border-gray-200 text-gray-900 rounded-xl px-4 py-3 focus:ring-2 focus:ring-[#FFC107] focus:border-transparent transition-all outline-none"
                          placeholder="اكتب طلبك بالتفصيل..."></textarea>
            </div>

            <!-- Delivery Area Selection -->
            <div>
                <label class="block text-sm font-bold text-[#0B1536] mb-2">منطقة التوصيل</label>
                <select name="delivery_area_id" id="delivery_area_id"
                        class="w-full bg-gray-50 border border-gray-200 text-gray-900 rounded-xl px-4 py-3 focus:ring-2 focus:ring-[#FFC107] focus:border-transparent transition-all outline-none">
                    <option value="">-- اختر منطقتك --</option>
                    @foreach($deliveryAreas as $area)
                        <option value="{{ $area->id }}" {{ old('delivery_area_id') == $area->id ? 'selected' : '' }}>
                            {{ $area->name }}
                        </option>
                    @endforeach
                    <option value="other" {{ old('delivery_area_id') == 'other' ? 'selected' : '' }}>منطقة أخرى (سأكتب العنوان بالكامل)</option>
                </select>
            </div>

            <!-- Detailed Delivery Address -->
            <div>
                <label class="block text-sm font-bold text-[#0B1536] mb-2" id="detailed_address_label">تفاصيل العنوان (الشارع، العمارة، الشقة)</label>
                <input type="text" name="dropoff_address" id="dropoff_address" value="{{ old('dropoff_address') }}" required
                       class="w-full bg-gray-50 border border-gray-200 text-gray-900 rounded-xl px-4 py-3 focus:ring-2 focus:ring-[#FFC107] focus:border-transparent transition-all outline-none"
                       placeholder="اكتب تفاصيل عنوانك...">
            </div>

            <div class="pt-4">
                <button type="submit"
                        class="w-full bg-[#FFC107] text-[#0B1536] font-bold text-lg rounded-xl px-8 py-4 shadow-lg hover:shadow-xl hover:-translate-y-1 hover:bg-yellow-500 transition-all duration-300 flex items-center justify-center gap-2">
                    تأكيد الطلب
                    <svg class="w-6 h-6 rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                    </svg>
                </button>
            </div>
        </form>

    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const storeSelect = document.getElementById('store_id');
        const customStoreAddress = document.getElementById('custom_store_address');
        const pickupInput = customStoreAddress.querySelector('input');

        function toggleCustomAddress() {
            if (storeSelect.value === 'other') {
                customStoreAddress.classList.remove('hidden');
                storeSelect.name = ''; // Don't send 'other' as store_id
                pickupInput.required = true;
            } else {
                customStoreAddress.classList.add('hidden');
                storeSelect.name = 'store_id';
                pickupInput.required = false;
                if(storeSelect.value === '') {
                    storeSelect.name = ''; 
                }
            }
        }

        storeSelect.addEventListener('change', toggleCustomAddress);
        toggleCustomAddress();

        // Delivery Area Logic
        const deliveryAreaSelect = document.getElementById('delivery_area_id');
        const detailedAddressLabel = document.getElementById('detailed_address_label');
        const dropoffAddressInput = document.getElementById('dropoff_address');

        function toggleDeliveryArea() {
            if (deliveryAreaSelect.value === 'other' || deliveryAreaSelect.value === '') {
                detailedAddressLabel.textContent = 'عنوان التوصيل بالكامل (المنطقة، الشارع، العمارة، الشقة)';
                dropoffAddressInput.placeholder = 'اكتب عنوانك بالتفصيل...';
            } else {
                const selectedText = deliveryAreaSelect.options[deliveryAreaSelect.selectedIndex].text;
                detailedAddressLabel.textContent = 'تفاصيل العنوان داخل ' + selectedText + ' (الشارع، العمارة، الشقة)';
                dropoffAddressInput.placeholder = 'اكتب الشارع، العمارة، الشقة...';
            }
        }

        deliveryAreaSelect.addEventListener('change', toggleDeliveryArea);
        toggleDeliveryArea();
    });
</script>
@endpush
@endsection
