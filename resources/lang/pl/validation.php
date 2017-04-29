<?php
return array(
    "accepted"             => ":attribute musi zostać zaakceptowane.", //yes, 1, true
    "active_url"           => ":attribute nie jest prawidłowym adresem URL.",
    "after"                => ":attribute nie może być wyznaczony na czas przeszły.",
    "alpha"                => ":attribute może zawierać tylko litery.",
    "alpha_dash"           => ":attribute może zawierać tylko litery, cyfry i podkreślenia.",
    "alpha_num"            => ":attribute może zawierać tylko litery i cyfry.",
    "array"                => ":attribute musi być tablicą.",
    "before"               => ":attribute musi być datą wcześniejszą niż :date.",
    "between"              => array(
        "numeric" => ":attribute musi być wartością pomiędzy :min i :max.",
        "file"    => ":attribute musi mieć pomiędzy :min a :max kilobajtów.",
        "string"  => ":attribute musi mieć pomiędzy :min a :max znaków.",
        "array"   => ":attribute musi mieć pomiędzy :min a :max pozycji.",
    ),
    "boolean"              => "pole :attribute musi być true lub false",
    "confirmed"            => ":attribute nie pasuję.",
    "date"                 => ":attribute nie jest prawidłową datą.",
    "date_format"          => ":attribute nie zgadza się z formatem :format.",
    "different"            => ":attribute i :other muszą być różne.",
    "digits"               => ":attribute musi mieć :digits cyfr.",
    "digits_between"       => ":attribute musi mieć pomiędzy :min a :max cyfr.",
    "email"                => ":attribute must be a valid email address.",
    "exists"               => "Wybrany :attribute jest nieprawidłowy.",
    "image"                => ":attribute musi być obrazkiem.",
    "in"                   => "Wybrany :attribute jest nieprawidłowy.",
    "integer"              => ":attribute musi być liczbą.",
    "ip"                   => ":attribute musi być poprawnym adresem IP.",
    "max"                  => array(
        "numeric" => ":attribute nie może być większy niż :max.",
        "file"    => ":attribute nie może być większy niż :max kilobajtów.",
        "string"  => ":attribute nie może być dłuższy niż :max znaków.",
        "array"   => ":attribute nie może mieć więcej niż :max pozycji.",
    ),
    "mimes"                => ":attribute musi być plikiem typu: :values.",
    "min"                  => array(
        "numeric" => ":attribute musi większy lub równy :min.",
        "file"    => ":attribute musi mieć co najmniej :min kilobajtów.",
        "string"  => "Pole :attribute musi mieć co najmniej :min znaków.",
        "array"   => ":attribute musi mieć co najmniej :min pozycji.",
    ),
    "not_in"               => "wybrany :attribute jest nieprawidłowy.",
    "numeric"              => ":attribute musi być numerem.",
    "regex"                => "format :attribute jest nieprawidłowy",
    "required"             => "Pole :attribute jest wymagane.",
    "required_if"          => "Pole :attribute jest wymagane, gdy :other ma wartość :value.",
    "required_with"        => "Pole :attribute jest wymagane, gdy :values są zdefiniowane.",
    "required_with_all"    => "Pole :attribute jest wymagane, gdy :values są zdefiniowane.",
    "required_without"     => "Pole :attribute jest wymagane, gdy :values nie są zdefiniowane.",
    "required_without_all" => "Pole :attribute jest wymagane, gdy żadne z :values nie są zdefiniowane.",
    "same"                 => ":attribute i :other muszą być takie same.",
    "size"                 => array(
        "numeric" => ":attribute musi wynosić :size.",
        "file"    => ":attribute musi mieć :size kilobajtów.",
        "string"  => ":attribute musi mieć :size znaków.",
        "array"   => ":attribute musi zawierać :size pozycji.",
    ),
    "unique"               => ":attribute jest już zajęty.",
    "url"                  => "format :attribute jest nieprawidłowy.",
    "timezone"             => ":attribute musi być prawidłową strefą czasową.",
    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */
    'custom' => array(
        'attribute-name' => array(
            'rule-name' => 'custom-message',
        ),
    ),
    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */
    'attributes' => array(
        'username' => 'Nazwa użytkownika',
        'password' => 'Hasło',
        'name' => 'Nazwa użytkownika',
        'description' => 'Opis'
    ),
);
