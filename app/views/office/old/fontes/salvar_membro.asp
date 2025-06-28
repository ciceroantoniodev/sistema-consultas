<%@ Language=VBScript %>
<!--#include file="conexao.asp"-->
<%

vAcao = Request.form("acao")
vID = Request.form("id")

vID_Cadastro = Request.QueryString("ida")

f_cargo = Request.form("cargo")
f_nome = Request.form("nome")
f_profissao = Request.form("profissao")
f_estadocivil = Request.form("estadocivil")
f_cpf = Request.form("cpf")
f_rg = Request.form("rg")
f_orgao = Request.form("orgao")
f_dt_nasc = Request.form("dt_nasc_ano") & "-" & Request.form("dt_nasc_mes") & "-" & Request.form("dt_nasc_dia")
f_endereco = Request.form("endereco")
f_bairro = Request.form("bairro")
f_cidade = Request.form("cidade")
f_estado = Request.form("estado")
f_cep = Request.form("cep")
f_dddfone = Request.form("dddfone")
f_fone = Request.form("fone")
f_dddcelular = Request.form("dddcelular")
f_celular = Request.form("celular")
f_email = Request.form("email")
f_ativo = Request.form("ativo")
f_data = Year(Date()) & "-" & Month(Date()) & "-" & Day(Date()) & " " & Time()

If CInt(vAcao) = 2 Then
  Set dbCadastros = conexao.execute("select * from cadastro_diretoria order by id desc")
    If dbCadastros.EOF And dbCadastros.BOF Then
      vCodigoMembro = 1
    Else
      vCodigoMembro = dbCadastros("id") + 1
    End If
  Set dbCadastros = Nothing

  dbDados = vCodigoMembro
  dbDados = dbDados & "," & vID_Cadastro
  dbDados = dbDados & ",'" & f_cargo & "'"
  dbDados = dbDados & ",'" & f_nome & "'"
  dbDados = dbDados & ",'" & f_profissao & "'"
  dbDados = dbDados & ",'" & f_estadocivil & "'"
  dbDados = dbDados & ",'" & f_endereco & "'"
  dbDados = dbDados & ",'" & f_bairro & "'"
  dbDados = dbDados & ",'" & f_cidade & "'"
  dbDados = dbDados & ",'" & f_estado & "'"
  dbDados = dbDados & ",'" & f_cep & "'"
  dbDados = dbDados & ",'" & f_dddfone & "'"
  dbDados = dbDados & ",'" & f_fone & "'"
  dbDados = dbDados & ",'" & f_dddcelular & "'"
  dbDados = dbDados & ",'" & f_celular & "'"
  dbDados = dbDados & ",'" & f_email & "'"
  dbDados = dbDados & ",'" & f_cpf & "'"
  dbDados = dbDados & ",'" & f_rg & "'"
  dbDados = dbDados & ",'" & f_orgao & "'"
  dbDados = dbDados & ",'" & f_dt_nasc & "'"
  dbDados = dbDados & ",''"
  dbDados = dbDados & ",'" & f_data & "'"

  conexao.Execute("insert into cadastro_diretoria values (" & UCase(dbDados) & ");")
  
Else
  vUpDate = "update cadastro_diretoria set "
  vWhere = " where id=" & vID
  
  conexao.Execute(vUpDate & "cargo='" & f_cargo & "'" & vWhere)
  conexao.Execute(vUpDate & "nome='" & f_nome & "'" & vWhere)
  conexao.Execute(vUpDate & "profissao='" & f_profissao & "'" & vWhere)
  conexao.Execute(vUpDate & "estado_civil='" & f_estadocivil & "'" & vWhere)
  conexao.Execute(vUpDate & "endereco='" & f_endereco & "'" & vWhere)
  conexao.Execute(vUpDate & "bairro='" & f_bairro & "'" & vWhere)
  conexao.Execute(vUpDate & "cidade='" & f_cidade & "'" & vWhere)
  conexao.Execute(vUpDate & "estado='" & f_estado & "'" & vWhere)
  conexao.Execute(vUpDate & "cep='" & f_cep & "'" & vWhere)
  conexao.Execute(vUpDate & "dddfone='" & f_dddfone & "'" & vWhere)
  conexao.Execute(vUpDate & "fone='" & f_fone & "'" & vWhere)
  conexao.Execute(vUpDate & "dddcelular='" & f_dddcelular & "'" & vWhere)
  conexao.Execute(vUpDate & "celular='" & f_celular & "'" & vWhere)
  conexao.Execute(vUpDate & "email='" & f_email& "'" & vWhere)
  conexao.Execute(vUpDate & "cpf='" & f_cpf & "'" & vWhere)
  conexao.Execute(vUpDate & "rg='" & f_rg & "'" & vWhere)
  conexao.Execute(vUpDate & "orgao='" & f_orgao & "'" & vWhere)
  
  If f_dt_nasc = "NULL" Then
    conexao.Execute(vUpDate & "data_nasc=" & f_dt_nasc & vWhere)
  Else
    conexao.Execute(vUpDate & "data_nasc='" & f_dt_nasc & "'" & vWhere)
  End If
  

End If

conexao.Close
%>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
	<title>Sistema Gerenciador de Ordem de Serviço</title>
    <style type="text/css">
    <!--
      @import url(estilo.css);
    -->
    </style>
</head>
  
<body style="background-color: #ffffff; margin-top: 0pt; margin-bottom: 0pt; margin-left: 0pt; margin-right: 0pt">
<div align="center">
<table cellspacing="0" cellpadding="0" border="0" width="100%" height="100%" class="letras_">
  <tr bgcolor="#ffffff">
    <td valign="middle" align="center">
	  <table width="400" height="150" class="letras_" cellpadding="0" cellspacing="0" border="1" bgcolor="#f0e9a2">
	    <tr>
		  <td align="center">
		    <span style="font-size: 24px; color: #1130ff">Atualização efetuada com sucesso!</span><br><br><br><br>
		    <div style="margin-top: 30px; background: #ff0000; width: 150px; padding: 5px; font-family: tahoma, arial; font-size: 18px; font-weight:bold"><a href="gerenciar_diretoria.asp?id=<%=vID_Cadastro%>" style="color: #ffffff">V O L T A R</a></div>
		  </td>
	    </tr>
	  </table>
    </td>
  </tr>
</table>
</div>
</body>
</html>
