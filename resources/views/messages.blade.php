<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    @include('includes.head', ['title' => 'Messages'])
    <body>
        @include('includes.modal')
        <section id="messages">
            <h4>Messages</h4>
            <section class="messages-info">
                <button class="contact-button">CONTACTS</button>
                <button class="compose-button">COMPOSE</button>
            </section>
            <section class="messages-frames">
                <ul>
                    <li>
                        <div>
                            WIP
                        </div>
                    </li>
                </ul>
            </section>
        </section>
        @include('includes.back-btn')
    </body>
    @include('includes.scripts', ['scripts' => []])
</html>