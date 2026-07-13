@extends('layouts.admin')

@section('page_title', 'Application — ' . $career->name)

@php use App\Helpers\PermissionHelper; @endphp

@section('content')

<div class="page-header" style="display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:12px;">
    <div>
        <h1><i class="bi bi-person-badge-fill me-2" style="color:var(--accent);"></i>{{ $career->name }}</h1>
        <p>Applied {{ $career->created_at->format('d M Y, h:i A') }} &nbsp;·&nbsp; {{ $career->created_at->diffForHumans() }}</p>
    </div>
    <a href="{{ route('admin.careers.index') }}" class="btn-ghost">
        <i class="bi bi-arrow-left"></i> Back to Applications
    </a>
</div>

<div class="row g-4">

    {{-- ── Left: Details ──────────────────────────────────────── --}}
    <div class="col-lg-8">

        {{-- Contact info --}}
        <div class="admin-card mb-4">
            <div class="card-head">
                <h5><i class="bi bi-person-circle me-2" style="color:var(--accent);"></i>Applicant Details</h5>
            </div>
            <div class="card-body-p">
                <div class="row g-3">
                    <div class="col-sm-6">
                        <div style="padding:16px;background:var(--body-bg);border-radius:12px;border:1px solid var(--border);">
                            <div style="font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:.6px;color:var(--text-muted);margin-bottom:6px;">
                                <i class="bi bi-person me-1"></i> Full Name
                            </div>
                            <div style="font-size:15px;font-weight:700;color:var(--text-main);">{{ $career->name }}</div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div style="padding:16px;background:var(--body-bg);border-radius:12px;border:1px solid var(--border);">
                            <div style="font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:.6px;color:var(--text-muted);margin-bottom:6px;">
                                <i class="bi bi-envelope me-1"></i> Email
                            </div>
                            <a href="mailto:{{ $career->email }}" style="font-size:15px;font-weight:600;color:var(--accent);text-decoration:none;">
                                {{ $career->email }}
                            </a>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div style="padding:16px;background:var(--body-bg);border-radius:12px;border:1px solid var(--border);">
                            <div style="font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:.6px;color:var(--text-muted);margin-bottom:6px;">
                                <i class="bi bi-whatsapp me-1"></i> WhatsApp
                            </div>
                            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $career->whatsapp) }}"
                               target="_blank"
                               style="font-size:15px;font-weight:600;color:#059669;text-decoration:none;display:inline-flex;align-items:center;gap:6px;">
                                <i class="bi bi-whatsapp"></i>{{ $career->whatsapp }}
                            </a>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div style="padding:16px;background:var(--body-bg);border-radius:12px;border:1px solid var(--border);">
                            <div style="font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:.6px;color:var(--text-muted);margin-bottom:6px;">
                                <i class="bi bi-mortarboard me-1"></i> Education
                            </div>
                            <div style="font-size:15px;font-weight:600;color:var(--text-main);">{{ $career->education }}</div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div style="padding:16px;background:var(--body-bg);border-radius:12px;border:1px solid var(--border);">
                            <div style="font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:.6px;color:var(--text-muted);margin-bottom:6px;">
                                <i class="bi bi-lightning me-1"></i> Primary Expertise / Role
                            </div>
                            <div style="font-size:15px;font-weight:700;color:var(--text-main);">{{ $career->expertise }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Experience --}}
        <div class="admin-card mb-4">
            <div class="card-head">
                <h5><i class="bi bi-briefcase-fill me-2" style="color:var(--info);"></i>Experience</h5>
            </div>
            <div class="card-body-p">
                <p style="font-size:14px;line-height:1.8;color:var(--text-main);white-space:pre-wrap;margin:0;">{{ $career->experience }}</p>
            </div>
        </div>

        {{-- Introduction --}}
        <div class="admin-card">
            <div class="card-head">
                <h5><i class="bi bi-chat-quote-fill me-2" style="color:var(--warning);"></i>Introduction / Short Bio</h5>
            </div>
            <div class="card-body-p">
                <p style="font-size:14px;line-height:1.85;color:var(--text-main);white-space:pre-wrap;margin:0;">{{ $career->introduction }}</p>
            </div>
        </div>

    </div>

    {{-- ── Right: Status & Actions ─────────────────────────────── --}}
    <div class="col-lg-4">

        {{-- Status Card --}}
        @php
            $colors = ['new'=>'#f59e0b','reviewed'=>'#3b82f6','shortlisted'=>'#10b981','rejected'=>'#ef4444'];
            $c = $colors[$career->status] ?? '#94a3b8';
        @endphp
        <div class="admin-card mb-4">
            <div class="card-head">
                <h5><i class="bi bi-flag-fill me-2" style="color:{{ $c }};"></i>Application Status</h5>
            </div>
            <div class="card-body-p">
                <div style="text-align:center;padding:20px 0;">
                    <span style="display:inline-flex;align-items:center;gap:8px;padding:10px 24px;
                        border-radius:50px;font-size:15px;font-weight:800;
                        background:{{ $c }}18;color:{{ $c }};border:2px solid {{ $c }}30;">
                        <span style="width:8px;height:8px;border-radius:50%;background:{{ $c }};display:block;"></span>
                        {{ $career->status_label }}
                    </span>
                </div>

                @if(PermissionHelper::can('careers.status'))
                <form method="POST" action="{{ route('admin.careers.status', $career) }}">
                    @csrf @method('PATCH')
                    <select name="status" class="form-control-custom mb-3" onchange="this.form.submit()">
                        @foreach(\App\Models\CareerApplication::statusLabels() as $val => $label)
                        <option value="{{ $val }}" {{ $career->status === $val ? 'selected' : '' }}>
                            {{ $label }}
                        </option>
                        @endforeach
                    </select>
                </form>
                @endif
            </div>
        </div>

        {{-- Quick Contact --}}
        <div class="admin-card mb-4">
            <div class="card-head">
                <h5><i class="bi bi-send-fill me-2" style="color:var(--success);"></i>Quick Contact</h5>
            </div>
            <div class="card-body-p">
                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $career->whatsapp) }}?text=Hi%20{{ urlencode($career->name) }}%2C%20we%20reviewed%20your%20application%20and%20would%20like%20to%20discuss%20further."
                   target="_blank"
                   style="display:flex;align-items:center;gap:10px;padding:12px 16px;border-radius:12px;
                          background:rgba(16,185,129,.08);border:1px solid rgba(16,185,129,.20);
                          text-decoration:none;color:#059669;font-weight:700;font-size:14px;margin-bottom:12px;
                          transition:all .2s;"
                   onmouseover="this.style.background='rgba(16,185,129,.14)'"
                   onmouseout="this.style.background='rgba(16,185,129,.08)'">
                    <i class="bi bi-whatsapp" style="font-size:18px;"></i>
                    Message on WhatsApp
                </a>
                <a href="mailto:{{ $career->email }}"
                   style="display:flex;align-items:center;gap:10px;padding:12px 16px;border-radius:12px;
                          background:rgba(99,102,241,.08);border:1px solid rgba(99,102,241,.20);
                          text-decoration:none;color:var(--accent);font-weight:700;font-size:14px;
                          transition:all .2s;"
                   onmouseover="this.style.background='rgba(99,102,241,.14)'"
                   onmouseout="this.style.background='rgba(99,102,241,.08)'">
                    <i class="bi bi-envelope-fill" style="font-size:18px;"></i>
                    Send Email
                </a>
            </div>
        </div>

        {{-- Danger Zone --}}
        @if(PermissionHelper::can('careers.delete'))
        <div class="admin-card">
            <div class="card-head">
                <h5 style="color:var(--danger);"><i class="bi bi-exclamation-triangle-fill me-2"></i>Danger Zone</h5>
            </div>
            <div class="card-body-p">
                <form method="POST" action="{{ route('admin.careers.destroy', $career) }}" id="deleteForm">
                    @csrf @method('DELETE')
                </form>
                <button type="button" class="btn-danger-custom w-100 justify-content-center"
                    onclick="confirmForm('Permanently delete this application from {{ addslashes($career->name) }}?', 'deleteForm')">
                    <i class="bi bi-trash3"></i> Delete Application
                </button>
            </div>
        </div>
        @endif

    </div>
</div>

@endsection
