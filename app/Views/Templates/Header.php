<!DOCTYPE html>
<html>
<head>
    <title><?php echo $title; ?></title>
    <style>
        @font-face{
            font-family: "Bookman Old Style";
            font-style: normal;
            font-weight: 400;
            src: url(<?php echo FCPATH . 'assets/fonts/BookmanOldStyle.ttf';?>) format("truetype");
        }
        @font-face {
            font-family: 'Bookman Old Style Italic';
            font-style: italic;
            font-weight: 400;
            src: url(<?php echo FCPATH . 'assets/fonts/BookmanOldStyle-Italic.ttf';?>) format('truetype');
        }
        @font-face {
            font-family: 'Bookman Old Style Bold';
            font-style: normal;
            font-weight: 700;
            src: url(<?php echo FCPATH . 'assets/fonts/BookmanOldStyle-Bold.ttf';?>) format('truetype');
        }
        @page {
            margin: <?php echo $margin; ?>;
            padding: 0;
        }
        table, tr, td,
        p {
            margin: 0;
            padding: 0;
        }
        table {
            width: 100%;
        }
        table, tr, td {
            border: none;
            border-collapse: collapse;
            word-spacing: normal;
        }
        td > p {
            text-align: justify;
        }

        .default-table-1,
        .default-table-1 tr,
        .default-table-1 tr td {
            text-align: left;
            vertical-align: top;
        }
        
        .barang,
        .barang tr,
        .barang tr td {
            border: solid 1px #000;
            text-align: center;
            vertical-align: middle;
        }
        .barang tr td.left {
            border: solid 1px #000;
            text-align: left;
        }
        .barang tr td.right {
            border: solid 1px #000;
            text-align: right;
        }
        .barang tr td {
            padding: 0.5mm 1mm;
        }
        .regular {
            font-family: "Bookman Old Style";
            font-style: normal;
            font-weight: 400;
        }
        .italic {
            font-family: 'Bookman Old Style Italic';
            font-style: italic;
            font-weight: 400;
        }
        .bold {
            font-family: 'Bookman Old Style Bold';
            font-style: normal;
            font-weight: 700;
        }
        .size105 {
            font-size: 10.5pt;
        }
        .size9 {
            font-size: 9pt;
        }
        .line-12-8 {
            margin: 12pt 0 8pt 0;
        }
        .line-12-0 {
            margin: 12pt 0 0 0;
        }
        .line-0-8 {
            margin: 0 0 8pt 0;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <div class="regular size105" style="text-align: center;">
        <table>
            <tr>
                <td rowspan="7" style="vertical-align: bottom; width: 28mm; text-align: left;">
                    <img style="width: 24mm; margin: 3mm 2mm;" src="<?php echo FCPATH . 'assets/img/logo_unud.png';?>"/>
                </td>
            </tr>
            <tr style="text-align: center">
                <td>KEMENTERIAN PENDIDIKAN, KEBUDAYAAN,</td>
            </tr>
            <tr style="text-align: center">
                <td>RISET, DAN TEKNOLOGI</td>
            </tr>
            <tr style="text-align: center">
                <td style="font-family: 'Bookman Old Style Bold'; font-weight: 700;">UNIVERSITAS UDAYANA</td>
            </tr>
            <tr style="text-align: center">
                <td>Alamat: Jln. Raya Kampus Unud, Jimbaran, Badung, Bali 80361</td>
            </tr>
            <tr style="text-align: center">
                <td>Telepon: (0361) 701954, 701797, 701812</td>
            </tr>
            <tr style="text-align: center">
                <td>Laman: www.unud.ac.id</td>
            </tr>
        </table>
        <hr style="height:1px; border-width:0; color:#000; background-color:#000;"/>
    </div>
    <!-- Header END-->
