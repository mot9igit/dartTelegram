<?php

class dartTelegramLevelDisableProcessor extends modObjectProcessor
{
    public $objectType = 'dartTelegramLevel';
    public $classKey = 'dartTelegramLevel';
    public $languageTopics = ['darttelegram'];
    //public $permission = 'save';


    /**
     * @return array|string
     */
    public function process()
    {
        if (!$this->checkPermissions()) {
            return $this->failure($this->modx->lexicon('access_denied'));
        }

        $ids = $this->modx->fromJSON($this->getProperty('ids'));
        if (empty($ids)) {
            return $this->failure($this->modx->lexicon('darttelegram_level_err_ns'));
        }

        foreach ($ids as $id) {
            /** @var dartTelegramLevel $object */
            if (!$object = $this->modx->getObject($this->classKey, $id)) {
                return $this->failure($this->modx->lexicon('darttelegram_level_err_nf'));
            }

            $object->set('active', false);
            $object->save();
        }

        return $this->success();
    }

}

return 'dartTelegramLevelDisableProcessor';
