@include('parts/titles/title', $group ? [
    'main' => 'Группа №'.$group->id.'. Создана '.$group->created_at,
    'additional' => $group->comment,
    'buttons' => [
        [
            'class' => 'success',
            'icon' => 'cart-plus',
            'text' => 'Создать заказ',
            'link' => url('/item/create/'.$group->id)
        ],
        [
            'class' => 'primary',
            'icon' => 'clipboard-list',
            'text' => 'Сделать отчет',
            'link' => url('/report/'.$group->id)
        ],
    ]
] : [
    'main' => 'Групп нет',
    'additional' => 'Пожалуйста свяжитесь с администрацией для создания группы',
    'buttons' => [
        
    ]
])