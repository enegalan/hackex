@php
    if (!Auth::check()) {
        return;
    }
@endphp
<div style="z-index: 3;" id="deposit-modal" class="modal" closable="true">
    <section class="card modal-frame">
        <section id="modal-top">
            <span>{{ __('bank.deposits_mention') }}</span>
        </section>
        <section id="deposit-frame">
            <ul>
                @foreach (\App\Http\Controllers\BankController::getDeposits() as $depositId => $deposit)
                    <li onclick="submitDeposit({{ $depositId }}, 'deposit-form-{{ $depositId }}')" class="deposit">
                        <form id="deposit-form-{{ $depositId }}" action="/deposit" method="post">
                            @csrf
                            <input type="hidden" name="deposit_id" id="#input-deposit-{{ $depositId }}">
                        </form>
                        <span class="deposit_reward">
                            <span class="deposit_value">{{ $deposit['value'] }}</span>
                            <span class="cryptocoins_label">{{ __('common.cryptocoins') }}</span>
                        </span>
                        <span class="deposit_cost">
                            <span>{{ $deposit['oc'] }} OC</span>
                        </span>
                    </li>
                @endforeach
            </ul>
        </section>
    </section>
    @include('includes.buttons.back-btn', ['callback' => 'closeDepositModal()'])
</div>
