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
              All Students
              @else
              Students belong to <strong>{{ $user->lab->lab_name }} lab</strong>
              @endif
            </div>
            <div class="card-body">
                
              <table class="table table-hover">
                  <thead>
                    <tr>
                      <th>Student ID</th>
                      <th>Name</th>
                      <th>Role</th>
                      <th>Own IP count</th>
                      <th>Action</th>
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
                  <button type="button" class="btn btn-primary"  data-toggle="modal" data-target="#addStudent">Add New Student(s)</button>
                </div>
              </div>

              
              <!-- Add Student Modal -->
              <div class="modal fade" id="addStudent">
                <div class="modal-dialog">
                  <div class="modal-content">
               

                    <div class="modal-header">
                      <h4 class="modal-title">Add New Student(s)</h4>
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
               
                    <div class="modal-body">

                      <form method="POST" action="/admin/stum/add">
                        @csrf

                        <div class="form-group row">
                            <label for="add-student" class="col-md-4 col-form-label text-md-right">{{ __('Student to add') }}</label>

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
                            <div class="col-md-2 offset-md-5">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Add') }}
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
                      <h5 class="text-bold">Tips</h5>
                      <p class="mb-0">You can add multiple students at one time using comma(,).</p>
                      <p>e.g: j20001aa,j20002bb,j20011xx</p>
                      
                      <p>
                        All the students being added will belong to <br>
                        <strong>Student</strong> role of Lab <strong>{{ $user->lab->lab_name }}</strong> defaultly.</p>
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
                      <h4 class="modal-title">Delete Student</h4>
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
               
                    <div class="modal-body">
                      <h5 style="text-align: center">Remove This Student?</h5>

                      <form method="POST" action="/admin/stum/del">
                        @csrf

                        <input class="mb-4" style="display:block; margin: auto; text-align:center;" id="del-student" type="text" value="" name="del-student" readonly>


                          <button style="display:block; margin: auto" type="submit" class="btn btn-danger">
                              {{ __('Delete') }}
                          </button>

                      </form>

                      <hr>
                      <h5 style="text-align: center; color: red">Warning</h5>
                      <h6 style="text-align: center; color: red">This action will remove the student record from the database
                        and it is unrecoverable. After the removement, you have to readd the student even if the student id is the same.</h6>
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
