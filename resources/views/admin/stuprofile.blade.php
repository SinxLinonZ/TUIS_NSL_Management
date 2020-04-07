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
          <h3>Profile of {{ $p_user->name }}</h3>

            <div class="row mb-4">
                
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">Student Info</div>
                        <div class="card-body">

                          <form method="POST" action="/admin/stum/profile/update">
                            @csrf
    
                            <div class="form-group row">
                              <label for="name" class="col-md-3 offset-1 col-form-label text-md-left">{{ __('Name') }}</label>
                              <div class="col-md-6">
                                  <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') ?? $p_user->name }}" required autocomplete="name" autofocus>
                                  @error('name')
                                      <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </div>
                          </div>

                          <div class="form-group row">
                            <label for="tuisid" class="col-md-3 offset-1 col-form-label text-md-left">{{ __('TUIS ID') }}</label>
                            <div class="col-md-6">
                                <input id="tuisid" type="text" class="form-control @error('tuisid') is-invalid @enderror" name="tuisid" value="{{ old('tuisid') ?? $p_user->tuisid }}" required autocomplete="tuisid" autofocus>
                                @error('tuisid')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="form-group row">
                          <label for="role" class="col-md-3 offset-1 col-form-label text-md-left">{{ __('Role') }}</label>
                          <div class="col-md-6">
                            <select class="form-control" id="role" name="role" required>
                              @foreach ($roles as $role)
                                @if ($p_user->role->role_name == $role->role_name)
                                  <option selected>{{$role->role_name}}</option>
                                @else
                                  <option>{{$role->role_name}}</option>
                                  @endif
                                @endforeach
                            </select>
                            @error('role')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror
                          </div>
                        </div>

                        <div class="form-group row">
                          <label for="lab" class="col-md-3 offset-1 col-form-label text-md-left">{{ __('Lab') }}</label>
                          <div class="col-md-6">
                              <select class="form-control" id="lab" name="lab" required>
                                @foreach ($labs as $lab)
                                  @if ($p_user->lab->lab_name == $lab->lab_name)
                                    <option selected>{{$lab->lab_name}}</option>
                                  @else
                                    <option>{{$lab->lab_name}}</option>
                                    @endif
                                  @endforeach
                              </select>
                              @error('lab')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror
                          </div>
                        </div>


                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Save') }}
                                    </button>
                                </div>
                            </div>
                        </form>

                        @error('admin_stuprofile_success')
                        <div class="alert alert-success mt-4">
                          <h6>{{ $message }}</h6>
                        </div>
                        @enderror
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">Hosts/IPs</div>

                        <div class="card-body">
                            
                            <h4 class="mb-3">
                                {{ $p_user->name }} have 
                                    <strong>{{ $p_user->ips()->count() }}</strong>
                                host(s)/IP(s)
                            </h4>

                            <table class="table table-hover">
                              <thead>
                                <tr>
                                  <th>Address</th>
                                  <th>Hostname</th>
                                  <th>Leased At</th>
                                </tr>
                              </thead>
                              <tbody>
                                @foreach ($p_user->ips as $ip)
                                <tr>
                                  <td>{{ $ip->address }}</td>
                                  <td>{{ $ip->hostname }}</td>
                                  <td>{{ $ip->updated_at }}</td>
                                </tr>
                                @endforeach
                              </tbody>
                            </table>
                            
                            <div class="row justify-content-end">
                              <div class="col-md-3">
                                <button type="button" class="btn btn-primary"  data-toggle="modal" data-target="#addIp">Add New IP</button>
                              </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>




    </div>






    
    <!-- Add IP Modal -->
    <div class="modal fade" id="addIp">
      <div class="modal-dialog">
        <div class="modal-content">
     

          <div class="modal-header">
            <h4 class="modal-title">Add New IP</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
     
          <div class="modal-body">

            <form method="POST" action="/admin/stum/profile/add">
              @csrf

              <input id="name" type="hidden" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $p_user->name }}" required autocomplete="name" autofocus>

                <div class="form-group row">
                <label for="ip-addr" class="col-md-4 col-form-label text-md-right">{{ __('IP address') }}</label>

                <div class="col-md-6">
                    <input id="ip-addr" type="text" class="form-control @error('ip-addr') is-invalid @enderror" name="ip-addr" value="{{ old('ip-addr') }}" required autocomplete="ip-addr" autofocus>

                    @error('ip-addr')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        <sessionerr err="ip-addr"></sessionerr>
                    @enderror
                </div>
            </div>

              <div class="form-group row">
                <label for="hostname" class="col-md-4 col-form-label text-md-right">{{ __('Hostname') }}</label>

                <div class="col-md-6">
                    <input id="hostname" type="text" class="form-control @error('hostname') is-invalid @enderror" name="hostname" value="{{ old('hostname') }}" autocomplete="hostname">

                    @error('hostname')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
              </div>

              <div class="form-group row">
                <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Description') }}</label>

                <div class="col-md-6">
                    <input id="description" type="text" class="form-control @error('description') is-invalid @enderror" name="description" value="{{ old('description') }}" autocomplete="description">
                </div>
              </div>

              <div class="form-group row mb-0">
                  <div class="col-md-2 offset-md-5">
                      <button type="submit" class="btn btn-primary">
                          {{ __('Add') }}
                      </button>

                  </div>
              </div>
          </form>
          @error('ip-registered')
            <div class="alert alert-danger mt-4">
              <h6>{{ $message }}</h6>
              <sessionerr err="ip-registered"></sessionerr>
            </div>
          @enderror
          </div>
     
        </div>
      </div>
    </div>


</div>
@endsection
