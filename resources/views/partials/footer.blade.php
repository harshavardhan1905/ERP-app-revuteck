

   
    <!-- Footer -->
    <footer class="kt-footer">
     <!-- Container -->
     <div class="kt-container-fixed">
      <div class="flex flex-col md:flex-row justify-center md:justify-between items-center gap-3 py-5">
       <div class="flex order-2 md:order-1 gap-2 font-normal text-sm">
        <span class="text-secondary-foreground">
         2026©
        </span>
        <a class="text-secondary-foreground hover:text-primary" href="https://revuteck.com/">
         Revuteck.com
        </a>
       </div>
       <nav class="flex order-1 md:order-2 gap-4 font-normal text-sm text-secondary-foreground">
        <a class="hover:text-primary" href="https://keenthemes.com/metronic/tailwind/docs">
         Docs
        </a>
        <a class="hover:text-primary" href="https://1.envato.market/Vm7VRE">
         Purchase
        </a>
        <a class="hover:text-primary" href="https://keenthemes.com/metronic/tailwind/docs/getting-started/license">
         FAQ
        </a>
        <a class="hover:text-primary" href="https://devs.keenthemes.com">
         Support
        </a>
        <a class="hover:text-primary" href="https://keenthemes.com/metronic/tailwind/docs/getting-started/license">
         License
        </a>
       </nav>
      </div>
     </div>
     <!-- End of Container -->
    </footer>
    <!-- End of Footer -->
  
  <!-- End of Main -->
  
  <!-- End of Page -->
  <!-- Scripts -->
<script src="{{ asset('assets/js/core.bundle.js') }}"></script>

<script src="{{ asset('assets/vendors/ktui/ktui.min.js') }}"></script>
<script src="{{ asset('assets/vendors/apexcharts/apexcharts.min.js') }}"></script>
<script src="{{ asset('assets/js/widgets/general.js') }}"></script>
<script src="{{ asset('assets/js/layouts/demo1.js') }}"></script>
  <!-- End of Scripts -->
   @if(session('success') || $errors->any())
<script>
    document.addEventListener('DOMContentLoaded', function() {
        
        // 1. Handle Success Message
        @if(session('success'))
            KTToast.show({
                message: "{{ session('success') }}",
                icon: '<i class="ki-filled ki-check-circle text-success text-xl"></i>',
                variant: 'mono', // This matches the "Unchecked row" style in your screenshot
                progress: true,
                pauseOnHover: true
            });
        @endif

        // 2. Handle Validation Errors (Loop through if there are multiple)
        @if($errors->any())
            @foreach($errors->all() as $error)
                KTToast.show({
                    message: "{{ $error }}",
                    icon: '<i class="ki-filled ki-information-4 text-destructive text-xl"></i>',
                    variant: 'mono',
                    progress: true,
                    pauseOnHover: true
                });
            @endforeach
        @endif
    });
</script>
@endif

