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
          <h3>{{ $p_user->name }}のプロフィール</h3>

            <div class="row mb-4">
                
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">学生情報</div>
                        <div class="card-body">

                          <form method="POST" action="/admin/stum/profile/update">
                            @csrf
    
                            <div class="form-group row">
                              <label for="name" class="col-md-3 offset-1 col-form-label text-md-left">{{ __('名前') }}</label>
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
                            <label for="tuisid" class="col-md-3 offset-1 col-form-label text-md-left">{{ __('学籍番号') }}</label>
                            <div class="col-md-6">
                                <input id="tuisid" type="text" class="form-control @error('tuisid') is-invalid @enderror" name="tuisid" value="{{ old('tuisid') ?? $p_user->tuisid }}" required autocomplete="tuisid" readonly>
                                @error('tuisid')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="form-group row">
                          <label for="role" class="col-md-3 offset-1 col-form-label text-md-left">{{ __('役割/権限') }}</label>
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
                          <label for="lab" class="col-md-3 offset-1 col-form-label text-md-left">{{ __('ゼミ') }}</label>
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
                                        {{ __('保存') }}
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
                        <div class="card-header">所持のIP</div>

                        <div class="card-body">
                            
                            <h4 class="mb-3">
                                {{ $p_user->name }} は 
                                    <strong>{{ $p_user->ips()->count() }}</strong>
                                個のIP/ホストを使用しています
                            </h4>

                            <table class="table table-hover">
                              <thead>
                                <tr>
                                  <th>IPアドレス</th>
                                  <th>ホスト名</th>
                                  <th>登録日</th>
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
                              <div class="col-md-4">
                                <button type="button" class="btn btn-primary"  data-toggle="modal" data-target="#addIp">使用するIPを追加</button>
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
            <h4 class="modal-title">使用するIPを追加</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
     
          <div class="modal-body">

            <form method="POST" action="/admin/stum/profile/add">
              @csrf

              <input id="name" type="hidden" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $p_user->name }}" required autocomplete="name" autofocus>

                <div class="form-group row">
                <label for="ip-addr" class="col-md-4 col-form-label text-md-right">{{ __('IPアドレス') }}</label>

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
                <label for="hostname" class="col-md-4 col-form-label text-md-right">{{ __('ホスト名') }}</label>

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
                <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('概要') }}</label>

                <div class="col-md-6">
                    <input id="description" type="text" class="form-control @error('description') is-invalid @enderror" name="description" value="{{ old('description') }}" autocomplete="description">
                </div>
              </div>

              <div class="form-group row mb-0">
                  <div class="col-md-3 offset-md-5">
                      <button type="submit" class="btn btn-primary">
                          {{ __('追加') }}
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
