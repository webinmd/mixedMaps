<?php

$mapId = $modx->getOption('mapId', $scriptProperties, 'map');
$coordinates = $modx->getOption('mapId', $scriptProperties, false);
$elementClass = $modx->getOption('elementClass', $scriptProperties, 'mixedmaps');
$mapClass = $modx->getOption('mapClass', $scriptProperties, $modx->getOption('mixedmaps_map_class', null, 'Leaflet', true));
$tv = $modx->getOption('tv', $scriptProperties, false);
$resourceId = $modx->getOption('resource', $scriptProperties, false);
$tpl = $modx->getOption('tpl', $scriptProperties, '@INLINE <div id="' . $mapId . '" class="' . $elementClass . '"></div>');

$corePath = $modx->getOption('core_path', null, MODX_CORE_PATH) . 'components/mixedmaps/';
require_once $corePath . '/maps/' . strtolower($mapClass) . '.class.php';
$map = new $mapClass($modx, []);
$map->loadCssJsWeb();
$output = false;

if (file_exists(MODX_CORE_PATH . 'components/pdotools')) {
    $pdoTools = $modx->getService('pdoTools');
}


if ($coordinates) {
    $coordinates = json_decode($coordinates, true);
} else {

    if ($tv) {
        if (!$resourceId) {
            $resourceId = $modx->resource->id;
        }

        if ($object = $modx->getObject('modResource', $resourceId)) {
            $coordinates = $object->getTVValue($tv);
        }
    }
}


$params = array_merge([
    'coordinates' => $coordinates,
], $scriptProperties);

if ($pdoTools) {
    $output = $pdoTools->getChunk($tpl, $params);
} else {
    $outputCat .= $modx->getChunk($tpl, $params);
}

$config_js = [
    'coordinates' => $coordinates,
    'mapId' => $mapId,
];

$this->controller->addHtml('<script defer>
mixedMaps.config = ' . json_encode($config_js) . ';           
</script>');

return $output;

// обработать параметры
// подключить карту
// подключить скрипт выбранного класса
// передать параметры в скрипт