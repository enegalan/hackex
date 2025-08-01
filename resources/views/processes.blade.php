<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    @include('includes.head', ['title' => 'Processes'])
    <body>
        @include('includes.modal')
        <section id="processes">
            <section class="processes-topwrap">
                <h4>Processes</h4>
                <section class="processes-info">
                    <section class="processes-counters">
                        <div class="total-counter">
                            <span>Total: </span>
                            <span id="total-value">0</span>
                        </div>
                        <div class="running-counter">
                            <span>Running: </span>
                            <span id="running-value">0</span>
                        </div>
                    </section>
                    <section class="oc-counters">
                        <div class="oc-counter">
                            <span id="oc-value">{{ Auth::user()['oc'] }}</span>
                            <div class="oc-label">
                                <span> OC</span>
                                <div class="oc-logo"></div>
                            </div>
                        </div>
                    </section>
                </section>
            </section>
            <section class="processes-tabs">
                <div class="tabs">
                    <div class="process-tab" id="bypassing-tab">
                        <input type="hidden" name="bypassing-total-value" id="bypassing-total-value-input" value="{{ Auth::user()->Bypass->count() }}">
                        <input type="hidden" name="bypassing-running-value" id="bypassing-running-value-input" value="{{ Auth::user()->Bypass->where('status', 0)->count() }}">
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
                        @foreach (Auth::user()->Bypass->reverse() as $bypass)
                            @php
                                // Ensure bypass is updated
                                \App\Http\Controllers\BypassController::checkAndUpdateBypass($bypass);
                            @endphp
                            <li timezone-replacing data-created-at="{{ \Carbon\Carbon::parse($bypass['created_at'])->toIso8601String() }}"
                                data-expires-at="{{ \Carbon\Carbon::parse($bypass['expires_at'])->toIso8601String() }}">
                                <div class="process-topwrap">
                                    <div class="process-info">
                                        <span class="process-ip">{{ $bypass->Victim['ip'] }}</span>
                                        @if ($bypass['status'] === 0)
                                            {{-- Working --}}
                                            <span class="process-date">Bypassing</span>
                                        @else
                                            {{-- Successful or Failed --}}
                                            <span class="process-date">{{ diffInHumanTime($bypass['expires_at'], false) }}</span>
                                            <span class="process-ago"> ago</span>
                                        @endif
                                    </div>
                                    <div class="checkbox">
                                        <input type="checkbox" name="select-process" class="select-1">
                                    </div>
                                </div>
                                <progress-bar class="progress-bar {{ $bypass['status'] === 2 ? 'failed' : ''}}">
                                    <div class="bar"></div>
                                </progress-bar>
                                <div class="process-bottomwrap">
                                    @if ($bypass['status'] === 0)
                                        {{-- Working --}}
                                        <div class="process-status working">
                                            <span class="progress-percentage">0%</span>
                                            <span class="time-remaining"> - {{ diffInHumanTime($bypass['expires_at']) }}</span>
                                        </div>
                                    @elseif ($bypass['status'] === 1)
                                        {{-- Successful --}}
                                        <div class="process-status successful">
                                            <span>Bypass</span>
                                            <span> successful</span>
                                        </div>
                                    @elseif ($bypass['status'] === 2)
                                        {{-- Failed --}}
                                        <div class="process-status failed">
                                            <span>Bypass</span>
                                            <span> failed</span>
                                        </div>
                                    @endif
                                    <div class="process-level">
                                        <span>Firewall level </span>
                                        <span>{{ $bypass->Victim['firewall_level'] }}</span>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                        {{-- <li>
                            <div class="process-topwrap">
                                <div class="process-info">
                                    <span class="process-ip">187.62.160.15</span>
                                    <span class="process-date">139d 14h 24m</span>
                                    <span class="process-ago"> ago</span>
                                </div>
                                <div class="checkbox">
                                    <input type="checkbox" name="select-process" id="select-1">
                                </div>
                            </div>
                            <progress-bar value="80" class="progress-bar">
                                <div class="bar"></div>
                            </progress-bar>
                            <div class="process-bottomwrap">
                                <div class="process-status successful">
                                    <span>Bypass</span>
                                    <span> successful</span>
                                </div>
                                <div class="process-level">
                                    <span>Firewall level </span>
                                    <span>443</span>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="process-topwrap">
                                <div class="process-info">
                                    <span class="process-ip">30.93.30.18</span>
                                    <span class="process-date">Bypassing</span>
                                    <span class="process-ago"></span>
                                </div>
                                <div class="checkbox">
                                    <input type="checkbox" name="select-process" id="select-1">
                                </div>
                            </div>
                            <progress-bar value="30" class="progress-bar">
                                <div class="bar"></div>
                            </progress-bar>
                            <div class="process-bottomwrap">
                                <div class="process-status working">
                                    <span>0.21%</span>
                                    <span> - 1d 3h 39m 10s</span>
                                </div>
                                <div class="process-level">
                                    <span>Firewall level </span>
                                    <span>436</span>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="process-topwrap">
                                <div class="process-info">
                                    <span class="process-ip">128.12.20.08</span>
                                    <span class="process-date">12d 12h 10m</span>
                                    <span class="process-ago"> ago</span>
                                </div>
                                <div class="checkbox">
                                    <input type="checkbox" name="select-process" id="select-1">
                                </div>
                            </div>
                            <progress-bar value="100" class="progress-bar failed">
                                <div class="bar"></div>
                            </progress-bar>
                            <div class="process-bottomwrap">
                                <div class="process-status failed">
                                    <span>Bypass</span>
                                    <span> failed</span>
                                </div>
                                <div class="process-level">
                                    <span>Firewall level </span>
                                    <span>649</span>
                                </div>
                            </div>
                        </li>
                    </ul>
                </section>
                <section id="cracking-frame">
                    <ul>
                        <li>
                            <div class="process-topwrap">
                                <div class="process-info">
                                    <span class="process-ip">187.62.160.15</span>
                                    <span class="process-date">135d 10h 14m</span>
                                    <span class="process-ago"> ago</span>
                                </div>
                                <div class="checkbox">
                                    <input type="checkbox" name="select-process" id="select-1">
                                </div>
                            </div>
                            <progress-bar value="100" class="progress-bar">
                                <div class="bar"></div>
                            </progress-bar>
                            <div class="process-bottomwrap">
                                <div class="process-status successful">
                                    <span>Crack</span>
                                    <span> successful</span>
                                </div>
                                <div class="process-level">
                                    <span>Encryptor level </span>
                                    <span>154</span>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="process-topwrap">
                                <div class="process-info">
                                    <span class="process-ip">123.162.120.15</span>
                                    <span class="process-date">166d 20h 14m</span>
                                    <span class="process-ago"> ago</span>
                                </div>
                                <div class="checkbox">
                                    <input type="checkbox" name="select-process" id="select-1">
                                </div>
                            </div>
                            <progress-bar value="100" class="progress-bar">
                                <div class="bar"></div>
                            </progress-bar>
                            <div class="process-bottomwrap">
                                <div class="process-status successful">
                                    <span>Crack</span>
                                    <span> successful</span>
                                </div>
                                <div class="process-level">
                                    <span>Encryptor level </span>
                                    <span>222</span>
                                </div>
                            </div>
                        </li>
                    </ul>
                </section>
                <section id="network-frame">
                    <ul>
                        <li>
                            <div class="process-topwrap">
                                <div class="process-info">
                                    <span class="process-ip">187.62.160.15</span>
                                    <span class="process-date">135d 10h 14m</span>
                                    <span class="process-ago"> ago</span>
                                </div>
                                <div class="checkbox">
                                    <input type="checkbox" name="select-process" id="select-1">
                                </div>
                            </div>
                            <progress-bar value="100" class="progress-bar">
                                <div class="bar"></div>
                            </progress-bar>
                            <div class="process-bottomwrap">
                                <div class="process-status successful">
                                    <span>Download</span>
                                    <span> complete</span>
                                </div>
                                <div class="process-level">
                                    <span>Spyware level </span>
                                    <span>154</span>
                                </div>
                            </div>
                        </li> --}}
                    </ul>
                </section>
            </section>
        </section>
        @include('includes.back-btn')
    </body>
    @include('includes.scripts', ['scripts' => ['processes', 'progress-bar']])
</html>