@extends('layouts.admin')

@section('page_title', 'Resume')

@push('styles')
<style>
    .resume-drop-zone {
        border: 2px dashed var(--border);
        border-radius: 16px;
        padding: 48px 24px;
        text-align: center;
        cursor: pointer;
        transition: all 0.3s ease;
        background: #fafbff;
        position: relative;
    }
    .resume-drop-zone:hover,
    .resume-drop-zone.drag-over {
        border-color: var(--accent);
        background: rgba(99,102,241,0.04);
    }
    .resume-drop-zone input[type="file"] {
        position: absolute;
        inset: 0;
        opacity: 0;
        cursor: pointer;
        width: 100%;
        height: 100%;
    }
    .drop-icon {
        width: 64px;
        height: 64px;
        background: rgba(99,102,241,0.1);
        border-radius: 18px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 16px;
        font-size: 28px;
        color: var(--accent);
    }
    .drop-title {
        font-size: 15px;
        font-weight: 600;
        color: var(--text-main);
        margin-bottom: 6px;
    }
    .drop-sub {
        font-size: 13px;
        color: var(--text-muted);
    }
    .file-selected-info {
        display: none;
        align-items: center;
        gap: 12px;
        padding: 14px 18px;
        background: rgba(99,102,241,0.07);
        border: 1px solid rgba(99,102,241,0.2);
        border-radius: 12px;
        margin-top: 16px;
    }
    .file-selected-info .file-icon {
        font-size: 26px;
        color: #ef4444;
        flex-shrink: 0;
    }
    .file-selected-info .file-name {
        font-size: 13px;
        font-weight: 600;
        color: var(--text-main);
        word-break: break-all;
    }
    .file-selected-info .file-size {
        font-size: 12px;
        color: var(--text-muted);
        margin-top: 2px;
    }

    /* Current resume card */
    .resume-current-card {
        display: flex;
        align-items: center;
        gap: 20px;
        padding: 22px 24px;
        background: linear-gradient(135deg, rgba(99,102,241,0.06) 0%, rgba(129,140,248,0.06) 100%);
        border: 1px solid rgba(99,102,241,0.18);
        border-radius: 14px;
        flex-wrap: wrap;
    }
    .resume-current-card .pdf-icon {
        width: 52px;
        height: 52px;
        background: #ef4444;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        font-size: 22px;
        flex-shrink: 0;
    }
    .resume-current-card .resume-meta {
        flex: 1;
        min-width: 0;
    }
    .resume-current-card .resume-meta .label {
        font-size: 11px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.7px;
        color: var(--text-muted);
        margin-bottom: 4px;
    }
    .resume-current-card .resume-meta .filename {
        font-size: 14px;
        font-weight: 600;
        color: var(--text-main);
        word-break: break-all;
    }
    .resume-current-card .resume-actions {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }
    .status-badge-active {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 5px 12px;
        background: rgba(16,185,129,0.1);
        color: #047857;
        border: 1px solid rgba(16,185,129,0.2);
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
    }
    .status-badge-none {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 5px 12px;
        background: rgba(245,158,11,0.1);
        color: #92400e;
        border: 1px solid rgba(245,158,11,0.2);
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
    }

    @media (max-width: 576px) {
        .resume-current-card { flex-direction: column; align-items: flex-start; gap: 14px; }
        .resume-current-card .resume-actions { width: 100%; }
        .resume-current-card .resume-actions .btn-primary-custom,
        .resume-current-card .resume-actions .btn-danger-custom { flex: 1; justify-content: center; }
    }
</style>
@endpush

@section('content')

<!-- Page Header -->
<div class="page-header d-flex align-items-center justify-content-between flex-wrap gap-3 mb-4">
    <div>
        <h1>Resume Manager</h1>
        <p>Upload your resume PDF — it will be available for download on the About page.</p>
    </div>
    <a href="{{ route('about-us') }}" target="_blank" class="btn-ghost">
        <i class="bi bi-eye"></i> Preview About Page
    </a>
</div>

<!-- Current Status -->
<div class="admin-card mb-4">
    <div class="card-head">
        <h5><i class="bi bi-file-earmark-person-fill me-2"></i>Current Resume</h5>
        @if($resume)
            <span class="status-badge-active"><i class="bi bi-check-circle-fill"></i> Active</span>
        @else
            <span class="status-badge-none"><i class="bi bi-exclamation-circle-fill"></i> No Resume</span>
        @endif
    </div>
    <div class="card-body-p">
        @if($resume)
            <div class="resume-current-card">
                <div class="pdf-icon">
                    <i class="bi bi-filetype-pdf"></i>
                </div>
                <div class="resume-meta">
                    <div class="label">Uploaded File</div>
                    <div class="filename">{{ $resume }}</div>
                    <div style="font-size:12px; color:var(--text-muted); margin-top:4px;">
                        Accessible at:
                        <code style="font-size:11px; background:#f1f5f9; padding:2px 6px; border-radius:5px;">
                            /uploads/{{ $resume }}
                        </code>
                    </div>
                </div>
                <div class="resume-actions">
                    <a href="{{ route('resume.download') }}"
                       class="btn-info-custom"
                       download>
                        <i class="bi bi-download"></i>
                        <span>Download</span>
                    </a>
                    <form action="{{ route('admin.resume.delete') }}" method="POST"
                          id="deleteResumeForm">
                        @csrf
                        @method('DELETE')
                        <button type="button"
                                class="btn-danger-custom"
                                onclick="confirmForm('Are you sure you want to delete the current resume? This cannot be undone.', 'deleteResumeForm')">
                            <i class="bi bi-trash3"></i>
                            <span>Delete</span>
                        </button>
                    </form>
                </div>
            </div>
        @else
            <div style="text-align:center; padding: 32px 0; color:var(--text-muted);">
                <i class="bi bi-file-earmark-x" style="font-size:48px; opacity:0.3; display:block; margin-bottom:12px;"></i>
                <p style="font-size:14px; margin:0;">No resume uploaded yet. Use the form below to upload one.</p>
            </div>
        @endif
    </div>
</div>

<!-- Upload Form -->
<div class="admin-card">
    <div class="card-head">
        <h5><i class="bi bi-cloud-upload-fill me-2"></i>{{ $resume ? 'Replace Resume' : 'Upload Resume' }}</h5>
    </div>
    <div class="card-body-p">
        <form action="{{ route('admin.resume.upload') }}" method="POST" enctype="multipart/form-data" id="resumeForm">
            @csrf

            <div class="resume-drop-zone" id="dropZone">
                <input type="file"
                       name="resume"
                       id="resumeInput"
                       accept=".pdf"
                       onchange="onFileSelected(this)"
                       required>

                <div class="drop-icon">
                    <i class="bi bi-file-earmark-arrow-up"></i>
                </div>
                <div class="drop-title">Drag & drop your resume here</div>
                <div class="drop-sub">or <strong style="color:var(--accent);">click to browse</strong></div>
                <div class="drop-sub mt-2" style="font-size:12px;">PDF only · Max 10 MB</div>
            </div>

            @error('resume')
                <div style="color:var(--danger); font-size:12px; margin-top:8px;">
                    <i class="bi bi-exclamation-circle"></i> {{ $message }}
                </div>
            @enderror

            <!-- Selected file info -->
            <div class="file-selected-info" id="fileInfo">
                <i class="bi bi-filetype-pdf file-icon"></i>
                <div>
                    <div class="file-name" id="fileName">—</div>
                    <div class="file-size" id="fileSize">—</div>
                </div>
            </div>

            @if($resume)
                <div style="margin-top:14px; padding:12px 16px; background:rgba(245,158,11,0.08); border:1px solid rgba(245,158,11,0.2); border-radius:10px; font-size:13px; color:#92400e;">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i>
                    Uploading a new file will replace and permanently delete the current resume.
                </div>
            @endif

            <div class="d-flex gap-3 mt-4">
                <button type="submit" class="btn-primary-custom" id="submitBtn" disabled>
                    <i class="bi bi-cloud-upload"></i>
                    {{ $resume ? 'Replace Resume' : 'Upload Resume' }}
                </button>
                <a href="{{ route('admin.resume') }}" class="btn-ghost">Cancel</a>
            </div>
        </form>
    </div>
</div>

@endsection

@push('scripts')
<script>
    const dropZone   = document.getElementById('dropZone');
    const fileInput  = document.getElementById('resumeInput');
    const fileInfo   = document.getElementById('fileInfo');
    const fileName   = document.getElementById('fileName');
    const fileSize   = document.getElementById('fileSize');
    const submitBtn  = document.getElementById('submitBtn');

    function formatBytes(bytes) {
        if (bytes < 1024) return bytes + ' B';
        if (bytes < 1024 * 1024) return (bytes / 1024).toFixed(1) + ' KB';
        return (bytes / (1024 * 1024)).toFixed(2) + ' MB';
    }

    function onFileSelected(input) {
        if (input.files && input.files[0]) {
            const f = input.files[0];
            fileName.textContent = f.name;
            fileSize.textContent = formatBytes(f.size);
            fileInfo.style.display = 'flex';
            submitBtn.disabled = false;
        }
    }

    // Drag & drop
    dropZone.addEventListener('dragover', e => {
        e.preventDefault();
        dropZone.classList.add('drag-over');
    });
    dropZone.addEventListener('dragleave', () => {
        dropZone.classList.remove('drag-over');
    });
    dropZone.addEventListener('drop', e => {
        e.preventDefault();
        dropZone.classList.remove('drag-over');
        const dt = e.dataTransfer;
        if (dt.files && dt.files[0]) {
            const f = dt.files[0];
            if (f.type !== 'application/pdf') {
                alert('Only PDF files are allowed.');
                return;
            }
            // Assign to input
            const dataTransfer = new DataTransfer();
            dataTransfer.items.add(f);
            fileInput.files = dataTransfer.files;
            onFileSelected(fileInput);
        }
    });
</script>
@endpush
