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
