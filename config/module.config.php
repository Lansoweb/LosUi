<?php
return [
    'view_helpers' => [
        'invokables' => [
            'los_alert'               => 'LosUi\View\Helper\Alert',
            'los_badge'               => 'LosUi\View\Helper\Badge',
            'los_button'              => 'LosUi\View\Helper\Button',
            'los_chosen'              => 'LosUi\View\Helper\Chosen',
            'los_flashmessenger'      => 'LosUi\View\Helper\FlashMessenger',
            'los_form'                => 'LosUi\Form\View\Helper\Form',
            'los_formrow'             => 'LosUi\Form\View\Helper\FormRow',
            'los_form_element_errors' => 'LosUi\Form\View\Helper\FormElementErrors',
            'los_form_renderer'       => 'LosUi\Form\View\Helper\Form',
            'los_headlink'            => 'LosUi\View\Helper\HeadLink',
            'los_headscript'          => 'LosUi\View\Helper\HeadScript',
            'los_icon'                => 'LosUi\View\Helper\Icon',
            'los_image'               => 'LosUi\View\Helper\Image',
            'los_label'               => 'LosUi\View\Helper\Label',
            'los_well'                => 'LosUi\View\Helper\Well',
        ]
    ],
    'asset_manager' => [
        'resolver_configs' => [
            'paths' => [
                'module_name' => __DIR__ . '/../public/',
            ]
        ]
    ]
];
