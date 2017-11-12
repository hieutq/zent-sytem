@extends('layouts.app')

@section('content')
<!-- BEGIN LOGO -->
      <div class="logo">
         <a href="{{ URL::asset('') }}">
         <img src="{{ asset('assets/layouts/layout/img/logo-big.png')}}" alt="" /> </a>
      </div>
      <!-- END LOGO -->
      <!-- BEGIN LOGIN -->
      <div class="content">

        <!-- BEGIN LOGIN FORM -->
        <div class="login-form">
        <form id="form-login" action="{{ url('/login') }}" method="POST" role="form">
            {{ csrf_field() }}
            <h3 class="form-title font-green">Đăng Nhập</h3>
           
           <!--  <div class="alert alert-danger">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
               
            </div> -->
          
            <div class="form-group">
                <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
                <label class="control-label visible-ie8 visible-ie9">Email</label>
                <input class="form-control form-control-solid placeholder-no-fix" type="email" id="email" placeholder="Nhập email" name="email" value="{{old('email')}}" />
                
                @if ($errors->has('email'))
                                <span class="help-block">
                                    <div style="color:red;"><strong>{{ $errors->first('email') }}</strong></div>
                                </span>
                            @endif                 
                </div>
            <div class="form-group">
                <label class="control-label visible-ie8 visible-ie9">Mật khẩu</label>
                <input class="form-control form-control-solid placeholder-no-fix" type="password" id="password" placeholder="Nhập mật khẩu" name="password" />
                @if ($errors->has('password'))
                                <span class="help-block">
                                    <div style="color:red;"><strong>{{ $errors->first('password') }}</strong></div>
                                </span>
                            @endif                  
                </div>
            <div class="form-actions">
                <button type="submit" class="btn green uppercase">Đăng Nhập</button>
                <label class="rememberme check">
                    <input type="checkbox" name="remember" value="1" />Ghi nhớ</label>
                <a href="#" id="forget-password" class="forget-password">Quên mật khẩu?</a>
            </div>
            <!-- <div class="create-account">
                <p>
                    <a href="{{ url('/register') }}" id="register-btn" class="uppercase">Tạo Tài Khoản</a>
                </p>
            </div> -->
        </form>
        </div>
</div>
@endsection