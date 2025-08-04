@extends('admin.layouts.app')
@section('title', 'Order Details Page')
@push('styles')

    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            background: #f1f1f1;
        }

        .memo-container {
            background: #fff;
            width: 900px;
            margin: 30px auto;
            padding: 20px;
            border: 2px solid #ccc;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 30px;
            border-bottom: 3px solid #0a4a8e;
            min-height: 80px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
            color: #0a4a8e;
            font-family: 'Segoe UI', sans-serif;
            flex-wrap: wrap;
            /* For responsiveness */
            gap: 10px;
            position: relative;
        }

        .top-short-cash-memo {
            position: absolute;
            top: 0;
            left: 0;
            background-color: #445EAB;
            color: #fff;
            padding: 5px 10px;
            font-size: 14px;
        }


        .header-address {
            background-color: #0154A6;
            color: #fff;
            /* padding: 3px 0; */
            text-align: center;
            font-size: 14px;
        }

        .header-address p {
            margin-bottom: 0;
            padding: 5px 0;
        }

        .header-left {
            width: 50%;
        }

        .header-left img {
            height: 100px;
        }

        .header-center {
            /* background-color: #ddd; */
            width: 30%;
        }

        .header-center h1 {
            color: #d80000;
            font-size: 28px;
            margin: 0;
        }

        .owner-header {
            background-color: #064E38;
            padding: 8px 50px;
            text-align: center;
            margin-bottom: 5px;
        }

        .owner-header {
            color: #fff;
            font-size: 17px;
        }

        .header-center p {
            font-size: 14px;
            margin: 2px 0;
            color: #003366;
        }

        .owners {
            font-size: 13px;
        }

        .single-owner {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            color: #000;
            background-color: #ddd;
            margin-bottom: 5px;
            padding: 5px 10px;
        }

        .single-owner:nth-child(1) {
            background: linear-gradient(135deg, #CDC5DB, #fff);
        }

        .single-owner:nth-child(2) {
            background: linear-gradient(135deg, #D4B34E, #fff);
        }

        .single-owner:nth-child(3) {
            background: linear-gradient(135deg, #80B65E, #fff);
        }

        .single-owner ul {
            margin: 0;
            padding: 0;
            list-style: none;
        }

        .info {
            display: flex;
            justify-content: space-between;
            margin-top: 15px;
            font-size: 15px;
            font-weight: bold;
        }

        .date-wrapper {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 16px;
            font-weight: bold;
        }

        .date-wrapper span {
            margin-right: 10px;
            color: #333;
        }

        .date-box {
            width: 60px;
            height: 35px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 6px;
            color: white;
            font-weight: bold;
        }

        .date-box:nth-child(2) {
            background: linear-gradient(135deg, #ff9a9e, #fad0c4);
            /* Date - pink */
        }

        .date-box:nth-child(3) {
            background: linear-gradient(135deg, #a1c4fd, #c2e9fb);
            /* Month - blue */
        }

        .date-box:nth-child(4) {
            background: linear-gradient(135deg, #d4fc79, #96e6a1);
            /* Year - green */
        }

        .name-address {
            max-width: 100%;
            margin: auto;
            margin-top: 10px;
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .name-address div {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .name-address button {
            border: none;
            color: white;
            font-weight: bold;
            padding: 9px 16px;
            border-radius: 3px;
            cursor: default;
            min-width: 80px;
            text-align: left;
        }

        /* Button colors */
        .name-address div:nth-child(1) button {
            background-color: #0181D0;
            /* Blue */
        }

        .name-address div:nth-child(2) button {
            background-color: #007958;
            /* Green */
        }

        .name-address input {
            flex: 1;
            padding: 10px 15px;
            border: none;
            border-radius: 3px;
            font-size: 14px;
            color: #333;
        }

        /* Input gradients */
        .name-address div:nth-child(1) input {
            background: linear-gradient(135deg, #79C7EE, #ffffff);
            /* Blue to white */
        }

        .name-address div:nth-child(2) input {
            background: linear-gradient(135deg, #ABD3B0, #ffffff);
            /* Green to white */
        }

        /* Optional: add subtle box-shadow */
        .name-address input:focus {
            outline: none;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.4);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            font-size: 14px;
        }

        table,
        th,
        td {
            border: 1px solid #777;
        }

        th {
            background: #cfe2f3;
        }

        thead th:nth-child(1) {
            background: linear-gradient(135deg, #DCA85D, #cea469);
        }

        thead th:nth-child(2) {
            background: linear-gradient(135deg, #DAAB65, #edeaee);
        }

        thead th:nth-child(3) {
            background: linear-gradient(135deg, #6ec3ee, #e9f5fa);
        }

        thead th:nth-child(4) {
            background: linear-gradient(135deg, #6ec3ee, #92c6e0);
        }

        thead th:nth-child(5) {
            background: linear-gradient(135deg, #7DA753, rgb(140, 192, 147));
        }

        th,
        td {
            padding: 6px 8px;
            text-align: center;
        }

        .first-td {
            color: #000;
            font-weight: bold;
        }


        .totals {
            margin-top: 20px;
            text-align: right;
            font-size: 16px;
            font-weight: bold;
        }

        .footer {
            margin-top: 20px;
            text-align: center;
            font-size: 13px;
            color: #555;
        }

        .footer img {
            height: 18px;
            vertical-align: middle;
        }

        /* ====== */
        .summary-row td {
            background: #f9f9f9;
            font-weight: bold;
        }

        .no-border {
            border: none !important;
            background: transparent !important;
        }

        .text-right {
            text-align: right;
        }

        .table-bottom-data {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-top: 20px;
            padding: 10px 0;
            font-family: 'Segoe UI', sans-serif;
            font-size: 14px;
            color: #333;
            /* border-top: 1px solid #ccc; */
        }

        .bottom-address {
            display: flex;
            flex-direction: column;
            gap: 8px;
            margin-top: 15px;
        }

        .bottom-address div {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .bottom-address span {
            font-size: 14px;
            color: #333;
        }

        .signature-marco {
            text-align: center;
            font-size: 13px;
            margin-top: 40px;
        }

        .signature-marco p {
            margin: 0;
            padding: 0;
            font-family: monospace;
            letter-spacing: 2px;
            color: #666;
        }

        .signature-marco h4 {
            margin-top: 5px;
            font-size: 14px;
            font-weight: normal;
        }
    </style>

    <style>
        /* your existing CSS... */

        @media print {
            body {
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
            }

            * {
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
            }

            .header {
                background: url('{{ asset('backend/assets/images/white-waves.jpg') }}') no-repeat center !important;
                background-size: cover !important;
            }

            .top-short-cash-memo {
                background-color: #445EAB !important;
                color: #fff !important;
            }

            /* Optional: hide buttons like Print */
            .btn {
                display: none !important;
            }
            i.fas, i.fab, i.fa {
                font-family: 'Font Awesome 6 Free' !important;
                font-weight: 900 !important;
                visibility: visible !important;
                display: inline-block !important;
            }

            /* Ensure page doesn't hide icons via transform or effects */
            .fa, .fas, .fab {
                text-rendering: auto;
                -webkit-font-smoothing: antialiased;
            }
        }
    </style>


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

@endpush

@section('admin_content')

<div class="container-fluid">
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 mt-4">

            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4>Order Information</h4>
                    <button class="btn btn-primary" onclick="printInvoice()">Print Invoice</button>
                </div>
                <div class="card-body" id="invoice">
                    <div class="memo-container">
                        <div class="header" style="background: url({{ asset('backend/assets/images/white-waves.jpg') }}) no-repeat center;
                            background-size: cover;">
                            <div class="top-short-cash-memo">
                                <span>ক্যাশ মেমো </span>
                            </div>
                            <div class="header-left">
                                <img src="{{ asset($website_setting->website_logo) }}" alt="Marco Logo" />
                            </div>
                            <div class="header-center">
                                <div class="owner-name-header">
                                    <h3 class="owner-header">Owners</h3>
                                </div>
                                <div class="owners">
                                    <div class="single-owner">
                                        <span><strong>Sorif Islam</strong> </span>
                                        <ul>
                                            <li>📞 01616 853902</li>
                                        </ul>
                                    </div>
                                    <div class="single-owner">
                                        <span><strong>Saroar Hossain</strong></span>
                                        <ul>
                                            <li>📞 01711 657743</li>
                                        </ul>
                                    </div>
                                    <div class="single-owner">
                                        <span><strong>Milon Talukdher</strong></span>
                                        <ul>
                                            <li>📞 01744 257246</li>
                                        </ul>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="header-address">
                            <p>{{ $website_setting->address }}</p>
                        </div>

                        <div class="info">
                            <div>ক্রমিক নং: <strong>{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}</strong></div>
                            @php
                                $date = now(); // or use $order->created_at if you're showing order date
                            @endphp

                            <div class="date-wrapper">
                                <span>তারিখ:</span>
                                <div class="date-box">{{ $date->format('d') }}</div> {{-- Day --}}
                                <div class="date-box">{{ $date->format('m') }}</div> {{-- Month --}}
                                <div class="date-box">{{ $date->format('Y') }}</div> {{-- Year --}}
                            </div>

                        </div>
                        <div class="name-address">
                            <div>
                                <button>নাম:</button>
                                <input type="text" style="font-weight: bold" value="{{ $order->name }}" placeholder="আপনার নাম লিখুন">
                            </div>
                            <div>
                                <button>ঠিকানা:</button>
                                <input type="text" style="font-weight: bold" value="{{ $order->address }}" placeholder="আপনার ঠিকানা লিখুন">
                            </div>
                        </div>

                        <table>
                            <thead>
                            <tr>
                                <th>ক্রঃ নং</th>
                                <th>বিবরণ</th>
                                <th>পরিমাণ</th>
                                <th>দর</th>
                                <th>টাকা</th>
                            </tr>
                            </thead>

                            @php
                                $subtotal = 0;
                            @endphp

                            <tbody id="data-table">

                            @foreach ($order->orderItems as $key => $orderItem)
                                @php
                                    $total = $orderItem->price * $orderItem->quantity;
                                    $subtotal += $total;
                                @endphp

                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td style="text-align: left">{{ $orderItem->product->product_name }}</td>
                                <td>{{ $orderItem->quantity }}</td>
                                <td>{{ number_format($orderItem->price, 2) }}</td>
                                <td>{{ number_format($orderItem->quantity * $orderItem->price, 2) }}</td>
                            </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <!-- Left Side: Payment Info -->
                                <td colspan="3"
                                    style="text-align: left; font-size: 14px; padding: 16px 10px 12px 30px; vertical-align: top;">

                                    <!-- Empty space above -->
                                    <div style="height: 10px;"></div>

                                    <!-- First line: Label + long dashed line -->
                                    <div
                                        style="font-style: italic; font-size: 13px; color: #333; display: flex; align-items: center; line-height: 1.4;">
                                        <span style="white-space: nowrap;"></span>
                                        <p style="margin: 0;">
                                            <strong>টাকা (কথায়):</strong> {{ convertNumberToBanglaWords($subtotal) }} ।
                                        </p>
                                    </div>

                                </td>



                                <td colspan="3" style="padding: 0; vertical-align: top; line-height: 1;">
                                    <table style="
                                                    width: 100%;
                                                    font-size: 14px;
                                                    border-collapse: collapse;
                                                    border-spacing: 0;
                                                    margin: 0;
                                                    padding: 0;
                                                    border: none;
                                                ">
                                        <tbody>
                                        <tr
                                            style="border-bottom: 1px solid #ccc; background: linear-gradient(90deg, #f0f4ff, #639146);">
                                            <td style="
                                                        padding: 5px 8px;
                                                        margin: 0;
                                                        line-height: 1.2;
                                                        vertical-align: top;
                                                        border: none;
                                                        border-right: 1px solid #777;
                                                        font-weight: bold;
                                                        text-align: left;
                                                    ">মোট:
                                            </td>
                                            <td style="
                                                        padding: 5px 8px;
                                                        margin: 0;
                                                        text-align: right;
                                                        line-height: 1.2;
                                                        vertical-align: top;
                                                        border: none;
                                                    "><strong>{{ number_format($subtotal, 2)}}</strong>
                                            </td>
                                        </tr>
                                        <tr
                                            style="border-bottom: 1px solid #ccc; background: linear-gradient(90deg, #6685BC, #c7d7ff);">
                                            <td style="
                                                        padding: 5px 8px;
                                                        margin: 0;
                                                        vertical-align: top;
                                                        border: none;
                                                        border-right: 1px solid #777;
                                                        font-weight: bold;
                                                        width: 45%;
                                                        text-align: left;
                                                    ">অগ্রিম:
                                            </td>
                                            <td style="
                                                        padding: 5px 8px;
                                                        margin: 0;
                                                        text-align: right;
                                                        vertical-align: top;
                                                        border: none;
                                                    "><strong>0.00</strong>
                                            </td>
                                        </tr>
                                        <tr style="background: linear-gradient(90deg, #f0f4ff, #AA9BA0);">
                                            <td style="
                                                        padding: 5px 8px;
                                                        margin: 0;
                                                        vertical-align: top;
                                                        border: none;
                                                        border-right: 1px solid #777;
                                                        font-weight: bold;
                                                        text-align: left;
                                                    ">বাকি:
                                            </td>
                                            <td style="
                                                        padding: 5px 8px;
                                                        margin: 0;
                                                        text-align: right;
                                                        vertical-align: top;
                                                        border: none;
                                                    "><strong>{{ number_format($order->total_price, 2) }}</strong>
                                            </td>
                                        </tr>
                                        </tbody>

                                    </table>
                                </td>
                            </tr>
                            </tfoot>
                        </table>
                        <div class="table-bottom-data">
                            <div class="bottom-address">
                                <div>
                                    <i class="fab fa-whatsapp" style="color: #25D366;"></i>
                                    <span>01616 853902</span>
                                </div>
                                <div>
                                    <i class="fas fa-envelope" style="color: #EA4335;"></i>
                                    <span>marcofootwearbd@gmail.com</span>
                                </div>
                                <div>
                                    <i class="fab fa-facebook" style="color: #1877F2;"></i>
                                    <span>Marco Footwear</span>
                                </div>
                            </div>
                            <div class="signature-marco">
                                <p>---------------------------</p>
                                <h4>পক্ষে - মারকো ফুটওয়্যার</h4>
                            </div>
                        </div>



                        <div class="footer" style="background-color: #C65D86; text-align: center; color:#fff; padding:8px 0">
                            <p style="color:#fff; margin-bottom: 0px; margin-top: 0px;">ধন্যবাদ আবার আসবেন ।</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>


@endsection

@push('scripts')

    <script>
        function printInvoice() {
            const invoiceContent = document.getElementById('invoice').innerHTML;

            // Get inline styles from the page
            const inlineStyles = Array.from(document.querySelectorAll('style'))
                .map(style => style.outerHTML)
                .join('\n');

            const printWindow = window.open('', '', 'width=1000,height=800');
            printWindow.document.write('<html><head><title>Invoice</title>');
            printWindow.document.write(inlineStyles); // Inject your page's CSS
            printWindow.document.write('</head><body>');
            printWindow.document.write(invoiceContent);
            printWindow.document.write('</body></html>');
            printWindow.document.close();

            printWindow.focus();

            // Delay to allow rendering before print
            setTimeout(() => {
                printWindow.print();
                printWindow.close();
            }, 500);
        }
    </script>



    <script>
    function hexToRgb(hex) {
        const bigint = parseInt(hex.replace("#", ""), 16);
        return {
            r: (bigint >> 16) & 255,
            g: (bigint >> 8) & 255,
            b: bigint & 255
        };
    }

    function rgbToHex({ r, g, b }) {
        return "#" + [r, g, b].map(x =>
            x.toString(16).padStart(2, "0")
        ).join("");
    }

    function interpolateColor(color1, color2, factor) {
        const c1 = hexToRgb(color1);
        const c2 = hexToRgb(color2);
        const result = {
            r: Math.round(c1.r + factor * (c2.r - c1.r)),
            g: Math.round(c1.g + factor * (c2.g - c1.g)),
            b: Math.round(c1.b + factor * (c2.b - c1.b))
        };
        return rgbToHex(result);
    }

    const table = document.getElementById("data-table");
    const rows = Array.from(table.querySelectorAll("tr"));

    // Define different color pairs for each column (startColor, endColor)
    const columnGradients = [
        ["#FFD3B6", "#FFAAA5"], // Column 0: peach to light red
        ["#D0E6A5", "#86E3CE"], // Column 1: light green to aqua
        ["#FFFFFF", "#419CD1"], // Column 2: mint to light lime
        ["#AFCBFF", "#FFFFFF"], // Column 3: sky blue tones
        ["#FFECB3", "#FFE0B2"]  // Column 4: light yellow/orange
    ];

    const totalRows = rows.length;

    rows.forEach((row, rowIndex) => {
        const tds = row.querySelectorAll("td");
        tds.forEach((td, colIndex) => {
            if (columnGradients[colIndex]) {
                const [startColor, endColor] = columnGradients[colIndex];
                const factor = rowIndex / (totalRows - 1 || 1); // scale gradient by row
                const bgColor = interpolateColor(startColor, endColor, factor);
                td.style.background = bgColor;
            }
        });
    });
</script>


@endpush
