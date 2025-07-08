@extends('layouts.master')

@push('tambahan')
<!-- Custom styles for this page -->
<link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endpush

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Detail Pan</h1>
    <p class="mb-4">Berikut rincian untuk data pan</p>

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-sm-flex align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-success">Detail Data</h6>
        </div>
        <div class="card-body">
            <form>
                @php
                @endphp
                <div class="mb-3">
                    <label>Kandang</label>
                    <input class="form-control" type="text" value="{{$fatteningPan->fattening->date_started}}" readonly>
                </div>
                <div class="mb-3">
                    <label>Nama Pan</label>
                    <input class="form-control" type="text" value="{{$fatteningPan->panCategory->category_name}}"
                        readonly>
                </div>
            </form>
        </div>
    </div>


    <div class="card shadow mb-4">
        <div class="card-header py-3 d-sm-flex align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-success">Data Domba</h6>
            @if ($fatteningPan->fattening->is_active)
            <a type="button" class="btn btn-success"
                href="{{ route('fattening.inputSheep', ['id' => $fatteningPan->fattening_pan_id]) }}">Tambah
                Domba</a>
            @endif
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTableSheep" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Tag Number</th>
                            <th>Nama</th>
                            <th>Gender</th>
                            <th>Usia</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($fatteningPan->fatteningSheep as $key => $value)
                        <tr>
                            <td>{{ $value->sheep->tag_number }} @if ($value->sheep->death)
                                <span class="badge badge-danger">Death</span>
                                @endif
                            </td>
                            <td>{{ $value->sheep->name }}</td>
                            <td>{{ $value->sheep->gender }}</td>
                            <td>{{ $value->sheep->age }}</td>
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
            @if ($fatteningPan->fattening->is_active)
            <a type="button" class="btn btn-success"
                href="{{ route('fattening.inputFeed', ['id' => $fatteningPan->fattening_pan_id]) }}">Tambah Pakan</a>
            @endif
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTableFeed" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Hijauan</th>
                            <th>Konsentrat</th>
                            <th>Jenis Konsentrat</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($fatteningPan->fatteningFeeds as $key => $value)
                        <tr>
                            <td>{{ $value->date }}</td>
                            <td>{{ $value->forage_feed }} gram</td>
                            <td>{{ $value->concentrate_feed }} gram</td>
                            <td>{{ $value->concentrateCategory->category_name }}</td>
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
      $('#dataTableSheep').DataTable();
      $('#dataTableFeed').DataTable();
  });
</script>

<!-- Page level plugins -->
<script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

<!-- Page level custom scripts -->
<script src="{{ asset('js/demo/datatables-demo.js') }}"></script>

@endpush