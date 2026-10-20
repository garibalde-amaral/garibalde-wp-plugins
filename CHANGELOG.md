# Changelog

## Gerenciador de Atualizações Automáticas 1.0.1
- Remove referência fixa ao caminho obsoleto `consulta-processual-segura/consulta-processual-segura.php` da tabela de plugins.
- A tabela passa a listar o caminho da Consulta Processual declarado no manifesto, evitando a linha falsa “Instalado: Não”.
- Atualiza o texto de ajuda do campo de manifesto e o aviso de implantação para refletir o funcionamento atual.
- PHP passou em `php -l`; o ZIP passou em teste de integridade. A instalação no site de produção ainda deve ser confirmada após atualização manual.

## Consulta Processual Segura 1.6.1 — correção de links
- Publicado `packages/consulta-processual-segura-1.6.1-links-hotfix.zip`.
- Manifesto usa o caminho confirmado no WordPress: `Garibalde_Consulta_Processual_Design_v1.5/consulta-processual-segura.php`.
- O teste real dos destinos da consulta e da navegação do site permanece sujeito à verificação no WordPress de produção.

## Consulta Processual Segura 1.6.0 — pacote compatível com o caminho instalado
- Publicado `packages/consulta-processual-segura-1.6.0-pathfix.zip`, preservando a pasta existente `Garibalde_Consulta_Processual_Design_v1.5/`.
- Atualizado o manifesto para reconhecer o caminho real do plugin.

## Modo Manutenção 1.0.2 — correção de privacidade
- Removido endereço pessoal do código-fonte e dos valores padrão do plugin.
- O botão de e-mail só aparece quando há endereço válido configurado.

## Kit inicial
- Preparada infraestrutura de distribuição por manifesto HTTPS.
- Incluídos pacotes de consulta processual, manutenção, alertas R.A.I., WhatsApp e gerenciador de atualizações.
- A distribuição de pacotes não substitui backup, testes e validação de cada atualização no WordPress.
