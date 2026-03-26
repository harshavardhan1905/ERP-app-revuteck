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
                themeMode = window.matchMedia('(prefers-color-scheme: dark)').matches ?
                    'dark' :
                    'light';
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
                                                <input data-kt-datatable-search="#kt_datatable_1" id="searchInput"  placeholder="Search Permission" type="text">
                                            </div>

                                            <a href="#" class="kt-btn kt-btn-icon kt-btn-light kt-btn-sm relative" title="Trash Bin">
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

                                                            <th class="w-[80px]">
                                                                <span class="kt-table-col">
                                                                    <span class="kt-table-col-label">Role</span>
                                                                    <span class="kt-table-col-sort"></span>
                                                                </span>
                                                            </th>
                                                            <th class="w-[20px]">
                                                                <span class="kt-table-col">
                                                                    <span class="kt-table-col-label">Level</span>
                                                                    <span class="kt-table-col-sort"></span>
                                                                </span>
                                                            </th>
                                                            <th class="w-[60px]">
                                                                <span class="kt-table-col">
                                                                    <span class="kt-table-col-label">Module</span>
                                                                    <span class="kt-table-col-sort"></span>
                                                                </span>
                                                            </th>
                                                            <th class="w-[150px]">
                                                                <span class="kt-table-col">
                                                                    <span class="kt-table-col-label">Role Action</span>
                                                                    <span class="kt-table-col-sort"></span>
                                                                </span>
                                                            </th>
                                                            <th class="w-[60px]">
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
                                                        <tr class="align-top">

                                                            <!-- ROLE -->
                                                            <td class="py-4">
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

                                                            <td class="py-4">
                                                                @if(count($row->modules) > 0)
                                                                <div class="flex items-center gap-1">
                                                                    <span class="kt-badge kt-badge-outline kt-badge-success">
                                                                        {{ strtoupper($row->modules[0]) }}
                                                                    </span>

                                                                    @if(count($row->modules) > 1)
                                                                    <button type="button"
                                                                        class="text-success cursor-pointer hover:text-success-active hover:underline text-xs font-bold mt-1 trigger-view-modules max-w-[80px] truncate whitespace-nowrap"
                                                                        data-role-name="{{ $row->role_name }}"
                                                                        data-modules="{{ json_encode($row->modules) }}">
                                                                        + {{ count($row->modules) - 1 }} more
                                                                    </button>
                                                                    @endif
                                                                </div>
                                                                @else
                                                                <span class="text-xs text-muted-foreground">None</span>
                                                                @endif
                                                            </td>

                                                            <!-- ACTION -->
                                                            <td class="py-4">

                                                                <div class="max-h-[52px] overflow-y-auto pr-2 flex flex-wrap gap-1 items-start content-start
                                                                        [&::-webkit-scrollbar]:w-1.5 
                                                                        [&::-webkit-scrollbar-track]:bg-transparent 
                                                                        [&::-webkit-scrollbar-thumb]:rounded-full 
                                                                        [&::-webkit-scrollbar-thumb]:bg-gray-300 
                                                                        hover:[&::-webkit-scrollbar-thumb]:bg-gray-400">

                                                                    @forelse($row->actions as $action_name => $modules_list)
                                                                    <button type="button"
                                                                        class="kt-badge kt-badge-light kt-badge-sm shrink-0 whitespace-nowrap cursor-pointer hover:border-primary transition-colors trigger-view-role-action"
                                                                        data-title="Action: {{ strtoupper($action_name) }}"
                                                                        data-type="action_modules"
                                                                        data-list="{{ json_encode($modules_list) }}"
                                                                        title="View modules for {{ $action_name }}">
                                                                        {{ strtoupper($action_name) }}
                                                                        <span class="text-primary ml-1">+{{ count($modules_list) }}</span>
                                                                    </button>
                                                                    @empty
                                                                    <span class="text-xs text-muted-foreground">None</span>
                                                                    @endforelse

                                                                </div>

                                                            </td>

                                                            <!-- PERMISSION -->
                                                            <td class="py-4">
                                                                @if(count($row->permissions) > 0)
                                                                <div class="text-sm flex flex-col gap-1">

                                                                    {{-- Show only the first 2 permissions --}}
                                                                    @foreach(collect($row->permissions)->take(2) as $perm_name)
                                                                    <div class="text-muted-foreground truncate" title="{{ $perm_name }}">
                                                                        • {{ $perm_name }}
                                                                    </div>
                                                                    @endforeach

                                                                    {{-- If there are more than 2, show the Read More button --}}
                                                                    @if(count($row->permissions) > 2)
                                                                    <button type="button"
                                                                        class="text-primary cursor-pointer hover:text-primary-active text-xs font-medium text-left mt-1 trigger-view-permissions"
                                                                        data-role-name="{{ $row->role_name }}"
                                                                        data-permissions="{{ json_encode($row->permissions) }}">
                                                                        + {{ count($row->permissions) - 2 }} more... (View All)
                                                                    </button>
                                                                    @endif

                                                                </div>
                                                                @else
                                                                <span class="text-xs text-muted-foreground">No permissions</span>
                                                                @endif
                                                            </td>

                                                            <!-- ACTION BUTTON -->
                                                            <!-- <td>
                                                              <p>{{ $row->permissions }}</p>
                                                            </td> -->
                                                            <td class="text-right py-4">

                                                                <button type="button" class="kt-btn kt-btn-primary kt-btn-sm open-assign-modal"
                                                                    data-role-id="{{ $row->role_id }}"
                                                                    data-role-level="{{$row->role_level}}"
                                                                    data-role-name="{{ $row->role_name }}"
                                                                    data-role-category="{{ $row->modules[0] ?? '' }}"
                                                                    data-existing="{{ json_encode($row->permissions) }}">
                                                                    <i class="ki-filled ki-plus"></i> Assign
                                                                </button>
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

   

        <!-- modal view for all permissions -->
        <div class="kt-modal hidden" data-kt-modal="true" id="view_permissions_modal">
            <div class="kt-modal-dialog flex items-center justify-center min-h-screen p-4">
                <div class="kt-modal-content !max-w-[500px] w-full bg-background border border-border rounded-xl shadow-xl overflow-hidden relative">

                    <div class="kt-modal-header py-4 px-5 border-b border-border flex justify-between items-center">
                        <h3 class="kt-modal-title font-semibold text-lg text-mono" id="view_permissions_title">
                            All Permissions
                        </h3>
                        <button class="kt-btn kt-btn-sm kt-btn-icon kt-btn-ghost" data-kt-modal-dismiss="true">
                            <i class="ki-filled ki-cross text-xl"></i>
                        </button>
                    </div>

                    <div class="kt-modal-body p-6 max-h-[60vh] overflow-y-auto 
                        [&::-webkit-scrollbar]:w-1.5 [&::-webkit-scrollbar-track]:bg-transparent 
                        [&::-webkit-scrollbar-thumb]:rounded-full [&::-webkit-scrollbar-thumb]:bg-gray-300">

                        <div id="permissions_list_container" class="flex flex-wrap gap-2 items-start content-start">
                        </div>

                    </div>

                    <div class="kt-modal-footer p-5 border-t border-border flex justify-end">
                        <button type="button" class="kt-btn kt-btn-light" data-kt-modal-dismiss="true">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- End of modal view for all permissions -->

        <!-- Assign permissions -->
        <div class="kt-modal hidden" data-kt-modal="true" id="assign_permission_modal">
            <div class="kt-modal-dialog flex items-center justify-center min-h-screen p-4">
                <div class="kt-modal-content !max-w-[550px] w-full bg-background border border-border rounded-xl shadow-xl overflow-hidden relative">

                    <div class="kt-modal-header py-4 px-5 border-b border-border flex justify-between items-center">
                        <h3 class="kt-modal-title font-semibold text-lg text-mono">
                            Assign to: <span id="modal_role_name_display" class="text-primary"></span>
                        </h3>
                        <button class="kt-btn kt-btn-sm kt-btn-icon kt-btn-ghost" data-kt-modal-dismiss="true">
                            <i class="ki-filled ki-cross text-xl"></i>
                        </button>
                    </div>

                    <form id="assign_permission_form" method="POST" action="{{ url('/roles-permissions/assign') }}">
                        @csrf
                        <input type="hidden" name="role_id" id="modal_role_id" value="">

                        <div class="kt-modal-body p-6">
                            <div class="mb-6">
                                <label class="text-sm font-medium mb-3 block">Currently Assigned Permissions:</label>
                                <div id="current_permissions_container" class="flex flex-wrap gap-2 max-h-32 overflow-y-auto p-3 border border-border rounded-lg bg-secondary/20">
                                </div>
                            </div>

                            <hr class="border-border mb-6">

                            <div class="mb-5">
                                <label class="text-sm font-medium mb-2 block">1. Select Category (Module):</label>
                                <select id="dynamic_module_select" class="kt-select w-full" required>
                                    <option value="" disabled selected>-- Choose Category --</option>
                                    @foreach($permissions as $module_name => $perms)
                                    <option value="{{ $module_name }}" data-perms='@json($perms)'>
                                        {{ strtoupper($module_name) }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>

                            <div id="action_select_container" class="hidden">
                                <label class="text-sm font-medium mb-2 block">2. Select Action(s):</label>
                                <div class="border border-border rounded-lg p-4 bg-secondary/10">
                                    <div class="flex items-center gap-2 mb-3 pb-3 border-b border-border">
                                        <input type="checkbox" id="select_all_actions" class="kt-checkbox kt-checkbox-sm kt-checkbox-primary cursor-pointer">
                                        <label for="select_all_actions" class="font-semibold text-sm cursor-pointer select-none">Select All</label>
                                    </div>

                                    <div id="dynamic_action_checkboxes" class="flex flex-col gap-3 max-h-40 overflow-y-auto pr-2">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="kt-modal-footer p-5 border-t border-border flex justify-end gap-3 bg-secondary/10">
                            <button type="button" class="kt-btn kt-btn-light" data-kt-modal-dismiss="true">Cancel</button>
                            <button type="submit" class="kt-btn kt-btn-primary">Confirm & Assign</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- End of Assign permissions -->
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
             <!-- Store grouped permissions in a data attribute -->
        <script type="application/json" id="grouped-permissions-data">
            @json($permissions)
        </script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // ==========================================
                // UNIFIED DYNAMIC MODAL LOGIC 
                // ==========================================
                document.addEventListener('click', function(e) {
                    // Check if the clicked element has the trigger class
                    const btn = e.target.closest('.trigger-view-role-action');

                    if (btn) {
                        e.preventDefault();

                        // 1. Extract data from the clicked button
                        const title = btn.getAttribute('data-title');
                        const type = btn.getAttribute('data-type');
                        const listData = JSON.parse(btn.getAttribute('data-list'));

                        // 2. Target the modal elements
                        document.getElementById('view_permissions_title').innerText = title;
                        const container = document.getElementById('permissions_list_container');

                        // Clear old data from previous clicks
                        container.innerHTML = '';

                        // 3. Format the layout based on WHAT was clicked
                        if (type === 'modules' || type === 'action_modules') {
                            // Show as horizontal badges (For Modules OR clicking an Action to see Modules)
                            container.className = 'flex flex-wrap gap-2 items-start';
                            listData.forEach(item => {
                                container.innerHTML += `
                    <span class="kt-badge kt-badge-outline kt-badge-primary kt-badge-lg px-3 py-2 text-sm">
                        ${item.toUpperCase()}
                    </span>`;
                            });

                        } else if (type === 'actions') {
                            // Show as a list with counts (For the "VIEW ALL" Action Summary)
                            container.className = 'flex flex-col gap-2';
                            for (const [actionName, count] of Object.entries(listData)) {
                                container.innerHTML += `
                    <div class="p-3 rounded-lg bg-secondary/20 border border-border text-sm flex justify-between items-center w-full">
                        <span class="font-medium text-foreground">${actionName.toUpperCase()}</span>
                        <span class="kt-badge kt-badge-light kt-badge-sm text-primary font-bold">+${count}</span>
                    </div>`;
                            }

                        } else if (type === 'permissions') {
                            // Show as a list with checkmarks (For Permissions)
                            container.className = 'flex flex-col gap-2';
                            listData.forEach(perm => {
                                container.innerHTML += `
                    <div class="p-3 rounded-lg bg-secondary/20 border border-border text-sm flex items-center gap-3 w-full">
                        <i class="ki-filled ki-check-circle text-success text-base"></i> 
                        <span class="text-foreground font-medium">${perm}</span>
                    </div>`;
                            });
                        }

                        // 4. Show the modal using Metronic's built-in KTModal class
                        // Make sure your modal HTML has id="view_dynamic_modal"
                        const modalElement = document.getElementById('view_permissions_modal');
                        const modalInstance = KTModal.getOrCreateInstance(modalElement);
                        modalInstance.show();
                    }


                });
                // ==========================================
                // VIEW MODULES MODAL LOGIC
                // ==========================================
                document.addEventListener('click', function(e) {
                    const btn = e.target.closest('.trigger-view-modules');

                    if (btn) {
                        e.preventDefault();

                        // 1. Get data from the button attributes
                        const roleName = btn.getAttribute('data-role-name');
                        const modulesArray = JSON.parse(btn.getAttribute('data-modules'));

                        // 2. Update Modal Title
                        document.getElementById('view_permissions_title').innerText = `Modules: ${roleName}`;

                        // 3. Get container, clear it, and change layout to 'flex-wrap' for badges
                        const container = document.getElementById('permissions_list_container');
                        container.innerHTML = '';
                        container.className = 'flex flex-wrap gap-2 items-start content-start';

                        // 4. Generate the badges
                        modulesArray.forEach(mod => {
                            const badge = document.createElement('span');
                            badge.className = 'kt-badge kt-badge-outline kt-badge-success kt-badge-lg';
                            badge.innerText = mod.toUpperCase();
                            container.appendChild(badge);
                        });

                        // 5. Show the modal
                        const modal = KTModal.getOrCreateInstance(document.getElementById('view_permissions_modal'));
                        modal.show();
                    }
                });
                // ==========================================
                // 1. VIEW ALL PERMISSIONS LOGIC (Read More)
                // ==========================================
                document.addEventListener('click', function(e) {
                    // Check if the clicked element (or its parent) has the 'trigger-view-permissions' class
                    const btn = e.target.closest('.trigger-view-permissions');

                    if (btn) {
                        // Prevent default button behavior
                        e.preventDefault();

                        // Get data from the button attributes
                        const roleName = btn.getAttribute('data-role-name');
                        const permissionsArray = JSON.parse(btn.getAttribute('data-permissions'));

                        // Update Modal Title
                        document.getElementById('view_permissions_title').innerText = `Permissions: ${roleName}`;

                        // Get container and clear old data
                        const container = document.getElementById('permissions_list_container');
                        container.innerHTML = '';

                        // Generate the list of permissions dynamically
                        permissionsArray.forEach(perm => {
                            const div = document.createElement('div');
                            // Styling for each permission row in the popup
                            div.className = 'p-2 rounded-lg bg-secondary/20 border border-border text-sm text-foreground flex items-center gap-2';
                            div.innerHTML = `<i class="ki-filled ki-check-circle text-success text-base"></i> <span>${perm}</span>`;
                            container.appendChild(div);
                        });

                        // Show the modal using Metronic's KTModal instance
                        const modal = KTModal.getOrCreateInstance(document.getElementById('view_permissions_modal'));
                        modal.show();
                    }
                });

                // ==========================================
                // 2. EDIT PERMISSION LOGIC
                // ==========================================
                document.addEventListener('click', function(e) {
                    const button = e.target.closest('.open-assign-modal');


                    if (button) {
                        e.preventDefault();

                        // Get data from button
                        const roleId = button.getAttribute('data-role-id');
                        const roleLevel = button.getAttribute('data-role-level');
                        const roleName = button.getAttribute('data-role-name');
                        const roleCategory = button.getAttribute('data-role-category');
                        const existingPerms = JSON.parse(button.getAttribute('data-existing'));

                        // Set Hidden Input and Title
                        document.getElementById('modal_role_id').value = roleId;
                        document.getElementById('modal_role_name_display').innerText = roleName;

                        // ✅ FILTER MODULE DROPDOWN
                        const moduleSelect = document.getElementById('dynamic_module_select');
                        const options = moduleSelect.querySelectorAll('option');

                        console.log(options);
                        options.forEach(option => {
                            if (!option.value) return;
                            option.style.display = 'block'
                            // 👉 show only matching module
                            // if (roleName.toLowerCase() === 'Super Admin') {
                            //     option.style.display = 'block';
                            // }
                            // if (option.value === roleCategory) {
                            //     option.style.display = 'block';
                            // } else {
                            //     option.style.display = 'none';
                            // }
                        });

                        moduleSelect.value = roleCategory; // auto select

                        // Trigger change manually
                        moduleSelect.dispatchEvent(new Event('change'));

                        // Populate Existing Permissions Box
                        const container = document.getElementById('current_permissions_container');
                        container.innerHTML = ''; // Clear old

                        if (existingPerms.length > 0) {
                            existingPerms.forEach(perm => {
                                container.innerHTML += `<span class="kt-badge kt-badge-outline kt-badge-success kt-badge-sm">${perm}</span>`;
                            });
                        } else {
                            container.innerHTML = '<span class="text-xs text-muted-foreground">This role has no permissions yet.</span>';
                        }

                        // Show Modal
                        const modal = KTModal.getOrCreateInstance(document.getElementById('assign_permission_modal'));
                        modal.show();
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

                // ==========================================
                // 4. DYNAMIC CHECKLIST LOGIC
                // ==========================================

                // Safely pass the grouped PHP array to JavaScript
                const groupedPermissions = JSON.parse(document.getElementById('grouped-permissions-data').textContent);

                const moduleSelect = document.getElementById('dynamic_module_select');
                const actionContainer = document.getElementById('action_select_container');
                const checkboxesContainer = document.getElementById('dynamic_action_checkboxes');
                const selectAllCheckbox = document.getElementById('select_all_actions');

                if (moduleSelect && actionContainer) {

                    // A. When a Module is selected...
                    moduleSelect.addEventListener('change', function() {
                        const selectedModule = this.value;

                        // Reset checklist
                        checkboxesContainer.innerHTML = '';
                        selectAllCheckbox.checked = false;

                        if (selectedModule && groupedPermissions[selectedModule]) {
                            // Populate checkboxes for this module
                            groupedPermissions[selectedModule].forEach(perm => {
                                checkboxesContainer.innerHTML += `
                                    <label class="flex items-center gap-3 cursor-pointer p-1 hover:bg-secondary/50 rounded transition-colors">
                                        <input type="checkbox" name="permission_ids[]" value="${perm.id}" class="kt-checkbox kt-checkbox-sm kt-checkbox-success action-checkbox">
                                        <span class="text-sm font-medium text-foreground select-none">
                                            ${perm.action_name.toUpperCase()} 
                                            <span class="text-xs text-muted-foreground font-normal ml-1">(${perm.permission_name})</span>
                                        </span>
                                    </label>
                                `;
                            });

                            // Show the actions container
                            actionContainer.classList.remove('hidden');
                        } else {
                            actionContainer.classList.add('hidden');
                        }
                    });

                    // B. "Select All" Logic
                    selectAllCheckbox.addEventListener('change', function() {
                        const isChecked = this.checked;
                        const checkboxes = checkboxesContainer.querySelectorAll('.action-checkbox');
                        checkboxes.forEach(cb => cb.checked = isChecked);
                    });

                    // C. Individual Checkbox Logic (Unchecks "Select All" if one is deselected)
                    checkboxesContainer.addEventListener('change', function(e) {
                        if (e.target.classList.contains('action-checkbox')) {
                            const checkboxes = checkboxesContainer.querySelectorAll('.action-checkbox');
                            const allChecked = Array.from(checkboxes).every(cb => cb.checked);
                            selectAllCheckbox.checked = allChecked;
                        }
                    });

                    // D. Reset form entirely when modal opens
                    document.addEventListener('click', function(e) {
                        if (e.target.closest('.open-assign-modal')) {
                            moduleSelect.value = '';
                            checkboxesContainer.innerHTML = '';
                            selectAllCheckbox.checked = false;
                            actionContainer.classList.add('hidden');
                        }
                    });
                }
            });
        </script>

</body>

</html>