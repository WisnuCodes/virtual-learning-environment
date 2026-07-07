@extends('layouts.app')

@section('content')
    <style>
        .settings-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            margin-bottom: 35px;
            border-bottom: 3px solid #000;
            padding-bottom: 20px;
            flex-wrap: wrap;
            gap: 20px;
        }

        .settings-title-wrapper {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 12px;
            background: #000;
            padding: 8px 18px;
            border: 2px solid #000;
            box-shadow: 4px 4px 0px 0px var(--accent-primary);
            display: inline-flex;
        }

        .admin-panel {
            background: #fff;
            border: 3px solid #000;
            box-shadow: 8px 8px 0px 0px #000;
        }

        .admin-panel-header {
            padding: 20px 25px;
            border-bottom: 3px solid #000;
            background: #f8fafc;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .sq-label {
            display: block;
            font-size: 13px;
            font-weight: 900;
            color: #000;
            text-transform: uppercase;
            margin-bottom: 10px;
            letter-spacing: 1px;
            border-left: 4px solid var(--accent-primary);
            padding-left: 10px;
        }

        .btn-sq-primary {
            background: var(--accent-primary);
            color: #fff;
            border: 3px solid #000;
            padding: 15px 30px;
            border-radius: 0;
            font-size: 14px;
            font-weight: 900;
            cursor: pointer;
            transition: all 0.2s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            text-transform: uppercase;
            letter-spacing: 1px;
            box-shadow: 6px 6px 0px 0px #000;
            text-decoration: none;
        }

        .btn-sq-primary:hover {
            transform: translate(-3px, -3px);
            box-shadow: 9px 9px 0px 0px #000;
            color: #fff;
        }

        .btn-sq-primary:active {
            transform: translate(3px, 3px);
            box-shadow: 0px 0px 0px 0px #000;
        }

        .btn-sq-outline {
            background: #fff;
            color: #000;
            border: 2px solid #000;
            padding: 12px 20px;
            border-radius: 0;
            font-size: 13px;
            font-weight: 900;
            cursor: pointer;
            transition: all 0.2s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            text-transform: uppercase;
            letter-spacing: 1px;
            box-shadow: 4px 4px 0px 0px #000;
            text-decoration: none;
        }

        .btn-sq-outline:hover {
            transform: translate(-3px, -3px);
            box-shadow: 7px 7px 0px 0px #000;
            color: #000;
            background: #f8fafc;
        }

        .btn-sq-outline:active {
            transform: translate(3px, 3px);
            box-shadow: 0px 0px 0px 0px #000;
        }

        .file-input-wrapper {
            position: relative;
            background: #f8fafc;
            border: 2px dashed #000;
            padding: 30px;
            text-align: center;
            cursor: pointer;
            transition: all 0.2s;
            display: block;
        }

        .file-input-wrapper:hover {
            background: #e2e8f0;
            border-style: solid;
        }

        .file-input-wrapper input[type="file"] {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            opacity: 0;
            cursor: pointer;
        }

        .logo-preview-box {
            border: 2px solid #000;
            background: #fff;
            padding: 20px;
            display: inline-block;
            box-shadow: 4px 4px 0px 0px #000;
            position: relative;
        }

        .logo-preview-badge {
            position: absolute;
            top: -12px;
            left: -12px;
            background: var(--accent-primary);
            color: #fff;
            font-size: 10px;
            font-weight: 900;
            text-transform: uppercase;
            padding: 4px 8px;
            border: 2px solid #000;
        }
    </style>

    <div
        style="background-color: var(--bg-secondary); min-height: calc(100vh - 73px); background-image: radial-gradient(#cbd5e1 1px, transparent 1px); background-size: 24px 24px;">
        <div style="max-width: 1000px; margin: 0 auto; padding: 40px 5%;">

            <div class="settings-header">
                <div>
                    <div class="settings-title-wrapper">
                        <i class="fa-solid fa-gears" style="color: var(--accent-primary); font-size: 18px;"></i>
                        <h2
                            style="font-size: 18px; font-weight: 900; color: #fff; text-transform: uppercase; letter-spacing: 1.5px; margin: 0;">
                            Pengaturan Sistem</h2>
                    </div>
                    <p
                        style="color: #000; font-size: 14px; margin: 0; font-weight: 800; text-transform: uppercase; letter-spacing: 0.5px;">
                        Kelola konfigurasi platform global dan branding.</p>
                </div>
                <a href="{{ route('admin.dashboard') }}" class="btn-sq-outline">
                    <i class="fa-solid fa-arrow-left" style="margin-right: 8px;"></i> Pusat Kendali
                </a>
            </div>

            @if (session('success'))
                <div
                    style="background: #ecfdf5; border: 2px solid #000; color: #059669; padding: 15px 20px; margin-bottom: 30px; font-weight: 900; font-size: 13px; text-transform: uppercase; letter-spacing: 1px; box-shadow: 5px 5px 0px 0px #10b981; display: flex; align-items: center; gap: 10px;">
                    <i class="fa-solid fa-circle-check" style="font-size: 18px;"></i> {{ session('success') }}
                </div>
            @endif

            <div class="admin-panel">
                <div class="admin-panel-header">
                    <h3
                        style="font-size: 15px; font-weight: 900; text-transform: uppercase; color: #000; margin: 0; display: flex; align-items: center; gap: 10px; letter-spacing: 1px;">
                        <i class="fa-solid fa-brush" style="color: var(--accent-primary);"></i> Protokol Identitas Brand
                    </h3>
                </div>

                <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data"
                    style="padding: 35px;">
                    @csrf

                    <div style="margin-bottom: 40px;">
                        <label class="sq-label">Konfigurasi Logo Situs</label>
                        <p style="font-size: 12px; font-weight: 700; color: #475569; margin-bottom: 25px; margin-top: 5px;">
                            Unggah aset logo utama. Ukuran maksimal: 2MB. Format yang disarankan: PNG atau SVG dengan latar belakang transparan.
                        </p>

                        <div
                            style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 30px; align-items: start;">

                            <div>
                                @if ($siteLogo && $siteLogo->value)
                                    <div class="logo-preview-box">
                                        <div class="logo-preview-badge">Aset Aktif</div>
                                        <img src="{{ $siteLogo->value }}" alt="Logo Situs Saat Ini"
                                            style="max-height: 50px; display: block; filter: drop-shadow(0px 2px 2px rgba(0,0,0,0.1));">
                                    </div>
                                @else
                                    <div
                                        style="font-size: 12px; color: #64748b; font-weight: 800; text-transform: uppercase; padding: 20px; border: 2px dashed #cbd5e1; display: inline-block; background: #f8fafc;">
                                        <i class="fa-solid fa-ghost" style="margin-right: 8px;"></i> TIDAK ADA LOGO AKTIF
                                    </div>
                                @endif
                            </div>

                            <div>
                                <label class="file-input-wrapper" id="drop-zone">
                                    <input type="file" name="site_logo" accept="image/*" id="logo-input">
                                    <i class="fa-solid fa-cloud-arrow-up"
                                        style="font-size: 32px; color: #000; margin-bottom: 12px; display: block;"></i>
                                    <span
                                        style="font-size: 13px; font-weight: 900; color: #000; text-transform: uppercase; display: block;"
                                        id="file-name">KLIK ATAU SERET ASET KE SINI</span>
                                    <span
                                        style="font-size: 10px; font-weight: 700; color: #64748b; text-transform: uppercase; display: block; margin-top: 8px;">Mendukung
                                        PNG, JPG, SVG</span>
                                </label>
                                @error('site_logo')
                                    <div
                                        style="color: #fff; background: #e11d48; padding: 6px 10px; font-size: 11px; font-weight: 900; margin-top: 10px; border: 2px solid #000; display: inline-block;">
                                        <i class="fa-solid fa-triangle-exclamation" style="margin-right: 5px;"></i>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                        </div>
                    </div>

                    <div style="border-top: 3px solid #000; padding-top: 30px; display: flex; justify-content: flex-end;">
                        <button type="submit" class="btn-sq-primary">
                            <i class="fa-solid fa-floppy-disk" style="margin-right: 10px; font-size: 16px;"></i> SIMPAN KONFIGURASI
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>

    <script>
        document.getElementById('logo-input').addEventListener('change', function(e) {
            const fileName = e.target.files[0] ? e.target.files[0].name : 'KLIK ATAU SERET ASET KE SINI';
            const fileNameEl = document.getElementById('file-name');

            if (e.target.files[0]) {
                fileNameEl.innerHTML =
                    `<span style="color: var(--accent-primary);"><i class="fa-solid fa-file-check" style="margin-right: 5px;"></i> ${fileName}</span>`;
                document.getElementById('drop-zone').style.borderColor = 'var(--accent-primary)';
                document.getElementById('drop-zone').style.borderStyle = 'solid';
            } else {
                fileNameEl.innerText = fileName;
                document.getElementById('drop-zone').style.borderColor = '#000';
                document.getElementById('drop-zone').style.borderStyle = 'dashed';
            }
        });
    </script>
@endsection
