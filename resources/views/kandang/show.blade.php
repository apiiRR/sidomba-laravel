@extends('layouts.master')

@push('tambahan')
<!-- Custom styles for this page -->
<link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endpush

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Detail Kandang</h1>
    <p class="mb-4">Berikut rincian untuk data kandang : {{$cage->code}}</p>

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-sm-flex align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-success">Data Kandang</h6>
        </div>
        <div class="card-body">
            <form>
                <div class="mb-3">
                    <label>Nama Mitra</label>
                    <input class="form-control" type="text" value="{{$cage->mitra_name}}" readonly>
                </div>
                <div class="mb-3">
                    <label>Fase Aktif</label>
                    <div class="input-group">
                        <input class="form-control" type="text" value="{{ ucfirst($cage->active_phase['name']) }}"
                            readonly>
                        <div class="input-group-append">
                            @php
                            $isActive = ucfirst($cage->active_phase['name']) != '-';
                            $isBreeding = ucfirst($cage->active_phase['name']) == 'Breeding';
                            $idFase = ucfirst($cage->active_phase['id']);
                            @endphp
                            <a class="btn btn-outline-secondary"
                                href="{{ $isActive ? $isBreeding ?  route('breeding.show', ['id' => $idFase]) : route('fattening.show', ['id' => $idFase]) : '#' }}"
                                {{ $isActive ? '' : 'disabled' }}>Detail</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>


    <div class="card shadow mb-4">
        <div class="card-header py-3 d-sm-flex align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-success">Daftar Kategori Pan</h6>
            <a type="button" class="btn btn-success"
                href="{{ url('/kandang/inputPan', ['id' => $cage->cage_id]) }}">Tambah Pan</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTablePan" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kategori Pan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $id = 0;
                        @endphp
                        @foreach ($cage->pan as $key => $value)
                        @php
                        $id++;
                        @endphp
                        <tr>
                            <td>{{ $id }}</td>
                            <td>{{ $value->panDetail->category_name }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <div class="card shadow mb-4">
        <div class="card-header py-3 d-sm-flex align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-success">Riwayat Fase Breeding</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTableWeight" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal Mulai</th>
                            <th>Tanggal Akhir</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $id = 0;
                        @endphp
                        @foreach ($cage->breeding as $key => $value)
                        @php
                        $id++;
                        @endphp
                        <tr>
                            <td>{{ $id }}</td>
                            <td>{{ $value->date_started }}</td>
                            <td>{{ $value->date_ended }}</td>
                            <td class="d-flex justify-content-center">
                                <a href="" class="btn btn-info btn-icon-split mr-2">
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


    <div class="card shadow mb-4">
        <div class="card-header py-3 d-sm-flex align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-success">Riwayat Fase Fattening</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTableWeight" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal Mulai</th>
                            <th>Tanggal Akhir</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $id = 0;
                        @endphp
                        @foreach ($cage->fattening as $key => $value)
                        @php
                        $id++;
                        @endphp
                        <tr>
                            <td>{{ $id }}</td>
                            <td>{{ $value->date_started }}</td>
                            <td>{{ $value->date_ended }}</td>
                            <td class="d-flex justify-content-center">
                                <a href="" class="btn btn-info btn-icon-split mr-2">
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


</div>
<!-- /.container-fluid -->
@endsection

@push('javascript')

<script>
    $(document).ready(function () {
        $('#dataTablePan').DataTable();
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