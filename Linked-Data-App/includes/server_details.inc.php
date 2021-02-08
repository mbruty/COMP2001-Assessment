<?php
function getDetails()
{
    // echo url
    $url = "";
    $port = $_SERVER["SERVER_PORT"];

    // correct http/s in url depending if it's on a ssl port
    $url = $url . $port == "443" ? "https://" : "http://";

    // Change this when deploying to different locations
    $url = $url . "web.socem.plymouth.ac.uk/COMP2001/mbruty/";

    return $url;
}
