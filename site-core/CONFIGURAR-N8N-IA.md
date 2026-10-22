# Configuração do n8n e IA — modo local-first

## Fluxos
- `n8n/GA-01-inbox-editorial.json`: entrada e validação de pauta.
- `n8n/GA-02-aprovacao-e-fila-social.json`: valida a aprovação e prepara a fila; **não publica** em rede social.
- `n8n/GA-03-gerar-rascunho-IA-WordPress.json`: gera rascunho por API compatível com OpenAI e envia ao WordPress como `draft`; não publica automaticamente.
- `n8n/GA-04-calendario-editorial-semanal.json`: executa toda segunda-feira às 08:00 no fuso `America/Sao_Paulo` e cria uma agenda semanal de cinco temas como rascunho editorial no WordPress. A agenda organiza tarefas, não publica os itens.

## Pré-requisitos
- Instância n8n controlada e acessível por HTTPS.
- Ollama (opção local sem cobrança por chamada) executando em rede alcançável pelo n8n, com modelo instalado, por exemplo `qwen2.5:7b`.
- WordPress HTTPS e usuário de integração com privilégios mínimos para criar posts, usando Application Password.
- Configuração de autenticação Header Auth em cada webhook n8n após importar o fluxo.

## Variáveis de ambiente
No servidor n8n, configurar no gerenciador seguro de ambiente:
- `GA_AI_BASE_URL`: padrão interno sugerido `http://ollama:11434/v1` quando ambos os serviços compartilham a rede Docker; adaptar ao ambiente real.
- `GA_AI_MODEL`: padrão `qwen2.5:7b`; precisa estar instalado no Ollama.
- `GA_AI_API_KEY`: opcional no Ollama local; em provedor de nuvem, usar a chave real em segredo protegido.
- `GA_WP_BASE_URL`: URL HTTPS do WordPress, sem barra final.
- No nó “Criar rascunho no WordPress”, selecione a credencial n8n **HTTP Basic Auth** com o usuário WordPress dedicado e a respectiva Application Password.

A expressão `$env` precisa estar permitida na instalação n8n; em ambientes que bloqueiam o acesso a variáveis, substitua as expressões por credenciais nativas de cada node. Nunca coloque segredos no JSON exportado, GitHub, prints ou arquivos compartilhados.

## Importação e configuração
1. Importe um JSON por vez em Workflows.
2. Para cada nó Webhook, escolha a credencial Header Auth e gere um segredo longo aleatório. Não reutilize senha do WordPress.
3. Configure as variáveis de ambiente e reinicie o n8n, se necessário.
4. Teste em modo manual com pauta fictícia, fonte HTTPS pública e request_id único.
5. Confirme no WordPress que o resultado foi criado como rascunho; confira título, resumo, corpo e fonte. Verifique o log do n8n sem expor segredos.
6. Não ative distribuição social até conectar adaptador autenticado de um agendador de fato, selecionar os canais institucionais e verificar o post no destino real. A conexão Metricool atual indica Facebook, TikTok e YouTube; o fluxo só permite esses três nesta fase. O Instagram `garibaldeamaral` foi tratado no histórico do projeto como perfil pessoal e, por segurança, fica bloqueado até confirmar e conectar o perfil institucional correto. LinkedIn/X também ficam bloqueados enquanto não houver conexão confirmada.

## Limitações honestas
- Modelo local evita cobrança por chamada, mas precisa de hardware, memória, espaço e operação contínua. Em hospedagem compartilhada, normalmente será necessário executar Ollama/n8n em outra máquina/servidor.
- Este fluxo produz rascunhos e não verifica, por conta própria, que leu o endereço de fonte. Para `news_summary`, envie o texto obtido da fonte primária em `source_text`; a origem permanece como referência para conferência.
- O fluxo social 02 só valida aprovação e enfileira; não se pode afirmar publicação até conectar e testar um adaptador (por exemplo, uma conta Metricool com as redes aprovadas).
- O fluxo não fornece deduplicação persistente completa nem agenda recorrente por si só; adicionar um banco de idempotência/registro e um Schedule Trigger antes de produção.
- Revisão humana jurídica/editorial é obrigatória antes da publicação.


## Fluxo semanal e duplicidade
O fluxo GA-04 roda na segunda às 08:00 em `America/Sao_Paulo` e cria um rascunho por semana. Não o execute manualmente novamente se a agenda daquela semana já tiver sido criada; não há ainda uma chave de idempotência persistente no WordPress, de modo que uma repetição manual pode criar outro rascunho.
