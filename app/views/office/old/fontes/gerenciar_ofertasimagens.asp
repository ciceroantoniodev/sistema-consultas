<%@ Language=VBScript %>
<!--#include file="conexao.asp"-->
<!--#include file="rotinas.asp"-->
<%
vID = Request.QueryString("id")
vID_Cadastro = Request.QueryString("id_cadastro")
vTipo = Request.QueryString("tp")

vID_Cidade = Request.QueryString("ida")
vID_Bairro = Request.QueryString("idb")
vID_Franquia = Request.QueryString("idf")
vOfertas = Request.QueryString("ofertas")

vPasta = StrZero(vID_Cadastro, 10)

vExcluirFoto = Request.QueryString("delfoto")
vExcluirPasta = Request.QueryString("delpasta")

If Not vExcluirFoto = "" Then
  set FSO = server.createObject("Scripting.FileSystemObject") 
  nome_pasta = "C:\Inetpub\vhosts\meubairrotem.com\httpdocs\documentos\fotos\produtos"
  
  Set dbFoto = conexao.execute("select * from cadastro_ofertas where id_cadastro=" & vID_Cadastro & " AND arquivo LIKE '%" & LCase(vExcluirFoto) & "%'")
    If Not dbFoto.EOF Then
      conexao.execute("delete from fotos where id_cadastro=" & vID_Cadastro & " AND arquivo LIKE '%" & LCase(vExcluirFoto) & "%'")
	End If
  Set dbFoto = Nothing
  
  FSO.DeleteFile(nome_pasta & "\" & vExcluirFoto)
End If
%>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<html>
<head>
	<title>.....:: MEU BAIRRO TEM - Área Restrita ::.....</title>
	<script language="Javascript" src="funcoes.js" type="text/javascript"></script>
	<script language="Javascript" type="text/javascript">
	function fAmpliarImagem(n) {
	vImagem = "imagem" + n;
	vLargura = document.getElementById(vImagem).width;

	if (vLargura < 300) {
	  document.getElementById(vImagem).style.width = 300;
	  document.getElementById(vImagem).style.height = 225;
	} else {
	  document.getElementById(vImagem).style.width = 80;
	  document.getElementById(vImagem).style.height = 60;
	}
	}
	
	function fExcluirFotos(vffoto, vfpasta) {
	window.location.href = "gerenciar_fotos.asp?id=<%=vID_Cadastro%>&delfoto=" + vffoto + "&delpasta=" + vfpasta;
	}
	</script>
    <style type="text/css">
    <!--
      @import url(../estilo.css);
    -->
	.box  {border: #CCCCCC;
	           border-style: solid;
           border-top-width: 1px;
           border-right-width: 0px;
           border-bottom-width: 0px;
           border-left-width: 1px}
    </style>
</head>

<body style='background: url(./images/ground_framework.gif) repeat-x fixed; margin-top: 0pt; margin-bottom: 0pt; margin-left: 0pt; margin-right: 0pt'>
<iframe src="excluir.asp" name="excluir" align="middle" frameborder="0" width="1" height="1"></iframe>
<div align="center">
<a name="#inicio"></a>
<table id="empresa" cellspacing="0" cellpadding="0" border="0" width="80%" class="letras_">
  <tr>
	<td align="center" id="descricao" valign="top">
		<tr>
		  <td align="center" valign="top">
				  <div style="margin-top: 10px; margin-bottom: 10px; background: #ff0000; width: 150px; padding: 5px; font-family: tahoma, arial; font-size: 18px; font-weight:bold"><a href="gerenciar_ofertas.asp?id=<%=vID_Cadastro%>&tp=<%=vTipo%>&ida=<%=vID_Cidade%>&idb=<%=vID_Bairro%>&idf=<%=vID_Franquia%>&ofertas=<%=vOfertas%>" style="color: #ffffff">V O L T A R</a></div>
			<span style="font-size: 18pt; color: #000000">Gerenciamento de Imagens em Ofertas</span><br><br>
		    <table border="0" cellspacing="0" cellpadding="0" class="letras_">
			  <tr>
			    <td align="center">
				  <table width="100%" border="0" cellspacing="0" cellpadding="0" class="letras_">
				    <tr height="30" bgcolor="#666666" style="font-size: 14px;color: #ffffff">
					  <td width="60" align="center"><font color="#ffffff">&nbsp;Excluir&nbsp;</font></td>
					  <td align="center" class="box4"><font color="#ffffff">Foto</font></td>
					  <td align="center" class="box4"><font color="#ffffff">Descrição</font></td>
					</tr>
				  <%
				  i=1
                  t=0
				  r=1
				  Dim aFotos(5)
				  
				  Set dbDados = conexao.execute("select * from cadastro_ofertas where id=" & vID)
				    If Not dbDados.EOF Then
					  aFotos(0) = dbDados("imagem")
					  aFotos(1) = dbDados("foto1")
					  aFotos(2) = dbDados("foto2")
					  aFotos(3) = dbDados("foto3")
					  aFotos(4) = dbDados("foto4")
					Else
					  aFotos(0) = ""
					  aFotos(1) = ""
					  aFotos(2) = ""
					  aFotos(3) = ""
					  aFotos(4) = ""
					End If
				  Set dbDados = Nothing
				  
				  'Imagem de destaque
				    Response.Write "<tr>"
				    Response.Write "  <td align=""center"" bgcolor=""#efefef"" class=""box"">"
                    If (InStr(1, UCase(aFotos(0)), ".JPG") > 0) Or (InStr(1, UCase(aFotos(0)), ".GIF") > 0) Or (InStr(1, UCase(aFotos(0)), ".PNG") > 0) Then 
				      Response.Write "  <a href=""javascript: fExcluirFotos('" & aFotos(0) & "','" & vPasta & "')""><img src=""./images/btn_excluir.gif"" border=""0"" vspace=""5"" hspace=""5""></a>"
					Else
				      Response.Write "  &nbsp;"
					End If
				    Response.Write "  </td>"
				    Response.Write "  <td align='center' bgcolor='#efefef' class='box'>"
                    If (InStr(1, UCase(aFotos(0)), ".JPG") > 0) Or (InStr(1, UCase(aFotos(0)), ".GIF") > 0) Or (InStr(1, UCase(aFotos(0)), ".PNG") > 0) Then 
				      Response.Write "  <a name='#imagem1'></a><a href='#imagem1' class='grid' onClick='fAmpliarImagem(1)'>"
					  Response.Write "  <img src='../documentos/ofertas/" & aFotos(0) & "' width='80' height='60' border='0' vspace='3' hspace='3' id='imagem1' alt='clique na imagem para ampliar'></a>"
					Else
					  Response.Write "  <img src='../images/sem_imagem.gif' width='80' border='0' vspace='3' hspace='3' id='imagem1'>"
					End If
					Response.Write "  </td>"
					Response.Write "  <td bgcolor='#efefef' style='border: #CCCCCC; border-style: solid; border-top-width: 1px; border-right-width: 1px; border-bottom-width: 0px; border-left-width: 1px'>"
                    Response.Write "    <Form action=""salvar_ofertasimagens.asp?id=" & vID & "&foto=0&ida=" & vID_Cidade & "&idb=" & vID_Bairro & "&idf=" & vID_Franquia & "&ofertas=" & vOfertas & "&tp=" & vTipo & """ name=""frmEnviarImagens"" method=""post"" enctype=""multipart/form-data"" style=""margin-top: 0px; margin-bottom: 0px"">"
					Response.Write "	<table height=""40"" border=""0"" cellspacing=""0"" cellpadding=""0"">"
                    Response.Write "      <tr> "
                    Response.Write "        <td valign=""middle""><input type=""file"" name=""foto1"" size=""40"" class=""form_file""></td>"
                    Response.Write "        <td align=""center"" valign=""middle"" height=""21"">"
                    Response.Write "          &nbsp;&nbsp;<input type=""submit"" name=""enviar"" value=""Enviar"" class=""submit_file"">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
                    Response.Write "        </td>"
                    Response.Write "      </tr>"
	                Response.Write "    </table>"
                    Response.Write "    </form>"
				    Response.Write "  </td>"
				    Response.Write "</tr>"
					
				  'Imagem 1
				    Response.Write "<tr>"
				    Response.Write "  <td align=""center"" bgcolor=""#efefef"" class=""box"">"
                    If (InStr(1, UCase(aFotos(1)), ".JPG") > 0) Or (InStr(1, UCase(aFotos(1)), ".GIF") > 0) Or (InStr(1, UCase(aFotos(1)), ".PNG") > 0) Then 
				      Response.Write "  <a href=""javascript: fExcluirFotos('" & aFotos(1) & "','" & vPasta & "')""><img src=""./images/btn_excluir.gif"" border=""0"" vspace=""5"" hspace=""5""></a>"
					Else
				      Response.Write "  &nbsp;"
					End If
				    Response.Write "  </td>"
				    Response.Write "  <td align='center' bgcolor='#efefef' class='box'>"
                    If (InStr(1, UCase(aFotos(1)), ".JPG") > 0) Or (InStr(1, UCase(aFotos(1)), ".GIF") > 0) Or (InStr(1, UCase(aFotos(1)), ".PNG") > 0) Then 
				      Response.Write "  <a name='#Imagem2'></a><a href='#Imagem2' class='grid' onClick='fAmpliarImagem(1)'>"
					  Response.Write "  <img src='../documentos/fotos/produtos/" & aFotos(1) & "' width='80' height='60' border='0' vspace='3' hspace='3' id='Imagem2' alt='clique na imagem para ampliar'></a>"
					Else
					  Response.Write "  <img src='../images/sem_imagem.gif' width='80' border='0' vspace='3' hspace='3' id='Imagem2'>"
					End If
					Response.Write "  </td>"
					Response.Write "  <td bgcolor='#efefef' style='border: #CCCCCC; border-style: solid; border-top-width: 1px; border-right-width: 1px; border-bottom-width: 0px; border-left-width: 1px'>"
                    Response.Write "    <Form action=""salvar_ofertasimagens.asp?id=" & vID & "&foto=1&ida=" & vID_Cidade & "&idb=" & vID_Bairro & "&idf=" & vID_Franquia & "&ofertas=" & vOfertas & "&tp=" & vTipo & """ name=""frmEnviarImagens"" method=""post"" enctype=""multipart/form-data"" style=""margin-top: 0px; margin-bottom: 0px"">"
					Response.Write "	<table height=""40"" border=""0"" cellspacing=""0"" cellpadding=""0"">"
                    Response.Write "      <tr> "
                    Response.Write "        <td valign=""middle""><input type=""file"" name=""foto2"" size=""40"" class=""form_file""></td>"
                    Response.Write "        <td align=""center"" valign=""middle"" height=""21"">"
                    Response.Write "          &nbsp;&nbsp;<input type=""submit"" name=""enviar"" value=""Enviar"" class=""submit_file"">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
                    Response.Write "        </td>"
                    Response.Write "      </tr>"
	                Response.Write "    </table>"
                    Response.Write "    </form>"
				    Response.Write "  </td>"
				    Response.Write "</tr>"
					
				  'Imagem 2
				    Response.Write "<tr>"
				    Response.Write "  <td align=""center"" bgcolor=""#efefef"" class=""box"">"
                    If (InStr(1, UCase(aFotos(2)), ".JPG") > 0) Or (InStr(1, UCase(aFotos(2)), ".GIF") > 0) Or (InStr(1, UCase(aFotos(2)), ".PNG") > 0) Then 
				      Response.Write "  <a href=""javascript: fExcluirFotos('" & aFotos(2) & "','" & vPasta & "')""><img src=""./images/btn_excluir.gif"" border=""0"" vspace=""5"" hspace=""5""></a>"
					Else
				      Response.Write "  &nbsp;"
					End If
				    Response.Write "  </td>"
				    Response.Write "  <td align='center' bgcolor='#efefef' class='box'>"
                    If (InStr(1, UCase(aFotos(2)), ".JPG") > 0) Or (InStr(1, UCase(aFotos(2)), ".GIF") > 0) Or (InStr(1, UCase(aFotos(2)), ".PNG") > 0) Then 
				      Response.Write "  <a name='#Imagem3'></a><a href='#Imagem3' class='grid' onClick='fAmpliarImagem(1)'>"
					  Response.Write "  <img src='../documentos/fotos/produtos/" & aFotos(2) & "' width='80' height='60' border='0' vspace='3' hspace='3' id='Imagem3' alt='clique na imagem para ampliar'></a>"
					Else
					  Response.Write "  <img src='../images/sem_imagem.gif' width='80' border='0' vspace='3' hspace='3' id='Imagem3'>"
					End If
					Response.Write "  </td>"
					Response.Write "  <td bgcolor='#efefef' style='border: #CCCCCC; border-style: solid; border-top-width: 1px; border-right-width: 1px; border-bottom-width: 0px; border-left-width: 1px'>"
                    Response.Write "    <Form action=""salvar_ofertasimagens.asp?id=" & vID & "&foto=2&ida=" & vID_Cidade & "&idb=" & vID_Bairro & "&idf=" & vID_Franquia & "&ofertas=" & vOfertas & "&tp=" & vTipo & """ name=""frmEnviarImagens"" method=""post"" enctype=""multipart/form-data"" style=""margin-top: 0px; margin-bottom: 0px"">"
					Response.Write "	<table height=""40"" border=""0"" cellspacing=""0"" cellpadding=""0"">"
                    Response.Write "      <tr> "
                    Response.Write "        <td valign=""middle""><input type=""file"" name=""foto3"" size=""40"" class=""form_file""></td>"
                    Response.Write "        <td align=""center"" valign=""middle"" height=""21"">"
                    Response.Write "          &nbsp;&nbsp;<input type=""submit"" name=""enviar"" value=""Enviar"" class=""submit_file"">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
                    Response.Write "        </td>"
                    Response.Write "      </tr>"
	                Response.Write "    </table>"
                    Response.Write "    </form>"
				    Response.Write "  </td>"
				    Response.Write "</tr>"
					
				  'Imagem 3
				    Response.Write "<tr>"
				    Response.Write "  <td align=""center"" bgcolor=""#efefef"" class=""box"">"
                    If (InStr(1, UCase(aFotos(3)), ".JPG") > 0) Or (InStr(1, UCase(aFotos(3)), ".GIF") > 0) Or (InStr(1, UCase(aFotos(3)), ".PNG") > 0) Then 
				      Response.Write "  <a href=""javascript: fExcluirFotos('" & aFotos(3) & "','" & vPasta & "')""><img src=""./images/btn_excluir.gif"" border=""0"" vspace=""5"" hspace=""5""></a>"
					Else
				      Response.Write "  &nbsp;"
					End If
				    Response.Write "  </td>"
				    Response.Write "  <td align='center' bgcolor='#efefef' class='box'>"
                    If (InStr(1, UCase(aFotos(3)), ".JPG") > 0) Or (InStr(1, UCase(aFotos(3)), ".GIF") > 0) Or (InStr(1, UCase(aFotos(3)), ".PNG") > 0) Then 
				      Response.Write "  <a name='#Imagem4'></a><a href='#Imagem4' class='grid' onClick='fAmpliarImagem(1)'>"
					  Response.Write "  <img src='../documentos/fotos/produtos/" & aFotos(3) & "' width='80' height='60' border='0' vspace='3' hspace='3' id='Imagem4' alt='clique na imagem para ampliar'></a>"
					Else
					  Response.Write "  <img src='../images/sem_imagem.gif' width='80' border='0' vspace='3' hspace='3' id='Imagem4'>"
					End If
					Response.Write "  </td>"
					Response.Write "  <td bgcolor='#efefef' style='border: #CCCCCC; border-style: solid; border-top-width: 1px; border-right-width: 1px; border-bottom-width: 0px; border-left-width: 1px'>"
                    Response.Write "    <Form action=""salvar_ofertasimagens.asp?id=" & vID & "&foto=3&ida=" & vID_Cidade & "&idb=" & vID_Bairro & "&idf=" & vID_Franquia & "&ofertas=" & vOfertas & "&tp=" & vTipo & """ name=""frmEnviarImagens"" method=""post"" enctype=""multipart/form-data"" style=""margin-top: 0px; margin-bottom: 0px"">"
					Response.Write "	<table height=""40"" border=""0"" cellspacing=""0"" cellpadding=""0"">"
                    Response.Write "      <tr> "
                    Response.Write "        <td valign=""middle""><input type=""file"" name=""foto4"" size=""40"" class=""form_file""></td>"
                    Response.Write "        <td align=""center"" valign=""middle"" height=""21"">"
                    Response.Write "          &nbsp;&nbsp;<input type=""submit"" name=""enviar"" value=""Enviar"" class=""submit_file"">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
                    Response.Write "        </td>"
                    Response.Write "      </tr>"
	                Response.Write "    </table>"
                    Response.Write "    </form>"
				    Response.Write "  </td>"
				    Response.Write "</tr>"
					
				  'Imagem 4
				    Response.Write "<tr>"
				    Response.Write "  <td align=""center"" bgcolor=""#efefef"" class=""box"">"
                    If (InStr(1, UCase(aFotos(4)), ".JPG") > 0) Or (InStr(1, UCase(aFotos(4)), ".GIF") > 0) Or (InStr(1, UCase(aFotos(4)), ".PNG") > 0) Then 
				      Response.Write "  <a href=""javascript: fExcluirFotos('" & aFotos(4) & "','" & vPasta & "')""><img src=""./images/btn_excluir.gif"" border=""0"" vspace=""5"" hspace=""5""></a>"
					Else
				      Response.Write "  &nbsp;"
					End If
				    Response.Write "  </td>"
				    Response.Write "  <td align='center' bgcolor='#efefef' class='box'>"
                    If (InStr(1, UCase(aFotos(4)), ".JPG") > 0) Or (InStr(1, UCase(aFotos(4)), ".GIF") > 0) Or (InStr(1, UCase(aFotos(4)), ".PNG") > 0) Then 
				      Response.Write "  <a name='#Imagem5'></a><a href='#Imagem5' class='grid' onClick='fAmpliarImagem(1)'>"
					  Response.Write "  <img src='../documentos/fotos/produtos/" & aFotos(4) & "' width='80' height='60' border='0' vspace='3' hspace='3' id='Imagem5' alt='clique na imagem para ampliar'></a>"
					Else
					  Response.Write "  <img src='../images/sem_imagem.gif' width='80' border='0' vspace='3' hspace='3' id='Imagem5'>"
					End If
					Response.Write "  </td>"
					Response.Write "  <td bgcolor='#efefef' style='border: #CCCCCC; border-style: solid; border-top-width: 1px; border-right-width: 1px; border-bottom-width: 0px; border-left-width: 1px'>"
                    Response.Write "    <Form action=""salvar_ofertasimagens.asp?id=" & vID & "&foto=4&ida=" & vID_Cidade & "&idb=" & vID_Bairro & "&idf=" & vID_Franquia & "&ofertas=" & vOfertas & "&tp=" & vTipo & """ name=""frmEnviarImagens"" method=""post"" enctype=""multipart/form-data"" style=""margin-top: 0px; margin-bottom: 0px"">"
					Response.Write "	<table height=""40"" border=""0"" cellspacing=""0"" cellpadding=""0"">"
                    Response.Write "      <tr> "
                    Response.Write "        <td valign=""middle""><input type=""file"" name=""foto5"" size=""40"" class=""form_file""></td>"
                    Response.Write "        <td align=""center"" valign=""middle"" height=""21"">"
                    Response.Write "          &nbsp;&nbsp;<input type=""submit"" name=""enviar"" value=""Enviar"" class=""submit_file"">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
                    Response.Write "        </td>"
                    Response.Write "      </tr>"
	                Response.Write "    </table>"
                    Response.Write "    </form>"
				    Response.Write "  </td>"
				    Response.Write "</tr>"
				  %>
				    <tr bgcolor="#666666">
					  <td height="1" colspan="4" style="border: #dddddd; border-style: solid; border-top-width: 1px; border-right-width: 0px; border-bottom-width: 0px; border-left-width: 0px"><span style="font-size: 1px">&nbsp;</span></td>
					</tr>
				  </table>
				</td>
			  </tr>
			</table>
		  </td>
		</tr>
	  </table>
	</td>
  </tr>
</table>
</div>
</body>
</html>
<%
conexao.close
Set dbDados = Nothing
%>