# Market
# Como executar o projeto

## Projeto
Pré-requisitos: docker, docker-compose 

```bash
# clonar repositório
git clone https://github.com/andrade-felipe-dev/market
```
Após realizado o clone dentor da raiz do projeto execute o comando: 

```bash
# comando docker compose
docker compose up -d
```
## Observações: 
- O projeto irá rodar em localhost:3000, as portas utilizadas para o processo são:
- 3000, 8080, 5433
- existe um dump do banco de dados na raiz do projeto, porém caso você prefira você também pode executar um script.sql que está em enviroment_development/postgresql/script.sql

## Documentação: 
Dentro da pasta docs há um arquivo insomnia.yml que você pode importá-lo caso deseje testar as apis, sem necessitar do front-end.
