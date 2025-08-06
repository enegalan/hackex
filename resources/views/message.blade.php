@php
    $user = session('hackedUser', Auth::user());
    $user->refresh();
@endphp
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    @include('includes.head', ['title' => 'Message'])
    <body>
        @include('includes.modal')
        <section id="message-main">
            <h4>{{ $received_message->subject }}</h4>
            <section class="messages-info">
                <button type="button" onclick="openMessageDeleteModal({{ $received_message->id }})" class="main-btn contact-button">DELETE</button>
            </section>
            <section class="messages-frames">
                <div class="message-top">
                    <span class="message-username">{{ $received_message->Sender->username }}</span>
                    <span class="message-date">{{ $received_message->created_at }}</span>
                </div>
                <div class="message-content">
                    <span class="message-value">{!! nl2br($received_message->message) !!}</span>
                </div>
            </section>
        </section>
    </body>
    @include('includes.back-btn', ['callback' => "redirect('/messages')"])
    @include('includes.scripts', ['scripts' => ['messages']])
    @include('includes.notifications')
</html>