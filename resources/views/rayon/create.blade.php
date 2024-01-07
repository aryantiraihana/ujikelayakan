@extends('layouts.template')

@section('content')
<h3>Tambah Data Rayon</h3>
<p><a href="/" style="text-decoration: none"> Home / </a><a href="{{ route('rayon.home') }}" style="text-decoration: none">Data Rayon</a> / Tambah Data Rayon</p>    

    <form action="{{ route('rayon.store') }}" method="POST" class="card p-5 shadow p-3 mb-5 bg-body rounded border-0">
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
            <label for="rayon" class="col-sm-2 col-form-label">Rayon</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="rayon" name="rayon">
            </div>
        </div>

        <div class="form-group">
            <label for="user" class="col-sm-2 col-form-label">Pembimbing Siswa</label>
            <div class="col-sm-10">
                <select class="form-select" id="role" name="user_id">
                    @foreach ($user as $user_ps)
                    @if ($user_ps->role == 'ps')
                        <option selected disabled hidden>Pilih</option>
                        <option value="{{ $user_ps->id }}">{{ $user_ps->name}}</option>  
                    @endif
                    @endforeach                  
                </select>
            </div>
        </div>
        
        <button type="submit" class="btn btn-primary mt-3 btn-sm" style="width: 150px;">Tambah</button>
    </form>
@endsection