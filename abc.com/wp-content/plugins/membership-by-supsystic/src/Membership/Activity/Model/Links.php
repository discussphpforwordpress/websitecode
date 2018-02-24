<?php

class Membership_Activity_Model_Links extends Membership_Base_Model_Base
{
	private $url = null;
	public $settings = null;

	public function parseUrl($url) {

		$urlHash = sha1($url);
		$data = $this->getLinkDataByUrlHash($urlHash);
		$this->url = $url;

		if ($data) {
			return $data;
		}
		$url = $this->prepareUrl($url);

		$response = wp_remote_get($url, array(
			'timeout' => 10,
			'user-agent' => 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13'
		));

		if (!is_wp_error($response) && ($response['response']['code'] == 200)) {

			$data = array(
				'url' => $url,
				'url_hash' => $urlHash,
			);


			if (preg_match('/www.facebook.com\/\w+\/videos\/\d+/', $url)) {
				$data['meta'] = $this->getFacebookVideoMetaData($response['body'], $url);
			} else {
				$data['meta'] = $this->getMetaData($response['body']);
			}

			$this->saveLinkData($data);

			return $data;
		}

		return false;
	}

	private function prepareUrl($url) {

		if (strpos($url, '//www.facebook.com/plugins/video.php') !== false) {
			$url = urldecode(str_replace('https://www.facebook.com/plugins/video.php?href=', '', $url));
		}

		return $url;
	}

	/**
	 * Extracts meta tag data from html string
	 *
	 * @param $str
	 * @return array
	 */
	private function getMetaData($str) {

		$validMetaTags = array(
			'title',
			'description',
			'og:title',
			'og:description',
			'og:type',
			'og:image',
			'og:image:width',
			'og:image:height',
			'og:video',
			'og:video:url',
			'og:video:width',
			'og:video:height',
			'og:video:type',
			'twitter:player',
		);

		$meta = array();
		$pattern = '
		~<\s*meta\s

			(?=[^>]*?
			\b(?:name|property|http-equiv)\s*=\s*
			(?|"\s*([^"]*?)\s*"|\'\s*([^\']*?)\s*\'|
			([^"\'>]*?)(?=\s*/?\s*>|\s\w+\s*=))
		)
		
		[^>]*?\bcontent\s*=\s*
			(?|"\s*([^"]*?)\s*"|\'\s*([^\']*?)\s*\'|
			([^"\'>]*?)(?=\s*/?\s*>|\s\w+\s*=))
		[^>]*>
		
		~ix';

		if (preg_match_all($pattern, $str, $matches)) {
			foreach ($matches[1] as $index => $name) {
				if (!isset($meta[$name]) && in_array($name, $validMetaTags)) {
					$meta[$name] = $matches[2][$index];
				}
			}
		}

		if (!isset($meta['title'])) {
			$meta['title'] = '';
			if (!isset($meta['og:title'])) {
				if (preg_match('/<title[^>]*>(.*?)<\/title>/ims', $str, $match)) {
					$meta['title'] = $match[1];
				}
			}
		}

		if (isset($meta['og:title'])) {
			$meta['title'] = $meta['og:title'];
		}

		$meta['title'] = mb_substr(html_entity_decode($meta['title'], ENT_QUOTES, 'UTF-8'), 0, 160, 'UTF-8');

		if (isset($meta['og:description'])) {
			$meta['description'] = $meta['og:description'];
		} else {
			if (!isset($meta['description'])) {
				$meta['description'] = '';
			}
		}

		$meta['description'] = mb_substr(html_entity_decode($meta['description'], ENT_QUOTES, 'UTF-8'), 0, 160, 'UTF-8');

		// special prepare for amazon
		// http://amzn.to/2saOfdF
		// https://www.amazon.it/dp/B00U8ZRECE/ref=as_li_ss_tl?&linkCode=sl1&tag=lostadit-21&linkId=9ed4416eed6e67a101fac1e73b4bcd58
		if(
			!empty($this->settings['base']['import']['amazon-link-img-preview']) && $this->settings['base']['import']['amazon-link-img-preview'] == 1
			&& !empty($this->url) && (preg_match('/amazon\./', $this->url, $urlMatch1) || preg_match('/\/amzn\./', $this->url, $urlMatch2))
		) {
			// url example:
			// https://images-eu.ssl-images-amazon.com/images/I/417TDYd50UL._SY300_QL70_.jpg
			if (preg_match('`https?:\/\/[\w\.\-_]*\/images\/[\w\.\-_]*\/[\w\.\-_]*(?:\.jpg|\.png|\.gif)`ims', $str, $match)) {
				$meta['og:image'] = $match[0];
			}
		} else if (!isset($meta['og:image'])) {
			if (preg_match('/https?:\/\/[^ ]+?(?:\.jpg|\.png|\.gif)/ims', $str, $match)) {
				$meta['og:image'] = $match[0];
			}

		}

		return $meta;
	}

	private function getFacebookVideoMetaData($str, $url) {

		$meta = array(
			'url' => $url,
			'og:video:url' => 'https://www.facebook.com/plugins/video.php?href=' . urlencode($url) . '&autoplay=1',
		);

		if (preg_match('/<title[^>]*>(.*?)<\/title>/ims', $str, $match)) {
			$meta['title'] = $match[1];
		}

		$response = wp_remote_get($meta['og:video:url'], array(
			'timeout' => 10,
			'user-agent' => 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13'
		));

		if (!is_wp_error($response) && ($response['response']['code'] == 200)) {
			if (preg_match('/<video(.*?)>/ims', $response['body'], $match)) {
				if (preg_match('/width=\"(.*?)\"/', $match[1], $width) && preg_match('/height=\"(.*?)\"/', $match[1], $height)) {
					$meta['og:video:width'] = (int)$width[1];
					$meta['og:video:height'] = (int)$height[1];
				}
			}
		}

		if (preg_match('/\"https?:\/\/[^ ]+?(?:\.jpg|\.png|\.gif).*?\"/ims', $str, $match)) {
			$image = trim($match[0], '"');
			$image = html_entity_decode($image);
			$meta['og:image'] = $image;
		}

		return $meta;
	}

	public function getLinkDataByUrlHash($urlHash) {

		$query = $this->preparePrefix("
			/* @lang sql */
			SELECT *
			FROM {prefix}links
			WHERE url_hash = '%s'
		");

		$data = $this->db->get_row(
			$this->db->prepare($query, $urlHash),
			ARRAY_A
		);

		if ($data) {
			$data['meta'] = unserialize($data['meta']);
		}

		return $data;
	}

	public function saveLinkData($data) {

		$currentDateTime = $this->getCurrentDateInUTC();

		$query = $this->preparePrefix("
			/* @lang sql */
			INSERT
			INTO {prefix}links (url, url_hash, meta, created_at)
			VALUES ('%s', '%s', '%s', '%s') 
			ON DUPLICATE KEY UPDATE url = VALUES(url), meta = VALUES(meta), created_at = VALUES(created_at)
		");

		return $this->db->query(
			$this->db->prepare($query, array(
				$data['url'],
				$data['url_hash'],
				serialize($data['meta']),
				$currentDateTime,
			))
		);
	}

	public function setActivityLinkByHash($activityId, $urlHash) {

		$this->removeLink($activityId);
		$link = $this->getLinkDataByUrlHash($urlHash);

		if ($link) {
			$query = $this->preparePrefix("
				/* @lang sql */
				INSERT
				INTO {prefix}activity_links (activity_id, link_id)
				VALUES ('%d', '%d')
				ON DUPLICATE KEY UPDATE activity_id = VALUES(activity_id), link_id = VALUES(link_id)
			");
			$this->db->query(
				$this->db->prepare($query, array(
					$activityId,
					$link['id'],
				))
			);
		}
	}

	public function removeLink($activityId) {
		$query = $this->preparePrefix("
			DELETE FROM {prefix}activity_links WHERE activity_id = '%d';
		");

		$this->db->query(
			$this->db->prepare($query, $activityId)
		);
	}

	public function prepareData($link) {

		return array(
			'id' => $link['id'],
			'hash' => $link['url_hash'],
			'url' => $link['url'],
			'type' => @$link['meta']['og:type'],
			'title' => @$link['meta']['title'],
			'image' => @$link['meta']['og:image'],
			'imageWidth' => @$link['meta']['og:image:width'],
			'imageHeight' => @$link['meta']['og:image:height'],
			'description' => @$link['meta']['description'],
			'hostname' => preg_replace('/^.*\/\/([^\/?#]*).*$/', '$1', $link['url']),
			'video' => $this->prepareDataVideoUrl($link),
			'videoWidth' => @$link['meta']['og:video:width'],
			'videoHeight' => @$link['meta']['og:video:height'],
		);
	}

	private function prepareDataVideoUrl($link) {

		$url = null;

		if (isset($link['meta']['og:video:url'])) {
			$url = $link['meta']['og:video:url'];
		} else if (isset($link['meta']['og:video'])) {
			$url = $link['meta']['og:video'];
		} else if (strpos($link['url'], 'youtube.com') !== false) {
			$url = str_replace('watch?v=', '/embed/', $link['url']);

		}

		if ($url && strpos($url, 'youtube.com') !== false) {
			$url .= '?autoplay=1';
		}

		return $url;
	}


	/**
	 * Extract what remains from an unintentionally truncated serialized string
	 *
	 * Example Usage:
	 *
	 * the native unserialize() function returns false on failure
	 * $data = @unserialize($serialized); // @ silences the default PHP failure notice
	 * if ($data === false) // could not unserialize
	 * {
	 *   $data = repairSerializedArray($serialized); // salvage what we can
	 * }
	 *
	 * $data contains your original array (or what remains of it).
	 *
	 * @param string The serialized array
	 *
	 * @return string
	 */
	public function repairSerializedArray($serialized)
	{
		$tmp = preg_replace('/^a:\d+:\{/', '', $serialized);
		return $this->repairSerializedArray_R($tmp); // operates on and whittles down the actual argument
	}

	/**
	 * The recursive function that does all of the heavy lifing. Do not call directly.
	 * @param string The broken serialzized array
	 * @return string Returns the repaired string
	 */
	private function repairSerializedArray_R(&$broken)
	{
		// array and string length can be ignored
		// sample serialized data
		// a:0:{}
		// s:4:"four";
		// i:1;
		// b:0;
		// N;
		$data       = array();
		$index      = null;
		$len        = strlen($broken);
		$i          = 0;

		while(strlen($broken))
		{
			$i++;
			if ($i > $len)
			{
				break;
			}

			if (substr($broken, 0, 1) == '}') // end of array
			{
				$broken = substr($broken, 1);
				return $data;
			}
			else
			{
				$bite = substr($broken, 0, 2);
				switch($bite)
				{
					case 's:': // key or value
						$re = '/^s:\d+:"([^\"]*)";/';
						if (preg_match($re, $broken, $m))
						{
							if ($index === null)
							{
								$index = $m[1];
							}
							else
							{
								$data[$index] = $m[1];
								$index = null;
							}
							$broken = preg_replace($re, '', $broken);
						}
						break;

					case 'i:': // key or value
						$re = '/^i:(\d+);/';
						if (preg_match($re, $broken, $m))
						{
							if ($index === null)
							{
								$index = (int) $m[1];
							}
							else
							{
								$data[$index] = (int) $m[1];
								$index = null;
							}
							$broken = preg_replace($re, '', $broken);
						}
						break;

					case 'b:': // value only
						$re = '/^b:[01];/';
						if (preg_match($re, $broken, $m))
						{
							$data[$index] = (bool) $m[1];
							$index = null;
							$broken = preg_replace($re, '', $broken);
						}
						break;

					case 'a:': // value only
						$re = '/^a:\d+:\{/';
						if (preg_match($re, $broken, $m))
						{
							$broken         = preg_replace('/^a:\d+:\{/', '', $broken);
							$data[$index]   = $this->repairSerializedArray_R($broken);
							$index = null;
						}
						break;

					case 'N;': // value only
						$broken = substr($broken, 2);
						$data[$index]   = null;
						$index = null;
						break;
				}
			}
		}

		return $data;
	}
}