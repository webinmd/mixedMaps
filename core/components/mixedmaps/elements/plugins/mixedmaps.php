<?php
$corePath = $modx->getOption('core_path', null, MODX_CORE_PATH) . 'components/mixedmaps/';
$assetsUrl = $modx->getOption('assets_url', null, MODX_ASSETS_URL) . 'components/mixedmaps/';

$modx->lexicon->load('mixedmaps:default');

switch ($modx->event->name) {
    case 'OnTVInputRenderList':
        $modx->event->output($corePath . 'elements/tv/input/');
        break;
    case 'OnTVOutputRenderList':
        $modx->event->output($corePath . 'elements/tv/output/');
        break;
    case 'OnTVInputPropertiesList':
        $modx->event->output($corePath . 'elements/tv/input/options/');
        break;
    case 'OnTVOutputRenderPropertiesList':
        $modx->event->output($corePath . 'elements/tv/properties/');
        break;
    case 'OnDocFormPrerender':
    case 'OnManagerPageBeforeRender':

        //component scripts
        $modx->regClientStartupScript($assetsUrl . 'js/mgr/default.js');
        $modx->regClientCSS($assetsUrl . 'css/mgr/default.css');
        $modx->controller->addLexiconTopic('mixedmaps:default');

        $mapClass = $modx->getOption('mixedmaps_map_class', null, 'Leaflet', true);
        require_once $corePath . '/maps/' . strtolower($mapClass) . '.class.php';
        $map = new $mapClass($modx, []);
        $map->loadMapLibrary();

        break;
}
