# Market
# Como executar o projeto

## Projeto
Pré-requisitos: docker, docker-compose 

```bash
# clonar repositório
git clone https://github.com/andrade-felipe-dev/market
```
Execute o comando: 
```bash
# comando docker compose
docker compose up -d
```
Faça a resturação que está na raiz do projeto com o nome market_db.sql ou pode executar o script em enviroment_development/postgresql/script.sql.

## Observações: 
- O projeto irá rodar em localhost:3000, as portas utilizadas para o processo são:
- 3000, 8080, 5433


## Documentação: 
Dentro da pasta docs há um arquivo insomnia.yml que você pode importá-lo caso deseje testar as apis, sem necessitar do front-end.
