<%@ Language=VBScript %>
<!--#include file="conexao.asp"-->
<!--#include file="rotinas.asp"-->
<%
vID_Cadastro = Request.QueryString("id")
vTipo = Request.QueryString("tp")

vPasta = StrZero(vID_Cadastro, 10)

'obtenho o diretório físico da pasta onde está este script 
nome_pasta = "C:\Inetpub\vhosts\meubairrotem.com\httpdocs\documentos\fotos\" & vPasta
'nome_pasta= "c:\inetpub\wwwroot\meubairrotem\documentos\fotos\" & vPasta

'Conecto com o sistema de arquivos 
set FSO = server.createObject("Scripting.FileSystemObject") 

'crio o objeto pasta 
Set pasta = FSO.GetFolder(nome_pasta) 

'pego os arquivos da pasta 
Set arquivos = pasta.Files 

vExcluirFoto = Request.QueryString("delfoto")
vExcluirPasta = Request.QueryString("delpasta")

If Not vExcluirFoto = "" Then
  Set dbFoto = conexao.execute("select * from fotos where id_cadastro=" & vID_Cadastro & " AND arquivo LIKE '%" & LCase(vExcluirFoto) & "%'")
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
		   
    .textarea1_ {background-color: transparent;
 	            border: 1px solid #ffffff;
				scrollbar-arrow-color: #ffffff;
				scrollbar-3dlight-color: #ffffff;
				scrollbar-darkshadow-color: #ffffff;
				scrollbar-track-color: #ffffff;
				scrollbar-face-color: #ffffff;
				scrollbar-shadow-color: #ffffff;
				scrollbar-highlight-color: #ffffff;
				font-size: 12px;
				color: #ff0000} 

    .textarea2_ {background-color: transparent;
 	            border: 0px solid #efefef;
				scrollbar-arrow-color: #efefef;
				scrollbar-3dlight-color: #efefef;
				scrollbar-darkshadow-color: #efefef;
				scrollbar-track-color: #efefef;
				scrollbar-face-color: #efefef;
				scrollbar-shadow-color: #efefef;
				scrollbar-highlight-color: #efefef;
				font-size: 12px;
				color: #ff0000} 
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
				  <div style="margin-top: 10px; margin-bottom: 10px; background: #ff0000; width: 150px; padding: 5px; font-family: tahoma, arial; font-size: 18px; font-weight:bold"><a href="conteudo.asp?id=<%=vID_Cadastro%>&tp=<%=vTipo%>" style="color: #ffffff">V O L T A R</a></div>
			<span style="font-size: 18pt; color: #000000">Gerenciamento de Fotos</span><br><br>
		    <table border="0" cellspacing="0" cellpadding="0" class="letras_">
			  <tr>
			    <td align="center" class="box1">
                        <form action="salvar_arquivoenviado.asp?id=<%=vID_Cadastro%>&pasta=<%=vPasta%>&bd=fotos&tp=<%=vTipo%>" name="frmEnviarFotos" method="post" enctype="multipart/form-data" onSubmit="return fValidaCad()" style="margin-top: 0px; margin-bottom: 0px">
						<table height="40" border="0" cellspacing="0" cellpadding="0">
                          <tr> 
                            <td valign="middle"> 
                              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style="font-size:14px; color: #ff0000"><B>Enviar nova foto:</b></span> <input type="file" name="foto1" size="40" class="form_file">
                            </td>
                            <td align="center" valign="middle" height="21">
                              &nbsp;&nbsp;<input type="submit" name="enviar" value="Enviar" class="submit_file">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            </td>
                          </tr>
	                    </table>
                        </form>
			    </td>
			  </tr>
			  <tr>
			    <td align="center">&nbsp;</td>
			  </tr>
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
				  for each nome_arquivo in arquivos 
				    If i=1 Then
					  vCor = "#efefef"
					  i=2
					Else
					  vCor = "#ffffff"
					  i=1
					End If

                    vImagem = Replace(UCase(nome_arquivo), UCase(Server.MapPath(".")), ".")
                    vArquivo = Trim(Replace(UCase(vImagem), UCase(nome_pasta & "\"), ""))

                    If InStr(1, vImagem, ".JPG") > 0 Or InStr(1, vImagem, ".GIF") > 0 Or InStr(1, vImagem, ".PNG") > 0 Then 
					  %>
				      <tr><td align="center" bgcolor="<%=vCor%>" class="box"><a href="javascript: fExcluirFotos('<%=vArquivo%>','<%=vPasta%>')"><img src="./images/btn_excluir.gif" border="0" vspace="5" hspace="5"></a></td>
					  <%
				      Response.Write "<td align='center' bgcolor=" & vCor & " class='box'><a name='#imagem'" & t & "></a><a href='#imagem" & t & "' class='grid' onClick='fAmpliarImagem(" & t & ")'>"
					  Response.Write "<img src='" & LCase(Replace(vImagem, "C:\INETPUB\VHOSTS\MEUBAIRROTEM.COM\HTTPDOCS", "..")) & "' width='80' height='60' border='0' vspace='3' hspace='3' id='imagem" & t & "' alt='clique na imagem para ampliar'></a>" & "</td>"
					  Response.Write "<td bgcolor=" & vCor & " style='border: #CCCCCC; border-style: solid; border-top-width: 1px; border-right-width: 1px; border-bottom-width: 0px; border-left-width: 1px'>"
					  
					  Set dbDescricao = conexao.execute("select * from fotos where id_cadastro=" & vID_Cadastro & " AND arquivo LIKE '%" & LCase(vArquivo) & "%'")
					    If dbDescricao.EOF Then
					      conexao.execute("insert into fotos values(" & vID_Cadastro & ",'" & Replace(LCase(vArquivo), LCase(nome_pasta & "\"), "") & "','')")
						  vDescricao = ""
						  vCodigo = vCodigo + 1
					    Else
					      vDescricao = dbDescricao("descricao")
				        End If
					  Set dbDescricao = Nothing
					  
					  If i=1 Then
				        Response.Write "<textarea name='descricao'" & t & " rows='3' cols='50' class='textarea1_'></textarea>"
					  Else
				        Response.Write "<textarea name='descricao'" & t & " rows='3' cols='50' class='textarea2_'></textarea>"
					  End If
					  
					  Response.Write "</td></tr>"
					  t = t + 1
					  r = r + 1
                    End If
                  next 
                  
				  'If Not dbDados("fotos") = t Then
				  '  conexao.execute("update web_galerias set fotos=" & t & " where id=" & id_galeria)
				  'End If
				  
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