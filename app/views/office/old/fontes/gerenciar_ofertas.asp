<%@ Language=VBScript %>
<!--#include file="conexao.asp"-->
<%
vID_Cadastro = Request.QueryString("id")
vID_Cidade = Request.QueryString("ida")
vID_Bairro = Request.QueryString("idb")
vID_Franquia = Request.QueryString("idf")
vOfertas = Request.QueryString("ofertas")
vTipo = Request.QueryString("tp")

Set dbDados = conexao.execute("select * from cadastro_ofertas where id_cadastro=" & vID_Cadastro & " order by id")

If dbDados.BOF And dbDados.EOF Then
  vID = 0
Else
  vID = dbDados("id")
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
		    <span style="font-size: 28px; color: #666666">GERENCIAR OFERTAS</span><br><br>
		    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="letras_">
			  <tr>
			    <td align="center">
				  <table width="100%" border="0" cellspacing="0" cellpadding="0" class="letras_">
				    <tr height="25" bgcolor="#999999">
					  <td align="center"><font color="#ffffff">&nbsp;Ordem&nbsp;</font></td>
					  <td align="center" class="td_div"><font color="#ffffff">Descrição</font></td>
					  <td align="center" class="td_div"><font color="#ffffff">&nbsp;&nbsp;Visualizações&nbsp;&nbsp;</font></td>
					  <td align="center" class="td_div"><font color="#ffffff">&nbsp;&nbsp;Cliques&nbsp;&nbsp;</font></td>
					  <td align="center" class="td_div"><font color="#ffffff">&nbsp;Imagens&nbsp;</font></td>
					  <td align="center" class="td_div"><font color="#ffffff">&nbsp;Excluir&nbsp;</font></td>
					</tr>
				  <%
				  If (Not dbDados.BOF) And (Not dbDados.EOF) Then
				    i=1
					o=1
				    Do While Not dbDados.EOF
				      If i=1 Then
					    vCor = "#efefef"
					    i=2
					  Else
					    vCor = "#ffffff"
					    i=1
					  End If
				      Response.Write "<tr height='40'><td align='center' bgcolor=" & vCor & " class='box'><a href='cad_ofertas.asp?id=" & dbDados("id") & "&id_cadastro=" & vID_Cadastro & "&ida=" & vID_Cidade & "&idb=" & vID_Bairro & "&idf=" & vID_Franquia & "&ofertas=" & vOfertas & "&o=change' class='grid'>" & o & "</a>&nbsp;</td>"
				      Response.Write "<td bgcolor=" & vCor & " class='box'><a href='cad_ofertas.asp?id=" & dbDados("id") & "&id_cadastro=" & vID_Cadastro & "&ida=" & vID_Cidade & "&idb=" & vID_Bairro & "&idf=" & vID_Franquia & "&ofertas=" & vOfertas & "&o=change' class='grid'>" & dbDados("descricao") & "</a>&nbsp;</td>"
				      Response.Write "<td align='center' bgcolor=" & vCor & " class='box'><a href='cad_ofertas.asp?id=" & dbDados("id") & "&id_cadastro=" & vID_Cadastro & "&ida=" & vID_Cidade & "&idb=" & vID_Bairro & "&idf=" & vID_Franquia & "&ofertas=" & vOfertas & "&o=change' class='grid'>" & dbDados("visualizacoes") & "</a>&nbsp;</td>"
				      Response.Write "<td align='center' bgcolor=" & vCor & " class='box'><a href='cad_ofertas.asp?id=" & dbDados("id") & "&id_cadastro=" & vID_Cadastro & "&ida=" & vID_Cidade & "&idb=" & vID_Bairro & "&idf=" & vID_Franquia & "&ofertas=" & vOfertas & "&o=change' class='grid'>" & dbDados("cliques") & "</a>&nbsp;</td>"
				      Response.Write "<td align='center' bgcolor=" & vCor & " class='box'><a href='gerenciar_ofertasimagens.asp?id=" & dbDados("id") & "&id_cadastro=" & vID_Cadastro & "&ida=" & vID_Cidade & "&idb=" & vID_Bairro & "&idf=" & vID_Franquia & "&ofertas=" & vOfertas & "&tp=" & vTipo & "' class='grid'>"
                      
					  If InStr(1, UCase(dbDados("imagem")), ".JPG") > 0 Or InStr(1, UCase(dbDados("imagem")), ".GIF") > 0 Or InStr(1, UCase(dbDados("imagem")), ".PNG") > 0 Then 
					    Response.Write "<img src='../documentos/ofertas/"
					    Response.Write dbDados("imagem")
					    Response.Write "' width='50' border='0'>"
					  Else
					    Response.Write "<i>definir</i>"
					  End If
					  
				      Response.Write "</a>&nbsp;</td>"
					  Response.Write "<td align='center' bgcolor=" & vCor & " style='border: #CCCCCC; border-style: solid; border-top-width: 1px; border-right-width: 1px; border-bottom-width: 0px; border-left-width: 1px'><a href='cad_ofertas.asp?id=" & dbDados("id") & "&id_cadastro=" & vID_Cadastro & "&ida=" & vID_Cidade & "&idb=" & vID_Bairro & "&idf=" & vID_Franquia & "&ofertas=" & vOfertas & "&o=change' class='grid'>"
					  Response.Write "<img src=""./images/btn_excluir.gif"" border=""0"" vspace=""5"" hspace=""5"">"
					  Response.Write "</a>&nbsp;</td></tr>"
					  o = o + 1
					  dbDados.MoveNext
				    Loop
					If o <= CInt(vOfertas) Then
				      Do While o <= CInt(vOfertas)
				        If i=1 Then
					      vCor = "#efefef"
					      i=2
					    Else
					      vCor = "#ffffff"
					      i=1
					    End If
				        Response.Write "<tr height='40'><td align='center' bgcolor=" & vCor & " class='box'><a href='cad_ofertas.asp?id_cadastro=" & vID_Cadastro & "&ida=" & vID_Cidade & "&idb=" & vID_Bairro & "&idf=" & vID_Franquia & "&ofertas=" & vOfertas & "&o=new' class='grid'>" & o & "</a>&nbsp;</td>"
				        Response.Write "<td bgcolor=" & vCor & " class='box'><a href='cad_ofertas.asp?id_cadastro=" & vID_Cadastro & "&ida=" & vID_Cidade & "&idb=" & vID_Bairro & "&idf=" & vID_Franquia & "&ofertas=" & vOfertas & "&o=new' class='grid'><b>NOVA OFERTA</b></a>&nbsp;</td>"
				        Response.Write "<td align='center' bgcolor=" & vCor & " class='box'><a href='cad_ofertas.asp?id_cadastro=" & vID_Cadastro & "&ida=" & vID_Cidade & "&idb=" & vID_Bairro & "&idf=" & vID_Franquia & "&ofertas=" & vOfertas & "&o=new' class='grid'>0</a>&nbsp;</td>"
				        Response.Write "<td align='center' bgcolor=" & vCor & " class='box'><a href='cad_ofertas.asp?id_cadastro=" & vID_Cadastro & "&ida=" & vID_Cidade & "&idb=" & vID_Bairro & "&idf=" & vID_Franquia & "&ofertas=" & vOfertas & "&o=new' class='grid'>0</a>&nbsp;</td>"
				        Response.Write "<td align='center' bgcolor=" & vCor & " class='box'><a href='cad_ofertas.asp?id_cadastro=" & vID_Cadastro & "&ida=" & vID_Cidade & "&idb=" & vID_Bairro & "&idf=" & vID_Franquia & "&ofertas=" & vOfertas & "&o=new' class='grid'>&nbsp;</a>&nbsp;</td>"
					    Response.Write "<td align='center' bgcolor=" & vCor & " style='border: #CCCCCC; border-style: solid; border-top-width: 1px; border-right-width: 1px; border-bottom-width: 0px; border-left-width: 1px'><a href='cad_ofertas.asp?id_cadastro=" & vID_Cadastro & "&ida=" & vID_Cidade & "&idb=" & vID_Bairro & "&idf=" & vID_Franquia & "&ofertas=" & vOfertas & "&o=new' class='grid'>"
					    Response.Write ""
					    Response.Write "</a>&nbsp;</td></tr>"
					    o = o + 1
				      Loop
					End If
				  Else
				    i=1
					o=1
				    Do While o <= CInt(vOfertas)
				      If i=1 Then
					    vCor = "#efefef"
					    i=2
					  Else
					    vCor = "#ffffff"
					    i=1
					  End If
				      Response.Write "<tr height='40'><td align='center' bgcolor=" & vCor & " class='box'><a href='cad_ofertas.asp?id_cadastro=" & vID_Cadastro & "&ida=" & vID_Cidade & "&idb=" & vID_Bairro & "&idf=" & vID_Franquia & "&ofertas=" & vOfertas & "&o=new' class='grid'>" & o & "</a>&nbsp;</td>"
				      Response.Write "<td bgcolor=" & vCor & " class='box'><a href='cad_ofertas.asp?id_cadastro=" & vID_Cadastro & "&ida=" & vID_Cidade & "&idb=" & vID_Bairro & "&idf=" & vID_Franquia & "&ofertas=" & vOfertas & "&o=new' class='grid'><b>NOVA OFERTA</b></a>&nbsp;</td>"
				      Response.Write "<td align='center' bgcolor=" & vCor & " class='box'><a href='cad_ofertas.asp?id_cadastro=" & vID_Cadastro & "&ida=" & vID_Cidade & "&idb=" & vID_Bairro & "&idf=" & vID_Franquia & "&ofertas=" & vOfertas & "&o=new' class='grid'>0</a>&nbsp;</td>"
				      Response.Write "<td align='center' bgcolor=" & vCor & " class='box'><a href='cad_ofertas.asp?id_cadastro=" & vID_Cadastro & "&ida=" & vID_Cidade & "&idb=" & vID_Bairro & "&idf=" & vID_Franquia & "&ofertas=" & vOfertas & "&o=new' class='grid'>0</a>&nbsp;</td>"
				      Response.Write "<td align='center' bgcolor=" & vCor & " class='box'><a href='cad_ofertas.asp?id_cadastro=" & vID_Cadastro & "&ida=" & vID_Cidade & "&idb=" & vID_Bairro & "&idf=" & vID_Franquia & "&ofertas=" & vOfertas & "&o=new' class='grid'>&nbsp;</a>&nbsp;</td>"
					  Response.Write "<td align='center' bgcolor=" & vCor & " style='border: #CCCCCC; border-style: solid; border-top-width: 1px; border-right-width: 1px; border-bottom-width: 0px; border-left-width: 1px'><a href='cad_ofertas.asp?id_cadastro=" & vID_Cadastro & "&ida=" & vID_Cidade & "&idb=" & vID_Bairro & "&idf=" & vID_Franquia & "&ofertas=" & vOfertas & "&o=new' class='grid'>"
					  Response.Write ""
					  Response.Write "</a>&nbsp;</td></tr>"
					  o = o + 1
				    Loop
				  End If
				  %>
				    <tr bgcolor="#999999">
					  <td height="1" colspan="6" style="border: #999999; border-style: solid; border-top-width: 1px; border-right-width: 0px; border-bottom-width: 0px; border-left-width: 0px"><span style="font-size: 1px">&nbsp;</span></td>
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