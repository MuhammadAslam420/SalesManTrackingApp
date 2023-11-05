@extends('layout.login')
@section('content')

<div class="row h-100">
    <div class="col-lg-6 col-12">
        <div id="auth-left">
            <div class="auth-logo mb-1">
                <a href="/"><img src="{{asset('assets/images/logo/Sales.png')}}" alt="Logo"></a>
            </div>
            <h3 class="auth-title">Salesman Login.</h3>
            <p class="auth-subtitle mb-2">Log in with your data that you entered during registration.</p>

            <form action="{{route('salesman.login.submit')}}" method="post">
                @csrf

                <div class="form-group position-relative has-icon-left mb-4">
                    <input type="email" name='email' class="form-control form-control-xl" placeholder="Username">
                    <div class="form-control-icon">
                        <i class="bi bi-person"></i>
                    </div>
                </div>
                <div class="form-group position-relative has-icon-left mb-4">
                    <input type="password" name="password" class="form-control form-control-xl" placeholder="Password">
                    <div class="form-control-icon">
                        <i class="bi bi-shield-lock"></i>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary btn-block btn-lg shadow-lg mt-5">Log in</button>
            </form>
            <div class="text-center mt-3 text-lg fs-4">
                <p><a class="font-bold" href="auth-forgot-password.html">Forgot password?</a>.</p>
            </div>
        </div>
    </div>
    <div class="col-lg-6 justify-content-center d-lg-block">
        <img src="{{asset('assets/images/logo/Sales.png')}}" class="img-thumbnail" width="1000" alt="">
    </div>
</div>
@endsection
