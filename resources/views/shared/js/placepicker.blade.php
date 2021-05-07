<script>
    $(document).ready(function() {
        if ($('#provinsi_list').val()) {
            $.ajax({
                url: "{{ url('pengajuan/getkota') }}/" + $('#provinsi_list').val()
                , method: 'GET'
                , success: function(data) {
                    $('#kota_list > option[selected="selected"]').attr('hidden', true);

                    if ($('#kota_list > option')) {
                        $('#kota_list > option').remove()
                    }
                    var old_kota = "<?= old('Kota') ?>"

                    $('#kota_list').append("<option value=''>Pilih Kota</option>")
                    Object.keys(data.list_kota).forEach(function(key) {
                        $('#kota_list').append("<option value='" + key + "'" + (old_kota == key ? 'selected' : null) + ">" + data.list_kota[key] + "</option>")
                    })
                    $('#kota_list').removeAttr('disabled');

                    $.ajax({
                        url: "{{ url('pengajuan/getkecamatan') }}/" + old_kota
                        , method: 'GET'
                        , success: function(data) {
                            $('#kecamatan_list > option[selected="selected"]').attr('hidden', true);

                            if ($('#kecamatan_list > option')) {
                                $('#kecamatan_list > option').remove()
                            }
                            var old_kec = "<?= old('Kecamatan') ?>"

                            $('#kecamatan_list').append("<option value=''>Pilih Kecamatan</option>")
                            Object.keys(data.list_kota).forEach(function(key) {
                                $('#kecamatan_list').append("<option value='" + key + "'" + (old_kec == key ? 'selected' : null) + ">" + data.list_kota[key] + "</option>")
                            })
                            $('#kecamatan_list').removeAttr('disabled');

                            $.ajax({
                                url: "{{ url('pengajuan/getkelurahan') }}/" + old_kec
                                , method: 'GET'
                                , success: function(data) {
                                    $('#kelurahan_list > option[selected="selected"]').attr('hidden', true);

                                    if ($('#kelurahan_list > option')) {
                                        $('#kelurahan_list > option').remove()
                                    }
                                    var old_kel = "<?= old('Kelurahan') ?>"

                                    $('#kelurahan_list').append("<option value=''>Pilih Kelurahan</option>")
                                    Object.keys(data.list_kota).forEach(function(key) {
                                        $('#kelurahan_list').append("<option value='" + key + "'" + (old_kel == key ? 'selected' : null) + ">" + data.list_kota[key] + "</option>")
                                    })
                                    $('#kelurahan_list').removeAttr('disabled');
                                }
                            })
                        }
                    })
                }
            })
        }


        $('#provinsi_list').on('change', function() {
            const value = $(this).val()

            $.ajax({
                url: "{{ url('pengajuan/getkota') }}/" + value
                , method: 'GET'
                , success: function(data) {
                    $('#kota_list > option[selected="selected"]').attr('hidden', true);

                    if ($('#kota_list > option')) {
                        $('#kota_list > option').remove()
                    }

                    if ($('#kecamatan_list > option')) {
                        $('#kecamatan_list > option').remove()
                    }
                    $('#kecamatan_list').attr('disabled', true);

                    if ($('#kelurahan_list > option')) {
                        $('#kelurahan_list > option').remove()
                    }
                    $('#kelurahan_list').attr('disabled', true);

                    $('#kota_list').append("<option value=''>Pilih Kota</option>")
                    Object.keys(data.list_kota).forEach(function(key) {
                        $('#kota_list').append("<option value='" + key + "'>" + data.list_kota[key] + "</option>")
                    })
                    $('#kota_list').removeAttr('disabled');
                }
            })
        })

        $('#kota_list').on('change', function() {
            const value = $(this).val()

            $.ajax({
                url: "{{ url('pengajuan/getkecamatan') }}/" + value
                , method: 'GET'
                , success: function(data) {
                    $('#kecamatan_list > option[selected="selected"]').attr('hidden', true);

                    if ($('#kecamatan_list > option')) {
                        $('#kecamatan_list > option').remove()
                    }

                    if ($('#kelurahan_list > option')) {
                        $('#kelurahan_list > option').remove()
                    }
                    $('#kelurahan_list').attr('disabled', true);

                    $('#kecamatan_list').append("<option value=''>Pilih Kecamatan</option>")
                    Object.keys(data.list_kota).forEach(function(key) {
                        $('#kecamatan_list').append("<option value='" + key + "'>" + data.list_kota[key] + "</option>")
                    })
                    $('#kecamatan_list').removeAttr('disabled');
                }
            })
        })

        $('#kecamatan_list').on('change', function() {
            const value = $(this).val()

            $.ajax({
                url: "{{ url('pengajuan/getkelurahan') }}/" + value
                , method: 'GET'
                , success: function(data) {
                    $('#kelurahan_list > option[selected="selected"]').attr('hidden', true);

                    if ($('#kelurahan_list > option')) {
                        $('#kelurahan_list > option').remove()
                    }

                    $('#kelurahan_list').append("<option value=''>Pilih Kelurahan</option>")
                    Object.keys(data.list_kota).forEach(function(key) {
                        $('#kelurahan_list').append("<option value='" + key + "'>" + data.list_kota[key] + "</option>")
                    })
                    $('#kelurahan_list').removeAttr('disabled');
                }
            })
        })
    })

</script>
