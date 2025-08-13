<?php

return [
    'user' => [
        'not_found' => 'Użytkownik nie znaleziony.',
        'max_savings_limit' => 'Osiągnąłeś maksymalny limit oszczędności.',
        'no_crypto_to_transfer' => 'Nie masz kryptowalut do przelania.',
        'log_error' => 'Nie udało się zapisać logu.',
        'download_error' => 'Nie możesz pobrać żadnej aplikacji od tego użytkownika.',
        'upload_error' => 'Nie możesz przesłać żadnej aplikacji do tego użytkownika.',
        'virus_uploading' => 'Wirus jest w trakcie przesyłania, proszę czekać aż się zakończy.',
        'virus_uploaded' => 'Już przesłałeś ten wirus na poziomie :level.',
        'process_remove_error' => 'Nie udało się usunąć tego procesu.',
        'process_unexpected' => 'Proces nie został znaleziony lub nie jesteś jego hakerem.',
        'process_shorten_error' => 'Nie udało się skrócić tego procesu.',
        'bypass_warning' => 'Ten użytkownik nie jest już dla Ciebie dostępny.',
        'bypass_error' => 'Bypass nie został znaleziony lub nie jesteś jego hakerem.',
    ],
    'auth' => [
        'not_match_password' => 'Hasła nie są zgodne.',
        'incorrect_password' => 'Nieprawidłowe hasło.',
    ],
    'bank' => [
        'no_credentials' => 'Nie masz danych logowania do tego konta bankowego.',
        'already_cracking' => 'Masz już uruchomiony proces łamania dla tego użytkownika.',
        'crack_not_allowed' => 'Nie możesz łamać tego użytkownika.',
        'deposit_not_found' => 'Ten depozyt nie istnieje.',
        'deposit_error' => 'Nie udało się wykonać depozytu.',
    ],
    'not_enough_oc' => 'Niewystarczająca ilość OC',
    'not_enough_bitcoins' => 'Niewystarczająca ilość bitcoinów',
    'message' => [
        'ip_null' => 'Proszę podać adres IP.',
        'ip_invalid' => 'Proszę podać prawidłowy adres IP.',
        'device_not_found' => 'Nie znaleziono urządzenia o tym adresie IP.',
        'message_error' => 'Błąd podczas wysyłania wiadomości.',
        'not_receiver' => 'Nie jesteś odbiorcą tej wiadomości.',
    ],
    'forgot_password' => [
        'code_invalid' => 'Nieprawidłowy kod',
        'code_expired' => 'Kod wygasł',
        'password_null' => 'Pole hasła musi być wypełnione',
        'password_invalid' => 'Hasło musi mieć co najmniej 8 znaków',
    ],
    'scan' => [
        'already_bypassing' => 'Masz już aktywny bypass na tym urządzeniu.',
    ],
];
