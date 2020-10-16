<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Interfaces\UserRepositoryInterface;
use App\Models\User;
use Illuminate\Http\Request;
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
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        if($request->input('btn-search')){
            $sName = $request->input('s-name');
            $sEmail = $request->input('s-email');
            $sPhone = $request->input('s-phone');
            $sAddress = $request->input('s-address');
            $keySearch = [];
            if(isset($sName)){
                $keySearch['name'] = $sName;
            }
            if(isset($sEmail)){
                $keySearch['mail_address'] = $sEmail;
            }
            if(isset($sPhone)){
                $keySearch['phone'] = $sPhone;
            }
            if(isset($sAddress)){
                $keySearch['address'] = $sAddress;
            }
            $user = $this->userRepositories->searchUser($keySearch);
        } else{
            $user = $this->userRepositories->getAll();
        }
        if($user->total()<1){
            flash('Khong tim thay du lieu!')->error();
        }
        return view('users.index', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function create()
    {
        return view('users.form');
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
    public function edit($id)
    {
        $data = $this->userRepositories->getOnlyUser($id);
        return view('users.form', compact('data'));
    }
    public function update(CreateUserRequest $request, $id)
    {
        try {
            $this->userRepositories->updateUser($id, $request->all());
        }catch (Throwable $exception){
            flash('Cap nhat that bai!')->error();
            return redirect()->route('user.index');
        }
        flash('Cap nhat thanh cong!')->success();
        return redirect()->route('user.index');
    }
}
