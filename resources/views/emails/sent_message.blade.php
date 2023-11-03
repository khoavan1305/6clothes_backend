<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">


    <title>html invoice email template - Bootdey.com</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style type="text/css">
        body {
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <h2>Tiêu để hỗ trợ KH: {{ $sent_message['title'] }}</h2>
    <h3>Người gửi: {{ $sent_message['name'] }} | E-Mail: {{ $sent_message['email'] }}</h3><br>
    <h4>Nội dung: {{ $sent_message['content'] }}</h4>
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript"></script>
</body>

</html>
