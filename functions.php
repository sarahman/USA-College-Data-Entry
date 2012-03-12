<?php

function getFormError($variable = array(), $index)
{
    $errorMsg = getVariableValue($variable, $index);
    return "<span class='error'>{$errorMsg}</span>";
}

function getVariableValue($variable = array(), $index)
{
    return empty($variable[$index]) ? '' : $variable[$index];
}

function getErrorMessage($variable = array(), $index)
{
    $errorMsg = getVariableValue($variable, $index);
    return "<span class='errorMsg'>{$errorMsg}</span>";
}