@include('parts/titles/title', [
    'main' => $user->name . ' ' . $user->surname,
    'additional' => 'Пожалуйста измените нужные данные и нажмите кнопку сохранить',
    'buttons' => [
        [
            'class' => 'primary',
            'icon' => 'chevron-left',
            'text' => 'На главную',
            'link' => url('/')
        ],
    ]
])