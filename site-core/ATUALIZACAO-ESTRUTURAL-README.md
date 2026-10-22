# Modernização estrutural do site antigo — escopo aprovado

O diretório `site-core/garibalde-institucional/` é um tema completo WordPress e não um plugin instalador. O objetivo é substituir de forma ampla a camada visual e os templates antigos, mantendo o banco de dados e recursos cuja migração ainda não foi validada.

## Requisito essencial
Não tratar esse projeto como “mais um plugin para remendar o site”. A camada principal passa a ser o tema versionado, com templates próprios, responsividade, cabeçalho/menus/hero/notícias/áreas/rodapé. A lógica persistente de operação e integrações deve ser desacoplada do tema para que uma futura troca de design não elimine workflows.

## Menu pretendido
1. Início
2. Institucional
3. Áreas de Atuação
4. Equipe
5. Artigos e Notícias
6. Central de Mídia
7. Central Digital do Cliente
8. Consulta Processual
9. Contato

A ordem e os slugs devem ser reconciliados no WordPress real antes de produção. O cabeçalho deve reduzir sua altura em telas menores sem cobrir a marca, ocultar menu sob botão acessível em mobile e respeitar o espaçamento da logo. O botão geral de atendimento vai à Central Digital do Cliente — nunca à Consulta Processual.

## Visual
- Preservar proporção e nitidez da logomarca oficial. A alteração do globo só ocorre depois de aprovar arquivo mestre exato; não desenhar uma marca substituta por inferência.
- Hero suporta 3 mensagens/imagens, controles manuais acessíveis e áreas para configurar imagens. O mapeamento real dos três arquivos oficiais ainda precisa de confirmação.
- CSS responsivo com foco visível, breakpoints, reduced motion e layout de conteúdo fluido.
- Não usar perfis sociais inventados. Só mostrar URLs institucionais confirmadas.

## Central de Mídia e robôs
O tema cria ponto de entrada visual para Central de Mídia; os fluxos de IA, n8n e publicação precisam ser implementados como serviço externo. O conteúdo deve ser gerado em rascunho, passar por revisão/aprovação humana e ser agendado por integração autenticada. Nenhum token deve ser gravado no tema, ZIP, manifesto público ou GitHub.
