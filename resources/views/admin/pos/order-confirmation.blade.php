<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="shortcut icon" type="image/png" href="https://nebulaitbd.com/frontend/assets/images/favicon.png">
    <title>MyApp</title>
    <meta name="description" content="MyApp is a leading platform for business solutions.">
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

        .company-info h6, p {
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
    </style>
</head>

<body>

    <div style="max-width:290px;margin:0 auto">
        <div class="hidden-print">
            <table>
                <tr>
                    <td><a href="{{ route('pos') }}" class="btn btn-info"><i class="fa fa-arrow-left"></i>Back</a> </td>
                    <td><button onclick="window.print();" class="btn btn-primary"><i
                                class="dripicons-print"></i>Print</button></td>
                </tr>
            </table>
            <br>
        </div>

        <div id="receipt-data">
            <div class="main-wrapper">
                <!-- Receipt Section -->
                <table align="center" class="mt-4" id="print-receipt"
                    style="max-width: 400px; width: 100%;  padding: 20px; border-radius: 8px; font-size: 14px;">
                    <tr>
                        <td align="center" colspan="4">
                            <img src="https://nebulaitbd.com/frontend/assets/images/logo.png" alt="Receipt Logo"
                                width="150" style="margin:0;">
                        </td>
                    </tr>
                    <tr>
                        <td align="center" colspan="4" class="company-info">
                            <h6 class="">Nebula IT BD.</h6>
                            <p>Phone: +8801886927829<br>Email: <a style="color: #222; text-decoration: none;"
                                    href="mailto:nebulaitd@gmail.com">nebulaitd@gmail.com</a>
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4" align="center"
                            style="border-top: 1px solid #ddd; border-bottom: 1px solid #ddd; background-color: #f8f9fa;">
                            <strong>Tax Invoice</strong>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4"><strong>Customer Name:</strong> {{ $order->customer_name }}</td>
                    </tr>
                    <tr>
                        <td colspan="4"><strong>Invoice No:</strong> {{ $order->order_number }}</td>
                    </tr>
                    <tr>
                           <td colspan="2"><strong>Date:</strong> {{ date('d-m-Y', strtotime($order->created_at)) }}</td>
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
                        <td>{{ $key + 1 }}. {{ $item->menuItem->name ?? null }}</td>
                        <td style="text-align: center;">$50</td>
                        <td>{{ $item->quantity }}</td>
                        <td style="text-align: right;">${{ $item->quantity * $item->price }}</td>
                    </tr>  
                    @endforeach
                    
                    {{-- <tr>
                        <td>2. iPhone 14</td>
                        <td style="text-align: center;">$50</td>
                        <td>2</td>
                        <td style="text-align: right;">$100</td>
                    </tr>
                    <tr>
                        <td>3. Apple Series</td>
                        <td style="text-align: center;">$50</td>
                        <td>3</td>
                        <td style="text-align: right;">$150</td>
                    </tr> --}}

                    <!-- Totals -->
                    <tr>
                        <td colspan="3"><strong>Sub Total:</strong></td>
                        <td style="text-align: right;">${{ $order->sub_total }}</td>
                    </tr>
                    <tr>
                        <td colspan="3"><strong>Discount:</strong></td>
                        <td style="text-align: right; color: red;">-${{ $order->discount }}</td>
                    </tr>
                    <tr>
                        <td colspan="3"><strong>Tax (0%):</strong></td>
                        <td style="text-align: right;">$0.00</td>
                    </tr>
                    <tr>
                        <td colspan="3"><strong>Total Bill:</strong></td>
                        <td style="text-align: right;">${{ $order->total }}</td>
                    </tr>
                    <tr>
                        <td colspan="3"><strong>Due:</strong></td>
                        <td style="text-align: right;">$0.00</td>
                    </tr>
                    <tr style="font-weight: bold; color: #0d6efd;">
                        <td colspan="3"><strong>Total Payable:</strong></td>
                        <td style="text-align: right;"><strong>${{ $order->total }}</strong></td>
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
                            <p>Developed By Nebula IT</p>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        localStorage.clear();
    function auto_print() {
        window.print();
    }
    //setTimeout(auto_print, 1000);
    </script>

</body>

</html>