
<!DOCTYPE html>
<html class="h-full" data-kt-theme="true" data-kt-theme-mode="light" dir="ltr" lang="en">
 <head>
  <title>
    Revuteck - Defines Everything
  </title>
  
 </head>
 <body class="antialiased flex h-full text-base text-foreground bg-background demo1 kt-sidebar-fixed kt-header-fixed">
  <!-- Theme Mode -->
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
  <!-- End of Theme Mode -->
  <!-- Page -->
     <!-- Main -->
  <div class="flex grow">
    @include('partials.sidebar')
   <!-- Wrapper -->
   <div class="kt-wrapper flex grow flex-col">
    @include('partials.header')
    <!-- End of Header -->
    <!-- Content -->
    <main class="grow pt-3" id="content" role="content">
            <!-- Container -->
            
            <!-- End of Container -->
            <!-- Container -->
                <div class="kt-container-fixed">
                    <div class="flex flex-wrap items-center lg:items-end justify-between gap-5 pb-7.5">
                        <div class="flex flex-col justify-center gap-2">
                            <h1 class="text-xl font-medium leading-none text-mono">
                            Roles
                            </h1>
                        <div class="flex items-center gap-2 text-sm font-normal text-secondary-foreground">
                            Central Hub for Personal Customization
                        </div>
                    </div>
                    <div class="flex items-center gap-2.5">
                        <button class="kt-btn kt-btn-primary" data-kt-modal-toggle="#create_role_modal">
                            <i class="ki-filled ki-plus"></i> Create Role
                        </button>
                    </div>
                </div>
                
                <!-- End of Container -->
                <!-- Container -->
                <div class="kt-container-fixed">
                <div class="grid gap-5 lg:gap-7.5">
                    <div class="lg:col-span-4">
                    <div class="grid">
                    <div class="kt-card kt-card-grid h-full min-w-full">
                    <div class="kt-card-header flex flex-wrap items-center justify-between gap-2 shadow-none">
                        <h3 class="kt-card-title">
                            Roles
                        </h3>
                        <div class="flex items-center gap-2.5">
                            <div class="kt-input max-w-48">
                                <i class="ki-filled ki-magnifier"></i>
                                <input data-kt-datatable-search="#kt_datatable_1" placeholder="Search Role" type="text">
                            </div>

                            <a href="{{ url('/roles/trash') }}" class="kt-btn kt-btn-icon kt-btn-light kt-btn-sm relative" title="Trash Bin">
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
                       
                        <th class="w-[280px]">
                            <span class="kt-table-col">
                                <span class="kt-table-col-label">Role Details</span>
                                <span class="kt-table-col-sort"></span>
                            </span>
                        </th>
                        <th class="w-[150px]">
                            <span class="kt-table-col">
                                <span class="kt-table-col-label">Category / Level</span>
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
                    @forelse($roles as $role)
                    <tr>
                        <td>
                            <div class="flex flex-col gap-2">
                                <a class="leading-none font-medium text-sm text-mono hover:text-primary" href="#">
                                    {{ $role->role_name }}
                                </a>
                                <span class="text-2sm text-secondary-foreground font-normal leading-3">
                                    Code: {{ $role->role_code }}
                                </span>
                            </div>
                        </td>

                        <td>
                            <div class="flex flex-col gap-1">
                                <span class="kt-badge kt-badge-outline kt-badge-primary kt-badge-sm self-start">
                                    {{ $role->role_category ?? 'Uncategorized' }}
                                </span>
                                <span class="text-xs text-muted-foreground">Level: {{ $role->role_level }}</span>
                            </div>
                        </td>
                        <td>
                            <div class="flex flex-col gap-1">
                                
                                <span class="text-xs text-muted-foreground">{{ $role->description }}</span>
                            </div>
                        </td>

                        <td>
                            @if($role->is_active)
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
                                {{ \Carbon\Carbon::parse($role->created_at)->format('d M, Y') }}
                            </span>
                        </td>

                        <td class="text-right">
                            <div class="flex justify-end gap-2">
                                <button 
                                    type="button"
                                    class="kt-btn kt-btn-icon kt-btn-ghost kt-btn-sm text-primary hover:bg-primary/10 edit-role-btn" 
                                    data-id="{{ $role->id }}"
                                    data-name="{{ $role->role_name }}"
                                    data-code="{{ $role->role_code }}"
                                    data-category="{{ $role->role_category }}"
                                    data-level="{{ $role->role_level }}"
                                    data-description="{{ $role->description }}"
                                    data-system="{{ $role->is_system_role }}"
                                    data-active="{{ $role->is_active }}"
                                >
                                    <i class="ki-filled ki-pencil"></i>
                                </button>

                                <form action="{{ url('/roles/' . $role->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button 
                                    id="trash" name="trash"
                                        type="button" 
                                        class="kt-btn kt-btn-icon kt-btn-ghost kt-btn-sm text-destructive hover:bg-destructive/10 trigger-delete-modal" 
                                        data-id="{{ $role->id }}" 
                                        data-name="{{ $role->role_name }}"
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
                            No roles found in the database.
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
                <!-- end: grid -->
                </div>
            </div>
            <!-- End of Container -->
    </main>
    <!-- End of Content -->
    <!-- Footer -->
     @include('partials.footer')
    <!-- End of Footer -->
    </div>
   <!-- End of Wrapper -->
  </div>
  <!-- End of Main -->
  <!-- End of Page -->

  <!-- Add Role -->
   <!-- Update model -->
   <div class="kt-modal" data-kt-modal="true" id="create_role_modal">
    <div class="kt-modal-content max-w-[600px] top-[10%]">
        <div class="kt-modal-header py-4 px-5 border-b border-border">
            <h3 class="kt-modal-title font-semibold text-lg text-mono">Add New Role</h3>
            <button class="kt-btn kt-btn-sm kt-btn-icon kt-btn-ghost shrink-0" data-kt-modal-dismiss="true">
                <i class="ki-filled ki-cross text-xl"></i>
            </button>
        </div>

        <form action="{{ url('/roles') }}" method="POST">
            @csrf
            
            <div class="kt-modal-body p-7 pb-5">
                <div class="grid gap-5">
                    
                    <div class="grid grid-cols-2 gap-5">
                        <div class="flex flex-col gap-2">
                            <label class="kt-label font-medium text-sm text-foreground">Role First Name <span class="text-destructive">*</span></label>
                            <input class="kt-input" name="role_first_name" id="role_first_name" placeholder="e.g. Super" required type="text"/>
                        </div>

                        <div class="flex flex-col gap-2">
                            <label class="kt-label font-medium text-sm text-foreground">Role Last Name <span class="text-destructive">*</span></label>
                            <input class="kt-input" name="role_last_name" id="role_last_name" placeholder="e.g. Admin" required type="text"/>
                        </div>
                    </div>

                   <div class="flex flex-col gap-2">
                    <label class="kt-label font-medium text-sm text-foreground">Role Code <span class="text-destructive">*</span></label>
                    <input class="kt-input bg-muted text-muted-foreground cursor-not-allowed focus:border-border" id="role_code" name="role_code" placeholder="e.g. SUPER_ADMIN" required readonly type="text"/>
                    <span class="text-xs text-muted-foreground">Auto generates based on Role name.</span>
                    </div>

                    <div class="grid grid-cols-2 gap-5">
                        <div class="flex flex-col gap-2">
                            <label class="kt-label font-medium text-sm text-foreground">Category</label>
                            <select class="kt-select" name="role_category" id="role_category" data-kt-select="true">
                                
                                <option value="PLATFORM">PLATFORM</option>
                                <option value="GROUP">GROUP</option>
                                <option value="COMPANY">COMPANY</option>
                                <option value="BRANCH">BRANCH</option>
                                <option value="UNIT">UNIT</option>
                                <option value="FUNCTIONAL">FUNCTIONAL</option>
                                <option value="EMPLOYEE">EMPLOYEE</option>
                            </select>   
                        </div>
                        <div class="flex flex-col gap-2">
                            <label class="kt-label font-medium text-sm text-foreground">Level <span class="text-destructive">*</span></label>
                            <select class="kt-select" name="role_level" id="role_level" required>
                            </select>
                        </div>
                    </div>

                    <div class="flex flex-col gap-2">
                        <label class="kt-label font-medium text-sm text-foreground">Description</label>
                        <textarea class="kt-textarea" id="description" name="description" placeholder="Describe the permissions and purpose of this role..." rows="3"></textarea>
                    </div>

                    <div class="grid grid-cols-2 gap-5 pt-3">
                        <label class="flex items-center justify-between gap-2 p-3 rounded-lg border border-border">
                            <span class="text-sm font-medium text-foreground">System Role</span>
                            <input class="kt-switch" name="is_system_role" type="checkbox" value="1"/>
                        </label>
                        
                        <label class="flex items-center justify-between gap-2 p-3 rounded-lg border border-border">
                            <span class="text-sm font-medium text-foreground">Active Status</span>
                            <input checked class="kt-switch kt-switch-success" name="is_active" type="checkbox" value="1"/>
                        </label>
                    </div>

                </div>
            </div>
            
            <div class="kt-modal-footer p-5 border-t border-border flex justify-end gap-3">
                <button type="button" class="kt-btn kt-btn-light" data-kt-modal-dismiss="true">Cancel</button>
                <button type="submit" class="kt-btn kt-btn-primary">Save Role</button>
            </div>
        </form>
    </div>
</div>
<!-- End of Add Roel -->
<!-- End of Update model -->
<!-- Delete confirmation Model -->
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
                    Are you sure you want to move this role to trash?
                </p>
                <p class="text-xs text-muted-foreground">This will move the role to trash. You can restore it later..</p>
            </div>

            <div class="kt-modal-footer p-5 border-t border-border flex gap-3">
                <button type="button" class="kt-btn kt-btn-light flex-1" data-kt-modal-dismiss="true">Cancel</button>
                <button type="button" id="confirm_delete_btn" class="kt-btn kt-btn-destructive flex-1">Yes, Delete</button>
            </div>
        </div>

    </div>
</div>
<!-- End of Delete confirmation Model -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        
        // 1. Grab all THREE input fields using unique variable names
        const firstNameInput = document.getElementById('role_first_name');
        const lastNameInput = document.getElementById('role_last_name');
        const codeInput = document.getElementById('role_code');

        // Check if all fields exist on the page to prevent errors
        if (firstNameInput && lastNameInput && codeInput) {
            
            // 2. Create a reusable function that handles the formatting
            function updateRoleCode() {
                // Get whatever text is currently in both fields
                const first = firstNameInput.value.trim();
                const last = lastNameInput.value.trim();
                
                // Put them in an array, but only if they aren't empty
                const parts = [];
                if (first) parts.push(first);
                if (last) parts.push(last);
                
                // 3. Join them with an underscore, make it UPPERCASE, and replace any internal spaces with _
                codeInput.value = parts.join('_').toUpperCase().replace(/\s+/g, '_');
            }

            // 4. Attach the function to listen for typing in BOTH fields
            firstNameInput.addEventListener('input', updateRoleCode);
            lastNameInput.addEventListener('input', updateRoleCode);
        }




        // ==========================================
        // 2. DYNAMIC LEVEL DROPDOWN LOGIC
        // ==========================================
        const categorySelect = document.getElementById('role_category');
        const levelSelect = document.getElementById('role_level');

        if (categorySelect && levelSelect) {
            // Grab the roles data already passed from Laravel
            const rawRoles = @json($allRoles);
            
            // Create an array to easily check which specific levels are already taken
            const usedLevels = rawRoles.map(role => role.role_level);

            function updateLevelDropdown() {
                const selectedCatValue = categorySelect.value;
                
                // Clear the dropdown completely first
                levelSelect.innerHTML = '';

                // 1. Check if the selected value is the default/empty placeholder
                if (selectedCatValue === 'Select' || selectedCatValue === '') {
                    const option = document.createElement('option');
                    option.text = 'Please select a category first';
                    option.value = '';
                    option.disabled = true;
                    option.selected = true;
                    levelSelect.appendChild(option);
                    return; // Stop the function here! Don't do any math.
                }
                
                // 2. If a real category IS selected, proceed with the math
                let selectedHigh = 0;
                let nextLow = null;

                // Loop through the roles (Assuming they are sorted by Level ASC in the DB)
                for (const role of rawRoles) {
                    if (role.role_category === selectedCatValue) {
                        selectedHigh = role.role_level;
                    } 
                    else if (role.role_category !== selectedCatValue && selectedHigh > 0 && role.role_level > selectedHigh) {
                        nextLow = role.role_level;
                        break; 
                    }
                }

                if (nextLow === null) {
                    nextLow = selectedHigh + 10; 
                }

                let startLevel = selectedHigh > 0 ? selectedHigh : 1;

                for (let i = startLevel; i < nextLow; i++) {
                    const option = document.createElement('option');
                    option.value = i;
                    
                    if (usedLevels.includes(i)) {
                        option.text = `Level ${i} (In Use)`;
                        option.disabled = true; 
                    } else {
                        option.text = `Level ${i} (Available)`;
                        if (!levelSelect.value || levelSelect.options[levelSelect.selectedIndex].disabled) {
                            option.selected = true;
                        }
                    }
                    
                    levelSelect.appendChild(option);
                }
            }

            // Run on load to set initial state
            updateLevelDropdown();

            // Run every time the user changes the category
            categorySelect.addEventListener('change', updateLevelDropdown);
        }



        // ==========================================
        // 3. EDIT ROLE LOGIC
        // ==========================================
        document.querySelectorAll('.edit-role-btn').forEach(button => {
            button.addEventListener('click', function() {
                const modal = document.querySelector('#create_role_modal');
                const form = modal.querySelector('form');
                const modalTitle = modal.querySelector('.kt-modal-title');
                
                // 1. Change Modal Title & Action
                modalTitle.innerText = 'Edit Role';
                form.action = `/roles/${this.getAttribute('data-id')}`;
                
                // 2. PUT Method spoofing
                if (!form.querySelector('input[name="_method"]')) {
                    const methodInput = document.createElement('input');
                    methodInput.type = 'hidden';
                    methodInput.name = '_method';
                    methodInput.value = 'PUT';
                    form.appendChild(methodInput);
                }

                // 3. Fill text inputs
                const fullName = this.getAttribute('data-name').split(' ');
                document.getElementById('role_first_name').value = fullName[0] || '';
                document.getElementById('role_last_name').value = fullName.slice(1).join(' ') || '';
                document.getElementById('role_code').value = this.getAttribute('data-code');
                document.getElementById('description').value = this.getAttribute('data-description') || '';
                
                // 4. Fill Category & TRIGGER Metronic Refresh
                const categoryVal = this.getAttribute('data-category');
                const categoryInput = document.getElementById('role_category');
                
                // Update the value
                categoryInput.value = categoryVal;
                
                // TRIGGER METRONIC REFRESH
                // We trigger 'change' so your updateLevelDropdown() runs
                categoryInput.dispatchEvent(new Event('change'));
                
                // Special Metronic 9 Select Refresh (This updates the visible UI)
                if (window.KTSelect) {
                    const selectInstance = KTSelect.getInstance(categoryInput);
                    if (selectInstance) selectInstance.update();
                }

                // 5. Fill Level after the dropdown calculates the gaps
                const targetLevel = this.getAttribute('data-level');
                setTimeout(() => {
                    const levelInput = document.getElementById('role_level');
                    levelInput.value = targetLevel;
                    
                    // Refresh the level dropdown UI as well
                    levelInput.dispatchEvent(new Event('change'));
                    if (window.KTSelect) {
                        const levelInstance = KTSelect.getInstance(levelInput);
                        if (levelInstance) levelInstance.update();
                    }
                }, 150); // Increased delay slightly to ensure gap calculation finishes

                // 6. Handle Switches
                form.querySelector('input[name="is_system_role"]').checked = this.getAttribute('data-system') == 1;
                form.querySelector('input[name="is_active"]').checked = this.getAttribute('data-active') == 1;

                // 7. Open the modal
                const modalInstance = KTModal.getInstance(modal);
                modalInstance.show();
            });
        });
        // ==========================================
        // 4. NATIVE DELETE CONFIRMATION LOGIC
        // ==========================================
        let roleIdToDelete = null;

        document.addEventListener('click', function(e) {
        const button = e.target.closest('.trigger-delete-modal');
        
        if (button) {
            roleIdToDelete = button.getAttribute('data-id');
            const roleName = button.getAttribute('data-name');

            document.getElementById('delete_modal_text').innerText =
                `Are you sure you want to delete "${roleName}"?`;

            const modal = KTModal.getOrCreateInstance(document.getElementById('delete_confirm_modal'));
            modal.show();
        }
    });

        // Handle the "Yes, Delete" click
        document.getElementById('confirm_delete_btn').addEventListener('click', function() {
            if (roleIdToDelete) {
                // Create a dynamic form to submit the DELETE request
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = `/roles/${roleIdToDelete}`;

                // Add CSRF Token
                const csrfToken = document.createElement('input');
                csrfToken.type = 'hidden';
                csrfToken.name = '_token';
                csrfToken.value = '{{ csrf_token() }}';
                
                // Add Method Spoofing
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


    // level Drop down logic


    // End level Drop down logic
</script>
<!-- End of Add Role -->


</body>
</html>
