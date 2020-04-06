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
            
            <table class="table table-hover">
                <thead>
                  <tr>
                    <th>IP</th>
                    <th>Host name</th>
                    <th>Using by</th>
                    <th>of Lab.</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>

                    <tr>
                        <td>172.22.1.TEMP</td>
                        <td>iseki-alice</td>
                        <td>
                            iseki
                            <span class="badge badge-secondary">Teacher</span>
                        </td>
                        <td>Iseki</td>
                        <td>
                            <a href="#">Edit</a>
                        </td>
                    </tr>
                    

                    @for ($i = 1; $i <= 255; $i++)
                    <tr>
                        <td>172.22.1.{{$i}}</td>
                        <td>ntkys-01</td>
                        <td>
                            j19478sr 
                            <span></span>
                        </td>
                        <td>Moriguchi</td>
                        <td>
                            <a href="#">Edit</a>
                        </td>
                      </tr>
                    @endfor

                </tbody>
            </table>
            
        </div>




    </div>




</div>
@endsection
