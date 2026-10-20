# Changelog

## Consulta Processual Segura 1.6.1 — correção de links
- Publicado `packages/consulta-processual-segura-1.6.1-links-hotfix.zip`.
- Manifesto atualizado para a versão 1.6.1 usando o caminho confirmado no WordPress: `Garibalde_Consulta_Processual_Design_v1.5/consulta-processual-segura.php`.
- Corrigido o destino do link “Acessar todas as notícias” para a página de artigos `/artigos/`.
- Atualizado `SHA256SUMS.txt` para registrar o SHA-256 do pacote.
- O ZIP passou no teste de integridade e o PHP passou na verificação sintática. A validação funcional no site de produção ainda precisa ser concluída.

## Consulta Processual Segura 1.6.0 — pacote compatível com o caminho instalado
- Publicado `packages/consulta-processual-segura-1.6.0-pathfix.zip`, preservando a pasta existente `Garibalde_Consulta_Processual_Design_v1.5/`.
- Atualizado o manifesto para reconhecer o caminho real do plugin.

## Modo Manutenção 1.0.2 — correção de privacidade
- Removido o endereço Gmail pessoal do código-fonte e dos valores padrão.
- O botão de e-mail só aparece quando há um endereço válido configurado. Valores já gravados no WordPress não são sobrescritos automaticamente.

## Kit inicial
- Preparada infraestrutura de distribuição por manifesto HTTPS.
- Incluídos pacotes de consulta processual, manutenção, alertas R.A.I., WhatsApp e gerenciador de atualizações.
- A distribuição de pacotes não substitui teste, backup e validação de cada atualização no WordPress.
