<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
 
$arResult['funcGetInputHtml'] = function($question, $arrVALUES) {
    $id = $question['STRUCTURE'][0]['ID'];
    $type = $question['STRUCTURE'][0]['FIELD_TYPE'];
    $name = "form_{$type}_{$id}";
    $value = isset($arrVALUES[$name]) ? htmlentities($arrVALUES[$name]) : '';
    $required = $question['REQUIRED'] === 'Y' ? 'required' : '';
    $class = ' ' . $question['STRUCTURE'][0]['FIELD_PARAM'];
    $title = $question['CAPTION'];
    $marketId = $question['STRUCTURE']['0']['VALUE'];
     
    switch ($type) {         
        case 'text':
            $input = "<input type=\"text\" class=\"form-field__input{$class}\" placeholder='{$title}' name=\"{$name}\" {$required}>";
            break;
        case 'email':
            $input = "<input type=\"text\" class=\"form-field__input{$class}\" placeholder='{$title}' name=\"{$name}\" {$required}>";
            break;
        case 'checkbox':
            $input = "<input type=\"checkbox\" class=\"market__box{$class}\" name=\"{$name}\" id=\"{$marketId}\" {$required}>";
            break;

        default:
            $input = "<input class=\"call__form-input{$class}\" type=\"text\" name=\"{$name}\" value=\"{$value}\" {$required}>";
            break;
    }
    return $input;
};