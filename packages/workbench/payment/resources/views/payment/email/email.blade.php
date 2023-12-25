<!DOCTYPE html>
<html>
<head>

    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>The Tukang Selamat Datang Pengguna Baru </title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style type="text/css">
        /**
         * Google webfonts. Recommended to include the .woff version for cross-client compatibility.
         */
        @media screen 
        {
            @font-face 
            {
                font-family: 'Source Sans Pro';
                font-style: normal;
                font-weight: 400;
                src: local('Source Sans Pro Regular'), local('SourceSansPro-Regular'), url(https://fonts.gstatic.com/s/sourcesanspro/v10/ODelI1aHBYDBqgeIAH2zlBM0YzuT7MdOe03otPbuUS0.woff) format('woff');
            }

            @font-face 
            {
                font-family: 'Source Sans Pro';
                font-style: normal;
                font-weight: 700;
                src: local('Source Sans Pro Bold'), local('SourceSansPro-Bold'), url(https://fonts.gstatic.com/s/sourcesanspro/v10/toadOcfmlt9b38dHJxOBGFkQc6VGVFSmCnC_l7QZG60.woff) format('woff');
            }
        }

        /**
         * Avoid browser level font resizing.
         * 1. Windows Mobile
         * 2. iOS / OSX
         */
        body, table, td, a 
        {
            -ms-text-size-adjust: 100%; /* 1 */
            -webkit-text-size-adjust: 100%; /* 2 */
        }

        /**
         * Remove extra space added to tables and cells in Outlook.
         */
        table, td 
        {
            mso-table-rspace: 0pt;
            mso-table-lspace: 0pt;
        }

        /**
         * Better fluid images in Internet Explorer.
         */
        img 
        {
           -ms-interpolation-mode: bicubic;
        }

        /**
         * Remove blue links for iOS devices.
         */
        a[x-apple-data-detectors] 
        {
            font-family: inherit !important;
            font-size: inherit !important;
            font-weight: inherit !important;
            line-height: inherit !important;
            color: inherit !important;
            text-decoration: none !important;
        }

        /**
         * Fix centering issues in Android 4.4.
         */
        div[style*="margin: 16px 0;"] 
        {
            margin: 0 !important;
        }
        
        body 
        {
            width: 100% !important;
            height: 100% !important;
            padding: 0 !important;
            margin: 0 !important;
        }

        /**
         * Collapse table borders to avoid space between cells.
         */
         table 
         {
            border-collapse: collapse !important;
        }

        a 
        {
            color: black;
        }

        img 
        {
            height: auto;
            line-height: 100%;
            text-decoration: none;
            border: 0;
            outline: none;
        }
    </style>
</head>

<body style="background-color: #e9ecef;">

    <!-- start preheader -->
    <div class="preheader" style="display: none; max-width: 0; max-height: 0; overflow: hidden; font-size: 1px; line-height: 1px; color: #fff; opacity: 0;">
      
    </div>
    <!-- end preheader -->

    <!-- start body -->
    <table border="0" cellpadding="0" cellspacing="0" width="100%">

        <!-- start logo -->
        <tr>
            <td align="center" bgcolor="#e9ecef">
            <!--[if (gte mso 9)|(IE)]>
            <table align="center" border="0" cellpadding="0" cellspacing="0" width="600">
            <tr>
            <td align="center" valign="top" width="600">
            <![endif]-->
                <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                    <tr>
                        <td align="center" valign="top" style="padding: 36px 24px;">
                            <img src="https://ptg.perak.gov.my/portal/documents/20123/1579659/logo-negeri-perak-png-1.png/7af3a38b-7999-75b8-ae7e-99156244be54?t=1653013935380" alt="Logo" border="0" width="48" style="display: block; width: 48px; max-width: 48px; min-width: 48px;">
                        </td>
                    </tr>
                </table>
                <!--[if (gte mso 9)|(IE)]>
                </td>
                </tr>
                </table>
                <![endif]-->
            </td>
        </tr>
        <!-- end logo -->

        <!-- start copy block -->
        <tr>
            <td align="center" bgcolor="#e9ecef">
            <!--[if (gte mso 9)|(IE)]>
            <table align="center" border="0" cellpadding="0" cellspacing="0" width="600">
            <tr>
            <td align="center" valign="top" width="600">
            <![endif]-->
                <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 800px;">
                    <!-- start copy -->
                    <tr>
                        <td bgcolor="#ffffff" align="left" style="padding: 23px; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px;">
                            <h1 style="margin: 0 0 12px; font-size: 18px; font-weight: 400; line-height: 48px;">PENGESAHAN EMEL PENDAFTARAN PENGGUNA</h1>
                            <p style="margin: 0;">Salam Negaraku Malaysia,</p>
                            <p style="margin: 0;">Tuan/Puan</p>
                            <p style="margin: 0;">Bayaran untuk {{ $content->paymentdetail->first()->fkperkhidmatan->name.' '.$status }}</p>
                            <p>2. Berikut adalah maklumat bayaran tersebut:</p>
                                
                                <center><b>
                                    <table style="width: 70%; border: 1px black solid">
                                        <tr style="border: 1px black solid; padding: 10px">
                                            <td style="border: 1px black solid; padding: 10px">
                                                Nama Pembayar
                                            </td>
                                            <td style="border: 1px black solid; padding: 10px">
                                                {{ $content->paymentdetail->first()->fkpayer->name }}
                                            </td>
                                        </tr>
                                        <tr style="border: 1px black solid; padding: 10px">
                                            <td style="border: 1px black solid; padding: 10px">
                                                No Telefon
                                            </td>
                                            <td style="border: 1px black solid; padding: 10px">
                                                {{ $content->paymentdetail->first()->fkpayer->no_tel }}
                                            </td>
                                        </tr>
                                        <tr style="border: 1px black solid; padding: 10px">
                                            <td style="border: 1px black solid; padding: 10px">
                                                Order No
                                            </td>
                                            <td style="border: 1px black solid; padding: 10px">
                                                {{ $content->transaction_no }}
                                            </td>
                                        </tr>
                                        <tr style="border: 1px black solid; padding: 10px">
                                            <td style="border: 1px black solid; padding: 10px">
                                                Tarikh Bayaran
                                            </td>
                                            <td style="border: 1px black solid; padding: 10px">
                                                {{ $content->transaction_date }}
                                            </td>
                                        </tr>
                                        <tr style="border: 1px black solid; padding: 10px">
                                            <td style="border: 1px black solid; padding: 10px">
                                                Cara Bayaran
                                            </td>
                                            <td style="border: 1px black solid; padding: 10px">
                                                {{ $content->fkpaymentgateway->name }}
                                            </td>
                                        </tr>
                                        <tr style="border: 1px black solid; padding: 10px">
                                            <td style="border: 1px black solid; padding: 10px">
                                                No Trasaksi bayaran
                                            </td>
                                            <td style="border: 1px black solid; padding: 10px">
                                                {{ $content->transaction_id }}
                                            </td>
                                        </tr>
                                        <tr style="border: 1px black solid; padding: 10px">
                                            <td style="border: 1px black solid; padding: 10px">
                                                Jumlah (RM)
                                            </td>
                                            <td style="border: 1px black solid; padding: 10px">
                                                {{ $content->total_amount }}
                                            </td>
                                        </tr>
                                        <tr style="border: 1px black solid; padding: 10px">
                                            <td style="border: 1px black solid; padding: 10px">
                                                Status
                                            </td>
                                            <td style="border: 1px black solid; padding: 10px">
                                                {{ $status }}
                                            </td>
                                        </tr>
                                    </table>
                                </b></center>

                            <p>3. Salinan resit bayaran boleh dimuat turun disini <a href="https://dev-epay.perak.gov.my//bayaran/receipt/{{ $content->id }}" target="_blank" style="color: blue"><b>Resit</b></a></p>
                            <br>
                            <p>Sekian Terima Kasih</p>
                        </td>
                    </tr>
                    <!-- end copy -->

                    <!-- start button -->
                    <!-- <tr>
                        <td align="left" bgcolor="#ffffff">
                            <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                <tr>
                                    <td align="center" bgcolor="#ffffff" style="padding: 12px;">
                                        <table border="0" cellpadding="0" cellspacing="0">
                                            <tr>
                                                <td align="center" bgcolor="#1a82e2" style="border-radius: 6px;">
                                                    <a href="#" target="_blank" rel="noopener noreferrer" style="display: inline-block; padding: 16px 36px; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 16px; color: #ffffff; text-decoration: none; border-radius: 6px;">Pengesahan Pendaftaran</a>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr> -->
                    <!-- end button -->

                    <!-- start copy -->
                    <tr>
                        <td align="left" bgcolor="#ffffff" style="padding: 24px; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px; border-bottom: 3px solid #d4dadf">
                            <p style="margin: 0;">Pejabat Kewangan Negeri Perak</p><br>
                            <p style="font-size: 10px">
                                <center>Peringatan: Ini adalah cetakan komputer. Tiada tandatangan dan maklum balas diperlukan.</center>
                            </p>

                        </td>
                    </tr>
                    <!-- end copy -->
                </table>
                <!--[if (gte mso 9)|(IE)]>
                </td>
                </tr>
                </table>
              <![endif]-->
          </td>
      </tr>
      <!-- end copy block -->
      
      <!-- start footer -->
      <tr>
          <td align="center" bgcolor="#e9ecef" style="padding: 24px;">
          <!--[if (gte mso 9)|(IE)]>
          <table align="center" border="0" cellpadding="0" cellspacing="0" width="600">
          <tr>
          <td align="center" valign="top" width="600">
          <![endif]-->
              <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                  <!-- start permission -->
                  <tr>
                      <td align="center" bgcolor="#e9ecef" style="padding: 12px 24px; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 20px; color: #666;">
                          <p style="margin: 0;">Anda menerima emel ini kerana kami menerima permohonan dari Sistem The Tukang. Jika bukan anda, sila abaikan dan padamkan emel ini.</p>
                      </td>
                  </tr>
                  <!-- end permission -->

                  <!-- start unsubscribe -->
                  <tr>
                      <td align="center" bgcolor="#e9ecef" style="padding: 12px 24px; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 20px; color: #666;">
                          <p style="margin: 0;">The Tukang </p>
                      </td>
                  </tr>
                  <!-- end unsubscribe -->
              </table>
              <!--[if (gte mso 9)|(IE)]>
              </td>
              </tr>
              </table>
              <![endif]-->
          </td>
      </tr>
      <!-- end footer -->
  </table>
  <!-- end body -->
</body>
</html>
