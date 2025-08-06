@php
    if (!Auth::check()) {
        return;
    }
    $user = Auth::user();
    $user->refresh();
    $friends = \App\Models\Friendship::where('accepted', true)->where('user_id', $user->id)->orWhere('friend_id', $user->id)->get();
@endphp
<div style="z-index: 3;" id="compose-modal" class="modal" closable="true">
    <section class="modal-frame">
        <section id="modal-top">
            <div class="app_label">Compose</div>
        </section>
        <form method="post" action="/friend/compose" id="compose-form">
            @csrf
            <div style="display:flex; align-items: center; justify-content: left; gap: .5rem;">
                <label for="to">To:</label>
                <select name="to" id="compose-to">
                    @if ($friends->count() === 0)
                        <option value="-1">You have no contacts</option>
                    @else
                        <option value="-1">Select a contact...</option>
                        @foreach ($friends as $friend)
                            @php
                                $requestMaker = $friend->User->id === Auth::id() ? $friend->Friend : $friend->User;
                            @endphp
                            <option value="{{ $requestMaker->id }}">{{ $requestMaker->username }}</option>
                        @endforeach
                    @endif
                </select>
            </div>
            <input type="text" name="subject" id="compose-subject" placeholder="subject">
            <textarea name="message" id="compose-message" placeholder="message"></textarea>
            <div style="display: flex; align-items: center; justify-content: center;">
                <button style="width: auto;" class="main-btn send-button" type="submit">SEND</button>
            </div>
        </form>
    </section>
    @include('includes.back-btn', ['callback' => 'closeComposeModal()'])
</div>
