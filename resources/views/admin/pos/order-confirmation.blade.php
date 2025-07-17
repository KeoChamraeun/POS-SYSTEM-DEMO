<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="shortcut icon" type="image/png" href="https://nebulaitbd.com/frontend/assets/images/favicon.png">
    <title>RAEUN IT POS</title>
    <meta name="description"
        content="RAEUN IT POS - Streamline your sales, inventory, and billing with our powerful, easy-to-use point of sale system for businesses of all sizes.">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="index, follow">

    <style type="text/css">
        * {
            font-size: 14px;
            line-height: 24px;
            font-family: 'Ubuntu', sans-serif;
            text-transform: capitalize;
        }

        .btn {
            padding: 7px 10px;
            text-decoration: none;
            border: none;
            display: block;
            text-align: center;
            margin: 7px;
            cursor: pointer;
        }

        .btn-info {
            background-color: #999;
            color: #FFF;
        }

        .btn-primary {
            background-color: #6449e7;
            color: #FFF;
            width: 100%;
        }

        td,
        th,
        tr,
        table {
            border-collapse: collapse;
        }

        tr {
            border-bottom: 1px dotted #ddd;
        }

        td,
        th {
            padding: 7px 0;
            width: 50%;
        }

        table {
            width: 100%;
        }

        tfoot tr th:first-child {
            text-align: left;
        }

        .centered {
            text-align: center;
            align-content: center;
        }

        .company-info h6,
        p {
            margin: 5px 0 !important;
        }

        small {
            font-size: 11px;
        }

        @media print {
            * {
                font-size: 12px;
                line-height: 20px;
            }

            td,
            th {
                padding: 5px 0;
            }

            .hidden-print {
                display: none !important;
            }

            @page {
                margin: 1.5cm 0.5cm 0.5cm;
            }

            @page: first {
                margin-top: 0.5cm;
            }
        }

        .receipt-container {
            position: relative;
        }

        .receipt-container::before {
            content: "PAID";
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) rotate(-45deg);
            font-size: 48px;
            font-weight: bold;
            color: rgba(179, 180, 179, 0.15);
            pointer-events: none;
            white-space: nowrap;
            z-index: 10;
        }

        .receipt-container::before {
            display: none;
        }

        @media print {
            .receipt-container::before {
                display: block;
            }
        }
    </style>
</head>

<body>

    <div style="max-width:290px;margin:0 auto">
        <div class="hidden-print">
            <table>
                <tr>
                    <td><a href="{{ route('pos') }}" class="btn btn-info"><i class="fa fa-arrow-left"></i>Back to
                            POS</a> </td>
                    <td><button onclick="window.print();" class="btn btn-primary"><i
                                class="dripicons-print"></i>Print</button></td>
                </tr>
            </table>
            <br>
        </div>

        <div class="receipt-container">
            <div id="receipt-data">
                <div class="main-wrapper">
                    <!-- Receipt Section -->
                    <table align="center" class="mt-4" id="print-receipt"
                        style="max-width: 400px; width: 100%;  padding: 20px; border-radius: 8px; font-size: 14px;">
                        <tr>
                            <td align="center" colspan="4">
                                <img src="data:image/png;base64,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" alt="img">

                            </td>
                        </tr>
                        <tr>
                            <td align="center" colspan="4" class="company-info">
                                <h6 class="">RAEUN IT</h6>
                                <p>Phone: +855 886576689<br>Email: <a style="color: #222; text-transform: lowercase;"
                                        href="keochamraeun54@gmail.com">keochamraeun54@gmail.com</a>
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="4" align="center"
                                style="border-top: 1px solid #ddd; border-bottom: 1px solid #ddd; background-color: #f8f9fa;">
                                <strong>Order Invoice</strong>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="4"><strong>Customer Information:</strong> {{ $order->customer_name }}</td>
                        </tr>
                        <tr>
                            <td colspan="4"><strong>Invoice No:</strong> {{ $order->order_number }}</td>
                        </tr>
                        <tr>
                            <td colspan="2"><strong>Date:</strong>{{ \Carbon\Carbon::parse($order->created_at)->setTimezone('Asia/Phnom_Penh')->format('d-m-Y h:i A') }}</td>
                        </tr>

                        <!-- Items Header -->
                        <tr style="background-color: #f8f9fa;">
                            <th style="text-align: left;"># Item</th>
                            <th>Price</th>
                            <th>Qty</th>
                            <th style="text-align: right;">Total</th>
                        </tr>

                        <!-- Items -->
                        @foreach ($order->orderItems as $key => $item)
                        <tr>
                            <td>{{ $key + 1 }}. {{ $item->item_type == 'menu' ? $item->menu->name :
                                $item->menuItem->name }}</td>
                            <td style="text-align: center;">{{ site_settings()->currency }}{{ $item->price }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td style="text-align: right;">{{ site_settings()->currency }}{{ $item->quantity *
                                $item->price }}</td>
                        </tr>
                        @endforeach

                        <!-- Totals -->
                        <tr>
                            <td colspan="3"><strong>Sub Total:</strong></td>
                            <td style="text-align: right;">{{ site_settings()->currency }}{{ $order->sub_total }}</td>
                        </tr>
                        <tr>
                            <td colspan="3"><strong>Discount:</strong></td>
                            <td style="text-align: right; color: red;">-{{ site_settings()->currency }}{{
                                $order->discount }}</td>
                        </tr>
                        <tr>
                            <td colspan="3"><strong>VAT ({{ $order->vat / $order->sub_total * 100 }}%):</strong></td>
                            <td style="text-align: right;">{{ site_settings()->currency }}{{ $order->vat }}</td>
                        </tr>
                        <tr>
                            <td colspan="3"><strong>Total Bill:</strong></td>
                            <td style="text-align: right;">{{ site_settings()->currency }}{{ $order->total }}</td>
                        </tr>
                        <tr>
                            <td colspan="3"><strong>Payment :</strong></td>
                            <td style="text-align: right;">{{ $order->payment_method }}</td>
                        </tr>

                        <tr style="font-weight: bold; color: #0d6efd;">
                            <td colspan="3"><strong>Total Payable:</strong></td>
                            <td style="text-align: right;"><strong>{{ site_settings()->currency }}{{ $order->total
                                    }}</strong></td>
                        </tr>

                        <!-- Footer -->
                        <tr>
                            <td colspan="4"
                                style="border-top: 1px solid #ddd; border-bottom: 1px solid #ddd; text-align: center; padding: 10px 0;">
                                <p>**Thank you for shopping with us. Please come again</p>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="4" align="center">
                                <p>Developed By RAEUN IT</p>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

    </div>

    <script type="text/javascript">
        localStorage.clear();

        function auto_print() {
            window.print();
        }
    </script>

</body>

</html>