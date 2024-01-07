@extends('layouts.template')

@section('content')
<h3>Tambah Data Siswa</h3>
<p><a href="/" style="text-decoration: none"> Home / </a><a href="{{ route('students.home') }}" style="text-decoration: none">Data Siswa</a> / Tambah Data Siswa</p>    
    <form action="{{ route('students.store') }}" method="POST" class="card p-5 shadow p-3 mb-5 bg-body rounded border-0">
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
            <label for="nis" class="col-sm-2 col-form-label">NIS</label>
            <div class="col-sm-10">
                <input type="number" class="form-control" id="nis" name="nis">
            </div>
        </div>

        <div class="form-group">
            <label for="name" class="col-sm-2 col-form-label">Nama</label>
            <div class="col-sm-10">
                <input type="name" class="form-control" id="name" name="name">
            </div>
        </div>

        <div class="form-group">
            <label for="rombel_id" class="col-sm-2 col-form-label">Rombel</label>
            <div class="col-sm-10">
                <select class="form-select" id="rombel_id" name="rombel_id">
                    @foreach ($rombel as $item)
                        <option selected disabled hidden>Pilih</option>
                        <option value="{{ $item->id }}">{{ $item->rombel}}</option>                          
                    @endforeach                  
                </select>
            </div>
        </div>

        <div class="form-group">
            <label for="rayon_id" class="col-sm-2 col-form-label">Rayon</label>
            <div class="col-sm-10">
                <select class="form-select" id="rayon_id" name="rayon_id">
                    @foreach ($rayon as $item)
                        <option selected disabled hidden>Pilih</option>
                        <option value="{{ $item->id }}">{{ $item->rayon}}</option>                          
                    @endforeach                  
                </select>
            </div>
        </div>       
        
        <button type="submit" class="btn btn-primary mt-3 btn-sm" style="width: 150px;">Tambah Siswa</button>
    </form>
@endsection