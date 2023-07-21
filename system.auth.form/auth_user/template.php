<?
if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

Aspro\Next\PhoneAuth::modifyResult($arResult, $arParams);

if($arResult['PHONE_AUTH_PARAMS']['USE']){
	echo CJSCore::Init('phone_auth', true);
} ?>
<?
use Bitrix\Main\Page\Asset;
$asset = Asset::getInstance();
$APPLICATION->ShowHead();
$asset->addString("<link href='//fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>");
$asset->addString("<link href='//fonts.googleapis.com/css?family=Raleway' rel='stylesheet' type='text/css'>");
?>
<div id="ajax_auth">
	<?if($arResult["ERROR"]):?>
		<div class="alert alert-danger"><?=$arResult['ERROR_MESSAGE']['MESSAGE']?></div>
	<?elseif($arResult['SHOW_SMS_FIELD']):?>
		<div class="alert alert-success"><?=GetMessage('main_user_auth_code_sent')?></div>
	<?endif;?>
	<form id="avtorization-form" name="system_auth_form<?=$arResult["RND"]?>" method="post" target="_top" action="<?=$arParams["AUTH_URL"]?>?login=yes">
	<?if($arResult["BACKURL"] <> ''):?>
		<input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>" />
	<?endif;?>
	<?foreach($arResult["POST"] as $key => $value):?>
		<input type="hidden" name="<?=$key?>" value="<?=$value?>" />
	<?endforeach;?>
	<input type="hidden" name="AUTH_FORM" value="Y" />
	<input type="hidden" name="TYPE" value="AUTH" />
	<input type="hidden" name="POPUP_AUTH" value="<?=$arParams['POPUP_AUTH']?>" />
		<div id="plug__auth-form">
			<div class="plug-form__content">
				<p class="plug-form__title">Вход</p>
				<p class="plug-form__description">
					Если у вас нет учетной записи, </br>
					Вы можете <a href="<?=$arResult["AUTH_REGISTER_URL"];?>" class="plug-form__link link__reg-form">зарегистрироваться здесь!</a>
				</p>
				<div class="plug-form__plug-fields">
					<label  class="plug-form__form-field" data-sid="USER_LOGIN_POPUP" for="USER_LOGIN_POPUP">
						<div class="form-field__icon">
							<img src="/images/plug/mdi_user.svg" alt="" class="icon__login">
						</div>
						<input type="text" placeholder='<?=GetMessage("AUTH_LOGIN")?>'
							class="form-field__input form-field__login" name="USER_LOGIN"
							value="<?=$arResult["USER_LOGIN"]?>" autocomplete="on" tabindex="1"/>
					</label>
					<label  class="plug-form__form-field" data-sid="USER_PASSWORD_POPUP" for="USER_PASSWORD_POPUP">
						<div class="form-field__icon">
							<img src="/images/plug/mdi_password.svg" alt="" class="icon__password">
						</div>
						<input type="password" placeholder='<?=GetMessage("AUTH_PASSWORD")?>' name="USER_PASSWORD"
							id="USER_PASSWORD_POPUP" class="form-field__input form-field__password form-control required password"
							value="" autocomplete="on" tabindex="2"/>
					</label>
					<div class="plug-form__after-fields">
						<div class="plug-form__remember-me">
							<label class="plug-form__switch" for="USER_REMEMBER_frm">
								<input type="checkbox" class="switch__box" id="USER_REMEMBER_frm" name="USER_REMEMBER" value="Y" tabindex="5" checked/>
								<span class="switch__custom"></span>
							</label>
							<p class="switch__title"><?=GetMessage("AUTH_REMEMBER_ME")?></p>
						</div>
						<a class="plug-form__link link__forgot-pass" href="<?=$arResult["AUTH_FORGOT_PASSWORD_URL"]?>" tabindex="3">
							<?=GetMessage("AUTH_FORGOT_PASSWORD_2")?>
						</a>
					</div>
				</div>
			</div>
			<!-- <input type="submit" class="plug__plug-form__btn" name="Login" value="<?=GetMessage("AUTH_LOGIN_BUTTON")?>" tabindex="4"/> -->
			<div class="buttons clearfix">
				<input type="submit" class="btn btn-default bold" name="Login" value="<?=GetMessage("AUTH_LOGIN_BUTTON")?>" tabindex="4" />
			</div>
		</div>
	</form>
</div>

<script>
function initValidate($form){
	if($form.length){
		$form.validate({
			rules: {
				USER_LOGIN: {
					required: true
				}
			},
			submitHandler: function(form){
				if($(form).valid()){
					/*var eventdata = {type: 'form_submit', form: form, form_name: 'AUTH'};
					BX.onCustomEvent('onSubmitForm', [eventdata]);*/

					jsAjaxUtil.CloseLocalWaitWindow('id', 'wrap_ajax_auth');
					jsAjaxUtil.ShowLocalWaitWindow('id', 'wrap_ajax_auth', true);

					var bCaptchaInvisible = false;
					if(window.renderRecaptchaById && window.asproRecaptcha && window.asproRecaptcha.key)
					{
						if(window.asproRecaptcha.params.recaptchaSize == 'invisible' && typeof grecaptcha != 'undefined')
						{
							if(!$(form).find('.g-recaptcha-response').val())
							{
								bCaptchaInvisible = true;
								grecaptcha.execute($(form).find('.g-recaptcha').data('widgetid'));
							}
						}
					}

					if(!bCaptchaInvisible)
					{
						var $button = $(form).find('input[type=submit]');
						if($button.length){
							if(!$button.hasClass('loadings')){
								$button.addClass('loadings');

								$.ajax({
									type: "POST",
									url: $(form).attr('action'),
									data: $(form).serializeArray()
								}).done(function(html){
									if($(html).find('.alert').length){
										$('#ajax_auth').parent().html(html);
									}
									else{
										BX.reload(false);
									}

									jsAjaxUtil.CloseLocalWaitWindow('id', 'wrap_ajax_auth');
								});
							}
						}
					}
				}
			},
			errorPlacement: function(error, element){
				$(error).attr('alt', $(error).text());
				$(error).attr('title', $(error).text());
				error.insertBefore(element);
			}
		});

		if(arNextOptions['THEME']['PHONE_MASK'].length){
			var base_mask = arNextOptions['THEME']['PHONE_MASK'].replace( /(\d)/g, '_' );
			$form.find('input.phone').inputmask('mask', {'mask': arNextOptions['THEME']['PHONE_MASK'] });
			$form.find('input.phone').blur(function(){
				if($(this).val() == base_mask || $(this).val() == ''){
					if($(this).hasClass('required')){
						$(this).parent().find('label.error').html(BX.message('JS_REQUIRED'));
					}
				}
			});
		}
	}
}

$(document).ready(function(){
	$('form[name=bx_auth_servicesform]').validate();
	$('.auth_wrapp .form-body a').removeAttr('onclick');

	if($('#ajax_auth .nav-tabs>li').length){
		$('#ajax_auth .nav-tabs>li').click(function(){
			var id = $(this).find('>a').attr('href');
			if(id.length){
				var $tabContent = $(id);
				if($tabContent.length){
					var $form = $tabContent.find('form')
					if($form.length){
						if(!$(this).hasClass('inited')){
							$(this).addClass('inited');
							initValidate($form);
						}

						setTimeout(function(){
							$form.find('input:visible').eq(0).focus();
						}, 50);
					}
				}
			}
		});

		$('#ajax_auth .nav-tabs>li.active').trigger('click');
	}
	else{
		initValidate($('#avtorization-form'));

		setTimeout(function(){
			$('#avtorization-form').find('input:visible').eq(0).focus();
		}, 50);
	}
});
</script>