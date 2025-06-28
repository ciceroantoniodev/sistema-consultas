<%@ Language=VBScript %>
<!--#include file="conexao.asp"-->
<%
id_cadastro = Request.QueryString("id")

f_enquete = Request.QueryString("enquete")

If Not f_enquete = "" Then
  conexao.execute("update web_enquete_perguntas set ativa='N' where ativa='S'")
  conexao.execute("update web_enquete_perguntas set ativa='S' where id=" & dbDados("id") & "&id_cadastro=" & f_enquete)
End If

Set dbDados = conexao.execute("select * from artigos where id_cadastro=" & id_cadastro & " order by id desc")

If dbDados.BOF And dbDados.EOF Then
  f_id = 0
Else
  f_id = dbDados("id")
End If
%>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<html>
<head>
	<title>:::: Portal Oficinas Automotiva :::: </title>
	<script language="Javascript" src="funcoes.js" type="text/javascript"></script>
	<script language="Javascript" type="text/javascript">
	function fAtivarEnquete(id) {
	window.location.href = "web_enquetes.asp?enquete=" + id;
	}
	</script>
    <style type="text/css">
    <!--
      @import url(../estilo.css);
       a.linkar:link    {color: #ffffff; font-size: 18px; text-decoration: none}
	  a.linkar:visited {color: #ffffff; font-size: 18px; text-decoration: none}
	  a.linkar:hover   {color: #FFFF00; font-size: 18px; text-decoration: underline}
   -->
    </style>
</head>

<body style='background-color: #ffffff; margin-top: 0pt; margin-bottom: 0pt; margin-left: 0pt; margin-right: 0pt'>
<div align="center">
<a name="#inicio"></a>
<table id=" & dbDados("id") & "&id_cadastro="empresa" cellspacing="0" cellpadding="0" border="0" width="80%">
  <tr>
	<td id=" & dbDados("id") & "&id_cadastro="descricao" valign="top" bgcolor="#ffffff">
	  <form action="form_dados.asp?tit=enquetes&bd=web_enquete_perguntas" method="post" name="form_excluir">
	  <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" class="letras_">
		<tr>
		  <td align="center" valign="top">
		    <br><br>
		    <span style="font-size: 28px; color: #666666">ARTIGOS</span><br><br>
			<table border="0" cellspacing="0" cellpadding="0" style="color:#FFE8E8; font-weight: bold; font-family: tahoma, arial; font-size: 12px">
			  <tr height="20">
			    <td bgcolor="#F40000" width="150" align="center" class="menuTOP"><%Response.Write "<a href='../RTE/default.asp?id=" & f_id & "&id_cadastro=" & id_cadastro & "&o=new&fl=new' target='conteudo' class='linkar'>"%>Novo Artigo</a></td>
			  </tr>
			  <tr height="3">
			    <td width="150" height="3" class="menuBOTTOM"><span style="font-size: 1px">&nbsp;</span></td>
			  </tr>
			</table><br>
		    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="letras_">
			  <tr>
			    <td align="center">
				  <table width="100%" border="0" cellspacing="0" cellpadding="0" class="letras_">
				    <tr bgcolor="#5b97f9">
					  <td align="center"><font color="#ffffff">Código</font></td>
					  <td align="center" class="td_div"><font color="#ffffff">Título</font></td>
					  <td align="center" class="td_div"><font color="#ffffff">&nbsp;&nbsp;Visualizações&nbsp;&nbsp;</font></td>
					  <td align="center" class="td_div"><font color="#ffffff">&nbsp;&nbsp;Cliques&nbsp;&nbsp;</font></td>
					  <td align="center" class="td_div"><font color="#ffffff">&nbsp;</font></td>
					</tr>
				  <%
				  If (Not dbDados.BOF) And (Not dbDados.EOF) Then
				    i=1
				    Do While Not dbDados.EOF
				      If i=1 Then
					    vCor = "#efefef"
					    i=2
					  Else
					    vCor = "#ffffff"
					    i=1
					  End If
				      Response.Write "<tr><td align='center' bgcolor=" & vCor & " class='box'><a href='../RTE/default.asp?id=" & dbDados("id") & "&id_cadastro=" & id_cadastro & "&t=" & dbDados("titulo") & "&o=change&fl=" & dbDados("arquivo") & "' class='grid' target='conteudo'>" & dbDados("id") & "</a>&nbsp;</td>"
				      Response.Write "<td bgcolor=" & vCor & " class='box'><a href='../RTE/default.asp?id=" & dbDados("id") & "&id_cadastro=" & id_cadastro & "&t=" & dbDados("titulo") & "&o=change&fl=" & dbDados("arquivo") & "'' class='grid' target='conteudo'>" & dbDados("titulo") & "</a>&nbsp;</td>"
				      Response.Write "<td bgcolor=" & vCor & " class='box'><a href='../RTE/default.asp?id=" & dbDados("id") & "&id_cadastro=" & id_cadastro & "&t=" & dbDados("titulo") & "&o=change&fl=" & dbDados("arquivo") & "'' class='grid' target='conteudo'>" & dbDados("visualizacoes") & "</a>&nbsp;</td>"
				      Response.Write "<td bgcolor=" & vCor & " class='box'><a href='../RTE/default.asp?id=" & dbDados("id") & "&id_cadastro=" & id_cadastro & "&t=" & dbDados("titulo") & "&o=change&fl=" & dbDados("arquivo") & "'' class='grid' target='conteudo'>" & dbDados("cliques") & "</a>&nbsp;</td>"
					  Response.Write "<td align='center' bgcolor=" & vCor & " style='border: #CCCCCC; border-style: solid; border-top-width: 1px; border-right-width: 1px; border-bottom-width: 0px; border-left-width: 1px'><a href='cad_enquete.asp?id=" & dbDados("id") & "&id_cadastro=" & dbDados("id") & "&acao=alterar' class='grid' target='conteudo'>"
					  Response.Write "[ excluir ]"
					  Response.Write "</a>&nbsp;</td></tr>"

					  dbDados.MoveNext
				    Loop
				  End If
				  %>
				    <tr bgcolor="#5b97f9">
					  <td height="1" colspan="5" style="border: #CCCCCC; border-style: solid; border-top-width: 1px; border-right-width: 0px; border-bottom-width: 0px; border-left-width: 0px"><span style="font-size: 1px">&nbsp;</span></td>
					</tr>
				  </table>
				</td>
			  </tr>
			</table>
		  </td>
		</tr>
	  </table>
	  </form>
	</td>
  </tr>
</table>
</div>
</body>
</html>
<%
session("sysoficinasATUALIZAR") = 0
conexao.close
Set dbDados = Nothing
%>