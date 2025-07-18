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
                <input class="form-control" type="text" id="sheep_id" name="sheep_id" value="{{ $sheep->sheep_id }}"
                    required readonly hidden>
                <input class="form-control" type="text" id="sheep_id" name="phase_sheep_id" value="{{ $phaseSheepId }}"
                    required readonly hidden>
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
                    <select class="form-control" name="phase_id" id="phase">
                        <option value="">---</option>
                    </select>
                </div>
                <div class="mb-3" style="display: none;" id="pan_group">
                    <label for="pan">Pilih Pan</label>
                    <select class="form-control" name="pan_sheep_id" id="pan">
                        <option value="">---</option>
                    </select>
                </div>

                <button type="submit" class="form-control btn btn-success mt-4">Transfer Domba</button>
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
        const $categorySelect = $('#category');
        // phase group
        const $detailGroupPhase = $('#phase_group');
        const $detailSelectPhase = $('#phase');
        // pan group
        const $detailGroupPan = $('#pan_group');
        const $detailSelectPan = $('#pan');

        // Sembunyikan saat pertama kali
        $detailGroupPhase.hide();
        $detailGroupPan.hide();

        let selectedCategory = $('#category').val(); 

        // phase process
        $categorySelect.on('change', function () {
            const phase = $(this).val();

            // Reset opsi
            $detailSelectPhase.html('<option value="">-- Pilih Detail --</option>');
            $detailGroupPhase.hide(); // sembunyikan lagi saat loading baru

            if (phase !== '') {
                $.ajax({
                    url: '/get-phase-options',
                    type: 'GET',
                    data: { phase: phase },
                    success: function (data) {
                        if (data.length > 0) {
                            $.each(data, function (i, item) {
                                console.log(item);
                                if (selectedCategory == 'breeding') { 
                                    $detailSelectPhase.append(`<option value="${item.breeding_id}">${item.date_started} - ${item.date_ended} (Kandang ${item.cage.mitra_name})</option>`);
                                } else {
                                     $detailSelectPhase.append(`<option value="${item.fattening_id}">${item.date_started} - ${item.date_ended} (Kandang ${item.cage.mitra_name})</option>`);
                                }
                                
                            });
                            $detailGroupPhase.show(); // tampilkan jika ada data
                        } else {
                            $detailSelectPhase.html('<option value="">Tidak ada data tersedia</option>');
                            $detailGroupPhase.show(); // tetap tampilkan meskipun kosong
                        }
                    },
                    error: function () {
                        $detailSelectPhase.html('<option value="">Gagal memuat data</option>');
                        $detailGroupPhase.show(); // tampilkan pesan error
                    }
                });
            }
        });

        // pan process
        $detailSelectPhase.on('change', function () {
        const phaseId = $(this).val();
            // Reset opsi
            $detailSelectPan.html('<option value="">-- Pilih Detail --</option>');
            $detailGroupPan.hide(); // sembunyikan lagi saat loading baru

            let selectedCategory = $('#category').val(); 

            if (phaseId !== '') {
                $.ajax({
                    url: '/get-pan-options',
                    type: 'GET',
                    data: { 
                        phaseId: phaseId,  
                        category: selectedCategory
                    },
                    success: function (data) {
                        if (data.length > 0) {
                            $.each(data, function (i, item) {                             
                                console.log(item);
                                if (selectedCategory == 'breeding') {
                                    $detailSelectPan.append(`<option value="${ item.breeding_pan_id }">${ item.pan_category.category_name }</option>`);
                                } else {
                                    $detailSelectPan.append(`<option value="${ item.fattening_pan_id }">${ item.pan_category.category_name }</option>`);
                                }
                            });
                            $detailGroupPan.show(); // tampilkan jika ada data
                        } else {
                            $detailSelectPan.html('<option value="">Tidak ada data tersedia</option>');
                            $detailGroupPan.show(); // tetap tampilkan meskipun kosong
                        }
                    },
                    error: function () {
                        $detailSelectPan.html('<option value="">Gagal memuat data</option>');
                        $detailGroupPan.show(); // tampilkan pesan error
                    }
                });
            }
        });
    });
</script>

@endpush