// Header megamenu
(function() {
        var $collapse = $('#collapse-tentang');

        $(document).on('click', function(event) {
            var $target = $(event.target);
            if (!$target.closest($collapse).length) {
                $collapse.collapse('hide');
            }
        });
    }
)();

// Check certificate modal
(function() {
        var $modal = $('#modal-check-certificate');
        var $form = $modal.find('form');
        var $result = $modal.find('.collapse');
        var $resultDetail = $modal.find('.detail');
        var $resultQr = $modal.find('.qr-img');
        var urlParams = new URLSearchParams(window.location.search);

        $modal.on('hidden.bs.modal', function() {
            $result.collapse('hide');
        });

        $form.on('submit', function(e) {
            e.preventDefault();

            loading();
            $.get($form.attr('action'), $form.serialize())
                .then(function(data) {
                    var detail = data.data;

                    if (!detail) {
                        swal.fire({
                            title: 'Sertifikat tidak ditemukan',
                            text: 'Mohon periksa kembali nomor sertifikat Anda',
                            icon: 'error',
                            buttonsStyling: false,
                            confirmButtonText: 'OK',
                            confirmButtonClass: 'btn btn-lg btn-danger',
                        });
                        return;
                    }

                    $resultDetail.html(`
                <p class="text-caption-sm text-caption-lg-sm text-center mb-4">
                    <span class="text-neutral">Nomor Sertifikat:</span>
                    <strong>${detail.nomor_sertifikat}</strong>
                </p>

                <div class="table-responsive">
                    <table class="table table-borderless w-auto gx-2px gy-2 mx-auto mb-0">
                        <tbody>
                            <tr>
                                <th>Nama Mahasiswa</th>
                                <td>:</td>
                                <td><strong>${detail.nama}</strong></td>
                            </tr>
                            <tr>
                                <th>Fakultas/Jurusan</th>
                                <td>:</td>
                                <td><strong>${detail.fakultas_jurusan}</strong></td>
                            </tr>
                            <tr>
                                <th>Pelaksanaan Magang</th>
                                <td>:</td>
                                <td><strong>${detail.bumn}</strong></td>
                            </tr>
                            <tr>
                                <th>Perguruan Tinggi</th>
                                <td>:</td>
                                <td><strong>${detail.universitas}</strong></td>
                            </tr>
                            <tr>
                                <th>Posisi Magang</th>
                                <td>:</td>
                                <td><strong>${detail.posisi}</strong></td>
                            </tr>
                            <tr>
                                <th>Nilai Magang</th>
                                <td>:</td>
                                <td><strong>${detail.grade}</strong></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            `);
                    $resultQr.attr('src', detail.qrCode);

                    $result.collapse('show');
                })
                .fail(function() {
                    swal.fire({
                        title: 'Terjadi kesalahan',
                        text: 'Mohon coba beberapa saat lagi',
                        icon: 'error',
                        buttonsStyling: false,
                        confirmButtonText: 'OK',
                        confirmButtonClass: 'btn btn-lg btn-danger',
                    });
                })
                .always(function() {
                    $.unblockUI();
                });
        });

        $(document).ready(function() {
            if (urlParams.get('nomor_sertifikat')) {
                $modal.modal('show');
                $form.submit();
            }
        });
    }
)();

// Autocomplete position field
(function() {
        $('[data-autocomplete="position"]').each(function() {
            var $this = $(this);
            var $apiUrl = $(this).data('api') || '';
            var $form = $(this).closest('form');
            var $province = $form && $form.find('[name="provinsi"]');
            var $company = $form && $form.find('[name="perusahaan"]');
            var $internship = $form && $form.find('[name="jenis_magang"]');
            var autoCompleteJS = new autoComplete({
                selector: function() {
                    return $this[0];
                },
                debounce: 400,
                data: {
                    src: function() {
                        // Use params from the current form if any
                        var province = $province && $province.val();
                        var company = $company && $company.val();
                        var internship = $internship && $internship.val();
                        var position = $this.val();

                        return $.get($apiUrl, {
                            position,
                            province,
                            company,
                            internship,
                        }).then(function(data) {
                            return data.data;
                        });
                    },
                },
                events: {
                    input: {
                        selection: (event) => {
                            const selection = event.detail.selection.value;
                            autoCompleteJS.input.value = selection;
                        },
                    },
                },
            });
        });
    }
)();

// Form input number
(function() {
    // Button minus click
    $(document).on('click', '.form-input-number .minus', function() {
        var $input = $(this).siblings('input');
        var value = Number($input.val());

        $input.val(value > 1 ? value - 1 : 1).trigger('change')
    });

    // Button plus click
    $(document).on('click', '.form-input-number .plus', function() {
        var $input = $(this).siblings('input');
        var value = Number($input.val());

        $input.val(value + 1).trigger('change')
    });

    // Sync preview with input value
    $(document).on('change', '.form-input-number input', function(event) {
        $(this).siblings('.number').text(event.target.value);
    });
})();