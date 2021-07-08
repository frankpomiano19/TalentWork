<?php

return [
    'required' => 'El campo :attribute es necesario.',
    'max' => [
        'numeric' => 'The :attribute may not be greater than :max.',
        'file' => 'The :attribute may not be greater than :max kilobytes.',
        'string' => 'El campo :attribute no puede tener mas de :max caracteres.',
        'array' => 'The :attribute may not have more than :max items.',
    ],
    'min' => [
        'numeric' => 'The :attribute must be at least :min.',
        'file' => 'The :attribute must be at least :min kilobytes.',
        'string' => 'El campo :attribute no puede tener menos de :min caracteres.',
        'array' => 'The :attribute must have at least :min items.',
    ],
    'email' => 'El :attribute debe ser una direccion de correo valida.',
    'confirmed' => 'Error en la confirmacion del campo :attribute.',
    'string' => 'El campo :attribute debe ser una cadena de caracteres.',
    'unique' => 'El :attribute ya ha sido registrado antes en el sistema',
];