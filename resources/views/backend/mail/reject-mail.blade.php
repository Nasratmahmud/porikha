
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            text-align: center;
        }

        .header {
            background-color: #94ce24;
            color: #fff;
            padding: 10px;
            border-radius: 8px 8px 0 0;
        }

        .content {
            padding: 20px;
        }

        .otp {
            font-size: 36px;
            font-weight: bold;
            color: #94ce24;
            margin-bottom: 20px;
        }

        .instructions {
            color: #333;
            margin-bottom: 20px;
            text-align: start;
        }

        .footer {
            margin-top: 20px;
            color: #777;
        }
    </style>
</head>

<body>
<div class="container">
    <div class="header">
        <h2>Oops Your Job Request Rejected</h2>
    </div>
    <div class="content">
        <p style="font-size: 18px">Hello {{ $user->name }},</p>
        <p class="otp">"{{$job_title}}" This job request has been rejected.</p>
        <p>
            {{$reason}}
        </p>
    </div>
    <div class="footer">
        <p>
            Thank You...
        </p>
    </div>
</div>
</body>

</html>







