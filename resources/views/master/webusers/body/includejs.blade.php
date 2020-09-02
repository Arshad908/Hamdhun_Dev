<!-- COMMON SCRIPTS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="{{asset('postAdvertisersLoad/js/common_scripts.js')}}"></script>
    <script src="{{asset('postAdvertisersLoad/js/main.js')}}"></script>
    <script src="{{asset('postAdvertisersLoad/assets/validate.js')}}"></script>
    <script src="{{asset('postAdvertisersLoad/assets/wesite_loads.js')}}"></script>
  <!-- Masonry Filtering -->
  <script src="{{asset('postAdvertisersLoad/js/isotope.min.js')}}"></script>
  <!-- Crypto JS -->
  <script type="text/javascript" src="{{asset('postAdvertisersLoad/js/ClientCrt/rollups/aes.js')}}"></script>
  <script type="text/javascript" src="{{asset('postAdvertisersLoad/js/ClientCrt/rollups/aes-json-format.js')}}"></script>
  

  <!-- Load tree -->
  <!-- <script src="/path/to/cdn/bootstrap.min.js"></script> -->
  <script type="text/javascript" src="{{asset('postAdvertisersLoad/js/tree/bootstrap-treeview.min.js')}}"></script>
  <!-- End tree -->



  <!-- DATEPICKER  -->
  <script>
  $(function() {
    'use strict';
    $('input[name="dates"]').daterangepicker({
      autoUpdateInput: false,
      locale: {
        cancelLabel: 'Clear'
      }
    });
    $('input[name="dates"]').on('apply.daterangepicker', function(ev, picker) {
      $(this).val(picker.startDate.format('MM-DD-YY') + ' > ' + picker.endDate.format('MM-DD-YY'));
    });
    $('input[name="dates"]').on('cancel.daterangepicker', function(ev, picker) {
      $(this).val('');
    });
  });
  </script>
  
  <!-- INPUT QUANTITY  -->
  <script src="{{asset('postAdvertisersLoad/js/input_qty.js')}}"></script> 