@extends('layouts.master')

@push('tambahan')
<!-- Custom styles for this page -->
<link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endpush

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Input Data Kebuntingan</h1>
    <p class="mb-4">Silahkan masukkan data kebuntingan</p>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-success">Input Data</h6>
        </div>
        <div class="card-body">
            <form action="{{route('domba.storePregnant')}}" method="POST">
                @csrf
                <div class="mb-3">
                    <label id="tag_number">Nomor Tag</label>
                    <input class="form-control" type="text" id="tag_number" name="tag_number"
                        value="{{ $sheep->tag_number }}" required readonly>
                    <input class="form-control" type="text" id="sheep_id" name="sheep_id" value="{{ $sheep->sheep_id }}"
                        required readonly hidden>
                </div>
                <div class="mb-3">
                    <label id="name">Nama</label>
                    <input class="form-control" type="text" id="name" name="name" value="{{ $sheep->name }}" required
                        readonly>
                </div>
                <div class="mb-3">
                    <label id="date_started">Tanggal Mulai</label>
                    <input class="form-control" type="date" id="date_started" name="date_started" required>
                </div>
                <div class="mb-3">
                    <label id="date_ended">Tanggal Akhir</label>
                    <input class="form-control" type="date" id="date_ended" name="date_ended" required>
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