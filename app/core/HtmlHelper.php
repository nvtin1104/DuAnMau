<?php
class HtmlHelper
{
    static function formOpen($method = 'get', $action)
    {
        echo '<form method=' . $method . ' action=' . $action . '>';
    }
    static function formClose()
    {
        echo '</form>';
    }
}
?>