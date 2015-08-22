<?php
	/**
	 * Created by ISNLab.
	 * User: Sedov Sergey
	 * Date: 05.06.15
	 * Time: 21:11
	 * Comment: CURL Helper
	 * Author: Sedov Sergey <sedov.sergey@isnlab.com>
	 * Version: 1.0
	 */

	/**
	 * Class SCurlRequest
	 */
	class SCurlRequest
	{


		/**
		 * Follow if redirects required
		 * @var bool
		 */
		public $follow = true;
		/**
		 * Request method
		 * @var string
		 */
		public $method = 'GET';
		/**
		 * Referer string
		 * @var null|string
		 */
		public $referer = null;
		/**
		 * POST/GET parameters
		 * @var array|string
		 */
		public $params;
		/**
		 * Cookies list
		 * @var array
		 */
		public $cookies = array();
		/**
		 * Proxy Address if needed
		 * @var null
		 */
		public $proxy;

		//DEbug with Charles
		//public $proxy = '127.0.0.1:8888';

		/**
		 * Browser User Agent
		 * @var string
		 */
		public $ua = 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:37.0) Gecko/20100101 Firefox/37.0';

		/**
		 * Request timeout
		 * @var int
		 */
		public $timeout = 30;

		/**
		 * URL Encode parametrs or not. Default is true.
		 * @var bool
		 */
		public $encode_params = true;
		/**
		 * File name to save data
		 * @var null|string
		 */
		public $savetofile = null;

		/**
		 * Custom HTTP Headers
		 * @var array|null
		 */
		public $custom_headers;

		/**
		 * CURL Verbose debug
		 * @var bool
		 */
		public $debug = false;

		/**
		 * Add another IP xxx.xxx.xxx.xxx
		 * Requests will be ruuning from this interface
		 * @var null|string
		 */
		public $from_interface = null;

		function __construct()
		{
		}

	}
?>