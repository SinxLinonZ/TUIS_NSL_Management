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
                    <th>Description</th>
                    <th>Using by</th>
                    <th>of Lab.</th>
                    <th>Modified at</th>
                    @if ($user->role->role_name == 'Admin' || $user->role->role_name == 'Teacher')
                    <th>Action</th>
                    @endif
                  </tr>
                </thead>
                <tbody>

                    @for ($i = 0; $i < 254; $i++)
                    <tr>
                        <td>172.22.1.{{$i+1}}</td>
                        <td id="hostname-{{ $i+1 }}">{{ $ips[$i]->hostname}}</td>
                        <td>{{ $ips[$i]->description }}</td>
                        <td>
                            {{ $ips[$i]->user['name'] }}

                            @if ( $ips[$i]->user['role']['role_name'] == 'Admin' || $ips[$i]->user['role']['role_name'] == "Teacher")
                                <span class="badge badge-secondary"> {{ $ips[$i]->user['role']['role_name'] }} </span>
                            @endif

                        </td>
                        <td>{{ $ips[$i]->user['lab']['lab_name'] }}</td>
                        @if ($ips[$i]->user['name'])
                        <td>{{ $ips[$i]->updated_at }}</td>
                        @else
                        <td></td>
                        @endif
                        
                        @if ($user->role->role_name == 'Admin' || $user->role->role_name == 'Teacher')
                        <td>
                          <nsledit
                          tagid="{{$i+1}}"></nsledit>
                        </td>
                        @endif
                        
                      </tr>
                    @endfor

                </tbody>
            </table>
            
            @if ($user->role->role_name == 'Admin' || $user->role->role_name == 'Teacher')
            <!-- Delete IP Modal -->
            <div class="modal fade" id="delIp">
              <div class="modal-dialog">
                <div class="modal-content">
             

                  <div class="modal-header">
                    <h4 class="modal-title">Delete IP</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                  </div>
             
                  <div class="modal-body">
                    <h5 style="text-align: center">Register to stop using this IP?</h5>

                    <form method="POST" action="/home/nsl/del">
                      @csrf

                      <input class="mb-4" style="display:block; margin: auto; text-align:center;" id="del-ip" type="text" value="" name="del-ip" readonly>


                        <button style="display:block; margin: auto" type="submit" class="btn btn-danger">
                            {{ __('Delete') }}
                        </button>

                    </form>

                  </div>
             
                </div>
              </div>
          </div>
          <!-- End of Delete IP Modal -->
          

          
          <!-- Edit IP Modal -->
          <div class="modal fade" id="editIp">
            <div class="modal-dialog">
              <div class="modal-content">
           

                <div class="modal-header">
                  <h4 class="modal-title">Edit IP</h4>
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
           
                <div class="modal-body">

                  <form method="POST" action="/home/nsl/edit">
                    @csrf

                    <div class="form-group row">
                        <label for="edit-ip" class="col-md-4 col-form-label text-md-right">{{ __('IP address') }}</label>

                        <div class="col-md-6">
                            <input id="edit-ip" type="text" class="form-control @error('edit-ip') is-invalid @enderror" name="edit-ip" value="{{ old('edit-ip') }}" required readonly>

                            @error('edit-ip')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                <sessionerr err="edit-ip"></sessionerr>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                      <label for="edit-hostname" class="col-md-4 col-form-label text-md-right">{{ __('Hostname') }}</label>

                      <div class="col-md-6">
                          <input id="edit-hostname" type="text" class="form-control @error('edit-hostname') is-invalid @enderror" name="edit-hostname" value="{{ old('edit-hostname') }}" required autocomplete="edit-hostname" autofocus>

                          @error('edit-hostname')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror
                      </div>
                    </div>

                    <div class="form-group row">
                        <label for="edit-usingUser" class="col-md-4 col-form-label text-md-right">{{ __('Using by') }}</label>
  
                        <div class="col-md-6">
                            <!--<input id="edit-usingUser" type="text" class="form-control @error('edit-usingUser') is-invalid @enderror" name="edit-usingUser" value="{{ old('edit-usingUser') }}" required autocomplete="edit-usingUser" autofocus>-->
                            <select class="form-control" id="edit-usingUser" name="edit-usingUser">
                                
                              @foreach ($all_user as $available_user)
                              @if ($available_user->lab_id == $user->lab_id &&
                                   $available_user->role->role_name != 'Admin')
                                <option>{{$available_user->name}}</option>
                              @elseif ($user->role->role_name == 'Admin')
                              <option>{{$available_user->name}}</option>
                              @endif
                              @endforeach
                              
                              </select>
                            @error('edit-usingUser')
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
                                {{ __('Save') }}
                            </button>

                        </div>
                    </div>
                </form>
                </div>
           
              </div>
            </div>
          </div>
          <!-- End of Edit IP Modal -->
          @endif
          



        </div>




    </div>




</div>
@endsection
