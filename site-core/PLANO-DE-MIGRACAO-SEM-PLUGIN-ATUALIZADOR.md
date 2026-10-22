# Plano de migração do código-mãe

## Objetivo
Substituir amplamente a camada de apresentação e templates legados, preservando dados, URLs e funções críticas. A troca do tema não reescreve automaticamente banco de dados, plugins ou todo o PHP antigo.

## Antes de instalar
- Inventariar tema ativo/child theme, functions.php, widgets, menus, shortcodes, tipos personalizados e metadados.
- Mapear quais plugins personalizados imprimem cabeçalho/menu, WhatsApp, redes, Consulta Processual e Central Digital; impedir dois componentes donos da mesma área.
- Mapear as URLs reais e testar status HTTP antes de criar redirects.
- Homologar em cópia restaurada, não apenas confiar que há backups.
- Desativar um plugin antigo por vez, somente quando a função substituta estiver validada e seus dados preservados.

## Critérios de aceite
Testar 360, 390, 430, 768, 1024, 1280 e 1440 px; teclado/foco; zoom 200%; menu, cabeçalho, marca, hero, áreas, notícias, botões flutuantes e rodapé; 404 e paginação.

## Instalação automática
Um instalador seguro por clique requer implantação autenticada. Um tema não deve apagar ou sobrescrever o próprio diretório ao ser ativado, nem executar código remoto por endpoint público. A estratégia recomendada é deploy versionado por Git/SSH/CI ou upload controlado do ZIP e ativação após homologação.

## Rollback
Manter tema e plugins antigos até o aceite; reativar tema anterior e restaurar arquivos/banco conforme procedimento de rollback validado em caso de regressão.
