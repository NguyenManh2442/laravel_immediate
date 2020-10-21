<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Interfaces\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Throwable;

class UserController extends Controller
{
    protected $userRepositories;

    public function __construct(UserRepositoryInterface $userRepositories)
    {
        $this->userRepositories = $userRepositories;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = $this->userRepositories->getAll();
        return view('users.index', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.createNewUser');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreateUserRequest $request)
    {
        try {
            DB::beginTransaction();
            $this->userRepositories->storeUser($request->all());
            DB::commit();
        } catch (Throwable $exception) {
            DB::rollBack();
            flash('Them moi that bai!')->error();
            return redirect()->route('user.create');
        }
        flash('Them moi thanh cong!')->success();
        return redirect()->route('user.index');
    }

    public function formLogin(){
//        return view('users.form-login');
    }
    public function login(Request $request)
    {
//        $data = [
//            'mail_address' => $request->mail_address,
//            'password' => $request->password
//        ];
//        if(Auth::attempt($data))
//        {
//            return redirect(route('user.index'));
//        }
//        return redirect(route('formLogin'));
    }

    public function logout(){
//        Auth::logout();
//        return redirect(route('formLogin'));
    }
}
