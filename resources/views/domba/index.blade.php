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
    <h1 class="h3 mb-2 text-gray-800">Domba</h1>
    <a href="/product_excel" target="_blank" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"><i
        class="fas fa-download fa-sm text-white-50"></i> Export Excel</a>
  </div>
  <p class="mb-4">Berikut ini adalah data domba yang memuat informasi lengkap mengenai biodata domba, catatan berat
    badan (weight record), dan riwayat penyakit (disease record)</p>

  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3 d-sm-flex align-items-center justify-content-between">
      <h6 class="m-0 font-weight-bold text-success">Data Domba</h6>
      <a type="button" class="btn btn-success" href="{{ url('/domba/input') }}">Tambah Domba</a>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>Nomor Tag</th>
              <th>Ras</th>
              <th>Gender</th>
              <th>Usia</th>
              <th>Action</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th>Nomor Tag</th>
              <th>Ras</th>
              <th>Gender</th>
              <th>Usia</th>
              <th>Action</th>
            </tr>
          </tfoot>
          <tbody>
            @foreach ($sheep as $key => $value)
            <tr>
              <td>{{ $value->tag_number }} @if ($value->death)
                <span class="badge badge-danger">Death</span>
                @endif
              </td>
              <td>{{ $value->name }}</td>
              <td>{{ $value->gender }}</td>
              <td>{{ $value->age }}
              </td>
              <td class="d-flex justify-content-center">
                <a href="{{ route('domba.show', ['id' => $value->sheep_id]) }}"
                  class="btn btn-info btn-icon-split mr-2">
                  <span class="icon text-white-50">
                    <i class="fas fa-solid fa-info text-white"></i>
                  </span>
                </a>
                <a href="{{ route('domba.destroy', ['id' => $value->sheep_id]) }}"
                  class="btn btn-danger btn-icon-split mr-2" data-confirm-delete="true">
                  <span class="icon text-white-50">
                    <i class="fas fa-trash text-white"></i>
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

<!-- Page level plugins -->
<script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

<!-- Page level custom scripts -->
<script src="{{ asset('js/demo/datatables-demo.js') }}"></script>

@endpush