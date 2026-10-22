# Fotografia-mestra: produção automatizada por IA e ativos que exigem fonte real

O manifesto ../photo-manifest-111.json contém 111 briefs canônicos extraídos do Livro Visual Mestre. Os nomes e rankings foram transcritos das decisões visuais, não inventados. Os arquivos finais aprovados ainda precisam existir individualmente.

## Regra de execução
- 106 ativos podem ser gerados por IA, a partir dos prompts específicos do manifesto. Cada imagem será salva no nome canônico, com proporção horizontal, sem texto, logos artificiais ou dados pessoais.
- 5 ativos exigem uma fonte real e não podem ser fabricados como se fossem documentos, fachadas ou pessoas reais: EQ-01 (retratos reais autorizados da equipe), LOC-01 (fachada real autorizada), LOC-02 (vista real verificada de Anápolis), LOC-03 (mapa oficial incorporado) e LOC-04 (rua/acesso real verificado).
- Imagens geradas passam por revisão técnica antes de serem marcadas como aprovadas. O manifesto não altera status para aprovado automaticamente.
- Cada área tem 5 opções; as prioridades 1 e 2 são as imagens iniciais do carrossel. As opções 3–5 ficam como alternativas editoriais.
- As nove páginas principais têm quatro opções canônicas cada. O código resolve arquivos da Biblioteca de Mídia do WordPress por nome canônico e usa o arquivo empacotado como fallback quando apropriado. Quando a foto mestra ainda não existe, a interface mantém uma apresentação textual/visual neutra; não escolhe imagem genérica aleatória.

## Serviço de geração recomendado: ComfyUI local
Esta rota evita custo por geração de imagem quando executada num computador/servidor próprio, mas requer hardware compatível, modelo instalado, energia, armazenamento, rede segura e operação contínua. Não é uma plataforma mágica de hospedagem gratuita, e o desempenho depende da GPU/RAM.

Variáveis de ambiente no n8n (não no GitHub):
- GA_COMFYUI_BASE_URL, por exemplo http://comfyui:8188.
- GA_COMFYUI_WORKFLOW_JSON ou configuração do workflow ComfyUI que use um checkpoint instalado.
- GA_WP_BASE_URL, URL HTTPS do WordPress.
- Credencial n8n de HTTP Basic Auth com um usuário WordPress dedicado e Application Password.

## Ciclo de vida
1. Ler o manifesto e filtrar apenas generation_allowed=true.
2. Construir prompt e gerar a imagem com o pipeline ComfyUI.
3. Validar dimensões, arquivo, foco, ausência de texto/artifacts e adequação da cena ao brief.
4. Nomear o arquivo exatamente conforme filename.
5. Fazer upload para a Biblioteca de Mídia do WordPress, definindo title e alt_text descritivos.
6. Conferir que a URL canônica resolveu no tema.
7. Aprovar manualmente o ativo na matriz de produção antes de marcar como liberado para publicação.

## Estado atual
Este documento e o manifesto estão versionados; o backend ComfyUI, o checkpoint, a conta WordPress de integração e a revisão visual humana ainda precisam ser conectados/testados. Não declarar as 111 fotografias prontas enquanto os 111 arquivos finais não existirem e a matriz de produção não registrar o estado aprovado.
