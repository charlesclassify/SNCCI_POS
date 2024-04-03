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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<!-- Your custom scripts -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="<?= base_url('assets/js/scripts1.js'); ?>"></script>
<script>
  // Your DataTable initialization scripts
  $(document).ready(function() {
    $('#user-datatables').dataTable({
      "lengthMenu": [10, 25, 50, 75, 100]
    });

    // Initialize DataTable for Module 1
    $('#user-datatables-module1').DataTable({
      "lengthMenu": [5, 10, 25, 50, 75, 100]
    });
    $(document).ready(function() {

      var table = $('#user-datatables-module2').DataTable({
        "lengthMenu": [5, 10, 25, 50, 75, 100]
      });
      var totalPages = table.page.info().pages;
      table.page(totalPages - 1).draw('page');
    });
    // Initialize DataTable for Module 3
    $('#user-datatables-module3').DataTable({
      "lengthMenu": [5, 10, 25, 50, 75, 100]
    });

    // Initialize DataTable for Module 4
    $('#user-datatables-module4').DataTable({
      "lengthMenu": [5, 10, 25, 50, 75, 100]
    });
    // Initialize DataTable for Module 4
    $('#user-datatables-module5').DataTable({
      "lengthMenu": [5, 10, 25, 50, 75, 100]
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