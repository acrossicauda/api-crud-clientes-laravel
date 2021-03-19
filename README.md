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
PARAMS: 
<br>{
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
<br>}
ou
<br>{
	<br>&nbsp;&nbsp;&nbsp;"nome": "Tiago",
	<br>&nbsp;&nbsp;&nbsp;"login": "acrossicauda1",
	<br>&nbsp;&nbsp;&nbsp;"senha": "123",
	<br>&nbsp;&nbsp;&nbsp;"idEndereco":1
<br>}
<br>Obs.: o código do login deve ser unico e o código do endereço tem que ser válido
<br><br>
<h2>Buscar Usuário</h2>
URL: http://{URL}/usuarios/show
PARAMS VÁLIDOS:
<br>{'id', 'name', 'login', 'created_id', 'updated_id'}dsa

###################
##### ENDERÇO #####
###################
Adicionar um Endereço:
URL: http://{URL}/enderecos/salvar
PARAMS:
<br>{
	<br>&nbsp;&nbsp;&nbsp;"tipoLogradouro":"Praça", 
	<br>&nbsp;&nbsp;&nbsp;"logradouro":"Praça da Sé",
	<br>&nbsp;&nbsp;&nbsp;"numero":"",
	<br>&nbsp;&nbsp;&nbsp;"complemento":"lado ímpar",
	<br>&nbsp;&nbsp;&nbsp;"cep":"01001-000",
  <br>&nbsp;&nbsp;&nbsp;"estado":"São Paulo", 
	<br>&nbsp;&nbsp;&nbsp;"uf":"SP",
 	<br>&nbsp;&nbsp;&nbsp;"cidade":"São Paulo"
<br>}
