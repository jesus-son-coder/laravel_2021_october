@extends('layout')
@section('main')
    <div class="container">
        <div class="flex min-h-screen">
            <!-- <div class="w-1/2 flex items-center justify-center">-->
            <div class="w-1/2 flex items-center justify-center">

                <form method="POST" action="/login" style="width: 70%">
                    @csrf
                    <h1 class="h3 text-4x1">Connexion</h1>
                    <span class="text-gray-600">Retrouvez tous vos contacts</span>

                    <div class="my-6">
                        <div class="form-group">
                            <input type="text" class="input form-control" placeholder="Votre adresse email" name="email" value="{{old('email')}}" />
                            @error('email')
                                <small class="text-red-400">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="my-6">
                        <div class="form-group">
                        <input type="password" class="input form-control" placeholder="Votre mot de passe" name="password"  value="{{old('password')}}" />
                        </div>
                        @error('password')
                            <small class="text-red-400">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="flex items-center">
                        <input type="checkbox" id="remember" class="h-5 w-5">
                        <label for="remember" class="text-base ml-2">Se souvenir de moi ?</label>
                    </div>

                    <div class="my-4">
                        <button type="submit" class="button btn btn-primary">Se connecter</button>
                    </div>
                </form>

            </div>

            <div class="bg-blue-800 w-1/2 mr-5 text-white flex flex-col items-center justify-center" style="">
                <div class="text-5xl font-bold">
                    Contact Manager
                </div>
                <div class="w-2/3 mt-6">
                    Lorem ipsum dolor sit amet
                </div>
            </div>
        </div>
    </div>
@endsection
