# Garibalde Amaral — repositório de atualizações WordPress

Repositório público destinado exclusivamente à distribuição de código dos plugins personalizados do site da Garibalde Amaral Advogados Associados.

## Conteúdo
- `manifest.json`: manifesto de versões do atualizador WordPress.
- `packages/`: pacotes ZIP individuais dos plugins.
- `CHANGELOG.md`: histórico das versões publicadas.
- `SHA256SUMS.txt`: checksums SHA-256 dos pacotes ZIP.

## URL do manifesto
`https://raw.githubusercontent.com/garibalde-amaral/garibalde-wp-plugins/main/manifest.json`

## Estado de implantação e segurança
O repositório é público. Não incluir senhas, tokens, credenciais, dados de clientes, bases de dados, backups, logs privados ou processos judiciais. Os pacotes devem conter apenas código e recursos necessários aos plugins.

Antes de habilitar atualizações automáticas na produção:
1. Validar o manifesto no WordPress.
2. Manter backup recente e restaurável.
3. Testar manualmente cada atualização e conferir as funcionalidades afetadas.
4. Confirmar links da Consulta Processual Segura e do bloco “Últimas Notícias” após a versão 1.6.1.
5. Ativar a automação somente depois dos testes.

A versão 1.6.1 da Consulta Processual Segura foi publicada para corrigir links e preservar o diretório do plugin já instalado. A validação funcional no site de produção permanece pendente até a conferência visual após a atualização.

O repositório distribui versões previamente criadas e aprovadas. Ele não cria, revisa ou publica novas versões por conta própria.
