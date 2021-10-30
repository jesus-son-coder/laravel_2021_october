@extends('layout')
@section('main')
    <div class="container">
        <div class="flex items-start mt-8 -mx-8">
            <!-- <div class="w-1/2 flex items-center justify-center">-->
            <div class="w-1/2">

                <form method="POST" action="{{ route('contacts.store') }}" style="width: 70%">
                    @csrf
                    <div class="px-8">
                        <div class="bg-white shadow rounded-lg px-12 py-10">
                            <div class="py-4">
                                <div class="form-group">
                                    <label for="name" class="label">Nom & Prénom</label>
                                    <input type="text" class="input form-control" placeholder="Ex: John Doe" id="name" name="name" value="{{ old('name') }}" />
                                    @error('name')
                                        <small class="text-red-600">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="py-4">
                                <div class="form-group">
                                    <label for="email" class="label">Email</label>
                                    <input type="email" class="input form-control" id="email" name="email" placeholder="Ex: John@example.com" value="{{ old('email') }}">
                                    @error('email')
                                        <small class="text-red-600">{{$message}}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="py-4">
                                <div class="form-group">
                                    <label for="phone" class="label">Numéro de téléphone</label>
                                    <input type="text" class="form-control input" placeholder="Ex: 0102030405" id="phone" name="phone" value="{{ old('phone') }}">
                                </div>
                            </div>
                            <div class="py-4">
                                <div class="form-group">
                                    <label for="address" class="label">Adresse</label>
                                    <textarea class="input" placeholder="Ex: Rue du commerce" id="address" name="address" cols="30" rows="5" >
                                        {{ old('address') }}</textarea>
                                </div>
                            </div>
                            <div class="py-4">
                                <button class="button btn btn-primary" type="submit">Créer</button>
                            </div>
                        </div>
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
