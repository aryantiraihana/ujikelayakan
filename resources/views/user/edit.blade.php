@extends('layouts.template')


@section('content')
<h3>Edit Data User</h3>
<p><a href="/" style="text-decoration: none"> Home / </a><a href="{{ route('user.home') }}" style="text-decoration: none">Data User</a> / Edit Data User</p>    
<form action="{{ route('user.update', $user['id']) }}" method="POST" class="card p-5 border-0">
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
            <label for="name" class="col-sm-2 col-form-label">Nama</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="name" name="name" value="{{ $user['name'] }}">
            </div>
        </div>
        
        <div class="mb-3 row">
            <label for="email" class="col-sm-2 col-form-label">Email</label>
            <div class="col-sm-10">
                <input type="email" class="form-control" id="email" name="email" value="{{ $user['email'] }}">
            </div>
        </div>

        <div class="mb-3 row">
            <label for="role" class="col-sm-2 col-form-label">Role</label>
            <div class="col-sm-10">
                <select class="form-select" id="role" name="role">
                    <option selected disabled hidden>Pilih</option>
                    <option value="admin" {{ $user['role'] == 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="ps" {{ $user['role'] == 'ps' ? 'selected' : '' }}>PS</option>
                </select>
            </div>
        </div>

        <div class="mb-3 row">
            <label for="password" class="col-sm-2 col-form-label">Ubah Password : </label>
            <div class="col-sm-10">
                <input type="password" class="form-control" id="password" name="password">
            </div>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Ubah Data User</button>

    </form>
@endsection