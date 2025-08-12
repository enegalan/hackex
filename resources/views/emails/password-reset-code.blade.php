<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <body>
        <h2>Recover your password</h2>
        <p style="#585858">Your recovery code is:</p>
        <h2 style="font-size: 32px; letter-spacing: 4px;">{{ $code }}</h2>
        <p style="color: #9a9a9a;">This code will expire in 10 minutes.</p>
    </body>
</html>