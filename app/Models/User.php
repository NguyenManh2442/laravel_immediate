<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use SoftDeletes;
    use Notifiable;

    protected $table = 'users';
    protected $perPage = 20;

    const ADMIN = 1;
    const EMPLOYEE = 2;

    const ROLE = [
        self::ADMIN => 'Quản trị viên',
        self::EMPLOYEE => 'Nhân viên'
    ];

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
        $query = User::query();
        $query->join('classrooms', 'classroom_id', '=', 'classrooms.id');
        if (!empty($request)) {
            foreach ($request as $key => $value) {
                if (isset($request['phone']) || isset($request['classroom_id'])) {
                    $query->whereWithEqual($key, $value);
                }
                $query->whereWithLike($key, $value);
            }
        }
        return $query->select('users.id as id', 'mail_address', 'users.name as name', 'address', 'classrooms.name as class_name', 'phone', 'role')
            ->paginate($this->perPage);
    }

    public function scopeWhereWithEqual($query, $key, $value)
    {
        return $query->where($key, '=', $value);
    }

    public function scopeWhereWithLike($query, $key, $value)
    {
        return $query->where($key, 'like', '%' . $value . '%');
    }

    public function storeUser(array $request)
    {
        $user = new User();
        $user->name = $request['name'];
        $user->mail_address = $request['mail_address'];
        $user->address = $request['address'];
        $user->phone = $request['phone'];
        $user->password = Hash::make($request['password']);
        $user->role = $request['role'];
        $user->classroom_id = $request['classroom'];
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
        $user->role = $request['role'];
        $user->classroom_id = $request['classroom'];
        $user->save();
        return true;
    }
}
