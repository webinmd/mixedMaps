<?php
if (!class_exists('MixedMapsInputRender')) {
    class MixedMapsInputRender extends modTemplateVarInputRender
    {

        public function getTemplate()
        {
            $mapClass = $this->getActiveMapClass();
            return $this->modx->getOption('core_path') . 'components/mixedmaps/elements/tv/input/tpl/mixedmaps_' . strtolower($mapClass) . '.tpl';
        }

        public function process($value, array $params = []) {}


        public function getLexiconTopics()
        {
            return array('mixedmaps:default');
        }

        private function getActiveMapClass()
        {
            $mapClass = $this->modx->getOption('mixedmaps_map_class', null, 'Leaflet', true);
            return $mapClass;
        }
    }
}
return 'MixedMapsInputRender';
