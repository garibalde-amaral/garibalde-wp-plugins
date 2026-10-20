# Changelog inicial

## Consulta Processual Segura 1.6.0 — pacote com caminho compatível
- Publicado `packages/consulta-processual-segura-1.6.0-pathfix.zip`, preservando a pasta atual `Garibalde_Consulta_Processual_Design_v1.5/` para evitar instalar em diretório diferente.
- Atualizado o manifesto para identificar o plugin pelo caminho real confirmado no WordPress.
- Atualizado `SHA256SUMS.txt` com o hash SHA-256 do novo pacote.
- O arquivo PHP passou na verificação sintática; a atualização em produção ainda requer teste controlado.

## Modo Manutenção 1.0.2 — 20/10/2026
- Removido o endereço Gmail pessoal do código-fonte e dos valores padrão do plugin Modo Manutenção.
- O botão de e-mail só aparece quando há um endereço válido configurado. Valores já gravados nas configurações do WordPress não são sobrescritos automaticamente.

## Kit inicial — 19/10/2026
- Preparada infraestrutura por manifesto HTTPS.
- Incluídos pacotes para consulta processual, manutenção, alertas R.A.I. e WhatsApp.
- Incluída versão corretiva dos alertas R.A.I., que captura falhas no envio de e-mail em vez de gerar erro fatal; a entrega depende de SMTP autenticado.
