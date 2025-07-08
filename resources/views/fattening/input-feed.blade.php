@extends('layouts.master')

@push('tambahan')
<!-- Custom styles for this page -->
<link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endpush

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Input Data Pakan</h1>
    <p class="mb-4">Silahkan masukkan data pakan : </p>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-success">Input Data</h6>
        </div>
        <div class="card-body">
            <form action="{{route('fattening.storeFeed')}}" method="POST">
                @csrf
                <div class="mb-3">
                    <label id="kandang">Kandang</label>
                    <input class="form-control" type="text" id="kandang" name="kandang"
                        value="{{ $fatteningPan->fattening->cage->mitra_name }}" required readonly>
                    <input class="form-control" type="text" id="fattening_pan_id" name="fattening_pan_id"
                        placeholder="A12345" value="{{ $fatteningPan->fattening_pan_id }}" required readonly hidden>
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
                    <label id="date">Tanggal Pemberian Pakan</label>
                    <input class="form-control" type="date" id="date" name="date" required>
                </div>
                <div class="mb-3">
                    <label id="forage_feed">Pakan Hijauan</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="validatedInputGroupPrepend">Kg</span>
                        </div>
                        <input type="text" class="form-control" type="number" id="forage_feed" name="forage_feed"
                            required>
                    </div>
                </div>
                <div class="mb-3">
                    <label id="concentrate_category_id">Jenis Konsentrat</label>
                    <select class="form-control" name="concentrate_category_id">
                        <option value="">---</option>
                        @foreach ($categoryConcentrate as $key => $value)
                        <option value="{{$value->consentrate_category_id}}">{{ $value->category_name
                            }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label id="concentrate_feed">Pakan Konsentrat</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="validatedInputGroupPrepend">Kg</span>
                        </div>
                        <input type="text" class="form-control" type="number" id="concentrate_feed"
                            name="concentrate_feed" required>
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