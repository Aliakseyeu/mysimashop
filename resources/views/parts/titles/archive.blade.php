@include('parts/titles/title', [
    'main' => 'Группа №'.$group->id.'. Создана '.$group->created_at,
    'additional' => $group->comment,
    'buttons' => [
        [
            'class' => 'primary',
            'icon' => 'clipboard-list',
            'text' => 'Сделать отчет',
            'link' => url('/report/'.$group->id)
        ],
    ]
])