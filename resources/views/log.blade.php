<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    @include('includes.head', ['title' => 'Messages'])
    <body>
        @include('includes.modal')
        <section id="log">
            <h4><b><span>Eneko</span>'s </b><span>Log</span></h4>
            <section class="log-textarea">
                <textarea rows="27" name="log" id="log"></textarea>
            </section>
            <section class="max-size">
                <span>max size: </span>
                <span>4kb</span>
            </section>
            <section class="log-buttons">
                <button class="save-button">Save</button>
            </section>
        </section>
        @include('includes.back-btn')
    </body>
    @include('includes.scripts', ['scripts' => []])
</html>