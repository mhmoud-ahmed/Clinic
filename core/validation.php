<?php
function notRequired($input): bool
{
    if (!empty($input)) {
        return true;
    }
    return false;
}
function pregInput($pattern, $input)
{
    if (preg_match($pattern, $input)) {
        return true;
    }
    return false;
}
function filterInputs($input)
{
    return trim(htmlentities(htmlspecialchars($input)));
}
function fliterEmail($email)
{
    if (trim(filter_var($email, FILTER_SANITIZE_EMAIL))) {
        return $email;
    }
}
