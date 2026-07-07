@extends('layouts.app')

@section('content')
    <style>
        .legal-hero {
            background-color: var(--bg-primary);
            padding: 40px 5% 40px;
            border-bottom: 3px solid #000;
            position: relative;
            background-image: radial-gradient(#cbd5e1 1px, transparent 1px);
            background-size: 24px 24px;
        }

        .btn-back {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            background: #fff;
            color: #000;
            border: 3px solid #000;
            padding: 10px 20px;
            font-weight: 900;
            font-size: 13px;
            text-transform: uppercase;
            text-decoration: none;
            box-shadow: 4px 4px 0px 0px #000;
            transition: 0.2s;
            margin-bottom: 30px;
        }

        .btn-back:hover {
            transform: translate(-2px, -2px);
            box-shadow: 6px 6px 0px 0px var(--accent-primary);
        }

        .legal-title {
            font-size: 48px;
            font-weight: 950;
            text-transform: uppercase;
            letter-spacing: -2px;
            margin-bottom: 10px;
            line-height: 1;
        }

        .legal-container {
            max-width: 1000px;
            margin: 0 auto;
            padding: 60px 5%;
            display: grid;
            grid-template-columns: 280px 1fr;
            gap: 60px;
        }

        .legal-nav {
            position: sticky;
            top: 100px;
            height: fit-content;
        }

        .legal-nav-title {
            font-size: 14px;
            font-weight: 950;
            text-transform: uppercase;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 3px solid #000;
        }

        .legal-nav ul {
            list-style: none;
            padding: 0;
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .legal-nav a {
            text-decoration: none;
            color: #64748b;
            font-weight: 800;
            font-size: 13px;
            transition: 0.2s;
            display: block;
        }

        .legal-nav a:hover, .legal-nav a.active {
            color: #000;
            transform: translateX(5px);
        }

        .legal-content section {
            margin-bottom: 80px;
            scroll-margin-top: 100px;
        }

        .section-summary {
            background: #f1f5f9;
            border-left: 5px solid var(--accent-primary);
            padding: 20px;
            margin-bottom: 25px;
            font-size: 14px;
            font-weight: 700;
            color: #475569;
        }

        .legal-content h2 {
            font-size: 28px;
            font-weight: 950;
            text-transform: uppercase;
            margin-bottom: 25px;
            display: flex;
            align-items: center;
            gap: 15px;
            letter-spacing: -1px;
        }

        .legal-content h2::before {
            content: '§';
            color: var(--accent-primary);
            font-size: 32px;
        }

        .legal-content p {
            font-size: 15px;
            line-height: 1.8;
            font-weight: 700;
            color: #334155;
            margin-bottom: 20px;
            text-align: justify;
        }

        .legal-stamp {
            position: absolute;
            top: 20px;
            right: 5%;
            width: 120px;
            height: 120px;
            border: 4px double var(--accent-primary);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            font-size: 10px;
            font-weight: 950;
            text-transform: uppercase;
            color: var(--accent-primary);
            transform: rotate(15deg);
            opacity: 0.3;
            pointer-events: none;
            user-select: none;
        }

        .btn-print {
            background: #000;
            color: #fff;
            border: 3px solid #000;
            padding: 10px 20px;
            font-weight: 900;
            font-size: 13px;
            text-transform: uppercase;
            text-decoration: none;
            box-shadow: 4px 4px 0px 0px var(--accent-primary);
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            margin-top: 20px;
        }

        @media print {
            .legal-nav, .btn-back, .btn-print, .legal-hero, footer, .navbar {
                display: none !important;
            }
            .legal-container {
                display: block;
                padding: 0;
            }
            .legal-content {
                width: 100%;
            }
        }

        .legal-content ul, .legal-content ol {
            padding-left: 20px;
            margin-bottom: 25px;
        }

        .legal-content li {
            font-size: 15px;
            font-weight: 700;
            color: #475569;
            margin-bottom: 12px;
            line-height: 1.5;
        }

        .legal-card {
            background: #fff;
            border: 3px solid #000;
            padding: 30px;
            box-shadow: 10px 10px 0px 0px #000;
            margin-top: 40px;
        }

        @media (max-width: 850px) {
            .legal-container {
                grid-template-columns: 1fr;
            }
            .legal-nav {
                display: none;
            }
        }
    </style>

    <div class="legal-hero">
        <div class="legal-stamp">Official<br>Legal<br>Document</div>
        <div style="max-width: 1000px; margin: 0 auto; width: 100%;">
            <a href="{{ route('home') }}" class="btn-back">
                <i class="fa-solid fa-arrow-left"></i> Kembali ke Beranda
            </a>
            <h1 class="legal-title">Syarat & <span style="color: var(--accent-primary);">Ketentuan</span></h1>
            <p style="font-weight: 800; color: #64748b;">Dokumen Resmi ID: RK-LMS-2026-001 | Terakhir diperbarui: 30 April 2026</p>
            <button onclick="window.print()" class="btn-print">
                <i class="fa-solid fa-print"></i> Cetak Dokumen
            </button>
        </div>
    </div>

    <div class="legal-container">
        <aside class="legal-nav">
            <h3 class="legal-nav-title">Navigasi</h3>
            <ul>
                <li><a href="#umum">1. Ketentuan Umum</a></li>
                <li><a href="#akun">2. Pendaftaran Akun</a></li>
                <li><a href="#pembayaran">3. Pembayaran & Harga</a></li>
                <li><a href="#refund">4. Kebijakan Pengembalian</a></li>
                <li><a href="#konten">5. Hak Kekayaan Intelektual</a></li>
                <li><a href="#instruktur">6. Ketentuan Instruktur</a></li>
                <li><a href="#tanggungjawab">7. Batasan Tanggung Jawab</a></li>
                <li><a href="#hukum">8. Hukum & Sengketa</a></li>
                <li><a href="#sanksi">9. Sanksi & Pelanggaran</a></li>
            </ul>
        </aside>

        <main class="legal-content">
            <section id="umum">
                <h2>1. Ketentuan Umum</h2>
                <div class="section-summary">Ringkasan: Dengan menggunakan RuangKelas, Anda setuju untuk mengikuti semua aturan yang ditetapkan dalam dokumen ini secara hukum.</div>
                <p>Dokumen Syarat dan Ketentuan ini merupakan perjanjian yang mengikat secara hukum antara Anda ("Pengguna", "Siswa", atau "Instruktur") dan RuangKelas LMS Pro ("Kami", "Platform"). Layanan ini mencakup seluruh fitur, fungsi, dan antarmuka yang disediakan melalui domain web kami.</p>
                <p>Kami berhak untuk mengubah, memodifikasi, atau memperbarui ketentuan ini kapan saja tanpa pemberitahuan tertulis sebelumnya. Anda diharapkan untuk meninjau halaman ini secara berkala untuk memastikan kepatuhan terhadap standar terbaru.</p>
            </section>

            <section id="akun">
                <h2>2. Pendaftaran Akun</h2>
                <div class="section-summary">Ringkasan: Anda bertanggung jawab penuh atas keamanan akun dan semua aktivitas yang dilakukan di dalamnya.</div>
                <p>Untuk menggunakan fitur-fitur premium, Anda diwajibkan membuat akun yang valid. Berikut adalah protokol keamanan yang harus dipatuhi:</p>
                <ul>
                    <li><strong>Kapasitas Hukum:</strong> Anda menyatakan bahwa Anda telah berusia minimal 18 tahun atau memiliki izin orang tua/wali untuk menggunakan layanan ini.</li>
                    <li><strong>Akurasi Data:</strong> Seluruh data yang dimasukkan dalam formulir profil harus merupakan data asli dan dapat dipertanggungjawabkan kebenarannya.</li>
                    <li><strong>Larangan Berbagi:</strong> Lisensi penggunaan konten bersifat personal. Dilarang keras membagikan akses login (Email/Password) kepada orang lain.</li>
                    <li><strong>Otoritas Akun:</strong> RuangKelas memiliki wewenang penuh untuk menonaktifkan akun yang terdeteksi melakukan aktivitas mencurigakan atau bot-like behavior.</li>
                </ul>
            </section>

            <section id="pembayaran">
                <h2>3. Pembayaran & Harga</h2>
                <div class="section-summary">Ringkasan: Semua pembayaran bersifat final setelah diverifikasi, dan harga dapat berubah sesuai kebijakan platform.</div>
                <p>Sistem ekonomi platform diatur berdasarkan mekanisme pasar digital yang transparan:</p>
                <ul>
                    <li><strong>Struktur Harga:</strong> Harga yang tertera adalah nilai bersih (nett). Namun, pajak atau biaya administrasi bank mungkin berlaku tergantung pada metode pembayaran yang dipilih.</li>
                    <li><strong>Masa Berlaku:</strong> Setelah pembayaran sukses, Anda mendapatkan akses seumur hidup (*Lifetime Access*) ke materi kursus tersebut, kecuali jika akun Anda melanggar ketentuan penggunaan.</li>
                    <li><strong>Konfirmasi Manual:</strong> Untuk metode transfer bank konvensional, pengguna wajib mengunggah bukti bayar yang valid melalui dashboard transaksi.</li>
                </ul>
            </section>

            <section id="refund">
                <h2>4. Kebijakan Pengembalian (Refund)</h2>
                <div class="section-summary">Ringkasan: Refund hanya tersedia dalam 24 jam pertama jika progres belajar masih sangat rendah.</div>
                <p>RuangKelas berkomitmen pada kualitas, namun kami memiliki kebijakan ketat terkait pengembalian dana:</p>
                <ul>
                    <li><strong>Jangka Waktu:</strong> Permohonan refund wajib diajukan maksimal dalam **24 jam** setelah transaksi dinyatakan berhasil.</li>
                    <li><strong>Batas Progres:</strong> Refund tidak akan diproses jika siswa telah menonton lebih dari **10%** total durasi video atau telah mengunduh materi pendukung (PDF/Code).</li>
                    <li><strong>Alasan Teknis:</strong> Pengembalian dana akan diprioritaskan jika terdapat kesalahan sistem dari pihak RuangKelas yang menyebabkan materi tidak dapat diakses sama sekali.</li>
                </ul>
            </section>

            <section id="konten">
                <h2>5. Hak Kekayaan Intelektual</h2>
                <div class="section-summary">Ringkasan: Seluruh konten dilindungi hak cipta. Mengunduh tanpa izin atau membajak adalah tindakan ilegal.</div>
                <p>Segala bentuk konten (Video, Teks, Grafik, Logo, Kode Sumber) yang ada di platform adalah milik RuangKelas atau instruktur terkait:</p>
                <ul>
                    <li><strong>Lisensi Terbatas:</strong> Anda diberikan lisensi terbatas, non-eksklusif, dan tidak dapat dipindahtangankan untuk mengakses konten guna keperluan edukasi pribadi.</li>
                    <li><strong>Larangan Reproduksi:</strong> Dilarang merekam layar (screen record), menyalin, atau mendistribusikan konten kursus ke platform lain (seperti YouTube, Telegram, atau Drive Publik).</li>
                    <li><strong>Tindakan Hukum:</strong> Kami menggunakan sistem tracking watermark digital. Pelanggaran hak cipta akan dilaporkan ke pihak berwajib berdasarkan UU ITE dan UU Hak Cipta yang berlaku di Indonesia.</li>
                </ul>
            </section>

            <section id="instruktur">
                <h2>6. Ketentuan Instruktur</h2>
                <div class="section-summary">Ringkasan: Instruktur adalah mitra yang wajib menjaga kualitas dan etika pengajaran.</div>
                <p>Sebagai pengajar di RuangKelas, Anda setuju untuk terikat pada standar profesionalisme tingkat tinggi:</p>
                <ul>
                    <li><strong>Kualitas Materi:</strong> Video harus memenuhi standar Full HD (1080p) dengan audio yang jernih dan materi yang tidak melanggar hak cipta pihak ketiga.</li>
                    <li><strong>Sistem Revenue:</strong> Pembagian hasil adalah 70% (Instruktur) dan 30% (RuangKelas). Laporan pendapatan tersedia secara real-time di Dashboard Instruktur.</li>
                    <li><strong>Interaksi Siswa:</strong> Instruktur wajib memberikan respon pada pertanyaan siswa di kolom Q&A minimal dalam 2x24 jam.</li>
                </ul>
            </section>

            <section id="tanggungjawab">
                <h2>7. Batasan Tanggung Jawab</h2>
                <div class="section-summary">Ringkasan: Kami menyediakan platform belajar, namun hasil akhir (kesuksesan/karir) tergantung pada usaha masing-masing siswa.</div>
                <p>RuangKelas tidak bertanggung jawab atas:</p>
                <ul>
                    <li>Kegagalan siswa dalam mendapatkan pekerjaan atau sertifikasi pihak ketiga setelah menyelesaikan kursus.</li>
                    <li>Kerusakan perangkat keras atau kehilangan data akibat kesalahan penggunaan platform.</li>
                    <li>Konten atau link pihak ketiga yang mungkin disertakan oleh instruktur dalam materi pelajaran.</li>
                </ul>
            </section>

            <section id="hukum">
                <h2>8. Hukum & Sengketa</h2>
                <div class="section-summary">Ringkasan: Segala perselisihan akan diselesaikan berdasarkan hukum Republik Indonesia.</div>
                <p>Perjanjian ini diatur oleh hukum yang berlaku di negara Indonesia. Jika terjadi sengketa atau perselisihan, para pihak sepakat untuk menyelesaikannya secara kekeluargaan terlebih dahulu melalui mediasi.</p>
                <p>Apabila tidak tercapai mufakat, maka penyelesaian akan dilakukan melalui Pengadilan Negeri Jakarta Selatan atau badan arbitrase yang ditunjuk oleh RuangKelas.</p>
            </section>

            <section id="sanksi">
                <h2>9. Sanksi & Pelanggaran</h2>
                <p>Pelanggaran terhadap poin-poin di atas dapat mengakibatkan sanksi bertahap:</p>
                <ol>
                    <li><strong>Peringatan Tertulis:</strong> Untuk pelanggaran ringan (misal: spamming di forum).</li>
                    <li><strong>Penangguhan Sementara:</strong> Pembekuan akses selama 7-30 hari.</li>
                    <li><strong>Banned Permanen:</strong> Penghapusan akun tanpa refund untuk pelanggaran berat (pembajakan konten/penipuan).</li>
                </ol>
            </section>

            <div class="legal-card" style="background: #000; color: #fff; margin-top: 80px;">
                <h3 style="font-size: 18px; font-weight: 950; text-transform: uppercase; margin-bottom: 15px;">Punya Pertanyaan Hukum?</h3>
                <p style="color: #94a3b8; font-size: 14px;">Jika Anda memiliki pertanyaan mengenai Syarat & Ketentuan ini, silakan hubungi tim legal kami melalui email.</p>
                <a href="mailto:legal@ruangkelas.com" style="color: var(--accent-primary); font-weight: 900; text-decoration: none; font-size: 14px;">LEGAL@RUANGKELAS.COM <i class="fa-solid fa-arrow-right"></i></a>
            </div>
        </main>
    </div>

    <script>
        // Simple active link tracker on scroll
        window.addEventListener('scroll', () => {
            let current = '';
            const sections = document.querySelectorAll('section');
            const navLinks = document.querySelectorAll('.legal-nav a');
            
            sections.forEach(section => {
                const sectionTop = section.offsetTop;
                if (pageYOffset >= sectionTop - 150) {
                    current = section.getAttribute('id');
                }
            });

            navLinks.forEach(link => {
                link.classList.remove('active');
                if (link.getAttribute('href').includes(current)) {
                    link.classList.add('active');
                }
            });
        });
    </script>
@endsection
