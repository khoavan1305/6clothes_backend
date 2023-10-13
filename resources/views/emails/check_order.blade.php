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
    <div bgcolor="#f6f6f6" style="color: #333; height: 100%; width: 100%;" height="100%" width="100%">
        <table bgcolor="#f6f6f6" cellspacing="0" style="border-collapse: collapse; padding: 40px; width: 100%;"
            width="100%">
            <tbody>
                <tr>
                    <td width="5px" style="padding: 0;"></td>
                    <td style="clear: both; display: block; margin: 0 auto; max-width: 600px; padding: 10px 0;">
                        <table width="100%" cellspacing="0" style="border-collapse: collapse;">
                            <tbody>
                                <tr>
                                    <td style="padding: 0;">
                                        <a style="color: #348eda;" target="_blank">
                                            <h2>Hi {{ $order->first_name }}</h2>
                                        </a>
                                    </td>
                                    <td style="color: #999; font-size: 12px; padding: 0; text-align: right;"
                                        align="right">
                                        6clothes<br />
                                        ID Đơn hàng #{{ $order->id }}<br />
                                        {{ $order->created_at }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                    <td width="5px" style="padding: 0;"></td>
                </tr>
                <tr>
                    <td width="5px" style="padding: 0;"></td>
                    <td bgcolor="#FFFFFF"
                        style="border: 1px solid #000; clear: both; display: block; margin: 0 auto; max-width: 600px; padding: 0;">
                        <table width="100%"
                            style="background: #f9f9f9; border-bottom: 1px solid #eee; border-collapse: collapse; color: #999;">
                            <tbody>
                                <tr>
                                    <td width="50%" style="padding: 20px;"><strong
                                            style="color: #333; font-size: 24px;">{{ number_format($order->total, 3) }}</strong>
                                        VND</td>
                                    <td align="right" width="50%" style="padding: 20px;">Cảm ơn quý khách </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                    <td style="padding: 0;"></td>
                    <td width="5px" style="padding: 0;"></td>
                </tr>
                <tr>
                    <td width="5px" style="padding: 0;"></td>
                    <td
                        style="border: 1px solid #000; border-top: 0; clear: both; display: block; margin: 0 auto; max-width: 600px; padding: 0;">
                        <table cellspacing="0"
                            style="border-collapse: collapse; border-left: 1px solid #000; margin: 0 auto; max-width: 600px;">
                            <tbody>
                                <div style="width: 500px;margin: 0 auto;padding: 15px;text-align: center">
                                    <a style="border-bottom: 2px solid #000; border-top: 2px solid #000; font-weight: bold; padding: 5px 0;"
                                        href="{{ route('checkOrder.action', ['order' => $order->id, 'token' => $order->token]) }}">Xác
                                        nhận đơn hàng</a>
                                    </p>
                                </div>
                            </tbody>
                        </table>
                    </td>
                </tr>
            </tbody>
        </table>
        </td>
        <td width="5px" style="padding: 0;"></td>
        </tr>
        <tr style="color: #666; font-size: 12px;">
            <td width="5px" style="padding: 10px 0;"></td>
            <td style="clear: both; display: block; margin: 0 auto; max-width: 600px; padding: 10px 0;">
                <table width="100%" cellspacing="0" style="border-collapse: collapse;">

                </table>
            </td>

            <td width="5px" style="padding: 10px 0;"></td>
        </tr>
        </tbody>
        </table>
    </div>
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript"></script>
</body>

</html>
