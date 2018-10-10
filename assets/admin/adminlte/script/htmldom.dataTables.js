$(document).ready(function() {
  var table = $('#usersTable').DataTable({
    'paging'      : true,
    'lengthChange': true,
    'searching'   : true,
    'ordering'    : true,
    'info'        : true,
    'autoWidth'   : true,
    'dom'         : 'Bfrtip',
    'buttons'     : ['copy','excel','pdf']
  })
})
