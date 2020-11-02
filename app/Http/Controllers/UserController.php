<?php
namespace App\Http\Controllers;
use App\Events\CreatedUser;
use App\Http\Requests\CreateUserRequest;
use App\Models\Classroom;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Throwable;
class UserController extends Controller
{
    protected $user;
    protected $classroom;
    public function __construct(User $user, Classroom $classroom)
    {
        $this->user = $user;
        $this->classroom = $classroom;
        $this->middleware('check_classroom')->only('index', 'create', 'store');
        $this->middleware('check_role')->only('create', 'store', 'edit', 'update');
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
            $sClassroom = $request->input('s_classroom');
            if (isset($sName)) {
                $keySearch['users.name'] = $sName;
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
            if (isset($sClassroom)) {
                $keySearch['classroom_id'] = $sClassroom;
            }
        }
        $user = $this->user->getUser($keySearch);
        $classroom = $this->classroom->getAllClassroom();
        return view('users.index', compact('user', 'classroom'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function create()
    {
        $this->authorize('isAdmin');
        $class = $this->classroom->getAllClassroom();
        return view('users.form', compact('class'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreateUserRequest $request)
    {
        $this->authorize('isAdmin');
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
        event(new CreatedUser($details));
        flash('Them moi thanh cong!')->success();
        return redirect()->route('user.index');
    }
    public function edit($id)
    {
        $this->authorize('isAdmin');
        $data = $this->user->getOnlyUser($id);
        $class = $this->classroom->getAllClassroom();
        return view('users.form', compact('data','class'));
    }
    public function update(CreateUserRequest $request, $id)
    {
        $this->authorize('isAdmin');
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
