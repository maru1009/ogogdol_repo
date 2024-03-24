<?php

    function validate_name($data)
    {
        return preg_match("/^[a-zA-Z-' ]*$/",$data);
    }
    function validate_email($data)
    {
        return filter_var($data, FILTER_VALIDATE_EMAIL);
    }
    function check_url($url)
    {
        preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$url);
    }

?>