<%@ Language=VBScript %>
<!--#include file="conexao.asp"-->
<!--#include file="rotinas.asp"-->
<%
'If session("funcao") = "ADMINISTRADOR" Then
'  Response.Redirect "selectuser.asp"
'End If

id_cadastro = Request.QueryString("id")

vSecao = "GERENCIAMENTO DE ESTOQUE"
vBotoes = "[1][3]"
vAtualizar = session("sysoficinasATUALIZAR")

Set dbDados = conexao.execute("select * from produtos where id_cadastro=" & id_cadastro & " order by descricao")
%>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<html>
<head>
	<title>:::: Portal Oficinas Automotiva :::: </title>
    <style type="text/css">
    <!--
      @import url(../estilo.css);
       a.linkar:link    {color: #ffffff; font-size: 18px; text-decoration: none}
	  a.linkar:visited {color: #ffffff; font-size: 18px; text-decoration: none}
	  a.linkar:hover   {color: #FFFF00; font-size: 18px; text-decoration: underline}
    -->
	.box  {border: #CCCCCC;
           border-style: solid;
           border-top-width: 1px;
           border-right-width: 0px;
           border-bottom-width: 0px;
           border-left-width: 1px}
    </style>
</head>
  
<body style="background-color: #ffffff; margin-top: 0pt; margin-bottom: 0pt; margin-left: 0pt; margin-right: 0pt">
<div align="center">
<a name="#inicio"></a>
<table id="empresa" cellspacing="0" cellpadding="0" border="0" width="80%">
  <tr>
	<td id="descricao" valign="top" bgcolor="#ffffff">
	  <form action="form_dados.asp" method="post" name="form_excluir">
	  <table border="0" width="100%" cellspacing="0" cellpadding="0" align="center" class="letras_">
		<tr>
		  <td align="center" valign="top">
		  		    <span style="font-size: 28px; color: #666666">GERENCIAMENTO DE PRODUTOS</span><br><br>
			<table border="0" cellspacing="0" cellpadding="0" style="color:#FFE8E8; font-weight: bold; font-family: tahoma, arial; font-size: 12px">
			  <tr height="20">
			    <td bgcolor="#F40000" width="150" align="center" class="menuTOP"><%Response.Write "<a href='cad_produtos.asp?id=" & id_cadastro & "&o=0' target='conteudo' class='linkar'>"%>Novo Produto</a></td>
			  </tr>
			  <tr height="3">
			    <td width="150" height="3" class="menuBOTTOM"><span style="font-size: 1px">&nbsp;</span></td>
			  </tr>
			</table><br>
		    <table border="0" width="100%" cellspacing="0" cellpadding="0" class="letras_">
			  <tr>
			    <td align="center">
				  <table border="0" cellspacing="0" cellpadding="0" class="letras_" width="80%">
				    <tr bgcolor="#5b97f9">
					  <td align="center"><font color="#ffffff">Código</font></td>
					  <td align="center"><font color="#ffffff">Descrição do Produto</font></td>
					  <td align="center"><font color="#ffffff">Valor Normal</font></td>
					  <td align="center"><font color="#ffffff">Estoque Atual</font></td>
					  <td align="center"><font color="#ffffff">Fotos</font></td>
					  <td align="center"><font color="#ffffff">Visualizações</font></td>
					  <td align="center"><font color="#ffffff">Cliques</font></td>
					</tr>
				  <%
				  i=1
				  t=0
				  Do While Not dbDados.EOF
				    If i=1 Then
					  vCor = "#efefef"
					  i=2
					Else
					  vCor = "#ffffff"
					  i=1
					End If
				    Response.Write "<tr><td bgcolor=" & vCor & " class='box' align='center'><a href='cad_produtos.asp?id=" & dbDados("id") & "&o=1' class='grid' target='conteudo'>" & dbDados("id") & "</a>&nbsp;</td>"
				    Response.Write "<td bgcolor=" & vCor & " class='box'><a href='cad_produtos.asp?id=" & dbDados("id") & "&o=1' class='grid' target='conteudo'>" & dbDados("descricao") & "</a>&nbsp;</td>"
				    Response.Write "<td align='right' bgcolor=" & vCor & " class='box'><a href='cad_produtos.asp?id=" & dbDados("id") & "&o=1' class='grid' target='conteudo'>" & FormatCurrency(dbDados("valor_normal")) & "</a>&nbsp;</td>"
				    Response.Write "<td align='right' bgcolor=" & vCor & " class='box'><a href='cad_produtos.asp?id=" & dbDados("id") & "&o=1' class='grid' target='conteudo'>" & dbDados("estatual") & "</a>&nbsp;</td>"
				    Response.Write "<td align='right' bgcolor=" & vCor & " class='box'><a href='ger_fotos.asp?id=" & dbDados("id") & "&o=1' class='grid' target='conteudo'>" & dbDados("fotos") & "</a>&nbsp;</td>"
				    Response.Write "<td align='right' bgcolor=" & vCor & " class='box'><a href='cad_produtos.asp?id=" & dbDados("id") & "&o=1' class='grid' target='conteudo'>" & dbDados("visualiza") & "</a>&nbsp;</td>"
				    Response.Write "<td align='right' bgcolor=" & vCor & " class='box'><a href='cad_produtos.asp?id=" & dbDados("id") & "&o=1' class='grid' target='conteudo'>" & dbDados("cliques") & "</a>&nbsp;</td>"
				    Response.Write "<td bgcolor=" & vCor & " align='right' style='border: #CCCCCC; border-style: solid; border-top-width: 1px; border-right-width: 1px; border-bottom-width: 0px; border-left-width: 1px'><a href='../RTE/default.asp?id=" & dbDados("id") & "&id_cadastro=" & id_cadastro & "&o=produto&t=" & Left(dbDados("descricao"), 75) & "' target='conteudo'>Especificações</a>&nbsp;</td>"
					t = t+1
					dbDados.MoveNext
				  Loop
				  %>
				    <tr bgcolor="#5b97f9">
					  <td height="1" colspan="7" style="border: #CCCCCC; border-style: solid; border-top-width: 1px; border-right-width: 0px; border-bottom-width: 0px; border-left-width: 0px"><span style="font-size: 1px">&nbsp;</span></td>
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
Session("sysoficinasTOTALPRODUTOS") = t
conexao.close
Set dbDados = Nothing
%>