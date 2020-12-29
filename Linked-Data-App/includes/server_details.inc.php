<?php
function getDetails()
{
    // echo url
    // will remove the need to update this if it's hosted under different url's
    $url = "";
    $port = $_SERVER["SERVER_PORT"];

    // correct http/s in url depending if it's on a ssl port
    $url = $url . $port == "443" ? "https://" : "http://";

    $url = $url . $_SERVER["SERVER_NAME"];

    // If application isn't running on a default http/s port, also echo the port number
    if ($port != "80" && $port != "443") $url = $url . ":" . $port;

    return $url;
}
