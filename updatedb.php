<?php

$data = file_get_contents('https://user.ipip.net/download.php?token=TOKEN');//注意要替换成自己的下载地址，不同文件格式地址不同。

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
