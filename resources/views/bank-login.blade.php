<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    @include('includes.head')
    <body style="background:#084b8d;">
        @include('includes.modal')
        <section id="bank-login">
            <article style="flex-direction: row;width: 100%;pointer-events: none;" class="app-frame">
                <button style="
                min-width: 120px;
                min-height: 120px;">
                    <div id="bank-logo">
                        <div id="part-1">
                            <div id="part-2">
                                <div id="part-3">
                                    <div id="part-4"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </button>
                <span class="bank-name">PNT</span>
            </article>
        </section>
        <section class="bank-welcome">
            Welcome to PNT Bank
        </section>
        <section class="bank-login-frame">
            <h3>Login</h3>
            <form action="/bank-account" method="post">
                @csrf
                <input placeholder="username" type="text" value="{{ Auth::user()['username'] }}" name="bank-username" id="bank-username">
                <input placeholder="password" type="password" value="*********" name="bank-password" id="bank-password">
                <button type="submit" style="font-weight: normal; font-style: normal;" class="login-button">Login</button>
            </form>
        </section>
        <section class="bank-quote">
            <q>Trust your life.</q>
        </section>
    </body>
    @include('includes.back-btn')
    @include('includes.scripts')
</html>