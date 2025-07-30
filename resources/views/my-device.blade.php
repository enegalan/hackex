<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    @include('includes.head', ['title' => 'Messages'])
    <body>
        @include('includes.modal')
        <section id="my-device">
            <h4>My Device</h4>
            <section class="device-info-frame">
                <div class="device-info">
                    <div class="ip-info">
                        <span>IP:</span>
                        <span>218.215.254.101</span>
                    </div>
                    <div class="specs-info">
                        <ul>
                            <li>
                                <span>Platform:</span>
                                <span>Nova I</span>
                            </li>
                            <li>
                                <span>CPU:</span>
                                <span>3.25 GHz 8 Core</span>
                            </li>
                            <li>
                                <span>Network:</span>
                                <span>5GS</span>
                            </li>
                        </ul>
                    </div>
                </div>
                <button class="change-ip-button">Change IP</button>
            </section>
            <section class="other-buttons">
                <ul>
                    <li>
                        <button class="leaderboards-button">Leaderboards</button>
                    </li>
                    <li>
                        <button class="wallpaper-button">Wallpaper</button>
                    </li>
                    <li>
                        <button class="wiki-button">Wiki / Help</button>
                    </li>
                    <li>
                        <button class="rate-button">Rate the App</button>
                    </li>
                    <li>
                        <button class="faq-button">FAQ</button>
                    </li>
                    <li>
                        <button class="social-links-button">Social Links</button>
                    </li>
                </ul>
            </section>
        </section>
        @include('includes.back-btn')
    </body>
    @include('includes.scripts', ['scripts' => []])
</html>