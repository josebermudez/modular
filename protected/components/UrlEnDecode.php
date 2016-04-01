<?php

class UrlEnDecode
{
	/**
	 * 
	 */
	public static function base64UrlEncode($input)
	{
		return strtr(base64_encode($input), '+/=', '-_,');
	}
	/**
	 * 
	 */
	public static function base64UrlDecode($input)
	{
		return base64_decode(strtr($input, '-_,', '+/='));
	}
	
}
