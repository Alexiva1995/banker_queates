<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted'             => 'Field :attribute it must be accepted.',
    'active_url'           => 'Field :attribute is not a valid URL.',
    'after'                => 'Field :attribute must be a date after :date.',
    'after_or_equal'       => 'Field :attribute must be a later date or equal to :date.',
    'alpha'                => 'Field :attribute solo puede contener letras.',
    'alpha_dash'           => 'Field :attribute solo puede contener letras, números, guiones y guiones bajos.',
    'alpha_num'            => 'Field :attribute solo puede contener letras y números.',
    'array'                => 'Field :attribute debe ser un array.',
    'before'               => 'Field :attribute debe ser una fecha anterior a :date.',
    'before_or_equal'      => 'Field :attribute debe ser una fecha anterior o igual a :date.',
    'between'              => [
        'numeric' => 'Field :attribute debe ser un valor entre :min y :max.',
        'file'    => 'El archivo :attribute debe pesar entre :min y :max kilobytes.',
        'string'  => 'Field :attribute debe contener entre :min y :max caracteres.',
        'array'   => 'Field :attribute debe contener entre :min y :max elementos.',
    ],
    'boolean'              => 'Field :attribute debe ser verdadero o falso.',
    'confirmed'            => 'Field confirmación de :attribute no coincide.',
    'date'                 => 'Field :attribute no corresponde con una fecha válida.',
    'date_equals'          => 'Field :attribute debe ser una fecha igual a :date.',
    'date_format'          => 'Field :attribute no corresponde con el formato de fecha :format.',
    'different'            => 'Los campos :attribute y :other deben ser diferentes.',
    'digits'               => 'Field :attribute debe ser un número de :digits dígitos.',
    'digits_between'       => 'Field :attribute debe contener entre :min y :max dígitos.',
    'dimensions'           => 'Field :attribute tiene dimensiones de imagen inválidas.',
    'distinct'             => 'Field :attribute tiene un valor duplicado.',
    'email'                => 'Field :attribute debe ser una dirección de correo válida.',
    'ends_with'            => 'Field :attribute debe finalizar con alguno de los siguientes valores: :values',
    'exists'               => 'Field :attribute seleccionado no existe.',
    'file'                 => 'Field :attribute debe ser un archivo.',
    'filled'               => 'Field :attribute debe tener un valor.',
    'gt'                   => [
        'numeric' => 'Field :attribute debe ser mayor a :value.',
        'file'    => 'El archivo :attribute debe pesar más de :value kilobytes.',
        'string'  => 'Field :attribute debe contener más de :value caracteres.',
        'array'   => 'Field :attribute debe contener más de :value elementos.',
    ],
    'gte'                  => [
        'numeric' => 'Field :attribute debe ser mayor o igual a :value.',
        'file'    => 'El archivo :attribute debe pesar :value o más kilobytes.',
        'string'  => 'Field :attribute debe contener :value o más caracteres.',
        'array'   => 'Field :attribute debe contener :value o más elementos.',
    ],
    'image'                => 'Field :attribute debe ser una imagen.',
    'in'                   => 'Field :attribute es inválido.',
    'in_array'             => 'Field :attribute no existe en :other.',
    'integer'              => 'Field :attribute debe ser un número entero.',
    'ip'                   => 'Field :attribute debe ser una dirección IP válida.',
    'ipv4'                 => 'Field :attribute debe ser una dirección IPv4 válida.',
    'ipv6'                 => 'Field :attribute debe ser una dirección IPv6 válida.',
    'json'                 => 'Field :attribute debe ser una cadena de texto JSON válida.',
    'lt'                   => [
        'numeric' => 'Field :attribute debe ser menor a :value.',
        'file'    => 'El archivo :attribute debe pesar menos de :value kilobytes.',
        'string'  => 'Field :attribute debe contener menos de :value caracteres.',
        'array'   => 'Field :attribute debe contener menos de :value elementos.',
    ],
    'lte'                  => [
        'numeric' => 'Field :attribute debe ser menor o igual a :value.',
        'file'    => 'El archivo :attribute debe pesar :value o menos kilobytes.',
        'string'  => 'Field :attribute debe contener :value o menos caracteres.',
        'array'   => 'Field :attribute debe contener :value o menos elementos.',
    ],
    'max'                  => [
        'numeric' => 'Field :attribute no debe ser mayor a :max.',
        'file'    => 'El archivo no debe pesar más de :max kilobytes.',
        'string'  => 'Field :attribute no debe contener más de :max caracteres.',
        'array'   => 'Field :attribute no debe contener más de :max elementos.',
    ],
    'mimes'                => 'Field :attribute debe ser un archivo de tipo: :values.',
    'mimetypes'            => 'Field :attribute debe ser un archivo de tipo: :values.',
    'min'                  => [
        'numeric' => 'Field :attribute debe ser al menos :min.',
        'file'    => 'El archivo :attribute debe pesar al menos :min kilobytes.',
        'string'  => 'Field :attribute debe contener al menos :min caracteres.',
        'array'   => 'Field :attribute debe contener al menos :min elementos.',
    ],
    'not_in'               => 'Field :attribute seleccionado es inválido.',
    'not_regex'            => 'El formato dField :attribute es inválido.',
    'numeric'              => 'Field :attribute debe ser un número.',
    'password'             => 'La contraseña es incorrecta.',
    'present'              => 'Field :attribute debe estar presente.',
    'regex'                => 'El formato dField :attribute es inválido.',
    'required'             => 'Field :attribute is required.',
    'required_if'          => 'Field :attribute is required when Field :other es :value.',
    'required_unless'      => 'Field :attribute es requerido a menos que :other se encuentre en :values.',
    'required_with'        => 'Field :attribute is required when :values is present.',
    'required_with_all'    => 'Field :attribute is required when :values están presentes.',
    'required_without'     => 'Field :attribute is required when :values no está presente.',
    'required_without_all' => 'Field :attribute is required when ninguno de los campos :values están presentes.',
    'same'                 => 'Los campos :attribute y :other deben coincidir.',
    'size'                 => [
        'numeric' => 'Field :attribute debe ser :size.',
        'file'    => 'El archivo :attribute debe pesar :size kilobytes.',
        'string'  => 'Field :attribute debe contener :size caracteres.',
        'array'   => 'Field :attribute debe contener :size elementos.',
    ],
    'starts_with'          => 'Field :attribute debe comenzar con uno de los siguientes valores: :values',
    'string'               => 'Field :attribute debe ser una cadena de caracteres.',
    'timezone'             => 'Field :attribute debe ser una zona horaria válida.',
    'unique'               => 'El valor dField :attribute ya está en uso.',
    'uploaded'             => 'Field :attribute no se pudo subir.',
    'url'                  => 'El formato dField :attribute es inválido.',
    'uuid'                 => 'Field :attribute debe ser un UUID válido.',

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

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
            'new_password' => 'nueva contraseña',
            'confirm_password' => 'Confirmar nueva contraseña',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [
        'email' => 'Correo',
        'title' => 'Titulo',
        'categorie' => 'categoria',
        'new_password' => 'nueva contraseña',
        'confirm_password' => 'Confirmar nueva contraseña',
    ],

];
