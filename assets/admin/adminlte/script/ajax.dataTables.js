var table;

  $(function () {
    table = $('#usersTable').DataTable({
      "processing"  : true,
      "serverSide"  : true,
      "order"       : [],
      "ajax"        : {
        "url"   : document.URL +'/json_users',
        "type"  : 'POST'
      },
      "columns"     : [
        {"data" : "username"},
        {"data" : "email"},
        {"data" : "last_login"}
      ],
    });
  });