<?php

return [
    'mixedMaps' => [
        'file' => 'mixedmaps',
        'description' => 'mixedMaps snippet to lrender map on frontend',
        'properties' => [
            'class' => [
                'type' => 'textfield',
                'value' => 'Leaflet',
            ],
            'coordinates' => [
                'type' => 'textfield',
                'value' => '',
            ],
            'mapId' => [
                'type' => 'textfield',
                'value' => 'map',
            ],
        ],
    ],
];
