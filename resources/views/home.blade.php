<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    @include('includes.head')
    <body>
        <section id="player">
            <div id="player-level">1</div>{{-- TODO: Do dynamic --}}
            <div id="player-name"><b><span id="player-name-value">Eneko</span><span>'s</span></b></div>{{-- TODO: Do dynamic --}}
            <div id="player-platform">Nova I</div>{{-- TODO: Do dynamic --}}
        </section>
        <section id="apps">
            {{-- Processes --}}
            <article id="processes" class="app-frame">
                <button class="app-button">
                    <div id="part-1"></div>
                    <div id="part-2"></div>
                    <div id="part-3"></div>
                </button>
                <label class="app-label">Processes</label>
            </article>
            {{-- Scan --}}
            <article id="scan" class="app-frame">
                <button class="app-button">
                    <div id="part-1"></div>
                    <div id="part-2"></div>

                    <div id="part-3"></div>

                    <div id="part-4"></div>

                    <div id="part-5"></div>
                    <div id="part-6"></div>
                    <div id="part-7"></div>

                    <div id="part-8"></div>

                    <div id="part-9"></div>
                    <div id="part-10"></div>
                    <div id="part-11"></div>
                    <div id="part-12"></div>
                    <div id="part-13"></div>

                    <div id="part-14"></div>
                </button>
                <label class="app-label">Scan</label>
            </article>
            {{-- Bank Account --}}
            <article id="bank-account" class="app-frame">
                <button class="app-button">
                    <div id="bank-logo">
                        <div id="part-1">
                            <div id="part-2">
                                <div id="part-3">
                                    <div id="part-4"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <span>PNT</span>
                </button>
                <label class="app-label">Bank account</label>
            </article>
            {{-- Store --}}
            <article id="store" class="app-frame">
                <button class="app-button">
                    <div class="bitcoin hover">
                        <div class="circle">
                            <div class="wrapper">
                                        <div class="element-1 primary-element"></div>
                                <div class="element-2 primary-element"></div>
                                <div class="element-3 primary-element"></div>
                                <div class="element-4 primary-element"></div>
                                <div class="element-5 primary-element"></div>
                                <div class="element-6 primary-element"></div>
                                <div class="element-7 primary-element"></div>
                                <div class="element-8 primary-element"></div>
                                <div class="element-9 bg-element"></div>
                                <div class="element-10 bg-element"></div>
                                <div class="element-11 bg-element"></div>
                                <div class="element-12 primary-element"></div>
                                <div class="element-13 primary-element"></div>
                            </div>
                            </div>
                        </div>
                </button>
                <label class="app-label">Store</label>
            </article>
            {{-- Contacts --}}
            <article id="contacts" class="app-frame">
                <button class="app-button">
                    <div class="folder">
                        <div class="details"></div>
                        <div class="person"></div>
                    </div>
                </button>
                <label class="app-label">Contacts</label>
            </article>
            {{-- Log --}}
            <article id="log" class="app-frame">
                <button class="app-button">
                    <div id="log-frame">
                        <span>EX:/></span>
                        <span id="encrypted-text">Lorem ipsum dolor sit amet consectetur adipisicing elit</span>
                        <div id="log-scroll">
                            <div id="close">X</div>
                            <div id="scrollbar">
                                <div id="scroll-up">▲</div>
                                <div id="scroll-bar"></div>
                                <div id="scroll-down">▼</div>
                            </div>
                        </div>
                    </div>
                </button>
                <label class="app-label">Log</label>
            </article>
            {{-- Apps --}}
            <article id="apps" class="app-frame">
                <button class="app-button">
                    <div id="apps-grid">
                        <div id="app-1"></div>
                        <div id="app-2"></div>
                        <div id="app-3"></div>
                        <div id="app-4"></div>
                    </div>
                </button>
                <label class="app-label">Apps</label>
            </article>
            {{-- My Device --}}
            <article id="device" class="app-frame">
                <button class="app-button">
                    <div class="app-img">
                        {{-- TODO: Add image <img> --}}
                    </div>
                </button>
                <label class="app-label">My Device</label>
            </article>
        </section>
    </body>
</html>