<?php

/** @var xPDOTransport $transport */
/** @var array $options */
/** @var modX $modx */
if ($transport->xpdo) {
	$modx = $transport->xpdo;
	switch ($options[xPDOTransport::PACKAGE_ACTION]) {
		case xPDOTransport::ACTION_INSTALL:
		case xPDOTransport::ACTION_UPGRADE:
			$modx->addPackage('darttelegram', MODX_CORE_PATH . 'components/darttelegram/model/');
			$lang = $modx->getOption('manager_language') === 'en' ? 1 : 0;

			$levels = [
				[
					'name' => 'FATAL',
					'active' => 1,
					'id' => 1
				],
				[
					'name' => 'ERROR',
					'active' => 1,
					'id' => 2
				],
				[
					'name' => 'WARN',
					'active' => 1,
					'id' => 3
				],
				[
					'name' => 'INFO',
					'active' => 1,
					'id' => 4
				],
				[
					'name' => 'DEBUG',
					'active' => 1,
					'id' => 5
				],
			];

			foreach ($levels as $properties) {
				$id = $properties['id'];
				unset($properties['id']);

				$level = $modx->getObject('dartTelegramLevel', [
					'id' => $id,
					'OR:name:=' => $properties['name']
				]);
				if (!$level) {
					$level = $modx->newObject('dartTelegramLevel', $properties);
				}
				$level->save();

				$status_id = $level->get('id');
				$status_name = $properties['name'];
			}
			break;

		case xPDOTransport::ACTION_UNINSTALL:
			$modx->removeCollection('dartTelegramLevel', []);
			break;
	}
}
return true;