<!DOCTYPE html>
<html lang="en-US">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Bowlby+One&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Red+Hat+Display:ital,wght@0,300..900;1,300..900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
        rel="stylesheet">
    <title>Telaahan Staff - {{ $telaahanStaff->nomor }}
    </title>
    <style>
        body {
            line-height: 108%;
            font-family: "Roboto", sans-serif;
            font-size: 11pt
        }

        p {
            margin: 0pt 0pt 8pt
        }

        table {
            margin-top: 0pt;
            margin-bottom: 8pt
        }

        .Footer {
            margin-bottom: 0pt;
            line-height: normal;
            font-size: 11pt
        }

        .Header {
            margin-bottom: 0pt;
            line-height: normal;
            font-family: "Roboto", sans-serif;
            font-size: 11pt
        }

        span.Hyperlink {
            text-decoration: underline;
            color: #0563c1
        }

        span.UnresolvedMention {
            color: #605e5c;
            background-color: #e1dfdd
        }

        @media (max-width: 900px) {
            img {
                max-width: 100%;
                height: auto;
            }

            .table-container {
                overflow-x: auto;
                -webkit-overflow-scrolling: touch;
            }

            table {
                width: 100%;
                border-collapse: collapse;
            }

            td,
            th {
                padding: 8px;
                text-align: left;
            }
        }
    </style>
</head>

<body>
    <div>
        <div style="clear:both">
            <table style="margin-bottom:0pt; border-collapse:collapse">
                <tr style="height:85.45pt">
                    <td
                        style="width:57.7pt; border-bottom:2.25pt solid #000000; padding-right:5.4pt; padding-left:5.4pt; vertical-align:top">
                        <p class="Header" style="text-align:center; font-size:12pt">
                            <img src="data:image/png;base64,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"
                                width="82" height="98" alt="" />
                        </p>
                    </td>
                    <td
                        style="width:399.5pt; border-bottom:2.25pt solid #000000; padding-right:5.4pt; padding-left:5.4pt; vertical-align:top">
                        <p class="Header" style="text-align:center; font-size:14pt">
                            <strong><span style="letter-spacing:4pt">PEMERINTAH KOTA
                                    BONTANG</span></strong>
                        </p>
                        <p class="Header" style="text-align:center; font-size:17pt">
                            <strong><span style="">RUMAH SAKIT UMUM DAERAH TAMAN
                                    HUSADA</span></strong>
                        </p>
                        <p class="Header" style="text-align:center; font-size:9pt">
                            <span style="font-family:Arial">JL. Let. Jend. S. Parman No. 1 Telp(0548) 22111, 23000
                                Fax.(0548) 29111 Kode Pos 75331</span>
                        </p>
                        <p class="Header" style="text-align:center">
                            <span style="font-size:9pt">E-mail : </span><a
                                href="/cdn-cgi/l/email-protection#daa8a9afbeb8b5b4aebbb4bd9aa3bbb2b5b5f4b9b5f4b3be"
                                style="text-decoration:none"><span class="Hyperlink"
                                    style="font-size:9pt; color:#000000"><span class="__cf_email__"
                                        data-cfemail="cfbdbcbaabada0a1bbaea1a88fb6aea7a0a0e1aca0e1a6ab">rsudbontang@yahoo.co.id</span></span></a><span
                                style="font-size:9pt">, Bontang - Kaltim</span>
                        </p>
                    </td>
                </tr>
            </table>
            <p class="Header">
                &#xa0;
            </p>
        </div>
        <p style="margin-bottom:0pt; text-align:center; line-height:108%; font-size:16pt">
            <strong><u>TELAAHAN STAF</u></strong>
        </p>
        <p style="margin-bottom:0pt; text-align:center; line-height:108%; font-size:12pt">
            <strong><span style="">&#xa0;</span></strong>
        </p>
        <table style="margin-bottom:0pt; border-collapse:collapse">
            <tr>
                <td style="width:108pt; padding-right:5.4pt; padding-left:5.4pt; vertical-align:top">
                    <p style="margin-bottom:0pt; text-align:justify; line-height:normal; font-size:12pt">
                        <strong>Kepada YTH</strong>
                    </p>
                </td>
                <td style="width:349.2pt; padding-right:5.4pt; padding-left:5.4pt; vertical-align:top">
                    <p style="margin-bottom:0pt; text-align:justify; line-height:normal; font-size:12pt">
                        <strong>: {{ $telaahanStaff->kepada }}</strong>
                    </p>
                </td>
            </tr>
            <tr>
                <td style="width:108pt; padding-right:5.4pt; padding-left:5.4pt; vertical-align:top">
                    <p style="margin-bottom:0pt; text-align:justify; line-height:normal; font-size:12pt">
                        <strong>Dari</strong>
                    </p>
                </td>
                <td style="width:349.2pt; padding-right:5.4pt; padding-left:5.4pt; vertical-align:top">
                    <p style="margin-bottom:0pt; text-align:justify; line-height:normal; font-size:12pt">
                        <strong>: {{ $telaahanStaff->dari }}</strong>
                    </p>
                </td>
            </tr>
            <tr>
                <td style="width:108pt; padding-right:5.4pt; padding-left:5.4pt; vertical-align:top">
                    <p style="margin-bottom:0pt; text-align:justify; line-height:normal; font-size:12pt">
                        <strong>Tanggal</strong>
                    </p>
                </td>
                <td style="width:349.2pt; padding-right:5.4pt; padding-left:5.4pt; vertical-align:top">
                    <p style="margin-bottom:0pt; text-align:justify; line-height:normal; font-size:12pt">
                        <strong>:
                            {{ \Carbon\Carbon::parse($telaahanStaff->tanggal)->translatedFormat('d F Y') }}</strong>
                    </p>
                </td>
            </tr>
            <tr>
                <td style="width:108pt; padding-right:5.4pt; padding-left:5.4pt; vertical-align:top">
                    <p style="margin-bottom:0pt; text-align:justify; line-height:normal; font-size:12pt">
                        <strong>Nomor</strong>
                    </p>
                </td>
                <td style="width:349.2pt; padding-right:5.4pt; padding-left:5.4pt; vertical-align:top">
                    <p style="margin-bottom:0pt; text-align:justify; line-height:normal; font-size:12pt">
                        <strong>: {{ $telaahanStaff->nomor }}</strong>
                    </p>
                </td>
            </tr>
            <tr style="height:19.65pt">
                <td
                    style="width:108pt; border-bottom:2.25pt solid #000000; padding-right:5.4pt; padding-left:5.4pt; vertical-align:top">
                    <p style="margin-bottom:0pt; text-align:justify; line-height:normal; font-size:12pt">
                        <strong>Perihal</strong>
                    </p>
                </td>
                <td
                    style="width:349.2pt; border-bottom:2.25pt solid #000000; padding-right:5.4pt; padding-left:5.4pt; vertical-align:top">
                    <p style="margin-bottom:0pt; text-align:justify; line-height:normal; font-size:12pt">
                        <strong>: {{ $telaahanStaff->perihal }}</strong>
                    </p>
                </td>
            </tr>
        </table>
        <p style="margin-bottom:0pt; text-align:justify; line-height:108%; font-size:12pt">
            <strong><span style="">&#xa0;</span></strong>
        </p>
        <table style="margin-bottom:0pt; border-collapse:collapse">
            <tr style="height:58.05pt">
                <td style="width:22.7pt; padding-right:5.4pt; padding-left:5.4pt; vertical-align:top">
                    <p style="margin-bottom:0pt; text-align:justify; line-height:normal; font-size:12pt">
                        <strong>I</strong>
                    </p>
                </td>
                <td style="width:81.55pt; padding-right:5.4pt; padding-left:5.4pt; vertical-align:top">
                    <p style="margin-bottom:0pt; text-align:justify; line-height:normal; font-size:12pt">
                        <strong>Persoalan</strong>
                    </p>
                </td>
                <td style="width:3.4pt; padding-right:5.4pt; padding-left:5.4pt; vertical-align:top">
                    <p style="margin-bottom:0pt; text-align:justify; line-height:normal; font-size:12pt">
                        <strong>:</strong>
                    </p>
                </td>
                <td style="width:3.7pt; padding-right:5.4pt; padding-left:5.4pt; vertical-align:top">
                    <p style="margin-bottom:0pt; text-align:justify; line-height:normal; font-size:12pt">
                        <strong>-</strong>
                    </p>
                </td>
                <td style="width:313.45pt; padding-right:5.4pt; padding-left:5.4pt; vertical-align:top">
                    <p style="margin-bottom:0pt; text-align:justify; line-height:normal; font-size:12pt">
                        {{ $telaahanStaff->persoalan }}
                    </p>
                </td>
            </tr>
            <tr style="height:56.75pt">
                <td style="width:22.7pt; padding-right:5.4pt; padding-left:5.4pt; vertical-align:top">
                    <p style="margin-bottom:0pt; text-align:justify; line-height:normal; font-size:12pt">
                        <strong>II</strong>
                    </p>
                </td>
                <td style="width:81.55pt; padding-right:5.4pt; padding-left:5.4pt; vertical-align:top">
                    <p style="margin-bottom:0pt; text-align:justify; line-height:normal; font-size:12pt">
                        <strong>Peranggapan</strong>
                    </p>
                </td>
                <td style="width:3.4pt; padding-right:5.4pt; padding-left:5.4pt; vertical-align:top">
                    <p style="margin-bottom:0pt; text-align:justify; line-height:normal; font-size:12pt">
                        <strong>:</strong>
                    </p>
                </td>
                <td style="width:3.7pt; padding-right:5.4pt; padding-left:5.4pt; vertical-align:top">
                    <p style="margin-bottom:0pt; text-align:justify; line-height:normal; font-size:12pt">
                        <strong>-</strong>
                    </p>
                </td>
                <td style="width:313.45pt; padding-right:5.4pt; padding-left:5.4pt; vertical-align:top">
                    <p style="margin-bottom:0pt; text-align:justify; line-height:normal; font-size:12pt">
                        {{ $telaahanStaff->peranggapan }}
                    </p>
                </td>
            </tr>
            <tr style="height:42pt">
                <td style="width:22.7pt; padding-right:5.4pt; padding-left:5.4pt; vertical-align:top">
                    <p style="margin-bottom:0pt; text-align:justify; line-height:normal; font-size:12pt">
                        <strong>III</strong>
                    </p>
                </td>
                <td style="width:81.55pt; padding-right:5.4pt; padding-left:5.4pt; vertical-align:top">
                    <p style="margin-bottom:0pt; line-height:normal; font-size:12pt">
                        <strong>Fakta Yang Mempengaruhi</strong>
                    </p>
                </td>
                <td style="width:3.4pt; padding-right:5.4pt; padding-left:5.4pt; vertical-align:top">
                    <p style="margin-bottom:0pt; text-align:justify; line-height:normal; font-size:12pt">
                        <strong>:</strong>
                    </p>
                </td>
                <td style="width:3.7pt; padding-right:5.4pt; padding-left:5.4pt; vertical-align:top">
                    <p style="margin-bottom:0pt; text-align:justify; line-height:normal; font-size:12pt">
                        <strong>-</strong>
                    </p>
                </td>
                <td style="width:313.45pt; padding-right:5.4pt; padding-left:5.4pt; vertical-align:top">
                    <p style="margin-bottom:0pt; text-align:justify; line-height:normal; font-size:12pt">
                        {{ $telaahanStaff->fakta }}
                    </p>
                </td>
            </tr>
            <tr style="height:56.05pt">
                <td style="width:22.7pt; padding-right:5.4pt; padding-left:5.4pt; vertical-align:top">
                    <p style="margin-bottom:0pt; text-align:justify; line-height:normal; font-size:12pt">
                        <strong>IV</strong>
                    </p>
                </td>
                <td style="width:81.55pt; padding-right:5.4pt; padding-left:5.4pt; vertical-align:top">
                    <p style="margin-bottom:0pt; text-align:justify; line-height:normal; font-size:12pt">
                        <strong>Analisa</strong>
                    </p>
                </td>
                <td style="width:3.4pt; padding-right:5.4pt; padding-left:5.4pt; vertical-align:top">
                    <p style="margin-bottom:0pt; text-align:justify; line-height:normal; font-size:12pt">
                        <strong>:</strong>
                    </p>
                </td>
                <td style="width:3.7pt; padding-right:5.4pt; padding-left:5.4pt; vertical-align:top">
                    <p style="margin-bottom:0pt; text-align:justify; line-height:normal; font-size:12pt">
                        <strong>-</strong>
                    </p>
                </td>
                <td style="width:313.45pt; padding-right:5.4pt; padding-left:5.4pt; vertical-align:top">
                    <p style="margin-bottom:0pt; text-align:justify; line-height:normal; font-size:12pt">
                        {{ $telaahanStaff->analisa }}
                    </p>
                </td>
            </tr>
            <tr style="height:134.15pt">
                <td style="width:22.7pt; padding-right:5.4pt; padding-left:5.4pt; vertical-align:top">
                    <p style="margin-bottom:0pt; text-align:justify; line-height:normal; font-size:12pt">
                        <strong>V</strong>
                    </p>
                </td>
                <td style="width:81.55pt; padding-right:5.4pt; padding-left:5.4pt; vertical-align:top">
                    <p style="margin-bottom:0pt; text-align:justify; line-height:normal; font-size:12pt">
                        <strong>Kesimpulan</strong>
                    </p>
                </td>
                <td style="width:3.4pt; padding-right:5.4pt; padding-left:5.4pt; vertical-align:top">
                    <p style="margin-bottom:0pt; text-align:justify; line-height:normal; font-size:12pt">
                        <strong>:</strong>
                    </p>
                </td>
                <td style="width:3.7pt; padding-right:5.4pt; padding-left:5.4pt; vertical-align:top">
                    <p style="margin-bottom:0pt; text-align:justify; line-height:normal; font-size:12pt">
                        <strong>-</strong>
                    </p>
                </td>
                <td style="width:313.45pt; padding-right:5.4pt; padding-left:5.4pt; vertical-align:top">
                    <p style="margin-bottom:0pt; text-align:justify; line-height:normal; font-size:12pt">
                        {{ $telaahanStaff->kesimpulan }}
                    </p>
                    @if ($telaahanStaff->jenis_permintaan_id === 1)
    <table
        style="margin-bottom:0pt; padding-top:8pt; border:1pt solid #000000; border-collapse:collapse">
        <tr>
            <td
                style="width:14.1pt; border-right:1pt solid #000000; border-bottom:1pt solid #000000; padding-right:4.9pt; padding-left:4.9pt; vertical-align:top">
                <p style="margin-bottom:0pt; text-align:center; line-height:normal; font-size:12pt">
                    No
                </p>
            </td>
            <td
                style="width:156.95pt; border-right:1pt solid #000000; border-left:1pt solid #000000; border-bottom:1pt solid #000000; padding-right:4.9pt; padding-left:4.9pt; vertical-align:top">
                <p style="margin-bottom:0pt; text-align:center; line-height:normal; font-size:12pt">
                    Nama Barang / Keterangan
                </p>
            </td>
            <td
                style="width:67.15pt; border-left:1pt solid #000000; border-bottom:1pt solid #000000; padding-right:4.9pt; padding-left:4.9pt; vertical-align:top">
                <p style="margin-bottom:0pt; text-align:center; line-height:normal; font-size:12pt">
                    Jumlah
                </p>
            </td>
        </tr>

        @foreach ($telaahanStaff->permintaanBarang as $index => $barang)
            <tr style="height:37.4pt">
                <td
                    style="width:14.1pt; border-top:1pt solid #000000; border-right:1pt solid #000000; border-bottom:1pt solid #000000; padding-right:4.9pt; padding-left:4.9pt; vertical-align:middle">
                    <p style="margin-bottom:0pt; text-align:center; line-height:normal; font-size:12pt">
                        {{ $index + 1 }}
                    </p>
                </td>
                <td
                    style="width:156.95pt; border:1pt solid #000000; padding-right:4.9pt; padding-left:4.9pt; vertical-align:middle">
                    <p style="margin-bottom:0pt; text-align:left; line-height:normal; font-size:12pt">
                        {{ $barang->nama }}
                    </p>
                </td>
                <td
                    style="width:67.15pt; border-top:1pt solid #000000; border-left:1pt solid #000000; border-bottom:1pt solid #000000; padding-right:4.9pt; padding-left:4.9pt; vertical-align:middle">
                    <p style="margin-bottom:0pt; text-align:center; line-height:normal; font-size:12pt">
                        {{ $barang->kuantitas }} unit
                    </p>
                </td>
            </tr>
        @endforeach
    </table>
@endif

                    <p style="margin-bottom:0pt; text-align:justify; line-height:normal; font-size:12pt">
                    </p>
                </td>
            </tr>
        </table>
         @if ($telaahanStaff->jenis_permintaan_id === 1)
        <p>
            <br style="page-break-before:always; clear:both">
        </p>
        <p>
            <br style="page-break-before:always; clear:both">
        </p>
        <p>
            <br style="page-break-before:always; clear:both">
        </p>
        <p>
            <br style="page-break-before:always; clear:both">
        </p>
        @endif

        <table style="margin-bottom:0pt; border-collapse:collapse">
            <tr style="height:41.8pt">
                <td style="width:22.7pt; padding-right:5.4pt; padding-left:5.4pt; vertical-align:top">
                    <p style="margin-bottom:0pt; text-align:justify; line-height:normal; font-size:12pt">
                        <strong>VI</strong>
                    </p>
                </td>
                <td style="width:81.55pt; padding-right:5.4pt; padding-left:5.4pt; vertical-align:top">
                    <p style="margin-bottom:0pt; text-align:justify; line-height:normal; font-size:12pt">
                        <strong>Saran</strong>
                    </p>
                </td>
                <td style="width:3.4pt; padding-right:5.4pt; padding-left:5.4pt; vertical-align:top">
                    <p style="margin-bottom:0pt; text-align:justify; line-height:normal; font-size:12pt">
                        <strong>:</strong>
                    </p>
                </td>
                <td style="width:3.7pt; padding-right:5.4pt; padding-left:5.4pt; vertical-align:top">
                    <p style="margin-bottom:0pt; text-align:justify; line-height:normal; font-size:12pt">
                        <strong>-</strong>
                    </p>
                </td>
                <td style="width:313.45pt; padding-right:5.4pt; padding-left:5.4pt; vertical-align:top">
                    <p style="margin-bottom:0pt; text-align:justify; line-height:normal; font-size:12pt">
                        {{ $telaahanStaff->saran }}
                    </p>
                </td>
            </tr>
        </table>
        <p style="margin-bottom:0pt; text-align:justify; line-height:108%; font-size:12pt">
            <strong><span style="">&#xa0;</span></strong>
        </p>
        <table style="margin-bottom:0pt; border-collapse:collapse">
            <tr>
                <td style="width:228.6pt; padding-right:5.4pt; padding-left:5.4pt; vertical-align:top">
                    <p style="margin-bottom:0pt; text-align:justify; line-height:normal; font-size:12pt">
                        Mengetahui,
                    </p>
                    <p style="margin-bottom:0pt; text-align:justify; line-height:normal; font-size:12pt">
                        {{ $telaahanStaff->wadir }},
                    </p>
                </td>
                <td style="width:228.6pt; padding-right:5.4pt; padding-left:5.4pt; vertical-align:top">
                    <p style="margin-bottom:0pt; text-align:justify; line-height:normal; font-size:12pt">
                        {{ $telaahanStaff->dari }}
                    </p>
                </td>
            </tr>
            <tr style="height:89.3pt">
                <td
                    style="width:228.6pt; padding-top:5rem; padding-right:5.4pt; padding-left:5.4pt; vertical-align:top">
                    <p style="margin-bottom:0pt; text-align:justify; line-height:normal; font-size:12pt">
                        <strong>&#xa0;</strong>
                    </p>
                </td>
                <td
                    style="width:228.6pt; padding-top:5rem; padding-right:5.4pt; padding-left:5.4pt; vertical-align:top">
                    <p style="margin-bottom:0pt; text-align:justify; line-height:normal; font-size:12pt">
                        <strong>&#xa0;</strong>
                    </p>
                </td>
            </tr>
            <tr>
                <td style="width:228.6pt; padding-right:5.4pt; padding-left:5.4pt; vertical-align:top">
                    <p style="margin-bottom:0pt; text-align:justify; line-height:normal; font-size:12pt">
                        <u>{{ $telaahanStaff->nama_wadir }}</u>
                    </p>
                    <p style="margin-bottom:0pt; text-align:justify; line-height:normal; font-size:12pt">
                        NIP. {{ $telaahanStaff->nip_wadir }}
                    </p>
                </td>
                <td style="width:228.6pt; padding-right:5.4pt; padding-left:5.4pt; vertical-align:top">
                    <p style="margin-bottom:0pt; text-align:justify; line-height:normal; font-size:12pt">
                        <u>{{ $telaahanStaff->nama_kabid }}</u>
                    </p>
                    <p style="margin-bottom:0pt; text-align:justify; line-height:normal; font-size:12pt">
                        NIP. {{ $telaahanStaff->nip_kabid }}
                    </p>
                </td>
            </tr>
        </table>
        @foreach ($telaahanStaff->lampiran as $index => $lampiran)
            <!-- Mulai halaman baru untuk setiap lampiran -->
            <div style="page-break-before:always;">
                <p style="margin-bottom:0pt; text-align:justify; line-height:108%; font-size:12pt">
                    <strong><span style="">&#xa0;</span></strong>
                </p>
                <p style="line-height:108%; font-size:12pt">
                    <br style="page-break-before:always; clear:both" />
                </p>
                <p style="margin-bottom:0pt; margin-bottom:1rem; text-align:justify; line-height:108%; font-size:12pt">
                    Lampiran {{ $index + 1 }}. {{ $lampiran->keterangan }}
                </p>
                <p style="margin-bottom:0pt; text-align:justify; line-height:108%; font-size:12pt">
                    @if ($lampiran->base64)
                        <img src="{{ $lampiran->base64 }}" alt="Gambar Lampiran {{ $index + 1 }}"
                            style="max-width:100%; height:auto;" />
                    @else
                        <span>Gambar tidak ditemukan</span>
                    @endif
                </p>
                <p style="margin-bottom:0pt; text-align:justify; line-height:108%; font-size:12pt">
                    &#xa0;
                </p>
            </div>
        @endforeach
        <div style="clear:both">
            <p class="Footer">
                &#xa0;
            </p>
        </div>
    </div>
    <script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
</body>

</html>
