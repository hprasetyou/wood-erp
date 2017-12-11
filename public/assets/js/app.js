var base_url = window.location.href.split('index.php');
Number.prototype.format = function(n, x, s, c) {
    var re = '\\d(?=(\\d{' + (x || 3) + '})+' + (n > 0 ? '\\D' : '$') + ')',
        num = this.toFixed(Math.max(0, ~~n));

    return (c ? num.replace('.', c) : num).replace(new RegExp(re, 'g'), '$&' + (s || ','));
};
//only formatting, not exchange
function format_currency(val,rule){
  return (rule.position == 'before'? rule.symbol:'')
  +" "+val.format(2, 3, '.', ',')
  +(rule.position == 'after'? rule.symbol:'')
}
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
    if(!conf.hasOwnProperty('ordering')){
      conf.ordering = true;
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
         var ordr = false;
         switch (ft) {
           case 'image':
             render_data = new Function("data", "type","row","meta",
              "return '<img src=\"'+data.replace('original','120x120')+'\" "+
              "class=\"img img-row\" />'")

             break;
          case 'cbm':
          render_data = new Function("data", "type","row","meta",
           "return parseFloat(data/1000000).toFixed(3) + ' m3';")

            break;
         case 'datetime':
         render_data = new Function("data", "type","row","meta",
          "return moment(data.date).format('DD MMM YYYY HH:mm:ss');")
          ordr = true;
           break;
        case 'datetime-human':
          ordr = true;
          render_data = new Function("data", "type","row","meta",
           "return moment(data.date).fromNow();")

          break;
        case 'array':
          ordr = true;
          render_data = new Function("data", "type","row","meta",
           "return data.toString()")
          break;
        case 'underneath_comma':
          ordr = true;
          render_data = new Function("data", "type","row","meta",
           "return data.replace(\", \",\"<br>\")")
          break;
        case 'currency':
        var curdata = $(this).data('currency');
        console.log(curdata);
          render_data = new Function("data", "type","row","meta",
         "var cdata = {symbol:'Rp.',rate:13400};"+
         "return '"+(curdata.position == 'before'? curdata.symbol:'')
         +" '+("+curdata.rate+"*data).format(2, 3, '.', ',')+' "
         +(curdata.position == 'after'? curdata.symbol:'')+"'")
        default:
          break;

         }
         fl.push({
          "data":$(this).data('fieldname'),
          "orderable": ordr,
          "render":render_data
        })
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
   var btns = ""
   for (var b in conf.button) {
     switch (conf.button[b]) {
       case 'show':
          btns += "<a data-id=\"'+data+'\" class=\"btn btn-sm btn-default pulloginl-right btn-select\" href=\""+base_url[0]+"index.php/"+c+"/detail/'+data+'\"><i class=\"fa fa-search\"></i> Detail</a>"
         break;
       case 'edit':
          btns += "<a data-id=\"'+data+'\" class=\"btn btn-row-action btn-sm btn-primary pulloginl-right btn-edit\" href=\"#\"><i class=\"fa fa-pencil\"></i> Edit</a>"
         break;
       case 'delete':
          btns += "<a data-id=\"'+data+'\" class=\"btn btn-sm btn-row-action btn-danger pulloginl-right btn-delete\" href=\"#\"><i class=\"fa fa-trash\"></i> Delete</a>"
         break;

       default:

     }
   }
   fl.push({
    "data":"id",
    "orderable": false,
    "render":new Function("data", "type","row","meta", "return  '"+btns+"'")
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
    "ordering": conf.ordering,
  }
  if(conf.order){
    dtconf.order = [[conf.order.col, conf.order.order]]
  }
  if(conf.serverSide){
    dtconf.ajax =  base_url[0]+"index.php/"+c+"/"+fs+params
    dtconf.columns = fl
    if(!conf.hasOwnProperty('complete')){
      conf.complete = function(settings, json) {
        tt.css('width','100%')
      }
    }

    dtconf.initComplete = conf.complete
    dtconf.fnRowCallback = conf.rowCallback
  }
  tt.DataTable(dtconf);
}

function set_back_url(url){
  var btn = $('.btn-back')
  btn.removeClass('.btn-back')
  btn.click(function(e){
    e.preventDefault()
    window.location.href = "/index.php/"+url
  })
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

         if($(this).data('fieldtype')){
           var ft = $(this).data('fieldtype')
           var ordr = false;
           switch (ft) {
             case 'image':
               render_data = new Function("data", "type","row","meta",
                "return '<img src=\"'+data.replace('original','120x120')+'\" "+
                "class=\"img img-row\" />'")

               break;
            case 'cbm':
            render_data = new Function("data", "type","row","meta",
             "return parseFloat(data/1000000).toFixed(3) + ' m3';")

              break;
           case 'datetime':
           render_data = new Function("data", "type","row","meta",
            "return moment(data.date).format('DD MMM YYYY HH:mm:ss');")
            ordr = true;
             break;
          case 'datetime-human':
            ordr = true;
            render_data = new Function("data", "type","row","meta",
             "return moment(data.date).fromNow();")

            break;
          case 'underneath_comma':
            ordr = true;
            render_data = new Function("data", "type","row","meta",
             "return data.replace(\", \",\"<br>\")")
            break;
          case 'array':
            ordr = true;
            render_data = new Function("data", "type","row","meta",
             "return data.toString()")
            break;
          case 'currency':
          var curdata = $(this).data('currency');
          console.log(curdata);
            render_data = new Function("data", "type","row","meta",
           "var cdata = {symbol:'Rp.',rate:13400};"+
           "return '"+(curdata.position == 'before'? curdata.symbol:'')
           +" '+("+curdata.rate+"*data).format(2, 3, '.', ',')+' "
           +(curdata.position == 'after'? curdata.symbol:'')+"'")
          default:
            break;

           }
           fl.push({
            "data":$(this).data('fieldname'),
            "orderable": ordr,
            "render":render_data
          })
         }else{
           var fdt = {
             data:$(this).data('fieldname')
           }
           if($(this).data('disablesort')){
             fdt.orderable = false
           }
           fl.push(fdt)
         }
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
$('#btn-edit').click(function(e){
  e.preventDefault();
  $('input:checkbox').removeAttr('disabled')
$('.input-wrap, #btn-save, #btn-canceledit, .embed-form, .btn-delete-row , .btn-row-action, .btn-edit-row').show()
$('.img-layer, .control-value').hide()
$(this).hide()
})
$('#btn-canceledit').click(function(e){
  e.preventDefault();
$('input:checkbox').attr('disabled','disabled')
$('#btn-edit, .img-layer, .control-value').show()
$('#btn-save, .input-wrap, .embed-form, .btn-delete-row, .btn-row-action, .btn-edit-row').hide()
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

$.fn.modal.Constructor.prototype.enforceFocus = function () {
  var that = this;
  $(document).on('focusin.modal', function (e) {
     if ($(e.target).hasClass('select2-input')) {
        return true;
     }

     if (that.$element[0] !== e.target && !that.$element.has(e.target).length) {
        that.$element.focus();
     }
  });
};

//repopulate select2

function repopulate_select2(el,newdata){
 $(el).select2('destroy');
 $(el).html('<option value="">Select</option>')
 $(el).select2({
   data:newdata
 })
 $('.select2').css('width','100%');
}
