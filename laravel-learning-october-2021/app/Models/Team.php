<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    protected $fillable = ['name','size'];

    public function add(mixed $user)
    {
        // Guard :
        if($this->count() >= $this->size) {
            throw new \Exception('Taille maximum de la Team dépassée !');
        }

        if($user instanceof User) {
            return $this->members()->save($user);
        }

        // Ici, $user est de type Collection :
        $this->members()->saveMany($user);
    }

    public function members()
    {
        return $this->hasMany(User::class);
    }

    public function count()
    {
        return $this->members()->count();
    }

    public function restart()
    {
        return $this->members()->update(['team_id' => null]);
    }

    public function remove($users = null)
    {
        if($users instanceof User) {
            return $users->leaveTeam();
        }

        return $this->removeMany($users);
    }

    public function removeMany($users)
    {
        $usersIds = $users->pluck('id');

        return $this->members()
            ->whereIn('id', $usersIds)
            ->update(['team_id' => null]);
    }

}
