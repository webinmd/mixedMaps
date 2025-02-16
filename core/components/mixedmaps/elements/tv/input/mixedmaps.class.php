<?php
if (!class_exists('MixedMapsInputRender')) {
    class MixedMapsInputRender extends modTemplateVarInputRender
    {

        public function getTemplate()
        {
            return $this->modx->getOption('core_path') . 'components/mixedmaps/elements/tv/input/tpl/mixedmaps.tpl';
        }

        public function process($value, array $params = array()) {}

        public function getLexiconTopics()
        {
            return array('mixedmaps:default');
        }
    }
}
return 'MixedMapsInputRender';
