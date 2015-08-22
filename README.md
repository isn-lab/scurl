PHP Curl Helper

Usage:

			/* Simple request */

			$scurl = new SCurl();
			$url = 'http://github.com';
			$result = $scurl->run($url);

			if ($result->info['http_code'] != '200') {
				echo "Error http request.";
				echo $result->error;
			}
			
			//Debug show result cookies
			print_r($result->cookies);
			
			
			/* Advanced Request */

			$request = new SCurlRequest();
			
			//Set cookies
			$request->cookies = array(
				'samplecookie' => '132',
			);
			
			//Set request URL
			$request->referer = $url;
			
			//Set request method (default is GET)
			$request->method = SCurl::METHOD_POST;
			
			//Send Custom headers
			$request->custom_headers = array(
				'X-CSRF-Token:' . 'qwerty',
				'X-Requested-With: XMLHttpRequest'
			);

			//Set parameters
			$request->params = array(
				'name'     => 'you username',
				'password' => 'you pass',
			);

			//Debug show request
			print_r($request);

			$result = $scurl->run($url, $request);
			if ($result->info['http_code'] != '200') {
				echo "Fail request";
				echo $result->error;
			}

			//Print result data
			print_r($result->data);
			print_r($result->headers);
			print_r($result->info);
			
			
			
			
			
			