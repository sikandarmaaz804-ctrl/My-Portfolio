@extends('layouts.admin')

@section('page_title', 'Career Applications')

@php use App\Helpers\PermissionHelper; @endphp

@section('content')

<div class="page-header">
    <h1><i class="bi bi-person-lines-fill me-2" style="color:var(--accent);"></i>Career Applications</h1>
    <p>Programmer job applications submitted through the website.</p>
</div>

{{-- ── Status Filter Tabs ──────────────────────────────────────── --}}
<div class="admin-card mb-4">
    <div class="card-body-p" style="padding:14px 22px;">
        <div style="display:flex;gap:8px;flex-wrap:wrap;align-items:center;">
            <a href="{{ route('admin.careers.index') }}"
               style="padding:7px 18px;border-radius:20px;font-size:13px;font-weight:600;text-decoration:none;
               {{ !$status ? 'background:var(--accent);color:#fff;' : 'background:var(--body-bg);color:var(--text-muted);border:1px solid var(--border);' }}">
                All
                <span style="margin-left:5px;font-size:11px;font-weight:700;
                    {{ !$status ? 'background:rgba(255,255,255,.22);' : 'background:var(--border);' }}
                    padding:2px 7px;border-radius:20px;">{{ $counts['all'] }}</span>
            </a>
            @foreach(['new' => ['label'=>'New','color'=>'#f59e0b'], 'reviewed' => ['label'=>'Reviewed','color'=>'#3b82f6'], 'shortlisted' => ['label'=>'Shortlisted','color'=>'#10b981'], 'rejected' => ['label'=>'Rejected','color'=>'#ef4444']] as $key => $meta)
            <a href="{{ route('admin.careers.index', ['status' => $key]) }}"
               style="padding:7px 18px;border-radius:20px;font-size:13px;font-weight:600;text-decoration:none;
               {{ $status === $key ? 'background:'.($key === 'new' ? '#f59e0b' : ($key === 'reviewed' ? '#3b82f6' : ($key === 'shortlisted' ? '#10b981' : '#ef4444'))).';color:#fff;' : 'background:var(--body-bg);color:var(--text-muted);border:1px solid var(--border);' }}">
                {{ $meta['label'] }}
                <span style="margin-left:5px;font-size:11px;font-weight:700;
                    {{ $status === $key ? 'background:rgba(255,255,255,.22);' : 'background:var(--border);' }}
                    padding:2px 7px;border-radius:20px;">{{ $counts[$key] }}</span>
            </a>
            @endforeach

            @if(PermissionHelper::can('careers.delete') && $counts['all'] > 0)
            <form method="POST" action="{{ route('admin.careers.destroyAll') }}" style="margin-left:auto;">
                @csrf @method('DELETE')
                <button type="button"
                    class="btn-danger-custom"
                    onclick="confirmForm('Delete ALL applications permanently? This cannot be undone.', 'deleteAllForm')">
                    <i class="bi bi-trash3"></i> Delete All
                </button>
            </form>
            <form id="deleteAllForm" method="POST" action="{{ route('admin.careers.destroyAll') }}" style="display:none;">
                @csrf @method('DELETE')
            </form>
            @endif
        </div>
    </div>
</div>

{{-- ── Applications Table ──────────────────────────────────────── --}}
<div class="admin-card">
    <div class="card-head">
        <h5>
            <i class="bi bi-person-lines-fill me-2" style="color:var(--accent);"></i>
            {{ $status ? ucfirst($status) . ' Applications' : 'All Applications' }}
            <span style="font-size:12px;font-weight:500;color:var(--text-muted);margin-left:8px;">({{ $applications->count() }})</span>
        </h5>
        <a href="{{ route('careers') }}" target="_blank" class="btn-ghost" style="padding:6px 14px;font-size:12px;">
            <i class="bi bi-box-arrow-up-right"></i> View Application Form
        </a>
    </div>

    @if($applications->isEmpty())
    <div style="text-align:center;padding:60px 20px;color:var(--text-muted);">
        <i class="bi bi-person-x" style="font-size:48px;opacity:.3;"></i>
        <p style="margin:16px 0 0;font-size:14px;">No applications found{{ $status ? ' for this status' : '' }}.</p>
    </div>
    @else
    <div style="overflow-x:auto;">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Applicant</th>
                    <th>Expertise</th>
                    <th>Education</th>
                    <th>WhatsApp</th>
                    <th>Status</th>
                    <th>Applied</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($applications as $i => $app)
                <tr>
                    <td style="color:var(--text-muted);font-size:12px;">{{ $i + 1 }}</td>
                    <td>
                        <div style="display:flex;align-items:center;gap:10px;">
                            <div style="width:36px;height:36px;border-radius:50%;
                                background:linear-gradient(135deg,var(--accent),#818cf8);
                                display:flex;align-items:center;justify-content:center;
                                color:#fff;font-weight:700;font-size:14px;flex-shrink:0;">
                                {{ strtoupper(substr($app->name, 0, 1)) }}
                            </div>
                            <div>
                                <div style="font-weight:600;font-size:13px;">{{ $app->name }}</div>
                                <div style="font-size:11px;color:var(--text-muted);">{{ $app->email }}</div>
                            </div>
                        </div>
                    </td>
                    <td style="font-size:13px;">{{ Str::limit($app->expertise, 32) }}</td>
                    <td style="font-size:13px;color:var(--text-muted);">{{ Str::limit($app->education, 30) }}</td>
                    <td>
                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $app->whatsapp) }}"
                           target="_blank"
                           style="display:inline-flex;align-items:center;gap:5px;font-size:12px;font-weight:600;color:#059669;text-decoration:none;background:rgba(16,185,129,.08);padding:4px 10px;border-radius:20px;">
                            <i class="bi bi-whatsapp"></i> {{ $app->whatsapp }}
                        </a>
                    </td>
                    <td>
                        @php
                            $colors = ['new'=>'#f59e0b','reviewed'=>'#3b82f6','shortlisted'=>'#10b981','rejected'=>'#ef4444'];
                            $c = $colors[$app->status] ?? '#94a3b8';
                        @endphp
                        <span style="display:inline-flex;align-items:center;gap:5px;padding:4px 10px;border-radius:20px;
                            font-size:11px;font-weight:700;background:{{ $c }}18;color:{{ $c }};">
                            <span style="width:5px;height:5px;border-radius:50%;background:{{ $c }};display:inline-block;"></span>
                            {{ $app->status_label }}
                        </span>
                    </td>
                    <td style="font-size:12px;color:var(--text-muted);white-space:nowrap;">
                        {{ $app->created_at->diffForHumans() }}
                    </td>
                    <td>
                        <div style="display:flex;gap:6px;">
                            <a href="{{ route('admin.careers.show', $app) }}" class="btn-info-custom">
                                <i class="bi bi-eye"></i> View
                            </a>
                            @if(PermissionHelper::can('careers.delete'))
                            <form method="POST" action="{{ route('admin.careers.destroy', $app) }}" id="del-{{ $app->id }}">
                                @csrf @method('DELETE')
                            </form>
                            <button type="button" class="btn-danger-custom"
                                onclick="confirmForm('Delete this application from {{ addslashes($app->name) }}?', 'del-{{ $app->id }}')">
                                <i class="bi bi-trash3"></i>
                            </button>
                            @endif
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif
</div>

@endsection
