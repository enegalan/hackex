<?php

return [
    'user' => [
        'not_found' => "Utilisateur non trouvé.",
        'max_savings_limit' => "Vous avez atteint la limite maximale d'épargne.",
        'no_crypto_to_transfer' => "Vous n'avez pas de Cryptocoins à transférer.",
        'log_error' => "Le journal n'a pas pu être enregistré.",
        'download_error' => "Vous ne pouvez pas télécharger d'application depuis cet utilisateur.",
        'upload_error' => "Vous ne pouvez pas télécharger d'application vers cet utilisateur.",
        'virus_uploading' => "Le virus est toujours en cours de téléchargement, veuillez attendre qu'il se termine.",
        'virus_uploaded' => "Vous avez déjà téléchargé ce virus avec le niveau :level.",
        'process_remove_error' => "Impossible de supprimer ce processus.",
        'process_unexpected' => "Processus introuvable ou vous n'êtes pas le hacker de ce processus.",
        'process_shorten_error' => "Impossible de réduire ce processus.",
        'bypass_warning' => "Cet utilisateur n'est plus disponible pour vous.",
        'bypass_error' => "Bypass introuvable ou vous n'êtes pas le hacker de ce bypass.",
    ],
    'auth' => [
        'not_match_password' => "Les mots de passe ne correspondent pas.",
        'incorrect_password' => "Mot de passe incorrect.",
    ],
    'bank' => [
        'no_credentials' => "Vous n'avez pas de justificatifs pour ce compte bancaire.",
        'already_cracking' => "Vous avez déjà un processus de crack en cours pour cet utilisateur.",
        'crack_not_allowed' => "Vous n'êtes pas autorisé à cracker cet utilisateur.",
        'deposit_not_found' => "Ce dépôt n'existe pas.",
        'deposit_error' => "Le dépôt n'a pas pu être effectué.",
    ],
    'not_enough_oc' => "Pas assez de OC",
    'not_enough_bitcoins' => "Pas assez de bitcoins",
    'message' => [
        'ip_null' => "Veuillez saisir une adresse IP.",
        'ip_invalid' => "Veuillez saisir une adresse IP valide.",
        'device_not_found' => "Aucun appareil trouvé avec cette adresse IP.",
        'message_error' => "Erreur lors de l'envoi du message.",
        'not_receiver' => "Vous n'êtes pas le destinataire de ce message.",
    ],
    'forgot_password' => [
        'code_invalid' => "Code invalide",
        'code_expired' => "Le code a expiré",
        'password_null' => "Le champ mot de passe doit être renseigné",
        'password_invalid' => "Le mot de passe doit contenir au moins 8 caractères",
    ],
    'scan' => [
        'already_bypassing' => "Vous avez déjà un bypass actif sur cet appareil.",
    ],
];
