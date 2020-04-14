# フルリゾルバーになったつもりで名前解決をしていく

## Aレコードの問い合わせ

### フルリゾルバーになってwww.jprs.co.jpの名前解決を実行していく

- まずはルートから

```txt
$ dig +norec @198.41.0.4 www.jprs.co.jp

; <<>> DiG 9.10.6 <<>> +norec @198.41.0.4 www.jprs.co.jp
; (1 server found)
;; global options: +cmd
;; Got answer:
;; ->>HEADER<<- opcode: QUERY, status: NOERROR, id: 53208
;; flags: qr; QUERY: 1, ANSWER: 0, AUTHORITY: 8, ADDITIONAL: 16

;; OPT PSEUDOSECTION:
; EDNS: version: 0, flags:; udp: 4096
;; QUESTION SECTION:
;www.jprs.co.jp.			IN	A

;; AUTHORITY SECTION:
jp.			172800	IN	NS	a.dns.jp.
jp.			172800	IN	NS	d.dns.jp.
jp.			172800	IN	NS	e.dns.jp.
jp.			172800	IN	NS	f.dns.jp.
jp.			172800	IN	NS	h.dns.jp.
jp.			172800	IN	NS	g.dns.jp.
jp.			172800	IN	NS	c.dns.jp.
jp.			172800	IN	NS	b.dns.jp.

;; ADDITIONAL SECTION:
a.dns.jp.		172800	IN	A	203.119.1.1
a.dns.jp.		172800	IN	AAAA	2001:dc4::1
d.dns.jp.		172800	IN	A	210.138.175.244
d.dns.jp.		172800	IN	AAAA	2001:240::53
e.dns.jp.		172800	IN	A	192.50.43.53
e.dns.jp.		172800	IN	AAAA	2001:200:c000::35
f.dns.jp.		172800	IN	A	150.100.6.8
f.dns.jp.		172800	IN	AAAA	2001:2f8:0:100::153
h.dns.jp.		172800	IN	A	65.22.40.25
h.dns.jp.		172800	IN	AAAA	2a01:8840:1ba::25
g.dns.jp.		172800	IN	A	203.119.40.1
c.dns.jp.		172800	IN	A	156.154.100.5
c.dns.jp.		172800	IN	AAAA	2001:502:ad09::5
b.dns.jp.		172800	IN	A	202.12.30.131
b.dns.jp.		172800	IN	AAAA	2001:dc2::1

;; Query time: 18 msec
;; SERVER: 198.41.0.4#53(198.41.0.4)
;; WHEN: Mon Apr 13 23:37:26 JST 2020
;; MSG SIZE  rcvd: 499

$ 
```

- 通常応答である  status: NOERROR
- Answerセクションがない ANSWER: 0
- 権威を持つ応答ではなく、委任先が示されている（flagsにaaがない）
- Authorityセクションにjpへの委任がある
- 委任先がa〜h.dns.jp.である
- additionalセクションにa〜h.dns.jp.の情報がある

### jpの権威サーバーに問い合わせ

```txt
PMAC747S:mochiko$ dig +norec @2001:200:c000::35 www.jprs.co.jp

; <<>> DiG 9.10.6 <<>> +norec @2001:200:c000::35 www.jprs.co.jp
; (1 server found)
;; global options: +cmd
;; Got answer:
;; ->>HEADER<<- opcode: QUERY, status: NOERROR, id: 33364
;; flags: qr; QUERY: 1, ANSWER: 0, AUTHORITY: 4, ADDITIONAL: 9

;; OPT PSEUDOSECTION:
; EDNS: version: 0, flags:; udp: 4096
;; QUESTION SECTION:
;www.jprs.co.jp.			IN	A

;; AUTHORITY SECTION:
jprs.co.jp.		86400	IN	NS	ns2.jprs.co.jp.
jprs.co.jp.		86400	IN	NS	ns3.jprs.co.jp.
jprs.co.jp.		86400	IN	NS	ns4.jprs.co.jp.
jprs.co.jp.		86400	IN	NS	ns1.jprs.co.jp.

;; ADDITIONAL SECTION:
ns1.jprs.co.jp.		86400	IN	A	202.11.16.49
ns2.jprs.co.jp.		86400	IN	A	202.11.16.59
ns3.jprs.co.jp.		86400	IN	A	203.105.65.178
ns4.jprs.co.jp.		86400	IN	A	203.105.65.181
ns1.jprs.co.jp.		86400	IN	AAAA	2001:df0:8::a153
ns2.jprs.co.jp.		86400	IN	AAAA	2001:df0:8::a253
ns3.jprs.co.jp.		86400	IN	AAAA	2001:218:3001::a153
ns4.jprs.co.jp.		86400	IN	AAAA	2001:218:3001::a253

;; Query time: 28 msec
;; SERVER: 2001:200:c000::35#53(2001:200:c000::35)
;; WHEN: Mon Apr 13 23:46:09 JST 2020
;; MSG SIZE  rcvd: 291

PMAC747S:mochiko$ 

```

- 通常応答である  status: NOERROR
- Answerセクションがない ANSWER: 0
- 権威を持つ応答ではなく、委任先が示されている（flagsにaaがない）
- Authorityセクションにjprs.co.jp.への委任がある
- 委任先がns1〜4.jprs.co.jp.である
- additionalセクションにns1〜4.jprs.co.jp.の情報がある

### jprs.co.jpの権威サーバーへ問い合わせ

```txt
PMAC747S:~ mochiko$ dig +norec @2001:df0:8::a153 www.jprs.co.jp

; <<>> DiG 9.10.6 <<>> +norec @2001:df0:8::a153 www.jprs.co.jp
; (1 server found)
;; global options: +cmd
;; Got answer:
;; ->>HEADER<<- opcode: QUERY, status: NOERROR, id: 46201
;; flags: qr aa; QUERY: 1, ANSWER: 1, AUTHORITY: 4, ADDITIONAL: 9

;; OPT PSEUDOSECTION:
; EDNS: version: 0, flags:; udp: 4096
;; QUESTION SECTION:
;www.jprs.co.jp.			IN	A

;; ANSWER SECTION:
www.jprs.co.jp.		300	IN	A	117.104.133.165

;; AUTHORITY SECTION:
jprs.co.jp.		86400	IN	NS	ns2.jprs.co.jp.
jprs.co.jp.		86400	IN	NS	ns3.jprs.co.jp.
jprs.co.jp.		86400	IN	NS	ns4.jprs.co.jp.
jprs.co.jp.		86400	IN	NS	ns1.jprs.co.jp.

;; ADDITIONAL SECTION:
ns1.jprs.co.jp.		86400	IN	AAAA	2001:df0:8::a153
ns2.jprs.co.jp.		86400	IN	AAAA	2001:df0:8::a253
ns3.jprs.co.jp.		86400	IN	AAAA	2001:218:3001::a153
ns4.jprs.co.jp.		86400	IN	AAAA	2001:218:3001::a253
ns1.jprs.co.jp.		86400	IN	A	202.11.16.49
ns2.jprs.co.jp.		86400	IN	A	202.11.16.59
ns3.jprs.co.jp.		86400	IN	A	203.105.65.178
ns4.jprs.co.jp.		86400	IN	A	203.105.65.181

;; Query time: 21 msec
;; SERVER: 2001:df0:8::a153#53(2001:df0:8::a153)
;; WHEN: Tue Apr 14 00:02:44 JST 2020
;; MSG SIZE  rcvd: 307

PMAC747S:~ mochiko$ 

```

- 通常応答である  status: NOERROR
- Answerセクションがある ANSWER: 1
- 権威を持つ応答が返ってきている（flagsにaaがある）
- Answerセクションにwww.jprs.co.jpのAレコードがある

これで名前解決か完了した
`;; ANSWER SECTION:` の情報 `www.jprs.co.jp.		300	IN	A	117.104.133.165` が求めていた答えになる

# フルリゾルバーになったつもりで名前解決をしていく２

## www.ietf.orgの名前解決

### まずルートサーバーにアクセス

```txt
PMAC747S:~ mochiko$ dig +norec @198.41.0.4 www.ietf.org

; <<>> DiG 9.10.6 <<>> +norec @198.41.0.4 www.ietf.org
; (1 server found)
;; global options: +cmd
;; Got answer:
;; ->>HEADER<<- opcode: QUERY, status: NOERROR, id: 12340
;; flags: qr; QUERY: 1, ANSWER: 0, AUTHORITY: 6, ADDITIONAL: 13

;; OPT PSEUDOSECTION:
; EDNS: version: 0, flags:; udp: 1472
;; QUESTION SECTION:
;www.ietf.org.			IN	A

;; AUTHORITY SECTION:
org.			172800	IN	NS	a0.org.afilias-nst.info.
org.			172800	IN	NS	a2.org.afilias-nst.info.
org.			172800	IN	NS	b0.org.afilias-nst.org.
org.			172800	IN	NS	b2.org.afilias-nst.org.
org.			172800	IN	NS	c0.org.afilias-nst.info.
org.			172800	IN	NS	d0.org.afilias-nst.org.

;; ADDITIONAL SECTION:
a0.org.afilias-nst.info. 172800	IN	A	199.19.56.1
a2.org.afilias-nst.info. 172800	IN	A	199.249.112.1
b0.org.afilias-nst.org.	172800	IN	A	199.19.54.1
b2.org.afilias-nst.org.	172800	IN	A	199.249.120.1
c0.org.afilias-nst.info. 172800	IN	A	199.19.53.1
d0.org.afilias-nst.org.	172800	IN	A	199.19.57.1
a0.org.afilias-nst.info. 172800	IN	AAAA	2001:500:e::1
a2.org.afilias-nst.info. 172800	IN	AAAA	2001:500:40::1
b0.org.afilias-nst.org.	172800	IN	AAAA	2001:500:c::1
b2.org.afilias-nst.org.	172800	IN	AAAA	2001:500:48::1
c0.org.afilias-nst.info. 172800	IN	AAAA	2001:500:b::1
d0.org.afilias-nst.org.	172800	IN	AAAA	2001:500:f::1

;; Query time: 18 msec
;; SERVER: 198.41.0.4#53(198.41.0.4)
;; WHEN: Tue Apr 14 21:56:15 JST 2020
;; MSG SIZE  rcvd: 443

PMAC747S:~ mochiko$ 

```

- 通常応答である  status: NOERROR
- Answerセクションがない ANSWER: 0
- 権威を持つ応答ではなく、委任先が示されている（flagsにaaがない）
- Authorityセクションにorgへの委任がある
- 委任先がa~d0.org.afilias-nst.info.などである
- additionalセクションにa0.org.afilias-nst.info.などのIP情報がある

### 続けてadditionalセクションの情報を元にorgの委任サーバーへ問い合わせ

```txt
PMAC747S:~ mochiko$ dig +norec @2001:500:e::1 www.ietf.org AAAA

; <<>> DiG 9.10.6 <<>> +norec @2001:500:e::1 www.ietf.org AAAA
; (1 server found)
;; global options: +cmd
;; Got answer:
;; ->>HEADER<<- opcode: QUERY, status: NOERROR, id: 28060
;; flags: qr; QUERY: 1, ANSWER: 0, AUTHORITY: 6, ADDITIONAL: 1

;; OPT PSEUDOSECTION:
; EDNS: version: 0, flags:; udp: 4096
;; QUESTION SECTION:
;www.ietf.org.			IN	AAAA

;; AUTHORITY SECTION:
ietf.org.		86400	IN	NS	ns1.yyz1.afilias-nst.info.
ietf.org.		86400	IN	NS	ns1.ams1.afilias-nst.info.
ietf.org.		86400	IN	NS	ns1.sea1.afilias-nst.info.
ietf.org.		86400	IN	NS	ns0.amsl.com.
ietf.org.		86400	IN	NS	ns1.hkg1.afilias-nst.info.
ietf.org.		86400	IN	NS	ns1.mia1.afilias-nst.info.

;; Query time: 155 msec
;; SERVER: 2001:500:e::1#53(2001:500:e::1)
;; WHEN: Tue Apr 14 22:02:55 JST 2020
;; MSG SIZE  rcvd: 198

PMAC747S:~ mochiko$ 
```

- 通常応答である  status: NOERROR
- Answerセクションがない ANSWER: 0
- 権威を持つ応答ではなく、委任先が示されている（flagsにaaがない）
- Authorityセクションにieftorgへの委任がある
- 委任先がns1.yyz1.afilias-nst.info.などである
- 委任先が外部なので Additionalセクションの情報がない
  - 次に問い合わせるためのIPアドレスがないので別の方法が必要
    - 外部のNSサーバーの名前解決を先に行う

## 外部のNSサーバー `ns1.yyz1.afilias-nst.info.` の名前解決を行う

### ルートサーバーに `ns1.yyz1.afilias-nst.info.` の情報を問い合わせ

```txt
PMAC747S:~ mochiko$ dig +norec @198.41.0.4 ns1.yyz1.afilias-nst.info A

; <<>> DiG 9.10.6 <<>> +norec @198.41.0.4 ns1.yyz1.afilias-nst.info A
; (1 server found)
;; global options: +cmd
;; Got answer:
;; ->>HEADER<<- opcode: QUERY, status: NOERROR, id: 21498
;; flags: qr; QUERY: 1, ANSWER: 0, AUTHORITY: 6, ADDITIONAL: 13

;; OPT PSEUDOSECTION:
; EDNS: version: 0, flags:; udp: 4096
;; QUESTION SECTION:
;ns1.yyz1.afilias-nst.info.	IN	A

;; AUTHORITY SECTION:
info.			172800	IN	NS	a2.info.afilias-nst.info.
info.			172800	IN	NS	b0.info.afilias-nst.org.
info.			172800	IN	NS	d0.info.afilias-nst.org.
info.			172800	IN	NS	c0.info.afilias-nst.info.
info.			172800	IN	NS	b2.info.afilias-nst.org.
info.			172800	IN	NS	a0.info.afilias-nst.info.

;; ADDITIONAL SECTION:
a2.info.afilias-nst.info. 172800 IN	A	199.249.113.1
a2.info.afilias-nst.info. 172800 IN	AAAA	2001:500:41::1
b0.info.afilias-nst.org. 172800	IN	A	199.254.48.1
b0.info.afilias-nst.org. 172800	IN	AAAA	2001:500:1a::1
d0.info.afilias-nst.org. 172800	IN	A	199.254.50.1
d0.info.afilias-nst.org. 172800	IN	AAAA	2001:500:1c::1
c0.info.afilias-nst.info. 172800 IN	A	199.254.49.1
c0.info.afilias-nst.info. 172800 IN	AAAA	2001:500:1b::1
b2.info.afilias-nst.org. 172800	IN	A	199.249.121.1
b2.info.afilias-nst.org. 172800	IN	AAAA	2001:500:49::1
a0.info.afilias-nst.info. 172800 IN	A	199.254.31.1
a0.info.afilias-nst.info. 172800 IN	AAAA	2001:500:19::1

;; Query time: 118 msec
;; SERVER: 198.41.0.4#53(198.41.0.4)
;; WHEN: Tue Apr 14 22:09:32 JST 2020
;; MSG SIZE  rcvd: 445

PMAC747S:~ mochiko$ 
```

- 通常応答である  status: NOERROR
- Answerセクションがない ANSWER: 0
- 権威を持つ応答ではなく、委任先が示されている（flagsにaaがない）
- Authorityセクションにinfo.への委任がある
- 委任先がa2.info.afilias-nst.info.などである
- additionalセクションにa2.info.afilias-nst.info.などのIP情報がある

### 続けてadditionalセクションの情報を元にinfoの委任サーバーへ問い合わせ

```txt
PMAC747S:~ mochiko$ dig +norec @199.249.113.1 ns1.yyz1.afilias-nst.info A

; <<>> DiG 9.10.6 <<>> +norec @199.249.113.1 ns1.yyz1.afilias-nst.info A
; (1 server found)
;; global options: +cmd
;; Got answer:
;; ->>HEADER<<- opcode: QUERY, status: NOERROR, id: 58841
;; flags: qr; QUERY: 1, ANSWER: 0, AUTHORITY: 4, ADDITIONAL: 9

;; OPT PSEUDOSECTION:
; EDNS: version: 0, flags:; udp: 4096
;; QUESTION SECTION:
;ns1.yyz1.afilias-nst.info.	IN	A

;; AUTHORITY SECTION:
afilias-nst.info.	86400	IN	NS	a0.dig.afilias-nst.info.
afilias-nst.info.	86400	IN	NS	b0.dig.afilias-nst.info.
afilias-nst.info.	86400	IN	NS	c0.dig.afilias-nst.info.
afilias-nst.info.	86400	IN	NS	d0.dig.afilias-nst.info.

;; ADDITIONAL SECTION:
a0.dig.afilias-nst.info. 86400	IN	A	65.22.6.1
b0.dig.afilias-nst.info. 86400	IN	A	65.22.7.1
c0.dig.afilias-nst.info. 86400	IN	A	65.22.8.1
d0.dig.afilias-nst.info. 86400	IN	A	65.22.9.1
a0.dig.afilias-nst.info. 86400	IN	AAAA	2a01:8840:6::1
b0.dig.afilias-nst.info. 86400	IN	AAAA	2a01:8840:7::1
c0.dig.afilias-nst.info. 86400	IN	AAAA	2a01:8840:8::1
d0.dig.afilias-nst.info. 86400	IN	AAAA	2a01:8840:9::1

;; Query time: 17 msec
;; SERVER: 199.249.113.1#53(199.249.113.1)
;; WHEN: Tue Apr 14 22:13:12 JST 2020
;; MSG SIZE  rcvd: 302

PMAC747S:~ mochiko$ 
```

- 通常応答である  status: NOERROR
- Answerセクションがない ANSWER: 0
- 権威を持つ応答ではなく、委任先が示されている（flagsにaaがない）
- Authorityセクションにafilias-nst.info.への委任がある
- 委任先がa0.dig.afilias-nst.info.などである
- additionalセクションにa0.dig.afilias-nst.info.などのIP情報がある

### 続けてadditionalセクションの情報を元にafilias-nst.info.の委任サーバーへ問い合わせ

```txt
PMAC747S:~ mochiko$ dig +norec @65.22.6.1 ns1.yyz1.afilias-nst.info A

; <<>> DiG 9.10.6 <<>> +norec @65.22.6.1 ns1.yyz1.afilias-nst.info A
; (1 server found)
;; global options: +cmd
;; Got answer:
;; ->>HEADER<<- opcode: QUERY, status: NOERROR, id: 20561
;; flags: qr aa; QUERY: 1, ANSWER: 1, AUTHORITY: 4, ADDITIONAL: 9

;; OPT PSEUDOSECTION:
; EDNS: version: 0, flags:; udp: 4096
;; QUESTION SECTION:
;ns1.yyz1.afilias-nst.info.	IN	A

;; ANSWER SECTION:
ns1.yyz1.afilias-nst.info. 3600	IN	A	65.22.9.1

;; AUTHORITY SECTION:
yyz1.afilias-nst.info.	3600	IN	NS	a0.dig.afilias-nst.info.
yyz1.afilias-nst.info.	3600	IN	NS	d0.dig.afilias-nst.info.
yyz1.afilias-nst.info.	3600	IN	NS	c0.dig.afilias-nst.info.
yyz1.afilias-nst.info.	3600	IN	NS	b0.dig.afilias-nst.info.

;; ADDITIONAL SECTION:
a0.dig.afilias-nst.info. 86400	IN	A	65.22.6.1
b0.dig.afilias-nst.info. 86400	IN	A	65.22.7.1
c0.dig.afilias-nst.info. 86400	IN	A	65.22.8.1
d0.dig.afilias-nst.info. 86400	IN	A	65.22.9.1
a0.dig.afilias-nst.info. 86400	IN	AAAA	2a01:8840:6::1
b0.dig.afilias-nst.info. 86400	IN	AAAA	2a01:8840:7::1
c0.dig.afilias-nst.info. 86400	IN	AAAA	2a01:8840:8::1
d0.dig.afilias-nst.info. 86400	IN	AAAA	2a01:8840:9::1

;; Query time: 20 msec
;; SERVER: 65.22.6.1#53(65.22.6.1)
;; WHEN: Tue Apr 14 22:15:20 JST 2020
;; MSG SIZE  rcvd: 318

PMAC747S:~ mochiko$ 
```

- 通常応答である  status: NOERROR
- Answerセクションがある ANSWER: 1
- 権威を持つ応答が返ってきている（flagsにaaがある）
- Answerセクションにns1.yyz1.afilias-nst.info.のAレコードがある
  - これで外部サーバーのIPが分かったので、元の`www.ietf.org`の名前解決に戻る

## 元の`www.ietf.org` の名前解決に戻る

### ietf.org.の委任先の外部サーバーのIPに問い合わせる

```txt
PMAC747S:~ mochiko$ dig +norec @65.22.6.1 www.ietf.org AAAA

; <<>> DiG 9.10.6 <<>> +norec @65.22.6.1 www.ietf.org AAAA
; (1 server found)
;; global options: +cmd
;; Got answer:
;; ->>HEADER<<- opcode: QUERY, status: NOERROR, id: 54428
;; flags: qr aa; QUERY: 1, ANSWER: 1, AUTHORITY: 0, ADDITIONAL: 1

;; OPT PSEUDOSECTION:
; EDNS: version: 0, flags:; udp: 4096
;; QUESTION SECTION:
;www.ietf.org.			IN	AAAA

;; ANSWER SECTION:
www.ietf.org.		1800	IN	CNAME	www.ietf.org.cdn.cloudflare.net.

;; Query time: 19 msec
;; SERVER: 65.22.6.1#53(65.22.6.1)
;; WHEN: Tue Apr 14 22:19:13 JST 2020
;; MSG SIZE  rcvd: 86

PMAC747S:~ mochiko$ 
```

- 通常応答である  status: NOERROR
- Answerセクションがある ANSWER: 1
- 権威を持つ応答が返ってきている（flagsにaaがある）
- Answerセクションにwww.ietf.org.のCNAMEレコードがある
  - CNAMEということで正式名称の方で今度は名前解決をする

## ルートサーバーに問い合わせる

### 正式名称`www.ietf.org.cdn.cloudflare.net.`をルートサーバーに問い合わせ

```txt
PMAC747S:~ mochiko$ dig +norec @198.41.0.4 www.ietf.org.cdn.cloudflare.net. A

; <<>> DiG 9.10.6 <<>> +norec @198.41.0.4 www.ietf.org.cdn.cloudflare.net. A
; (1 server found)
;; global options: +cmd
;; Got answer:
;; ->>HEADER<<- opcode: QUERY, status: NOERROR, id: 12674
;; flags: qr; QUERY: 1, ANSWER: 0, AUTHORITY: 13, ADDITIONAL: 27

;; OPT PSEUDOSECTION:
; EDNS: version: 0, flags:; udp: 1472
;; QUESTION SECTION:
;www.ietf.org.cdn.cloudflare.net. IN	A

;; AUTHORITY SECTION:
net.			172800	IN	NS	a.gtld-servers.net.
net.			172800	IN	NS	b.gtld-servers.net.
net.			172800	IN	NS	c.gtld-servers.net.
net.			172800	IN	NS	d.gtld-servers.net.
net.			172800	IN	NS	e.gtld-servers.net.
net.			172800	IN	NS	f.gtld-servers.net.
net.			172800	IN	NS	g.gtld-servers.net.
net.			172800	IN	NS	h.gtld-servers.net.
net.			172800	IN	NS	i.gtld-servers.net.
net.			172800	IN	NS	j.gtld-servers.net.
net.			172800	IN	NS	k.gtld-servers.net.
net.			172800	IN	NS	l.gtld-servers.net.
net.			172800	IN	NS	m.gtld-servers.net.

;; ADDITIONAL SECTION:
a.gtld-servers.net.	172800	IN	A	192.5.6.30
b.gtld-servers.net.	172800	IN	A	192.33.14.30
c.gtld-servers.net.	172800	IN	A	192.26.92.30
d.gtld-servers.net.	172800	IN	A	192.31.80.30
e.gtld-servers.net.	172800	IN	A	192.12.94.30
f.gtld-servers.net.	172800	IN	A	192.35.51.30
g.gtld-servers.net.	172800	IN	A	192.42.93.30
h.gtld-servers.net.	172800	IN	A	192.54.112.30
i.gtld-servers.net.	172800	IN	A	192.43.172.30
j.gtld-servers.net.	172800	IN	A	192.48.79.30
k.gtld-servers.net.	172800	IN	A	192.52.178.30
l.gtld-servers.net.	172800	IN	A	192.41.162.30
m.gtld-servers.net.	172800	IN	A	192.55.83.30
a.gtld-servers.net.	172800	IN	AAAA	2001:503:a83e::2:30
b.gtld-servers.net.	172800	IN	AAAA	2001:503:231d::2:30
c.gtld-servers.net.	172800	IN	AAAA	2001:503:83eb::30
d.gtld-servers.net.	172800	IN	AAAA	2001:500:856e::30
e.gtld-servers.net.	172800	IN	AAAA	2001:502:1ca1::30
f.gtld-servers.net.	172800	IN	AAAA	2001:503:d414::30
g.gtld-servers.net.	172800	IN	AAAA	2001:503:eea3::30
h.gtld-servers.net.	172800	IN	AAAA	2001:502:8cc::30
i.gtld-servers.net.	172800	IN	AAAA	2001:503:39c1::30
j.gtld-servers.net.	172800	IN	AAAA	2001:502:7094::30
k.gtld-servers.net.	172800	IN	AAAA	2001:503:d2d::30
l.gtld-servers.net.	172800	IN	AAAA	2001:500:d937::30
m.gtld-servers.net.	172800	IN	AAAA	2001:501:b1f9::30

;; Query time: 18 msec
;; SERVER: 198.41.0.4#53(198.41.0.4)
;; WHEN: Tue Apr 14 22:23:20 JST 2020
;; MSG SIZE  rcvd: 853

PMAC747S:~ mochiko$ 

```

- 通常応答である  status: NOERROR
- Answerセクションがない ANSWER: 0
- 権威を持つ応答ではなく、委任先が示されている（flagsにaaがない）
- Authorityセクションにnetへの委任がある
- 委任先がa.gtld-servers.net.などである
- additionalセクションにa.gtld-servers.net.などのIP情報がある

### netの委任先のサーバーに問い合わせる

```txt
PMAC747S:~ mochiko$ dig +norec @192.5.6.30 www.ietf.org.cdn.cloudflare.net. A

; <<>> DiG 9.10.6 <<>> +norec @192.5.6.30 www.ietf.org.cdn.cloudflare.net. A
; (1 server found)
;; global options: +cmd
;; Got answer:
;; ->>HEADER<<- opcode: QUERY, status: NOERROR, id: 38837
;; flags: qr; QUERY: 1, ANSWER: 0, AUTHORITY: 5, ADDITIONAL: 11

;; OPT PSEUDOSECTION:
; EDNS: version: 0, flags:; udp: 4096
;; QUESTION SECTION:
;www.ietf.org.cdn.cloudflare.net. IN	A

;; AUTHORITY SECTION:
cloudflare.net.		172800	IN	NS	ns1.cloudflare.net.
cloudflare.net.		172800	IN	NS	ns2.cloudflare.net.
cloudflare.net.		172800	IN	NS	ns3.cloudflare.net.
cloudflare.net.		172800	IN	NS	ns4.cloudflare.net.
cloudflare.net.		172800	IN	NS	ns5.cloudflare.net.

;; ADDITIONAL SECTION:
ns1.cloudflare.net.	172800	IN	A	173.245.59.31
ns1.cloudflare.net.	172800	IN	AAAA	2400:cb00:2049:1::adf5:3b1f
ns2.cloudflare.net.	172800	IN	A	198.41.222.131
ns2.cloudflare.net.	172800	IN	AAAA	2400:cb00:2049:1::c629:de83
ns3.cloudflare.net.	172800	IN	A	198.41.222.31
ns3.cloudflare.net.	172800	IN	AAAA	2400:cb00:2049:1::c629:de1f
ns4.cloudflare.net.	172800	IN	A	198.41.223.131
ns4.cloudflare.net.	172800	IN	AAAA	2400:cb00:2049:1::c629:df83
ns5.cloudflare.net.	172800	IN	A	198.41.223.31
ns5.cloudflare.net.	172800	IN	AAAA	2400:cb00:2049:1::c629:df1f

;; Query time: 67 msec
;; SERVER: 192.5.6.30#53(192.5.6.30)
;; WHEN: Tue Apr 14 22:26:22 JST 2020
;; MSG SIZE  rcvd: 370

PMAC747S:~ mochiko$ 

```

- 通常応答である  status: NOERROR
- Answerセクションがない ANSWER: 0
- 権威を持つ応答ではなく、委任先が示されている（flagsにaaがない）
- Authorityセクションにcloudflare.net.への委任がある
- 委任先がns1.cloudflare.net.などである
- additionalセクションにns1.cloudflare.net.などのIP情報がある

### cloudflare.net.の委任先に問い合わせる

```txt
PMAC747S:~ mochiko$ dig +norec @173.245.59.31 www.ietf.org.cdn.cloudflare.net. A

; <<>> DiG 9.10.6 <<>> +norec @173.245.59.31 www.ietf.org.cdn.cloudflare.net. A
; (1 server found)
;; global options: +cmd
;; Got answer:
;; ->>HEADER<<- opcode: QUERY, status: NOERROR, id: 3878
;; flags: qr aa; QUERY: 1, ANSWER: 2, AUTHORITY: 0, ADDITIONAL: 1

;; OPT PSEUDOSECTION:
; EDNS: version: 0, flags:; udp: 512
;; QUESTION SECTION:
;www.ietf.org.cdn.cloudflare.net. IN	A

;; ANSWER SECTION:
www.ietf.org.cdn.cloudflare.net. 300 IN	A	104.20.1.85
www.ietf.org.cdn.cloudflare.net. 300 IN	A	104.20.0.85

;; Query time: 22 msec
;; SERVER: 173.245.59.31#53(173.245.59.31)
;; WHEN: Tue Apr 14 22:28:30 JST 2020
;; MSG SIZE  rcvd: 92

PMAC747S:~ mochiko$ 
```

- 通常応答である  status: NOERROR
- Answerセクションがある ANSWER: 1
- 権威を持つ応答が返ってきている（flagsにaaがある）
- Answerセクションにwww.ietf.org.cdn.cloudflare.net.のAレコードがある
