$(function($){
    makeButtonLoading();
});
function makeButtonLoading() {
    $('form.async [type=submit]').each(function(){
        idbtn = $(this).attr('id');
        window.window[idbtn] = Ladda.create(document.querySelector('#'+idbtn));
    });
}
function btnLoadingStart(buttonname) {
    window[buttonname].start();
}
function btnLoadingStop(buttonname) {
    window[buttonname].stop();
}
function makeForm(formname, method = 'post') {
    var formData = new FormData();
    formData.append('_method', method);
    $('#'+formname+' .send').each(function(){
        field = $(this).attr('id');
        if (
            ($(this).attr('type')=='text') ||
            ($(this).prop("tagName").toLowerCase()=='textarea')
        ) {
            var valdata = $(this).val();
            if ($(this).siblings().closest('.send.flatpickr-input').length) {
                var valdata = $(this).siblings().closest('.send.flatpickr-input').val();
            }
        } else if (($(this).attr('type')=='radio')){
            field = $(this).attr('name');
            var valdata = $('input[name="' + $(this).attr('name') + '"]:checked').val();
        } else if ( ($(this).attr('type')=='checkbox') ) {
            var valdata = ($('#'+$(this).attr('id'))[0].checked)? 'true' : '';
        } else if ( ($(this).prop("tagName").toLowerCase()=='select') ) {
            var valdata = $('#'+$(this).attr('id')).select2('val');
        } else if ($(this).hasClass('wysiwyg')) {
            var valdata = strip_tags($(this).summernote('code'));
            if (valdata!='') {
                var valdata = $(this).summernote('code');
            }
        } else if ($(this).attr('type')=='file') {
            if ($(this).val()!=='') {
                var bypassFormData = true;
                var valdata = [];
                for (var i = 0; i < $(this)[0].files.length; i++) {
                    valdata.push($(this)[0].files[i]);
                }
                $.each(valdata, function(i, v){
                    arrayfield = field + '[]';
                    formData.append(arrayfield, v);
                })
            } else {
                var valdata = '';
                if ($(this).siblings().closest('.dropify-preview').find('.dropify-render').html()!='') {
                    var valdata = 'nochange';
                }
            }
        }
        if (!bypassFormData) {
            formData.append(field, valdata);
        }
    });
    return  formData;
}
function sentData(url, option=null){
    if (option.module) {
        module = option.module
        // ------------
        var formname = 'form'+module;
        var buttonname = $('#btn'+module).attr('id');
        var formSend = makeForm(formname, 'post');
        // ------------
        btnLoadingStart(buttonname);
    } else {
        var formSend = new FormData();
    }
    if (option.success) {
        var actSuccess =  option.success;
    }

    $.ajax({
        type: 'post',
        url: url,
        data: formSend,
        dataType:'json',
        async:true,
        processData: false,
        contentType: false,
        success:function(response){
            notifyMe('Success', response.message, 'success', 10000);
            if (module) {
                btnLoadingStop(buttonname);
            }
            if (actSuccess) {
                if (actSuccess.request=='redirect') {
                    setTimeout(function(){ window.location = actSuccess.url; }, actSuccess.after);
                }
                if (actSuccess.request=='redirectpost') {
                    setTimeout(function(){
                        $.redirect(actSuccess.url,{});
                    }, actSuccess.after);
                }
                if (actSuccess.request=='addtotable') {
                    act = {'stat':'add', 'table':actSuccess.table};
                    setTimeout(function(){
                        clearSearch();
                        $('#'+actSuccess.modal).modal('hide');
                        loadTable(actSuccess.fetch, null, 'last', act);
                    }, actSuccess.after);
                }
                if (actSuccess.request=='addtotablefirst') {
                    act = {'stat':'addfirst', 'table':actSuccess.table};
                    setTimeout(function(){
                        clearSearch();
                        $('#'+actSuccess.modal).modal('hide');
                        loadTable(actSuccess.fetch, null, 'first', act);
                    }, actSuccess.after);
                }
                if (actSuccess.request=='removefromtable') {
                    $('#'+actSuccess.table+' tbody tr td div.data-store[data-id="'+response.data.id+'"]').parent().parent().addClass('readytodelete delete');
                    crrentPage = $('.pagination li.page-item.active a.page-link').text();
                    setTimeout(function(){
                        clearSearch();
                        loadTable(actSuccess.fetch, null, crrentPage);
                    }, actSuccess.after);
                }
                if (actSuccess.request=='updatetable') {
                    act = {'stat':'update', 'id':response.data.id, 'table':actSuccess.table};
                    crrentPage = $('.pagination li.page-item.active a.page-link').text();
                    if (search) {
                        crrentPage = 'findme';
                    }
                    setTimeout(function(){
                        clearSearch();
                        $('#'+actSuccess.modal).modal('hide');
                        loadTable(actSuccess.fetch, null, crrentPage, act, response.data.id);
                    }, actSuccess.after);
                }
                if (actSuccess.request=='thanksskm') {
                    $('#'+actSuccess.target).addClass('hasvote');
                    Cookies.set('vote', true);
                    setTimeout(function(){
                        $('.slider-arrow').click();
                    }, 1500);
                    // act = {'stat':'update', 'id':response.data.id, 'table':actSuccess.table};
                    // crrentPage = $('.pagination li.page-item.active a.page-link').text();
                    // if (search) {
                    //     crrentPage = 'findme';
                    // }
                    // setTimeout(function(){
                    //     clearSearch();
                    //     $('#'+actSuccess.modal).modal('hide');
                    //     loadTable(actSuccess.fetch, null, crrentPage, act, response.data.id);
                    // }, actSuccess.after);
                }
            }
        },
        error:function(response, code){
            if (response.responseJSON.message == 'Validation Error') {
                $.each(response.responseJSON.data, function(key, data){
                    notifyMe(key, data, 'error');
                });
            }
            if (response.responseJSON.message == 'User and/or Password wrong') {
                notifyMe('Login Failed', 'Username or/and password is wrong', 'error');
            }
            if (response.responseJSON.message == 'Unauthenticated') {
                notifyMe('Authentication Expired', 'Unauthenticated', 'error');
                setTimeout(function(){
                    window.location.replace(window.location.origin+'/login');
                }, 900);
            }
            if (module) {
                btnLoadingStop(buttonname);
            }
        }
    });
}
function notifyMe(heading, body, status, hideAfter, position, stack, showHideTransition) {
    // default
    if (!hideAfter)
    hideAfter = 5000;
    if (!stack)
    stack = 10;
    if (!position)
    position = "top-right";
    if (status=='success') {
        loaderBgColor = '#5ba035';
        icon = 'success';
    }
    if (status=='error') {
        loaderBgColor = '#bf441d';
        icon = 'error';
    }
    if (status=='warning') {
        loaderBgColor = '#da8609';
        icon = 'warning';
    }
    if (status=='info') {
        loaderBgColor = '#3b98b5';
        icon = 'info';
    }

    var options = {
        heading: heading,
        text: body,
        position: position,
        loaderBg: loaderBgColor,
        icon: icon,
        hideAfter: hideAfter,
        stack: stack
    };

    if(showHideTransition)
    options.showHideTransition = showHideTransition;
    $.toast(options);
}