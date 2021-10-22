<?php

namespace App\Http\Controllers\Learning;

use App\Exceptions\UserNotfoundException;
use App\Models\User;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Http\Controllers\Controller;
use App\Services\UserService;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class LearningController extends Controller
{
    public function index()
    {
        return view('users.index');
    }

    public function show($username)
    {
        try {
            $user = (new UserService())->findByUsername($username);
        }
        catch(UserNotfoundException $exception) {
            return view('users.modelnotfound', ['error' => $exception->getMessage()]);
        }

        catch (\Exception $exception) {
            return view('users.notfound');
        }

        return view('users.show', compact('user'));

    }











}
