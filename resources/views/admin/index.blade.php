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
            <div class="card-header">
              @if ($user->lab->lab_name == 'NetTech')
              全ての学生
              @else
              <strong>{{ $user->lab->lab_name }} ゼミ</strong>所属の学生
              @endif
            </div>
            <div class="card-body">
                
              <table class="table table-hover">
                  <thead>
                    <tr>
                      <th>学籍番号</th>
                      <th>名前</th>
                      <th>役割/権限</th>
                      <th>使用中のIP数</th>
                      <th>操作</th>
                    </tr>
                  </thead>
                  <tbody>
                    
                      @foreach ($students as $student)

                      @if ($student->lab_id == $user->lab_id &&
                           $student->role->role_name != 'Teacher'&&
                           $student->role->role_name != 'Admin')

                      <tr>
                        <td>{{ $student->tuisid }}</td>
                        <td>{{ $student->name }}</td>
                        <td>{{ $student->role->role_name }}</td>
                        <td>{{ $student->IPs()->count() }}</td>
                        <td>
                          <stumedit studentname="{{ $student->name }}"></stumedit>
                        </td>
                      </tr>
                      @elseif ($user->lab->lab_name == 'NetTech')
                      <tr>
                        <td>{{ $student->tuisid }}</td>
                        <td>{{ $student->name }}</td>
                        <td>{{ $student->role->role_name }}</td>
                        <td>{{ $student->IPs()->count() }}</td>
                        <td>
                          <stumedit studentname="{{ $student->name }}"></stumedit>
                        </td>
                      </tr>
                      @endif
                      @endforeach
                    
                  </tbody>
              </table>

              <div class="row justify-content-end">
                <div class="col-md-2">
                  <button type="button" class="btn btn-primary"  data-toggle="modal" data-target="#addStudent">学生を追加</button>
                </div>
              </div>

              
              <!-- Add Student Modal -->
              <div class="modal fade" id="addStudent">
                <div class="modal-dialog">
                  <div class="modal-content">
               

                    <div class="modal-header">
                      <h4 class="modal-title">学生を追加</h4>
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
               
                    <div class="modal-body">

                      <form method="POST" action="/admin/stum/add">
                        @csrf

                        <div class="form-group row">
                            <label for="add-student" class="col-md-4 col-form-label text-md-right">{{ __('追加する学生') }}</label>

                            <div class="col-md-6">
                                <input id="add-student" type="text" class="form-control @error('add-student') is-invalid @enderror" name="add-student" value="{{ old('add-student') }}" required autocomplete="add-student" autofocus>

                                @error('student-registered')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    <sessionerr err="student-registered"></sessionerr>
                                @enderror
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
                    @error('student-registered')
                      <div class="alert alert-danger mt-4">
                        <h6>{{ $message }}</h6>
                        <sessionerr err="student-registered"></sessionerr>
                      </div>
                    @enderror
                    </div>

                    <div class="card-footer">
                      <h5 class="text-bold">説明</h5>
                      <p class="mb-0">半角コンマ（,）で区切し、複数の学生を一括追加することができます</p>
                      <p>例: j20001aa,j20002bb,j20011xx</p>
                      
                      <p>
                        新しく追加される学生はディフォルトで<br>
                        <strong>{{ $user->lab->lab_name }}ゼミ</strong>の<strong>学生</strong>役割/権限<br>
                        で追加されます
                      </p>
                    </div>
               
                  </div>
                </div>
              </div>
              <!-- End of Add Student Modal -->
              

              
              <!-- Delete Student Modal -->
              <div class="modal fade" id="delStudent">
                <div class="modal-dialog">
                  <div class="modal-content">
               

                    <div class="modal-header">
                      <h4 class="modal-title">学生を削除</h4>
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
               
                    <div class="modal-body">
                      <h5 style="text-align: center">この学生（ユーザー）を削除しますか</h5>

                      <form method="POST" action="/admin/stum/del">
                        @csrf

                        <input class="mb-4" style="display:block; margin: auto; text-align:center;" id="del-student" type="text" value="" name="del-student" readonly>


                          <button style="display:block; margin: auto" type="submit" class="btn btn-danger">
                              {{ __('削除') }}
                          </button>

                      </form>

                      <hr>
                      <h5 style="text-align: center; color: red">警告</h5>
                      <h6 style="text-align: center; color: red">
                        この操作はデータベースに保存している学生（ユーザー）レコードを削除し、回復不能な操作です。<br>
                        削除したら、同じ学籍番号の学生でも問わず、もう一度追加する必要があります。
                    </div>
               
                  </div>
                </div>
            </div>
            <!-- End of Delete Student Modal -->
            
            </div>
          </div>
          
        </div>




    </div>




</div>
@endsection
