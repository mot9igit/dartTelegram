<?php
if (file_exists(dirname(dirname(dirname(dirname(__FILE__)))) . '/config.core.php')) {
	/** @noinspection PhpIncludeInspection */
	require_once dirname(dirname(dirname(dirname(__FILE__)))) . '/config.core.php';
} else {
	require_once dirname(dirname(dirname(dirname(dirname(dirname(__FILE__)))))) . '/config.core.php';
}
/** @noinspection PhpIncludeInspection */
require_once MODX_CORE_PATH . 'config/' . MODX_CONFIG_KEY . '.inc.php';
/** @noinspection PhpIncludeInspection */
require_once MODX_CONNECTORS_PATH . 'index.php';
/** @var dartTelegram $dartTelegram */
$corePath = $modx->getOption('darttelegram_core_path', null, $modx->getOption('core_path') . 'components/darttelegram/');
$dartTelegram = $modx->getService('dartTelegram', 'dartTelegram', $corePath . 'model/');
$modx->lexicon->load('darttelegram:default');

// handle request
$corePath = $modx->getOption('darttelegram_core_path', null, $modx->getOption('core_path') . 'components/darttelegram/');
$path = $modx->getOption('processorsPath', $dartTelegram->config, $corePath . 'processors/');
$modx->getRequest();

/** @var modConnectorRequest $request */
$request = $modx->request;
$request->handleRequest([
    'processors_path' => $path,
    'location' => '',
]);