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
            
          <div class="card">
            <div class="card-header">My IPs</div>
            <div class="card-body">
                
              <table class="table table-hover">
                  <thead>
                    <tr>
                      <th>IP</th>
                      <th>Host name</th>
                      <th>Modified at</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
      
                      <tr>
                          <td>172.22.1.1</td>
                          <td>iseki-alice</td>
                          <td>2020-04-04 23:24:38</td>
                          <td>
                              <a href="#">Edit</a>
                              &nbsp;
                              <a href="#">Delete</a>
                          </td>
                      </tr>
      
                  </tbody>
              </table>

              <div class="row justify-content-end">
                <div class="col-md-2">
                  <button type="button" class="btn btn-primary"  data-toggle="modal" data-target="#addIp">Add New IP</button>
                </div>
              </div>

              <div class="modal fade" id="addIp">
                <div class="modal-dialog">
                  <div class="modal-content">
               
                    <div class="modal-header">
                      <h4 class="modal-title">Add New IP</h4>
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
               
                    <div class="modal-body">
                      
                      <form method="POST" action="#">
                        @csrf

                        <div class="form-group row">
                            <label for="ip-addr" class="col-md-4 col-form-label text-md-right">{{ __('IP address') }}</label>

                            <div class="col-md-6">
                                <input id="ip-addr" type="text" class="form-control @error('ip-addr') is-invalid @enderror" name="ip-addr" value="{{ old('ip-addr') }}" required autocomplete="ip-addr" autofocus>

                                @error('ip-addr')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                          <label for="hostname" class="col-md-4 col-form-label text-md-right">{{ __('Hostname') }}</label>

                          <div class="col-md-6">
                              <input id="hostname" type="text" class="form-control @error('hostname') is-invalid @enderror" name="hostname" value="{{ old('hostname') }}" required autocomplete="hostname">

                              @error('hostname')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror
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
