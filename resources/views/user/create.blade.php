@extends('layouts.template')

@section('content')
<h3>Tambah Data User</h3>
<p><a href="/" style="text-decoration: none"> Home / </a><a href="{{ route('user.home') }}" style="text-decoration: none">Data User</a> / Tambah Data User</p>    
    <form action="{{ route('user.store') }}" method="POST" class="card p-5 shadow p-3 mb-5 bg-body rounded border-0">
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
            <label for="name" class="col-sm-2 col-form-label">Nama</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="name" name="name">
            </div>
        </div>

        <div class="form-group">
            <label for="email" class="col-sm-2 col-form-label">Email</label>
            <div class="col-sm-10">
                <input type="email" class="form-control" id="email" name="email">
            </div>
        </div>

        <div class="form-group">
            <label for="role" class="col-sm-2 col-form-label">Role</label>
            <div class="col-sm-10">
                <select class="form-select" id="role" name="role">
                    <option selected disabled hidden>Pilih</option>
                    <option value="admin">Administrator</option>
                    <option value="ps">Pembimbing Siswa</option>
                </select>
            </div>
        </div>
        
        <button type="submit" class="btn btn-primary mt-3 btn-sm" style="width: 150px;">Tambah User</button>
    </form>
@endsection