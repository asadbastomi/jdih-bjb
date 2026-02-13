$(function ($) {
    // $('[data-toggle="select2"]').select2();
    $(window).bind("load", function () {
        makeButtonLoading();
    });
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
function downloading($id, $kategori) {
    var formData = new FormData();
    formData.append('_method', 'post');
    formData.append('id', $id);
    formData.append('kategori', $kategori);
    $.ajax({
        type: 'post',
        url: '/api/client-download',
        data: formData,
        dataType: 'json',
        async: true,
        processData: false,
        contentType: false,
        success: function (response) {
            // Success handler
        },
        error: function (response, code) {
            // Error handler
        }
    });
}
function makeButtonLoading() {
    $('form.async [type=submit]').each(function () {
        idbtn = $(this).attr('id');
        window[idbtn] = Ladda.create(document.querySelector('#' + idbtn));
    });
}
function btnLoadingStart(buttonname) {
    window[buttonname].start();
}
function btnLoadingStop(buttonname) {
    window[buttonname].stop();
}
function loadTable(url, search, tahun, page = null, act = null, idnow = null) {
    addTableLoader();
    var formSend = new FormData();
    if (page) {
        formSend.append('page', page);
    }
    if (search) {
        formSend.append('search', search);
    }
    if (tahun) {
        formSend.append('tahun', tahun);
    }
    if (act?.status) {
        formSend.append('status', act.status);
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
            if (!$('#table-data tbody tr.empty').length) {
                $('#table-main').footable({
                    'paginate': false,
                    'showToggle': false
                }).on('footable_row_expanded', function (e) {
                    $('#table-main tbody tr.footable-detail-show').not(e.row).each(function () {
                        $('#table-main').data('footable').toggleDetail(this);
                    });
                });
                setTimeout(function () {
                    if (opentop) {
                        $('#table-main tr td:first').click();
                        opentop = false;
                    }
                }, 500);
            }
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
function clearSearch() {
    $('#search-data').val('');
    textserach = '';
}
