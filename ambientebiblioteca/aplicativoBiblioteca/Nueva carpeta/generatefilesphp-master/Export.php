<?php

/**
 * Created by PhpStorm.
 * User: Iparra
 * Date: 9/11/15
 * Time: 20:28
 */
class Export
{
    /**
     * @return array
     */
    public static function data()
    {
        $users = [
            ["id" => 1, "username" => "iparra", "created_at" => date("Y-m-d")],
            ["id" => 2, "username" => "juan", "created_at" => date("Y-m-d")],
            ["id" => 3, "username" => "andrés", "created_at" => date("Y-m-d")],
            ["id" => 4, "username" => "luís", "created_at" => date("Y-m-d")]
        ];
        return $users;
    }

    /**
     * @return string
     * @throws Exception
     */
    public static function toCsv()
    {
        $array = Export::data();

        if (count($array) == 0) {
            throw new Exception("Array cannot be empty");
        }

        // disable caching
        $filename = "data_" . date('d-m-Y') . ".csv";
        $now = gmdate("D, d M Y H:i:s");

        Export::headers($filename, $now);

        ob_start();
        $df = fopen("php://output", 'w');

        fputcsv($df, array_keys(reset($array)));
        foreach ($array as $row) {
            fputcsv($df, $row);
        }
        fclose($df);
        return ob_get_clean();
    }

    /**
     * @return string
     * @throws Exception
     */
    public static function toJson()
    {
        $array = Export::data();

        if (count($array) == 0) {
            throw new Exception("Array cannot be empty");
        }

        // disable caching
        $filename = "data_" . date('d-m-Y') . ".json";
        $now = gmdate("D, d M Y H:i:s");

        Export::headers($filename, $now);

        ob_start();
        $response = array();

        $response["users"] = $array;

        $fp = fopen("php://output", 'w');
        fwrite($fp, json_encode($response));
        fclose($fp);
        return ob_get_clean();
    }

    /**
     * @return string
     * @throws Exception
     */
    public static function toExcel()
    {
        $array = Export::data();

        if (count($array) == 0) {
            throw new Exception("Array cannot be empty");
        }

        $headers = ''; // just creating the var for field headers to append to below
        $data = ''; // just creating the var for field data to append to below

        foreach (array_keys($array[0]) as $columns)
        {
            $headers.=$columns. "\t";
        }

        foreach ($array as $row) {
            $line = '';

            foreach ($row as $key => $value)
            {
                if ((!isset($value)) OR ($value == "")) {
                    $value = "\t";
                } else {
                    $value = str_replace('"', '""', $value);
                    $value = '"' . $value . '"' . "\t";
                }
                $line .= $value;
            }
            $data .= trim($line) . "\n";
        }

        $data = str_replace("\r", "", $data);

        header("Content-type: application/x-msdownload");
        header("Content-Disposition: attachment; filename=data_" . date('d-m-Y') . ".xls");
        return mb_convert_encoding("$headers\n$data", 'utf-16', 'utf-8');
    }

    /**
     * @return mixed
     * @throws Exception
     */
    public static function toXml()
    {
        $array = Export::data();

        if (count($array) == 0) {
            throw new Exception("Array cannot be empty");
        }

        $xml = new SimpleXMLElement('<xml/>');
        $track = $xml->addChild('users');
        foreach ($array as $key => $value)
        {
            $track->addChild('user');
            foreach($value as $k => $v)
            {
                $track->addChild($k, $v);
            }
        }
        header("Content-disposition: attachment; filename=data_" . date('d-m-Y') . ".xml");
        header('Content-type: "text/xml"; charset="utf8"');
        return $xml->asXML();
    }

    /**
     * @param $filename
     * @param $now
     */
    private static function headers($filename, $now)
    {
        header("Expires: Tue, 03 Jul 2001 06:00:00 GMT");
        header("Cache-Control: max-age=0, no-cache, must-revalidate, proxy-revalidate");
        header("Last-Modified: {$now} GMT");

        // force download
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");

        // disposition / encoding on response body
        header("Content-Disposition: attachment;filename={$filename}");
        header("Content-Transfer-Encoding: binary");
    }
}