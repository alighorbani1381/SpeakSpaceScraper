<?php
class urlPage
{
	
    # Use This Command for LocalSystem
	public static function isOnline(){
		$connected = file_get_contents("http://www.google.com");
		if($connected)
			return true;
		else
			return false;
	}
	public static function urlGenerate($number)
	{
		$baseUrl = "https://spacespeak.com/Users/";
		$endUrl = "/Messages";
		$fullUrl = $baseUrl . $number . $endUrl;
		return $fullUrl;
	}

	public static function hasMessage($content)
	{
		return ((strpos($content, "unexpected") === false) && (strpos($content, "No messages found") === false) && (strpos($content, "Private Message") === false));
	}
}