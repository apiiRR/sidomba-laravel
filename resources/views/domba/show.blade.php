@extends('layouts.master')

@push('tambahan')
<!-- Custom styles for this page -->
<link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endpush

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Detail Domba</h1>
    <p class="mb-4">Berikut rincian untuk data domba : {{$sheep->tag_number}}</p>

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-sm-flex align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-success">Detail Data</h6>
            @if ($sheep->death == false)
            <a type="button" class="btn btn-secondary" href="{{ route('domba.edit', ['id' => $sheep->sheep_id]) }}">
                <span class="icon text-white-50">
                    <i class="fas fa-pencil-alt text-white"></i>
                </span> Ubah Data</a>
            @endif
        </div>
        <div class="card-body">
            <form>
                <div class="mb-3">
                    <label>Nomor Tag</label>
                    <input class="form-control" type="text" value="{{$sheep->tag_number}}" readonly>
                </div>
                <div class="mb-3">
                    <label>Ras</label>
                    <input class="form-control" type="text" value="{{$sheep->name}}" readonly>
                </div>
                <div class="mb-3">
                    <label>Gender</label>
                    <input class="form-control" type="text" value="{{$sheep->gender}}" readonly>
                </div>
                <div class="mb-3">
                    <label>Usia</label>
                    <input class="form-control" type="text" value="{{$sheep->age}}" readonly>
                </div>
                <div class="mb-3">
                    <label>Father Sheep</label>
                    <div class="input-group">
                        <input class="form-control" type="text" value="{{$sheep->father->tag_number ?? '-'}}" readonly>
                        <div class="input-group-append">
                            <a class="btn btn-outline-secondary" type="button" id="button-addon2" @if ($sheep->father)
                                href="{{ route('domba.show', ['id' => $sheep->father->sheep_id]) }}"
                                @endif >Detail</a>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label>Mother Sheep</label>
                    <div class="input-group">
                        <input class="form-control" type="text" value="{{$sheep->mother->tag_number ?? '-'}}" readonly>
                        <div class="input-group-append">
                            <a class="btn btn-outline-secondary" type="button" id="button-addon2" @if ($sheep->mother)
                                href="{{ route('domba.show', ['id' => $sheep->mother->sheep_id]) }}"
                                @endif >Detail</a>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label>Asal Kebuntingan</label>
                    <div class="input-group">
                        <input class="form-control" type="text"
                            value="{{$sheep->pregnancy_order ? 'Kebuntingan Ke-'.$sheep->pregnancy_order : '-'}}"
                            readonly>
                        <div class="input-group-append">
                            <a class="btn btn-outline-secondary" type="button" id="button-addon2">Detail</a>
                        </div>
                    </div>
                </div>
                @if ($sheep->image != null)
                <div class="mb-3 row">
                    <label class="col-12">Foto Domba</label>
                    <img src="{{ asset('storage/sheep/' . $sheep->image) }}" alt="Foto Domba"
                        style="border: 1px solid #000000; padding:5px; border-radius:10px; max-height:500px; ">
                </div>
                @endif
            </form>
        </div>
    </div>

    @if ($sheep->gender == 'Betina')
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-sm-flex align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-success">Data Kebuntingan</h6>
            @if ($sheep->death == false)
            <a type="button" class="btn btn-success"
                href="{{ url('/domba/inputPregnant', ['id' => $sheep->sheep_id]) }}">Tambah Kebuntingan</a>
            @endif
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTablePregnant" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal Mulai</th>
                            <th>Tanggal Akhir</th>
                            <th>Jumlah Anak</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $id = 0;
                        @endphp
                        @foreach ($sheep->pregnancies as $key => $value)
                        @php
                        $id++;
                        @endphp
                        <tr>
                            <td>{{ $id }}</td>
                            <td>{{ $value->date_started }}</td>
                            <td>{{ $value->date_ended }}</td>
                            <td>{{ $value->children->count() }} Ekor</td>
                            <td class="d-flex justify-content-center">
                                <a href="{{ route('domba.show', ['id' => $value->sheep_id]) }}"
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
    @endif


    <div class="card shadow mb-4">
        <div class="card-header py-3 d-sm-flex align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-success">Riwayat Fase</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTableHistory" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal Mulai</th>
                            <th>Tanggal Akhir</th>
                            <th>Fase</th>
                            <th>Kandang</th>
                            <th>Pan</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $id = 0;
                        @endphp
                        @foreach ($history as $key => $value)
                        @php
                        $id++;
                        @endphp
                        <tr>
                            <td>{{ $id }}</td>
                            <td>{{ $value['date_started'] }} </td>
                            <td>{{ $value['date_ended'] }}</td>
                            <td>{{ $value['phase'] }}</td>
                            <td>{{ $value['cage'] }}</td>
                            <td>{{ $value['pan'] }}</td>
                            <td class="d-flex justify-content-center">
                                @if ($key == 0)
                                <a href="{{ route('domba.inputTransfer', ['id' => $sheep->sheep_id, 'phase_sheep_id' => $value['phase_sheep_id']]) }}"
                                    class="btn btn-info btn-icon-split mr-2">
                                    <span class="icon text-white-50">
                                        <i class="fas fa-exchange-alt text-white"></i> </span>
                                </a>
                                @endif
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
            <h6 class="m-0 font-weight-bold text-success">Fase Anakan</h6>
            @if ($sheep->death == false)
            <a type="button" class="btn btn-success"
                href="{{ url('/domba/inputPhase', ['id' => $sheep->sheep_id]) }}">Tambah Fase</a>
            @endif
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTablePhase" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Fase Anakan</th>
                            <th>Tanggal Mulai</th>
                            <th>Tanggal Akhir</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $id = 0;
                        @endphp
                        @foreach ($sheep->childCategories as $key => $value)
                        @php
                        $id++;
                        @endphp
                        <tr>
                            <td>{{ $id }}</td>
                            <td>{{ $value->childCategory->category_name }}
                                @if ($value->is_active)
                                <span class="badge badge-success">Aktif</span>
                                @endif
                            </td>
                            <td>{{ $value->date_started }}</td>
                            <td>{{ $value->date_ended }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>



    <div class="card shadow mb-4">
        <div class="card-header py-3 d-sm-flex align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-success">Data Berat</h6>
            @if ($sheep->death == false)
            <a type="button" class="btn btn-success"
                href="{{ url('/domba/inputWeight', ['id' => $sheep->sheep_id]) }}">Tambah Berat</a>
            @endif
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTableWeight" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Date</th>
                            <th>Berat</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $id = 0;
                        @endphp
                        @foreach ($sheep->weightRecords as $key => $value)
                        @php
                        $id++;
                        @endphp
                        <tr>
                            <td>{{ $id }}</td>
                            <td>{{ $value->date }}</td>
                            <td>{{ number_format($value->weight) }} Kg</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>




    <div class="card shadow mb-4">
        <div class="card-header py-3 d-sm-flex align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-success">Data Penyakit</h6>
            @if ($sheep->death == false)
            <a type="button" class="btn btn-success"
                href="{{ url('/domba/inputDisease', ['id' => $sheep->sheep_id]) }}">Tambah Penyakit</a>
            @endif
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTableDisease" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Date</th>
                            <th>Penyakit</th>
                            <th>Deskripsi</th>
                            <th>Treatment</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $id = 0;
                        @endphp
                        @foreach ($sheep->diseaseRecords as $key => $value)
                        @php
                        $id++;
                        @endphp
                        <tr>
                            <td>{{ $id }}</td>
                            <td>{{ $value->date }}</td>
                            <td>{{ $value->disease_name }}</td>
                            <td>{{ $value->description }}</td>
                            <td>{{ $value->treatment }}</td>
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
        $('#dataTablePregnant').DataTable();
        $('#dataTableHistory').DataTable();
        $('#dataTablePhase').DataTable();
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