<?php
/**
 * YiiMailer class - wrapper for PHPMailer
 * Yii extension for sending emails using views and layouts
 * https://github.com/vernes/YiiMailer
 * Copyright (c) 2014 YiiMailer
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation; either
 * version 2.1 of the License, or (at your option) any later version.
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this library; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301  USA
 *
 *
 * @package YiiMailer
 * @author Vernes Šiljegović
 * @copyright  Copyright (c) 2014 YiiMailer
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt	LGPL
 * @version 1.6, 2014-07-09
 */

require_once(dirname(__FILE__).DIRECTORY_SEPARATOR.'YiiMailer.php');
class YiiMailerModular extends YiiMailer {
	
	public function __construct($view='', $data=array(), $layout='')
	{
		parent::__construct($view, $data, $layout);
	}

	/**
	 * Save message as eml file
	 * @return boolean True if saved successfully, false otherwise
	 */
	public function save()
	{
		$filename = date('YmdHis') . '_' . uniqid() . '.eml';
		$dir = Yii::getPathOfAlias($this->savePath);

		// Create a directory
		if(!is_dir($dir))
		{
			$oldmask = @umask(0);
			$result = @mkdir($dir, 0777);
			@umask($oldmask);
			if (!$result)
			{
				throw new CException('Unable to create the directory '.$dir);
			}
		}

		try {
			$file = fopen($dir . DIRECTORY_SEPARATOR . $filename,'w+');
			fwrite($file, $this->GetSentMIMEMessage());
			fclose($file);

			return $filename;
		} catch(Exception $e) {
			$this->SetError($e->getMessage());

			return '';
		}
	}
		
}
