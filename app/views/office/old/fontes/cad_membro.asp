<%@ Language=VBScript %>
<!--#include file="conexao.asp"-->
<!--#include file="rotinas.asp"-->
<%
vID = Request.QueryString("id")
vID_Cadastro = Request.QueryString("ida")

vAcao = Request.QueryString("acao")

vSecao = "CADASTRO DE NOVO MEMBRO"

f_nome = ""
f_cpf = ""
f_rg = ""
f_estadocivil = ""
f_orgao = ""
f_dt_nasc = ""
f_endereco = ""
f_bairro = ""
f_cidade = ""
f_estado = ""
f_cep = ""
f_dddfone = ""
f_fone = ""
f_dddcelular = ""
f_celular = ""
f_email = ""
f_cargo = ""
f_profissao = ""

If CInt(vAcao) = 1 Then
  Set dbDados = conexao.execute("select * from cadastro_diretoria where id=" & vID)

  f_nome = dbDados("nome")
  f_cpf = dbDados("cpf")
  f_rg = dbDados("rg")
  f_orgao = dbDados("orgao")
  f_estadocivil = dbDados("estado_civil")
  f_dt_nasc = dbDados("data_nasc")
  f_endereco = dbDados("endereco")
  f_bairro = dbDados("bairro")
  f_cidade = dbDados("cidade")
  f_estado = dbDados("estado")
  f_cep = dbDados("cep")
  f_dddfone = dbDados("dddfone")
  f_fone = dbDados("fone")
  f_dddcelular = dbDados("dddcelular")
  f_celular = dbDados("celular")
  f_email = dbDados("email")
  f_cargo = dbDados("cargo")
  f_profissao = dbDados("profissao")
  
  vSecao = "ALTERAÇÃO DE DADOS NO MEMBRO"

End If

conexao.Close
Set dbDados = Nothing
%>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<html>
<head>
	<title>.....:: MEU BAIRRO TEM - Área Restrita ::.....</title>
    <style type="text/css">
    <!--
      @import url(../estilo.css);
    -->
    </style>

<script language="JavaScript" type="text/javascript">

function fValidaCad()
{
hoje = new Date();
if (document.cadastro.apelido.value.length == 0)
  {
  alert('NOME ABREVIADO/APELIDO não pode ser vazio');
      document.cadastro.apelido.value = '';
      document.cadastro.apelido.focus();
      return false;
  }
if (document.cadastro.email.value.length == 0)
  {
  alert('EMAIL não pode ser vazio');
      document.cadastro.email.value = '';
      document.cadastro.email.focus();
      return false;
  }
if (document.cadastro.senhaX.value.length == 0)
  {
  alert('SENHA não pode ser vazio');
      document.cadastro.senhaX.value = '';
      document.cadastro.senhaX.focus();
      return false;
  }
if (document.cadastro.senhaC.value.length != document.cadastro.senhaX.value.length)
  {
  alert('SENHA não confere');
      document.cadastro.senhaC.value = '';
      document.cadastro.senhaX.focus();
      return false;
  }
if (document.cadastro.nome.value.length == 0)
  {
  alert('NOME não pode ser vazio');
      document.cadastro.nome.value = '';
      document.cadastro.nome.focus();
      return false;
  }
if (document.cadastro.cpf.value.length == 0)
  {
  alert('CPF não pode ser vazio');
      document.cadastro.cpf.value = '';
      document.cadastro.cpf.focus();
      return false;
  }
if (document.cadastro.endereco.value.length == 0)
  {
  alert('ENDEREÇO não pode ser vazio');
      document.cadastro.endereco.value = '';
      document.cadastro.endereco.focus();
      return false;
  }
if (document.cadastro.bairro.value.length == 0)
  {
  alert('BAIRRO não pode ser vazio');
      document.cadastro.bairro.value = '';
      document.cadastro.bairro.focus();
      return false;
  }
if (document.cadastro.cidade.value.length == 0)
  {
  alert('CIDADE não pode ser vazio');
      document.cadastro.cidade.value = '';
      document.cadastro.cidade.focus();
      return false;
  }
if (document.cadastro.cep.value.length == 0)
  {
  alert('CEP não pode ser vazio');
      document.cadastro.cep.value = '';
      document.cadastro.cep.focus();
      return false;
  }
if (document.cadastro.dddfone.value.length == 0 && document.cadastro.dddcelular.value.length == 0)
  {
  alert('DDD não pode ser vazio');
      document.cadastro.dddfone.value = '';
      document.cadastro.dddfone.focus();
      return false;
  }
if (document.cadastro.fone.value.length == 0 && document.cadastro.celular.value.length == 0)
  {
  alert('FONE ou CELULAR não pode ser vazio');
      document.cadastro.fone.value = '';
      document.cadastro.fone.focus();
      return false;
  }
if (document.cadastro.escolaridade.value == "X")
  {
  alert('Selecione um grau de ESCOLARIDADE');
      document.cadastro.escolaridade.value = '';
      document.cadastro.escolaridade.focus();
      return false;
  }
if (document.cadastro.profissao.value == "X")
  {
  alert('Selecione uma PROFISSÃO');
      document.cadastro.profissao.value = '';
      document.cadastro.profissao.focus();
      return false;
  }
if (document.cadastro.rendamensal.value == "X")
  {
  alert('Selecione uma RENDA MENSAL');
      document.cadastro.rendamensal.value = '';
      document.cadastro.rendamensal.focus();
      return false;
  }
}

function fConfirmeSenha() {
  var s1 = document.getElementById('senhaX').value;
  var s2 = document.getElementById('senhaC').value;
  if (s2 != s1) {
    alert('SENHA não confere');
	document.cadastro.senhaC.value = '';
	document.cadastro.senhaC.focus();
	return false;
  }
}
</script>
</head>
  
<body style="background: url(./images/ground_framework.gif) repeat-x fixed; margin-top: 0pt; margin-bottom: 0pt; margin-left: 0pt; margin-right: 0pt">
<div align="center">
<a name="#inicio"></a>
<table id="empresa" cellspacing="0" cellpadding="0" border="0" width="80%">
  <tr>
	<td align="center" id="descricao" valign="top">
      <div style="margin-top: 10px; margin-bottom: 10px; background: #ff0000; width: 150px; padding: 5px; font-family: tahoma, arial; font-size: 18px; font-weight:bold"><a href="gerenciar_diretoria.asp?id=<%=vID_Cadastro%>" style="color: #ffffff">V O L T A R</a></div>
	  <FORM ACTION="salvar_membro.asp?ida=<%=vID_Cadastro%>" METHOD="POST" style="margin-top: 0px; margin-bottom: 0pt" name="frmDiretoriaMembro" onSubmit="return fValidaCad()">
	  <input name="id" type="hidden" value="<%=vID%>">
	  <input name="acao" type="hidden" value="<%=vAcao%>">
	  <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" class="letras_">
		<tr>
		  <td valign="top" align="center">
		  		    <span style="font-size: 28px; color: #666666"><%=vSecao%></span><br><br>
					<table cellspacing="0" cellpadding="0" border="0" class="letras_">
                      <tr> 
                        <td valign="middle"> 
                          <br><br>&nbsp;&nbsp;Nome:
                        </td>
                        <td valign="middle"> 
                          <br><br><input type="text" name="nome" size="50" maxlength="80" value="<%=f_nome%>" class="form_">
                        </td>
                      </tr>
                      <tr> 
                        <td valign="middle"> 
                          &nbsp;&nbsp;Cargo:
                        </td>
                        <td valign="middle"> 
                          <input type="text" name="cargo" size="40" maxlength="50" value="<%=f_cargo%>" class="form_">
                        </td>
                      </tr>
                      <tr> 
                        <td valign="middle"> 
                          &nbsp;&nbsp;Profissão:
                        </td>
                        <td valign="middle"> 
                          <input type="text" name="profissao" size="40" maxlength="50" value="<%=f_profissao%>" class="form_">
                        </td>
                      </tr>
                      <tr> 
                        <td valign="middle"> 
                          &nbsp;&nbsp;Estado Civil:
                        </td>
                        <td valign="middle"> 
                          <input type="text" name="estadocivil" size="20" maxlength="20" value="<%=f_estadocivil%>" class="form_">
                        </td>
                      </tr>
                      <tr> 
                        <td valign="middle"> 
                          &nbsp;&nbsp;Data de Nascimento:&nbsp;&nbsp;&nbsp;&nbsp;
                        </td>
                        <td valign="middle"> 
                          <%
						  If CInt(vAcao) = 1 Then
                            Response.Write "<input type=""text"" name=""dt_nasc_dia"" size=""2"" maxlength=""2"" value=""" & Day(f_dt_nasc) & """ class=""form_"">/"
                            Response.Write "<input type=""text"" name=""dt_nasc_mes"" size=""2"" maxlength=""2"" value=""" & Month(f_dt_nasc) & """ class=""form_"">/"
                            Response.Write "<input type=""text"" name=""dt_nasc_ano"" size=""6"" maxlength=""4"" value=""" & Year(f_dt_nasc) & """ class=""form_"">"
						  Else
						    SelecionarData("dt_nasc[1950," & Year(Date()) & "]")
						  End If
						  %>
                        </td>
                      </tr>
                      <tr> 
                        <td valign="middle"> 
                          &nbsp;&nbsp;CPF:
                        </td>
                        <td valign="middle"> 
                          <input type="text" name="cpf" size="20" maxlength="50" value="<%=f_cpf%>" class="form_">
                        </td>
                      </tr>
                      <tr> 
                        <td valign="middle"> 
                          &nbsp;&nbsp;RG:
                        </td>
                        <td valign="middle"> 
                          <input type="text" name="rg" size="20" maxlength="50" value="<%=f_rg%>" class="form_">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                          Orgão:&nbsp;<input type="text" name="orgao" size="10" maxlength="10" value="<%=f_orgao%>" class="form_">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        </td>
                      </tr>
                      <tr> 
                        <td valign="middle"> 
                          &nbsp;&nbsp;Endereço:</span>&nbsp;&nbsp;
                        </td>
                        <td valign="middle"> 
                          <input type="text" name="endereco" size="50" maxlength="80" value="<%=f_endereco%>" class="form_">
                        </td>
                      </tr>
					  <tr> 
                        <td valign="middle"> 
                          &nbsp;&nbsp;Bairro:</span>&nbsp;&nbsp;
                        </td>
                        <td valign="middle"> 
                          <input type="text" name="bairro" size="30" maxlength="50" value="<%=f_bairro%>" class="form_">
                        </td>
                      </tr>
                      <tr> 
                        <td valign="middle"> 
                          &nbsp;&nbsp;Cidade:</span>&nbsp;&nbsp;
                        </td>
                        <td valign="middle"> 
                          <input type="text" name="cidade" size="30" maxlength="50" value="<%=f_cidade%>" class="form_">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						  Estado:
						  <select name="estado" class="form_">
						    <option value="<%=f_estado%>"><%=f_estado%></option>
                            <option value="AC">AC</option>
                            <option value="AL">AL</option>
                            <option value="AM">AM</option>
                            <option value="AP">AP</option>
                            <option value="BA">BA</option>
                            <option value="CE">CE</option>
                            <option value="DF">DF</option>
                            <option value="ES">ES</option>
                            <option value="GO">GO</option>
                            <option value="MA">MA</option>
                            <option value="MG">MG</option>
                            <option value="MS">MS</option>
                            <option value="MT">MT</option>
                            <option value="PA">PA</option>
                            <option value="PB">PB</option>
                            <option value="PE">PE</option>
                            <option value="PI">PI</option>
                            <option value="PR">PR</option>
                            <option value="RJ">RJ</option>
                            <option value="RN">RN</option>
                            <option value="RO">RO</option>
                            <option value="RR">RR</option>
                            <option value="RS">RS</option>
                            <option value="SC">SC</option>
                            <option value="SE">SE</option>
                            <option value="SP">SP</option>
                            <option value="TO">TO</option>
                          </select>
                        </td>
                      </tr>
                      <tr> 
                        <td valign="middle"nowrap> 
                          &nbsp;&nbsp;CEP:</span>&nbsp;&nbsp;&nbsp;
                        </td>
                        <td valign="middle"> 
                          <input type="text" name="cep" size="10" maxlength="10" value="<%=f_cep%>" class="form_">
                        </td>
                      </tr>
                      <tr> 
                        <td valign="middle"> 
                          &nbsp;&nbsp;Fone:
                        </td>
                        <td valign="middle"> 
                          (<input type="text" name="dddfone" size="2" maxlength="2" value="<%=f_dddfone%>" class="form_">)&nbsp;
						  <input type="text" name="fone" size="8" maxlength="8" value="<%=f_fone%>" class="form_">
                          &nbsp;&nbsp;<span class="letra_2"> (ex: 11-99999999)</span>
	  		            </td>
                      </tr>
                      <tr> 
                        <td valign="middle"> 
                          &nbsp;&nbsp;Celular:
                        </td>
                        <td valign="middle"> 
                          (<input type="text" name="dddcelular" size="2" maxlength="2" value="<%=f_dddcelular%>" class="form_">)&nbsp; 
                          <input type="text" name="celular" size="8" maxlength="8" value="<%=f_celular%>" class="form_">
                          &nbsp;&nbsp;<span class="letra_2"> (ex: 11-99999999)</span>
	  		            </td>
                      </tr>
                      <tr> 
                        <td valign="middle"> 
                          &nbsp;&nbsp;Email:
                        </td>
                        <td valign="middle"> 
                          <input type="text" name="email" size="50" maxlength="150" value="<%=f_email%>" class="form_">
                        </td>
                      </tr>
                      <tr> 
                        <td colspan="2" align="center" valign="middle" height="21">
						  <br><br> 
                          <input type="submit" name="enviar" value="Atualizar" class="submit_login">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                          <input type="reset" name="limpar" value="Limpar" class="submit_login">
                        </td>
                      </tr>
                    </table><br>
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
