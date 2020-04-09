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
                    <th>ホスト名</th>
                    <th>概要</th>
                    <th>使用者</th>
                    <th>所属ゼミ</th>
                    <th>登録日</th>
                    <th>登録者</th>
                    @if ($user->role->role_name == '管理者' || $user->role->role_name == '先生')
                    <th>操作</th>
                    @endif
                  </tr>
                </thead>
                <tbody>

                    @foreach ($ips as $ip)
                        
                    <tr>
                        <td>{{$ip->address}}</td>
                        <td id="hostname-{{ $ip->id }}">{{ $ip->hostname}}</td>
                        <td>{{ $ip->description }}</td>
                        <td>
                            {{ $ip->user['name'] }}

                            @if ( $ip->user['role']['role_name'] == '管理者' || $ip->user['role']['role_name'] == "先生")
                                <span class="badge badge-secondary"> {{ $ip->user['role']['role_name'] }} </span>
                            @endif

                        </td>
                        <td>{{ $ip->user['lab']['lab_name'] }}</td>
                        
                        @if ($ip->user['name'])
                        <td>{{ $ip->updated_at }}</td>
                        <td>{{ $ip->wasChangedBy->name }}</td>
                        @else
                        <td></td>
                        <td></td>
                        @endif
                        

                        @if ($user->role->role_name == '管理者' || $user->role->role_name == '先生')
                        <td>
                          <nsledit
                          tagid="{{$ip->id}}"></nsledit>
                        </td>
                        @endif
                        
                      </tr>
                    @endforeach

                </tbody>
            </table>
            
            @if ($user->role->role_name == '管理者' || $user->role->role_name == '先生')
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

                    <form method="POST" action="/home/nsl/del">
                      @csrf

                      <input class="mb-4" style="display:block; margin: auto; text-align:center;" id="del-ip" type="text" value="" name="del-ip" readonly>


                        <button style="display:block; margin: auto" type="submit" class="btn btn-danger">
                            {{ __('削除') }}
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
                  <h4 class="modal-title">IP使用情報を編集</h4>
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
           
                <div class="modal-body">

                  <form method="POST" action="/home/nsl/edit">
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
                        <label for="edit-usingUser" class="col-md-4 col-form-label text-md-right">{{ __('使用者') }}</label>
  
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
          <!-- End of Edit IP Modal -->
          @endif
          



        </div>




    </div>




</div>
@endsection
