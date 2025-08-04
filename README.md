# Falzoni Laravel API de Transações

API REST para registro e gerenciamento de transações financeiras desenvolvida com Laravel 11 com PHP 8. A aplicação permite registrar transações, removê-las e calcular estatísticas em tempo real dos últimos 60 segundos.

Este projeto é baseado no desafio proposto pelo Itaú: https://github.com/rafaellins-itau/desafio-itau-vaga-99-junior

## 🚀 Tecnologias Utilizadas

- **PHP 8.4.11**: Linguagem de desenvolvimento base
- **Spring Boot 3**: Framework principal para desenvolvimento da API
- **Docker**: Containerização da aplicação
- **Laravel Tests c\ PHP Unit**: Framework de testes unitários
- **Swagger**: Documentação interativa da API

## 📋 Funcionalidades

### Sistema de Registro de Transações

A API oferece um sistema completo para gerenciamento de transações financeiras com armazenamento em memória, proporcionando alta performance para cálculos estatísticos em tempo real.

## 📚 Endpoints da API

### 1. Registrar Transação
**POST** `/api/transacao`

Registra uma nova transação no sistema.

#### Payload de Entrada:
- **Valor**: Obrigatório, deve ser maior que zero
- **DataHora**: Obrigatória, deve ser uma data no passado (não pode ser futura)
- **Formato**: JSON válido seguindo padrão ISO 8601 para datas

#### Respostas:
- `201 Created`: Transação registrada com sucesso
- `400 Bad Request`: Payload inválido ou mal formatado
- `422 Unprocessable Entity`: Dados não atendem às regras de validação

### 2. Remover Todas as Transações
**DELETE** `/api/transacao`

Remove todas as transações armazenadas no sistema.

#### Respostas:
- `200 OK`: Todas as transações foram removidas com sucesso

### 3. Obter Estatísticas
**GET** `/api/estatistica`

Calcula e retorna estatísticas das transações registradas nos últimos 60 segundos.

#### Respostas:
- `200 OK`: Estatísticas calculadas com sucesso

#### Resposta de Sucesso - Campos Retornados:
- **Count**: Quantidade de transações nos últimos 60 segundos
- **Sum**: Soma total dos valores transacionados
- **Average**: Média dos valores das transações
- **Min**: Menor valor transacionado
- **Max**: Maior valor transacionado

## 🔧 Como Executar

### Pré-requisitos
- PHP ^8.4
- Composer ^2
- Docker (opcional)
- Docker Compose (para execução via Docker)

## Execução Local

## Execução via VS Code/Terminal com PHP Artisan

No VS Code, abra um terminal. Na raiz do projeto e digite `composer install`. Após a instação dos pacotes digite `php artisan serve` para executar o projeto.

## Docker
Para execução via Docker Compose, existem dois arquivos de execução, um arquivo `compose.dev.yml` (Ambiente de desenvolvimento) e outro `compose.prod.yml` (Ambiente de produção). Ambos seguem o padrão da documentação suporte https://docs.docker.com/guides/frameworks/laravel/ do próprio Docker.

Para executar o build de ambiente de desenvolvimento, digite:

 `docker compose -f compose.dev.yml up --build -d`

Para executar o build de ambiente de Produção, digite:

 `docker compose -f compose.prod.yml up --build -d`

Após a montagem, digite:
```
docker compose exec workspace bash
composer install
```

Para executar o projeto, digite no navegador a url `http://localhost`

## 🏗️ Arquitetura

- **Controller Layer**: Gerencia requisições HTTP e respostas
- **Service Layer**: Contém lógica de negócio para processamento de transações
- **Model Layer**: Define estruturas de dados (Transaction, SummaryStatistics)
- **In-Memory Storage**: Armazenamento temporário para alta performance

## 🔍 Monitoramento

A API inclui:
- **Health Check**: Endpoint `/api/Health` para verificação do status da aplicação
- **Logging Estruturado**: Logs detalhados de todas as operações
- **Métricas de Performance**: Medição do tempo de cálculo das estatísticas

## ⚡ Performance

O sistema foi otimizado para:
- Cálculo de estatísticas em tempo real
- Armazenamento em memória para acesso rápido
- Validação eficiente de dados de entrada
- Logging não-bloqueante