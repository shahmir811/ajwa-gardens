<!DOCTYPE html>
<html>
<head>
<title>Ajwa Garden</title>
<style>
  body {
        height: auto;
        width: 480px;
        /* to centre page on screen*/
        margin-left: auto;
        margin-right: auto;
        background-color: aqua;
    
    }
</style>

</head>
<body style="margin: 0 0; background: #fff; font-size: 14px; font-family: Arial, Helvetica, sans-serif; line-height: 18px;">

    <table width="720px" style="border-spacing:0; margin: 0 auto;" >
        <tr>
            <td>
                <table width="100%" style="border-spacing:0; margin: 0 auto; font-size: 14px;">
                    <tr>
                        <td style="text-align:left; width: 130px;"><img src="{{ public_path('images/ajwa.png')}}" height="70"></td>
                        <td style="text-align:center;">
                            <table width="150" style="margin-left:auto; margin-right:auto;">
                                <tr>
                                    <td  style="text-align:center;">
                                        <div style="display:inline-block; color:#ffffff; background-color: #008d44; padding: 6px 20px; border-radius: 100px; font-size: 18px;"><strong>Office Copy</strong></div>
                                    </td>
                                </tr>
                            </table>
                        </td>
                        <td style="text-align:right; width: 250px;">
                            <table width="100%" style="border-spacing:0; margin: 0 0; font-size: 14px; line-height: 14px;"">
                                <tr>
                                    <td width="60"><strong>Post By</strong></td>
                                    <td>{{ auth()->user()->name }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Date</strong></td>
                                    <td>{{ date('d/m/Y', strtotime($allotment->created_at)) }}</td>
                                </tr>
                                <tr>
                                    <td width="90"><strong>Receipt No.</strong></td>
                                    <td>{{ $allotment->down_payment_receipt_no }}</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td>
                <table width="100%" style="border-spacing:0; margin: 0 auto;">
                    <tr>
                        <td style="width:54px; height:30px"><strong>Reg No.</strong></td>
                        <td style="border-bottom:1px solid #000000; text-align: left; padding-left: 25px;">{{ $allotment->registration_no }}</td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td>
                <table width="100%" style="border-spacing:0; margin: 0 auto;">
                    <tr>
                        <td style="width:282px; height:23px"><strong>Received with thanks from Mr./Mrs./Miss.</strong></td>
                        <td style="border-bottom:1px solid #000000; text-align: left; padding-left: 25px;">	{{ $allotment->customer->name }}</td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td>
                <table width="100%" style="border-spacing:0; margin: 0 auto;">
                    <tr>
                        <td style="width:60px; height:23px"><strong>Rupees</strong></td>
                        <td style="border-bottom:1px solid #000000; width: 150px; text-align: left; padding-left: 25px;">	{{ number_format($allotment->down_amount) }} /-
                        <td style="width:64px ;"><strong>Inwords</strong></td>
                        <td style="border-bottom:1px solid #000000; text-align: left; padding-left: 25px;">{{ $allotment->convertNumber($allotment->down_amount) }} Only</td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td>
                <table width="100%" style="border-spacing:0; margin: 0 auto;">
                    <tr>
                        <td style="width:105px; height:23px"><strong>Payment Mode</strong></td>
                        <td style="border-bottom:1px solid #000000; width:350px; text-align: left; padding-left: 25px;">{{ $allotment->down_payment_mode }}</td>
                        <td style="width:45px;"><strong>Dated</strong></td>
                        <td style="border-bottom:1px solid #000000; text-align: left; padding-left: 25px;">{{ date('d/m/Y', strtotime($allotment->created_at)) }}</td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td>
                <table width="100%" style="border-spacing:0; margin: 0 auto;">
                    <tr>
                        <td style="width:110px; height:23px"><strong>Block & Plot No.</strong></td>
                        <td style="border-bottom:1px solid #000000; width: 300px;  text-align: left; padding-left: 25px;">{{ $allotment->plot->plot_no }} (Phase: {{ $allotment->plot->phase->name }})</td>
                        <td style="width:30px;"><strong>Size</strong></td>
                        <td style="border-bottom:1px solid #000000;  text-align: left; padding-left: 25px;">{{ $allotment->plot->marla }}-M ({{ $allotment->plot->type }})</td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td>
                <table width="100%" style="border-spacing:0; margin: 0 auto;">
                    <tr>
                        <td style="width:100px; height:23px"><strong>Payment Type</strong></td>
                        <td style="border-bottom:1px solid #000000; width: 330px; text-align: left; padding-left: 25px;">Down Payment</td>
                        <td style="width:104px;"><strong>Analysis Code</strong></td>
                        <td style="border-bottom:1px solid #000000;  text-align: center;">True Marketing</td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td>
                <table width="100%" style="border-spacing:0; margin: 0 auto;">
                    <tr>
                        <td style="padding-top: 25px;">
                            <table width="100%" style="border-spacing:0; margin: 0 auto; font-size: 11px; line-height: 12px;">
                                <tr>
                                    <td style="width:68px ; color: rgb(0, 22, 163);"><strong>Address:</strong></td>
                                    <td colspan="4">{{ $allotment->plot->phase->name == '1' ? 'Rangpur Road off Khaimkaran, Road Kasur' : 'Main Depalpur Road Kasur' }}</td>
                                </tr>
                                <tr>
                                    <td style="width:68px ; color: rgb(0, 22, 163);"><strong>Contact No.</strong></td>
                                    <td colspan="4">+92 302 4888999</td>
                                </tr>
                                <tr>
                                    <td style="width:68px ; color: rgb(0, 22, 163);"><strong>Website:</strong></td>
                                    <td style="width:100px;">www.ajwagarden.pk</td>
                                    <td style="width:34px ; color: rgb(0, 22, 163);"><strong>Email:</strong></td>
                                    <td>zafarlhr@gmail.com</td>
                                </tr>
                            </table>
                        </td>
                        <td style="vertical-align: bottom;text-align: right; font-size: 12px;">
                            This is a computer generated print & no need of signature.
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>

    </table>

<div style="height: 1px; width: 100%; background-color: #000000; margin-top: 20px; margin-bottom: 20px;"></div>

<table width="720px" style="border-spacing:0; margin: 0 auto;" >
    <tr>
        <td>
            <table width="100%" style="border-spacing:0; margin: 0 auto;">
                <tr>
                    <td style="text-align:left; width: 130px;"><img src="{{ public_path('images/ajwa.png')}}" height="70"></td>
                    <td style="text-align:center;">
                        <table width="150" style="margin-left:auto; margin-right:auto;">
                            <tr>
                                <td  style="text-align:center;">
                                    <div style="display:inline-block; color:#ffffff; background-color: #008d44; padding: 2px 10px; border-radius: 100px;"><strong>Client Copy</strong></div>
                                </td>
                            </tr>
                        </table>
                    </td>
                    <td style="text-align:right; width: 250px;">
                        <table width="100%" style="border-spacing:0; margin: 0 0; font-size: 14px; line-height: 14px;"">
                            <tr>
                                <td width="60"><strong>Post By</strong></td>
                                <td>{{ auth()->user()->name }}</td>
                            </tr>
                            <tr>
                                <td><strong>Date</strong></td>
                                <td>{{ date('d/m/Y', strtotime($allotment->created_at)) }}</td>
                            </tr>
                            <tr>
                                <td width="90"><strong>Receipt No.</strong></td>
                                <td>{{ $allotment->down_payment_receipt_no }}</td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td>
            <table width="100%" style="border-spacing:0; margin: 0 auto;">
                <tr>
                    <td style="width:54px; height:30px"><strong>Reg No.</strong></td>
                    <td style="border-bottom:1px solid #000000; text-align: left; padding-left: 25px;">{{ $allotment->registration_no }}</td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td>
            <table width="100%" style="border-spacing:0; margin: 0 auto;">
                <tr>
                    <td style="width:282px; height:23px"><strong>Received with thanks from Mr./Mrs./Miss.</strong></td>
                    <td style="border-bottom:1px solid #000000; text-align: left; padding-left: 25px;">	{{ $allotment->customer->name }}</td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td>
            <table width="100%" style="border-spacing:0; margin: 0 auto;">
                <tr>
                    <td style="width:60px; height:23px"><strong>Rupees</strong></td>
                    <td style="border-bottom:1px solid #000000; width: 150px; text-align: left; padding-left: 25px;">	{{ number_format($allotment->down_amount) }} /-
                    <td style="width:64px ;"><strong>Inwords</strong></td>
                    <td style="border-bottom:1px solid #000000; text-align: left; padding-left: 25px;">{{ $allotment->convertNumber($allotment->down_amount) }} Only</td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td>
            <table width="100%" style="border-spacing:0; margin: 0 auto;">
                <tr>
                    <td style="width:105px; height:23px"><strong>Payment Mode</strong></td>
                    <td style="border-bottom:1px solid #000000; width:350px; text-align: left; padding-left: 25px;">{{ $allotment->down_payment_mode }}</td>
                    <td style="width:45px;"><strong>Dated</strong></td>
                    <td style="border-bottom:1px solid #000000; text-align: left; padding-left: 25px;">{{ date('d/m/Y', strtotime($allotment->created_at)) }}</td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td>
            <table width="100%" style="border-spacing:0; margin: 0 auto;">
                <tr>
                    <td style="width:110px; height:23px"><strong>Block & Plot No.</strong></td>
                    <td style="border-bottom:1px solid #000000; width: 300px;  text-align: left; padding-left: 25px;">{{ $allotment->plot->plot_no }} (Phase: {{ $allotment->plot->phase->name }})</td>
                    <td style="width:30px;"><strong>Size</strong></td>
                    <td style="border-bottom:1px solid #000000;  text-align: left; padding-left: 25px;">{{ $allotment->plot->marla }}-M ({{ $allotment->plot->type }})</td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td>
            <table width="100%" style="border-spacing:0; margin: 0 auto;">
                <tr>
                    <td style="width:100px; height:23px"><strong>Payment Type</strong></td>
                    <td style="border-bottom:1px solid #000000; width: 330px; text-align: left; padding-left: 25px;">Down Payment</td>
                    <td style="width:104px;"><strong>Analysis Code</strong></td>
                    <td style="border-bottom:1px solid #000000;  text-align: center;">True Marketing</td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td>
            <table width="100%" style="border-spacing:0; margin: 0 auto;">
                <tr>
                    <td style="padding-top: 25px;">
                        <table width="100%" style="border-spacing:0; margin: 0 auto; font-size: 11px; line-height: 12px;">
                            <tr>
                                <td style="width:68px ; color: rgb(0, 22, 163);"><strong>Address:</strong></td>
                                <td colspan="4">{{ $allotment->plot->phase->name == '1' ? 'Rangpur Road off Khaimkaran, Road Kasur' : 'Main Depalpur Road Kasur' }}</td>
                            </tr>
                            <tr>
                                <td style="width:68px ; color: rgb(0, 22, 163);"><strong>Contact No.</strong></td>
                                <td colspan="4">+92 302 4888999</td>
                            </tr>
                            <tr>
                                <td style="width:68px ; color: rgb(0, 22, 163);"><strong>Website:</strong></td>
                                <td style="width:100px;">www.ajwagarden.pk</td>
                                <td style="width:34px ; color: rgb(0, 22, 163);"><strong>Email:</strong></td>
                                <td>zafarlhr@gmail.com</td>
                            </tr>
                        </table>
                    </td>
                    <td style="vertical-align: bottom;text-align: right; font-size: 12px;">
                        This is a computer generated print & no need of signature.
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>

</table>

<div style="height: 1px; width: 100%; background-color: #000000; margin-top: 20px; margin-bottom: 20px;"></div>

<table width="720px" style="border-spacing:0; margin: 0 auto;" >
    <tr>
        <td>
            <table width="100%" style="border-spacing:0; margin: 0 auto;">
                <tr>
                    <td style="text-align:left; width: 130px;"><img src="{{ public_path('images/ajwa.png')}}" height="70"></td>
                    <td style="text-align:center;">
                        <table width="150" style="margin-left:auto; margin-right:auto;">
                            <tr>
                                <td  style="text-align:center;">
                                    <div style="display:inline-block; color:#ffffff; background-color: #008d44; padding: 2px 10px; border-radius: 100px;"><strong>Audit Copy</strong></div>
                                </td>
                            </tr>
                        </table>
                    </td>
                    <td style="text-align:right; width: 250px;">
                        <table width="100%" style="border-spacing:0; margin: 0 0; font-size: 14px; line-height: 14px;"">
                            <tr>
                                <td width="60"><strong>Post By</strong></td>
                                <td>{{ auth()->user()->name }}</td>
                            </tr>
                            <tr>
                                <td><strong>Date</strong></td>
                                <td>{{ date('d/m/Y', strtotime($allotment->created_at)) }}</td>
                            </tr>
                            <tr>
                                <td width="90"><strong>Receipt No.</strong></td>
                                <td>{{ $allotment->down_payment_receipt_no }}</td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td>
            <table width="100%" style="border-spacing:0; margin: 0 auto;">
                <tr>
                    <td style="width:54px; height:30px"><strong>Reg No.</strong></td>
                    <td style="border-bottom:1px solid #000000; text-align: left; padding-left: 25px;">{{ $allotment->registration_no }}</td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td>
            <table width="100%" style="border-spacing:0; margin: 0 auto;">
                <tr>
                    <td style="width:282px; height:23px"><strong>Received with thanks from Mr./Mrs./Miss.</strong></td>
                    <td style="border-bottom:1px solid #000000; text-align: left; padding-left: 25px;">	{{ $allotment->customer->name }}</td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td>
            <table width="100%" style="border-spacing:0; margin: 0 auto;">
                <tr>
                    <td style="width:60px; height:23px"><strong>Rupees</strong></td>
                    <td style="border-bottom:1px solid #000000; width: 150px; text-align: left; padding-left: 25px;">	{{ number_format($allotment->down_amount) }} /-
                    <td style="width:64px ;"><strong>Inwords</strong></td>
                    <td style="border-bottom:1px solid #000000; text-align: left; padding-left: 25px;">{{ $allotment->convertNumber($allotment->down_amount) }} Only</td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td>
            <table width="100%" style="border-spacing:0; margin: 0 auto;">
                <tr>
                    <td style="width:105px; height:23px"><strong>Payment Mode</strong></td>
                    <td style="border-bottom:1px solid #000000; width:350px; text-align: left; padding-left: 25px;">{{ $allotment->down_payment_mode }}</td>
                    <td style="width:45px;"><strong>Dated</strong></td>
                    <td style="border-bottom:1px solid #000000; text-align: left; padding-left: 25px;">{{ date('d/m/Y', strtotime($allotment->created_at)) }}</td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td>
            <table width="100%" style="border-spacing:0; margin: 0 auto;">
                <tr>
                    <td style="width:110px; height:23px"><strong>Block & Plot No.</strong></td>
                    <td style="border-bottom:1px solid #000000; width: 300px;  text-align: left; padding-left: 25px;">{{ $allotment->plot->plot_no }} (Phase: {{ $allotment->plot->phase->name }})</td>
                    <td style="width:30px;"><strong>Size</strong></td>
                    <td style="border-bottom:1px solid #000000;  text-align: left; padding-left: 25px;">{{ $allotment->plot->marla }}-M ({{ $allotment->plot->type }})</td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td>
            <table width="100%" style="border-spacing:0; margin: 0 auto;">
                <tr>
                    <td style="width:100px; height:23px"><strong>Payment Type</strong></td>
                    <td style="border-bottom:1px solid #000000; width: 330px; text-align: left; padding-left: 25px;">Down Payment</td>
                    <td style="width:104px;"><strong>Analysis Code</strong></td>
                    <td style="border-bottom:1px solid #000000;  text-align: center;">True Marketing</td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td>
            <table width="100%" style="border-spacing:0; margin: 0 auto;">
                <tr>
                    <td style="padding-top: 25px;">
                        <table width="100%" style="border-spacing:0; margin: 0 auto; font-size: 11px; line-height: 12px;">
                            <tr>
                                <td style="width:68px ; color: rgb(0, 22, 163);"><strong>Address:</strong></td>
                                <td colspan="4">{{ $allotment->plot->phase->name == '1' ? 'Rangpur Road off Khaimkaran, Road Kasur' : 'Main Depalpur Road Kasur' }}</td>
                            </tr>
                            <tr>
                                <td style="width:68px ; color: rgb(0, 22, 163);"><strong>Contact No.</strong></td>
                                <td colspan="4">+92 302 4888999</td>
                            </tr>
                            <tr>
                                <td style="width:68px ; color: rgb(0, 22, 163);"><strong>Website:</strong></td>
                                <td style="width:100px;">www.ajwagarden.pk</td>
                                <td style="width:34px ; color: rgb(0, 22, 163);"><strong>Email:</strong></td>
                                <td>zafarlhr@gmail.com</td>
                            </tr>
                        </table>
                    </td>
                    <td style="vertical-align: bottom;text-align: right; font-size: 12px;">
                        This is a computer generated print & no need of signature.
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>

</table>


</body>
</html> 