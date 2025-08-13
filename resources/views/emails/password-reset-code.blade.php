<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <body>
        <h2>{{ __('email.recover') }}</h2>
        <p style="#585858">{{ __('email.recover_caption') }}</p>
        <h2 style="font-size: 32px; letter-spacing: 4px;">{{ $code }}</h2>
        <p style="color: #9a9a9a;">{{ __('email.recover_footer') }}</p>
    </body>
</html>