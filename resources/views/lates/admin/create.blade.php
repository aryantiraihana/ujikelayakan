@extends('layouts.template')

@section('content')

    <h3>Tambah Data Keterlambatan</h3>
    <p><a href="/" style="text-decoration: none"> Home / </a><a href="{{ route('lates.home') }}" style="text-decoration: none">Data Keterlambatan</a> / Tambah Data Keterlambatan</p>    

    <form action="{{ route('lates.store') }}" method="POST" class="card p-5 shadow p-3 mb-5 bg-body rounded border-0" enctype="multipart/form-data">
        @csrf

        @if(Session::get('success'))
            <div class="alert alert-success"> {{ Session::get('success') }} </div>
        @endif

        @if ($errors->any())
            <ul class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <li> {{ $error }} </li>
                @endforeach
            </ul>
        @endif

        <div class="form-group">
            <label for="name" class="col-sm-2 col-form-label">Siswa</label>            
            {{-- <input type="text" class="form-control is-invalid" id="validationServer03" name="name" required>   --}}
            <select class="form-select" id="name" name="student_id">
                @foreach ($students as $item)
                    <option selected disabled hidden>Pilih</option>
                    <option value="{{ $item->id }}">{{ $item->name}}</option>                          
                @endforeach                  
            </select>            
            <div class="invalid-feedback">
                Siswa harus diisi!
            </div>
        </div>

        <div class="form-group">
            <label for="time" class="col-sm-2 col-form-label">Tanggal</label>
            <div class="col-sm-10">
                <input type="datetime-local" class="form-control" id="time" name="date_time_late">
            </div>
        </div>

        <div class="form-group">
            <label for="information" class="col-sm-2 col-form-label">Keterangan Keterlambatan</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="information" name="information">
            </div>
        </div>

        <div class="form-group">
            <label for="bukti" class="col-sm-2 col-form-label">Bukti</label>
            <div class="col-sm-10">
                <input type="file" class="form-control" id="bukti" name="bukti">
            </div>
        </div>

        {{-- <div class="form-group">
            <label for="text" class="col-sm-2 col-form-label">Keterangan Keterlambatan</label>            
            <textarea type="text" class="form-control is-invalid" id="validationServer03" name="text" required></textarea>          
            <div class="invalid-feedback">
                Keterangan keterlambatan harus diisi!
            </div>
        </div>

        <div class="form-group">
            <label for="exampleFormControlFile1" class="col-sm-2 col-form-label">Bukti</label>
            <input type="file" class="form-control is-invalid" id="validationServer03" name="file" required>        
            <div class="invalid-feedback">
                Bukti harus diupload!
            </div>
        </div> --}}

        {{-- <div class="form-group">
            <label for="role" class="col-sm-2 col-form-label">Role</label>
            <div class="col-sm-10">
                <select class="form-select" id="role" name="role">
                    <option selected disabled hidden>Pilih</option>
                    <option value="admin">Administrator</option>
                    <option value="ps">PS</option>
                </select>
            </div>
        </div> --}}
        
        <button type="submit" class="btn btn-primary mt-3 btn-sm" style="width: 200px;">Tambah</button>
    </form>
@endsection