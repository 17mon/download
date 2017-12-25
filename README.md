# download

示例代码，对header头响应的ETag字段做验证，确保文件完整。

响应头示例：

HTTP/1.1 200 OK
Server: NewDefend
Date: Mon, 25 Dec 2017 09:21:13 GMT
Content-Type: application/octet-stream
Content-Length: 35933577
Connection: keep-alive
Content-Disposition: attachment; filename="mydata4vipday2.datx"
ETag: sha1-5e14374162ae476b8c4cd267c7a834f322356322
Last-Modified: Mon, 25 Dec 2017 09:21:13 GMT
X-Cache: BYPASS from ctl-ha-036-099-018-136
Accept-Ranges: bytes
