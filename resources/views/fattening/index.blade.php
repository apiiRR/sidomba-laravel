@extends('layouts.master')

@push('tambahan')
<!-- Custom styles for this page -->
<link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endpush

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-2 text-gray-800">Fattening</h1>
    <a href="" target="#" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"><i
        class="fas fa-download fa-sm text-white-50"></i> Export Excel</a>
  </div>
  <p class="mb-4">Berikut ini adalah data fase fattening yang sedang atau telah berlangsung di masing-masing kandang.
    Setiap entri mencakup informasi mengenai kandang, periode fattening, dan daftar domba yang terlibat dalam fase
    tersebut.</p>

  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3 d-sm-flex align-items-center justify-content-between">
      <h6 class="m-0 font-weight-bold text-success">Data Fattening</h6>
      <a type="button" class="btn btn-success" href="{{ url('/fattening/input') }}">Tambah Fattening</a>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>No</th>
              <th>Kandang</th>
              <th>Tanggal Mulai</th>
              <th>Tanggal Akhir</th>
              <th>Action</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th>No</th>
              <th>Kandang</th>
              <th>Tanggal Mulai</th>
              <th>Tanggal Akhir</th>
              <th>Action</th>
            </tr>
          </tfoot>
          <tbody>
            @php
            $id = 0;
            @endphp
            @foreach ($fattening as $key => $value)
            @php
            $id++;
            @endphp
            <tr>
              <td>{{ $id }}</td>
              <td>{{ $value->cage->mitra_name }} @if ($value->is_active == false)
                <span class="badge badge-secondary">Inactive</span>
                @endif
              </td>
              <td>{{ $value->date_started }}</td>
              <td>{{ $value->date_ended }}</td>
              <td class="d-flex justify-content-center">
                <a href="{{ route('fattening.show', ['id' => $value->fattening_id]) }}"
                  class="btn btn-info btn-icon-split mr-2">
                  <span class="icon text-white-50">
                    <i class="fas fa-solid fa-info text-white"></i>
                  </span>
                </a>
                <form id="delete" action="{{ route('fattening.destroy', $value->fattening_id) }}" method="POST">
                  @csrf
                  @method('DELETE')
                  <button onclick="if (confirm('Apakah kamu yakin untuk menghapus data ini?.') == false) {
                      return false;
                  }" type="submit" class="btn btn-danger"><i class="fas fa-trash text-white"></i></button>
                </form>
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

<!-- Page level plugins -->
<script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

<!-- Page level custom scripts -->
<script src="{{ asset('js/demo/datatables-demo.js') }}"></script>

@endpush