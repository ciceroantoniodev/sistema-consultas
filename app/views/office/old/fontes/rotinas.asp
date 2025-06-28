<%
'==============================================
' SelecionarData(campo[2009,2020])
'==============================================
Sub SelecionarData(campo)

AnoI = Year(Date())
AnoF = Year(Date()) + 3

If InStr(1, campo, "[") > 0 Then
  AnoI = Mid(campo, InStr(1, campo, "[")+1, 4)
  AnoF = Mid(campo, InStr(1, campo, ",")+1, 4)
  campo = Mid(campo, 1, InStr(1, campo, "[")-1)
End If

Response.Write "<select name='" & campo & "_dia' class='form_co'>"
Response.Write "<option value='" & Day(Date()) & "'>" & Day(Date()) & "</option>"
Response.Write "<option value='01'>01</option>"
Response.Write "<option value='02'>02</option>"
Response.Write "<option value='03'>03</option>"
Response.Write "<option value='04'>04</option>"
Response.Write "<option value='05'>05</option>"
Response.Write "<option value='06'>06</option>"
Response.Write "<option value='07'>07</option>"
Response.Write "<option value='08'>08</option>"
Response.Write "<option value='09'>09</option>"
Response.Write "<option value='10'>10</option>"
Response.Write "<option value='11'>11</option>"
Response.Write "<option value='12'>12</option>"
Response.Write "<option value='13'>13</option>"
Response.Write "<option value='14'>14</option>"
Response.Write "<option value='15'>15</option>"
Response.Write "<option value='16'>16</option>"
Response.Write "<option value='17'>17</option>"
Response.Write "<option value='18'>18</option>"
Response.Write "<option value='19'>19</option>"
Response.Write "<option value='20'>20</option>"
Response.Write "<option value='21'>21</option>"
Response.Write "<option value='22'>22</option>"
Response.Write "<option value='23'>23</option>"
Response.Write "<option value='24'>24</option>"
Response.Write "<option value='25'>25</option>"
Response.Write "<option value='26'>26</option>"
Response.Write "<option value='27'>27</option>"
Response.Write "<option value='28'>28</option>"
Response.Write "<option value='29'>29</option>"
Response.Write "<option value='30'>30</option>"
Response.Write "<option value='31'>31</option>"
Response.Write "</select>&nbsp;/&nbsp;"

Response.Write "<select name='" & campo & "_mes' class='form_co'>"
Response.Write "<option value='" & Month(Date()) & "'>" & Month(Date()) & "</option>"
Response.Write "<option value='01'>01</option>"
Response.Write "<option value='02'>02</option>"
Response.Write "<option value='03'>03</option>"
Response.Write "<option value='04'>04</option>"
Response.Write "<option value='05'>05</option>"
Response.Write "<option value='06'>06</option>"
Response.Write "<option value='07'>07</option>"
Response.Write "<option value='08'>08</option>"
Response.Write "<option value='09'>09</option>"
Response.Write "<option value='10'>10</option>"
Response.Write "<option value='11'>11</option>"
Response.Write "<option value='12'>12</option>"
Response.Write "</select>&nbsp;/&nbsp;"

Response.Write "<select name='" & campo & "_ano' class='form_co'>"
Response.Write "<option value='" & Year(Date()) & "'>" & Year(Date()) & "</option>"

i= CInt(AnoI) + 1
Do While i <= CInt(AnoF)
  Response.Write "<option value='" & i & "'>" & i & "</option>"
  i = i+1
Loop
Response.Write "</select>"
End Sub

'==============================================
' Preenche com Zeros a Esquerda Qualquer String
' Deve ser passado a Variavel e o Numero de Casas
' A Variavel pode ser Tipo Caracter ou Numerico
'==============================================
Function StrZero(Variavel, nCasas)
   cVariavel = cstr(Variavel)
   StrZero = right(string(nCasas,"0") + trim(cVariavel),nCasas)
End Function

'==============================================
' Criptografia de dados
'==============================================
function fCripto(cadeia)
va = "vkK"
vb = "Vhr"
vc = "vMd"
vd = "vOw"
ve = "vLs"
vf = "vWp"
vg = "vZM"
vh = "WPs"
vi = "wLm"
vj = "Wqn"
vk = "wAP"
vl = "Spw"
vm = "SzM"
vn = "sRt"
vo = "sPl"
vp = "aaL"
vq = "aZp"
vr = "ABw"
vs = "ePU"
vt = "eKa"
vu = "EwQ"
vv = "eEe"
vw = "zXz"
vx = "zOw"
vy = "zLO"
vz = "XqP"
v1 = "xWp"
v2 = "xzP"
v3 = "UAp"
v4 = "uOl"
v5 = "uQp"
v6 = "uDD"
v7 = "hAp"
v8 = "hMz"
v9 = "hGu"
v0 = "gKk"

c = ""
t = Trim(cadeia)
For i=1 To Len(Trim(cadeia))
  x = Mid(t, 1, 1)
  t = Mid(t, 2, Len(t) - 1)
  If x = "a" Then c = c & va
  If x = "b" Then c = c & vb
  If x = "c" Then c = c & vc
  If x = "d" Then c = c & vd
  If x = "e" Then c = c & ve
  If x = "f" Then c = c & vf
  If x = "g" Then c = c & vg
  If x = "h" Then c = c & vh
  If x = "i" Then c = c & vi
  If x = "j" Then c = c & vj
  If x = "k" Then c = c & vk
  If x = "l" Then c = c & vl
  If x = "m" Then c = c & vm
  If x = "n" Then c = c & vn
  If x = "o" Then c = c & vo
  If x = "p" Then c = c & vp
  If x = "q" Then c = c & vq
  If x = "r" Then c = c & vr
  If x = "s" Then c = c & vs
  If x = "t" Then c = c & vt
  If x = "u" Then c = c & vu
  If x = "v" Then c = c & vv
  If x = "w" Then c = c & vw
  If x = "x" Then c = c & vx
  If x = "y" Then c = c & vy
  If x = "z" Then c = c & vz
  If x = "1" Then c = c & v1
  If x = "2" Then c = c & v2
  If x = "3" Then c = c & v3
  If x = "4" Then c = c & v4
  If x = "5" Then c = c & v5
  If x = "6" Then c = c & v6
  If x = "7" Then c = c & v7
  If x = "8" Then c = c & v8
  If x = "9" Then c = c & v9
  If x = "0" Then c = c & v0
Next

fCripto =  c
end function

'==============================================
' De-Criptografia de dados
'==============================================
function fDeCripto(cadeia)
codigos = "[vkKa][Vhrb][vMdc][vOwd][vLse][vWpf][vZMg][WPsh][wLmi][Wqnj][wAPk][Spwl][SzMm][sRtn][sPlo][aaLp][aZpq][ABwr][ePUs][eKat][EwQu][eEev][zXzw][zOwx][zLOy][XqPz][xWp1][xzP2][UAp3][uOl4][uQp5][uDD6][hAp7][hMz8][hGu9][gKk0]"

c = ""
t = Trim(cadeia)
For i=1 To Len(Trim(cadeia)) Step 3
  x = Mid(t, 1, 3)
  t = Mid(t, 4, Len(t) - 3)
  p = InStr(1, codigos, x)
  If p > 0 Then c = c & Mid(codigos, p+3, 1)
Next

fDeCripto =  c
end function

'==============================================
' Função fEscrever()
'==============================================
function fEscrever(cadeia)
c = ""
t = Trim(cadeia)
For i=1 To Len(Trim(cadeia))
  x = Mid(t, 1, 1)
  t = Mid(t, 2, Len(t) - 1)
  If Trim(x) = "" Then
    c = c & "&nbsp;&nbsp;"
  Else
    c = c & "<img src='./images/alfa" & x & ".gif' border='0'>"
  End If
Next

fEscrever =  c
end function
%>