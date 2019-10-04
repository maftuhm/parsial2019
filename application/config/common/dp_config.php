<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$config['title']      		= 'PARSIAL 2019';
$config['content_title']['tryout'] 		= 'Try Out SBMPTN';
$config['content_title']['mathcomp'] 	= 'Mathematic Competition';
$config['content_title']['futsal'] 		= 'Futsal Competition';
$config['content_title']['singcomp'] 	= 'Singing Competition';
$config['content_title']['baksos'] 		= 'Bakti Sosial';

/*
|--------------------------------------------------------------------------
| Content URL
|--------------------------------------------------------------------------
|
*/
$content 	= array('Tryout', 'Mathcom', 'Futsal', 'Singcom', 'Baksos');
$parsial 	= 'Parsial';
$domain 	= 'https://s.id/';
$payment 	= 'Pembayaran';
$upload 	= 'Upload';
$print 		= 'Cetak';

/*$config['content_url']['tryout'] 			= $domain.$content[0].$parsial;
$config['content_url']['payment_tryout']	= $domain.$payment.$content[0].$parsial;
$config['content_url']['mathcomp'] 			= $domain.$content[1].$parsial;
$config['content_url']['payment_mathcomp']	= $domain.$payment.$content[1].$parsial;
$config['content_url']['futsal'] 			= $domain.$content[2].$parsial;
$config['content_url']['payment_futsal']	= $domain.$payment.$content[2].$parsial;
$config['content_url']['singcomp'] 			= $domain.$content[3].$parsial;
$config['content_url']['payment_singcomp']	= $domain.$payment.$content[3].$parsial;*/

$config['content_url']['print_tryout'] 		= $domain.$print.$content[0].$parsial;
$config['content_url']['upload_futsal'] 	= $domain.$upload.$content[2].$parsial;
$config['content_url']['upload_singcomp'] 	= $domain.$upload.$content[3].$parsial;

/*
|--------------------------------------------------------------------------
| SK URL
|--------------------------------------------------------------------------
|
*/
$himatika 		= "http://himatika.fst.uinjkt.ac.id/parsial2019/";
$sk 	  		= "/sk/";
$content_title 	= $config['content_title'];
$find = ' ';
$i = 0;
foreach ($content_title as $key => $value) {
	$config['content_url'][$key] = $domain.$content[$i].$parsial;
	$config['content_url']['payment_'.$key] = $domain.$payment.$content[$i].$parsial;

	$title = str_replace($find, '-', strtolower($value));
	$config['sk_url'][$key] = $himatika.$title.$sk;
	$i++;
}

/*
|--------------------------------------------------------------------------
| Base Site URL
|--------------------------------------------------------------------------
|
*/
// Possible hosts locally. You can add some if needed.
$config['host_dev'] = array('localhost', '127.0.0.1');

// Fill in the file of your project here when you develop locally.
$host_dev = 'parsial2019';

// Fill in the domain name here when your project is online.
// Example : www.johndoe.com
//           johndoe.com
$host_prod = 'www.parsial.site';

// WARNING: Do not modify the lines below
$domain = (in_array($_SERVER['HTTP_HOST'], $config['host_dev'], TRUE)) ? $_SERVER['HTTP_HOST'] . '/' . $host_dev : $host_prod;

$config['base_url'] = ( ! empty($_SERVER['HTTPS'])) ? 'https://' . $domain : 'http://' . $domain;

/*
|--------------------------------------------------------------------------
| Index File
|--------------------------------------------------------------------------
|
*/
$config['index_page'] = '';

/*
|--------------------------------------------------------------------------
| Assets
|--------------------------------------------------------------------------
|
*/
$config['assets_dir']     = 'assets';
$config['frameworks_dir'] = $config['assets_dir'] . '/frameworks';
$config['plugins_dir']    = $config['assets_dir'] . '/plugins';

/*
|--------------------------------------------------------------------------
| Upload
|--------------------------------------------------------------------------
|
*/
$config['upload_dir']     = 'upload';
$config['avatar_dir']     = $config['upload_dir'] . '/avatar';
$config['images_dir']      = $config['upload_dir'] . '/images';