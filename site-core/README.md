# Core Institucional — Garibalde Amaral

Este diretório contém o **tema WordPress completo e independente** do novo código institucional. Não é um plugin de atualização nem um pacote de remendos. O tema substitui a camada principal de apresentação/templates e mantém separadas as funções de negócio e as integrações.

## Catálogo visual e geração automática

A fonte única é `photo-manifest-111.json`, transcrita do Livro Visual Mestre: **36 imagens para 9 destinos principais e 75 imagens para 15 áreas de atuação**. O código não escolhe imagens aleatórias nem usa os banners antigos com texto embutido.

- 106 imagens editoriais podem ser geradas automaticamente a partir dos prompts e rankings do livro com `tools/generate-photo-masters.py`.
- EQ-01 é um retrato real, importado do Livro Visual Mestre quando a fonte está disponível; nunca é substituído por rosto sintético.
- LOC-02 é uma vista real de Anápolis de Wikimedia Commons, com crédito e licença CC BY-SA 4.0.
- LOC-03 é um mapa cartográfico real incorporado na página Localização.
- LOC-01 e LOC-04 exigem fotografias reais correspondentes à fachada e ao acesso/local. O script procura esses ativos na biblioteca WordPress oficial e aceita fontes fornecidas no diretório `source-media`; não inventa fachadas ou ruas.

Os nomes finais são canônicos (por exemplo, `HOME-01.webp`, `QS-01.webp`, `DIREITO_TRIBUTARIO-01.webp`). O carrossel e as páginas de área procuram esses nomes automaticamente. Os primeiros dois rankings de cada área são as imagens iniciais.

## Execução automatizada no Windows

1. Inicie o ComfyUI local com um checkpoint SDXL fotorealístico instalado.
2. Execute `GERAR-FOTOS-E-MONTAR.bat` na pasta `site-core`.
3. A rotina importa/baixa fontes reais, gera os 106 ativos elegíveis, valida dimensões e manifesto e somente então cria `garibalde-institucional-2.0.0.zip`.

Não é preciso escolher cada foto, abrir o personalizador nem substituir imagens manualmente. Se não houver um backend de IA local ou se as fotografias reais obrigatórias de localização não puderem ser confirmadas, o processo interrompe o empacotamento em vez de fingir que o pacote está completo. Esta execução não foi feita neste ambiente: não há ComfyUI/checkpoint disponível aqui.

## Conteúdo e navegação

O tema inclui templates para Home, páginas principais, Central de Mídia, Localização, arquivos de artigos, páginas individuais e as 15 áreas. Os textos-base das áreas são inseridos pelo código com finalidade informativa, sem dados de clientes ou promessas de resultado.

A navegação mantém os nove destinos do Livro Visual Mestre, acrescentando Central de Mídia; os botões de serviço ficam separados. O atendimento geral aponta para a Central Digital do Cliente. Consulta Processual é exclusiva para consulta de processos.

## Segurança e publicação

- Nenhum plugin antigo é removido automaticamente. A migração das funções existentes depende de inventário e homologação do banco, slugs, widgets e endpoints.
- O tema e a matriz visual ficam em branch separada; `main` e o WordPress da Locaweb não foram alterados.
- O CI só publica um ZIP instalável quando o conjunto de imagens canônicas passar no verificador. Um pacote de código-fonte/automação pode existir antes disso, mas não é um tema pronto para produção.
- A troca de tema não substitui backup restaurável, teste em staging, mapa de redirecionamentos e plano de rollback.
