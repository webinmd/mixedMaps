<?php

$root = $modx->getOption('core_path') . 'components/mixedmaps/elements/tv/input/';

return $modx->smarty->fetch($root . 'tpl/mixedmaps.options.tpl');
