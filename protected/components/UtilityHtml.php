<?php

class UtilityHtml extends CrugeAuthManager
{
		public static function getImagetitle($status) {
		if ((bool)$status === true || strtolower($status) === 'yes') {
			return 'Active';
		} else {
			return 'Inactive';
		}
	}
 
	public static function getStatusImage($status) {
		if ((bool)$status === true || strtolower($status) === 'yes') {
			return Yii::app()->theme->baseUrl."/img/formatovalido.png";
		} else {
			return Yii::app()->theme->baseUrl."/img/formatoerroneo.png";
		}
	}
	
	public static function getPregenerarLink($status,$codigoFormato){
		if ((bool)$status === true || strtolower($status) === 'yes') {
			return Yii::app()->createUrl("/motivo/motivo/pregenerar", array("formato"=>$codigoFormato));
		} else {
			return "javascript:;";
		}
		
	}
	
	public static function getPregenerarLinkEsVisible($status){
		if ((bool)$status === true || strtolower($status) === 'yes') {
			return true;
		} else {
			return false;
		}
		
	}
}
