<?php
// 每周高级版的客户不需要指定type参数
$data = file_get_contents('https://user.ipip.net/download.php?type=datx&token=TOKEN');//注意要替换成自己的下载地址，不同文件格式地址不同。

$verified = FALSE;
$filename = '';
foreach ($http_response_header AS $line)
{
    if (strpos($line, 'Content-Disposition:') !== FALSE)
    {
        if (preg_match('/Content-Disposition: attachment; filename="([\w|\.]+)"/', $line, $match) > 0)
        {
            $filename = $match[1]; //获取默认下载文件名称
        }
    }
    elseif (strpos($line, 'ETag:') !== FALSE)
    {
        $value = explode('sha1-', $line)[1]; // ETag: sha1-b7c2296a2941c6f6a74726ea4dbf88509b91fda8

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
