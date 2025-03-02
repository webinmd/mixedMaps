<?php

$mapId = $modx->getOption('mapId', $scriptProperties, 'map');
$coordinates = $modx->getOption('coordinates', $scriptProperties, false);
$data = $modx->getOption('data', $scriptProperties, []);
$mapCenter = $modx->getOption('mapCenter', $scriptProperties, false);
$mapParams = $modx->getOption('mapParams', $scriptProperties, []);
$mapCenterOffset = $modx->getOption('mapCenterOffset', $scriptProperties, false);
$elementClass = $modx->getOption('elementClass', $scriptProperties, 'mixedmaps');
$mapClass = $modx->getOption('mapClass', $scriptProperties, $modx->getOption('mixedmaps_map_class', null, 'Leaflet', true));
$mapJs = $modx->getOption('mapJs', $scriptProperties, $modx->getOption('mixedmaps_frontend_js', null, '/assets/components/mixedmaps/libs/leaflet/web.js', true));

$tv = $modx->getOption('tv', $scriptProperties, false);
$resourceId = $modx->getOption('resource', $scriptProperties, false);
$tpl = $modx->getOption('tpl', $scriptProperties, '@INLINE <div id="' . $mapId . '" class="' . $elementClass . '"></div>');


// load map class
$corePath = $modx->getOption('core_path', null, MODX_CORE_PATH) . 'components/mixedmaps/';
require_once $corePath . '/maps/' . strtolower($mapClass) . '.class.php';
$map = new $mapClass($modx, []);
$map->loadCssJsWeb();

if ($mapJs) {
    $modx->regClientScript($mapJs);
}
$output = false;

if (file_exists(MODX_CORE_PATH . 'components/pdotools')) {
    $pdoTools = $modx->getService('pdoTools');
}

if ($data) {
    if (!is_array($data)) {
        $data = json_decode($data, true);
    }

    if (!$mapCenter) {
        $mapCenter = explode(',', $data[0]['coordinates']);
    }
} else {

    // Get coordinates 
    if (!$coordinates) {
        if ($tv) {
            if (!$resourceId) {
                $resourceId = $modx->resource->id;
            }

            if ($object = $modx->getObject('modResource', $resourceId)) {
                $coordinates = $object->getTVValue($tv);
            }
        }
    }

    if ($coordinates) {
        if (!$mapCenter) {
            $mapCenter = explode(',', $coordinates);
        }

        $data[] = [
            'coordinates' => $coordinates
        ];
    }
}


// Set defaul params for map
$params = array_merge([
    'zoom' => 12
], $mapParams);


if ($mapCenterOffset) {
    $mapOffset = explode(',', $mapCenterOffset);
    $mapCenter = [
        $mapCenter[0] + $mapOffset[0],
        $mapCenter[1] + $mapOffset[1]
    ];
}


// set config
$config_js = [
    'data' => $data,
    'mapId' => $mapId,
    'mapCenter' => $mapCenter,
    'params' => $params,
];

$modx->regClientStartupHTMLBlock('<script defer>
if (!window.mixedMapsConfig) {window.mixedMapsConfig = {}; }
mixedMapsConfig["' . $config_js["mapId"] . '"] = ' . json_encode($config_js) . ';           
</script>');

//  

if ($pdoTools) {
    $output = $pdoTools->getChunk($tpl, $scriptProperties);
} else {
    $output = $modx->getChunk($tpl, $scriptProperties);
}

return $output;
