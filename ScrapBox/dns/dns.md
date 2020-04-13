dnsの設定していてdigの情報が面白かったのでメモ

- 普段の様子

```txt
$ dig testdomain

; <<>> DiG 9.10.6 <<>> testdomain
;; global options: +cmd
;; Got answer:
;; ->>HEADER<<- opcode: QUERY, status: NOERROR, id: 54069
;; flags: qr rd ra; QUERY: 1, ANSWER: 1, AUTHORITY: 2, ADDITIONAL: 3

;; OPT PSEUDOSECTION:
; EDNS: version: 0, flags:; udp: 4096
;; QUESTION SECTION:
;testdomain.			IN	A

;; ANSWER SECTION:
testdomain.		3600	IN	A	AAA.AAA.AAA.AA

;; AUTHORITY SECTION:
testdomain.		3600	IN	NS	dns01.example.com.
testdomain.		3600	IN	NS	dns02.example.com.

;; ADDITIONAL SECTION:
dns01.example.com. 544	IN	A	XXX.XXX.XXX.XX
dns02.example.com. 3472	IN	A	YYY.YYY.YYY.YY

;; Query time: 221 msec
;; SERVER: XXXXXX:c8ff:fe65:3bd0#53(XXXXXX:c8ff:fe65:3bd0)
;; WHEN: Fri Apr 10 22:59:58 JST 2020
;; MSG S
```

- キャッシュがきいてる？

```txt
$ dig testdomain

; <<>> DiG 9.10.6 <<>> testdomain
;; global options: +cmd
;; Got answer:
;; ->>HEADER<<- opcode: QUERY, status: NOERROR, id: 41325
;; flags: qr rd ra ad; QUERY: 1, ANSWER: 1, AUTHORITY: 0, ADDITIONAL: 0

;; QUESTION SECTION:
;testdomain.			IN	A

;; ANSWER SECTION:
testdomain.		3436	IN	A	AAA.AAA.AAA.AA

;; Query time: 1 msec
;; SERVER: XXXXXX:c8ff:fe65:3bd0#53(XXXXXX:c8ff:fe65:3bd0)
;; WHEN: Fri Apr 10 23:18:08 JST 2020
;; MSG SIZE  rcvd: 46
```

- 設定前のサブドメイン

```txt

$ dig test.testdomain
;; Warning: Message parser reports malformed message packet.

; <<>> DiG 9.10.6 <<>> test.testdomain
;; global options: +cmd
;; Got answer:
;; ->>HEADER<<- opcode: QUERY, status: NXDOMAIN, id: 28599
;; flags: qr rd ra ad; QUERY: 1, ANSWER: 1, AUTHORITY: 0, ADDITIONAL: 0
;; WARNING: Message has 65 extra bytes at end

;; QUESTION SECTION:
;test.testdomain.		IN	A

;; Query time: 1 msec
;; SERVER: XXXXXX:c8ff:fe65:3bd0#53(XXXXXX:c8ff:fe65:3bd0)
;; WHEN: Fri Apr 10 22:55:13 JST 2020
;; MSG SIZE  rcvd: 112
```

- 設定直後

```txt
$ dig test.testdomain

; <<>> DiG 9.10.6 <<>> test.testdomain
;; global options: +cmd
;; Got answer:
;; ->>HEADER<<- opcode: QUERY, status: NXDOMAIN, id: 44720
;; flags: qr rd ra; QUERY: 1, ANSWER: 0, AUTHORITY: 1, ADDITIONAL: 1

;; OPT PSEUDOSECTION:
; EDNS: version: 0, flags:; udp: 4096
;; QUESTION SECTION:
;test.testdomain.		IN	A

;; AUTHORITY SECTION:
testdomain.		33	IN	SOA	dns01.example.com. postmaster.testdomain. 1581662901 3600 1800 604800 3600

;; Query time: 83 msec
;; SERVER: XXXXXX:c8ff:fe65:3bd0#53(XXXXXX:c8ff:fe65:3bd0)
;; WHEN: Fri Apr 10 23:04:13 JST 2020
;; MSG SIZE  rcvd: 116
```

- 一定時間後（キャッシュきいてる？）
  - この後さらに時間が経つとNSレコードも表示された

```txt
$ dig test.testdomain
;; Warning: Message parser reports malformed message packet.

; <<>> DiG 9.10.6 <<>> test.testdomain
;; global options: +cmd
;; Got answer:
;; ->>HEADER<<- opcode: QUERY, status: NXDOMAIN, id: 33148
;; flags: qr rd ra ad; QUERY: 1, ANSWER: 1, AUTHORITY: 0, ADDITIONAL: 0
;; WARNING: Message has 65 extra bytes at end

;; QUESTION SECTION:
;test.testdomain.		IN	A

;; Query time: 1 msec
;; SERVER: XXXXXX:c8ff:fe65:3bd0#53(XXXXXX:c8ff:fe65:3bd0)
;; WHEN: Fri Apr 10 23:17:04 JST 2020
;; MSG SIZE  rcvd: 112
```

- メール設定前

```txt
$ dig info@testdomain

; <<>> DiG 9.10.6 <<>> info@testdomain
;; global options: +cmd
;; Got answer:
;; ->>HEADER<<- opcode: QUERY, status: NXDOMAIN, id: 61389
;; flags: qr rd ra; QUERY: 1, ANSWER: 0, AUTHORITY: 1, ADDITIONAL: 1

;; OPT PSEUDOSECTION:
; EDNS: version: 0, flags:; udp: 4096
;; QUESTION SECTION:
;info\@testdomain.		IN	A

;; AUTHORITY SECTION:
info.testdomain.			600	IN	SOA	dns1.nic.work. hostmaster.nominet.org.uk. 2100908821 900 300 2419200 3600

;; Query time: 130 msec
;; SERVER: XXXXXX:c8ff:fe65:3bd0#53(XXXXXX:c8ff:fe65:3bd0)
;; WHEN: Fri Apr 10 23:15:35 JST 2020
;; MSG SIZE  rcvd: 116
```

- 一定時間後

```txt
$ dig info@testdomain
;; Warning: Message parser reports malformed message packet.

; <<>> DiG 9.10.6 <<>> info@testdomain
;; global options: +cmd
;; Got answer:
;; ->>HEADER<<- opcode: QUERY, status: NXDOMAIN, id: 35824
;; flags: qr rd ra ad; QUERY: 1, ANSWER: 1, AUTHORITY: 0, ADDITIONAL: 0
;; WARNING: Message has 65 extra bytes at end

;; QUESTION SECTION:
;info\@testdomain.		IN	A

;; Query time: 2 msec
;; SERVER: XXXXXX:c8ff:fe65:3bd0#53(XXXXXX:c8ff:fe65:3bd0)
;; WHEN: Fri Apr 10 23:29:18 JST 2020
;; MSG SIZE  rcvd: 112
```

- mxレコードはコマンドが違った

```txt
dig testdomain mx

; <<>> DiG 9.10.6 <<>> testdomain mx
;; global options: +cmd
;; Got answer:
;; ->>HEADER<<- opcode: QUERY, status: NOERROR, id: 19906
;; flags: qr rd ra; QUERY: 1, ANSWER: 1, AUTHORITY: 2, ADDITIONAL: 3

;; OPT PSEUDOSECTION:
; EDNS: version: 0, flags:; udp: 4096
;; QUESTION SECTION:
;testdomain.			IN	MX

;; ANSWER SECTION:
testdomain.		3600	IN	MX	50 mx01.example.com.

;; AUTHORITY SECTION:
testdomain.		3600	IN	NS	dns01.example.com.
testdomain.		3600	IN	NS	dns02.example.com.

;; ADDITIONAL SECTION:
dns02.example.com. 3017	IN	A	XXX.XXX.XX.XX
dns01.example.com. 1139	IN	A	YYY.YYY.YY.YY

;; Query time: 419 msec
;; SERVER: XXXXXXXX:fe65:3bd0#53(XXXXXXXX:fe65:3bd0#53)
;; WHEN: Sat Apr 11 00:08:21 JST 2020
;; MSG SIZE  rcvd: 161

```