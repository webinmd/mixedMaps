<?php
if (!class_exists('MixedMapsInputRender')) {
    class MixedMapsInputRender extends modTemplateVarInputRender
    {

        public function getTemplate()
        {
            return $this->modx->getOption('core_path') . 'components/mixedmaps/elements/tv/input/tpl/mixedmaps.tpl';
        }

        public function process($value, array $params = [])
        {
            $mapClass = $this->modx->getOption('mixemaps_map_class', null, 'mixedmapsLeaflet', true);
            require_once dirname(__FILE__, 4) . '/maps/' . strtolower($mapClass) . '.class.php';
            $map = new $mapClass($this->modx, $params);
            $map->loadMapLibrary();
        }


        public function getLexiconTopics()
        {
            return array('mixedmaps:default');
        }
    }
}
return 'MixedMapsInputRender';
