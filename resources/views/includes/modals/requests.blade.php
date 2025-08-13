@php
    if (!Auth::check()) {
        return;
    }
    $friendRequests = \App\Models\Friendship::where('friend_id', Auth::id())->where('accepted', false)->get();
@endphp
<div style="z-index: 3;" id="requests-modal" class="modal" closable="true">
    <section class="card modal-frame">
        <section>
            <section id="modal-top">
                <div class="app_label">{{ __('contacts.contact_requests') }}</div>
            </section>
            @if ($friendRequests->count() === 0)
                <p class="empty-frame-message">{{ __('contacts.no_request') }}</p>
            @endif
            <ul id="requests-list">
                @foreach ($friendRequests as $friendRequest)
                    <li class="friend-request">
                        <div class="request-info">
                            <h3 class="request-user">{{ $friendRequest->User->ip }} - {{ $friendRequest->User->username }}</h3>
                            <h4 class="request-date">{{ $friendRequest->created_at }}</h4>
                        </div>
                        <div class="request-action">
                            <form method="post" action="/friend/accept" id="accept-request-form">
                                @csrf
                                <input type="hidden" name="friend_request_id" value="{{ $friendRequest->id }}">
                                <div style="width: 100%;" class="button-wrapper">
                                    <button class="button accept-button" type="submit">{{ __('common.accept') }}</button>
                                    <div class="input-glow"></div>
                                </div>
                            </form>
                            <form method="post" action="/friend/decline" id="decline-request-form">
                                @csrf
                                <input type="hidden" name="friend_request_id" value="{{ $friendRequest->id }}">
                                <div style="width: 100%;" class="button-wrapper">
                                    <button class="button decline-button" type="submit">{{ __('common.decline') }}</button>
                                    <div class="input-glow"></div>
                                </div>
                            </form>
                        </div>
                    </li>
                @endforeach
            </ul>
        </section>
    </section>
    @include('includes.buttons.back-btn', ['callback' => 'closeRequestsModal()'])
</div>
