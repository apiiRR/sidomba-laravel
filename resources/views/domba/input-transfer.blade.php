@extends('layouts.master')

@push('tambahan')
<!-- Custom styles for this page -->
<link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endpush

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Input Transfer Domba</h1>
    <p class="mb-4">Silahkan masukkan data domba baru</p>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-success">Input Data</h6>
        </div>
        <div class="card-body">
            <form action="" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="category">Pilih Kategori</label>
                    <select class="form-control" name="category" id="category">
                        <option value="">---</option>
                        <option value="breeding">Breeding</option>
                        <option value="fattening">Fattening</option>
                    </select>
                </div>
                <div class="mb-3" style="display: none;" id="phase_group">
                    <label for="phase">Pilih Fase</label>
                    <select class="form-control" name="phase" id="phase">
                        <option value="">---</option>
                    </select>
                </div>

                <button type="submit" class="form-control btn btn-success mt-4">Simpan Data</button>
            </form>
        </div>
    </div>

</div>
<!-- /.container-fluid -->
@endsection

@push('javascript')

<!-- Page level plugins -->
<script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

<!-- Page level custom scripts -->
<script src="{{ asset('js/demo/datatables-demo.js') }}"></script>

<script>
    $(document).ready(function () {
        const $phaseSelect = $('#category');
        const $detailGroup = $('#phase_group');
        const $detailSelect = $('#phase');

        // Sembunyikan saat pertama kali
        $detailGroup.hide();

        $phaseSelect.on('change', function () {
            const phase = $(this).val();

            // Reset opsi
            $detailSelect.html('<option value="">-- Pilih Detail --</option>');
            $detailGroup.hide(); // sembunyikan lagi saat loading baru

            if (phase !== '') {
                $.ajax({
                    url: '/get-phase-options',
                    type: 'GET',
                    data: { phase: phase },
                    success: function (data) {
                        if (data.length > 0) {
                            $.each(data, function (i, item) {
                                $detailSelect.append(`<option value="${item.breeding_id}">${item.cage}</option>`);
                            });
                            $detailGroup.show(); // tampilkan jika ada data
                        } else {
                            $detailSelect.html('<option value="">Tidak ada data tersedia</option>');
                            $detailGroup.show(); // tetap tampilkan meskipun kosong
                        }
                    },
                    error: function () {
                        $detailSelect.html('<option value="">Gagal memuat data</option>');
                        $detailGroup.show(); // tampilkan pesan error
                    }
                });
            }
        });
    });
</script>

@endpush