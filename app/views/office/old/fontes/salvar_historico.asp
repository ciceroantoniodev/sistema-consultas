<%@ Language=VBScript %>
<!--#include file="conexao.asp"-->
<!--#include file="rotinas.asp"-->
<%
Set objTexto = Server.CreateObject("Scripting.FileSystemObject")
'Recupera informações do formulário

vID = Request.form("id")
vTipo = Request.QueryString("tp")

f_texto = Request.Form("textarea")

f_data = Year(Date()) & "-" & Month(Date()) & "-" & Day(Date()) & " " & Time()

'inicia cadastro

conexao.execute("update cadastro_geral set historico='" & f_texto & "' where id=" & vID)

f_arquivo = StrZero(vID, 10) & "_historico.html"

Set Arquivo = objTexto.CreateTextFile(request.serverVariables("APPL_PHYSICAL_PATH")&"documentos\include\paginas\" & f_arquivo)
Arquivo.Close

Set Arquivo = objTexto.OpenTextFile(request.serverVariables("APPL_PHYSICAL_PATH")&"documentos\include\paginas\" & f_arquivo, 8, True) 

vHTML = "<!DOCTYPE HTML PUBLIC ""-//W3C//DTD HTML 4.0 Transitional//EN"">"
vHTML = vHTML & "<html>"
vHTML = vHTML & "<head>"
vHTML = vHTML & "	<title></title>"
vHTML = vHTML & "</head>"
vHTML = vHTML & "<body>"
vHTML = vHTML & f_texto
vHTML = vHTML & "</body>"
vHTML = vHTML & "</html>"

Arquivo.Write(vHTML)

conexao.Close
%>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
	<title>.....:: MEU BAIRRO TEM - Área Restrita ::.....</title>
	<script language="Javascript" src="funcoes.js" type="text/javascript"></script>
    <style type="text/css">
    <!--
      @import url(../estilo.css);
    -->
    </style>
</head>
  
<body style="background: url(./images/ground_framework.gif) repeat-x fixed; margin-top: 0pt; margin-bottom: 0pt; margin-left: 0pt; margin-right: 0pt">
<div align="center">
<table cellspacing="0" cellpadding="0" border="0" width="100%" height="100%" class="letras_">
  <tr bgcolor="#ffffff">
    <td valign="middle" align="center">
	  <table width="400" height="150" class="letras_" cellpadding="0" cellspacing="0" border="1" bgcolor="#f0e9a2">
	    <tr>
		  <td align="center">
		    <span style="font-size: 24px; color: #1130ff">Atualização efetuada com sucesso!</span><br><br><br><br>
		    <div style="margin-top: 30px; background: #ff0000; width: 150px; padding: 5px; font-family: tahoma, arial; font-size: 18px; font-weight:bold"><a href="conteudo.asp?id=<%=vID%>&tp=<%=vTipo%>" style="color: #ffffff">V O L T A R</a></div>
		  </td>
	    </tr>
	  </table>
    </td>
  </tr>
</table>
</div>
</body>
</html>

