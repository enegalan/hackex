<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    @include('includes.head', ['title' => 'Processes'])
    <body>
        @include('includes.modal')
        <section id="processes">
            <h4>Processes</h4>
            <section class="processes-info">
                <section>
                    <div>
                        <span>Total: </span>
                        <span>1</span>
                    </div>
                    <div>
                        <span>Running: </span>
                        <span>0</span>
                    </div>
                </section>
                <section>
                    <div>
                        <span>7071</span>
                        <div>
                            <span> OC</span>
                            <div class="oc-logo"></div>
                        </div>
                    </div>
                </section>
            </section>
            <section class="processes-tabs">
                <div class="tabs">
                    <div class="process-tab" id="bypassing-tab">
                        <span>Bypassing</span>
                    </div>
                    <div class="process-tab" id="cracking-tab">
                        <span>Cracking</span>
                    </div>
                    <div class="process-tab" id="network-tab">
                        <span>Network</span>
                    </div>
                </div>
            </section>
            <section class="processes-frames">
                <section id="bypassing-frame">
                    <ul>
                        <li>
                            <div>
                                <div>
                                    <span>187.62.160.15</span>
                                    <span>139d 14h 24m</span>
                                    <span> ago</span>
                                </div>
                                <div class="checkbox">
                                    <input type="checkbox" name="select-process" id="select-1">
                                </div>
                            </div>
                            <div class="progress-bar">

                            </div>
                            <div>
                                <div class="bypass-status">
                                    <span>Bypass </span>
                                    <span>successful</span>
                                </div>
                                <div class="firewall-level">
                                    <span>Firewall level </span>
                                    <span>443</span>
                                </div>
                            </div>
                        </li>
                    </ul>
                </section>
                <section id="cracking-frame">

                </section>
                <section id="network-frame">

                </section>
            </section>
        </section>
    </body>
    @include('includes.scripts', ['scripts' => ['processes']])
</html>