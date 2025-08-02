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
                            <span id="oc-value">{{ formatNumber(Auth::user()['oc']) }}</span>
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
                        <input type="hidden" name="bypassing-running-value" id="bypassing-running-value-input" value="{{ Auth::user()->Bypass->where('status', \App\Models\Bypass::WORKING)->count() }}">
                        <span>Bypassing</span>
                    </div>
                    <div class="process-tab" id="cracking-tab">
                        <input type="hidden" name="cracking-total-value" id="cracking-total-value-input" value="{{ Auth::user()->Crack->count() }}">
                        <input type="hidden" name="cracking-running-value" id="cracking-running-value-input" value="{{ Auth::user()->Crack->where('status', \App\Models\Crack::WORKING)->count() }}">
                        <span>Cracking</span>
                    </div>
                    <div class="process-tab" id="transfer-tab">
                        <input type="hidden" name="transfer-total-value" id="transfer-total-value-input" value="{{ Auth::user()->Transfer->count() }}">
                        <input type="hidden" name="transfer-running-value" id="transfer-running-value-input" value="{{ Auth::user()->Transfer->where('status', \App\Models\Transfer::WORKING)->count() }}">
                        <span>Network</span>
                    </div>
                </div>
            </section>
            <section class="processes-frames">
                <section id="bypassing-frame">
                    @if (Auth::user()->Bypass->count() === 0)
                        <p class="empty-frame-message">You have no bypass processes</p>
                    @endif
                    <ul>
                        @foreach (Auth::user()->Bypass->reverse() as $bypass)
                            @php
                                // Ensure bypass is updated
                                \App\Http\Controllers\BypassController::checkAndUpdateBypass($bypass);
                            @endphp
                            <li onclick="openHackWindow('bypass', {{ $bypass['id'] }}, {{ $bypass['status'] === \App\Models\Bypass::SUCCESSFUL ? false : true }})" timezone-replacing data-created-at="{{ \Carbon\Carbon::parse($bypass['created_at'])->toIso8601String() }}"
                                data-expires-at="{{ \Carbon\Carbon::parse($bypass['expires_at'])->toIso8601String() }}">
                                <div class="process-topwrap">
                                    <div class="process-info">
                                        <span class="process-ip">{{ $bypass->Victim['ip'] }}</span>
                                        @if ($bypass['status'] === \App\Models\Bypass::WORKING)
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
                                    @if ($bypass['status'] === \App\Models\Bypass::WORKING)
                                        <div class="process-status working">
                                            <span class="progress-percentage">0%</span>
                                            <span class="time-remaining"> - {{ diffInHumanTime($bypass['expires_at']) }}</span>
                                        </div>
                                    @elseif ($bypass['status'] === \App\Models\Bypass::SUCCESSFUL)
                                        <div class="process-status successful">
                                            <span>Bypass</span>
                                            <span> successful</span>
                                        </div>
                                    @elseif ($bypass['status'] === \App\Models\Bypass::FAILED)
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
                    </ul>
                </section>
                <section id="cracking-frame">
                    @if (Auth::user()->Crack->count() === 0)
                        <p class="empty-frame-message">You have no crack processes</p>
                    @endif
                    <ul>
                        @foreach (Auth::user()->Crack->reverse() as $crack)
                            @php
                                // Ensure transfer is updated
                                \App\Http\Controllers\CrackController::checkAndUpdateCrack($crack);
                            @endphp
                            <li onclick="openHackWindow('crack', '{{ $crack['id'] }}', true)" timezone-replacing data-created-at="{{ \Carbon\Carbon::parse($crack['created_at'])->toIso8601String() }}"
                                data-expires-at="{{ \Carbon\Carbon::parse($crack['expires_at'])->toIso8601String() }}">
                                <div class="process-topwrap">
                                    <div class="process-info">
                                        <span class="process-ip">{{ $crack->Victim['ip'] }}</span>
                                        @if ($crack['status'] === \App\Models\Bypass::WORKING)
                                            {{-- Working --}}
                                            <span class="process-date">Cracking</span>
                                        @else
                                            {{-- Successful or Failed --}}
                                            <span class="process-date">{{ diffInHumanTime($crack['expires_at'], false) }}</span>
                                            <span class="process-ago"> ago</span>
                                        @endif
                                    </div>
                                    <div class="checkbox">
                                        <input type="checkbox" name="select-process" class="select-1">
                                    </div>
                                </div>
                                <progress-bar class="progress-bar {{ $crack['status'] === 2 ? 'failed' : ''}}">
                                    <div class="bar"></div>
                                </progress-bar>
                                <div class="process-bottomwrap">
                                    @if ($crack['status'] === \App\Models\Crack::WORKING)
                                        <div class="process-status working">
                                            <span class="progress-percentage">0%</span>
                                            <span class="time-remaining"> - {{ diffInHumanTime($crack['expires_at']) }}</span>
                                        </div>
                                    @elseif ($crack['status'] === \App\Models\Crack::SUCCESSFUL)
                                        <div class="process-status successful">
                                            <span>Crack</span>
                                            <span> successful</span>
                                        </div>
                                    @endif
                                    <div class="process-level">
                                        <span>Encryptor level </span>
                                        <span>{{ $crack->Victim['password_encryptor_level'] }}</span>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </section>
                <section id="transfer-frame">
                    @if (Auth::user()->Transfer->count() === 0)
                        <p class="empty-frame-message">You have no network processes</p>
                    @endif
                    <ul>
                        @foreach (Auth::user()->Transfer->reverse() as $transfer)
                            @php
                                // Ensure transfer is updated
                                \App\Http\Controllers\TransferController::checkAndUpdateTransfer($transfer);
                            @endphp
                            <li onclick="openHackWindow('transfer', '{{ $transfer['id'] }}', true)" timezone-replacing data-created-at="{{ \Carbon\Carbon::parse($transfer['created_at'])->toIso8601String() }}"
                                data-expires-at="{{ \Carbon\Carbon::parse($transfer['expires_at'])->toIso8601String() }}">
                                <div class="process-topwrap">
                                    <div class="process-info">
                                        <span class="process-ip">{{ $transfer->Victim['ip'] }}</span>
                                        @if ($transfer['status'] === \App\Models\Transfer::WORKING)
                                            {{-- Working --}}
                                            @if ($transfer['type'] === \App\Models\Transfer::DOWNLOAD)
                                                <span class="process-date">Downloading</span>
                                            @else
                                                <span class="process-date">Uploading</span>
                                            @endif
                                        @else
                                            {{-- Successful or Failed --}}
                                            <span class="process-date">{{ diffInHumanTime($transfer['expires_at'], false) }}</span>
                                            <span class="process-ago"> ago</span>
                                        @endif
                                    </div>
                                    <div class="checkbox">
                                        <input type="checkbox" name="select-process" class="select-1">
                                    </div>
                                </div>
                                <progress-bar class="progress-bar {{ $transfer['status'] === 2 ? 'failed' : ''}}">
                                    <div class="bar"></div>
                                </progress-bar>
                                <div class="process-bottomwrap">
                                    @if ($transfer['status'] === \App\Models\Transfer::WORKING)
                                        <div class="process-status working">
                                            <span class="progress-percentage">0%</span>
                                            <span class="time-remaining"> - {{ diffInHumanTime($transfer['expires_at']) }}</span>
                                        </div>
                                    @elseif ($transfer['status'] === \App\Models\Transfer::SUCCESSFUL)
                                        <div class="process-status successful">
                                            <span>Bypass</span>
                                            <span> successful</span>
                                        </div>
                                    @endif
                                    <div class="process-level">
                                        <span>{{ \App\Enums\Apps::getAppName($transfer->app_name) }} level </span>
                                        <span>{{ $transfer->type === \App\Models\Transfer::DOWNLOAD ? $transfer->Victim[$transfer->app_name . '_level'] : $transfer->app_level }}</span>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </section>
            </section>
        </section>
        @include('includes.back-btn')
    </body>
    @include('includes.scripts', ['scripts' => ['processes', 'progress-bar']])
</html>