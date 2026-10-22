<?php
/**
 * Catálogo canônico do Livro Visual Mestre.
 * Imagens são resolvidas automaticamente pelos nomes oficiais. Não usar recortes de pranchas
 * nem imagens genéricas no lugar de mestres ainda não produzidos/aprovados.
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

function ga_core_areas_catalog() {
    return array(
        array('title'=>'Administrativo e Contratos Públicos','slug'=>'administrativo-contratos-publicos','image1'=>'ADMINISTRATIVO_E_CONTRATOS_PUBLICOS-01.webp','image2'=>'ADMINISTRATIVO_E_CONTRATOS_PUBLICOS-03.webp','lead'=>'Atuação jurídica voltada à relação entre Administração Pública, contratos, licitações e controle de legalidade.','copy'=>'A atuação nesta área exige leitura rigorosa dos instrumentos convocatórios, contratos, atos administrativos, prazos e registros que sustentam cada decisão. A análise deve considerar o contexto institucional, a documentação disponível e os objetivos legítimos do interessado.','focus'=>'Licitações e contratos públicos; análise de editais e instrumentos contratuais; acompanhamento de atos administrativos; prevenção e tratamento de controvérsias.'),
        array('title'=>'Arbitragem e Mediação','slug'=>'arbitragem-mediacao','image1'=>'ARBITRAGEM_E_MEDIACAO-01.webp','image2'=>'ARBITRAGEM_E_MEDIACAO-02.webp','lead'=>'Métodos estruturados para a prevenção e a resolução de conflitos com estratégia, confidencialidade e diálogo.','copy'=>'A avaliação do método adequado considera a natureza do conflito, as cláusulas existentes, a autonomia das partes, a urgência e os custos envolvidos. A negociação e os meios consensuais podem reduzir desgaste quando existe espaço juridicamente seguro para construir uma solução.','focus'=>'Análise de cláusulas compromissórias; preparação de estratégia de negociação; mediação; procedimentos arbitrais; formalização de acordos.'),
        array('title'=>'Contencioso Civil e Comercial','slug'=>'contencioso-civil-comercial','image1'=>'CONTENCIOSO_CIVIL_E_COMERCIAL-01.webp','image2'=>'CONTENCIOSO_CIVIL_E_COMERCIAL-02.webp','lead'=>'Condução técnica de disputas civis e comerciais, com atenção aos documentos, riscos e alternativas processuais.','copy'=>'Uma estratégia contenciosa responsável começa pela organização dos fatos, das provas e dos contratos, seguida da análise do procedimento aplicável, dos prazos e das consequências práticas de cada alternativa. A avaliação de risco deve ser individualizada e não permite prometer resultado.','focus'=>'Análise contratual; demandas de cobrança e responsabilidade civil; controvérsias entre empresas; produção e organização de provas; negociação e acompanhamento processual.'),
        array('title'=>'Direito Ambiental','slug'=>'direito-ambiental','image1'=>'DIREITO_AMBIENTAL-01.webp','image2'=>'DIREITO_AMBIENTAL-02.webp','lead'=>'Orientação jurídica para questões ambientais, obrigações regulatórias e prevenção de riscos.','copy'=>'As questões ambientais podem envolver licenciamento, condicionantes, fiscalização, responsabilidade, contratos e interação com órgãos públicos. A análise depende da atividade, da localização, das licenças e dos documentos técnicos disponíveis.','focus'=>'Licenciamento e condicionantes; análise de autos e notificações; obrigações ambientais; contratos e gestão de risco regulatório; estratégias administrativas e judiciais.'),
        array('title'=>'Direito Bancário e Financeiro','slug'=>'direito-bancario-financeiro','image1'=>'DIREITO_BANCARIO_E_FINANCEIRO-01.webp','image2'=>'DIREITO_BANCARIO_E_FINANCEIRO-03.webp','lead'=>'Análise jurídica de contratos, operações financeiras e controvérsias bancárias a partir de documentos e dados verificáveis.','copy'=>'A avaliação exige conferência de contratos, extratos, encargos, garantias, histórico de pagamentos e comunicações. Cada operação deve ser examinada de acordo com sua estrutura e com as regras vigentes aplicáveis, sem generalizações automáticas.','focus'=>'Contratos bancários; operações de crédito; garantias; revisão documental; cobranças e controvérsias financeiras; prevenção de litígios.'),
        array('title'=>'Direito de Família e Sucessões','slug'=>'direito-familia-sucessoes','image1'=>'DIREITO_DE_FAMILIA_E_SUCESSOES-01.webp','image2'=>'DIREITO_DE_FAMILIA_E_SUCESSOES-02.webp','lead'=>'Acompanhamento jurídico cuidadoso de relações familiares e questões sucessórias, com respeito às pessoas envolvidas.','copy'=>'Demandas familiares e sucessórias frequentemente combinam documentos, patrimônio, interesses de crianças e adolescentes e decisões pessoais sensíveis. A orientação deve observar sigilo, proteção de dados e as particularidades de cada situação.','focus'=>'Divórcio e dissolução de união; guarda e convivência; alimentos; planejamento sucessório; inventário e partilha; acordos familiares juridicamente adequados.'),
        array('title'=>'Direito Imobiliário','slug'=>'direito-imobiliario','image1'=>'DIREITO_IMOBILIARIO-01.webp','image2'=>'DIREITO_IMOBILIARIO-02.webp','lead'=>'Segurança documental e contratual em negócios, propriedade e relações imobiliárias.','copy'=>'Operações imobiliárias pedem exame das matrículas, certidões, contratos, obrigações, regularidade e condições de pagamento. A análise preventiva ajuda a identificar pendências e a documentar responsabilidades antes de decisões relevantes.','focus'=>'Compra e venda; locações; contratos imobiliários; regularização; condomínio; posse e propriedade; análise de riscos documentais.'),
        array('title'=>'Direito Penal','slug'=>'direito-penal','image1'=>'DIREITO_PENAL-01.webp','image2'=>'DIREITO_PENAL-02.webp','lead'=>'Atuação penal técnica e individualizada, com respeito às garantias legais e à confidencialidade.','copy'=>'A análise criminal depende dos fatos apurados, dos elementos de prova, dos atos processuais e dos direitos das pessoas envolvidas. Cada caso exige exame próprio dos autos e da fase procedimental, sem conclusões antecipadas nem garantia de desfecho.','focus'=>'Orientação e defesa técnica; acompanhamento de atos investigativos e processuais; análise de provas; preparação de manifestações e recursos cabíveis.'),
        array('title'=>'Direito Trabalhista','slug'=>'direito-trabalhista','image1'=>'DIREITO_TRABALHISTA-01.webp','image2'=>'DIREITO_TRABALHISTA-02.webp','lead'=>'Gestão jurídica de relações de trabalho com foco em documentos, prevenção e solução de controvérsias.','copy'=>'Questões trabalhistas exigem reconstrução cronológica da relação, conferência de registros, contratos, pagamentos, comunicações e demais provas. A orientação varia conforme a posição jurídica, a atividade e as circunstâncias concretas.','focus'=>'Consultoria preventiva; contratos e políticas; análise de verbas e registros; negociação; reclamações e defesas trabalhistas.'),
        array('title'=>'Direito Eleitoral','slug'=>'direito-eleitoral','image1'=>'DIREITO_ELEITORAL-01.webp','image2'=>'DIREITO_ELEITORAL-02.webp','lead'=>'Acompanhamento jurídico de questões eleitorais com atenção a prazos, registros, propaganda e prestação de contas.','copy'=>'O ambiente eleitoral possui calendários e regras próprias, que variam conforme o pleito e o ato praticado. A avaliação deve conferir as normas vigentes, as orientações oficiais aplicáveis e a documentação específica, sem extrapolar informação não confirmada.','focus'=>'Orientação eleitoral; análise de propaganda e conteúdo; registros e documentos; prestação de contas; acompanhamento de procedimentos.'),
        array('title'=>'Empresarial e Recuperação de Empresas','slug'=>'empresarial-recuperacao-empresas','image1'=>'EMPRESARIAL_E_RECUPERACAO_DE_EMPRESAS-01.webp','image2'=>'EMPRESARIAL_E_RECUPERACAO_DE_EMPRESAS-04.webp','lead'=>'Estratégia jurídica empresarial para contratos, governança, reorganização e enfrentamento de crises.','copy'=>'A atuação empresarial considera a estrutura da organização, os contratos, os riscos operacionais, os credores e a continuidade das atividades. Em situações de crise, a análise documentada das alternativas deve anteceder decisões que afetem o negócio e seus interessados.','focus'=>'Contratos empresariais; governança; negociação com credores; reorganização; prevenção de litígios; avaliação de alternativas legalmente disponíveis.'),
        array('title'=>'Justiça Desportiva','slug'=>'justica-desportiva','image1'=>'JUSTICA_DESPORTIVA-01.webp','image2'=>'JUSTICA_DESPORTIVA-05.webp','lead'=>'Análise jurídica de relações e controvérsias desportivas, regulamentos e procedimentos disciplinares.','copy'=>'Questões desportivas demandam identificação da entidade competente, do regulamento aplicável, dos prazos e dos meios de impugnação previstos. A estratégia depende dos fatos, da documentação e da estrutura normativa da modalidade e da competição.','focus'=>'Regulamentos e contratos desportivos; procedimentos disciplinares; direitos e deveres de atletas e entidades; análise de decisões e recursos cabíveis.'),
        array('title'=>'Direito Previdenciário','slug'=>'direito-previdenciario','image1'=>'DIREITO_PREVIDENCIARIO-04.webp','image2'=>'DIREITO_PREVIDENCIARIO-01.webp','lead'=>'Orientação jurídica previdenciária baseada no histórico contributivo, nos documentos e nas regras aplicáveis.','copy'=>'A avaliação previdenciária depende dos vínculos, contribuições, períodos reconhecíveis, documentos e requisitos vigentes na data relevante. Simulações não substituem conferência dos dados oficiais e não garantem a concessão de benefício.','focus'=>'Análise de histórico contributivo; requerimentos e recursos administrativos; organização documental; revisão de decisões; planejamento previdenciário individualizado.'),
        array('title'=>'Relação de Consumo','slug'=>'relacao-consumo','image1'=>'RELACAO_DE_CONSUMO-01.webp','image2'=>'RELACAO_DE_CONSUMO-05.webp','lead'=>'Tratamento jurídico de conflitos de consumo com base em contratos, oferta, comprovantes e histórico de atendimento.','copy'=>'A análise de uma relação de consumo exige identificar o produto ou serviço, a oferta, os documentos, as comunicações e a sequência dos acontecimentos. A orientação deve distinguir fatos comprovados de alegações e avaliar soluções proporcionais ao caso.','focus'=>'Contratos de consumo; vícios e falhas de serviço; cobranças; atendimento e reclamações; negociação; medidas administrativas ou judiciais adequadas.'),
        array('title'=>'Direito Tributário','slug'=>'direito-tributario','image1'=>'DIREITO_TRIBUTARIO-01.webp','image2'=>'DIREITO_TRIBUTARIO-02.webp','lead'=>'Análise jurídica de obrigações tributárias, conformidade fiscal, controvérsias e alternativas legalmente disponíveis.','copy'=>'Questões tributárias exigem verificar o tributo, o período, a atividade, os documentos, os prazos e a norma vigente aplicável. Planejamentos e contestações precisam ser fundamentados em dados reais e avaliação individualizada, sem promessas de economia ou resultado.','focus'=>'Obrigações e procedimentos fiscais; análise de autuações; planejamento dentro da legalidade; consultas; defesas e recursos administrativos ou judiciais.')
    );
}

function ga_core_register_area_type() {
    register_post_type('ga_area_atuacao', array(
        'labels' => array(
            'name' => 'Áreas de Atuação',
            'singular_name' => 'Área de Atuação',
            'add_new_item' => 'Adicionar Área de Atuação',
            'edit_item' => 'Editar Área de Atuação',
            'menu_name' => 'Áreas de Atuação',
        ),
        'public' => true,
        'show_in_rest' => true,
        'has_archive' => false,
        'rewrite' => array('slug' => 'area-de-atuacao', 'with_front' => false),
        'menu_icon' => 'dashicons-index-card',
        'supports' => array('title', 'editor', 'excerpt', 'thumbnail', 'revisions'),
    ));
}
add_action('init', 'ga_core_register_area_type');

function ga_core_seed_areas() {
    if ( ! post_type_exists('ga_area_atuacao') ) { ga_core_register_area_type(); }
    foreach ( ga_core_areas_catalog() as $area ) {
        $existing = get_page_by_path($area['slug'], OBJECT, 'ga_area_atuacao');
        if ( $existing instanceof WP_Post ) {
            update_post_meta($existing->ID, '_ga_core_image_1', $area['image1']);
            update_post_meta($existing->ID, '_ga_core_image_2', $area['image2']);
            // If this theme previously created the starter page, keep it fully available;
            // pages not created by GA Core are never published by this migration step.
            if ( get_post_meta($existing->ID, '_ga_core_seeded_by_theme', true) === '111-v1'
                && $existing->post_status === 'draft' ) {
                wp_update_post(array('ID'=>$existing->ID,'post_status'=>'publish'));
            }
            continue;
        }
        $content = '<p>' . esc_html($area['lead']) . '</p><h2>Como a análise jurídica é estruturada</h2><p>' . esc_html($area['copy']) . '</p><h2>Temas relacionados</h2><p>' . esc_html($area['focus']) . '</p><p>O conteúdo é informativo e não substitui a análise individual de documentos e circunstâncias. A aplicação de regras, prazos e estratégias depende da verificação dos fatos e da legislação vigente pertinente.</p>';
        $id = wp_insert_post(array(
            'post_type' => 'ga_area_atuacao',
            // Complete general-information pages are seeded with a caution/disclaimer and no promise
            // of result; no individual client facts or invented case outcomes are included.
            'post_status' => 'publish',
            'post_title' => $area['title'],
            'post_name' => $area['slug'],
            'post_content' => $content,
            'post_excerpt' => $area['lead'],
        ), true);
        if ( ! is_wp_error($id) && $id ) {
            update_post_meta($id, '_ga_core_image_1', $area['image1']);
            update_post_meta($id, '_ga_core_image_2', $area['image2']);
            update_post_meta($id, '_ga_core_image_manifest_version', '111-v1');
            update_post_meta($id, '_ga_core_seeded_by_theme', '111-v1');
        }
    }
    $hub = get_page_by_path('area-de-atuacao', OBJECT, 'page');
    if ( ! $hub ) {
        $hub_id = wp_insert_post(array(
            'post_type' => 'page',
            'post_status' => 'publish',
            'post_title' => 'Áreas de Atuação',
            'post_name' => 'area-de-atuacao',
            'post_content' => '<!-- Hub dinâmico gerado pelo tema GA Core. -->',
        ));
        if ( ! is_wp_error($hub_id) && $hub_id ) {
            update_post_meta($hub_id, '_wp_page_template', 'page-area-de-atuacao.php');
        }
    } else if ( ! get_page_template_slug($hub->ID) ) {
        update_post_meta($hub->ID, '_wp_page_template', 'page-area-de-atuacao.php');
    }
    flush_rewrite_rules(false);
}
add_action('after_switch_theme', 'ga_core_seed_areas');

function ga_core_area_asset_url($filename) {
    $filename = sanitize_file_name((string)$filename);
    if ( ! $filename ) { return ''; }
    $base = trailingslashit(get_template_directory()) . 'assets/images/areas/';
    $web = trailingslashit(get_template_directory_uri()) . 'assets/images/areas/';
    if ( is_file($base . $filename) ) { return $web . rawurlencode($filename); }
    $slug = sanitize_title(pathinfo($filename, PATHINFO_FILENAME));
    $attachments = get_posts(array(
        'post_type' => 'attachment', 'post_status' => 'inherit', 'name' => $slug,
        'posts_per_page' => 1, 'fields' => 'ids', 'no_found_rows' => true,
    ));
    if ( ! empty($attachments[0]) ) {
        $url = wp_get_attachment_image_url((int)$attachments[0], 'full');
        if ( $url ) { return $url; }
    }
    return '';
}

function ga_core_get_area_images($post_id) {
    $filenames = array(
        (string)get_post_meta($post_id, '_ga_core_image_1', true),
        (string)get_post_meta($post_id, '_ga_core_image_2', true),
    );
    $images = array();
    foreach ( $filenames as $index => $filename ) {
        $images[] = array(
            'id' => $filename ? pathinfo($filename, PATHINFO_FILENAME) : '',
            'file' => $filename,
            'url' => ga_core_area_asset_url($filename),
            'alt' => get_the_title($post_id) . ' — imagem editorial ' . ( $index + 1 ),
        );
    }
    return $images;
}

function ga_core_missing_area_assets() {
    $missing = array();
    foreach ( ga_core_areas_catalog() as $area ) {
        foreach ( array($area['image1'], $area['image2']) as $filename ) {
            if ( ! ga_core_area_asset_url($filename) ) { $missing[] = $filename; }
        }
    }
    return $missing;
}

function ga_core_admin_asset_notice() {
    if ( ! current_user_can('manage_options') ) { return; }
    $missing = ga_core_missing_area_assets();
    if ( empty($missing) ) { return; }
    printf(
        '<div class="notice notice-warning"><p><strong>Garibalde Core — mídia mestra pendente:</strong> %d arquivos canônicos de imagem de áreas de atuação ainda não estão disponíveis na biblioteca de mídia/tema. O código já procura automaticamente cada nome; não serão usados recortes preliminares ou imagens genéricas no lugar.</p></div>',
        count($missing)
    );
}
add_action('admin_notices', 'ga_core_admin_asset_notice');


/**
 * Canonical photo mapping from the Visual Master Book for the eight secondary
 * primary destinations. HOME has its own three-slide set while final masters are produced.
 */
function ga_core_primary_page_catalog() {
    return array(
        'quem-somos'=>array('code'=>'QS','label'=>'Quem Somos','title'=>'Conheça a história e o método de trabalho.','description'=>'Informação institucional, princípios de atuação e compromisso com a clareza.'),
        'area-de-atuacao'=>array('code'=>'AA','label'=>'Áreas de Atuação','title'=>'Especialidades jurídicas organizadas para facilitar sua consulta.','description'=>'Explore as áreas e encontre conteúdos gerais relacionados a cada especialidade.'),
        'areas-de-atuacao'=>array('code'=>'AA','label'=>'Áreas de Atuação','title'=>'Especialidades jurídicas organizadas para facilitar sua consulta.','description'=>'Explore as áreas e encontre conteúdos gerais relacionados a cada especialidade.'),
        'equipe'=>array('code'=>'EQ','label'=>'Equipe','title'=>'Pessoas, experiência e trabalho em conjunto.','description'=>'Conheça a equipe e a estrutura de trabalho do escritório.'),
        'central-de-midia'=>array('code'=>'ART','label'=>'Central de Mídia','title'=>'Conteúdo jurídico em texto, áudio e vídeo.','description'=>'Artigos, notícias e vídeos institucionais com fontes identificadas e revisão editorial.'),
        'artigos'=>array('code'=>'ART','label'=>'Artigos e Notícias','title'=>'Informação jurídica com contexto e fontes.','description'=>'Conteúdo informativo organizado por tema, data e origem.'),
        'noticias-artigos'=>array('code'=>'ART','label'=>'Artigos e Notícias','title'=>'Informação jurídica com contexto e fontes.','description'=>'Conteúdo informativo organizado por tema, data e origem.'),
        'clientes'=>array('code'=>'CLI','label'=>'Clientes','title'=>'Informação e canais institucionais para clientes.','description'=>'Consulte os recursos disponíveis e selecione o canal correto para a sua necessidade.'),
        'links-uteis'=>array('code'=>'LU','label'=>'Links Úteis','title'=>'Recursos de referência em um só lugar.','description'=>'Acesse fontes e serviços institucionais relevantes.'),
        'contato'=>array('code'=>'CONT','label'=>'Contato','title'=>'Encontre o canal adequado para sua solicitação.','description'=>'Para atendimento geral, comece pela Central Digital do Cliente.'),
        'fale-conosco'=>array('code'=>'CONT','label'=>'Contato','title'=>'Encontre o canal adequado para sua solicitação.','description'=>'Para atendimento geral, comece pela Central Digital do Cliente.'),
        'localizacao'=>array('code'=>'LOC','label'=>'Localização','title'=>'Localização e orientações para chegar ao escritório.','description'=>'Consulte o endereço institucional e abra o aplicativo de navegação de sua preferência.'),
    );
}

function ga_core_primary_page_slides($page_slug) {
    $catalog = ga_core_primary_page_catalog();
    $page_slug = sanitize_title((string)$page_slug);
    if ( ! isset($catalog[$page_slug]) ) { return array(); }
    $item = $catalog[$page_slug];
    $narratives = array(
        'QS' => array(
            array('title'=>'História e identidade','description'=>'Conheça a trajetória, os valores e a forma de atuação institucional.'),
            array('title'=>'Método e clareza','description'=>'Organização, análise e comunicação responsável em cada etapa.'),
            array('title'=>'Compromisso profissional','description'=>'Princípios de trabalho, confidencialidade e atenção às particularidades.'),
            array('title'=>'Visão de longo prazo','description'=>'Relações profissionais baseadas em clareza, seriedade e confiança.'),
        ),
        'AA' => array(
            array('title'=>'Áreas de atuação','description'=>'Explore a arquitetura de especialidades jurídicas do escritório.'),
            array('title'=>'Análise por especialidade','description'=>'Cada área reúne temas próprios, documentos relevantes e regras aplicáveis.'),
            array('title'=>'Informação com contexto','description'=>'Conteúdo informativo para ajudar a identificar o assunto adequado.'),
            array('title'=>'Atendimento pelo canal correto','description'=>'Para atendimento geral, utilize a Central Digital do Cliente.'),
        ),
        'EQ' => array(
            array('title'=>'Equipe e colaboração','description'=>'Trabalho coordenado, análise técnica e comunicação profissional.'),
            array('title'=>'Experiência e método','description'=>'A atuação exige estudo, organização e atenção às evidências.'),
            array('title'=>'Responsabilidade profissional','description'=>'Sigilo, ética e clareza orientam a relação com cada cliente.'),
            array('title'=>'Atuação institucional','description'=>'Conheça a estrutura do escritório e os canais oficiais.'),
        ),
        'ART' => array(
            array('title'=>'Artigos e notícias','description'=>'Informação jurídica organizada por assunto e data.'),
            array('title'=>'Fontes identificadas','description'=>'Notícias externas devem apontar para a origem e sua data.'),
            array('title'=>'Análise própria','description'=>'Comentários e artigos do escritório são distinguidos de notícias de terceiros.'),
            array('title'=>'Conteúdo relacionado','description'=>'Explore materiais ligados ao mesmo assunto e suas referências.'),
        ),
        'CLI' => array(
            array('title'=>'Área de clientes','description'=>'Acesse recursos institucionais e orientações de navegação.'),
            array('title'=>'Organização do atendimento','description'=>'Encaminhe sua solicitação pela Central Digital do Cliente.'),
            array('title'=>'Acesso responsável','description'=>'Utilize apenas canais oficiais e mantenha seus dados protegidos.'),
            array('title'=>'Consulta processual separada','description'=>'A consulta de processos permanece em página específica.'),
        ),
        'LU' => array(
            array('title'=>'Links úteis','description'=>'Fontes públicas, sistemas oficiais e recursos de referência.'),
            array('title'=>'Fontes institucionais','description'=>'Prefira endereços oficiais e confira a informação diretamente na origem.'),
            array('title'=>'Acesso organizado','description'=>'Os recursos são agrupados por finalidade e área.'),
            array('title'=>'Informação verificável','description'=>'Links de apoio não substituem análise jurídica individualizada.'),
        ),
        'CONT' => array(
            array('title'=>'Fale com a equipe','description'=>'Escolha o canal adequado para a natureza de sua solicitação.'),
            array('title'=>'Central Digital do Cliente','description'=>'O atendimento geral começa pela Central Digital do Cliente.'),
            array('title'=>'Mensagem direcionada','description'=>'Solicitações devem indicar um assunto para encaminhamento organizado.'),
            array('title'=>'Privacidade e clareza','description'=>'Não envie informações sigilosas desnecessárias por formulários públicos.'),
        ),
        'LOC' => array(
            array('title'=>'Localização do escritório','description'=>'Consulte o endereço institucional e planeje sua rota.'),
            array('title'=>'Navegação por aplicativo','description'=>'Abra o destino em seu aplicativo de mapas preferido.'),
            array('title'=>'Endereço institucional','description'=>'Confira os dados do destino antes de iniciar o deslocamento.'),
            array('title'=>'Atendimento e chegada','description'=>'Para dúvidas antes da visita, utilize a Central Digital do Cliente.'),
        ),
    );
    $copy = isset($narratives[$item['code']]) ? $narratives[$item['code']] : array();
    $slides = array();
    for ( $i = 1; $i <= 4; $i++ ) {
        $filename = $item['code'] . '-' . sprintf('%02d', $i) . '.webp';
        $narrative = isset($copy[$i-1]) ? $copy[$i-1] : array('title'=>$item['title'],'description'=>$item['description']);
        $slides[] = array(
            'id' => $item['code'] . '-' . sprintf('%02d', $i),
            'file' => $filename,
            'title' => $narrative['title'],
            'description' => $narrative['description'],
            'url' => ga_core_primary_page_asset_url($filename),
        );
    }
    return $slides;
}

function ga_core_primary_page_asset_url($filename) {
    $filename = sanitize_file_name((string)$filename);
    if ( ! $filename ) { return ''; }
    $relative = 'assets/images/pages/' . $filename;
    $base = trailingslashit(get_template_directory()) . $relative;
    $web = trailingslashit(get_template_directory_uri()) . $relative;
    if ( is_file($base) ) { return $web . rawurlencode($filename); }

    $attachments = get_posts(array(
        'post_type' => 'attachment',
        'post_status' => 'inherit',
        'posts_per_page' => 1,
        'fields' => 'ids',
        'no_found_rows' => true,
        'meta_query' => array(array(
            'key' => '_wp_attached_file',
            'value' => '/' . $filename,
            'compare' => 'LIKE',
        )),
    ));
    if ( ! empty($attachments[0]) ) {
        $url = wp_get_attachment_image_url((int)$attachments[0], 'full');
        if ( $url ) { return $url; }
    }
    return '';
}

function ga_core_home_asset_url($filename) {
    $filename = sanitize_file_name((string)$filename);
    if ( ! $filename ) { return ''; }

    // Canonical masters uploaded by the media-generation workflow must override interim crops.
    $attachments = get_posts(array(
        'post_type' => 'attachment',
        'post_status' => 'inherit',
        'posts_per_page' => 1,
        'fields' => 'ids',
        'no_found_rows' => true,
        'meta_query' => array(array(
            'key' => '_wp_attached_file',
            'value' => '/' . $filename,
            'compare' => 'LIKE',
        )),
    ));
    if ( ! empty($attachments[0]) ) {
        $url = wp_get_attachment_image_url((int)$attachments[0], 'full');
        if ( $url ) { return $url; }
    }

    $relative = 'assets/images/home/' . $filename;
    $base = trailingslashit(get_template_directory()) . $relative;
    $web = trailingslashit(get_template_directory_uri()) . $relative;
    if ( is_file($base) ) { return $web . rawurlencode($filename); }
    return '';
}

