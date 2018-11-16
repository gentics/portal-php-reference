<section class="nav-register">
    @auth
        Welcome {{ Auth::user()->name ?? "" }} ({{ Auth::user()->username ?? "" }})!
        <a href="{{ route('logout') }}" class="btn btn-light">Sign out</a>
    @endauth

    @guest
    <!-- REGISTER BUTTON WITH REDIRECT -->
    <a href="{{ route('register', ['returnTo' => url()->full()]) }}" class="btn btn-light">Register</a>

    {{--
    <!-- REGISTER BUTTON -->
    <button type="button" class="btn btn-light" data-toggle="modal" data-target="#exampleModalCenter">
        Register
    </button>

    <!-- REGISTER MODAL -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <h5 class="modal-title" id="exampleModalLongTitle">Great to see you here!</h5>
                    <form>
                        <div class="form-group">
                            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Choose your username">
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Your firstname">
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Your lastname">
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Your email adress">
                        </div>
                        <button type="submit" class="btn btn-secondary submitBtn">Create your account</button>
                        <small id="emailHelp" class="form-text text-small">Already got an account? <a href="." data-toggle="modal" data-target="#exampleModalCenter1" data-dismiss="modal">Sign in here</a></small>
                    </form>
                </div>
            </div>
        </div>
    </div>
    --}}

        {{--
        <!-- SIGN IN BUTTON WITH MODAL -->
        <button type="button" class="btn btn-dark" data-toggle="modal" data-target="#exampleModalCenter1">
            Sign In
        </button>
        --}}

    <!-- SIGN IN BUTTON WITH REDIRECT -->
    <a href="{{ route('login', ['returnTo' => url()->full()]) }}" class="btn btn-dark">Sign in</a>

        {{--
        <!-- SIGN IN MODAL -->
        <div class="modal fade" id="exampleModalCenter1" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <h5 class="modal-title" id="exampleModalLongTitle">Great to have you back!</h5>
                        <form method="post" action="{{ route('loginPassword', ['returnTo' => url()->full()]) }}">
                            <div class="form-group">
                                <input type="text" name="username" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="username">
                            </div>
                            <div class="form-group">
                                <input type="password" name="password" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="password">
                                <a href="#" id="resetBtn">Reset</a></small>
                            </div>
                            <button type="submit" class="btn btn-secondary submitBtn">Sign in to your account</button>
                            <small id="emailHelp" class="form-text text-small">New here? <a href="#" data-toggle="modal" data-target="#exampleModalCenter" data-dismiss="modal">Register</a></small>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        --}}
    @endguest
</section>