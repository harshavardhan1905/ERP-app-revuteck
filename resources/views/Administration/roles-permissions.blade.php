<!DOCTYPE html>
<html class="h-full" data-kt-theme="true" data-kt-theme-mode="light" dir="ltr" lang="en">
 <head>
  @include('partials.header')
  
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
 
    <main class="grow pt-3" id="content" role="content">
            <div class="kt-container-fixed">
                    <div class="flex flex-wrap items-center lg:items-end justify-between gap-5 pb-7.5">
                        <div class="flex flex-col justify-center gap-2">
                            <h1 class="text-xl font-medium leading-none text-mono">
                            Roles Permissions
                            </h1>
                        <div class="flex items-center gap-2 text-sm font-normal text-secondary-foreground">
                            Assign permissions to the roles
                        </div>
                    </div>
                    <!-- <div class="flex items-center gap-2.5">
                        <button class="kt-btn kt-btn-primary" data-kt-modal-toggle="#assign_permission_modal">
                            <i class="ki-filled ki-plus"></i> Assign Permissions
                        </button>
                    </div> -->
                </div>
                
                <div class="kt-container-fixed">
                <div class="grid gap-5 lg:gap-7.5">
                    <div class="lg:col-span-4">
                    <div class="grid">
                    <div class="kt-card kt-card-grid h-full min-w-full">
                    <div class="kt-card-header flex flex-wrap items-center justify-between gap-2 shadow-none">
                        <h3 class="kt-card-title">
                            Roles & Permissions
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
                       
                        <th class="w-[150px]">
                            <span class="kt-table-col">
                                <span class="kt-table-col-label">Role</span>
                                <span class="kt-table-col-sort"></span>
                            </span>
                        </th>
                        <th class="w-[50px]">
                            <span class="kt-table-col">
                                <span class="kt-table-col-label">Level</span>
                                <span class="kt-table-col-sort"></span>
                            </span>
                        </th>
                        <th class="w-[100px]">
                            <span class="kt-table-col">
                                <span class="kt-table-col-label">Module</span>
                                <span class="kt-table-col-sort"></span>
                            </span>
                        </th>
                        <th class="w-[100px]">
                            <span class="kt-table-col">
                                <span class="kt-table-col-label">Role Action</span>
                                <span class="kt-table-col-sort"></span>
                            </span>
                        </th>
                        <th class="w-[100px]">
                            <span class="kt-table-col">
                                <span class="kt-table-col-label">Permission</span>
                                <span class="kt-table-col-sort"></span>
                            </span>
                        </th>
                        <th class="w-[50px] text-right">
                            <span class="kt-table-col justify-end">
                                <span class="kt-table-col-label">Actions</span>
                            </span>
                        </th>
                    </tr>
                </thead>
                <tbody>
                        @forelse($data as $row)
                            <tr>

                                <!-- ROLE -->
                                <td>
                                    <div class="flex flex-col gap-1">
                                        <span class="font-medium text-sm text-mono">
                                            {{ $row->role_name }}
                                        </span>
                                        <span class="text-xs text-muted-foreground">
                                            Code: {{ $row->role_code }}
                                        </span>
                                    </div>
                                </td>

                                <!-- LEVEL -->
                                <td>
                                    <span class="kt-badge kt-badge-outline kt-badge-primary">
                                        {{ $row->role_level }}
                                    </span>
                                </td>

                                <!-- MODULE -->
                                <td>
                                    <span class="kt-badge kt-badge-outline kt-badge-success">
                                        {{ strtoupper($row->module_name) }}
                                    </span>
                                </td>

                                <!-- ACTION -->
                                <td>
                                    <span class="text-sm text-muted-foreground">
                                        {{ strtoupper($row->action_name) }}
                                    </span>
                                </td>

                                <!-- PERMISSION -->
                                <td>
                                    <span class="text-sm">
                                        {{ $row->permission_name }}
                                    </span>
                                </td>

                                <!-- ACTION BUTTON -->
                                <td class="text-right">
                                    <a href="{{ route('Administration.assign-permissions', $row->role_id) }}"
                                        class="kt-btn kt-btn-primary kt-btn-sm">
                                        Assign
                                    </a>
                                </td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-10 text-muted-foreground">
                                    No role permissions found
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
        // 2. EDIT PERMISSION LOGIC
        // ==========================================
        document.addEventListener('click', function(e) {

        const button = e.target.closest('.open-assign-modal');

        if (button) {

            const roleName = button.getAttribute('data-role-name');
            const moduleName = button.getAttribute('data-module-name');
            const roleId = button.getAttribute('data-role-id');

            console.log(roleName, moduleName, roleId); // 🔥 DEBUG

            // Set values
            document.getElementById('modal_role_name').value = roleName || '';
            document.getElementById('modal_module_name').value = moduleName || '';
            document.getElementById('modal_role_id').value = roleId || '';

            // Open modal AFTER setting values
            const modal = document.getElementById('assign_permission_modal');
            const modalInstance = KTModal.getOrCreateInstance(modal);
            modalInstance.show();
        }

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