<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.7/js/dataTables.responsive.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.3.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.3.1/js/buttons.bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.3.1/js/buttons.colVis.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.3.1/js/buttons.html5.min.js"></script>
<link href="{{ asset('asset/css/datatable-custom.css') }}" rel="stylesheet" type="text/css">
<script>
    var check_guard = "{{ Auth::guard('admin')->check() }}";
    var buttons = [];
    if (check_guard) {
        buttons.push({
            text: '<i class="fas fa-plus"></i> Tambah',
            className: 'btn btn-info btn-sm btn-add',
        });
    }
    var isVisibleColumns = check_guard ? true : false;
</script>
