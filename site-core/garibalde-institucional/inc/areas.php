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
        array('title'=>'Direito Previdenciário','slug'=>'direito-previdenciario','image1'=>'DIREITO_PREVIDENCIARIO-01.webp','image2'=>'DIREITO_PREVIDENCIARIO-02.webp','lead'=>'Orientação jurídica previdenciária baseada no histórico contributivo, nos documentos e nas regras aplicáveis.','copy'=>'A avaliação previdenciária depende dos vínculos, contribuições, períodos reconhecíveis, documentos e requisitos vigentes na data relevante. Simulações não substituem conferência dos dados oficiais e não garantem a concessão de benefício.','focus'=>'Análise de histórico contributivo; requerimentos e recursos administrativos; organização documental; revisão de decisões; planejamento previdenciário individualizado.'),
        array('title'=>'Relação de Consumo','slug'=>'relacao-consumo','image1'=>'RELACAO_DE_CONSUMO-01.webp','image2'=>'RELACAO_DE_CONSUMO-02.webp','lead'=>'Tratamento jurídico de conflitos de consumo com base em contratos, oferta, comprovantes e histórico de atendimento.','copy'=>'A análise de uma relação de consumo exige identificar o produto ou serviço, a oferta, os documentos, as comunicações e a sequência dos acontecimentos. A orientação deve distinguir fatos comprovados de alegações e avaliar soluções proporcionais ao caso.','focus'=>'Contratos de consumo; vícios e falhas de serviço; cobranças; atendimento e reclamações; negociação; medidas administrativas ou judiciais adequadas.'),
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
            continue;
        }
        $content = '<p>' . esc_html($area['lead']) . '</p><h2>Como a análise jurídica é estruturada</h2><p>' . esc_html($area['copy']) . '</p><h2>Temas relacionados</h2><p>' . esc_html($area['focus']) . '</p><p>O conteúdo é informativo e não substitui a análise individual de documentos e circunstâncias. A aplicação de regras, prazos e estratégias depende da verificação dos fatos e da legislação vigente pertinente.</p>';
        $id = wp_insert_post(array(
            'post_type' => 'ga_area_atuacao',
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
        }
    }
    $hub = get_page_by_path('area-de-atuacao', OBJECT, 'page');
    if ( ! $hub ) {
        wp_insert_post(array(
            'post_type' => 'page',
            'post_status' => 'publish',
            'post_title' => 'Áreas de Atuação',
            'post_name' => 'area-de-atuacao',
            'page_template' => 'page-area-de-atuacao.php',
            'post_content' => '<!-- Conteúdo gerado pelo tema GA Core; lista dinâmica de áreas. -->',
        ));
    } else if ( ! get_page_template_slug($hub->ID) ) {
        update_post_meta($hub->ID, '_wp_page_template', 'page-area-de-atuacao.php');
    }
    flush_rewrite_rules(false);
}
add_action('after_switch_theme', 'ga_core_seed_areas');

function ga_core_area_asset_path($filename) {
    $filename = sanitize_file_name((string)$filename);
    if ( ! $filename ) { return ''; }
    $base = trailingslashit(get_template_directory()) . 'assets/images/areas/';
    $web = trailingslashit(get_template_directory_uri()) . 'assets/images/areas/';
    $path = $base . $filename;
    if ( is_file($path) ) { return $web . rawurlencode($filename); }
    return '';
}

function ga_core_get_area_images($post_id) {
    return array(
        array('file'=>(string)get_post_meta($post_id, '_ga_core_image_1', true),'url'=>ga_core_area_asset_path(get_post_meta($post_id, '_ga_core_image_1', true))),
        array('file'=>(string)get_post_meta($post_id, '_ga_core_image_2', true),'url'=>ga_core_area_asset_path(get_post_meta($post_id, '_ga_core_image_2', true))),
    );
}
