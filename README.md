"# api-crud-clientes-laravel" 

executar os comandos abaixo para que a API gere as migrations e instale as dependencias do laravel
// irá instalar as dependencias do projeto
- composer install
// irá gerar uma chave para sua aplicação. Sem isso o Laravel não vai funcionar
- php artisan key:generate
// irá criar as tabelas da aplicação
- php artisan migrate

URLs e parametros que podem ser utilizados:

###################
##### USUÁRIO #####
###################
<h2>Adicionar um usuário:</h2>
URL: http://{URL}/usuarios/salvar
TIPO: _POST
PARAMS: 

	<br>&nbsp;&nbsp;&nbsp;"nome": "Tiago",
	<br>&nbsp;&nbsp;&nbsp;"login": "teste",
	<br>&nbsp;&nbsp;&nbsp;"senha": "123",
	<br>&nbsp;&nbsp;&nbsp;"tipoLogradouro":"Praça", 
	<br>&nbsp;&nbsp;&nbsp;"logradouro":"Praça da Sé",
	<br>&nbsp;&nbsp;&nbsp;"numero":"1",
	<br>&nbsp;&nbsp;&nbsp;"complemento":"lado ímpar",
	<br>&nbsp;&nbsp;&nbsp;"cep":"01001-000",
	<br>&nbsp;&nbsp;&nbsp;"estado":"São Paulo", 
	<br>&nbsp;&nbsp;&nbsp;"uf":"SP",
	<br>&nbsp;&nbsp;&nbsp;"cidade":"São Paulo"

ou
	<br>&nbsp;&nbsp;&nbsp;"nome": "Tiago",
	<br>&nbsp;&nbsp;&nbsp;"login": "acrossicauda1",
	<br>&nbsp;&nbsp;&nbsp;"senha": "123",
	<br>&nbsp;&nbsp;&nbsp;"idEndereco":1
	
<br>Obs.: o código do login deve ser unico e o código do endereço tem que ser válido
<br><br>
<h2>Buscar Usuário</h2>
URL: http://{URL}/usuarios/show
TIPO: _GET
PARAMS VÁLIDOS (FILTROS):
<br>'id', 
<br>'name', 
<br>'login',
<br>"campos": "count" => esse parametro faz um count dos clientes e pode ter como filtro 'idEndereco', 'idCidade' e 'idEstado'

<h2>Editar um usuário:</h2>
URL: http://{URL}/usuarios/editar
TIPO: _POST
PARAMS: 
<br>'id', * obrigatório
<br>'name', 
<br>'login',
<br>'senha',

<h2>Excluir um usuário:</h2>
URL: http://{URL}/usuarios/excluir
TIPO: _POST
PARAMS: 
"id" *obrigatório"

###################
##### ENDERÇO #####
###################
Adicionar um Endereço:
URL: http://{URL}/enderecos/salvar
TIPO: _POST
PARAMS:

	<br>&nbsp;&nbsp;&nbsp;"tipoLogradouro":"Praça", 
	<br>&nbsp;&nbsp;&nbsp;"logradouro":"Praça da Sé",
	<br>&nbsp;&nbsp;&nbsp;"numero":"",
	<br>&nbsp;&nbsp;&nbsp;"complemento":"lado ímpar",
	<br>&nbsp;&nbsp;&nbsp;"cep":"01001-000",
	<br>&nbsp;&nbsp;&nbsp;"estado":"São Paulo", 
	<br>&nbsp;&nbsp;&nbsp;"uf":"SP",
	<br>&nbsp;&nbsp;&nbsp;"cidade":"São Paulo"

<h2>Buscar Endereços</h2>
URL: http://{URL}/enderecos/show
TIPO: _GET
PARAMS VÁLIDOS (FILTROS):
	<br>&nbsp;&nbsp;&nbsp;"tipoLogradouro", 
	<br>&nbsp;&nbsp;&nbsp;"logradouro",
	<br>&nbsp;&nbsp;&nbsp;"numero",
	<br>&nbsp;&nbsp;&nbsp;"complemento",
	<br>&nbsp;&nbsp;&nbsp;"cep",
	<br>&nbsp;&nbsp;&nbsp;"estado",
	<br>&nbsp;&nbsp;&nbsp;"uf",
	<br>&nbsp;&nbsp;&nbsp;"cidade"

<h2>Editar um usuário:</h2>
URL: http://{URL}/enderecos/editar
TIPO: _POST
PARAMS: 
	<br>'id', * obrigatório
	<br>'tipoLogradouro', 
	<br>'logradouro', 
	<br>'cep', 
	<br>'numero'
	<br>'cidade'
	'estado', 
	<br>'uf'

<br>'name', 
<br>'login',
<br>'senha',

<h2>Excluir um usuário:</h2>
URL: http://{URL}/enderecos/excluir
TIPO: _POST
PARAMS: 
"id" *obrigatório"
