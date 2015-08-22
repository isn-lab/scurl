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

	require_once dirname(__FILE__)."/SCurlRequest.php";
	require_once dirname(__FILE__)."/SCurlResult.php";

	class SCurl extends CApplicationComponent
	{

		const METHOD_GET = "GET";
		const METHOD_POST = "POST";

		const MAX_REDIRECTS = 10;

		public function __construct()
		{
		}

		public function init()
		{

		}

		/**
		 * @param $url
		 * @param null|SCurlRequest $request
		 * @return SCurlResult
		 */
		function run($url, $request = null)
		{

			if (!$request)
				$request = new SCurlRequest();

			if (is_array($request->params))
				$params = http_build_query($request->params);
			else
				$params = $request->params;

			if (!$request->encode_params) $params = urldecode($params);

			if ($request->method == self::METHOD_GET)
			{

				if (strpos($url, "?",10) !== false)
				{
					$url .= "&".$params;
				}
				else
				{
					$url .= "?".$params;
				}
			}

			$curl = curl_init($url);

			curl_setopt($curl, CURLOPT_FRESH_CONNECT, 1);
			curl_setopt($curl, CURLOPT_HEADER, 1);
			curl_setopt($curl, CURLOPT_USERAGENT, $request->ua);
			if ($request->debug) curl_setopt($curl, CURLOPT_VERBOSE, 1);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
			//curl_setopt($curl, CURLOPT_FAILONERROR, 0);
			if ($request->referer != null)
				curl_setopt($curl, CURLOPT_REFERER, $request->referer);

			if ($request->method == self::METHOD_POST) {
				curl_setopt($curl, CURLOPT_POST, 1);
				curl_setopt($curl, CURLOPT_POSTFIELDS, $params);
			}

			//curl_setopt($curl, CURLOPT_MAXREDIRS, self::MAX_REDIRECTS);
			curl_setopt($curl, CURLOPT_FOLLOWLOCATION, $request->follow);
			curl_setopt($curl, CURLOPT_TIMEOUT, $request->timeout);

			if ($request->proxy != null) {
				curl_setopt($curl, CURLOPT_HTTPPROXYTUNNEL, 0);
				curl_setopt($curl, CURLOPT_PROXY, $request->proxy);
			}

			if ($request->from_interface != null && preg_match("'^\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}$'", $request->from_interface))
			{
				curl_setopt($curl, CURLOPT_INTERFACE, $request->from_interface);
			}

			if (is_array($request->cookies)) {
				$cc = implode('; ', $request->cookies);
				curl_setopt($curl, CURLOPT_COOKIE, $cc);
			}

			if ($request->custom_headers)
				curl_setopt($curl, CURLOPT_HTTPHEADER, $request->custom_headers);

			curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
			curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);

			$result = new SCurlResult();
			$result->requested_url = $url;

			$result->data = curl_exec($curl);

			$result->info = curl_getinfo($curl);

			$result->headers = substr($result->data, 0, $result->info['header_size']);
			$result->data = substr($result->data, $result->info['header_size']);
			$result->code = $result->info['http_code'];

			if (preg_match_all("'Set-Cookie:\s*([^;]+)'i", $result->headers, $matches)) {
				if ($matches[1])
					$result->cookies = $matches[1];
			}

			if (preg_match("'Location:\s*(.+)'i", $result->headers, $matches)) {
				if ($matches)
					$result->location = $matches[1];
			}

			$result->error = curl_error($curl);
			@curl_close($curl);

			if ($request->savetofile) {
				$result->writed = file_put_contents($request->savetofile, $result->data);
			}

			$result->request = $request;

			return $result;

		}

	}






?>