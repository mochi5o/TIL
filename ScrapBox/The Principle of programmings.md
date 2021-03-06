# [プリンシプルオブプログラミング](https://www.amazon.co.jp/%E3%83%97%E3%83%AA%E3%83%B3%E3%82%B7%E3%83%97%E3%83%AB-%E3%82%AA%E3%83%96-%E3%83%97%E3%83%AD%E3%82%B0%E3%83%A9%E3%83%9F%E3%83%B3%E3%82%B0-3%E5%B9%B4%E7%9B%AE%E3%81%BE%E3%81%A7%E3%81%AB%E8%BA%AB%E3%81%AB%E3%81%A4%E3%81%91%E3%81%9F%E3%81%84-%E4%B8%80%E7%94%9F%E5%BD%B9%E7%AB%8B%E3%81%A4101%E3%81%AE%E5%8E%9F%E7%90%86%E5%8E%9F%E5%89%87-ebook/dp/B071V7MY82)

## [ScrapBoxのまとめ](https://scrapbox.io/moch/%E3%83%97%E3%83%AA%E3%83%B3%E3%82%B7%E3%83%97%E3%83%AB_%E3%82%AA%E3%83%96_%E3%83%97%E3%83%AD%E3%82%B0%E3%83%A9%E3%83%9F%E3%83%B3%E3%82%B0_3%E5%B9%B4%E7%9B%AE%E3%81%BE%E3%81%A7%E3%81%AB%E8%BA%AB%E3%81%AB%E3%81%A4%E3%81%91%E3%81%9F%E3%81%84_%E4%B8%80%E7%94%9F%E5%BD%B9%E7%AB%8B%E3%81%A4101%E3%81%AE%E5%8E%9F%E7%90%86%E5%8E%9F%E5%89%87)

- 凝集度 モジュール同士の要素間の関係性（モジュールの中身に着目）ー数字が大きいほどよい
- 結合度 モジュール同士の関係の密接さ（モジュール間のデータの受け渡しに着目）ー数字が大きいほどよい
- プログラマは「怠慢」「短気」「傲慢」であれ
  - いい言葉
- エゴレスプログラミングの十戒
  - 世界で唯一変わらないことは、変わるということだけです。
  - 好き、めっちゃ好き

### 第6章　手法〜プログラマの道具箱

- 曳光弾＝えいこうだん　行き先を照らすもの、動作する土台
  - プロトタイプとは異なる、プロトタイプはあくまでイメージを確認する用のハリボテ
  - 曳光弾の場合は、確かに動くが最小の実装で土台だけのもの→これはそのままプロダクトに引き継がれる
  - とはいえ「動作する土台」はレベルが高そう

- ドッグフーディング
  - 自分のソフトウェアを味見する
  - 忘れてしまいがちだけど、ユーザーに「便利です」と言って提供しているソフトウェアなら自ら使い続けることでそれが便利であると証明しなければいけない
  - 作った後もユーザーとして使い続けること

- ラバーダッキング（説明する、というデバッグ）
  - 「誰かに」説明するつもりで課題を整理すると自己解決する
  - バスタブのアヒル（ラバーダック）にように「誰か」定期的にうなづくだけで良いことから
    - これはよく分かる。教えてもらおうと思って課題を整理していると突然コードが見えてくる
  - 意識的に取り組むようになるとよりよい
    - 自分で○分悩んだらテディに相談する、と決める
    - テディに○分相談してもダメだったら周りに聞く

- コンテキスト
  - 達人の考える過程を真似する
  - コンテキストの存在を意識しながら真似する

### 第7章　法則〜プログラミングのアンチパターン〜

- ブルックスの法則
  - 人月計算において、人と月は交換できない
    - 言われてみれば確かにそう
    - 2人で6ヶ月と6人で2ヶ月だと全然違うというのは分かりやすい
    - 大人数いても結局手が余って進まないなど
  - 生産性は単なる労働力の足し算にはならない

- ジョシュアツリーの法則
  - 名前を知らないと見えるようにならない、ということ
    - まずは頭の中にインデックスを貼ること
    - 分からなくてもいいからどんどん入れておく
    - 次に見たときにピンとくる

- ヤクの毛刈り
  - 本質ではないことに時間を浪費してしまうこと
    - ついつい作業から作業が派生してしまい、それに没頭してしまう
  - 気づいたときに立ち止まって本来の目的を思い出すようにする
  - コードを読んでいても、追いかけているうちに何を目的としていたか忘れていることがある
    - メモを取りながら作業する
    - 一旦考えなくていいこと、すでに考えたことを外（＝メモ）においておく

### 人間のためのプリンシプル

- ケアリング
  - 相手をケアすることで相手の成長を助けるだけでなく、自分の成長を助ける
- 道徳法則
  - >汝の意思の格率が、常に同時に普遍的立法の原理として妥当するように行為せよ
    - つまり、「自分自身の行動をとい、みんなが認めてくれるようなことであれば、それを行え」という意
- メソテース（＝中庸）
  - 過不足なくバランスを持って取り組めるような徳のこと
  - 全ての物事はグラデーションである、二項対立ではないということ
  - どの濃さの灰色を選ぶのか、という考え方
