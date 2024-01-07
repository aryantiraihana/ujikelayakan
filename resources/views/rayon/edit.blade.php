@extends('layouts.template')

@section('content')
    
    <h3>Edit Data Rayon</h3>
    <p><a href="/" style="text-decoration: none"> Home / </a><a href="{{ route('rayon.home') }}" style="text-decoration: none">Data Rayon</a> / Edit Data Rayon</p>    

    <form action="{{ route('rayon.update', $rayon['id']) }}" method="POST" class="card p-5">
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
            <label for="rayon" class="col-sm-2 col-form-label">Rayon</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="rayon" name="rayon" value="{{ $rayon['rayon'] }}">
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
    
        <button type="submit" class="btn btn-primary mt-3">Ubah Rombel</button>

    </form>
@endsection