<?php

namespace TB_WP_Framework\WP_Settings;
if(!defined('ABSPATH')){exit;}
use TB_WP_Framework\Helpers\Debug;
use TB_WP_Framework\Helpers\PluginData;
use TB_WP_Framework\TB_WP_Framework;
use WP_REST_Request;

/**
 * Class Options
 * @package TB_WP_Framework\WP_Settings
 * @since 1.0.0
 * @author Eyal Borgman <www.linkedin.com/in/eyalborgman>
 */
abstract class Options {
	/**
	 * @var array
	 * @since 1.0.0
	 */
	protected $options = [];
	/**
	 * @var
	 * @since 1.0.0
	 */
	protected $pluginData;
	/**
	 * @var
	 * @since 1.0.0
	 */
	protected $optionsName;
	/**
	 * @var string
	 * @since 1.0.0
	 */
	protected $apiBaseName;
	/**
	 * @var string
	 * @since 1.0.0
	 */
	protected $apiVersion = 'v1';
	/**
	 * @var
	 * @since 1.0.0
	 */
	protected $optionsUpdateTrigger;
	/**
	 * @var array
	 * @since 1.0.0
	 */
	protected $apiRoutes = [];
	/**
	 * @var string
	 * @since 1.0.0
	 */
	public $optionsRouteAPI;
	/**
	 * @var string
	 */
	private $siteURL;
	/**
	 * @var Debug
	 */
	private $log;

	/**
	 *
	 */
	public function __construct() {
		$this->log = new Debug();
	    $this->siteURL = get_site_url();
        $this->apiBaseName = $this->getApiBaseName();
		$this->init();
	    $this->optionsRouteAPI = $this->initOptionsAPI();
    }

	/**
	 * @since 1.0.0
	 */
	protected function init() {
		$this->initPluginData();
		$this->initOptions();

	}

	/**
	 * @since 1.0.0
	 */
	protected function initPluginData(){
		$this->pluginData = new PluginData($this->pluginData());
		$this->optionsName = $this->pluginData->TextDomain.'_tb_options';
		$this->optionsUpdateTrigger = $this->pluginData->TextDomain.'_options';
	}

	/**
	 * @since 1.0.0
	 */
	protected function initOptions() {
		$this->options = get_option($this->optionsName,[]);
		if (isset($_POST[$this->optionsUpdateTrigger])){
			$newOptions = $_POST;
			unset($newOptions[$this->optionsUpdateTrigger]);
			$this->setOptions($newOptions);
		} else {
			$this->buildOptions();
		}

	}

	/**
	 * @since 1.0.0
	 */
	protected function updateOptions(){
		update_option($this->optionsName,$this->options);
		$this->buildOptions();
	}

	/**
	 * @return string
	 * @since 1.0.0
	 */
	public function getUpdateHiddenInput(): string {
		return "<input type='hidden' name='{$this->optionsUpdateTrigger}' value='Y'>";
	}

	/**
	 * @since 1.0.0
	 */
	public function theUpdateHiddenInput(){
		echo $this->getUpdateHiddenInput();
	}

	/**
	 * @since 1.0.0
	 */
	public function buildOptions() {
		if (!empty($this->options)) {
			foreach ( $this->options as $key => $value ) {
				$this->$key = $value;
			}
		}
	}

	/**
	 * @return mixed
	 * @since 1.0.0
	 */
	public function getPluginData() {
		return $this->pluginData;
	}

	/**
	 * @return array
	 * @since 1.0.0
	 */
	public function getOptions(): array {
		return $this->options;
	}

	/**
	 * @param string $name
	 *
	 * @return mixed|string
	 * @since 1.0.0
	 */
	public function get(string $name){
		return $this->options[ $name ] ?? '';
	}

	/**
	 * @param array $options
	 *
	 * @since 1.0.0
	 */
	public function setOptions( array $options ): void {
		if (empty($options)) {
			$this->options = $options;
		} else {
			$this->options = array_merge($this->options,$options);
			$this->updateOptions();
		}
		$this->updateOptions();
	}
	/*---------------------------*/
	/*------OPTIONS API----------*/
	/*---------------------------*/

	/**
	 * @return string
	 * @since 1.0.0
	 */
	public function initOptionsAPI(): string {
		$this->apiBaseName = $this->getApiBaseName();
		add_action( 'rest_api_init', function () {
			register_rest_route( $this->apiBaseName.'/'.$this->apiVersion, '/options/', [
				[
					'methods' => 'GET',
					'callback' => [$this,'getOptionsCallback'],
					'permission_callback' => function () {
						return current_user_can( 'edit_others_posts' );
					}
				],
				[
					'methods' => 'POST',
					'callback' => [$this,'PostOptionsCallback'],
					'permission_callback' => function () {
						return current_user_can( 'edit_others_posts' );
					}
				],

			] );
		} );
		return $this->OptionsRouteAPI();
	}

	/**
	 * @param \WP_REST_Request $request
	 *
	 * @since 1.0.0
	 */
	public function getOptionsCallback(WP_REST_Request $request){
		if ($request->get_param('option') == null)
			wp_send_json($this->getOptions(),200);
		wp_send_json($this->get($request->get_param('option')),200);

	}

	/**
	 * @param \WP_REST_Request $request
	 *
	 * @since 1.0.0
	 */
	public function postOptionsCallback(WP_REST_Request $request){
		$data = $request->get_json_params();
//		$this->log->debug(__FUNCTION__,['$data'=>[gettype($data),$data]]);
		$optionName = str_replace('_switch','',$data['name']);
		$optionValue = $data['value']=='on'?$data['checked']:$data['value'];
		$this->setOptions([
			$optionName => $optionValue
		]);
		wp_send_json('Done!',200);
	}

	/**
	 * @return string
	 * @since 1.0.0
	 */
	public function OptionsRouteAPI(): string {
		return $this->siteURL.'/wp-json/'.$this->apiBaseName.'/'.$this->apiVersion.'/options/';
	}

	/**
     * The API base name
     * @return string
     */
    abstract public function getApiBaseName():string;

	/**
	 * @return array
	 * @since 1.0.0
	 */
	abstract public function pluginData():array;


}