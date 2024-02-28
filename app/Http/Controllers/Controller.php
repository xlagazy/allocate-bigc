<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;

use Cookie;
use DB;

class Controller extends BaseController
{
    function login(Request $request)
    {
        $code = $request->input('code');
        $password = $request->input('password');

        $login = DB::table('Account')
                    ->select('name',
                             'code')
                    ->where('code', '=',$code)
                    ->where('password', '=', $password)
                    ->get();
                    
        if(count($login) !== 0)
        {
            Cookie::queue('name', $login[0]->name);
            Cookie::queue('code', $login[0]->code);
            return redirect()->back();
        }
        else
        {            
            return redirect()->back()->with('failLogin', "ชื่อผู้ใช้งานหรือรหัสผ่านไม่ถูกต้อง");
        }
    }

    function logout(){
        Cookie::queue(Cookie::forget('name'));
        Cookie::queue(Cookie::forget('code'));

        return redirect()->back();
    }
}
