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
    "paging"      : true,
  });
});