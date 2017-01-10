## Repositório de Cenas

Este repositório consiste de um cadastro de cenas e permite que as cenas do repositório sejam utilizados via API por diversos renderizadores de cenas. A utilização é através de chamadas AJAX que retorna um JSON.


## Ferramentas utilizadas para o desenvolvimento

Ambiente de Desenvolvimento: Windows 10

Xampp versão 5.6.23 (https://www.apachefriends.org/pt_br/index.html)
	- pacote composto pelo APACHE, MYSQL, PHP
	
	Obs.: incluir a pasta PASTA_DO_XAMPP/php no PATH do Windows

Laravel (https://www.apachefriends.org/pt_br/index.html)
	
	Obs.: O laravel não precisa ser baixado, pois ele já se encontra no projeto

Banco de Dados sqlite (https://sqlite.org)

	Obs.: Não precisa ser instalado, pois ele já se encontra no projeto

	Pode utilizar o Sqlite Client que encontra-se na pasta PASTA_DO_XAMPP/MercuryMail para conectar no 
	Banco de Dados que está sendo armazenado no arquivo /storage/database.sqlite



## Para "subir" o servidor web

	php artisan serve --host="nome_servidor" --port="porta_servidor"

por exemplo: 

	php artisan serve --host="192.168.1.10" --port=80



## Para acessar o cadastro de cenas através do navegador web
	
	http://nome_servidor:porta_servidor/scene



## A API oferece os seguintes serviços retornando um JSON
	
	http://nome_servidor:porta_servidor/API
	Descrição: retorna um conjunto de cenas disponíveis no repositório

	http://nome_servidor:porta_servidor/API/id/numero_cena
	Onde: numero_cena representa o ID da cena
	Descrição: retorna as informações da cena cujo ID é numero_cena

	http://nome_servidor:porta_servidor/API/label/palavra_busca
	Onde: palavra_busca é uma palavra a ser buscada
	Descrição: retorna um conjunto de cenas disponíveis no repositório que possuem a palavra_busca na 
	descrição da cena


