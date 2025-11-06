<!DOCTYPE html>
<html>

<head>
    <style>
        body {
            font-family: sans-serif;
            font-size: 14px;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .table th,
        .table td {
            border: 1px solid #000;
            padding: 8px;
        }

        .text-center {
            text-align: center;
        }

        .title {
            font-size: 18px;
            font-weight: bold;
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>

    <div class="title">Payment Voucher</div>

    <table class="table">
        <tr>
            <th>PV Number</th>
            <td>{{ $payment_voucher->pv_number }}</td>
        </tr>
        <tr>
            <th>Vendor</th>
            <td>{{ $payment_voucher->vendor->name }}</td>
        </tr>
        <tr>
            <th>Requested By</th>
            <td>{{ $payment_voucher->request->user->name }}</td>
        </tr>
        <tr>
            <th>Amount</th>
            <td>₦{{ number_format($payment_voucher->amount, 2) }}</td>
        </tr>
        <tr>
            <th>Status</th>
            <td>{{ ucfirst($payment_voucher->status) }}</td>
        </tr>
        <tr>
            <th>Payment Date</th>
            <td>{{ $payment_voucher->payment_date }}</td>
        </tr>
    </table>

    <p>Authorized By: ______________________</p>
    <p>Signature: ___________________________</p>

</body>

</html>
