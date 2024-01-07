@extends('layouts.template')

@section('content')
    <h3>Data Keterlambatan</h3>
    <p><a href="/" style="text-decoration: none"> Home / </a><a href="{{ route('lates.home') }}" style="text-decoration: none">Data Keterlambatan</a> / Edit Data Keterlambatan</p>    


    <form action="{{ route('lates.update', $lates['id']) }}" method="POST" class="card p-5" enctype="multipart/form-data">
        @csrf
        @method('PATCH')

        @if ($errors->any())
            <ul class="alert alert-danger p-3">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif
        
        <div class="mb-3 row">
            <label for="student_id" class="col-sm-2 col-form-label">Nama</label>
            <div class="col-sm-10">
                <select class="form-select" id="student_id" name="student_id">
                    <option selected disabled hidden>Pilih</option>
                    @foreach ($students as $item)
                        <option value="{{ $item->id }}" {{ $item->id == $lates['student_id'] ? 'selected' : ''}}>{{ $item->name}} - {{ $item->nis }}</option>  
                    @endforeach                  
                </select>
            </div>
        </div>

        <div class="mb-3 row">
            <label for="date_time_late" class="col-sm-2 col-form-label">Tanggal</label>
            <div class="col-sm-10">
                <input type="datetime-local" class="form-control" id="date_time_late" name="date_time_late" value="{{ $lates['date_time_late'] }}">
            </div>
        </div>

        <div class="mb-3 row">
            <label for="information" class="col-sm-2 col-form-label">Informasi</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="information" name="information" value="{{ $lates['information'] }}">
            </div>
        </div>

        <div class="mb-3 row">
            <label for="bukti" class="col-sm-2 col-form-label">Bukti</label>
            <div class="col-sm-10">
                <input type="file" class="form-control" id="bukti" name="bukti" onchange="previewImage(this)">
                <img id="preview" src="{{ asset('img/' . $lates['bukti']) }}" alt="Bukti" style="width: 150px; height:100px; margin-top:10px;"> 
            </div>
        </div>
    
        <button type="submit" class="btn btn-primary mt-3">Ubah Data Keterlambatan</button>

    </form>
@endsection

<script>
    function previewImage(input) {
        var preview = document.getElementById('preview');
        preview.src = URL.createObjectURL(input.files[0]);
        preview.onload = function () {
            URL.revokeObjectURL(this.src);
        };
    }
</script>