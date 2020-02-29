@include('parts/titles/title', [
    'main' => 'Регистрация',
    'additional' => 'Пожалуйста корректно заполните все данные и нажмите кнопку "Зарегистрироваться"',
    'buttons' => [
        [
            'class' => 'success',
            'icon' => 'sign-in-alt',
            'text' => 'Войти',
            'link' => route('login')
        ]
    ]
])