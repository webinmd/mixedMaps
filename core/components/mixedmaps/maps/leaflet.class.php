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

        $this->config = array_merge([
            'assets' =>  $this->modx->getOption('assets_url') . 'components/mixedmaps/',
        ], $config);

        return $this->config;
    }


    /**
     * Loads CSS and JS files for the manager interface.
     *
     * This function registers necessary JavaScript and CSS files for the manager
     * interface using the MODX methods `regClientStartupScript` and `regClientCSS`.
     * The files are specified in the `$jsList` and `$cssList` arrays and are 
     * loaded from the assets path defined in the configuration.
     */

    public function loadCssJsMgr()
    {
        // JS
        $jsList = [
            $this->config['assets'] . 'libs/leaflet/leaflet.js',
            $this->config['assets'] . 'libs/autocomplete/autocomplete.min.js'
        ];

        foreach ($jsList as $js) {
            $this->modx->regClientStartupScript($js);
        }

        // CSS
        $cssList = [
            $this->config['assets'] . 'libs/leaflet/leaflet.css',
            $this->config['assets'] . 'libs/autocomplete/autocomplete.min.css',
        ];

        foreach ($cssList as $css) {
            $this->modx->regClientCSS($css);
        }
    }

    /**
     * Register CSS and JS for frontend.
     *
     * This function is called by the system on page load.
     * It loads all JS and CSS files specified in the system settings.
     * These files are loaded after the MODX page has been processed, so you can use MODX placeholders and snippet calls in them.
     *
     * @return void
     */

    public function loadCssJsWeb()
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
