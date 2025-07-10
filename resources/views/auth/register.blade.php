
@extends('layouts.app')
@section('content')
<section class="h-100 gradient-form" style="">
  <div class="container py-4 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-xl-5">
        <div class="card rounded-3 text-black">
          <div class="row g-0">
            <div class="col">
              <div class="card-body p-md-5 mx-md-4">

                <div class="text-center">
                  <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/lotus.webp"
                    style="width: 185px;" alt="logo">
                  <h4 class="mt-1 mb-5 pb-1">The Lotus Finance Tracker App</h4>
                </div>

                <form action="{{route('register')}}" method="POST">
                    @csrf
                    @method('POST')

                    @if($errors->any())
                        <ul class="list-group">
                            @foreach ( $errors->all() as $error )
                                <li class="list-group-item list-group-item-danger my-1">{{$error}}</li>
                                
                            @endforeach
                        </ul>
                    @endif  


                    <div data-mdb-input-init class="form-outline mb-4">
                        <label class="form-label" for="form2Example22">Name</label>
                        <input type="text"  id="name" name="name" class="form-control" value="{{ old('name')}}"/>
                    </div>

                    <div data-mdb-input-init class="form-outline mb-4">
                        <label class="form-label" for="form2Example11">Email</label>
                        <input type="email" id="email" name="email" class="form-control" placeholder="" value="{{ old('email')}}"/>
                        
                    </div>

                    <div data-mdb-input-init class="form-outline mb-4">
                        <label class="form-label" for="form2Example22">Password</label>
                        <input type="password"  id="password" name="password" class="form-control" />
                    </div>

                    <div data-mdb-input-init class="form-outline mb-4">
                        <label class="form-label" for="form2Example22">Repeat your password</label>
                        <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" />
                    </div>

                    <div class="text-center pt-1 mb-1 pb-1">
                        <button data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-block fa-lg gradient-custom-2 mb-3" type="submit">Register </button>
                {{--        <a class="text-muted" href="#!">Forgot password?</a> --}}
                    </div>

                    <div class="d-flex align-items-center justify-content-center pb-4">
                        <p class="mb-0 me-2">Have an account?</p>
                    
                        <a href="{{route('show.login')}}">Log in</a>
                    </div>

                </form>

              </div>
            </div>
  
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection