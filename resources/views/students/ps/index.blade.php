@extends('layouts.template')

@section('content')

    @if(Session::get('success'))
        <div class="alert alert-success"> {{ Session::get('success') }} </div>
    @endif

    @if(Session::get('deleted'))
        <div class="alert alert-warning"> {{ Session::get('deleted') }} </div>
    @endif
    
    <h3>Data Siswa</h3>
    <p><a href="{{ route('home.page') }}" style="text-decoration: none"> Home / </a>Data Siswa</p>


    <br>

    <table class="table">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">NIS</th>
                <th scope="col">Nama</th>
                <th scope="col">Rombel</th>
                <th scope="col">Rayon</th>
            </tr>
        </thead>
        <tbody>
            @php $no = 1; @endphp
            @foreach ($students as $item)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $item['nis'] }}</td>
                    <td>{{ $item['name'] }}</td>
                    <td>{{ isset($item['rombel']) ? $item['rombel']['rombel'] : '-'}}</td>
                    <td>{{ isset($item['rayon']) ? $item['rayon']['rayon'] : '-'}}</td>
                    
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection