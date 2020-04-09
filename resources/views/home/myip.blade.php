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
            <div class="card-header">私のIP</div>
            <div class="card-body">
                
              <table class="table table-hover">
                  <thead>
                    <tr>
                      <th>IP</th>
                      <th>ホスト名</th>
                      <th>登録日</th>
                      <th>操作</th>
                    </tr>
                  </thead>
                  <tbody>
                    
                    @foreach ($ips as $ip)
                    <tr>
                      
                      <td>{{ $ip->address }}</td>
                      <td id="hostname-{{ $ip->id }}">{{ $ip->hostname }}</td>
                      <td>{{ $ip->updated_at }}</td>
                      <td>
                        <myipedit tagid="{{ $ip->id }}"></myipedit>
                      </td>

                    </tr>
                    @endforeach
                    
      
                  </tbody>
              </table>

              <div class="row justify-content-end">
                <div class="col-md-3">
                  <button type="button" class="btn btn-primary"  data-toggle="modal" data-target="#addIp">使用するIPを追加</button>
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

                      <form method="POST" action="/home/myip/add">
                        @csrf

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
                              <input id="hostname" type="text" class="form-control @error('hostname') is-invalid @enderror" name="hostname" value="{{ old('hostname') }}" required autocomplete="hostname">

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

              
              <!-- Delete IP Modal -->
              <div class="modal fade" id="delIp">
                <div class="modal-dialog">
                  <div class="modal-content">
               

                    <div class="modal-header">
                      <h4 class="modal-title">登録IPを削除</h4>
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
               
                    <div class="modal-body">
                      <h5 style="text-align: center">このIPの使用情報を削除しますか？</h5>

                      <form method="POST" action="/home/myip/del">
                        @csrf

                        <input class="mb-4" style="display:block; margin: auto" id="del-ip" type="text" value="" name="del-ip" readonly>


                          <button style="display:block; margin: auto" type="submit" class="btn btn-danger">
                              {{ __('削除') }}
                          </button>

                      </form>
                    </div>
               
                  </div>
                </div>
            </div>

            
            <!-- Edit IP Modal -->
            <div class="modal fade" id="editIp">
              <div class="modal-dialog">
                <div class="modal-content">
             

                  <div class="modal-header">
                    <h4 class="modal-title">IP使用情報を編集</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                  </div>
             
                  <div class="modal-body">

                    <form method="POST" action="/home/myip/edit">
                      @csrf

                      <div class="form-group row">
                          <label for="edit-ip" class="col-md-4 col-form-label text-md-right">{{ __('IPアドレス') }}</label>

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
                        <label for="edit-hostname" class="col-md-4 col-form-label text-md-right">{{ __('ホスト名') }}</label>

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
                        <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('概要') }}</label>
        
                        <div class="col-md-6">
                            <input id="description" type="text" class="form-control @error('description') is-invalid @enderror" name="description" value="{{ old('description') }}" autocomplete="description">
                        </div>
                      </div>

                      <div class="form-group row mb-0">
                          <div class="col-md-3 offset-md-5">
                              <button type="submit" class="btn btn-primary">
                                  {{ __('保存') }}
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
