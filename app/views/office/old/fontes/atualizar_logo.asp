<%@ Language=VBScript %>
<!--#include file="conexao.asp"-->
<!--#include file="rotinas.asp"-->
<%
Server.ScriptTimeout = 480

Dim Contador, Tamanho
Dim ConteudoBinario, ConteudoTexto
Dim Delimitador, Posicao1, Posicao2
Dim ArquivoNome, ArquivoConteudo, PastaDestino
Dim objobjTexto, objArquivo

vID_Cadastro = Request.QueryString("id")
vTipo = Request.QueryString("tp")
vLogo = Request.QueryString("logo")

'obtenho o diretório físico da pasta onde está este script 
nome_pasta = "C:\Inetpub\vhosts\meubairrotem.com\httpdocs\documentos\logos"
'nome_pasta= "c:\inetpub\wwwroot\meubairrotem\documentos\logos"

'Conecto com o sistema de arquivos 
set FSO = server.createObject("Scripting.FileSystemObject") 

'crio o objeto pasta 
Set pasta = FSO.GetFolder(nome_pasta) 

'pego os arquivos da pasta 
Set arquivos = pasta.Files 

vSalvarFoto = Request.QueryString("salvar")
vExcluirFoto = Request.QueryString("delfoto")
vExcluirPasta = Request.QueryString("delpasta")

If Not vExcluirFoto = "" Then
  conexao.execute("update cadastro_geral set logo='' where id=" & vID_Cadastro)
  
  FSO.DeleteFile(nome_pasta & "\" & vExcluirFoto)
  
  vLogo = ""
End If

If Not vSalvarFoto = "" Then
'Determina o tamanho do conteúdo
PastaDestino = "C:\Inetpub\vhosts\meubairrotem.com\httpdocs\documentos\logos"
Tamanho = Request.TotalBytes

If Tamanho > 170000 Then
%>
  <script language="Javascript" type="text/javascript">
  <!--
  alert("O tamanho do arquivo não pode ultrapassar os 170.000 Kb");
  history.back();
  //-->
  </script>
<%
End If

'Obtém o conteúdo no formato binário
ConteudoBinario = Request.BinaryRead(Tamanho)

'Transforma o conteúdo binário em string
For Contador = 1 To Tamanho
  ConteudoTexto = ConteudoTexto & Chr(AscB(MidB(ConteudoBinario, Contador, 1)))
Next 

'Determina o delimitador de campos
Delimitador = Left(ConteudoTexto, InStr(ConteudoTexto, vbCrLf) - 1)

'Percorre a String procurando os campos
'identifica os arquivo e grava no disco
Set objobjTexto = Server.CreateObject("Scripting.FileSystemObject")

Posicao1 = InStr(ConteudoTexto, Delimitador) + Len(Delimitar)
do while True
  ArquivoNome = ""
  Posicao1 = InStr(Posicao1, ConteudoTexto, "filename=")
  if Posicao1 = 0 then
    exit do
  else
   'Determina o nome do arquivo
   Posicao1 = Posicao1 + 10
   Posicao2 = InStr(Posicao1, ConteudoTexto, """")
   For contador = (Posicao2 - 1) to Posicao1 step -1
    if Mid(ConteudoTexto, Contador, 1) <> "\" then '"
      ArquivoNome = Mid(ConteudoTexto, Contador, 1) & ArquivoNome
    else
      exit for
    end if
   next
	
   'Determina o conteúdo do arquivo
   Posicao1 = InStr(Posicao1, ConteudoTexto, vbCrLf & vbCrLf) + 4
   Posicao2 = InStr(Posicao1, ConteudoTexto, Delimitador) - 2
   ArquivoConteudo = Mid(ConteudoTexto, Posicao1, (Posicao2 - Posicao1 + 1))

   'Grava o arquivo
   If ArquivoNome <> "" then
     Set objArquivo = objobjTexto.CreateTextFile(PastaDestino & "/" & ArquivoNome, true)
       objArquivo.WriteLine ArquivoConteudo
       objArquivo.Close			
     Set objArquivo = nothing
	 
	 If InStr(1, UCase(ArquivoNome), ".JPG") > 0 Then
	   vArquivoNovo = "LOGO_" & UCase(Left(Replace(ArquivoNome, ".", ""), 4)) & vID_Cadastro & Hour(Time()) & Minute(Time()) & Second(Time()) & Year(Date()) & Month(Date()) & Day(Date()) & ".jpg"
	 ElseIf InStr(1, UCase(ArquivoNome), ".GIF") > 0 Then
	   vArquivoNovo = "LOGO_" & UCase(Left(Replace(ArquivoNome, ".", ""), 4)) & vID_Cadastro & Hour(Time()) & Minute(Time()) & Second(Time()) & Year(Date()) & Month(Date()) & Day(Date()) & ".gif"
	 Else
	   vArquivoNovo = "LOGO_" & UCase(Left(Replace(ArquivoNome, ".", ""), 4)) & vID_Cadastro & Hour(Time()) & Minute(Time()) & Second(Time()) & Year(Date()) & Month(Date()) & Day(Date()) & ".png"
	 End If
	 
     objobjTexto.CopyFile PastaDestino & "/" & ArquivoNome, PastaDestino & "/" & vArquivoNovo
     objobjTexto.DeleteFile PastaDestino & "/" & ArquivoNome,true

	 conexao.execute("update cadastro_geral set logo='" & vArquivoNovo & "' where id=" & vID_Cadastro)
	 
	 vLogo = vArquivoNovo

  end if
end if
Loop
Set objobjTexto = nothing
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
	window.location.href = "atualizar_logo.asp?id=<%=vID_Cadastro%>&tp=<%=vTipo%>&delfoto=" + vffoto + "&delpasta=" + vfpasta;
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
			<span style="font-size: 18pt; color: #000000">Atualizar Logomarca</span><br><br>
			<div style="border: #dddddd 1px solid; width: 540px; margin-bottom: 10px">
			  <%
			  If (InStr(1, UCase(vLogo), ".JPG") > 0) Or (InStr(1, UCase(vLogo), ".GIF") > 0) Or (InStr(1, UCase(vLogo), ".PNG") > 0) Then
			    Response.Write "<div><img src=""../documentos/logos/" & vLogo & """ border=""0"" vspace=""10""></div>"
			    Response.Write "<div>[&nbsp;<a href=""javascript: fExcluirFotos('" & vLogo & "','')"" style=""color: #ff0000""><img src=""./images/btn_excluir.gif"" border=""0"" vspace=""5"" hspace=""5"" align=""center"">Excluir logo</a>&nbsp;]</div>"
              Else
			    Response.Write "<div><img src=""../images/sem_logomarca.gif"" border=""0"" vspace=""10""></div>"
			  End If			  
			  %>
			</div>
		    <table width="540" border="0" cellspacing="0" cellpadding="0" class="letras_">
			  <tr>
			    <td align="center" class="box1">
                        <form action="atualizar_logo.asp?id=<%=vID_Cadastro%>&tp=<%=vTipo%>&salvar=sim" name="frmEnviarFotos" method="post" enctype="multipart/form-data" onSubmit="return fValidaCad()" style="margin-top: 0px; margin-bottom: 0px">
						<table height="40" border="0" cellspacing="0" cellpadding="0">
                          <tr> 
                            <td valign="middle"> 
                              &nbsp;&nbsp;&nbsp;&nbsp;<span style="font-size:14px; color: #ff0000"><B>Enviar nova logo:</b></span> <input type="file" name="foto1" size="35" class="form_file">
                            </td>
                            <td align="center" valign="middle" height="21">
                              &nbsp;&nbsp;<input type="submit" name="enviar" value="Enviar" class="submit_file">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            </td>
                          </tr>
	                    </table>
                        </form>
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