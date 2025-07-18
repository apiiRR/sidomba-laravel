@extends('layouts.master')

@push('tambahan')
<!-- Custom styles for this page -->
<link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endpush

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Detail Fattening</h1>
    <p class="mb-4">Berikut rincian untuk data fattening</p>

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-sm-flex align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-success">Detail Data</h6>
            @if ($fattening->is_active)
            <a type="button" class="btn btn-secondary"
                href="{{ route('fattening.edit', ['id' => $fattening->fattening_id]) }}">
                <span class="icon text-white-50">
                    <i class="fas fa-pencil-alt text-white"></i>
                </span> Ubah Data</a>
            @endif
        </div>
        <div class="card-body">
            <form>
                <div class="mb-3">
                    <label>Kandang</label>
                    <input class="form-control" type="text" value="{{$fattening->cage->mitra_name}}" readonly>
                </div>
                <div class="mb-3">
                    <label>Tanggal Mulai</label>
                    <input class="form-control" type="text" value="{{$fattening->date_started}}" readonly>
                </div>
                <div class="mb-3">
                    <label>Tanggal Akhir</label>
                    <input class="form-control" type="text" value="{{$fattening->date_ended}}" readonly>
                </div>
            </form>
        </div>
    </div>


    <div class="card shadow mb-4">
        <div class="card-header py-3 d-sm-flex align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-success">Data Pan</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTablePan" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Pan</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $id = 0;
                        @endphp
                        @foreach ($fattening->fatteningPans as $key => $value)
                        @php
                        $id++;
                        @endphp
                        <tr>
                            <td>{{ $id }}</td>
                            <td>{{ $value->panCategory->category_name }}</td>
                            <td class="d-flex justify-content-center">
                                <a href="{{ route('fattening.showPan', ['id' => $value->fattening_pan_id]) }}"
                                    class="btn btn-info btn-icon-split mr-2">
                                    <span class="icon text-white-50">
                                        <i class="fas fa-solid fa-info text-white"></i>
                                    </span>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- <div class="card shadow mb-4">
        <div class="card-header py-3 d-sm-flex align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-success">Data Pakan</h6>
            @if ($fattening->is_active)
            <a type="button" class="btn btn-success"
                href="{{ route('fattening.inputFeed', ['id' => $fattening->fattening_id]) }}">Tambah Pakan</a>
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
                        @foreach ($fattening->fatteningFeeds as $key => $value)
                        <tr>
                            <td>{{ $value->date }}</td>
                            <td>{{ $value->forage_feed }} Kg</td>
                            <td>{{ $value->concentrate_feed }} Kg</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div> --}}


</div>
<!-- /.container-fluid -->
@endsection

@push('javascript')

<script>
    $(document).ready(function () {
      $('#dataTablePan').DataTable();
  });
</script>

<!-- Page level plugins -->
<script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

<!-- Page level custom scripts -->
<script src="{{ asset('js/demo/datatables-demo.js') }}"></script>

@endpush