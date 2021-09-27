<?php

namespace TB_WP_Framework\WP_Settings;
if(!defined('ABSPATH')){exit;}

/**
 * Class MenuPage
 * @package TB_WP_Framework\WP_Settings
 * @since 1.0.0
 * @author Eyal Borgman <www.linkedin.com/in/eyalborgman>
 */
class MenuPage {
	/**
	 * @var string
	 * @since 1.0.0
	 */
	public $assetDirPath;
	/**
	 * @var string
	 * @since 1.0.0
	 */
	public $assetDirURL;
	/**
	 * @var string
	 * @since 1.0.0
	 */
	public $pageTitle;
	/**
	 * @var string
	 * @since 1.0.0
	 */
	public $menuTitle;
	/**
	 * @var string
	 * @since 1.0.0
	 */
	public $menuSlug;
	/**
	 * @var
	 * @since 1.0.0
	 */
	public $Callback;


	/**
	 * @param string $pageTitle
	 * @param string $menuTitle
	 * @param $Callback
	 * @param string $menuSlug
	 */
	public function __construct(string $pageTitle,string $menuTitle,$Callback,string $menuSlug) {
		$this->pageTitle = $pageTitle;
		$this->menuTitle = $menuTitle;
		$this->menuSlug = $this->getMenuSlug($menuSlug,$menuTitle);
		$this->Callback = $Callback;
		$this->assetDirPath = plugin_dir_path(__DIR__).'assets/admin/';
		$this->assetDirURL = plugin_dir_url(__DIR__).'assets/admin/';
	}

	/**
	 * @since 1.0.0
	 */
	public function setMenuPages() {
		add_action( 'admin_menu', array( $this, 'registerMenuPages' ) );
	}

	/**
	 * @since 1.0.0
	 */
	public function registerMenuPages() {
		$this->addMenuPage();
		$this->addSubMenuPages();
	}

	/**
	 * @since 1.0.0
	 */
	public function addMenuPage() {
		add_menu_page( $this->pageTitle, $this->menuTitle, 'manage_options', $this->menuSlug, $this->Callback, 'dashicons-marker', 6 );
	}

	/**
	 * @since 1.0.0
	 */
	public function addSubMenuPages() {
		add_submenu_page( $this->menuSlug, $this->pageTitle, $this->menuTitle, 'manage_options', $this->menuSlug );
	}


	/**
	 * @param $menuSlug
	 * @param string|null $menuTitle
	 *
	 * @return string
	 * @since 1.0.0
	 */
	protected function getMenuSlug($menuSlug,?string $menuTitle): string {
		if ($menuSlug)
			return $menuSlug;
		if ($menuTitle)
			return sanitize_title($menuTitle);
		return sanitize_title($this->menuTitle);
	}
}