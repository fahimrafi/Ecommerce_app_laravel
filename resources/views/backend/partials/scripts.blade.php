<!-- jQuery -->

<script src="{{ asset("admin-lte/plugins/jquery/jquery.min.js") }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset("admin-lte/plugins/bootstrap/js/bootstrap.bundle.min.js") }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset("admin-lte/dist/js/adminlte.min.js") }}"></script>
<script src="{{ asset("admin-lte/dist/js/datatables.min.js") }}"></script>


<script>
    $(document).ready(function() {
      $('#dataTable').DataTable();
    } );
</script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
 <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
 <script>
  @if(Session::has('message'))
    var type="{{Session::get('alert-type','info')}}"
    switch(type)
    {
      case 'info' :
        toastr.info("{{ Session::get('message')}}");
        break;
      case 'success' :
        toastr.success("{{ Session::get('message')}}");
        break;
      case 'warning' :
        toastr.warning("{{ Session::get('message')}}");
        break;
      case 'error' :
        toastr.error("{{ Session::get('message')}}");
        break;
    }

  @endif
</script>
 <script>  
         $(document).on("click", "#delete", function(e){
             e.preventDefault();
             var link = $(this).attr("href");
              
          


                swal({
                  title: "Do you want to delete?",
                  text: "Once Delete, This will be Permanently Delete!",
                  icon: "warning",
                  buttons: true,
                  dangerMode: true,
                })
                .then((willDelete) => {
                  if (willDelete) {
                       window.location.href = link;
                  } else {
                    swal("Cancelled!");
                  }
                });

            });
    </script>