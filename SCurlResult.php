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
	 * Class SCurlResult
	 */
	class SCurlResult
	{

		/**
		 * HTML or XML data
		 * @var string
		 */
		public $data;
		/**
		 * Information data
		 * @var
		 */
		public $info;
		/**
		 * Errors
		 * @var string|null
		 */
		public $error;
		/**
		 * Cookies array
		 * @var array|null
		 */
		public $cookies;
		/**
		 * Location url
		 * @var string|bool
		 */
		public $location;
		/**
		 * Write to file result
		 * @var int
		 */
		public $writed;

		/**
		 * @var string HTTP answer code
		 */
		public $code;

		/**
		 * Request Object
		 * @var null
		 */
		public $request = null;
		/**
		 * Requested URL
		 * @var
		 */
		public $requested_url;

		/**
		 * Return Headers
		 * @var string
		 */
		public $headers;

		public function generateNextRequest()
		{
			$req = new SCurlRequest();
			if (!$this->request) return $req;
		}


	}
?>