<!DOCTYPE html>
<html class="h-full" data-kt-theme="true" data-kt-theme-mode="light" dir="ltr" lang="en">
 <head>
  <title>
    Revuteck - Defines Everything
  </title>
  
 </head>
 <body class="antialiased flex h-full text-base text-foreground bg-background demo1 kt-sidebar-fixed kt-header-fixed">
  <script>
   const defaultThemeMode = 'light'; // light|dark|system
            let themeMode;

            if (document.documentElement) {
                if (localStorage.getItem('kt-theme')) {
                    themeMode = localStorage.getItem('kt-theme');
                } else if (
                    document.documentElement.hasAttribute('data-kt-theme-mode')
                ) {
                    themeMode =
                        document.documentElement.getAttribute('data-kt-theme-mode');
                } else {
                    themeMode = defaultThemeMode;
                }

                if (themeMode === 'system') {
                    themeMode = window.matchMedia('(prefers-color-scheme: dark)').matches
                        ? 'dark'
                        : 'light';
                }

                document.documentElement.classList.add(themeMode);
            }
  </script>
  <div class="flex grow">
    @include('partials.sidebar')
   <div class="kt-wrapper flex grow flex-col">
    @include('partials.header')
    <main class="grow pt-3" id="content" role="content">
            <div class="kt-container-fixed">
                    <div class="flex flex-wrap items-center lg:items-end justify-between gap-5 pb-7.5">
                        <div class="flex flex-col justify-center gap-2">
                            <h1 class="text-xl font-medium leading-none text-mono">
                            Permissions
                            </h1>
                        <div class="flex items-center gap-2 text-sm font-normal text-secondary-foreground">
                            Granular Access Control Management
                        </div>
                    </div>
                    <div class="flex items-center gap-2.5">
                        <button class="kt-btn kt-btn-primary" data-kt-modal-toggle="#create_permission_modal">
                            <i class="ki-filled ki-plus"></i> Create Permission
                        </button>
                    </div>
                </div>
                
                <div class="kt-container-fixed">
                <div class="grid gap-5 lg:gap-7.5">
                    <div class="lg:col-span-4">
                    <div class="grid">
                    <div class="kt-card kt-card-grid h-full min-w-full">
                    <div class="kt-card-header flex flex-wrap items-center justify-between gap-2 shadow-none">
                        <h3 class="kt-card-title">
                            Permissions
                        </h3>
                        <div class="flex items-center gap-2.5">
                            <div class="kt-input max-w-48">
                                <i class="ki-filled ki-magnifier"></i>
                                <input data-kt-datatable-search="#kt_datatable_1" placeholder="Search Permission" type="text">
                            </div>

                            <a href="{{ url('/permissions/trash') }}" class="kt-btn kt-btn-icon kt-btn-light kt-btn-sm relative" title="Trash Bin">
                                <i class="ki-filled ki-trash"></i>
                      
                                <span class="absolute top-0 right-0 -mt-1 -mr-1 flex h-2 w-2">
                                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-primary opacity-75"></span>
                                    <span class="relative inline-flex rounded-full h-2 w-2 bg-primary"></span>
                                </span>
                            
                            </a>
                        </div>
                    </div>
                    <div class="kt-card-table">
                        <div class="grid" data-kt-datatable="true" data-kt-datatable-page-size="5" id="teams_datatable">
                        <div class="kt-scrollable-x-auto">
                        <table class="kt-table kt-table-border table-fixed" data-kt-datatable-table="true" id="kt_datatable_1">
                <thead>
                    <tr>
                       
                        <th class="w-[250px]">
                            <span class="kt-table-col">
                                <span class="kt-table-col-label">Permission Details</span>
                                <span class="kt-table-col-sort"></span>
                            </span>
                        </th>
                        <th class="w-[180px]">
                            <span class="kt-table-col">
                                <span class="kt-table-col-label">Module / Action</span>
                                <span class="kt-table-col-sort"></span>
                            </span>
                        </th>
                        <th class="w-[150px]">
                            <span class="kt-table-col">
                                <span class="kt-table-col-label">Description</span>
                                <span class="kt-table-col-sort"></span>
                            </span>
                        </th>
                        <th class="w-[125px]">
                            <span class="kt-table-col">
                                <span class="kt-table-col-label">Status</span>
                                <span class="kt-table-col-sort"></span>
                            </span>
                        </th>
                        <th class="w-[135px]">
                            <span class="kt-table-col">
                                <span class="kt-table-col-label">Created At</span>
                                <span class="kt-table-col-sort"></span>
                            </span>
                        </th>
                        <th class="w-[100px] text-right">
                            <span class="kt-table-col justify-end">
                                <span class="kt-table-col-label">Actions</span>
                            </span>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($permissions as $permission)
                    <tr>
                        <td>
                            <div class="flex flex-col gap-2">
                                <a class="leading-none font-medium text-sm text-mono hover:text-primary" href="#">
                                    {{ $permission->permission_name }}
                                </a>
                                <span class="text-2sm text-secondary-foreground font-normal leading-3">
                                    Code: {{ $permission->permission_code }}
                                </span>
                            </div>
                        </td>

                        <td>
                            <div class="flex flex-col gap-1">
                                <span class="kt-badge kt-badge-outline kt-badge-primary kt-badge-sm self-start">
                                    {{ $permission->module_name }}
                                </span>
                                <span class="text-xs text-muted-foreground">Action: {{ $permission->action_name }}</span>
                            </div>
                        </td>
                        <td>
                            <div class="flex flex-col gap-1">
                                
                                <span class="text-xs text-muted-foreground">{{ $permission->description }}</span>
                            </div>
                        </td>

                        <td>
                            @if($permission->is_active)
                                <div class="kt-badge rounded-full kt-badge-outline kt-badge-success gap-1.5 kt-badge-sm">
                                    <span class="kt-badge-dot"></span> Active
                                </div>
                            @else
                                <div class="kt-badge rounded-full kt-badge-outline kt-badge-destructive gap-1.5 kt-badge-sm">
                                    <span class="kt-badge-dot"></span> Inactive
                                </div>
                            @endif
                        </td>

                        <td>
                            <span class="text-sm font-medium text-secondary-foreground">
                                {{ \Carbon\Carbon::parse($permission->created_at)->format('d M, Y') }}
                            </span>
                        </td>

                        <td class="text-right">
                            <div class="flex justify-end gap-2">
                                <button 
                                    type="button"
                                    class="kt-btn kt-btn-icon kt-btn-ghost kt-btn-sm text-primary hover:bg-primary/10 edit-permission-btn" 
                                    data-id="{{ $permission->id }}"
                                    data-name="{{ $permission->permission_name }}"
                                    data-code="{{ $permission->permission_code }}"
                                    data-module="{{ $permission->module_name }}"
                                    data-action="{{ $permission->action_name }}"
                                    data-description="{{ $permission->description }}"
                                    data-active="{{ $permission->is_active }}"
                                >
                                    <i class="ki-filled ki-pencil"></i>
                                </button>

                                <form action="{{ url('/permissions/' . $permission->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button 
                                    id="trash" name="trash"
                                        type="button" 
                                        class="kt-btn kt-btn-icon kt-btn-ghost kt-btn-sm text-destructive hover:bg-destructive/10 trigger-delete-modal" 
                                        data-id="{{ $permission->id }}" 
                                        data-name="{{ $permission->permission_name }}"
                                    >
                                        <i class="ki-filled ki-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-10 text-muted-foreground">
                            No permissions found in the database.
                        </td>
                    </tr>
                    @endforelse
                    </tbody>
                    </table>
                        </div>
                        <div class="kt-card-footer justify-center md:justify-between flex-col md:flex-row gap-5 text-secondary-foreground text-sm font-medium">
                        <div class="flex items-center gap-2 order-2 md:order-1">
                        Show
                        <select class="kt-select w-16" data-kt-datatable-size="true" data-kt-select="" name="perpage">
                        </select>
                        per page
                        </div>
                        <div class="flex items-center gap-4 order-1 md:order-2">
                        <span data-kt-datatable-info="true">
                        </span>
                        <div class="kt-datatable-pagination" data-kt-datatable-pagination="true">
                        </div>
                        </div>
                        </div>
                        </div>
                    </div>
                    </div>
                    </div>
                    </div>
                </div>
                </div>
            </div>
            </main>
    @include('partials.footer')
    </div>
   </div>
  <div class="kt-modal" data-kt-modal="true" id="create_permission_modal">
    <div class="kt-modal-content max-w-[600px] top-[10%]">
        <div class="kt-modal-header py-4 px-5 border-b border-border">
            <h3 class="kt-modal-title font-semibold text-lg text-mono">Add New Permission</h3>
            <button class="kt-btn kt-btn-sm kt-btn-icon kt-btn-ghost shrink-0" data-kt-modal-dismiss="true">
                <i class="ki-filled ki-cross text-xl"></i>
            </button>
        </div>

        <form action="{{ url('/permissions') }}" method="POST">
            @csrf
            
            <div class="kt-modal-body p-7 pb-5">
                <div class="grid gap-5">
                    
                    <div class="grid grid-cols-2 gap-5">
                        <div class="flex flex-col gap-2">
                            <label class="kt-label font-medium text-sm text-foreground">Module Name <span class="text-destructive">*</span></label>
                            <select class="kt-select" name="module_name" id="module_name">
                              <option value="" selected>Select a module</option>
                              <option value="USER">USER</option>
                              <option value="ROLE">ROLE</option>
                              <option value="GROUP">GROUP</option>
                              <option value="COMPANY">COMPANY</option>
                              <option value="BRANCH">BRANCH</option>
                              <option value="UNIT">UNIT</option>
                              <option value="DEPARTMENT">DEPARTMENT</option>
                              <option value="TEAM">TEAM</option>
                              <option value="DESIGNATION">DESIGNATION</option>
                              <option value="EMPLOYEE">EMPLOYEE</option>
                            </select>
                            <!-- <input class="kt-input" name="module_name" id="module_name" placeholder="e.g. Users" required type="text"/> -->
                        </div>

                        <div class="flex flex-col gap-2">
                            <label class="kt-label font-medium text-sm text-foreground">Action Name <span class="text-destructive">*</span></label>
                            <input class="kt-input" name="action_name" id="action_name" placeholder="e.g. Create" required type="text"/>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-5">
                        <div class="flex flex-col gap-2">
                            <label class="kt-label font-medium text-sm text-foreground">Permission Name <span class="text-destructive">*</span></label>
                            <input class="kt-input" name="permission_name" id="permission_name" placeholder="e.g. Create Users" required type="text"/>
                        </div>

                        <div class="flex flex-col gap-2">
                            <label class="kt-label font-medium text-sm text-foreground">Permission Code <span class="text-destructive">*</span></label>
                            <input class="kt-input bg-muted text-muted-foreground cursor-not-allowed focus:border-border" id="permission_code" name="permission_code" placeholder="e.g. USERS_CREATE" required readonly type="text"/>
                            <span class="text-xs text-muted-foreground">Auto generated from Module & Action.</span>
                        </div>
                    </div>

                    <div class="flex flex-col gap-2">
                        <label class="kt-label font-medium text-sm text-foreground">Description</label>
                        <textarea class="kt-textarea" id="description" name="description" placeholder="Describe the purpose of this permission..." rows="3"></textarea>
                    </div>

                    <div class="grid grid-cols-2 gap-5 pt-3">
                        <label class="flex items-center justify-between gap-2 p-3 rounded-lg border border-border">
                            <span class="text-sm font-medium text-foreground">Active Status</span>
                            <input checked class="kt-switch kt-switch-success" name="is_active" type="checkbox" value="1"/>
                        </label>
                    </div>

                </div>
            </div>
            
            <div class="kt-modal-footer p-5 border-t border-border flex justify-end gap-3">
                <button type="button" class="kt-btn kt-btn-light" data-kt-modal-dismiss="true">Cancel</button>
                <button type="submit" class="kt-btn kt-btn-primary">Save Permission</button>
            </div>
        </form>
    </div>
</div>
<div class="kt-modal hidden" data-kt-modal="true" id="delete_confirm_modal">
    <div class="kt-modal-dialog flex items-center justify-center min-h-screen p-4">
        
        <div class="kt-modal-content !max-w-[400px] w-full bg-background border border-border rounded-xl shadow-xl overflow-hidden relative">
            
            <div class="kt-modal-header py-4 px-5 border-b border-border flex justify-between items-center">
                <h3 class="kt-modal-title font-semibold text-lg text-mono">Confirm Soft Deletion</h3>
                <button class="kt-btn kt-btn-sm kt-btn-icon kt-btn-ghost" data-kt-modal-dismiss="true">
                    <i class="ki-filled ki-cross text-xl"></i>
                </button>
            </div>

            <div class="kt-modal-body p-8 text-center">
                <div class="flex justify-center mb-5">
                    <div class="flex items-center justify-center w-14 h-14 rounded-full bg-destructive/10 text-destructive">
                        <i class="ki-filled ki-trash text-2xl"></i>
                    </div>
                </div>
                <p class="text-sm text-foreground mb-1 font-semibold" id="delete_modal_text">
                    Are you sure you want to move this permission to trash?
                </p>
                <p class="text-xs text-muted-foreground">This will move the permission to trash. You can restore it later.</p>
            </div>

            <div class="kt-modal-footer p-5 border-t border-border flex gap-3">
                <button type="button" class="kt-btn kt-btn-light flex-1" data-kt-modal-dismiss="true">Cancel</button>
                <button type="button" id="confirm_delete_btn" class="kt-btn kt-btn-destructive flex-1">Yes, Delete</button>
            </div>
        </div>

    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        
        // ==========================================
        // 1. DYNAMIC CODE & NAME GENERATION
        // ==========================================
        const moduleInput = document.getElementById('module_name');
        const actionInput = document.getElementById('action_name');
        const codeInput = document.getElementById('permission_code');
        const nameInput = document.getElementById('permission_name');

        if (moduleInput && actionInput && codeInput) {
            
            function updatePermissionFields() {
                const mod = moduleInput.value.trim();
                const act = actionInput.value.trim();
                
                // Set the code logic (e.g., USERS_CREATE)
                const parts = [];
                if (mod) parts.push(mod);
                if (act) parts.push(act);
                
                codeInput.value = parts.join('_').toUpperCase().replace(/\s+/g, '_');

                // Optional: Automatically fill the permission name if it's empty
                if(document.activeElement !== nameInput) {
                    nameInput.value = (act + ' ' + mod).trim();
                }
            }

            moduleInput.addEventListener('input', updatePermissionFields);
            actionInput.addEventListener('input', updatePermissionFields);
        }


        // ==========================================
        // 2. EDIT PERMISSION LOGIC
        // ==========================================
        document.querySelectorAll('.edit-permission-btn').forEach(button => {
            button.addEventListener('click', function() {
                const modal = document.querySelector('#create_permission_modal');
                const form = modal.querySelector('form');
                const modalTitle = modal.querySelector('.kt-modal-title');
                
                // 1. Change Modal Title & Action
                modalTitle.innerText = 'Edit Permission';
                form.action = `/permissions/${this.getAttribute('data-id')}`;
                
                // 2. PUT Method spoofing
                if (!form.querySelector('input[name="_method"]')) {
                    const methodInput = document.createElement('input');
                    methodInput.type = 'hidden';
                    methodInput.name = '_method';
                    methodInput.value = 'PUT';
                    form.appendChild(methodInput);
                }

                // 3. Fill text inputs
                document.getElementById('module_name').value = this.getAttribute('data-module') || '';
                document.getElementById('action_name').value = this.getAttribute('data-action') || '';
                document.getElementById('permission_name').value = this.getAttribute('data-name') || '';
                document.getElementById('permission_code').value = this.getAttribute('data-code') || '';
                document.getElementById('description').value = this.getAttribute('data-description') || '';
                
                // 4. Handle Switches
                form.querySelector('input[name="is_active"]').checked = this.getAttribute('data-active') == 1;

                // 5. Open the modal
                const modalInstance = KTModal.getInstance(modal);
                modalInstance.show();
            });
        });

        // ==========================================
        // 3. NATIVE DELETE CONFIRMATION LOGIC
        // ==========================================
        let permissionIdToDelete = null;

        document.addEventListener('click', function(e) {
            const button = e.target.closest('.trigger-delete-modal');
            
            if (button) {
                permissionIdToDelete = button.getAttribute('data-id');
                const permissionName = button.getAttribute('data-name');

                document.getElementById('delete_modal_text').innerText =
                    `Are you sure you want to delete "${permissionName}"?`;

                const modal = KTModal.getOrCreateInstance(document.getElementById('delete_confirm_modal'));
                modal.show();
            }
        });

        // Handle the "Yes, Delete" click
        document.getElementById('confirm_delete_btn').addEventListener('click', function() {
            if (permissionIdToDelete) {
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = `/permissions/${permissionIdToDelete}`;

                const csrfToken = document.createElement('input');
                csrfToken.type = 'hidden';
                csrfToken.name = '_token';
                csrfToken.value = '{{ csrf_token() }}';
                
                const methodInput = document.createElement('input');
                methodInput.type = 'hidden';
                methodInput.name = '_method';
                methodInput.value = 'DELETE';

                form.appendChild(csrfToken);
                form.appendChild(methodInput);
                document.body.appendChild(form);
                
                form.submit();
            }
        });
    });
</script>

</body>
</html>