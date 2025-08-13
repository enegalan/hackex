<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    @include('includes.layouts.head', ['title' => __('common.processes')])
    <body>
        @include('includes.modal', ['modals' => ['hack']])
        <section id="processes">
            <section class="processes-topwrap">
                <h4>{{ __('common.processes') }}</h4>
                <section class="processes-info">
                    <section class="processes-counters">
                        <div class="total-counter">
                            <span>{{ __('common.total') }}: </span>
                            <span id="total-value">0</span>
                        </div>
                        <div class="running-counter">
                            <span>{{ __('common.running') }}: </span>
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
                        <input type="hidden" name="bypassing-total-value" id="bypassing-total-value-input" value="{{ Auth::user()->Bypass()->where('visible', true)->count() }}">
                        <input type="hidden" name="bypassing-running-value" id="bypassing-running-value-input" value="{{ Auth::user()->Bypass()->where('status', \App\Models\Bypass::WORKING)->count() }}">
                        <span>{{ __('processes.bypassing_tab') }}</span>
                    </div>
                    <div class="process-tab" id="cracking-tab">
                        <input type="hidden" name="cracking-total-value" id="cracking-total-value-input" value="{{ Auth::user()->Crack()->where('visible', true)->count() }}">
                        <input type="hidden" name="cracking-running-value" id="cracking-running-value-input" value="{{ Auth::user()->Crack()->where('visible', true)->where('status', \App\Models\Crack::WORKING)->count() }}">
                        <span>{{ __('processes.cracking_tab') }}</span>
                    </div>
                    <div class="process-tab" id="transfer-tab">
                        <input type="hidden" name="transfer-total-value" id="transfer-total-value-input" value="{{ Auth::user()->Transfer()->where('visible', true)->count() }}">
                        <input type="hidden" name="transfer-running-value" id="transfer-running-value-input" value="{{ Auth::user()->Transfer()->where('visible', true)->where('status', \App\Models\Transfer::WORKING)->count() }}">
                        <span>{{ __('processes.network_tab') }}</span>
                    </div>
                </div>
            </section>
            <section class="processes-frames">
                <section id="bypassing-frame">
                    @if (Auth::user()->Bypass->count() === 0)
                        <p class="empty-frame-message">{{ __('processes.no_bypass') }}</p>
                    @endif
                    <ul>
                        @foreach (Auth::user()->Bypass->reverse() as $bypass)
                            @php
                                // Ensure bypass is updated
                                \App\Http\Controllers\BypassController::checkAndUpdateBypass($bypass);
                            @endphp
                            <li onclick="openHackWindow(this, 'bypass', {{ $bypass['id'] }}, {{ $bypass['status'] === \App\Models\Bypass::SUCCESSFUL ? 'false' : 'true' }}, {{ $bypass['status'] === \App\Models\Bypass::WORKING ? 'false' : 'true' }}, {{ $bypass['status'] === \App\Models\Bypass::WORKING ? formatNumber(\App\Models\Bypass::generateBypassFinishValueOC($bypass)) : 0 }}, {{ $bypass['status'] === \App\Models\Bypass::FAILED ? 'true' : 'false' }})" timezone-replacing data-created-at="{{ \Carbon\Carbon::parse($bypass['created_at'])->toIso8601String() }}"
                                data-expires-at="{{ \Carbon\Carbon::parse($bypass['expires_at'])->toIso8601String() }}">
                                <div class="process-topwrap">
                                    <div class="process-info">
                                        <span class="process-ip">{{ $bypass->Victim['ip'] }}</span>
                                        @if ($bypass['status'] === \App\Models\Bypass::WORKING)
                                            {{-- Working --}}
                                            <span class="process-date">{{ __('processes.bypassing') }}</span>
                                        @else
                                            {{-- Successful or Failed --}}
                                            <span class="process-date">{{ __('processes.process_ago', ['ago' => diffInHumanTime($bypass['expires_at'], false)]) }}</span>
                                        @endif
                                    </div>
                                    <div onclick="event.stopPropagation()" class="checkbox-wrapper-65">
                                        <label for="select-bypass-{{ $bypass['id'] }}">
                                            <input onclick="openRemoveButton('bypass')" type="checkbox" name="selected_process" class="select-1" id="select-bypass-{{ $bypass['id'] }}" process_type="bypass" value="{{ $bypass['id'] }}">
                                            <span class="cbx">
                                                <svg width="12px" height="11px" viewBox="0 0 12 11">
                                                    <polyline points="1 6.29411765 4.5 10 11 1"></polyline>
                                                </svg>
                                            </span>
                                            <div class="cbx-glow"></div>
                                        </label>
                                    </div>
                                </div>
                                <progress-bar class="progress-bar {{ $bypass['status'] === 2 ? 'failed' : ''}}">
                                    <div class="bar">
                                        <div class="bar-glow"></div>
                                    </div>
                                </progress-bar>
                                <div class="process-bottomwrap">
                                    @if ($bypass['status'] === \App\Models\Bypass::WORKING)
                                        <div class="process-status working">
                                            <span class="progress-percentage">0%</span>
                                            <span class="time-remaining"> - {{ diffInHumanTime($bypass['expires_at']) }}</span>
                                        </div>
                                    @elseif ($bypass['status'] === \App\Models\Bypass::SUCCESSFUL)
                                        <div class="process-status successful">
                                            <span>{{ __('processes.bypass_successful') }}</span>
                                        </div>
                                    @elseif ($bypass['status'] === \App\Models\Bypass::FAILED)
                                        <div class="process-status failed">
                                            <span>{{ __('processes.bypass_failed') }}</span>
                                        </div>
                                    @endif
                                    <div class="process-level">
                                        <span>{{ __('processes.firewall_level') }} </span>
                                        <span>{{ $bypass->Victim['firewall_level'] }}</span>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </section>
                <section id="cracking-frame">
                    @if (Auth::user()->Crack->count() === 0)
                        <p class="empty-frame-message">{{ __('processes.no_crack') }}</p>
                    @endif
                    <ul>
                        @foreach (Auth::user()->Crack()->where('visible', true)->get()->reverse() as $crack)
                            @php
                                // Ensure crack is updated
                                \App\Http\Controllers\CrackController::checkAndUpdateCrack($crack);
                            @endphp
                            <li onclick="openHackWindow(this, 'crack', '{{ $crack['id'] }}', 'true', 'false', {{ $crack['status'] === \App\Models\Crack::WORKING ? formatNumber(\App\Models\Crack::generateCrackFinishValueOC($crack)) : 0 }}, {{ $crack['status'] === \App\Models\Crack::FAILED ? 'true' : 'false' }})" timezone-replacing data-created-at="{{ \Carbon\Carbon::parse($crack['created_at'])->toIso8601String() }}"
                                data-expires-at="{{ \Carbon\Carbon::parse($crack['expires_at'])->toIso8601String() }}">
                                <div class="process-topwrap">
                                    <div class="process-info">
                                        <span class="process-ip">{{ $crack->Victim['ip'] }}</span>
                                        @if ($crack['status'] === \App\Models\Bypass::WORKING)
                                            {{-- Working --}}
                                            <span class="process-date">{{ __('processes.cracking') }}</span>
                                        @else
                                            {{-- Successful or Failed --}}
                                            <span class="process-date">{{ __('processes.process_ago', ['ago' => diffInHumanTime($crack['expires_at'], false)]) }}</span>
                                        @endif
                                    </div>
                                    <div onclick="event.stopPropagation()" class="checkbox-wrapper-65">
                                        <label for="select-crack-{{ $crack['id'] }}">
                                            <input onclick="openRemoveButton('crack')" type="checkbox" name="selected_process" class="select-1" id="select-crack-{{ $crack['id'] }}" process_type="crack" value="{{ $crack['id'] }}">
                                            <span class="cbx">
                                                <svg width="12px" height="11px" viewBox="0 0 12 11">
                                                    <polyline points="1 6.29411765 4.5 10 11 1"></polyline>
                                                </svg>
                                            </span>
                                            <div class="cbx-glow"></div>
                                        </label>
                                    </div>
                                </div>
                                <progress-bar class="progress-bar {{ $crack['status'] === 2 ? 'failed' : ''}}">
                                    <div class="bar">
                                        <div class="bar-glow"></div>
                                    </div>
                                </progress-bar>
                                <div class="process-bottomwrap">
                                    @if ($crack['status'] === \App\Models\Crack::WORKING)
                                        <div class="process-status working">
                                            <span class="progress-percentage">0%</span>
                                            <span class="time-remaining"> - {{ diffInHumanTime($crack['expires_at']) }}</span>
                                        </div>
                                    @elseif ($crack['status'] === \App\Models\Crack::SUCCESSFUL)
                                        <div class="process-status successful">
                                            <span>{{ __('processes.crack_successful') }}</span>
                                        </div>
                                    @elseif ($crack['status'] === \App\Models\Crack::FAILED)
                                        <div class="process-status failed">
                                            <span>{{ __('processes.crack_failed') }}</span>
                                        </div>
                                    @endif
                                    <div class="process-level">
                                        <span>{{ __('processes.encryptor_level') }} </span>
                                        <span>{{ $crack->Victim['password_encryptor_level'] }}</span>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </section>
                <section id="transfer-frame">
                    @if (Auth::user()->Transfer->count() === 0)
                        <p class="empty-frame-message">{{ __('processes.no_network') }}</p>
                    @endif
                    <ul>
                        @foreach (Auth::user()->Transfer()->where('visible', true)->get()->reverse() as $transfer)
                            @php
                                // Ensure transfer is updated
                                \App\Http\Controllers\TransferController::checkAndUpdateTransfer($transfer);
                            @endphp
                            <li onclick="openHackWindow(this, 'transfer', '{{ $transfer['id'] }}', true, false, {{ $transfer['status'] === \App\Models\Transfer::WORKING ? formatNumber(\App\Models\Transfer::generateTransferFinishValueOC($transfer)) : 0 }})" timezone-replacing data-created-at="{{ \Carbon\Carbon::parse($transfer['created_at'])->toIso8601String() }}"
                                data-expires-at="{{ \Carbon\Carbon::parse($transfer['expires_at'])->toIso8601String() }}">
                                <div class="process-topwrap">
                                    <div class="process-info">
                                        <span class="process-ip">{{ $transfer->Victim['ip'] }}</span>
                                        @if ($transfer['status'] === \App\Models\Transfer::WORKING)
                                            {{-- Working --}}
                                            @if ($transfer['type'] === \App\Models\Transfer::DOWNLOAD)
                                                <span class="process-date">{{ __('processes.downloading') }}</span>
                                            @else
                                                <span class="process-date">{{ __('processes.uploading') }}</span>
                                            @endif
                                        @else
                                            {{-- Successful or Failed --}}
                                            <span class="process-date">{{ __('processes.process_ago', ['ago' => diffInHumanTime($transfer['expires_at'], false)]) }}</span>
                                        @endif
                                    </div>
                                    <div onclick="event.stopPropagation()" class="checkbox-wrapper-65">
                                        <label for="select-transfer-{{ $transfer['id'] }}">
                                            <input onclick="openRemoveButton('transfer')" type="checkbox" name="selected_process" class="select-1" id="select-transfer-{{ $transfer['id'] }}" process_type="transfer" value="{{ $transfer['id'] }}">
                                            <span class="cbx">
                                                <svg width="12px" height="11px" viewBox="0 0 12 11">
                                                    <polyline points="1 6.29411765 4.5 10 11 1"></polyline>
                                                </svg>
                                            </span>
                                            <div class="cbx-glow"></div>
                                        </label>
                                    </div>
                                </div>
                                <progress-bar class="progress-bar {{ $transfer['status'] === 2 ? 'failed' : ''}}">
                                    <div class="bar">
                                        <div class="bar-glow"></div>
                                    </div>
                                </progress-bar>
                                <div class="process-bottomwrap">
                                    @if ($transfer['status'] === \App\Models\Transfer::WORKING)
                                        <div class="process-status working">
                                            <span class="progress-percentage">0%</span>
                                            <span class="time-remaining"> - {{ diffInHumanTime($transfer['expires_at']) }}</span>
                                        </div>
                                    @elseif ($transfer['status'] === \App\Models\Transfer::SUCCESSFUL)
                                        <div class="process-status successful">
                                            @if ($transfer->type === \App\Models\Transfer::DOWNLOAD)
                                                <span>{{ __('processes.download_successful') }}</span>
                                            @elseif ( $transfer->type === \App\Models\Transfer::UPLOAD)
                                                <span>{{ __('processes.upload_successful') }}</span>
                                            @endif
                                        </div>
                                    @endif
                                    <div class="process-level">
                                        <span>{{ \App\Enums\Apps::getAppName($transfer->app_name) }} {{ __('common.level') }} </span>
                                        <span>{{ $transfer->type === \App\Models\Transfer::DOWNLOAD ? $transfer->Victim[$transfer->app_name . '_level'] : $transfer->app_level }}</span>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </section>
            </section>
        </section>
        @include('includes.buttons.back-btn')
        @include('includes.buttons.remove-btn')
    </body>
    @include('includes.scripts', ['scripts' => ['processes', 'progress-bar']])
    @include('includes.notifications')
</html>