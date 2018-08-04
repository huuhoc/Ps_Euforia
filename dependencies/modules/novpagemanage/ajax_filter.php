<?php
/******************
 * Vinova Themes  Framework for Prestashop 1.7.x 
 * @package   	novpagemanage
 * @version   	1.0
 * @author   	http://vinovathemes.com/
 * @copyright 	Copyright (C) October 2013 vinovathemes.com <@emai:vinovathemes@gmail.com>
 * <info@vinovathemes.com>.All rights reserved.
 * @license   GNU General Public License version 1
 
 * *****************/
include_once('../../config/config.inc.php');
include_once('../../init.php');
include_once 'class/default.php';
include_once('novpagemanage.php');

$context = Context::getContext();
$novpagemanage = new novpagemanage();
if (!Tools::isSubmit('secure_key') || Tools::getValue('secure_key') != $novpagemanage->secure_key || !Tools::getValue('action'))
	die(1);

if (Tools::getValue('action') == 'filter_product')
{
	$id_category 	= Tools::getValue('id_category') 	? Tools::getValue('id_category') : "";
	$id_manufacture = Tools::getValue('id_manufacture') ? Tools::getValue('id_manufacture') : "";
	$id_attribute 	= Tools::getValue('id_attribute') 	? Tools::getValue('id_attribute') : "";
	$count_showmore 	= Tools::getValue('count_showmore') ? Tools::getValue('count_showmore') : 0;
	$numberload 	= Tools::getValue('numberload') ? Tools::getValue('numberload') : 4;
	$orderby 	= Tools::getValue('orderby') 	? Tools::getValue('orderby') : "";
	$limit 	= Tools::getValue('limit') 	? Tools::getValue('limit') : 4;
	$min_price 	= Tools::getValue('min_price') 	? (float)Tools::getValue('min_price') : 0;
	$max_price 	= Tools::getValue('max_price') 	? (float)Tools::getValue('max_price') : 0;
	$data = $novpagemanage->ajaxFilterProduct($id_category,$id_manufacture,$id_attribute,$orderby,$limit,$count_showmore,$numberload,$min_price,$max_price);
	die($data);
}