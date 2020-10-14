<?php
namespace App\Repositories;

use App\Interfaces\UserRepositoryInterface;
use App\Models\User;
use App\Repositories\EloquentRepository;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\Types\This;

class UserRepositories extends EloquentRepository implements UserRepositoryInterface
{

    /**
     * get model
     * @return string
     */
    public function getModel(): string
    {
        return User::class;
    }
    public function getAll()
    {
        return $this->_model->newQuery()
            ->paginate(20);
    }
    public function storeUser(array $request){
        $user = new User();
        $user->name = $request['name'];
        $user->mail_address = $request['mail_address'];
        $user->address = $request['address'];
        $user->phone = $request['phone'];
        $user->password = bcrypt($request['password']);
        $user->save();
        return true;
    }
    public function updateUser($id, array $request){

    }
    public function deleteUser($id){

    }

}