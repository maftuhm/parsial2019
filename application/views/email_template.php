<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="icon" type="image/png" href="https://parsial2018.000webhostapp.com/img/icon.png">
        <title><?php echo $title;?></title>
        <style>
            @media only screen and (max-width: 620px) {
                table[class=body] h1 {                    
                    font-size: 28px !important;
                    margin-bottom: 10px !important;
                }
                table[class=body] p,
                table[class=body] ul,
                table[class=body] ol,
                table[class=body] td,
                table[class=body] span,
                table[class=body] a {
                    font-size: 16px !important;
                }
                table[class=body] .wrapper,
                table[class=body] .article {
                    padding: 10px !important;
                }
                table[class=body] .content {
                    padding: 0 !important;
                }
                table[class=body] .container {
                    padding: 0 !important;
                    width: 100% !important;
                }
                table[class=body] .main {
                    border-left-width: 0 !important;
                    border-radius: 0 !important;
                    border-right-width: 0 !important;
                }
                table[class=body] .btn table {
                    width: 100% !important;
                }
                table[class=body] .btn a {
                    width: 100% !important;
                }
                table[class=body] .img-responsive {
                    height: auto !important;
                    max-width: 100% !important;
                    width: auto !important;
                }
            }
            /* -------------------------------------
            PRESERVE THESE STYLES IN THE HEAD
            ------------------------------------- */
            @media all {
                .ExternalClass {
                    width: 100%;
                }
                .ExternalClass,
                .ExternalClass p,
                .ExternalClass span,
                .ExternalClass font,
                .ExternalClass td,
                .ExternalClass div {
                    line-height: 100%;
                }
                .apple-link a {
                    color: inherit !important;
                    font-family: inherit !important;
                    font-size: inherit !important;
                    font-weight: inherit !important;
                    line-height: inherit !important;
                    text-decoration: none !important;
                }
                .btn-primary table td:hover {
                    background-color: #34495e !important;
                }
                .btn-primary a:hover {
                    background-color: #34495e !important;
                    border-color: #34495e !important;
                }
                .social img:hover {
                    opacity: 0.75 !important;
                }
            }
        </style>
    </head>
    <body class="" style="background-color: #f6f6f6; font-family: sans-serif; -webkit-font-smoothing: antialiased; font-size: 14px; line-height: 1.4; margin: 0; padding: 0; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;">
        <table border="0" cellpadding="0" cellspacing="0" class="body" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%; background-color: #f6f6f6;">
            <tr>
                <td style="font-family: sans-serif; font-size: 14px; vertical-align: top;">&nbsp;</td>
                <td class="container" style="font-family: sans-serif; font-size: 14px; vertical-align: top; display: block; margin: 0 auto; max-width: 580px; padding: 10px; width: 580px;">
                    <div class="content" style="box-sizing: border-box; display: block; margin: 0 auto; max-width: 580px; padding: 10px;">
                        <table class="main" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%; background: #ffffff; border-radius: 3px;">
                        	<!-- START MAIN CONTENT AREA -->
                            <!--tr>
                                <td class="wrapper" style="vertical-align: top; box-sizing: border-box;">
                                
                                    <img style="max-width: 100%; margin: 0; display: block;" src="https://parsial2018.000webhostapp.com/img/header-email.jpg" >
                                
                                </td>
                            </tr-->
                            <tr>
                                <td class="wrapper" style="vertical-align: top; text-align:center;box-sizing: border-box;">
                                    <h1><?php echo $judul_email;?></h1>
                                    <img style="max-width: 25%; margin: 10px auto; display: block;" src="<?php echo base_url('/upload/images/ceklis.png')?>" >
                                </td>
                            </tr>
                            <tr>
                                <td class="wrapper" style="font-family: sans-serif; font-size: 14px; vertical-align: top; box-sizing: border-box; padding: 20px;">
                                    <table border="0" cellpadding="0" cellspacing="0" style="border-top:1px solid #999999;border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%;">
                                        <tr>
                                            <td style="font-family: sans-serif; font-size: 14px; vertical-align: top;">
                                                <p style="font-family: sans-serif; font-size: 16px; font-weight: bold; margin: 15px 0;">Hai <?php echo $nama_peserta;?>,</p>
                                                <p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 15px 0;"><?php echo $text;?></p>
                                                <h2>Jadwal Pelaksanaan</h2>
                                                <table>
                                                    <tbody>
                                                    <tr>
                                                        <td colspan="3"><strong>Babak penyisihan</strong></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Hari, Tanggal</td>
                                                        <td>:</td>
                                                        <td>Senin, 11 Maret 2019</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Pukul</td>
                                                        <td>:</td>
                                                        <td>07.00 s/d selesai</td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="3"><strong>Babak Semifinal</strong></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Hari, Tanggal</td>
                                                        <td>:</td>
                                                        <td>Selasa, 12 Maret 2019</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Pukul</td>
                                                        <td>:</td>
                                                        <td>07.00 s/d selesai</td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="3"><strong>Babak final</strong></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Hari, Tanggal</td>
                                                        <td>:</td>
                                                        <td>Rabu, 13 Maret 2019</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Pukul</td>
                                                        <td>:</td>
                                                        <td>07.00 s/d selesai</td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                                <!-- <table border="0" cellpadding="0" cellspacing="0" class="btn btn-primary" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%; box-sizing: border-box;">
                                                    <tbody>
                                                        <tr>
                                                            <td align="center" style="font-family: sans-serif; font-size: 14px; vertical-align: top; padding: 25px 35px;">
                                                                <table border="0" cellpadding="0" cellspacing="0" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: auto;">
                                                                    <tbody>
                                                                        <tr>
                                                                            <td style="font-family: sans-serif; font-size: 14px; vertical-align: top; background-color: #222; border-radius: 5px; text-align: center;"> <a href="'.$url_tombol.'" target="_blank" style="display: block; color: #ffffff; background-color: #222; border: solid 1px #222; border-radius: 5px; box-sizing: border-box; cursor: pointer; text-decoration: none; font-size: 14px; font-weight: bold; margin: 0; padding: 12px 35px; text-transform: capitalize; border-color: #222;">'.$tombol_email.'</a> 
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table> -->
                                                <!-- <p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin:15px 0;">Untuk informasi lebih lanjut dapat hubungi contact persontentang pengisian formullir dapat melalui halaman <a href="http://parsial.cf/contact-us.php" style="text-decoration: none;color: #999999" target="_blank">Contact Us</a> yang telah kami sediakan.</p> -->
                                                <br>
                                                <p style="font-family: sans-serif; font-size: 14px; text-align: right; font-weight: normal; padding-bottom: 15px;padding-right: 15px"><em>Hormat kami,</em></p>
                                                <p style="border-bottom:1px solid #999999;font-family: sans-serif; font-size: 14px; text-align: right; font-weight: normal; padding-bottom: 15px;padding-right: 15px"><em> - <?php echo $cp;?></em></p>
                                                <!-- <tr>
                                                    <td class="wrapper social" style="vertical-align: top; box-sizing: border-box; padding: 10px 15px 0 0; text-align: right;">
                                                        <a href="https://plus.google.com/103991975733942642578" target="_blank"><img style="max-width: 8%;display: inline; margin-right: 2px;" src="https://parsial2018.000webhostapp.com/img/email/gplus.png" ></a>
                                                        <a href="https://line.me/ti/id/@uao9815e" target="_blank"><img style="max-width: 8%;display: inline; margin-right: 2px;" src="https://parsial2018.000webhostapp.com/img/email/line.png" ></a>
                                                        <a href="tel:+6281386314898" target="_blank"><img style="max-width: 8%;display: inline; margin-right: 2px;" src="https://parsial2018.000webhostapp.com/img/email/whatsup.png" ></a>
                                                        <a href="https://www.instagram.com/parsialhimatika.uinjkt/" target="_blank"><img style="max-width: 8%;display: inline; margin-right: 2px;" src="https://parsial2018.000webhostapp.com/img/email/instagram.png" ></a>
                                                        <a href="https://www.youtube.com/channel/UCLb7GCLgwPB4egtOzw3dDDA" target="_blank"><img style="max-width: 8%;display: inline; margin-right: 2px;" src="https://parsial2018.000webhostapp.com/img/email/youtube.png" ></a>
                                                    </td>
                                                </tr> -->
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <!-- END MAIN CONTENT AREA -->
                        </table>
                        <!-- START FOOTER -->
                        <div class="footer" style="clear: both; margin-top: 10px; text-align: center; width: 100%;">
                            <table border="0" cellpadding="0" cellspacing="0" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%;">
                                <tr>
                                    <td class="content-block" style="font-family: sans-serif; vertical-align: top; padding-bottom: 10px; padding-top: 10px; font-size: 12px; color: #999999; text-align: center;">
                                        <span class="apple-link" style="color: #999999; font-size: 12px; text-align: center;">Jalan Ir. Juanda Nomor 95, Ciputat, Tangerang Selatan, Banten, 15412.</span>
                                        <br>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="content-block powered-by" style="font-family: sans-serif; vertical-align: top; padding-bottom: 10px; padding-top: 10px; font-size: 12px; color: #999999; text-align: center;">
                                    &copy; Copyright <a href="http://www.parsial.cf" style="color: #999999; font-size: 12px; text-align: center; text-decoration: none;">PARSIAL 2019 <br> HIMATIKA UIN Syarif Hidayatullah Jakarta</a>.
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <!-- END FOOTER -->
                        <!-- END CENTERED WHITE CONTAINER -->
                    </div>
                </td>
                <td style="font-family: sans-serif; font-size: 14px; vertical-align: top;">&nbsp;</td>
            </tr>
        </table>
    </body>
</html>