<?php
/** @var modX $modx */
switch ($modx->event->name) {
	case 'msOnCreateOrder':
		if(!isset($msOrder)){
			$modx->log(xPDO::LOG_LEVEL_ERROR, 'dartTelegram Error: Не передан объект заказа');
		}else{
			$corePath = $modx->getOption('darttelegram_core_path', array(), $modx->getOption('core_path') . 'components/darttelegram/');
			$dartTelegram = $modx->getService('dartTelegram', 'dartTelegram', $corePath . 'model/', array());
			if (!$dartTelegram) {
				$modx->log(xPDO::LOG_LEVEL_ERROR,  'dartTelegram Error: не могу инициализировать класс.');
			}else {
				if (!$modx->loadClass('pdofetch', MODX_CORE_PATH . 'components/pdotools/model/pdotools/', false, true)) {
					$modx->log(xPDO::LOG_LEVEL_ERROR,  'dartTelegram Error: не могу инициализировать класс pdoFetch.');
				}else{
					$pdoFetch = new pdoFetch($modx, array());
					$data = array(
						'order' => $msOrder->toArray(),
						'delivery' => $msOrder->Delivery->toArray(),
						'payment' => $msOrder->Payment->toArray(),
						'address' => $msOrder->Address->toArray(),
						'user' => $msOrder->User->toArray(),
						'user_profile' => $msOrder->UserProfile->toArray(),
					);
					$_products = $msOrder->getMany('Products');
					foreach ($_products as $product) {
						$data['products'][] = $product->toArray();
					}

					$level = $modx->getOption('darttelegram_order_level');
					$tpl = $modx->getOption('darttelegram_order_chunk');

					if ($tpl && $level) {
						$message = $pdoFetch->getChunk($tpl, $data);
						$message = str_replace("FF", "\n", $message);
						$dartTelegram->sendMessage($level, $message);
					}else{
						$modx->log(xPDO::LOG_LEVEL_ERROR,  'dartTelegram Error: проверьте корректность установки системных настроек заказа (darttelegram_order_level и darttelegram_order_chunk).');
					}
				}

			}
		}
		break;
}