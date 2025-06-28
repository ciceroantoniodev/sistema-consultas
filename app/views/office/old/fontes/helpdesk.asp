<%@ Language=VBScript %>
<!--#include file="../conexao.asp"-->
<%
vCodemp = Request.QueryString("id")
vNome = Request.QueryString("nome")

vAcao = Request.Form("acao")

If CInt(vAcao) = 1 Then
  vCodemp =  Request.Form("codemp")
  f_tipo = Request.Form("tipo")
  f_pergunta = Request.Form("pergunta")
  f_data = Year(Date()) & "-" & Month(Date()) & "-" & Day(Date()) & " " & Time()

  Set dbDados = conexao.Execute("select * from helpdesk order by id desc")

  If dbDados.EOF And dbDados.BOF Then
    vCodigo = 1
  Else
    vCodigo = dbDados("id") + 1
  End If

  dbDados = vCodigo
  dbDados = dbDados & "," & vCodemp
  dbDados = dbDados & ",'" & f_tipo & "'"
  dbDados = dbDados & ",'" & f_pergunta   & "'"
  dbDados = dbDados & ",NULL"
  dbDados = dbDados & ",'S'"
  dbDados = dbDados & ",'" & f_data & "'"
 
  conexao.Execute("insert into helpdesk values (" & dbDados & ");")
  
  Set dbDados = conexao.Execute("select * from mensagens order by id desc")

  If dbDados.EOF And dbDados.BOF Then
    vCodigo = 1
  Else
    vCodigo = dbDados("id") + 1
  End If

  dbDados = vCodigo
  dbDados = dbDados & ",888888"
  dbDados = dbDados & ",'Solicitação de suporte no HelpDesk'"
  dbDados = dbDados & ",'S'"
  dbDados = dbDados & ",'" & f_data & "'"
 
  conexao.Execute("insert into mensagens values (" & dbDados & ");")
  
  Set Mailer = Server.CreateObject("SMTPsvg.Mailer")
  Mailer.RemoteHost = "mail.oficinasautomotiva.com.br"
  Mailer.FromName = "OficinasAutomotiva"
  Mailer.FromAddress = "suporte@oficinasautomotiva.com.br"
  Mailer.AddRecipient "Suporte Samsite" , "suporte@samsite.com.br"
  Mailer.Subject = "Oficinasautomotiva.com.br - Helpdesk"
  Mailer.BodyText = "Nova solicitação em Helpdesk" & vbcrlf
  Mailer.BodyText = "Usuário.........: " & vNome & vbcrlf
  Mailer.BodyText = "Código..........: " & vCodemp & vbcrlf
  Mailer.BodyText = "Tipo............: " & f_tipo & vbcrlf
  Mailer.BodyText = "Pergunta........: " & f_pergunta & vbcrlf
  Mailer.BodyText = "Data............: " & f_data & vbcrlf
  Mailer.SendMail 

End If

vAcao = 0
f_codcli = vCodemp
%>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
	<title>.....:: Portal Oficinas Automotiva ::.....</title>
    <script language="JavaScript" type="text/javascript" src="funcoes.js"></script>
    <style type="text/css">
    <!--
      @import url(../estilo.css);
    -->
	
    .td_box1  {text-align: center;
	           border: #CCCCCC;
               border-style: solid;
               border-top-width: 1px;
               border-right-width: 0px;
               border-bottom-width: 0px;
               border-left-width: 1px}
			   
     .form_   {BORDER-RIGHT: #698593 1px solid;
               BORDER-TOP: #698593 1px solid;
               FONT-WEIGHT: bold;
               FONT-SIZE: 11px;
               BORDER-LEFT: #698593 1px solid;
               COLOR: #e04430;
               BORDER-BOTTOM: #698593 1px solid;
               FONT-FAMILY: Arial, Verdana, Helvetica, sans-serif}
    </style>
</head>
  
<body style="background-color: #ffffff; margin-top: 0pt; margin-bottom: 0pt; margin-left: 0pt; margin-right: 0pt">
<div align="center">
<table align="center" cellspacing="0" cellpadding="0" border="0" width="100%">
  <tr bgcolor="#ffffff">
    <td align="center" valign="top">
	
<!---------// Inicia aqui% -->

<table align="center" cellspacing="0" cellpadding="0" border="0" width="100%">
  <tr height="400" bgcolor="ffffff">
    <td valign="top" align="center">
	  <span style="font-family: tahoma, arial; font-size: 20pt; color: #999999"><br>
	  <span style="font-size: 28px; color: #666666">HELPDESK</span><br><br>
	  <table class="letras_" width="600">
	    <tr bgcolor="#6666FF"><td><b>N&deg;</b></td><td><b>Data</b></td><td><b>Setor</b></td><td><b>Solicitação</b></td></tr>
	  <%
	  i=1
	  c=1
	  Set dbDados = conexao.execute("select * from helpdesk where codcli=" & vCodemp & " order by data_cad desc")
	  Do While Not dbDados.EOF
	    If c = 1 Then
		  cor = "#E9E9E9"
		  c=c+1
		Else
		  cor = "#ffffff"
		  c=1
		End If
	    Response.Write "<tr bgcolor="&cor&"><td>"
		Response.Write i
		Response.Write "</td><td width='100'>"
		Response.Write dbDados("data_cad")
		Response.Write "</td><td width='70'>"
		Response.Write dbDados("tipo")
		Response.Write "</td><td>"
		Response.Write dbDados("pergunta")
		Response.Write "</td></tr><tr bgcolor="&cor&"><td colspan='3'>&nbsp;</td><td>"
		Response.Write "<font color='#FF0033'>" & dbDados("resposta") & "</font></b>"
		Response.Write "</td></tr>"
		i=i+1
        dbDados.MoveNext
	  Loop
	  %>
	  </table>
	  <FORM ACTION="helpdesk.asp" METHOD="POST" style="margin-bottom: 0pt" name="cadastro">
	  <input name="acao" type="hidden" value="1">	  
	  <%
	  Response.Write "<input name='codemp' type='hidden' value='" & vCodemp & "'>"
	  %>
	  <div style='margin-left: 0pt'>
	  <table cellspacing='0' cellpadding='0' border='0' width='600'>
	  <tr>
	  <td class='td_box' align='center'>
	  <br>
	  <table width="500" border='0' cellspacing='3' cellpadding='0' class='letras_'>
	    <tr>
		  <td width='130' bgcolor='#CCCCCC'>&nbsp;&nbsp;Setor:</td>
		  <td width='330'><input name="tipo" type="radio" value="SUPORTE" checked>SUPORTE <input name="tipo" type="radio" value="FINANCEIRO">FINANCEIRO <input name="tipo" type="radio" value="PUBLICIDADE">PUBLICIDADE</td>
		</tr>
		<tr>
		  <td bgcolor='#CCCCCC'>&nbsp;&nbsp;Qual sua dúvida ou<br>&nbsp;&nbsp;solicitação?</td>
		  <td><textarea name="pergunta" rows='10' cols='60' class='form_co'></textarea></td>
		</tr>
		<tr><td height='5'></td></tr>
	  </table><br>
	  <font style='font-size: 15pt'><input type="submit" value='  Enviar  ' style="font-family: Verdana, Arial; font-size: 16px; color: #ffffff; background-color: #FF6600; border: #990000; border-style: solid; border-top-width: 2px; border-right-width: 3px; border-bottom-width: 3px; border-left-width: 2pxC"></font><br><br>
	  </td>
	  </tr>
	  </table><br>
	  </form>
	  </div>
	 </td>
</tr>
</table>

<!---------// Termina aqui%-->

    </td>
  </tr>
</table>
</div>
</body>
</html>
<%
conexao.Close
Set conexao=Nothing
Set dbDados=Nothing
%>