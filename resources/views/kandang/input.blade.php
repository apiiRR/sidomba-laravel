@extends('layouts.master')

@push('tambahan')
<!-- Custom styles for this page -->
<link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endpush

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Input Kandang Baru</h1>
    <p class="mb-4">Silahkan masukkan data kandang baru</p>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-success">Input Data</h6>
        </div>
        <div class="card-body">
            <form action="{{route('kandang.store')}}" method="POST">
                @csrf
                <div class="mb-3">
                    <label id="mitra_name">Nama Mitra<span class="text-danger">*</span></label>
                    <input class="form-control" type="text" id="mitra_name" name="mitra_name" required>
                </div>
                <div class="mb-3">
                    <label id="sheep_id">Kategori Pan : </label>
                    <div class="form-group">
                        @if (count($pan) > 0)
                        @foreach ($pan as $key => $value)
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="pan_category_id[]"
                                value="{{ $value->pan_category_id }}" {{ in_array($value->pan_category_id,
                            old('pan_category_id', []))
                            ?
                            'checked' : '' }}>
                            <label class="form-check-label">
                                {{ $value->category_name }}
                            </label>
                        </div>
                        @endforeach
                        @else
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="pan_category_id[]" disabled>
                            <label class="form-check-label">
                                Pan Tidak Tersedia
                            </label>
                        </div>
                        @endif
                    </div>
                </div>
                <div class="mb-3">
                    <label for="image">Foto Kandang</label>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="image" name="image">
                        <label class="custom-file-label" for="image">Choose file...</label>
                    </div>
                </div>

                <button type="submit" class="form-control btn btn-success mt-4">Simpan Data</button>
            </form>
        </div>
    </div>

</div>
<!-- /.container-fluid -->
@endsection

@push('javascript')

<script>
    document.getElementById('image').addEventListener('change', function(e) {
        const fileName = e.target.files[0]?.name;
        if (fileName) {
            e.target.nextElementSibling.innerText = fileName;
        }
    });
</script>

<!-- Page level plugins -->
<script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

<!-- Page level custom scripts -->
<script src="{{ asset('js/demo/datatables-demo.js') }}"></script>

@endpush