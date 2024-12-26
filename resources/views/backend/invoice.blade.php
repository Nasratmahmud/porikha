
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 30px;
            color: #333;
        }
        h1 {
            color: #4CAF50;
            text-align: center;
            margin-bottom: 30px;
        }
        .invoice-container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .invoice-details {
            margin-bottom: 30px;
        }
        .invoice-details p {
            font-size: 14px;
            margin: 5px 0;
        }
        .invoice-details strong {
            font-weight: bold;
        }
        .invoice-footer {
            text-align: center;
            margin-top: 20px;
            font-size: 12px;
            color: #777;
        }
        .total-amount {
            font-size: 18px;
            color: #4CAF50;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <h1>Invoice</h1>

    <div class="invoice-container">
        <div class="invoice-details">
            <p><strong>User Name:</strong> {{ $userName }}</p>
            <p><strong>Course Name:</strong> {{ $courseName }}</p>
            <p><strong>Status:</strong> {{ $status }}</p>
            <p class="total-amount"><strong>Amount:</strong> ${{ $amount }}</p>
        </div>
        
        <div class="invoice-footer">
            <p>Thank you for your purchase!</p>
            <p>For any questions, please contact support.</p>
        </div>
    </div>
</body>
</html>

