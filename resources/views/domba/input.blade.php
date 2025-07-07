@extends('layouts.master')

@push('tambahan')
<!-- Custom styles for this page -->
<link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endpush

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Input Domba Baru</h1>
    <p class="mb-4">Silahkan masukkan data domba baru</p>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-success">Input Data</h6>
        </div>
        <div class="card-body">
            <form action="{{route('domba.store')}}" method="POST">
                @csrf
                <div class="mb-3">
                    <label id="tag_number">Tag Number</label>
                    <input class="form-control" type="text" id="tag_number" name="tag_number" required>
                </div>
                <div class="mb-3">
                    <label id="nama">Nama</label>
                    <input class="form-control" type="text" id="nama" name="nama" required>
                </div>
                <div class="mb-3">
                    <label id="gender">Gender</label>
                    <select class="form-control" name="gender">
                        <option value="">---</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label id="birth_date">Tanggal Lahir</label>
                    <input class="form-control" type="date" id="birth_date" name="birth_date" required>
                </div>
                <div class="mb-3">
                    <label id="father_id">Father</label>
                    <select class="form-control" name="father_id">
                        <option value="">---</option>
                        @foreach ($sheep as $key => $value)
                        <option value="{{$value->sheep_id}}">{{ $value->tag_number }} - {{ $value->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label>Mother</label>
                    <select class="form-control" name="mother_id" id="mother_id">
                        <option value="">---</option>
                        @foreach ($sheep as $key => $value)
                        <option value="{{$value->sheep_id}}">{{ $value->tag_number }} - {{ $value->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3" id="pregnant_container" style="display: none;">
                    <label>Hasil Kehamilan : </label>
                    <select class="form-control" name="pregnant_id" id="pregnant_id">
                        <option value="">---</option>
                    </select>
                </div>

                <button type="submit" class="form-control btn btn-success mt-4">Simpan Data</button>
            </form>
        </div>
    </div>

</div>
<!-- /.container-fluid -->
@endsection

@push('javascript')

<script>
    const pregnantData = @json($pregnant);
    const motherSelect = document.getElementById('mother_id');
    const pregnantSelect = document.getElementById('pregnant_id');
    const pregnantContainer = document.getElementById('pregnant_container');

    motherSelect.addEventListener('change', function () {
        const selectedMotherId = this.value;

        // Kosongkan opsi pregnant
        pregnantSelect.innerHTML = '<option value="">---</option>';

        if (selectedMotherId) {
            // Tampilkan div pregnant
            pregnantContainer.style.display = 'block';

            // Filter data berdasarkan induk
            const filtered = pregnantData.filter(item => item.sheep_id == selectedMotherId);

            // Tampilkan opsi
            filtered.forEach((item, index) => {
                const option = document.createElement('option');
                option.value = item.pregnant_id;
                option.textContent = `Hamil ${index + 1} (${item.date_started} - ${item.date_ended})`;
                pregnantSelect.appendChild(option);
            });
        } else {
            // Sembunyikan jika mother kosong
            pregnantContainer.style.display = 'none';
        }
    });
</script>

<!-- Page level plugins -->
<script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

<!-- Page level custom scripts -->
<script src="{{ asset('js/demo/datatables-demo.js') }}"></script>

@endpush