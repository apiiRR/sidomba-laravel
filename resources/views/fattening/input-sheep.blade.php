@extends('layouts.master')

@push('tambahan')
<!-- Custom styles for this page -->
<link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endpush

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Input Data Domba</h1>
    <p class="mb-4">Silahkan masukkan data domba</p>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-success">Input Data</h6>
        </div>
        <div class="card-body">
            <form action="{{route('fattening.storeSheep')}}" method="POST">
                @csrf
                <div class="mb-3">
                    <label id="kandang">Kandang</label>
                    <input class="form-control" type="text" id="kandang" name="kandang"
                        value="{{ $fatteningPan->fattening->cage->mitra_name }}" required readonly>
                    <input class="form-control" type="text" id="fattening_pan_id" name="fattening_pan_id"
                        value="{{ $fatteningPan->fattening_pan_id }}" required readonly hidden>
                </div>
                <div class="mb-3">
                    <label id="pan">Pan</label>
                    <input class="form-control" type="text" id="pan" name="pan"
                        value="{{ $fatteningPan->panCategory->category_name }}" required readonly>
                </div>
                <div class="mb-3">
                    <label id="date_started">Tanggal Mulai</label>
                    <input class="form-control" type="date" id="date_started" name="date_started"
                        value="{{ $fatteningPan->fattening->date_started }}" required readonly>
                </div>
                <div class="mb-3">
                    <label id="date_ended">Tanggal Akhir</label>
                    <input class="form-control" type="date" id="date_ended" name="date_ended"
                        value="{{ $fatteningPan->fattening->date_ended }}" required readonly>
                </div>
                <div class="mb-3">
                    <label id="sheep_id">Pilih Domba : </label>
                    <div class="form-group">
                        @foreach ($sheep as $key => $value)
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="sheep_id[]"
                                value="{{ $value->sheep_id }}" {{ in_array($value->sheep_id, old('sheep_id', [])) ?
                            'checked' : '' }} {{ $value->death ||
                            $fatteningPan->fatteningSheep->firstWhere('sheep_id',
                            $value->sheep_id) ? 'disabled' : '' }}>
                            <label class="form-check-label">
                                @if ($value->death) <del>{{ $value->tag_number }} - {{ $value->name }}</del>
                                <span class="badge badge-danger">Death</span>
                                @else
                                {{ $value->tag_number }} - {{ $value->name }}
                                @endif
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