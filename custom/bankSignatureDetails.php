<?php

/*
Author : Aditya Harshey 
Date : 27th May 2017
*/
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

class bankSignatureDetails
{
	public function renderView($value='')
	{
		include 'bankView.php';
	}
}

$o = new bankSignatureDetails;
$o->renderView();
?>