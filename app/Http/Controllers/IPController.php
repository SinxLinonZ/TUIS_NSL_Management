<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Carbon\Carbon;


class IPController extends Controller
{


    public function add() {

        $user = auth()->user();

        $data = request()->validate([
            'ip-addr' => ['required', 'ipv4'],
            'hostname' => 'required',
            'description' => ''
        ]);

        $target_ip = DB::table('i_p_s')->where('address', $data['ip-addr'])->first();

        if ( !$target_ip ) {
            abort(403, 'IP Not Found.');
        }

        if ( $target_ip->user_id && $target_ip->user_id != $user->id ) {
            throw ValidationException::withMessages(['ip-registered' => 'This IP has been used by others']);
        };

        DB::table('i_p_s')
        ->where('address', $data['ip-addr'])
        ->update(['user_id' => $user->id,
                  'hostname' => $data['hostname'],
                  'description' => $data['description'],
                  'updated_at' => Carbon::now()
                ]);

        return redirect("/home/myip");
    }
    
    public function edit() {
        $user = auth()->user();
        $data = request()->validate([
            'edit-ip' => ['required', 'ipv4'],
            'edit-hostname' => 'required',
            'description' => ''
        ]);
    
        $target_ip = DB::table('i_p_s')->where('address', $data['edit-ip'])->first();
    
        if ( !$target_ip ) {
            abort(403, 'IP Not Found.');
        }
        if ( $target_ip->user_id != $user->id ) {
            abort(403, 'Illegal operation.');
//          throw ValidationException::withMessages(['edit-err' => 'Illegal operation']);
        };
    
        DB::table('i_p_s')
        ->where('address', $data['edit-ip'])
        ->update(['hostname' => $data['edit-hostname'],
                  'description' => $data['description'],
                  'updated_at' => Carbon::now()
                ]);
    
        return redirect("/home/myip");
    }

    public function del() {
        $user = auth()->user();

        $data = request()->validate([
            'del-ip' => ['required', 'ipv4']
        ]);

        $target_ip = DB::table('i_p_s')->where('address', $data['del-ip'])->first();
        
        if ( !$target_ip ) {
            abort(403, 'IP Not Found.');
        }
        if ( $target_ip->user_id != $user->id ) {
            abort(403, 'Illegal operation.');
//          throw ValidationException::withMessages(['del-err' => 'Illegal operation']);
        };

        DB::table('i_p_s')
        ->where('address', $data['del-ip'])
        ->update(['user_id' => null,
                  'hostname' => null,
                  'description' => null,
                  'updated_at' => Carbon::now()
                ]);

        return redirect("/home/myip");
    }



    public function edit_admin() {
        $user = auth()->user();

        if ($user->role->role_name != 'Admin' && $user->role->role_name != 'Teacher' ) {
            abort(403, 'Illegal operation.');
        }
        
        $data = request()->validate([
            'edit-ip' => ['required', 'ipv4'],
            'edit-hostname' => 'required',
            'edit-usingUser' => 'required',
            'description' => ''
        ]);

        $edit_user = DB::table('users')->where('name', $data['edit-usingUser'])->first();
        if ( !$edit_user ) {
            abort(403, 'User Not Found.');
        }
        $target_ip = DB::table('i_p_s')->where('address', $data['edit-ip'])->first();
        if ( !$target_ip ) {
            abort(403, 'IP Not Found.');
        }

        DB::table('i_p_s')
        ->where('address', $data['edit-ip'])
        ->update(['hostname' => $data['edit-hostname'],
                  'user_id' => $edit_user->id,
                  'description' => $data['description'],
                  'updated_at' => Carbon::now()
                ]);

        return redirect("/home/nsl");
    }

    public function del_admin() {
        $user = auth()->user();

        if ($user->role->role_name != 'Admin' && $user->role->role_name != 'Teacher' ) {
            abort(403, 'Illegal operation.');
        }

        $data = request()->validate([
            'del-ip' => ['required', 'ipv4']
        ]);

        $target_ip = DB::table('i_p_s')->where('address', $data['del-ip'])->first();
        if ( !$target_ip ) {
            abort(403, 'IP Not Found.');
        }

        DB::table('i_p_s')
        ->where('address', $data['del-ip'])
        ->update(['user_id' => null,
                  'hostname' => null,
                  'description' => null,
                  'updated_at' => Carbon::now()
                ]);

        return redirect("/home/nsl");
    }
}
