@extends('layouts.admin')

@section('page_title', 'System Utilities')

@section('content')

<!-- Page Header -->
<div class="page-header">
    <h1>System Utilities & Hosting Prep</h1>
    <p>Manage application paths, link storage, execute migrations, and optimize caches for Hostinger.</p>
</div>

<div class="row g-4">

    <!-- Path & Environment Diagnostics -->
    <div class="col-lg-4">
        <div class="admin-card h-100">
            <div class="card-head">
                <h5><i class="bi bi-info-circle me-2" style="color:var(--info);"></i>System Environment</h5>
            </div>
            <div class="card-body-p">
                <div class="mb-3">
                    <span class="d-block text-muted small uppercase font-weight-bold">Environment (APP_ENV)</span>
                    <strong class="text-dark">{{ app()->environment() }}</strong>
                </div>
                <div class="mb-3">
                    <span class="d-block text-muted small uppercase font-weight-bold">Debug Mode (APP_DEBUG)</span>
                    <span class="badge {{ config('app.debug') ? 'bg-danger' : 'bg-success' }}">
                        {{ config('app.debug') ? 'Enabled (Local)' : 'Disabled (Production)' }}
                    </span>
                </div>
                <div class="mb-3">
                    <span class="d-block text-muted small uppercase font-weight-bold">Project Base Path</span>
                    <code class="text-primary small" style="word-break: break-all;">{{ base_path() }}</code>
                </div>
                <div class="mb-3">
                    <span class="d-block text-muted small uppercase font-weight-bold">Resolved Public Path</span>
                    <code class="text-success small" style="word-break: break-all;">{{ public_path() }}</code>
                </div>
                <div class="p-3 bg-light rounded-3 small text-muted border">
                    <i class="bi bi-lightbulb-fill text-warning me-1"></i>
                    In production, if a <code>public_html</code> folder is found parallel or inside the project directory, the resolved public path is updated dynamically.
                </div>
            </div>
        </div>
    </div>

    <!-- Live Server Utility Commands -->
    <div class="col-lg-8">
        <div class="admin-card">
            <div class="card-head">
                <h5><i class="bi bi-terminal me-2" style="color:var(--accent);"></i>Artisan Operations</h5>
            </div>
            <div class="card-body-p">
                <div class="row g-3">
                    
                    <!-- Storage Link -->
                    <div class="col-md-6">
                        <div class="p-3 border rounded-3 h-100 d-flex flex-column justify-content-between">
                            <div>
                                <h6 class="font-weight-bold mb-1"><i class="bi bi-link-45deg text-primary"></i> Link Storage</h6>
                                <p class="text-muted small mb-3">Links the storage directory to the public folder (e.g. <code>public_html/storage</code>) so file uploads are web-accessible.</p>
                            </div>
                            <form action="{{ route('admin.system.run_command') }}" method="POST">
                                @csrf
                                <input type="hidden" name="command" value="storage_link">
                                <button type="submit" class="btn-ghost w-100 justify-content-center">
                                    <i class="bi bi-link-45deg"></i> Link Storage
                                </button>
                            </form>
                        </div>
                    </div>

                    <!-- Database Migrations -->
                    <div class="col-md-6">
                        <div class="p-3 border rounded-3 h-100 d-flex flex-column justify-content-between">
                            <div>
                                <h6 class="font-weight-bold mb-1"><i class="bi bi-database-fill-gear text-success"></i> Run Migrations</h6>
                                <p class="text-muted small mb-3">Runs outstanding database schema migrations. Safe in production using the <code>--force</code> flag.</p>
                            </div>
                            <form action="{{ route('admin.system.run_command') }}" method="POST" onsubmit="return confirm('Run database migrations on live database?')">
                                @csrf
                                <input type="hidden" name="command" value="migrate">
                                <button type="submit" class="btn-ghost w-100 justify-content-center text-success" style="border-color: rgba(16,185,129,0.3)">
                                    <i class="bi bi-database-fill-gear"></i> Run Migrations
                                </button>
                            </form>
                        </div>
                    </div>

                    <!-- Clear Caches -->
                    <div class="col-md-6">
                        <div class="p-3 border rounded-3 h-100 d-flex flex-column justify-content-between">
                            <div>
                                <h6 class="font-weight-bold mb-1"><i class="bi bi-trash3 text-danger"></i> Clear All Cache</h6>
                                <p class="text-muted small mb-3">Clears application, configuration, route, and view caches. Run this after editing configuration or the <code>.env</code> file.</p>
                            </div>
                            <form action="{{ route('admin.system.run_command') }}" method="POST">
                                @csrf
                                <input type="hidden" name="command" value="clear_cache">
                                <button type="submit" class="btn-ghost w-100 justify-content-center text-danger" style="border-color: rgba(239,68,68,0.3)">
                                    <i class="bi bi-trash3"></i> Clear Caches
                                </button>
                            </form>
                        </div>
                    </div>

                    <!-- Cache and Optimize -->
                    <div class="col-md-6">
                        <div class="p-3 border rounded-3 h-100 d-flex flex-column justify-content-between">
                            <div>
                                <h6 class="font-weight-bold mb-1"><i class="bi bi-rocket-takeoff text-warning"></i> Optimize Application</h6>
                                <p class="text-muted small mb-3">Generates route, view, and configuration caches to boost production loading speeds on Hostinger.</p>
                            </div>
                            <form action="{{ route('admin.system.run_command') }}" method="POST">
                                @csrf
                                <input type="hidden" name="command" value="optimize">
                                <button type="submit" class="btn-ghost w-100 justify-content-center text-warning" style="border-color: rgba(245,158,11,0.3)">
                                    <i class="bi bi-rocket-takeoff"></i> Optimize Site
                                </button>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

</div>

<!-- Command Output Terminal -->
@if(session('command_output'))
<div class="admin-card mt-4">
    <div class="card-head" style="background:#0f172a; border-bottom:1px solid #1e293b;">
        <h5 style="color:#f8fafc;"><i class="bi bi-cpu me-2" style="color:var(--success);"></i>Command Execution Output</h5>
    </div>
    <div class="card-body-p" style="background:#020617; padding:18px;">
        <pre style="color:#22c55e; margin:0; font-family:'Courier New', monospace; font-size:13px; line-height:1.5; overflow-x:auto;">{{ session('command_output') }}</pre>
    </div>
</div>
@endif

@endsection
