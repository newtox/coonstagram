<?php

return [
    'required' => 'The :attribute field is required.',
    'email' => 'The :attribute field must be a valid email address.',
    'string' => 'The :attribute field must be a string.',
    'image' => 'The :attribute field must be an image.',
    'unique' => 'The :attribute has already been taken.',
    'confirmed' => 'The :attribute confirmation does not match.',
    'exists' => 'The selected :attribute is invalid.',
    'regex' => 'The :attribute format is invalid.',
    'current_password' => 'The password is incorrect.',
    'boolean' => 'The :attribute field must be true or false.',

    'max' => [
        'string' => 'The :attribute field must not be greater than :max characters.',
        'file' => 'The :attribute field must not be greater than :max kilobytes.',
    ],
    'min' => [
        'string' => 'The :attribute field must be at least :min characters.',
    ],

    'attributes' => [
        'name' => 'name',
        'email' => 'email',
        'password' => 'password',
        'password_confirmation' => 'password confirmation',
        'current_password' => 'current password',
        'username' => 'username',
        'display_name' => 'display name',
        'title' => 'title',
        'bio' => 'bio',
        'avatar' => 'avatar',
        'body' => 'body',
        'image' => 'image',
    ],
];
