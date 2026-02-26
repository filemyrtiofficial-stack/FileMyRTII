
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Mail</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 10px;
            text-align: left;
            border: 2px solid #bdbcbc;
            box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;
        }
        p {
            color: #333333;
            font-size: 14px;
            line-height: 1.6;
        }
        .btn-container {
            text-align: center;
            margin-top: 20px;
            margin-bottom: 20px;
        }
        .btn {
            background: #0384D4;
            color: white !important;
            text-decoration: none;
            padding: 12px 24px;
            border-radius: 5px;
            display: inline-block;
            font-size: 16px;
            font-weight: bold;
            margin-right: 10px;
        }
        .btn-danger {
            background: #d9534f;
               color: white !important;
        }
         .btn-secondary {
            background: #FFA500;
               color: white !important;
        }
        .footer {
            font-size: 12px;
            color: #777777;
            margin-top: 20px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
    @yield('content')
      
    <p><strong>FileMyRTI System</strong></p>
    <p class="footer">FileMyRTI.com | India’s Simplest Way to File My RTI</p>

    </div>
</body>
</html>