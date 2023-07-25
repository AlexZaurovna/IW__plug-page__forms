<?
define("NO_KEEP_STATISTIC", true);
define("NOT_CHECK_PERMISSIONS", true);
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
// use Bitrix\Main\Page\Asset;
if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
// $asset = Asset::getInstance();
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?
    $APPLICATION->ShowHead();
    // $asset->addString("<link href='//fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>");
    // $asset->addString("<link href='//fonts.googleapis.com/css?family=Raleway' rel='stylesheet' type='text/css'>");
    ?>
    <title>Document</title>
</head>
<body id='plug'>
    <?
    $rfSiteID = 's7';
    if (SITE_ID==$rfSiteID) {
    ?>
        <div id="plug__content">
            <div id="plug__logo">
                <img src="/images/plug/logo.png" alt="">
            </div>
            <!-- <div id="plug__auth-form">
                <div class="plug-form__content">
                    <p class="plug-form__title">Вход</p>
                    <p class="plug-form__description">
                        Если у вас нет учетной записи, </br>
                        Вы можете <a href="" class="plug-form__link link__reg-form">зарегистрироваться здесь!</a>
                    </p>
                    <div class="plug-form__plug-fields">
                        <label  class="plug-form__form-field">
                            <div class="form-field__icon">
                                <img src="/images/plug/mdi_user.svg" alt="" class="icon__login">
                            </div>
                            <input type="text" placeholder='Логин' class="form-field__input form-field__login">
                        </label>
                        <label  class="plug-form__form-field">
                            <div class="form-field__icon">
                                <img src="/images/plug/mdi_password.svg" alt="" class="icon__password">
                            </div>
                            <input type="text" placeholder='Пароль' class="form-field__input form-field__password">
                        </label>
                        <div class="plug-form__after-fields">
                            <div class="plug-form__remember-me">
                                <label class="plug-form__switch">
                                    <input type="checkbox" class="switch__box" name="remeber-me" id="remeber-me" checked>
                                    <span class="switch__custom"></span>
                                </label>
                                <p class="switch__title">Запомнить меня</p>
                            </div>
                            <a href="" class="plug-form__link link__forgot-pass">Забыли пароль?</a>
                        </div>
                    </div>
                </div>
                <button class="plug__plug-form__btn">Войти</button>
            </div> -->
            <?$APPLICATION->IncludeComponent(
                "bitrix:system.auth.form", 
                "auth_user", 
                array(
                    "FORGOT_PASSWORD_URL" => "/auth/forgot-password/?forgot_password=yes",
                    "PROFILE_URL" => "/personal/",
                    "REGISTER_URL" => "/test-plug.php",
                    "SHOW_ERRORS" => "N",
                    "COMPONENT_TEMPLATE" => "auth_user"
                ),
                false
            );
            ?>
            <!-- <div id="plug__reg-form">
                <div class="plug-form__content">
                    <p class="plug-form__title">Регистрация</p>
                    <p class="plug-form__description">
                        Зарегистрируйтесь, чтобы получить доступ </br>
                        к индивидуальной цене!
                    </p>
                    <div class="plug-form__plug-fields">
                        <label  class="plug-form__form-field">
                            <div class="form-field__icon">
                                <img src="/images/plug/mdi_user.svg" alt="" class="icon__login">
                            </div>
                            <input type="text" placeholder='Логин' class="form-field__input form-field__login">
                        </label>
                        <label  class="plug-form__form-field">
                            <div class="form-field__icon">
                                <img src="/images/plug/mdi_email.svg" alt="" class="icon__email">
                            </div>
                            <input type="text" placeholder='E-mail' class="form-field__input form-field__email">
                        </label>
                        <label  class="plug-form__form-field">
                            <div class="form-field__icon">
                                <img src="/images/plug/mdi_phone.svg" alt="" class="icon__phone">
                            </div>
                            <input type="text" placeholder='Телефон' class="form-field__input form-field__phone">
                        </label>
                    </div>
                    <div class="reg-form__order-inf">
                        <p class="order-inf__title">Информация о заказе</p>
                        <div class="order-inf__inf-fields">
                            <label  class="plug-form__form-field">
                                <div class="form-field__icon">
                                    <img src="/images/plug/mdi_order.svg" alt="" class="icon__order-num">
                                </div>
                                <input type="text" placeholder='Номер заказа на маркете' class="form-field__input inf-fields__order-num">
                            </label>
                            <div class="inf-fields__markets">
                                <div class="markets__single-market ya-market">
                                    <label class="single-market__box">
                                        <input type="checkbox" class="market__box" name="ya-market" id="ya-market">
                                        <span class="market__box-custom"></span>
                                    </label>
                                    <div class="market__title">Я.Маркет</div>
                                </div>
                                <div class="markets__single-market ozon-market">
                                    <label class="single-market__box">
                                        <input type="checkbox" class="market__box" name="ozon-market" id="ozon-market">
                                        <span class="market__box-custom"></span>
                                    </label>
                                    <div class="market__title">Ozon</div>
                                </div>
                                <div class="markets__single-market ali-market">
                                    <label class="single-market__box">
                                        <input type="checkbox" class="market__box" name="ali-market" id="ali-market">
                                        <span class="market__box-custom"></span>
                                    </label>
                                    <div class="market__title">Aliexpress</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <button class="plug__plug-form__btn">Зарегистрироваться</button>
            </div> -->
            <!-- bitrix version of registetion form -->
            <?
            $APPLICATION->IncludeComponent(
                "bitrix:form",
                "register_user",
                Array(
                    "AJAX_MODE" => "N",
                    "AJAX_OPTION_ADDITIONAL" => "",
                    "AJAX_OPTION_HISTORY" => "N",
                    "AJAX_OPTION_JUMP" => "N",
                    "AJAX_OPTION_STYLE" => "Y",
                    "CACHE_TIME" => "3600",
                    "CACHE_TYPE" => "A",
                    "CHAIN_ITEM_LINK" => "",
                    "CHAIN_ITEM_TEXT" => "",
                    "COMPONENT_TEMPLATE" => "register_user",
                    "EDIT_ADDITIONAL" => "N",
                    "EDIT_STATUS" => "N",
                    "IGNORE_CUSTOM_TEMPLATE" => "N",
                    "NOT_SHOW_FILTER" => array(0=>"",1=>"",),
                    "NOT_SHOW_TABLE" => array(0=>"",1=>"",),
                    "RESULT_ID" => $_REQUEST[RESULT_ID],
                    "SEF_MODE" => "N",
                    "SHOW_ADDITIONAL" => "N",
                    "SHOW_ANSWER_VALUE" => "N",
                    "SHOW_EDIT_PAGE" => "N",
                    "SHOW_LIST_PAGE" => "N",
                    "SHOW_STATUS" => "N",
                    "SHOW_VIEW_PAGE" => "N",
                    "START_PAGE" => "new",
                    "SUCCESS_URL" => "",
                    "USE_EXTENDED_ERRORS" => "N",
                    "VARIABLE_ALIASES" => array("action"=>"action",),
                    "WEB_FORM_ID" => "14"
                )
            );
            ?>
        </div>
    <?}?>
</body>
</html>

<style>
    #plug {
        margin: 0px;
        padding: 0px;
    }
    #plug__logo {
        height: 120px;
        width: 602px;
    }
    #plug__content {
        font-family: Montserrat;
        font-size: 20px;
        font-weight: 400;
        letter-spacing: 0em;
        color: #1F1F1F;
        width: 100vw;
        height: 100vh;
        background-image: url('/images/plug/bg.png');
        background-repeat: no-repeat;
        background-position: center;
        background-size: cover;
        display: flex;
        justify-content: space-evenly;
        align-items: center;
        flex-direction: column;
    }
</style>