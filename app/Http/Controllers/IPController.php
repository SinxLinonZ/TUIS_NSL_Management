<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Validation\ValidationException;


class IPController extends Controller
{


    public function add() {

        $user = auth()->user();

        $data = request()->validate([
            'ip-addr' => ['required', 'ipv4'],
            'hostname' => 'required'
        ]);

        $target_ip = DB::table('i_p_s')->where('address', $data['ip-addr'])->first();

        if ( $target_ip->user_id && $target_ip->user_id != $user->id ) {
            throw ValidationException::withMessages(['ip-registered' => 'This IP has been used by others']);
        };

        DB::table('i_p_s')
        ->where('address', $data['ip-addr'])
        ->update(['user_id' => $user->id,
                  'hostname' => $data['hostname'],
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

        if ( $target_ip->user_id != $user->id ) {
            throw ValidationException::withMessages(['del-err' => 'Illegal operation']);
        };

        DB::table('i_p_s')
        ->where('address', $data['del-ip'])
        ->update(['user_id' => null,
                  'hostname' => null,
                  'updated_at' => Carbon::now()
                ]);

        return redirect("/home/myip");
    }


    public function edit() {
        $user = auth()->user();
        $data = request()->validate([
            'edit-ip' => ['required', 'ipv4'],
            'edit-hostname' => 'required'
        ]);

        $target_ip = DB::table('i_p_s')->where('address', $data['edit-ip'])->first();

        if ( $target_ip->user_id != $user->id ) {
            throw ValidationException::withMessages(['edit-err' => 'Illegal operation']);
        };

        DB::table('i_p_s')
        ->where('address', $data['edit-ip'])
        ->update(['hostname' => $data['edit-hostname'],
                  'updated_at' => Carbon::now()
                ]);

        return redirect("/home/myip");
    }

    public function edit_admin() {
        $data = request()->validate([
            'edit-ip' => ['required', 'ipv4'],
            'edit-hostname' => 'required',
            'edit-usingUser' => 'required'
        ]);

        $edit_user = DB::table('users')->where('name', $data['edit-usingUser'])->first();

        DB::table('i_p_s')
        ->where('address', $data['edit-ip'])
        ->update(['hostname' => $data['edit-hostname'],
                  'user_id' => $edit_user->id,
                  'updated_at' => Carbon::now()
                ]);

        return redirect("/home/nsl");
    }

    public function del_admin() {
        $data = request()->validate([
            'del-ip' => ['required', 'ipv4']
        ]);

        DB::table('i_p_s')
        ->where('address', $data['del-ip'])
        ->update(['user_id' => null,
                  'hostname' => null,
                  'updated_at' => Carbon::now()
                ]);

        return redirect("/home/nsl");
    }
}
