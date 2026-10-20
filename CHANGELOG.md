# Changelog inicial

## Consulta Processual Segura 1.6.1 — correção de links
- Publicado `packages/consulta-processual-segura-1.6.1-links-hotfix.zip`.
- Manifesto aponta para a versão 1.6.1 usando o caminho instalado confirmado no WordPress: `Garibalde_Consulta_Processual_Design_v1.5/consulta-processual-segura.php`.
- Ajustado o link “Acessar todas as notícias” para o arquivo de artigos `/artigos/` e preservados links encontrados no bloco do carrossel.
- Atualizado `SHA256SUMS.txt` com o SHA-256 do ZIP 1.6.1.
- ZIP passou no teste de integridade; PHP passou na verificação sintática. A validação visual e funcional no site de produção permanece pendente.

## Consulta Processual Segura 1.6.0 — pacote com caminho compatível
- Publicado `packages/consulta-processual-segura-1.6.0-pathfix.zip`, preservando a pasta atual `Garibalde_Consulta_Processual_Design_v1.5/`.
- Atualizado o manifesto para identificar o plugin pelo caminho real confirmado no WordPress.

## Modo Manutenção 1.0.2 — 20/10/2026
- Removido o endereço Gmail pessoal do código-fonte e dos valores padrão do plugin Modo Manutenção.
- O botão de e-mail só aparece quando há um endereço válido configurado. Valores já gravados nas configurações do WordPress não são sobrescritos automaticamente.

## Kit inicial — 19/10/2026
- Preparada infraestrutura por manifesto HTTPS.
- Incluídos pacotes para consulta processual, manutenção, alertas R.A.I. e WhatsApp.
- Incluída versão corretiva dos alertas R.A.I., que captura falhas no envio de e-mail em vez de gerar erro fatal; a entrega depende de SMTP autenticado.
