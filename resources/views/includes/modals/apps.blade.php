@php
    $user = session('hackedUser', Auth::user());
    $isHacked = session('isHacked', false);
    if (!Auth::check()) {
        return;
    }
@endphp
<div id="apps-modal" class="modal" closable="true">
    <section class="modal-frame">
        <section id="modal-top">
            <div class="title">Apps</div>
            <div class="top-rightside">
                <span class="close">&times;</span>
                @if ($isHacked)
                    <button onclick="openVirusesModal({{ $user->id }})" class="main-btn upload-button">Upload</button>
                @endif
            </div>
        </section>
        <div class="modal-content">
            <section class="content">
                <ul>
                    @php
                        $diff = Auth::user()->antivirus_level - $user->antivirus_level;
                    @endphp
                    <li {!! $isHacked && $diff < 0 ? 'onclick="openDownloadModal(\'' . $user->id . '\', \'antivirus\', \'' . $user->antivirus_level . '\', \'Antivirus\')"' : (!$isHacked ? 'onclick="openAntivirusModal()"' : '') !!}>
                        <div class="app-logo">
                            <img src="{{ asset('apps/antivirus.webp') }}" alt="antivirus">
                        </div>
                        <div class="app-info">
                            <span class="app-name">{{ \App\Enums\Apps::getAppName('antivirus') }}</span>
                            <span class="app-value">
                                Level <span class="app-level-value">{{ $user['antivirus_level'] }}</span>
                                @if ($isHacked)
                                    @if ($diff === 0)
                                    @elseif ($diff > 0)
                                        <span class="negative">-{{ $diff }}</span>
                                    @else
                                        <span class="positive">+{{ abs($diff) }}</span>
                                    @endif
                                @endif
                            </span>
                        </div>
                    </li>
                    @php
                        $diff = Auth::user()->spam_level - $user->spam_level;
                    @endphp
                    <li {!! $isHacked && $diff < 0 ? 'onclick="openDownloadModal(\'' . $user->id . '\', \'spam\', \'' . $user->spam_level . '\', \'Spam\')"' : (!$isHacked ? 'onclick="openSpamModal()"' : '') !!}>
                        <div class="app-logo">
                            <img src="{{ asset('apps/spam.webp') }}" alt="spam">
                        </div>
                        <div class="app-info">
                            <span class="app-name">{{ \App\Enums\Apps::getAppName('spam') }}</span>
                            <span class="app-value">
                                Level <span class="app-level-value">{{ $user['spam_level'] }}</span>
                                @if ($isHacked)
                                    @if ($diff === 0)
                                    @elseif ($diff > 0)
                                        <span class="negative">-{{ $diff }}</span>
                                    @else
                                        <span class="positive">+{{ abs($diff) }}</span>
                                    @endif
                                @endif
                            </span>
                        </div>
                    </li>
                    @php
                        $diff = Auth::user()->spyware_level - $user->spyware_level;
                    @endphp
                    <li {!! $isHacked && $diff < 0 ? 'onclick="openDownloadModal(\'' . $user->id . '\', \'spyware\', \'' . $user->spyware_level . '\', \'Spyware\')"' : (!$isHacked ? 'onclick="openSpywareModal()"' : '') !!}>
                        <div class="app-logo">
                            <img src="{{ asset('apps/spyware.webp') }}" alt="spyware">
                        </div>
                        <div class="app-info">
                            <span class="app-name">{{ \App\Enums\Apps::getAppName('spyware') }}</span>
                            <span class="app-value">
                                Level <span class="app-level-value">{{ $user['spyware_level'] }}</span>
                                @if ($isHacked)
                                    @if ($diff === 0)
                                    @elseif ($diff > 0)
                                        <span class="negative">-{{ $diff }}</span>
                                    @else
                                        <span class="positive">+{{ abs($diff) }}</span>
                                    @endif
                                @endif
                            </span>
                        </div>
                    </li>
                    @php
                        $diff = Auth::user()->firewall_level - $user->firewall_level;
                        $onclick = '';
                        if ($isHacked && $diff < 0) {
                            $onclick = 'onclick="openDownloadModal(\'' . $user->id . '\', \'firewall\', \'' . $user->firewall_level . '\', \'Firewall\')"';
                        } elseif (!$isHacked) {
                            $appName = \App\Enums\Apps::getAppName('firewall');
                            $appDesc = \App\Enums\Apps::getAppDescription('firewall');
                            $appUse = \App\Enums\Apps::getAppUse('firewall');
                            $onclick = 'onclick="openAppInfoModal(\'' . e($appName) . '\', ' . $user->firewall_level . ', \'' . e($appDesc) . '\', \'' . str_replace("'", "\'", $appUse)     . '\')"';
                        }
                    @endphp
                    <li {!! $onclick !!}>
                        <div class="app-logo">
                            <img src="{{ asset('apps/firewall.webp') }}" alt="firewall">
                        </div>
                        <div class="app-info">
                            <span class="app-name">{{ \App\Enums\Apps::getAppName('firewall') }}</span>
                            <span class="app-value">
                                Level <span class="app-level-value">{{ $user['firewall_level'] }}</span>
                                @if ($isHacked)
                                    @if ($diff === 0)
                                    @elseif ($diff > 0)
                                        <span class="negative">-{{ $diff }}</span>
                                    @else
                                        <span class="positive">+{{ abs($diff) }}</span>
                                    @endif
                                @endif
                            </span>
                        </div>
                    </li>
                    @php
                        $diff = Auth::user()->bypasser_level - $user->bypasser_level;
                        $onclick = '';
                        if ($isHacked && $diff < 0) {
                            $onclick = 'onclick="openDownloadModal(\'' . $user->id . '\', \'bypasser\', \'' . $user->bypasser_level . '\', \'Bypasser\')"';
                        } elseif (!$isHacked) {
                            $appName = \App\Enums\Apps::getAppName('bypasser');
                            $appDesc = \App\Enums\Apps::getAppDescription('bypasser');
                            $appUse = \App\Enums\Apps::getAppUse('bypasser');
                            $onclick = 'onclick="openAppInfoModal(\'' . e($appName) . '\', ' . $user->bypasser_level . ', \'' . e($appDesc) . '\', \'' . str_replace("'", "\'", $appUse)     . '\')"';
                        }
                    @endphp
                    <li {!! $onclick !!}>
                        <div class="app-logo">
                            <img src="{{ asset('apps/bypasser.webp') }}" alt="bypasser">
                        </div>
                        <div class="app-info">
                            <span class="app-name">{{ \App\Enums\Apps::getAppName('bypasser') }}</span>
                            <span class="app-value">Level <span class="app-level-value">{{ $user['bypasser_level'] }}</span>
                            @if ($isHacked)
                                @if ($diff === 0)
                                @elseif ($diff > 0)
                                    <span class="negative">-{{ $diff }}</span>
                                @else
                                    <span class="positive">+{{ abs($diff) }}</span>
                                @endif
                            @endif
                        </span>
                        </div>
                    </li>
                    @php
                        $diff = Auth::user()->password_cracker_level - $user->password_cracker_level;
                        $onclick = '';
                        if ($isHacked && $diff < 0) {
                            $onclick = 'onclick="openDownloadModal(\'' . $user->id . '\', \'password_cracker\', \'' . $user->password_cracker_level . '\', \'Password cracker\')"';
                        } elseif (!$isHacked) {
                            $appName = \App\Enums\Apps::getAppName('password_cracker');
                            $appDesc = \App\Enums\Apps::getAppDescription('password_cracker');
                            $appUse = \App\Enums\Apps::getAppUse('password_cracker');
                            $onclick = 'onclick="openAppInfoModal(\'' . e($appName) . '\', ' . $user->password_cracker_level . ', \'' . e($appDesc) . '\', \'' . str_replace("'", "\'", $appUse) . '\')"';
                        }
                    @endphp
                    <li {!! $onclick !!}>
                        <div class="app-logo">
                            <img src="{{ asset('apps/password_cracker.webp') }}" alt="password_cracker">
                        </div>
                        <div class="app-info">
                            <span class="app-name">{{ \App\Enums\Apps::getAppName('password_cracker') }}</span>
                            <span class="app-value">Level <span class="app-level-value">{{ $user['password_cracker_level'] }}</span>
                            @if ($isHacked)
                                @if ($diff === 0)
                                @elseif ($diff > 0)
                                    <span class="negative">-{{ $diff }}</span>
                                @else
                                    <span class="positive">+{{ abs($diff) }}</span>
                                @endif
                            @endif
                        </span>
                        </div>
                    </li>
                    @php
                        $diff = Auth::user()->password_encryptor_level - $user->password_encryptor_level;
                        $onclick = '';
                        if ($isHacked && $diff < 0) {
                            $onclick = 'onclick="openDownloadModal(\'' . $user->id . '\', \'password_encryptor\', \'' . $user->password_encryptor_level . '\', \'Password encryptor\')"';
                        } elseif (!$isHacked) {
                            $appName = \App\Enums\Apps::getAppName('password_encryptor');
                            $appDesc = \App\Enums\Apps::getAppDescription('password_encryptor');
                            $appUse = \App\Enums\Apps::getAppUse('password_encryptor');
                            $onclick = 'onclick="openAppInfoModal(\'' . e($appName) . '\', ' . $user->password_encryptor_level . ', \'' . e($appDesc) . '\', \'' . str_replace("'", "\'", $appUse)   . '\')"';
                        }
                    @endphp
                    <li {!! $onclick !!}>
                        <div class="app-logo">
                            <img src="{{ asset('apps/password_encryptor.webp') }}" alt="password_encryptor">
                        </div>
                        <div class="app-info">
                            <span class="app-name">{{ \App\Enums\Apps::getAppName('password_encryptor') }}</span>
                            <span class="app-value">Level <span class="app-level-value">{{ $user['password_encryptor_level'] }}</span>
                            @if ($isHacked)
                                @php
                                    $diff = Auth::user()->password_encryptor_level - $user->password_encryptor_level;
                                @endphp
                                @if ($diff === 0)
                                @elseif ($diff > 0)
                                    <span class="negative">-{{ $diff }}</span>
                                @else
                                    <span class="positive">+{{ abs($diff) }}</span>
                                @endif
                            @endif
                        </span>
                        </div>
                    </li>
                </ul>
            </section>
        </div>
    </section>
</div>