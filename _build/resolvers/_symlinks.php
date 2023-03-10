<?php
/** @var xPDOTransport $transport */
/** @var array $options */
/** @var modX $modx */
if ($transport->xpdo) {
    $modx =& $transport->xpdo;

    $dev = MODX_BASE_PATH . 'Extras/dartTelegram/';
    /** @var xPDOCacheManager $cache */
    $cache = $modx->getCacheManager();
    if (file_exists($dev) && $cache) {
        if (!is_link($dev . 'assets/components/darttelegram')) {
            $cache->deleteTree(
                $dev . 'assets/components/darttelegram/',
                ['deleteTop' => true, 'skipDirs' => false, 'extensions' => []]
            );
            symlink(MODX_ASSETS_PATH . 'components/darttelegram/', $dev . 'assets/components/darttelegram');
        }
        if (!is_link($dev . 'core/components/darttelegram')) {
            $cache->deleteTree(
                $dev . 'core/components/darttelegram/',
                ['deleteTop' => true, 'skipDirs' => false, 'extensions' => []]
            );
            symlink(MODX_CORE_PATH . 'components/darttelegram/', $dev . 'core/components/darttelegram');
        }
    }
}

return true;