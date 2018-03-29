<?php

return [
    'view_helpers' => [
        'factories' => [
            'LosUi\View\Helper\Url' => 'LosUi\View\Helper\UrlFactory',
        ],
        'invokables' => [
            'losAlert' => 'LosUi\View\Helper\Alert',
            'losBadge' => 'LosUi\View\Helper\Badge',
            'losButton' => 'LosUi\View\Helper\Button',
            'losChosen' => 'LosUi\View\Helper\Chosen',
            'losFlashMessenger' => 'LosUi\View\Helper\FlashMessenger',
            'losForm' => 'LosUi\Form\View\Helper\Form',
            'losFormRow' => 'LosUi\Form\View\Helper\FormRow',
            'losFormCollection' => 'LosUi\Form\View\Helper\FormCollection',
            'losFormElementErrors' => 'LosUi\Form\View\Helper\FormElementErrors',
            'losFormRenderer' => 'LosUi\Form\View\Helper\Form',
            'losHeadlink' => 'LosUi\View\Helper\HeadLink',
            'losHeadscript' => 'LosUi\View\Helper\HeadScript',
            'losIcon' => 'LosUi\View\Helper\Icon',
            'losImage' => 'LosUi\View\Helper\Image',
            'losLabel' => 'LosUi\View\Helper\Label',
            'losNavigation' => 'LosUi\View\Helper\Navigation',
            'losPaginationControl' => 'LosUi\View\Helper\PaginationControl',
            'losWell' => 'LosUi\View\Helper\Well',
        ],
    ],
    'view_manager' => [
        'template_path_stack' => [
            'losui' => __DIR__.'/../view',
        ],
    ],
];
