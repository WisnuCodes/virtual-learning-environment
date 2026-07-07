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
            transform: rotate(-15deg);
            opacity: 0.3;
            pointer-events: none;
            user-select: none;
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
        <div class="legal-stamp">Data<br>Privacy<br>Protected</div>
        <div style="max-width: 1000px; margin: 0 auto; width: 100%;">
            <a href="{{ route('home') }}" class="btn-back">
                <i class="fa-solid fa-arrow-left"></i> Kembali ke Beranda
            </a>
            <h1 class="legal-title">Kebijakan <span style="color: var(--accent-primary);">Privasi</span></h1>
            <p style="font-weight: 800; color: #64748b;">Dokumen Resmi ID: RK-PRIV-2026-002 | Terakhir diperbarui: 30 April 2026</p>
            <button onclick="window.print()" class="btn-print">
                <i class="fa-solid fa-print"></i> Cetak Dokumen
            </button>
        </div>
    </div>

    <div class="legal-container">
        <aside class="legal-nav">
            <h3 class="legal-nav-title">Navigasi</h3>
            <ul>
                <li><a href="#pengumpulan">1. Pengumpulan Data</a></li>
                <li><a href="#penggunaan">2. Penggunaan Data</a></li>
                <li><a href="#keamanan">3. Keamanan Data</a></li>
                <li><a href="#pihak-ketiga">4. Pihak Ketiga</a></li>
                <li><a href="#cookies">5. Cookies & Pelacakan</a></li>
                <li><a href="#hak-pengguna">6. Hak Pengguna</a></li>
                <li><a href="#perubahan">7. Perubahan Kebijakan</a></li>
            </ul>
        </aside>

        <main class="legal-content">
            <section id="pengumpulan">
                <h2>1. Pengumpulan Data</h2>
                <div class="section-summary">Ringkasan: Kami mengumpulkan informasi yang Anda berikan secara langsung dan data yang dihasilkan secara otomatis saat menggunakan platform.</div>
                <p>Kami mengumpulkan berbagai jenis informasi untuk menyediakan dan meningkatkan layanan kami kepada Anda:</p>
                <ul>
                    <li><strong>Data Pribadi:</strong> Nama lengkap, alamat email, nomor telepon, dan informasi profil lainnya yang Anda berikan saat pendaftaran.</li>
                    <li><strong>Data Transaksi:</strong> Detail mengenai pembayaran yang Anda lakukan (namun kami tidak menyimpan detail kartu kredit/debit secara langsung).</li>
                    <li><strong>Data Penggunaan:</strong> Informasi tentang bagaimana Anda mengakses platform, durasi belajar, kursus yang diikuti, dan progres materi.</li>
                    <li><strong>Data Teknis:</strong> Alamat IP, jenis browser, versi sistem operasi, dan perangkat yang digunakan untuk mengakses RuangKelas.</li>
                </ul>
            </section>

            <section id="penggunaan">
                <h2>2. Penggunaan Data</h2>
                <div class="section-summary">Ringkasan: Data Anda digunakan untuk personalisasi pengalaman belajar, memproses transaksi, dan meningkatkan layanan kami.</div>
                <p>Informasi yang kami kumpulkan digunakan untuk tujuan berikut:</p>
                <ul>
                    <li>Menyediakan dan memelihara layanan platform kami.</li>
                    <li>Memberitahukan Anda tentang perubahan pada layanan atau update materi kursus baru.</li>
                    <li>Memungkinkan Anda untuk berinteraksi dengan fitur Q&A dan diskusi instruktur.</li>
                    <li>Memberikan dukungan teknis dan menanggapi permintaan bantuan Anda.</li>
                    <li>Menganalisis penggunaan platform guna pengembangan fitur yang lebih baik di masa depan.</li>
                    <li>Mendeteksi, mencegah, dan mengatasi masalah teknis atau upaya penipuan.</li>
                </ul>
            </section>

            <section id="keamanan">
                <h2>3. Keamanan Data</h2>
                <div class="section-summary">Ringkasan: Kami menggunakan enkripsi standar industri untuk melindungi data Anda, namun tidak ada sistem yang 100% aman.</div>
                <p>Keamanan data Anda adalah prioritas kami. Kami mengimplementasikan protokol keamanan fisik, elektronik, dan manajerial untuk menjaga informasi Anda:</p>
                <ul>
                    <li>Penggunaan enkripsi SSL (Secure Socket Layer) untuk setiap pengiriman data sensitif.</li>
                    <li>Audit keamanan berkala pada server dan database kami.</li>
                    <li>Pembatasan akses data hanya kepada staf internal yang membutuhkan informasi tersebut untuk operasional.</li>
                </ul>
                <p>Meskipun kami berupaya menggunakan cara yang diterima secara komersial untuk melindungi Data Pribadi Anda, kami tidak dapat menjamin keamanan absolutnya.</p>
            </section>

            <section id="pihak-ketiga">
                <h2>4. Pihak Ketiga</h2>
                <div class="section-summary">Ringkasan: Kami bekerja sama dengan penyedia layanan eksternal tepercaya untuk pembayaran dan analitik.</div>
                <p>Kami dapat mempekerjakan perusahaan pihak ketiga untuk memfasilitasi layanan kami:</p>
                <ul>
                    <li><strong>Payment Gateways:</strong> Untuk memproses transaksi pembayaran secara aman.</li>
                    <li><strong>Analitik:</strong> Seperti Google Analytics untuk memantau dan menganalisis penggunaan layanan kami.</li>
                    <li><strong>Layanan Email:</strong> Untuk mengirimkan notifikasi transaksi, reset password, dan newsletter.</li>
                </ul>
                <p>Pihak ketiga ini memiliki akses ke Data Pribadi Anda hanya untuk melakukan tugas-tugas ini atas nama kami dan berkewajiban untuk tidak mengungkapkan atau menggunakannya untuk tujuan lain.</p>
            </section>

            <section id="cookies">
                <h2>5. Cookies & Pelacakan</h2>
                <div class="section-summary">Ringkasan: Kami menggunakan cookies untuk mengingat preferensi Anda dan menjaga sesi login tetap aktif.</div>
                <p>Cookies adalah file kecil yang disimpan di perangkat Anda. Kami menggunakan cookies untuk:</p>
                <ul>
                    <li>Menjaga Anda tetap terhubung (sesi login).</li>
                    <li>Mengingat preferensi bahasa atau pengaturan dashboard.</li>
                    <li>Menganalisis performa halaman web kami.</li>
                </ul>
                <p>Anda dapat menginstruksikan browser Anda untuk menolak semua cookies atau untuk menunjukkan kapan cookies sedang dikirim. Namun, jika Anda tidak menerima cookies, Anda mungkin tidak dapat menggunakan beberapa bagian dari layanan kami.</p>
            </section>

            <section id="hak-pengguna">
                <h2>6. Hak Pengguna</h2>
                <div class="section-summary">Ringkasan: Anda memiliki hak penuh untuk mengakses, memperbarui, atau meminta penghapusan data pribadi Anda.</div>
                <p>Sesuai dengan regulasi perlindungan data, Anda memiliki hak untuk:</p>
                <ul>
                    <li>Meminta akses ke data pribadi yang kami simpan tentang Anda.</li>
                    <li>Meminta koreksi jika terdapat data yang tidak akurat.</li>
                    <li>Meminta penghapusan akun dan seluruh data pribadi terkait.</li>
                    <li>Menolak penggunaan data Anda untuk tujuan pemasaran langsung.</li>
                </ul>
                <p>Untuk menggunakan hak-hak ini, silakan hubungi kami melalui saluran dukungan resmi yang tersedia.</p>
            </section>

            <section id="perubahan">
                <h2>7. Perubahan Kebijakan</h2>
                <p>Kami dapat memperbarui Kebijakan Privasi kami dari waktu ke waktu. Kami akan memberitahu Anda tentang perubahan apa pun dengan memposting Kebijakan Privasi baru di halaman ini.</p>
                <p>Anda disarankan untuk meninjau Kebijakan Privasi ini secara berkala untuk setiap perubahan. Perubahan pada Kebijakan Privasi ini efektif saat diposting di halaman ini.</p>
            </section>

            <div class="legal-card" style="background: #000; color: #fff; margin-top: 80px;">
                <h3 style="font-size: 18px; font-weight: 950; text-transform: uppercase; margin-bottom: 15px;">Hubungi Tim Privasi Kami</h3>
                <p style="color: #94a3b8; font-size: 14px;">Jika Anda memiliki pertanyaan tentang Kebijakan Privasi ini, silakan hubungi kami:</p>
                <a href="mailto:privacy@ruangkelas.com" style="color: var(--accent-primary); font-weight: 900; text-decoration: none; font-size: 14px;">PRIVACY@RUANGKELAS.COM <i class="fa-solid fa-arrow-right"></i></a>
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
