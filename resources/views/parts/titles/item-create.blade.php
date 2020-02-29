@include('parts/titles/title', [
    'main' => 'Группа №'.$group->id.'. Создана '.$group->created_at,
    'additional' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Velit alias quibusdam debitis!',
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
])