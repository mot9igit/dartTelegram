<?php

class dartTelegramLevelGetListProcessor extends modObjectGetListProcessor
{
    public $objectType = 'dartTelegramLevel';
    public $classKey = 'dartTelegramLevel';
    public $defaultSortField = 'id';
    public $defaultSortDirection = 'ASC';
    //public $permission = 'list';


    /**
     * We do a special check of permissions
     * because our objects is not an instances of modAccessibleObject
     *
     * @return boolean|string
     */
    public function beforeQuery()
    {
        if (!$this->checkPermissions()) {
            return $this->modx->lexicon('access_denied');
        }

        return true;
    }


    /**
     * @param xPDOQuery $c
     *
     * @return xPDOQuery
     */
    public function prepareQueryBeforeCount(xPDOQuery $c)
    {
        $query = trim($this->getProperty('query'));
        if ($query) {
            $c->where([
                'name:LIKE' => "%{$query}%",
                'OR:description:LIKE' => "%{$query}%",
				'OR:chats:LIKE' => "%{$query}%",
            ]);
        }

        return $c;
    }


    /**
     * @param xPDOObject $object
     *
     * @return array
     */
    public function prepareRow(xPDOObject $object)
    {
        $array = $object->toArray();
        $array['actions'] = [];

        // Edit
        $array['actions'][] = [
            'cls' => '',
            'icon' => 'icon icon-edit',
            'title' => $this->modx->lexicon('darttelegram_level_update'),
            //'multiple' => $this->modx->lexicon('darttelegram_levels_update'),
            'action' => 'updateLevel',
            'button' => true,
            'menu' => true,
        ];

        if (!$array['active']) {
            $array['actions'][] = [
                'cls' => '',
                'icon' => 'icon icon-power-off action-green',
                'title' => $this->modx->lexicon('darttelegram_level_enable'),
                'multiple' => $this->modx->lexicon('darttelegram_levels_enable'),
                'action' => 'enableLevel',
                'button' => true,
                'menu' => true,
            ];
        } else {
            $array['actions'][] = [
                'cls' => '',
                'icon' => 'icon icon-power-off action-gray',
                'title' => $this->modx->lexicon('darttelegram_level_disable'),
                'multiple' => $this->modx->lexicon('darttelegram_levels_disable'),
                'action' => 'disableLevel',
                'button' => true,
                'menu' => true,
            ];
        }

        // Remove
        $array['actions'][] = [
            'cls' => '',
            'icon' => 'icon icon-trash-o action-red',
            'title' => $this->modx->lexicon('darttelegram_level_remove'),
            'multiple' => $this->modx->lexicon('darttelegram_levels_remove'),
            'action' => 'removeLevel',
            'button' => true,
            'menu' => true,
        ];

        return $array;
    }

}

return 'dartTelegramLevelGetListProcessor';