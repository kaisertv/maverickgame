<?php
session_start();
include("dbconnection.php");
$reward_id           =  mysql_real_escape_string($_REQUEST['reward_id']);
$reward_name         =  mysql_real_escape_string($_REQUEST['reward_name']);
$reward_price        =  mysql_real_escape_string($_REQUEST['reward_price']);
$reward_description  =  mysql_real_escape_string($_REQUEST['reward_description']);
$smallimage = $_FILES['reward_image'];
	if ($smallimage['name'] == "")
	$reward_image = $_REQUEST['prev_image'];
else
	$reward_image= $smallimage['name'];
	if (!$smallimage['error']) 
		{
			if (!@move_uploaded_file($smallimage['tmp_name'],"../rewards_stores/" . $smallimage['name']) ) 
			{
				header("location:edit-reward-store.php?id=$reward_id&err=Unknown Error Occured please try again");
				exit();
			}
			else
			{
                            $work = new ImgResizer("../rewards_stores/". $smallimage['name']);
	 		}
		} 
updateRewardStore($reward_id,$reward_name,$reward_price,$reward_description,$reward_image);
header("location:maverick-rewards.php?update");
  class ImgResizer {
	var $originalFile = '';
	function ImgResizer($originalFile = '') {
		$this -> originalFile = $originalFile;
	}
	function resize($newWidth, $targetFile) {
		if (empty($newWidth) || empty($targetFile)) {
			return false;
		}
		$src = imagecreatefromjpeg($this -> originalFile);
		list($width, $height) = getimagesize($this -> originalFile);
		$newHeight = ($height / $width) * $newWidth;
		$tmp = imagecreatetruecolor($newWidth, $newHeight);
		imagecopyresampled($tmp, $src, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
		if (file_exists($targetFile)) {
			unlink($targetFile);
		}
		imagejpeg($tmp, $targetFile, 85);
	}
}
              
