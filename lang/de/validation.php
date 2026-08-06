<?php

return [
    'required' => 'Das Feld :attribute ist erforderlich.',
    'email' => 'Das Feld :attribute muss eine gültige E-Mail-Adresse sein.',
    'string' => 'Das Feld :attribute muss ein Text sein.',
    'image' => 'Das Feld :attribute muss ein Bild sein.',
    'unique' => 'Das Feld :attribute ist bereits vergeben.',
    'confirmed' => 'Die Bestätigung für :attribute stimmt nicht überein.',
    'exists' => 'Der ausgewählte Wert für :attribute ist ungültig.',
    'regex' => 'Das Format des Feldes :attribute ist ungültig.',
    'current_password' => 'Das Passwort ist falsch.',
    'boolean' => 'Das Feld :attribute muss true oder false sein.',

    'max' => [
        'string' => 'Das Feld :attribute darf maximal :max Zeichen haben.',
        'file' => 'Das Feld :attribute darf maximal :max Kilobyte groß sein.',
    ],
    'min' => [
        'string' => 'Das Feld :attribute muss mindestens :min Zeichen haben.',
    ],

    'attributes' => [
        'name' => 'Name',
        'email' => 'E-Mail',
        'password' => 'Passwort',
        'password_confirmation' => 'Passwort-Bestätigung',
        'current_password' => 'aktuelles Passwort',
        'username' => 'Username',
        'display_name' => 'Anzeigename',
        'title' => 'Titel',
        'bio' => 'Bio',
        'avatar' => 'Profilbild',
        'body' => 'Text',
        'image' => 'Bild',
    ],
];
