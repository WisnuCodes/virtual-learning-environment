<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Sertifikat Penyelesaian - {{ $course->title }}</title>
    <style>
        @page {
            margin: 0;
            size: a4 landscape;
        }
        html, body {
            margin: 0;
            padding: 0;
            width: 100%;
            height: 100%;
            background-color: #ffffff;
            font-family: 'Helvetica', 'Arial', sans-serif;
            color: #0f172a;
        }
        .wrapper {
            width: 100%;
            height: 100%;
            padding: 20px;
            box-sizing: border-box;
            background-color: #f8fafc;
        }
        .border-outer {
            width: 100%;
            height: 100%;
            border: 15px solid #1e293b;
            background-color: #ffffff;
            box-sizing: border-box;
            padding: 5px;
        }
        .border-inner {
            width: 100%;
            height: 100%;
            border: 2px solid #10b981;
            box-sizing: border-box;
            position: relative;
        }
        
        /* Centering Table */
        .layout-table {
            width: 100%;
            height: 100%;
            border-collapse: collapse;
        }
        .content-cell {
            vertical-align: middle;
            text-align: center;
            padding: 40px;
        }

        /* Corner ornaments */
        .corner {
            position: absolute;
            width: 60px;
            height: 60px;
            border: 4px solid #10b981;
            z-index: 5;
        }
        .top-left { top: -2px; left: -2px; border-right: none; border-bottom: none; }
        .top-right { top: -2px; right: -2px; border-left: none; border-bottom: none; }
        .bottom-left { bottom: -2px; left: -2px; border-right: none; border-top: none; }
        .bottom-right { bottom: -2px; right: -2px; border-left: none; border-top: none; }

        .header-logo {
            font-size: 12px;
            font-weight: bold;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: 5px;
            margin-bottom: 20px;
        }
        .header-logo span { color: #10b981; }

        .main-heading {
            font-size: 52px;
            font-weight: bold;
            margin: 0;
            color: #1e293b;
            text-transform: uppercase;
            letter-spacing: 12px;
            font-family: 'Times-Bold', serif;
        }
        
        .sub-heading {
            font-size: 14px;
            color: #10b981;
            text-transform: uppercase;
            letter-spacing: 8px;
            font-weight: bold;
            margin-top: 5px;
        }

        .presentation-text {
            font-size: 16px;
            color: #64748b;
            margin: 30px 0 10px 0;
            font-style: italic;
        }

        .recipient-name {
            font-size: 44px;
            font-weight: bold;
            color: #1e293b;
            margin: 5px 0;
            border-bottom: 2px solid #e2e8f0;
            display: inline-block;
            padding: 0 30px 5px 30px;
            font-family: 'Times-Bold', serif;
        }

        .course-description {
            font-size: 14px;
            color: #475569;
            line-height: 1.5;
            margin: 25px auto;
            max-width: 650px;
        }

        .course-name {
            font-size: 20px;
            font-weight: bold;
            color: #10b981;
            display: block;
            margin: 8px 0;
            text-transform: uppercase;
        }

        .footer-table {
            width: 100%;
            margin-top: 30px;
        }
        
        .sig-cell {
            text-align: center;
            width: 33%;
            vertical-align: bottom;
        }

        .sig-line {
            border-top: 1.5px solid #1e293b;
            margin: 0 30px 8px 30px;
            padding-top: 8px;
        }

        .sig-name {
            font-weight: bold;
            font-size: 14px;
            color: #1e293b;
        }

        .sig-title {
            font-size: 11px;
            color: #64748b;
            text-transform: uppercase;
        }

        .seal-box {
            width: 100px;
            height: 100px;
            background-color: #10b981;
            border-radius: 50%;
            margin: 0 auto;
            padding: 5px;
            box-sizing: border-box;
        }

        .seal-inner {
            width: 100%;
            height: 100%;
            border: 2px dashed #ffffff;
            border-radius: 50%;
            display: table;
        }

        .seal-text {
            display: table-cell;
            vertical-align: middle;
            text-align: center;
            color: #ffffff;
            font-size: 9px;
            font-weight: bold;
            text-transform: uppercase;
        }

        .meta-info {
            position: absolute;
            bottom: 15px;
            left: 0;
            right: 0;
            text-align: center;
            font-size: 9px;
            color: #94a3b8;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="border-outer">
            <div class="border-inner">
                <!-- Ornaments -->
                <div class="corner top-left"></div>
                <div class="corner top-right"></div>
                <div class="corner bottom-left"></div>
                <div class="corner bottom-right"></div>

                <table class="layout-table">
                    <tr>
                        <td class="content-cell">
                            <div class="header-logo">RUANG<span>KELAS.</span> ACADEMY</div>
                            
                            <h1 class="main-heading">SERTIFIKAT</h1>
                            <div class="sub-heading">PENYELESAIAN KURSUS</div>
                            
                            <div class="presentation-text">Dengan bangga kami anugerahkan kepada:</div>
                            
                            <div class="recipient-name">{{ $user->name }}</div>
                            
                            <div class="course-description">
                                Atas keberhasilan dan dedikasi luar biasa dalam menyelesaikan program pelatihan profesional:
                                <span class="course-name">"{{ $course->title }}"</span>
                                Program ini diselenggarakan oleh RuangKelas Academy dengan kurikulum standar industri.
                            </div>
                            
                            <table class="footer-table">
                                <tr>
                                    <td class="sig-cell">
                                        <div class="sig-line">
                                            <div class="sig-name">{{ $course->user->name }}</div>
                                            <div class="sig-title">Instruktur Kursus</div>
                                        </div>
                                    </td>
                                    <td class="sig-cell">
                                        <div class="seal-box">
                                            <div class="seal-inner">
                                                <div class="seal-text">
                                                    OFFICIAL<br>VERIFIED<br>2026
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="sig-cell">
                                        <div class="sig-line">
                                            <div class="sig-name">{{ $certificate->created_at->format('d F Y') }}</div>
                                            <div class="sig-title">Tanggal Terbit</div>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>

                <div class="meta-info">
                    ID SERTIFIKAT: <strong>{{ $certificate->certificate_code }}</strong> &nbsp; | &nbsp; 
                    VERIFIKASI ONLINE: {{ route('certificate.verify', $certificate->certificate_code) }}
                </div>
            </div>
        </div>
    </div>
</body>
</html>
