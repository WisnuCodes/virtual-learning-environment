<div id="nb-preloader">
    <!-- Polka Dot Pattern Background -->
    <div class="preloader-polka-bg"></div>

    <div class="preloader-brutalist-card">
        <!-- Brand Logo -->
        <div class="preloader-brand">
            ruang<span>kelas.</span>
        </div>
        
        <!-- Brutalist Loader -->
        <div class="preloader-main-loader">
            <div class="loader-info">
                <span class="loader-tag">MEMUAT SISTEM</span>
                <span class="loader-num">0%</span>
            </div>
            <div class="brutalist-track">
                <div class="brutalist-fill"></div>
            </div>
            <div class="loader-tip">Menyiapkan aset pembelajaran terbaik untuk Anda...</div>
        </div>

        <div class="preloader-badge">
            <i class="fa-solid fa-graduation-cap"></i> Professional Learning Platform
        </div>
    </div>
</div>

<style>
    /* CRITICAL: Hide notifications during loading */
    body.preloader-active .premium-banner-wrapper,
    body.preloader-active #ann-global-container,
    body.preloader-active #toast-container,
    body.preloader-active .nb-toast-wrapper {
        opacity: 0 !important;
        visibility: hidden !important;
        transform: translateY(-40px) !important;
        pointer-events: none !important;
    }

    .premium-banner-wrapper,
    #ann-global-container,
    #toast-container,
    .nb-toast-wrapper {
        transition: all 0.8s cubic-bezier(0.175, 0.885, 0.32, 1.275) !important;
    }

    #nb-preloader {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: #ffffff;
        z-index: 100000;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        transition: transform 0.8s cubic-bezier(0.8, 0, 0.2, 1), opacity 0.5s ease;
    }

    #nb-preloader.loaded {
        transform: scale(1.2);
        opacity: 0;
        visibility: hidden;
    }

    /* Polka Dot Background Styling */
    .preloader-polka-bg {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: #ffffff;
        background-image: radial-gradient(#cbd5e1 1.5px, transparent 1.5px);
        background-size: 30px 30px;
        opacity: 0.4;
        z-index: -1;
    }

    .preloader-brutalist-card {
        background: #ffffff;
        border: 4px solid #000000;
        padding: 50px;
        width: 90%;
        max-width: 440px;
        text-align: center;
        box-shadow: 15px 15px 0px #000000;
        position: relative;
        animation: card-pop 0.6s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }

    @keyframes card-pop {
        0% { transform: scale(0.8) rotate(-2deg); opacity: 0; }
        100% { transform: scale(1) rotate(0deg); opacity: 1; }
    }

    .preloader-brand {
        font-size: 44px;
        font-weight: 900;
        color: #0f172a;
        letter-spacing: -2px;
        text-transform: lowercase;
        margin-bottom: 40px;
    }

    .preloader-brand span {
        color: #10b981;
    }

    .preloader-main-loader {
        margin-bottom: 25px;
        text-align: left;
    }

    .loader-info {
        display: flex;
        justify-content: space-between;
        align-items: flex-end;
        margin-bottom: 12px;
    }

    .loader-tag {
        font-size: 11px;
        font-weight: 900;
        color: #000;
        text-transform: uppercase;
        letter-spacing: 1.5px;
        background: #fbbf24;
        padding: 2px 8px;
        border: 2px solid #000;
    }

    .loader-num {
        font-size: 18px;
        font-weight: 950;
        color: #000;
        font-family: monospace;
    }

    .brutalist-track {
        height: 24px;
        background: #fff;
        border: 3px solid #000;
        overflow: hidden;
        position: relative;
        box-shadow: 4px 4px 0px #000;
    }

    .brutalist-fill {
        height: 100%;
        width: 0%;
        background: #10b981;
        transition: width 0.3s ease;
        border-right: 3px solid #000;
    }

    .loader-tip {
        margin-top: 15px;
        font-size: 11px;
        font-weight: 700;
        color: #64748b;
        text-align: center;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .preloader-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: #f1f5f9;
        padding: 6px 15px;
        font-size: 10px;
        font-weight: 900;
        text-transform: uppercase;
        letter-spacing: 1px;
        border: 2px solid #000;
        margin-top: 10px;
    }

    .preloader-badge i {
        color: #10b981;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const preloader = document.getElementById('nb-preloader');
        const fill = preloader.querySelector('.brutalist-fill');
        const percentText = preloader.querySelector('.loader-num');
        let progress = 0;

        const completeLoading = () => {
            preloader.classList.add('loaded');
            document.body.classList.remove('preloader-active');
            setTimeout(() => preloader.remove(), 1000);
        };

        const interval = setInterval(() => {
            progress += Math.random() * 4; 
            if (progress >= 100) {
                progress = 100;
                clearInterval(interval);
                setTimeout(completeLoading, 1500);
            }
            fill.style.width = progress + '%';
            percentText.innerText = Math.floor(progress) + '%';
        }, 300);

        window.addEventListener('load', () => {
            setTimeout(() => {
                if (progress < 100) {
                    progress = 100;
                    fill.style.width = '100%';
                    percentText.innerText = '100%';
                    setTimeout(completeLoading, 1500);
                }
            }, 800);
        });
    });
</script>
