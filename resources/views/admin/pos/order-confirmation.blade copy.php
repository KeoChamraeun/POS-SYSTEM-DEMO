<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" type="image/png" href="https://salepropos.com/demo/logo/20220905125905.png" />
    <title>SalePro</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">

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
                    <td><button onclick="window.print();" class="btn btn-primary"><i class="dripicons-print"></i>Print</button></td>
                </tr>
            </table>
            <br>
        </div>

        <div id="receipt-data">
            <div class="centered">
                <img src="https://nebulaitbd.com/frontend/assets/images/logo.png" alt="Logo" width="150"
                    style="margin:10px 0;">
                <h2>Nebula IT BD</h2>

                <p>Address: Mirpur 10
                <br>Phone Number: 01711-111111
                </p>
            </div>
            <p>Date: 27-05-2025<br>
                Reference: INV-0001<br>
                Customer: Walk in Customer
            </p>
            <table class="table-data">
                <tbody>
                    <div style="text-align: right;">
                       
                    </div>
                    <tr>
                        <td colspan="2">
                            Apple TV HD 32GB
                        </td>
                        <td style="text-align:right;vertical-align:bottom">109.00</td>
                    </tr>

                    <!-- <tfoot> -->
                    <tr>
                        <th colspan="2" style="text-align:left">Total</th>
                        <th style="text-align:right">109.00</th>
                    </tr>
                    <tr>
                        <th colspan="2" style="text-align:left">Grand Total</th>
                        <th style="text-align:right">109.00</th>
                    </tr>
                    <tr>
                        <th colspan="2" style="text-align:left">Total Due</th>
                        <th style="text-align:right">6,655.98</th>
                    </tr>
                    <tr>
                        <th class="centered" colspan="3">In Words: <span>USD</span> <span>one hundred nine</span></th>
                    </tr>
                </tbody>
                <!-- </tfoot> -->
            </table>
            <table>
                <tbody>
                    <tr style="background-color:#ddd;">
                        <td style="padding: 5px;width:30%">Paid By: Cash</td>
                        <td style="padding: 5px;width:40%">Amount: 109.00</td>
                        <td style="padding: 5px;width:30%">Change: 0.00</td>
                    </tr>
                    <tr>
                        <td class="centered" colspan="3">Thank you for shopping with us. Please come again</td>
                    </tr>
                    <tr>
                        <td class="centered" colspan="3">
                            <img style="margin-top:10px;"
                                src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAdIAAAAeAQMAAACi8w0OAAAABlBMVEX///8AAABVwtN+AAAAAXRSTlMAQObYZgAAAAlwSFlzAAAOxAAADsQBlSsOGwAAAExJREFUOI3ty0EGQEEIANBoG10l2kZXH9oOXSXaxvxzfHr7B03oQXpMIQnlkTzxm9nBGSZSU+F5bbSnOjCY2ZzK9cDevXv37t378/sBy2RaWJQy128AAAAASUVORK5CYII="
                                width="300" alt="barcode" /> <br>
                            <img style="margin-top:10px;"
                                src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAEsAAABLAQMAAAACgOipAAAABlBMVEX///8AAABVwtN+AAAAAXRSTlMAQObYZgAAAAlwSFlzAAAOxAAADsQBlSsOGwAAANJJREFUKJF90rERhCAQBdB1CMi0AWdog4yW7OCsAFsyo42d2QYwM7jh33rjRce60QuQ/wEJOOeRHMDUJ1N0LbmVLEqLyFG284HhgHukW+MDNW0ezl9wh9pXNO2u3qEOtkL3dIgNUiPWaNFlkurnMbHBULVOYZv8KrT4UDWtT3eAR4/rQH2Gpst3DbTIL7gW5wkWQ/PvCZpmUVqSmoDdos57STyZ1FvnYZecLOq7XWVHsvj9d/SL8kCHQoM+nUm0KPne7J+axhMkezJ49V1iuC61yw9pTZkG32JiYQAAAABJRU5ErkJggg=="
                                alt="QRcode" />
                        </td>
                    </tr>
                </tbody>
            </table>
            <!-- <div class="centered" style="margin:30px 0 50px">
            <small>Invoice Generated By SalePro.
            Developed By LionCoders</strong></small>
        </div> -->
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