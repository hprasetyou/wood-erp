var base_url = window.location.href.split('index.php');
jQuery.fn
jQuery.fn.loadTableData = function(
  conf = {search:true,
    serverSide:true,
    paging:true,
    button:['show']
  }){
    if(!conf.button){
      conf.button = ['show'];
    }
    if(!conf.hasOwnProperty('search')){
      conf.search = true;
    }
    if(!conf.hasOwnProperty('serverSide')){
      conf.serverSide = true;
    }
    if(!conf.hasOwnProperty('paging')){
      conf.paging = true;
    }
    if(!conf.hasOwnProperty('backendfunc')){
      conf.backendfunc = 'get_json';
    }
    var fs = conf.backendfunc
  var tt = $(this)
  var c = tt.data('controller')
  var bdm = tt.data('domain')
  var fl = []
  var fd= []
   tt.find('th').each(function(){
     if($(this).data('fieldname')){
       fd.push($(this).data('fieldname'))
       if($(this).data('fieldtype')){
         var ft = $(this).data('fieldtype')
         switch (ft) {
           case 'image':
             fl.push({
              "data":$(this).data('fieldname'),
              "orderable": false,
              "render":new Function("data", "type","row","meta",
              "return '<img src=\"'+data.replace('original','120x120')+'\" "+
              "class=\"img img-row\" />'")
            })
             break;
           default:
              break;

         }

       }else{
         var fdt = {
           data:$(this).data('fieldname')
         }
         if($(this).data('disablesort')){
           fdt.orderable = false
         }
         fl.push(fdt)
       }

     }
   })
   var btns = "return "
   for (var b in conf.button) {
     switch (conf.button[b]) {
       case 'show':
          btns += "'<a data-id=\"'+data+'\" class=\"btn btn-sm btn-default pulloginl-right btn-select\" href=\""+base_url[0]+"index.php/"+c+"/detail/'+data+'\"><i class=\"fa fa-search\"></i> Detail</a>'"
         break;
       default:

     }
   }
   fl.push({
    "data":"id",
    "orderable": false,
    "render":new Function("data", "type","row","meta", btns)
  })
  var params = '?fields='+JSON.stringify(fd)
  if(bdm){
    var z = 0
    for (var prop in bdm) {
      // d.cond = []
      if (bdm.hasOwnProperty(prop)) {
         params += '&'
        params += prop+'='+bdm[prop]
      }
      z++
    }
  }
  var dtconf = {
    "processing": true,
    "serverSide": conf.serverSide,
    "searching": conf.search,
    "paging": conf.paging,
    "searchDelay": 1000,
    "ordering": true,
  }
  if(conf.order){
    dtconf.order = [[conf.order.col, conf.order.order]]
  }
  if(conf.serverSide){
    dtconf.ajax =  base_url[0]+"index.php/"+c+"/"+fs+params
    dtconf.columns = fl
    dtconf.initComplete = function(settings, json) {
      tt.css('width','100%')
    }
  }
  tt.DataTable(dtconf);
}


jQuery.fn.simpleValidation =  function(){
  var d = $(this)
  d.on('keyup change','input, select',function(e){
    var valid = true;
    d.find('input').each(function(){
      if($(this).data('required')){
        if(!$(this).val()){
          console.log($(this).attr('id'));
          valid = false
        }
      }

    })
    if(valid){
      $('#'+d.data('target')).removeClass('disabled')
    }else{
      $('#'+d.data('target')).addClass('disabled')
    }
  })
}

function init_modal_selection(){
  console.log(base_url);

  $('.btnModal').click(function(e){
    e.preventDefault()
    var target = $(this).data('target')
    var bdm = $(this).data('domain')

    var thide = $(this).parents('.input-wrap').find('input[type="hidden"]').prop('id')
    var ttext = $(this).parents('.input-wrap').find('input[type="text"]').prop('id')
    console.log(thide);
    console.log(ttext);
    $('#'+target).find('table').attr('data-thide',thide)
    $('#'+target).find('table').attr('data-ttext',ttext)
    var c = $('#'+target).data('controller')
    var fl = [{
      "data":"id",
      "render":new Function("data", "type","row","meta", "return '<a data-id=\"'+data+'\" class=\"btn btn-sm btn-default pull-right btn-select\" href=\"#\"><i class=\"fa fa-search\"></i> </a>'")
    }]
    var fd= ['id']
     $('#'+target).find('th').each(function(){
       if($(this).data('fieldname')){
         var fdt = {
           data:$(this).data('fieldname')
         }
         if($(this).data('disablesort')){
           fdt.orderable = false
         }
         fl.push(fdt)
         fd.push($(this).data('fieldname'))
       }
     })
    var url = base_url[0]+"index.php/"+c+"/get_json?fields="+JSON.stringify(fd)
    for (var prop in bdm) {
      // d.cond = []
      if (bdm.hasOwnProperty(prop)) {
        url += "&"+prop+"="+bdm[prop]
      }
    }
   var mtt = $('#'+target).find('table');
    if($('#'+target).data('init') != 1){
      $('#'+target).data('init',1)
    mtt.DataTable({
      "processing": true,
      "serverSide": true,
      "searchDelay": 1000,
      "ordering": true,
      "ajax": url,
      "columns": fl
    });
  }else{
    mtt.DataTable().ajax.url(url).load()
  }

    $('#'+target).find('table').css('width','100%')
    $('#'+target).modal('show')
  })
  $('.modal').on('click','.btn-select',function(e){
    e.preventDefault()
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
      $('#'+$(this).parents('table').data('thide')).trigger('change')
  })
}
$(document).ready(function(){
  init_modal_selection()
  $('.form-select').select2()
  $('.select2').css('width','100%');
  $('.btn-back').click(function(e){
    e.preventDefault()
    var link = window.location.href.replace('#','');
    if(link == document.referer){
      window.history.go(-2)
    }else{
      window.history.back();
    }
  })
  $('.lightGallery').lightGallery({
     thumbnail:true,
     animateThumb:true
  });
  $('.input-group').on('click','input',function(){
    $(this).parents('.input-group').find('button').trigger('click')
  })
})
$('.form-select').select2()
$('#btn-edit').click(function(e){
  e.preventDefault();
  $('input:checkbox').removeAttr('disabled')
$('.input-wrap, #btn-save, #btn-canceledit, .embed-form, .btn-delete-row , .btn-edit-row').show()
$('.img-layer, .control-value').hide()
$(this).hide()
})
$('#btn-canceledit').click(function(e){
  e.preventDefault();
$('input:checkbox').attr('disabled','disabled')
$('#btn-edit, .img-layer, .control-value').show()
$('#btn-save, .input-wrap, .embed-form, .btn-delete-row, .btn-edit-row').hide()
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

//navbar focus

$('.treeview-menu').each(function(i){
console.log(i);
$(this).children().each(function(){
  var li = $(this)
  var href = li.children().attr('href')
  console.log(href);
  console.log(window.location.pathname);
  if(href == window.location.pathname){
    console.log('sama');
    $(this).addClass("active");
  }
})
})



//repopulate select2

function repopulate_select2(el,newdata){
 $(el).select2('destroy');
 $(el).html('')
 $(el).select2({
   data:newdata
 })
}
