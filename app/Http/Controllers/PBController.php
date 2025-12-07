<?php

namespace App\Http\Controllers;

use App\Models\PB;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;

class PBController extends Controller
{
    public function changePassword(){
        return view('content.pb.change-password');
    }
    public function updatePassword(Request $request, $id){
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required',
            'confirm_password' => 'required|same:new_password',
        ]);
        try {
            $user = PB::where('id', Crypt::decrypt($id))->first();
            if(!Hash::check($request->old_password,$user->password)) {
                return redirect()->back()->with('wrong-password', 'Wrong password');
            }
            DB::beginTransaction();
            PB::where('id', Crypt::decrypt($id))->update([
                'password'      => bcrypt($request->new_password),
                'updated_by'    => Auth::user()->id,
                'updated_at'    => Carbon::now(),
            ]);
            DB::commit();
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return redirect('/login')->with('password-changed', 'Password has been changed, please login with new password');
        } catch (\Throwable $th) {
            DB::rollback();
            throw $th;
        }
    }
    public function cashflow_index(){
        return view('content.pb.cashflow.index');
    }
    public function withdraw_index(){
        return view('content.pb.withdraw.index');
    }
}
