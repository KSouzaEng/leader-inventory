@extends('layouts.app')
@section('title', 'Login Page')
@section('content')
    <main class="login-form mt-5">
        <div class="cotainer">
            <div class="row justify-content-center">
                <div class="col-md-4">
                    <div class="card">
                        <div class="row justify-content-center">
                            <img src="{{ asset('leaderinventory.png') }}" class="img-fluid rounded mt-3"
                                alt="Townhouses and Skyscrapers" style="width:9em"/>

                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('signin') }}">
                                @csrf
                                <div class="form-group mb-3">
                                    <input type="text" placeholder="Email" id="email" class="form-control p-2"
                                        name="email" required autofocus>
                                    @if ($errors->has('email'))
                                        <span class="text-danger">{{ $errors->first('email') }}</span>
                                    @endif
                                </div>
                                <div class="form-group mb-3">
                                    <input type="password" placeholder="Password" id="password" class="form-control p-2"
                                        name="password" required>
                                    @if ($errors->has('password'))
                                        <span class="text-danger">{{ $errors->first('password') }}</span>
                                    @endif
                                </div>

                                <div class="form-check d-flex justify-content-center mb-4">
                                    <label class="form-check-label" for="form2Example33">
                                        <a class="nav-link" href="{{ route('register-user') }}">Don't have an account?
                                            Register</a>
                                    </label>
                                </div>

                                <div class="d-grid mx-auto">
                                    <button type="submit" class="btn btn-block p-3 mb-2 bg-primary bg-gradient text-white mb-4">SignIn</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
