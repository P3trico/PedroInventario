Aqui está um modelo de README para o seu projeto:

---

# Inventário de Jogo Estilo Undertale

Este projeto implementa um sistema de inventário para um jogo estilo *Undertale*. O sistema permite que os itens do jogo sejam visualizados, adicionados e exibidos com suas respectivas imagens e quantidades. O inventário é armazenado em um arquivo de texto simples (`inventario.txt`), e a interface do usuário é construída com HTML, CSS e Bootstrap.

## Funcionalidades

- **Visualizar Itens**: Exibe todos os itens do inventário com suas respectivas quantidades e imagens.
- **Adicionar Itens**: Permite adicionar novos itens ao inventário, tanto via upload de imagem quanto através do fornecimento de uma URL para a imagem.
- **Atualização de Quantidade**: Caso o item já exista no inventário, sua quantidade será incrementada automaticamente.

## Estrutura de Arquivos

- `index.php`: Página principal que exibe o inventário.
- `adicionar_item.php`: Página para adicionar novos itens ao inventário.
- `inventario.txt`: Arquivo de texto que armazena os dados dos itens do inventário.
- `imagens/`: Pasta onde as imagens dos itens são armazenadas (somente para uploads locais).

## Requisitos

- Servidor PHP para executar os arquivos.
- Extensão PHP `fileinfo` para validação de imagens.
- Acesso a um navegador web para interação com a interface.

## Instruções de Uso

### 1. **Clonando o Repositório**

Clone o repositório para sua máquina local:

```bash
git clone https://github.com/seu-usuario/inventario-jogo.git
```

### 2. **Configurando o Ambiente**

1. **Instale o PHP**: Se não tiver o PHP instalado, baixe-o de [https://www.php.net/](https://www.php.net/).
2. **Suba o Servidor Local**: Navegue até o diretório do projeto e inicie um servidor local:

   ```bash
   php -S localhost:8000
   ```

3. **Estrutura do Projeto**: Certifique-se de que os arquivos estejam na seguinte estrutura:
   ```
   inventario-jogo/
   ├── index.php
   ├── adicionar_item.php
   ├── inventario.txt
   └── imagens/ (pasta para armazenar imagens)
   ```

### 3. **Usando o Sistema de Inventário**

- **Visualizando o Inventário**: Acesse a página `index.php` em seu navegador para ver os itens do inventário listados com suas imagens e quantidades.
- **Adicionando Itens**: Para adicionar novos itens, acesse `adicionar_item.php`. Preencha o formulário com o nome, a quantidade e a imagem (seja por upload ou fornecendo uma URL).
  - O item será adicionado ao inventário, e se já existir, sua quantidade será aumentada.
- **Armazenamento e Atualização**: O inventário é armazenado no arquivo `inventario.txt`, e ao adicionar ou atualizar itens, o arquivo é reescrito.

### 4. **Formato do Arquivo `inventario.txt`**

Cada linha do arquivo contém um item do inventário no formato:

```
nome_do_item;quantidade;imagem_url_ou_nome_do_arquivo
```

Exemplo:

```
Teste;2;https://th.bing.com/th/id/OIP.9pNRoF5qlpwsJtU6LHbpSgHaHa?rs=1&pid=ImgDetMain
```

## Tecnologias Utilizadas

- **PHP**: Para manipulação do backend e processamento de arquivos.
- **HTML/CSS**: Para construção da interface do usuário.
- **Bootstrap**: Para tornar a interface responsiva e fácil de usar.
- **Fontes Google**: Para a fonte estilizada "Press Start 2P" que lembra o estilo retro de jogos antigos.

## Contribuindo

1. Faça um fork do repositório.
2. Crie uma branch para sua modificação (`git checkout -b minha-modificacao`).
3. Comite suas alterações (`git commit -am 'Adiciona nova funcionalidade'`).
4. Envie para o repositório remoto (`git push origin minha-modificacao`).
5. Abra um pull request.
