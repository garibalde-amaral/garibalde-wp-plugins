# Plano de operação editorial, IA, n8n e Central de Mídia

## Objetivo operacional
O site deve ter uma operação editorial rastreável: pauta -> fonte -> rascunho -> revisão jurídica/editorial -> aprovação -> adaptação por canal -> agendamento -> confirmação por plataforma -> análise de resultados.

## Componentes
- WordPress: repositório canônico dos artigos, páginas, vídeos incorporados e rascunhos.
- n8n: coordenação de tarefas e integrações; credenciais devem residir em Credentials/secret store.
- Provedor de IA: gerar rascunhos, títulos, resumo, legenda, transcrição e variações. Não enviar dados confidenciais de clientes.
- Armazenamento de mídia: biblioteca do WordPress ou object storage autorizado, com limites, nomenclatura e retenção definidos.
- Agendador social: preferir uma conexão já disponível e licenciada, como Metricool, depois de confirmar marcas/canais e permissões.
- Monitoramento: log de execução sem tokens, retry limitado, deduplicação por idempotency key, alerta de erro e estado real por canal.

## Regras obrigatórias
1. Conteúdo jurídico não deve ser publicado automaticamente sem revisão e aprovação de pessoa autorizada.
2. O fluxo não deve afirmar que uma publicação foi feita sem confirmação da plataforma.
3. Notícias externas precisam registrar fonte/data e usar resumo curto com link original, respeitando direitos autorais.
4. A Central Digital do Cliente é o destino do atendimento geral. Consulta Processual continua exclusivamente para consulta de processos.
5. Vídeo com rosto/voz exige consentimento, ferramenta de renderização e aprovação; um fluxo n8n não cria por si só mídia sintética sem motor de IA.
6. “100% gratuito e sem erro” não é garantia tecnicamente demonstrável. Selecionar ferramentas conforme limites de uso, custo recorrente, segurança e compatibilidade.
7. A implantação real necessita credenciais autorizadas, configuração do servidor n8n, HTTPS e teste em homologação.

## Agenda editorial padrão para configurar
- Segunda: artigo educativo do escritório / área de atuação.
- Terça: vídeo curto educativo, uma pergunta comum e resposta geral.
- Quarta: resumo de notícia jurídica com fonte primária e data.
- Quinta: carrossel explicativo derivado de conteúdo aprovado.
- Sexta: vídeo ou artigo de dúvidas frequentes, sem promessa de resultado nem captação indevida.
- Mensal: relatório de desempenho, auditoria de links, revisão das fontes e calendário do mês seguinte.

Este é um calendário-base a validar; não representa publicações agendadas. Para ativar, escolher canais reais, fuso horário, conta do agendador, modelo de IA e regras de aprovação.
