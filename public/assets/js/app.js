var base_url = window.location.href.split('index.php');
jQuery.fn
jQuery.fn.loadTableData = function(){
  var tt = $(this)
  var c = tt.data('controller')
  var bdm = tt.data('domain')
  var fl = []
   tt.find('th').each(function(){
     if($(this).data('fieldname')){
       fl.push({
         data:$(this).data('fieldname')
       })
     }
   })
   fl.push({
    "data":"id",
    "render":new Function("data", "type","row","meta", "console.log(meta);return '<a data-id=\"'+data+'\" class=\"btn btn-sm btn-default pulloginl-right btn-select\" href=\"'+meta.settings.ajax.split('get_json')[0]+'detail/'+data+'\"><i class=\"fa fa-search\"></i> </a>'")
  })
  var params = ''
  if(bdm){
    var z = 0
    for (var prop in bdm) {
      // d.cond = []
      if (bdm.hasOwnProperty(prop)) {
        if(z>0){
         params += '&'
      }else{
         params += '?'
      }
        params += prop+'='+bdm[prop]
      }
      z++
    }
  }
  tt.DataTable({
    "processing": true,
    "serverSide": true,
    "searchDelay": 1000,
    "ordering": false,
    "ajax": base_url[0]+"index.php/"+c+"/get_json"+params,
    "columns": fl
  });
}

function init_modal_selection(){
  console.log(base_url);
  $('.btnModal').click(function(){
    var target = $(this).data('target')
    var bdm = $(this).data('domain')

    var thide = $(this).parents('.input-wrap').find('input[type="hidden"]').prop('id')
    var ttext = $(this).parents('.input-wrap').find('input[type="text"]').prop('id')
    console.log(thide);
    console.log(ttext);
    $('#'+target).find('table').attr('data-thide',thide)
    $('#'+target).find('table').attr('data-ttext',ttext)
    var c = $('#'+target).data('controller')
    if($('#'+target).data('init') != 1){
      $('#'+target).data('init',1)

    var fl = [{
      "data":"id",
      "render":new Function("data", "type","row","meta", "return '<a data-id=\"'+data+'\" class=\"btn btn-sm btn-default pull-right btn-select\" href=\"#\"><i class=\"fa fa-search\"></i> </a>'")
    }]
     $('#'+target).find('th').each(function(){
       if($(this).data('fieldname')){
         fl.push({
           data:$(this).data('fieldname')
         })
       }
     })
    var mtt = $('#'+target).find('table');
    mtt.DataTable({
      "processing": true,
      "serverSide": true,
      "searchDelay": 1000,
      "ordering": false,
      "ajax": {
          "url": base_url[0]+"index.php/"+c+"/get_json",
          "data": function ( d ) {
            if(bdm){
              for (var prop in bdm) {
                // d.cond = []
                if (bdm.hasOwnProperty(prop)) {
                  d[prop] = bdm[prop]
                }
              }
            }
          }
      },
      "columns": fl
    });
    }

    $('#'+target).find('table').css('width','100%')
    $('#'+target).modal('show')
  })
  $('.modal').on('click','.btn-select',function(){
      $('#'+$(this).parents('table').data('thide')).val($(this).data('id'))
      var ddis = $(this).parents('table').data('display')+"";
      var didx = ddis.split('-')
      var so = ''
      for (var i in didx) {
        if(i>0){
          so += '-'
        }
        so += $(this).parents('tr').children('td:eq('+didx[i]+')').text()
      }
      $('#'+$(this).parents('table').data('ttext')).val(so)
      $(this).parents('.modal').modal('hide')
  })
}
$(document).ready(function(){
  init_modal_selection()
  $('.form-select').select2()
  $('.select2').css('width','100%');
})
$('.form-select').select2()
$('#btn-edit').click(function(){
$('#btn-canceledit').show()
$('#btn-save').show()
$('.input-wrap').show()
$('.control-value').hide()
$(this).hide()
})
$('#btn-canceledit').click(function(){
$('#btn-edit').show()
$('#btn-save').hide()
$('.input-wrap').hide()
$('.control-value').show()
$(this).hide()
})
$(function() {
$('.input-date').daterangepicker({
singleDatePicker: true,
showDropdowns: true,
locale: {
  format: 'YYYY/MM/DD'
}
},function(start, end, label) {
});
$('.input-datetime').daterangepicker({
singleDatePicker: true,
showDropdowns: true,
timePicker: true,
timePickerIncrement: 30,
locale: {
  format: 'YYYY/MM/DD hh:mm:ss'
}
},
function(start, end, label) {
});
});
