<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    @include('includes.head')
    <body id="login-frame">
        @include('includes.modal')
        <section> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> 
            <div id="container">
                <div class="signin active"> 
                    <div class="card content">
                        <div class="front">
                            <h2>Sign In</h2> 
                            <div class="form"> 
                                <div class="inputBox">
                                    <input type="text" required> <i>Username</i> 
                                </div>
                                <div class="inputBox">
                                    <input type="password" required> <i>Password</i> 
                                </div>
                                <div class="links">
                                    <a href="/forgot-password">Forgot Password</a> <a class="cursor-pointer" onclick="toggleLogin()">Sign up</a>
                                </div>
                                <div class="inputBox">
                                    <input type="submit" value="Login">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="signup"> 
                    <div class="content"> 
                        <h2>Sign Up</h2> 
                        <div class="form"> 
                            <div class="inputBox">
                                <input type="text" required> <i>Username</i> 
                            </div>
                            <div class="inputBox">
                                <input type="email" required> <i>Email</i> 
                            </div>
                            <div class="inputBox">
                                <input type="password" required> <i>Password</i> 
                            </div>
                            <div class="inputBox">
                                <input type="password" required> <i>Repeat Password</i> 
                            </div>
                            <div class="links">
                                <a href="/forgot-password">Forgot Password</a> <a class="cursor-pointer" onclick="toggleLogin()">Sign in</a>
                            </div>
                            <div class="inputBox">
                                <input type="submit" value="Submit">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </body>
    @include('includes.scripts', ['scripts' => ['login']])
</html>