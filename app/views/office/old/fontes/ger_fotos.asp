<%@ Language=VBScript %>
<!--#include file="conexao.asp"-->
<!--#include file="rotinas.asp"-->
<%
id_cadastro = Session("sysoficinasUSUARIO")

f_id = Request.QueryString("id")
vTipo = Request.QueryString("tp")

Set dbDados = conexao.execute("select * from produtos where id=" & f_id)
  
f_nome = dbDados("descricao")
f_fotos = dbDados("fotos")
f_foto1 = dbDados("foto1")
f_foto2 = dbDados("foto2")
f_foto3 = dbDados("foto3")
f_foto4 = dbDados("foto4")

vSecao = "GERENCIAMENTO DE FOTOS EM PRODUTOS"
vBotoes = "[1]"

%>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<html>
<head>
	<title>:::: SysControle - Você no Controle :::: </title>
	<script language="Javascript" type="text/javascript">
	function fAtualizarFoto(vThis) {
	alert(vThis.value);
	document.foto1.src = '"' + vThis.value + '"';
	}
	</script>
    <style type="text/css">
    <!--
      @import url(../estilo.css);
    -->
    </style>
</head>

<body style="background-color: #ffffff; margin-top: 0pt; margin-bottom: 0pt; margin-left: 0pt; margin-right: 0pt">
<div align="center">
<a name="#inicio"></a>
<table id="empresa" cellspacing="0" cellpadding="0" border="0" width="80%">
  <tr>
	<td id="descricao" valign="top" bgcolor="#ffffff">
	  <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" class="letras_">
		<tr>
		  <td align="center" valign="top">
		  	<span style="font-size: 28px; color: #666666">GERENCIAMENTO DE FOTOS DOS PRODUTOS</span><br><br>
		    <table border="0" cellspacing="0" cellpadding="0" class="letras_">
			  <tr>
			    <td>Produto:&nbsp;<%=f_nome%></td>
			  </tr>
              <tr> 
                <td colspan="2" align="center" valign="middle" height="21">
				  <table cellspacing="0" cellpadding="5" border="0">
				    <tr>
					  <td style="border: #999999; border-style: solid; border-top-width: 0px; border-left-width: 0px; border-bottom-width: 1px; border-right-width: 1px;">
					    <%If f_foto1 = "" Then%>
						  <img src='../images/sem_imagem.gif' border='0' name="foto1">
						<%Else%>
						  <img src="../documentos/produtos/<%=Session("sysoficinasTBLPRODUTOS")%>/<%=f_foto1%>" border="0" name="foto1">
						<%End If%>
					  </td>
					  <td valign="middle" style="border: #999999; border-style: solid; border-top-width: 0px; border-left-width: 0px; border-bottom-width: 1px; border-right-width: 0px;">
                        <form action="salvar_foto.asp?id=<%=f_id%>&foto=1" name="cadastro" method="post" enctype="multipart/form-data" onSubmit="return fValidaCad()" style="margin-top: 0px; margin-bottom: 0px">
						<table border="0" cellspacing="0" cellpadding="0">
                          <tr> 
                            <td valign="middle"> 
                              <input type="file" size="10" name="foto1" class="form_file">
                            </td>
                            <td align="center" valign="middle" height="21">
                              &nbsp;&nbsp;<input type="submit" name="enviar" value="Enviar" class="submit_file">
                            </td>
                          </tr>
	                    </table>
                        </form>
					  </td>
					</tr>
					<tr>
					  <td style="border: #999999; border-style: solid; border-top-width: 0px; border-left-width: 0px; border-bottom-width: 1px; border-right-width: 1px;">
					    <%If f_foto2 = "" Then%>
						  <img src='../images/sem_imagem.gif' border='0' name="foto2">
						<%Else%>
						  <img src="../documentos/produtos/<%=Session("sysoficinasTBLPRODUTOS")%>/<%=f_foto2%>" border="0" name="foto2">
						<%End If%>
					  </td>
					  <td valign="middle" style="border: #999999; border-style: solid; border-top-width: 0px; border-left-width: 0px; border-bottom-width: 1px; border-right-width: 0px;">
                        <form action="salvar_foto.asp?id=<%=f_id%>&foto=2" name="cadastro" method="post" enctype="multipart/form-data" onSubmit="return fValidaCad()" style="margin-top: 0px; margin-bottom: 0px">
						<table border="0" cellspacing="0" cellpadding="0" align="center" class="letras_">
                          <tr> 
                            <td valign="middle"> 
                              <input type="file" size="10" name="filephoto" class="form_file">
                            </td>
                            <td align="center" valign="middle" height="21">
                              <input type="submit" name="enviar" value="Enviar" class="submit_file">
                            </td>
                          </tr>
	                    </table>
                        </form>
					  </td>
					</tr>
					<tr>
					  <td style="border: #999999; border-style: solid; border-top-width: 0px; border-left-width: 0px; border-bottom-width: 1px; border-right-width: 1px;">
					    <%If f_foto3 = "" Then%>
						  <img src='../images/sem_imagem.gif' border='0' name="foto3">
						<%Else%>
						  <img src="../documentos/produtos/<%=Session("sysoficinasTBLPRODUTOS")%>/<%=f_foto3%>" border="0" name="foto3">
						<%End If%>
					  </td>
					  <td valign="middle" style="border: #999999; border-style: solid; border-top-width: 0px; border-left-width: 0px; border-bottom-width: 1px; border-right-width: 0px;">
                        <form action="salvar_foto.asp?id=<%=f_id%>&foto=3" name="cadastro" method="post" enctype="multipart/form-data" onSubmit="return fValidaCad()" style="margin-top: 0px; margin-bottom: 0px">
						<table border="0" cellspacing="0" cellpadding="0" align="center" class="letras_">
                          <tr> 
                            <td valign="middle"> 
                              <input type="file" size="10" name="filephoto" class="form_file">
                            </td>
                            <td align="center" valign="middle" height="21">
                              <input type="submit" name="enviar" value="Enviar" class="submit_file">
                            </td>
                          </tr>
	                    </table>
                        </form>
					  </td>
					</tr>
					<tr>
					  <td style="border: #999999; border-style: solid; border-top-width: 0px; border-left-width: 0px; border-bottom-width: 1px; border-right-width: 1px;">
					    <%If f_foto4 = "" Then%>
						  <img src='../images/sem_imagem.gif' border='0' name="foto4">
						<%Else%>
						  <img src="../documentos/produtos/<%=Session("sysoficinasTBLPRODUTOS")%>/<%=f_foto4%>" border="0" name="foto4">
						<%End If%>
					  </td>
					  <td valign="middle" style="border: #999999; border-style: solid; border-top-width: 0px; border-left-width: 0px; border-bottom-width: 1px; border-right-width: 0px;">
                        <form action="salvar_foto.asp?id=<%=f_id%>&foto=4" name="cadastro" method="post" enctype="multipart/form-data" onSubmit="return fValidaCad()" style="margin-top: 0px; margin-bottom: 0px">
						<table border="0" cellspacing="0" cellpadding="0" align="center" class="letras_">
                          <tr> 
                            <td valign="middle"> 
                              <input type="file" size="10" name="filephoto" class="form_file">
                            </td>
                            <td align="center" valign="middle" height="21">
                              <input type="submit" name="enviar" value="Enviar" class="submit_file">
                            </td>
                          </tr>
	                    </table>
                        </form>
					  </td>
					</tr>
                  </table>
			    <td>
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
