<?php
namespace App\Http\Controllers;
use App\Http\Requests\CreateUserRequest;
use App\Jobs\SendEmail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Throwable;
class UserController extends Controller
{
    protected $user;
    public function __construct(User $user)
    {
        $this->user = $user;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $keySearch = [];
        if ($request->input('btn_search')) {
            $sName = $request->input('s_name');
            $sEmail = $request->input('s_email');
            $sPhone = $request->input('s_phone');
            $sAddress = $request->input('s_address');
            if (isset($sName)) {
                $keySearch['name'] = $sName;
            }
            if (isset($sEmail)) {
                $keySearch['mail_address'] = $sEmail;
            }
            if (isset($sPhone)) {
                $keySearch['phone'] = $sPhone;
            }
            if (isset($sAddress)) {
                $keySearch['address'] = $sAddress;
            }
        }
        $user = $this->user->getUser($keySearch);
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
            $this->user->storeUser($request->all());
            DB::commit();
        } catch (Throwable $exception) {
            DB::rollBack();
            flash('Them moi that bai!')->error();
            return redirect()->route('user.create');
        }
        $details = [
            'mail' => $request->mail_address,
            'name' => $request->name
        ];
        SendEmail::dispatch($details);
        flash('Them moi thanh cong!')->success();
        return redirect()->route('user.index');
    }
    public function edit($id)
    {
        $data = $this->user->getOnlyUser($id);
        return view('users.form', compact('data'));
    }
    public function update(CreateUserRequest $request, $id)
    {
        try {
            $this->user->updateUser($id, $request->all());
        } catch (Throwable $exception) {
            flash('Cap nhat that bai!')->error();
            return redirect()->route('user.index');
        }
        flash('Cap nhat thanh cong!')->success();
        return redirect()->route('user.index');
    }
}
