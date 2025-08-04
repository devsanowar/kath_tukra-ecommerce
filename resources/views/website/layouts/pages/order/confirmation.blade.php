@extends('website.layouts.app')

@section('body')
    <style>
        .confirmation-page {
            max-width: 600px;
            margin: 40px auto;
            padding: 30px;
            background: #f9fff9;
            border: 2px solid #cde0cd;
            text-align: center;
            border-radius: 10px;
            font-family: 'Segoe UI', sans-serif;
        }

        .tick-icon {
            font-size: 70px;
            color: #28a745;
            margin-bottom: 20px;
        }

        .message h2 {
            color: #28a745;
            margin-bottom: 10px;
        }

        .message p {
            color: #555;
            margin-bottom: 20px;
        }

        .button-group {
            margin-top: 40px;
            display: flex;
            justify-content: center;
            gap: 15px;
            flex-wrap: wrap;
        }

        .button-group a,
        .button-group button {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            font-weight: bold;
            text-decoration: none;
            color: #fff;
            background-color: #28a745;
            transition: background-color 0.3s;
            cursor: pointer;
        }

        .button-group a:hover,
        .button-group button:hover {
            background-color: #218838;
        }

        @media print {
            body * {
                visibility: hidden;
            }

            #printArea, #printArea * {
                visibility: visible;
            }

            #printArea {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
            }

            .button-group {
                display: none;
            }
        }
    </style>

    <style>
        @media print {
            body {
                margin: 0;
                padding: 0;
            }

            #printArea,
            .button-group {
                display: none !important;
            }

            #invoiceArea {
                display: block !important;
                width: 100% !important;
            }

            html, body {
                width: 100%;
                height: auto;
            }
            * {
                box-sizing: border-box;
            }
            html, body {
                margin: 0;
                padding: 0;
                width: 100%;
            }

            body, html {
                margin: 0;
                padding: 0;
            }

            #invoiceArea {
                page-break-inside: avoid;
                page-break-before: auto;
                page-break-after: auto;
            }

            .invoice-header {
                margin-top: 0;
                padding-top: 10px;
                /* Ensure no big margin/padding pushing it down */
            }
        }
    </style>

    <!-- ✅ Confirmation Area -->
    <div id="printArea" class="confirmation-page">
        <div class="tick-icon">✅</div>
        <div class="message">
            <h2>Order Confirmed!</h2>
            <p>Thank you <strong>{{ $order->name }}</strong>, your order (#{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}) has been successfully placed.</p>
            <p>Total Amount: <strong>{{ number_format($order->total_price, 2) }} ৳</strong></p>
            <p>We will contact you soon at <strong>{{ $order->phone }}</strong></p>
        </div>

        <div class="button-group">
            <button onclick="printInvoice()">🖨️ Print</button>
            <button onclick="downloadInvoice()">📄 Download</button>
            <a href="{{ route('shop') }}">🛒 Shop</a>
            <a href="{{ url('/') }}">🏠 Home</a>
        </div>
    </div>

    <div id="invoiceArea" style="width: 60%; display: none; max-width: 794px; padding: 40px; margin: 0 auto; background: white; box-sizing: border-box;">
        @include('website.layouts.inc.invoice')
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>

    <script>
        function downloadInvoice() {
            const original = document.getElementById('invoiceArea');

            // Clone the invoice content
            const clone = original.cloneNode(true);
            clone.id = 'invoice-download-clone';

            // Strict A4 size in px (794x1123 at 96dpi)
            Object.assign(clone.style, {
                width: '994px',
                minHeight: '1123px',
                padding: '40px',
                margin: '0',
                background: '#fff',
                boxSizing: 'border-box',
                display: 'block',
                position: 'relative',
                fontFamily: 'Arial, sans-serif',
                // overflow: 'hidden'
            });

            // Add clone to a full-screen hidden container
            const container = document.createElement('div');
            container.id = 'pdf-wrapper';
            Object.assign(container.style, {
                position: 'fixed',
                top: '0',
                left: '0',
                width: '100% !important',
                height: '100vh',
                background: '#fff',
                zIndex: '-9999',
                opacity: '0',
                // overflow: 'hidden',
                display: 'flex',
                justifyContent: 'center',
                alignItems: 'center'
            });

            container.appendChild(clone);
            document.body.appendChild(container);

            // PDF generation options
            const options = {
                margin: 0,
                filename: 'invoice.pdf',
                image: { type: 'jpg', quality: 1 },
                html2canvas: {
                    scale: 3,
                    useCORS: true,
                    scrollY: 0
                },
                jsPDF: {
                    unit: 'px',
                    format: [994, 1123], // Exact A4
                    orientation: 'portrait'
                }
            };

            // Generate and download
            html2pdf()
                .set(options)
                .from(clone)
                .save()
                .then(() => {
                    document.body.removeChild(container);
                });
        }
    </script>

    <script>
        function printInvoice() {
            const printContents = document.getElementById('invoiceArea').innerHTML;
            const originalContents = document.body.innerHTML;

            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
            location.reload(); // optional
        }
    </script>

@endsection
