@extends('layouts.app')

@section('content')
    <style>
        .hc-hero {
            background-color: var(--bg-primary);
            padding: 40px 5% 60px;
            border-bottom: 3px solid #000;
            position: relative;
            overflow: hidden;
            background-image: radial-gradient(#cbd5e1 1px, transparent 1px);
            background-size: 24px 24px;
            text-align: center;
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
            position: absolute;
            top: 30px;
            left: 5%;
            z-index: 100;
        }

        .btn-back:hover {
            transform: translate(-2px, -2px);
            box-shadow: 6px 6px 0px 0px var(--accent-primary);
        }

        .hc-title {
            font-size: 56px;
            font-weight: 950;
            text-transform: uppercase;
            letter-spacing: -3px;
            margin-bottom: 20px;
            line-height: 0.9;
        }

        .platform-status {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            background: #fff;
            padding: 8px 16px;
            border: 2px solid #000;
            font-size: 11px;
            font-weight: 900;
            text-transform: uppercase;
            box-shadow: 4px 4px 0px 0px #22c55e;
            margin-bottom: 30px;
        }

        .status-dot {
            width: 8px;
            height: 8px;
            background: #22c55e;
            border-radius: 50%;
            box-shadow: 0 0 10px #22c55e;
            animation: pulse 1.5s infinite;
        }

        @keyframes pulse {
            0% { opacity: 0.5; }
            50% { opacity: 1; }
            100% { opacity: 0.5; }
        }

        .hc-search-wrapper {
            max-width: 700px;
            margin: 0 auto;
            position: relative;
            z-index: 10;
        }

        .hc-search-input {
            width: 100%;
            padding: 25px 35px 25px 70px;
            border: 4px solid #000;
            font-weight: 900;
            font-size: 18px;
            box-shadow: 10px 10px 0px 0px var(--accent-primary);
            outline: none;
            transition: 0.2s;
            background: #fff;
        }

        .hc-search-icon {
            position: absolute;
            left: 25px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 24px;
            color: #000;
        }

        .hc-container {
            max-width: 1100px;
            margin: 0 auto;
            padding: 60px 5%;
        }

        .hc-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 25px;
            margin-bottom: 40px;
        }

        .hc-card {
            background: #fff;
            border: 3px solid #000;
            padding: 30px;
            text-align: center;
            transition: 0.2s;
            text-decoration: none;
            color: inherit;
            position: relative;
            box-shadow: 6px 6px 0px 0px #000;
            cursor: pointer;
        }

        .hc-card.active {
            transform: translate(-4px, -4px);
            box-shadow: 10px 10px 0px 0px var(--accent-primary);
            background: #f8fafc;
        }

        .hc-card:hover {
            transform: translate(-4px, -4px);
            box-shadow: 10px 10px 0px 0px var(--accent-primary);
        }

        .hc-card i {
            font-size: 40px;
            margin-bottom: 20px;
            color: var(--accent-primary);
            transition: 0.2s;
        }

        .hc-card h3 {
            font-size: 16px;
            font-weight: 950;
            text-transform: uppercase;
            margin-bottom: 10px;
        }

        .hc-card p {
            font-size: 12px;
            color: #64748b;
            font-weight: 700;
            line-height: 1.4;
        }

        /* Article List Area */
        .article-container {
            display: none;
            background: #fff;
            border: 3px solid #000;
            padding: 40px;
            box-shadow: 10px 10px 0px 0px #000;
            margin-bottom: 60px;
            animation: slideUp 0.3s ease-out;
        }

        @keyframes slideUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .article-list {
            list-style: none;
            padding: 0;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .article-link {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 15px;
            border: 2px solid #e2e8f0;
            text-decoration: none;
            color: #000;
            font-weight: 800;
            font-size: 14px;
            transition: 0.2s;
        }

        .article-link:hover {
            border-color: #000;
            background: #f8fafc;
            transform: translateX(5px);
        }

        .article-link i { color: var(--accent-primary); }

        /* Modal Styles */
        .hc-modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.8);
            z-index: 2000;
            backdrop-filter: blur(5px);
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .hc-modal-content {
            background: #fff;
            border: 4px solid #000;
            width: 100%;
            max-width: 700px;
            max-height: 80vh;
            overflow-y: auto;
            position: relative;
            box-shadow: 20px 20px 0px 0px var(--accent-primary);
            padding: 50px;
            animation: modalPop 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        @keyframes modalPop {
            from { transform: scale(0.8) translateY(50px); opacity: 0; }
            to { transform: scale(1) translateY(0); opacity: 1; }
        }

        .hc-modal-close {
            position: absolute;
            top: 20px;
            right: 20px;
            background: #000;
            color: #fff;
            border: none;
            width: 40px;
            height: 40px;
            font-weight: 900;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: 0.2s;
        }

        .hc-modal-close:hover {
            background: var(--accent-primary);
            transform: rotate(90deg);
        }

        .hc-modal-body h2 {
            font-size: 28px;
            font-weight: 950;
            text-transform: uppercase;
            letter-spacing: -1px;
            margin-bottom: 25px;
            border-bottom: 4px solid #000;
            padding-bottom: 15px;
        }

        .hc-modal-body p {
            font-size: 15px;
            line-height: 1.6;
            font-weight: 700;
            color: #334155;
            margin-bottom: 20px;
        }

        .hc-modal-body ol {
            padding-left: 20px;
            margin-bottom: 20px;
        }

        .hc-modal-body li {
            margin-bottom: 10px;
            font-weight: 700;
            color: #334155;
        }

        .hc-section-title {
            font-size: 24px;
            font-weight: 950;
            text-transform: uppercase;
            letter-spacing: -1px;
            margin-bottom: 30px;
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .hc-section-title::after {
            content: '';
            flex-grow: 1;
            height: 3px;
            background: #000;
        }

        .faq-item {
            background: #fff;
            border: 3px solid #000;
            margin-bottom: 15px;
            box-shadow: 4px 4px 0px 0px #000;
        }

        .faq-question {
            padding: 20px 25px;
            font-weight: 900;
            font-size: 14px;
            text-transform: uppercase;
            display: flex;
            justify-content: space-between;
            align-items: center;
            cursor: pointer;
            user-select: none;
        }

        .faq-answer {
            padding: 0 25px 20px;
            font-size: 14px;
            font-weight: 700;
            color: #475569;
            display: none;
        }

        .contact-banner {
            background: #000;
            color: #fff;
            padding: 40px;
            border: 3px solid #000;
            box-shadow: 8px 8px 0px 0px var(--accent-primary);
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 60px;
        }

        .btn-hc {
            background: var(--accent-primary);
            color: #fff;
            border: 2px solid #fff;
            padding: 12px 24px;
            font-weight: 950;
            text-transform: uppercase;
            font-size: 13px;
            text-decoration: none;
            transition: 0.2s;
            box-shadow: 4px 4px 0px 0px #fff;
        }

        .btn-hc:hover {
            transform: translate(-2px, -2px);
            box-shadow: 6px 6px 0px 0px var(--accent-primary);
            background: #fff;
            color: #000;
        }
    </style>

    <div class="hc-hero">
        <div style="max-width: 1300px; margin: 0 auto; position: relative;">
            <a href="{{ route('home') }}" class="btn-back">
                <i class="fa-solid fa-arrow-left"></i> Beranda
            </a>
            
            <div class="platform-status">
                <div class="status-dot"></div>
                Platform Status: All Systems Operational
            </div>

            <h1 class="hc-title">Self-Service<br><span style="color: var(--accent-primary);">Support</span> Hub</h1>
            <p style="font-weight: 800; color: #475569; margin-bottom: 45px; max-width: 600px; margin-left: auto; margin-right: auto;">Temukan solusi cepat, panduan langkah demi langkah, dan dukungan teknis untuk mempercepat perjalanan belajar Anda.</p>
            
            <div class="hc-search-wrapper">
                <i class="fa-solid fa-magnifying-glass hc-search-icon"></i>
                <input type="text" class="hc-search-input" placeholder="Cari masalah, fitur, atau panduan...">
            </div>

            <div style="margin-top: 30px; display: flex; justify-content: center; gap: 20px; flex-wrap: wrap;">
                <span style="font-size: 12px; font-weight: 900; color: #64748b;">Pencarian Populer:</span>
                <a href="#" style="font-size: 12px; font-weight: 900; color: #000; text-decoration: underline;">Reset Password</a>
                <a href="#" style="font-size: 12px; font-weight: 900; color: #000; text-decoration: underline;">Download Sertifikat</a>
                <a href="#" style="font-size: 12px; font-weight: 900; color: #000; text-decoration: underline;">Metode Pembayaran</a>
            </div>
        </div>
    </div>

    <div class="hc-container">
        <h2 class="hc-section-title">Telusuri Kategori</h2>
        <div class="hc-grid">
            <div class="hc-card" onclick="showCategory('account', this)">
                <i class="fa-solid fa-user-gear"></i>
                <h3>Akun & Profil</h3>
                <p>Masalah login dan keamanan akun.</p>
            </div>
            <div class="hc-card" onclick="showCategory('payment', this)">
                <i class="fa-solid fa-credit-card"></i>
                <h3>Pembayaran</h3>
                <p>Metode pembayaran dan tagihan.</p>
            </div>
            <div class="hc-card" onclick="showCategory('learning', this)">
                <i class="fa-solid fa-book-open-reader"></i>
                <h3>Kursus & Belajar</h3>
                <p>Akses materi dan sertifikat.</p>
            </div>
            <div class="hc-card" onclick="showCategory('instructor', this)">
                <i class="fa-solid fa-chalkboard-user"></i>
                <h3>Instruktur</h3>
                <p>Panduan mengajar dan komisi.</p>
            </div>
        </div>

        <!-- Dynamic Article Sections -->
        <div id="account" class="article-container">
            <h3 style="font-size: 20px; font-weight: 950; text-transform: uppercase; margin-bottom: 25px; border-left: 4px solid var(--accent-primary); padding-left: 15px;">Akun & Profil</h3>
            <div class="article-list">
                <a href="javascript:void(0)" onclick="openArticle('forgot-password')" class="article-link"><i class="fa-solid fa-file-lines"></i> Lupa kata sandi akun</a>
                <a href="javascript:void(0)" onclick="openArticle('change-email')" class="article-link"><i class="fa-solid fa-file-lines"></i> Mengubah email profil</a>
                <a href="javascript:void(0)" onclick="openArticle('2fa-setup')" class="article-link"><i class="fa-solid fa-file-lines"></i> Keamanan Dua Langkah (2FA)</a>
                <a href="javascript:void(0)" onclick="openArticle('delete-account')" class="article-link"><i class="fa-solid fa-file-lines"></i> Menghapus akun permanen</a>
            </div>
        </div>

        <div id="payment" class="article-container">
            <h3 style="font-size: 20px; font-weight: 950; text-transform: uppercase; margin-bottom: 25px; border-left: 4px solid var(--accent-primary); padding-left: 15px;">Pembayaran</h3>
            <div class="article-list">
                <a href="javascript:void(0)" onclick="openArticle('payment-methods')" class="article-link"><i class="fa-solid fa-file-lines"></i> Metode pembayaran tersedia</a>
                <a href="javascript:void(0)" onclick="openArticle('confirm-payment')" class="article-link"><i class="fa-solid fa-file-lines"></i> Cara konfirmasi pembayaran</a>
                <a href="javascript:void(0)" onclick="openArticle('refund-policy')" class="article-link"><i class="fa-solid fa-file-lines"></i> Kebijakan Refund (Pengembalian)</a>
                <a href="javascript:void(0)" onclick="openArticle('checkout-issue')" class="article-link"><i class="fa-solid fa-file-lines"></i> Masalah saat checkout</a>
            </div>
        </div>

        <div id="learning" class="article-container">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px;">
                <h3 style="font-size: 20px; font-weight: 950; text-transform: uppercase; border-left: 4px solid var(--accent-primary); padding-left: 15px; margin: 0;">Kursus & Belajar</h3>
                <span style="background: #000; color: #fff; font-size: 10px; padding: 4px 10px; font-weight: 900;">12 ARTICLES FOUND</span>
            </div>
            <div class="article-list">
                <a href="javascript:void(0)" onclick="openArticle('video-issue')" class="article-link">
                    <i class="fa-solid fa-circle-play"></i> 
                    <div>Video tidak bisa diputar<br><small style="font-weight: 700; color: #94a3b8; font-size: 10px;">Diperbarui 2 hari yang lalu</small></div>
                </a>
                <a href="javascript:void(0)" onclick="openArticle('claim-cert')" class="article-link">
                    <i class="fa-solid fa-certificate"></i> 
                    <div>Cara klaim sertifikat digital<br><small style="font-weight: 700; color: #94a3b8; font-size: 10px;">Topik Populer</small></div>
                </a>
                <a href="javascript:void(0)" onclick="openArticle('submit-task')" class="article-link">
                    <i class="fa-solid fa-file-arrow-up"></i> 
                    <div>Mengirim tugas & kuis<br><small style="font-weight: 700; color: #94a3b8; font-size: 10px;">Panduan Dasar</small></div>
                </a>
                <a href="javascript:void(0)" onclick="openArticle('qna-instructor')" class="article-link">
                    <i class="fa-solid fa-comments"></i> 
                    <div>Diskusi dengan instruktur<br><small style="font-weight: 700; color: #94a3b8; font-size: 10px;">Interaksi Siswa</small></div>
                </a>
            </div>
        </div>

        <div id="instructor" class="article-container">
            <h3 style="font-size: 20px; font-weight: 950; text-transform: uppercase; margin-bottom: 25px; border-left: 4px solid var(--accent-primary); padding-left: 15px;">Instruktur</h3>
            <div class="article-list">
                <a href="javascript:void(0)" onclick="openArticle('become-instr')" class="article-link"><i class="fa-solid fa-file-lines"></i> Syarat menjadi instruktur</a>
                <a href="javascript:void(0)" onclick="openArticle('revenue-share')" class="article-link"><i class="fa-solid fa-file-lines"></i> Sistem bagi hasil komisi</a>
                <a href="javascript:void(0)" onclick="openArticle('upload-guide')" class="article-link"><i class="fa-solid fa-file-lines"></i> Panduan upload materi video</a>
                <a href="javascript:void(0)" onclick="openArticle('payout-process')" class="article-link"><i class="fa-solid fa-file-lines"></i> Cara tarik saldo pendapatan</a>
            </div>
        </div>

        <h2 class="hc-section-title">Solusi Instan (FAQ)</h2>
        <div class="faq-container" style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 60px; align-items: start;">
            <div class="faq-item" style="margin-bottom: 0;">
                <div class="faq-question">Bagaimana cara mendapatkan sertifikat? <i class="fa-solid fa-chevron-down"></i></div>
                <div class="faq-answer">Sertifikat akan otomatis tersedia untuk diunduh setelah Anda menyelesaikan semua materi dan tugas dalam suatu kursus dengan progress 100%.</div>
            </div>
            <div class="faq-item" style="margin-bottom: 0;">
                <div class="faq-question">Apakah akses kursus selamanya? <i class="fa-solid fa-chevron-down"></i></div>
                <div class="faq-answer">Ya, sekali Anda membeli kursus, Anda akan memiliki akses selamanya ke materi tersebut termasuk pembaruan di masa mendatang.</div>
            </div>
            <div class="faq-item" style="margin-bottom: 0;">
                <div class="faq-question">Metode pembayaran apa saja yang tersedia? <i class="fa-solid fa-chevron-down"></i></div>
                <div class="faq-answer">Kami mendukung transfer bank (BCA, Mandiri), E-Wallet (OVO, Dana, GoPay), dan Kartu Kredit.</div>
            </div>
            <div class="faq-item" style="margin-bottom: 0;">
                <div class="faq-question">Bagaimana cara menjadi instruktur? <i class="fa-solid fa-chevron-down"></i></div>
                <div class="faq-answer">Anda bisa mendaftar melalui menu "Menjadi Pengajar" di footer, isi data diri, dan tunggu verifikasi tim kurasi kami.</div>
            </div>
        </div>

        <!-- Quick Contact Section -->
        <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 20px; margin-bottom: 60px;">
            <div style="border: 3px solid #000; padding: 25px; background: #fff; box-shadow: 6px 6px 0px 0px #000;">
                <i class="fa-solid fa-envelope" style="font-size: 24px; color: var(--accent-primary); margin-bottom: 15px;"></i>
                <h4 style="font-weight: 950; text-transform: uppercase; font-size: 14px; margin-bottom: 5px;">Email Support</h4>
                <p style="font-size: 12px; font-weight: 700; color: #64748b; margin-bottom: 15px;">Balasan dalam 24 jam.</p>
                <a href="mailto:help@ruangkelas.com" style="color: #000; font-weight: 900; text-decoration: underline; font-size: 12px;">help@ruangkelas.com</a>
            </div>
            <div style="border: 3px solid #000; padding: 25px; background: #fff; box-shadow: 6px 6px 0px 0px #000;">
                <i class="fa-solid fa-comment-dots" style="font-size: 24px; color: var(--accent-primary); margin-bottom: 15px;"></i>
                <h4 style="font-weight: 950; text-transform: uppercase; font-size: 14px; margin-bottom: 5px;">Live Chat</h4>
                <p style="font-size: 12px; font-weight: 700; color: #64748b; margin-bottom: 15px;">Tersedia Senin-Jumat.</p>
                <a href="#" style="color: #000; font-weight: 900; text-decoration: underline; font-size: 12px;">Mulai Chat Sekarang</a>
            </div>
            <div style="border: 3px solid #000; padding: 25px; background: #fff; box-shadow: 6px 6px 0px 0px #000;">
                <i class="fa-solid fa-book" style="font-size: 24px; color: var(--accent-primary); margin-bottom: 15px;"></i>
                <h4 style="font-weight: 950; text-transform: uppercase; font-size: 14px; margin-bottom: 5px;">Documentation</h4>
                <p style="font-size: 12px; font-weight: 700; color: #64748b; margin-bottom: 15px;">Panduan API & Developer.</p>
                <a href="#" style="color: #000; font-weight: 900; text-decoration: underline; font-size: 12px;">Lihat Dokumentasi</a>
            </div>
        </div>

        <div class="contact-banner">
            <div>
                <h3 style="font-size: 20px; font-weight: 950; text-transform: uppercase; margin-bottom: 5px;">Masih Butuh Bantuan?</h3>
                <p style="font-weight: 700; color: #94a3b8; font-size: 13px;">Tim dukungan kami siap melayani Anda 24/7.</p>
            </div>
            <a href="mailto:support@ruangkelas.com" class="btn-hc">Hubungi Support</a>
        </div>
    </div>

    <!-- Article Modal -->
    <div id="articleModal" class="hc-modal">
        <div class="hc-modal-content">
            <button class="hc-modal-close" onclick="closeArticle()"><i class="fa-solid fa-xmark"></i></button>
            <div id="modalBody" class="hc-modal-body">
                <!-- Content injected via JS -->
            </div>
        </div>
    </div>

    <script>
        const articleData = {
            // Akun & Profil
            'forgot-password': {
                title: 'Lupa Kata Sandi Akun',
                content: `
                    <p>Jika Anda lupa kata sandi akun Anda, ikuti langkah-langkah berikut:</p>
                    <ol>
                        <li>Buka halaman <strong>Login</strong> RuangKelas.</li>
                        <li>Klik tautan <strong>"Lupa Kata Sandi?"</strong> di bawah kotak input.</li>
                        <li>Masukkan alamat email yang terdaftar.</li>
                        <li>Cek email Anda untuk link reset sandi.</li>
                        <li>Klik link tersebut dan buat kata sandi baru.</li>
                    </ol>
                `
            },
            'change-email': {
                title: 'Mengubah Email Profil',
                content: `
                    <p>Untuk mengubah alamat email utama Anda:</p>
                    <ol>
                        <li>Pergi ke <strong>Pengaturan Profil</strong>.</li>
                        <li>Cari kolom <strong>Email</strong>.</li>
                        <li>Masukkan email baru Anda dan simpan perubahan.</li>
                        <li>Sistem akan mengirimkan verifikasi ke email baru tersebut.</li>
                    </ol>
                `
            },
            '2fa-setup': {
                title: 'Keamanan Dua Langkah (2FA)',
                content: `
                    <p>Tingkatkan keamanan akun Anda dengan 2FA:</p>
                    <ol>
                        <li>Buka menu <strong>Keamanan</strong> di profil.</li>
                        <li>Aktifkan <strong>Two-Factor Authentication</strong>.</li>
                        <li>Pilih metode (Email atau Aplikasi Authenticator).</li>
                        <li>Ikuti petunjuk sinkronisasi kode.</li>
                    </ol>
                `
            },
            'delete-account': {
                title: 'Menghapus Akun Permanen',
                content: `
                    <p><strong>Peringatan:</strong> Tindakan ini tidak dapat dibatalkan.</p>
                    <ol>
                        <li>Hubungi tim support kami melalui email dengan subjek "Penghapusan Akun".</li>
                        <li>Lampirkan bukti kepemilikan akun.</li>
                        <li>Kami akan memproses penghapusan data dalam 3x24 jam.</li>
                    </ol>
                `
            },

            // Pembayaran
            'payment-methods': {
                title: 'Metode Pembayaran Tersedia',
                content: `
                    <p>Kami mendukung berbagai metode pembayaran aman:</p>
                    <ul>
                        <li><strong>Transfer Bank</strong> (BCA, Mandiri, BNI, BRI).</li>
                        <li><strong>E-Wallet</strong> (GoPay, OVO, Dana).</li>
                        <li><strong>Kartu Kredit</strong> (Visa, Mastercard).</li>
                    </ul>
                `
            },
            'confirm-payment': {
                title: 'Cara Konfirmasi Pembayaran',
                content: `
                    <p>Setelah transfer, lakukan konfirmasi:</p>
                    <ol>
                        <li>Buka <strong>Riwayat Transaksi</strong> di profil Anda.</li>
                        <li>Klik tombol <strong>Konfirmasi</strong> pada pesanan Anda.</li>
                        <li>Unggah foto bukti transfer yang sah.</li>
                        <li>Tunggu verifikasi admin maksimal 1x24 jam.</li>
                    </ol>
                `
            },
            'refund-policy': {
                title: 'Kebijakan Refund',
                content: `
                    <p>Kami memberikan garansi uang kembali jika:</p>
                    <ul>
                        <li>Pengajuan dilakukan dalam <strong>24 jam</strong> setelah pembelian.</li>
                        <li>Progres belajar kursus masih di bawah <strong>10%</strong>.</li>
                        <li>Terdapat kendala teknis yang tidak dapat kami selesaikan.</li>
                    </ul>
                `
            },
            'checkout-issue': {
                title: 'Masalah Saat Checkout',
                content: `
                    <p>Jika gagal melakukan pembayaran:</p>
                    <ol>
                        <li>Pastikan koneksi internet stabil.</li>
                        <li>Coba gunakan browser lain atau mode incognito.</li>
                        <li>Pastikan saldo/limit kartu Anda mencukupi.</li>
                        <li>Jika masih gagal, hubungi WhatsApp Support kami.</li>
                    </ol>
                `
            },

            // Kursus & Belajar
            'video-issue': {
                title: 'Video Tidak Bisa Diputar',
                content: `
                    <p>Solusi video yang buffering atau tidak muncul:</p>
                    <ol>
                        <li>Turunkan resolusi video ke 480p atau 360p.</li>
                        <li>Bersihkan cache browser Anda.</li>
                        <li>Matikan ekstensi AdBlocker jika ada.</li>
                        <li>Refresh halaman dan coba lagi.</li>
                    </ol>
                `
            },
            'claim-cert': {
                title: 'Cara Klaim Sertifikat Digital',
                content: `
                    <p>Dapatkan sertifikat keahlian Anda:</p>
                    <ol>
                        <li>Pastikan progres materi sudah <strong>100%</strong>.</li>
                        <li>Selesaikan semua kuis dan tugas wajib.</li>
                        <li>Klik tombol <strong>"Unduh Sertifikat"</strong> di dashboard kursus.</li>
                    </ol>
                `
            },
            'submit-task': {
                title: 'Mengirim Tugas & Kuis',
                content: `
                    <p>Cara menyelesaikan evaluasi belajar:</p>
                    <ol>
                        <li>Pilih modul tugas di dalam materi kursus.</li>
                        <li>Tulis jawaban atau unggah file pendukung.</li>
                        <li>Klik <strong>Kirim Jawaban</strong>.</li>
                        <li>Nilai akan muncul setelah dikoreksi oleh instruktur.</li>
                    </ol>
                `
            },
            'qna-instructor': {
                title: 'Diskusi Dengan Instruktur',
                content: `
                    <p>Ada pertanyaan teknis? Tanyakan langsung:</p>
                    <ol>
                        <li>Gunakan fitur <strong>Q&A</strong> di bawah setiap video materi.</li>
                        <li>Tulis pertanyaan Anda secara jelas dan spesifik.</li>
                        <li>Instruktur akan menjawab melalui notifikasi akun Anda.</li>
                    </ol>
                `
            },

            // Instruktur
            'become-instr': {
                title: 'Syarat Menjadi Instruktur',
                content: `
                    <p>Bergabunglah dengan tim pengajar kami:</p>
                    <ol>
                        <li>Memiliki keahlian di bidang terkait (Tech, Design, Business, dll).</li>
                        <li>Memiliki peralatan recording yang memadai.</li>
                        <li>Mendaftar melalui menu <strong>"Menjadi Pengajar"</strong>.</li>
                        <li>Lulus seleksi materi dan kualitas video dari tim kurasi kami.</li>
                    </ol>
                `
            },
            'revenue-share': {
                title: 'Sistem Bagi Hasil Komisi',
                content: `
                    <p>Transparansi pendapatan untuk instruktur:</p>
                    <ul>
                        <li><strong>70%</strong> untuk Instruktur dari setiap penjualan kursus.</li>
                        <li><strong>30%</strong> untuk Platform (Biaya server, marketing, dan operasional).</li>
                    </ul>
                `
            },
            'upload-guide': {
                title: 'Panduan Upload Materi Video',
                content: `
                    <p>Ketentuan video materi kursus:</p>
                    <ul>
                        <li>Format file: MP4 atau MKV.</li>
                        <li>Resolusi minimal: 1080p (Full HD).</li>
                        <li>Rasio layar: 16:9.</li>
                        <li>Audio harus terdengar jelas tanpa noise berlebih.</li>
                    </ul>
                `
            },
            'payout-process': {
                title: 'Cara Tarik Saldo Pendapatan',
                content: `
                    <p>Tarik hasil kerja keras Anda:</p>
                    <ol>
                        <li>Buka menu <strong>Earnings</strong> di Dashboard Instruktur.</li>
                        <li>Minimal penarikan adalah Rp100.000.</li>
                        <li>Input nomor rekening bank yang valid.</li>
                        <li>Proses pengiriman dana dilakukan setiap tanggal 5 & 20 tiap bulan.</li>
                    </ol>
                `
            }
        };

        function openArticle(id) {
            const data = articleData[id] || { title: 'Topik Tidak Ditemukan', content: '<p>Mohon maaf, penjelasan untuk topik ini sedang dalam tahap penyusunan oleh tim kami.</p>' };
            const modalBody = document.getElementById('modalBody');
            modalBody.innerHTML = `<h2>${data.title}</h2>${data.content}`;
            
            const modal = document.getElementById('articleModal');
            modal.style.display = 'flex';
            document.body.style.overflow = 'hidden'; // Prevent scroll
        }

        function closeArticle() {
            const modal = document.getElementById('articleModal');
            modal.style.display = 'none';
            document.body.style.overflow = 'auto'; // Restore scroll
        }

        // Close on outside click
        window.onclick = function(event) {
            const modal = document.getElementById('articleModal');
            if (event.target == modal) {
                closeArticle();
            }
        }

        function showCategory(id, el) {
            // Remove active class from all cards
            document.querySelectorAll('.hc-card').forEach(card => card.classList.remove('active'));
            // Add active class to clicked card
            el.classList.add('active');

            // Hide all article containers
            document.querySelectorAll('.article-container').forEach(container => {
                container.style.display = 'none';
            });

            // Show selected container
            const target = document.getElementById(id);
            if (target) {
                target.style.display = 'block';
                // Scroll to target smoothly
                target.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
            }
        }

        document.querySelectorAll('.faq-question').forEach(q => {
            q.addEventListener('click', () => {
                const answer = q.nextElementSibling;
                const icon = q.querySelector('i');
                const isOpen = answer.style.display === 'block';
                
                // Close all others
                document.querySelectorAll('.faq-answer').forEach(a => a.style.display = 'none');
                document.querySelectorAll('.faq-question i').forEach(i => {
                    i.classList.remove('fa-chevron-up');
                    i.classList.add('fa-chevron-down');
                });

                if (!isOpen) {
                    answer.style.display = 'block';
                    icon.classList.remove('fa-chevron-down');
                    icon.classList.add('fa-chevron-up');
                }
            });
        });
    </script>
@endsection
