$(document).ready(function(){
    $('.fakebtn').click(function(){
        $(this).next().click();
    });


    $('.inputFile input[type="file"]').change(function(){
        var input = $(this);
        var file = input.val();
        var extmas = input.attr('data-ext').split(',');
        var pos = false;
        if(file.length > 0){
            reWin = /.*\\(.*)/;
            var fileTitle = file.replace(reWin, "$1"); //выдираем название файла
            reUnix = /.*\/(.*)/;
            fileTitle = fileTitle.replace(reUnix, "$1"); //выдираем название файла

            var RegExExt =/.*\.(.*)/;
            var ext = fileTitle.replace(RegExExt, "$1");//и его расширение

            if (ext) {
                for(var i=0;i<extmas.length;i++){
                    if(ext.toLowerCase() == extmas[i]){
                        pos = true;
                    }
                }

            }
            if(pos !== false){
                input.next('p.help-block').hide();
                input.parent().find('div.fileName').show().text(fileTitle);
                return;
            }else{
                input.next('p.help-block').css('color','red');
                setTimeout(function() { input.next('p.help-block').css('color','#000')}, 3000)

            }
        }

        input.parent().find('div.fileName').hide().text('');
        input.next('p.help-block').show();
        input.val('');
    });
});

$(function() {
    $( "#sendbutton" ).click(function() {
        var derror = false;
        if ($("#delay").val().length<1)
        {
            $("#delay").parent().addClass("has-error");
            derror = true;
        } else {$("#delay").parent().removeClass("has-error"); }

         if ($("#repeat").val().length<1)
         {
           $("#repeat").parent().addClass("has-error");
            derror = true;
         } else {$("#repeat").parent().removeClass("has-error"); }

         if (derror)
         {
             return false;
         }
    });

});



