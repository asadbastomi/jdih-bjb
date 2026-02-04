$(function ($) {
    $('[data-toggle="select2"]').select2({
        allowClear: false
    });
    makeButtonLoading();
    $(window).bind("load", function () {
    });
    $(document).on('click', '#btnlogout', function () {
        event.preventDefault();
        option = {
            'success': {
                'request': 'redirectpost',
                'url': window.location.origin + '/bye',
                'after': 2000
            }
        }
        sentData(window.location.origin + '/api/logout', option);
    });
    $(document).on('click', '.link_ubah, .link_cabut', function (event) {
        event.preventDefault();
        $('#search-data').val($(this).data('id')).trigger('keyup');
    });
    $('#modalform').on('hidden.bs.modal', function (e) {
        formname = $(this).find('form').attr('id');
        $(this).find('input.additional').remove();
        fieldClear(formname);
        fieldIndcator('clear', formname);
    })
});
(function ($) {
    $.fn.inputFilter = function (inputFilter) {
        return this.on("input keydown keyup mousedown mouseup select contextmenu drop", function () {
            if (inputFilter(this.value)) {
                this.oldValue = this.value;
                this.oldSelectionStart = this.selectionStart;
                this.oldSelectionEnd = this.selectionEnd;
            } else if (this.hasOwnProperty("oldValue")) {
                this.value = this.oldValue;
                this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
            } else {
                this.value = "";
            }
        });
    };
}(jQuery));
$(".intTextBox").inputFilter(function (value) {
    return /^-?\d*$/.test(value);
});
$(".uintTextBox").inputFilter(function (value) {
    return /^\d*$/.test(value);
});
$(".intLimitTextBox").inputFilter(function (value) {
    return /^\d*$/.test(value) && (value === "" || parseInt(value) <= 500);
});
$(".floatTextBox").inputFilter(function (value) {
    return /^-?\d*[.,]?\d*$/.test(value);
});
$(".currencyTextBox").inputFilter(function (value) {
    return /^-?\d*[.,]?\d{0,2}$/.test(value);
});
$(".latinTextBox").inputFilter(function (value) {
    return /^[a-z]*$/i.test(value);
});
$(".hexTextBox").inputFilter(function (value) {
    return /^[0-9a-f]*$/i.test(value);
});
function makeButtonLoading() {
    $('form.async [type=submit]').each(function () {
        idbtn = $(this).attr('id');
        window.window[idbtn] = Ladda.create(document.querySelector('#' + idbtn));
    });
}
function makeForm(formname, method) {
    var formData = new FormData();
    formData.append('_method', method);
    // console.log($('#'+formname+' .send'));
    $('#' + formname + ' .send').each(function () {
        field = $(this).attr('id');
        if (
            ($(this).attr('type') == 'text') ||
            ($(this).attr('type') == 'email') ||
            ($(this).attr('type') == 'password') ||
            ($(this).attr('type') == 'number') ||
            ($(this).attr('type') == 'hidden') ||
            ($(this).prop("tagName").toLowerCase() == 'textarea')
        ) {
            var valdata = $(this).val();
            if ($(this).siblings().closest('.send.flatpickr-input').length) {
                var valdata = $(this).siblings().closest('.send.flatpickr-input').val();
            }
        } else if (($(this).attr('type') == 'checkbox')) {
            var valdata = ($('#' + $(this).attr('id'))[0].checked) ? 'true' : '';
        } else if (($(this).prop("tagName").toLowerCase() == 'select')) {
            var valdata = $(this).val();
        } else if ($(this).hasClass('wysiwyg')) {
            var valdata = strip_tags($(this).summernote('code'));
            if (valdata != '') {
                var valdata = $(this).summernote('code');
            }
        } else if ($(this).attr('type') == 'file') {
            if ($(this).val() !== '') {
                var valdata = [];
                for (var i = 0; i < $(this)[0].files.length; i++) {
                    valdata.push($(this)[0].files[i]);
                }
                $.each(valdata, function (i, v) {
                    formData.append(field, v);
                })
            } else {
                var valdata = '';
                if ($(this).siblings().closest('.dropify-preview').find('.dropify-render').html() != '') {
                    var valdata = 'nochange';
                }
            }
        }
        if ($(this).attr('type') != 'file') {
            formData.append(field, valdata);
        }
    });
    return formData;
}
function btnLoadingStart(buttonname) {
    window[buttonname].start();
}
function btnLoadingStop(buttonname) {
    if (buttonname && window[buttonname]) {
        window[buttonname].stop();
    }
}
function getData(url, option = null) {
    if (option.success) var actSuccess = option.success;
    if (option.error) var actError = option.error;
    $.ajax({
        type: 'get',
        url: url,
        dataType: 'json',
        async: true,
        processData: false,
        contentType: false,
        success: function (response) {
            console.log(url);
            if (actSuccess) {
                if (actSuccess.request == 'appliedtoform') {
                    $('#' + actSuccess.modal + ' form#' + actSuccess.form).prepend('<input type="hidden" id="id" value="' + response.data.id + '" class="id additional send">');
                    if (response.data.tipe) {
                        if (response.data.tipe == 'text') {
                            $('.conditional').html(textInput);
                        } else if (response.data.tipe == 'pdf') {
                            $('.conditional').html(pdfInput);
                            $('[data-plugins=\"dropify\"]').dropify();
                        } else if (response.data.tipe == 'gallery') {
                            $('.conditional').html(galleryInput);
                            $('[data-plugins=\"dropify\"]').dropify();
                        }
                    }
                    $.each(actSuccess.field, function (key, val) {
                        el = $('#' + actSuccess.modal + ' form#' + actSuccess.form + ' #' + val);
                        console.log('#' + actSuccess.modal + ' form#' + actSuccess.form + ' #' + val);
                        console.log(el);
                        
                        // Check if element exists before accessing its tagName
                        if (el.length === 0) {
                            console.warn('Element not found: #' + val);
                            return; // Skip this element
                        }
                        
                        element = el.prop("tagName").toLowerCase();
                        if (element == 'input') {
                            tipe = el.attr('type');
                            if (
                                (tipe == 'text') ||
                                (tipe == 'email') ||
                                (tipe == 'hidden') ||
                                (tipe == 'number')
                            ) {
                                data = eval('response.data.' + val);
                                el.val(data);
                            }
                        }
                        if (element == 'textarea') {
                            data = eval('response.data.' + val);
                            el.val(data);
                        }
                        if (element == 'select') {
                            data = eval('response.data.' + val);
                            if (data !== null) {
                                if (el.attr('multiple') == 'multiple') {
                                    if (!Array.isArray(data)) {
                                        data = data.split(';');
                                    }
                                }
                                el.val(data).change();
                            } else {
                                $('.select2-search__field').css('width', '406px');
                            }
                        }
                        if (el.hasClass('wysiwyg')) {
                            data = eval('response.data.' + val);
                            $('#' + val).summernote('code', data);
                        }
                        if (el.siblings().closest('.send.input').length) {
                            data = eval('response.data.' + val);
                            window['flatpickr' + val].setDate(data);
                        }
                        if ((el.attr('type') == 'file') && (el.data('plugins') == 'dropify')) {
                            data = eval('response.data.' + val);
                            if (data) {
                                datasplit = data.split(';');
                                if (datasplit.length > 1) {
                                    var listfile = '';
                                    $.each(datasplit, function (i, v) {
                                        justname = v.split('/');
                                        listfile += justname[justname.length - 1];
                                        if ((i + 1) < datasplit.length) {
                                            listfile += ', ';
                                        }
                                        if (i) {
                                            if (val == 'foto') {
                                                $('#' + val).parent().find('.dropify-preview .dropify-render').append('<img src="' + v + '">');
                                            } else {
                                                $('#' + val).parent().find('.dropify-preview .dropify-render .dropify-extension').html('');
                                            }
                                        } else {
                                            var imagenUrl = v;
                                            var drEvent = el.dropify({
                                                defaultFile: imagenUrl
                                            });
                                            drEvent = drEvent.data('dropify');
                                            drEvent.resetPreview();
                                            drEvent.clearElement();
                                            drEvent.settings.defaultFile = imagenUrl;
                                            drEvent.destroy();
                                            drEvent.init();
                                        }
                                    });
                                    setTimeout(function () {
                                        $('#' + val).parent().find('.dropify-preview .dropify-infos .dropify-filename-inner').html(listfile);
                                    }, 900);
                                } else {
                                    var imagenUrl = window.location.origin + data;
                                    var drEvent = el.dropify({
                                        defaultFile: imagenUrl
                                    });
                                    drEvent = drEvent.data('dropify');
                                    drEvent.resetPreview();
                                    drEvent.clearElement();
                                    drEvent.settings.defaultFile = imagenUrl;
                                    drEvent.destroy();
                                    drEvent.init();
                                }
                            }
                        }
                    });
                    if (actSuccess.hasOwnProperty('parentchildajax')) {
                        $.each(actSuccess.parentchildajax, function (key, item) {
                            $('#' + item[0]).data('ajaxchild', item[1])
                            $('#' + item[0]).data('ajaxchildval', eval('response.data.' + item[1]))
                            data = eval('response.data.' + item[0]);
                            // console.log(item);
                            $('#' + item[0]).val(data).change();
                        });
                    }
                    $('#' + actSuccess.modal).modal({
                        backdrop: 'static',
                        keyboard: false
                    });
                }
                if (actSuccess.request == 'appliedtoselec') {
                    $('#' + actSuccess.idelement).empty().trigger('change');
                    var newState = new Option('', '', false, false);
                    $('#' + actSuccess.idelement).append(newState).trigger('change');
                    $.each(response, function (key, val) {
                        selected = false;
                        if (actSuccess.hasOwnProperty('childval')) {
                            if (actSuccess.childval == val.id) {
                                selected = true;
                            }
                        }
                        var newState = new Option(eval('val.' + actSuccess.fielddisplay), val.id, selected, selected);
                        $('#' + actSuccess.idelement).append(newState).trigger('change');
                    })
                }
                if (actSuccess.request == 'appliedtoformuc') {
                    var elementsel = '';
                    $.each(actSuccess.selector, function (key, sel) {
                        elementsel += '#' + sel;
                        if (actSuccess.selector.length > (key + 1)) {
                            elementsel += ',';
                        }
                    })
                    $(elementsel).empty().trigger('change');
                    var newState = new Option('', '', false, false);
                    $(elementsel).append(newState).trigger('change');
                    $.each(response.data.addtoselector, function (key, val) {
                        selected = false;
                        var newState = new Option(val.text, val.id, selected, selected);
                        $(elementsel).append(newState).trigger('change');
                    })

                    $('#' + actSuccess.modal + ' form#' + actSuccess.form).prepend('<input type="hidden" id="iduc" value="' + response.data.id + '" class="id additional send">');
                    $.each(actSuccess.field, function (key, val) {
                        el = $('#' + actSuccess.modal + ' form#' + actSuccess.form + ' #' + val);
                        element = el.prop("tagName").toLowerCase();
                        if (element == 'textarea') {
                            data = eval('response.data.' + val);
                            el.val(data);
                        }
                        if (element == 'select') {
                            data = eval('response.data.' + val);
                            if (data !== undefined) {
                                el.val(data).change();
                            }
                        }
                    });
                    $('#' + actSuccess.modal).modal({
                        backdrop: 'static',
                        keyboard: false
                    });
                    $('.select2-search__field').css('width', '406px');
                }
            }
        },
        error: function (response, code) {
            if (response.responseJSON.message == 'Data not found') {
                notifyMe('404 Error', 'Data not found', 'error');
            }
            if (response.responseJSON.message == 'Unauthenticated') {
                notifyMe('Authentication Expired', 'Unauthenticated', 'error');
                setTimeout(function () {
                    window.location.replace(window.location.origin + '/login');
                }, 900);
            }
        }
    });
}
function sentData(url, option = null) {
    var defaultmethod = 'post';
    var method = 'post';
    if (option.method) {
        method = option.method;
        if (method == 'delete') {
            defaultmethod = method;
        }
    }
    if (option.module) {
        var module = option.module;
        // ------------
        var formname = 'form' + module;
        var buttonname = $('#btn' + module).attr('id');
        var formSend = makeForm(formname, method);
        // ------------
        fieldIndcator('clear', formname);
        btnLoadingStart(buttonname);
    } else {
        var formSend = new FormData();
    }
    if (option.success) {
        var actSuccess = option.success;
        if (actSuccess.textserach) {
            var search = actSuccess.textserach;
        }
    }
    if (option.error) var actError = option.error;

    $.ajax({
        type: defaultmethod,
        url: url,
        data: formSend,
        dataType: 'json',
        async: true,
        processData: false,
        contentType: false,
        success: function (response) {
            notifyMe('Success', response.message, 'success', 10000);
            if (module) {
                btnLoadingStop(buttonname);
                fieldClear(formname);
            }
            if (actSuccess) {
                if (actSuccess.request == 'redirect') {
                    setTimeout(function () { window.location = actSuccess.url; }, actSuccess.after);
                }
                if (actSuccess.request == 'redirectpost') {
                    setTimeout(function () {
                        $.redirect(actSuccess.url, {});
                    }, actSuccess.after);
                }
                if (actSuccess.request == 'addtotable') {
                    act = { 'stat': 'add', 'table': actSuccess.table };
                    setTimeout(function () {
                        clearSearch();
                        $('#' + actSuccess.modal).modal('hide');
                        loadTable(actSuccess.fetch, null, 'last', act);
                    }, actSuccess.after);
                }
                if (actSuccess.request == 'addtotablefirst') {
                    act = { 'stat': 'addfirst', 'table': actSuccess.table };
                    setTimeout(function () {
                        clearSearch();
                        $('#' + actSuccess.modal).modal('hide');
                        loadTable(actSuccess.fetch, null, 'first', act);
                    }, actSuccess.after);
                }
                if (actSuccess.request == 'removefromtable') {
                    $('#' + actSuccess.table + ' tbody tr td div.data-store[data-id="' + response.data.id + '"]').parent().parent().addClass('readytodelete delete');
                    crrentPage = $('.pagination li.page-item.active a.page-link').text();
                    setTimeout(function () {
                        clearSearch();
                        loadTable(actSuccess.fetch, null, crrentPage);
                    }, actSuccess.after);
                }
                if (actSuccess.request == 'updatetable') {
                    act = { 'stat': 'update', 'id': response.data.id, 'table': actSuccess.table };
                    crrentPage = $('.pagination li.page-item.active a.page-link').text();
                    if (search) {
                        crrentPage = 'findme';
                    }
                    setTimeout(function () {
                        clearSearch();
                        $('#' + actSuccess.modal).modal('hide');
                        loadTable(actSuccess.fetch, null, crrentPage, act, response.data.id);
                    }, actSuccess.after);
                }
                if (actSuccess.request == 'thanksskm') {
                    $('#' + actSuccess.target).addClass('hasvote');
                    $('.slider-arrow').click()
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
        error: function (response, code) {
            console.error('AJAX Error:', response);
            console.error('Status:', response.status);
            console.error('ResponseText:', response.responseText);
            
            // Handle 500 errors specially
            if (response.status === 500) {
                notifyMe('Server Error', 'An error occurred on the server. Please try again.', 'error');
                if (module) {
                    btnLoadingStop(buttonname);
                }
                return;
            }
            
            // Check if responseJSON exists
            if (!response.responseJSON) {
                notifyMe('Error', 'An unexpected error occurred. Please try again.', 'error');
                if (module) {
                    btnLoadingStop(buttonname);
                }
                return;
            }
            
            if (response.responseJSON.message == 'Validation Error') {
                $.each(response.responseJSON.data, function (key, data) {
                    notifyMe(key, data, 'error');
                    fieldIndcator('add', key);
                });
                btnLoadingStop(buttonname);
            }
            if (response.responseJSON.message == 'Too Many Attempts.') {
                notifyMe('Login Halt', 'Too Many Attempts', 'error');
                fieldIndcator('add', 'username');
                fieldIndcator('add', 'password');
                showCaptchaIfNeeded();
            }
            if (response.responseJSON.message == 'User and/or Password wrong') {
                notifyMe('Login Failed', 'Username or/and password is wrong', 'error');
                fieldIndcator('add', 'username');
                fieldIndcator('add', 'password');
            }
            if (response.responseJSON.message == 'Unauthenticated') {
                notifyMe('Authentication Expired', 'Unauthenticated', 'error');
                setTimeout(function () {
                    window.location.replace(window.location.origin + '/login');
                }, 900);
            }
            if (module) {
                btnLoadingStop(buttonname);
            }
            if (actError) {
                actError(response);
            }
        }
    });
}
function showCaptchaIfNeeded(errors) {
    $('#captcha-container').show();
}
function fieldIndcator(status, name) {
    if (status == 'clear') {
        $('#' + name + ' .invalid').removeClass('invalid')
    } else {
        if ($('#' + name + '_confirmation').length > 0) {
            name = name + '_confirmation';
        }
        if (
            ($('#' + name).attr('type') == 'text') ||
            ($('#' + name).attr('type') == 'password') ||
            ($('#' + name).attr('type') == 'email') ||
            ($('#' + name).attr('type') == 'number') ||
            ($('#' + name).prop("tagName").toLowerCase() == 'textarea')
        ) {
            $('#' + name).addClass('invalid');
        }
        if (($('#' + name).hasClass('flatpickr-input'))) {
            if ($('#' + name).siblings().closest('.send.input').length) {
                $('#' + name).siblings().closest('.send.input').addClass('invalid');
            }
        }
        if (($('#' + name).attr('type') == 'checkbox')) {
            $('#' + name).parent().find('.custom-control-label').addClass('invalid');
        }
        if (($('#' + name).prop("tagName").toLowerCase() == 'select')) {
            $('#' + name).siblings().closest('.select2').find('.select2-selection').addClass('invalid');
        }
        if (($('#' + name).hasClass('wysiwyg'))) {
            $('#' + name).siblings().closest('.note-editor').addClass('invalid');
        }
        if (($('#' + name).attr('type') == 'file')) {
            if ($('#' + name).data('plugins') == 'dropify') {
                $('#' + name).parent().closest('.dropify-wrapper').addClass('invalid');
            }
        }
    }
}
function fieldClear(formname) {
    $('#' + formname + ' .send, #' + formname + ' .not-send').each(function () {
        if (
            ($(this).attr('type') == 'text') ||
            ($(this).attr('type') == 'email') ||
            ($(this).attr('type') == 'password') ||
            ($(this).attr('type') == 'number') ||
            ($(this).prop("tagName").toLowerCase() == 'textarea')
        ) {
            $(this).val('');
        }
        if (($(this).attr('type') == 'checkbox')) {
            $(this).prop('checked', false);
        }
        if (($(this).prop("tagName").toLowerCase() == 'select')) {
            $(this).val(null).trigger('change');
            if ($(this).hasClass('child')) {
                $(this).empty().trigger('change');
            }
        }
        if (($(this).hasClass('wysiwyg'))) {
            $(this).summernote('reset');
            $(this).summernote('code', '');
        }
        if (($(this).hasClass('optional'))) {
            $(this).removeClass('optional');
            $(this).attr('required', true);
        }
        if (($(this).data('plugins') == 'dropify')) {
            $(".dropify-clear").trigger("click")
        }
        if (($(this).hasClass('flatpickr-input'))) {
            window['flatpickr' + $(this).attr('id')].clear();
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
    if (status == 'success') {
        loaderBgColor = '#5ba035';
        icon = 'success';
    }
    if (status == 'error') {
        loaderBgColor = '#bf441d';
        icon = 'error';
    }
    if (status == 'warning') {
        loaderBgColor = '#da8609';
        icon = 'warning';
    }
    if (status == 'info') {
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

    if (showHideTransition)
        options.showHideTransition = showHideTransition;
    $.toast(options);
}
function loadTable(url, search, page = null, act = null, idnow = null) {
    addTableLoader();
    var formSend = new FormData();
    if (page) {
        formSend.append('page', page);
    }
    if (search) {
        formSend.append('search', search);
    }
    if (idnow) {
        formSend.append('idnow', idnow);
    }
    $.ajax({
        type: 'post',
        url: url,
        data: formSend,
        dataType: 'html',
        async: true,
        processData: false,
        contentType: false,
        success: function (response) {
            $('#table-data').html(response);
            removeTableLoader();
            if (act) {
                if (act.stat == 'add') {
                    $('#' + act.table + ' tbody tr:last-child').addClass('notif');
                    setTimeout(function () {
                        $('#' + act.table + ' tbody tr.notif').removeClass('notif');
                    }, 1000);
                }
                if (act.stat == 'addfirst') {
                    $('#' + act.table + ' tbody tr:first-child').addClass('notif');
                    setTimeout(function () {
                        $('#' + act.table + ' tbody tr.notif').removeClass('notif');
                    }, 1000);
                }
                if (act.stat == 'update') {
                    $('#' + act.table + ' tbody tr td div.data-store[data-id="' + act.id + '"]').parent().parent().addClass('notif');
                    setTimeout(function () {
                        $('#' + act.table + ' tbody tr.notif').removeClass('notif');
                    }, 1000);
                }
            }
            if (!$('#table-data tbody tr.empty').length) {
                $('#table-main').footable({
                    'paginate': false,
                    'showToggle': false
                }).on('footable_row_expanded', function (e) {
                    $('#table-main tbody tr.footable-detail-show').not(e.row).each(function () {
                        $('#table-main').data('footable').toggleDetail(this);
                    });
                });
            }
            // tippy('[data-plugin="tippy"]');
        },
        error: function (response, code) {
            removeTableLoader();
            //
        }
    });
}
function addTableLoader() {
    var loader = '<div class="card-disabled" id="table-loader"> <div class="card-portlets-loader"></div> </div>';
    $(loader).hide().appendTo("#index-content").fadeIn(200);
}
function removeTableLoader() {
    $('#table-loader').fadeOut(200, function () {
        $('#table-loader').remove();
    });
}
function isNew(form) {
    if ($('form#' + form + ' input[type="hidden"].id').length) {
        id = $('form#' + form + ' input[type="hidden"].id').val();
        data = { 'status': false, 'id': id }
        return data;
    }
    data = { 'status': true }
    return data;
}
function delay(callback, ms) {
    var timer = 0;
    return function () {
        var context = this, args = arguments;
        clearTimeout(timer);
        timer = setTimeout(function () {
            callback.apply(context, args);
        }, ms || 0);
    };
}
function optionalField(name) {
    $('#' + name).addClass('optional');
    $('#' + name).removeAttr('required');
}
function clearSearch() {
    $('#search-data').val('');
    textserach = '';
}
function strip_tags(input, allowed) {
    allowed = (((allowed || "") + "").toLowerCase().match(/<[a-z][a-z0-9]*>/g) || []).join(''); // making sure the allowed arg is a string containing only tags in lowercase (<a><b><c>)
    var tags = /<\/?([a-z][a-z0-9]*)\b[^>]*>/gi,
        commentsAndPhpTags = /<!--[\s\S]*?-->|<\?(?:php)?[\s\S]*?\?>/gi;
    return input.replace(commentsAndPhpTags, '').replace(tags, function ($0, $1) {
        return allowed.indexOf('<' + $1.toLowerCase() + '>') > -1 ? $0 : '';
    });
}

function handleFileSelect(evt, functionnext, target) {
    var f = evt; // FileList object
    var reader = new FileReader();
    // Closure to capture the file information.
    reader.onload = (function (theFile) {
        return function (e) {
            var binaryData = e.target.result;
            //Converting Binary Data to base 64
            var base64String = window.btoa(binaryData);
            //showing file converted to base64
            functionnext(f.type, base64String, target);
        };
    })(f);
    // Read in the image file as a data URL.
    reader.readAsBinaryString(f);
}
