## Logcomex Teste
Neste teste para a área de engenharia, a partir dos requisitos apresentados pela Logcomex, a ideia é de construir um BI.

### Tecnologias Utilizadas

- PHP 8.1
- Laravel 10.10
- PostgreSQL
- Docker

### Endpoints construídos:

#### 1. Lista de Importações/Exportações (comex-list)
- URL: http://localhost:9000/api/v1/comex-list
- Objetivo: retornar uma lista de Importações/Exportações ordenados por ano/mês de forma decrescente, paginados de 20 em 20 registros
- Exemplo de Json:
  
  ![image](https://github.com/user-attachments/assets/c86c7683-8bcc-4f3b-84d2-b3e89b694a2c)

#### 2. Dashboard por tipo de Transporte (comex-dashboard-transport)
- URL: http://localhost:9000/api/v1/comex-dashboard-transport
- Objetivo: retornar o total de Importações/Exportações por tipo de Transporte 
- Exemplo de Json:

![image](https://github.com/user-attachments/assets/04979140-859f-47b0-9101-7835ced22913)

#### 3. Dashboard por Ranking de NCM (comex-dashboard-ranking-ncm)
- URL: http://localhost:9000/api/v1/comex-dashboard-ranking-ncm
- Objetivo: retornar o total de Importações/Exportações por NCM (ranking dos 10 maiores valores)
- Exemplo de Json:

![image](https://github.com/user-attachments/assets/a430ba88-75f2-437f-8bff-614d50d6782b)

### Filtros disponíveis:

Todos os Endpoints possuem os seguintes filtros:

- country => código do país
- flow => tipo de fluxo (E=Exportação | I=Importação)
- transport => tipo de transporte (A=Aéreo | M=Marítimo | R=Rodoviário | F=Ferroviário)
- year.from => ano inicial
- year.to => ano final
- amount.from => valor inicial
- amount.to => valor final

Exemplo de Json:

![image](https://github.com/user-attachments/assets/0a225d75-cbe4-4816-916f-7088f4b41234)

### Orientações para Executar o Projeto

1. Baixar o projeto a partir do GitHub:
   
   ```git init```
   
   ```git remote add origin https://github.com/dcunhamaciel/Comex.git```
   
   ```git pull origin main```
3. Fazer o build da imagem do docker:
   
   ```docker build -t nome-imagem .```
4. Levantar o container do docker a partir do compose:
   
   ```docker compose up```

### Orientações para Executar os Testes Unitários

1. Cria um Bancos de Dados de sua preferência
2. Duplicar o arquivo ".env.example" com o nome de ".env.testing"
3. Configurar as variáveis de ambiente pré-fixadas com DB_ (exemplo: DB_DATABASE) do arquivo ".env.testing" para o banco criado
4. Executar os testes: ```php artisan test```

### Observações

- As Migrations e Seeders estão sendo executadas ao subir o container do docker
- O Banco de Dados está sendo criado e destruído junto com o container do docker
  
### Considerações

O desenvolvimento desse teste foi um grande desafio pessoal e profissional, onde pude melhorar e obter novos conhecimentos, principalmente na configuração do Docker.

Agradeço a Logcomex pela oportunidade de fazer este teste.
