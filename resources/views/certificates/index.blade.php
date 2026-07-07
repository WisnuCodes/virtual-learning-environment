@extends('layouts.app')

@section('content')
<div style="background-color: var(--bg-secondary); min-height: calc(100vh - 73px); background-image: radial-gradient(#cbd5e1 1px, transparent 1px); background-size: 24px 24px;">
    <div style="max-width: 1200px; margin: 0 auto; padding: 40px 5%;">

        <div style="display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 40px; border-bottom: 3px solid #000; padding-bottom: 20px; flex-wrap: wrap; gap: 20px;">
            <div>
                <div style="font-size: 12px; font-weight: 900; color: #000; text-transform: uppercase; letter-spacing: 2px; margin-bottom: 8px; background: var(--bg-primary); display: inline-block; padding: 4px 10px; border: 2px solid #000; box-shadow: 2px 2px 0px 0px #000;">
                    <i class="fa-solid fa-award" style="margin-right: 6px; color: var(--accent-primary);"></i> Pencapaian Saya
                </div>
                <h1 style="font-size: 36px; font-weight: 900; color: #000; margin: 0; letter-spacing: -1.5px; text-transform: uppercase;">
                    Sertifikat & Kelulusan</h1>
                <p style="color: #475569; font-size: 14px; font-weight: 600; margin-top: 5px;">Kelola dan unduh semua sertifikat resmi yang telah Anda raih.</p>
            </div>
            <div style="background: #fff; border: 2px solid #000; padding: 10px 15px; display: flex; align-items: center; gap: 15px; box-shadow: 4px 4px 0px 0px var(--accent-primary);">
                <span style="font-size: 11px; font-weight: 900; color: #000; text-transform: uppercase; letter-spacing: 1px;">Total Sertifikat:</span>
                <span style="font-size: 20px; font-weight: 900; color: #000; line-height: 1;">{{ sprintf('%02d', $completedCourses->count()) }}</span>
            </div>
        </div>

        @if ($completedCourses->isEmpty())
            <div style="text-align: center; padding: 80px 20px; border: 2px dashed #000; background: #fff; box-shadow: 8px 8px 0px 0px #000;">
                <div style="width: 80px; height: 80px; border: 3px solid #000; display: inline-flex; align-items: center; justify-content: center; font-size: 36px; color: #000; margin-bottom: 25px; background: #f8fafc; box-shadow: 6px 6px 0px 0px var(--accent-primary);">
                    <i class="fa-solid fa-scroll"></i>
                </div>
                <h3 style="font-size: 20px; font-weight: 900; color: #000; text-transform: uppercase; letter-spacing: 1.5px; margin-bottom: 12px;">
                    Belum Ada Sertifikat</h3>
                <p style="color: #475569; margin-bottom: 35px; font-size: 14px; font-weight: 600; max-width: 400px; margin-left: auto; margin-right: auto;">
                    Selesaikan kursus Anda hingga 100% untuk mendapatkan sertifikat kelulusan.</p>
                <a href="{{ route('my-learning') }}" style="background: var(--accent-primary); color: #fff; border: 2px solid #000; padding: 12px 20px; font-size: 13px; font-weight: 900; text-transform: uppercase; letter-spacing: 0.5px; box-shadow: 4px 4px 0px 0px #000; text-decoration: none; display: inline-block;">
                    LANJUTKAN BELAJAR <i class="fa-solid fa-arrow-right" style="margin-left: 8px;"></i>
                </a>
            </div>
        @else
            <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(350px, 1fr)); gap: 30px;">
                @foreach ($completedCourses as $cert)
                    <div style="background: #fff; border: 2px solid #000; padding: 25px; position: relative; box-shadow: 6px 6px 0px 0px #000; transition: all 0.2s ease;" onmouseover="this.style.transform='translate(-2px, -2px)'; this.style.boxShadow='8px 8px 0px 0px var(--accent-primary)';" onmouseout="this.style.transform='translate(0, 0)'; this.style.boxShadow='6px 6px 0px 0px #000';">
                        
                        <div style="position: absolute; top: 15px; right: 15px; font-size: 18px; color: var(--accent-primary);">
                            <i class="fa-solid fa-circle-check"></i>
                        </div>

                        <div style="font-size: 10px; font-weight: 900; color: #64748b; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 5px;">ID: {{ $cert->certificate_code }}</div>
                        <h3 style="font-size: 18px; font-weight: 900; color: #000; margin: 0 0 20px; line-height: 1.4; text-transform: uppercase;">
                            {{ $cert->course->title }}
                        </h3>
                        
                        <div style="display: flex; align-items: center; gap: 15px; margin-bottom: 25px; padding: 15px; background: #f8fafc; border: 2px solid #000; box-shadow: inset 4px 4px 0px #e2e8f0;">
                            <img src="{{ $cert->course->thumbnail }}" alt="Thumbnail" style="width: 50px; height: 50px; object-fit: cover; border: 2px solid #000;">
                            <div>
                                <div style="font-size: 11px; font-weight: 900; color: #000; text-transform: uppercase;">Diterbitkan:</div>
                                <div style="font-size: 13px; color: #475569; font-weight: 600;">{{ $cert->created_at->format('d M Y') }}</div>
                            </div>
                        </div>

                        <div style="display: flex; gap: 10px;">
                            <a href="{{ route('certificate.download', $cert->course->id) }}" style="flex: 2; text-align: center; padding: 12px; background: var(--accent-primary); color: #fff; border: 2px solid #000; font-size: 12px; font-weight: 900; text-transform: uppercase; letter-spacing: 1px; cursor: pointer; transition: 0.2s; box-shadow: 4px 4px 0px 0px #000; text-decoration: none;" onmouseover="this.style.transform='translate(-1px, -1px)'; this.style.boxShadow='5px 5px 0px 0px #000';" onmouseout="this.style.transform='translate(0, 0)'; this.style.boxShadow='4px 4px 0px 0px #000';">
                                <i class="fa-solid fa-download" style="margin-right: 8px;"></i> UNDUH PDF
                            </a>
                            <a href="{{ route('certificate.verify', $cert->certificate_code) }}" style="flex: 1; text-align: center; padding: 12px; background: #fff; color: #000; border: 2px solid #000; font-size: 12px; font-weight: 900; cursor: pointer; transition: 0.2s; box-shadow: 4px 4px 0px 0px #000; text-decoration: none;" onmouseover="this.style.transform='translate(-1px, -1px)'; this.style.boxShadow='5px 5px 0px 0px #000';" onmouseout="this.style.transform='translate(0, 0)'; this.style.boxShadow='4px 4px 0px 0px #000';">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

    </div>
</div>
@endsection


