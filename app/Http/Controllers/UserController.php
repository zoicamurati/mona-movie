<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Notifications\NewContactCreated;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users=User::where('role',0)
           -> whereHas('invoices', function($q){
                $q->where('status', '=', 1);})
            ->orderBy('created_at','desc')->get();

        return view('panel.users.index', compact('users'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function contact(Request $request)
    {
        $user=User::where('email','contact@drilonhoxha.com')->orderBy('created_at','desc')->first();

        try {
            $user->notify(new NewContactCreated($request->all()));
        } catch (\Exception $e) {
            \Log::info($e->getMessage());
        }

        return  redirect()->back()->with('success', 'your message,here');


    }
}
