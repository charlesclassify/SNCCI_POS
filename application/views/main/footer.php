</div>
</main>
</div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Latest compiled and minified JavaScript for Bootstrap 5 -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

<!-- Toastr JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

<script src="https://cdn.datatables.net/2.0.3/js/dataTables.min.js"></script>

<!-- Your custom scripts -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="<?= base_url('assets/js/scripts1.js'); ?>"></script>
<script>
  // Your DataTable initialization scripts
  $(document).ready(function() {
    $('#user-datatables').dataTable({
      "lengthMenu": [10, 25, 50, 75, 100]
    });

    $(document).ready(function() {
      // Initialize DataTable for Module 1
      $('#user-datatables-module1').DataTable({
        "paging": true,
        "searching": true,
        "ordering": true,
        "lengthMenu": [5, 10, 25, 50, 75, 100]
      });

      // Initialize DataTable for Module 2
      $('#user-datatables-module2').DataTable({
        "paging": true,
        "searching": true,
        "ordering": true,
        "lengthMenu": [5, 10, 25, 50, 75, 100]
      });

      // Initialize DataTable for Module 3
      $('#user-datatables-module3').DataTable({
        "paging": true,
        "searching": true,
        "ordering": true,
        "lengthMenu": [5, 10, 25, 50, 75, 100]
      });
    });
    // Additional DataTable configurations
    $('#ledger-table').DataTable({
      paging: true,
      searching: true,
      ordering: true,
      order: [
        [0, 'desc']
      ],
      lengthMenu: [5, 10, 25, 50],
      language: {
        paginate: {
          next: '<i class="fa fa-angle-right"></i>',
          previous: '<i class="fa fa-angle-left"></i>'
        }
      }
    });
  });
</script>
<script>
  $(document).ready(function() {
    var url = window.location.href;
    $('#layoutSidenav_nav .nav-link').each(function() {
      if (this.href === url) {
        $(this).addClass('active');
      }
    });
  });
</script>