@extends('layouts.template')

@section('content')
    <h3>Data Siswa</h3>
    <p><a href="/" style="text-decoration: none"> Home / </a><a href="{{ route('students.home') }}" style="text-decoration: none">Data Siswa</a> / Edit Data Siswa</p>    


    <form action="{{ route('students.update', $students['id']) }}" method="POST" class="card p-5">
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
            <label for="nis" class="col-sm-2 col-form-label">NIS</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="nis" name="nis" value="{{ $students['nis'] }}">
            </div>
        </div>

        <div class="mb-3 row">
            <label for="name" class="col-sm-2 col-form-label">Nama</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="name" name="name" value="{{ $students['name'] }}">
            </div>
        </div>

        <div class="form-group">
            <label for="rombel" class="col-sm-2 col-form-label">Rombel</label>
            <div class="col-sm-10">
                <select class="form-select" id="rombel" name="rombel_id">
                    @foreach ($rombel as $item)
                        <option selected disabled hidden>Pilih</option>
                        <option value="{{ $item->id }}">{{ $item->rombel}}</option>  
                    @endforeach                  
                </select>
            </div>
        </div>

        <div class="form-group">
            <label for="rayon" class="col-sm-2 col-form-label">Rayon</label>
            <div class="col-sm-10">
                <select class="form-select" id="rayon" name="rayon_id">
                    @foreach ($rayon as $item)
                        <option selected disabled hidden>Pilih</option>
                        <option value="{{ $item->id }}">{{ $item->rayon}}</option>  
                    @endforeach                  
                </select>
            </div>
        </div>
    
        <button type="submit" class="btn btn-primary mt-3">Ubah Data Siswa</button>

    </form>
@endsection