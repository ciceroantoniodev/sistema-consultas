# SISTEMA GERENCIADOR DE CONSULTAS
***

## Resumo

Este documento apresenta o desenvolvimento de um Sistema Gerenciador de Consultas, voltado para a marcação e gerenciamento simples de consultas médicas. A solução tem como objetivo principal facilitar o agendamento e organização dos atendimentos clínicos, promovendo maior controle, praticidade e agilidade no fluxo de informações entre pacientes, profissionais da saúde e unidades de atendimento. O projeto foi desenvolvido como parte das atividades acadêmicas do semestre, exigindo não apenas a implementação prática do sistema, mas também uma abordagem teórica que sustente a sua aplicação. O trabalho propõe também uma reflexão sobre a importância da digitalização de processos em ambientes de saúde e os benefícios que sistemas informatizados podem oferecer à gestão clínica.

## Fundamentação

A escolha por um modelo baseado em programação procedural estruturada demonstra que, mesmo fora do paradigma orientado a objetos, é possível manter uma arquitetura sólida e eficiente, desde que sejam aplicadas boas práticas de desenvolvimento. Neste projeto, a organização do sistema respeitou o padrão MVC (Model-View-Controller), promovendo uma separação funcional entre lógica de negócios, exibição e controle, o que favorece a manutenção e expansão do sistema. O uso do PHP como linguagem de desenvolvimento está alinhado com a proposta de acessibilidade e simplicidade. Trata-se de uma linguagem amplamente difundida, com vasta documentação, que permite a criação de sistemas dinâmicos e escaláveis. Combinado a um banco de dados como MySQL, o sistema torna-se robusto o suficiente para atender pequenas clínicas e consultórios.

# Instalação

## Instalação do projeto via repositório Git

_Certifique-se de ter o GIT instalado_.

1) Abra o terminal: windows + R + digite CMD
2) Crie uma __pasta__ para seus projetos
3) Acesse a pasta criada
4) Faça o clone do repositório utiizando git clone
   
```
git clone git@github.com:ciceroantoniodev/sistema-consultas.git
```

## Instalação do banco de dados

_Após fazer o clone do projeto_

1) Acesse a pasta __DB__ do projeto __sistema-consultas__.
2) Nesta pasta terá o arquivo __sistema_consulyas.sql__ que deverá ser importado através do phpMyAdmin.
3) Através do phpMyAdmin crie o banco de dados __sistema_consultas__.
4) Faça a importação do arquivo __sistemas_consultas.sql__ que contém as tabelas do banco de dados.

# Como Acessar o Sistema

Certifique-se de ter instalado um servidor Apache para acesso ao sistema, visto que o mesmo utiliza a linguagem PHP e banco de dados MySQL. Para o desenvolvimento local do projeto, utilizei o pacote WAMPServer em ambiente Windows.

1) Baixe e instale o WAMPServer
2) Copie o projeto para a pasta __www__, que deve estar na pasta __wamp64__.
3) No navegador acesse __http://localhost/sistema-consultas__.
4) Para usuário e senha utilize:

```
Usuário: admin
Senha: admin
```

# Consideações Finais

O __Sistema Gerenciador de Consultas__ se mostrou uma solução eficiente para organização de atendimentos clínicos em pequena escala. Com uma estrutura simples, mas funcional, é capaz de atender as necessidades básicas de marcação, edição e visualização de consultas. O projeto proporcionou uma experiência enriquecedora, tanto na parte técnica quanto teórica, fortalecendo o conhecimento em desenvolvimento web, modelagem de sistemas e boas práticas de programação. Além disso, abre portas para evoluções futuras como integração com sistemas de prontuário eletrônico, envio de lembretes por SMS ou e-mail e utilização de APIs para relatórios mais completos.

# _Obrigado!!!_
