' 素数の判定は与えられた数より小さい数でひたすら割っていく
a = 91
s = "は、素数です。"
For i = 2 to (a - 1)
    If a Mod i = 0 Then
        s = "は、素数ではない"
        Exit For
    End If
Next
MsgBox CStr(a) & s
' 上記は本当は判定したい数の1/2までの数で割れば良いのでまだ工夫の余地がある
