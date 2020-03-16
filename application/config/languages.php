<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 ** POEditor API
 **/

$config['poeditor']['apikey']    = 'YOUR_API_KEY';
$config['poeditor']['apiurl']    = 'https://poeditor.com/api/';
$config['poeditor']['projectID'] = 'YOUR_PROJECT_ID';


/* The language to fall back on if we cannot determine one any other
   way (user choice or preferences).
 */

$config['default'] = 'en_US';

// Gettext catalog codeset
$config['charset'] = 'UTF-8';

// Gettext domain
$config['domain'] = 'YOUR_PROJECT_NAME';

// Path to gettext locale directory relative to FCPATH.APPPATH
$config['directory'] = 'locale';

// Gettext locale
$config['locale'] = 'C.UTF-8';

$config['languages']['ar_SY'] = 'Arabic (&#x0627;&#x0644;&#x0639;&#x0631;&#x0628;&#x064a;&#x0629;)';
$config['languages']['id_ID'] = 'Bahasa Indonesia';
$config['languages']['be_BY'] = 'Byelorussian';
$config['languages']['bs_BA'] = 'Bosanski';
$config['languages']['bg_BG'] = 'Bulgarian (&#x0411;&#x044a;&#x043b;&#x0433;&#x0430;&#x0440;&#x0441;&#x043a;&#x0438;)';
$config['languages']['ca_ES'] = 'Catal&agrave;';
$config['languages']['zh_CN'] = 'Chinese (Simplified) (&#x7b80;&#x4f53;&#x4e2d;&#x6587;)';
$config['languages']['zh_TW'] = 'Chinese (Traditional) (&#x6b63;&#x9ad4;&#x4e2d;&#x6587;)';
$config['languages']['cs_CZ'] = 'Czech (&#x010c;esky)';
$config['languages']['da_DK'] = 'Dansk';
$config['languages']['de_DE'] = 'Deutsch';
$config['languages']['en_GB'] = 'English (British)';
$config['languages']['en_CA'] = 'English (Canadian)';
$config['languages']['en_US'] = 'English';
$config['languages']['es_ES'] = 'Espa&ntilde;ol';
$config['languages']['fr_FR'] = 'Fran&ccedil;ais'; 
$config['languages']['et_EE'] = 'Eesti';
$config['languages']['gl_ES'] = 'Galego';
$config['languages']['el_GR'] = 'Greek (&#x0395;&#x03bb;&#x03bb;&#x03b7;&#x03bd;&#x03b9;&#x03ba;&#x03ac;)';
$config['languages']['he_IL'] = '&#x202d;Hebrew &#x202e;(&#x05E2;&#x05D1;&#x05E8;&#x05D9;&#x05EA;)';

$config['languages']['is_IS'] = '&Iacute;slenska';
$config['languages']['it_IT'] = 'Italiano';
$config['languages']['ja_JP'] = 'Japanese (&#x65e5;&#x672c;&#x8a9e;)';
$config['languages']['ko_KR'] = 'Korean (&#xd55c;&#xad6d;&#xc5b4;)';
$config['languages']['lv_LV'] = 'Latvie&#x0161;u';
$config['languages']['lt_LT'] = 'Lietuvi&#x0173;';
$config['languages']['mk_MK'] = 'Macedonian (&#x041c;&#x0430;&#x043a;&#x0435;&#x0434;&#x043e;&#x043d;&#x0441;&#x043a;&#x0438;)';
$config['languages']['hu_HU'] = 'Magyar';
$config['languages']['nl_NL'] = 'Nederlands';
$config['languages']['nb_NO'] = 'Norsk bokm&aring;l';
$config['languages']['nn_NO'] = 'Norsk nynorsk';
$config['languages']['fa_IR'] = 'Persian (&#x0641;&#x0627;&#x0631;&#x0633;&#x0649;)';
$config['languages']['pl_PL'] = 'Polski';
$config['languages']['pt_PT'] = 'Portugu&ecirc;s';
$config['languages']['pt_BR'] = 'Portugu&ecirc;s Brasileiro';
$config['languages']['ro_RO'] = 'Rom&acirc;n&auml;';
$config['languages']['ru_RU'] = 'Russian (&#x0420;&#x0443;&#x0441;&#x0441;&#x043a;&#x0438;&#x0439;)';
$config['languages']['sk_SK'] = 'Slovak (Sloven&#x010d;ina)';
$config['languages']['sl_SI'] = 'Slovenian (Sloven&#x0161;&#x010d;ina)';
$config['languages']['fi_FI'] = 'Suomi';
$config['languages']['sv_SE'] = 'Svenska';
$config['languages']['th_TH'] = 'Thai (&#x0e44;&#x0e17;&#x0e22;)';
$config['languages']['tr_TR'] = 'T&uuml;rk&ccedil;e';
$config['languages']['uk_UA'] = 'Ukrainian (&#x0423;&#x043a;&#x0440;&#x0430;&#x0457;&#x043d;&#x0441;&#x044c;&#x043a;&#x0430;)';


/**
 ** Aliases for languages with different browser and gettext codes
 **/

$config['aliases']['ar'] = 'ar_SY';
$config['aliases']['bg'] = 'bg_BG';
$config['aliases']['bs'] = 'bs_BA';
$config['aliases']['ca'] = 'ca_ES';
$config['aliases']['cs'] = 'cs_CZ';
$config['aliases']['da'] = 'da_DK';
$config['aliases']['de'] = 'de_DE';
$config['aliases']['el'] = 'el_GR';
$config['aliases']['en'] = 'en_US';
$config['aliases']['es'] = 'es_ES';
$config['aliases']['et'] = 'et_EE';
$config['aliases']['fa'] = 'fa_IR';
$config['aliases']['fi'] = 'fi_FI';
$config['aliases']['fr'] = 'fr_FR';
$config['aliases']['gl'] = 'gl_ES';
$config['aliases']['he'] = 'he_IL';
$config['aliases']['hu'] = 'hu_HU';
$config['aliases']['id'] = 'id_ID';
$config['aliases']['is'] = 'is_IS';
$config['aliases']['it'] = 'it_IT';
$config['aliases']['ja'] = 'ja_JP';
$config['aliases']['ko'] = 'ko_KR';
$config['aliases']['lt'] = 'lt_LT';
$config['aliases']['lv'] = 'lv_LV';
$config['aliases']['mk'] = 'mk_MK';
$config['aliases']['nl'] = 'nl_NL';
$config['aliases']['nn'] = 'nn_NO';
$config['aliases']['no'] = 'nb_NO';
$config['aliases']['pl'] = 'pl_PL';
$config['aliases']['pt'] = 'pt_PT';
$config['aliases']['ro'] = 'ro_RO';
$config['aliases']['ru'] = 'ru_RU';
$config['aliases']['sk'] = 'sk_SK';
$config['aliases']['sl'] = 'sl_SI';
$config['aliases']['sv'] = 'sv_SE';
$config['aliases']['th'] = 'th_TH';
$config['aliases']['tr'] = 'tr_TR';
$config['aliases']['uk'] = 'uk_UA';

foreach($config['aliases'] as $k => $v) {
    if (!isset($config['languages'][$v])) {
	unset($config['aliases'][$k]);
    }
}

/**
 ** Right-to-left languages
 **/

$config['rtl']['ar_OM'] = true;
$config['rtl']['ar_SY'] = true;
$config['rtl']['fa_IR'] = true;
$config['rtl']['he_IL'] = true;
