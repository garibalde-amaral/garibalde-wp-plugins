# Garibalde Amaral — repositório de atualizações WordPress

Repositório público destinado exclusivamente à distribuição de código dos plugins personalizados do site da Garibalde Amaral Advogados Associados.

## Conteúdo

- `manifest.json`: manifesto de versões do atualizador WordPress.
- `packages/`: pacotes ZIP individuais dos plugins.
- `CHANGELOG.md`: histórico inicial.
- `SHA256SUMS.txt`: checksums dos arquivos do kit.

## URL do manifesto

`https://raw.githubusercontent.com/garibalde-amaral/garibalde-wp-plugins/main/manifest.json`

## Segurança e estado de implantação

Não incluir senhas, tokens, credenciais, dados de clientes, bases de dados, backups, logs privados nem processos judiciais. Este repositório foi preparado para publicar código de plugins apenas. Os pacotes devem evitar endereços de e-mail pessoais embutidos como valores padrão; configure os contatos no painel WordPress. O pacote Modo Manutenção 1.0.2 remove esse valor padrão e só exibe o botão de e-mail quando endereço válido estiver configurado.

**Antes de habilitar atualizações automáticas na produção:** validar o manifesto no WordPress, conferir o mapeamento do plugin “Consulta Processual Segura” (o gerenciador instalado atualmente o identifica como não instalado apesar de aparecer ativo na lista de plugins), fazer backup restaurável, testar uma atualização manual e testar as funcionalidades afetadas. Manter a opção de instalação automática desativada até a validação.

O repositório distribui versões previamente criadas e aprovadas. Ele não cria, revisa ou publica novas versões por conta própria.
