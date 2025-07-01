@extends('layouts.master')

@push('tambahan')
<!-- Custom styles for this page -->
<link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endpush

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Detail Breeding</h1>
    <p class="mb-4">Berikut rincian untuk data breeding</p>

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-sm-flex align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-success">Detail Data</h6>
            @if ($breeding->is_active)
            <a type="button" class="btn btn-secondary"
                href="{{ route('breeding.edit', ['id' => $breeding->breeding_id]) }}">
                <span class="icon text-white-50">
                    <i class="fas fa-pencil-alt text-white"></i>
                </span> Ubah Data</a>
            @endif
        </div>
        <div class="card-body">
            <form>
                <div class="mb-3">
                    <label>Kandang</label>
                    <input class="form-control" type="text" value="{{$breeding->cage->code}}" readonly>
                </div>
                <div class="mb-3">
                    <label>Tanggal Mulai</label>
                    <input class="form-control" type="text" value="{{$breeding->date_started}}" readonly>
                </div>
                <div class="mb-3">
                    <label>Tanggal Akhir</label>
                    <input class="form-control" type="text" value="{{$breeding->date_ended}}" readonly>
                </div>
            </form>
        </div>
    </div>



    <div class="card shadow mb-4">
        <div class="card-header py-3 d-sm-flex align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-success">Data Domba</h6>
            @if ($breeding->is_active)
            <a type="button" class="btn btn-success"
                href="{{ route('breeding.inputSheep', ['id' => $breeding->breeding_id]) }}">Tambah
                Domba</a>
            @endif
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTableWeight" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Tag Number</th>
                            <th>Nama</th>
                            <th>Gender</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($breeding->breedingSheep as $key => $value)
                        <tr>
                            <td>{{ $value->sheep->tag_number }} @if ($value->sheep->death)
                                <span class="badge badge-danger">Death</span>
                                @endif
                            </td>
                            <td>{{ $value->sheep->name }}</td>
                            <td>{{ $value->sheep->gender }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>




    <div class="card shadow mb-4">
        <div class="card-header py-3 d-sm-flex align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-success">Data Pakan</h6>
            @if ($breeding->is_active)
            <a type="button" class="btn btn-success"
                href="{{ route('breeding.inputFeed', ['id' => $breeding->breeding_id]) }}">Tambah Pakan</a>
            @endif
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTableDisease" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Hijauan</th>
                            <th>Konsentrat</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($breeding->breedingFeeds as $key => $value)
                        <tr>
                            <td>{{ $value->date }}</td>
                            <td>{{ $value->forage_feed }}</td>
                            <td>{{ $value->concentrate_feed }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>


</div>
<!-- /.container-fluid -->
@endsection

@push('javascript')

<script>
    $(document).ready(function () {
      $('#dataTableWeight').DataTable();
      $('#dataTableDisease').DataTable();
  });
</script>

<!-- Page level plugins -->
<script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

<!-- Page level custom scripts -->
<script src="{{ asset('js/demo/datatables-demo.js') }}"></script>

@endpush