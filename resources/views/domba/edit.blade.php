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
            <form action="{{route('domba.update', $sheep->sheep_id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label id="tag_number">Tag Number<span class="text-danger">*</span></label>
                    <input class="form-control" type="text" id="tag_number" name="tag_number" placeholder="A12345"
                        value="{{ $sheep->tag_number}}" required>
                </div>
                <div class="mb-3">
                    <label id="nama">Ras<span class="text-danger">*</span></label>
                    <input class="form-control" type="text" id="nama" name="nama" placeholder="Domba Shaun The Sheep"
                        value="{{ $sheep->name}}" required>
                </div>
                <div class="mb-3">
                    <label id="gender">Gender<span class="text-danger">*</span></label>
                    <select class="form-control" name="gender" required>
                        <option value="">---</option>
                        <option value="Jantan" {{ $sheep->gender == 'Jantan' ? 'selected' : '' }}>Jantan</option>
                        <option value="Betina" {{ $sheep->gender == 'Betina' ? 'selected' : '' }}>Betina</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label id="birth_date">Tanggal Lahir<span class="text-danger">*</span></label>
                    <input class="form-control" type="date" id="birth_date" name="birth_date"
                        value="{{ $sheep->birth_date}}" required>
                </div>
                <div class="mb-3">
                    <label for="father_id">Induk Jantan</label>
                    <select class="form-control" id="father_id" name="father_id">
                        <option value="">---</option>
                        @foreach ($allSheep as $sheepOption)
                        <option value="{{ $sheepOption->sheep_id }}" {{ optional($sheep->father)->sheep_id ===
                            $sheepOption->sheep_id ? 'selected' : '' }}>
                            {{ $sheepOption->tag_number }} - {{ $sheepOption->name }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="mother_id">Induk Betina</label>
                    <select class="form-control" id="mother_id" name="mother_id">
                        <option value="">---</option>
                        @foreach ($allSheep as $sheepOption)
                        <option value="{{ $sheepOption->sheep_id }}" {{ optional($sheep->mother)->sheep_id ===
                            $sheepOption->sheep_id ? 'selected' : '' }}>
                            {{ $sheepOption->tag_number }} - {{ $sheepOption->name }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="image">Foto Domba</label>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="image" name="image">
                        <label class="custom-file-label" for="image">Choose file...</label>
                    </div>
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

<script>
    document.getElementById('image').addEventListener('change', function(e) {
        const fileName = e.target.files[0]?.name;
        if (fileName) {
            e.target.nextElementSibling.innerText = fileName;
        }
    });
</script>

@endpush