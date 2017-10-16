<?php

$data = file_get_contents('https://user.ipip.net/download.php?token=TOKEN');

$verified = FALSE;
$filename = '';
foreach ($http_response_header AS $line)
{
    if (strpos($line, 'Content-Disposition:') !== FALSE)
    {
        if (preg_match('/Content-Disposition: attachment; filename="([\w|\.]+)"/', $line, $match) > 0)
        {
            $filename = $match[1];
        }
    }
    elseif (strpos($line, 'ETag:') !== FALSE)
    {
        $value = explode('sha1-', $line)[1];

        if ($value == sha1($data))
        {
            $verified = TRUE;
        }
    }
}

if ($verified)
{
    if ($filename == '')
    {
        $filename = 'ipip.dat';
    }
    file_put_contents(__DIR__ . '/' . $filename, $data, LOCK_EX);
}
