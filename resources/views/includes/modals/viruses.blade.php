@php
    if (!Auth::check()) {
        return;
    }
@endphp
<div id="viruses-modal" class="modal">
    <section class="modal-frame">
        <section id="modal-top">
            <div class="title">Viruses</div>
        </section>
        <section class="buttons">
            <input type="hidden" name="user_id" id="input-user-id-5">
            <div>
                <button onclick="toggleVirusList(this, 'spam', 'virus-form')" type="button" class="main-btn virus-button spam-button">Spam</button>
                <form style="display: none;" id="virus-form" action="/upload/spam" method="post" class="modal-content virus-list">
                    @csrf
                    <ul class="scrollbar-none">
                        @foreach (range(Auth::user()['spam_level'], 1, -1) as $level)
                            <li class="virus-level spam-level" onclick="submitUpload('virus-form')">
                                <label for="spam-level-{{ Auth::user()['spam_level'] }}">level {{ $level }}</label>
                                <input type="checkbox" name="app_level" id="spam-level-{{ $level }}">
                            </li>
                        @endforeach
                    </ul>
                    <input type="hidden" name="user_id" id="input-user-id-5-hidden">
                </form>
            </div>
            <div>
                <button onclick="toggleVirusList(this, 'spyware', 'upload-spyware-form')" type="button" class="main-btn virus-button spyware-button">Spyware</button>
                <form style="display: none;" id="upload-spyware-form" action="/upload/spyware" method="post" class="modal-content virus-list">
                    @csrf
                    <ul class="scrollbar-none">
                        @foreach (range(Auth::user()['spyware_level'], 1, -1) as $level)
                            <li class="virus-level spyware-level" onclick="submitUpload('upload-spyware-form')">
                                <label for="spyware-level-{{ $level }}">level {{ $level }}</label>
                                <input type="checkbox" name="app_level" id="spyware-level-{{ $level }}">
                            </li>
                        @endforeach
                    </ul>
                    <input type="hidden" name="user_id" id="input-user-id-6-hidden">
                </form>
            </div>
        </section>
    </section>
</div>
