<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>فاتورة الطلب #{{ $order->id }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f3f4f6;
            margin: 0;
            padding: 20px;
            color: #000;
        }

        .invoice-container {
            max-width: 800px;
            margin: 0 auto;
            background: #fff;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .header {
            text-align: center;
            border-bottom: 2px solid #000;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }

        .header h1 {
            margin: 0 0 10px 0;
            font-size: 28px;
        }

        .header p {
            margin: 5px 0;
            font-size: 16px;
            color: #555;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 12px 15px;
            text-align: right;
            font-size: 16px;
        }

        th {
            background-color: #f8f9fa;
            width: 30%;
            font-weight: bold;
        }

        .total-row th, .total-row td {
            background-color: #f8f9fa;
            font-size: 18px;
            font-weight: bold;
            border-top: 2px solid #000;
        }

        .footer {
            text-align: center;
            margin-top: 40px;
            font-size: 14px;
            color: #777;
            border-top: 1px solid #ddd;
            padding-top: 20px;
        }

        /* Print Specific Styles */
        @media print {
            body {
                background-color: #fff;
                padding: 0;
            }
            .invoice-container {
                box-shadow: none;
                padding: 0;
                margin: 0;
                width: 100%;
                max-width: 100%;
            }
            th {
                background-color: #eee !important;
                -webkit-print-color-adjust: exact;
            }
            .total-row th, .total-row td {
                background-color: #eee !important;
                -webkit-print-color-adjust: exact;
            }
            .no-print {
                display: none !important;
            }
        }
        
        .print-btn {
            display: block;
            width: 200px;
            margin: 0 auto 30px auto;
            padding: 12px 20px;
            background-color: #0B1536;
            color: #fff;
            text-align: center;
            text-decoration: none;
            font-size: 18px;
            font-weight: bold;
            border-radius: 8px;
            cursor: pointer;
            border: none;
        }
        .print-btn:hover {
            background-color: #1a295c;
        }
    </style>
</head>
<body>

    <button onclick="window.print()" class="print-btn no-print">طباعة الفاتورة 🖨️</button>

    <div class="invoice-container">
        <div class="header">
            <h1>فاتورة طلب - علي الباب</h1>
            <p><strong>رقم الطلب:</strong> #{{ $order->id }}</p>
            <p><strong>تاريخ الطلب:</strong> <span dir="ltr">{{ $order->created_at->format('Y-m-d h:i A') }}</span></p>
        </div>

        <table>
            <tr>
                <th>بيانات العميل</th>
                <td>
                    <strong>الاسم:</strong> {{ $order->customer->name ?? 'غير متوفر' }}<br>
                    <strong>الهاتف:</strong> <span dir="ltr">{{ $order->customer->phone ?? 'غير متوفر' }}</span><br>
                    <strong>عنوان التوصيل:</strong> {{ $order->dropoff_address }}
                </td>
            </tr>
            <tr>
                <th>بيانات الطلب</th>
                <td>
                    <strong>النوع:</strong> {{ $order->order_type == 'store_order' ? 'طلب من متجر' : 'طلب خاص / منوع' }}<br>
                    @if($order->order_type == 'store_order' && $order->store)
                        <strong>المتجر:</strong> {{ $order->store->name }}<br>
                    @elseif($order->order_type == 'custom_order')
                        <strong>الاستلام من:</strong> {{ $order->pickup_address }}<br>
                    @endif
                    <strong>كود التتبع:</strong> <span dir="ltr">{{ $order->tracking_code }}</span>
                </td>
            </tr>
            <tr>
                <th>الطلبات والملاحظات</th>
                <td style="white-space: pre-line;">{{ $order->notes ?? 'لا يوجد' }}</td>
            </tr>
            <tr>
                <th>بيانات الحساب</th>
                <td>
                    ثمن المشتريات: {{ number_format($order->items_total, 2) }} ج.م<br>
                    رسوم التوصيل: {{ number_format($order->delivery_fee, 2) }} ج.م
                </td>
            </tr>
            <tr class="total-row">
                <th>المبلغ المطلوب تحصيله</th>
                <td>{{ number_format($order->total_amount, 2) }} ج.م</td>
            </tr>
            <tr>
                <th>بيانات المندوب</th>
                <td>
                    <strong>الاسم:</strong> {{ $order->driver->name }}<br>
                    <strong>رقم الهاتف:</strong> <span dir="ltr">{{ $order->driver->phone }}</span>
                </td>
            </tr>
        </table>

        <div class="footer">
            <p>شكرًا لاختيارك علي الباب... كل طلباتك لحد باب بيتك 🚚</p>
            <p>تم إصدار هذه الفاتورة بواسطة المندوب.</p>
        </div>
    </div>

    <!-- Auto print when page loads -->
    <script>
        window.onload = function() {
            setTimeout(function() {
                window.print();
            }, 500);
        }
    </script>
</body>
</html>
