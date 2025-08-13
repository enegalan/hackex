@php
    if (!Auth::check()) {
        return;
    }
    $user = Auth::user();
    $user->refresh();
    $friends = \App\Models\Friendship::where('accepted', true)->where('user_id', $user->id)->orWhere('friend_id', $user->id)->get();
@endphp
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    @include('includes.layouts.head', ['title' => __('common.contacts')])
    <body>
        @include('includes.modal', ['modals' => ['add-contact', 'requests', 'remove-contact']])
        <section id="contacts">
            <h4>{{ __('common.contacts') }}</h4>
            <section class="contacts-info">
                <div>
                    <div style="width: 100%;" class="button-wrapper">
                        <button onclick="openAddContactModal()" type="button" class="button add-button">{{ __('contacts.add') }}</button>
                        <div class="input-glow"></div>
                    </div>
                </div>
                <div>
                    <div style="width: 100%;" class="button-wrapper">
                        <button onclick="openRequestsModal()" type="button" class="button requests-button">{{ __('contacts.requests') }}</button>
                        <div class="input-glow"></div>
                    </div>
                </div>
            </section>
            <section class="contacts-frames">
                @if (count($friends) === 0)
                    <p class="empty-frame-message">{{ __('contacts.no_contact') }}</p>
                @endif
                <ul>
                    @foreach ($friends as $friend)
                        @php
                            $requestMaker = $friend->User->id === Auth::id() ? $friend->Friend : $friend->User;
                        @endphp
                        <li onclick="openRemoveContactModal({{ $friend->id }})" class="contact">
                            <div class="contact-top">
                                <div class="subject">
                                    <div class="player">
                                        @include('includes.components.player_level', ['user' => $requestMaker, 'showLevel' => true])
                                        <span class="subject-value">{{ $requestMaker->username }}</span>
                                    </div>
                                    <span class="subject-value">{{ $requestMaker->ip }}</span>
                                </div>
                                <div class="friend-date">
                                    <span class="friend-date">{{ __('contacts.friend_since', ['date' => $requestMaker->created_at]) }}</span>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </section>
        </section>
        @include('includes.buttons.back-btn', ['callback' => "redirect('/messages')"])
    </body>
    @include('includes.scripts', ['scripts' => ['contacts']])
    @include('includes.notifications')
</html>