<?php

class Leaflet
{

    /** @var modX $modx */
    public $modx;

    public $config = [];


    /**
     * @param modX $modx
     * @param array $config
     */
    public function __construct(modX $modx, array $config = [])
    {

        $this->modx = $modx;

        $assetsUrl = $this->modx->getOption('assets_url') . 'components/mixedmaps/';

        $this->config = array_merge([
            'js' => [
                $assetsUrl . 'libs/leaflet/leaflet.js',
                $assetsUrl . 'libs/autocomplete/autocomplete.min.js'
            ],
            'css' => [
                $assetsUrl . 'libs/leaflet/leaflet.css',
                $assetsUrl . 'libs/autocomplete/autocomplete.min.css'
            ],
        ], $config);

        return $this->config;
    }

    public function loadMapLibrary()
    {
        // JS
        foreach ($this->config['js'] as $js) {
            $this->modx->regClientStartupScript($js);
        }

        // CSS
        foreach ($this->config['css'] as $css) {
            $this->modx->regClientCSS($css);
        }
    }
}
