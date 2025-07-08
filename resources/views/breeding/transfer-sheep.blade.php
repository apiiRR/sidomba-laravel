@extends('layouts.master')

@push('tambahan')
<!-- Custom styles for this page -->
<link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endpush

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Transfer Domba</h1>
    <p class="mb-4">Silahkan pilih data pan breeding berikut :</p>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-success">Input Data</h6>
        </div>
        <div class="card-body">
            <form action="{{route('breeding.updateTransferSheep', $breedingSheep->breeding_sheep_id)}}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label id="tag_number">Nomor Tag</label>
                    <input class="form-control" type="text" id="tag_number" name="tag_number"
                        value="{{ $breedingSheep->sheep->tag_number }}" readonly>
                    <input class="form-control" type="text" id="breeding_pan_id_old" name="breeding_pan_id_old"
                        value="{{ $breedingSheep->breeding_pan_id }}" readonly hidden>
                </div>
                <div class="mb-3">
                    <label id="name">Nama Domba</label>
                    <input class="form-control" type="text" id="name" name="name"
                        value="{{ $breedingSheep->sheep->name }}" readonly>
                </div>
                <div class="mb-3">
                    <label id="breeding_pan_id">Kategori Pan</label>
                    <select class="form-control" name="breeding_pan_id">
                        <option value="">---</option>
                        @foreach ($breedingPan as $key => $value)
                        <option value="{{$value->breeding_pan_id}}" {{ $breedingSheep->breeding_pan_id ==
                            $value->breeding_pan_id ?
                            'disabled' : ''}}>{{ $value->panCategory->category_name
                            }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="form-control btn btn-success mt-4">Transfer Data</button>
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