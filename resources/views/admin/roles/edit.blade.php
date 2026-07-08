@extends('layouts.admin')

@section('page_title', 'Edit Role — ' . $role->name)

@section('content')

<div class="page-header d-flex align-items-center justify-content-between flex-wrap gap-3 mb-4">
    <div>
        <h1>Edit Role: {{ $role->name }}</h1>
        <p>Update role details and fine-tune its permissions.</p>
    </div>
    <a href="{{ route('admin.roles.index') }}" class="btn-ghost">
        <i class="bi bi-arrow-left"></i> Back to Roles
    </a>
</div>

<form action="{{ route('admin.roles.update', $role->id) }}" method="POST" id="roleForm">
    @csrf @method('PUT')

    <div class="row g-3">

        <!-- Left: Role Info -->
        <div class="col-lg-4">
            <div class="admin-card">
                <div class="card-head">
                    <h5><i class="bi bi-shield-fill me-2" style="color:var(--accent);"></i>Role Details</h5>
                </div>
                <div class="card-body-p">

                    <div class="mb-3">
                        <label class="form-label-custom">Role Name <span style="color:var(--danger)">*</span></label>
                        <input type="text" name="name" class="form-control-custom"
                               value="{{ old('name', $role->name) }}" required>
                        @error('name')<div style="color:var(--danger); font-size:12px; margin-top:4px;">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label-custom">Description</label>
                        <textarea name="description" class="form-control-custom" rows="3">{{ old('description', $role->description) }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label-custom">Badge Color</label>
                        <div style="display:flex; align-items:center; gap:10px;">
                            <input type="color" name="color" id="colorPicker"
                                   value="{{ old('color', $role->color) }}"
                                   style="width:44px; height:36px; border:1px solid var(--border); border-radius:8px; cursor:pointer; padding:2px;">
                            <input type="text" id="colorHex" class="form-control-custom"
                                   value="{{ old('color', $role->color) }}"
                                   style="flex:1;" maxlength="7">
                        </div>
                        <div style="margin-top:8px;">
                            <div style="font-size:12px; color:var(--text-muted); margin-bottom:6px;">Quick presets:</div>
                            <div style="display:flex; gap:6px; flex-wrap:wrap;">
                                @foreach(['#6366f1','#10b981','#f59e0b','#ef4444','#3b82f6','#8b5cf6','#ec4899','#14b8a6'] as $preset)
                                <button type="button"
                                        onclick="setColor('{{ $preset }}')"
                                        style="width:28px; height:28px; border-radius:8px; border:2px solid transparent;
                                               background:{{ $preset }}; cursor:pointer; transition:all 0.2s;"
                                        title="{{ $preset }}"></button>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <!-- Preview -->
                    <div style="padding:14px; background:var(--body-bg); border-radius:10px;">
                        <div style="font-size:12px; color:var(--text-muted); margin-bottom:8px; font-weight:600;">Preview</div>
                        <div style="display:flex; align-items:center; gap:8px;">
                            <div id="previewIcon" style="
                                width:36px; height:36px; border-radius:10px;
                                background: {{ $role->color }}22;
                                display:flex; align-items:center; justify-content:center;
                            ">
                                <i class="bi bi-shield-fill" id="previewIconColor" style="color:{{ $role->color }}; font-size:17px;"></i>
                            </div>
                            <div>
                                <div id="previewName" style="font-weight:700; font-size:14px;">{{ $role->name }}</div>
                                <span id="previewBadge" style="
                                    font-size:11px; font-weight:700; padding:2px 10px; border-radius:20px;
                                    background: {{ $role->color }}22; color: {{ $role->color }};
                                ">{{ $role->slug }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Role Users info -->
                    @if($role->users->count() > 0)
                    <div style="margin-top:16px; padding:12px 14px; background:rgba(59,130,246,0.06); border:1px solid rgba(59,130,246,0.15); border-radius:10px;">
                        <div style="font-size:12px; font-weight:600; color:var(--info);">
                            <i class="bi bi-people-fill me-1"></i>
                            {{ $role->users->count() }} user(s) assigned to this role
                        </div>
                        <a href="{{ route('admin.role-users.index') }}?role={{ $role->id }}" style="font-size:12px; color:var(--info); text-decoration:none; font-weight:600;">
                            View users →
                        </a>
                    </div>
                    @endif

                </div>
            </div>
        </div>

        <!-- Right: Permissions -->
        <div class="col-lg-8">
            <div class="admin-card">
                <div class="card-head">
                    <h5><i class="bi bi-key-fill me-2" style="color:var(--warning);"></i>Permissions</h5>
                    <div style="display:flex; gap:8px;">
                        <button type="button" onclick="selectAll()" class="btn-ghost" style="padding:5px 12px; font-size:12px;">
                            <i class="bi bi-check2-all"></i> Select All
                        </button>
                        <button type="button" onclick="deselectAll()" class="btn-ghost" style="padding:5px 12px; font-size:12px;">
                            <i class="bi bi-x-lg"></i> Clear
                        </button>
                    </div>
                </div>
                <div class="card-body-p">

                    @foreach($permissionsByModule as $module => $perms)
                    <div style="margin-bottom:24px;">
                        <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:10px;">
                            <div style="display:flex; align-items:center; gap:8px;">
                                <span style="width:8px; height:8px; border-radius:50%; background:var(--accent); display:inline-block;"></span>
                                <span style="font-weight:700; font-size:13px; text-transform:uppercase; letter-spacing:0.5px;">
                                    {{ $moduleLabels[$module] ?? ucfirst($module) }}
                                </span>
                            </div>
                            <button type="button"
                                    onclick="toggleModule('{{ $module }}')"
                                    class="btn-ghost"
                                    style="padding:3px 10px; font-size:11px;">
                                Select All
                            </button>
                        </div>

                        <div style="display:flex; flex-wrap:wrap; gap:8px;">
                            @foreach($perms as $perm)
                            <label class="perm-label module-{{ $module }}"
                                   style="
                                display:flex; align-items:center; gap:7px;
                                padding:8px 14px;
                                border:1px solid {{ in_array($perm->id, $assignedIds) ? 'var(--accent)' : 'var(--border)' }};
                                border-radius:8px; cursor:pointer; transition:all 0.2s;
                                background: {{ in_array($perm->id, $assignedIds) ? 'rgba(99,102,241,0.06)' : '' }};
                                user-select:none;
                            ">
                                <input type="checkbox"
                                       name="permissions[]"
                                       value="{{ $perm->id }}"
                                       class="perm-check"
                                       {{ in_array($perm->id, old('permissions', $assignedIds)) ? 'checked' : '' }}
                                       style="width:15px; height:15px; accent-color:var(--accent); cursor:pointer;">
                                <span style="font-size:13px; font-weight:500;">{{ $perm->name }}</span>
                            </label>
                            @endforeach
                        </div>
                    </div>
                    @endforeach

                </div>
            </div>
        </div>

    </div>

    <!-- Submit Bar -->
    <div style="
        position:sticky; bottom:0;
        background:#fff; border-top:1px solid var(--border);
        padding:16px 22px; margin-top:16px;
        border-radius:0 0 12px 12px;
        display:flex; align-items:center; justify-content:space-between; gap:12px;
    ">
        <span id="permCount" style="font-size:13px; color:var(--text-muted);">0 permissions selected</span>
        <div style="display:flex; gap:10px;">
            <a href="{{ route('admin.roles.index') }}" class="btn-ghost">Cancel</a>
            <button type="submit" class="btn-primary-custom">
                <i class="bi bi-check2"></i> Save Changes
            </button>
        </div>
    </div>

</form>

@endsection

@push('scripts')
<script>
    const picker = document.getElementById('colorPicker');
    const hexInput = document.getElementById('colorHex');

    function setColor(hex) {
        picker.value = hex;
        hexInput.value = hex;
        updatePreview(hex);
    }

    picker.addEventListener('input', () => { hexInput.value = picker.value; updatePreview(picker.value); });
    hexInput.addEventListener('input', () => {
        if (/^#[0-9A-Fa-f]{6}$/.test(hexInput.value)) { picker.value = hexInput.value; updatePreview(hexInput.value); }
    });

    function updatePreview(hex) {
        document.getElementById('previewIcon').style.background = hex + '22';
        document.getElementById('previewIconColor').style.color = hex;
        document.getElementById('previewBadge').style.background = hex + '22';
        document.getElementById('previewBadge').style.color = hex;
    }

    document.querySelector('[name="name"]').addEventListener('input', function () {
        document.getElementById('previewName').textContent = this.value || 'Role Name';
        document.getElementById('previewBadge').textContent = this.value.toLowerCase().replace(/[^a-z0-9]+/g, '-').replace(/^-|-$/g, '') || 'slug';
    });

    function updateCount() {
        const count = document.querySelectorAll('.perm-check:checked').length;
        document.getElementById('permCount').textContent = count + ' permission' + (count !== 1 ? 's' : '') + ' selected';
    }

    document.querySelectorAll('.perm-check').forEach(cb => {
        cb.addEventListener('change', function () {
            this.closest('.perm-label').style.borderColor = this.checked ? 'var(--accent)' : 'var(--border)';
            this.closest('.perm-label').style.background  = this.checked ? 'rgba(99,102,241,0.06)' : '';
            updateCount();
        });
    });
    updateCount();

    function toggleModule(module) {
        const boxes = document.querySelectorAll('.module-' + module + ' .perm-check');
        const allChecked = [...boxes].every(b => b.checked);
        boxes.forEach(b => { b.checked = !allChecked; b.dispatchEvent(new Event('change')); });
    }

    function selectAll() { document.querySelectorAll('.perm-check').forEach(b => { b.checked = true; b.dispatchEvent(new Event('change')); }); }
    function deselectAll() { document.querySelectorAll('.perm-check').forEach(b => { b.checked = false; b.dispatchEvent(new Event('change')); }); }

    @if(session('success'))
    Swal.fire({ icon:'success', title:'Done!', text:"{{ session('success') }}", timer:2500, showConfirmButton:false, toast:true, position:'top-end' });
    @endif
</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endpush
