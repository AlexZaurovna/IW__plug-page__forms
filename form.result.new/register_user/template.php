<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

use Bitrix\Main\Page\Asset;
$asset = Asset::getInstance();
$APPLICATION->ShowHead();
$asset->addString("<link href='//fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>");
$asset->addString("<link href='//fonts.googleapis.com/css?family=Raleway' rel='stylesheet' type='text/css'>");

$formQuestions = $arResult['QUESTIONS'];
$formFieldLogin = $arResult['QUESTIONS']['donaquarf_login'];
$formFieldEmail = $arResult['QUESTIONS']['donaquarf_email'];
$formFieldPhone = $arResult['QUESTIONS']['donaquarf_phone'];
$formFieldOrder = $arResult['QUESTIONS']['donaquarf_order'];
?>
<?if ($arResult["isFormErrors"] == "Y"):?><?=$arResult["FORM_ERRORS_TEXT"];?><?endif;?>

<?=$arResult["FORM_NOTE"]?>

<?if ($arResult["isFormNote"] != "Y") { ?>
<?=$arResult["FORM_HEADER"]?>

<div id="plug__reg-form">
	<div class="plug-form__content">
		<? if ($arResult["isFormTitle"] == "Y" || $arResult["isFormDescription"] == "Y") { ?>
			<? if ($arResult["isFormTitle"]) { ?>
				<p class="plug-form__title"><?=$arResult["FORM_TITLE"]?></p>
			<? } ?>
			<p class="plug-form__description"><?=$arResult["FORM_DESCRIPTION"]?></p>
		<? } ?>
		<div class="plug-form__plug-fields">
			<label  class="plug-form__form-field">
				<div class="form-field__icon">
					<img src="/images/plug/mdi_user.svg" alt="" class="icon__login">
				</div>
				<?=$arResult['funcGetInputHtml']($formFieldLogin, $arResult['arrVALUES'])?>
			</label>
			<label  class="plug-form__form-field">
				<div class="form-field__icon">
					<img src="/images/plug/mdi_email.svg" alt="" class="icon__email">
				</div>
				<?=$arResult['funcGetInputHtml']($formFieldEmail, $arResult['arrVALUES'])?>
			</label>
			<label  class="plug-form__form-field">
				<div class="form-field__icon">
					<img src="/images/plug/mdi_phone.svg" alt="" class="icon__phone">
				</div>
				<?=$arResult['funcGetInputHtml']($formFieldPhone, $arResult['arrVALUES'])?>
			</label>
		</div>
		<div class="reg-form__order-inf">
			<p class="order-inf__title"><?=GetMessage('FORM_ORDER_INFO_TITLE')?></p>
			<div class="order-inf__inf-fields">
				<label  class="plug-form__form-field">
					<div class="form-field__icon">
						<img src="/images/plug/mdi_order.svg" alt="" class="icon__order-num">
					</div>
					<?=$arResult['funcGetInputHtml']($formFieldOrder, $arResult['arrVALUES'])?>
				</label>
				<div class="inf-fields__markets">
					<?
					foreach ($formQuestions as $questionKey => $formQuestion) {
						switch ($questionKey) {
							case 'donaquarf_ya_market':
					?>
								<div class="markets__single-market ya-market">
									<label class="single-market__box">
										<?=$arResult['funcGetInputHtml']($formQuestion, $arResult['arrVALUES'])?>
										<span class="market__box-custom"></span>
									</label>
									<div class="market__title"><?=$formQuestion['CAPTION']?></div>
								</div>
					<?
								break;
							case 'donaquarf_ozon_market':
					?>
								<div class="markets__single-market ozon-market">
									<label class="single-market__box">
										<?=$arResult['funcGetInputHtml']($formQuestion, $arResult['arrVALUES'])?>
										<span class="market__box-custom"></span>
									</label>
									<div class="market__title"><?=$formQuestion['CAPTION']?></div>
								</div>
					<?
								break;
							case 'donaquarf_ali_market':
					?>
								<div class="markets__single-market ali-market">
									<label class="single-market__box">
										<?=$arResult['funcGetInputHtml']($formQuestion, $arResult['arrVALUES'])?>
										<span class="market__box-custom"></span>
									</label>
									<div class="market__title"><?=$formQuestion['CAPTION']?></div>
								</div>
					<?
								break;
							default:
								break;
						}
					}
					?>
				</div>
			</div>
		</div>
	</div>
	<?$bShowLicenses = (isset($arParams["SHOW_LICENCE"]) ? $arParams["SHOW_LICENCE"] : COption::GetOptionString("aspro.next", "SHOW_LICENCE", "Y"));?>
	<?if($bShowLicenses == "Y"):?>
		<div class="licence_block filter label_block plug__reg-form__license">
			<input type="checkbox" id="licenses_popup" name="licenses_popup"  required value="Y" checked <?//=(COption::GetOptionString("aspro.next", "LICENCE_CHECKED", "N") == "Y" ? "checked" : "");?>>
			<label for="licenses_popup">
				<?$APPLICATION->IncludeFile(SITE_DIR."include/licenses_text.php", Array(), Array("MODE" => "html", "NAME" => "LICENSES")); ?>
			</label>
		</div>
	<?endif;?>
	<input class="plug__plug-form__btn" type="submit" name="web_form_submit" value="<?=htmlspecialcharsbx(strlen(trim($arResult["arForm"]["BUTTON"])) <= 0 ? GetMessage("FORM_ADD") : $arResult["arForm"]["BUTTON"]);?>" />
</div>

<?=$arResult["FORM_FOOTER"]?>
<?
} //endif (isFormNote)
?>