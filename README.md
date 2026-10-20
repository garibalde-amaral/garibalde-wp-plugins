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
Não incluir senhas, tokens, credenciais, dados de clientes, bases de dados, backups, logs privados ou processos judiciais. Os pacotes devem conter somente código e recursos necessários aos plugins.

Antes de habilitar atualizações automáticas em produção:
1. Validar o manifesto no WordPress.
2. Manter backup recente e restaurável.
3. Testar manualmente cada atualização e verificar as funcionalidades afetadas.
4. Confirmar a Consulta Processual e os links da página inicial após a atualização.
5. Ativar atualizações automáticas somente depois dos testes.

A versão 1.0.1 do gerenciador remove uma referência fixa obsoleta ao arquivo da Consulta Processual. A instalação e a conferência na tela de administração de produção ainda são necessárias.

O repositório distribui versões previamente preparadas e aprovadas; não cria, revisa ou publica novas versões por conta própria.
