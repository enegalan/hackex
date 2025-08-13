@php
    $user = session('hackedUser', Auth::user());
    $user->refresh();
@endphp
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    @include('includes.layouts.head', ['title' => __('common.log')])
    <body>
        @include('includes.modal', ['modals' => []])
        <form action="/save-log" method="post" id="log">
            @csrf
            <h4><b><span>{{ __('home.device_of', ['username' => $user['username']]) }} </b><span>{{ __('common.log') }}</span></h4>
            <section class="log-textarea">
                <div class="text-area-wrapper">
                    <textarea rows="27" name="log" id="log">{{ $user['log'] }}</textarea>
                    <div class="textarea-glow"></div>
                    <input type="hidden" name="user_id" id="user-id-input" value="{{ $user['id'] }}">
                </div>
            </section>
            <section class="max-size">
                <span>{{ __('log.max_size') }}: </span>
                <span>{{ \App\Enums\MaxLogSizes::getMaxLogSize($user['notepad_level'], true) }}</span>
            </section>
            <section class="log-buttons">
                <div>
                    <div style="width: 100%;" class="button-wrapper">
                        <button type="submit" class="button save-button">{{ __('common.save') }}</button>
                        <div class="input-glow"></div>
                    </div>
                </div>
            </section>
        </form>
        @include('includes.buttons.back-btn')
    </body>
    @include('includes.scripts', ['scripts' => ['log']])
    @include('includes.notifications')
</html>