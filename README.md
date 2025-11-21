# DevAlicia - ThemeConfig 

Este módulo permite **alterar dinamicamente a cor primária da loja Magento 2** (botões e principais ações) **sem necessidade de deploy de conteúdo estático**, com suporte completo a **escopos de Store View**.

A solução é ideal para lojas multi-idiomas/multi-marcas, permitindo personalização rápida e centralizada apenas via comando.

---

## 🎯 Visão Geral

O DevAlicia2_ThemeConfig injeta uma camada de personalização visual no frontend da loja usando JavaScript, aplicando estilos inline a botões e elementos primários de interação.

Como o módulo atua em tempo de execução, **qualquer mudança é aplicada instantaneamente**, sem recompilações ou reinstalações de tema.

---

## ✨ Principais Funcionalidades

* 🎨 Alteração dinâmica da cor primária (background e borda).
* 🔄 Suporte para elementos renderizados via AJAX (Checkout, minicart, carregamentos KnockoutJS).
* 🖱️ Estilos customizados para eventos de hover, inclusive para botões secundários.
* 🏪 Configuração por Store View — perfeito para multi-loja.
* 🚀 Possibilidade de integração com comandos CLI para alteração rápida.

---

## ⚙️ Como o Módulo Funciona

A arquitetura do módulo é dividida em três camadas principais:

### 1. **Backend — Armazenamento de Configuração**

Localização do valor configurado: `core_config_data` → `devalicia2/theme/primary_color`.

* Valor salvo em formato HEX.
* Respeita o escopo `store`, permitindo cores distintas por loja.
* Possui suporte a comando CLI dedicado para atualizar o valor e limpar cache automaticamente.

### 2. **Frontend — Injeção de Configuração via Layout + ViewModel**

Arquivos envolvidos:

* `default.xml` e `checkout_index_index.xml` injetam o template `js_injector.phtml`.
* O ViewModel `ColorConfig.php` recupera o valor configurado no banco.
* O template passa a cor para o JavaScript via `text/x-magento-init` no formato JSON.

Essa camada faz a ponte entre a configuração de backend e o JavaScript que atuará no navegador.

### 3. **Cliente — Aplicação da Cor via JavaScript**

Arquivo principal: `view/frontend/web/js/apply-color.js`.

O script:

* Busca elementos como `.primary`, `.action.primary` e `.button`.
* Aplica cor de fundo e borda via estilo inline.
* Implementa listeners para hover de elementos `.button.more`.
* Monitora elementos dinâmicos via:

    * Evento nativo do Magento `contentUpdated`,
    * API `MutationObserver` para DOM dinâmico (Checkout, minicart, etc.).

Resultado: todos os elementos relevantes, mesmo os renderizados tardiamente, recebem a cor primária configurada.

---

## 🛠️ Instalação

1. Copie o módulo para:

```
src/app/code --> app/code/DevAlicia2/ThemeConfig
```

2. Execute os comandos:

```bash
bin/magento module:enable DevAlicia2_ThemeConfig
bin/magento setup:upgrade
bin/magento cache:clean
```

---

## 🎮 Como Usar

A cor primária pode ser configurada diretamente no `core_config_data` ou via comando CLI (caso implementado conforme a estrutura do módulo).

### Exemplo (comando CLI hipotético):

```bash
bin/magento color:change FF6600 1
```

Após execução:

* A cor é salva no banco.
* O cache de configuração é limpo.
* A loja aplica a nova cor em tempo real, sem deploy estático.

---

## 📁 Estrutura do Módulo (Resumo)

```
DevAlicia2/ThemeConfig
├── Console
│   └── ColorPrimaryCommand.php
├── Model
│   └── ChangeColors.php
├── ViewModel
│   └── ColorConfig.php
├── view
│   └── frontend
│       ├── layout
│       │   ├── default.xml
│       │   └── checkout_index_index.xml
│       ├── templates
│       │   └── js_injector.phtml
│       └── web
│           └── js
│               └── apply-color.js
```

---

## 🧪 Compatibilidade

* Magento 2.3+
* Funciona com qualquer tema baseado em Luma, Blank ou temas customizados.
* Compatível com checkout padrão ou módulos que utilizam KnockoutJS.

---

## 📌 Observações

* O módulo não substitui arquivos CSS do tema — ele opera **apenas por estilo inline**.
* É seguro para ambientes multi-loja.
* Não interfere na hierarquia normal de estilos do Magento.

---


**DevAlicia2 ThemeConfig – Personalização simples, rápida e sem complicações.**
