<?php

/**
 * The home manager controller for dartTelegram.
 *
 */
class dartTelegramHomeManagerController extends modExtraManagerController
{
    /** @var dartTelegram $dartTelegram */
    public $dartTelegram;


    /**
     *
     */
    public function initialize()
    {
		$corePath = $this->modx->getOption('darttelegram_core_path', array(), $this->modx->getOption('core_path') . 'components/darttelegram/');
        $this->dartTelegram = $this->modx->getService('dartTelegram', 'dartTelegram', $corePath . 'model/');
        parent::initialize();
    }


    /**
     * @return array
     */
    public function getLanguageTopics()
    {
        return ['darttelegram:default'];
    }


    /**
     * @return bool
     */
    public function checkPermissions()
    {
        return true;
    }


    /**
     * @return null|string
     */
    public function getPageTitle()
    {
        return $this->modx->lexicon('darttelegram');
    }


    /**
     * @return void
     */
    public function loadCustomCssJs()
    {
        $this->addCss($this->dartTelegram->config['cssUrl'] . 'mgr/main.css');
        $this->addJavascript($this->dartTelegram->config['jsUrl'] . 'mgr/darttelegram.js');
        $this->addJavascript($this->dartTelegram->config['jsUrl'] . 'mgr/misc/utils.js');
        $this->addJavascript($this->dartTelegram->config['jsUrl'] . 'mgr/misc/combo.js');
        $this->addJavascript($this->dartTelegram->config['jsUrl'] . 'mgr/widgets/levels.grid.js');
        $this->addJavascript($this->dartTelegram->config['jsUrl'] . 'mgr/widgets/levels.windows.js');
        $this->addJavascript($this->dartTelegram->config['jsUrl'] . 'mgr/widgets/home.panel.js');
        $this->addJavascript($this->dartTelegram->config['jsUrl'] . 'mgr/sections/home.js');

        $this->addHtml('<script type="text/javascript">
        dartTelegram.config = ' . json_encode($this->dartTelegram->config) . ';
        dartTelegram.config.connector_url = "' . $this->dartTelegram->config['connectorUrl'] . '";
        Ext.onReady(function() {MODx.load({ xtype: "darttelegram-page-home"});});
        </script>');
    }


    /**
     * @return string
     */
    public function getTemplateFile()
    {
        $this->content .= '<div id="darttelegram-panel-home-div"></div>';

        return '';
    }
}