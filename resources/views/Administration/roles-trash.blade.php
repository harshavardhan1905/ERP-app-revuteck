
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
   const defaultThemeMode = 'dark'; // light|dark|system
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
                            Trashed Roles
                            </h1>
                        <div class="flex items-center gap-2 text-sm font-normal text-secondary-foreground">
                            Roles Trash bin Restore or Delete permanently
                        </div>
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
                       <a href="/roles" class="kt-btn kt-btn-light kt-btn-sm flex items-center gap-2">
                            <i class="ki-filled ki-left"></i>
                            Back to Roles
                        </a>
                       
                        <div class="flex items-center gap-2.5">
                            <div class="kt-input max-w-48">
                                <i class="ki-filled ki-magnifier"></i>
                                <input data-kt-datatable-search="#kt_datatable_1" placeholder="Search Role" type="text">
                            </div>
                        </div>
                    </div>
                    <div class="kt-card-table">
                        <div class="grid"  data-kt-datatable-page-size="5" id="teams_datatable">
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
                                <span class="kt-table-col-label">Deleted At</span>
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
                    @forelse($trashedRoles as $role)
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
                                {{ \Carbon\Carbon::parse($role->deleted_at)->format('d M, Y') }}
                            </span>
                        </td>

                        <td class="text-right">
                            <div class="flex justify-end gap-2">

                                <!-- ♻ Restore -->
                                <form action="/roles/{{ $role->id }}/restore" method="POST">
                                    @csrf
                                    <button class="kt-btn kt-btn-icon kt-btn-ghost kt-btn-sm text-success hover:bg-success/10">
                                        <i class="ki-filled ki-arrows-loop"></i>
                                    </button>
                                </form>

                                <!-- ❌ Permanent Delete -->
                               <button 
                                    type="button"
                                    class="kt-btn kt-btn-icon kt-btn-ghost kt-btn-sm text-destructive hover:bg-destructive/10 trigger-delete-modal"
                                    data-id="{{ $role->id }}"
                                    data-name="{{ $role->role_name }}"
                                >
                                    <i class="ki-filled ki-trash"></i>
                                </button>

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
  
   <!-- End of Wrapper -->
  </div>
  <!-- End of Main -->
  <!-- End of Page -->

  
<!-- Delete confirmation Model -->
<div class="kt-modal hidden" data-kt-modal="true" id="delete_confirm_modal">
    <div class="kt-modal-dialog flex items-center justify-center min-h-screen p-4">
        
        <div class="kt-modal-content !max-w-[400px] w-full bg-background border border-border rounded-xl shadow-xl overflow-hidden relative">
            
            <div class="kt-modal-header py-4 px-5 border-b border-border flex justify-between items-center">
                <h3 class="kt-modal-title font-semibold text-lg text-mono">Confirm Permanent Deletion</h3>
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
                    This action is permanent and cannot be undone.
                </p>
                <p class="text-xs text-muted-foreground">This will remove the record from the database</p>
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
        let roleIdToDelete = null;

        document.querySelectorAll('.trigger-delete-modal').forEach(button => {
            button.addEventListener('click', function() {
                roleIdToDelete = this.getAttribute('data-id');
                const roleName = this.getAttribute('data-name');

                document.getElementById('delete_modal_text').innerText =
                    `Are you sure you want to permanently delete "${roleName}"?`;

                const modal = KTModal.getOrCreateInstance(document.getElementById('delete_confirm_modal'));
                modal.show();
            });
        });

        document.getElementById('confirm_delete_btn').addEventListener('click', function() {
            if (roleIdToDelete) {
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = `/roles/${roleIdToDelete}/force-delete`;

                form.innerHTML = `
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="_method" value="DELETE">
                `;

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
