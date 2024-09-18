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

    'accepted' => 'Поле :attribute має бути прийняте.',
    'accepted_if' => 'Поле :attribute має бути прийняте, коли :other дорівнює :value.',
    'active_url' => 'Поле :attribute має бути дійсною URL-адресою.',
    'after' => 'Поле :attribute має бути датою після :date.',
    'after_or_equal' => 'Поле :attribute має бути датою після або рівною :date.',
    'alpha' => 'Поле :attribute може містити лише літери.',
    'alpha_dash' => 'Поле :attribute може містити лише літери, цифри, дефіси та підкреслення.',
    'alpha_num' => 'Поле :attribute може містити лише літери та цифри.',
    'array' => 'Поле :attribute має бути масивом.',
    'ascii' => 'Поле :attribute може містити лише однобайтові алфавітно-цифрові символи та знаки.',
    'before' => 'Поле :attribute має бути датою до :date.',
    'before_or_equal' => 'Поле :attribute має бути датою до або рівною :date.',
    'between' => [
        'array' => 'Поле :attribute повинно містити від :min до :max елементів.',
        'file' => 'Поле :attribute має бути від :min до :max кілобайт.',
        'numeric' => 'Поле :attribute має бути між :min та :max.',
        'string' => 'Поле :attribute має бути від :min до :max символів.',
    ],
    'boolean' => 'Поле :attribute має бути true або false.',
    'can' => 'Поле :attribute містить неприпустиме значення.',
    'confirmed' => 'Підтвердження поля :attribute не збігається.',
    'current_password' => 'Неправильний пароль.',
    'date' => 'Поле :attribute має бути дійсною датою.',
    'date_equals' => 'Поле :attribute має бути датою, рівною :date.',
    'date_format' => 'Поле :attribute не відповідає формату :format.',
    'decimal' => 'Поле :attribute має містити :decimal десяткових знаків.',
    'declined' => 'Поле :attribute повинно бути відхилене.',
    'declined_if' => 'Поле :attribute повинно бути відхилене, коли :other дорівнює :value.',
    'different' => 'Поле :attribute і :other повинні відрізнятися.',
    'digits' => 'Поле :attribute повинно містити :digits цифр.',
    'digits_between' => 'Поле :attribute повинно містити від :min до :max цифр.',
    'dimensions' => 'Поле :attribute має неправильні розміри зображення.',
    'distinct' => 'Поле :attribute має дублікати значень.',
    'doesnt_end_with' => 'Поле :attribute не повинно закінчуватися одним з наступних: :values.',
    'doesnt_start_with' => 'Поле :attribute не повинно починатися одним з наступних: :values.',
    'email' => 'Поле :attribute має бути дійсною електронною адресою.',
    'ends_with' => 'Поле :attribute має закінчуватися одним з наступних: :values.',
    'enum' => 'Вибране значення для поля :attribute є недійсним.',
    'exists' => 'Вибране значення для поля :attribute є недійсним.',
    'extensions' => 'Поле :attribute має мати одне з наступних розширень: :values.',
    'file' => 'Поле :attribute має бути файлом.',
    'filled' => 'Поле :attribute обов\'язкове для заповнення.',
    'gt' => [
        'array' => 'Поле :attribute повинно містити більше ніж :value елементів.',
        'file' => 'Поле :attribute повинно бути більше ніж :value кілобайт.',
        'numeric' => 'Поле :attribute повинно бути більше ніж :value.',
        'string' => 'Поле :attribute повинно бути більше ніж :value символів.',
    ],
    'gte' => [
        'array' => 'Поле :attribute повинно містити :value або більше елементів.',
        'file' => 'Поле :attribute повинно бути не менше :value кілобайт.',
        'numeric' => 'Поле :attribute повинно бути не менше :value.',
        'string' => 'Поле :attribute повинно бути не менше :value символів.',
    ],
    'hex_color' => 'Поле :attribute має бути дійсним шістнадцятковим кольором.',
    'image' => 'Поле :attribute має бути зображенням.',
    'in' => 'Вибране значення для поля :attribute є недійсним.',
    'in_array' => 'Поле :attribute повинно існувати в :other.',
    'integer' => 'Поле :attribute повинно бути цілим числом.',
    'ip' => 'Поле :attribute повинно бути дійсною IP-адресою.',
    'ipv4' => 'Поле :attribute повинно бути дійсною IPv4-адресою.',
    'ipv6' => 'Поле :attribute повинно бути дійсною IPv6-адресою.',
    'json' => 'Поле :attribute повинно бути дійсним рядком JSON.',
    'lowercase' => 'Поле :attribute повинно бути в нижньому регістрі.',
    'lt' => [
        'array' => 'Поле :attribute повинно містити менше ніж :value елементів.',
        'file' => 'Поле :attribute повинно бути менше ніж :value кілобайт.',
        'numeric' => 'Поле :attribute повинно бути менше ніж :value.',
        'string' => 'Поле :attribute повинно бути менше ніж :value символів.',
    ],
    'lte' => [
        'array' => 'Поле :attribute не повинно містити більше ніж :value елементів.',
        'file' => 'Поле :attribute повинно бути не більше :value кілобайт.',
        'numeric' => 'Поле :attribute повинно бути не більше :value.',
        'string' => 'Поле :attribute повинно бути не більше :value символів.',
    ],
    'mac_address' => 'Поле :attribute повинно бути дійсною MAC-адресою.',
    'max' => [
        'array' => 'Поле :attribute не повинно містити більше ніж :max елементів.',
        'file' => 'Поле :attribute не повинно бути більше :max кілобайт.',
        'numeric' => 'Поле :attribute не повинно бути більше :max.',
        'string' => 'Поле :attribute не повинно містити більше :max символів.',
    ],
    'max_digits' => 'Поле :attribute не повинно містити більше ніж :max цифр.',
    'mimes' => 'Поле :attribute повинно бути файлом типу: :values.',
    'mimetypes' => 'Поле :attribute повинно бути файлом типу: :values.',
    'min' => [
        'array' => 'Поле :attribute повинно містити щонайменше :min елементів.',
        'file' => 'Поле :attribute повинно бути не менше :min кілобайт.',
        'numeric' => 'Поле :attribute повинно бути не менше :min.',
        'string' => 'Поле :attribute повинно містити щонайменше :min символів.',
    ],
    'min_digits' => 'Поле :attribute повинно містити щонайменше :min цифр.',
    'missing' => 'Поле :attribute повинно бути відсутнім.',
    'missing_if' => 'Поле :attribute повинно бути відсутнім, коли :other дорівнює :value.',
    'missing_unless' => 'Поле :attribute повинно бути відсутнім, якщо :other не дорівнює :value.',
    'missing_with' => 'Поле :attribute повинно бути відсутнім, коли присутнє :values.',
    'missing_with_all' => 'Поле :attribute повинно бути відсутнім, коли присутні всі значення :values.',
    'multiple_of' => 'Поле :attribute повинно бути кратним :value.',
    'not_in' => 'Вибране значення для поля :attribute є недійсним.',
    'not_regex' => 'Неправильний формат поля :attribute.',
    'numeric' => 'Поле :attribute повинно бути числом.',
    'password' => [
        'letters' => 'Поле :attribute повинно містити щонайменше одну літеру.',
        'mixed' => 'Поле :attribute повинно містити щонайменше одну велику та одну малу літеру.',
        'numbers' => 'Поле :attribute повинно містити щонайменше одну цифру.',
        'symbols' => 'Поле :attribute повинно містити щонайменше один символ.',
        'uncompromised' => 'Значення :attribute було виявлене в зливі даних. Виберіть інше значення для :attribute.',
    ],
    'present' => 'Поле :attribute повинно бути присутнім.',
    'present_if' => 'Поле :attribute повинно бути присутнім, коли :other дорівнює :value.',
    'present_unless' => 'Поле :attribute повинно бути присутнім, якщо :other не дорівнює :value.',
    'present_with' => 'Поле :attribute повинно бути присутнім, коли присутнє :values.',
    'present_with_all' => 'Поле :attribute повинно бути присутнім, коли присутні всі значення :values.',
    'prohibited' => 'Поле :attribute заборонене.',
    'prohibited_if' => 'Поле :attribute заборонене, коли :other дорівнює :value.',
    'prohibited_unless' => 'Поле :attribute заборонене, якщо :other не знаходиться в списку :values.',
    'prohibits' => 'Поле :attribute забороняє присутність :other.',
    'regex' => 'Неправильний формат поля :attribute.',
    'required' => 'Поле :attribute є обов\'язковим.',
    'required_array_keys' => 'Поле :attribute повинно містити записи для: :values.',
    'required_if' => 'Поле :attribute є обов\'язковим, коли :other дорівнює :value.',
    'required_if_accepted' => 'Поле :attribute є обов\'язковим, коли :other прийняте.',
    'required_unless' => 'Поле :attribute є обов\'язковим, якщо :other не знаходиться в списку :values.',
    'required_with' => 'Поле :attribute є обов\'язковим, коли присутнє :values.',
    'required_with_all' => 'Поле :attribute є обов\'язковим, коли присутні всі значення :values.',
    'required_without' => 'Поле :attribute є обов\'язковим, коли :values відсутнє.',
    'required_without_all' => 'Поле :attribute є обов\'язковим, коли відсутні всі значення :values.',
    'same' => 'Поле :attribute має збігатися з полем :other.',
    'size' => [
        'array' => 'Поле :attribute повинно містити :size елементів.',
        'file' => 'Поле :attribute повинно бути розміром :size кілобайт.',
        'numeric' => 'Поле :attribute повинно бути розміром :size.',
        'string' => 'Поле :attribute повинно містити :size символів.',
    ],
    'starts_with' => 'Поле :attribute повинно починатися з одного з наступних значень: :values.',
    'string' => 'Поле :attribute повинно бути рядком.',
    'timezone' => 'Поле :attribute повинно бути дійсним часовим поясом.',
    'unique' => 'Значення поля :attribute вже використано.',
    'uploaded' => 'Не вдалося завантажити поле :attribute.',
    'uppercase' => 'Поле :attribute повинно бути у верхньому регістрі.',
    'url' => 'Поле :attribute повинно бути дійсною URL-адресою.',
    'ulid' => 'Поле :attribute повинно бути дійсним ULID.',
    'uuid' => 'Поле :attribute повинно бути дійсним UUID.',

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
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [],

];
