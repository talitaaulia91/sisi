function loading() {
    $.blockUI({
        message: '<div class="d-flex align-items-center justify-content-center">'
            + '<span class="spinner-border text-white" role="status"></span>'
            + '<span class="text-white fs-6 fw-bold ms-5">Loading...</span>'
            + '</div>',
        fadeIn: 700,
        fadeOut: 700,
        showOverlay: true,
        centerY: true,
        css: {
            border: 0,
            padding: 20,
            backgroundColor: 'transparent',
            color: '#fff'
        },
        baseZ: 3000,
    });
}

function winform(url, param, caption, tipe = 'post') {
    $.ajax({
        url: url,
        data: param,
        type: tipe,
        beforeSend: function () {
            loading();
            // Remove the previous content to clear the DOM cache which causes
            // the same JS not to be executed again
            $('#winform .modal-body').html('');
        },
        success: function (html) {
            $.unblockUI();
            $('#winform .modal-title').text(caption);
            $('#winform .modal-body').html(html);
            $('#winform').modal('show');
        },
        error: ajaxErrorHandler,
    });
}

function onRemoveSpace(txb) {
    txb.value = txb.value.replace(/\s+/g, '');
}

function onRemoveWhiteSpaceCharact(txb) {
    txb.value = txb.value.replace(/[, ]|[: ]|[; ]|[' ]|[" ]|[~ ]|[` ]+/g, ' ')
        .trim();
}

function onAllKapitalize(txb) {
    txb.value = txb.value.toUpperCase();
}

function onAllLowerCase(txb) {
    txb.value = txb.value.toLowerCase();
}

function popupwindow(url, title, w, h) {
    var left = (screen.width / 2
    ) - (w / 2
        );
    var top = (screen.height / 2
    ) - (h / 2
        );
    window.open(
        url,
        title,
        'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=no, copyhistory=no, width='
        + w
        + ', height='
        + h
        + ', top='
        + top
        + ', left='
        + left,
    );
    window.focus();
}

function numericFilter(txb) {
    txb.value = txb.value.replace(/[^\0-9]/ig, '');
}

function loadContent(div, varurl, loadingmessage) {
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        },
        url: varurl,
        beforeSend: function () {
            if (loadingmessage) {
                swal({
                    title: 'Proses ...',
                    text: 'Sedang Proses. Mohon untuk ditunggu sesaat.',
                    imageUrl: loading_gif,
                    showConfirmButton: false,
                });
            }
        },
        success: function (response) {
            $(div).html(response);
            if (loadingmessage) {
                swal.closeModal();
            }
        },
        error: function (jqXHR, exception) {
            swal.closeModal();
            var msgerror = '';
            if (jqXHR.status === 0) {
                msgerror = 'jaringan tidak terkoneksi.';
            } else if (jqXHR.status == 404) {
                msgerror = 'Halamam tidak ditemukan. [404]';
            } else if (jqXHR.status == 500) {
                msgerror = 'Internal Server Error [500].';
            } else if (exception === 'parsererror') {
                msgerror = 'Requested JSON parse gagal.';
            } else if (exception === 'timeout') {
                msgerror = 'RTO.';
            } else if (exception === 'abort') {
                msgerror = 'Gagal request ajax.';
            } else {
                msgerror = 'Error.\n' + jqXHR.responseText;
            }
            swal(
                'Error System',
                msgerror + ', coba ulangi kembali !!!',
                'error',
            );
        },
        dataType: 'html',
    });
    return false;
}

var Helper = function () {

    return {
        select2: function (ele, url, tag, placeholder, clear, min, tanggal) {
            var Dtag = (typeof tag == 'undefined' || tag == false ? false : true
            );
            var Dpcd = (typeof placeholder == 'undefined' ? '' : placeholder
            );
            var Dclr = (typeof clear == 'undefined' ? false : clear
            );
            var min = (typeof min == 'undefined' ? 1 : 0
            );

            $(ele).select2({
                width: '100%',
                allowClear: Dclr,
                placeholder: Dpcd,
                ajax: {
                    url: url,
                    dataType: 'json',
                    delay: 2500,
                    data: function (params) {
                        return {
                            q: params.term, // search term
                            page: params.page,
                        };
                    },
                    processResults: function (data, params) {
                        if (data.item) {
                            return {
                                results: data.item,
                            };
                        }
                        return {
                            results: data,
                        }
                    },
                    cache: true,
                },
                tags: Dtag,
                tokeSparator: [','],
                escapeMarkup: function (markup) {
                    return markup;
                }, // let our custom formatter work
                minimumInputLength: min,
                templateResult: formatResult, // omitted for brevity, see the source of this page
                templateSelection: formatResult, // omitted for brevity, see the source of this page
            });

            if (typeof tanggal != 'undefined') {
                $(ele).on('select2:select', function (e) {
                    let data_optional = e.params.data.tanggal;
                    $(tanggal).val(data_optional);
                });
            }
        },

        select2me: function (ele) {
            $(ele).select2({
                placeholder: 'Pilih',
                width: '100%',
                allowClear: true,
                closeOnSelect: true,
            });
        },

        select2meAjax: function (ele, url, selected_id = null) {
            var element = $(ele);

            element.select2({
                placeholder: 'Pilih',
                width: '100%',
                allowClear: true,
                escapeMarkup: function (markup) {
                    return markup;
                }, // let our custom formatter work
                closeOnSelect: true,
            });

            Helper.disabled(element);

            $.ajax({
                type: 'GET',
                url: baseUrl + url,
            }).then(function (data) {
                let newOption = [];

                if (selected_id == null || selected_id == '') {
                    newOption.push(new Option(null, '', true, false));
                }

                $.each(data.item, function (index, value) {
                    var selected = false;
                    if (selected_id && value.id == selected_id) {
                        selected = true;
                    }
                    newOption.push(new Option(
                        value.text,
                        value.id,
                        false,
                        selected,
                    ));
                });

                element.html(newOption);

                Helper.enabled(element);
            });
        },

        ckeditor: function (ele) {
            var editor = CKEDITOR.replace(ele, {
                allowedContent: true,
                extraAllowedContent: 'table[class]',
            });
            editor.on('change', function (evt) {
                // getData() returns CKEditor's HTML content.
                var dumy = evt.editor.getData();
                $('#' + ele + '_value').val(dumy);
            });
        },

        bsSelect: function () {
            $('.bs-select').selectpicker({
                iconBase: 'fa',
                tickIcon: 'fa-check',
            });
        },

        getTableData: function (table, callback) {
            table.on('xhr', function () {
                var ajaxJson = table.ajax.json();
                callback(ajaxJson.data);
            });
        },

        onTableDraw: function (table, callback) {
            table.on('draw', function () {
                callback();
            });
        },

        submitButtonVisibility: function (datatable) {
            $('button[type=submit]').hide();
            this.getTableData(datatable, function (data) {
                if (data.length == 0 || data[0].status == 'approve') {
                    $('button[type=submit]').hide();
                } else {
                    $('button[type=submit]').show();
                }
            });
        },

        disabled: function (element) {
            for (let i = 0; i < element.length; i++) {
                $(element[i]).prop('disabled', true);
            }
        },

        enabled: function (element) {
            for (let i = 0; i < element.length; i++) {
                $(element[i]).prop('disabled', false);
            }
        },

        clear: function (element) {
            for (let i = 0; i < element.length; i++) {
                $(element[i]).val('').change();
            }
        },

        show: function (elementToShow) {
            $(elementToShow).show('fast');
            this.enabled([$(elementToShow).find('input, select, textarea')]);
        },

        hide: function (elementToHide) {
            $(elementToHide).hide('fast');
            this.disabled([$(elementToHide).find('input, select, textarea')]);
        },

        checked: function (element) {
            for (let i = 0; i < element.length; i++) {
                $(element[i]).prop('checked', true).change();
            }
        },

        mtCheckBox: function (ele, val) {
            $(ele).find('input[type="radio"]').each(function () {
                var inp = $(this).val();
                if (inp == val) {
                    $(this).attr('checked', true);
                }
            });
        },

        onTableCheked: function (table) {
            $('.table-container').on('change', '.checked_all', function (e) {
                if ($(this).is(':checked')) {
                    $('.checked_item').prop('checked', true).change();
                } else {
                    $('.checked_item').prop('checked', false).change();
                }
            });

            let list_checked = [];
            Helper.onTableDraw(table, function () {
                $('.table-container .checked_all').prop('checked', false);
                $('.table-container .checked_item').each(function (index, item) {
                    if (list_checked.indexOf($(item).val()) > -1) {
                        $(item).prop('checked', true);
                    }
                });
            });

            $('.table-container').on('change', '.checked_item', function (e) {
                let item = $(this).val();
                if ($(this).is(':checked')) {
                    if (list_checked.indexOf($(this).val()) == -1) {
                        list_checked.push(item);
                    }
                } else {
                    list_checked.splice(list_checked.indexOf(item), 1);
                }

                $('.checked_status').val(list_checked);
            });
        },

        select2Selected: function (ele, data) {
            $(ele).select2('trigger', 'select', {
                data: data,
            });
        },

        select2SelectedFetch: function (ele, url) {
            var promise = new Promise(function (resolve, reject) {
                $.get(baseUrl + url, function (json) {
                    $.each(json.item, function (index, value) {
                        if ($(ele).data('select2')) {
                            $(ele).select2('trigger', 'select', {
                                data: value,
                            });
                        }
                    });
                    resolve();
                }).fail(function (xhr) {
                    console.log('select2SelectedFetch gagal');
                    reject();
                });
            });

            return promise;
        },

        tabMenu: function () {
            $('a[data-toggle=tab]').on('click', function (e) {
                const href = $(this).attr('href');

                $.each($('.actions').children('a'), function (index, value) {
                    let dataTab = $(value).attr('data-tab');
                    if (typeof dataTab
                        !== typeof undefined
                        && dataTab
                        !== false) {
                        if (dataTab == href) {
                            $(value).show();
                        } else {
                            $(value).hide();
                        }
                    }
                });
            });
        },

        getProvinsi: function () {
            $('.toggle-provinsi').on('click', function () {
                let is_checked = $('.toggle-provinsi').is(':checked');

                Helper.clear(['.provinsi', '.kota']);
                Helper.disabled(['.kota']);
                if (is_checked) {
                    Helper.select2meAjax(
                        '.provinsi',
                        'fetch/provinsi?is_luar_negeri=true',
                    );
                } else {
                    Helper.select2meAjax('.provinsi', 'fetch/provinsi');
                }
            });
        },

        getKota: function () {
            $('.provinsi').on('change', function () {
                let parent_id = $('.provinsi').val();

                Helper.clear(['.kota']);
                if (parent_id == null || parent_id == '') {
                    Helper.disabled(['.kota']);
                } else {
                    Helper.enabled(['.kota']);
                    Helper.select2meAjax(
                        '.kota',
                        'fetch/kota?provinsi_id=' + parent_id,
                    );
                }
            });
        },

        getModal: function (url) {
            App.blockUI();

            $.get(url, function (html) {
                $('#modal .modal-dialog').attr('class', options.modal_size);
                $('#modal .modal-content').html(html);

                App.unblockUI();
                $('#modal').modal('show');
            }).fail(function (xhr) {

                if (xhr.status == 500 || xhr.status == 401) {
                    window.location = url;
                } else {
                    pageContentBody.html(xhr.responseText);
                    App.unblockUI();
                    console.log('Gagal');
                }
            });

            return false;
        },

        convert_angka: function (str) {
            if (typeof str !== 'string') {
                str = str.toString();
            }

            var ret = [];
            var jml = str.length;
            for (var i = 0; i < jml / 3; i++) {
                var res = str.substring(
                    str.length - ((i + 1
                    ) * 3
                    ),
                    str.length - (i * 3
                    ),
                );
                ret.push(res);
            }
            ret.reverse();
            ret = ret.join('.');
            return ret;
        },

        convert_rupiah: function (str) {
            str = convert_angka(str);
            str = 'Rp. ' + str;
        },

        myeditable: function (ele, isAutoSubmit = true) {
            $(ele).css('-webkit-appearance', 'none');
            $(ele).css('border', 'transparent');
            $(ele).css('border-radius', 0);
            $(ele).css('border-bottom', '1px solid #ccc');
            $(ele).css('cursor', 'pointer');
            $(ele).css('background-color', 'transparent');

            $(ele).focusin(function () {
                $(this).toggleClass('myeditable');
            });
            $(ele).focusout(function (e) {
                $(this).toggleClass('myeditable');
            });

            if (isAutoSubmit) {
                $(ele).change(function () {
                    $(this).closest('form').submit();
                });
            }
        },

        convert_tanggal: function (str) {
            var bulan = [
                'Januari',
                'Februari',
                'Maret',
                'April',
                'Mei',
                'Juni',
                'Juli',
                'Agustus',
                'September',
                'Oktober',
                'November',
                'Desember',
            ];

            var tanggal = new Date(str).getDate();
            var _bulan = new Date(str).getMonth();
            var _tahun = new Date(str).getYear();

            var bulan = bulan[_bulan];

            var tahun = (_tahun < 1000
            ) ? _tahun + 1900 : _tahun;

            return tanggal + ' ' + bulan + ' ' + tahun;
        },
    };

    function formatResult(result) {
        return result.text;
    }
}();

function countDown(time, $selector, $parent, $button, $input) {
    var interval = setInterval(function () {
        var timer = time.split(':');
        //by parsing integer, I avoid all extra string processing
        var hours = null;
        var minutes = parseInt(timer[0], 10);
        var seconds = parseInt(timer[1], 10);
        if (timer.length > 2) {
            hours = parseInt(timer[0], 10);
            minutes = parseInt(timer[1], 10);
            seconds = parseInt(timer[2], 10);
        }
        --seconds;
        minutes = (seconds < 0) ? --minutes : minutes;
        if (timer.length > 2) {
            hours = (minutes < 0) ? --hours : hours;
            hours = (hours < 10) ? '0' + hours : hours;
            minutes = (minutes < 0) ? 59 : minutes;
        }
        minutes = (minutes < 10) ? '0' + minutes : minutes;
        seconds = (seconds < 0) ? 59 : seconds;
        seconds = (seconds < 10) ? '0' + seconds : seconds;
        if ($selector) {
            if (timer.length > 2) {
                $selector.html(hours + ':' + minutes + ':' + seconds);
            } else {
                $selector.html(minutes + ':' + seconds);
            }
        }
        if ($parent) {
            $parent.show();
        }
        if ($button) {
            $button.attr('disabled', 'disabled');
        }
        if ($input) {
            $input.attr('disabled', 'disabled');
        }
        if (timer.length > 2) {
            if (hours < 0) {
                clearInterval(interval);
            }
            //check if both minutes and seconds are 0
            if ((seconds <= 0) && (minutes <= 0) && (hours <= 0)) {
                clearInterval(interval);
                window.location.reload();
            }
        } else {
            if (minutes < 0) {
                clearInterval(interval);
            }
            //check if both minutes and seconds are 0
            if ((seconds <= 0) && (minutes <= 0)) {
                clearInterval(interval);
                window.location.reload();
            }
        }
        if (timer.length > 2) {
            time = hours + ':' + minutes + ':' + seconds;
        } else {
            time = minutes + ':' + seconds;
        }
    }, 1000);
}

function setSubmitValidate($formElement, storeUrl, rules, messages, successHandler, additionalData = {}) {
    $formElement.validate({
        ignore: '',
        rules: rules,
        messages: messages,
        highlight: function (element) {
            $(element).closest('.form-control').addClass('is-invalid');
        },
        unhighlight: function (element) {
            $(element).closest('.form-control').removeClass('is-invalid');
        },
        errorElement: 'div',
        errorClass: 'invalid-feedback',
        errorPlacement: function (error, element) {
            if (element.parent('.validated').length) {
                error.insertAfter(element.parent());
            } else {
                element.parent().append(error);
            }
        },
        submitHandler: function (form) {
            $(form).ajaxSubmit({
                type: 'post',
                url: storeUrl,
                dataType: 'json',
                data: additionalData,
                beforeSend: function () {
                    loading();
                },
                success: function (data) {
                    $.unblockUI();
                    successHandler(data);
                },
                error: ajaxErrorHandler,
            });
        },
    });
}

/**
 * Handle AJAX errors by unblocking the UI and displaying an error dialog.
 *
 * This function is designed to be used as an error handler for AJAX requests. When an AJAX request fails, it unblocks the UI,
 * retrieves a user-friendly error message using the `getAjaxErrorMessage` function, and displays this message in an error dialog
 * using the `showAjaxErrorDialog` function.
 *
 * @param {jqXHR} jqXHR - The jqXHR object representing the AJAX request.
 * @param {string} exception - The type of exception that occurred.
 */
function ajaxErrorHandler(jqXHR, exception) {
    $.unblockUI();
    var msgerror = getAjaxErrorMessage(jqXHR, exception);

    if (msgerror) {
        showAjaxErrorDialog(msgerror, jqXHR);
    }
}

/**
 * Get a user-friendly error message based on the HTTP status code or exception type of an AJAX request.
 *
 * @param {jqXHR} jqXHR - The jqXHR object representing the AJAX request.
 * @param {string} exception - The type of exception that occurred.
 * @returns {string} A user-friendly error message.
 */
function getAjaxErrorMessage(jqXHR, exception) {
    switch (true) {
        case jqXHR.status === 0:
            return 'Jaringan tidak terkoneksi.';
        case jqXHR.status == 404:
            return 'Data tidak ditemukan.';
        case jqXHR.status == 500:
            return 'Internal Server Error.';
        case exception === 'parsererror':
            return 'Requested JSON parse gagal.';
        case exception === 'timeout':
            return 'Request timed out.';
        case exception === 'abort':
            return 'Gagal request ajax.';
        default:
            return jqXHR.responseJSON && jqXHR.responseJSON.msg || jqXHR.responseJSON.message || jqXHR.responseText;
    }
}

/**
 * Display an error dialog with a custom message and handle redirection if specified in the AJAX response.
 *
 * This function uses the SweetAlert library to display an error dialog with a custom message. If the AJAX response
 * contains a 'redirect' property, the function redirects the browser to the specified URL when the user confirms the dialog.
 *
 * @param {string} message - The custom message to display in the error dialog.
 * @param {jqXHR} jqXHR - The jqXHR object representing the AJAX request.
 */
function showAjaxErrorDialog(message, jqXHR) {
    swal.fire({
        title: 'Gagal',
        html: message,
        icon: 'error',
        buttonsStyling: false,
        confirmButtonText: 'OK',
        confirmButtonClass: 'btn btn-lg btn-danger',
    }).then((result) => {
        if (result.isConfirmed && jqXHR.responseJSON && jqXHR.responseJSON.redirect) {
            window.location.href = jqXHR.responseJSON.redirect;
        }
    });
}

/**
 * Creates a debounced function that delays invoking func until after wait
 * milliseconds have elapsed since the last time the debounced function was
 * invoked
 *
 * @param {Function} func
 * @param {Number} timeout
 * @returns {Function}
 */
function debounce(func, timeout = 300) {
    let timer;
    return (...args) => {
        clearTimeout(timer);
        timer = setTimeout(() => { func.apply(this, args); }, timeout);
    };
}

if ($.validator) {
    /**
     * Modify default settings for validation.
     */
    $.validator.setDefaults({
        highlight: function(element) {
            const $el = $(element)
            $el.closest('.form-control, .form-select').addClass('is-invalid');
        },
        unhighlight: function(element) {
            const $el = $(element)
            $el.closest('.form-control, .form-select').removeClass('is-invalid');
            $el.next('.select2').find('.select2-selection').removeClass('is-invalid');
        },
        errorElement: 'div',
        errorClass: 'invalid-feedback',
        errorPlacement: function(error, element) {
            const $el = $(element)
            const $validatedParent = $el.closest('.validated')

            if ($validatedParent.length) {
                error.insertAfter($validatedParent);
            } else if ($el.hasClass('select2-hidden-accessible')) {
                error.insertAfter($el.next('.select2'));
            } else {
                error.insertAfter(element);
            }
        },
    });

    /**
     * Validate multiple form fields with identical names
     * 
     * @link https://stackoverflow.com/a/11740602
     */
    $.validator.prototype.checkForm = function() {
        //overriden in a specific page
        this.prepareForm();
        for (var i = 0, elements = (this.currentElements = this.elements()); elements[i]; i++) {
            if (this.findByName(elements[i].name).length !== undefined && this.findByName(elements[i].name)
                .length > 1) {
                for (var cnt = 0; cnt < this.findByName(elements[i].name).length; cnt++) {
                    this.check(this.findByName(elements[i].name)[cnt]);
                }
            } else {
                this.check(elements[i]);
            }
        }
        return this.valid();
    };
}