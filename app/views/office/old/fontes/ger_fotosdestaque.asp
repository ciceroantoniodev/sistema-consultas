<%@ Language=VBScript %>
<!--#include file="conexao.asp"-->
<!--#include file="rotinas.asp"-->
<%
vID = Request.QueryString("id")
vID_Cadastro = Request.QueryString("ida")
vOrigem = Request.QueryString("o")
'vPasta = Server.MapPath("..") & "\" & 

vPasta = "C:\Inetpub\vhosts\meubairrotem.com\httpdocs\" & Request.QueryString("pasta")


If vOrigem = "diretoria" Then
  vSecao = "DEFINIÇÃO DA FOTO DO MEMBRO"
  vTxtCampo = "Nome do Membro:"
  
  Set dbDados = conexao.execute("select * from cadastro_diretoria where id=" & vID)  
    vNome = dbDados("nome")
	vFoto = dbDados("foto")
  Set dbDados = Nothing
  
End If

'response.write "[" & vPasta & "\" & vFoto & "]"

 
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

<body style="background: url(./images/ground_framework.gif) repeat-x fixed; margin-top: 0pt; margin-bottom: 0pt; margin-left: 0pt; margin-right: 0pt">
<div align="center">
<a name="#inicio"></a>
<table id="empresa" cellspacing="0" cellpadding="0" border="0" width="80%">
  <tr>
	<td align="center" id="descricao" valign="top">
		<BR><div style="margin-top: 10px; margin-bottom: 10px; background: #ff0000; width: 150px; padding: 5px; font-family: tahoma, arial; font-size: 18px; font-weight:bold"><a href="gerenciar_diretoria.asp?id=<%=vID_Cadastro%>" style="color: #ffffff">V O L T A R</a></div>	  <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" class="letras_">
		<tr>
		  <td align="center" valign="top">
			<BR><BR><span style="font-size: 18pt"><%=vSecao%></span>
		    <table border="0" cellspacing="0" cellpadding="0" class="letras_">
			  <tr>
			    <td><br><span style="font-size: 16px"><b><%=vTxtCampo%>&nbsp;<%=vNome%></b></span><br><br></td>
			  </tr>
              <tr> 
                <td colspan="2" align="center" valign="middle" height="21">
				  <table cellspacing="0" cellpadding="5" border="0">
				    <tr>
					  <td style="border: #999999; border-style: solid; border-top-width: 0px; border-left-width: 0px; border-bottom-width: 1px; border-right-width: 1px;">
					    <%If (InStr(1, UCase(vFoto), ".JPG") > 0) Or (InStr(1, UCase(vFoto), ".PNG") > 0) Or (InStr(1, UCase(vFoto), ".GIF") > 0) Then%>
						  <img src="<%=Replace(vPasta, "C:\Inetpub\vhosts\meubairrotem.com\httpdocs", "..")%>\<%=vFoto%>" border="0" name="foto1">
						<%Else%>
						  <img src='../images/sem_foto.gif' border='0' name="foto1">
						<%End If%>
					  </td>
					  <td valign="middle" style="border: #999999; border-style: solid; border-top-width: 0px; border-left-width: 0px; border-bottom-width: 1px; border-right-width: 0px;">
                        <form action="salvar_arquivoenviado.asp?id=<%=vID%>&pasta=<%=vPasta%>&bd=cadastro_diretoria" name="cadastro" method="post" enctype="multipart/form-data" onSubmit="return fValidaCad()" style="margin-top: 0px; margin-bottom: 0px">
						<table border="0" cellspacing="0" cellpadding="0">
                          <tr> 
                            <td valign="middle"> 
                              <input type="file" name="foto1" class="form_file">
                            </td>
                            <td align="center" valign="middle" height="21">
                              &nbsp;&nbsp;<input type="submit" name="enviar" value="Enviar" class="submit_file">
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
