 <!-- Feather Icon JS -->
 <script src="{{ asset('backend/assets/js/feather.min.js') }}"></script>

 <!-- Slimscroll JS -->
 <script src="{{ asset('backend/assets/js/jquery.slimscroll.min.js') }}"></script>

 <script src="{{ asset('backend/assets/js/jquery.ui.touch-punch.min.js') }}"></script>

 <script src="{{ asset('backend/assets/js/jquery-ui.min.js') }}"></script>
 <script src="{{ asset('backend/assets/js/jsvectormap.js') }}"></script>

 <!-- Bootstrap Core JS -->
 <script src="{{ asset('backend/assets/js/bootstrap.bundle.min.js') }}"></script>

 <!-- ApexChart JS -->
 <script src="{{ asset('backend/assets/plugins/apexchart/apexcharts.min.js') }}"></script>
 <script src="{{ asset('backend/assets/plugins/apexchart/chart-data.js') }}"></script>

 <!-- Chart JS -->
 <script src="{{ asset('backend/assets/plugins/chartjs/chart.min.js') }}"></script>
 <script src="{{ asset('backend/assets/plugins/chartjs/chart-data.js') }}"></script>

 <!-- Datatable JS -->
 <script src="{{ asset('backend/assets/js/jquery.dataTables.min.js') }}"></script>
 <script src="{{ asset('backend/assets/js/dataTables.bootstrap5.min.js') }}"></script>

 <!-- Daterangepikcer JS -->
 <script src="{{ asset('backend/assets/js/moment.min.js') }}"></script>
 <script src="{{ asset('backend/assets/plugins/daterangepicker/daterangepicker.js') }}"></script>

 <!-- Select2 JS -->
 <script src="{{ asset('backend/assets/plugins/select2/js/select2.min.js') }}"></script>

 <!-- Color Picker JS -->
 <script src="{{ asset('backend/assets/plugins/%40simonwep/pickr/pickr.es5.min.js') }}"></script>


 <script src="{{ asset('backend/assets/js/email-decode.min.js') }}"></script>
 <script src="{{ asset('backend/assets/js/validation.js') }}"></script>
 <script src="{{ asset('backend/assets/js/calculator.js') }}"></script>
 <script src="{{ asset('backend/assets/js/canada.js') }}"></script>
 <script src="{{ asset('backend/assets/js/plyr-js.js') }}"></script>

 <!-- Owl JS -->
 <script src="{{ asset('backend/assets/plugins/owlcarousel/owl.carousel.min.js') }}"></script>

 <!-- Sticky-sidebar -->
 <script src="{{ asset('backend/assets/plugins/theia-sticky-sidebar/ResizeSensor.js') }}"></script>
 <script src="{{ asset('backend/assets/plugins/theia-sticky-sidebar/theia-sticky-sidebar.js') }}"></script>

 <!-- Custom JS -->
 <script src="{{ asset('backend/assets/js/theme-colorpicker.js') }}"></script>
 <script src="{{ asset('backend/assets/js/script.js') }}"></script>

 <script>
     document.getElementById('select-all').onclick = function() {
         let checkboxes = document.querySelectorAll('input[name="ids[]"]');
         for (let checkbox of checkboxes) {
             checkbox.checked = this.checked;
         }
     }
 </script>
 <script>
     function loadImage(input) {
         if (input.files && input.files[0]) {
             const reader = new FileReader();
             reader.onload = function(e) {
                 const preview = input.closest('.add-choosen')?.querySelector('img');
                 if (preview) {
                     preview.src = e.target.result;
                 }
             }
             reader.readAsDataURL(input.files[0]);
         }
     }
 </script>
