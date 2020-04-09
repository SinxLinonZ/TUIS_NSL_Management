<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Carbon\Carbon;
use App\User;
use App\Lab;
use App\Role;
use App\IP;

class AdminController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index() {
        $user = auth()->user();

        if ($user->role->role_name == 'Student') {
            abort(403, '操作禁止, あなたは管理者ではありません');
        }
        
        $students = User::all();
        return view('admin.index', compact('user', 'students'));
    }

    public function admin_stuprofile($user) {

        $a_user = auth()->user();
        $p_user = User::where('name', $user)->with('role','ips')->first();

        $labs = Lab::all()->where('id', '>', 1);
        $roles = Role::all()->where('id', '>', 1);
        
        return view('admin.stuprofile', compact('a_user', 'p_user', 'labs', 'roles'));
    }

    public function admin_updatestuprofile() {
        $data = request()->validate([
            'name' => 'required',
            'tuisid' => '',
            'role' => '',
            'lab' => ''
        ]);

        $target_user = User::where('tuisid', $data['tuisid'])->first();
        if ( !$target_user ) {
            abort(403, 'この学生は登録されていません');
        }
        $target_role = Role::where('role_name', $data['role'])->first()->id;
        $target_lab = Lab::where('lab_name', $data['lab'])->first()->id;

        $name_changed = '';
        if ($target_user->name != $data['name']) {
            $name_changed = true;
        }

        DB::table('users')
        ->where('id', $target_user->id)
        ->update(['name' => $data['name'],
                  'role_id' => $target_role,
                  'lab_id' => $target_lab,
                  'updated_at' => Carbon::now()
                ]);
        
        if ($name_changed) {
            return redirect("/admin/stum");
        }

        throw ValidationException::withMessages(['admin_stuprofile_success' => '更新が成功しました']);

    }

    public function admin_addstuip() {
        $data = request()->validate([
            'name' => 'required',
            'ip-addr' => ['required', 'ipv4'],
            'hostname' => '',
            'description' => '',
        ]);

        $user = User::where('name', $data['name'])->first();
        $target_ip = IP::where('address', $data['ip-addr'])->first();

        if ( !$target_ip ) {
            abort(403, 'NSLのIPではありません');
        }

        if ( $target_ip->user_id && $target_ip->user_id != $user->id ) {
            throw ValidationException::withMessages(['ip-registered' => 'このIPは他の人に使われています']);
        };

        DB::table('i_p_s')
        ->where('address', $data['ip-addr'])
        ->update(['user_id' => $user->id,
                  'hostname' => $data['hostname'],
                  'description' => $data['description'],
                  'updated_at' => Carbon::now()
                ]);

        return redirect("/admin/stum/".$data['name']);
    }


    public function del() {
        $user = auth()->user();

        $data = request()->validate([
            'del-student' => 'required'
        ]);

        $target_user = DB::table('users')->where('name', $data['del-student'])->first();
        
        if ($user->role->role_name != '管理者') {
            if ( $target_user->lab_id != $user->lab_id ) {
                abort(403, 'この学生はあなたの管理下にありません。');
            };
        }

        if ( !$target_user ) {
            abort(403, 'この学生は登録されていません');
        }

        DB::table('users')
        ->where('id', $target_user->id)
        ->delete();

        DB::table('i_p_s')
        ->where('user_id', $target_user->id)
        ->update(['user_id' => null,
        'last_modified' => $user->id,
        'hostname' => null,
        'description' => null,
        'updated_at' => Carbon::now()
      ]);

        return redirect("/admin/stum");

    }


    
    public function add() {

        $user = auth()->user();

        $data = request()->validate([
            'add-student' => 'required'
        ]);

        $students_string_origin = preg_replace('/\s+/', '', $data['add-student']);
        $students_string_lower = strtolower($students_string_origin);
        $students_array = explode(',', $students_string_lower);
        
        $v_registered_students_array =array();
        foreach ($students_array as $student) {
            $v_result = DB::table('users')->where('tuisid', $student)->first();
            if($v_result) {
                array_push($v_registered_students_array, $student);
            }
        }
        if (!empty($v_registered_students_array)) {
            $v_registered_students = implode(" ",$v_registered_students_array);
            throw ValidationException::withMessages(['student-registered' => "学籍番号 $v_registered_students は既に登録されています"]);
        }

        foreach ($students_array as $student) {
            DB::table('users')->insert([
                'name' => $student,
                'tuisid' => $student,
                'role_id' => 2,
                'lab_id' => $user->lab_id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
        }

        return redirect("/admin/stum");
    }

}
