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
        }

        .table th,
        .table td {
            border: 1px solid #000;
            padding: 8px;
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

    <div class="title">Official Receipt</div>

    <table class="table">
        <tr>
            <th>Reference</th>
            <td>{{ $receipt->reference }}</td>
        </tr>
        <tr>
            <th>Revenue Source</th>
            <td>{{ $receipt->revenueSource->name }}</td>
        </tr>
        <tr>
            <th>Amount</th>
            <td>₦{{ number_format($receipt->amount, 2) }}</td>
        </tr>
        <tr>
            <th>Date</th>
            <td>{{ $receipt->receipt_date }}</td>
        </tr>
    </table>

    <p>Authorized Signature: ___________________________</p>

</body>

</html>
