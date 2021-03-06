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
            <div class="card-header">My Profile</div>
            <div class="card-body">
                
              <div class="row align-baseline">
                <div class="col-md-2 offset-2">
                  <h4>Name:</h4>
                </div>
                <div class="col-md-6">
                  <h4>{{ $user->name }}</h4>
                </div>
              </div>

              <div class="row">
                <div class="col-md-2 offset-2">
                  <h4>TUIS ID:</h4>
                </div>
                <div class="col-md-6">
                  <h4>{{ $user->tuisid }}</h4>
                </div>
              </div>

              <div class="row">
                <div class="col-md-2 offset-2">
                  <h4>Role:</h4>
                </div>
                <div class="col-md-6">
                  <h4>{{ $user->role->role_name }}</h4>
                </div>
              </div>

              <div class="row">
                <div class="col-md-2 offset-2">
                  <h4>Lab:</h4>
                </div>
                <div class="col-md-6">
                  <h4>{{ $user->lab->lab_name }}</h4>
                </div>
              </div>

              <div class="row justify-content-end">
                <div class="col-md-1">
                  <button type="button" class="btn btn-primary"  data-toggle="modal" data-target="#editProfile">Edit</button>
                </div>
              </div>


              <!-- Edit Profile Modal -->
              <div class="modal fade" id="editProfile">
                <div class="modal-dialog">
                  <div class="modal-content">
               
                    <div class="modal-header">
                      <h4 class="modal-title">Edit Profile</h4>
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
               
                    <div class="modal-body">

                      <form method="POST" action="/home/profile">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') ?? $user->name }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                          <label for="tuisid" class="col-md-4 col-form-label text-md-right">{{ __('TUIS ID') }}</label>

                          <div class="col-md-6">
                              <input id="tuisid" type="text" class="form-control @error('tuisid') is-invalid @enderror" name="tuisid" value="{{ old('tuisid') ?? $user->tuisid }}" required autocomplete="tuisid" readonly>

                              @error('tuisid')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror
                          </div>
                        </div>

                        <div class="form-group row">
                          <label for="role" class="col-md-4 col-form-label text-md-right">{{ __('Role') }}</label>

                          <div class="col-md-6">
                              <input id="role" type="text" class="form-control @error('role') is-invalid @enderror" name="role" value="{{ old('role') ?? $user->role->role_name }}" required autocomplete="role" readonly>
                            
                              @error('role')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror
                          </div>
                        </div>

                        <div class="form-group row">
                          <label for="lab" class="col-md-4 col-form-label text-md-right">{{ __('Lab') }}</label>

                          <div class="col-md-6">
                            <select class="form-control" id="lab">
                                <option readonly>{{ $user->lab->lab_name }}</option>
                            </select>

                              @error('lab')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror
                          </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-2 offset-md-5">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Save') }}
                                </button>

                            </div>
                        </div>

                      </form>

                      
                    </div>
               
                  </div>
                </div>
              </div>
              <!-- End of Edit Profile Modal -->
              

            </div>
          </div>
          
        </div>




    </div>




</div>
@endsection
