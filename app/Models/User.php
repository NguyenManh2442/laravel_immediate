<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class User extends Model
{
    use SoftDeletes;

    protected $table = 'users';
    protected $perPage = 20;

    protected $fillable = [
        'mail_address',
        'name',
        'password',
        'address',
        'phone',
    ];
    protected $dates = [
        'deleted_at',
        'created_at',
        'updated_at',
    ];

    public function getUser(array $request)
    {
        $query = DB::table('users');
        if (!empty($request)) {
            foreach ($request as $key => $value) {
                if (isset($request['phone'])) {
                    $query->where($key, '=', $value);
                }
                $query->where($key, 'like', '%' . $value . '%');
            }
        }
        return $query->paginate($this->perPage);
    }

    public function storeUser(array $request)
    {
        $user = new User();
        $user->name = $request['name'];
        $user->mail_address = $request['mail_address'];
        $user->address = $request['address'];
        $user->phone = $request['phone'];
        $user->password = Hash::make($request['password']);
        $user->save();
        return true;
    }

    public function getOnlyUser($id)
    {
        return DB::table('users')
            ->where('id', $id)
            ->get();
    }

    public function updateUser($id, array $request)
    {
        $user = User::find($id);
        $user->name = $request['name'];
        $user->mail_address = $request['mail_address'];
        $user->address = $request['address'];
        $user->phone = $request['phone'];
        if (empty($request['password'])) {
            $user->password = Hash::make($request['password']);
        }
        $user->save();
        return true;
    }
}
