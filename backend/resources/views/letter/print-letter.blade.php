<html>

<head>
    <meta charset="UTF-8">
    {{-- <link href="https://fonts.googleapis.com/css?family=Signika" rel="stylesheet" type="text/css"> --}}
    <title>{{ $data->user->name." - ".Carbon\Carbon::now()->setTimezone('Asia/Jakarta')->locale('id_ID')->translatedFormat('l, d F Y') }}</title>
    <style media="all">
        *,
        *:before,
        *:after {
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            -webkit-print-color-adjust: exact !important;
            /* Chrome, Safari */
            color-adjust: exact !important;
            box-sizing: border-box;
        }

        body {
            width: 210mm;
            height: 100%;
            line-height: 80%;
            margin: 0;
            padding: 0;
            /* your background image should have dimensions of 2588x3338 pixels. */
            background-image: url('{{ public_path('anica_bg.png') }}');
            background-size: 8.5in 11in;
            background-repeat: no-repeat;
        }

        .page {
            page-break-after: always;
            position: relative;
            width: 8.5in;
            height: 11in;
        }

        .page-content {
            position: absolute;
            width: 8.125in;
            height: 10.625in;
            left: 0.1875in;
            top: 0.1875in;
            background-color: rgba(0, 0, 0, 0);
        }

        .text {
            position: relative;
            top: 317px;
            width: 7in;
            margin: 0 auto;
            /* font-family: 'Signika'; */
            font-size: 12pt;
            line-height: 13pt;
        }

        .green-text {
            color: #73a044;
        }

        .date {
            float: right;
        }

        #footer {
            position: absolute;
            left: 64px;
            bottom: 32px;
            font-family: 'Signika';
            font-size: 10pt;
            text-align: left;
            color: #73a044;
        }

        #line {
            position: absolute;
            left: 123px;
            top: -20px;
            width: 5.5in;
            height: 5px;
            border-top: 1px solid #106387;
        }

        /* your main logo should have dimensions of at least 240x220 pixels. */
        #main-logo {
            position: absolute;
            left: 515px;
            top: 4px;
            width: 2in;
            height: .3in;
        }

        @page {
            size: A4;
            margin: 0;
        }

        @media print {
            html, body {
                -webkit-box-sizing: border-box;
                -moz-box-sizing: border-box;
                -webkit-print-color-adjust: exact !important;
                /* Chrome, Safari */
                color-adjust: exact !important;
                box-sizing: border-box;
                width: 210mm;
                height: 100%;
            }

            @page {
                size: A4;
                margin: 0mm;
            }

            @page :blank {
                @top-left-corner {
                    content: null
                }

                @top-right-corner {
                    content: null
                }

                @bottom-left-corner {
                    content: null
                }

                @bottom-right-corner {
                    content: null
                }
            }
        }
    </style>
</head>

<body id="printable">
    <div class="page">
        <div class="page-content">
            <div id="main-logo"><img src="{{ asset('logo.png') }}" width="240px"></div>
            <div class="text">
                <span class="date">{{ Carbon\Carbon::now()->setTimezone('Asia/Jakarta')->locale('id_ID')->translatedFormat('l, d F Y') }}</span>{{-- April 30, 2018 --}}
                <br><br>
                Salam {{ $data->user->name }},<br><br>
                Terima kasih telah memilih Depok Bersih sebagai mitra kebersihan Anda. Kami berkomitmen untuk menyediakan
                pelayanan dengan
                tingkat layanan tertinggi dan solusi pembersihan paling inovatif.<br><br>
                Surat pernyataan kebersihan ini memiliki kegunaan utama sebagai berikut:<br><br>
                <ul style="list-style-type: disc;">

                    <li><span class="green-text">Menjadikan surat ini sebagai lampiran surat resmi. </span>Dengan melakukan validasi
                        di <br> <span class="green-text">www.depokbersih.org</span>, anda bisa melihat klaim, keaslian dan tanggal kadaluwarsa surat tersebut.<br><br></li>

                </ul>

                Depok Bersih adalah mitra kebersihan. Kami berharap Anda akan memanfaatkan layanan yang
                kami
                persembahkan, semuanya dirancang dengan mempertimbangkan kesehatan optimal Anda.<br><br>
                Kami tersedia untuk terhubung dengan Anda kapan saja di Portal, melalui
                www.depokbersih.org<br><br>
                Hormat kami,<br><br>
                <span class="green-text">Tim Hubungan Masyarakat Depok Bersih</span>
            </div>
            <div id="footer">
                <img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')
                ->merge('logo.png', 0.2, true)
                ->size(270)->errorCorrection('H')
                ->generate($data? $data->signature : 'Make me into an QrCode!')) !!}">
            </div>
        </div>
    </div>
</body>

</html>