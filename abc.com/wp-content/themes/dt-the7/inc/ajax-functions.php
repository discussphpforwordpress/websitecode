<?php

/**
 * Ajax functions.
 */

// File Security Check
if (!defined('ABSPATH')) {
	exit;
}

if (!function_exists('presscore_ajax_pagination_controller')) :

/**
 * Ajax pagination controller.
 *
 */
function presscore_ajax_pagination_controller()
{

	$ajax_data = array(
		'nonce' => isset($_POST['nonce']) ? $_POST['nonce'] : false,
		'post_id' => isset($_POST['postID']) ? absint($_POST['postID']) : false,
		'post_paged' => isset($_POST['paged']) ? absint($_POST['paged']) : false,
		'target_page' => isset($_POST['targetPage']) ? absint($_POST['targetPage']) : false,
		'page_data' => isset($_POST['pageData']) ? $_POST['pageData'] : false,
		'term' => isset($_POST['term']) ? $_POST['term'] : '',
		'orderby' => isset($_POST['orderby']) ? $_POST['orderby'] : '',
		'order' => isset($_POST['order']) ? $_POST['order'] : '',
		'loaded_items' => isset($_POST['visibleItems']) ? array_map('absint', $_POST['visibleItems']) : array(),
		'sender' => isset($_POST['sender']) ? $_POST['sender'] : '',
		'posts_count' => isset($_POST['postsCount']) ? $_POST['postsCount'] : 0,
	);

	if ($ajax_data['post_id'] && 'page' == get_post_type($ajax_data['post_id'])) {
		$template = dt_get_template_name($ajax_data['post_id'], true);
	} else if (is_array($ajax_data['page_data'])) {

		switch ($ajax_data['page_data'][0]) {
			case 'archive':
				$template = 'archive';
				break;
			case 'search':
				$template = 'search';
		}
	}

	do_action('presscore_before_ajax_response', $template);

	$response = array('success' => false, 'reason' => 'undefined template');
	if (in_array($template, array('template-blog-list.php', 'template-blog-masonry.php'))) {
		$response = presscore_blog_ajax_loading_responce($ajax_data);
	}

	$response = apply_filters('presscore_ajax_pagination_response', $response, $ajax_data, $template);

	wp_send_json($response);
}
add_action('wp_ajax_nopriv_presscore_template_ajax', 'presscore_ajax_pagination_controller');
add_action('wp_ajax_presscore_template_ajax', 'presscore_ajax_pagination_controller');

endif;

if (!function_exists('upload_images_by_user')) :

	function upload_images_by_user()
{
	wplog("do upload_images_by_user");
	$targetFolder = '/upload/';
	if (!empty($_FILES)) {
		wplog("not empty file");
		$file_names = $_FILES['file']['name']; //文件名称
		wplog($file_names);
		for ($i = 0; $i < count($file_names); $i++) {
			$file_name = $file_names[$i];
			wplog('filename:' . $file_name . '\n');
				// $file_name = iconv("UTF-8","gb2312", $_FILES['upfile']['name']); //文件名称
			$filenames = explode(".", $file_name);
			$tempFile = $_FILES['file']['tmp_name'][$i];

			wplog('tempFile:' . $tempFile);
			$rand = rand(1000, 9999);
			$targetPath = $_SERVER['DOCUMENT_ROOT'] . '/' . ltrim($targetFolder, '/') . get_current_user_id(); //图片存放目录
			wplog('targetPath:' . $targetPath);
			if (!file_exists($targetPath)) {
				mkdir($targetPath);
			}
			$targetFile = rtrim($targetPath, '/') . '/' . time() . $rand . "." . $filenames[count($filenames) - 1]; //图片完整路徑

			wplog('targetFile:' . $targetFile);
				// Validate the file type
			$fileTypes = array('jpg', 'jpeg', 'png'); // File extensions
			$fileParts = pathinfo($_FILES['file']['name']);
	
			// if (in_array($fileParts['extension'],$fileTypes)) {
			move_uploaded_file($tempFile, iconv("UTF-8", "gb2312", $targetFile));
			// echo json_encode(array("url" => $targetFile, 'name' => $file_name));
		}
	
				// exit(json_encode(array("url"=>$targetFile,'name'=>$file_name)));
			// } else {
			//     echo 'Invalid file type.';
			// }
	} else {
		wplog('empty file');
	}
}

add_action('wp_ajax_upload_images', 'upload_images_by_user');
endif;

if (!function_exists('get_images_by_user')) :

	function get_images_by_user()
{
	wplog("do get_images_by_user");
	$targetFolder = '/upload/';
	$dir = $_SERVER['DOCUMENT_ROOT'] . '/' . ltrim($targetFolder, '/') . get_current_user_id();

	// Open a known directory, and proceed to read its contents
	$result = array();
	$index = 0;
	if (is_dir($dir)) {
		if ($dh = opendir($dir)) {
			while (($file = readdir($dh)) !== false) {
				if (filetype($dir . $file) != 'dir') {
					$result[$index] = '/' . ltrim($targetFolder, '/') . get_current_user_id() . '/' . $file;
					$index++;
				}
			}
			closedir($dh);
		}
	}

	echo json_encode($result);
	die();
}

add_action('wp_ajax_get_my_pic', 'get_images_by_user');
endif;

if (!function_exists('del_one_pic_by_user')) :

	function del_one_pic_by_user()
{
	wplog("do del_one_pic_by_user");
	$pathinfo = isset($_POST['picinfo']) ? $_POST['picinfo'] : '';
	wplog("picinfo:" . $pathinfo);
	$targetFolder = '/upload/';
	$file = $_SERVER['DOCUMENT_ROOT'] . '/' . ltrim($targetFolder, '/') . get_current_user_id() . '/' . $pathinfo;
	unlink($file);
}

add_action('wp_ajax_del_one_pic', 'del_one_pic_by_user');
endif;

if (!function_exists('create_album_by_user')) :
	function copyDir($dirSrc, $dirTo)
{
	if (is_file($dirTo)) {
		echo $dirTo . '这不是一个目录';
		return;
	}
	if (!file_exists($dirTo)) {
		echo $dirTo . '这不是一个目录';
		return;
	}

	if ($handle = opendir($dirSrc)) {
		while ($filename = readdir($handle)) {
			if ($filename != '.' && $filename != '..') {
				$subsrcfile = $dirSrc . '/' . $filename;
				$subtofile = $dirTo . '/' . $filename;
				if (is_file($subsrcfile)) {
					copy($subsrcfile, $subtofile);
				}
			}
		}
		closedir($handle);
	}

}
function create_album_by_user()
{
	wplog("do create_album_by_user");
	$targetFolder = '/album/';
	$albumName = isset($_POST['albumName']) ? $_POST['albumName'] : '';
	$modelPath = $_SERVER['DOCUMENT_ROOT'] . '/' . ltrim($targetFolder, '/') . 'model';
	$targetPath = $_SERVER['DOCUMENT_ROOT'] . '/' . ltrim($targetFolder, '/')
		. get_current_user_id() . '/' . ltrim($albumName, '/'); //图片存放目录
	wplog('modelPath:' . $modelPath);
	wplog('targetPath:' . $targetPath);
	if (!file_exists($targetPath)) {
		mkdir(iconv("UTF-8", "GBK", $targetPath), 0777, true);
		copyDir($modelPath, $targetPath);
	} else {
		echo "相册已创建";
	}
}

add_action('wp_ajax_create_album', 'create_album_by_user');
endif;

if (!function_exists('get_album_names_by_user')) :

	function get_album_names_by_user()
{
	wplog("do get_album_names_by_user");
	$targetFolder = '/album/';
	$dir = $_SERVER['DOCUMENT_ROOT'] . '/' . ltrim($targetFolder, '/') . get_current_user_id();

	// Open a known directory, and proceed to read its contents
	$result = array();
	$index = 0;
	if (is_dir($dir)) {
		if ($dh = opendir($dir)) {
			while (($filename = readdir($dh)) !== false) {
				if($filename != "." && $filename != ".."){
                    $subFile = $dir.DIRECTORY_SEPARATOR.$filename; //要将源目录及子文件相连
                    if(is_dir($subFile)){ //若子文件是个目录
						$result[$index] = '/' . ltrim($targetFolder, '/') . get_current_user_id() . '/' . $filename;
						$index++;
					}
				}
			}
			closedir($dh);
		}
	}

	echo json_encode($result);
	die();
}

add_action('wp_ajax_get_album_names', 'get_album_names_by_user');
endif;