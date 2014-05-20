<?php  
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('css_url'))
{
	function css_url($nom)
	{
		return base_url() . 'assets/css/' . $nom . '.css';
	}
}

if ( ! function_exists('js_url'))
{
	function js_url($nom)
	{
		return base_url() . 'assets/js/' . $nom . '.js';
	}
}

if ( ! function_exists('img_url'))
{
	function img_url($nom)
	{
		return base_url() . 'assets/img/' . $nom;
	}
}

if ( ! function_exists('img'))
{
	function img($nom, $alt = '')
	{
		return '<img src="' . img_url($nom) . '" alt="' . $alt . '" />';
	}
}

if ( ! function_exists('charac_min'))
{
	function charac_min($nom)
	{
		$nom = explode('.',$nom);
		$nom = $nom[0].".png";
		return img($nom);
	}
}

if ( ! function_exists('charac_img'))
{
	function charac_img($nom)
	{
		$nom = explode('.',$nom);
		$nom = $nom[0]."_nrj.png";
		return img($nom);
	}
}