@extends('layouts.template')

@section('content')
    @if (Session::get('alreadyAccess'))
        <div class="alert alert-danger">{{ Session::get('alreadyAccess') }}</div>
    @endif
    <div class="jumbotron py-4 px-5">
        <h3 class="display-5">
            Selamat Datang {{ Auth::user()->name }} !
        </h3>
        <p><a href="/" style="text-decoration: none"> Home</a> / Dashboard</p>

        <div class="row">      
            @if (Auth::check())
            @if (Auth::user()->role == 'admin')
            <div class="card m-3 shadow p-3 mb-5 bg-body rounded border-0" style="width: 25rem;">
                <div class="card-body">
                <h5 class="card-title">Peserta Didik</h5>
                <br>
                <p class="card-text" style="font-size: 1.3rem;"><i class="fi fi-sr-user" style="margin-right:10px;"></i>{{ App\Models\Students::count() }}</p>                
                </div>
            </div>

            <div class="card m-3 shadow p-3 mb-5 bg-body rounded border-0" style="width: 15rem;">
                <div class="card-body">
                <h5 class="card-title">Administrator</h5>
                <br>
                <p class="card-text" style="font-size: 1.3rem;"><i class="fi fi-sr-user" style="margin-right:10px;"></i>{{ App\Models\User::where('role', '=', 'admin')->count() }}</p>
                </div>
            </div>
            
            <div class="card m-3 shadow p-3 mb-5 bg-body rounded border-0" style="width: 15rem;">
                <div class="card-body">
                <h5 class="card-title">Pembimbing Siswa</h5>
                <img src="" alt="">
                <p class="card-text" style="font-size: 1.3rem;"><i class="fi fi-sr-user" style="margin-right:10px;"></i>{{ App\Models\User::where('role', '=', 'ps')->count() }}</p>
                </div>
            </div>
            <div class="card m-3 shadow p-3 mb-5 bg-body rounded border-0" style="width: 25rem;">
                <div class="card-body">
                <h5 class="card-title">Rombel</h5>
                <img src="" alt="">
                <p class="card-text" style="font-size: 1.3rem;"><i class="fi fi-rr-bookmark" style="margin-right:10px;"></i>{{ App\Models\Rombel::count() }}</p>
                </div>
            </div>
            <div class="card m-3 shadow p-3 mb-5 bg-body rounded border-0" style="width: 30rem;">
                <div class="card-body">
                <h5 class="card-title">Rayon</h5>
                <img src="" alt="">
                <p class="card-text" style="font-size: 1.3rem;"><i class="fi fi-rr-bookmark" style="margin-right:10px;"></i>{{ App\Models\Rayon::count() }}</p>
                </div>
            </div>
            @elseif (Auth::user()->role == 'ps')
            <div class="card m-3 shadow p-3 mb-5 bg-body rounded border-0" style="width: 25rem;">
                <div class="card-body">
                <h5 class="card-title">Peserta Didik Rayon Ciawi 3{{-- $userRayon->rayon --}}</h5>
                <br>
                <p class="card-text" style="font-size: 1.3rem;"><i class="fi fi-sr-user" style="margin-right:10px;"></i>2{{-- $rayonStudentCount --}}</p>                
                </div>
            </div>
            <div class="card m-3 shadow p-3 mb-5 bg-body rounded border-0" style="width: 25rem;">
                <div class="card-body">
                <h5 class="card-title">Keterlambatan Ciawi 3 Hari Ini</h5>
                <br>
                <p>7 Januari 2024</p>
                <p class="card-text" style="font-size: 1.3rem;"><i class="fi fi-sr-user" style="margin-right:10px;"></i>2{{-- App\Models\Students::count() --}}</p>                
                </div>
            </div>
            @else
            <div></div>
            @endif
            @endif
        </div>
    </div>
@endsection

