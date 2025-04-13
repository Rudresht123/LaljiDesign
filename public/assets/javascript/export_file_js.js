   // Ajax for our form
    $('.export-excel').click(function (event) {
        var tabledata=$(".datatable").html();
        var finaltabledata=replaceAll(tabledata, 'style', 'null');

        var formAction = $(this).attr('href'); // form handler url
        var filename=$(this).attr('FileName');
        var fileformat=$(this).attr('FileFormat');
        var colspan=$(this).attr('colspan');
        var dummy = new iframeform(formAction);
        dummy.addParameter('_token',$(this).attr('tokenid'));
        dummy.addParameter('tabledata',finaltabledata);
        dummy.addParameter('filename',filename);
        dummy.addParameter('fileformat',fileformat);
        dummy.addParameter('colspan',colspan);
        dummy.send();

    });

   $('.export-pdf').click(function (event) {
       var tabledata=$(".datatable").html();
       var finaltabledata=replaceAll(tabledata, 'style', 'null');

       var formAction = $(this).attr('href'); // form handler url
       var filename=$(this).attr('FileName');
       var fileformat=$(this).attr('FileFormat');
       var colspan=$(this).attr('colspan');
       var dummy = new iframeform(formAction);
       dummy.addParameter('_token',$(this).attr('tokenid'));
       dummy.addParameter('tabledata',finaltabledata);
       dummy.addParameter('filename',filename);
       dummy.addParameter('fileformat',fileformat);
       dummy.addParameter('colspan',colspan);
       dummy.send();

   });




   function iframeform(url)
   {
       var object = this;
       object.time = new Date().getTime();
       object.form = $('<form action="'+url+'" target="iframe'+object.time+'" method="post" style="display:none;" id="form'+object.time+'" name="form'+object.time+'"></form>');

       object.addParameter = function(parameter,value)
       {
           $("<input type='hidden'/>")
               .attr("name", parameter)
               .attr("value", value)
               .appendTo(object.form);
       }
       object.send = function()
       {
           var iframe = $('<iframe data-time="'+object.time+'" style="display:none;" id="iframe'+object.time+'"></iframe>');
           $( "body" ).append(iframe);
           $( "body" ).append(object.form);
           object.form.submit();
           iframe.load(function(){  $('#form'+$(this).data('time')).remove();  $(this).remove();   });
       }
   }
   function escapeRegExp(string){
       return string.replace(/[.*+?^${}()|[\]\\]/g, "\\$&");
   }
   function replaceAll(str, term, replacement) {
       return str.replace(new RegExp(escapeRegExp(term), 'g'), replacement);
   }
