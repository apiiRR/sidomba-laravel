@extends('layouts.master')

@push('tambahan')
<!-- Custom styles for this page -->
<link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endpush

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Input Pan Baru</h1>
    <p class="mb-4">Silahkan masukkan data pan baru</p>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-success">Input Data</h6>
        </div>
        <div class="card-body">
            <form action="{{route('kandang.storePan')}}" method="POST">
                @csrf
                <div class="mb-3">
                    <label id="mitra_name">Nama Mitra</label>
                    <input class="form-control" type="text" id="mitra_name" name="mitra_name"
                        value="{{$cage->mitra_name}}" required readonly>
                    <input class="form-control" type="text" id="cage_id" name="cage_id" value="{{$cage->cage_id}}"
                        required readonly hidden>
                </div>
                <div class="mb-3">
                    <label id="sheep_id">Kategori Pan : </label>
                    <div class="form-group">
                        @foreach ($pan as $key => $value)
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="pan_category_id[]"
                                value="{{ $value->pan_category_id }}" {{ in_array($value->pan_category_id,
                            old('pan_category_id', []))
                            ?
                            'checked' : '' }} {{ $cagePan->firstWhere('pan_category_id', $value->pan_category_id) ?
                            'disabled' :
                            '' }}>
                            <label class="form-check-label">
                                {{ $value->category_name }}
                            </label>
                        </div>
                        @endforeach
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

<!-- Page level plugins -->
<script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

<!-- Page level custom scripts -->
<script src="{{ asset('js/demo/datatables-demo.js') }}"></script>

@endpush