<div id="viruses-modal" class="modal">
    <section class="modal-frame">
        <section id="modal-top">
            <div class="title">Viruses</div>
        </section>
        <section class="buttons">
            <input type="hidden" name="user_id" id="input-user-id">
            <div>
                <button onclick="toggleVirusList(this, 'spam', 'spam-form')" type="button" class="virus-button spam-button">Spam</button>
                <form style="display: none;" id="spam-form" action="/upload/spam" method="post" class="modal-content virus-list">
                    @csrf
                    <ul class="scrollbar-none">
                        @foreach (range(Auth::user()['spam_level'], 1, -1) as $level)
                            <li class="virus-level spam-level" onclick="submitUpload('spam-form')">
                                <label for="spam-level-{{ Auth::user()['spam_level'] }}">level {{ $level }}</label>
                                <input type="checkbox" name="app_level" id="spam-level-{{ $level }}">
                            </li>
                        @endforeach
                    </ul>
                    <input type="hidden" name="user_id" id="input-user-id-2">
                </form>
            </div>
            <div>
                <button onclick="toggleVirusList(this, 'spyware', 'spyware-form')" type="button" class="virus-button spyware-button">Spyware</button>
                <form style="display: none;" id="spyware-form" action="/upload/spyware" method="post" class="modal-content virus-list">
                    @csrf
                    <ul class="scrollbar-none">
                        @foreach (range(Auth::user()['spyware_level'], 1, -1) as $level)
                            <li class="virus-level spyware-level" onclick="submitUpload('spyware-form')">
                                <label for="spyware-level-{{ $level }}">level {{ $level }}</label>
                                <input type="checkbox" name="app_level" id="spyware-level-{{ $level }}">
                            </li>
                        @endforeach
                    </ul>
                    <input type="hidden" name="user_id" id="input-user-id-2">
                </form>
            </div>
        </section>
    </section>
</div>
