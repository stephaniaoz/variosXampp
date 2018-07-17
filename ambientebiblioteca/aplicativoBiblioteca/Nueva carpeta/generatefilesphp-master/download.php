<?php
/**
 * Created by PhpStorm.
 * User: Iparra
 * Date: 09/11/2015
 * Time: 20:36
 */
require "Export.php";

if(isset($_GET["type"]) && !empty($_GET["type"]) && in_array($_GET["type"], ["csv", "xml", "excel", "json"]))
{
    switch ($_GET["type"]) {
        case 'csv':
            echo Export::toCsv();
            break;
        case 'excel':
            echo Export::toExcel();
            break;
        case 'json':
            echo Export::toJson();
            break;
        case 'xml':
            echo Export::toXml();
            break;
    }
}