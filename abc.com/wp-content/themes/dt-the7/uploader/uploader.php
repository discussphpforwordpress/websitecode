<?php
defined('ABSPATH') or exit;

defined('UPLOAD_FILE_URL') or define('UPLOAD_FILE_URL',dirname(__FILE__));
wplog('UPLOAD_FILE_URL:'.UPLOAD_FILE_URL);

wp_enqueue_script('upload-ajax', UPLOAD_FILE_URL . '/js/upload.js', array('jquery'));
if (!function_exists('upload_images_by_user')) :

function upload_images_by_user() {
    wplog("do upload_images_by_user");
    $targetFolder = '/upload/';
    if (!empty($_FILES)) {
        var_dump($_FILES);
        echo '<br/>';
        $file_names = $_FILES['upfile']['name']; //文件名称
        for ($i = 0; $i < count($file_names); $i++) {
            $file_name = $file_names[$i];
            var_dump($file_name);
            echo 'filename:' . $file_name . '\n';
            echo '<br/>';
            // $file_name = iconv("UTF-8","gb2312", $_FILES['upfile']['name']); //文件名称
            $filenames = explode(".", $file_name);
            $tempFile = $_FILES['upfile']['tmp_name'][$i];
            echo 'tempFile:' . $tempFile;
            $rand = rand(1000, 9999);
            $targetPath = $_SERVER['DOCUMENT_ROOT'] . '/' . ltrim($targetFolder, '/'); //图片存放目录
            $targetFile = rtrim($targetPath, '/') . '/' . time() . $rand . "." . $filenames[count($filenames) - 1]; //图片完整路徑

            // Validate the file type
            $fileTypes = array('jpg', 'jpeg', 'png'); // File extensions
            $fileParts = pathinfo($_FILES['file']['name']);

        // if (in_array($fileParts['extension'],$fileTypes)) {
            move_uploaded_file($tempFile, iconv("UTF-8", "gb2312", $targetFile));
            echo json_encode(array("url" => $targetFile, 'name' => $file_name));
        }

            // exit(json_encode(array("url"=>$targetFile,'name'=>$file_name)));
        // } else {
        //     echo 'Invalid file type.';
        // }
    }
}

add_action('wp_ajax_upload_images', 'upload_images_by_user');
endif;