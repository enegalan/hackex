<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    @include('includes.head')
    <body id="login-frame">
        <section> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> 
            <div id="container">
                <div class="signin active"> 
                    <div class="card content">
                        <div class="front">
                            <h2>Sign In</h2> 
                            <form action="/signin" method="post" class="form"> 
                                @csrf
                                <div class="inputBox">
                                    <input type="text" name="username-email" id="login-username-email" required>
                                    <i>Username or Email</i>
                                    @error('login-username-email')
                                    <div class="input-error-message">{{ $message }}</div>
                                @enderror
                                </div>
                                <div class="inputBox">
                                    <input type="password" name="password" id="login-password" required>
                                    <i>Password</i> 
                                    @error('login-password')
                                        <div class="input-error-message">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="links">
                                    <a href="/forgot-password">Forgot Password</a>
                                    <a class="cursor-pointer" onclick="toggleLogin()">Sign up</a>
                                </div>
                                <div class="inputBox">
                                    <input type="submit" id="login-button" value="Login">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                @php
                    $signupErrors = $errors->get('signup') ?: [];
                @endphp
                <div class="signup"> 
                    <div class="content"> 
                        <h2>Sign Up</h2> 
                        <form action="/signup" method="post" class="form">
                            @csrf
                            <div class="inputBox">
                                <input type="text" name="username" id="register-username" required>
                                <i>Username</i>
                                @if (isset($signupErrors['username']))
                                    <div class="input-error-message">{{ $signupErrors['username'][0] }}</div>
                                @endif
                            </div>
                            <div class="inputBox">
                                <input type="email" name="email" id="register-email" required>
                                <i>Email</i>
                                @if (isset($signupErrors['email']))
                                    <div class="input-error-message">{{ $signupErrors['email'][0] }}</div>
                                @endif
                            </div>
                            <div class="inputBox">
                                <input type="password" name="password" id="register-password" required> <i>Password</i> 
                                @if (isset($signupErrors['password']))
                                    <div class="input-error-message">{{ $signupErrors['password'][0] }}</div>
                                @endif
                            </div>
                            <div class="inputBox">
                                <input type="password" name="repeat-password" id="register-repeat-password" required>
                                <i>Repeat Password</i>
                                @if (isset($signupErrors['repeat-password']))
                                    <div class="input-error-message">{{ $signupErrors['repeat-password'][0] }}</div>
                                @endif
                            </div>
                            <div class="links">
                                <div>
                                    <label>Already have an account? </label>
                                    <a class="cursor-pointer" onclick="toggleLogin()">Sign in</a>
                                </div>
                            </div>
                            <div class="inputBox">
                                <input type="submit" id="register-button" value="Submit">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </body>
    @include('includes.scripts', ['scripts' => ['login']])
    @if (session('initialToggle'))
        <script>toggleLogin()</script>
    @endif
</html>