<?php

return [
    'mixedMaps' => [
        'file' => 'mixedmaps',
        'description' => 'Snippet for rendering the map on the front',
        'properties' => [
            'mapClass' => [
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
            'elementClass' => [
                'type' => 'textfield',
                'value' => 'mixedmaps',
            ],
        ],
    ],
];
