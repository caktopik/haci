var table;

$(function () {
  table = $('#usersTable').DataTable({
    "processing"  : true,
    "serverSide"  : true,
    "order"       : [],
    "ajax"        : {
      "url"   : window.location.origin + window.location.pathname +'/json_users',
      "type"  : 'POST'
    },
    "paging"      : true,
  });
});