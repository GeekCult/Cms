Bem vindo ao código de desenvolvimento do PurplePier

SETUP
=============================================

Nos aqui na Plataforma utilizamos um ambiente de desenvolvimento com virtualhost, 
Você vai precisar fazer o setup para funcionar corretamente, pois caso contrário os arquivos
CSS, JS e Medias não irão carregar corretamente.

O projeto deve estar localizado dentro da pasta /httpdocs - do mamp ou xamp ou outro tipo 
de localhost que você utiliza para rodar o Apache na sua máquina.

Para iniciar o desenvolvimento você precisa seguir os passos abaixo:

1 - Adicionar a pasta "user" em /media  
Encontre o arquivo user.zip.
Descompacteo e adicione seu conteúdo, a pasta "user" dentro, de /media, acho que é só substituir.

2 - Crie do diretórios
"assets" na raiz do projeto
"runtime" dentro de protected.

3 - Adicione o arquivo database.php
Existe o arquivo database.php, este deve ser colocado dentro de /protected/config
Esse arquivo, database.php, é a conexão com o banco. 
Confira se o nome do banco, user e senha estão conforme você utiliza em sua configuração habitual.
Geralmente é: database: purplepier, user: root, password: root


4 - Teste inicial
Para ver se o projeto abre, você pode tentar bater em seu browser: localhost/purplepier.
Se abrir, ótimo é um bom começo, caso contrário deve-se conferir os passos acima.


5 - Configurar o VirtualHost
Veja o arquivo virtual_host.txt
Utilizamos assim:

dev.purplepier.com.br

Para acessar o painel Administrador
dev.purplepier.com.br/admin

Usuário e senha
user: contato@purplepier.com.br
pass:1234

6 - Não comite os arquivos de configuração.
Por favor não comita os arquivos de configuração de projeto, pois irá danificar o projeto de outros
usuários, desenvolvedores. 
Acesse o arquivo "excluir_submissao.txt" para não commitar os arquivos que não podem. 

Mas é bem simples, são os arquivos utilizados nos passos acima.




DESENVOLVIMENTO
===============================================
Caso precise adicionar Bibliotecas de Terceiros como PagSeguro, Google, Facebook e etc
para uso de SDK ou APIs, por favor adicione em /protected/extensions/vendors

Para CSS e Javascript mesma coisa

Caso precise criar ou gerar arquivos de media, como imagens, txt, json e etc crie-os em 

/media/user dentro existem várias medias, css, files, downloads, imagens e etc

A lógica de negócios devem sempre estar dentro dos Managers, nunca nas Actions
Por exemplo para trabalhar com Materias, você tem o 

MateriasAction.php - recebem as chamadas, os get e os posts
MateriasManager.php - fazem a lógica toda, CRUD no banco e etc
MateriasUtils.php - Se precisar de algo mais específico e não quer "sujar" as classes Managers


Se for trabalhar com produtos você deve ter de adicionar ou trocar a permissão do XML produtos.xml em /media/users/rss/produtos.xml


