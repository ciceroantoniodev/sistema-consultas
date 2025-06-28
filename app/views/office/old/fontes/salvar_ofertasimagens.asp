<%@ Language=VBScript %>
<!--#include file="conexao.asp"-->
<!--#include file="rotinas.asp"-->
<%
Server.ScriptTimeout = 480

Dim Contador, Tamanho
Dim ConteudoBinario, ConteudoTexto
Dim Delimitador, Posicao1, Posicao2
Dim ArquivoNome, ArquivoConteudo, PastaDestino
Dim objobjTexto, objArquivo

vPasta = Request.QueryString("pasta")

vID = Request.QueryString("id")
vID_Cadastro = Request.QueryString("id_cadastro")
vTipo = Request.QueryString("tp")
vFoto = Request.QueryString("foto")

vID_Cidade = Request.QueryString("ida")
vID_Bairro = Request.QueryString("idb")
vID_Franquia = Request.QueryString("idf")
vOfertas = Request.QueryString("ofertas")

f_voltar = 2

If CInt(vFoto) = 0 Then
  PastaDestino = "C:\Inetpub\vhosts\meubairrotem.com\httpdocs\documentos\ofertas\"
Else
  PastaDestino = "C:\Inetpub\vhosts\meubairrotem.com\httpdocs\documentos\fotos\produtos\"
End If

'Determina o tamanho do conteúdo
Tamanho = Request.TotalBytes

If Tamanho > 170000 Then
%>
  <script language="Javascript" type="text/javascript">
  <!--
  alert("O tamanho do arquivo não pode ultrapassar os 170.000 Kb");
  history.back();
  //-->
  </script>
<%
End If

'Obtém o conteúdo no formato binário
ConteudoBinario = Request.BinaryRead(Tamanho)

'Transforma o conteúdo binário em string
For Contador = 1 To Tamanho
  ConteudoTexto = ConteudoTexto & Chr(AscB(MidB(ConteudoBinario, Contador, 1)))
Next 

'Determina o delimitador de campos
Delimitador = Left(ConteudoTexto, InStr(ConteudoTexto, vbCrLf) - 1)

'Percorre a String procurando os campos
'identifica os arquivo e grava no disco
Set objobjTexto = Server.CreateObject("Scripting.FileSystemObject")

Posicao1 = InStr(ConteudoTexto, Delimitador) + Len(Delimitar)
do while True
  ArquivoNome = ""
  Posicao1 = InStr(Posicao1, ConteudoTexto, "filename=")
  if Posicao1 = 0 then
    exit do
  else
   'Determina o nome do arquivo
   Posicao1 = Posicao1 + 10
   Posicao2 = InStr(Posicao1, ConteudoTexto, """")
   For contador = (Posicao2 - 1) to Posicao1 step -1
    if Mid(ConteudoTexto, Contador, 1) <> "\" then '"
      ArquivoNome = Mid(ConteudoTexto, Contador, 1) & ArquivoNome
    else
      exit for
    end if
   next
	
   'Determina o conteúdo do arquivo
   Posicao1 = InStr(Posicao1, ConteudoTexto, vbCrLf & vbCrLf) + 4
   Posicao2 = InStr(Posicao1, ConteudoTexto, Delimitador) - 2
   ArquivoConteudo = Mid(ConteudoTexto, Posicao1, (Posicao2 - Posicao1 + 1))

   'Grava o arquivo
   If ArquivoNome <> "" then
     Set objArquivo = objobjTexto.CreateTextFile(PastaDestino & "/" & ArquivoNome, true)
       objArquivo.WriteLine ArquivoConteudo
       objArquivo.Close			
     Set objArquivo = nothing
	 
     If InStr(1, UCase(ArquivoNome), ".JPG") > 0 Then 
	   vArquivoNovo = "OFERTA" & UCase(Left(Replace(ArquivoNome, ".", ""), 4)) & vID_Cadastro & Hour(Time()) & Minute(Time()) & Second(Time()) & Year(Date()) & Month(Date()) & Day(Date()) & ".jpg"
	 End If
	 
     If InStr(1, UCase(ArquivoNome), ".GIF") > 0 Then 
	   vArquivoNovo = "OFERTA" & UCase(Left(Replace(ArquivoNome, ".", ""), 4)) & vID_Cadastro & Hour(Time()) & Minute(Time()) & Second(Time()) & Year(Date()) & Month(Date()) & Day(Date()) & ".gif"
	 End If
	 
     If InStr(1, UCase(ArquivoNome), ".PNG") > 0 Then 
	   vArquivoNovo = "OFERTA" & UCase(Left(Replace(ArquivoNome, ".", ""), 4)) & vID_Cadastro & Hour(Time()) & Minute(Time()) & Second(Time()) & Year(Date()) & Month(Date()) & Day(Date()) & ".png"
	 End If
	 
     If InStr(1, UCase(ArquivoNome), ".BMP") > 0 Then 
	   vArquivoNovo = "OFERTA" & UCase(Left(Replace(ArquivoNome, ".", ""), 4)) & vID_Cadastro & Hour(Time()) & Minute(Time()) & Second(Time()) & Year(Date()) & Month(Date()) & Day(Date()) & ".bmp"
	 End If
	 
     objobjTexto.CopyFile PastaDestino & "/" & ArquivoNome, PastaDestino & "/" & vArquivoNovo
     objobjTexto.DeleteFile PastaDestino & "/" & ArquivoNome,true
     
	 If CInt(vFoto) = 0 Then
	   conexao.execute("update cadastro_ofertas set imagem='" & vArquivoNovo & "' where id=" & vID)
	 Else
	   conexao.execute("update cadastro_ofertas set foto" & vFoto & "='" & vArquivoNovo & "' where id=" & vID)
	 End If
  end if
end if
Loop
Set objobjTexto = nothing
%>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
	<title>:::: SysControle - Você no Controle :::: </title>
	<script language="Javascript" src="funcoes.js" type="text/javascript"></script>
    <style type="text/css">
    <!--
      @import url(estilo.css);
    -->
    </style>
</head>
  
<body style="background-color: #ffffff; margin-top: 0pt; margin-bottom: 0pt; margin-left: 0pt; margin-right: 0pt">
<div align="center">
<table cellspacing="0" cellpadding="0" border="0" width="100%" height="100%" class="letras_">
  <tr bgcolor="#ffffff">
    <td valign="middle" align="center">
	  <table width="400" height="150" class="letras_" cellpadding="0" cellspacing="0" border="1" bgcolor="#f0e9a2">
	    <tr>
		  <td align="center">
		    <span style="font-size: 24px; color: #1130ff">Imagem enviada com sucesso!</span><br><br><br><br>
<%If vBancoDados = "cadastro_diretoria" Then%>
		    <div style="margin-top: 30px; background: #ff0000; width: 150px; padding: 5px; font-family: tahoma, arial; font-size: 18px; font-weight:bold"><a href="gerenciar_diretoria.asp?id=<%=vID_Cadastro%>&tp=<%=vTipo%>" style="color: #ffffff">V O L T A R</a></div>
<%Else%>			
		    <div style="margin-top: 30px; background: #ff0000; width: 150px; padding: 5px; font-family: tahoma, arial; font-size: 18px; font-weight:bold"><a href="gerenciar_fotos.asp?id=<%=vID_Cadastro%>&tp=<%=vTipo%>" style="color: #ffffff">V O L T A R</a></div>
<%End If%>			
		  </td>
	    </tr>
	  </table>
    </td>
  </tr>
</table>
</div>
</body>
</html>
