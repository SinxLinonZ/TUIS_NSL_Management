@extends('layouts.app')

@section('content')
<div class="container-fluid">

    <div class="row">

        <div class="col-md-2">

            <sidenav></sidenav>

                @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
                @endif
        </div>

        <div class="col-md-9">
            <div class="row mb-4">
                
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">Profile</div>
                        <div class="card-body">
                            <div class="d-flex">
                                <h4>
                                    Welcome,
                                    <strong>{{ $user->name }}</strong>
                                    ({{ $user->tuisid }})
                                </h4>
                            </div>
                            <div>
                                <h5>
                                    <strong>{{ $user->role->role_name ?? "Undefined" }} </strong>
                                    of
                                    <strong>{{ $user->lab->lab_name ?? "Undefined" }} Lab</strong>
                                </h5>
                                <hr>
                                <current-time></current-time>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">My Hosts/IPs</div>

                        <div class="card-body">
                            
                            <h4>
                                You have 
                                <a class="text-dark" href="/home/myip">
                                    <strong>{{ $user->IPs()->count() }}</strong>
                                </a> 
                                host(s)/IP(s)
                            </h4>
                            <hr>

                            <div class="row">
                                @foreach ($user->IPs as $ip)
                                <div class="col-md-4">
                                    <h5>{{ $ip->address }}</h5>
                                </div>
                                @endforeach
                            </div>

                            
                        </div>
                    </div>
                </div>

            </div>


            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">NSL Overview</div>

                        <div class="card-body">
                            
                            <div class="row">
                                <div class="col-md-8 offset-2 d-flex justify-content-center">

                                    <table class="table table-bordered">
                                        <tbody>
                                            <tr>
                                                @for ($i = 1; $i <= 32; $i++)
                                                <td id=ip-{{$i}}></td>
                                                @endfor
                                            </tr>
                                            <tr>
                                                @for ($i = 33; $i <= 64; $i++)
                                                <td id=ip-{{$i}}></td>
                                                @endfor
                                            </tr>
                                            <tr>
                                                @for ($i = 65; $i <= 96; $i++)
                                                <td id=ip-{{$i}}></td>
                                                @endfor
                                            </tr>
                                            <tr>
                                                @for ($i = 97; $i <= 128; $i++)
                                                <td id=ip-{{$i}}></td>
                                                @endfor
                                            </tr>
                                            <tr>
                                                @for ($i = 129; $i <= 160; $i++)
                                                <td id=ip-{{$i}}></td>
                                                @endfor
                                            </tr>
                                            <tr>
                                                @for ($i = 161; $i <= 192; $i++)
                                                <td id=ip-{{$i}}></td>
                                                @endfor
                                            </tr>
                                            <tr>
                                                @for ($i = 193; $i <= 224; $i++)
                                                <td id=ip-{{$i}}></td>
                                                @endfor
                                            </tr>
                                            <tr>
                                                @for ($i = 225; $i <= 256; $i++)
                                                <td id=ip-{{$i}}></td>
                                                @endfor
                                            </tr>
                                        </tbody>
                                    </table>
                              
                                    <nsloverview 
                                    registeredips="@foreach ($registeredips as $registeredip){{ $registeredip }},@endforeach" 
                                    ipusers="@foreach ($ipUsers as $ipUser){{ $ipUser }},@endforeach">
                                    </nsloverview>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>




    </div>




</div>
@endsection
