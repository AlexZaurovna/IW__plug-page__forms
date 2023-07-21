<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("test");
?><?
// $APPLICATION->IncludeComponent(
// 	"bitrix:main.auth.form",
// 	"auth_user",
// 	Array(
// 		"AUTH_FORGOT_PASSWORD_URL" => "",
// 		"AUTH_REGISTER_URL" => "",
// 		"AUTH_SUCCESS_URL" => ""
// 	)
// );
?><?
// $APPLICATION->IncludeComponent(
// 	"aspro:auth.next", 
// 	"main", 
// 	array(
// 		"PERSONAL" => "",
// 		// "PERSONAL" => "/personal/",
// 		"SEF_MODE" => "N",
// 		"COMPONENT_TEMPLATE" => "main"
// 	),
// 	false
// );
?><br>
 <?
 $APPLICATION->IncludeComponent(
	"bitrix:system.auth.form",
	"auth_user",
	Array(
		"FORGOT_PASSWORD_URL" => "",
		"PROFILE_URL" => "/personal/",
		"REGISTER_URL" => "",
		"SHOW_ERRORS" => "N"
	)
);
?><br><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>