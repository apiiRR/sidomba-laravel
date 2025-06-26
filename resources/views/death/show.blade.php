@extends('layouts.master')

@push('tambahan')
<!-- Custom styles for this page -->
<link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endpush

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Detail Kematian</h1>
    <p class="mb-4">Berikut rincian untuk data kematian</p>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-success">Detail Data</h6>
        </div>
        <div class="card-body">
            <form>
                <div class="mb-3">
                    <label>Date</label>
                    <input class="form-control" type="text" value="{{$death->date}}" readonly>
                </div>
                <div class="mb-3">
                    <label>Tag Number</label>
                    <div class="input-group">
                        <input class="form-control" type="text" value="{{$death->sheep->tag_number ?? '-'}}" readonly>
                        <div class="input-group-append">
                            <a class="btn btn-outline-secondary" type="button" id="button-addon2"
                                href="{{ route('domba.show', ['id' => $death->sheep->sheep_id]) }}">Detail</a>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label>Penyebab</label>
                    <input class="form-control" type="text" value="{{$death->cause}}" readonly>
                </div>
            </form>
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