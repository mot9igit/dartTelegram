<?php

class dartTelegram
{
    /** @var modX $modx */
    public $modx;


    /**
     * @param modX $modx
     * @param array $config
     */
    function __construct(modX &$modx, array $config = [])
    {
        $this->modx =& $modx;
		$corePath = $this->modx->getOption('darttelegram_core_path', $config, $this->modx->getOption('core_path') . 'components/darttelegram/');
		$assetsUrl = $this->modx->getOption('darttelegram_assets_url', $config, $this->modx->getOption('assets_url') . 'components/darttelegram/');
		$assetsPath = $this->modx->getOption('darttelegram_assets_path', $config, $this->modx->getOption('base_path') . 'assets/components/darttelegram/');

        $this->config = array_merge([
            'corePath' => $corePath,
            'modelPath' => $corePath . 'model/',
            'processorsPath' => $corePath . 'processors/',
			'version' => '0.0.1',

            'connectorUrl' => $assetsUrl . 'connector.php',
            'assetsUrl' => $assetsUrl,
            'assetsPath' => $assetsPath,
            'cssUrl' => $assetsUrl . 'css/',
            'jsUrl' => $assetsUrl . 'js/',

			'apiURL' => $this->modx->getOption("darttelegram_api_url"),
			'token' => $this->modx->getOption("darttelegram_bot_token")
        ], $config);

        $this->modx->addPackage('darttelegram', $this->config['modelPath']);
        $this->modx->lexicon->load('darttelegram:default');
    }

	/**
	 * SendMessage
	 *
	 * @param $level
	 * @param $message
	 * @return bool
	 */

    public function sendMessage($level, $message){
    	$method = 'sendMessage';
    	if(is_numeric($level)){
			$lv = $this->modx->getObject("dartTelegramLevel", $level);
		}else{
			$lv = $this->modx->getObject("dartTelegramLevel", array('name' => $level));
		}
    	if($lv){
    		$chats = explode(",", $lv->get('chats'));
    		if(count($chats)){
    			// если уровень активный
    			if($lv->get('active')){
					$data = array(
						'text' => $message,
						'parse_mode' => $this->modx->getOption('darttelegram_parse_mode')
					);
					$token = $lv->get('token');
					foreach($chats as $chat){
						$data['chat_id'] = $chat;
						$response = $this->request($method, $data, $token);
					}
				}
    			return true;
			}else{
				$this->modx->log(xPDO::LOG_LEVEL_ERROR,  'dartTelegram Error: не заполнены чаты для уведомлений.');
			}
		}else{
			$this->modx->log(xPDO::LOG_LEVEL_ERROR,  'dartTelegram Error: не найден уровень уведомления.');
		}
    	return false;
	}

	/**
	 * Request to API
	 *
	 * @param $method
	 * @param $data
	 * @return bool|mixed
	 */

    public function request($method, $data, $token = ''){
    	if($token){
    		$tk = $token;
		}else{
    		$tk = $this->config['token'];
		}
		$website = $this->config['apiURL'].$tk.'/';
		$ch = curl_init($website . $method);
		curl_setopt($ch, CURLOPT_HEADER, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		$result = curl_exec($ch);
		if (curl_errno($ch)) {
			$this->modx->log(xPDO::LOG_LEVEL_ERROR,  'dartTelegram Error:' . curl_error($ch));
			curl_close($ch);
			return false;
		}else{
			curl_close($ch);
			return json_decode($result, 1);
		}
	}
}