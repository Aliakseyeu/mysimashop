@include('parts/titles/title', [
    'main' => 'Логин',
    'additional' => 'Пожалуйста введите e-mail и пароль и нажмите кнопку войти',
    'buttons' => [
        [
            'class' => 'success',
            'icon' => 'user-plus',
            'text' => 'Зарегистрироваться',
            'link' => route('register')
        ]
    ]
])