@php
    $user = session('hackedUser', Auth::user());
    $user->refresh();
    $receivedMessages = $user->ReceivedMessage()->get()->reverse();
@endphp
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    @include('includes.layouts.head', ['title' => 'Messages'])
    <body>
        @include('includes.modal', ['modals' => ['compose']])
        <section id="messages-main">
            <h4>Messages</h4>
            <section class="messages-info">
                <button type="button" onclick="redirect('/contacts')" class="main-btn contact-button">CONTACTS</button>
                <button type="button" onclick="openComposeModal()" class="main-btn compose-button">COMPOSE</button>
            </section>
            <section class="messages-frames">
                @if ($receivedMessages->count() === 0)
                    <p class="empty-frame-message">Your inbox is empty.</p>
                @endif
                <ul>
                    @foreach ($receivedMessages as $receivedMessage)
                        <li onclick="submitForm('message-form-{{ $receivedMessage->id }}')" class="message">
                            <form id="message-form-{{ $receivedMessage->id }}" method="post" action="/message">
                                @csrf
                                <input type="hidden" name="message_id" value="{{ $receivedMessage->id }}">
                            </form>
                            <div class="message-top">
                                <div class="subject">
                                    @if ($receivedMessage['from_hackex'])
                                        <div class="from-hackex logo-title">
                                            <span id="logo-1">HACK</span>
                                            <span id="logo-2">EX</span>
                                        </div>
                                    @endif
                                    <span class="subject-value">{{ $receivedMessage['subject'] }}</span>
                                </div>
                                <div class="date-autor">
                                    <span class="message-date">{{ $receivedMessage['created_at'] }}</span>
                                    <span>-</span>
                                    <span class="message-date">{{ $receivedMessage['from_hackex'] ? 'Hack Ex Admin' : $receivedMessage->Sender->username }}</span>
                                </div>
                            </div>
                            <div class="message-content">
                                <span class="message-value">{!! truncateWithDots($receivedMessage['message']) !!}</span>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </section>
        </section>
        @include('includes.buttons.back-btn')
    </body>
    @include('includes.scripts', ['scripts' => ['messages']])
    @include('includes.notifications')
</html>