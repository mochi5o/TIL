' 手を表す変数を初期化する
Dim te(２)
te(0) = "グー"
te(1) = "チョキ"
te(2) = "パー"

' ユーザーの勝ち数をカウントする変数を初期化する
kachi = 0

' 乱数のタネを初期化する
Randomize

' 起動メッセージを表示
MsgBox "じゃんけんゲーム"

' 5回勝負
For i = 1 To 5
    ' ユーザーの手を入力する
    user = CInt(InputBox("0: グー、1: チョキ、2: パー"))

    ' コンピュータの手を決める
    computer = CInt(Rnd * 2)

    ' 出した手を表す文字列を作成する
    s = "ユーザー：" & te(user) & "、コンピュータ：" &te(computer)

    ' 勝敗を判定し結果を表示する
    if user = computer Then
        MsgBox s & "・・・あいこです！"
    ElseIf computer = (user + 1) Mod 3 Then
        MsgBox s & "・・・ユーザーの勝ちです！！"
        kachi = kachi + 1
    Else
        MsgBox s & "・・・コンピュータの勝ち。。"
    End if
Next

' ユーザーの勝ち数を表示する
MsgBox "ユーザーの勝ち数：" & kachi