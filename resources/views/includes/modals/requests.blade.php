@php
    if (!Auth::check()) {
        return;
    }
    $friendRequests = \App\Models\Friendship::where('friend_id', Auth::id())->where('accepted', false)->get();
@endphp
<div style="z-index: 3;" id="requests-modal" class="modal" closable="true">
    <section class="modal-frame">
        <section id="modal-top">
            <div class="app_label">Contact Requests</div>
        </section>
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
                            <button class="main-btn accept-button" type="submit">Accept</button>
                        </form>
                        <form method="post" action="/friend/decline" id="decline-request-form">
                            @csrf
                            <input type="hidden" name="friend_request_id" value="{{ $friendRequest->id }}">
                            <button class="main-btn decline-button" type="submit">Decline</button>
                        </form>
                    </div>
                </li>
            @endforeach
        </ul>
    </section>
    @include('includes.back-btn', ['callback' => 'closeRequestsModal()'])
</div>
