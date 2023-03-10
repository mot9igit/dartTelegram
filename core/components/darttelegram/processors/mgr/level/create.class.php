<?php

class dartTelegramLevelCreateProcessor extends modObjectCreateProcessor
{
    public $objectType = 'dartTelegramLevel';
    public $classKey = 'dartTelegramLevel';
    public $languageTopics = ['darttelegram'];
    //public $permission = 'create';


    /**
     * @return bool
     */
    public function beforeSet()
    {
        $name = trim($this->getProperty('name'));
        if (empty($name)) {
            $this->modx->error->addField('name', $this->modx->lexicon('darttelegram_level_err_name'));
        } elseif ($this->modx->getCount($this->classKey, ['name' => $name])) {
            $this->modx->error->addField('name', $this->modx->lexicon('darttelegram_level_err_ae'));
        }

        return parent::beforeSet();
    }

}

return 'dartTelegramLevelCreateProcessor';