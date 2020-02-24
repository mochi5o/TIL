a = 12
b = 42
While a <> b
    If a > b Then
        a = a -b
    Else
        b = b - a
    End If
Wend
MsgBox "最大公約数は、" & CStr(b) & "です。"