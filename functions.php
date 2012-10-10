<?php

function getNotificationMessage(array $messageDetail)
{
    if (empty($messageDetail)) {
        return '';
    }

    return <<<EOT
    <div class='message-block'>
        <p class="{$messageDetail['type']}">{$messageDetail['msg']}</p>
    </div>
EOT;
}

function getSuccessMessageData($msg)
{
    if (empty($msg)) {
        return '';
    }

    return array(
        'type' => 'success',
        'msg' => $msg
    );
}

function getFailureMessageData($msg)
{
    if (empty($msg)) {
        return '';
    }

    return array(
        'type' => 'failure',
        'msg' => $msg
    );
}

function getFormErrorMessage($variable = array(), $index)
{
    $errorMsg = getVariableValue($variable, $index);
    return empty($errorMsg) ? '' : "<span class='error'>{$errorMsg}</span>";
}

function getFieldErrorMessage($variable = array(), $index)
{
    $errorMsg = getVariableValue($variable, $index);
    return empty($errorMsg) ? '' : "<span class='errorMsg'>{$errorMsg}</span>";
}

function getVariableValue($variable = array(), $index)
{
    return empty($variable[$index]) ? '' : $variable[$index];
}