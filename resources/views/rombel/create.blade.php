@extends('layouts.template')

@section('content')
<h3>Tambah Data Rombel</h3>
<p><a href="/" style="text-decoration: none"> Home / </a><a href="{{ route('rombel.home') }}" style="text-decoration: none">Data Rombel</a> / Tambah Data Rombel</p>    

    <form action="{{ route('rombel.store') }}" method="POST" class="card p-5 shadow p-3 mb-5 bg-body rounded border-0">
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
            <label for="rombel" class="col-sm-2 col-form-label">Rombel</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="rombel" name="rombel">
            </div>
        </div>        
        
        <button type="submit" class="btn btn-primary mt-3 btn-sm" style="width: 150px;">Tambah</button>
    </form>
@endsection