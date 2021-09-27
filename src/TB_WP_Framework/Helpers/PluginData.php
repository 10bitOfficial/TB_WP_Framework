<?php

namespace TB_WP_Framework\Helpers;
if(!defined('ABSPATH')){exit;}

/**
 * Class PluginData
 * @package TB_WP_Framework\Helpers
 * @since 1.0.0
 * @author Eyal Borgman <www.linkedin.com/in/eyalborgman>
 */
class PluginData {
	/**
	 * @var
	 * @since 1.0.0
	 */
	public $pluginData;
	/**
	 * @var mixed
	 * @since 1.0.0
	 */
	public $Name;
	/**
	 * @var mixed
	 * @since 1.0.0
	 */
	public $Title;
	/**
	 * @var mixed
	 * @since 1.0.0
	 */
	public $Description;
	/**
	 * @var mixed
	 * @since 1.0.0
	 */
	public $Author;
	/**
	 * @var mixed
	 * @since 1.0.0
	 */
	public $AuthorURI;
	/**
	 * @var mixed
	 * @since 1.0.0
	 */
	public $Version;
	/**
	 * @var mixed
	 * @since 1.0.0
	 */
	public $TextDomain;
	/**
	 * @var mixed
	 * @since 1.0.0
	 */
	public $DomainPath;
	/**
	 * @var mixed
	 * @since 1.0.0
	 */
	public $Network;
	/**
	 * @var mixed
	 * @since 1.0.0
	 */
	public $RequiresWP;
	/**
	 * @var mixed
	 * @since 1.0.0
	 */
	public $RequiresPHP;
	/**
	 * @var mixed
	 * @since 1.0.0
	 */
	public $UpdateURI;
	/**
	 * @var
	 * @since 1.0.0
	 */
	public $URL;
	/**
	 * @var
	 * @since 1.0.0
	 */
	public $DIR;

	/**
	 * @param $pluginData
	 */
	public function __construct($pluginData) {
		$this->pluginData = $pluginData;
		$this->Name = $this->pluginData['Name'];
		$this->Title = $this->pluginData['Title'];
		$this->Description = $this->pluginData['Description'];
		$this->Author = $this->pluginData['Author'];
		$this->AuthorURI = $this->pluginData['AuthorURI'];
		$this->Version = $this->pluginData['Version'];
		$this->TextDomain = $this->pluginData['TextDomain'];
		$this->DomainPath = $this->pluginData['DomainPath'];
		$this->Network = $this->pluginData['Network'];
		$this->RequiresWP = $this->pluginData['RequiresWP'];
		$this->RequiresPHP = $this->pluginData['RequiresPHP'];
		$this->UpdateURI = $this->pluginData['UpdateURI'];
	}
}