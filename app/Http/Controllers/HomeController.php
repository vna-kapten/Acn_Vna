<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        return view('home');
    }
}
//         $validator = Validator::make($request->all(), [
//             'username' => 'required|min:4|max:50',
//             'password' => 'required'
//         ]);

//         if ($validator->fails()) {
//             return back()
//                 ->withErrors($validator)
//                 ->withInput();
//         }

//         return 'Login berhasil';
//     }
// }
//     public function index () {
// $authors = DB::table('authors')->get();
//      dd($authors);
//     }
// }

// public function index () {
// $author = DB::table('authors')->where('author_name',
// 'Leandra Devlin Cezare Phutra')->first();
// dd($author);
// }

// public function index () {
// $author = DB::table('authors')->count();
// dd($author);
// }

// public function index () {
// $author = DB::table('authors')->max('created_at');


// dd($author);
// }


