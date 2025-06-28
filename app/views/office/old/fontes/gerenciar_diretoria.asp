<%@ Language=VBScript %>
<!--#include file="conexao.asp"-->
<!--#include file="rotinas.asp"-->
<%
vID_Cadastro = Request.QueryString("id")

Set dbDados = conexao.execute("select * from cadastro_diretoria where id_associacao=" & vID_Cadastro & " order by nome")
%>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<html>
<head>
	<title>.....:: MEU BAIRRO TEM - Área Restrita ::.....</title>
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
<table id="empresa" cellspacing="0" cellpadding="0" border="0">
  <tr>
	<td align="center" id="descricao" valign="top" bgcolor="#ffffff">
		<BR><div style="margin-top: 10px; margin-bottom: 10px; background: #ff0000; width: 150px; padding: 5px; font-family: tahoma, arial; font-size: 18px; font-weight:bold"><a href="conteudo.asp?id=<%=vID_Cadastro%>&tp=2" style="color: #ffffff">V O L T A R</a></div>	  <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" class="letras_">
	  <form action="form_dados.asp" method="post" name="form_excluir">
	  <table border="0" width="100%" cellspacing="0" cellpadding="0" align="center" class="letras_">
		<tr>
		  <td align="center" valign="top">
		  		    <span style="font-size: 28px; color: #666666">DIRETORIA DA ASSOCIAÇÃO</span><br><br>
			<table border="0" cellspacing="0" cellpadding="0" style="color:#FFE8E8; font-weight: bold; font-family: tahoma, arial; font-size: 12px">
			  <tr height="20">
			    <td bgcolor="#F40000" width="150" align="center" class="menuTOP"><%Response.Write "<a href='cad_membro.asp?id=" & vID_Cadastro & "&ida=" & vID_Cadastro & "&acao=2' class='linkar'>"%>Novo Membro</a></td>
			  </tr>
			  <tr height="3">
			    <td width="150" height="3" class="menuBOTTOM"><span style="font-size: 1px">&nbsp;</span></td>
			  </tr>
			</table><br>
		    <table border="0" width="100%" cellspacing="0" cellpadding="0" class="letras_">
			  <tr>
			    <td align="center">
				  <table border="0" cellspacing="0" cellpadding="0" class="letras_">
				    <tr height="25" bgcolor="#666666">
					  <td align="center"><font color="#ffffff">&nbsp;Código&nbsp;</font></td>
					  <td align="center" class="box4"><font color="#ffffff">Nome do Membro</font></td>
					  <td align="center" class="box4"><font color="#ffffff">Cargo</font></td>
					  <td align="center" class="box4"><font color="#ffffff">Profissão</font></td>
					  <td align="center" class="box4"><font color="#ffffff">Foto</font></td>
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
				    Response.Write "<tr><td bgcolor=" & vCor & " class='box' align='center'><a href='cad_membro.asp?id=" & dbDados("id") & "&ida=" & vID_Cadastro & "&acao=1'>" & dbDados("id") & "</a>&nbsp;</td>"
				    Response.Write "<td align='left' bgcolor=" & vCor & " class='box'>&nbsp;&nbsp;<a href='cad_membro.asp?id=" & dbDados("id") & "&ida=" & vID_Cadastro & "&acao=1'>" & dbDados("nome") & "</a>&nbsp;</td>"
				    Response.Write "<td align='left' bgcolor=" & vCor & " class='box'>&nbsp;&nbsp;<a href='cad_membro.asp?id=" & dbDados("id") & "&ida=" & vID_Cadastro & "&acao=1'>" & dbDados("cargo") & "</a>&nbsp;</td>"
				    Response.Write "<td align='left' bgcolor=" & vCor & " class='box'>&nbsp;&nbsp;<a href='cad_membro.asp?id=" & dbDados("id") & "&ida=" & vID_Cadastro & "&acao=1'>" & dbDados("profissao") & "</a>&nbsp;</td>"
					If (InStr(1, UCase(dbDados("foto")), ".JPG") > 0) Or (InStr(1, UCase(dbDados("foto")), ".PNG") > 0) Or (InStr(1, UCase(dbDados("foto")), ".GIF") > 0) Then
					  vFoto = "../documentos/fotos/diretoria/" & StrZero(vID_Cadastro, 10) & "/" & dbDados("foto")
					ELse
					  vFoto = "../images/sem_foto.gif"
					End If
				    Response.Write "<td bgcolor=" & vCor & " align='center' style='border: #CCCCCC; border-style: solid; border-top-width: 1px; border-right-width: 1px; border-bottom-width: 0px; border-left-width: 1px'>&nbsp;<a href='ger_fotosdestaque.asp?id=" & dbDados("id") & "&ida=" & vID_Cadastro & "&o=diretoria&pasta=documentos\fotos\diretoria\" & StrZero(vID_Cadastro, 10) & "' class='grid'><img src='" & vFoto & "' width='60' border='0' vspace='3' hspace='3'></a>&nbsp;</td>"
					t = t+1
					dbDados.MoveNext
				  Loop
				  %>
				    <tr bgcolor="#666666">
					  <td height="1" colspan="7" style="border: #666666; border-style: solid; border-top-width: 1px; border-right-width: 0px; border-bottom-width: 0px; border-left-width: 0px"><span style="font-size: 1px">&nbsp;</span></td>
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