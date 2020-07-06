@extends('admin.layouts.app')

@section('title', 'Login')

@section('body')
<body>
    @endsection

    @section('content')
    <div class="home-btn d-none d-sm-block">
        <a href="index" class="text-dark"><i class="fas fa-home h2"></i></a>
    </div>
    <div class="account-pages my-5 pt-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5">
                    <div class="card overflow-hidden">
                        <div class="bg-primary">
                            <div class="text-primary text-center p-4">
                                <h5 class="text-white font-size-20">Welcome Back !</h5>
                                <p class="text-white-50">Sign in to start session.</p>
                                <a href="index" class="logo logo-admin">
                                    <img src="{{ asset('assets/images/logo-sm.png') }}" height="24" alt="logo">
                                </a>
                            </div>
                        </div>

                        <div class="card-body p-4">
                            <div class="p-3">
                                <form class="form-horizontal mt-4" method="POST" action="{{ route('login') }}">
                                    @csrf
                                    
                                    <div class="form-group">
                                        <label for="sin">NIK</label>
                                        <input name="sin" type="text" class="form-control @error('sin') is-invalid @enderror" value="{{ old('sin') }}" id="sin" placeholder="NIK KTP" autocomplete="sin" autofocus>
                                        @error('sin')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input type="password" name="password" class="form-control  @error('password') is-invalid @enderror" id="password" placeholder="Enter password">
                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-sm-6">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="customControlInline">
                                                <label class="custom-control-label" for="customControlInline">Remember me</label>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 text-right">
                                            <button class="btn btn-primary w-md waves-effect waves-light" type="submit">Log In</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>

                    <div class="mt-5 text-center">
                        <p class="mb-0">© <script>document.write(new Date().getFullYear())</script> {{ config('app.name') }}. Crafted with <i class="mdi mdi-heart text-danger"></i> by Hiskia</p>
                    </div>

                </div>
            </div>
        </div>
    </div>
    @endsection