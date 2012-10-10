<?php

function getNotificationMessage(array $messageDetail)
{
    return <<<EOT
    <div class='message-block'>
        <p class="{$messageDetail['type']}">{$messageDetail['msg']}</p>
    </div>
EOT;
}

function getSuccessMessageData($msg)
{
    return array(
        'type' => 'success',
        'msg' => $msg
    );
}

function getFailureMessageData($msg)
{
    return array(
        'type' => 'failure',
        'msg' => $msg
    );
}

function getFormError($variable = array(), $index)
{
    $errorMsg = getVariableValue($variable, $index);
    return "<span class='error'>{$errorMsg}</span>";
}

function getErrorMessage($variable = array(), $index)
{
    $errorMsg = getVariableValue($variable, $index);
    return "<span class='errorMsg'>{$errorMsg}</span>";
}

function getVariableValue($variable = array(), $index)
{
    return empty($variable[$index]) ? '' : $variable[$index];
}