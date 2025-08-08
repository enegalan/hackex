@php
    $user = session('hackedUser', Auth::user());
    $user->refresh();
@endphp
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    @include('includes.layouts.head', ['title' => 'Log'])
    <body>
        @include('includes.modal', ['modals' => []])
        <form action="/save-log" method="post" id="log">
            @csrf
            <h4><b><span>{{ $user['username'] }}</span>'s </b><span>Log</span></h4>
            <section class="log-textarea">
                <textarea rows="27" name="log" id="log">{{ $user['log'] }}</textarea>
                <input type="hidden" name="user_id" id="user-id-input" value="{{ $user['id'] }}">
            </section>
            <section class="max-size">
                <span>max size: </span>
                <span>{{ \App\Enums\MaxLogSizes::getMaxLogSize($user['notepad_level'], true) }}</span>
            </section>
            <section class="log-buttons">
                <button type="submit" class="main-btn save-button">Save</button>
            </section>
        </form>
        @include('includes.buttons.back-btn')
    </body>
    @include('includes.scripts', ['scripts' => ['log']])
    @include('includes.notifications')
</html>