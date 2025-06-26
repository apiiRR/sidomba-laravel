@extends('layouts.master')

@push('tambahan')
<!-- Custom styles for this page -->
<link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endpush

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Edit Domba</h1>
    <p class="mb-4">Silahkan ubah data domba berikut</p>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-success">Ubah Data</h6>
        </div>
        <div class="card-body">
            <form action="{{route('domba.update', $sheep->sheep_id)}}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label id="tag_number">Tag Number</label>
                    <input class="form-control" type="text" id="tag_number" name="tag_number" placeholder="A12345"
                        value="{{ $sheep->tag_number}}" required>
                </div>
                <div class="mb-3">
                    <label id="nama">Nama</label>
                    <input class="form-control" type="text" id="nama" name="nama" placeholder="Domba Shaun The Sheep"
                        value="{{ $sheep->name}}" required>
                </div>
                <div class="mb-3">
                    <label id="gender">Gender</label>
                    <select class="form-control" name="gender">
                        <option value="">---</option>
                        <option value="Male" {{ $sheep->gender == 'Male' ? 'selected' : '' }}>Male</option>
                        <option value="Female" {{ $sheep->gender == 'Female' ? 'selected' : '' }}>Female</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label id="birth_date">Tanggal Lahir</label>
                    <input class="form-control" type="date" id="birth_date" name="birth_date"
                        value="{{ $sheep->birth_date}}" required>
                </div>
                <div class="mb-3">
                    <label id="breed">Ras</label>
                    <input class="form-control" type="text" id="breed" name="breed" placeholder="Domba Shaun The Sheep"
                        value="{{ $sheep->breed}}" required>
                </div>
                <div class="mb-3">
                    <label id="father_id">Father</label>
                    <select class="form-control" name="father_id">
                        <option value="">---</option>
                        @foreach ($allSheep as $key => $value)
                        <option value="{{$value->sheep_id}}" {{ $sheep->father->sheep_id == $value->sheep_id ?
                            'selected' : ''}}>{{
                            $value->tag_number }} -
                            {{ $value->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label id="mother_id">Mother</label>
                    <select class="form-control" name="mother_id">
                        <option value="">---</option>
                        @foreach ($allSheep as $key => $value)
                        <option value="{{$value->sheep_id}}" {{ $sheep->mother->sheep_id == $value->sheep_id ?
                            'selected' : ''}}>{{ $value->tag_number }} - {{ $value->name }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="form-control btn btn-success mt-4">Ubah Data</button>
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