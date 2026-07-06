@extends('layouts.admin')

@section('page_title', 'Dashboard')

@section('content')

@php
    $blogCount    = \App\Models\Blog::count();
    $messageCount = \App\Models\Contact::count();
    $projectCount = \App\Models\Project::count();
    $commentCount = \App\Models\Comment::count();

    $recentBlogs    = \App\Models\Blog::latest()->take(5)->get();
    $recentMessages = \App\Models\Contact::latest()->take(5)->get();
    $recentProjects = \App\Models\Project::latest()->take(4)->get();
@endphp

<!-- Page Header -->
<div class="page-header">
    <h1>Welcome back, Maaz 👋</h1>
    <p>Here's what's happening across your site today.</p>
</div>

<!-- ── STAT CARDS ─────────────────────────────────────────── -->
<div class="row g-3 mb-4">

    <div class="col-sm-6 col-xl-3">
        <div class="stat-card">
            <div class="stat-icon purple"><i class="bi bi-journal-richtext"></i></div>
            <div class="stat-info">
                <div class="label">Total Blogs</div>
                <div class="value">{{ $blogCount }}</div>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-xl-3">
        <div class="stat-card">
            <div class="stat-icon green"><i class="bi bi-envelope-fill"></i></div>
            <div class="stat-info">
                <div class="label">Messages</div>
                <div class="value">{{ $messageCount }}</div>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-xl-3">
        <div class="stat-card">
            <div class="stat-icon blue"><i class="bi bi-folder2-open"></i></div>
            <div class="stat-info">
                <div class="label">Projects</div>
                <div class="value">{{ $projectCount }}</div>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-xl-3">
        <div class="stat-card">
            <div class="stat-icon orange"><i class="bi bi-chat-dots-fill"></i></div>
            <div class="stat-info">
                <div class="label">Comments</div>
                <div class="value">{{ $commentCount }}</div>
            </div>
        </div>
    </div>

</div>

<!-- ── MAIN GRID ───────────────────────────────────────────── -->
<div class="row g-3 mb-4">

    <!-- Recent Blogs -->
    <div class="col-lg-7">
        <div class="admin-card h-100">
            <div class="card-head">
                <h5><i class="bi bi-journal-text me-2" style="color:var(--accent);"></i>Recent Blogs</h5>
                <a href="{{ route('admin.blogs') }}" class="btn-ghost" style="padding:6px 12px; font-size:12px;">
                    View All <i class="bi bi-arrow-right"></i>
                </a>
            </div>
            <div class="card-body-p p-0">
                @forelse($recentBlogs as $blog)
                <div style="display:flex; align-items:center; gap:14px; padding:14px 22px; border-bottom:1px solid var(--border);">
                    <img src="{{ asset('uploads/'.$blog->image) }}"
                         style="width:46px; height:46px; border-radius:10px; object-fit:cover; flex-shrink:0;"
                         onerror="this.src='https://via.placeholder.com/46'">
                    <div style="flex:1; min-width:0;">
                        <div style="font-weight:600; font-size:14px; white-space:nowrap; overflow:hidden; text-overflow:ellipsis;">
                            {{ $blog->title }}
                        </div>
                        <div style="font-size:12px; color:var(--text-muted);">
                            {{ $blog->created_at->diffForHumans() }}
                        </div>
                    </div>
                    <a href="{{ route('admin.blog.delete', $blog->id) }}" style="color:var(--text-muted); font-size:16px; text-decoration:none;">
                        <i class="bi bi-pencil-square"></i>
                    </a>
                </div>
                @empty
                <div style="padding:32px; text-align:center; color:var(--text-muted);">
                    <i class="bi bi-journal-x" style="font-size:36px; opacity:0.3;"></i>
                    <p class="mt-2 mb-0">No blogs yet</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Recent Messages -->
    <div class="col-lg-5">
        <div class="admin-card h-100">
            <div class="card-head">
                <h5><i class="bi bi-envelope me-2" style="color:var(--success);"></i>Recent Messages</h5>
                <a href="{{ route('admin.messages') }}" class="btn-ghost" style="padding:6px 12px; font-size:12px;">
                    View All <i class="bi bi-arrow-right"></i>
                </a>
            </div>
            <div class="card-body-p p-0">
                @forelse($recentMessages as $msg)
                <a href="{{ route('admin.contacts.show', $msg->id) }}"
                   style="display:flex; align-items:center; gap:12px; padding:14px 22px; border-bottom:1px solid var(--border); text-decoration:none; color:inherit; transition:background 0.15s;"
                   onmouseover="this.style.background='#fafbff'" onmouseout="this.style.background=''">
                    <div style="width:38px; height:38px; background:linear-gradient(135deg, var(--accent), #818cf8); border-radius:50%; display:flex; align-items:center; justify-content:center; color:#fff; font-weight:700; font-size:14px; flex-shrink:0;">
                        {{ strtoupper(substr($msg->name, 0, 1)) }}
                    </div>
                    <div style="flex:1; min-width:0;">
                        <div style="font-weight:600; font-size:13px;">{{ $msg->name }}</div>
                        <div style="font-size:12px; color:var(--text-muted); white-space:nowrap; overflow:hidden; text-overflow:ellipsis;">
                            {{ \Illuminate\Support\Str::limit($msg->subject, 35) }}
                        </div>
                    </div>
                    <div style="font-size:11px; color:var(--text-muted); white-space:nowrap;">
                        {{ $msg->created_at->diffForHumans() }}
                    </div>
                </a>
                @empty
                <div style="padding:32px; text-align:center; color:var(--text-muted);">
                    <i class="bi bi-inbox" style="font-size:36px; opacity:0.3;"></i>
                    <p class="mt-2 mb-0">No messages yet</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>

</div>

<!-- ── QUICK ACTIONS + PROJECTS ────────────────────────────── -->
<div class="row g-3">

    <!-- Quick Actions -->
    <div class="col-lg-4">
        <div class="admin-card">
            <div class="card-head">
                <h5><i class="bi bi-lightning-fill me-2" style="color:var(--warning);"></i>Quick Actions</h5>
            </div>
            <div class="card-body-p">
                <a href="{{ route('admin.blog') }}" class="btn-primary-custom w-100 mb-3 justify-content-center">
                    <i class="bi bi-plus-lg"></i> New Blog Post
                </a>
                <a href="{{ route('admin.projects.create') }}" class="btn-ghost w-100 mb-3 justify-content-center">
                    <i class="bi bi-folder-plus"></i> Add Project
                </a>
                <a href="{{ route('admin.messages') }}" class="btn-ghost w-100 justify-content-center">
                    <i class="bi bi-envelope"></i> Check Messages
                </a>
            </div>
        </div>
    </div>

    <!-- Recent Projects -->
    <div class="col-lg-8">
        <div class="admin-card">
            <div class="card-head">
                <h5><i class="bi bi-folder2 me-2" style="color:var(--info);"></i>Recent Projects</h5>
                <a href="{{ route('admin.projects.index') }}" class="btn-primary-custom" style="padding:6px 14px; font-size:12px;">
                    <i class="bi bi-folder2-open"></i> View All
                </a>
            </div>
            <div class="card-body-p">
                @if($recentProjects->count())
                <div class="row g-2">
                    @foreach($recentProjects as $project)
                    <div class="col-6 col-md-3">
                        <div style="border-radius:12px; overflow:hidden; border:1px solid var(--border);">
                            <img src="{{ asset('uploads/'.$project->image1) }}"
                                 style="width:100%; height:90px; object-fit:cover; display:block;"
                                 onerror="this.src='https://via.placeholder.com/200x90'">
                            <div style="padding:8px; background:#fff;">
                                <div style="font-size:12px; font-weight:600; white-space:nowrap; overflow:hidden; text-overflow:ellipsis;">
                                    {{ $project->title }}
                                </div>
                                <div style="font-size:11px; color:var(--text-muted);">{{ $project->client_name }}</div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                @else
                <div style="text-align:center; padding:24px; color:var(--text-muted);">
                    <i class="bi bi-folder-x" style="font-size:36px; opacity:0.3;"></i>
                    <p class="mt-2 mb-0">No projects yet</p>
                </div>
                @endif
            </div>
        </div>
    </div>

</div>

@endsection
