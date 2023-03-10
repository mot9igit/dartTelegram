<?php

/** @var modX $modx */
/** @var formit $formit */
/** @var hook $hook */
/** @var array $scriptProperties */
/** @var dartTelegram $dartTelegram */

$corePath = $modx->getOption('darttelegram_core_path', $scriptProperties, $modx->getOption('core_path') . 'components/darttelegram/');
$dartTelegram = $modx->getService('dartTelegram', 'dartTelegram', $corePath . 'model/', $scriptProperties);
if (!$dartTelegram) {
	$modx->log(xPDO::LOG_LEVEL_ERROR,  'dartTelegram Error: не могу инициализировать класс.');
}else {
	$values = $hook->getValues();
	$level = $modx->getOption('dtLevel', $scriptProperties, 'INFO');
	$fields = $modx->getOption('dtFields', $scriptProperties, array());
	$formName = $modx->getOption('formName', $formit->config, 'form-' . $modx->resource->get('id'));
	$ip = $modx->getOption('REMOTE_ADDR', $_SERVER, '');

	$message_data = array(
		"Название формы" => $formName,
		"IP" => $ip
	);

	if (count($fields)) {
		foreach ($fields as $key => $field) {
			$message_data[$field] = $values[$key];
		}
	} else {
		// если поля не заполнены выводим весь массив данных
		foreach ($values as $key => $field) {
			$message_data[$key] = $field;
		}
	}

	$txt = '<b>Заполнена форма - ' . $formName . "</b>\n";
	// Цикл по массиву (собираем сообщение)
	foreach ($message_data as $key => $value) {
		$txt .= "<b>" . $key . "</b>: " . $value . " \n";
	}
	$dartTelegram->sendMessage($level, $txt);
}
return true;
