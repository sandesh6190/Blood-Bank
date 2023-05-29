<?php
session_start();

$u_success_message = $_SESSION['success_messagex'] ?? null;
$u_error_message = $_SESSION['error_messagex'] ?? null;
unset($_SESSION['success_messagex']);
unset($_SESSION['error_messagex']);

function addSuccessMessage($message)
{
    $_SESSION['success_messagex'] = $message;
}
function addErrorMessage($message)
{
    $_SESSION['error_messagex'] = $message;
}
function renderMessages()
{
    global $u_success_message;
    global $u_error_message;
    $u_success_message != null && renderMessage($u_success_message, 'success');
    $u_error_message != null && renderMessage($u_error_message, 'error');
}
function renderMessage($message, $type)
{
    if ($type == 'success'):
        ?>
        <div class="alert alert-success" role="alert">
            🎉
            <?= $message ?>
        </div>
        <?php
    else:
        ?>
        <div class="alert alert-danger" role="alert">
            💀
            <?= $message ?>
        </div>
        <?php
    endif;
}
function isPost()
{
    return $_SERVER['REQUEST_METHOD'] === 'POST';
}

function getParam($name, $defaultValue = null)
{
    $value = $_GET[$name] ?? null;
    if ($value === "") {
        $value = null;
    }
    return $value ?? $defaultValue;
}

function dd($value)
{
    var_dump($value);
    die;
}

?>