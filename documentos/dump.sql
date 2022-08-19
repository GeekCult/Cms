-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Tempo de geração: 19-Maio-2021 às 14:56
-- Versão do servidor: 5.7.32
-- versão do PHP: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Banco de dados: `matrix2`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `activity_2`
--

CREATE TABLE `activity_2` (
  `id` int(6) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `activity_count`
--

CREATE TABLE `activity_count` (
  `id` int(6) UNSIGNED NOT NULL,
  `url` varchar(400) NOT NULL,
  `facebook_shares` int(11) DEFAULT NULL,
  `facebook_reaction` int(11) DEFAULT NULL,
  `facebook_comment` int(11) DEFAULT NULL,
  `facebook_comment_plugin` int(11) DEFAULT NULL,
  `facebook_total` int(11) DEFAULT NULL,
  `pintrest` int(11) NOT NULL,
  `linkedin` int(11) NOT NULL,
  `stumbleupon` int(11) DEFAULT NULL,
  `googleplus` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `activity_log`
--

CREATE TABLE `activity_log` (
  `id` int(11) NOT NULL,
  `plataforma` varchar(40) NOT NULL DEFAULT 'desktop',
  `ip` varchar(50) NOT NULL,
  `user_id` int(11) NOT NULL,
  `time` datetime NOT NULL,
  `uri` varchar(300) NOT NULL,
  `msg` varchar(400) NOT NULL,
  `browser` varchar(40) NOT NULL,
  `num` int(1) DEFAULT '1',
  `tipo` varchar(50) NOT NULL DEFAULT '0',
  `cidade` varchar(200) NOT NULL DEFAULT '0',
  `id_pier` int(11) NOT NULL DEFAULT '0',
  `week_day` int(2) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `activity_log`
--

INSERT INTO `activity_log` (`id`, `plataforma`, `ip`, `user_id`, `time`, `uri`, `msg`, `browser`, `num`, `tipo`, `cidade`, `id_pier`, `week_day`) VALUES
(1, 'desktop', '127.0.0.1', 1, '2016-08-15 16:10:43', '/site/purplestore/comprar', 'email_tipo_purplestore', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 1', 1, 'email_enviado ', '', 412879, 1),
(2, 'desktop', '127.0.0.1', 1, '2016-08-15 16:10:59', '/site/purplestore/comprar', 'email_tipo_purplestore', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 1', 1, 'email_enviado ', '', 412879, 1),
(3, 'desktop', '127.0.0.1', 1, '2016-08-16 14:09:30', '/clientes', 'acesso a página clientes', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 1', 1, '', '', 539300, 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `activity_milestone`
--

CREATE TABLE `activity_milestone` (
  `id` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `tipo` varchar(100) NOT NULL,
  `label` varchar(100) NOT NULL,
  `meta` int(11) NOT NULL,
  `unidade` varchar(100) NOT NULL,
  `date` date NOT NULL,
  `month` int(2) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `activity_milestone`
--

INSERT INTO `activity_milestone` (`id`, `id_user`, `tipo`, `label`, `meta`, `unidade`, `date`, `month`) VALUES
(1, NULL, 'rede_beneficios', 'acessos', 1000, 'acesso(s)', '0000-00-00', 12),
(2, NULL, 'rede_beneficios', 'busca_cpf', 100, 'busca(s)', '0000-00-00', 12),
(3, NULL, 'rede_beneficios', 'maxima', 1200, '', '0000-00-00', 0),
(4, NULL, 'rede_beneficios', 'ofertas', 50, 'ofertas', '2013-11-29', 11),
(5, NULL, 'rede_beneficios', 'usuarios', 500, 'usuários', '2013-11-29', 11),
(7, NULL, 'rede_beneficios', 'ofertas_visitas', 500, 'visualizações', '2013-11-30', 11),
(8, 255, 'rede_beneficios', 'ofertas_visitas', 1000, 'visualizações', '2013-11-30', 2),
(11, 0, 'produtos', 'vendas', 100, 'vendas', '0000-00-00', 0),
(12, 0, 'produtos', 'produtos_vendidos', 150, 'produtos vendidos', '0000-00-00', 0),
(13, 0, 'produtos', 'maxima', 300, '', '0000-00-00', 0),
(14, NULL, 'produtos', 'produtos_carrinho', 100, '', '0000-00-00', 0),
(15, NULL, 'vagas', 'novas_vagas', 20, 'vagas', '0000-00-00', 0),
(16, NULL, 'vagas', 'empresas', 10, 'empresas', '0000-00-00', 0),
(17, NULL, 'vagas', 'vagas_ativas', 10, 'vagas', '0000-00-00', 0),
(18, 0, 'vagas', 'vagas_inativas', 10, 'vagas', '0000-00-00', 0),
(19, NULL, 'vagas', 'maxima', 30, 'maxima', '0000-00-00', 0),
(20, NULL, 'curriculos', 'curriculos_atualizados', 40, 'currículos', '0000-00-00', 0),
(21, NULL, 'curriculos', 'curriculos', 50, '', '0000-00-00', 0),
(22, NULL, 'curriculos', 'candidaturas', 40, 'candidaturas', '0000-00-00', 0),
(23, NULL, 'curriculos', 'maxima', 60, '', '0000-00-00', 0),
(24, 0, 'produtos', 'produtos_carrinho', 40, 'items', '2015-02-10', 2),
(25, 0, 'produtos', 'maxima_analise', 400, 'analises', '0000-00-00', 0),
(26, 0, 'produtos', 'loja_step_1', 400, 'fechamentos', '0000-00-00', 0),
(27, 0, 'produtos', 'loja_step_2', 400, 'indentificações', '0000-00-00', 0),
(28, 0, 'produtos', 'loja_step_3a', 400, 'endereços', '0000-00-00', 0),
(29, 0, 'produtos', 'loja_step_3', 400, '', '0000-00-00', 0),
(30, 0, 'produtos', 'loja_step_3b', 400, '', '0000-00-00', 0),
(31, 0, 'produtos', 'loja_step_3c', 400, '', '0000-00-00', 0),
(32, 0, 'produtos', 'loja_step_7', 400, 'embalagens', '0000-00-00', 0),
(33, 0, 'produtos', 'loja_step_5', 400, '', '0000-00-00', 0),
(34, 0, 'produtos', 'loja_step_4', 400, '', '0000-00-00', 0),
(35, 0, 'produtos', 'loja_step_6', 400, '', '0000-00-00', 0),
(36, 0, 'produtos', 'loja_step_6', 400, 'pagamentos', '0000-00-00', 0),
(37, 0, 'produtos', 'loja_step_7', 400, 'pagamentos', '0000-00-00', 0),
(38, 0, 'produtos', 'loja_step_7_error', 400, '', '0000-00-00', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `activity_recent`
--

CREATE TABLE `activity_recent` (
  `id` int(11) NOT NULL,
  `id_general` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `tipo` varchar(50) NOT NULL,
  `titulo` varchar(100) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `mensagem` longtext NOT NULL,
  `picture` varchar(250) NOT NULL,
  `data` datetime NOT NULL,
  `last_update` datetime NOT NULL,
  `status` int(11) NOT NULL,
  `from_action` varchar(200) NOT NULL DEFAULT '0',
  `valor_conversao` float NOT NULL,
  `id_campanha` int(11) NOT NULL DEFAULT '0',
  `from_page` varchar(400) NOT NULL DEFAULT '0',
  `modo` int(2) NOT NULL DEFAULT '0',
  `ip` varchar(40) NOT NULL DEFAULT '0',
  `id_pier` int(11) NOT NULL DEFAULT '0',
  `canal` varchar(50) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `activity_server`
--

CREATE TABLE `activity_server` (
  `id` int(11) NOT NULL,
  `id_general` int(11) NOT NULL,
  `tipo` varchar(50) NOT NULL,
  `data` datetime NOT NULL,
  `encerramento` datetime NOT NULL,
  `descricao` longtext NOT NULL,
  `status` int(2) NOT NULL,
  `name` varchar(200) NOT NULL DEFAULT '0',
  `page_id` int(11) NOT NULL DEFAULT '0',
  `id_user` int(11) NOT NULL DEFAULT '0',
  `email` varchar(100) NOT NULL DEFAULT '0',
  `nr_envios` int(11) NOT NULL DEFAULT '0',
  `titulo` varchar(400) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `activity_server`
--

INSERT INTO `activity_server` (`id`, `id_general`, `tipo`, `data`, `encerramento`, `descricao`, `status`, `name`, `page_id`, `id_user`, `email`, `nr_envios`, `titulo`) VALUES
(1, 0, 'keywords', '2012-04-19 13:43:14', '0000-00-00 00:00:00', 'esporte, bolas, futebols, tennis, basquete, sport, esportes, atletismo, tennis, times, fifa, time', 0, '0', 0, 0, '0', 0, '0'),
(2, 0, 'keywords', '2012-04-19 13:44:53', '0000-00-00 00:00:00', 'tintas, pintura, cores, tinta, pintar, paredes, pincel, pinceis, solventes, latas, lata de tinta, spray, pintores', 0, '0', 0, 0, '0', 0, '0'),
(3, 0, 'keywords', '2012-04-19 14:09:59', '0000-00-00 00:00:00', 'acic. associação, campinas, acic campinas, comercial, industrial', 0, '0', 0, 0, '0', 0, '0'),
(4, 0, 'keywords', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'imobilizaria, imóveis, casas, apartamentos, corretores, residência, terrenos, chácaras, fazendas, locação', 0, '0', 0, 0, '0', 0, '0');

-- --------------------------------------------------------

--
-- Estrutura da tabela `banners_attribute`
--

CREATE TABLE `banners_attribute` (
  `id` int(11) NOT NULL,
  `banner_id` int(11) NOT NULL,
  `page_id` int(11) NOT NULL,
  `tipo` varchar(50) NOT NULL,
  `n_index` int(11) DEFAULT NULL,
  `size` varchar(50) DEFAULT NULL,
  `name` varchar(45) NOT NULL,
  `inteiro` int(11) DEFAULT NULL,
  `number` float NOT NULL,
  `estampa` timestamp NULL DEFAULT NULL,
  `texto` varchar(255) DEFAULT NULL,
  `descricao` longtext NOT NULL,
  `data` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `banners_data`
--

CREATE TABLE `banners_data` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `plataforma` varchar(40) NOT NULL DEFAULT 'desktop',
  `nome` varchar(100) NOT NULL,
  `tipo` varchar(100) NOT NULL,
  `keywords` varchar(400) NOT NULL,
  `altura` varchar(4) NOT NULL,
  `largura` varchar(4) NOT NULL,
  `modelo` varchar(50) NOT NULL,
  `link` varchar(250) NOT NULL,
  `cor` varchar(100) NOT NULL,
  `cool` longtext NOT NULL,
  `detalhes` longtext NOT NULL,
  `plano` varchar(100) NOT NULL,
  `page_views` int(11) NOT NULL,
  `clicks` int(11) NOT NULL,
  `creditos` float NOT NULL,
  `lance` float NOT NULL,
  `desconto` float NOT NULL,
  `valor_max` float NOT NULL DEFAULT '0',
  `debito_dia` float NOT NULL DEFAULT '0',
  `container_1` varchar(20) DEFAULT NULL,
  `image` varchar(400) DEFAULT NULL,
  `exibe` int(1) NOT NULL DEFAULT '0' COMMENT 'true = 1 e false =0',
  `minisite` int(2) NOT NULL DEFAULT '0',
  `image_type` int(2) NOT NULL DEFAULT '0',
  `titulo` varchar(200) NOT NULL,
  `descricao` longtext NOT NULL,
  `mostrar` int(2) NOT NULL DEFAULT '0',
  `expira` date DEFAULT NULL,
  `link_modo` int(2) NOT NULL DEFAULT '0',
  `language` varchar(10) NOT NULL DEFAULT '0',
  `json` longtext NOT NULL,
  `banner1` varchar(400) NOT NULL DEFAULT '0',
  `banner2` varchar(400) NOT NULL DEFAULT '0',
  `banner3` varchar(400) NOT NULL DEFAULT '0',
  `data` datetime DEFAULT NULL,
  `df` longtext NOT NULL,
  `t_bn_2` varchar(100) NOT NULL DEFAULT '0',
  `d_bn_2` varchar(100) NOT NULL DEFAULT '0',
  `t_bn_3` varchar(100) NOT NULL DEFAULT '0',
  `d_bn_3` varchar(200) NOT NULL DEFAULT '0',
  `destaque` int(2) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `banners_data`
--

INSERT INTO `banners_data` (`id`, `id_user`, `plataforma`, `nome`, `tipo`, `keywords`, `altura`, `largura`, `modelo`, `link`, `cor`, `cool`, `detalhes`, `plano`, `page_views`, `clicks`, `creditos`, `lance`, `desconto`, `valor_max`, `debito_dia`, `container_1`, `image`, `exibe`, `minisite`, `image_type`, `titulo`, `descricao`, `mostrar`, `expira`, `link_modo`, `language`, `json`, `banner1`, `banner2`, `banner3`, `data`, `df`, `t_bn_2`, `d_bn_2`, `t_bn_3`, `d_bn_3`, `destaque`) VALUES
(1, 0, 'desktop', 'Topo Glamo', 'topos', '', '0', '0', 'render_partial', '', '', 'topo_glamo', '', '', 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 0, 0, 0, '', '', 0, '2021-04-13', 0, '0', '', '0', '0', '0', '2021-04-12 13:29:40', '', '0', '0', '0', '0', 0),
(2, 0, 'desktop', 'Rodape Stalker', 'rodapes', '', '0', '0', 'render_partial', '', '', 'stalker', '', '', 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 0, 0, 0, '', '', 0, '2021-04-21', 0, '0', '', '0', '0', '0', '2021-04-12 13:29:43', '', '0', '0', '0', '0', 0),
(3, 0, 'desktop', 'Lampejo', 'html_mainbanners', '', '0', '0', 'render_partial', '', '', 'lampejo', '', '', 0, 0, 100, 0, 0, 0.1, 0, NULL, NULL, 1, 0, 0, '', '', 0, '2021-04-21', 1, '0', '', '0', '0', '0', '2021-04-12 13:29:46', '', '0', '0', '0', '0', 0),
(5, 0, 'desktop', 'Topo Maserati', 'topos', '', '0', '0', 'render_partial', '', '', 'Topo Maserati', '', '', 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 0, 0, 0, '', '', 0, '2021-04-21', 0, '0', '', '0', '0', '0', '2021-04-06 13:29:48', '', '0', '0', '0', '0', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `banners_items`
--

CREATE TABLE `banners_items` (
  `id` int(11) NOT NULL,
  `id_banner` int(11) NOT NULL,
  `label` varchar(50) NOT NULL,
  `tipo` varchar(6) NOT NULL,
  `src` varchar(200) NOT NULL,
  `p_x` int(5) NOT NULL,
  `p_y` int(5) NOT NULL,
  `width` int(5) NOT NULL,
  `height` int(5) NOT NULL,
  `color` varchar(17) NOT NULL,
  `f_type` varchar(50) NOT NULL,
  `s_text` varchar(6) NOT NULL,
  `s_thumb` varchar(6) NOT NULL,
  `link` varchar(150) NOT NULL,
  `variante` varchar(50) NOT NULL,
  `z_index` varchar(11) NOT NULL,
  `id_general` int(11) NOT NULL,
  `type_general` int(11) NOT NULL,
  `texto` varchar(1000) NOT NULL DEFAULT '',
  `json` longtext,
  `name` varchar(100) NOT NULL DEFAULT '0',
  `descricao` longtext,
  `posin_x` int(11) NOT NULL DEFAULT '0',
  `posin_y` int(11) NOT NULL DEFAULT '0',
  `duracao_in` int(11) NOT NULL DEFAULT '0',
  `iniciar` int(11) NOT NULL DEFAULT '0',
  `fade` int(2) NOT NULL DEFAULT '0',
  `sombra` int(2) NOT NULL DEFAULT '0',
  `saida` varchar(100) NOT NULL DEFAULT '0',
  `show_until` int(11) NOT NULL DEFAULT '0',
  `tamanho` varchar(100) NOT NULL DEFAULT '0',
  `fonte` varchar(100) NOT NULL DEFAULT '0',
  `alinhamento` varchar(100) NOT NULL DEFAULT '0',
  `angule` int(11) NOT NULL DEFAULT '0',
  `rotate_x` int(11) NOT NULL DEFAULT '0',
  `rotate_y` int(11) NOT NULL DEFAULT '0',
  `scale_x` int(11) NOT NULL DEFAULT '0',
  `scale_y` int(11) NOT NULL DEFAULT '0',
  `skew_x` int(11) NOT NULL DEFAULT '0',
  `skew_y` int(11) NOT NULL DEFAULT '0',
  `exibe` int(2) NOT NULL DEFAULT '0',
  `color2` varchar(50) NOT NULL DEFAULT '0',
  `target` int(2) NOT NULL DEFAULT '0',
  `tema` varchar(100) NOT NULL DEFAULT '0',
  `parallax_level` int(2) NOT NULL DEFAULT '0',
  `p_y_un` int(2) NOT NULL DEFAULT '0',
  `p_x_un` int(2) NOT NULL DEFAULT '0',
  `posin_x_un` int(2) NOT NULL DEFAULT '0',
  `posin_y_un` int(2) NOT NULL DEFAULT '0',
  `width_un` int(2) NOT NULL DEFAULT '0',
  `height_un` int(2) NOT NULL DEFAULT '0',
  `position_type` int(2) NOT NULL DEFAULT '0',
  `efeito` varchar(100) NOT NULL DEFAULT '0',
  `looping` int(2) NOT NULL DEFAULT '0',
  `padding_top` int(11) NOT NULL DEFAULT '0',
  `padding_bottom` int(11) NOT NULL DEFAULT '0',
  `padding_right` int(11) NOT NULL DEFAULT '0',
  `padding_left` int(11) NOT NULL DEFAULT '0',
  `df_componente` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `banners_items`
--

INSERT INTO `banners_items` (`id`, `id_banner`, `label`, `tipo`, `src`, `p_x`, `p_y`, `width`, `height`, `color`, `f_type`, `s_text`, `s_thumb`, `link`, `variante`, `z_index`, `id_general`, `type_general`, `texto`, `json`, `name`, `descricao`, `posin_x`, `posin_y`, `duracao_in`, `iniciar`, `fade`, `sombra`, `saida`, `show_until`, `tamanho`, `fonte`, `alinhamento`, `angule`, `rotate_x`, `rotate_y`, `scale_x`, `scale_y`, `skew_x`, `skew_y`, `exibe`, `color2`, `target`, `tema`, `parallax_level`, `p_y_un`, `p_x_un`, `posin_x_un`, `posin_y_un`, `width_un`, `height_un`, `position_type`, `efeito`, `looping`, `padding_top`, `padding_bottom`, `padding_right`, `padding_left`, `df_componente`) VALUES
(1, 3, 'Imagem - 1', 'i', 'banner_mobile_y4.png', 0, 0, 0, 0, '', '', '', '', '', '1', '1', 0, 0, '', '', 'image1', '', 0, 0, 0, 0, 0, 0, '0', 0, '0', '0', '0', 0, 0, 0, 0, 0, 0, 0, 0, '0', 0, '0', 0, 0, 0, 0, 0, 0, 0, 0, '0', 0, 0, 0, 0, 0, ''),
(2, 3, '', 't', '', 0, 0, 0, 0, '#FFFFFF', '', '', '', '', '', '1', 0, 0, '', '', 'titulo1', '', 0, 0, 0, 0, 0, 0, '0', 0, '0', '0', '0', 0, 0, 0, 0, 0, 0, 0, 0, '0', 0, '0', 0, 0, 0, 0, 0, 0, 0, 0, '0', 0, 0, 0, 0, 0, ''),
(3, 3, '', 't', '', 0, 0, 0, 0, '#FFFFFF', '', '', '', '', '', '1', 0, 0, '', '', 'texto1', '', 0, 0, 0, 0, 0, 0, '0', 0, '0', '0', '0', 0, 0, 0, 0, 0, 0, 0, 0, '0', 0, '0', 0, 0, 0, 0, 0, 0, 0, 0, '0', 0, 0, 0, 0, 0, ''),
(4, 3, 'Link - 1', 'lnk', '', 0, 0, 0, 0, '', '', '', '1', '', '', '1', 0, 0, '', '', 'link1', '', 0, 0, 0, 0, 0, 0, '0', 0, '0', '0', '0', 0, 0, 0, 0, 0, 0, 0, 0, '0', 0, '0', 0, 0, 0, 0, 0, 0, 0, 0, '0', 0, 0, 0, 0, 0, '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `conteudo_categorias`
--

CREATE TABLE `conteudo_categorias` (
  `id` int(11) NOT NULL,
  `id_page` int(11) NOT NULL,
  `nome` varchar(100) DEFAULT NULL,
  `id_subcategoria` int(11) NOT NULL DEFAULT '0',
  `container_1` varchar(50) NOT NULL DEFAULT '0',
  `descricao` longtext,
  `id_user` int(11) NOT NULL DEFAULT '0',
  `url` varchar(500) NOT NULL DEFAULT '0',
  `language` varchar(10) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `conteudo_categorias`
--

INSERT INTO `conteudo_categorias` (`id`, `id_page`, `nome`, `id_subcategoria`, `container_1`, `descricao`, `id_user`, `url`, `language`) VALUES
(1, 47, 'Logos', 0, '0', NULL, 0, '0', '0'),
(2, 47, 'Banners', 0, '0', NULL, 0, '0', '0'),
(3, 47, 'Materias', 0, '0', NULL, 0, '0', '0');

-- --------------------------------------------------------

--
-- Estrutura da tabela `conteudo_downloads`
--

CREATE TABLE `conteudo_downloads` (
  `id` int(11) NOT NULL,
  `id_categoria` int(11) DEFAULT NULL,
  `nome` varchar(255) DEFAULT NULL,
  `arquivo` varchar(255) DEFAULT NULL,
  `data` date DEFAULT NULL,
  `icon` varchar(100) DEFAULT NULL,
  `tipo` int(2) DEFAULT NULL,
  `descricao` longtext,
  `shorturl` varchar(100) DEFAULT NULL,
  `id_user` int(11) NOT NULL DEFAULT '0',
  `aplicativo` int(2) NOT NULL DEFAULT '0',
  `tag` varchar(30) NOT NULL DEFAULT '0',
  `capa` varchar(100) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `conteudo_forum`
--

CREATE TABLE `conteudo_forum` (
  `id` int(11) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `tipo` varchar(100) CHARACTER SET utf8 NOT NULL,
  `views` int(11) NOT NULL,
  `titulo` varchar(500) CHARACTER SET utf8 NOT NULL,
  `subtitulo` varchar(1000) CHARACTER SET utf8 NOT NULL,
  `materia` longtext CHARACTER SET utf8 NOT NULL,
  `keywords` varchar(300) CHARACTER SET utf8 NOT NULL,
  `data` datetime NOT NULL,
  `last_update` datetime NOT NULL,
  `container_1` varchar(200) CHARACTER SET utf8 NOT NULL,
  `data_novidade` date NOT NULL,
  `link_special` varchar(300) CHARACTER SET utf8 NOT NULL,
  `status` int(2) NOT NULL DEFAULT '0',
  `file` varchar(200) NOT NULL DEFAULT '0',
  `tema` int(2) NOT NULL DEFAULT '0',
  `id_tema` int(2) NOT NULL DEFAULT '0',
  `url` varchar(600) NOT NULL DEFAULT '0',
  `reputation` int(2) NOT NULL DEFAULT '0',
  `nr_comentarios` int(11) NOT NULL DEFAULT '0',
  `reputation_count` int(11) NOT NULL DEFAULT '0',
  `reputation_total` int(11) NOT NULL DEFAULT '0',
  `reputation_higher` int(11) NOT NULL DEFAULT '0',
  `reputation_lower` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `conteudo_hiperlinks`
--

CREATE TABLE `conteudo_hiperlinks` (
  `id` int(11) NOT NULL,
  `id_categoria` int(11) DEFAULT NULL,
  `nome` varchar(255) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `descricao` varchar(69) NOT NULL,
  `janela` varchar(255) DEFAULT NULL,
  `data` date NOT NULL,
  `email` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `conteudo_images`
--

CREATE TABLE `conteudo_images` (
  `id` int(11) NOT NULL,
  `id_categoria` int(11) DEFAULT NULL,
  `id_user` int(11) NOT NULL,
  `tipo` varchar(50) NOT NULL,
  `titulo` varchar(100) NOT NULL,
  `fotop` varchar(50) NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `largura` int(4) NOT NULL,
  `altura` int(4) NOT NULL,
  `descricao` text,
  `ficha_tecnica` text,
  `data` varchar(255) DEFAULT NULL,
  `local` varchar(50) NOT NULL DEFAULT '0',
  `cor` varchar(50) NOT NULL DEFAULT '0',
  `type_repeat` int(2) NOT NULL DEFAULT '0',
  `modelo` int(2) NOT NULL DEFAULT '0',
  `filesize` varchar(100) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `conteudo_images`
--

INSERT INTO `conteudo_images` (`id`, `id_categoria`, `id_user`, `tipo`, `titulo`, `fotop`, `foto`, `largura`, `altura`, `descricao`, `ficha_tecnica`, `data`, `local`, `cor`, `type_repeat`, `modelo`, `filesize`) VALUES
(2, 1, 54, '', 'Logo principal', '', 'pierlogo_azul_b8.png', 0, 0, '', NULL, '20160127', '0', '0', 0, 0, '0'),
(4, 2, 54, '', 'Banner Mobile', '', 'banner_mobile_y4.png', 0, 0, '', NULL, '20160127', '0', '0', 0, 0, '0');

-- --------------------------------------------------------

--
-- Estrutura da tabela `conteudo_materias`
--

CREATE TABLE `conteudo_materias` (
  `id` int(11) NOT NULL,
  `tipo` varchar(50) CHARACTER SET latin1 NOT NULL,
  `titulo` varchar(200) NOT NULL,
  `subtitulo` varchar(255) NOT NULL,
  `keywords` varchar(400) NOT NULL,
  `materia` longtext NOT NULL,
  `data` date NOT NULL,
  `data_novidade` date DEFAULT NULL,
  `last_update` date NOT NULL,
  `container_1` varchar(25) NOT NULL,
  `id_colunista` int(11) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `link_special` varchar(100) NOT NULL DEFAULT '0',
  `views` int(11) NOT NULL DEFAULT '0',
  `id_user` int(11) NOT NULL DEFAULT '0',
  `destaque` int(2) DEFAULT NULL,
  `chamada` varchar(200) DEFAULT NULL,
  `titulo_fb` varchar(200) DEFAULT NULL,
  `descricao_fb` varchar(500) DEFAULT NULL,
  `foto_fb` varchar(100) DEFAULT NULL,
  `modelo` varchar(100) DEFAULT NULL,
  `exibe` int(2) NOT NULL DEFAULT '1',
  `cor` varchar(50) DEFAULT NULL,
  `url` varchar(600) NOT NULL DEFAULT '0',
  `fonte` varchar(1000) NOT NULL DEFAULT '0',
  `exibe_autor` int(2) NOT NULL DEFAULT '0',
  `data_creation` datetime DEFAULT NULL,
  `last_update_creation` datetime DEFAULT NULL,
  `nr_comentarios` int(11) NOT NULL DEFAULT '0',
  `reputation` int(2) NOT NULL DEFAULT '0',
  `reputation_count` int(11) NOT NULL DEFAULT '0',
  `reputation_total` int(11) NOT NULL DEFAULT '0',
  `reputation_higher` int(11) NOT NULL DEFAULT '0',
  `reputation_lower` int(11) NOT NULL DEFAULT '0',
  `foto_square` varchar(100) NOT NULL DEFAULT '0',
  `language` varchar(10) NOT NULL DEFAULT '0',
  `cidade` varchar(100) NOT NULL DEFAULT '0',
  `tipo_media` int(2) NOT NULL DEFAULT '0',
  `id_media` int(11) NOT NULL DEFAULT '0',
  `link_modo` varchar(30) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `conteudo_videos`
--

CREATE TABLE `conteudo_videos` (
  `id` int(11) NOT NULL,
  `titulo` varchar(50) NOT NULL,
  `data` date NOT NULL,
  `descricao` varchar(150) NOT NULL,
  `arquivo` varchar(50) NOT NULL,
  `link` longtext NOT NULL,
  `container_1` varchar(200) NOT NULL DEFAULT '0',
  `id_video` varchar(200) NOT NULL DEFAULT '0',
  `tipo_video` int(2) NOT NULL DEFAULT '0',
  `last_update` datetime DEFAULT NULL,
  `exibir` int(2) NOT NULL DEFAULT '0',
  `url` varchar(500) NOT NULL DEFAULT '0',
  `id_categoria` int(11) NOT NULL DEFAULT '0',
  `reputation` int(2) NOT NULL DEFAULT '0',
  `nr_comentarios` int(2) NOT NULL DEFAULT '0',
  `keywords` varchar(400) NOT NULL DEFAULT '0',
  `titulo_fb` varchar(400) NOT NULL DEFAULT '0',
  `descricao_fb` longtext NOT NULL,
  `foto_fb` varchar(300) NOT NULL DEFAULT '0',
  `reputation_count` int(11) NOT NULL DEFAULT '0',
  `reputation_total` int(11) NOT NULL DEFAULT '0',
  `reputation_higher` int(11) NOT NULL DEFAULT '0',
  `reputation_lower` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `controle_attribute`
--

CREATE TABLE `controle_attribute` (
  `id` int(11) NOT NULL,
  `pedido_id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `inteiro` int(11) DEFAULT NULL,
  `number` float NOT NULL,
  `estampa` timestamp NULL DEFAULT NULL,
  `texto` varchar(255) DEFAULT NULL,
  `descricao` longtext NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `controle_chamados`
--

CREATE TABLE `controle_chamados` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_owner` int(11) NOT NULL,
  `id_worker` int(11) NOT NULL,
  `id_pedido` int(11) NOT NULL,
  `id_proposta` int(11) NOT NULL,
  `tipo` varchar(100) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `anotacao` longtext NOT NULL,
  `prioridade` varchar(50) NOT NULL,
  `data` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='Tabela de relacionamento dos chamados';

--
-- Extraindo dados da tabela `controle_chamados`
--

INSERT INTO `controle_chamados` (`id`, `id_user`, `id_owner`, `id_worker`, `id_pedido`, `id_proposta`, `tipo`, `nome`, `email`, `anotacao`, `prioridade`, `data`, `status`) VALUES
(1, 0, 0, 0, 1, 0, 'publicidade', 'www.vittabella.com.br', '', '', '', '2016-08-15 18:45:56', 0),
(2, 2, 0, 0, 2, 0, 'tarefa', 'cliente2.purplepier.com.br', '', '', '', '2016-08-15 18:45:57', 0),
(3, 291, 0, 0, 3, 0, 'tarefa', 'www.kikitofestas.com.br', '', '', '', '2016-08-15 18:45:57', 0),
(4, 288, 0, 0, 4, 0, 'tarefa', 'www.salgadostoninho.com.br', '', '', '', '2016-08-15 18:45:57', 0),
(5, 273, 0, 0, 5, 0, 'tarefa', 'www.associacaolivre.com.br', '', '', '', '2016-08-15 18:45:57', 0),
(6, 291, 0, 0, 6, 0, 'tarefa', 'www.kikitofestas.com.br', '', '', '', '2016-08-15 18:45:57', 0),
(7, 59, 0, 0, 7, 0, 'tarefa', 'cliente.purplepier.com.br', '', '', '', '2016-08-15 18:45:57', 0),
(8, 319, 0, 0, 8, 0, 'tarefa', 'dev.purplepier.com.br', '', '', '', '2016-08-15 18:45:57', 0),
(9, 319, 0, 0, 9, 0, 'tarefa', 'dev.purplepier.com.br', '', '', '', '2016-08-15 18:45:57', 0),
(10, 319, 0, 0, 10, 0, 'tarefa', 'dev.purplepier.com.br', '', '', '', '2016-08-15 18:45:57', 0),
(11, 319, 0, 0, 11, 0, 'tarefa', 'dev.purplepier.com.br', '', '', '', '2016-08-15 18:45:57', 0),
(12, 319, 0, 0, 12, 0, 'tarefa', 'dev.purplepier.com.br', '', '', '', '2016-08-15 18:45:57', 0),
(13, 319, 0, 0, 13, 0, 'tarefa', 'dev.purplepier.com.br', '', '', '', '2016-08-15 18:45:57', 0),
(14, 319, 0, 0, 14, 0, 'tarefa', 'dev.purplepier.com.br', '', '', '', '2016-08-15 18:45:57', 0),
(15, 319, 0, 0, 15, 0, 'tarefa', 'dev.purplepier.com.br', '', '', '', '2016-08-15 18:45:57', 0),
(16, 319, 0, 0, 16, 0, 'tarefa', 'dev.purplepier.com.br', '', '', '', '2016-08-15 18:45:57', 0),
(17, 319, 0, 0, 17, 0, 'tarefa', 'dev.purplepier.com.br', '', '', '', '2016-08-15 18:45:57', 0),
(18, 319, 0, 0, 18, 0, 'tarefa', 'dev.purplepier.com.br', '', '', '', '2016-08-15 18:45:57', 0),
(19, 319, 0, 0, 19, 0, 'tarefa', 'dev.purplepier.com.br', '', '', '', '2016-08-15 18:45:57', 0),
(20, 319, 0, 0, 20, 0, 'tarefa', 'dev.purplepier.com.br', '', '', '', '2016-08-15 18:45:57', 0),
(21, 319, 0, 0, 21, 0, 'tarefa', 'dev.purplepier.com.br', '', '', '', '2016-08-15 18:45:57', 0),
(22, 319, 0, 0, 22, 0, 'tarefa', 'dev.purplepier.com.br', '', '', '', '2016-08-15 18:45:57', 0),
(23, 319, 0, 0, 23, 0, 'tarefa', 'dev.purplepier.com.br', '', '', '', '2016-08-15 18:45:57', 0),
(24, 319, 0, 0, 24, 0, 'ideia', 'dev.purplepier.com.br', '', '', '', '2016-08-15 18:45:57', 0),
(25, 319, 0, 0, 25, 0, 'tarefa', 'dev.purplepier.com.br', '', '', '', '2016-08-15 18:45:57', 0),
(26, 319, 0, 0, 26, 0, 'tarefa', 'dev.purplepier.com.br', '', '', '', '2016-08-15 18:45:57', 0),
(27, 319, 0, 0, 27, 0, 'tarefa', 'dev.purplepier.com.br', '', '', '', '2016-08-15 18:45:57', 0),
(28, 1, 0, 0, 28, 0, 'tarefa', 'dev.purplepier.com.br', '', '', '', '2016-08-15 18:45:57', 0),
(29, 1, 0, 0, 29, 0, 'tarefa', 'dev.purplepier.com.br', '', '', '', '2016-08-15 18:45:57', 0),
(30, 1, 0, 0, 30, 0, 'tarefa', 'dev.purplepier.com.br', '', '', '', '2016-08-15 18:45:57', 0),
(31, 1, 0, 0, 31, 0, 'tarefa', 'dev.purplepier.com.br', '', '', '', '2016-08-15 18:45:57', 0),
(32, 1, 0, 0, 32, 0, 'tarefa', 'dev.purplepier.com.br', '', '', '', '2016-08-15 18:45:57', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `controle_pedidos`
--

CREATE TABLE `controle_pedidos` (
  `id` int(11) NOT NULL,
  `id_general` int(11) DEFAULT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_worker` int(11) DEFAULT NULL,
  `id_categoria` int(11) NOT NULL,
  `id_empresa` int(11) DEFAULT NULL,
  `id_entidade` int(11) DEFAULT NULL,
  `nome` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `telefone` varchar(25) NOT NULL,
  `tipo` varchar(150) NOT NULL,
  `pais` varchar(100) NOT NULL,
  `estado` varchar(50) DEFAULT NULL,
  `cidade` varchar(100) NOT NULL,
  `valor` float NOT NULL,
  `quantidade` int(11) NOT NULL,
  `data` datetime NOT NULL,
  `last_update` datetime NOT NULL,
  `data_final` datetime NOT NULL,
  `data_inicio` datetime NOT NULL,
  `titulo` varchar(150) NOT NULL,
  `descricao` longtext NOT NULL,
  `detalhes` longtext NOT NULL,
  `file` varchar(150) NOT NULL,
  `documento` varchar(100) NOT NULL,
  `destaque` int(2) DEFAULT NULL,
  `setor` int(11) NOT NULL,
  `especializacao` int(11) DEFAULT NULL,
  `status` int(2) DEFAULT NULL,
  `extra_1` int(11) NOT NULL DEFAULT '0',
  `extra_2` int(11) NOT NULL DEFAULT '0',
  `extra_3` int(11) NOT NULL DEFAULT '0',
  `extra_4` int(11) NOT NULL DEFAULT '0',
  `empresa` varchar(200) NOT NULL DEFAULT '0',
  `desconto` float NOT NULL,
  `progresso` int(11) NOT NULL DEFAULT '0',
  `cobranca_tipo` int(2) NOT NULL DEFAULT '0',
  `user_purplepier` varchar(200) NOT NULL DEFAULT '0',
  `celular` varchar(30) NOT NULL DEFAULT '0',
  `valor_conversao` float NOT NULL DEFAULT '0',
  `from_action` varchar(200) NOT NULL DEFAULT '0',
  `from_page` varchar(400) NOT NULL DEFAULT '0',
  `dominio` varchar(150) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='Tabel geral de infornmações do site - usuários';

-- --------------------------------------------------------

--
-- Estrutura da tabela `controle_propostas`
--

CREATE TABLE `controle_propostas` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_pedido` int(11) NOT NULL,
  `id_owner` int(11) NOT NULL,
  `id_produto` int(11) NOT NULL,
  `data` date NOT NULL,
  `last_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int(2) DEFAULT '0',
  `tipo` varchar(100) NOT NULL DEFAULT '0',
  `titulo` varchar(200) NOT NULL DEFAULT '0',
  `descricao` longtext NOT NULL,
  `valor` float NOT NULL,
  `nome` varchar(200) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='propostas para os pedidos';

-- --------------------------------------------------------

--
-- Estrutura da tabela `date_attribute`
--

CREATE TABLE `date_attribute` (
  `id` int(11) NOT NULL,
  `label` varchar(100) NOT NULL,
  `number` int(11) NOT NULL,
  `last_update` datetime NOT NULL,
  `descricao` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `date_controller`
--

CREATE TABLE `date_controller` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `json` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `date_invites`
--

CREATE TABLE `date_invites` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `status` int(2) NOT NULL,
  `last_update` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `date_items`
--

CREATE TABLE `date_items` (
  `id` int(11) NOT NULL,
  `plataforma` varchar(40) NOT NULL,
  `tipo` varchar(40) NOT NULL,
  `name` varchar(45) NOT NULL,
  `inteiro` int(11) DEFAULT NULL,
  `number` float NOT NULL,
  `date` datetime DEFAULT NULL,
  `date_simple` date NOT NULL,
  `texto` varchar(255) DEFAULT NULL,
  `descricao` longtext NOT NULL,
  `id_item` int(11) NOT NULL,
  `status` int(2) DEFAULT '0',
  `canal` varchar(30) NOT NULL DEFAULT '0',
  `id_generl` int(11) NOT NULL DEFAULT '0',
  `container_1` varchar(300) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `ecommerce_attribute`
--

CREATE TABLE `ecommerce_attribute` (
  `id_produto` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `inteiro` int(11) DEFAULT NULL,
  `estampa` timestamp NULL DEFAULT NULL,
  `texto` varchar(255) DEFAULT NULL,
  `id_variante` int(11) NOT NULL DEFAULT '0',
  `descricao` longtext NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `ecommerce_attribute`
--

INSERT INTO `ecommerce_attribute` (`id_produto`, `name`, `inteiro`, `estampa`, `texto`, `id_variante`, `descricao`) VALUES
(1, 'video1', NULL, NULL, NULL, 0, ''),
(2, 'video1', NULL, NULL, NULL, 0, ''),
(3, 'video1', NULL, NULL, NULL, 0, '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `ecommerce_caracteristicas`
--

CREATE TABLE `ecommerce_caracteristicas` (
  `id` int(11) NOT NULL,
  `tipo` varchar(100) NOT NULL,
  `number` float NOT NULL,
  `texto` varchar(255) NOT NULL,
  `inteiro` int(11) NOT NULL,
  `extra` varchar(255) NOT NULL,
  `container_1` varchar(200) NOT NULL DEFAULT '0',
  `descricao` longtext NOT NULL,
  `data` datetime NOT NULL,
  `last_update` datetime NOT NULL,
  `cep_inicio` varchar(100) NOT NULL DEFAULT '0',
  `cep_final` varchar(100) NOT NULL DEFAULT '0',
  `extra_2` varchar(400) NOT NULL DEFAULT '0',
  `json` longtext NOT NULL,
  `valor` float NOT NULL,
  `n_index` int(2) NOT NULL DEFAULT '5',
  `id_api` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `ecommerce_carrinho`
--

CREATE TABLE `ecommerce_carrinho` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL DEFAULT '0',
  `id_pedido` int(11) NOT NULL,
  `id_item` int(11) NOT NULL,
  `id_variante` int(11) NOT NULL,
  `tipo` varchar(80) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `amount` int(11) NOT NULL,
  `valor` float NOT NULL,
  `valor_total` float NOT NULL,
  `mes` int(2) DEFAULT NULL,
  `extra` float DEFAULT NULL,
  `data` datetime NOT NULL,
  `language` varchar(10) NOT NULL DEFAULT '0',
  `status` int(2) NOT NULL DEFAULT '0',
  `container_1` varchar(100) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `ecommerce_categorias`
--

CREATE TABLE `ecommerce_categorias` (
  `id_categoria` int(11) NOT NULL,
  `categoria_label` varchar(50) NOT NULL,
  `categoria_url` varchar(100) NOT NULL,
  `descricao` longtext,
  `container_0` varchar(200) DEFAULT NULL,
  `container_1` varchar(200) DEFAULT NULL,
  `menu_1` int(2) DEFAULT NULL,
  `menu_2` int(2) DEFAULT NULL,
  `menu_3` int(2) DEFAULT NULL,
  `exibe` int(2) DEFAULT NULL,
  `n_index` int(11) DEFAULT NULL,
  `tipo` int(2) NOT NULL DEFAULT '0',
  `layout` int(2) NOT NULL DEFAULT '0',
  `layout2` int(2) NOT NULL DEFAULT '0',
  `flag1` int(2) NOT NULL DEFAULT '0',
  `flag2` int(2) NOT NULL DEFAULT '0',
  `image` varchar(200) NOT NULL DEFAULT '0',
  `icon` varchar(100) NOT NULL DEFAULT '0',
  `exibe_sub` int(1) NOT NULL DEFAULT '0',
  `cor` varchar(50) NOT NULL DEFAULT '0',
  `id_master` int(11) NOT NULL DEFAULT '0',
  `language` varchar(10) NOT NULL DEFAULT '0',
  `keywords` varchar(400) NOT NULL DEFAULT '0',
  `id_bling` int(11) NOT NULL DEFAULT '0',
  `image2` varchar(100) NOT NULL DEFAULT '0',
  `filtro` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `ecommerce_estoque`
--

CREATE TABLE `ecommerce_estoque` (
  `id` int(11) NOT NULL,
  `id_produto` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `ref` varchar(50) NOT NULL,
  `cor` varchar(50) NOT NULL,
  `hexadecimal` varchar(50) NOT NULL,
  `tamanho` varchar(50) NOT NULL,
  `qtd` int(11) NOT NULL,
  `valor` float NOT NULL,
  `tipo` varchar(50) NOT NULL DEFAULT '0',
  `n_index` int(11) NOT NULL DEFAULT '0',
  `id_variante` int(11) NOT NULL DEFAULT '0',
  `titulo` varchar(200) NOT NULL DEFAULT '0',
  `container_1` longtext NOT NULL,
  `image_1` longtext NOT NULL,
  `image_2` longtext NOT NULL,
  `image_3` longtext NOT NULL,
  `image_4` longtext NOT NULL,
  `image_5` longtext NOT NULL,
  `image_6` longtext NOT NULL,
  `image_7` longtext NOT NULL,
  `image_8` longtext NOT NULL,
  `image_9` longtext NOT NULL,
  `image_10` longtext NOT NULL,
  `reservados` int(11) NOT NULL DEFAULT '0',
  `reservados_time` datetime NOT NULL,
  `promocao` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `ecommerce_pagamentos`
--

CREATE TABLE `ecommerce_pagamentos` (
  `id` int(11) NOT NULL,
  `id_pedido` varchar(155) NOT NULL,
  `id_user` int(11) NOT NULL,
  `cod_pagamento` varchar(255) NOT NULL,
  `url` varchar(500) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `cidade` varchar(100) NOT NULL,
  `tipo` varchar(50) NOT NULL,
  `descricao` longtext NOT NULL,
  `data` datetime NOT NULL,
  `last_update` datetime NOT NULL,
  `valor` float NOT NULL,
  `valor_retorno` float NOT NULL,
  `extra1` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `nr_rastreio` varchar(100) NOT NULL DEFAULT '0',
  `nr_rastreio_transportadora` varchar(100) NOT NULL DEFAULT '0',
  `metodo_pagamento` varchar(100) NOT NULL DEFAULT '0',
  `id_pedido_simples` int(11) NOT NULL DEFAULT '0',
  `tipo_pagamento` int(2) NOT NULL DEFAULT '0',
  `vencimento` date NOT NULL,
  `id_fatura` int(11) NOT NULL DEFAULT '0',
  `replaced` int(2) NOT NULL DEFAULT '0',
  `local_entrega` int(11) NOT NULL,
  `id_voucher` int(11) NOT NULL DEFAULT '0',
  `shorturl` varchar(100) NOT NULL DEFAULT '0',
  `json` longtext NOT NULL,
  `canal` varchar(30) NOT NULL DEFAULT '0',
  `transporte` varchar(100) NOT NULL DEFAULT '0',
  `id_general` int(11) NOT NULL DEFAULT '0',
  `id_api` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `ecommerce_participantes`
--

CREATE TABLE `ecommerce_participantes` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_produto` int(11) NOT NULL,
  `nome` varchar(200) NOT NULL,
  `date` datetime NOT NULL,
  `last_update` datetime NOT NULL,
  `status` int(2) NOT NULL,
  `ip` varchar(100) NOT NULL,
  `tipo` int(2) NOT NULL DEFAULT '0',
  `id_pedido` int(11) NOT NULL DEFAULT '0',
  `id_pagamento` int(11) NOT NULL DEFAULT '0',
  `id_afiliado` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `ecommerce_pedidos`
--

CREATE TABLE `ecommerce_pedidos` (
  `id` int(11) NOT NULL,
  `data` datetime NOT NULL,
  `last_update` datetime NOT NULL,
  `ip` varchar(80) NOT NULL,
  `exibe` int(2) DEFAULT NULL,
  `status` int(2) NOT NULL DEFAULT '0',
  `id_user` int(11) NOT NULL DEFAULT '0',
  `tipo` int(2) NOT NULL DEFAULT '0',
  `referente` varchar(100) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `ecommerce_produtos`
--

CREATE TABLE `ecommerce_produtos` (
  `id` int(11) NOT NULL,
  `id_pedido` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `nome` varchar(300) NOT NULL,
  `status` int(11) NOT NULL,
  `id_categoria` int(11) NOT NULL DEFAULT '0',
  `id_subcategoria` int(11) NOT NULL DEFAULT '0',
  `id_subitem` int(11) NOT NULL DEFAULT '0',
  `id_master` int(11) DEFAULT NULL,
  `id_categoria_menu` int(11) DEFAULT NULL,
  `descricao_resumo` varchar(800) DEFAULT NULL,
  `estado_produto` int(11) NOT NULL,
  `marca` varchar(45) NOT NULL,
  `descricao` text NOT NULL,
  `keywords` varchar(400) NOT NULL,
  `preco_real` float NOT NULL,
  `preco` float NOT NULL,
  `parcelas` int(11) NOT NULL DEFAULT '1',
  `unidades_min` int(11) NOT NULL,
  `unidades_max` int(11) NOT NULL,
  `unidades_person` int(11) NOT NULL DEFAULT '1',
  `unidades_current` int(11) NOT NULL DEFAULT '0',
  `peso` double UNSIGNED NOT NULL,
  `altura` int(11) DEFAULT NULL,
  `largura` int(11) DEFAULT NULL,
  `comprimento` int(11) DEFAULT NULL,
  `diametro` int(11) DEFAULT NULL,
  `data` datetime NOT NULL,
  `last_update` datetime NOT NULL,
  `date_start` datetime NOT NULL,
  `date_end` datetime DEFAULT NULL,
  `entrega` int(11) DEFAULT NULL,
  `retirar_local` int(2) DEFAULT NULL,
  `reputation` int(1) NOT NULL DEFAULT '0',
  `show_transport` int(11) NOT NULL DEFAULT '0',
  `transporte` float DEFAULT NULL,
  `embrulho` float DEFAULT NULL,
  `vitrine` int(11) NOT NULL DEFAULT '0',
  `promocao` float NOT NULL DEFAULT '0',
  `lancamento` int(2) DEFAULT NULL,
  `exibe_ecommerce` int(2) DEFAULT NULL,
  `exibe_produtos` int(2) DEFAULT NULL,
  `display_company` int(11) NOT NULL DEFAULT '0',
  `percentage` float DEFAULT NULL,
  `n_index` int(11) NOT NULL DEFAULT '0',
  `tipo` varchar(100) NOT NULL,
  `pais` varchar(100) NOT NULL,
  `cidade` varchar(100) NOT NULL,
  `slot1` varchar(150) NOT NULL DEFAULT '',
  `slot2` varchar(150) NOT NULL DEFAULT '',
  `slot3` varchar(150) NOT NULL DEFAULT '',
  `slot4` varchar(150) NOT NULL DEFAULT '',
  `slot5` varchar(150) NOT NULL DEFAULT '',
  `url` varchar(100) DEFAULT NULL,
  `referencia` varchar(100) NOT NULL DEFAULT '0',
  `sob_consulta` int(2) DEFAULT NULL,
  `ordem_servico` int(2) NOT NULL DEFAULT '0',
  `frete_gratis` int(2) NOT NULL DEFAULT '0',
  `nr_comentarios` int(11) NOT NULL DEFAULT '0',
  `views` int(11) NOT NULL DEFAULT '0',
  `unidade` varchar(40) NOT NULL DEFAULT '0',
  `modelo` varchar(400) NOT NULL DEFAULT '0',
  `ano` varchar(4) NOT NULL DEFAULT '0',
  `reputation_count` int(11) NOT NULL DEFAULT '0',
  `reputation_total` int(11) NOT NULL DEFAULT '0',
  `reputation_higher` int(2) NOT NULL DEFAULT '0',
  `reputation_lower` int(2) NOT NULL DEFAULT '0',
  `slot6` varchar(200) NOT NULL DEFAULT '0',
  `slot7` varchar(200) NOT NULL DEFAULT '0',
  `slot8` varchar(200) NOT NULL DEFAULT '0',
  `slot9` varchar(200) NOT NULL DEFAULT '0',
  `slot10` varchar(200) NOT NULL DEFAULT '0',
  `estoque` int(11) NOT NULL,
  `language` varchar(10) NOT NULL DEFAULT '0',
  `parcela_valor` float NOT NULL,
  `afiliacao_valor` int(11) NOT NULL DEFAULT '0',
  `slot11` varchar(100) NOT NULL DEFAULT '0',
  `slot12` varchar(100) NOT NULL DEFAULT '0',
  `slot13` varchar(100) NOT NULL DEFAULT '0',
  `slot14` varchar(100) NOT NULL DEFAULT '0',
  `slot15` varchar(100) NOT NULL DEFAULT '0',
  `slot16` varchar(100) NOT NULL DEFAULT '0',
  `slot17` varchar(100) NOT NULL DEFAULT '0',
  `slot18` varchar(100) NOT NULL DEFAULT '0',
  `slot19` varchar(100) NOT NULL DEFAULT '0',
  `slot20` varchar(100) NOT NULL DEFAULT '0',
  `selo` varchar(100) NOT NULL DEFAULT '0',
  `sob_encomenda` int(2) NOT NULL DEFAULT '0',
  `container_1` varchar(100) NOT NULL DEFAULT '0',
  `exibir_banner` int(2) NOT NULL DEFAULT '0',
  `nome_usuario` varchar(800) NOT NULL DEFAULT '0',
  `user_edition` varchar(200) NOT NULL DEFAULT '0',
  `qtd_allowed` int(11) NOT NULL DEFAULT '0',
  `link_special` varchar(200) NOT NULL DEFAULT '0',
  `tipo_contato` int(2) NOT NULL DEFAULT '0',
  `email` varchar(100) NOT NULL DEFAULT '0',
  `json` longtext NOT NULL,
  `sku` varchar(100) NOT NULL DEFAULT '0',
  `api` varchar(10) NOT NULL DEFAULT '0',
  `id_categoria2` int(11) NOT NULL DEFAULT '0',
  `id_subcategoria2` int(11) NOT NULL DEFAULT '0',
  `id_subitem2` int(11) NOT NULL DEFAULT '0',
  `id_categoria3` int(11) NOT NULL DEFAULT '0',
  `id_subcategoria3` int(11) NOT NULL DEFAULT '0',
  `id_subitem3` int(11) NOT NULL DEFAULT '0',
  `id_estoque` int(11) NOT NULL DEFAULT '0',
  `uf` varchar(6) NOT NULL DEFAULT '0',
  `area` varchar(20) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `ecommerce_produtos`
--

INSERT INTO `ecommerce_produtos` (`id`, `id_pedido`, `id_user`, `nome`, `status`, `id_categoria`, `id_subcategoria`, `id_subitem`, `id_master`, `id_categoria_menu`, `descricao_resumo`, `estado_produto`, `marca`, `descricao`, `keywords`, `preco_real`, `preco`, `parcelas`, `unidades_min`, `unidades_max`, `unidades_person`, `unidades_current`, `peso`, `altura`, `largura`, `comprimento`, `diametro`, `data`, `last_update`, `date_start`, `date_end`, `entrega`, `retirar_local`, `reputation`, `show_transport`, `transporte`, `embrulho`, `vitrine`, `promocao`, `lancamento`, `exibe_ecommerce`, `exibe_produtos`, `display_company`, `percentage`, `n_index`, `tipo`, `pais`, `cidade`, `slot1`, `slot2`, `slot3`, `slot4`, `slot5`, `url`, `referencia`, `sob_consulta`, `ordem_servico`, `frete_gratis`, `nr_comentarios`, `views`, `unidade`, `modelo`, `ano`, `reputation_count`, `reputation_total`, `reputation_higher`, `reputation_lower`, `slot6`, `slot7`, `slot8`, `slot9`, `slot10`, `estoque`, `language`, `parcela_valor`, `afiliacao_valor`, `slot11`, `slot12`, `slot13`, `slot14`, `slot15`, `slot16`, `slot17`, `slot18`, `slot19`, `slot20`, `selo`, `sob_encomenda`, `container_1`, `exibir_banner`, `nome_usuario`, `user_edition`, `qtd_allowed`, `link_special`, `tipo_contato`, `email`, `json`, `sku`, `api`, `id_categoria2`, `id_subcategoria2`, `id_subitem2`, `id_categoria3`, `id_subcategoria3`, `id_subitem3`, `id_estoque`, `uf`, `area`) VALUES
(1, 0, 1, 'Camiseta Preta', 1, 0, 0, 0, NULL, NULL, 'Camiseta preta', 0, 'PurplePier', '', 'camiseta, malha fria', 39.9, 0, 1, 0, 1, 1, 0, 1, NULL, NULL, NULL, NULL, '2016-10-13 11:57:37', '2016-10-13 11:57:37', '1969-12-31 21:00:00', '1969-12-31 21:00:00', NULL, 0, 5, 0, NULL, NULL, 0, 0, 0, 0, 1, 0, 0, 0, 'simples', '', '', '', '', '', '', '', 'camiseta-preta', '', 0, 0, 0, 0, 0, '0', '0', '0', 0, 0, 0, 0, '0', '0', '0', '0', '0', 0, '0', 0, 0, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', 0, '0', 0, '0', '0', 0, '0', 0, '0', '', '0', '0', 0, 0, 0, 0, 0, 0, 0, '0', '0'),
(2, 0, 1, 'Camiseta Preta', 1, 0, 0, 0, NULL, NULL, 'Camiseta preta', 0, 'PurplePier', '', 'camiseta, malha fria', 39.9, 0, 1, 0, 1, 1, 0, 1, NULL, NULL, NULL, NULL, '2016-10-13 11:58:44', '2016-10-13 11:58:44', '1969-12-31 21:00:00', '1969-12-31 21:00:00', NULL, 0, 5, 0, NULL, NULL, 0, 0, 0, 0, 1, 0, 0, 0, 'simples', '', '', '', '', '', '', '', 'camiseta-preta', '', 0, 0, 0, 0, 0, '0', '0', '0', 0, 0, 0, 0, '0', '0', '0', '0', '0', 0, '0', 0, 0, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', 0, '0', 0, '0', '0', 0, '0', 0, '0', '', '0', '0', 0, 0, 0, 0, 0, 0, 0, '0', '0'),
(3, 0, 1, 'Camiseta Preta', 1, 0, 0, 0, NULL, NULL, 'Camiseta preta', 0, 'PurplePier', '', 'camiseta, malha fria', 39.9, 0, 1, 0, 1, 1, 0, 1, NULL, NULL, NULL, NULL, '2016-10-13 11:59:58', '2016-10-13 11:59:58', '1969-12-31 21:00:00', '1969-12-31 21:00:00', NULL, 0, 5, 0, NULL, NULL, 0, 0, 0, 0, 1, 0, 0, 0, 'simples', '', '', '', '', '', '', '', 'camiseta-preta', '', 0, 0, 0, 0, 0, '0', '0', '0', 0, 0, 0, 0, '0', '0', '0', '0', '0', 0, '0', 0, 0, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', 0, '0', 0, '0', '0', 0, '0', 0, '0', '', '0', '0', 0, 0, 0, 0, 0, 0, 0, '0', '0');

-- --------------------------------------------------------

--
-- Estrutura da tabela `ecommerce_regions`
--

CREATE TABLE `ecommerce_regions` (
  `id` int(11) NOT NULL,
  `id_produto` int(11) NOT NULL,
  `id_region` int(11) NOT NULL COMMENT '//Se zero todas as regioes foram selecionadas',
  `cep` varchar(20) NOT NULL DEFAULT '0',
  `uf` varchar(100) NOT NULL DEFAULT '0',
  `kg` varchar(20) NOT NULL DEFAULT '0',
  `valor` float NOT NULL,
  `valor_extra` float NOT NULL,
  `data` datetime NOT NULL,
  `last_update` datetime NOT NULL,
  `area` varchar(50) NOT NULL DEFAULT '0',
  `sedex` float NOT NULL,
  `prazo_sedex` varchar(20) NOT NULL DEFAULT '0',
  `prazo_pac` varchar(20) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='//Se zero todas as regiões';

--
-- Extraindo dados da tabela `ecommerce_regions`
--

INSERT INTO `ecommerce_regions` (`id`, `id_produto`, `id_region`, `cep`, `uf`, `kg`, `valor`, `valor_extra`, `data`, `last_update`, `area`, `sedex`, `prazo_sedex`, `prazo_pac`) VALUES
(15, 11, 12, '0', '0', '0', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0', 0, '0', '0'),
(14, 55, 12, '0', '0', '0', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0', 0, '0', '0'),
(13, 55, 10, '0', '0', '0', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0', 0, '0', '0'),
(12, 55, 1, '0', '0', '0', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0', 0, '0', '0'),
(16, 10, 3, '0', '0', '0', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0', 0, '0', '0'),
(27, 12, 0, '0', '0', '0', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0', 0, '0', '0'),
(26, 57, 0, '0', '0', '0', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0', 0, '0', '0'),
(19, 56, 1, '0', '0', '0', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0', 0, '0', '0'),
(20, 56, 12, '0', '0', '0', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0', 0, '0', '0'),
(25, 54, 0, '0', '0', '0', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0', 0, '0', '0'),
(28, 58, 0, '0', '0', '0', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0', 0, '0', '0');

-- --------------------------------------------------------

--
-- Estrutura da tabela `ecommerce_states`
--

CREATE TABLE `ecommerce_states` (
  `id` int(11) NOT NULL,
  `description` varchar(45) DEFAULT NULL COMMENT 'Cadastrado'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `ecommerce_states`
--

INSERT INTO `ecommerce_states` (`id`, `description`) VALUES
(1, 'Cadastrado'),
(2, 'Aprovado'),
(3, 'Reprovado'),
(4, 'Finalizado Com Sucesso'),
(5, 'Finalizado Sem Sucesso'),
(6, 'Iniciado');

-- --------------------------------------------------------

--
-- Estrutura da tabela `ecommerce_subcategorias`
--

CREATE TABLE `ecommerce_subcategorias` (
  `id_subcategoria` int(11) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `subcategoria_label` varchar(100) NOT NULL,
  `subcategoria_url` varchar(100) NOT NULL,
  `tipo` int(2) NOT NULL DEFAULT '0',
  `n_index` int(11) NOT NULL,
  `exibe` int(2) NOT NULL DEFAULT '0',
  `descricao` longtext NOT NULL,
  `container_1` varchar(200) NOT NULL DEFAULT '0',
  `id_master` int(11) NOT NULL DEFAULT '0',
  `language` varchar(10) NOT NULL DEFAULT '0',
  `keywords` varchar(400) NOT NULL DEFAULT '0',
  `id_bling` int(11) NOT NULL DEFAULT '0',
  `image2` varchar(100) NOT NULL DEFAULT '0',
  `filtro` int(11) NOT NULL DEFAULT '0',
  `json` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `ecommerce_subitems`
--

CREATE TABLE `ecommerce_subitems` (
  `id_subitem` int(11) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `id_subcategoria` int(11) NOT NULL,
  `subitem_label` varchar(100) NOT NULL,
  `subitem_url` varchar(150) NOT NULL,
  `tipo` int(2) NOT NULL DEFAULT '0',
  `n_index` int(11) NOT NULL,
  `container_1` varchar(200) NOT NULL DEFAULT '0',
  `exibe` int(2) NOT NULL DEFAULT '0',
  `descricao` longtext NOT NULL,
  `id_master` int(11) NOT NULL DEFAULT '0',
  `language` varchar(10) NOT NULL DEFAULT '0',
  `keywords` varchar(400) NOT NULL DEFAULT '0',
  `id_bling` int(11) NOT NULL DEFAULT '0',
  `image2` varchar(100) NOT NULL DEFAULT '0',
  `filtro` int(11) NOT NULL DEFAULT '0',
  `json` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `erp_boletos`
--

CREATE TABLE `erp_boletos` (
  `id` int(11) NOT NULL,
  `id_entidade` int(11) NOT NULL,
  `banco` varchar(50) CHARACTER SET utf8 NOT NULL,
  `valor` float NOT NULL,
  `multa` float NOT NULL,
  `prazo` int(11) NOT NULL,
  `vencimento` date NOT NULL,
  `last_update` datetime NOT NULL,
  `tipo` int(11) NOT NULL,
  `titulo` varchar(300) NOT NULL,
  `descricao` longtext NOT NULL,
  `status` int(2) NOT NULL,
  `qtd` int(11) NOT NULL DEFAULT '0',
  `shorturl` varchar(100) NOT NULL DEFAULT '0',
  `id_pedido` int(11) NOT NULL DEFAULT '0',
  `cod_pedidos` varchar(200) NOT NULL DEFAULT '0',
  `cod_pedido` varchar(200) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `erp_boletos`
--

INSERT INTO `erp_boletos` (`id`, `id_entidade`, `banco`, `valor`, `multa`, `prazo`, `vencimento`, `last_update`, `tipo`, `titulo`, `descricao`, `status`, `qtd`, `shorturl`, `id_pedido`, `cod_pedidos`, `cod_pedido`) VALUES
(2, 0, '', 33, 0, 0, '2016-09-02', '2016-09-02 11:39:43', 1, 'Boleto de teste', '', 0, 0, 'vp9l9', 0, '0', '0_0b335a00138ac751409fa1bed8639f39'),
(3, 0, '', 0, 0, 0, '2016-09-02', '2016-09-02 11:43:05', 1, 'Boleto', '', 0, 0, 'vb1q2', 0, '0', '0_391b253689e3872f837116cbe6b7805a'),
(4, 0, '', 0, 0, 0, '2016-09-02', '2016-09-02 11:43:20', 1, 'Bolteo', '', 0, 0, 'vc7z8', 0, '0', '0_f041f53430aa6f433950bfc60e3273d0'),
(5, 0, '', 33, 0, 0, '2016-09-02', '2016-09-02 11:44:31', 1, 'Titulo', '', 0, 0, 'vd5a1', 0, '0', '0_da77e28cd1e16e07c2d3298ff59dc6aa');

-- --------------------------------------------------------

--
-- Estrutura da tabela `erp_categorias`
--

CREATE TABLE `erp_categorias` (
  `id` int(11) NOT NULL,
  `id_level` int(11) NOT NULL,
  `id_n1` int(11) NOT NULL,
  `id_n2` int(11) NOT NULL,
  `id_n3` int(11) NOT NULL,
  `id_n4` int(11) NOT NULL,
  `titulo` varchar(300) NOT NULL,
  `descricao` longtext NOT NULL,
  `tipo` int(2) NOT NULL,
  `level` varchar(100) NOT NULL,
  `last_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `erp_categorias`
--

INSERT INTO `erp_categorias` (`id`, `id_level`, `id_n1`, `id_n2`, `id_n3`, `id_n4`, `titulo`, `descricao`, `tipo`, `level`, `last_update`) VALUES
(1, 1, 0, 0, 0, 0, 'Receita', '', 1, '1', '2015-02-18 21:58:21'),
(2, 1, 0, 0, 0, 0, 'Despesas', 'Despesas gerais', 0, '2', '2015-02-20 14:17:52'),
(3, 3, 1, 2, 0, 0, 'Receitas sob Serviços', '', 1, '1.1', '2015-02-20 14:19:45'),
(20, 3, 1, 0, 0, 0, 'Receitas com Produtos', '', 1, '1.2 ', '2015-02-20 21:14:40'),
(21, 2, 1, 0, 0, 0, 'Receitas Financeiras', '', 1, '1.3', '2015-02-20 21:15:08'),
(61, 2, 2, 0, 0, 0, 'Despesas Adminstrativas', 'Tudo relacionado a Administração do negócio em si', 2, '2.1', '2015-02-24 15:15:38'),
(62, 2, 2, 0, 0, 0, 'Despesas Operacionais', 'Tudo relacionado as operações do negócio', 2, '2.2', '2015-02-24 15:16:08'),
(63, 2, 2, 0, 0, 0, 'Despesas Colaboradores', 'Tudo relacionado as colaboradores, fornecedores e etc', 2, '2.2', '2015-02-24 15:16:34'),
(64, 2, 2, 0, 0, 0, 'Impostos', 'Impostos', 2, '2.4', '2015-02-24 15:16:54'),
(66, 2, 1, 0, 0, 0, 'Receitas de Venda de Produtos', '', 1, '1.2', '2015-02-26 14:22:15');

-- --------------------------------------------------------

--
-- Estrutura da tabela `erp_faturas`
--

CREATE TABLE `erp_faturas` (
  `id` int(11) NOT NULL,
  `id_entidade` int(11) NOT NULL,
  `id_boleto` int(11) NOT NULL,
  `titulo` varchar(300) CHARACTER SET utf8 NOT NULL,
  `date` date NOT NULL,
  `last_update` datetime NOT NULL,
  `cod_pedido` varchar(200) NOT NULL,
  `vencimento` date NOT NULL,
  `valor` float NOT NULL,
  `tipo` int(2) NOT NULL,
  `status` int(2) NOT NULL,
  `tipo_pagamento` int(3) NOT NULL DEFAULT '0',
  `cod_pagamento` varchar(20) NOT NULL DEFAULT '0',
  `vencimento_original` date NOT NULL,
  `shorturl` varchar(100) NOT NULL DEFAULT '0',
  `entidade` varchar(100) NOT NULL DEFAULT '0',
  `nr_envios` int(2) NOT NULL DEFAULT '0',
  `email` varchar(150) NOT NULL DEFAULT '0',
  `nr_open` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `erp_faturas_items`
--

CREATE TABLE `erp_faturas_items` (
  `id` int(11) NOT NULL,
  `id_fatura` int(11) NOT NULL,
  `id_conta` int(11) NOT NULL,
  `last_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `erp_financeiro`
--

CREATE TABLE `erp_financeiro` (
  `id` int(11) NOT NULL,
  `id_categoria` int(2) NOT NULL COMMENT '0 = pagamentos e 1 = recebimentos',
  `id_general` int(11) NOT NULL,
  `id_entidade` int(11) DEFAULT NULL,
  `id_erp_categoria` int(11) DEFAULT NULL,
  `id_erp_subcategoria` int(11) DEFAULT NULL,
  `id_erp_subitem` int(11) DEFAULT NULL,
  `id_erp_subelement` int(11) DEFAULT NULL,
  `titulo` varchar(300) CHARACTER SET utf8 NOT NULL,
  `tipo` int(2) NOT NULL,
  `valor` float NOT NULL,
  `descricao` longtext CHARACTER SET utf8 NOT NULL,
  `nr_parcela` int(11) NOT NULL DEFAULT '0',
  `date` date NOT NULL,
  `date_final` datetime NOT NULL,
  `last_update` datetime NOT NULL,
  `id_order` int(11) NOT NULL DEFAULT '0',
  `comissao` float NOT NULL,
  `id_comissionado` int(11) NOT NULL DEFAULT '0',
  `status` int(2) NOT NULL DEFAULT '0',
  `instituicao` int(2) NOT NULL DEFAULT '0',
  `nr_parcelas` int(2) NOT NULL DEFAULT '0',
  `desconto` float NOT NULL,
  `area` int(2) NOT NULL DEFAULT '0',
  `cod_pedido` varchar(200) NOT NULL DEFAULT '0',
  `id_frequencia` int(2) NOT NULL DEFAULT '0',
  `next_payment` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `erp_insumos`
--

CREATE TABLE `erp_insumos` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `ref` varchar(50) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `id_item` int(11) NOT NULL,
  `qtd` int(11) NOT NULL,
  `valor` float NOT NULL,
  `tipo` varchar(50) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `erp_insumos`
--

INSERT INTO `erp_insumos` (`id`, `id_user`, `ref`, `id_categoria`, `id_item`, `qtd`, `valor`, `tipo`) VALUES
(25, 0, '0', 0, 5, 0, 0, '0'),
(26, 0, '0', 0, 6, 0, 0, '0'),
(27, 0, '0', 0, 7, 0, 0, '0'),
(28, 0, '0', 0, 10, 0, 0, '0'),
(29, 0, '0', 0, 11, 0, 0, '0'),
(30, 0, '0', 0, 12, 0, 0, '0');

-- --------------------------------------------------------

--
-- Estrutura da tabela `erp_nfe`
--

CREATE TABLE `erp_nfe` (
  `id` int(11) NOT NULL,
  `id_entidade` int(11) NOT NULL,
  `banco` varchar(50) CHARACTER SET utf8 NOT NULL,
  `valor` float NOT NULL,
  `multa` float NOT NULL,
  `prazo` int(11) NOT NULL,
  `vencimento` date NOT NULL,
  `last_update` datetime NOT NULL,
  `tipo` int(11) NOT NULL,
  `titulo` varchar(300) NOT NULL,
  `descricao` longtext NOT NULL,
  `status` int(2) NOT NULL,
  `qtd` int(11) NOT NULL DEFAULT '0',
  `shorturl` varchar(100) NOT NULL DEFAULT '0',
  `id_pedido` int(11) NOT NULL DEFAULT '0',
  `cod_pedidos` varchar(200) NOT NULL DEFAULT '0',
  `cod_pedido` varchar(200) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `erp_recorrentes`
--

CREATE TABLE `erp_recorrentes` (
  `id` int(11) NOT NULL,
  `id_entidade` int(11) NOT NULL,
  `titulo` varchar(400) NOT NULL,
  `tipo` int(2) NOT NULL,
  `date` datetime NOT NULL,
  `mes` int(2) NOT NULL,
  `last_update` datetime NOT NULL,
  `descricao` longtext NOT NULL,
  `valor` float NOT NULL,
  `id_frequencia` int(2) NOT NULL,
  `id_servidor` int(11) NOT NULL,
  `id_plano` int(11) NOT NULL,
  `next_invoice` date NOT NULL,
  `total_invoice` float NOT NULL,
  `status` int(2) NOT NULL,
  `json` longtext NOT NULL,
  `valor_erp` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `eventos_attribute`
--

CREATE TABLE `eventos_attribute` (
  `id` int(11) NOT NULL,
  `id_evento` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_company` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `texto` varchar(150) NOT NULL,
  `inteiro` int(11) NOT NULL,
  `estampa` varchar(150) NOT NULL,
  `data_criacao` datetime NOT NULL,
  `data_evento` date DEFAULT NULL,
  `pago` int(11) NOT NULL,
  `pagamento` int(2) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `eventos_data`
--

CREATE TABLE `eventos_data` (
  `id` int(11) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `subtitulo` varchar(200) NOT NULL DEFAULT '',
  `destaque` varchar(400) DEFAULT NULL,
  `descricao` longtext NOT NULL,
  `container_1` varchar(25) NOT NULL,
  `data` date NOT NULL,
  `data_criacao` datetime NOT NULL,
  `last_update` datetime NOT NULL,
  `local` varchar(150) NOT NULL,
  `valor` int(11) NOT NULL,
  `valor_associado` int(11) NOT NULL,
  `link` varchar(200) DEFAULT NULL,
  `realizacao` varchar(155) NOT NULL,
  `keywords` varchar(400) NOT NULL,
  `requisitos` varchar(550) NOT NULL,
  `hora_inicio` time NOT NULL,
  `hora_final` time NOT NULL,
  `inscritos_max` int(11) NOT NULL,
  `inscritos_atual` int(11) NOT NULL,
  `exibe` int(2) NOT NULL DEFAULT '1',
  `agenda` int(2) NOT NULL DEFAULT '0',
  `palestrante` int(11) NOT NULL DEFAULT '0',
  `palestrantes` varchar(100) NOT NULL DEFAULT '0',
  `views` int(11) NOT NULL DEFAULT '0',
  `termino` int(2) NOT NULL DEFAULT '0',
  `url` varchar(600) NOT NULL DEFAULT '0',
  `titulo_fb` varchar(400) NOT NULL DEFAULT '0',
  `descricao_fb` varchar(400) NOT NULL DEFAULT '0',
  `foto_fb` varchar(100) NOT NULL DEFAULT '0',
  `status_pagamento` int(11) NOT NULL,
  `exibe_formulario` int(2) NOT NULL DEFAULT '1',
  `foto_square` varchar(200) NOT NULL DEFAULT '0',
  `data_inicio` date NOT NULL,
  `json` longtext NOT NULL,
  `n_index` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `general_apontamento`
--

CREATE TABLE `general_apontamento` (
  `id_apontamento` int(11) NOT NULL,
  `titulo` varchar(45) CHARACTER SET utf8 NOT NULL,
  `data` datetime NOT NULL,
  `quantidade_horas` float NOT NULL,
  `worker_id` int(11) NOT NULL,
  `descricao` varchar(200) CHARACTER SET utf8 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `general_campanhas`
--

CREATE TABLE `general_campanhas` (
  `id` int(11) NOT NULL,
  `titulo` varchar(200) NOT NULL,
  `descricao` longtext NOT NULL,
  `data` datetime NOT NULL,
  `last_update` datetime NOT NULL,
  `tipo` varchar(50) NOT NULL,
  `id_template` int(11) NOT NULL,
  `destinatarios` longtext NOT NULL,
  `extra_1` int(2) NOT NULL,
  `extra_2` int(2) NOT NULL,
  `status` int(2) NOT NULL,
  `mensagem` varchar(200) NOT NULL DEFAULT '0',
  `ramo_atuacao` int(11) NOT NULL DEFAULT '0',
  `dia` int(99) NOT NULL DEFAULT '0',
  `horario` varchar(100) NOT NULL DEFAULT '0',
  `data_especifica` date NOT NULL,
  `referente` varchar(100) NOT NULL DEFAULT '0',
  `max_envio` int(11) NOT NULL DEFAULT '0',
  `nr_envios` int(11) NOT NULL DEFAULT '0',
  `modelo` int(11) NOT NULL DEFAULT '0',
  `cidade` varchar(200) NOT NULL DEFAULT '0',
  `uf` varchar(20) NOT NULL DEFAULT '0',
  `disparos` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `general_city`
--

CREATE TABLE `general_city` (
  `id` int(11) NOT NULL,
  `id_uf` int(11) NOT NULL DEFAULT '0',
  `id_city` int(11) NOT NULL DEFAULT '0',
  `name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Estrutura da tabela `general_comentarios`
--

CREATE TABLE `general_comentarios` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_general` int(11) NOT NULL COMMENT 'Id General porque serve para qualquer coisa, materias,  produtos, cools e etc',
  `id_moderador` int(11) NOT NULL,
  `id_comment` int(11) NOT NULL,
  `tipo` varchar(100) NOT NULL,
  `exibir_comentario` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `reply_to` varchar(100) NOT NULL,
  `title` varchar(100) NOT NULL,
  `question` varchar(255) NOT NULL,
  `answer` longtext NOT NULL,
  `comentario` longtext NOT NULL,
  `date_question` datetime NOT NULL,
  `date_answer` datetime NOT NULL,
  `date_comment` datetime NOT NULL,
  `email` varchar(100) NOT NULL,
  `exibir_email` int(11) NOT NULL,
  `likes` int(11) NOT NULL,
  `unlikes` int(11) NOT NULL,
  `file` varchar(200) NOT NULL DEFAULT '0',
  `site` varchar(200) NOT NULL DEFAULT '0',
  `avatar` varchar(200) NOT NULL DEFAULT '0',
  `json` longtext NOT NULL,
  `telefone` varchar(30) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `general_contador`
--

CREATE TABLE `general_contador` (
  `id` int(11) NOT NULL,
  `tipo` varchar(100) CHARACTER SET latin1 NOT NULL,
  `total` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `general_contador`
--

INSERT INTO `general_contador` (`id`, `tipo`, `total`) VALUES
(1, 'admin', 6),
(2, 'site', 0),
(3, 'conta', 0),
(4, 'mobile', 0),
(5, 'tablet', 0),
(6, 'desktop', 6);

-- --------------------------------------------------------

--
-- Estrutura da tabela `general_contador_items`
--

CREATE TABLE `general_contador_items` (
  `id` int(11) NOT NULL,
  `tipo` varchar(20) NOT NULL,
  `date` datetime NOT NULL,
  `date_simple` date NOT NULL,
  `plataforma` varchar(20) NOT NULL,
  `descricao` longtext,
  `cidade` varchar(100) DEFAULT NULL,
  `isp` varchar(200) DEFAULT NULL,
  `pais` varchar(11) DEFAULT NULL,
  `url_from` varchar(400) DEFAULT NULL,
  `num` int(1) NOT NULL DEFAULT '1',
  `canal` varchar(30) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `general_contador_items`
--

INSERT INTO `general_contador_items` (`id`, `tipo`, `date`, `date_simple`, `plataforma`, `descricao`, `cidade`, `isp`, `pais`, `url_from`, `num`, `canal`) VALUES
(1, 'desktop', '2015-04-27 13:56:30', '2015-04-27', 'desktop', NULL, '', '', '', 'http://dev.purplepier.com.br/admin/intro/logar', 1, '0'),
(2, 'desktop', '2015-04-27 13:57:03', '2015-04-27', 'desktop', NULL, '', '', '', '', 1, '0'),
(3, 'desktop', '2015-05-22 16:40:34', '2015-05-22', 'desktop', NULL, '', '', '', 'http://dev.purplepier.com.br/admin/intro/logar', 1, '0'),
(4, 'desktop', '2015-05-22 17:23:46', '2015-05-22', 'desktop', NULL, '', '', '', '', 1, '0'),
(5, 'desktop', '2016-01-27 15:05:04', '2016-01-27', 'desktop', NULL, '', '', '', '', 1, '0'),
(6, 'desktop', '2016-01-27 16:07:27', '2016-01-27', 'desktop', NULL, '', '', '', 'http://dev.purplepier.com.br/contato', 1, '0'),
(7, 'desktop', '2016-01-27 16:55:20', '2016-01-27', 'desktop', NULL, '', '', '', '', 1, '0'),
(8, 'desktop', '2016-01-27 17:46:22', '2016-01-27', 'desktop', NULL, '', '', '', '', 1, '0'),
(9, 'desktop', '2016-01-28 20:59:30', '2016-01-28', 'desktop', NULL, '', '', '', 'http://dev.purplepier.com.br/admin', 1, '0'),
(10, 'desktop', '2016-01-29 10:16:06', '2016-01-29', 'desktop', NULL, '', '', '', 'http://dev.purplepier.com.br/admin', 1, '0'),
(11, 'desktop', '2016-08-15 15:45:45', '2016-08-15', 'desktop', NULL, '', '', '', 'http://dev.purplepier.com.br/admin/intro/logar', 1, '0'),
(12, 'desktop', '2016-08-16 07:31:50', '2016-08-16', 'desktop', NULL, '', '', '', 'http://dev.purplepier.com.br/admin/intro/logar', 1, '0');

-- --------------------------------------------------------

--
-- Estrutura da tabela `general_contato`
--

CREATE TABLE `general_contato` (
  `id` int(11) NOT NULL,
  `nome` varbinary(255) DEFAULT NULL,
  `email` varbinary(255) DEFAULT NULL,
  `telefone` varbinary(255) DEFAULT NULL,
  `mensagem` longtext,
  `container_1` varchar(150) DEFAULT NULL,
  `data` date NOT NULL,
  `last_update` datetime DEFAULT NULL,
  `tipo` varchar(50) DEFAULT NULL,
  `titulo` varchar(100) DEFAULT NULL,
  `grupo` varchar(100) DEFAULT NULL,
  `link` varchar(200) DEFAULT NULL,
  `celular` varbinary(255) DEFAULT NULL,
  `from_action` varchar(100) NOT NULL DEFAULT '0',
  `from_page` varchar(100) NOT NULL DEFAULT '0',
  `id_general` int(11) NOT NULL DEFAULT '0',
  `json` longtext,
  `canal` varchar(40) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='Tabela conta nao delete novamente';

-- --------------------------------------------------------

--
-- Estrutura da tabela `general_faq`
--

CREATE TABLE `general_faq` (
  `id` int(11) NOT NULL,
  `Titulo` varchar(200) NOT NULL,
  `Resposta` longtext NOT NULL,
  `date` datetime NOT NULL,
  `last_update` datetime NOT NULL,
  `status` int(2) NOT NULL DEFAULT '0',
  `nome` varchar(100) NOT NULL DEFAULT '0',
  `email` varchar(100) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `general_galerias`
--

CREATE TABLE `general_galerias` (
  `id` int(11) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `id_galeria` int(11) NOT NULL,
  `id_graphic` int(11) NOT NULL,
  `nome` varchar(150) NOT NULL,
  `n_index` int(11) NOT NULL,
  `tipo` varchar(50) NOT NULL,
  `data_criacao` datetime NOT NULL,
  `last_update` datetime NOT NULL,
  `status` int(2) NOT NULL DEFAULT '0',
  `id_subcategoria` int(11) NOT NULL DEFAULT '0',
  `url` varchar(200) NOT NULL DEFAULT '0',
  `descricao` longtext NOT NULL,
  `link` varchar(300) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `general_galerias_subcategorias`
--

CREATE TABLE `general_galerias_subcategorias` (
  `id` int(11) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `titulo` varchar(200) NOT NULL,
  `descricao` longtext NOT NULL,
  `container_1` varchar(100) NOT NULL,
  `url` varchar(100) NOT NULL,
  `exibe` int(2) NOT NULL,
  `data` datetime NOT NULL,
  `last_update` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `general_likes`
--

CREATE TABLE `general_likes` (
  `id` int(11) NOT NULL,
  `id_general` int(11) NOT NULL,
  `tipo` varchar(155) NOT NULL,
  `likes` int(11) NOT NULL,
  `unlikes` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `general_messages`
--

CREATE TABLE `general_messages` (
  `id` int(11) NOT NULL,
  `titulo` varchar(300) CHARACTER SET utf8 NOT NULL,
  `descricao` longtext CHARACTER SET utf8 NOT NULL,
  `tipo` int(2) NOT NULL,
  `container_1` varchar(100) CHARACTER SET utf8 NOT NULL,
  `container_2` varchar(100) CHARACTER SET utf8 NOT NULL,
  `status` int(2) NOT NULL,
  `data` datetime NOT NULL,
  `last_update` datetime NOT NULL,
  `link` varchar(200) CHARACTER SET utf8 NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `general_messages`
--

INSERT INTO `general_messages` (`id`, `titulo`, `descricao`, `tipo`, `container_1`, `container_2`, `status`, `data`, `last_update`, `link`) VALUES
(44, 'ERP - Ordem de Serviços adicionados ao Contas a Pagar', 'Agora as ordem de serviços podem ser adicionas ou não as contas a Receber.\r\nFoi adicionado um novo checkbox Ädicionar a Contas\", que ao  deixa-lo selecionado após fechado a ordem de serviço essa é cadastrada em Contas a receber, caso deixe Não selecionado nada ocorrerá.\r\nCaso tenha adicionado a Ordem de Serviço sem querer nas contas a Receber você pode remove-la, basta trocar o status de \"Aprovado\" para \"Reprovado\"... isso fará com que a conta a Receber seja removida das Contas a Receber, após isso você pode mudar o status novamente para qual desejar, não esquecendo de verificar o checkbox de \"Adicionar a Contas\"', 1, '', '', 0, '2016-08-15 15:45:56', '2016-08-16 07:32:00', ''),
(78, 'Nova Interação do seu chamado: 1202', 'Super teste', 1, '', '', 0, '2016-08-15 15:45:56', '2016-08-16 07:32:00', ''),
(79, 'Nova Interação do seu chamado: 1202', 'Quero ver a parada ficar loca!', 1, '', '', 0, '2016-08-15 15:45:56', '2016-08-16 07:32:00', ''),
(80, 'Nova Interação do seu chamado: 1202', 'Super teste', 1, '', '', 0, '2016-08-15 15:45:56', '2016-08-16 07:32:00', ''),
(81, 'Nova Interação do seu chamado: 1202', 'Muito bom!', 1, 'https://www.purplepier.com.br/media/images/messages/bt_chamado.png', '', 0, '2016-08-15 15:45:56', '2016-08-16 07:32:00', '/admin/ticket/editar/1202'),
(82, 'Nova Interação do seu chamado: 1202', 'Bom!', 1, 'https://www.purplepier.com.br/media/images/messages/bt_chamado.png', '', 0, '2016-08-15 15:45:56', '2016-08-16 07:32:00', '/admin/ticket/editar/1202'),
(83, 'Nova Interação do seu chamado: 1202', 'certo', 1, 'https://www.purplepier.com.br/media/images/messages/bt_chamado.png', '', 0, '2016-08-15 15:45:56', '2016-08-16 07:32:00', '/admin/ticket/editar/1202'),
(84, 'Nova Interação do seu chamado: 1202', 'certo', 1, 'https://www.purplepier.com.br/media/images/messages/bt_chamado.png', '', 0, '2016-08-15 15:45:56', '2016-08-16 07:32:00', '/admin/ticket/editar/1202'),
(85, 'Nova Interação do seu chamado: 1202', 'certo', 1, 'https://www.purplepier.com.br/media/images/messages/bt_chamado.png', '', 0, '2016-08-15 15:45:56', '2016-08-16 07:32:00', '/admin/ticket/editar/1202'),
(86, 'Nova Interação do seu chamado: 1202', 'certo', 1, 'https://www.purplepier.com.br/media/images/messages/bt_chamado.png', '', 0, '2016-08-15 15:45:56', '2016-08-16 07:32:00', '/admin/ticket/editar/1202'),
(24, 'Revisão - 4984', '4984', 5, '2015-04-15T10:05:08-0300', '', 0, '2016-08-15 15:45:56', '2016-08-16 07:32:00', ''),
(61, 'Revisão - 4519', '4519', 5, '2015-02-18T19:26:35-0200', '', 0, '2016-08-15 15:45:56', '2016-08-16 07:32:00', ''),
(33, 'Envie boletos do Bradesco para seus Clientes', 'PierBoletos a facilidade na emissão de suas cobranças esta aqui. Que tal enviar boletos com data de vencimento, código de barra e tudo mais!\r\nAdquira o módulo PierBoletos e profissionalize seu negócio!', 2, 'aviso_boleto_bradesco_k0.jpg', '', 0, '2016-08-15 15:45:56', '2016-08-16 07:32:00', ''),
(52, 'Deseja falar com a DigitalPier? Solicitar algum serviço? Comunicar algo? Abra um CHAMADO em seu Canal de Comunicação', 'Olá,\r\n\r\nNo começo do ano apresentamos o Canal de Comunicação, nele informamos aos nossos clientes tudo que o PurplePier está criando e disponibilizando como ferramenta de marketing para os seu negocio!\r\n\r\nPara facilitar e agilizar suas solicitações com a nossa equipe criamos dentro do Canal de Comunicação a possibilidade de abrir um CHAMADO.\r\n\r\nAssim, toda vez que você desejar falar com a nossa equipe, solicitar algum serviço, comunicar algo, basta você acessar seu painel de controle, o Admin3.0, abrir o Canal de Comunicação e registrar sua necessidade.\r\n\r\nPara saber mais como funciona o Canal de Comunicação acesse:  https://purplepier.com.br/wiki/listar/163\r\n\r\nVeja na imagem abaixo como é simples abrir um chamando:\r\n\r\n\r\nDúvidas? Acesse nossa Wiki, ou abra um chamado, ou entre em contato no telefone 3367-3442\r\n\r\nAtenciosamente,\r\n\r\nEquipe Digital Píer \r\n', 2, 'canal_de_comunicacao_chamado2_g9.jpg', '', 0, '2016-08-15 15:45:56', '2016-08-16 07:32:00', 'https://purplepier.com.br/wiki/listar/163'),
(76, 'Playground, criar imagens é divertido!', 'Com esse aplicativo você consegue criar ou melhorar suas próprias imagens.\r\nQuer mudar o tamanho, girar, aplicar filtros? Acesse o link para ver', 2, 'pierplayground_d1.png', '', 0, '2016-08-15 15:45:56', '2016-08-16 07:32:00', 'http://www.purplepier.com.br/pierplayground');

-- --------------------------------------------------------

--
-- Estrutura da tabela `general_newsletter`
--

CREATE TABLE `general_newsletter` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `regiao_interesse` varchar(100) NOT NULL,
  `newsletter` int(11) NOT NULL,
  `data` date NOT NULL,
  `ramo_atuacao` int(11) NOT NULL DEFAULT '0',
  `abordagem` int(11) NOT NULL DEFAULT '0',
  `cidade` varchar(100) NOT NULL DEFAULT '0',
  `last_update` datetime DEFAULT NULL,
  `uf` int(11) NOT NULL DEFAULT '0',
  `obiz` int(2) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `general_newsletter`
--

INSERT INTO `general_newsletter` (`id`, `nome`, `email`, `regiao_interesse`, `newsletter`, `data`, `ramo_atuacao`, `abordagem`, `cidade`, `last_update`, `uf`, `obiz`) VALUES
(1, 'Carlos Garcia', 'publicidade.exe@gmail.com', '', 1, '2015-04-27', 0, 1, '0', NULL, 0, 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `general_newsletter_tracker`
--

CREATE TABLE `general_newsletter_tracker` (
  `id` int(11) NOT NULL,
  `tipo` varchar(100) NOT NULL,
  `ip` varchar(100) NOT NULL,
  `date` date NOT NULL,
  `message` longtext NOT NULL,
  `email` varchar(300) NOT NULL,
  `cidade` varchar(200) NOT NULL,
  `pais` varchar(10) NOT NULL,
  `regiao` varchar(100) NOT NULL,
  `codigo` varchar(100) NOT NULL,
  `error` longtext,
  `descricao` longtext,
  `dominio` varchar(200) DEFAULT NULL,
  `id_campanha` int(11) DEFAULT NULL,
  `titulo_campanha` varchar(300) DEFAULT NULL,
  `tag` varchar(300) DEFAULT NULL,
  `mailing_list` varchar(300) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `general_ofertas`
--

CREATE TABLE `general_ofertas` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `tipo` varchar(50) NOT NULL,
  `titulo` varchar(100) NOT NULL,
  `subtitulo` varchar(200) NOT NULL,
  `descricao` varchar(500) NOT NULL,
  `image` varchar(100) NOT NULL,
  `data` date NOT NULL,
  `last_update` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `general_reputation`
--

CREATE TABLE `general_reputation` (
  `id` int(11) NOT NULL,
  `id_general` int(11) NOT NULL,
  `tipo` varchar(50) NOT NULL,
  `number` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `general_reputation`
--

INSERT INTO `general_reputation` (`id`, `id_general`, `tipo`, `number`) VALUES
(1, 57, 'user_vote', 11);

-- --------------------------------------------------------

--
-- Estrutura da tabela `general_shorturl`
--

CREATE TABLE `general_shorturl` (
  `id` int(11) NOT NULL,
  `id_general` int(11) NOT NULL,
  `tipo` varchar(100) NOT NULL,
  `longurl` varchar(255) NOT NULL,
  `shorturl` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `general_shorturl`
--

INSERT INTO `general_shorturl` (`id`, `id_general`, `tipo`, `longurl`, `shorturl`) VALUES
(1, 1, 'boletos', 'listar/1', 'vk7t0'),
(2, 2, 'boletos', 'listar/2', 'vp9l9'),
(3, 3, 'boletos', 'listar/3', 'vb1q2'),
(4, 4, 'boletos', 'listar/4', 'vc7z8'),
(5, 5, 'boletos', 'listar/5', 'vd5a1');

-- --------------------------------------------------------

--
-- Estrutura da tabela `general_state`
--

CREATE TABLE `general_state` (
  `id` int(11) NOT NULL,
  `countries_id` int(11) NOT NULL,
  `uf` varchar(2) DEFAULT NULL COMMENT 'Ex: SP',
  `name` varchar(20) DEFAULT NULL COMMENT 'ex: S?o Paulo',
  `exibe` int(2) NOT NULL DEFAULT '1',
  `n_index` int(11) NOT NULL DEFAULT '5'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `general_state`
--

INSERT INTO `general_state` (`id`, `countries_id`, `uf`, `name`, `exibe`, `n_index`) VALUES
(1, 1, 'AC', 'Acre', 1, 5),
(2, 1, 'AL', 'Alagoas', 1, 5),
(3, 1, 'AM', 'Amazonas', 1, 5),
(4, 1, 'AP', 'Amapá', 1, 5),
(5, 1, 'BA', 'Bahia', 1, 5),
(6, 1, 'CE', 'Ceará', 1, 5),
(7, 1, 'DF', 'Distrito Federal', 1, 5),
(8, 1, 'ES', 'Espírito Santo', 1, 5),
(9, 1, 'GO', 'Goiás', 1, 5),
(10, 1, 'MA', 'Maranhão', 1, 5),
(11, 1, 'MG', 'Minas Gerais', 1, 5),
(12, 1, 'MS', 'Mato Grosso do Sul', 1, 5),
(13, 1, 'MT', 'Mato Grosso', 1, 5),
(14, 1, 'PA', 'Pará', 1, 5),
(15, 1, 'PB', 'Paraíba', 1, 5),
(16, 1, 'PE', 'Pernambuco', 1, 5),
(17, 1, 'PI', 'Piauí', 1, 5),
(18, 1, 'PR', 'Paraná', 1, 5),
(19, 1, 'RJ', 'Rio de Janeiro', 1, 5),
(20, 2, 'RN', 'Rio Grande do Norte', 1, 5),
(21, 2, 'RR', 'Roraima', 1, 5),
(22, 2, 'RO', 'Rondônia', 1, 5),
(23, 2, 'RS', 'Rio Grande do Sul', 1, 5),
(24, 2, 'SC', 'Santa Catarina', 1, 5),
(25, 2, 'SE', 'Sergipe', 1, 5),
(26, 2, 'SP', 'São Paulo', 1, 5),
(27, 2, 'TO', 'Tocantins', 1, 5);

-- --------------------------------------------------------

--
-- Estrutura da tabela `inhamer_data`
--

CREATE TABLE `inhamer_data` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `avatar` varchar(150) NOT NULL,
  `date` datetime NOT NULL,
  `comentario` longtext NOT NULL,
  `status` int(2) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `inhamer_messages`
--

CREATE TABLE `inhamer_messages` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `tipo` int(2) NOT NULL,
  `message` longtext NOT NULL,
  `file` varchar(400) NOT NULL,
  `date` datetime NOT NULL,
  `status` int(2) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `paginas_attribute`
--

CREATE TABLE `paginas_attribute` (
  `id` int(11) NOT NULL,
  `id_pagina` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `inteiro` int(11) DEFAULT NULL,
  `number` float NOT NULL,
  `estampa` timestamp NULL DEFAULT NULL,
  `texto` varchar(255) DEFAULT NULL,
  `descricao` longtext NOT NULL,
  `id_componente` int(11) NOT NULL DEFAULT '0',
  `id_row` int(11) NOT NULL DEFAULT '0',
  `tipo` varchar(50) NOT NULL DEFAULT '0',
  `plataforma` varchar(50) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `paginas_attribute`
--

INSERT INTO `paginas_attribute` (`id`, `id_pagina`, `user_id`, `name`, `inteiro`, `number`, `estampa`, `texto`, `descricao`, `id_componente`, `id_row`, `tipo`, `plataforma`) VALUES
(1, 7, 0, 'ctt_address', NULL, 0, NULL, NULL, 'Av.: Dr. Júlio Soares de Arruda, 630', 0, 0, '0', '0'),
(2, 7, 0, 'ctt_celular', NULL, 0, NULL, ' [19] 9-8367-5969 - Tim', '', 0, 0, '0', '0'),
(3, 7, 0, 'ctt_cidade', NULL, 0, NULL, 'Campinas', '', 0, 0, '0', '0'),
(4, 7, 0, 'ctt_company_name', NULL, 0, NULL, 'Digital Pier - Marketing Digital', '', 0, 0, '0', '0'),
(5, 7, 0, 'ctt_estado', NULL, 0, NULL, ' SP', '', 0, 0, '0', '0'),
(6, 7, 0, 'ctt_site', NULL, 0, NULL, ' www.purplepier.com.br', '', 0, 0, '0', '0'),
(7, 7, 0, 'ctt_tel_1', NULL, 0, NULL, ' [19] 3367-3442', '', 0, 0, '0', '0'),
(8, 7, 0, 'gel_fr_initial', NULL, 0, NULL, NULL, ' Entre em contato conosco e surpreenda-se', 0, 0, '0', '0'),
(9, 58, 0, 'mat_lk_rcn_adv', 5, 0, NULL, NULL, '', 0, 0, '0', '0'),
(10, 58, 0, 'mat_lk_rcn_afi', NULL, 0, NULL, 'todos', '', 0, 0, '0', '0'),
(11, 58, 0, 'mat_lk_rcn_blc', 4, 0, NULL, NULL, '', 0, 0, '0', '0'),
(12, 58, 0, 'mat_lk_rcn_qtd', 20, 0, NULL, NULL, '', 0, 0, '0', '0'),
(13, 119, 0, 'gel_fr_initial', NULL, 0, NULL, NULL, ' Desenvolva sua loja conosco e entre para o ramo online', 0, 0, '0', '0'),
(14, 6, 0, 'gel_fr_initial', NULL, 0, NULL, NULL, 'Preencha os dados abaixo para orçar', 0, 0, '0', '0'),
(15, 50, 0, 'mat_lk_rcn_qtd', 30, 0, NULL, NULL, '', 0, 0, '0', '0'),
(16, 50, 0, 'mat_lk_rcn_afi', NULL, 0, NULL, 'afinidade', '', 0, 0, '0', '0'),
(17, 50, 0, 'mat_lk_rcn_adv', 1, 0, NULL, NULL, '', 0, 0, '0', '0'),
(18, 50, 0, 'mat_lk_rcn_blc', 4, 0, NULL, NULL, '', 0, 0, '0', '0'),
(19, 137, 0, 'qtd_blocos', 4, 0, '2014-08-22 15:03:44', NULL, '', 206, 14, 'inteiro', 'desktop'),
(20, 137, 0, 'titulo_1', NULL, 0, '2014-08-22 15:03:44', NULL, 'Plano Pier - 1', 206, 14, 'texto', 'desktop'),
(21, 137, 0, 'subtitulo_1', NULL, 0, '2014-08-22 15:03:44', NULL, 'WebSite Responsivo + ERP + Loja Virtual + Integração Mercado Livre + Identidade Visual', 206, 14, 'texto', 'desktop'),
(22, 137, 0, 'texto_1', NULL, 0, '2014-08-22 15:03:44', NULL, '- Plano completo com todas funcionalidades do sistema liberados;\r\n- Gerenciamento de Conteúdo - Pier Admin 3.0;\r\n- ERP -  Sistema integrado de gestão empresarial;\r\n- Loja Virtual;\r\n- Identidade Visual (3 Banners, Logotipo e +1000 cartões de visita);\r\n- Layout Responsivo.\r\n\r\nValor de hospedagem sobre consulta', 206, 14, 'texto', 'desktop'),
(23, 137, 0, 'valor_1', 3500, 0, '2014-08-22 15:03:44', NULL, '', 206, 14, 'inteiro', 'desktop'),
(24, 137, 0, 'centavo_1', NULL, 0, '2014-08-22 15:03:44', '', '', 206, 14, 'texto', 'desktop'),
(25, 137, 0, 'unidade_1', NULL, 0, '2014-08-22 15:03:44', 'R$', '', 206, 14, 'texto', 'desktop'),
(26, 137, 0, 'frequencia_1', NULL, 0, '2014-08-22 15:03:44', '/ 4 x', '', 206, 14, 'texto', 'desktop'),
(27, 137, 0, 'label_1', NULL, 0, '2014-08-22 15:03:44', 'Contratar', '', 206, 14, 'texto', 'desktop'),
(28, 137, 0, 'link_1', NULL, 0, '2014-08-22 15:03:44', '/contato', '', 206, 14, 'texto', 'desktop'),
(29, 137, 0, 'destaque_1', 0, 0, '2014-08-22 15:03:44', NULL, '', 206, 14, 'inteiro', 'desktop'),
(30, 137, 0, 'titulo_2', NULL, 0, '2014-08-22 15:03:44', NULL, 'Plano Pier - 2', 206, 14, 'texto', 'desktop'),
(31, 137, 0, 'subtitulo_2', NULL, 0, '2014-08-22 15:03:44', NULL, 'WebSite Responsivo + ERP + Loja Virtual + Identidade Visual', 206, 14, 'texto', 'desktop'),
(32, 137, 0, 'texto_2', NULL, 0, '2014-08-22 15:03:44', NULL, '- Plano com estrutura básica para loja virtual;\r\n- Gerenciamento de Conteúdo - Pier Admin 3.0;\r\n- ERP - Sistema integrado de gestão empresarial;\r\n- Loja Virtual;\r\n- Identidade Visual (3 Banners, Logotipo e +1000 cartões de visita)\r\n- Layout Responsivo.\r\n\r\nValor de hospedagem sobre consulta', 206, 14, 'texto', 'desktop'),
(33, 137, 0, 'valor_2', 2600, 0, '2014-08-22 15:03:44', NULL, '', 206, 14, 'inteiro', 'desktop'),
(34, 137, 0, 'centavo_2', NULL, 0, '2014-08-22 15:03:44', '', '', 206, 14, 'texto', 'desktop'),
(35, 137, 0, 'unidade_2', NULL, 0, '2014-08-22 15:03:44', 'R$', '', 206, 14, 'texto', 'desktop'),
(36, 137, 0, 'frequencia_2', NULL, 0, '2014-08-22 15:03:44', '/ 4 x', '', 206, 14, 'texto', 'desktop'),
(37, 137, 0, 'label_2', NULL, 0, '2014-08-22 15:03:44', 'Contratar', '', 206, 14, 'texto', 'desktop'),
(38, 137, 0, 'link_2', NULL, 0, '2014-08-22 15:03:44', '/contato', '', 206, 14, 'texto', 'desktop'),
(39, 137, 0, 'destaque_2', 0, 0, '2014-08-22 15:03:45', NULL, '', 206, 14, 'inteiro', 'desktop'),
(40, 137, 0, 'titulo_3', NULL, 0, '2014-08-22 15:03:45', NULL, 'Plano Pier - 3', 206, 14, 'texto', 'desktop'),
(41, 137, 0, 'subtitulo_3', NULL, 0, '2014-08-22 15:03:45', NULL, 'WebSite Responsivo + ERP + Identidade Visual', 206, 14, 'texto', 'desktop'),
(42, 137, 0, 'texto_3', NULL, 0, '2014-08-22 15:03:45', NULL, '- Plano com estrutura básica de website;\r\n- Gerenciamento de Conteúdo - Pier Admin 3.0;\r\n- ERP - Sistema integrado de gestão empresarial;\r\n- Identidade Visual (3 Banners, Logotipo e +1000 cartões de visita)\r\n- Vários modelos de Layout disponíveis;\r\n- Layout Responsivo\r\n\r\nValor de hospedagem sobre consulta', 206, 14, 'texto', 'desktop'),
(43, 137, 0, 'valor_3', 1750, 0, '2014-08-22 15:03:45', NULL, '', 206, 14, 'inteiro', 'desktop'),
(44, 137, 0, 'centavo_3', NULL, 0, '2014-08-22 15:03:45', '', '', 206, 14, 'texto', 'desktop'),
(45, 137, 0, 'unidade_3', NULL, 0, '2014-08-22 15:03:45', 'R$', '', 206, 14, 'texto', 'desktop'),
(46, 137, 0, 'frequencia_3', NULL, 0, '2014-08-22 15:03:45', '/ 4 x', '', 206, 14, 'texto', 'desktop'),
(47, 137, 0, 'label_3', NULL, 0, '2014-08-22 15:03:45', 'Contratar', '', 206, 14, 'texto', 'desktop'),
(48, 137, 0, 'link_3', NULL, 0, '2014-08-22 15:03:45', '/contato', '', 206, 14, 'texto', 'desktop'),
(49, 137, 0, 'destaque_3', 0, 0, '2014-08-22 15:03:45', NULL, '', 206, 14, 'inteiro', 'desktop'),
(50, 137, 0, 'titulo_4', NULL, 0, '2014-08-22 15:03:45', NULL, 'Plano Pier - 4', 206, 14, 'texto', 'desktop'),
(51, 137, 0, 'subtitulo_4', NULL, 0, '2014-08-22 15:03:45', NULL, 'Plano Econômico - Ideal para empresas que já possuem Identidade Visual', 206, 14, 'texto', 'desktop'),
(52, 137, 0, 'texto_4', NULL, 0, '2014-08-22 15:03:45', NULL, '- Vários modelos de Layout disponíveis;\r\n- Email personalizado;\r\n- Não Responsivo. \r\n\r\nSem Gerenciamento de Conteúdo\r\n\r\nValor de hospedagem sobre consulta', 206, 14, 'texto', 'desktop'),
(53, 137, 0, 'valor_4', 300, 0, '2014-08-22 15:03:45', NULL, '', 206, 14, 'inteiro', 'desktop'),
(54, 137, 0, 'centavo_4', NULL, 0, '2014-08-22 15:03:45', '', '', 206, 14, 'texto', 'desktop'),
(55, 137, 0, 'unidade_4', NULL, 0, '2014-08-22 15:03:45', 'R$', '', 206, 14, 'texto', 'desktop'),
(56, 137, 0, 'frequencia_4', NULL, 0, '2014-08-22 15:03:45', '/ 2x', '', 206, 14, 'texto', 'desktop'),
(57, 137, 0, 'label_4', NULL, 0, '2014-08-22 15:03:45', 'Contratar', '', 206, 14, 'texto', 'desktop'),
(58, 137, 0, 'link_4', NULL, 0, '2014-08-22 15:03:45', '/contato', '', 206, 14, 'texto', 'desktop'),
(59, 137, 0, 'destaque_4', 0, 0, '2014-08-22 15:03:45', NULL, '', 206, 14, 'inteiro', 'desktop'),
(60, 137, 0, 'cor_1', NULL, 0, '2014-08-22 15:03:45', 'FFFFFF', '', 206, 14, 'texto', 'desktop'),
(61, 137, 0, 'cor_2', NULL, 0, '2014-08-22 15:03:45', 'FFFFFF', '', 206, 14, 'texto', 'desktop'),
(62, 137, 0, 'cor_3', NULL, 0, '2014-08-22 15:03:45', 'FFFFFF', '', 206, 14, 'texto', 'desktop'),
(63, 137, 0, 'cor_block_1', NULL, 0, '2014-08-22 15:03:45', 'A23479', '', 206, 14, 'texto', 'desktop'),
(64, 137, 0, 'cor_block_2', NULL, 0, '2014-08-22 15:03:45', 'A23479', '', 206, 14, 'texto', 'desktop'),
(65, 137, 0, 'cor_block_3', NULL, 0, '2014-08-22 15:03:45', '4384E5', '', 206, 14, 'texto', 'desktop'),
(66, 137, 0, 'cor_block_4', NULL, 0, '2014-08-22 15:03:45', 'A23479', '', 206, 14, 'texto', 'desktop'),
(67, 137, 0, 'qtd_blocos', 3, 0, '2014-08-22 15:58:26', NULL, '', 206, 15, 'inteiro', 'desktop'),
(68, 137, 0, 'titulo_1', NULL, 0, '2014-08-22 15:58:26', NULL, '', 206, 15, 'texto', 'desktop'),
(69, 137, 0, 'subtitulo_1', NULL, 0, '2014-08-22 15:58:26', NULL, '', 206, 15, 'texto', 'desktop'),
(70, 137, 0, 'texto_1', NULL, 0, '2014-08-22 15:58:26', NULL, '', 206, 15, 'texto', 'desktop'),
(71, 137, 0, 'valor_1', 0, 0, '2014-08-22 15:58:26', NULL, '', 206, 15, 'inteiro', 'desktop'),
(72, 137, 0, 'centavo_1', NULL, 0, '2014-08-22 15:58:26', '', '', 206, 15, 'texto', 'desktop'),
(73, 137, 0, 'unidade_1', NULL, 0, '2014-08-22 15:58:26', '', '', 206, 15, 'texto', 'desktop'),
(74, 137, 0, 'frequencia_1', NULL, 0, '2014-08-22 15:58:26', '', '', 206, 15, 'texto', 'desktop'),
(75, 137, 0, 'label_1', NULL, 0, '2014-08-22 15:58:26', '', '', 206, 15, 'texto', 'desktop'),
(76, 137, 0, 'link_1', NULL, 0, '2014-08-22 15:58:26', '', '', 206, 15, 'texto', 'desktop'),
(77, 137, 0, 'destaque_1', 0, 0, '2014-08-22 15:58:26', NULL, '', 206, 15, 'inteiro', 'desktop'),
(78, 137, 0, 'titulo_2', NULL, 0, '2014-08-22 15:58:26', NULL, '', 206, 15, 'texto', 'desktop'),
(79, 137, 0, 'subtitulo_2', NULL, 0, '2014-08-22 15:58:26', NULL, '', 206, 15, 'texto', 'desktop'),
(80, 137, 0, 'texto_2', NULL, 0, '2014-08-22 15:58:26', NULL, '', 206, 15, 'texto', 'desktop'),
(81, 137, 0, 'valor_2', 0, 0, '2014-08-22 15:58:26', NULL, '', 206, 15, 'inteiro', 'desktop'),
(82, 137, 0, 'centavo_2', NULL, 0, '2014-08-22 15:58:26', '', '', 206, 15, 'texto', 'desktop'),
(83, 137, 0, 'unidade_2', NULL, 0, '2014-08-22 15:58:26', '', '', 206, 15, 'texto', 'desktop'),
(84, 137, 0, 'frequencia_2', NULL, 0, '2014-08-22 15:58:26', '', '', 206, 15, 'texto', 'desktop'),
(85, 137, 0, 'label_2', NULL, 0, '2014-08-22 15:58:26', '', '', 206, 15, 'texto', 'desktop'),
(86, 137, 0, 'link_2', NULL, 0, '2014-08-22 15:58:26', '', '', 206, 15, 'texto', 'desktop'),
(87, 137, 0, 'destaque_2', 0, 0, '2014-08-22 15:58:26', NULL, '', 206, 15, 'inteiro', 'desktop'),
(88, 137, 0, 'titulo_3', NULL, 0, '2014-08-22 15:58:27', NULL, '', 206, 15, 'texto', 'desktop'),
(89, 137, 0, 'subtitulo_3', NULL, 0, '2014-08-22 15:58:27', NULL, '', 206, 15, 'texto', 'desktop'),
(90, 137, 0, 'texto_3', NULL, 0, '2014-08-22 15:58:27', NULL, '', 206, 15, 'texto', 'desktop'),
(91, 137, 0, 'valor_3', 0, 0, '2014-08-22 15:58:27', NULL, '', 206, 15, 'inteiro', 'desktop'),
(92, 137, 0, 'centavo_3', NULL, 0, '2014-08-22 15:58:27', '', '', 206, 15, 'texto', 'desktop'),
(93, 137, 0, 'unidade_3', NULL, 0, '2014-08-22 15:58:27', '', '', 206, 15, 'texto', 'desktop'),
(94, 137, 0, 'frequencia_3', NULL, 0, '2014-08-22 15:58:27', '', '', 206, 15, 'texto', 'desktop'),
(95, 137, 0, 'label_3', NULL, 0, '2014-08-22 15:58:27', '', '', 206, 15, 'texto', 'desktop'),
(96, 137, 0, 'link_3', NULL, 0, '2014-08-22 15:58:27', '', '', 206, 15, 'texto', 'desktop'),
(97, 137, 0, 'destaque_3', 0, 0, '2014-08-22 15:58:27', NULL, '', 206, 15, 'inteiro', 'desktop'),
(98, 137, 0, 'titulo_4', NULL, 0, '2014-08-22 15:58:27', NULL, '', 206, 15, 'texto', 'desktop'),
(99, 137, 0, 'subtitulo_4', NULL, 0, '2014-08-22 15:58:27', NULL, '', 206, 15, 'texto', 'desktop'),
(100, 137, 0, 'texto_4', NULL, 0, '2014-08-22 15:58:27', NULL, '', 206, 15, 'texto', 'desktop'),
(101, 137, 0, 'valor_4', 0, 0, '2014-08-22 15:58:27', NULL, '', 206, 15, 'inteiro', 'desktop'),
(102, 137, 0, 'centavo_4', NULL, 0, '2014-08-22 15:58:27', '', '', 206, 15, 'texto', 'desktop'),
(103, 137, 0, 'unidade_4', NULL, 0, '2014-08-22 15:58:27', '', '', 206, 15, 'texto', 'desktop'),
(104, 137, 0, 'frequencia_4', NULL, 0, '2014-08-22 15:58:27', '', '', 206, 15, 'texto', 'desktop'),
(105, 137, 0, 'label_4', NULL, 0, '2014-08-22 15:58:27', '', '', 206, 15, 'texto', 'desktop'),
(106, 137, 0, 'link_4', NULL, 0, '2014-08-22 15:58:27', '', '', 206, 15, 'texto', 'desktop'),
(107, 137, 0, 'destaque_4', 0, 0, '2014-08-22 15:58:27', NULL, '', 206, 15, 'inteiro', 'desktop'),
(108, 137, 0, 'cor_1', NULL, 0, '2014-08-22 15:58:27', '', '', 206, 15, 'texto', 'desktop'),
(109, 137, 0, 'cor_2', NULL, 0, '2014-08-22 15:58:27', '', '', 206, 15, 'texto', 'desktop'),
(110, 137, 0, 'cor_3', NULL, 0, '2014-08-22 15:58:27', '', '', 206, 15, 'texto', 'desktop'),
(111, 137, 0, 'cor_block_1', NULL, 0, '2014-08-22 15:58:27', '', '', 206, 15, 'texto', 'desktop'),
(112, 137, 0, 'cor_block_2', NULL, 0, '2014-08-22 15:58:27', '', '', 206, 15, 'texto', 'desktop'),
(113, 137, 0, 'cor_block_3', NULL, 0, '2014-08-22 15:58:27', '', '', 206, 15, 'texto', 'desktop'),
(114, 137, 0, 'cor_block_4', NULL, 0, '2014-08-22 15:58:27', '', '', 206, 15, 'texto', 'desktop'),
(115, 137, 0, 'qtd_blocos', 1, 0, '2014-08-22 21:03:48', NULL, '', 206, 17, 'inteiro', 'desktop'),
(116, 137, 0, 'titulo_1', NULL, 0, '2014-08-22 21:03:48', NULL, '', 206, 17, 'texto', 'desktop'),
(117, 137, 0, 'subtitulo_1', NULL, 0, '2014-08-22 21:03:48', NULL, '', 206, 17, 'texto', 'desktop'),
(118, 137, 0, 'texto_1', NULL, 0, '2014-08-22 21:03:48', NULL, '', 206, 17, 'texto', 'desktop'),
(119, 137, 0, 'valor_1', 0, 0, '2014-08-22 21:03:48', NULL, '', 206, 17, 'inteiro', 'desktop'),
(120, 137, 0, 'centavo_1', NULL, 0, '2014-08-22 21:03:48', '', '', 206, 17, 'texto', 'desktop'),
(121, 137, 0, 'unidade_1', NULL, 0, '2014-08-22 21:03:48', '', '', 206, 17, 'texto', 'desktop'),
(122, 137, 0, 'frequencia_1', NULL, 0, '2014-08-22 21:03:48', '', '', 206, 17, 'texto', 'desktop'),
(123, 137, 0, 'label_1', NULL, 0, '2014-08-22 21:03:48', '', '', 206, 17, 'texto', 'desktop'),
(124, 137, 0, 'link_1', NULL, 0, '2014-08-22 21:03:48', '', '', 206, 17, 'texto', 'desktop'),
(125, 137, 0, 'destaque_1', 0, 0, '2014-08-22 21:03:48', NULL, '', 206, 17, 'inteiro', 'desktop'),
(126, 137, 0, 'titulo_2', NULL, 0, '2014-08-22 21:03:48', NULL, '', 206, 17, 'texto', 'desktop'),
(127, 137, 0, 'subtitulo_2', NULL, 0, '2014-08-22 21:03:48', NULL, '', 206, 17, 'texto', 'desktop'),
(128, 137, 0, 'texto_2', NULL, 0, '2014-08-22 21:03:48', NULL, '', 206, 17, 'texto', 'desktop'),
(129, 137, 0, 'valor_2', 0, 0, '2014-08-22 21:03:48', NULL, '', 206, 17, 'inteiro', 'desktop'),
(130, 137, 0, 'centavo_2', NULL, 0, '2014-08-22 21:03:48', '', '', 206, 17, 'texto', 'desktop'),
(131, 137, 0, 'unidade_2', NULL, 0, '2014-08-22 21:03:49', '', '', 206, 17, 'texto', 'desktop'),
(132, 137, 0, 'frequencia_2', NULL, 0, '2014-08-22 21:03:49', '', '', 206, 17, 'texto', 'desktop'),
(133, 137, 0, 'label_2', NULL, 0, '2014-08-22 21:03:49', '', '', 206, 17, 'texto', 'desktop'),
(134, 137, 0, 'link_2', NULL, 0, '2014-08-22 21:03:49', '', '', 206, 17, 'texto', 'desktop'),
(135, 137, 0, 'destaque_2', 0, 0, '2014-08-22 21:03:49', NULL, '', 206, 17, 'inteiro', 'desktop'),
(136, 137, 0, 'titulo_3', NULL, 0, '2014-08-22 21:03:49', NULL, '', 206, 17, 'texto', 'desktop'),
(137, 137, 0, 'subtitulo_3', NULL, 0, '2014-08-22 21:03:49', NULL, '', 206, 17, 'texto', 'desktop'),
(138, 137, 0, 'texto_3', NULL, 0, '2014-08-22 21:03:49', NULL, '', 206, 17, 'texto', 'desktop'),
(139, 137, 0, 'valor_3', 0, 0, '2014-08-22 21:03:49', NULL, '', 206, 17, 'inteiro', 'desktop'),
(140, 137, 0, 'centavo_3', NULL, 0, '2014-08-22 21:03:49', '', '', 206, 17, 'texto', 'desktop'),
(141, 137, 0, 'unidade_3', NULL, 0, '2014-08-22 21:03:49', '', '', 206, 17, 'texto', 'desktop'),
(142, 137, 0, 'frequencia_3', NULL, 0, '2014-08-22 21:03:49', '', '', 206, 17, 'texto', 'desktop'),
(143, 137, 0, 'label_3', NULL, 0, '2014-08-22 21:03:49', '', '', 206, 17, 'texto', 'desktop'),
(144, 137, 0, 'link_3', NULL, 0, '2014-08-22 21:03:49', '', '', 206, 17, 'texto', 'desktop'),
(145, 137, 0, 'destaque_3', 0, 0, '2014-08-22 21:03:49', NULL, '', 206, 17, 'inteiro', 'desktop'),
(146, 137, 0, 'titulo_4', NULL, 0, '2014-08-22 21:03:49', NULL, '', 206, 17, 'texto', 'desktop'),
(147, 137, 0, 'subtitulo_4', NULL, 0, '2014-08-22 21:03:49', NULL, '', 206, 17, 'texto', 'desktop'),
(148, 137, 0, 'texto_4', NULL, 0, '2014-08-22 21:03:49', NULL, '', 206, 17, 'texto', 'desktop'),
(149, 137, 0, 'valor_4', 0, 0, '2014-08-22 21:03:49', NULL, '', 206, 17, 'inteiro', 'desktop'),
(150, 137, 0, 'centavo_4', NULL, 0, '2014-08-22 21:03:49', '', '', 206, 17, 'texto', 'desktop'),
(151, 137, 0, 'unidade_4', NULL, 0, '2014-08-22 21:03:49', '', '', 206, 17, 'texto', 'desktop'),
(152, 137, 0, 'frequencia_4', NULL, 0, '2014-08-22 21:03:49', '', '', 206, 17, 'texto', 'desktop'),
(153, 137, 0, 'label_4', NULL, 0, '2014-08-22 21:03:49', '', '', 206, 17, 'texto', 'desktop'),
(154, 137, 0, 'link_4', NULL, 0, '2014-08-22 21:03:49', '', '', 206, 17, 'texto', 'desktop'),
(155, 137, 0, 'destaque_4', 0, 0, '2014-08-22 21:03:49', NULL, '', 206, 17, 'inteiro', 'desktop'),
(156, 137, 0, 'cor_1', NULL, 0, '2014-08-22 21:03:49', '', '', 206, 17, 'texto', 'desktop'),
(157, 137, 0, 'cor_2', NULL, 0, '2014-08-22 21:03:49', '', '', 206, 17, 'texto', 'desktop'),
(158, 137, 0, 'cor_3', NULL, 0, '2014-08-22 21:03:49', '', '', 206, 17, 'texto', 'desktop'),
(159, 137, 0, 'cor_block_1', NULL, 0, '2014-08-22 21:03:49', '', '', 206, 17, 'texto', 'desktop'),
(160, 137, 0, 'cor_block_2', NULL, 0, '2014-08-22 21:03:49', '', '', 206, 17, 'texto', 'desktop'),
(161, 137, 0, 'cor_block_3', NULL, 0, '2014-08-22 21:03:49', '', '', 206, 17, 'texto', 'desktop'),
(162, 137, 0, 'cor_block_4', NULL, 0, '2014-08-22 21:03:49', '', '', 206, 17, 'texto', 'desktop'),
(163, 137, 0, 'qtd_blocos', 1, 0, '2014-08-22 21:06:42', NULL, '', 206, 18, 'inteiro', 'desktop'),
(164, 137, 0, 'titulo_1', NULL, 0, '2014-08-22 21:06:42', NULL, 'Plano Pier 1 - Funcionalidades do sistema Pier Admin 3.0', 206, 18, 'texto', 'desktop'),
(165, 137, 0, 'subtitulo_1', NULL, 0, '2014-08-22 21:06:42', NULL, 'Plano Pier 1 - Plano completo com todas funcionalidades do sistema liberados', 206, 18, 'texto', 'desktop'),
(166, 137, 0, 'texto_1', NULL, 0, '2014-08-22 21:06:42', NULL, '<h3><b><red>Este plano, garante ao seu website, Update das novas versões e aplicativos gratuitamente durante 1 ano! </red></b>\r\n</h3>\r\n<B><RED>Aplicativos disponíveis:</RED></B>\r\n\r\n-PierGestão ERP - Sistema integrado de gestão empresarial;\r\n-PierMail - Email-Marketing (disponibilizado de acordo com o plano contratado);\r\n-PierLayout - Alteração completa em todo layout (cores fontes, cores paginas, topo, rodapé, texturas, logos, menu);\r\n-PierLiveChat - Atendimento Online (Atenda seus clientes online, com chat pelo Admin)\r\n-PierMagazine - Revistas Online (Crie revistas, livros e apresentações com esse componente)\r\n-PierDownloads - Disponibilize Arquivos aos seus clientes, podendo baixar via download (Word, MP3, Pdf, Excel, Zip...) \r\n-PierHiperLinks - adicione seus links favoritos (essencial para começar a adquirir Link building)\r\n-PierEventos - Crie e organize com fichas de inscrições, eventos, palestras, cursos, workshops, viagens. \r\n-PierGalerias - Galeiras de Fotos e usuários \r\n-PierVídeos - Vídeos do YouTube e Vimeo\r\n-PierMaterias - Publique matérias, dicas, notícias e novidades (opção de poder receber comentários e curtidas)\r\n-PierProdutos - Adicione seus produtos a seu site (cria/edita/remove produtos com categorias, imagens, vídeos de demonstração, detalhes, descrição, lançamentos, vitrine e mais uma infinidade de opções)\r\n-PierEcommerce - Venda seus produtos em sua loja virtual\r\n-PierPromoções - Crie promoções no seu site (Programas de fidelidade, gere vouchers, concursos culturais, post no seu Facebook)\r\n-PierFórum - Discussões, informações e arquivos. Ideal para grupos de BenchMarking.\r\n-PierBoletos - Gerador de Boletos (Com vários bancos: Bradesco, Banco do Brasil, Itaú entre outros)\r\n-PierComboShare - Combobox lateral com as principais redes sociais e diferentes forma de compartilhamento\r\n-PierWiki - Componente de ajuda para usuários. \r\n-PierBugFree - Monitora os possíveis erros do seu site\r\n-PierFaq - Perguntas Frequentes (cadastro de respostas as perguntas frequentes, interagindo com usuários)\r\n-PierComunicador - Ideal para realizar a conversa interna de sua empresa, time ou usuários do seu site.\r\n-PierPesquisas - Saiba a opinião de seus clientes através dos formulários de pesquisa\r\n-PierAgenda - é uma extensão para o PierGestão, como ele você consegue gerenciar sua agenda de atividades.\r\n-PierSMS - Envie mensagem de texto para celulares de seus clientes\r\n\r\n\r\n<B><RED>Componentes disponíveis</RED></B>\r\n\r\n-Aplicativo para criação de Banners;\r\n-Banner principal com troca ilimitada de imagens;\r\n-Newsletter, emails cadastrados serão salvos no banco de dados, enviados para email master;\r\n-Personalização de Logos para email de Newsletter;\r\n-Listagem de contatos e emails recebidos pela pagina CONTATO, salvos no banco de dados;\r\n-Banco de Currículos; \r\n-Divulgação de Vagas; \r\n-Cadastro de Comentários em matérias (com opção de edição e moderação para publicação);\r\n-Cadastro de Depoimentos com fotos (com opção de edição e moderação para publicação);\r\n-Cadastro \"Seja Fornecedor\" no banco de dados de acordo com as necessidades do seu negocio.\r\ne muito mais...\r\n\r\n<b><red>Aplicativos do sistema Ecommerce:</red></b>\r\n\r\n-Integrado com Mercado Livre\r\n-Carrinho de Compra;\r\n-Cadastro de Cliente;\r\n-Cadastro de Pedidos;\r\n-Acompanhamento de Pedido por Clientes e número de rastreamento dos correios;\r\n-Envio automático para cada cliente com alteração de status de pedido;\r\n-Formas de Pagamento Personalizadas;\r\n-Compartilhamento com Redes Sociais (Twitter, Facebook, Google Plus);\r\n-Menu configurável;\r\n-Busca de produtos por palavra-chave, categoria e departamento;\r\n-Integração com Pag Seguro, podendo ser utilizados diversos tipos de cartões de créditos, boletos... sem a necessidade de ter convênio com -Bancos e Operadoras de Cartões. Esses recursos são oferecidos a pessoas físicas e jurídicas;\r\n-Envio de e-mail alertando sobre novos pedidos;\r\n-Configuração da quantidade de itens na vitrine;\r\n-Cálculo de frete por pedido, produto ou peso (diretamente pelo sistema dos correios);\r\n-Frete especial para determinadas faixas de CEPs e/ou por valor total de pedido;\r\n-Produtos promocionais;\r\n-Produtos em Destaque;\r\n-Vitrine de produtos na tela inicial do site;\r\n-Configuração de \"qual item será exibido\" na vitrine;\r\n-Exibição do valor do produto parcelado na loja;\r\n-Possibilidade de controlar estoque;\r\n-Permite até 6 fotos por produtos, as thumbs (imagem reduzidas) são criadas automaticamente;\r\n-Destaque para produtos com desconto;\r\n-Destaque para produtos de lançamento;\r\n\r\n<b><red>Área Administrador Completo</red></b>\r\n\r\n-Cadastro Categoria\r\n-Cadastro Produto\r\n-Cadastramento de Forma de Pagamento Pag Seguro - Acompanhamento de Pedidos\r\n-Acompanhamento de Clientes\r\n-Possibilidade de alterar Cores, Imagens, Banner, entre outros de maneira simples\r\n-Templates de cores pré-definidos\r\n-Opção de alterar meta tags\r\n-Controle de estatística de visitas do site\r\n\r\n\r\n<b><red>Base Plataforma Purplepier Admin3.0</red></b>\r\n\r\n-Hospedagem em nosso provedor;\r\n-Site em Tecnologia PHP- HTML - JavaScript - Base de dados MySQL;\r\n-Padrão W3C;\r\n-Sistema de Gerenciamento de conteúdo;\r\n-Cadastro de contas de email ilimitado;\r\n-Interface gráfica simplificada, amigável;\r\n-Número de Páginas de Conteúdo Ilimitadas;\r\n-Integração com Redes Sociais (Facebook, Twitter, Google Plus);\r\n-Suporte por telefone/e-mail e Google Hangouts;\r\n-Relatório de uso do site (matérias publicadas, currículos cadastrados, pageviews, browsers, etc);\r\n-Estatísticas de número de visita por mês, dia e total;\r\n-Recebimento semanal de relatório de desempenho do site;\r\n-Relatório de acessos de páginas visitadas;\r\n-Cadastro para Google Analytics;\r\n-Cadastro de Gerenciador Google Tags Managers;\r\n-Cadastro de Meta Tags;\r\n-Cadastro Favicon;\r\n-Opção de habilitar ‘Indique para um amigo’\r\n-Cadastro de usuários (pessoa física ou jurídica);\r\n-Controle de usuários com Tags (administrador, colunista, cliente, parceiro, associado);\r\n-Criação de chamados ou tarefas para cada usuário interno - Intranet;\r\n-RSS Feeds (ideal para sites que terão artigos ou noticias publicadas regularmente);\r\n-Uso de aplicativo com o Facebook (Curtir e compartilhamento e publicação de matérias e produtos);\r\n-Integração de um mapa do Google;\r\n-Cópia de Banco de dados com todos seus textos e fotos;\r\n-Cópia de Banco de todo conteúdo do diretório mídia/user;\r\n-Proteção com senha para acesso ao ADMIN 3.0 (controle total do site).\r\n\r\nPara ver mais detalhes de todos os aplicativos e componentes disponíveis neste plano, você pode acessar direto o link: \r\n<a href=\"https://www.purplepier.com.br/paginasavancadas\" target= \"blank\"><RED>CLIQUE AQUI PARA TER ACESSO A TODAS AS NOSSAS PAGINAS AVANÇADAS</RED></a>\r\n\r\n', 206, 18, 'texto', 'desktop'),
(167, 137, 0, 'valor_1', 0, 0, '2014-08-22 21:06:42', NULL, '', 206, 18, 'inteiro', 'desktop'),
(168, 137, 0, 'centavo_1', NULL, 0, '2014-08-22 21:06:42', '', '', 206, 18, 'texto', 'desktop'),
(169, 137, 0, 'unidade_1', NULL, 0, '2014-08-22 21:06:42', '', '', 206, 18, 'texto', 'desktop'),
(170, 137, 0, 'frequencia_1', NULL, 0, '2014-08-22 21:06:42', '', '', 206, 18, 'texto', 'desktop'),
(171, 137, 0, 'label_1', NULL, 0, '2014-08-22 21:06:42', '', '', 206, 18, 'texto', 'desktop'),
(172, 137, 0, 'link_1', NULL, 0, '2014-08-22 21:06:42', '', '', 206, 18, 'texto', 'desktop'),
(173, 137, 0, 'destaque_1', 0, 0, '2014-08-22 21:06:42', NULL, '', 206, 18, 'inteiro', 'desktop'),
(174, 137, 0, 'titulo_2', NULL, 0, '2014-08-22 21:06:42', NULL, '', 206, 18, 'texto', 'desktop'),
(175, 137, 0, 'subtitulo_2', NULL, 0, '2014-08-22 21:06:43', NULL, '', 206, 18, 'texto', 'desktop'),
(176, 137, 0, 'texto_2', NULL, 0, '2014-08-22 21:06:43', NULL, '', 206, 18, 'texto', 'desktop'),
(177, 137, 0, 'valor_2', 0, 0, '2014-08-22 21:06:43', NULL, '', 206, 18, 'inteiro', 'desktop'),
(178, 137, 0, 'centavo_2', NULL, 0, '2014-08-22 21:06:43', '', '', 206, 18, 'texto', 'desktop'),
(179, 137, 0, 'unidade_2', NULL, 0, '2014-08-22 21:06:43', '', '', 206, 18, 'texto', 'desktop'),
(180, 137, 0, 'frequencia_2', NULL, 0, '2014-08-22 21:06:43', '', '', 206, 18, 'texto', 'desktop'),
(181, 137, 0, 'label_2', NULL, 0, '2014-08-22 21:06:43', '', '', 206, 18, 'texto', 'desktop'),
(182, 137, 0, 'link_2', NULL, 0, '2014-08-22 21:06:43', '', '', 206, 18, 'texto', 'desktop'),
(183, 137, 0, 'destaque_2', 0, 0, '2014-08-22 21:06:43', NULL, '', 206, 18, 'inteiro', 'desktop'),
(184, 137, 0, 'titulo_3', NULL, 0, '2014-08-22 21:06:43', NULL, '', 206, 18, 'texto', 'desktop'),
(185, 137, 0, 'subtitulo_3', NULL, 0, '2014-08-22 21:06:43', NULL, '', 206, 18, 'texto', 'desktop'),
(186, 137, 0, 'texto_3', NULL, 0, '2014-08-22 21:06:43', NULL, '', 206, 18, 'texto', 'desktop'),
(187, 137, 0, 'valor_3', 0, 0, '2014-08-22 21:06:43', NULL, '', 206, 18, 'inteiro', 'desktop'),
(188, 137, 0, 'centavo_3', NULL, 0, '2014-08-22 21:06:43', '', '', 206, 18, 'texto', 'desktop'),
(189, 137, 0, 'unidade_3', NULL, 0, '2014-08-22 21:06:43', '', '', 206, 18, 'texto', 'desktop'),
(190, 137, 0, 'frequencia_3', NULL, 0, '2014-08-22 21:06:43', '', '', 206, 18, 'texto', 'desktop'),
(191, 137, 0, 'label_3', NULL, 0, '2014-08-22 21:06:43', '', '', 206, 18, 'texto', 'desktop'),
(192, 137, 0, 'link_3', NULL, 0, '2014-08-22 21:06:43', '', '', 206, 18, 'texto', 'desktop'),
(193, 137, 0, 'destaque_3', 0, 0, '2014-08-22 21:06:43', NULL, '', 206, 18, 'inteiro', 'desktop'),
(194, 137, 0, 'titulo_4', NULL, 0, '2014-08-22 21:06:43', NULL, '', 206, 18, 'texto', 'desktop'),
(195, 137, 0, 'subtitulo_4', NULL, 0, '2014-08-22 21:06:43', NULL, '', 206, 18, 'texto', 'desktop'),
(196, 137, 0, 'texto_4', NULL, 0, '2014-08-22 21:06:43', NULL, '', 206, 18, 'texto', 'desktop'),
(197, 137, 0, 'valor_4', 0, 0, '2014-08-22 21:06:43', NULL, '', 206, 18, 'inteiro', 'desktop'),
(198, 137, 0, 'centavo_4', NULL, 0, '2014-08-22 21:06:43', '', '', 206, 18, 'texto', 'desktop'),
(199, 137, 0, 'unidade_4', NULL, 0, '2014-08-22 21:06:43', '', '', 206, 18, 'texto', 'desktop'),
(200, 137, 0, 'frequencia_4', NULL, 0, '2014-08-22 21:06:43', '', '', 206, 18, 'texto', 'desktop'),
(201, 137, 0, 'label_4', NULL, 0, '2014-08-22 21:06:43', '', '', 206, 18, 'texto', 'desktop'),
(202, 137, 0, 'link_4', NULL, 0, '2014-08-22 21:06:43', '', '', 206, 18, 'texto', 'desktop'),
(203, 137, 0, 'destaque_4', 0, 0, '2014-08-22 21:06:43', NULL, '', 206, 18, 'inteiro', 'desktop'),
(204, 137, 0, 'cor_1', NULL, 0, '2014-08-22 21:06:43', '', '', 206, 18, 'texto', 'desktop'),
(205, 137, 0, 'cor_2', NULL, 0, '2014-08-22 21:06:43', '', '', 206, 18, 'texto', 'desktop'),
(206, 137, 0, 'cor_3', NULL, 0, '2014-08-22 21:06:43', '', '', 206, 18, 'texto', 'desktop'),
(207, 137, 0, 'cor_block_1', NULL, 0, '2014-08-22 21:06:43', '', '', 206, 18, 'texto', 'desktop'),
(208, 137, 0, 'cor_block_2', NULL, 0, '2014-08-22 21:06:43', '', '', 206, 18, 'texto', 'desktop'),
(209, 137, 0, 'cor_block_3', NULL, 0, '2014-08-22 21:06:43', '', '', 206, 18, 'texto', 'desktop'),
(210, 137, 0, 'cor_block_4', NULL, 0, '2014-08-22 21:06:43', '', '', 206, 18, 'texto', 'desktop'),
(211, 137, 0, 'qtd_blocos', 1, 0, '2014-09-01 22:16:53', NULL, '', 206, 20, 'inteiro', 'desktop'),
(212, 137, 0, 'titulo_1', NULL, 0, '2014-09-01 22:16:53', NULL, 'Plano Pier 4 - Mini Site ', 206, 20, 'texto', 'desktop'),
(213, 137, 0, 'subtitulo_1', NULL, 0, '2014-09-01 22:16:53', NULL, 'Para o Plano Pier 4', 206, 20, 'texto', 'desktop'),
(214, 137, 0, 'texto_1', NULL, 0, '2014-09-01 22:16:54', NULL, 'Este plano é ideal para empresas que já possuem toda identidade visual criada. Isso inclui, imagens para banner principal do website, imagens de produtos, logotipo, etc. Também todo conteúdo descritivo do website.\r\n\r\nEstrutura básica do website:\r\n\r\n-Pagina Inicial (home) \r\n-Pagina da Empresa - exibimos o histórico de sua empresa, com fotos e descrição de: missão, visão, valores e certificados de qualidade.\r\n-Pagina de contato\r\n-Hospedagem em nosso provedor;\r\n-Cadastro de 1 conta de email;\r\n-Cadastro Favicon;\r\n-Suporte por telefone/e-mail e Google Hangouts;\r\n\r\nOs sites não contém Gerenciamento de Conteúdo. Toda e qualquer alteração no website será necessária a contratação dos nossos serviços.\r\n\r\n<b>Este plano contém os aplicativos e componentes básicos para exibição de website. Contudo, ele é compatível com todos os outros aplicativos e componentes do sistema. <red>Também aceita a implementação da Plataforma Responsiva.</red>\r\n\r\nPara a implementação dos demais recursos, basta solicitar orçamento para a liberação junto a equipe de vendas da DigitalPier.\r\n\r\nPara ver mais detalhes de todos os aplicativos e componentes disponíveis no sistema, você pode acessar direto o link:</b>\r\n<a href=\"https://www.purplepier.com.br/paginasavancadas\" target= \"blank\"><RED>CLIQUE AQUI PARA TER ACESSO A TODAS AS NOSSAS PAGINAS AVANÇADAS</RED></a>\r\n', 206, 20, 'texto', 'desktop'),
(215, 137, 0, 'valor_1', 0, 0, '2014-09-01 22:16:54', NULL, '', 206, 20, 'inteiro', 'desktop'),
(216, 137, 0, 'centavo_1', NULL, 0, '2014-09-01 22:16:54', '', '', 206, 20, 'texto', 'desktop'),
(217, 137, 0, 'unidade_1', NULL, 0, '2014-09-01 22:16:54', '', '', 206, 20, 'texto', 'desktop'),
(218, 137, 0, 'frequencia_1', NULL, 0, '2014-09-01 22:16:54', '', '', 206, 20, 'texto', 'desktop'),
(219, 137, 0, 'label_1', NULL, 0, '2014-09-01 22:16:54', '', '', 206, 20, 'texto', 'desktop'),
(220, 137, 0, 'link_1', NULL, 0, '2014-09-01 22:16:54', '', '', 206, 20, 'texto', 'desktop'),
(221, 137, 0, 'destaque_1', 0, 0, '2014-09-01 22:16:54', NULL, '', 206, 20, 'inteiro', 'desktop'),
(222, 137, 0, 'titulo_2', NULL, 0, '2014-09-01 22:16:54', NULL, '', 206, 20, 'texto', 'desktop'),
(223, 137, 0, 'subtitulo_2', NULL, 0, '2014-09-01 22:16:54', NULL, '', 206, 20, 'texto', 'desktop'),
(224, 137, 0, 'texto_2', NULL, 0, '2014-09-01 22:16:54', NULL, '', 206, 20, 'texto', 'desktop'),
(225, 137, 0, 'valor_2', 0, 0, '2014-09-01 22:16:54', NULL, '', 206, 20, 'inteiro', 'desktop'),
(226, 137, 0, 'centavo_2', NULL, 0, '2014-09-01 22:16:54', '', '', 206, 20, 'texto', 'desktop'),
(227, 137, 0, 'unidade_2', NULL, 0, '2014-09-01 22:16:54', '', '', 206, 20, 'texto', 'desktop'),
(228, 137, 0, 'frequencia_2', NULL, 0, '2014-09-01 22:16:54', '', '', 206, 20, 'texto', 'desktop'),
(229, 137, 0, 'label_2', NULL, 0, '2014-09-01 22:16:54', '', '', 206, 20, 'texto', 'desktop'),
(230, 137, 0, 'link_2', NULL, 0, '2014-09-01 22:16:54', '', '', 206, 20, 'texto', 'desktop'),
(231, 137, 0, 'destaque_2', 0, 0, '2014-09-01 22:16:54', NULL, '', 206, 20, 'inteiro', 'desktop'),
(232, 137, 0, 'titulo_3', NULL, 0, '2014-09-01 22:16:54', NULL, '', 206, 20, 'texto', 'desktop'),
(233, 137, 0, 'subtitulo_3', NULL, 0, '2014-09-01 22:16:54', NULL, '', 206, 20, 'texto', 'desktop'),
(234, 137, 0, 'texto_3', NULL, 0, '2014-09-01 22:16:54', NULL, '', 206, 20, 'texto', 'desktop'),
(235, 137, 0, 'valor_3', 0, 0, '2014-09-01 22:16:54', NULL, '', 206, 20, 'inteiro', 'desktop'),
(236, 137, 0, 'centavo_3', NULL, 0, '2014-09-01 22:16:54', '', '', 206, 20, 'texto', 'desktop'),
(237, 137, 0, 'unidade_3', NULL, 0, '2014-09-01 22:16:55', '', '', 206, 20, 'texto', 'desktop'),
(238, 137, 0, 'frequencia_3', NULL, 0, '2014-09-01 22:16:55', '', '', 206, 20, 'texto', 'desktop'),
(239, 137, 0, 'label_3', NULL, 0, '2014-09-01 22:16:55', '', '', 206, 20, 'texto', 'desktop'),
(240, 137, 0, 'link_3', NULL, 0, '2014-09-01 22:16:55', '', '', 206, 20, 'texto', 'desktop'),
(241, 137, 0, 'destaque_3', 0, 0, '2014-09-01 22:16:55', NULL, '', 206, 20, 'inteiro', 'desktop'),
(242, 137, 0, 'titulo_4', NULL, 0, '2014-09-01 22:16:55', NULL, '', 206, 20, 'texto', 'desktop'),
(243, 137, 0, 'subtitulo_4', NULL, 0, '2014-09-01 22:16:55', NULL, '', 206, 20, 'texto', 'desktop'),
(244, 137, 0, 'texto_4', NULL, 0, '2014-09-01 22:16:55', NULL, '', 206, 20, 'texto', 'desktop'),
(245, 137, 0, 'valor_4', 0, 0, '2014-09-01 22:16:55', NULL, '', 206, 20, 'inteiro', 'desktop'),
(246, 137, 0, 'centavo_4', NULL, 0, '2014-09-01 22:16:55', '', '', 206, 20, 'texto', 'desktop'),
(247, 137, 0, 'unidade_4', NULL, 0, '2014-09-01 22:16:55', '', '', 206, 20, 'texto', 'desktop'),
(248, 137, 0, 'frequencia_4', NULL, 0, '2014-09-01 22:16:55', '', '', 206, 20, 'texto', 'desktop'),
(249, 137, 0, 'label_4', NULL, 0, '2014-09-01 22:16:55', '', '', 206, 20, 'texto', 'desktop'),
(250, 137, 0, 'link_4', NULL, 0, '2014-09-01 22:16:55', '', '', 206, 20, 'texto', 'desktop'),
(251, 137, 0, 'destaque_4', 0, 0, '2014-09-01 22:16:55', NULL, '', 206, 20, 'inteiro', 'desktop'),
(252, 137, 0, 'cor_1', NULL, 0, '2014-09-01 22:16:55', '#6ba2c7', '', 206, 20, 'texto', 'desktop'),
(253, 137, 0, 'cor_2', NULL, 0, '2014-09-01 22:16:55', '', '', 206, 20, 'texto', 'desktop'),
(254, 137, 0, 'cor_3', NULL, 0, '2014-09-01 22:16:55', '', '', 206, 20, 'texto', 'desktop'),
(255, 137, 0, 'cor_block_1', NULL, 0, '2014-09-01 22:16:55', '', '', 206, 20, 'texto', 'desktop'),
(256, 137, 0, 'cor_block_2', NULL, 0, '2014-09-01 22:16:55', '', '', 206, 20, 'texto', 'desktop'),
(257, 137, 0, 'cor_block_3', NULL, 0, '2014-09-01 22:16:55', '', '', 206, 20, 'texto', 'desktop'),
(258, 137, 0, 'cor_block_4', NULL, 0, '2014-09-01 22:16:55', '', '', 206, 20, 'texto', 'desktop'),
(259, 7, 0, 'ctt_tel_2', NULL, 0, NULL, '  [19] 9-8367-5969 - Tim', '', 0, 0, '0', '0'),
(260, 1, 0, 'titulo_1', NULL, 0, '2014-09-08 13:36:42', NULL, 'Um Pier Digital especialmente para o seu negócio', 207, 22, 'texto', 'desktop'),
(261, 1, 0, 'subtitulo_1', NULL, 0, '2014-09-08 13:36:42', NULL, '', 207, 22, 'texto', 'desktop'),
(262, 1, 0, 'texto_1', NULL, 0, '2014-09-08 13:36:42', NULL, '', 207, 22, 'texto', 'desktop'),
(263, 1, 0, 'image_1', NULL, 0, '2014-09-08 13:36:42', '', '', 207, 22, 'texto', 'desktop'),
(264, 1, 0, 'margin_top', 0, 0, '2014-09-08 13:36:42', NULL, '', 207, 22, 'inteiro', 'desktop'),
(265, 1, 0, 'margin_bottom', 10, 0, '2014-09-08 13:36:42', NULL, '', 207, 22, 'inteiro', 'desktop'),
(266, 1, 0, 'cor_1', NULL, 0, '2014-09-08 13:36:42', '#ffffff', '', 207, 22, 'texto', 'desktop'),
(267, 1, 0, 'cor_2', NULL, 0, '2014-09-08 13:36:42', '#cccccc', '', 207, 22, 'texto', 'desktop'),
(268, 1, 0, 'cor_3', NULL, 0, '2014-09-08 13:36:42', '#dddedf', '', 207, 22, 'texto', 'desktop'),
(269, 1, 0, 'alinhamento_1', NULL, 0, '2014-09-08 13:36:42', 'center', '', 207, 22, 'texto', 'desktop'),
(270, 1, 0, 'alinhamento_2', NULL, 0, '2014-09-08 13:36:42', 'center', '', 207, 22, 'texto', 'desktop'),
(271, 1, 0, 'alinhamento_3', NULL, 0, '2014-09-08 13:36:42', 'center', '', 207, 22, 'texto', 'desktop'),
(272, 1, 0, 'background_type', 1, 0, '2014-09-08 13:36:42', NULL, '', 207, 22, 'inteiro', 'desktop'),
(273, 1, 0, 'background', NULL, 0, '2014-09-08 13:36:42', 'purple_lines2.jpg', '', 207, 22, 'texto', 'desktop'),
(274, 1, 0, 'titulo_1', NULL, 0, '2014-09-08 13:43:29', NULL, 'Sites com Sistema para Gerenciamento de Conteúdo', 215, 23, 'texto', 'desktop'),
(275, 1, 0, 'subtitulo_1', NULL, 0, '2014-09-08 13:43:29', NULL, '- Tenha total autonomia sobre o seu site', 215, 23, 'texto', 'desktop'),
(276, 1, 0, 'texto_1', NULL, 0, '2014-09-08 13:43:29', NULL, 'Plataforma PurplePier, disponibiliza uma ferramenta simples, prática, com fácil interface  fácil fantástica, capaz de lhe proporcionar a independência que você precisa para atualização de seu Web Site, o Pier Admin 2.0.', 215, 23, 'texto', 'desktop'),
(277, 1, 0, 'link_1', NULL, 0, '2014-09-08 13:43:29', NULL, '/web_site', 215, 23, 'texto', 'desktop'),
(278, 1, 0, 'margin_top', 30, 0, '2014-09-08 13:43:29', NULL, '', 215, 23, 'inteiro', 'desktop'),
(279, 1, 0, 'margin_bottom', 25, 0, '2014-09-08 13:43:29', NULL, '', 215, 23, 'inteiro', 'desktop'),
(280, 1, 0, 'cor_1', NULL, 0, '2014-09-08 13:43:29', '#81183d', '', 215, 23, 'texto', 'desktop'),
(281, 1, 0, 'cor_2', NULL, 0, '2014-09-08 13:43:29', '#33190f', '', 215, 23, 'texto', 'desktop'),
(282, 1, 0, 'cor_3', NULL, 0, '2014-09-08 13:43:29', '', '', 215, 23, 'texto', 'desktop'),
(283, 1, 0, 'alinhamento_1', NULL, 0, '2014-09-08 13:43:29', 'left', '', 215, 23, 'texto', 'desktop'),
(284, 1, 0, 'alinhamento_2', NULL, 0, '2014-09-08 13:43:29', 'left', '', 215, 23, 'texto', 'desktop'),
(285, 1, 0, 'alinhamento_3', NULL, 0, '2014-09-08 13:43:29', 'left', '', 215, 23, 'texto', 'desktop'),
(286, 1, 0, 'background_type', 0, 0, '2014-09-08 13:43:29', NULL, '', 215, 23, 'inteiro', 'desktop'),
(287, 1, 0, 'background', NULL, 0, '2014-09-08 13:43:29', '', '', 215, 23, 'texto', 'desktop'),
(288, 1, 0, 'qtd_blocos', 4, 0, '2014-09-08 13:50:38', NULL, '', 211, 24, 'inteiro', 'desktop'),
(289, 1, 0, 'titulo_1', NULL, 0, '2014-09-08 13:50:38', NULL, 'Criação de Web Site', 211, 24, 'texto', 'desktop'),
(290, 1, 0, 'subtitulo_1', NULL, 0, '2014-09-08 13:50:38', NULL, 'Com Gerenciamento de Conteúdo', 211, 24, 'texto', 'desktop'),
(291, 1, 0, 'texto_1', NULL, 0, '2014-09-08 13:50:38', NULL, 'A principal característica da construção de sites gerenciáveis é a facilidade de manutenção. Ao optar por criar um site gerenciável você mesmo poderá atualizar o conteúdo do seu site via painel administrativo sem nenhum custo de manutenção ou conhecimento técnico de programação.\r\n', 211, 24, 'texto', 'desktop'),
(292, 1, 0, 'titulo_2', NULL, 0, '2014-09-08 13:50:38', NULL, 'Criação de Loja Virtual', 211, 24, 'texto', 'desktop'),
(293, 1, 0, 'subtitulo_2', NULL, 0, '2014-09-08 13:50:38', NULL, 'Pronto para começar a vender', 211, 24, 'texto', 'desktop'),
(294, 1, 0, 'texto_2', NULL, 0, '2014-09-08 13:50:38', NULL, 'Clientes potenciais de todos as regiões do Brasil ou do mundo. Tenha uma loja virtual completa com a principais funções do mercado. Venda o que desejar, diferentes produtos, diferentes categorias, escolha a forma de entrega, o tipo de embalagem, forma de pagamento, controle de estoque, lançamentos e etc.', 211, 24, 'texto', 'desktop'),
(295, 1, 0, 'titulo_3', NULL, 0, '2014-09-08 13:50:38', NULL, 'Criação de Logotipos e +', 211, 24, 'texto', 'desktop'),
(296, 1, 0, 'subtitulo_3', NULL, 0, '2014-09-08 13:50:38', NULL, 'Identidade Visual Corporativa', 211, 24, 'texto', 'desktop'),
(297, 1, 0, 'texto_3', NULL, 0, '2014-09-08 13:50:38', NULL, 'Criamos Manual de Identidade Visual, com normas de aplicação de logotipo para sua empresa. Desenvolvemos todo suporte gráfico para impressão, como logotipo, cartão de visita, pasta, papel timbrado, etc. E suporte eletrônicos para interfaces, como banner para site, e-mail marketing, mascotes, etc.', 211, 24, 'texto', 'desktop'),
(298, 1, 0, 'titulo_4', NULL, 0, '2014-09-08 13:50:38', NULL, 'Hospedagem de Sites', 211, 24, 'texto', 'desktop'),
(299, 1, 0, 'subtitulo_4', NULL, 0, '2014-09-08 13:50:38', NULL, 'Atualizações constantes', 211, 24, 'texto', 'desktop'),
(300, 1, 0, 'texto_4', NULL, 0, '2014-09-08 13:50:38', NULL, 'Tudo o que há de mais moderno o PurplePier faz e disponibiliza na plataforma. Sites são integrados com as principais redes sociais, Facebook, Twitter, Google Plus. Integrado com Getty Images na incorporação do seu banco de imagens. Já configurado e pronto para receber Google Analytics, Google Maps e Google Tags Manager. ', 211, 24, 'texto', 'desktop'),
(301, 1, 0, 'image_type_1', 4, 0, '2014-09-08 13:50:38', NULL, '', 211, 24, 'inteiro', 'desktop'),
(302, 1, 0, 'image_1', NULL, 0, '2014-09-08 13:50:38', 'fa-arrows-alt.png', '', 211, 24, 'texto', 'desktop'),
(303, 1, 0, 'icone_cor_1', NULL, 0, '2014-09-08 13:50:38', '#8e1a4c', '', 211, 24, 'texto', 'desktop'),
(304, 1, 0, 'image_type_2', 4, 0, '2014-09-08 13:50:38', NULL, '', 211, 24, 'inteiro', 'desktop'),
(305, 1, 0, 'image_2', NULL, 0, '2014-09-08 13:50:38', 'fa-shopping-cart.png', '', 211, 24, 'texto', 'desktop'),
(306, 1, 0, 'icone_cor_2', NULL, 0, '2014-09-08 13:50:38', '#8e1a4c', '', 211, 24, 'texto', 'desktop'),
(307, 1, 0, 'image_type_3', 4, 0, '2014-09-08 13:50:38', NULL, '', 211, 24, 'inteiro', 'desktop'),
(308, 1, 0, 'image_3', NULL, 0, '2014-09-08 13:50:38', 'fa-tag.png', '', 211, 24, 'texto', 'desktop'),
(309, 1, 0, 'icone_cor_3', NULL, 0, '2014-09-08 13:50:38', '#8e1a4c', '', 211, 24, 'texto', 'desktop'),
(310, 1, 0, 'image_type_4', 4, 0, '2014-09-08 13:50:38', NULL, '', 211, 24, 'inteiro', 'desktop'),
(311, 1, 0, 'image_4', NULL, 0, '2014-09-08 13:50:38', 'fa-rocket.png', '', 211, 24, 'texto', 'desktop'),
(312, 1, 0, 'icone_cor_4', NULL, 0, '2014-09-08 13:50:38', '#8e1a4c', '', 211, 24, 'texto', 'desktop'),
(313, 1, 0, 'margin_top', 30, 0, '2014-09-08 13:50:38', NULL, '', 211, 24, 'inteiro', 'desktop'),
(314, 1, 0, 'margin_bottom', 10, 0, '2014-09-08 13:50:38', NULL, '', 211, 24, 'inteiro', 'desktop'),
(315, 1, 0, 'item1_cor_1', NULL, 0, '2014-09-08 13:50:38', '#8A1C6C', '', 211, 24, 'texto', 'desktop'),
(316, 1, 0, 'item1_alinhamento_1', NULL, 0, '2014-09-08 13:50:38', 'center', '', 211, 24, 'texto', 'desktop'),
(317, 1, 0, 'item1_cor_2', NULL, 0, '2014-09-08 13:50:38', '#2075cb', '', 211, 24, 'texto', 'desktop'),
(318, 1, 0, 'item1_alinhamento_2', NULL, 0, '2014-09-08 13:50:38', 'left', '', 211, 24, 'texto', 'desktop'),
(319, 1, 0, 'item1_cor_3', NULL, 0, '2014-09-08 13:50:38', '#333333', '', 211, 24, 'texto', 'desktop'),
(320, 1, 0, 'item1_alinhamento_3', NULL, 0, '2014-09-08 13:50:38', 'left', '', 211, 24, 'texto', 'desktop'),
(321, 1, 0, 'item2_cor_1', NULL, 0, '2014-09-08 13:50:38', '#8A1C6C', '', 211, 24, 'texto', 'desktop'),
(322, 1, 0, 'item2_alinhamento_1', NULL, 0, '2014-09-08 13:50:38', 'center', '', 211, 24, 'texto', 'desktop'),
(323, 1, 0, 'item2_cor_2', NULL, 0, '2014-09-08 13:50:38', '#2075cb', '', 211, 24, 'texto', 'desktop'),
(324, 1, 0, 'item2_alinhamento_2', NULL, 0, '2014-09-08 13:50:38', 'left', '', 211, 24, 'texto', 'desktop'),
(325, 1, 0, 'item2_cor_3', NULL, 0, '2014-09-08 13:50:38', '#333333', '', 211, 24, 'texto', 'desktop'),
(326, 1, 0, 'item2_alinhamento_3', NULL, 0, '2014-09-08 13:50:38', 'left', '', 211, 24, 'texto', 'desktop'),
(327, 1, 0, 'item3_cor_1', NULL, 0, '2014-09-08 13:50:38', '#8A1C6C', '', 211, 24, 'texto', 'desktop'),
(328, 1, 0, 'item3_alinhamento_1', NULL, 0, '2014-09-08 13:50:38', 'center', '', 211, 24, 'texto', 'desktop'),
(329, 1, 0, 'item3_cor_2', NULL, 0, '2014-09-08 13:50:38', '#2075cb', '', 211, 24, 'texto', 'desktop'),
(330, 1, 0, 'item3_alinhamento_2', NULL, 0, '2014-09-08 13:50:38', 'left', '', 211, 24, 'texto', 'desktop'),
(331, 1, 0, 'item3_cor_3', NULL, 0, '2014-09-08 13:50:38', '#333333', '', 211, 24, 'texto', 'desktop'),
(332, 1, 0, 'item3_alinhamento_3', NULL, 0, '2014-09-08 13:50:38', 'left', '', 211, 24, 'texto', 'desktop'),
(333, 1, 0, 'item4_cor_1', NULL, 0, '2014-09-08 13:50:38', '#8A1C6C', '', 211, 24, 'texto', 'desktop'),
(334, 1, 0, 'item4_alinhamento_1', NULL, 0, '2014-09-08 13:50:38', 'center', '', 211, 24, 'texto', 'desktop'),
(335, 1, 0, 'item4_cor_2', NULL, 0, '2014-09-08 13:50:38', '#2075cb', '', 211, 24, 'texto', 'desktop'),
(336, 1, 0, 'item4_alinhamento_2', NULL, 0, '2014-09-08 13:50:38', 'left', '', 211, 24, 'texto', 'desktop'),
(337, 1, 0, 'item4_cor_3', NULL, 0, '2014-09-08 13:50:38', '#333333', '', 211, 24, 'texto', 'desktop'),
(338, 1, 0, 'item4_alinhamento_3', NULL, 0, '2014-09-08 13:50:38', 'left', '', 211, 24, 'texto', 'desktop'),
(339, 1, 0, 'background_type', 0, 0, '2014-09-08 13:50:38', NULL, '', 211, 24, 'inteiro', 'desktop'),
(340, 1, 0, 'background', NULL, 0, '2014-09-08 13:50:38', '', '', 211, 24, 'texto', 'desktop'),
(341, 1, 0, 'titulo_1', NULL, 0, '2014-09-08 13:54:52', NULL, 'Mural de notícias', 216, 25, 'texto', 'desktop'),
(342, 1, 0, 'subtitulo_1', NULL, 0, '2014-09-08 13:54:52', NULL, 'Veja nossas ultimas noticias', 216, 25, 'texto', 'desktop'),
(343, 1, 0, 'texto_1', NULL, 0, '2014-09-08 13:54:52', NULL, '', 216, 25, 'texto', 'desktop'),
(344, 1, 0, 'cor_1', NULL, 0, '2014-09-08 13:54:52', '#55254a', '', 216, 25, 'texto', 'desktop'),
(345, 1, 0, 'cor_2', NULL, 0, '2014-09-08 13:54:52', '#2075cb', '', 216, 25, 'texto', 'desktop'),
(346, 1, 0, 'cor_3', NULL, 0, '2014-09-08 13:54:52', '', '', 216, 25, 'texto', 'desktop'),
(347, 1, 0, 'cor_titulo_materia', NULL, 0, '2014-09-08 13:54:52', '#69163d', '', 216, 25, 'texto', 'desktop'),
(348, 1, 0, 'cor_descricao_materia', NULL, 0, '2014-09-08 13:54:52', '#1a262d', '', 216, 25, 'texto', 'desktop'),
(349, 1, 0, 'cor_icone_materia', NULL, 0, '2014-09-08 13:54:52', '#a52c64', '', 216, 25, 'texto', 'desktop'),
(350, 1, 0, 'background_type', 0, 0, '2014-09-08 13:54:52', NULL, '', 216, 25, 'inteiro', 'desktop'),
(351, 1, 0, 'background', NULL, 0, '2014-09-08 13:54:52', '', '', 216, 25, 'texto', 'desktop'),
(352, 1, 0, 'titulo_1', NULL, 0, '2014-09-08 16:40:26', NULL, 'Novidades', 217, 27, 'texto', 'desktop'),
(353, 1, 0, 'subtitulo_1', NULL, 0, '2014-09-08 16:40:26', NULL, '', 217, 27, 'texto', 'desktop'),
(354, 1, 0, 'texto_1', NULL, 0, '2014-09-08 16:40:26', NULL, '', 217, 27, 'texto', 'desktop'),
(355, 1, 0, 'cor_1', NULL, 0, '2014-09-08 16:40:26', '#a21551', '', 217, 27, 'texto', 'desktop'),
(356, 1, 0, 'cor_2', NULL, 0, '2014-09-08 16:40:26', '', '', 217, 27, 'texto', 'desktop'),
(357, 1, 0, 'cor_3', NULL, 0, '2014-09-08 16:40:26', '', '', 217, 27, 'texto', 'desktop'),
(358, 1, 0, 'order_by', NULL, 0, '2014-09-08 16:40:26', 'random', '', 217, 27, 'texto', 'desktop'),
(359, 1, 0, 'background_type', 0, 0, '2014-09-08 16:40:26', NULL, '', 217, 27, 'inteiro', 'desktop'),
(360, 1, 0, 'background', NULL, 0, '2014-09-08 16:40:26', '', '', 217, 27, 'texto', 'desktop'),
(361, 1, 0, 'titulo_1', NULL, 0, '2014-09-08 17:17:39', NULL, 'Nossos clientes', 219, 29, 'texto', 'desktop'),
(362, 1, 0, 'subtitulo_1', NULL, 0, '2014-09-08 17:17:39', NULL, 'Veja abaixo nosso portfólio ', 219, 29, 'texto', 'desktop'),
(363, 1, 0, 'texto_1', NULL, 0, '2014-09-08 17:17:39', NULL, '', 219, 29, 'texto', 'desktop'),
(364, 1, 0, 'cor_1', NULL, 0, '2014-09-08 17:17:39', '#4f1227', '', 219, 29, 'texto', 'desktop'),
(365, 1, 0, 'cor_2', NULL, 0, '2014-09-08 17:17:39', '#2075cb', '', 219, 29, 'texto', 'desktop'),
(366, 1, 0, 'cor_3', NULL, 0, '2014-09-08 17:17:39', '', '', 219, 29, 'texto', 'desktop'),
(367, 1, 0, 'margin_top', 30, 0, '2014-09-08 17:17:39', NULL, '', 219, 29, 'inteiro', 'desktop'),
(368, 1, 0, 'margin_bottom', 30, 0, '2014-09-08 17:17:39', NULL, '', 219, 29, 'inteiro', 'desktop'),
(369, 1, 0, 'qtd_items', 4, 0, '2014-09-08 17:17:39', NULL, '', 219, 29, 'inteiro', 'desktop'),
(370, 1, 0, 'galeria', NULL, 0, '2014-09-08 17:17:39', '116-103', '', 219, 29, 'texto', 'desktop'),
(371, 1, 0, 'cor_titulo_item', NULL, 0, '2014-09-08 17:17:39', '', '', 219, 29, 'texto', 'desktop'),
(372, 1, 0, 'cor_descricao_item', NULL, 0, '2014-09-08 17:17:39', '', '', 219, 29, 'texto', 'desktop'),
(373, 1, 0, 'cor_botao', NULL, 0, '2014-09-08 17:17:39', '', '', 219, 29, 'texto', 'desktop'),
(374, 1, 0, 'cor_botao2', NULL, 0, '2014-09-08 17:17:39', '', '', 219, 29, 'texto', 'desktop'),
(375, 1, 0, 'cor_avancar', NULL, 0, '2014-09-08 17:17:39', '', '', 219, 29, 'texto', 'desktop'),
(376, 1, 0, 'cor_botao_label', NULL, 0, '2014-09-08 17:17:39', '', '', 219, 29, 'texto', 'desktop'),
(377, 1, 0, 'botao_exibe', 0, 0, '2014-09-08 17:17:39', NULL, '', 219, 29, 'inteiro', 'desktop'),
(378, 1, 0, 'background_type', 0, 0, '2014-09-08 17:17:39', NULL, '', 219, 29, 'inteiro', 'desktop'),
(379, 1, 0, 'background', NULL, 0, '2014-09-08 17:17:39', '', '', 219, 29, 'texto', 'desktop'),
(380, 1, 0, 'titulo_exibe', 0, 0, '2014-09-08 18:05:51', NULL, '', 219, 29, 'inteiro', 'desktop'),
(381, 1, 0, 'cor_paginacao', NULL, 0, '2014-09-08 18:05:51', '#5c5c5c', '', 219, 29, 'texto', 'desktop'),
(382, 1, 0, 'cor_paginacao_ativo', NULL, 0, '2014-09-08 18:05:51', '#cf2a7b', '', 219, 29, 'texto', 'desktop'),
(383, 1, 0, 'titulo_1', NULL, 0, '2014-09-08 19:35:46', NULL, 'Depoimentos', 215, 30, 'texto', 'desktop'),
(384, 1, 0, 'subtitulo_1', NULL, 0, '2014-09-08 19:35:46', NULL, '- Leia os comentários de quem trabalha com a gente', 215, 30, 'texto', 'desktop'),
(385, 1, 0, 'texto_1', NULL, 0, '2014-09-08 19:35:46', NULL, '', 215, 30, 'texto', 'desktop'),
(386, 1, 0, 'link_1', NULL, 0, '2014-09-08 19:35:46', NULL, '/depoimentos', 215, 30, 'texto', 'desktop'),
(387, 1, 0, 'margin_top', 0, 0, '2014-09-08 19:35:46', NULL, '', 215, 30, 'inteiro', 'desktop'),
(388, 1, 0, 'margin_bottom', 20, 0, '2014-09-08 19:35:46', NULL, '', 215, 30, 'inteiro', 'desktop'),
(389, 1, 0, 'cor_1', NULL, 0, '2014-09-08 19:35:46', '#81183d', '', 215, 30, 'texto', 'desktop'),
(390, 1, 0, 'cor_2', NULL, 0, '2014-09-08 19:35:46', '#33190f', '', 215, 30, 'texto', 'desktop'),
(391, 1, 0, 'cor_3', NULL, 0, '2014-09-08 19:35:46', '', '', 215, 30, 'texto', 'desktop'),
(392, 1, 0, 'alinhamento_1', NULL, 0, '2014-09-08 19:35:46', 'left', '', 215, 30, 'texto', 'desktop'),
(393, 1, 0, 'alinhamento_2', NULL, 0, '2014-09-08 19:35:46', 'left', '', 215, 30, 'texto', 'desktop'),
(394, 1, 0, 'alinhamento_3', NULL, 0, '2014-09-08 19:35:46', 'left', '', 215, 30, 'texto', 'desktop'),
(395, 1, 0, 'background_type', 0, 0, '2014-09-08 19:35:46', NULL, '', 215, 30, 'inteiro', 'desktop');
INSERT INTO `paginas_attribute` (`id`, `id_pagina`, `user_id`, `name`, `inteiro`, `number`, `estampa`, `texto`, `descricao`, `id_componente`, `id_row`, `tipo`, `plataforma`) VALUES
(396, 1, 0, 'background', NULL, 0, '2014-09-08 19:35:46', '', '', 215, 30, 'texto', 'desktop'),
(397, 2, 0, 'gel_fr_initial', NULL, 0, NULL, NULL, ' Leia nossos Termos e Condições de uso', 0, 0, '0', '0'),
(398, 105, 0, 'gel_fr_initial', NULL, 0, NULL, NULL, 'Veja nossa política de Privacidade', 0, 0, '0', '0'),
(399, 131, 0, 'gel_fr_initial', NULL, 0, NULL, NULL, ' Veja o que nossos clientes dizem sobre nossos serviços', 0, 0, '0', '0'),
(400, 1, 0, 'margin_top', 20, 0, '2014-09-08 22:19:37', NULL, '', 216, 25, 'inteiro', 'desktop'),
(401, 1, 0, 'margin_bottom', 30, 0, '2014-09-08 22:19:37', NULL, '', 216, 25, 'inteiro', 'desktop'),
(402, 9, 0, 'gel_fr_initial', NULL, 0, NULL, NULL, ' Preencha abaixo e venha trabalhar com a gente', 0, 0, '0', '0'),
(403, 8, 0, 'forn_phrase', NULL, 0, NULL, 'Sempre precisamos dos seguintes produtos', '', 0, 0, '0', '0'),
(404, 8, 0, 'gel_fr_initial', NULL, 0, NULL, NULL, 'Tem bons produtos e bons preços, seja um de nossos fornecedores', 0, 0, '0', '0'),
(405, 140, 0, 'titulo_1', NULL, 0, '2014-09-27 22:25:49', NULL, 'Páginas Avançadas', 207, 31, 'texto', 'desktop'),
(406, 140, 0, 'subtitulo_1', NULL, 0, '2014-09-27 22:25:49', NULL, 'Você monta o site do jeito que quiser!!', 207, 31, 'texto', 'desktop'),
(407, 140, 0, 'texto_1', NULL, 0, '2014-09-27 22:25:49', NULL, 'Disponibilizamos vários tipos de componentes, onde você pode usar e abusar de sua criatividade. ', 207, 31, 'texto', 'desktop'),
(408, 140, 0, 'image_1', NULL, 0, '2014-09-27 22:25:49', '', '', 207, 31, 'texto', 'desktop'),
(409, 140, 0, 'cor_1', NULL, 0, '2014-09-27 22:25:49', '', '', 207, 31, 'texto', 'desktop'),
(410, 140, 0, 'cor_2', NULL, 0, '2014-09-27 22:25:49', '', '', 207, 31, 'texto', 'desktop'),
(411, 140, 0, 'cor_3', NULL, 0, '2014-09-27 22:25:49', '', '', 207, 31, 'texto', 'desktop'),
(412, 140, 0, 'alinhamento_1', NULL, 0, '2014-09-27 22:25:49', 'center', '', 207, 31, 'texto', 'desktop'),
(413, 140, 0, 'alinhamento_2', NULL, 0, '2014-09-27 22:25:49', 'center', '', 207, 31, 'texto', 'desktop'),
(414, 140, 0, 'alinhamento_3', NULL, 0, '2014-09-27 22:25:49', 'center', '', 207, 31, 'texto', 'desktop'),
(415, 140, 0, 'margin_top', 20, 0, '2014-09-27 22:25:49', NULL, '', 207, 31, 'inteiro', 'desktop'),
(416, 140, 0, 'margin_bottom', 20, 0, '2014-09-27 22:25:49', NULL, '', 207, 31, 'inteiro', 'desktop'),
(417, 140, 0, 'padding_top', 0, 0, '2014-09-27 22:25:49', NULL, '', 207, 31, 'inteiro', 'desktop'),
(418, 140, 0, 'padding_bottom', 0, 0, '2014-09-27 22:25:49', NULL, '', 207, 31, 'inteiro', 'desktop'),
(419, 140, 0, 'background_type', 0, 0, '2014-09-27 22:25:49', NULL, '', 207, 31, 'inteiro', 'desktop'),
(420, 140, 0, 'background', NULL, 0, '2014-09-27 22:25:49', '', '', 207, 31, 'texto', 'desktop'),
(421, 140, 0, 'titulo_1', NULL, 0, '2014-09-27 22:30:04', NULL, '', 186, 32, 'texto', 'desktop'),
(422, 140, 0, 'subtitulo_1', NULL, 0, '2014-09-27 22:30:04', NULL, '', 186, 32, 'texto', 'desktop'),
(423, 140, 0, 'texto_1', NULL, 0, '2014-09-27 22:30:04', NULL, '', 186, 32, 'texto', 'desktop'),
(424, 140, 0, 'image_1', NULL, 0, '2014-09-27 22:30:04', '', '', 186, 32, 'image', 'desktop'),
(425, 140, 0, 'cor_1', NULL, 0, '2014-09-27 22:30:04', '', '', 186, 32, 'texto', 'desktop'),
(426, 140, 0, 'cor_2', NULL, 0, '2014-09-27 22:30:04', '', '', 186, 32, 'texto', 'desktop'),
(427, 140, 0, 'cor_3', NULL, 0, '2014-09-27 22:30:04', '', '', 186, 32, 'texto', 'desktop'),
(428, 140, 0, 'titulo_1', NULL, 0, '2014-09-30 18:38:40', NULL, '', 186, 34, 'texto', 'desktop'),
(429, 140, 0, 'subtitulo_1', NULL, 0, '2014-09-30 18:38:40', NULL, '', 186, 34, 'texto', 'desktop'),
(430, 140, 0, 'texto_1', NULL, 0, '2014-09-30 18:38:40', NULL, '', 186, 34, 'texto', 'desktop'),
(431, 140, 0, 'image_1', NULL, 0, '2014-09-30 18:38:40', 'f_835', '', 186, 34, 'image', 'desktop'),
(432, 140, 0, 'cor_1', NULL, 0, '2014-09-30 18:38:40', '', '', 186, 34, 'texto', 'desktop'),
(433, 140, 0, 'cor_2', NULL, 0, '2014-09-30 18:38:40', '', '', 186, 34, 'texto', 'desktop'),
(434, 140, 0, 'cor_3', NULL, 0, '2014-09-30 18:38:40', '', '', 186, 34, 'texto', 'desktop'),
(435, 1, 0, 'margin_top', 0, 0, '2014-09-30 18:40:27', NULL, '', 217, 27, 'inteiro', 'desktop'),
(436, 1, 0, 'margin_bottom', 20, 0, '2014-09-30 18:40:27', NULL, '', 217, 27, 'inteiro', 'desktop'),
(437, 140, 0, 'titulo_1', NULL, 0, '2014-09-30 19:03:22', NULL, '', 207, 35, 'texto', 'desktop'),
(438, 140, 0, 'subtitulo_1', NULL, 0, '2014-09-30 19:03:22', NULL, '', 207, 35, 'texto', 'desktop'),
(439, 140, 0, 'texto_1', NULL, 0, '2014-09-30 19:03:22', NULL, '', 207, 35, 'texto', 'desktop'),
(440, 140, 0, 'image_1', NULL, 0, '2014-09-30 19:03:22', 'massachusetts_artigo_g0.png', '', 207, 35, 'texto', 'desktop'),
(441, 140, 0, 'cor_1', NULL, 0, '2014-09-30 19:03:22', '', '', 207, 35, 'texto', 'desktop'),
(442, 140, 0, 'cor_2', NULL, 0, '2014-09-30 19:03:22', '', '', 207, 35, 'texto', 'desktop'),
(443, 140, 0, 'cor_3', NULL, 0, '2014-09-30 19:03:22', '', '', 207, 35, 'texto', 'desktop'),
(444, 140, 0, 'alinhamento_1', NULL, 0, '2014-09-30 19:03:22', 'left', '', 207, 35, 'texto', 'desktop'),
(445, 140, 0, 'alinhamento_2', NULL, 0, '2014-09-30 19:03:22', 'left', '', 207, 35, 'texto', 'desktop'),
(446, 140, 0, 'alinhamento_3', NULL, 0, '2014-09-30 19:03:22', 'left', '', 207, 35, 'texto', 'desktop'),
(447, 140, 0, 'margin_top', 0, 0, '2014-09-30 19:03:22', NULL, '', 207, 35, 'inteiro', 'desktop'),
(448, 140, 0, 'margin_bottom', 0, 0, '2014-09-30 19:03:22', NULL, '', 207, 35, 'inteiro', 'desktop'),
(449, 140, 0, 'padding_top', 0, 0, '2014-09-30 19:03:22', NULL, '', 207, 35, 'inteiro', 'desktop'),
(450, 140, 0, 'padding_bottom', 0, 0, '2014-09-30 19:03:22', NULL, '', 207, 35, 'inteiro', 'desktop'),
(451, 140, 0, 'background_type', 0, 0, '2014-09-30 19:03:22', NULL, '', 207, 35, 'inteiro', 'desktop'),
(452, 140, 0, 'background', NULL, 0, '2014-09-30 19:03:22', '', '', 207, 35, 'texto', 'desktop'),
(453, 140, 0, 'titulo_1', NULL, 0, '2014-09-30 19:07:41', NULL, '', 207, 41, 'texto', 'desktop'),
(454, 140, 0, 'subtitulo_1', NULL, 0, '2014-09-30 19:07:41', NULL, '', 207, 41, 'texto', 'desktop'),
(455, 140, 0, 'texto_1', NULL, 0, '2014-09-30 19:07:41', NULL, '', 207, 41, 'texto', 'desktop'),
(456, 140, 0, 'image_1', NULL, 0, '2014-09-30 19:07:41', 'block_novidades_tetriz_z1.png', '', 207, 41, 'texto', 'desktop'),
(457, 140, 0, 'cor_1', NULL, 0, '2014-09-30 19:07:41', '', '', 207, 41, 'texto', 'desktop'),
(458, 140, 0, 'cor_2', NULL, 0, '2014-09-30 19:07:41', '', '', 207, 41, 'texto', 'desktop'),
(459, 140, 0, 'cor_3', NULL, 0, '2014-09-30 19:07:41', '', '', 207, 41, 'texto', 'desktop'),
(460, 140, 0, 'alinhamento_1', NULL, 0, '2014-09-30 19:07:41', 'left', '', 207, 41, 'texto', 'desktop'),
(461, 140, 0, 'alinhamento_2', NULL, 0, '2014-09-30 19:07:41', 'left', '', 207, 41, 'texto', 'desktop'),
(462, 140, 0, 'alinhamento_3', NULL, 0, '2014-09-30 19:07:41', 'left', '', 207, 41, 'texto', 'desktop'),
(463, 140, 0, 'margin_top', 30, 0, '2014-09-30 19:07:41', NULL, '', 207, 41, 'inteiro', 'desktop'),
(464, 140, 0, 'margin_bottom', 0, 0, '2014-09-30 19:07:41', NULL, '', 207, 41, 'inteiro', 'desktop'),
(465, 140, 0, 'padding_top', 0, 0, '2014-09-30 19:07:41', NULL, '', 207, 41, 'inteiro', 'desktop'),
(466, 140, 0, 'padding_bottom', 0, 0, '2014-09-30 19:07:41', NULL, '', 207, 41, 'inteiro', 'desktop'),
(467, 140, 0, 'background_type', 0, 0, '2014-09-30 19:07:41', NULL, '', 207, 41, 'inteiro', 'desktop'),
(468, 140, 0, 'background', NULL, 0, '2014-09-30 19:07:41', '', '', 207, 41, 'texto', 'desktop'),
(469, 140, 0, 'titulo_1', NULL, 0, '2014-09-30 19:11:15', NULL, '', 207, 40, 'texto', 'desktop'),
(470, 140, 0, 'subtitulo_1', NULL, 0, '2014-09-30 19:11:15', NULL, '', 207, 40, 'texto', 'desktop'),
(471, 140, 0, 'texto_1', NULL, 0, '2014-09-30 19:11:15', NULL, '', 207, 40, 'texto', 'desktop'),
(472, 140, 0, 'image_1', NULL, 0, '2014-09-30 19:11:15', 'lampejo_l2.png', '', 207, 40, 'texto', 'desktop'),
(473, 140, 0, 'cor_1', NULL, 0, '2014-09-30 19:11:15', '', '', 207, 40, 'texto', 'desktop'),
(474, 140, 0, 'cor_2', NULL, 0, '2014-09-30 19:11:15', '', '', 207, 40, 'texto', 'desktop'),
(475, 140, 0, 'cor_3', NULL, 0, '2014-09-30 19:11:15', '', '', 207, 40, 'texto', 'desktop'),
(476, 140, 0, 'alinhamento_1', NULL, 0, '2014-09-30 19:11:15', 'left', '', 207, 40, 'texto', 'desktop'),
(477, 140, 0, 'alinhamento_2', NULL, 0, '2014-09-30 19:11:15', 'left', '', 207, 40, 'texto', 'desktop'),
(478, 140, 0, 'alinhamento_3', NULL, 0, '2014-09-30 19:11:15', 'left', '', 207, 40, 'texto', 'desktop'),
(479, 140, 0, 'margin_top', 0, 0, '2014-09-30 19:11:15', NULL, '', 207, 40, 'inteiro', 'desktop'),
(480, 140, 0, 'margin_bottom', 0, 0, '2014-09-30 19:11:15', NULL, '', 207, 40, 'inteiro', 'desktop'),
(481, 140, 0, 'padding_top', 0, 0, '2014-09-30 19:11:15', NULL, '', 207, 40, 'inteiro', 'desktop'),
(482, 140, 0, 'padding_bottom', 0, 0, '2014-09-30 19:11:15', NULL, '', 207, 40, 'inteiro', 'desktop'),
(483, 140, 0, 'background_type', 0, 0, '2014-09-30 19:11:15', NULL, '', 207, 40, 'inteiro', 'desktop'),
(484, 140, 0, 'background', NULL, 0, '2014-09-30 19:11:15', '', '', 207, 40, 'texto', 'desktop'),
(485, 140, 0, 'titulo_1', NULL, 0, '2014-09-30 19:11:27', NULL, 'Componentes para colocar o conteúdo nas paginas do Web Site', 207, 39, 'texto', 'desktop'),
(486, 140, 0, 'subtitulo_1', NULL, 0, '2014-09-30 19:11:27', NULL, '', 207, 39, 'texto', 'desktop'),
(487, 140, 0, 'texto_1', NULL, 0, '2014-09-30 19:11:27', NULL, '', 207, 39, 'texto', 'desktop'),
(488, 140, 0, 'image_1', NULL, 0, '2014-09-30 19:11:27', 'texas_artigo_e7.png', '', 207, 39, 'texto', 'desktop'),
(489, 140, 0, 'cor_1', NULL, 0, '2014-09-30 19:11:27', '', '', 207, 39, 'texto', 'desktop'),
(490, 140, 0, 'cor_2', NULL, 0, '2014-09-30 19:11:27', '', '', 207, 39, 'texto', 'desktop'),
(491, 140, 0, 'cor_3', NULL, 0, '2014-09-30 19:11:27', '', '', 207, 39, 'texto', 'desktop'),
(492, 140, 0, 'alinhamento_1', NULL, 0, '2014-09-30 19:11:27', 'center', '', 207, 39, 'texto', 'desktop'),
(493, 140, 0, 'alinhamento_2', NULL, 0, '2014-09-30 19:11:27', 'left', '', 207, 39, 'texto', 'desktop'),
(494, 140, 0, 'alinhamento_3', NULL, 0, '2014-09-30 19:11:27', 'left', '', 207, 39, 'texto', 'desktop'),
(495, 140, 0, 'margin_top', 40, 0, '2014-09-30 19:11:27', NULL, '', 207, 39, 'inteiro', 'desktop'),
(496, 140, 0, 'margin_bottom', 0, 0, '2014-09-30 19:11:27', NULL, '', 207, 39, 'inteiro', 'desktop'),
(497, 140, 0, 'padding_top', 0, 0, '2014-09-30 19:11:27', NULL, '', 207, 39, 'inteiro', 'desktop'),
(498, 140, 0, 'padding_bottom', 0, 0, '2014-09-30 19:11:27', NULL, '', 207, 39, 'inteiro', 'desktop'),
(499, 140, 0, 'background_type', 0, 0, '2014-09-30 19:11:27', NULL, '', 207, 39, 'inteiro', 'desktop'),
(500, 140, 0, 'background', NULL, 0, '2014-09-30 19:11:27', '', '', 207, 39, 'texto', 'desktop'),
(501, 140, 0, 'titulo_1', NULL, 0, '2014-09-30 19:13:17', NULL, '', 207, 38, 'texto', 'desktop'),
(502, 140, 0, 'subtitulo_1', NULL, 0, '2014-09-30 19:13:17', NULL, '', 207, 38, 'texto', 'desktop'),
(503, 140, 0, 'texto_1', NULL, 0, '2014-09-30 19:13:17', NULL, '', 207, 38, 'texto', 'desktop'),
(504, 140, 0, 'image_1', NULL, 0, '2014-09-30 19:13:17', 'colorado_artigo_w7.png', '', 207, 38, 'texto', 'desktop'),
(505, 140, 0, 'cor_1', NULL, 0, '2014-09-30 19:13:17', '', '', 207, 38, 'texto', 'desktop'),
(506, 140, 0, 'cor_2', NULL, 0, '2014-09-30 19:13:17', '', '', 207, 38, 'texto', 'desktop'),
(507, 140, 0, 'cor_3', NULL, 0, '2014-09-30 19:13:17', '', '', 207, 38, 'texto', 'desktop'),
(508, 140, 0, 'alinhamento_1', NULL, 0, '2014-09-30 19:13:17', 'left', '', 207, 38, 'texto', 'desktop'),
(509, 140, 0, 'alinhamento_2', NULL, 0, '2014-09-30 19:13:17', 'left', '', 207, 38, 'texto', 'desktop'),
(510, 140, 0, 'alinhamento_3', NULL, 0, '2014-09-30 19:13:17', 'left', '', 207, 38, 'texto', 'desktop'),
(511, 140, 0, 'margin_top', 0, 0, '2014-09-30 19:13:17', NULL, '', 207, 38, 'inteiro', 'desktop'),
(512, 140, 0, 'margin_bottom', 0, 0, '2014-09-30 19:13:17', NULL, '', 207, 38, 'inteiro', 'desktop'),
(513, 140, 0, 'padding_top', 0, 0, '2014-09-30 19:13:17', NULL, '', 207, 38, 'inteiro', 'desktop'),
(514, 140, 0, 'padding_bottom', 0, 0, '2014-09-30 19:13:17', NULL, '', 207, 38, 'inteiro', 'desktop'),
(515, 140, 0, 'background_type', 0, 0, '2014-09-30 19:13:17', NULL, '', 207, 38, 'inteiro', 'desktop'),
(516, 140, 0, 'background', NULL, 0, '2014-09-30 19:13:17', '', '', 207, 38, 'texto', 'desktop'),
(517, 140, 0, 'titulo_1', NULL, 0, '2014-09-30 19:13:27', NULL, 'Componentes para criação de Banner ', 207, 37, 'texto', 'desktop'),
(518, 140, 0, 'subtitulo_1', NULL, 0, '2014-09-30 19:13:27', NULL, '', 207, 37, 'texto', 'desktop'),
(519, 140, 0, 'texto_1', NULL, 0, '2014-09-30 19:13:27', NULL, '', 207, 37, 'texto', 'desktop'),
(520, 140, 0, 'image_1', NULL, 0, '2014-09-30 19:13:27', 'billboard_j9.png', '', 207, 37, 'texto', 'desktop'),
(521, 140, 0, 'cor_1', NULL, 0, '2014-09-30 19:13:27', '', '', 207, 37, 'texto', 'desktop'),
(522, 140, 0, 'cor_2', NULL, 0, '2014-09-30 19:13:27', '', '', 207, 37, 'texto', 'desktop'),
(523, 140, 0, 'cor_3', NULL, 0, '2014-09-30 19:13:27', '', '', 207, 37, 'texto', 'desktop'),
(524, 140, 0, 'alinhamento_1', NULL, 0, '2014-09-30 19:13:27', 'center', '', 207, 37, 'texto', 'desktop'),
(525, 140, 0, 'alinhamento_2', NULL, 0, '2014-09-30 19:13:27', 'left', '', 207, 37, 'texto', 'desktop'),
(526, 140, 0, 'alinhamento_3', NULL, 0, '2014-09-30 19:13:27', 'left', '', 207, 37, 'texto', 'desktop'),
(527, 140, 0, 'margin_top', 30, 0, '2014-09-30 19:13:27', NULL, '', 207, 37, 'inteiro', 'desktop'),
(528, 140, 0, 'margin_bottom', 0, 0, '2014-09-30 19:13:27', NULL, '', 207, 37, 'inteiro', 'desktop'),
(529, 140, 0, 'padding_top', 0, 0, '2014-09-30 19:13:27', NULL, '', 207, 37, 'inteiro', 'desktop'),
(530, 140, 0, 'padding_bottom', 0, 0, '2014-09-30 19:13:27', NULL, '', 207, 37, 'inteiro', 'desktop'),
(531, 140, 0, 'background_type', 0, 0, '2014-09-30 19:13:27', NULL, '', 207, 37, 'inteiro', 'desktop'),
(532, 140, 0, 'background', NULL, 0, '2014-09-30 19:13:27', '', '', 207, 37, 'texto', 'desktop'),
(533, 140, 0, 'titulo_1', NULL, 0, '2014-09-30 19:32:34', NULL, '', 207, 36, 'texto', 'desktop'),
(534, 140, 0, 'subtitulo_1', NULL, 0, '2014-09-30 19:32:34', NULL, '', 207, 36, 'texto', 'desktop'),
(535, 140, 0, 'texto_1', NULL, 0, '2014-09-30 19:32:34', NULL, '', 207, 36, 'texto', 'desktop'),
(536, 140, 0, 'image_1', NULL, 0, '2014-09-30 19:32:34', 'block_novidades_zambe_w6.png', '', 207, 36, 'texto', 'desktop'),
(537, 140, 0, 'cor_1', NULL, 0, '2014-09-30 19:32:34', '', '', 207, 36, 'texto', 'desktop'),
(538, 140, 0, 'cor_2', NULL, 0, '2014-09-30 19:32:34', '', '', 207, 36, 'texto', 'desktop'),
(539, 140, 0, 'cor_3', NULL, 0, '2014-09-30 19:32:34', '', '', 207, 36, 'texto', 'desktop'),
(540, 140, 0, 'alinhamento_1', NULL, 0, '2014-09-30 19:32:34', 'left', '', 207, 36, 'texto', 'desktop'),
(541, 140, 0, 'alinhamento_2', NULL, 0, '2014-09-30 19:32:34', 'left', '', 207, 36, 'texto', 'desktop'),
(542, 140, 0, 'alinhamento_3', NULL, 0, '2014-09-30 19:32:34', 'left', '', 207, 36, 'texto', 'desktop'),
(543, 140, 0, 'margin_top', 0, 0, '2014-09-30 19:32:34', NULL, '', 207, 36, 'inteiro', 'desktop'),
(544, 140, 0, 'margin_bottom', 0, 0, '2014-09-30 19:32:34', NULL, '', 207, 36, 'inteiro', 'desktop'),
(545, 140, 0, 'padding_top', 0, 0, '2014-09-30 19:32:34', NULL, '', 207, 36, 'inteiro', 'desktop'),
(546, 140, 0, 'padding_bottom', 0, 0, '2014-09-30 19:32:34', NULL, '', 207, 36, 'inteiro', 'desktop'),
(547, 140, 0, 'background_type', 0, 0, '2014-09-30 19:32:34', NULL, '', 207, 36, 'inteiro', 'desktop'),
(548, 140, 0, 'background', NULL, 0, '2014-09-30 19:32:34', '', '', 207, 36, 'texto', 'desktop'),
(549, 140, 0, 'titulo_1', NULL, 0, '2014-09-30 19:32:49', NULL, '', 207, 52, 'texto', 'desktop'),
(550, 140, 0, 'subtitulo_1', NULL, 0, '2014-09-30 19:32:49', NULL, '', 207, 52, 'texto', 'desktop'),
(551, 140, 0, 'texto_1', NULL, 0, '2014-09-30 19:32:49', NULL, '', 207, 52, 'texto', 'desktop'),
(552, 140, 0, 'image_1', NULL, 0, '2014-09-30 19:32:49', 'plataforma_responsiva_w8.png', '', 207, 52, 'texto', 'desktop'),
(553, 140, 0, 'cor_1', NULL, 0, '2014-09-30 19:32:49', '', '', 207, 52, 'texto', 'desktop'),
(554, 140, 0, 'cor_2', NULL, 0, '2014-09-30 19:32:49', '', '', 207, 52, 'texto', 'desktop'),
(555, 140, 0, 'cor_3', NULL, 0, '2014-09-30 19:32:49', '', '', 207, 52, 'texto', 'desktop'),
(556, 140, 0, 'alinhamento_1', NULL, 0, '2014-09-30 19:32:49', 'left', '', 207, 52, 'texto', 'desktop'),
(557, 140, 0, 'alinhamento_2', NULL, 0, '2014-09-30 19:32:49', 'left', '', 207, 52, 'texto', 'desktop'),
(558, 140, 0, 'alinhamento_3', NULL, 0, '2014-09-30 19:32:49', 'left', '', 207, 52, 'texto', 'desktop'),
(559, 140, 0, 'margin_top', 0, 0, '2014-09-30 19:32:49', NULL, '', 207, 52, 'inteiro', 'desktop'),
(560, 140, 0, 'margin_bottom', 0, 0, '2014-09-30 19:32:49', NULL, '', 207, 52, 'inteiro', 'desktop'),
(561, 140, 0, 'padding_top', 0, 0, '2014-09-30 19:32:49', NULL, '', 207, 52, 'inteiro', 'desktop'),
(562, 140, 0, 'padding_bottom', 0, 0, '2014-09-30 19:32:49', NULL, '', 207, 52, 'inteiro', 'desktop'),
(563, 140, 0, 'background_type', 0, 0, '2014-09-30 19:32:49', NULL, '', 207, 52, 'inteiro', 'desktop'),
(564, 140, 0, 'background', NULL, 0, '2014-09-30 19:32:49', '', '', 207, 52, 'texto', 'desktop'),
(565, 140, 0, 'titulo_1', NULL, 0, '2014-09-30 19:34:08', NULL, '', 207, 51, 'texto', 'desktop'),
(566, 140, 0, 'subtitulo_1', NULL, 0, '2014-09-30 19:34:08', NULL, '', 207, 51, 'texto', 'desktop'),
(567, 140, 0, 'texto_1', NULL, 0, '2014-09-30 19:34:08', NULL, '', 207, 51, 'texto', 'desktop'),
(568, 140, 0, 'image_1', NULL, 0, '2014-09-30 19:34:08', 'vitrine_barcelona_n0.png', '', 207, 51, 'texto', 'desktop'),
(569, 140, 0, 'cor_1', NULL, 0, '2014-09-30 19:34:08', '', '', 207, 51, 'texto', 'desktop'),
(570, 140, 0, 'cor_2', NULL, 0, '2014-09-30 19:34:08', '', '', 207, 51, 'texto', 'desktop'),
(571, 140, 0, 'cor_3', NULL, 0, '2014-09-30 19:34:08', '', '', 207, 51, 'texto', 'desktop'),
(572, 140, 0, 'alinhamento_1', NULL, 0, '2014-09-30 19:34:08', 'left', '', 207, 51, 'texto', 'desktop'),
(573, 140, 0, 'alinhamento_2', NULL, 0, '2014-09-30 19:34:08', 'left', '', 207, 51, 'texto', 'desktop'),
(574, 140, 0, 'alinhamento_3', NULL, 0, '2014-09-30 19:34:08', 'left', '', 207, 51, 'texto', 'desktop'),
(575, 140, 0, 'margin_top', 0, 0, '2014-09-30 19:34:08', NULL, '', 207, 51, 'inteiro', 'desktop'),
(576, 140, 0, 'margin_bottom', 0, 0, '2014-09-30 19:34:08', NULL, '', 207, 51, 'inteiro', 'desktop'),
(577, 140, 0, 'padding_top', 0, 0, '2014-09-30 19:34:08', NULL, '', 207, 51, 'inteiro', 'desktop'),
(578, 140, 0, 'padding_bottom', 0, 0, '2014-09-30 19:34:08', NULL, '', 207, 51, 'inteiro', 'desktop'),
(579, 140, 0, 'background_type', 0, 0, '2014-09-30 19:34:08', NULL, '', 207, 51, 'inteiro', 'desktop'),
(580, 140, 0, 'background', NULL, 0, '2014-09-30 19:34:08', '', '', 207, 51, 'texto', 'desktop'),
(581, 140, 0, 'titulo_1', NULL, 0, '2014-09-30 19:36:25', NULL, '', 207, 50, 'texto', 'desktop'),
(582, 140, 0, 'subtitulo_1', NULL, 0, '2014-09-30 19:36:25', NULL, '', 207, 50, 'texto', 'desktop'),
(583, 140, 0, 'texto_1', NULL, 0, '2014-09-30 19:36:25', NULL, '', 207, 50, 'texto', 'desktop'),
(584, 140, 0, 'image_1', NULL, 0, '2014-09-30 19:36:25', 'users_slider_s4.png', '', 207, 50, 'texto', 'desktop'),
(585, 140, 0, 'cor_1', NULL, 0, '2014-09-30 19:36:25', '', '', 207, 50, 'texto', 'desktop'),
(586, 140, 0, 'cor_2', NULL, 0, '2014-09-30 19:36:25', '', '', 207, 50, 'texto', 'desktop'),
(587, 140, 0, 'cor_3', NULL, 0, '2014-09-30 19:36:25', '', '', 207, 50, 'texto', 'desktop'),
(588, 140, 0, 'alinhamento_1', NULL, 0, '2014-09-30 19:36:25', 'left', '', 207, 50, 'texto', 'desktop'),
(589, 140, 0, 'alinhamento_2', NULL, 0, '2014-09-30 19:36:25', 'left', '', 207, 50, 'texto', 'desktop'),
(590, 140, 0, 'alinhamento_3', NULL, 0, '2014-09-30 19:36:25', 'left', '', 207, 50, 'texto', 'desktop'),
(591, 140, 0, 'margin_top', 0, 0, '2014-09-30 19:36:25', NULL, '', 207, 50, 'inteiro', 'desktop'),
(592, 140, 0, 'margin_bottom', 0, 0, '2014-09-30 19:36:25', NULL, '', 207, 50, 'inteiro', 'desktop'),
(593, 140, 0, 'padding_top', 0, 0, '2014-09-30 19:36:25', NULL, '', 207, 50, 'inteiro', 'desktop'),
(594, 140, 0, 'padding_bottom', 0, 0, '2014-09-30 19:36:25', NULL, '', 207, 50, 'inteiro', 'desktop'),
(595, 140, 0, 'background_type', 0, 0, '2014-09-30 19:36:25', NULL, '', 207, 50, 'inteiro', 'desktop'),
(596, 140, 0, 'background', NULL, 0, '2014-09-30 19:36:25', '', '', 207, 50, 'texto', 'desktop'),
(597, 140, 0, 'titulo_1', NULL, 0, '2014-09-30 19:37:07', NULL, '', 207, 49, 'texto', 'desktop'),
(598, 140, 0, 'subtitulo_1', NULL, 0, '2014-09-30 19:37:07', NULL, '', 207, 49, 'texto', 'desktop'),
(599, 140, 0, 'texto_1', NULL, 0, '2014-09-30 19:37:07', NULL, '', 207, 49, 'texto', 'desktop'),
(600, 140, 0, 'image_1', NULL, 0, '2014-09-30 19:37:07', 'banca_revistas_s6.png', '', 207, 49, 'texto', 'desktop'),
(601, 140, 0, 'cor_1', NULL, 0, '2014-09-30 19:37:07', '', '', 207, 49, 'texto', 'desktop'),
(602, 140, 0, 'cor_2', NULL, 0, '2014-09-30 19:37:07', '', '', 207, 49, 'texto', 'desktop'),
(603, 140, 0, 'cor_3', NULL, 0, '2014-09-30 19:37:07', '', '', 207, 49, 'texto', 'desktop'),
(604, 140, 0, 'alinhamento_1', NULL, 0, '2014-09-30 19:37:07', 'left', '', 207, 49, 'texto', 'desktop'),
(605, 140, 0, 'alinhamento_2', NULL, 0, '2014-09-30 19:37:07', 'left', '', 207, 49, 'texto', 'desktop'),
(606, 140, 0, 'alinhamento_3', NULL, 0, '2014-09-30 19:37:07', 'left', '', 207, 49, 'texto', 'desktop'),
(607, 140, 0, 'margin_top', 0, 0, '2014-09-30 19:37:07', NULL, '', 207, 49, 'inteiro', 'desktop'),
(608, 140, 0, 'margin_bottom', 0, 0, '2014-09-30 19:37:07', NULL, '', 207, 49, 'inteiro', 'desktop'),
(609, 140, 0, 'padding_top', 0, 0, '2014-09-30 19:37:07', NULL, '', 207, 49, 'inteiro', 'desktop'),
(610, 140, 0, 'padding_bottom', 0, 0, '2014-09-30 19:37:07', NULL, '', 207, 49, 'inteiro', 'desktop'),
(611, 140, 0, 'background_type', 0, 0, '2014-09-30 19:37:07', NULL, '', 207, 49, 'inteiro', 'desktop'),
(612, 140, 0, 'background', NULL, 0, '2014-09-30 19:37:07', '', '', 207, 49, 'texto', 'desktop'),
(613, 140, 0, 'titulo_1', NULL, 0, '2014-09-30 19:54:29', NULL, '', 207, 48, 'texto', 'desktop'),
(614, 140, 0, 'subtitulo_1', NULL, 0, '2014-09-30 19:54:29', NULL, '', 207, 48, 'texto', 'desktop'),
(615, 140, 0, 'texto_1', NULL, 0, '2014-09-30 19:54:29', NULL, '', 207, 48, 'texto', 'desktop'),
(616, 140, 0, 'image_1', NULL, 0, '2014-09-30 19:54:29', 'tarjenta_g6.png', '', 207, 48, 'texto', 'desktop'),
(617, 140, 0, 'cor_1', NULL, 0, '2014-09-30 19:54:29', '', '', 207, 48, 'texto', 'desktop'),
(618, 140, 0, 'cor_2', NULL, 0, '2014-09-30 19:54:29', '', '', 207, 48, 'texto', 'desktop'),
(619, 140, 0, 'cor_3', NULL, 0, '2014-09-30 19:54:29', '', '', 207, 48, 'texto', 'desktop'),
(620, 140, 0, 'alinhamento_1', NULL, 0, '2014-09-30 19:54:29', 'left', '', 207, 48, 'texto', 'desktop'),
(621, 140, 0, 'alinhamento_2', NULL, 0, '2014-09-30 19:54:29', 'left', '', 207, 48, 'texto', 'desktop'),
(622, 140, 0, 'alinhamento_3', NULL, 0, '2014-09-30 19:54:29', 'left', '', 207, 48, 'texto', 'desktop'),
(623, 140, 0, 'margin_top', 0, 0, '2014-09-30 19:54:29', NULL, '', 207, 48, 'inteiro', 'desktop'),
(624, 140, 0, 'margin_bottom', 0, 0, '2014-09-30 19:54:29', NULL, '', 207, 48, 'inteiro', 'desktop'),
(625, 140, 0, 'padding_top', 0, 0, '2014-09-30 19:54:29', NULL, '', 207, 48, 'inteiro', 'desktop'),
(626, 140, 0, 'padding_bottom', 0, 0, '2014-09-30 19:54:29', NULL, '', 207, 48, 'inteiro', 'desktop'),
(627, 140, 0, 'background_type', 0, 0, '2014-09-30 19:54:29', NULL, '', 207, 48, 'inteiro', 'desktop'),
(628, 140, 0, 'background', NULL, 0, '2014-09-30 19:54:29', '', '', 207, 48, 'texto', 'desktop'),
(629, 140, 0, 'titulo_1', NULL, 0, '2014-09-30 19:55:45', NULL, '', 207, 47, 'texto', 'desktop'),
(630, 140, 0, 'subtitulo_1', NULL, 0, '2014-09-30 19:55:45', NULL, '', 207, 47, 'texto', 'desktop'),
(631, 140, 0, 'texto_1', NULL, 0, '2014-09-30 19:55:45', NULL, '', 207, 47, 'texto', 'desktop'),
(632, 140, 0, 'image_1', NULL, 0, '2014-09-30 19:55:45', 'outdoor_rotativo_u1.png', '', 207, 47, 'texto', 'desktop'),
(633, 140, 0, 'cor_1', NULL, 0, '2014-09-30 19:55:45', '', '', 207, 47, 'texto', 'desktop'),
(634, 140, 0, 'cor_2', NULL, 0, '2014-09-30 19:55:45', '', '', 207, 47, 'texto', 'desktop'),
(635, 140, 0, 'cor_3', NULL, 0, '2014-09-30 19:55:45', '', '', 207, 47, 'texto', 'desktop'),
(636, 140, 0, 'alinhamento_1', NULL, 0, '2014-09-30 19:55:45', 'left', '', 207, 47, 'texto', 'desktop'),
(637, 140, 0, 'alinhamento_2', NULL, 0, '2014-09-30 19:55:45', 'left', '', 207, 47, 'texto', 'desktop'),
(638, 140, 0, 'alinhamento_3', NULL, 0, '2014-09-30 19:55:45', 'left', '', 207, 47, 'texto', 'desktop'),
(639, 140, 0, 'margin_top', 0, 0, '2014-09-30 19:55:45', NULL, '', 207, 47, 'inteiro', 'desktop'),
(640, 140, 0, 'margin_bottom', 0, 0, '2014-09-30 19:55:45', NULL, '', 207, 47, 'inteiro', 'desktop'),
(641, 140, 0, 'padding_top', 0, 0, '2014-09-30 19:55:45', NULL, '', 207, 47, 'inteiro', 'desktop'),
(642, 140, 0, 'padding_bottom', 0, 0, '2014-09-30 19:55:45', NULL, '', 207, 47, 'inteiro', 'desktop'),
(643, 140, 0, 'background_type', 0, 0, '2014-09-30 19:55:45', NULL, '', 207, 47, 'inteiro', 'desktop'),
(644, 140, 0, 'background', NULL, 0, '2014-09-30 19:55:45', '', '', 207, 47, 'texto', 'desktop'),
(645, 140, 0, 'titulo_1', NULL, 0, '2014-09-30 19:56:01', NULL, '', 207, 46, 'texto', 'desktop'),
(646, 140, 0, 'subtitulo_1', NULL, 0, '2014-09-30 19:56:01', NULL, '', 207, 46, 'texto', 'desktop'),
(647, 140, 0, 'texto_1', NULL, 0, '2014-09-30 19:56:01', NULL, '', 207, 46, 'texto', 'desktop'),
(648, 140, 0, 'image_1', NULL, 0, '2014-09-30 19:56:01', 'newsletter_easy_x1.png', '', 207, 46, 'texto', 'desktop'),
(649, 140, 0, 'cor_1', NULL, 0, '2014-09-30 19:56:01', '', '', 207, 46, 'texto', 'desktop'),
(650, 140, 0, 'cor_2', NULL, 0, '2014-09-30 19:56:01', '', '', 207, 46, 'texto', 'desktop'),
(651, 140, 0, 'cor_3', NULL, 0, '2014-09-30 19:56:01', '', '', 207, 46, 'texto', 'desktop'),
(652, 140, 0, 'alinhamento_1', NULL, 0, '2014-09-30 19:56:01', 'left', '', 207, 46, 'texto', 'desktop'),
(653, 140, 0, 'alinhamento_2', NULL, 0, '2014-09-30 19:56:01', 'left', '', 207, 46, 'texto', 'desktop'),
(654, 140, 0, 'alinhamento_3', NULL, 0, '2014-09-30 19:56:01', 'left', '', 207, 46, 'texto', 'desktop'),
(655, 140, 0, 'margin_top', 0, 0, '2014-09-30 19:56:01', NULL, '', 207, 46, 'inteiro', 'desktop'),
(656, 140, 0, 'margin_bottom', 0, 0, '2014-09-30 19:56:01', NULL, '', 207, 46, 'inteiro', 'desktop'),
(657, 140, 0, 'padding_top', 0, 0, '2014-09-30 19:56:01', NULL, '', 207, 46, 'inteiro', 'desktop'),
(658, 140, 0, 'padding_bottom', 0, 0, '2014-09-30 19:56:01', NULL, '', 207, 46, 'inteiro', 'desktop'),
(659, 140, 0, 'background_type', 0, 0, '2014-09-30 19:56:01', NULL, '', 207, 46, 'inteiro', 'desktop'),
(660, 140, 0, 'background', NULL, 0, '2014-09-30 19:56:01', '', '', 207, 46, 'texto', 'desktop'),
(661, 140, 0, 'titulo_1', NULL, 0, '2014-09-30 19:56:20', NULL, '', 207, 45, 'texto', 'desktop'),
(662, 140, 0, 'subtitulo_1', NULL, 0, '2014-09-30 19:56:20', NULL, '', 207, 45, 'texto', 'desktop'),
(663, 140, 0, 'texto_1', NULL, 0, '2014-09-30 19:56:20', NULL, '', 207, 45, 'texto', 'desktop'),
(664, 140, 0, 'image_1', NULL, 0, '2014-09-30 19:56:20', 'mural_noticias_p3.png', '', 207, 45, 'texto', 'desktop'),
(665, 140, 0, 'cor_1', NULL, 0, '2014-09-30 19:56:20', '', '', 207, 45, 'texto', 'desktop'),
(666, 140, 0, 'cor_2', NULL, 0, '2014-09-30 19:56:20', '', '', 207, 45, 'texto', 'desktop'),
(667, 140, 0, 'cor_3', NULL, 0, '2014-09-30 19:56:20', '', '', 207, 45, 'texto', 'desktop'),
(668, 140, 0, 'alinhamento_1', NULL, 0, '2014-09-30 19:56:20', 'left', '', 207, 45, 'texto', 'desktop'),
(669, 140, 0, 'alinhamento_2', NULL, 0, '2014-09-30 19:56:20', 'left', '', 207, 45, 'texto', 'desktop'),
(670, 140, 0, 'alinhamento_3', NULL, 0, '2014-09-30 19:56:20', 'left', '', 207, 45, 'texto', 'desktop'),
(671, 140, 0, 'margin_top', 0, 0, '2014-09-30 19:56:20', NULL, '', 207, 45, 'inteiro', 'desktop'),
(672, 140, 0, 'margin_bottom', 0, 0, '2014-09-30 19:56:20', NULL, '', 207, 45, 'inteiro', 'desktop'),
(673, 140, 0, 'padding_top', 0, 0, '2014-09-30 19:56:20', NULL, '', 207, 45, 'inteiro', 'desktop'),
(674, 140, 0, 'padding_bottom', 0, 0, '2014-09-30 19:56:20', NULL, '', 207, 45, 'inteiro', 'desktop'),
(675, 140, 0, 'background_type', 0, 0, '2014-09-30 19:56:20', NULL, '', 207, 45, 'inteiro', 'desktop'),
(676, 140, 0, 'background', NULL, 0, '2014-09-30 19:56:20', '', '', 207, 45, 'texto', 'desktop'),
(677, 1, 0, 'titulo_1', NULL, 0, '2014-09-30 20:22:27', NULL, 'Você escolhe quais aplicativos deseja colocar no seu site!', 207, 53, 'texto', 'desktop'),
(678, 1, 0, 'subtitulo_1', NULL, 0, '2014-09-30 20:22:27', NULL, 'São vários componentes disponíveis para você incrementar seu site', 207, 53, 'texto', 'desktop'),
(679, 1, 0, 'texto_1', NULL, 0, '2014-09-30 20:22:27', NULL, '', 207, 53, 'texto', 'desktop'),
(680, 1, 0, 'image_1', NULL, 0, '2014-09-30 20:22:27', '', '', 207, 53, 'texto', 'desktop'),
(681, 1, 0, 'cor_1', NULL, 0, '2014-09-30 20:22:27', '', '', 207, 53, 'texto', 'desktop'),
(682, 1, 0, 'cor_2', NULL, 0, '2014-09-30 20:22:27', '#2d648f', '', 207, 53, 'texto', 'desktop'),
(683, 1, 0, 'cor_3', NULL, 0, '2014-09-30 20:22:27', '', '', 207, 53, 'texto', 'desktop'),
(684, 1, 0, 'alinhamento_1', NULL, 0, '2014-09-30 20:22:27', 'left', '', 207, 53, 'texto', 'desktop'),
(685, 1, 0, 'alinhamento_2', NULL, 0, '2014-09-30 20:22:27', 'left', '', 207, 53, 'texto', 'desktop'),
(686, 1, 0, 'alinhamento_3', NULL, 0, '2014-09-30 20:22:27', 'left', '', 207, 53, 'texto', 'desktop'),
(687, 1, 0, 'margin_top', 50, 0, '2014-09-30 20:22:27', NULL, '', 207, 53, 'inteiro', 'desktop'),
(688, 1, 0, 'margin_bottom', 20, 0, '2014-09-30 20:22:27', NULL, '', 207, 53, 'inteiro', 'desktop'),
(689, 1, 0, 'padding_top', 0, 0, '2014-09-30 20:22:27', NULL, '', 207, 53, 'inteiro', 'desktop'),
(690, 1, 0, 'padding_bottom', 0, 0, '2014-09-30 20:22:27', NULL, '', 207, 53, 'inteiro', 'desktop'),
(691, 1, 0, 'background_type', 0, 0, '2014-09-30 20:22:27', NULL, '', 207, 53, 'inteiro', 'desktop'),
(692, 1, 0, 'background', NULL, 0, '2014-09-30 20:22:27', '', '', 207, 53, 'texto', 'desktop'),
(693, 1, 0, 'alinhamento_1', NULL, 0, '2014-09-30 20:28:54', 'left', '', 216, 25, 'texto', 'desktop'),
(694, 1, 0, 'alinhamento_2', NULL, 0, '2014-09-30 20:28:54', 'left', '', 216, 25, 'texto', 'desktop'),
(695, 1, 0, 'alinhamento_3', NULL, 0, '2014-09-30 20:28:54', 'left', '', 216, 25, 'texto', 'desktop'),
(696, 1, 0, 'botao_exibe', 0, 0, '2014-10-02 21:24:48', NULL, '', 211, 24, 'inteiro', 'desktop'),
(697, 1, 0, 'titulo_1', NULL, 0, '2014-10-02 21:46:27', NULL, 'PierMail-Marketing', 207, 54, 'texto', 'desktop'),
(698, 1, 0, 'subtitulo_1', NULL, 0, '2014-10-02 21:46:27', NULL, 'Ferramenta completa de Envio e Gestão de Campanha de Email Marketing', 207, 54, 'texto', 'desktop'),
(699, 1, 0, 'texto_1', NULL, 0, '2014-10-02 21:46:27', NULL, 'O e-mail continua sendo a ferramenta de maior força na sinergia com os clientes. É a ferramenta de divulgação mais utilizada no mundo, por seu baixo custo e rápido retorno do investimento. Com a nossa ferramenta <b>PierMail </b>e o módulo de newsletter você pode criar e disparar suas campanhas de email fazendo o seu marketing digital sem complicações, pois, nós já facilitamos tudo para você!\r\n\r\nNo PierMail você poderá criar diferentes layouts com imagens, botões, links e outras elementos para enriquecer seu e-mail. Todos os layouts do emails são responsivos, preparados para os dispositivos móveis, ficando perfeito em qualquer plataforma, iOS, Android, Desktop entre outras. São vários Templates prontos para montar sua campanha de email marketing. ', 207, 54, 'texto', 'desktop'),
(700, 1, 0, 'image_1', NULL, 0, '2014-10-02 21:46:27', 'bn_piermail_z0.jpg', '', 207, 54, 'texto', 'desktop'),
(701, 1, 0, 'cor_1', NULL, 0, '2014-10-02 21:46:27', '', '', 207, 54, 'texto', 'desktop'),
(702, 1, 0, 'cor_2', NULL, 0, '2014-10-02 21:46:27', '#2075cb', '', 207, 54, 'texto', 'desktop'),
(703, 1, 0, 'cor_3', NULL, 0, '2014-10-02 21:46:27', '#585e65', '', 207, 54, 'texto', 'desktop'),
(704, 1, 0, 'alinhamento_1', NULL, 0, '2014-10-02 21:46:27', 'left', '', 207, 54, 'texto', 'desktop'),
(705, 1, 0, 'alinhamento_2', NULL, 0, '2014-10-02 21:46:27', 'left', '', 207, 54, 'texto', 'desktop'),
(706, 1, 0, 'alinhamento_3', NULL, 0, '2014-10-02 21:46:27', 'left', '', 207, 54, 'texto', 'desktop'),
(707, 1, 0, 'margin_top', 40, 0, '2014-10-02 21:46:27', NULL, '', 207, 54, 'inteiro', 'desktop'),
(708, 1, 0, 'margin_bottom', 0, 0, '2014-10-02 21:46:27', NULL, '', 207, 54, 'inteiro', 'desktop'),
(709, 1, 0, 'padding_top', 0, 0, '2014-10-02 21:46:28', NULL, '', 207, 54, 'inteiro', 'desktop'),
(710, 1, 0, 'padding_bottom', 0, 0, '2014-10-02 21:46:28', NULL, '', 207, 54, 'inteiro', 'desktop'),
(711, 1, 0, 'background_type', 0, 0, '2014-10-02 21:46:28', NULL, '', 207, 54, 'inteiro', 'desktop'),
(712, 1, 0, 'background', NULL, 0, '2014-10-02 21:46:28', '', '', 207, 54, 'texto', 'desktop'),
(713, 1, 0, 'qtd_blocos', 0, 0, '2014-10-02 22:34:15', NULL, '', 212, 57, 'inteiro', 'desktop'),
(714, 1, 0, 'titulo_1', NULL, 0, '2014-10-02 22:34:15', NULL, 'Topo', 212, 57, 'texto', 'desktop'),
(715, 1, 0, 'subtitulo_1', NULL, 0, '2014-10-02 22:34:15', NULL, 'fgdrbh', 212, 57, 'texto', 'desktop'),
(716, 1, 0, 'texto_1', NULL, 0, '2014-10-02 22:34:15', NULL, 'erhbeartjjnmbhrt srtj wryju rwt rw6uet tuy q5uy qet yq5y ', 212, 57, 'texto', 'desktop'),
(717, 1, 0, 'titulo_2', NULL, 0, '2014-10-02 22:34:15', NULL, '', 212, 57, 'texto', 'desktop'),
(718, 1, 0, 'subtitulo_2', NULL, 0, '2014-10-02 22:34:15', NULL, '', 212, 57, 'texto', 'desktop'),
(719, 1, 0, 'texto_2', NULL, 0, '2014-10-02 22:34:15', NULL, '', 212, 57, 'texto', 'desktop'),
(720, 1, 0, 'titulo_3', NULL, 0, '2014-10-02 22:34:15', NULL, '', 212, 57, 'texto', 'desktop'),
(721, 1, 0, 'subtitulo_3', NULL, 0, '2014-10-02 22:34:15', NULL, '', 212, 57, 'texto', 'desktop'),
(722, 1, 0, 'texto_3', NULL, 0, '2014-10-02 22:34:15', NULL, '', 212, 57, 'texto', 'desktop'),
(723, 1, 0, 'titulo_4', NULL, 0, '2014-10-02 22:34:15', NULL, '', 212, 57, 'texto', 'desktop'),
(724, 1, 0, 'subtitulo_4', NULL, 0, '2014-10-02 22:34:15', NULL, '', 212, 57, 'texto', 'desktop'),
(725, 1, 0, 'texto_4', NULL, 0, '2014-10-02 22:34:15', NULL, '', 212, 57, 'texto', 'desktop'),
(726, 1, 0, 'image_type_1', 1, 0, '2014-10-02 22:34:15', NULL, '', 212, 57, 'inteiro', 'desktop'),
(727, 1, 0, 'image_1', NULL, 0, '2014-10-02 22:34:15', 'f_853', '', 212, 57, 'image', 'desktop'),
(728, 1, 0, 'image_type_2', 1, 0, '2014-10-02 22:34:15', NULL, '', 212, 57, 'inteiro', 'desktop'),
(729, 1, 0, 'image_2', NULL, 0, '2014-10-02 22:34:15', '', '', 212, 57, 'image', 'desktop'),
(730, 1, 0, 'image_type_3', 1, 0, '2014-10-02 22:34:15', NULL, '', 212, 57, 'inteiro', 'desktop'),
(731, 1, 0, 'image_3', NULL, 0, '2014-10-02 22:34:15', '', '', 212, 57, 'image', 'desktop'),
(732, 1, 0, 'image_type_4', 1, 0, '2014-10-02 22:34:15', NULL, '', 212, 57, 'inteiro', 'desktop'),
(733, 1, 0, 'image_4', NULL, 0, '2014-10-02 22:34:15', '', '', 212, 57, 'image', 'desktop'),
(734, 1, 0, 'item1_cor_1', NULL, 0, '2014-10-02 22:34:15', '', '', 212, 57, 'texto', 'desktop'),
(735, 1, 0, 'item1_alinhamento_1', NULL, 0, '2014-10-02 22:34:15', 'left', '', 212, 57, 'texto', 'desktop'),
(736, 1, 0, 'item1_cor_2', NULL, 0, '2014-10-02 22:34:15', '', '', 212, 57, 'texto', 'desktop'),
(737, 1, 0, 'item1_alinhamento_2', NULL, 0, '2014-10-02 22:34:15', 'left', '', 212, 57, 'texto', 'desktop'),
(738, 1, 0, 'item1_cor_3', NULL, 0, '2014-10-02 22:34:15', '', '', 212, 57, 'texto', 'desktop'),
(739, 1, 0, 'item1_alinhamento_3', NULL, 0, '2014-10-02 22:34:15', 'left', '', 212, 57, 'texto', 'desktop'),
(740, 1, 0, 'item2_cor_1', NULL, 0, '2014-10-02 22:34:15', '', '', 212, 57, 'texto', 'desktop'),
(741, 1, 0, 'item2_alinhamento_1', NULL, 0, '2014-10-02 22:34:15', 'left', '', 212, 57, 'texto', 'desktop'),
(742, 1, 0, 'item2_cor_2', NULL, 0, '2014-10-02 22:34:15', '', '', 212, 57, 'texto', 'desktop'),
(743, 1, 0, 'item2_alinhamento_2', NULL, 0, '2014-10-02 22:34:15', 'left', '', 212, 57, 'texto', 'desktop'),
(744, 1, 0, 'item2_cor_3', NULL, 0, '2014-10-02 22:34:15', '', '', 212, 57, 'texto', 'desktop'),
(745, 1, 0, 'item2_alinhamento_3', NULL, 0, '2014-10-02 22:34:15', 'left', '', 212, 57, 'texto', 'desktop'),
(746, 1, 0, 'item3_cor_1', NULL, 0, '2014-10-02 22:34:15', '', '', 212, 57, 'texto', 'desktop'),
(747, 1, 0, 'item3_alinhamento_1', NULL, 0, '2014-10-02 22:34:15', 'left', '', 212, 57, 'texto', 'desktop'),
(748, 1, 0, 'item3_cor_2', NULL, 0, '2014-10-02 22:34:15', '', '', 212, 57, 'texto', 'desktop'),
(749, 1, 0, 'item3_alinhamento_2', NULL, 0, '2014-10-02 22:34:15', 'left', '', 212, 57, 'texto', 'desktop'),
(750, 1, 0, 'item3_cor_3', NULL, 0, '2014-10-02 22:34:15', '', '', 212, 57, 'texto', 'desktop'),
(751, 1, 0, 'item3_alinhamento_3', NULL, 0, '2014-10-02 22:34:15', 'left', '', 212, 57, 'texto', 'desktop'),
(752, 1, 0, 'item4_cor_1', NULL, 0, '2014-10-02 22:34:15', '', '', 212, 57, 'texto', 'desktop'),
(753, 1, 0, 'item4_alinhamento_1', NULL, 0, '2014-10-02 22:34:15', 'left', '', 212, 57, 'texto', 'desktop'),
(754, 1, 0, 'item4_cor_2', NULL, 0, '2014-10-02 22:34:15', '', '', 212, 57, 'texto', 'desktop'),
(755, 1, 0, 'item4_alinhamento_2', NULL, 0, '2014-10-02 22:34:15', 'left', '', 212, 57, 'texto', 'desktop'),
(756, 1, 0, 'item4_cor_3', NULL, 0, '2014-10-02 22:34:15', '', '', 212, 57, 'texto', 'desktop'),
(757, 1, 0, 'item4_alinhamento_3', NULL, 0, '2014-10-02 22:34:15', 'left', '', 212, 57, 'texto', 'desktop'),
(758, 1, 0, 'botao_exibe', 0, 0, '2014-10-02 22:34:15', NULL, '', 212, 57, 'inteiro', 'desktop'),
(759, 1, 0, 'margin_top', 0, 0, '2014-10-02 22:34:15', NULL, '', 212, 57, 'inteiro', 'desktop'),
(760, 1, 0, 'margin_bottom', 0, 0, '2014-10-02 22:34:15', NULL, '', 212, 57, 'inteiro', 'desktop'),
(761, 1, 0, 'background_type', 0, 0, '2014-10-02 22:34:15', NULL, '', 212, 57, 'inteiro', 'desktop'),
(762, 1, 0, 'background', NULL, 0, '2014-10-02 22:34:15', '', '', 212, 57, 'texto', 'desktop'),
(763, 1, 0, 'titulo_1', NULL, 0, '2014-10-02 22:45:27', NULL, '', 242, 58, 'texto', 'desktop'),
(764, 1, 0, 'subtitulo_1', NULL, 0, '2014-10-02 22:45:27', NULL, '', 242, 58, 'texto', 'desktop'),
(765, 1, 0, 'texto_1', NULL, 0, '2014-10-02 22:45:27', NULL, '', 242, 58, 'texto', 'desktop'),
(766, 1, 0, 'cor_1', NULL, 0, '2014-10-02 22:45:27', '', '', 242, 58, 'texto', 'desktop'),
(767, 1, 0, 'cor_2', NULL, 0, '2014-10-02 22:45:27', '', '', 242, 58, 'texto', 'desktop'),
(768, 1, 0, 'cor_3', NULL, 0, '2014-10-02 22:45:27', '', '', 242, 58, 'texto', 'desktop'),
(769, 1, 0, 'galeria', NULL, 0, '2014-10-02 22:45:27', '93-107', '', 242, 58, 'texto', 'desktop'),
(770, 1, 0, 'botao_exibe', 0, 0, '2014-10-02 22:45:27', NULL, '', 242, 58, 'inteiro', 'desktop'),
(771, 1, 0, 'titulo_exibe', 0, 0, '2014-10-02 22:45:28', NULL, '', 242, 58, 'inteiro', 'desktop'),
(772, 1, 0, 'margin_top', 20, 0, '2014-10-02 22:45:28', NULL, '', 242, 58, 'inteiro', 'desktop'),
(773, 1, 0, 'margin_bottom', 20, 0, '2014-10-02 22:45:28', NULL, '', 242, 58, 'inteiro', 'desktop'),
(774, 1, 0, 'background_type', 0, 0, '2014-10-02 22:45:28', NULL, '', 242, 58, 'inteiro', 'desktop'),
(775, 1, 0, 'background', NULL, 0, '2014-10-02 22:45:28', '', '', 242, 58, 'texto', 'desktop'),
(776, 140, 0, 'titulo_1', NULL, 0, '2014-10-03 02:07:41', NULL, '', 207, 60, 'texto', 'desktop'),
(777, 140, 0, 'subtitulo_1', NULL, 0, '2014-10-03 02:07:41', NULL, '', 207, 60, 'texto', 'desktop'),
(778, 140, 0, 'texto_1', NULL, 0, '2014-10-03 02:07:41', NULL, '', 207, 60, 'texto', 'desktop'),
(779, 140, 0, 'image_1', NULL, 0, '2014-10-03 02:07:41', 'block_image_text_left_v5.png', '', 207, 60, 'texto', 'desktop'),
(780, 140, 0, 'cor_1', NULL, 0, '2014-10-03 02:07:41', '', '', 207, 60, 'texto', 'desktop'),
(781, 140, 0, 'cor_2', NULL, 0, '2014-10-03 02:07:41', '', '', 207, 60, 'texto', 'desktop'),
(782, 140, 0, 'cor_3', NULL, 0, '2014-10-03 02:07:41', '', '', 207, 60, 'texto', 'desktop'),
(783, 140, 0, 'alinhamento_1', NULL, 0, '2014-10-03 02:07:41', 'center', '', 207, 60, 'texto', 'desktop'),
(784, 140, 0, 'alinhamento_2', NULL, 0, '2014-10-03 02:07:42', 'center', '', 207, 60, 'texto', 'desktop'),
(785, 140, 0, 'alinhamento_3', NULL, 0, '2014-10-03 02:07:42', 'left', '', 207, 60, 'texto', 'desktop'),
(786, 140, 0, 'margin_top', 20, 0, '2014-10-03 02:07:42', NULL, '', 207, 60, 'inteiro', 'desktop'),
(787, 140, 0, 'margin_bottom', 20, 0, '2014-10-03 02:07:42', NULL, '', 207, 60, 'inteiro', 'desktop'),
(788, 140, 0, 'padding_top', 0, 0, '2014-10-03 02:07:42', NULL, '', 207, 60, 'inteiro', 'desktop'),
(789, 140, 0, 'padding_bottom', 0, 0, '2014-10-03 02:07:42', NULL, '', 207, 60, 'inteiro', 'desktop'),
(790, 140, 0, 'background_type', 0, 0, '2014-10-03 02:07:42', NULL, '', 207, 60, 'inteiro', 'desktop'),
(791, 140, 0, 'background', NULL, 0, '2014-10-03 02:07:42', '', '', 207, 60, 'texto', 'desktop'),
(792, 140, 0, 'titulo_1', NULL, 0, '2014-10-03 02:10:37', NULL, '', 207, 61, 'texto', 'desktop'),
(793, 140, 0, 'subtitulo_1', NULL, 0, '2014-10-03 02:10:37', NULL, '', 207, 61, 'texto', 'desktop'),
(794, 140, 0, 'texto_1', NULL, 0, '2014-10-03 02:10:37', NULL, '', 207, 61, 'texto', 'desktop'),
(795, 140, 0, 'image_1', NULL, 0, '2014-10-03 02:10:37', 'artigo_new_orleans_p6.png', '', 207, 61, 'texto', 'desktop'),
(796, 140, 0, 'cor_1', NULL, 0, '2014-10-03 02:10:37', '', '', 207, 61, 'texto', 'desktop'),
(797, 140, 0, 'cor_2', NULL, 0, '2014-10-03 02:10:37', '', '', 207, 61, 'texto', 'desktop'),
(798, 140, 0, 'cor_3', NULL, 0, '2014-10-03 02:10:37', '', '', 207, 61, 'texto', 'desktop'),
(799, 140, 0, 'alinhamento_1', NULL, 0, '2014-10-03 02:10:37', 'left', '', 207, 61, 'texto', 'desktop'),
(800, 140, 0, 'alinhamento_2', NULL, 0, '2014-10-03 02:10:37', 'left', '', 207, 61, 'texto', 'desktop'),
(801, 140, 0, 'alinhamento_3', NULL, 0, '2014-10-03 02:10:37', 'left', '', 207, 61, 'texto', 'desktop'),
(802, 140, 0, 'margin_top', 0, 0, '2014-10-03 02:10:37', NULL, '', 207, 61, 'inteiro', 'desktop'),
(803, 140, 0, 'margin_bottom', 0, 0, '2014-10-03 02:10:37', NULL, '', 207, 61, 'inteiro', 'desktop'),
(804, 140, 0, 'padding_top', 0, 0, '2014-10-03 02:10:37', NULL, '', 207, 61, 'inteiro', 'desktop'),
(805, 140, 0, 'padding_bottom', 0, 0, '2014-10-03 02:10:37', NULL, '', 207, 61, 'inteiro', 'desktop'),
(806, 140, 0, 'background_type', 0, 0, '2014-10-03 02:10:37', NULL, '', 207, 61, 'inteiro', 'desktop'),
(807, 140, 0, 'background', NULL, 0, '2014-10-03 02:10:37', '', '', 207, 61, 'texto', 'desktop'),
(808, 140, 0, 'titulo_1', NULL, 0, '2014-10-03 02:17:03', NULL, '', 207, 69, 'texto', 'desktop'),
(809, 140, 0, 'subtitulo_1', NULL, 0, '2014-10-03 02:17:03', NULL, '', 207, 69, 'texto', 'desktop'),
(810, 140, 0, 'texto_1', NULL, 0, '2014-10-03 02:17:03', NULL, '', 207, 69, 'texto', 'desktop'),
(811, 140, 0, 'image_1', NULL, 0, '2014-10-03 02:17:03', 'email_supernova_c6.png', '', 207, 69, 'texto', 'desktop'),
(812, 140, 0, 'cor_1', NULL, 0, '2014-10-03 02:17:03', '', '', 207, 69, 'texto', 'desktop'),
(813, 140, 0, 'cor_2', NULL, 0, '2014-10-03 02:17:03', '', '', 207, 69, 'texto', 'desktop'),
(814, 140, 0, 'cor_3', NULL, 0, '2014-10-03 02:17:03', '', '', 207, 69, 'texto', 'desktop'),
(815, 140, 0, 'alinhamento_1', NULL, 0, '2014-10-03 02:17:03', 'left', '', 207, 69, 'texto', 'desktop'),
(816, 140, 0, 'alinhamento_2', NULL, 0, '2014-10-03 02:17:03', 'left', '', 207, 69, 'texto', 'desktop'),
(817, 140, 0, 'alinhamento_3', NULL, 0, '2014-10-03 02:17:03', 'left', '', 207, 69, 'texto', 'desktop'),
(818, 140, 0, 'margin_top', 0, 0, '2014-10-03 02:17:03', NULL, '', 207, 69, 'inteiro', 'desktop'),
(819, 140, 0, 'margin_bottom', 0, 0, '2014-10-03 02:17:03', NULL, '', 207, 69, 'inteiro', 'desktop'),
(820, 140, 0, 'padding_top', 0, 0, '2014-10-03 02:17:03', NULL, '', 207, 69, 'inteiro', 'desktop'),
(821, 140, 0, 'padding_bottom', 0, 0, '2014-10-03 02:17:03', NULL, '', 207, 69, 'inteiro', 'desktop'),
(822, 140, 0, 'background_type', 0, 0, '2014-10-03 02:17:03', NULL, '', 207, 69, 'inteiro', 'desktop'),
(823, 140, 0, 'background', NULL, 0, '2014-10-03 02:17:03', '', '', 207, 69, 'texto', 'desktop'),
(824, 140, 0, 'titulo_1', NULL, 0, '2014-10-03 02:18:17', NULL, '', 207, 68, 'texto', 'desktop'),
(825, 140, 0, 'subtitulo_1', NULL, 0, '2014-10-03 02:18:17', NULL, '', 207, 68, 'texto', 'desktop'),
(826, 140, 0, 'texto_1', NULL, 0, '2014-10-03 02:18:17', NULL, '', 207, 68, 'texto', 'desktop'),
(827, 140, 0, 'image_1', NULL, 0, '2014-10-03 02:18:17', 'topo_detalhe_d6.png', '', 207, 68, 'texto', 'desktop'),
(828, 140, 0, 'cor_1', NULL, 0, '2014-10-03 02:18:17', '', '', 207, 68, 'texto', 'desktop'),
(829, 140, 0, 'cor_2', NULL, 0, '2014-10-03 02:18:17', '', '', 207, 68, 'texto', 'desktop'),
(830, 140, 0, 'cor_3', NULL, 0, '2014-10-03 02:18:17', '', '', 207, 68, 'texto', 'desktop'),
(831, 140, 0, 'alinhamento_1', NULL, 0, '2014-10-03 02:18:17', 'left', '', 207, 68, 'texto', 'desktop'),
(832, 140, 0, 'alinhamento_2', NULL, 0, '2014-10-03 02:18:17', 'left', '', 207, 68, 'texto', 'desktop'),
(833, 140, 0, 'alinhamento_3', NULL, 0, '2014-10-03 02:18:17', 'left', '', 207, 68, 'texto', 'desktop'),
(834, 140, 0, 'margin_top', 0, 0, '2014-10-03 02:18:17', NULL, '', 207, 68, 'inteiro', 'desktop'),
(835, 140, 0, 'margin_bottom', 0, 0, '2014-10-03 02:18:17', NULL, '', 207, 68, 'inteiro', 'desktop'),
(836, 140, 0, 'padding_top', 0, 0, '2014-10-03 02:18:17', NULL, '', 207, 68, 'inteiro', 'desktop'),
(837, 140, 0, 'padding_bottom', 0, 0, '2014-10-03 02:18:17', NULL, '', 207, 68, 'inteiro', 'desktop'),
(838, 140, 0, 'background_type', 0, 0, '2014-10-03 02:18:17', NULL, '', 207, 68, 'inteiro', 'desktop'),
(839, 140, 0, 'background', NULL, 0, '2014-10-03 02:18:17', '', '', 207, 68, 'texto', 'desktop'),
(840, 140, 0, 'titulo_1', NULL, 0, '2014-10-03 02:19:59', NULL, '', 207, 66, 'texto', 'desktop'),
(841, 140, 0, 'subtitulo_1', NULL, 0, '2014-10-03 02:19:59', NULL, '', 207, 66, 'texto', 'desktop'),
(842, 140, 0, 'texto_1', NULL, 0, '2014-10-03 02:19:59', NULL, '', 207, 66, 'texto', 'desktop'),
(843, 140, 0, 'image_1', NULL, 0, '2014-10-03 02:19:59', 'dividers_d1.png', '', 207, 66, 'texto', 'desktop'),
(844, 140, 0, 'cor_1', NULL, 0, '2014-10-03 02:19:59', '', '', 207, 66, 'texto', 'desktop'),
(845, 140, 0, 'cor_2', NULL, 0, '2014-10-03 02:19:59', '', '', 207, 66, 'texto', 'desktop'),
(846, 140, 0, 'cor_3', NULL, 0, '2014-10-03 02:19:59', '', '', 207, 66, 'texto', 'desktop'),
(847, 140, 0, 'alinhamento_1', NULL, 0, '2014-10-03 02:19:59', 'left', '', 207, 66, 'texto', 'desktop'),
(848, 140, 0, 'alinhamento_2', NULL, 0, '2014-10-03 02:19:59', 'left', '', 207, 66, 'texto', 'desktop'),
(849, 140, 0, 'alinhamento_3', NULL, 0, '2014-10-03 02:19:59', 'left', '', 207, 66, 'texto', 'desktop'),
(850, 140, 0, 'margin_top', 0, 0, '2014-10-03 02:19:59', NULL, '', 207, 66, 'inteiro', 'desktop'),
(851, 140, 0, 'margin_bottom', 0, 0, '2014-10-03 02:19:59', NULL, '', 207, 66, 'inteiro', 'desktop'),
(852, 140, 0, 'padding_top', 0, 0, '2014-10-03 02:19:59', NULL, '', 207, 66, 'inteiro', 'desktop'),
(853, 140, 0, 'padding_bottom', 0, 0, '2014-10-03 02:19:59', NULL, '', 207, 66, 'inteiro', 'desktop'),
(854, 140, 0, 'background_type', 0, 0, '2014-10-03 02:19:59', NULL, '', 207, 66, 'inteiro', 'desktop'),
(855, 140, 0, 'background', NULL, 0, '2014-10-03 02:19:59', '', '', 207, 66, 'texto', 'desktop'),
(856, 140, 0, 'titulo_1', NULL, 0, '2014-10-03 02:20:58', NULL, '', 207, 65, 'texto', 'desktop'),
(857, 140, 0, 'subtitulo_1', NULL, 0, '2014-10-03 02:20:58', NULL, '', 207, 65, 'texto', 'desktop'),
(858, 140, 0, 'texto_1', NULL, 0, '2014-10-03 02:20:58', NULL, '', 207, 65, 'texto', 'desktop'),
(859, 140, 0, 'image_1', NULL, 0, '2014-10-03 02:20:58', 'rodape_simples_b9.png', '', 207, 65, 'texto', 'desktop'),
(860, 140, 0, 'cor_1', NULL, 0, '2014-10-03 02:20:58', '', '', 207, 65, 'texto', 'desktop'),
(861, 140, 0, 'cor_2', NULL, 0, '2014-10-03 02:20:58', '', '', 207, 65, 'texto', 'desktop'),
(862, 140, 0, 'cor_3', NULL, 0, '2014-10-03 02:20:58', '', '', 207, 65, 'texto', 'desktop'),
(863, 140, 0, 'alinhamento_1', NULL, 0, '2014-10-03 02:20:58', 'left', '', 207, 65, 'texto', 'desktop'),
(864, 140, 0, 'alinhamento_2', NULL, 0, '2014-10-03 02:20:58', 'left', '', 207, 65, 'texto', 'desktop'),
(865, 140, 0, 'alinhamento_3', NULL, 0, '2014-10-03 02:20:58', 'left', '', 207, 65, 'texto', 'desktop'),
(866, 140, 0, 'margin_top', 0, 0, '2014-10-03 02:20:58', NULL, '', 207, 65, 'inteiro', 'desktop'),
(867, 140, 0, 'margin_bottom', 0, 0, '2014-10-03 02:20:58', NULL, '', 207, 65, 'inteiro', 'desktop'),
(868, 140, 0, 'padding_top', 0, 0, '2014-10-03 02:20:58', NULL, '', 207, 65, 'inteiro', 'desktop'),
(869, 140, 0, 'padding_bottom', 0, 0, '2014-10-03 02:20:58', NULL, '', 207, 65, 'inteiro', 'desktop'),
(870, 140, 0, 'background_type', 0, 0, '2014-10-03 02:20:58', NULL, '', 207, 65, 'inteiro', 'desktop'),
(871, 140, 0, 'background', NULL, 0, '2014-10-03 02:20:58', '', '', 207, 65, 'texto', 'desktop'),
(872, 140, 0, 'titulo_1', NULL, 0, '2014-10-03 02:22:09', NULL, '', 207, 64, 'texto', 'desktop'),
(873, 140, 0, 'subtitulo_1', NULL, 0, '2014-10-03 02:22:09', NULL, '', 207, 64, 'texto', 'desktop'),
(874, 140, 0, 'texto_1', NULL, 0, '2014-10-03 02:22:09', NULL, '', 207, 64, 'texto', 'desktop'),
(875, 140, 0, 'image_1', NULL, 0, '2014-10-03 02:22:09', 'topo_simples_b6.png', '', 207, 64, 'texto', 'desktop'),
(876, 140, 0, 'cor_1', NULL, 0, '2014-10-03 02:22:09', '', '', 207, 64, 'texto', 'desktop'),
(877, 140, 0, 'cor_2', NULL, 0, '2014-10-03 02:22:09', '', '', 207, 64, 'texto', 'desktop'),
(878, 140, 0, 'cor_3', NULL, 0, '2014-10-03 02:22:09', '', '', 207, 64, 'texto', 'desktop'),
(879, 140, 0, 'alinhamento_1', NULL, 0, '2014-10-03 02:22:09', 'left', '', 207, 64, 'texto', 'desktop'),
(880, 140, 0, 'alinhamento_2', NULL, 0, '2014-10-03 02:22:09', 'left', '', 207, 64, 'texto', 'desktop'),
(881, 140, 0, 'alinhamento_3', NULL, 0, '2014-10-03 02:22:09', 'left', '', 207, 64, 'texto', 'desktop'),
(882, 140, 0, 'margin_top', 0, 0, '2014-10-03 02:22:09', NULL, '', 207, 64, 'inteiro', 'desktop'),
(883, 140, 0, 'margin_bottom', 0, 0, '2014-10-03 02:22:09', NULL, '', 207, 64, 'inteiro', 'desktop'),
(884, 140, 0, 'padding_top', 0, 0, '2014-10-03 02:22:09', NULL, '', 207, 64, 'inteiro', 'desktop'),
(885, 140, 0, 'padding_bottom', 0, 0, '2014-10-03 02:22:09', NULL, '', 207, 64, 'inteiro', 'desktop'),
(886, 140, 0, 'background_type', 0, 0, '2014-10-03 02:22:09', NULL, '', 207, 64, 'inteiro', 'desktop'),
(887, 140, 0, 'background', NULL, 0, '2014-10-03 02:22:09', '', '', 207, 64, 'texto', 'desktop');
INSERT INTO `paginas_attribute` (`id`, `id_pagina`, `user_id`, `name`, `inteiro`, `number`, `estampa`, `texto`, `descricao`, `id_componente`, `id_row`, `tipo`, `plataforma`) VALUES
(888, 140, 0, 'titulo_1', NULL, 0, '2014-10-03 02:22:38', NULL, '', 207, 63, 'texto', 'desktop'),
(889, 140, 0, 'subtitulo_1', NULL, 0, '2014-10-03 02:22:38', NULL, '', 207, 63, 'texto', 'desktop'),
(890, 140, 0, 'texto_1', NULL, 0, '2014-10-03 02:22:38', NULL, '', 207, 63, 'texto', 'desktop'),
(891, 140, 0, 'image_1', NULL, 0, '2014-10-03 02:22:38', 'topo_tarja_r9.png', '', 207, 63, 'texto', 'desktop'),
(892, 140, 0, 'cor_1', NULL, 0, '2014-10-03 02:22:38', '', '', 207, 63, 'texto', 'desktop'),
(893, 140, 0, 'cor_2', NULL, 0, '2014-10-03 02:22:38', '', '', 207, 63, 'texto', 'desktop'),
(894, 140, 0, 'cor_3', NULL, 0, '2014-10-03 02:22:38', '', '', 207, 63, 'texto', 'desktop'),
(895, 140, 0, 'alinhamento_1', NULL, 0, '2014-10-03 02:22:38', 'left', '', 207, 63, 'texto', 'desktop'),
(896, 140, 0, 'alinhamento_2', NULL, 0, '2014-10-03 02:22:38', 'left', '', 207, 63, 'texto', 'desktop'),
(897, 140, 0, 'alinhamento_3', NULL, 0, '2014-10-03 02:22:38', 'left', '', 207, 63, 'texto', 'desktop'),
(898, 140, 0, 'margin_top', 0, 0, '2014-10-03 02:22:38', NULL, '', 207, 63, 'inteiro', 'desktop'),
(899, 140, 0, 'margin_bottom', 0, 0, '2014-10-03 02:22:38', NULL, '', 207, 63, 'inteiro', 'desktop'),
(900, 140, 0, 'padding_top', 0, 0, '2014-10-03 02:22:38', NULL, '', 207, 63, 'inteiro', 'desktop'),
(901, 140, 0, 'padding_bottom', 0, 0, '2014-10-03 02:22:38', NULL, '', 207, 63, 'inteiro', 'desktop'),
(902, 140, 0, 'background_type', 0, 0, '2014-10-03 02:22:38', NULL, '', 207, 63, 'inteiro', 'desktop'),
(903, 140, 0, 'background', NULL, 0, '2014-10-03 02:22:38', '', '', 207, 63, 'texto', 'desktop'),
(904, 140, 0, 'titulo_1', NULL, 0, '2014-10-03 16:00:08', NULL, '', 207, 67, 'texto', 'desktop'),
(905, 140, 0, 'subtitulo_1', NULL, 0, '2014-10-03 16:00:08', NULL, '', 207, 67, 'texto', 'desktop'),
(906, 140, 0, 'texto_1', NULL, 0, '2014-10-03 16:00:08', NULL, '', 207, 67, 'texto', 'desktop'),
(907, 140, 0, 'image_1', NULL, 0, '2014-10-03 16:00:08', 'produtos_venezza_w0.png', '', 207, 67, 'texto', 'desktop'),
(908, 140, 0, 'cor_1', NULL, 0, '2014-10-03 16:00:08', '', '', 207, 67, 'texto', 'desktop'),
(909, 140, 0, 'cor_2', NULL, 0, '2014-10-03 16:00:08', '', '', 207, 67, 'texto', 'desktop'),
(910, 140, 0, 'cor_3', NULL, 0, '2014-10-03 16:00:08', '', '', 207, 67, 'texto', 'desktop'),
(911, 140, 0, 'alinhamento_1', NULL, 0, '2014-10-03 16:00:08', 'left', '', 207, 67, 'texto', 'desktop'),
(912, 140, 0, 'alinhamento_2', NULL, 0, '2014-10-03 16:00:08', 'left', '', 207, 67, 'texto', 'desktop'),
(913, 140, 0, 'alinhamento_3', NULL, 0, '2014-10-03 16:00:08', 'left', '', 207, 67, 'texto', 'desktop'),
(914, 140, 0, 'margin_top', 0, 0, '2014-10-03 16:00:08', NULL, '', 207, 67, 'inteiro', 'desktop'),
(915, 140, 0, 'margin_bottom', 0, 0, '2014-10-03 16:00:08', NULL, '', 207, 67, 'inteiro', 'desktop'),
(916, 140, 0, 'padding_top', 0, 0, '2014-10-03 16:00:08', NULL, '', 207, 67, 'inteiro', 'desktop'),
(917, 140, 0, 'padding_bottom', 0, 0, '2014-10-03 16:00:08', NULL, '', 207, 67, 'inteiro', 'desktop'),
(918, 140, 0, 'background_type', 0, 0, '2014-10-03 16:00:08', NULL, '', 207, 67, 'inteiro', 'desktop'),
(919, 140, 0, 'background', NULL, 0, '2014-10-03 16:00:08', '', '', 207, 67, 'texto', 'desktop'),
(920, 142, 0, 'titulo_1', NULL, 0, '2014-10-08 23:43:20', NULL, 'PierMail-Marketing', 207, 70, 'texto', 'desktop'),
(921, 142, 0, 'subtitulo_1', NULL, 0, '2014-10-08 23:43:20', NULL, 'Ferramenta completa de Envio e Gestão de Campanha de Email Marketing', 207, 70, 'texto', 'desktop'),
(922, 142, 0, 'texto_1', NULL, 0, '2014-10-08 23:43:20', NULL, 'O e-mail continua sendo a ferramenta de maior força na sinergia com os clientes. É a ferramenta de divulgação mais utilizada no mundo, por seu baixo custo e rápido retorno do investimento. \r\n\r\nCom a nossa ferramenta <b>PierMail </b>e o módulo de newsletter você pode criar e disparar suas campanhas de email fazendo o seu marketing digital sem complicações, pois, nós já facilitamos tudo para você!\r\n\r\nNo PierMail você poderá criar diferentes layouts com imagens, botões, links e outras elementos para enriquecer seu e-mail. Todos os layouts do emails são responsivos, preparados para os dispositivos móveis, ficando perfeito em qualquer plataforma, iOS, Android, Desktop entre outras. São vários Templates prontos para montar sua campanha de email marketing. ', 207, 70, 'texto', 'desktop'),
(923, 142, 0, 'image_1', NULL, 0, '2014-10-08 23:43:20', 'piermail_e9.png', '', 207, 70, 'texto', 'desktop'),
(924, 142, 0, 'cor_1', NULL, 0, '2014-10-08 23:43:20', 'FFFFFF', '', 207, 70, 'texto', 'desktop'),
(925, 142, 0, 'cor_2', NULL, 0, '2014-10-08 23:43:20', 'FFFFFF', '', 207, 70, 'texto', 'desktop'),
(926, 142, 0, 'cor_3', NULL, 0, '2014-10-08 23:43:20', 'FFFFFF', '', 207, 70, 'texto', 'desktop'),
(927, 142, 0, 'alinhamento_1', NULL, 0, '2014-10-08 23:43:20', 'center', '', 207, 70, 'texto', 'desktop'),
(928, 142, 0, 'alinhamento_2', NULL, 0, '2014-10-08 23:43:20', 'center', '', 207, 70, 'texto', 'desktop'),
(929, 142, 0, 'alinhamento_3', NULL, 0, '2014-10-08 23:43:20', 'left', '', 207, 70, 'texto', 'desktop'),
(930, 142, 0, 'margin_top', 20, 0, '2014-10-08 23:43:20', NULL, '', 207, 70, 'inteiro', 'desktop'),
(931, 142, 0, 'margin_bottom', 30, 0, '2014-10-08 23:43:20', NULL, '', 207, 70, 'inteiro', 'desktop'),
(932, 142, 0, 'padding_top', 20, 0, '2014-10-08 23:43:20', NULL, '', 207, 70, 'inteiro', 'desktop'),
(933, 142, 0, 'padding_bottom', 0, 0, '2014-10-08 23:43:20', NULL, '', 207, 70, 'inteiro', 'desktop'),
(934, 142, 0, 'is_full', 0, 0, '2014-10-08 23:43:20', NULL, '', 207, 70, 'inteiro', 'desktop'),
(935, 142, 0, 'background_type', 0, 0, '2014-10-08 23:43:20', NULL, '', 207, 70, 'inteiro', 'desktop'),
(936, 142, 0, 'background', NULL, 0, '2014-10-08 23:43:20', '', '', 207, 70, 'texto', 'desktop'),
(937, 142, 0, 'titulo_1', NULL, 0, '2014-10-08 23:46:08', NULL, 'Diferentes layouts com imagens, botões, links', 207, 72, 'texto', 'desktop'),
(938, 142, 0, 'subtitulo_1', NULL, 0, '2014-10-08 23:46:08', NULL, 'Para o topo do seu mailing hoje existe 3 tipos diferentes para você escolher ', 207, 72, 'texto', 'desktop'),
(939, 142, 0, 'texto_1', NULL, 0, '2014-10-08 23:46:08', NULL, '', 207, 72, 'texto', 'desktop'),
(940, 142, 0, 'image_1', NULL, 0, '2014-10-08 23:46:08', 'topo_tarja_r9.png', '', 207, 72, 'texto', 'desktop'),
(941, 142, 0, 'cor_1', NULL, 0, '2014-10-08 23:46:08', '', '', 207, 72, 'texto', 'desktop'),
(942, 142, 0, 'cor_2', NULL, 0, '2014-10-08 23:46:08', '', '', 207, 72, 'texto', 'desktop'),
(943, 142, 0, 'cor_3', NULL, 0, '2014-10-08 23:46:08', '', '', 207, 72, 'texto', 'desktop'),
(944, 142, 0, 'alinhamento_1', NULL, 0, '2014-10-08 23:46:08', 'center', '', 207, 72, 'texto', 'desktop'),
(945, 142, 0, 'alinhamento_2', NULL, 0, '2014-10-08 23:46:08', 'center', '', 207, 72, 'texto', 'desktop'),
(946, 142, 0, 'alinhamento_3', NULL, 0, '2014-10-08 23:46:08', 'left', '', 207, 72, 'texto', 'desktop'),
(947, 142, 0, 'margin_top', 20, 0, '2014-10-08 23:46:08', NULL, '', 207, 72, 'inteiro', 'desktop'),
(948, 142, 0, 'margin_bottom', 0, 0, '2014-10-08 23:46:08', NULL, '', 207, 72, 'inteiro', 'desktop'),
(949, 142, 0, 'padding_top', 0, 0, '2014-10-08 23:46:08', NULL, '', 207, 72, 'inteiro', 'desktop'),
(950, 142, 0, 'padding_bottom', 0, 0, '2014-10-08 23:46:08', NULL, '', 207, 72, 'inteiro', 'desktop'),
(951, 142, 0, 'is_full', 0, 0, '2014-10-08 23:46:08', NULL, '', 207, 72, 'inteiro', 'desktop'),
(952, 142, 0, 'background_type', 0, 0, '2014-10-08 23:46:08', NULL, '', 207, 72, 'inteiro', 'desktop'),
(953, 142, 0, 'background', NULL, 0, '2014-10-08 23:46:08', '', '', 207, 72, 'texto', 'desktop'),
(954, 28, 0, 'mat_lk_rcn_qtd', 4, 0, NULL, NULL, '', 0, 0, '0', '0'),
(955, 28, 0, 'mat_lk_rcn_afi', NULL, 0, NULL, 'afinidade', '', 0, 0, '0', '0'),
(956, 28, 0, 'mat_lk_rcn_adv', 1, 0, NULL, NULL, '', 0, 0, '0', '0'),
(957, 28, 0, 'mat_lk_rcn_blc', 4, 0, NULL, NULL, '', 0, 0, '0', '0'),
(958, 142, 0, 'titulo_1', NULL, 0, '2014-10-09 00:21:26', NULL, '', 186, 80, 'texto', 'desktop'),
(959, 142, 0, 'subtitulo_1', NULL, 0, '2014-10-09 00:21:26', NULL, ' 3 tipos diferentes para você montar o topo de seu mailing', 186, 80, 'texto', 'desktop'),
(960, 142, 0, 'texto_1', NULL, 0, '2014-10-09 00:21:26', NULL, '', 186, 80, 'texto', 'desktop'),
(961, 142, 0, 'image_1', NULL, 0, '2014-10-09 00:21:26', '', '', 186, 80, 'image', 'desktop'),
(962, 142, 0, 'cor_1', NULL, 0, '2014-10-09 00:21:26', '', '', 186, 80, 'texto', 'desktop'),
(963, 142, 0, 'cor_2', NULL, 0, '2014-10-09 00:21:26', '', '', 186, 80, 'texto', 'desktop'),
(964, 142, 0, 'cor_3', NULL, 0, '2014-10-09 00:21:26', '', '', 186, 80, 'texto', 'desktop'),
(965, 142, 0, 'is_full', 0, 0, '2014-10-09 00:21:26', NULL, '', 186, 80, 'inteiro', 'desktop'),
(966, 142, 0, 'titulo_1', NULL, 0, '2014-10-09 00:23:20', NULL, '', 207, 73, 'texto', 'desktop'),
(967, 142, 0, 'subtitulo_1', NULL, 0, '2014-10-09 00:23:20', NULL, '', 207, 73, 'texto', 'desktop'),
(968, 142, 0, 'texto_1', NULL, 0, '2014-10-09 00:23:20', NULL, '', 207, 73, 'texto', 'desktop'),
(969, 142, 0, 'image_1', NULL, 0, '2014-10-09 00:23:20', 'topo_simples_b6.png', '', 207, 73, 'texto', 'desktop'),
(970, 142, 0, 'cor_1', NULL, 0, '2014-10-09 00:23:20', '', '', 207, 73, 'texto', 'desktop'),
(971, 142, 0, 'cor_2', NULL, 0, '2014-10-09 00:23:20', '', '', 207, 73, 'texto', 'desktop'),
(972, 142, 0, 'cor_3', NULL, 0, '2014-10-09 00:23:20', '', '', 207, 73, 'texto', 'desktop'),
(973, 142, 0, 'alinhamento_1', NULL, 0, '2014-10-09 00:23:20', 'left', '', 207, 73, 'texto', 'desktop'),
(974, 142, 0, 'alinhamento_2', NULL, 0, '2014-10-09 00:23:20', 'left', '', 207, 73, 'texto', 'desktop'),
(975, 142, 0, 'alinhamento_3', NULL, 0, '2014-10-09 00:23:20', 'left', '', 207, 73, 'texto', 'desktop'),
(976, 142, 0, 'margin_top', 20, 0, '2014-10-09 00:23:20', NULL, '', 207, 73, 'inteiro', 'desktop'),
(977, 142, 0, 'margin_bottom', 0, 0, '2014-10-09 00:23:20', NULL, '', 207, 73, 'inteiro', 'desktop'),
(978, 142, 0, 'padding_top', 0, 0, '2014-10-09 00:23:20', NULL, '', 207, 73, 'inteiro', 'desktop'),
(979, 142, 0, 'padding_bottom', 0, 0, '2014-10-09 00:23:20', NULL, '', 207, 73, 'inteiro', 'desktop'),
(980, 142, 0, 'is_full', 0, 0, '2014-10-09 00:23:20', NULL, '', 207, 73, 'inteiro', 'desktop'),
(981, 142, 0, 'background_type', 0, 0, '2014-10-09 00:23:20', NULL, '', 207, 73, 'inteiro', 'desktop'),
(982, 142, 0, 'background', NULL, 0, '2014-10-09 00:23:20', '', '', 207, 73, 'texto', 'desktop'),
(983, 142, 0, 'titulo_1', NULL, 0, '2014-10-09 00:25:12', NULL, '', 207, 74, 'texto', 'desktop'),
(984, 142, 0, 'subtitulo_1', NULL, 0, '2014-10-09 00:25:12', NULL, '', 207, 74, 'texto', 'desktop'),
(985, 142, 0, 'texto_1', NULL, 0, '2014-10-09 00:25:12', NULL, '', 207, 74, 'texto', 'desktop'),
(986, 142, 0, 'image_1', NULL, 0, '2014-10-09 00:25:12', 'topo_detalhe_d6.png', '', 207, 74, 'texto', 'desktop'),
(987, 142, 0, 'cor_1', NULL, 0, '2014-10-09 00:25:12', '', '', 207, 74, 'texto', 'desktop'),
(988, 142, 0, 'cor_2', NULL, 0, '2014-10-09 00:25:12', '', '', 207, 74, 'texto', 'desktop'),
(989, 142, 0, 'cor_3', NULL, 0, '2014-10-09 00:25:12', '', '', 207, 74, 'texto', 'desktop'),
(990, 142, 0, 'alinhamento_1', NULL, 0, '2014-10-09 00:25:12', 'left', '', 207, 74, 'texto', 'desktop'),
(991, 142, 0, 'alinhamento_2', NULL, 0, '2014-10-09 00:25:12', 'left', '', 207, 74, 'texto', 'desktop'),
(992, 142, 0, 'alinhamento_3', NULL, 0, '2014-10-09 00:25:12', 'left', '', 207, 74, 'texto', 'desktop'),
(993, 142, 0, 'margin_top', 0, 0, '2014-10-09 00:25:12', NULL, '', 207, 74, 'inteiro', 'desktop'),
(994, 142, 0, 'margin_bottom', 0, 0, '2014-10-09 00:25:12', NULL, '', 207, 74, 'inteiro', 'desktop'),
(995, 142, 0, 'padding_top', 0, 0, '2014-10-09 00:25:12', NULL, '', 207, 74, 'inteiro', 'desktop'),
(996, 142, 0, 'padding_bottom', 0, 0, '2014-10-09 00:25:12', NULL, '', 207, 74, 'inteiro', 'desktop'),
(997, 142, 0, 'is_full', 0, 0, '2014-10-09 00:25:12', NULL, '', 207, 74, 'inteiro', 'desktop'),
(998, 142, 0, 'background_type', 0, 0, '2014-10-09 00:25:12', NULL, '', 207, 74, 'inteiro', 'desktop'),
(999, 142, 0, 'background', NULL, 0, '2014-10-09 00:25:12', '', '', 207, 74, 'texto', 'desktop'),
(1000, 142, 0, 'titulo_1', NULL, 0, '2014-10-09 00:25:42', NULL, '', 207, 75, 'texto', 'desktop'),
(1001, 142, 0, 'subtitulo_1', NULL, 0, '2014-10-09 00:25:42', NULL, '', 207, 75, 'texto', 'desktop'),
(1002, 142, 0, 'texto_1', NULL, 0, '2014-10-09 00:25:42', NULL, '', 207, 75, 'texto', 'desktop'),
(1003, 142, 0, 'image_1', NULL, 0, '2014-10-09 00:25:42', 'topo_simples_b6.png', '', 207, 75, 'texto', 'desktop'),
(1004, 142, 0, 'cor_1', NULL, 0, '2014-10-09 00:25:42', '', '', 207, 75, 'texto', 'desktop'),
(1005, 142, 0, 'cor_2', NULL, 0, '2014-10-09 00:25:42', '', '', 207, 75, 'texto', 'desktop'),
(1006, 142, 0, 'cor_3', NULL, 0, '2014-10-09 00:25:42', '', '', 207, 75, 'texto', 'desktop'),
(1007, 142, 0, 'alinhamento_1', NULL, 0, '2014-10-09 00:25:42', 'left', '', 207, 75, 'texto', 'desktop'),
(1008, 142, 0, 'alinhamento_2', NULL, 0, '2014-10-09 00:25:42', 'left', '', 207, 75, 'texto', 'desktop'),
(1009, 142, 0, 'alinhamento_3', NULL, 0, '2014-10-09 00:25:42', 'left', '', 207, 75, 'texto', 'desktop'),
(1010, 142, 0, 'margin_top', 0, 0, '2014-10-09 00:25:42', NULL, '', 207, 75, 'inteiro', 'desktop'),
(1011, 142, 0, 'margin_bottom', 0, 0, '2014-10-09 00:25:42', NULL, '', 207, 75, 'inteiro', 'desktop'),
(1012, 142, 0, 'padding_top', 0, 0, '2014-10-09 00:25:42', NULL, '', 207, 75, 'inteiro', 'desktop'),
(1013, 142, 0, 'padding_bottom', 0, 0, '2014-10-09 00:25:42', NULL, '', 207, 75, 'inteiro', 'desktop'),
(1014, 142, 0, 'is_full', 0, 0, '2014-10-09 00:25:42', NULL, '', 207, 75, 'inteiro', 'desktop'),
(1015, 142, 0, 'background_type', 0, 0, '2014-10-09 00:25:42', NULL, '', 207, 75, 'inteiro', 'desktop'),
(1016, 142, 0, 'background', NULL, 0, '2014-10-09 00:25:42', '', '', 207, 75, 'texto', 'desktop'),
(1017, 142, 0, 'titulo_1', NULL, 0, '2014-10-09 00:35:05', NULL, 'Várias formas de você publicar o seu conteúdo', 207, 76, 'texto', 'desktop'),
(1018, 142, 0, 'subtitulo_1', NULL, 0, '2014-10-09 00:35:05', NULL, 'Com imagem inteira, imagem e texto ou também divulgação de dois produtos', 207, 76, 'texto', 'desktop'),
(1019, 142, 0, 'texto_1', NULL, 0, '2014-10-09 00:35:05', NULL, '', 207, 76, 'texto', 'desktop'),
(1020, 142, 0, 'image_1', NULL, 0, '2014-10-09 00:35:05', 'email_supernova_c6.png', '', 207, 76, 'texto', 'desktop'),
(1021, 142, 0, 'cor_1', NULL, 0, '2014-10-09 00:35:05', '', '', 207, 76, 'texto', 'desktop'),
(1022, 142, 0, 'cor_2', NULL, 0, '2014-10-09 00:35:05', '', '', 207, 76, 'texto', 'desktop'),
(1023, 142, 0, 'cor_3', NULL, 0, '2014-10-09 00:35:05', '', '', 207, 76, 'texto', 'desktop'),
(1024, 142, 0, 'alinhamento_1', NULL, 0, '2014-10-09 00:35:05', 'center', '', 207, 76, 'texto', 'desktop'),
(1025, 142, 0, 'alinhamento_2', NULL, 0, '2014-10-09 00:35:05', 'center', '', 207, 76, 'texto', 'desktop'),
(1026, 142, 0, 'alinhamento_3', NULL, 0, '2014-10-09 00:35:05', 'left', '', 207, 76, 'texto', 'desktop'),
(1027, 142, 0, 'margin_top', 30, 0, '2014-10-09 00:35:05', NULL, '', 207, 76, 'inteiro', 'desktop'),
(1028, 142, 0, 'margin_bottom', 0, 0, '2014-10-09 00:35:05', NULL, '', 207, 76, 'inteiro', 'desktop'),
(1029, 142, 0, 'padding_top', 0, 0, '2014-10-09 00:35:05', NULL, '', 207, 76, 'inteiro', 'desktop'),
(1030, 142, 0, 'padding_bottom', 0, 0, '2014-10-09 00:35:05', NULL, '', 207, 76, 'inteiro', 'desktop'),
(1031, 142, 0, 'is_full', 0, 0, '2014-10-09 00:35:05', NULL, '', 207, 76, 'inteiro', 'desktop'),
(1032, 142, 0, 'background_type', 0, 0, '2014-10-09 00:35:05', NULL, '', 207, 76, 'inteiro', 'desktop'),
(1033, 142, 0, 'background', NULL, 0, '2014-10-09 00:35:05', '', '', 207, 76, 'texto', 'desktop'),
(1034, 142, 0, 'titulo_1', NULL, 0, '2014-10-09 00:35:59', NULL, '', 207, 77, 'texto', 'desktop'),
(1035, 142, 0, 'subtitulo_1', NULL, 0, '2014-10-09 00:35:59', NULL, '', 207, 77, 'texto', 'desktop'),
(1036, 142, 0, 'texto_1', NULL, 0, '2014-10-09 00:35:59', NULL, '', 207, 77, 'texto', 'desktop'),
(1037, 142, 0, 'image_1', NULL, 0, '2014-10-09 00:35:59', 'artigo_newyork_y4.png', '', 207, 77, 'texto', 'desktop'),
(1038, 142, 0, 'cor_1', NULL, 0, '2014-10-09 00:35:59', '', '', 207, 77, 'texto', 'desktop'),
(1039, 142, 0, 'cor_2', NULL, 0, '2014-10-09 00:35:59', '', '', 207, 77, 'texto', 'desktop'),
(1040, 142, 0, 'cor_3', NULL, 0, '2014-10-09 00:35:59', '', '', 207, 77, 'texto', 'desktop'),
(1041, 142, 0, 'alinhamento_1', NULL, 0, '2014-10-09 00:35:59', 'left', '', 207, 77, 'texto', 'desktop'),
(1042, 142, 0, 'alinhamento_2', NULL, 0, '2014-10-09 00:35:59', 'left', '', 207, 77, 'texto', 'desktop'),
(1043, 142, 0, 'alinhamento_3', NULL, 0, '2014-10-09 00:35:59', 'left', '', 207, 77, 'texto', 'desktop'),
(1044, 142, 0, 'margin_top', 20, 0, '2014-10-09 00:35:59', NULL, '', 207, 77, 'inteiro', 'desktop'),
(1045, 142, 0, 'margin_bottom', 0, 0, '2014-10-09 00:35:59', NULL, '', 207, 77, 'inteiro', 'desktop'),
(1046, 142, 0, 'padding_top', 0, 0, '2014-10-09 00:35:59', NULL, '', 207, 77, 'inteiro', 'desktop'),
(1047, 142, 0, 'padding_bottom', 0, 0, '2014-10-09 00:35:59', NULL, '', 207, 77, 'inteiro', 'desktop'),
(1048, 142, 0, 'is_full', 0, 0, '2014-10-09 00:35:59', NULL, '', 207, 77, 'inteiro', 'desktop'),
(1049, 142, 0, 'background_type', 0, 0, '2014-10-09 00:35:59', NULL, '', 207, 77, 'inteiro', 'desktop'),
(1050, 142, 0, 'background', NULL, 0, '2014-10-09 00:35:59', '', '', 207, 77, 'texto', 'desktop'),
(1051, 142, 0, 'titulo_1', NULL, 0, '2014-10-09 00:38:05', NULL, '', 207, 78, 'texto', 'desktop'),
(1052, 142, 0, 'subtitulo_1', NULL, 0, '2014-10-09 00:38:05', NULL, '', 207, 78, 'texto', 'desktop'),
(1053, 142, 0, 'texto_1', NULL, 0, '2014-10-09 00:38:05', NULL, '', 207, 78, 'texto', 'desktop'),
(1054, 142, 0, 'image_1', NULL, 0, '2014-10-09 00:38:05', 'produtos_venezza_w0.png', '', 207, 78, 'texto', 'desktop'),
(1055, 142, 0, 'cor_1', NULL, 0, '2014-10-09 00:38:05', '', '', 207, 78, 'texto', 'desktop'),
(1056, 142, 0, 'cor_2', NULL, 0, '2014-10-09 00:38:05', '', '', 207, 78, 'texto', 'desktop'),
(1057, 142, 0, 'cor_3', NULL, 0, '2014-10-09 00:38:05', '', '', 207, 78, 'texto', 'desktop'),
(1058, 142, 0, 'alinhamento_1', NULL, 0, '2014-10-09 00:38:05', 'left', '', 207, 78, 'texto', 'desktop'),
(1059, 142, 0, 'alinhamento_2', NULL, 0, '2014-10-09 00:38:05', 'left', '', 207, 78, 'texto', 'desktop'),
(1060, 142, 0, 'alinhamento_3', NULL, 0, '2014-10-09 00:38:05', 'left', '', 207, 78, 'texto', 'desktop'),
(1061, 142, 0, 'margin_top', 0, 0, '2014-10-09 00:38:05', NULL, '', 207, 78, 'inteiro', 'desktop'),
(1062, 142, 0, 'margin_bottom', 0, 0, '2014-10-09 00:38:05', NULL, '', 207, 78, 'inteiro', 'desktop'),
(1063, 142, 0, 'padding_top', 0, 0, '2014-10-09 00:38:05', NULL, '', 207, 78, 'inteiro', 'desktop'),
(1064, 142, 0, 'padding_bottom', 0, 0, '2014-10-09 00:38:05', NULL, '', 207, 78, 'inteiro', 'desktop'),
(1065, 142, 0, 'is_full', 0, 0, '2014-10-09 00:38:05', NULL, '', 207, 78, 'inteiro', 'desktop'),
(1066, 142, 0, 'background_type', 0, 0, '2014-10-09 00:38:05', NULL, '', 207, 78, 'inteiro', 'desktop'),
(1067, 142, 0, 'background', NULL, 0, '2014-10-09 00:38:05', '', '', 207, 78, 'texto', 'desktop'),
(1068, 142, 0, 'titulo_1', NULL, 0, '2014-10-09 00:38:41', NULL, '', 207, 79, 'texto', 'desktop'),
(1069, 142, 0, 'subtitulo_1', NULL, 0, '2014-10-09 00:38:41', NULL, '', 207, 79, 'texto', 'desktop'),
(1070, 142, 0, 'texto_1', NULL, 0, '2014-10-09 00:38:41', NULL, '', 207, 79, 'texto', 'desktop'),
(1071, 142, 0, 'image_1', NULL, 0, '2014-10-09 00:38:41', 'Array', '', 207, 79, 'texto', 'desktop'),
(1072, 142, 0, 'cor_1', NULL, 0, '2014-10-09 00:38:41', '', '', 207, 79, 'texto', 'desktop'),
(1073, 142, 0, 'cor_2', NULL, 0, '2014-10-09 00:38:41', '', '', 207, 79, 'texto', 'desktop'),
(1074, 142, 0, 'cor_3', NULL, 0, '2014-10-09 00:38:41', '', '', 207, 79, 'texto', 'desktop'),
(1075, 142, 0, 'alinhamento_1', NULL, 0, '2014-10-09 00:38:41', 'left', '', 207, 79, 'texto', 'desktop'),
(1076, 142, 0, 'alinhamento_2', NULL, 0, '2014-10-09 00:38:41', 'left', '', 207, 79, 'texto', 'desktop'),
(1077, 142, 0, 'alinhamento_3', NULL, 0, '2014-10-09 00:38:41', 'left', '', 207, 79, 'texto', 'desktop'),
(1078, 142, 0, 'margin_top', 0, 0, '2014-10-09 00:38:41', NULL, '', 207, 79, 'inteiro', 'desktop'),
(1079, 142, 0, 'margin_bottom', 0, 0, '2014-10-09 00:38:41', NULL, '', 207, 79, 'inteiro', 'desktop'),
(1080, 142, 0, 'padding_top', 0, 0, '2014-10-09 00:38:41', NULL, '', 207, 79, 'inteiro', 'desktop'),
(1081, 142, 0, 'padding_bottom', 0, 0, '2014-10-09 00:38:41', NULL, '', 207, 79, 'inteiro', 'desktop'),
(1082, 142, 0, 'is_full', 0, 0, '2014-10-09 00:38:41', NULL, '', 207, 79, 'inteiro', 'desktop'),
(1083, 142, 0, 'background_type', 0, 0, '2014-10-09 00:38:41', NULL, '', 207, 79, 'inteiro', 'desktop'),
(1084, 142, 0, 'background', NULL, 0, '2014-10-09 00:38:41', '', '', 207, 79, 'texto', 'desktop'),
(1085, 142, 0, 'titulo_1', NULL, 0, '2014-10-09 00:44:24', NULL, '', 207, 81, 'texto', 'desktop'),
(1086, 142, 0, 'subtitulo_1', NULL, 0, '2014-10-09 00:44:24', NULL, 'Criamos até os separadores de conteúdo', 207, 81, 'texto', 'desktop'),
(1087, 142, 0, 'texto_1', NULL, 0, '2014-10-09 00:44:24', NULL, '', 207, 81, 'texto', 'desktop'),
(1088, 142, 0, 'image_1', NULL, 0, '2014-10-09 00:44:24', 'dividers_d1.png', '', 207, 81, 'texto', 'desktop'),
(1089, 142, 0, 'cor_1', NULL, 0, '2014-10-09 00:44:24', '', '', 207, 81, 'texto', 'desktop'),
(1090, 142, 0, 'cor_2', NULL, 0, '2014-10-09 00:44:24', '', '', 207, 81, 'texto', 'desktop'),
(1091, 142, 0, 'cor_3', NULL, 0, '2014-10-09 00:44:24', '', '', 207, 81, 'texto', 'desktop'),
(1092, 142, 0, 'alinhamento_1', NULL, 0, '2014-10-09 00:44:24', 'left', '', 207, 81, 'texto', 'desktop'),
(1093, 142, 0, 'alinhamento_2', NULL, 0, '2014-10-09 00:44:24', 'center', '', 207, 81, 'texto', 'desktop'),
(1094, 142, 0, 'alinhamento_3', NULL, 0, '2014-10-09 00:44:24', 'left', '', 207, 81, 'texto', 'desktop'),
(1095, 142, 0, 'margin_top', 0, 0, '2014-10-09 00:44:24', NULL, '', 207, 81, 'inteiro', 'desktop'),
(1096, 142, 0, 'margin_bottom', 0, 0, '2014-10-09 00:44:24', NULL, '', 207, 81, 'inteiro', 'desktop'),
(1097, 142, 0, 'padding_top', 0, 0, '2014-10-09 00:44:24', NULL, '', 207, 81, 'inteiro', 'desktop'),
(1098, 142, 0, 'padding_bottom', 0, 0, '2014-10-09 00:44:24', NULL, '', 207, 81, 'inteiro', 'desktop'),
(1099, 142, 0, 'is_full', 0, 0, '2014-10-09 00:44:24', NULL, '', 207, 81, 'inteiro', 'desktop'),
(1100, 142, 0, 'background_type', 0, 0, '2014-10-09 00:44:24', NULL, '', 207, 81, 'inteiro', 'desktop'),
(1101, 142, 0, 'background', NULL, 0, '2014-10-09 00:44:24', '', '', 207, 81, 'texto', 'desktop'),
(1102, 142, 0, 'titulo_1', NULL, 0, '2014-10-09 00:44:37', NULL, '', 207, 82, 'texto', 'desktop'),
(1103, 142, 0, 'subtitulo_1', NULL, 0, '2014-10-09 00:44:37', NULL, '', 207, 82, 'texto', 'desktop'),
(1104, 142, 0, 'texto_1', NULL, 0, '2014-10-09 00:44:37', NULL, '', 207, 82, 'texto', 'desktop'),
(1105, 142, 0, 'image_1', NULL, 0, '2014-10-09 00:44:37', 'artigo_oklahoma_y9.png', '', 207, 82, 'texto', 'desktop'),
(1106, 142, 0, 'cor_1', NULL, 0, '2014-10-09 00:44:37', '', '', 207, 82, 'texto', 'desktop'),
(1107, 142, 0, 'cor_2', NULL, 0, '2014-10-09 00:44:37', '', '', 207, 82, 'texto', 'desktop'),
(1108, 142, 0, 'cor_3', NULL, 0, '2014-10-09 00:44:37', '', '', 207, 82, 'texto', 'desktop'),
(1109, 142, 0, 'alinhamento_1', NULL, 0, '2014-10-09 00:44:37', 'left', '', 207, 82, 'texto', 'desktop'),
(1110, 142, 0, 'alinhamento_2', NULL, 0, '2014-10-09 00:44:37', 'left', '', 207, 82, 'texto', 'desktop'),
(1111, 142, 0, 'alinhamento_3', NULL, 0, '2014-10-09 00:44:37', 'left', '', 207, 82, 'texto', 'desktop'),
(1112, 142, 0, 'margin_top', 0, 0, '2014-10-09 00:44:37', NULL, '', 207, 82, 'inteiro', 'desktop'),
(1113, 142, 0, 'margin_bottom', 0, 0, '2014-10-09 00:44:37', NULL, '', 207, 82, 'inteiro', 'desktop'),
(1114, 142, 0, 'padding_top', 0, 0, '2014-10-09 00:44:37', NULL, '', 207, 82, 'inteiro', 'desktop'),
(1115, 142, 0, 'padding_bottom', 0, 0, '2014-10-09 00:44:37', NULL, '', 207, 82, 'inteiro', 'desktop'),
(1116, 142, 0, 'is_full', 0, 0, '2014-10-09 00:44:37', NULL, '', 207, 82, 'inteiro', 'desktop'),
(1117, 142, 0, 'background_type', 0, 0, '2014-10-09 00:44:37', NULL, '', 207, 82, 'inteiro', 'desktop'),
(1118, 142, 0, 'background', NULL, 0, '2014-10-09 00:44:37', '', '', 207, 82, 'texto', 'desktop'),
(1119, 142, 0, 'titulo_1', NULL, 0, '2014-10-09 00:45:48', NULL, 'Rodapé ', 207, 83, 'texto', 'desktop'),
(1120, 142, 0, 'subtitulo_1', NULL, 0, '2014-10-09 00:45:48', NULL, '', 207, 83, 'texto', 'desktop'),
(1121, 142, 0, 'texto_1', NULL, 0, '2014-10-09 00:45:48', NULL, '', 207, 83, 'texto', 'desktop'),
(1122, 142, 0, 'image_1', NULL, 0, '2014-10-09 00:45:48', 'rodape_simples_b9.png', '', 207, 83, 'texto', 'desktop'),
(1123, 142, 0, 'cor_1', NULL, 0, '2014-10-09 00:45:48', '', '', 207, 83, 'texto', 'desktop'),
(1124, 142, 0, 'cor_2', NULL, 0, '2014-10-09 00:45:48', '', '', 207, 83, 'texto', 'desktop'),
(1125, 142, 0, 'cor_3', NULL, 0, '2014-10-09 00:45:48', '', '', 207, 83, 'texto', 'desktop'),
(1126, 142, 0, 'alinhamento_1', NULL, 0, '2014-10-09 00:45:48', 'left', '', 207, 83, 'texto', 'desktop'),
(1127, 142, 0, 'alinhamento_2', NULL, 0, '2014-10-09 00:45:48', 'left', '', 207, 83, 'texto', 'desktop'),
(1128, 142, 0, 'alinhamento_3', NULL, 0, '2014-10-09 00:45:48', 'left', '', 207, 83, 'texto', 'desktop'),
(1129, 142, 0, 'margin_top', 30, 0, '2014-10-09 00:45:48', NULL, '', 207, 83, 'inteiro', 'desktop'),
(1130, 142, 0, 'margin_bottom', 0, 0, '2014-10-09 00:45:48', NULL, '', 207, 83, 'inteiro', 'desktop'),
(1131, 142, 0, 'padding_top', 0, 0, '2014-10-09 00:45:48', NULL, '', 207, 83, 'inteiro', 'desktop'),
(1132, 142, 0, 'padding_bottom', 0, 0, '2014-10-09 00:45:48', NULL, '', 207, 83, 'inteiro', 'desktop'),
(1133, 142, 0, 'is_full', 0, 0, '2014-10-09 00:45:48', NULL, '', 207, 83, 'inteiro', 'desktop'),
(1134, 142, 0, 'background_type', 0, 0, '2014-10-09 00:45:48', NULL, '', 207, 83, 'inteiro', 'desktop'),
(1135, 142, 0, 'background', NULL, 0, '2014-10-09 00:45:48', '', '', 207, 83, 'texto', 'desktop'),
(1136, 142, 0, 'titulo_1', NULL, 0, '2014-10-09 00:46:05', NULL, '', 207, 84, 'texto', 'desktop'),
(1137, 142, 0, 'subtitulo_1', NULL, 0, '2014-10-09 00:46:05', NULL, '', 207, 84, 'texto', 'desktop'),
(1138, 142, 0, 'texto_1', NULL, 0, '2014-10-09 00:46:05', NULL, '', 207, 84, 'texto', 'desktop'),
(1139, 142, 0, 'image_1', NULL, 0, '2014-10-09 00:46:05', 'redesocial_facebook_i4.png', '', 207, 84, 'texto', 'desktop'),
(1140, 142, 0, 'cor_1', NULL, 0, '2014-10-09 00:46:05', '', '', 207, 84, 'texto', 'desktop'),
(1141, 142, 0, 'cor_2', NULL, 0, '2014-10-09 00:46:05', '', '', 207, 84, 'texto', 'desktop'),
(1142, 142, 0, 'cor_3', NULL, 0, '2014-10-09 00:46:05', '', '', 207, 84, 'texto', 'desktop'),
(1143, 142, 0, 'alinhamento_1', NULL, 0, '2014-10-09 00:46:05', 'left', '', 207, 84, 'texto', 'desktop'),
(1144, 142, 0, 'alinhamento_2', NULL, 0, '2014-10-09 00:46:05', 'left', '', 207, 84, 'texto', 'desktop'),
(1145, 142, 0, 'alinhamento_3', NULL, 0, '2014-10-09 00:46:05', 'left', '', 207, 84, 'texto', 'desktop'),
(1146, 142, 0, 'margin_top', 0, 0, '2014-10-09 00:46:05', NULL, '', 207, 84, 'inteiro', 'desktop'),
(1147, 142, 0, 'margin_bottom', 0, 0, '2014-10-09 00:46:05', NULL, '', 207, 84, 'inteiro', 'desktop'),
(1148, 142, 0, 'padding_top', 0, 0, '2014-10-09 00:46:05', NULL, '', 207, 84, 'inteiro', 'desktop'),
(1149, 142, 0, 'padding_bottom', 0, 0, '2014-10-09 00:46:05', NULL, '', 207, 84, 'inteiro', 'desktop'),
(1150, 142, 0, 'is_full', 0, 0, '2014-10-09 00:46:05', NULL, '', 207, 84, 'inteiro', 'desktop'),
(1151, 142, 0, 'background_type', 0, 0, '2014-10-09 00:46:05', NULL, '', 207, 84, 'inteiro', 'desktop'),
(1152, 142, 0, 'background', NULL, 0, '2014-10-09 00:46:05', '', '', 207, 84, 'texto', 'desktop'),
(1153, 142, 0, 'qtd_blocos', 4, 0, '2014-10-09 00:57:30', NULL, '', 211, 88, 'inteiro', 'desktop'),
(1154, 142, 0, 'titulo_1', NULL, 0, '2014-10-09 00:57:30', NULL, 'Desempenho', 211, 88, 'texto', 'desktop'),
(1155, 142, 0, 'subtitulo_1', NULL, 0, '2014-10-09 00:57:30', NULL, 'Envios rápidos e eficientes', 211, 88, 'texto', 'desktop'),
(1156, 142, 0, 'texto_1', NULL, 0, '2014-10-09 00:57:30', NULL, '- Envios simultâneos \r\n- Otimização de mailing\r\n- Integração com cadastro de seu website (Newsletter) \r\n- Criação de campos personalizáveis. Ex: Olá Fulano', 211, 88, 'texto', 'desktop'),
(1157, 142, 0, 'titulo_2', NULL, 0, '2014-10-09 00:57:30', NULL, 'Economia', 211, 88, 'texto', 'desktop'),
(1158, 142, 0, 'subtitulo_2', NULL, 0, '2014-10-09 00:57:30', NULL, 'Envios Inteligentes, segmentação avançada', 211, 88, 'texto', 'desktop'),
(1159, 142, 0, 'texto_2', NULL, 0, '2014-10-09 00:57:30', NULL, '- Envio teste de mensagem\r\n- Preview antes do envio de campanhas \r\n- Segmentação de contatos por ramo de atividade\r\n- Layout com modelos gratuitos\r\n\r\n', 211, 88, 'texto', 'desktop'),
(1160, 142, 0, 'titulo_3', NULL, 0, '2014-10-09 00:57:30', NULL, 'Usabilidade', 211, 88, 'texto', 'desktop'),
(1161, 142, 0, 'subtitulo_3', NULL, 0, '2014-10-09 00:57:30', NULL, 'Interface intuitiva, moderna e amigável', 211, 88, 'texto', 'desktop'),
(1162, 142, 0, 'texto_3', NULL, 0, '2014-10-09 00:57:30', NULL, '- Variedade de componentes para criação de templates \r\n- Construtor de template\r\n- Tutorial Online \r\n\r\n', 211, 88, 'texto', 'desktop'),
(1163, 142, 0, 'titulo_4', NULL, 0, '2014-10-09 00:57:30', NULL, 'Resultados ', 211, 88, 'texto', 'desktop'),
(1164, 142, 0, 'subtitulo_4', NULL, 0, '2014-10-09 00:57:30', NULL, 'Relatórios detalhados ', 211, 88, 'texto', 'desktop'),
(1165, 142, 0, 'texto_4', NULL, 0, '2014-10-09 00:57:30', NULL, '- Estatísticas em tempo real \r\n- Relatório Geral - total de visualizações, cliques, descadastros e rejeições\r\n- Relatórios de Geolocalização (cidade, estado, região, país)\r\n- Relatórios Detalhados (leitor de email, plataforma)', 211, 88, 'texto', 'desktop'),
(1166, 142, 0, 'image_type_1', 1, 0, '2014-10-09 00:57:30', NULL, '', 211, 88, 'inteiro', 'desktop'),
(1167, 142, 0, 'image_1', NULL, 0, '2014-10-09 00:57:30', '', '', 211, 88, 'texto', 'desktop'),
(1168, 142, 0, 'image_type_2', 1, 0, '2014-10-09 00:57:30', NULL, '', 211, 88, 'inteiro', 'desktop'),
(1169, 142, 0, 'image_2', NULL, 0, '2014-10-09 00:57:30', '', '', 211, 88, 'texto', 'desktop'),
(1170, 142, 0, 'image_type_3', 1, 0, '2014-10-09 00:57:30', NULL, '', 211, 88, 'inteiro', 'desktop'),
(1171, 142, 0, 'image_3', NULL, 0, '2014-10-09 00:57:30', '', '', 211, 88, 'texto', 'desktop'),
(1172, 142, 0, 'image_type_4', 1, 0, '2014-10-09 00:57:30', NULL, '', 211, 88, 'inteiro', 'desktop'),
(1173, 142, 0, 'image_4', NULL, 0, '2014-10-09 00:57:30', '', '', 211, 88, 'texto', 'desktop'),
(1174, 142, 0, 'item1_cor_1', NULL, 0, '2014-10-09 00:57:30', '#4d185d', '', 211, 88, 'texto', 'desktop'),
(1175, 142, 0, 'item1_alinhamento_1', NULL, 0, '2014-10-09 00:57:30', 'center', '', 211, 88, 'texto', 'desktop'),
(1176, 142, 0, 'item1_cor_2', NULL, 0, '2014-10-09 00:57:30', '', '', 211, 88, 'texto', 'desktop'),
(1177, 142, 0, 'item1_alinhamento_2', NULL, 0, '2014-10-09 00:57:30', 'left', '', 211, 88, 'texto', 'desktop'),
(1178, 142, 0, 'item1_cor_3', NULL, 0, '2014-10-09 00:57:30', '', '', 211, 88, 'texto', 'desktop'),
(1179, 142, 0, 'item1_alinhamento_3', NULL, 0, '2014-10-09 00:57:30', 'left', '', 211, 88, 'texto', 'desktop'),
(1180, 142, 0, 'item2_cor_1', NULL, 0, '2014-10-09 00:57:30', '#42174f', '', 211, 88, 'texto', 'desktop'),
(1181, 142, 0, 'item2_alinhamento_1', NULL, 0, '2014-10-09 00:57:30', 'center', '', 211, 88, 'texto', 'desktop'),
(1182, 142, 0, 'item2_cor_2', NULL, 0, '2014-10-09 00:57:30', '', '', 211, 88, 'texto', 'desktop'),
(1183, 142, 0, 'item2_alinhamento_2', NULL, 0, '2014-10-09 00:57:30', 'left', '', 211, 88, 'texto', 'desktop'),
(1184, 142, 0, 'item2_cor_3', NULL, 0, '2014-10-09 00:57:30', '', '', 211, 88, 'texto', 'desktop'),
(1185, 142, 0, 'item2_alinhamento_3', NULL, 0, '2014-10-09 00:57:30', 'left', '', 211, 88, 'texto', 'desktop'),
(1186, 142, 0, 'item3_cor_1', NULL, 0, '2014-10-09 00:57:30', '#34133e', '', 211, 88, 'texto', 'desktop'),
(1187, 142, 0, 'item3_alinhamento_1', NULL, 0, '2014-10-09 00:57:30', 'center', '', 211, 88, 'texto', 'desktop'),
(1188, 142, 0, 'item3_cor_2', NULL, 0, '2014-10-09 00:57:30', '', '', 211, 88, 'texto', 'desktop'),
(1189, 142, 0, 'item3_alinhamento_2', NULL, 0, '2014-10-09 00:57:30', 'left', '', 211, 88, 'texto', 'desktop'),
(1190, 142, 0, 'item3_cor_3', NULL, 0, '2014-10-09 00:57:30', '', '', 211, 88, 'texto', 'desktop'),
(1191, 142, 0, 'item3_alinhamento_3', NULL, 0, '2014-10-09 00:57:30', 'left', '', 211, 88, 'texto', 'desktop'),
(1192, 142, 0, 'item4_cor_1', NULL, 0, '2014-10-09 00:57:30', '#381443', '', 211, 88, 'texto', 'desktop'),
(1193, 142, 0, 'item4_alinhamento_1', NULL, 0, '2014-10-09 00:57:30', 'center', '', 211, 88, 'texto', 'desktop'),
(1194, 142, 0, 'item4_cor_2', NULL, 0, '2014-10-09 00:57:30', '', '', 211, 88, 'texto', 'desktop'),
(1195, 142, 0, 'item4_alinhamento_2', NULL, 0, '2014-10-09 00:57:30', 'left', '', 211, 88, 'texto', 'desktop'),
(1196, 142, 0, 'item4_cor_3', NULL, 0, '2014-10-09 00:57:30', '', '', 211, 88, 'texto', 'desktop'),
(1197, 142, 0, 'item4_alinhamento_3', NULL, 0, '2014-10-09 00:57:30', 'left', '', 211, 88, 'texto', 'desktop'),
(1198, 142, 0, 'botao_exibe', 0, 0, '2014-10-09 00:57:30', NULL, '', 211, 88, 'inteiro', 'desktop'),
(1199, 142, 0, 'margin_top', 0, 0, '2014-10-09 00:57:30', NULL, '', 211, 88, 'inteiro', 'desktop'),
(1200, 142, 0, 'margin_bottom', 30, 0, '2014-10-09 00:57:30', NULL, '', 211, 88, 'inteiro', 'desktop'),
(1201, 142, 0, 'padding_top', 0, 0, '2014-10-09 00:57:30', NULL, '', 211, 88, 'inteiro', 'desktop'),
(1202, 142, 0, 'padding_bottom', 0, 0, '2014-10-09 00:57:30', NULL, '', 211, 88, 'inteiro', 'desktop'),
(1203, 142, 0, 'is_full', 0, 0, '2014-10-09 00:57:30', NULL, '', 211, 88, 'inteiro', 'desktop'),
(1204, 142, 0, 'background_type', 0, 0, '2014-10-09 00:57:30', NULL, '', 211, 88, 'inteiro', 'desktop'),
(1205, 142, 0, 'background', NULL, 0, '2014-10-09 00:57:30', '', '', 211, 88, 'texto', 'desktop'),
(1206, 1, 0, 'layout_1', NULL, 0, '2014-10-15 19:20:35', 'down', '', 207, 54, 'texto', 'desktop'),
(1207, 1, 0, 'is_full', 0, 0, '2014-10-15 19:20:36', NULL, '', 207, 54, 'inteiro', 'desktop'),
(1208, 143, 0, 'titulo_1', NULL, 0, '2014-10-15 19:25:55', NULL, 'Começe criando um template', 186, 89, 'texto', 'desktop'),
(1209, 143, 0, 'subtitulo_1', NULL, 0, '2014-10-15 19:25:55', NULL, 'Um template é uma sequencia de elementos que formam um layout', 186, 89, 'texto', 'desktop'),
(1210, 143, 0, 'texto_1', NULL, 0, '2014-10-15 19:25:55', NULL, 'Acesse: Relacionamento / Email Marketing / Criar Templates.\r\nDigite o nome do seu template e uma descrição para ser fácil de encontrar caso tenha dezenas deles.\r\nClique salvar. \r\nSeu template será criado e irá aparecer o Template Constructor, para você construir seu template.', 186, 89, 'texto', 'desktop'),
(1211, 143, 0, 'image_1', NULL, 0, '2014-10-15 19:25:55', 'captura_de_tela_2014_10_15_162452_g9.png', '', 186, 89, 'texto', 'desktop'),
(1212, 143, 0, 'layout_1', NULL, 0, '2014-10-15 19:25:55', 'left', '', 186, 89, 'texto', 'desktop'),
(1213, 143, 0, 'cor_1', NULL, 0, '2014-10-15 19:25:55', '', '', 186, 89, 'texto', 'desktop'),
(1214, 143, 0, 'cor_2', NULL, 0, '2014-10-15 19:25:55', '', '', 186, 89, 'texto', 'desktop'),
(1215, 143, 0, 'cor_3', NULL, 0, '2014-10-15 19:25:55', '', '', 186, 89, 'texto', 'desktop'),
(1216, 143, 0, 'alinhamento_1', NULL, 0, '2014-10-15 19:25:55', 'left', '', 186, 89, 'texto', 'desktop'),
(1217, 143, 0, 'alinhamento_2', NULL, 0, '2014-10-15 19:25:55', 'left', '', 186, 89, 'texto', 'desktop'),
(1218, 143, 0, 'alinhamento_3', NULL, 0, '2014-10-15 19:25:55', 'left', '', 186, 89, 'texto', 'desktop'),
(1219, 143, 0, 'margin_top', 10, 0, '2014-10-15 19:25:55', NULL, '', 186, 89, 'inteiro', 'desktop'),
(1220, 143, 0, 'margin_bottom', 20, 0, '2014-10-15 19:25:55', NULL, '', 186, 89, 'inteiro', 'desktop'),
(1221, 143, 0, 'padding_top', 0, 0, '2014-10-15 19:25:55', NULL, '', 186, 89, 'inteiro', 'desktop'),
(1222, 143, 0, 'padding_bottom', 0, 0, '2014-10-15 19:25:55', NULL, '', 186, 89, 'inteiro', 'desktop'),
(1223, 143, 0, 'is_full', 0, 0, '2014-10-15 19:25:55', NULL, '', 186, 89, 'inteiro', 'desktop'),
(1224, 143, 0, 'background_type', 0, 0, '2014-10-15 19:25:55', NULL, '', 186, 89, 'inteiro', 'desktop'),
(1225, 143, 0, 'background', NULL, 0, '2014-10-15 19:25:55', '', '', 186, 89, 'texto', 'desktop'),
(1226, 143, 0, 'titulo_1', NULL, 0, '2014-10-15 19:28:44', NULL, 'Template Constructor', 186, 90, 'texto', 'desktop'),
(1227, 143, 0, 'subtitulo_1', NULL, 0, '2014-10-15 19:28:44', NULL, 'Funcionalidade de escolher/editar componentes', 186, 90, 'texto', 'desktop'),
(1228, 143, 0, 'texto_1', NULL, 0, '2014-10-15 19:28:44', NULL, 'Para exbir os componentes que formarão seu template clique em \"adicionar\".\r\nUma tela será exibido com os componentes disponíveis até então.\r\nInicialmente os componentes estão abertos a todos e são grátis para os cientes PREMIUM', 186, 90, 'texto', 'desktop'),
(1229, 143, 0, 'image_1', NULL, 0, '2014-10-15 19:28:44', 'captura_de_tela_2014_10_15_162745_d6.png', '', 186, 90, 'texto', 'desktop'),
(1230, 143, 0, 'layout_1', NULL, 0, '2014-10-15 19:28:44', 'left', '', 186, 90, 'texto', 'desktop'),
(1231, 143, 0, 'cor_1', NULL, 0, '2014-10-15 19:28:44', '', '', 186, 90, 'texto', 'desktop'),
(1232, 143, 0, 'cor_2', NULL, 0, '2014-10-15 19:28:44', '', '', 186, 90, 'texto', 'desktop'),
(1233, 143, 0, 'cor_3', NULL, 0, '2014-10-15 19:28:44', '', '', 186, 90, 'texto', 'desktop'),
(1234, 143, 0, 'alinhamento_1', NULL, 0, '2014-10-15 19:28:45', 'left', '', 186, 90, 'texto', 'desktop'),
(1235, 143, 0, 'alinhamento_2', NULL, 0, '2014-10-15 19:28:45', 'left', '', 186, 90, 'texto', 'desktop'),
(1236, 143, 0, 'alinhamento_3', NULL, 0, '2014-10-15 19:28:45', 'left', '', 186, 90, 'texto', 'desktop'),
(1237, 143, 0, 'margin_top', 10, 0, '2014-10-15 19:28:45', NULL, '', 186, 90, 'inteiro', 'desktop'),
(1238, 143, 0, 'margin_bottom', 20, 0, '2014-10-15 19:28:45', NULL, '', 186, 90, 'inteiro', 'desktop'),
(1239, 143, 0, 'padding_top', 0, 0, '2014-10-15 19:28:45', NULL, '', 186, 90, 'inteiro', 'desktop'),
(1240, 143, 0, 'padding_bottom', 0, 0, '2014-10-15 19:28:45', NULL, '', 186, 90, 'inteiro', 'desktop'),
(1241, 143, 0, 'is_full', 0, 0, '2014-10-15 19:28:45', NULL, '', 186, 90, 'inteiro', 'desktop'),
(1242, 143, 0, 'background_type', 0, 0, '2014-10-15 19:28:45', NULL, '', 186, 90, 'inteiro', 'desktop'),
(1243, 143, 0, 'background', NULL, 0, '2014-10-15 19:28:45', '', '', 186, 90, 'texto', 'desktop'),
(1244, 143, 0, 'titulo_1', NULL, 0, '2014-10-15 19:30:17', NULL, 'Componentes para escolher e editar', 186, 91, 'texto', 'desktop'),
(1245, 143, 0, 'subtitulo_1', NULL, 0, '2014-10-15 19:30:17', NULL, 'São vários componentes para você escolher e adicionar ao seu template', 186, 91, 'texto', 'desktop'),
(1246, 143, 0, 'texto_1', NULL, 0, '2014-10-15 19:30:17', NULL, 'Cada componente tem sua diferenças, como somente imagem, textos e imagens, produtos lado a lado, redes sociais, topos, rodapés e por ai vai.\r\nSeu template tem que ter no mínimo 3 componentes: Topo, Rodapé e um de conteúdo.\r\nTOPO: importante pois é nele que é exibido o nome do destinatário. \"Olá Fulano\";\r\nRODAPÉ: é nele que são exibidos as informações de descadastramento, termos e condições e política de privacidade.\r\nCONTEÚDO: pode ter mais de um componente. Não é indicado o uso de uma única foto, pois é pesado e o usuário só verá caso clique em exibir imagens portanto, mescle imagens e textos', 186, 91, 'texto', 'desktop'),
(1247, 143, 0, 'image_1', NULL, 0, '2014-10-15 19:30:17', 'captura_de_tela_2014_10_15_162922_l1.png', '', 186, 91, 'texto', 'desktop'),
(1248, 143, 0, 'layout_1', NULL, 0, '2014-10-15 19:30:17', 'left', '', 186, 91, 'texto', 'desktop'),
(1249, 143, 0, 'cor_1', NULL, 0, '2014-10-15 19:30:17', '', '', 186, 91, 'texto', 'desktop'),
(1250, 143, 0, 'cor_2', NULL, 0, '2014-10-15 19:30:17', '', '', 186, 91, 'texto', 'desktop'),
(1251, 143, 0, 'cor_3', NULL, 0, '2014-10-15 19:30:17', '', '', 186, 91, 'texto', 'desktop'),
(1252, 143, 0, 'alinhamento_1', NULL, 0, '2014-10-15 19:30:17', 'left', '', 186, 91, 'texto', 'desktop'),
(1253, 143, 0, 'alinhamento_2', NULL, 0, '2014-10-15 19:30:17', 'left', '', 186, 91, 'texto', 'desktop'),
(1254, 143, 0, 'alinhamento_3', NULL, 0, '2014-10-15 19:30:17', 'left', '', 186, 91, 'texto', 'desktop'),
(1255, 143, 0, 'margin_top', 10, 0, '2014-10-15 19:30:17', NULL, '', 186, 91, 'inteiro', 'desktop'),
(1256, 143, 0, 'margin_bottom', 20, 0, '2014-10-15 19:30:17', NULL, '', 186, 91, 'inteiro', 'desktop'),
(1257, 143, 0, 'padding_top', 0, 0, '2014-10-15 19:30:17', NULL, '', 186, 91, 'inteiro', 'desktop'),
(1258, 143, 0, 'padding_bottom', 0, 0, '2014-10-15 19:30:17', NULL, '', 186, 91, 'inteiro', 'desktop'),
(1259, 143, 0, 'is_full', 0, 0, '2014-10-15 19:30:17', NULL, '', 186, 91, 'inteiro', 'desktop'),
(1260, 143, 0, 'background_type', 0, 0, '2014-10-15 19:30:17', NULL, '', 186, 91, 'inteiro', 'desktop'),
(1261, 143, 0, 'background', NULL, 0, '2014-10-15 19:30:17', '', '', 186, 91, 'texto', 'desktop'),
(1262, 143, 0, 'titulo_1', NULL, 0, '2014-10-15 19:32:53', NULL, 'Visualizando seu Template', 186, 92, 'texto', 'desktop'),
(1263, 143, 0, 'subtitulo_1', NULL, 0, '2014-10-15 19:32:53', NULL, 'Ideal para ir testando seus dons de criação, deixe uma aba aberta com o template para facilitar', 186, 92, 'texto', 'desktop'),
(1264, 143, 0, 'texto_1', NULL, 0, '2014-10-15 19:32:53', NULL, 'Para visualizar seu template é muito simples.\r\nClique acesse: Relacionamento / Email Marketing / Listar Templates\r\nTodos seus templates serão exibidos, pelo nome escolha qual deseja visualizar e clique no botão do lado esquerdo com o desenho do olho. Uma nova aba será aberta com seu layout. Cada alteraçào que fizer será refletida nesta tela. Portanto deixe-a aberta para ir visualizando suas alteração.\r\nEssa também será a tela que o usuário verá caso clique em: \"Não consegue visualizar clique aqui\".', 186, 92, 'texto', 'desktop'),
(1265, 143, 0, 'image_1', NULL, 0, '2014-10-15 19:32:53', 'captura_de_tela_2014_10_15_163152_u9.png', '', 186, 92, 'texto', 'desktop'),
(1266, 143, 0, 'layout_1', NULL, 0, '2014-10-15 19:32:53', 'left', '', 186, 92, 'texto', 'desktop'),
(1267, 143, 0, 'cor_1', NULL, 0, '2014-10-15 19:32:53', '', '', 186, 92, 'texto', 'desktop'),
(1268, 143, 0, 'cor_2', NULL, 0, '2014-10-15 19:32:53', '', '', 186, 92, 'texto', 'desktop'),
(1269, 143, 0, 'cor_3', NULL, 0, '2014-10-15 19:32:53', '', '', 186, 92, 'texto', 'desktop'),
(1270, 143, 0, 'alinhamento_1', NULL, 0, '2014-10-15 19:32:53', 'left', '', 186, 92, 'texto', 'desktop'),
(1271, 143, 0, 'alinhamento_2', NULL, 0, '2014-10-15 19:32:53', 'left', '', 186, 92, 'texto', 'desktop'),
(1272, 143, 0, 'alinhamento_3', NULL, 0, '2014-10-15 19:32:53', 'left', '', 186, 92, 'texto', 'desktop'),
(1273, 143, 0, 'margin_top', 10, 0, '2014-10-15 19:32:53', NULL, '', 186, 92, 'inteiro', 'desktop'),
(1274, 143, 0, 'margin_bottom', 20, 0, '2014-10-15 19:32:53', NULL, '', 186, 92, 'inteiro', 'desktop'),
(1275, 143, 0, 'padding_top', 0, 0, '2014-10-15 19:32:53', NULL, '', 186, 92, 'inteiro', 'desktop'),
(1276, 143, 0, 'padding_bottom', 0, 0, '2014-10-15 19:32:53', NULL, '', 186, 92, 'inteiro', 'desktop'),
(1277, 143, 0, 'is_full', 0, 0, '2014-10-15 19:32:54', NULL, '', 186, 92, 'inteiro', 'desktop'),
(1278, 143, 0, 'background_type', 0, 0, '2014-10-15 19:32:54', NULL, '', 186, 92, 'inteiro', 'desktop'),
(1279, 143, 0, 'background', NULL, 0, '2014-10-15 19:32:54', '', '', 186, 92, 'texto', 'desktop'),
(1280, 143, 0, 'titulo_1', NULL, 0, '2014-10-15 19:42:56', NULL, 'Entendo o que são suas campanhas', 186, 93, 'texto', 'desktop'),
(1281, 143, 0, 'subtitulo_1', NULL, 0, '2014-10-15 19:42:56', NULL, 'Simples: é o conjunto de template e destinatários que será disparado via seu Admin', 186, 93, 'texto', 'desktop'),
(1282, 143, 0, 'texto_1', NULL, 0, '2014-10-15 19:42:56', NULL, 'A campanhas pode ser acessadas a qualquer momento e re-disparadas a qualquer momento clicando no ícone do envelope.\r\nNesta tela temos todas as campanhas e as opções para o disparo da mesma, fora os botões excluir e editar que fazem o que seus nomes sugerem temos o botão templates para escolher um template, o botão usuário para escolher os destinatários e o botão disparar. Não fiquem com medo de clicar pois as ações importantes precisam de confirmação para serem executas e você será questionado se realmente deseja realizar a ação ou se deseja voltar.', 186, 93, 'texto', 'desktop'),
(1283, 143, 0, 'image_1', NULL, 0, '2014-10-15 19:42:56', 'captura_de_tela_2014_10_15_163914_g7.png', '', 186, 93, 'texto', 'desktop'),
(1284, 143, 0, 'layout_1', NULL, 0, '2014-10-15 19:42:56', 'left', '', 186, 93, 'texto', 'desktop'),
(1285, 143, 0, 'cor_1', NULL, 0, '2014-10-15 19:42:56', '', '', 186, 93, 'texto', 'desktop'),
(1286, 143, 0, 'cor_2', NULL, 0, '2014-10-15 19:42:56', '', '', 186, 93, 'texto', 'desktop'),
(1287, 143, 0, 'cor_3', NULL, 0, '2014-10-15 19:42:56', '', '', 186, 93, 'texto', 'desktop'),
(1288, 143, 0, 'alinhamento_1', NULL, 0, '2014-10-15 19:42:57', 'left', '', 186, 93, 'texto', 'desktop'),
(1289, 143, 0, 'alinhamento_2', NULL, 0, '2014-10-15 19:42:57', 'left', '', 186, 93, 'texto', 'desktop'),
(1290, 143, 0, 'alinhamento_3', NULL, 0, '2014-10-15 19:42:57', 'left', '', 186, 93, 'texto', 'desktop'),
(1291, 143, 0, 'margin_top', 10, 0, '2014-10-15 19:42:57', NULL, '', 186, 93, 'inteiro', 'desktop'),
(1292, 143, 0, 'margin_bottom', 20, 0, '2014-10-15 19:42:57', NULL, '', 186, 93, 'inteiro', 'desktop'),
(1293, 143, 0, 'padding_top', 0, 0, '2014-10-15 19:42:57', NULL, '', 186, 93, 'inteiro', 'desktop'),
(1294, 143, 0, 'padding_bottom', 0, 0, '2014-10-15 19:42:57', NULL, '', 186, 93, 'inteiro', 'desktop'),
(1295, 143, 0, 'is_full', 0, 0, '2014-10-15 19:42:57', NULL, '', 186, 93, 'inteiro', 'desktop'),
(1296, 143, 0, 'background_type', 0, 0, '2014-10-15 19:42:57', NULL, '', 186, 93, 'inteiro', 'desktop'),
(1297, 143, 0, 'background', NULL, 0, '2014-10-15 19:42:57', '', '', 186, 93, 'texto', 'desktop'),
(1298, 143, 0, 'titulo_1', NULL, 0, '2014-10-15 19:44:32', NULL, 'Os destinatários serão os escolhidos', 186, 94, 'texto', 'desktop'),
(1299, 143, 0, 'subtitulo_1', NULL, 0, '2014-10-15 19:44:32', NULL, 'Próximo passo escolha quem receberá seu e-mail marketing', 186, 94, 'texto', 'desktop'),
(1300, 143, 0, 'texto_1', NULL, 0, '2014-10-15 19:44:32', NULL, 'Quando clicado em usuário o popup ao lado será exibido e nele você terá as opções ao lado.\r\nAs opções são simples: Ou você envia para todos os usuários cadastrados na sua NewsLetter ou para os usuários que estão cadastrados no seu site. \r\nCaso opte por TODOS da newsletter, todos que assinaram sua newsletter e não foram removidos por disparos anteriores ou se descadastraram irão receber.\r\nCaso opte por uma das outras opções somente usuários cadastrados no seu site e que possuírem a tag com a opção escolhida receberão. Exemplo, você cadastra um usuário e adiciona a tag Fornecedor, Cliente e Representante. \r\nSe você escolher a opção somente para Fornecedores, ele irá receber o e-mail, mas nenhum cliente nem representante irá recebe-lá, para isso você deverá fazer um novo disparo escolhendo essa opção. ', 186, 94, 'texto', 'desktop'),
(1301, 143, 0, 'image_1', NULL, 0, '2014-10-15 19:44:32', 'captura_de_tela_2014_10_15_164347_b1.png', '', 186, 94, 'texto', 'desktop'),
(1302, 143, 0, 'layout_1', NULL, 0, '2014-10-15 19:44:32', 'left', '', 186, 94, 'texto', 'desktop'),
(1303, 143, 0, 'cor_1', NULL, 0, '2014-10-15 19:44:32', '', '', 186, 94, 'texto', 'desktop'),
(1304, 143, 0, 'cor_2', NULL, 0, '2014-10-15 19:44:32', '', '', 186, 94, 'texto', 'desktop'),
(1305, 143, 0, 'cor_3', NULL, 0, '2014-10-15 19:44:32', '', '', 186, 94, 'texto', 'desktop'),
(1306, 143, 0, 'alinhamento_1', NULL, 0, '2014-10-15 19:44:32', 'left', '', 186, 94, 'texto', 'desktop'),
(1307, 143, 0, 'alinhamento_2', NULL, 0, '2014-10-15 19:44:32', 'left', '', 186, 94, 'texto', 'desktop'),
(1308, 143, 0, 'alinhamento_3', NULL, 0, '2014-10-15 19:44:32', 'left', '', 186, 94, 'texto', 'desktop'),
(1309, 143, 0, 'margin_top', 10, 0, '2014-10-15 19:44:32', NULL, '', 186, 94, 'inteiro', 'desktop'),
(1310, 143, 0, 'margin_bottom', 20, 0, '2014-10-15 19:44:32', NULL, '', 186, 94, 'inteiro', 'desktop'),
(1311, 143, 0, 'padding_top', 0, 0, '2014-10-15 19:44:32', NULL, '', 186, 94, 'inteiro', 'desktop'),
(1312, 143, 0, 'padding_bottom', 0, 0, '2014-10-15 19:44:32', NULL, '', 186, 94, 'inteiro', 'desktop'),
(1313, 143, 0, 'is_full', 0, 0, '2014-10-15 19:44:32', NULL, '', 186, 94, 'inteiro', 'desktop'),
(1314, 143, 0, 'background_type', 0, 0, '2014-10-15 19:44:32', NULL, '', 186, 94, 'inteiro', 'desktop'),
(1315, 143, 0, 'background', NULL, 0, '2014-10-15 19:44:32', '', '', 186, 94, 'texto', 'desktop'),
(1316, 143, 0, 'titulo_1', NULL, 0, '2014-10-15 19:45:42', NULL, 'Adicione seu template a sua campanha', 186, 95, 'texto', 'desktop'),
(1317, 143, 0, 'subtitulo_1', NULL, 0, '2014-10-15 19:45:42', NULL, 'Uma campanha é formada por um template mais destinatários, caso não tenha um template crie um', 186, 95, 'texto', 'desktop'),
(1318, 143, 0, 'texto_1', NULL, 0, '2014-10-15 19:45:42', NULL, 'Adicione um template a sua campanha clicando no botão de template. Será aberto um popup com todos os templates que você criou, escolha qual deseja utilizar pelo nome e clique na linha.\r\nPronto o template foi adicionado e ícone de template deve ter passo de cinza para verde, informando que está ok.\r\nCaso queira, crie um novo template. A ordem não tem importância, apenas a campanha completa', 186, 95, 'texto', 'desktop'),
(1319, 143, 0, 'image_1', NULL, 0, '2014-10-15 19:45:42', 'captura_de_tela_2014_10_15_164503_h1.png', '', 186, 95, 'texto', 'desktop'),
(1320, 143, 0, 'layout_1', NULL, 0, '2014-10-15 19:45:42', 'left', '', 186, 95, 'texto', 'desktop'),
(1321, 143, 0, 'cor_1', NULL, 0, '2014-10-15 19:45:42', '', '', 186, 95, 'texto', 'desktop'),
(1322, 143, 0, 'cor_2', NULL, 0, '2014-10-15 19:45:42', '', '', 186, 95, 'texto', 'desktop'),
(1323, 143, 0, 'cor_3', NULL, 0, '2014-10-15 19:45:42', '', '', 186, 95, 'texto', 'desktop'),
(1324, 143, 0, 'alinhamento_1', NULL, 0, '2014-10-15 19:45:42', 'left', '', 186, 95, 'texto', 'desktop'),
(1325, 143, 0, 'alinhamento_2', NULL, 0, '2014-10-15 19:45:42', 'left', '', 186, 95, 'texto', 'desktop'),
(1326, 143, 0, 'alinhamento_3', NULL, 0, '2014-10-15 19:45:43', 'left', '', 186, 95, 'texto', 'desktop');
INSERT INTO `paginas_attribute` (`id`, `id_pagina`, `user_id`, `name`, `inteiro`, `number`, `estampa`, `texto`, `descricao`, `id_componente`, `id_row`, `tipo`, `plataforma`) VALUES
(1327, 143, 0, 'margin_top', 0, 0, '2014-10-15 19:45:43', NULL, '', 186, 95, 'inteiro', 'desktop'),
(1328, 143, 0, 'margin_bottom', 0, 0, '2014-10-15 19:45:43', NULL, '', 186, 95, 'inteiro', 'desktop'),
(1329, 143, 0, 'padding_top', 0, 0, '2014-10-15 19:45:43', NULL, '', 186, 95, 'inteiro', 'desktop'),
(1330, 143, 0, 'padding_bottom', 0, 0, '2014-10-15 19:45:43', NULL, '', 186, 95, 'inteiro', 'desktop'),
(1331, 143, 0, 'is_full', 0, 0, '2014-10-15 19:45:43', NULL, '', 186, 95, 'inteiro', 'desktop'),
(1332, 143, 0, 'background_type', 0, 0, '2014-10-15 19:45:43', NULL, '', 186, 95, 'inteiro', 'desktop'),
(1333, 143, 0, 'background', NULL, 0, '2014-10-15 19:45:43', '', '', 186, 95, 'texto', 'desktop'),
(1334, 143, 0, 'titulo_1', NULL, 0, '2014-10-15 19:46:53', NULL, 'Disparar, e suas opções de teste, cadastro e mais', 186, 96, 'texto', 'desktop'),
(1335, 143, 0, 'subtitulo_1', NULL, 0, '2014-10-15 19:46:53', NULL, 'Clicando no botão Disparar voc6e verá outras opções e pode voltar se desejar', 186, 96, 'texto', 'desktop'),
(1336, 143, 0, 'texto_1', NULL, 0, '2014-10-15 19:46:53', NULL, 'Clicar neste botão não requer sorte, experiência ou magia, é simples. Clique e verá.\r\nQuando clicado no botão do envelope, de disparar algumas opções serão exibidas. \r\nEnviar teste - envia um e-mail de teste para o e-mail cadastrado em: / Controle / Configurações / Email contato\r\nCadastrar Novo Usuário - Permite cadastrar e/ou enviar um e-mail. Não será repetido o email nunca\r\nDisparar - exibe tela de conferencia dos dados do disparo e botão voltar. Se clicar em voltar você poderá editar qualquer parte do e-mail marketing. Caso clique em disparar será disparado para o grupo que você escolheu.', 186, 96, 'texto', 'desktop'),
(1337, 143, 0, 'image_1', NULL, 0, '2014-10-15 19:46:53', 'captura_de_tela_2014_10_15_164624_w3.png', '', 186, 96, 'texto', 'desktop'),
(1338, 143, 0, 'layout_1', NULL, 0, '2014-10-15 19:46:53', 'left', '', 186, 96, 'texto', 'desktop'),
(1339, 143, 0, 'cor_1', NULL, 0, '2014-10-15 19:46:53', '', '', 186, 96, 'texto', 'desktop'),
(1340, 143, 0, 'cor_2', NULL, 0, '2014-10-15 19:46:53', '', '', 186, 96, 'texto', 'desktop'),
(1341, 143, 0, 'cor_3', NULL, 0, '2014-10-15 19:46:53', '', '', 186, 96, 'texto', 'desktop'),
(1342, 143, 0, 'alinhamento_1', NULL, 0, '2014-10-15 19:46:53', 'left', '', 186, 96, 'texto', 'desktop'),
(1343, 143, 0, 'alinhamento_2', NULL, 0, '2014-10-15 19:46:53', 'left', '', 186, 96, 'texto', 'desktop'),
(1344, 143, 0, 'alinhamento_3', NULL, 0, '2014-10-15 19:46:53', 'left', '', 186, 96, 'texto', 'desktop'),
(1345, 143, 0, 'margin_top', 10, 0, '2014-10-15 19:46:53', NULL, '', 186, 96, 'inteiro', 'desktop'),
(1346, 143, 0, 'margin_bottom', 20, 0, '2014-10-15 19:46:53', NULL, '', 186, 96, 'inteiro', 'desktop'),
(1347, 143, 0, 'padding_top', 0, 0, '2014-10-15 19:46:53', NULL, '', 186, 96, 'inteiro', 'desktop'),
(1348, 143, 0, 'padding_bottom', 0, 0, '2014-10-15 19:46:53', NULL, '', 186, 96, 'inteiro', 'desktop'),
(1349, 143, 0, 'is_full', 0, 0, '2014-10-15 19:46:53', NULL, '', 186, 96, 'inteiro', 'desktop'),
(1350, 143, 0, 'background_type', 0, 0, '2014-10-15 19:46:54', NULL, '', 186, 96, 'inteiro', 'desktop'),
(1351, 143, 0, 'background', NULL, 0, '2014-10-15 19:46:54', '', '', 186, 96, 'texto', 'desktop'),
(1352, 143, 0, 'titulo_1', NULL, 0, '2014-10-15 19:50:32', NULL, 'Disparo para um usuário específico, sim é possível', 186, 97, 'texto', 'desktop'),
(1353, 143, 0, 'subtitulo_1', NULL, 0, '2014-10-15 19:50:33', NULL, 'A opção ', 186, 97, 'texto', 'desktop'),
(1354, 143, 0, 'texto_1', NULL, 0, '2014-10-15 19:50:33', NULL, 'Essa opção deixa cadastrar um usuário novo na Newsletter e já enviar um e-mail para ele.\r\nO Poder desta funcionalidade é muito grande pois, você pode além de disparar um e-mail para um determinado cliente, cadastra-lo sem medo deste ser recadastrado pois o Newsletter só aceita um e-mail e não aceita e-mail repetidos.\r\nCom essa opção você pode enviar um e-mail para você de teste, para uma outra pessoa para testar ou para alguém que devia receber o newsletter e não recebeu pois ainda não estava cadastrado. \r\nCaso só deseje cadastrar o cliente e não enviar um e-mail para ele deixa desmarcado a opção enviar e-mail.', 186, 97, 'texto', 'desktop'),
(1355, 143, 0, 'image_1', NULL, 0, '2014-10-15 19:50:33', 'captura_de_tela_2014_10_15_164936_k9.png', '', 186, 97, 'texto', 'desktop'),
(1356, 143, 0, 'layout_1', NULL, 0, '2014-10-15 19:50:33', 'left', '', 186, 97, 'texto', 'desktop'),
(1357, 143, 0, 'cor_1', NULL, 0, '2014-10-15 19:50:33', '', '', 186, 97, 'texto', 'desktop'),
(1358, 143, 0, 'cor_2', NULL, 0, '2014-10-15 19:50:33', '', '', 186, 97, 'texto', 'desktop'),
(1359, 143, 0, 'cor_3', NULL, 0, '2014-10-15 19:50:33', '', '', 186, 97, 'texto', 'desktop'),
(1360, 143, 0, 'alinhamento_1', NULL, 0, '2014-10-15 19:50:33', 'left', '', 186, 97, 'texto', 'desktop'),
(1361, 143, 0, 'alinhamento_2', NULL, 0, '2014-10-15 19:50:33', 'left', '', 186, 97, 'texto', 'desktop'),
(1362, 143, 0, 'alinhamento_3', NULL, 0, '2014-10-15 19:50:33', 'left', '', 186, 97, 'texto', 'desktop'),
(1363, 143, 0, 'margin_top', 10, 0, '2014-10-15 19:50:33', NULL, '', 186, 97, 'inteiro', 'desktop'),
(1364, 143, 0, 'margin_bottom', 20, 0, '2014-10-15 19:50:33', NULL, '', 186, 97, 'inteiro', 'desktop'),
(1365, 143, 0, 'padding_top', 0, 0, '2014-10-15 19:50:33', NULL, '', 186, 97, 'inteiro', 'desktop'),
(1366, 143, 0, 'padding_bottom', 0, 0, '2014-10-15 19:50:33', NULL, '', 186, 97, 'inteiro', 'desktop'),
(1367, 143, 0, 'is_full', 0, 0, '2014-10-15 19:50:33', NULL, '', 186, 97, 'inteiro', 'desktop'),
(1368, 143, 0, 'background_type', 0, 0, '2014-10-15 19:50:33', NULL, '', 186, 97, 'inteiro', 'desktop'),
(1369, 143, 0, 'background', NULL, 0, '2014-10-15 19:50:33', '', '', 186, 97, 'texto', 'desktop'),
(1370, 143, 0, 'titulo_1', NULL, 0, '2014-10-15 20:01:46', NULL, 'Estatísticas para analisar seu disparo', 186, 98, 'texto', 'desktop'),
(1371, 143, 0, 'subtitulo_1', NULL, 0, '2014-10-15 20:01:46', NULL, 'As estatíticas são os meios de identificar como sua campanhas estão sendo recebidas pelos destinatários', 186, 98, 'texto', 'desktop'),
(1372, 143, 0, 'texto_1', NULL, 0, '2014-10-15 20:01:47', NULL, 'As estatísticas podem ser acessadas por: Relacionamento / Email Marketing / Estatísticas e são divididas em duas partes\r\nA primeira é a Geral que informa por mês as atividades diárias de seus disparos. Quantos foram disparados, abertos, clicado, retornaram entre outras opções.\r\nAs estatísticas também podem ser mais especificas como quem clicou, quem abriu, quem deu erro, qual cidade foi efetuada essa ação e etc.\r\nPara isso basta trocar a opção Geral por uma das opções das abas.', 186, 98, 'texto', 'desktop'),
(1373, 143, 0, 'image_1', NULL, 0, '2014-10-15 20:01:47', 'captura_de_tela_2014_10_15_170034_a4.png', '', 186, 98, 'texto', 'desktop'),
(1374, 143, 0, 'layout_1', NULL, 0, '2014-10-15 20:01:47', 'left', '', 186, 98, 'texto', 'desktop'),
(1375, 143, 0, 'cor_1', NULL, 0, '2014-10-15 20:01:47', '', '', 186, 98, 'texto', 'desktop'),
(1376, 143, 0, 'cor_2', NULL, 0, '2014-10-15 20:01:47', '', '', 186, 98, 'texto', 'desktop'),
(1377, 143, 0, 'cor_3', NULL, 0, '2014-10-15 20:01:47', '', '', 186, 98, 'texto', 'desktop'),
(1378, 143, 0, 'alinhamento_1', NULL, 0, '2014-10-15 20:01:47', 'left', '', 186, 98, 'texto', 'desktop'),
(1379, 143, 0, 'alinhamento_2', NULL, 0, '2014-10-15 20:01:47', 'left', '', 186, 98, 'texto', 'desktop'),
(1380, 143, 0, 'alinhamento_3', NULL, 0, '2014-10-15 20:01:47', 'left', '', 186, 98, 'texto', 'desktop'),
(1381, 143, 0, 'margin_top', 10, 0, '2014-10-15 20:01:47', NULL, '', 186, 98, 'inteiro', 'desktop'),
(1382, 143, 0, 'margin_bottom', 20, 0, '2014-10-15 20:01:47', NULL, '', 186, 98, 'inteiro', 'desktop'),
(1383, 143, 0, 'padding_top', 0, 0, '2014-10-15 20:01:47', NULL, '', 186, 98, 'inteiro', 'desktop'),
(1384, 143, 0, 'padding_bottom', 0, 0, '2014-10-15 20:01:47', NULL, '', 186, 98, 'inteiro', 'desktop'),
(1385, 143, 0, 'is_full', 0, 0, '2014-10-15 20:01:47', NULL, '', 186, 98, 'inteiro', 'desktop'),
(1386, 143, 0, 'background_type', 0, 0, '2014-10-15 20:01:47', NULL, '', 186, 98, 'inteiro', 'desktop'),
(1387, 143, 0, 'background', NULL, 0, '2014-10-15 20:01:47', '', '', 186, 98, 'texto', 'desktop'),
(1388, 143, 0, 'titulo_1', NULL, 0, '2014-10-15 20:03:15', NULL, 'Estatíticas específicas de Usuários, Cidades e erros', 186, 99, 'texto', 'desktop'),
(1389, 143, 0, 'subtitulo_1', NULL, 0, '2014-10-15 20:03:15', NULL, 'Com as estatíticas específicas voc6e fica informado de tudo que acontece com seus e-mail', 186, 99, 'texto', 'desktop'),
(1390, 143, 0, 'texto_1', NULL, 0, '2014-10-15 20:03:15', NULL, 'Utilizando as abas de e-mail Clicados, Abertos e Erros você pode ver as cidades dos usuários, os emails deles e a data que foi executada a ação. \r\nLembre-se que um email enviado em um dia pode ser aberto um ou dois dias após seu envio, dependendo da ação do usuário.', 186, 99, 'texto', 'desktop'),
(1391, 143, 0, 'image_1', NULL, 0, '2014-10-15 20:03:15', 'captura_de_tela_2014_10_15_170222_g0.png', '', 186, 99, 'texto', 'desktop'),
(1392, 143, 0, 'layout_1', NULL, 0, '2014-10-15 20:03:15', 'left', '', 186, 99, 'texto', 'desktop'),
(1393, 143, 0, 'cor_1', NULL, 0, '2014-10-15 20:03:15', '', '', 186, 99, 'texto', 'desktop'),
(1394, 143, 0, 'cor_2', NULL, 0, '2014-10-15 20:03:15', '', '', 186, 99, 'texto', 'desktop'),
(1395, 143, 0, 'cor_3', NULL, 0, '2014-10-15 20:03:15', '', '', 186, 99, 'texto', 'desktop'),
(1396, 143, 0, 'alinhamento_1', NULL, 0, '2014-10-15 20:03:15', 'left', '', 186, 99, 'texto', 'desktop'),
(1397, 143, 0, 'alinhamento_2', NULL, 0, '2014-10-15 20:03:15', 'left', '', 186, 99, 'texto', 'desktop'),
(1398, 143, 0, 'alinhamento_3', NULL, 0, '2014-10-15 20:03:15', 'left', '', 186, 99, 'texto', 'desktop'),
(1399, 143, 0, 'margin_top', 10, 0, '2014-10-15 20:03:15', NULL, '', 186, 99, 'inteiro', 'desktop'),
(1400, 143, 0, 'margin_bottom', 20, 0, '2014-10-15 20:03:15', NULL, '', 186, 99, 'inteiro', 'desktop'),
(1401, 143, 0, 'padding_top', 0, 0, '2014-10-15 20:03:15', NULL, '', 186, 99, 'inteiro', 'desktop'),
(1402, 143, 0, 'padding_bottom', 0, 0, '2014-10-15 20:03:15', NULL, '', 186, 99, 'inteiro', 'desktop'),
(1403, 143, 0, 'is_full', 0, 0, '2014-10-15 20:03:15', NULL, '', 186, 99, 'inteiro', 'desktop'),
(1404, 143, 0, 'background_type', 0, 0, '2014-10-15 20:03:15', NULL, '', 186, 99, 'inteiro', 'desktop'),
(1405, 143, 0, 'background', NULL, 0, '2014-10-15 20:03:15', '', '', 186, 99, 'texto', 'desktop'),
(1406, 143, 0, 'titulo_1', NULL, 0, '2014-10-15 20:42:05', NULL, 'Criando uma campanha', 186, 100, 'texto', 'desktop'),
(1407, 143, 0, 'subtitulo_1', NULL, 0, '2014-10-15 20:42:05', NULL, 'Uma campanha é um conjunto de destinatários e template', 186, 100, 'texto', 'desktop'),
(1408, 143, 0, 'texto_1', NULL, 0, '2014-10-15 20:42:05', NULL, 'Para criar uma campanha é muito fácil assim como qualquer outro conteúdo do PurplePier. \r\nAcesse: Relacionamento / Email Marketing / Criar Campanha a tela ao lado será exibida é nela que o título do seu e-mail será criado, portanto preste atenção no Título, pois esse será o título do e-mail que todos irão receber.\r\nNão utilize palavras como Importante, Promoção, Urgente pois os Servidores de e-mail classificam o e-mail como SPAM.\r\nTambém não utilize caixa ALTA, essas palavras em letras maiúsculas nem no seu texto.\r\nApós criado a campanha clique em listar para continuar o preparo do seu bolo, digo e-mail marketing, rs!', 186, 100, 'texto', 'desktop'),
(1409, 143, 0, 'image_1', NULL, 0, '2014-10-15 20:42:05', 'captura_de_tela_2014_10_15_173551_o7.png', '', 186, 100, 'texto', 'desktop'),
(1410, 143, 0, 'layout_1', NULL, 0, '2014-10-15 20:42:05', 'left', '', 186, 100, 'texto', 'desktop'),
(1411, 143, 0, 'cor_1', NULL, 0, '2014-10-15 20:42:05', '', '', 186, 100, 'texto', 'desktop'),
(1412, 143, 0, 'cor_2', NULL, 0, '2014-10-15 20:42:05', '', '', 186, 100, 'texto', 'desktop'),
(1413, 143, 0, 'cor_3', NULL, 0, '2014-10-15 20:42:05', '', '', 186, 100, 'texto', 'desktop'),
(1414, 143, 0, 'alinhamento_1', NULL, 0, '2014-10-15 20:42:05', 'left', '', 186, 100, 'texto', 'desktop'),
(1415, 143, 0, 'alinhamento_2', NULL, 0, '2014-10-15 20:42:05', 'left', '', 186, 100, 'texto', 'desktop'),
(1416, 143, 0, 'alinhamento_3', NULL, 0, '2014-10-15 20:42:05', 'left', '', 186, 100, 'texto', 'desktop'),
(1417, 143, 0, 'margin_top', 10, 0, '2014-10-15 20:42:05', NULL, '', 186, 100, 'inteiro', 'desktop'),
(1418, 143, 0, 'margin_bottom', 20, 0, '2014-10-15 20:42:05', NULL, '', 186, 100, 'inteiro', 'desktop'),
(1419, 143, 0, 'padding_top', 0, 0, '2014-10-15 20:42:05', NULL, '', 186, 100, 'inteiro', 'desktop'),
(1420, 143, 0, 'padding_bottom', 0, 0, '2014-10-15 20:42:05', NULL, '', 186, 100, 'inteiro', 'desktop'),
(1421, 143, 0, 'is_full', 0, 0, '2014-10-15 20:42:05', NULL, '', 186, 100, 'inteiro', 'desktop'),
(1422, 143, 0, 'background_type', 0, 0, '2014-10-15 20:42:05', NULL, '', 186, 100, 'inteiro', 'desktop'),
(1423, 143, 0, 'background', NULL, 0, '2014-10-15 20:42:05', '', '', 186, 100, 'texto', 'desktop'),
(1424, 143, 0, 'titulo_1', NULL, 0, '2014-10-15 21:43:33', NULL, 'PierMail - Veja como que funciona nosso disparador de e-mails', 207, 101, 'texto', 'desktop'),
(1425, 143, 0, 'subtitulo_1', NULL, 0, '2014-10-15 21:43:33', NULL, 'O PierMail possui um sistema exclusivo de criação de templates personalizáveis e responsívos', 207, 101, 'texto', 'desktop'),
(1426, 143, 0, 'texto_1', NULL, 0, '2014-10-15 21:43:33', NULL, 'Utilizando o sistema de Criação de Templates do PurplePier você cria templates perfeitos para todos os dispositivos e pode editá-los de forma simples e rápidas. \r\nCom o PierMail você pode disparar quantos e-mails quiser, ver as estatística e só pagar pelo que utilizar ', 207, 101, 'texto', 'desktop'),
(1427, 143, 0, 'image_1', NULL, 0, '2014-10-15 21:43:33', '', '', 207, 101, 'texto', 'desktop'),
(1428, 143, 0, 'layout_1', NULL, 0, '2014-10-15 21:43:33', 'up', '', 207, 101, 'texto', 'desktop'),
(1429, 143, 0, 'cor_1', NULL, 0, '2014-10-15 21:43:33', 'FFFFFF', '', 207, 101, 'texto', 'desktop'),
(1430, 143, 0, 'cor_2', NULL, 0, '2014-10-15 21:43:33', 'FFFFFF', '', 207, 101, 'texto', 'desktop'),
(1431, 143, 0, 'cor_3', NULL, 0, '2014-10-15 21:43:33', 'FFFFFF', '', 207, 101, 'texto', 'desktop'),
(1432, 143, 0, 'alinhamento_1', NULL, 0, '2014-10-15 21:43:33', 'left', '', 207, 101, 'texto', 'desktop'),
(1433, 143, 0, 'alinhamento_2', NULL, 0, '2014-10-15 21:43:33', 'left', '', 207, 101, 'texto', 'desktop'),
(1434, 143, 0, 'alinhamento_3', NULL, 0, '2014-10-15 21:43:33', 'left', '', 207, 101, 'texto', 'desktop'),
(1435, 143, 0, 'margin_top', 10, 0, '2014-10-15 21:43:33', NULL, '', 207, 101, 'inteiro', 'desktop'),
(1436, 143, 0, 'margin_bottom', 20, 0, '2014-10-15 21:43:33', NULL, '', 207, 101, 'inteiro', 'desktop'),
(1437, 143, 0, 'padding_top', 0, 0, '2014-10-15 21:43:33', NULL, '', 207, 101, 'inteiro', 'desktop'),
(1438, 143, 0, 'padding_bottom', 0, 0, '2014-10-15 21:43:33', NULL, '', 207, 101, 'inteiro', 'desktop'),
(1439, 143, 0, 'is_full', 0, 0, '2014-10-15 21:43:33', NULL, '', 207, 101, 'inteiro', 'desktop'),
(1440, 143, 0, 'background_type', 0, 0, '2014-10-15 21:43:33', NULL, '', 207, 101, 'inteiro', 'desktop'),
(1441, 143, 0, 'background', NULL, 0, '2014-10-15 21:43:33', '', '', 207, 101, 'texto', 'desktop'),
(1442, 1, 0, 'link_1', NULL, 0, '2014-10-16 17:13:04', NULL, '/piermail', 207, 54, 'texto', 'desktop'),
(1443, 1, 0, 'titulo_componente', NULL, 0, '2014-10-16 17:13:04', 'PierMail Banner', '', 207, 54, 'texto', 'desktop'),
(1444, 134, 0, 'titulo_1', NULL, 0, '2014-10-16 22:35:06', NULL, ' Purplepier - Sites com Sistema de Gerenciamento de Conteúdo', 186, 102, 'texto', 'desktop'),
(1445, 134, 0, 'subtitulo_1', NULL, 0, '2014-10-16 22:35:06', NULL, 'Tenha total autonomia sobre o seu site com Pier Admin 2.0', 186, 102, 'texto', 'desktop'),
(1446, 134, 0, 'texto_1', NULL, 0, '2014-10-16 22:35:06', NULL, 'Atualmente você administra seu próprio site? Ou ainda está na dependência de quem desenvolveu para você?\r\n\r\nO PurplePier, criou, desenvolveu e hoje disponibiliza a você, uma ferramenta fantástica, capaz de lhe proporcionar a independência que você precisa para atualização de seu Web Site, o Pier Admin 2.0.\r\n\r\nCliente Purplepier adquiri em qualquer plano de web site o Gerenciamento de Conteúdo (CMS).\r\n\r\nCMS - Content Management System (Sistema de Gerenciamento de Conteúdo)\r\n\r\nO sistema de gerenciamento de conteúdo, disponibiliza ao usuário autonomia de controlar todo o conteúdo de um website, como as notícias publicadas, eventos, galerias de imagens, itens de menu, cores das páginas, layout do site, enquetes e muito mais.\r\n\r\nO Purplepier oferece tudo isso a você de uma forma simplificada, com muita facilidade e agilidade.\r\n\r\nA principal característica da construção de sites gerenciáveis é a facilidade de manutenção. Ao optar por criar um site gerenciável você mesmo poderá atualizar o conteúdo do seu site via painel administrativo sem nenhum custo de manutenção ou conhecimento técnico.\r\n', 186, 102, 'texto', 'desktop'),
(1447, 134, 0, 'link_1', NULL, 0, '2014-10-16 22:35:07', NULL, '', 186, 102, 'texto', 'desktop'),
(1448, 134, 0, 'image_1', NULL, 0, '2014-10-16 22:35:07', 'f_876', '', 186, 102, 'image', 'desktop'),
(1449, 134, 0, 'layout_1', NULL, 0, '2014-10-16 22:35:07', 'left', '', 186, 102, 'texto', 'desktop'),
(1450, 134, 0, 'cor_1', NULL, 0, '2014-10-16 22:35:07', '', '', 186, 102, 'texto', 'desktop'),
(1451, 134, 0, 'cor_2', NULL, 0, '2014-10-16 22:35:07', '', '', 186, 102, 'texto', 'desktop'),
(1452, 134, 0, 'cor_3', NULL, 0, '2014-10-16 22:35:07', '', '', 186, 102, 'texto', 'desktop'),
(1453, 134, 0, 'alinhamento_1', NULL, 0, '2014-10-16 22:35:07', 'left', '', 186, 102, 'texto', 'desktop'),
(1454, 134, 0, 'alinhamento_2', NULL, 0, '2014-10-16 22:35:07', 'left', '', 186, 102, 'texto', 'desktop'),
(1455, 134, 0, 'alinhamento_3', NULL, 0, '2014-10-16 22:35:07', 'left', '', 186, 102, 'texto', 'desktop'),
(1456, 134, 0, 'margin_top', 0, 0, '2014-10-16 22:35:07', NULL, '', 186, 102, 'inteiro', 'desktop'),
(1457, 134, 0, 'margin_bottom', 0, 0, '2014-10-16 22:35:07', NULL, '', 186, 102, 'inteiro', 'desktop'),
(1458, 134, 0, 'padding_top', 0, 0, '2014-10-16 22:35:07', NULL, '', 186, 102, 'inteiro', 'desktop'),
(1459, 134, 0, 'padding_bottom', 0, 0, '2014-10-16 22:35:07', NULL, '', 186, 102, 'inteiro', 'desktop'),
(1460, 134, 0, 'is_full', 0, 0, '2014-10-16 22:35:07', NULL, '', 186, 102, 'inteiro', 'desktop'),
(1461, 134, 0, 'titulo_componente', NULL, 0, '2014-10-16 22:35:07', 'Parte 1', '', 186, 102, 'texto', 'desktop'),
(1462, 134, 0, 'background_type', 0, 0, '2014-10-16 22:35:07', NULL, '', 186, 102, 'inteiro', 'desktop'),
(1463, 134, 0, 'background', NULL, 0, '2014-10-16 22:35:07', '', '', 186, 102, 'texto', 'desktop'),
(1464, 134, 0, 'titulo_1', NULL, 0, '2014-10-16 22:39:55', NULL, 'Com o Pier Admin 2.0 - Você altera seu web site quantas vezes quiser!', 186, 103, 'texto', 'desktop'),
(1465, 134, 0, 'subtitulo_1', NULL, 0, '2014-10-16 22:39:55', NULL, 'O sistema Purplepier apresenta uma interface amigável, e de fácil acesso.', 186, 103, 'texto', 'desktop'),
(1466, 134, 0, 'texto_1', NULL, 0, '2014-10-16 22:39:55', NULL, '- Qualquer usuário cadastrado poderá manipular facilmente o web site; <br>\r\n- Tendo ou não conhecimento técnico de informática; <br>\r\n- Alteração poderá ser feita de qualquer computador, basta ter acesso a internet;\r\n\r\n\r\n', 186, 103, 'texto', 'desktop'),
(1467, 134, 0, 'link_1', NULL, 0, '2014-10-16 22:39:55', NULL, '', 186, 103, 'texto', 'desktop'),
(1468, 134, 0, 'image_1', NULL, 0, '2014-10-16 22:39:56', 'f_877', '', 186, 103, 'image', 'desktop'),
(1469, 134, 0, 'layout_1', NULL, 0, '2014-10-16 22:39:56', 'left', '', 186, 103, 'texto', 'desktop'),
(1470, 134, 0, 'cor_1', NULL, 0, '2014-10-16 22:39:56', '', '', 186, 103, 'texto', 'desktop'),
(1471, 134, 0, 'cor_2', NULL, 0, '2014-10-16 22:39:56', '', '', 186, 103, 'texto', 'desktop'),
(1472, 134, 0, 'cor_3', NULL, 0, '2014-10-16 22:39:56', '', '', 186, 103, 'texto', 'desktop'),
(1473, 134, 0, 'alinhamento_1', NULL, 0, '2014-10-16 22:39:56', 'left', '', 186, 103, 'texto', 'desktop'),
(1474, 134, 0, 'alinhamento_2', NULL, 0, '2014-10-16 22:39:56', 'left', '', 186, 103, 'texto', 'desktop'),
(1475, 134, 0, 'alinhamento_3', NULL, 0, '2014-10-16 22:39:56', 'left', '', 186, 103, 'texto', 'desktop'),
(1476, 134, 0, 'margin_top', 0, 0, '2014-10-16 22:39:56', NULL, '', 186, 103, 'inteiro', 'desktop'),
(1477, 134, 0, 'margin_bottom', 30, 0, '2014-10-16 22:39:56', NULL, '', 186, 103, 'inteiro', 'desktop'),
(1478, 134, 0, 'padding_top', 0, 0, '2014-10-16 22:39:56', NULL, '', 186, 103, 'inteiro', 'desktop'),
(1479, 134, 0, 'padding_bottom', 20, 0, '2014-10-16 22:39:56', NULL, '', 186, 103, 'inteiro', 'desktop'),
(1480, 134, 0, 'is_full', 0, 0, '2014-10-16 22:39:56', NULL, '', 186, 103, 'inteiro', 'desktop'),
(1481, 134, 0, 'titulo_componente', NULL, 0, '2014-10-16 22:39:56', 'Parte 2', '', 186, 103, 'texto', 'desktop'),
(1482, 134, 0, 'background_type', 0, 0, '2014-10-16 22:39:56', NULL, '', 186, 103, 'inteiro', 'desktop'),
(1483, 134, 0, 'background', NULL, 0, '2014-10-16 22:39:56', '', '', 186, 103, 'texto', 'desktop'),
(1484, 134, 0, 'titulo_1', NULL, 0, '2014-10-16 22:42:11', NULL, ' Você paga apenas a hospedagem, e fica livre de qualquer custo de manutenção.', 186, 104, 'texto', 'desktop'),
(1485, 134, 0, 'subtitulo_1', NULL, 0, '2014-10-16 22:42:11', NULL, 'São vários componentes já prontos para você incrementar seu site.', 186, 104, 'texto', 'desktop'),
(1486, 134, 0, 'texto_1', NULL, 0, '2014-10-16 22:42:11', NULL, '- sistema trabalha em tempo real, todo o conteúdo alterado é instantaneamente publicado no web site;\r\n\r\n', 186, 104, 'texto', 'desktop'),
(1487, 134, 0, 'link_1', NULL, 0, '2014-10-16 22:42:11', NULL, '', 186, 104, 'texto', 'desktop'),
(1488, 134, 0, 'image_1', NULL, 0, '2014-10-16 22:42:11', 'f_878', '', 186, 104, 'image', 'desktop'),
(1489, 134, 0, 'layout_1', NULL, 0, '2014-10-16 22:42:11', 'left', '', 186, 104, 'texto', 'desktop'),
(1490, 134, 0, 'cor_1', NULL, 0, '2014-10-16 22:42:11', '', '', 186, 104, 'texto', 'desktop'),
(1491, 134, 0, 'cor_2', NULL, 0, '2014-10-16 22:42:11', '', '', 186, 104, 'texto', 'desktop'),
(1492, 134, 0, 'cor_3', NULL, 0, '2014-10-16 22:42:11', '', '', 186, 104, 'texto', 'desktop'),
(1493, 134, 0, 'alinhamento_1', NULL, 0, '2014-10-16 22:42:11', 'left', '', 186, 104, 'texto', 'desktop'),
(1494, 134, 0, 'alinhamento_2', NULL, 0, '2014-10-16 22:42:11', 'left', '', 186, 104, 'texto', 'desktop'),
(1495, 134, 0, 'alinhamento_3', NULL, 0, '2014-10-16 22:42:11', 'left', '', 186, 104, 'texto', 'desktop'),
(1496, 134, 0, 'margin_top', 0, 0, '2014-10-16 22:42:11', NULL, '', 186, 104, 'inteiro', 'desktop'),
(1497, 134, 0, 'margin_bottom', 20, 0, '2014-10-16 22:42:11', NULL, '', 186, 104, 'inteiro', 'desktop'),
(1498, 134, 0, 'padding_top', 0, 0, '2014-10-16 22:42:11', NULL, '', 186, 104, 'inteiro', 'desktop'),
(1499, 134, 0, 'padding_bottom', 30, 0, '2014-10-16 22:42:11', NULL, '', 186, 104, 'inteiro', 'desktop'),
(1500, 134, 0, 'is_full', 0, 0, '2014-10-16 22:42:11', NULL, '', 186, 104, 'inteiro', 'desktop'),
(1501, 134, 0, 'titulo_componente', NULL, 0, '2014-10-16 22:42:11', 'Parte 3', '', 186, 104, 'texto', 'desktop'),
(1502, 134, 0, 'background_type', 0, 0, '2014-10-16 22:42:11', NULL, '', 186, 104, 'inteiro', 'desktop'),
(1503, 134, 0, 'background', NULL, 0, '2014-10-16 22:42:11', '', '', 186, 104, 'texto', 'desktop'),
(1504, 134, 0, 'titulo_1', NULL, 0, '2014-10-16 22:44:23', NULL, 'Esta gostando? Então continue navegando, pois ainda temos mais para te oferecer!', 186, 105, 'texto', 'desktop'),
(1505, 134, 0, 'subtitulo_1', NULL, 0, '2014-10-16 22:44:23', NULL, ' O Pier Admin 2.0, oferece a possilidade de você escolher e alterar o layout do seu site quando você quiser.', 186, 105, 'texto', 'desktop'),
(1506, 134, 0, 'texto_1', NULL, 0, '2014-10-16 22:44:23', NULL, 'São vários componetes a sua disposição, é só escolher!\r\nVeja quantas opções o sistema oferece para você editar e alterar o seu site.\r\nE ainda dentro do layout escolhido, você poderá alterar tudo o que quiser. Desde o Topo, rodapés, menu, banners, texturas, etc.\r\n', 186, 105, 'texto', 'desktop'),
(1507, 134, 0, 'link_1', NULL, 0, '2014-10-16 22:44:23', NULL, '', 186, 105, 'texto', 'desktop'),
(1508, 134, 0, 'image_1', NULL, 0, '2014-10-16 22:44:23', 'f_879', '', 186, 105, 'image', 'desktop'),
(1509, 134, 0, 'layout_1', NULL, 0, '2014-10-16 22:44:23', 'left', '', 186, 105, 'texto', 'desktop'),
(1510, 134, 0, 'cor_1', NULL, 0, '2014-10-16 22:44:23', '', '', 186, 105, 'texto', 'desktop'),
(1511, 134, 0, 'cor_2', NULL, 0, '2014-10-16 22:44:23', '', '', 186, 105, 'texto', 'desktop'),
(1512, 134, 0, 'cor_3', NULL, 0, '2014-10-16 22:44:23', '', '', 186, 105, 'texto', 'desktop'),
(1513, 134, 0, 'alinhamento_1', NULL, 0, '2014-10-16 22:44:23', 'left', '', 186, 105, 'texto', 'desktop'),
(1514, 134, 0, 'alinhamento_2', NULL, 0, '2014-10-16 22:44:23', 'left', '', 186, 105, 'texto', 'desktop'),
(1515, 134, 0, 'alinhamento_3', NULL, 0, '2014-10-16 22:44:23', 'left', '', 186, 105, 'texto', 'desktop'),
(1516, 134, 0, 'margin_top', 0, 0, '2014-10-16 22:44:23', NULL, '', 186, 105, 'inteiro', 'desktop'),
(1517, 134, 0, 'margin_bottom', 0, 0, '2014-10-16 22:44:23', NULL, '', 186, 105, 'inteiro', 'desktop'),
(1518, 134, 0, 'padding_top', 0, 0, '2014-10-16 22:44:23', NULL, '', 186, 105, 'inteiro', 'desktop'),
(1519, 134, 0, 'padding_bottom', 0, 0, '2014-10-16 22:44:23', NULL, '', 186, 105, 'inteiro', 'desktop'),
(1520, 134, 0, 'is_full', 0, 0, '2014-10-16 22:44:24', NULL, '', 186, 105, 'inteiro', 'desktop'),
(1521, 134, 0, 'titulo_componente', NULL, 0, '2014-10-16 22:44:24', 'Parte 4', '', 186, 105, 'texto', 'desktop'),
(1522, 134, 0, 'background_type', 0, 0, '2014-10-16 22:44:24', NULL, '', 186, 105, 'inteiro', 'desktop'),
(1523, 134, 0, 'background', NULL, 0, '2014-10-16 22:44:24', '', '', 186, 105, 'texto', 'desktop'),
(1524, 134, 0, 'titulo_1', NULL, 0, '2014-10-16 22:45:03', NULL, '', 186, 106, 'texto', 'desktop'),
(1525, 134, 0, 'subtitulo_1', NULL, 0, '2014-10-16 22:45:03', NULL, '', 186, 106, 'texto', 'desktop'),
(1526, 134, 0, 'texto_1', NULL, 0, '2014-10-16 22:45:03', NULL, 'O que você esta esperando, entre logo em contato com o PurplePier.\r\nNós temos a ferramenta certa! Ela é tudo o que você precisa para administrar seu web site.\r\n\r\nTodos os nossos preços são informados por email.', 186, 106, 'texto', 'desktop'),
(1527, 134, 0, 'link_1', NULL, 0, '2014-10-16 22:45:03', NULL, '', 186, 106, 'texto', 'desktop'),
(1528, 134, 0, 'image_1', NULL, 0, '2014-10-16 22:45:03', '', '', 186, 106, 'image', 'desktop'),
(1529, 134, 0, 'layout_1', NULL, 0, '2014-10-16 22:45:03', 'left', '', 186, 106, 'texto', 'desktop'),
(1530, 134, 0, 'cor_1', NULL, 0, '2014-10-16 22:45:03', '', '', 186, 106, 'texto', 'desktop'),
(1531, 134, 0, 'cor_2', NULL, 0, '2014-10-16 22:45:03', '', '', 186, 106, 'texto', 'desktop'),
(1532, 134, 0, 'cor_3', NULL, 0, '2014-10-16 22:45:03', '', '', 186, 106, 'texto', 'desktop'),
(1533, 134, 0, 'alinhamento_1', NULL, 0, '2014-10-16 22:45:03', 'left', '', 186, 106, 'texto', 'desktop'),
(1534, 134, 0, 'alinhamento_2', NULL, 0, '2014-10-16 22:45:03', 'left', '', 186, 106, 'texto', 'desktop'),
(1535, 134, 0, 'alinhamento_3', NULL, 0, '2014-10-16 22:45:03', 'left', '', 186, 106, 'texto', 'desktop'),
(1536, 134, 0, 'margin_top', 0, 0, '2014-10-16 22:45:03', NULL, '', 186, 106, 'inteiro', 'desktop'),
(1537, 134, 0, 'margin_bottom', 0, 0, '2014-10-16 22:45:03', NULL, '', 186, 106, 'inteiro', 'desktop'),
(1538, 134, 0, 'padding_top', 0, 0, '2014-10-16 22:45:03', NULL, '', 186, 106, 'inteiro', 'desktop'),
(1539, 134, 0, 'padding_bottom', 0, 0, '2014-10-16 22:45:03', NULL, '', 186, 106, 'inteiro', 'desktop'),
(1540, 134, 0, 'is_full', 0, 0, '2014-10-16 22:45:03', NULL, '', 186, 106, 'inteiro', 'desktop'),
(1541, 134, 0, 'titulo_componente', NULL, 0, '2014-10-16 22:45:03', 'Parte 5', '', 186, 106, 'texto', 'desktop'),
(1542, 134, 0, 'background_type', 0, 0, '2014-10-16 22:45:03', NULL, '', 186, 106, 'inteiro', 'desktop'),
(1543, 134, 0, 'background', NULL, 0, '2014-10-16 22:45:03', '', '', 186, 106, 'texto', 'desktop'),
(1544, 1, 0, 'is_full', 0, 0, '2014-10-17 01:47:43', NULL, '', 217, 27, 'inteiro', 'desktop'),
(1545, 1, 0, 'link_1', NULL, 0, '2014-10-17 01:48:19', NULL, '', 207, 53, 'texto', 'desktop'),
(1546, 1, 0, 'layout_1', NULL, 0, '2014-10-17 01:48:19', 'down', '', 207, 53, 'texto', 'desktop'),
(1547, 1, 0, 'is_full', 0, 0, '2014-10-17 01:48:19', NULL, '', 207, 53, 'inteiro', 'desktop'),
(1548, 1, 0, 'titulo_componente', NULL, 0, '2014-10-17 01:48:19', '', '', 207, 53, 'texto', 'desktop'),
(1549, 1, 0, 'is_full', 0, 0, '2014-10-17 02:12:05', NULL, '', 215, 23, 'inteiro', 'desktop'),
(1550, 1, 0, 'link_1', NULL, 0, '2014-10-17 02:22:19', NULL, '', 207, 22, 'texto', 'desktop'),
(1551, 1, 0, 'layout_1', NULL, 0, '2014-10-17 02:22:19', 'up', '', 207, 22, 'texto', 'desktop'),
(1552, 1, 0, 'padding_top', 0, 0, '2014-10-17 02:22:19', NULL, '', 207, 22, 'inteiro', 'desktop'),
(1553, 1, 0, 'padding_bottom', 0, 0, '2014-10-17 02:22:19', NULL, '', 207, 22, 'inteiro', 'desktop'),
(1554, 1, 0, 'is_full', 1, 0, '2014-10-17 02:22:19', NULL, '', 207, 22, 'inteiro', 'desktop'),
(1555, 1, 0, 'titulo_componente', NULL, 0, '2014-10-17 02:22:19', '', '', 207, 22, 'texto', 'desktop'),
(1556, 1, 0, 'padding_top', 0, 0, '2014-10-17 02:29:15', NULL, '', 211, 24, 'inteiro', 'desktop'),
(1557, 1, 0, 'padding_bottom', 0, 0, '2014-10-17 02:29:15', NULL, '', 211, 24, 'inteiro', 'desktop'),
(1558, 1, 0, 'is_full', 0, 0, '2014-10-17 02:29:15', NULL, '', 211, 24, 'inteiro', 'desktop'),
(1559, 1, 0, 'is_full', 0, 0, '2014-10-17 02:36:28', NULL, '', 216, 25, 'inteiro', 'desktop'),
(1560, 1, 0, 'is_full', 0, 0, '2014-10-17 02:36:54', NULL, '', 219, 29, 'inteiro', 'desktop'),
(1561, 134, 0, 'titulo_1', NULL, 0, '2014-10-17 02:43:52', NULL, 'Sites com Sistema para Gerenciamento de Conteúdo', 207, 109, 'texto', 'desktop'),
(1562, 134, 0, 'subtitulo_1', NULL, 0, '2014-10-17 02:43:52', NULL, 'Tenha total autonomia sobre o seu site com Pier Admin 2.0', 207, 109, 'texto', 'desktop'),
(1563, 134, 0, 'texto_1', NULL, 0, '2014-10-17 02:43:52', NULL, '<br>Atualmente você administra seu próprio site? Ou ainda está na dependência de quem desenvolveu para você? \r\n\r\nCriamos uma ferramenta fantástica, capaz de lhe proporcionar sua independência em toda e qualquer alteração em seu web site. Você terá autonomia de publicar há qualquer momento suas campanhas de marketing. \r\n\r\nSua empresa contratando nossos serviços, adquiri em qualquer plano de web site o sistema para o <b>Gerenciamento de Conteúdo (CMS). </b>\r\n\r\nCMS - Content Management System - a função é disponibilizar ao usuário autonomia em controlar todo o conteúdo de um website, como as notícias publicadas, eventos, galerias de imagens, itens de menu, cores das páginas, layout do site, enquetes e muito mais. \r\n\r\nDesenvolvemos uma plataforma simples e de fácil acesso. Deixamos tudo mais fácil para você efetuar qualquer alteração. De forma simplificada, com muita facilidade e agilidade em qualquer processo. \r\n\r\nA principal característica da construção de sites gerenciáveis é a facilidade de manutenção. Ao optar por criar um site gerenciável você mesmo poderá atualizar o conteúdo do seu site via painel administrativo sem nenhum custo de manutenção ou conhecimento técnico em programação.\r\n', 207, 109, 'texto', 'desktop'),
(1564, 134, 0, 'link_1', NULL, 0, '2014-10-17 02:43:52', NULL, '', 207, 109, 'texto', 'desktop'),
(1565, 134, 0, 'image_1', NULL, 0, '2014-10-17 02:43:52', 'gerenciador_de_conteudo_purplepier_site1_h7.png', '', 207, 109, 'texto', 'desktop'),
(1566, 134, 0, 'layout_1', NULL, 0, '2014-10-17 02:43:52', 'down', '', 207, 109, 'texto', 'desktop'),
(1567, 134, 0, 'cor_1', NULL, 0, '2014-10-17 02:43:52', '', '', 207, 109, 'texto', 'desktop'),
(1568, 134, 0, 'cor_2', NULL, 0, '2014-10-17 02:43:52', '', '', 207, 109, 'texto', 'desktop'),
(1569, 134, 0, 'cor_3', NULL, 0, '2014-10-17 02:43:52', '', '', 207, 109, 'texto', 'desktop'),
(1570, 134, 0, 'alinhamento_1', NULL, 0, '2014-10-17 02:43:52', 'center', '', 207, 109, 'texto', 'desktop'),
(1571, 134, 0, 'alinhamento_2', NULL, 0, '2014-10-17 02:43:52', 'center', '', 207, 109, 'texto', 'desktop'),
(1572, 134, 0, 'alinhamento_3', NULL, 0, '2014-10-17 02:43:52', 'left', '', 207, 109, 'texto', 'desktop'),
(1573, 134, 0, 'margin_top', 10, 0, '2014-10-17 02:43:52', NULL, '', 207, 109, 'inteiro', 'desktop'),
(1574, 134, 0, 'margin_bottom', 0, 0, '2014-10-17 02:43:52', NULL, '', 207, 109, 'inteiro', 'desktop'),
(1575, 134, 0, 'padding_top', 0, 0, '2014-10-17 02:43:52', NULL, '', 207, 109, 'inteiro', 'desktop'),
(1576, 134, 0, 'padding_bottom', 30, 0, '2014-10-17 02:43:52', NULL, '', 207, 109, 'inteiro', 'desktop'),
(1577, 134, 0, 'is_full', 0, 0, '2014-10-17 02:43:52', NULL, '', 207, 109, 'inteiro', 'desktop'),
(1578, 134, 0, 'titulo_componente', NULL, 0, '2014-10-17 02:43:52', 'Sites com Sistema de Gerenciamento', '', 207, 109, 'texto', 'desktop'),
(1579, 134, 0, 'background_type', 0, 0, '2014-10-17 02:43:52', NULL, '', 207, 109, 'inteiro', 'desktop'),
(1580, 134, 0, 'background', NULL, 0, '2014-10-17 02:43:52', '', '', 207, 109, 'texto', 'desktop'),
(1581, 134, 0, 'titulo_1', NULL, 0, '2014-10-17 03:24:28', NULL, 'Você altera seu web site quantas vezes quiser!', 207, 110, 'texto', 'desktop'),
(1582, 134, 0, 'subtitulo_1', NULL, 0, '2014-10-17 03:24:28', NULL, 'O sistema Purplepier apresenta uma interface amigável, e de fácil acesso.', 207, 110, 'texto', 'desktop'),
(1583, 134, 0, 'texto_1', NULL, 0, '2014-10-17 03:24:28', NULL, '- Qualquer usuário cadastrado poderá manipular facilmente o web site;\r\n- Tendo ou não conhecimento técnico de informática;\r\n- Alteração poderá ser feita de qualquer computador, basta ter acesso a internet;\r\n', 207, 110, 'texto', 'desktop'),
(1584, 134, 0, 'link_1', NULL, 0, '2014-10-17 03:24:28', NULL, '', 207, 110, 'texto', 'desktop'),
(1585, 134, 0, 'image_1', NULL, 0, '2014-10-17 03:24:28', 'gerenciador_de_conteudo_purplepier_site2_y7.png', '', 207, 110, 'texto', 'desktop'),
(1586, 134, 0, 'layout_1', NULL, 0, '2014-10-17 03:24:28', 'down', '', 207, 110, 'texto', 'desktop'),
(1587, 134, 0, 'cor_1', NULL, 0, '2014-10-17 03:24:28', '', '', 207, 110, 'texto', 'desktop'),
(1588, 134, 0, 'cor_2', NULL, 0, '2014-10-17 03:24:28', '', '', 207, 110, 'texto', 'desktop'),
(1589, 134, 0, 'cor_3', NULL, 0, '2014-10-17 03:24:28', '', '', 207, 110, 'texto', 'desktop'),
(1590, 134, 0, 'alinhamento_1', NULL, 0, '2014-10-17 03:24:28', 'center', '', 207, 110, 'texto', 'desktop'),
(1591, 134, 0, 'alinhamento_2', NULL, 0, '2014-10-17 03:24:28', 'center', '', 207, 110, 'texto', 'desktop'),
(1592, 134, 0, 'alinhamento_3', NULL, 0, '2014-10-17 03:24:28', 'center', '', 207, 110, 'texto', 'desktop'),
(1593, 134, 0, 'margin_top', 0, 0, '2014-10-17 03:24:28', NULL, '', 207, 110, 'inteiro', 'desktop'),
(1594, 134, 0, 'margin_bottom', 20, 0, '2014-10-17 03:24:28', NULL, '', 207, 110, 'inteiro', 'desktop'),
(1595, 134, 0, 'padding_top', 0, 0, '2014-10-17 03:24:28', NULL, '', 207, 110, 'inteiro', 'desktop'),
(1596, 134, 0, 'padding_bottom', 0, 0, '2014-10-17 03:24:29', NULL, '', 207, 110, 'inteiro', 'desktop'),
(1597, 134, 0, 'is_full', 0, 0, '2014-10-17 03:24:29', NULL, '', 207, 110, 'inteiro', 'desktop'),
(1598, 134, 0, 'titulo_componente', NULL, 0, '2014-10-17 03:24:29', 'Você altera seu web site quantas', '', 207, 110, 'texto', 'desktop'),
(1599, 134, 0, 'background_type', 0, 0, '2014-10-17 03:24:29', NULL, '', 207, 110, 'inteiro', 'desktop'),
(1600, 134, 0, 'background', NULL, 0, '2014-10-17 03:24:29', '', '', 207, 110, 'texto', 'desktop'),
(1601, 134, 0, 'titulo_1', NULL, 0, '2014-10-17 03:34:07', NULL, ' Você paga apenas a hospedagem, e fica livre de qualquer custo de manutenção.', 207, 111, 'texto', 'desktop'),
(1602, 134, 0, 'subtitulo_1', NULL, 0, '2014-10-17 03:34:07', NULL, ' São vários componentes já prontos para você incrementar seu site.', 207, 111, 'texto', 'desktop'),
(1603, 134, 0, 'texto_1', NULL, 0, '2014-10-17 03:34:07', NULL, '- sistema trabalha em tempo real;\r\n- todo o conteúdo alterado é instantaneamente publicado no web site;\r\n', 207, 111, 'texto', 'desktop'),
(1604, 134, 0, 'link_1', NULL, 0, '2014-10-17 03:34:07', NULL, '', 207, 111, 'texto', 'desktop'),
(1605, 134, 0, 'image_1', NULL, 0, '2014-10-17 03:34:07', 'gerenciador_de_conteudo_purplepier_site3_m6.png', '', 207, 111, 'texto', 'desktop'),
(1606, 134, 0, 'layout_1', NULL, 0, '2014-10-17 03:34:07', 'down', '', 207, 111, 'texto', 'desktop'),
(1607, 134, 0, 'cor_1', NULL, 0, '2014-10-17 03:34:07', '', '', 207, 111, 'texto', 'desktop'),
(1608, 134, 0, 'cor_2', NULL, 0, '2014-10-17 03:34:07', '', '', 207, 111, 'texto', 'desktop'),
(1609, 134, 0, 'cor_3', NULL, 0, '2014-10-17 03:34:07', '', '', 207, 111, 'texto', 'desktop'),
(1610, 134, 0, 'alinhamento_1', NULL, 0, '2014-10-17 03:34:07', 'center', '', 207, 111, 'texto', 'desktop'),
(1611, 134, 0, 'alinhamento_2', NULL, 0, '2014-10-17 03:34:07', 'center', '', 207, 111, 'texto', 'desktop'),
(1612, 134, 0, 'alinhamento_3', NULL, 0, '2014-10-17 03:34:07', 'center', '', 207, 111, 'texto', 'desktop'),
(1613, 134, 0, 'margin_top', 30, 0, '2014-10-17 03:34:07', NULL, '', 207, 111, 'inteiro', 'desktop'),
(1614, 134, 0, 'margin_bottom', 0, 0, '2014-10-17 03:34:07', NULL, '', 207, 111, 'inteiro', 'desktop'),
(1615, 134, 0, 'padding_top', 0, 0, '2014-10-17 03:34:07', NULL, '', 207, 111, 'inteiro', 'desktop'),
(1616, 134, 0, 'padding_bottom', 0, 0, '2014-10-17 03:34:07', NULL, '', 207, 111, 'inteiro', 'desktop'),
(1617, 134, 0, 'is_full', 0, 0, '2014-10-17 03:34:07', NULL, '', 207, 111, 'inteiro', 'desktop'),
(1618, 134, 0, 'titulo_componente', NULL, 0, '2014-10-17 03:34:07', 'Você paga apenas a hospedagem', '', 207, 111, 'texto', 'desktop'),
(1619, 134, 0, 'background_type', 0, 0, '2014-10-17 03:34:07', NULL, '', 207, 111, 'inteiro', 'desktop'),
(1620, 134, 0, 'background', NULL, 0, '2014-10-17 03:34:07', '', '', 207, 111, 'texto', 'desktop'),
(1621, 134, 0, 'titulo_1', NULL, 0, '2014-10-17 14:12:44', NULL, ' Além das páginas serem ilimitadas, você escolhe como elas irão aparecer.', 207, 112, 'texto', 'desktop'),
(1622, 134, 0, 'subtitulo_1', NULL, 0, '2014-10-17 14:12:44', NULL, 'Terá autonomia de escolher também como será o layout.', 207, 112, 'texto', 'desktop'),
(1623, 134, 0, 'texto_1', NULL, 0, '2014-10-17 14:12:44', NULL, 'Quais serão as cores das fontes, no background (fundo do site) você poderá colocar imagem, texturas, efeitos sobre imagens. ', 207, 112, 'texto', 'desktop'),
(1624, 134, 0, 'link_1', NULL, 0, '2014-10-17 14:12:44', NULL, '', 207, 112, 'texto', 'desktop'),
(1625, 134, 0, 'image_1', NULL, 0, '2014-10-17 14:12:44', 'gerenciador_de_conteudo_purplepier_site4_k4.png', '', 207, 112, 'texto', 'desktop'),
(1626, 134, 0, 'layout_1', NULL, 0, '2014-10-17 14:12:44', 'down', '', 207, 112, 'texto', 'desktop'),
(1627, 134, 0, 'cor_1', NULL, 0, '2014-10-17 14:12:44', '', '', 207, 112, 'texto', 'desktop'),
(1628, 134, 0, 'cor_2', NULL, 0, '2014-10-17 14:12:44', '', '', 207, 112, 'texto', 'desktop'),
(1629, 134, 0, 'cor_3', NULL, 0, '2014-10-17 14:12:44', '', '', 207, 112, 'texto', 'desktop'),
(1630, 134, 0, 'alinhamento_1', NULL, 0, '2014-10-17 14:12:44', 'center', '', 207, 112, 'texto', 'desktop'),
(1631, 134, 0, 'alinhamento_2', NULL, 0, '2014-10-17 14:12:44', 'center', '', 207, 112, 'texto', 'desktop'),
(1632, 134, 0, 'alinhamento_3', NULL, 0, '2014-10-17 14:12:44', 'center', '', 207, 112, 'texto', 'desktop'),
(1633, 134, 0, 'margin_top', 30, 0, '2014-10-17 14:12:44', NULL, '', 207, 112, 'inteiro', 'desktop'),
(1634, 134, 0, 'margin_bottom', 0, 0, '2014-10-17 14:12:44', NULL, '', 207, 112, 'inteiro', 'desktop'),
(1635, 134, 0, 'padding_top', 0, 0, '2014-10-17 14:12:44', NULL, '', 207, 112, 'inteiro', 'desktop'),
(1636, 134, 0, 'padding_bottom', 0, 0, '2014-10-17 14:12:44', NULL, '', 207, 112, 'inteiro', 'desktop'),
(1637, 134, 0, 'is_full', 0, 0, '2014-10-17 14:12:44', NULL, '', 207, 112, 'inteiro', 'desktop'),
(1638, 134, 0, 'titulo_componente', NULL, 0, '2014-10-17 14:12:44', '', '', 207, 112, 'texto', 'desktop'),
(1639, 134, 0, 'background_type', 0, 0, '2014-10-17 14:12:44', NULL, '', 207, 112, 'inteiro', 'desktop'),
(1640, 134, 0, 'background', NULL, 0, '2014-10-17 14:12:44', '', '', 207, 112, 'texto', 'desktop'),
(1641, 134, 0, 'titulo_1', NULL, 0, '2014-10-17 14:23:05', NULL, 'São vários componentes a sua disposição, é só escolher! ', 207, 115, 'texto', 'desktop'),
(1642, 134, 0, 'subtitulo_1', NULL, 0, '2014-10-17 14:23:05', NULL, 'Veja quantas opções o sistema oferece para você editar e alterar o seu site. ', 207, 115, 'texto', 'desktop'),
(1643, 134, 0, 'texto_1', NULL, 0, '2014-10-17 14:23:05', NULL, 'Veja quantas opções o sistema oferece para você editar e alterar o seu site. E ainda dentro do layout escolhido, você poderá alterar tudo o que quiser. Desde o Topo, rodapés, menu, banners, texturas, etc.', 207, 115, 'texto', 'desktop'),
(1644, 134, 0, 'link_1', NULL, 0, '2014-10-17 14:23:05', NULL, '', 207, 115, 'texto', 'desktop'),
(1645, 134, 0, 'image_1', NULL, 0, '2014-10-17 14:23:05', '', '', 207, 115, 'image', 'desktop'),
(1646, 134, 0, 'layout_1', NULL, 0, '2014-10-17 14:23:05', 'up', '', 207, 115, 'texto', 'desktop'),
(1647, 134, 0, 'cor_1', NULL, 0, '2014-10-17 14:23:05', '', '', 207, 115, 'texto', 'desktop'),
(1648, 134, 0, 'cor_2', NULL, 0, '2014-10-17 14:23:05', '', '', 207, 115, 'texto', 'desktop'),
(1649, 134, 0, 'cor_3', NULL, 0, '2014-10-17 14:23:05', '', '', 207, 115, 'texto', 'desktop'),
(1650, 134, 0, 'alinhamento_1', NULL, 0, '2014-10-17 14:23:05', 'left', '', 207, 115, 'texto', 'desktop'),
(1651, 134, 0, 'alinhamento_2', NULL, 0, '2014-10-17 14:23:05', 'left', '', 207, 115, 'texto', 'desktop'),
(1652, 134, 0, 'alinhamento_3', NULL, 0, '2014-10-17 14:23:05', 'left', '', 207, 115, 'texto', 'desktop'),
(1653, 134, 0, 'margin_top', 0, 0, '2014-10-17 14:23:05', NULL, '', 207, 115, 'inteiro', 'desktop'),
(1654, 134, 0, 'margin_bottom', 0, 0, '2014-10-17 14:23:05', NULL, '', 207, 115, 'inteiro', 'desktop'),
(1655, 134, 0, 'padding_top', 0, 0, '2014-10-17 14:23:05', NULL, '', 207, 115, 'inteiro', 'desktop'),
(1656, 134, 0, 'padding_bottom', 0, 0, '2014-10-17 14:23:05', NULL, '', 207, 115, 'inteiro', 'desktop'),
(1657, 134, 0, 'is_full', 0, 0, '2014-10-17 14:23:05', NULL, '', 207, 115, 'inteiro', 'desktop'),
(1658, 134, 0, 'titulo_componente', NULL, 0, '2014-10-17 14:23:05', '', '', 207, 115, 'texto', 'desktop'),
(1659, 134, 0, 'background_type', 0, 0, '2014-10-17 14:23:05', NULL, '', 207, 115, 'inteiro', 'desktop'),
(1660, 134, 0, 'background', NULL, 0, '2014-10-17 14:23:05', '', '', 207, 115, 'texto', 'desktop'),
(1661, 134, 0, 'titulo_1', NULL, 0, '2014-10-17 14:26:08', NULL, 'São várias opções que o sistema oferece para você editar e alterar o seu site. ', 234, 116, 'texto', 'desktop'),
(1662, 134, 0, 'subtitulo_1', NULL, 0, '2014-10-17 14:26:08', NULL, 'Veja em páginas avançadas, quantas possibilidades o sistema disponibiliza para editar e incrementar o seu site.', 234, 116, 'texto', 'desktop'),
(1663, 134, 0, 'texto_1', NULL, 0, '2014-10-17 14:26:08', NULL, '', 234, 116, 'texto', 'desktop'),
(1664, 134, 0, 'item1_cor_1', NULL, 0, '2014-10-17 14:26:08', '', '', 234, 116, 'texto', 'desktop'),
(1665, 134, 0, 'item1_alinhamento_1', NULL, 0, '2014-10-17 14:26:08', 'center', '', 234, 116, 'texto', 'desktop'),
(1666, 134, 0, 'item1_link_1', NULL, 0, '2014-10-17 14:26:08', 'https://purplepier.com.br/paginasavancadas', '', 234, 116, 'texto', 'desktop'),
(1667, 134, 0, 'item1_font_1', NULL, 0, '2014-10-17 14:26:08', '', '', 234, 116, 'texto', 'desktop'),
(1668, 134, 0, 'item1_cor_2', NULL, 0, '2014-10-17 14:26:08', '', '', 234, 116, 'texto', 'desktop'),
(1669, 134, 0, 'item1_alinhamento_2', NULL, 0, '2014-10-17 14:26:08', 'center', '', 234, 116, 'texto', 'desktop'),
(1670, 134, 0, 'item1_cor_3', NULL, 0, '2014-10-17 14:26:08', '', '', 234, 116, 'texto', 'desktop'),
(1671, 134, 0, 'item1_alinhamento_3', NULL, 0, '2014-10-17 14:26:08', 'left', '', 234, 116, 'texto', 'desktop'),
(1672, 134, 0, 'cor_botao', NULL, 0, '2014-10-17 14:26:08', '', '', 234, 116, 'texto', 'desktop'),
(1673, 134, 0, 'cor_botao2', NULL, 0, '2014-10-17 14:26:08', '', '', 234, 116, 'texto', 'desktop'),
(1674, 134, 0, 'cor_botao_label', NULL, 0, '2014-10-17 14:26:08', '', '', 234, 116, 'texto', 'desktop'),
(1675, 134, 0, 'botao_exibe', 1, 0, '2014-10-17 14:26:08', NULL, '', 234, 116, 'inteiro', 'desktop'),
(1676, 134, 0, 'botao_label', NULL, 0, '2014-10-17 14:26:08', 'Páginas Avançadas', '', 234, 116, 'texto', 'desktop'),
(1677, 134, 0, 'margin_top', 30, 0, '2014-10-17 14:26:08', NULL, '', 234, 116, 'inteiro', 'desktop'),
(1678, 134, 0, 'margin_bottom', 30, 0, '2014-10-17 14:26:08', NULL, '', 234, 116, 'inteiro', 'desktop'),
(1679, 134, 0, 'padding_top', 0, 0, '2014-10-17 14:26:08', NULL, '', 234, 116, 'inteiro', 'desktop'),
(1680, 134, 0, 'padding_bottom', 0, 0, '2014-10-17 14:26:08', NULL, '', 234, 116, 'inteiro', 'desktop'),
(1681, 134, 0, 'is_full', 0, 0, '2014-10-17 14:26:08', NULL, '', 234, 116, 'inteiro', 'desktop'),
(1682, 134, 0, 'background_type', 0, 0, '2014-10-17 14:26:08', NULL, '', 234, 116, 'inteiro', 'desktop'),
(1683, 134, 0, 'background', NULL, 0, '2014-10-17 14:26:08', '', '', 234, 116, 'texto', 'desktop'),
(1684, 134, 0, 'titulo_1', NULL, 0, '2014-10-17 14:43:28', NULL, '', 207, 117, 'texto', 'desktop'),
(1685, 134, 0, 'subtitulo_1', NULL, 0, '2014-10-17 14:43:28', NULL, '', 207, 117, 'texto', 'desktop'),
(1686, 134, 0, 'texto_1', NULL, 0, '2014-10-17 14:43:28', NULL, '', 207, 117, 'texto', 'desktop'),
(1687, 134, 0, 'link_1', NULL, 0, '2014-10-17 14:43:28', NULL, '', 207, 117, 'texto', 'desktop'),
(1688, 134, 0, 'image_1', NULL, 0, '2014-10-17 14:43:28', 'banner_pages_layouts_c5.png', '', 207, 117, 'texto', 'desktop'),
(1689, 134, 0, 'layout_1', NULL, 0, '2014-10-17 14:43:28', 'up', '', 207, 117, 'texto', 'desktop'),
(1690, 134, 0, 'cor_1', NULL, 0, '2014-10-17 14:43:28', '', '', 207, 117, 'texto', 'desktop'),
(1691, 134, 0, 'cor_2', NULL, 0, '2014-10-17 14:43:28', '', '', 207, 117, 'texto', 'desktop'),
(1692, 134, 0, 'cor_3', NULL, 0, '2014-10-17 14:43:28', '', '', 207, 117, 'texto', 'desktop'),
(1693, 134, 0, 'alinhamento_1', NULL, 0, '2014-10-17 14:43:28', 'left', '', 207, 117, 'texto', 'desktop'),
(1694, 134, 0, 'alinhamento_2', NULL, 0, '2014-10-17 14:43:28', 'left', '', 207, 117, 'texto', 'desktop'),
(1695, 134, 0, 'alinhamento_3', NULL, 0, '2014-10-17 14:43:28', 'left', '', 207, 117, 'texto', 'desktop'),
(1696, 134, 0, 'margin_top', 30, 0, '2014-10-17 14:43:29', NULL, '', 207, 117, 'inteiro', 'desktop'),
(1697, 134, 0, 'margin_bottom', 0, 0, '2014-10-17 14:43:29', NULL, '', 207, 117, 'inteiro', 'desktop'),
(1698, 134, 0, 'padding_top', 0, 0, '2014-10-17 14:43:29', NULL, '', 207, 117, 'inteiro', 'desktop'),
(1699, 134, 0, 'padding_bottom', 0, 0, '2014-10-17 14:43:29', NULL, '', 207, 117, 'inteiro', 'desktop'),
(1700, 134, 0, 'is_full', 0, 0, '2014-10-17 14:43:29', NULL, '', 207, 117, 'inteiro', 'desktop'),
(1701, 134, 0, 'titulo_componente', NULL, 0, '2014-10-17 14:43:29', 'banner com varios sites', '', 207, 117, 'texto', 'desktop'),
(1702, 134, 0, 'background_type', 0, 0, '2014-10-17 14:43:29', NULL, '', 207, 117, 'inteiro', 'desktop'),
(1703, 134, 0, 'background', NULL, 0, '2014-10-17 14:43:29', '', '', 207, 117, 'texto', 'desktop'),
(1704, 1, 0, 'titulo_1', NULL, 0, '2014-10-17 17:04:23', NULL, 'Pier Fotos', 255, 118, 'texto', 'desktop'),
(1705, 1, 0, 'subtitulo_1', NULL, 0, '2014-10-17 17:04:23', NULL, ' Fotografia de produtos para Lojas Ecommerce / M-Ecommerce ', 255, 118, 'texto', 'desktop'),
(1706, 1, 0, 'texto_1', NULL, 0, '2014-10-17 17:04:23', NULL, 'O objetivo do Pier Fotos é fornecer fotos de produtos com qualidade profissional para qualquer finalidade, como produção de catálogos, folders, sites e-commerce e material de divulgação.\r\n\r\nPara este tipo de trabalho, nós não trabalhamos com cenários personalizados, as fotos são sobre fundo branco, azul, vermelho ou preto. Desta forma conseguimos unir qualidade e produtividade, resultando em baixo investimento. Por essa razão as fotos são produzidas sempre com uma iluminação padrão, sobre um fundo padrão.\r\n\r\nGarantimos fotos de qualidade, fazemos os tratamentos na imagem para entregar um produto perfeito.\r\n', 255, 118, 'texto', 'desktop'),
(1707, 1, 0, 'cor_1', NULL, 0, '2014-10-17 17:04:23', '', '', 255, 118, 'texto', 'desktop'),
(1708, 1, 0, 'cor_2', NULL, 0, '2014-10-17 17:04:23', '#2d648f', '', 255, 118, 'texto', 'desktop'),
(1709, 1, 0, 'cor_3', NULL, 0, '2014-10-17 17:04:23', '', '', 255, 118, 'texto', 'desktop'),
(1710, 1, 0, 'galeria', NULL, 0, '2014-10-17 17:04:23', '93-112', '', 255, 118, 'texto', 'desktop'),
(1711, 1, 0, 'botao_exibe', 0, 0, '2014-10-17 17:04:23', NULL, '', 255, 118, 'inteiro', 'desktop'),
(1712, 1, 0, 'titulo_exibe', 0, 0, '2014-10-17 17:04:23', NULL, '', 255, 118, 'inteiro', 'desktop'),
(1713, 1, 0, 'margin_top', 0, 0, '2014-10-17 17:04:23', NULL, '', 255, 118, 'inteiro', 'desktop'),
(1714, 1, 0, 'margin_bottom', 0, 0, '2014-10-17 17:04:23', NULL, '', 255, 118, 'inteiro', 'desktop'),
(1715, 1, 0, 'is_full', 0, 0, '2014-10-17 17:04:23', NULL, '', 255, 118, 'inteiro', 'desktop'),
(1716, 1, 0, 'titulo_componente', NULL, 0, '2014-10-17 17:04:23', 'Fotografia', '', 255, 118, 'texto', 'desktop'),
(1717, 1, 0, 'background_type', 0, 0, '2014-10-17 17:04:23', NULL, '', 255, 118, 'inteiro', 'desktop'),
(1718, 1, 0, 'background', NULL, 0, '2014-10-17 17:04:23', '', '', 255, 118, 'texto', 'desktop'),
(1719, 140, 0, 'titulo_1', NULL, 0, '2014-10-17 18:26:25', NULL, '', 207, 119, 'texto', 'desktop'),
(1720, 140, 0, 'subtitulo_1', NULL, 0, '2014-10-17 18:26:25', NULL, '', 207, 119, 'texto', 'desktop'),
(1721, 140, 0, 'texto_1', NULL, 0, '2014-10-17 18:26:25', NULL, '', 207, 119, 'texto', 'desktop'),
(1722, 140, 0, 'link_1', NULL, 0, '2014-10-17 18:26:25', NULL, '', 207, 119, 'texto', 'desktop'),
(1723, 140, 0, 'image_1', NULL, 0, '2014-10-17 18:26:25', 'piermagazine_r3.png', '', 207, 119, 'texto', 'desktop'),
(1724, 140, 0, 'layout_1', NULL, 0, '2014-10-17 18:26:25', 'up', '', 207, 119, 'texto', 'desktop'),
(1725, 140, 0, 'cor_1', NULL, 0, '2014-10-17 18:26:25', '', '', 207, 119, 'texto', 'desktop');
INSERT INTO `paginas_attribute` (`id`, `id_pagina`, `user_id`, `name`, `inteiro`, `number`, `estampa`, `texto`, `descricao`, `id_componente`, `id_row`, `tipo`, `plataforma`) VALUES
(1726, 140, 0, 'cor_2', NULL, 0, '2014-10-17 18:26:25', '', '', 207, 119, 'texto', 'desktop'),
(1727, 140, 0, 'cor_3', NULL, 0, '2014-10-17 18:26:25', '', '', 207, 119, 'texto', 'desktop'),
(1728, 140, 0, 'alinhamento_1', NULL, 0, '2014-10-17 18:26:25', 'left', '', 207, 119, 'texto', 'desktop'),
(1729, 140, 0, 'alinhamento_2', NULL, 0, '2014-10-17 18:26:25', 'left', '', 207, 119, 'texto', 'desktop'),
(1730, 140, 0, 'alinhamento_3', NULL, 0, '2014-10-17 18:26:25', 'left', '', 207, 119, 'texto', 'desktop'),
(1731, 140, 0, 'margin_top', 21, 0, '2014-10-17 18:26:25', NULL, '', 207, 119, 'inteiro', 'desktop'),
(1732, 140, 0, 'margin_bottom', 0, 0, '2014-10-17 18:26:25', NULL, '', 207, 119, 'inteiro', 'desktop'),
(1733, 140, 0, 'padding_top', 0, 0, '2014-10-17 18:26:25', NULL, '', 207, 119, 'inteiro', 'desktop'),
(1734, 140, 0, 'padding_bottom', 0, 0, '2014-10-17 18:26:25', NULL, '', 207, 119, 'inteiro', 'desktop'),
(1735, 140, 0, 'is_full', 0, 0, '2014-10-17 18:26:25', NULL, '', 207, 119, 'inteiro', 'desktop'),
(1736, 140, 0, 'titulo_componente', NULL, 0, '2014-10-17 18:26:25', 'Pier Magazine', '', 207, 119, 'texto', 'desktop'),
(1737, 140, 0, 'background_type', 0, 0, '2014-10-17 18:26:25', NULL, '', 207, 119, 'inteiro', 'desktop'),
(1738, 140, 0, 'background', NULL, 0, '2014-10-17 18:26:25', '', '', 207, 119, 'texto', 'desktop'),
(1739, 140, 0, 'link_1', NULL, 0, '2014-10-17 18:28:06', NULL, '', 207, 41, 'texto', 'desktop'),
(1740, 140, 0, 'layout_1', NULL, 0, '2014-10-17 18:28:06', 'up', '', 207, 41, 'texto', 'desktop'),
(1741, 140, 0, 'is_full', 0, 0, '2014-10-17 18:28:06', NULL, '', 207, 41, 'inteiro', 'desktop'),
(1742, 140, 0, 'titulo_componente', NULL, 0, '2014-10-17 18:28:06', 'Tetriz', '', 207, 41, 'texto', 'desktop'),
(1743, 140, 0, 'titulo_1', NULL, 0, '2014-10-17 18:57:19', NULL, '', 207, 120, 'texto', 'desktop'),
(1744, 140, 0, 'subtitulo_1', NULL, 0, '2014-10-17 18:57:19', NULL, '', 207, 120, 'texto', 'desktop'),
(1745, 140, 0, 'texto_1', NULL, 0, '2014-10-17 18:57:19', NULL, '', 207, 120, 'texto', 'desktop'),
(1746, 140, 0, 'link_1', NULL, 0, '2014-10-17 18:57:19', NULL, '', 207, 120, 'texto', 'desktop'),
(1747, 140, 0, 'image_1', NULL, 0, '2014-10-17 18:57:19', 'galeria_destaques_a5.png', '', 207, 120, 'texto', 'desktop'),
(1748, 140, 0, 'layout_1', NULL, 0, '2014-10-17 18:57:19', 'up', '', 207, 120, 'texto', 'desktop'),
(1749, 140, 0, 'cor_1', NULL, 0, '2014-10-17 18:57:19', '', '', 207, 120, 'texto', 'desktop'),
(1750, 140, 0, 'cor_2', NULL, 0, '2014-10-17 18:57:19', '', '', 207, 120, 'texto', 'desktop'),
(1751, 140, 0, 'cor_3', NULL, 0, '2014-10-17 18:57:19', '', '', 207, 120, 'texto', 'desktop'),
(1752, 140, 0, 'alinhamento_1', NULL, 0, '2014-10-17 18:57:19', 'left', '', 207, 120, 'texto', 'desktop'),
(1753, 140, 0, 'alinhamento_2', NULL, 0, '2014-10-17 18:57:19', 'left', '', 207, 120, 'texto', 'desktop'),
(1754, 140, 0, 'alinhamento_3', NULL, 0, '2014-10-17 18:57:19', 'left', '', 207, 120, 'texto', 'desktop'),
(1755, 140, 0, 'margin_top', 0, 0, '2014-10-17 18:57:19', NULL, '', 207, 120, 'inteiro', 'desktop'),
(1756, 140, 0, 'margin_bottom', 0, 0, '2014-10-17 18:57:19', NULL, '', 207, 120, 'inteiro', 'desktop'),
(1757, 140, 0, 'padding_top', 0, 0, '2014-10-17 18:57:19', NULL, '', 207, 120, 'inteiro', 'desktop'),
(1758, 140, 0, 'padding_bottom', 0, 0, '2014-10-17 18:57:19', NULL, '', 207, 120, 'inteiro', 'desktop'),
(1759, 140, 0, 'is_full', 0, 0, '2014-10-17 18:57:19', NULL, '', 207, 120, 'inteiro', 'desktop'),
(1760, 140, 0, 'titulo_componente', NULL, 0, '2014-10-17 18:57:19', 'Galeria de fotos', '', 207, 120, 'texto', 'desktop'),
(1761, 140, 0, 'background_type', 0, 0, '2014-10-17 18:57:19', NULL, '', 207, 120, 'inteiro', 'desktop'),
(1762, 140, 0, 'background', NULL, 0, '2014-10-17 18:57:19', '', '', 207, 120, 'texto', 'desktop'),
(1763, 140, 0, 'titulo_1', NULL, 0, '2014-10-17 19:03:17', NULL, '', 207, 121, 'texto', 'desktop'),
(1764, 140, 0, 'subtitulo_1', NULL, 0, '2014-10-17 19:03:17', NULL, '', 207, 121, 'texto', 'desktop'),
(1765, 140, 0, 'texto_1', NULL, 0, '2014-10-17 19:03:17', NULL, '', 207, 121, 'texto', 'desktop'),
(1766, 140, 0, 'link_1', NULL, 0, '2014-10-17 19:03:17', NULL, '', 207, 121, 'texto', 'desktop'),
(1767, 140, 0, 'image_1', NULL, 0, '2014-10-17 19:03:17', 'publicidade_online_y6.png', '', 207, 121, 'texto', 'desktop'),
(1768, 140, 0, 'layout_1', NULL, 0, '2014-10-17 19:03:17', 'up', '', 207, 121, 'texto', 'desktop'),
(1769, 140, 0, 'cor_1', NULL, 0, '2014-10-17 19:03:17', '', '', 207, 121, 'texto', 'desktop'),
(1770, 140, 0, 'cor_2', NULL, 0, '2014-10-17 19:03:17', '', '', 207, 121, 'texto', 'desktop'),
(1771, 140, 0, 'cor_3', NULL, 0, '2014-10-17 19:03:17', '', '', 207, 121, 'texto', 'desktop'),
(1772, 140, 0, 'alinhamento_1', NULL, 0, '2014-10-17 19:03:17', 'left', '', 207, 121, 'texto', 'desktop'),
(1773, 140, 0, 'alinhamento_2', NULL, 0, '2014-10-17 19:03:17', 'left', '', 207, 121, 'texto', 'desktop'),
(1774, 140, 0, 'alinhamento_3', NULL, 0, '2014-10-17 19:03:17', 'left', '', 207, 121, 'texto', 'desktop'),
(1775, 140, 0, 'margin_top', 0, 0, '2014-10-17 19:03:17', NULL, '', 207, 121, 'inteiro', 'desktop'),
(1776, 140, 0, 'margin_bottom', 0, 0, '2014-10-17 19:03:17', NULL, '', 207, 121, 'inteiro', 'desktop'),
(1777, 140, 0, 'padding_top', 0, 0, '2014-10-17 19:03:17', NULL, '', 207, 121, 'inteiro', 'desktop'),
(1778, 140, 0, 'padding_bottom', 0, 0, '2014-10-17 19:03:17', NULL, '', 207, 121, 'inteiro', 'desktop'),
(1779, 140, 0, 'is_full', 0, 0, '2014-10-17 19:03:17', NULL, '', 207, 121, 'inteiro', 'desktop'),
(1780, 140, 0, 'titulo_componente', NULL, 0, '2014-10-17 19:03:17', 'Publicidade On line', '', 207, 121, 'texto', 'desktop'),
(1781, 140, 0, 'background_type', 0, 0, '2014-10-17 19:03:17', NULL, '', 207, 121, 'inteiro', 'desktop'),
(1782, 140, 0, 'background', NULL, 0, '2014-10-17 19:03:17', '', '', 207, 121, 'texto', 'desktop'),
(1783, 140, 0, 'titulo_1', NULL, 0, '2014-10-17 19:13:50', NULL, '', 207, 122, 'texto', 'desktop'),
(1784, 140, 0, 'subtitulo_1', NULL, 0, '2014-10-17 19:13:50', NULL, '', 207, 122, 'texto', 'desktop'),
(1785, 140, 0, 'texto_1', NULL, 0, '2014-10-17 19:13:50', NULL, '', 207, 122, 'texto', 'desktop'),
(1786, 140, 0, 'link_1', NULL, 0, '2014-10-17 19:13:50', NULL, '', 207, 122, 'texto', 'desktop'),
(1787, 140, 0, 'image_1', NULL, 0, '2014-10-17 19:13:50', 'banca_revistas4x4_v5.png', '', 207, 122, 'texto', 'desktop'),
(1788, 140, 0, 'layout_1', NULL, 0, '2014-10-17 19:13:50', 'up', '', 207, 122, 'texto', 'desktop'),
(1789, 140, 0, 'cor_1', NULL, 0, '2014-10-17 19:13:50', '', '', 207, 122, 'texto', 'desktop'),
(1790, 140, 0, 'cor_2', NULL, 0, '2014-10-17 19:13:50', '', '', 207, 122, 'texto', 'desktop'),
(1791, 140, 0, 'cor_3', NULL, 0, '2014-10-17 19:13:50', '', '', 207, 122, 'texto', 'desktop'),
(1792, 140, 0, 'alinhamento_1', NULL, 0, '2014-10-17 19:13:50', 'left', '', 207, 122, 'texto', 'desktop'),
(1793, 140, 0, 'alinhamento_2', NULL, 0, '2014-10-17 19:13:50', 'left', '', 207, 122, 'texto', 'desktop'),
(1794, 140, 0, 'alinhamento_3', NULL, 0, '2014-10-17 19:13:50', 'left', '', 207, 122, 'texto', 'desktop'),
(1795, 140, 0, 'margin_top', 0, 0, '2014-10-17 19:13:50', NULL, '', 207, 122, 'inteiro', 'desktop'),
(1796, 140, 0, 'margin_bottom', 0, 0, '2014-10-17 19:13:50', NULL, '', 207, 122, 'inteiro', 'desktop'),
(1797, 140, 0, 'padding_top', 0, 0, '2014-10-17 19:13:50', NULL, '', 207, 122, 'inteiro', 'desktop'),
(1798, 140, 0, 'padding_bottom', 0, 0, '2014-10-17 19:13:50', NULL, '', 207, 122, 'inteiro', 'desktop'),
(1799, 140, 0, 'is_full', 0, 0, '2014-10-17 19:13:50', NULL, '', 207, 122, 'inteiro', 'desktop'),
(1800, 140, 0, 'titulo_componente', NULL, 0, '2014-10-17 19:13:50', 'Banca de revista 4x4', '', 207, 122, 'texto', 'desktop'),
(1801, 140, 0, 'background_type', 0, 0, '2014-10-17 19:13:50', NULL, '', 207, 122, 'inteiro', 'desktop'),
(1802, 140, 0, 'background', NULL, 0, '2014-10-17 19:13:50', '', '', 207, 122, 'texto', 'desktop'),
(1803, 140, 0, 'titulo_1', NULL, 0, '2014-10-17 19:16:56', NULL, '', 207, 123, 'texto', 'desktop'),
(1804, 140, 0, 'subtitulo_1', NULL, 0, '2014-10-17 19:16:56', NULL, '', 207, 123, 'texto', 'desktop'),
(1805, 140, 0, 'texto_1', NULL, 0, '2014-10-17 19:16:56', NULL, '', 207, 123, 'texto', 'desktop'),
(1806, 140, 0, 'link_1', NULL, 0, '2014-10-17 19:16:56', NULL, '', 207, 123, 'texto', 'desktop'),
(1807, 140, 0, 'image_1', NULL, 0, '2014-10-17 19:16:56', 'revista_v9.png', '', 207, 123, 'texto', 'desktop'),
(1808, 140, 0, 'layout_1', NULL, 0, '2014-10-17 19:16:56', 'up', '', 207, 123, 'texto', 'desktop'),
(1809, 140, 0, 'cor_1', NULL, 0, '2014-10-17 19:16:56', '', '', 207, 123, 'texto', 'desktop'),
(1810, 140, 0, 'cor_2', NULL, 0, '2014-10-17 19:16:56', '', '', 207, 123, 'texto', 'desktop'),
(1811, 140, 0, 'cor_3', NULL, 0, '2014-10-17 19:16:56', '', '', 207, 123, 'texto', 'desktop'),
(1812, 140, 0, 'alinhamento_1', NULL, 0, '2014-10-17 19:16:56', 'left', '', 207, 123, 'texto', 'desktop'),
(1813, 140, 0, 'alinhamento_2', NULL, 0, '2014-10-17 19:16:56', 'left', '', 207, 123, 'texto', 'desktop'),
(1814, 140, 0, 'alinhamento_3', NULL, 0, '2014-10-17 19:16:56', 'left', '', 207, 123, 'texto', 'desktop'),
(1815, 140, 0, 'margin_top', 0, 0, '2014-10-17 19:16:56', NULL, '', 207, 123, 'inteiro', 'desktop'),
(1816, 140, 0, 'margin_bottom', 0, 0, '2014-10-17 19:16:56', NULL, '', 207, 123, 'inteiro', 'desktop'),
(1817, 140, 0, 'padding_top', 0, 0, '2014-10-17 19:16:56', NULL, '', 207, 123, 'inteiro', 'desktop'),
(1818, 140, 0, 'padding_bottom', 0, 0, '2014-10-17 19:16:56', NULL, '', 207, 123, 'inteiro', 'desktop'),
(1819, 140, 0, 'is_full', 0, 0, '2014-10-17 19:16:56', NULL, '', 207, 123, 'inteiro', 'desktop'),
(1820, 140, 0, 'titulo_componente', NULL, 0, '2014-10-17 19:16:56', 'Revista', '', 207, 123, 'texto', 'desktop'),
(1821, 140, 0, 'background_type', 0, 0, '2014-10-17 19:16:56', NULL, '', 207, 123, 'inteiro', 'desktop'),
(1822, 140, 0, 'background', NULL, 0, '2014-10-17 19:16:56', '', '', 207, 123, 'texto', 'desktop'),
(1823, 142, 0, 'link_1', NULL, 0, '2014-10-17 19:26:47', NULL, '', 207, 70, 'texto', 'desktop'),
(1824, 142, 0, 'layout_1', NULL, 0, '2014-10-17 19:26:47', 'down', '', 207, 70, 'texto', 'desktop'),
(1825, 142, 0, 'titulo_componente', NULL, 0, '2014-10-17 19:26:47', '', '', 207, 70, 'texto', 'desktop'),
(1826, 136, 0, 'titulo_1', NULL, 0, '2014-10-17 19:47:32', NULL, '', 207, 124, 'texto', 'desktop'),
(1827, 136, 0, 'subtitulo_1', NULL, 0, '2014-10-17 19:47:32', NULL, '', 207, 124, 'texto', 'desktop'),
(1828, 136, 0, 'texto_1', NULL, 0, '2014-10-17 19:47:32', NULL, 'Clique o ícone com seta abaixo \r\n', 207, 124, 'texto', 'desktop'),
(1829, 136, 0, 'link_1', NULL, 0, '2014-10-17 19:47:32', NULL, '', 207, 124, 'texto', 'desktop'),
(1830, 136, 0, 'image_1', NULL, 0, '2014-10-17 19:47:32', '', '', 207, 124, 'texto', 'desktop'),
(1831, 136, 0, 'layout_1', NULL, 0, '2014-10-17 19:47:32', 'up', '', 207, 124, 'texto', 'desktop'),
(1832, 136, 0, 'cor_1', NULL, 0, '2014-10-17 19:47:32', '', '', 207, 124, 'texto', 'desktop'),
(1833, 136, 0, 'cor_2', NULL, 0, '2014-10-17 19:47:32', '', '', 207, 124, 'texto', 'desktop'),
(1834, 136, 0, 'cor_3', NULL, 0, '2014-10-17 19:47:32', '', '', 207, 124, 'texto', 'desktop'),
(1835, 136, 0, 'alinhamento_1', NULL, 0, '2014-10-17 19:47:32', 'left', '', 207, 124, 'texto', 'desktop'),
(1836, 136, 0, 'alinhamento_2', NULL, 0, '2014-10-17 19:47:32', 'left', '', 207, 124, 'texto', 'desktop'),
(1837, 136, 0, 'alinhamento_3', NULL, 0, '2014-10-17 19:47:32', 'left', '', 207, 124, 'texto', 'desktop'),
(1838, 136, 0, 'margin_top', 0, 0, '2014-10-17 19:47:32', NULL, '', 207, 124, 'inteiro', 'desktop'),
(1839, 136, 0, 'margin_bottom', 0, 0, '2014-10-17 19:47:32', NULL, '', 207, 124, 'inteiro', 'desktop'),
(1840, 136, 0, 'padding_top', 0, 0, '2014-10-17 19:47:32', NULL, '', 207, 124, 'inteiro', 'desktop'),
(1841, 136, 0, 'padding_bottom', 0, 0, '2014-10-17 19:47:32', NULL, '', 207, 124, 'inteiro', 'desktop'),
(1842, 136, 0, 'is_full', 0, 0, '2014-10-17 19:47:32', NULL, '', 207, 124, 'inteiro', 'desktop'),
(1843, 136, 0, 'titulo_componente', NULL, 0, '2014-10-17 19:47:32', 'Fotos', '', 207, 124, 'texto', 'desktop'),
(1844, 136, 0, 'background_type', 0, 0, '2014-10-17 19:47:32', NULL, '', 207, 124, 'inteiro', 'desktop'),
(1845, 136, 0, 'background', NULL, 0, '2014-10-17 19:47:32', '', '', 207, 124, 'texto', 'desktop'),
(1846, 142, 0, 'titulo_1', NULL, 0, '2014-10-17 22:54:30', NULL, 'Veja mais como funciona nosso disparador de e-mails', 234, 126, 'texto', 'desktop'),
(1847, 142, 0, 'subtitulo_1', NULL, 0, '2014-10-17 22:54:30', NULL, 'O PierMail possui um sistema exclusivo de criação de templates personalizáveis e responsívos', 234, 126, 'texto', 'desktop'),
(1848, 142, 0, 'texto_1', NULL, 0, '2014-10-17 22:54:30', NULL, 'Utilizando o sistema de Criação de Templates do PurplePier, você cria templates perfeitos para todos os dispositivos e pode editá-los de forma simples e rápidas.\r\nCom o PierMail você pode disparar quantos e-mails quiser, ver as estatística e só pagar pelo que utilizar\r\n', 234, 126, 'texto', 'desktop'),
(1849, 142, 0, 'item1_cor_1', NULL, 0, '2014-10-17 22:54:30', '', '', 234, 126, 'texto', 'desktop'),
(1850, 142, 0, 'item1_alinhamento_1', NULL, 0, '2014-10-17 22:54:30', 'center', '', 234, 126, 'texto', 'desktop'),
(1851, 142, 0, 'item1_link_1', NULL, 0, '2014-10-17 22:54:30', 'https://purplepier.com.br/piermail_dicas', '', 234, 126, 'texto', 'desktop'),
(1852, 142, 0, 'item1_font_1', NULL, 0, '2014-10-17 22:54:30', '', '', 234, 126, 'texto', 'desktop'),
(1853, 142, 0, 'item1_cor_2', NULL, 0, '2014-10-17 22:54:30', '', '', 234, 126, 'texto', 'desktop'),
(1854, 142, 0, 'item1_alinhamento_2', NULL, 0, '2014-10-17 22:54:30', 'center', '', 234, 126, 'texto', 'desktop'),
(1855, 142, 0, 'item1_cor_3', NULL, 0, '2014-10-17 22:54:30', '', '', 234, 126, 'texto', 'desktop'),
(1856, 142, 0, 'item1_alinhamento_3', NULL, 0, '2014-10-17 22:54:30', 'center', '', 234, 126, 'texto', 'desktop'),
(1857, 142, 0, 'cor_botao', NULL, 0, '2014-10-17 22:54:30', '', '', 234, 126, 'texto', 'desktop'),
(1858, 142, 0, 'cor_botao2', NULL, 0, '2014-10-17 22:54:30', '', '', 234, 126, 'texto', 'desktop'),
(1859, 142, 0, 'cor_botao_label', NULL, 0, '2014-10-17 22:54:30', '', '', 234, 126, 'texto', 'desktop'),
(1860, 142, 0, 'botao_exibe', 1, 0, '2014-10-17 22:54:30', NULL, '', 234, 126, 'inteiro', 'desktop'),
(1861, 142, 0, 'botao_label', NULL, 0, '2014-10-17 22:54:30', 'Veja como é simples', '', 234, 126, 'texto', 'desktop'),
(1862, 142, 0, 'margin_top', 0, 0, '2014-10-17 22:54:30', NULL, '', 234, 126, 'inteiro', 'desktop'),
(1863, 142, 0, 'margin_bottom', 0, 0, '2014-10-17 22:54:30', NULL, '', 234, 126, 'inteiro', 'desktop'),
(1864, 142, 0, 'padding_top', 0, 0, '2014-10-17 22:54:30', NULL, '', 234, 126, 'inteiro', 'desktop'),
(1865, 142, 0, 'padding_bottom', 0, 0, '2014-10-17 22:54:30', NULL, '', 234, 126, 'inteiro', 'desktop'),
(1866, 142, 0, 'is_full', 0, 0, '2014-10-17 22:54:30', NULL, '', 234, 126, 'inteiro', 'desktop'),
(1867, 142, 0, 'background_type', 0, 0, '2014-10-17 22:54:30', NULL, '', 234, 126, 'inteiro', 'desktop'),
(1868, 142, 0, 'background', NULL, 0, '2014-10-17 22:54:30', '', '', 234, 126, 'texto', 'desktop'),
(1869, 140, 0, 'titulo_1', NULL, 0, '2014-10-18 20:15:41', NULL, 'Aplicativo PierMail Marketing', 207, 62, 'texto', 'desktop'),
(1870, 140, 0, 'subtitulo_1', NULL, 0, '2014-10-18 20:15:41', NULL, 'Componentes para os layouts em suas campanhas de email marketing', 207, 62, 'texto', 'desktop'),
(1871, 140, 0, 'texto_1', NULL, 0, '2014-10-18 20:15:41', NULL, '', 207, 62, 'texto', 'desktop'),
(1872, 140, 0, 'link_1', NULL, 0, '2014-10-18 20:15:41', NULL, '', 207, 62, 'texto', 'desktop'),
(1873, 140, 0, 'image_1', NULL, 0, '2014-10-18 20:15:42', 'piermail_e9.png', '', 207, 62, 'texto', 'desktop'),
(1874, 140, 0, 'layout_1', NULL, 0, '2014-10-18 20:15:42', 'down', '', 207, 62, 'texto', 'desktop'),
(1875, 140, 0, 'cor_1', NULL, 0, '2014-10-18 20:15:42', '', '', 207, 62, 'texto', 'desktop'),
(1876, 140, 0, 'cor_2', NULL, 0, '2014-10-18 20:15:42', '', '', 207, 62, 'texto', 'desktop'),
(1877, 140, 0, 'cor_3', NULL, 0, '2014-10-18 20:15:42', '', '', 207, 62, 'texto', 'desktop'),
(1878, 140, 0, 'alinhamento_1', NULL, 0, '2014-10-18 20:15:42', 'center', '', 207, 62, 'texto', 'desktop'),
(1879, 140, 0, 'alinhamento_2', NULL, 0, '2014-10-18 20:15:42', 'center', '', 207, 62, 'texto', 'desktop'),
(1880, 140, 0, 'alinhamento_3', NULL, 0, '2014-10-18 20:15:42', 'left', '', 207, 62, 'texto', 'desktop'),
(1881, 140, 0, 'margin_top', 40, 0, '2014-10-18 20:15:42', NULL, '', 207, 62, 'inteiro', 'desktop'),
(1882, 140, 0, 'margin_bottom', 0, 0, '2014-10-18 20:15:42', NULL, '', 207, 62, 'inteiro', 'desktop'),
(1883, 140, 0, 'padding_top', 0, 0, '2014-10-18 20:15:42', NULL, '', 207, 62, 'inteiro', 'desktop'),
(1884, 140, 0, 'padding_bottom', 0, 0, '2014-10-18 20:15:42', NULL, '', 207, 62, 'inteiro', 'desktop'),
(1885, 140, 0, 'is_full', 0, 0, '2014-10-18 20:15:42', NULL, '', 207, 62, 'inteiro', 'desktop'),
(1886, 140, 0, 'titulo_componente', NULL, 0, '2014-10-18 20:15:42', 'Pier Mail', '', 207, 62, 'texto', 'desktop'),
(1887, 140, 0, 'background_type', 0, 0, '2014-10-18 20:15:42', NULL, '', 207, 62, 'inteiro', 'desktop'),
(1888, 140, 0, 'background', NULL, 0, '2014-10-18 20:15:42', '', '', 207, 62, 'texto', 'desktop'),
(1889, 1, 0, 'margin_top', 0, 0, '2014-10-18 20:20:35', NULL, '', 249, 128, 'inteiro', 'desktop'),
(1890, 1, 0, 'margin_bottom', 0, 0, '2014-10-18 20:20:35', NULL, '', 249, 128, 'inteiro', 'desktop'),
(1891, 1, 0, 'padding_top', 0, 0, '2014-10-18 20:20:35', NULL, '', 249, 128, 'inteiro', 'desktop'),
(1892, 1, 0, 'padding_bottom', 0, 0, '2014-10-18 20:20:35', NULL, '', 249, 128, 'inteiro', 'desktop'),
(1893, 1, 0, 'is_full', 0, 0, '2014-10-18 20:20:35', NULL, '', 249, 128, 'inteiro', 'desktop'),
(1894, 1, 0, 'titulo_componente', NULL, 0, '2014-10-18 20:20:35', '', '', 249, 128, 'texto', 'desktop'),
(1895, 1, 0, 'background_type', 0, 0, '2014-10-18 20:20:35', NULL, '', 249, 128, 'inteiro', 'desktop'),
(1896, 1, 0, 'background', NULL, 0, '2014-10-18 20:20:35', '', '', 249, 128, 'texto', 'desktop'),
(1897, 1, 0, 'titulo_1', NULL, 0, '2014-10-18 20:28:41', NULL, 'Seu site visto em todas plataformas - iOS, Android, Desktop!!', 207, 130, 'texto', 'desktop'),
(1898, 1, 0, 'subtitulo_1', NULL, 0, '2014-10-18 20:28:41', NULL, 'Instale já o aplicativo e comece a divulgar seu site em todas as plataformas!', 207, 130, 'texto', 'desktop'),
(1899, 1, 0, 'texto_1', NULL, 0, '2014-10-18 20:28:41', NULL, 'Este novo aplicativo permite que seu site  e seus emails se tornem responsivo. \r\nIsso mesmo, seus email também terão layouts responsivos, preparados para os dispositivos móveis, ficando perfeito em qualquer plataforma, iOS, Android, Desktop.', 207, 130, 'texto', 'desktop'),
(1900, 1, 0, 'link_1', NULL, 0, '2014-10-18 20:28:41', NULL, '/plataformaresponsiva', 207, 130, 'texto', 'desktop'),
(1901, 1, 0, 'image_1', NULL, 0, '2014-10-18 20:28:41', 'bn_plataforma_responsiva_k7_k3.jpg', '', 207, 130, 'texto', 'desktop'),
(1902, 1, 0, 'layout_1', NULL, 0, '2014-10-18 20:28:41', 'down', '', 207, 130, 'texto', 'desktop'),
(1903, 1, 0, 'cor_1', NULL, 0, '2014-10-18 20:28:41', '', '', 207, 130, 'texto', 'desktop'),
(1904, 1, 0, 'cor_2', NULL, 0, '2014-10-18 20:28:41', '#2075cb', '', 207, 130, 'texto', 'desktop'),
(1905, 1, 0, 'cor_3', NULL, 0, '2014-10-18 20:28:41', '', '', 207, 130, 'texto', 'desktop'),
(1906, 1, 0, 'alinhamento_1', NULL, 0, '2014-10-18 20:28:41', 'left', '', 207, 130, 'texto', 'desktop'),
(1907, 1, 0, 'alinhamento_2', NULL, 0, '2014-10-18 20:28:41', 'left', '', 207, 130, 'texto', 'desktop'),
(1908, 1, 0, 'alinhamento_3', NULL, 0, '2014-10-18 20:28:41', 'left', '', 207, 130, 'texto', 'desktop'),
(1909, 1, 0, 'margin_top', 20, 0, '2014-10-18 20:28:42', NULL, '', 207, 130, 'inteiro', 'desktop'),
(1910, 1, 0, 'margin_bottom', 0, 0, '2014-10-18 20:28:42', NULL, '', 207, 130, 'inteiro', 'desktop'),
(1911, 1, 0, 'padding_top', 0, 0, '2014-10-18 20:28:42', NULL, '', 207, 130, 'inteiro', 'desktop'),
(1912, 1, 0, 'padding_bottom', 0, 0, '2014-10-18 20:28:42', NULL, '', 207, 130, 'inteiro', 'desktop'),
(1913, 1, 0, 'is_full', 0, 0, '2014-10-18 20:28:42', NULL, '', 207, 130, 'inteiro', 'desktop'),
(1914, 1, 0, 'titulo_componente', NULL, 0, '2014-10-18 20:28:42', 'Plataforma Responsiva', '', 207, 130, 'texto', 'desktop'),
(1915, 1, 0, 'background_type', 0, 0, '2014-10-18 20:28:42', NULL, '', 207, 130, 'inteiro', 'desktop'),
(1916, 1, 0, 'background', NULL, 0, '2014-10-18 20:28:42', '', '', 207, 130, 'texto', 'desktop'),
(1917, 140, 0, 'titulo_1', NULL, 0, '2014-10-18 20:48:36', NULL, '', 207, 131, 'texto', 'desktop'),
(1918, 140, 0, 'subtitulo_1', NULL, 0, '2014-10-18 20:48:36', NULL, '', 207, 131, 'texto', 'desktop'),
(1919, 140, 0, 'texto_1', NULL, 0, '2014-10-18 20:48:36', NULL, '', 207, 131, 'texto', 'desktop'),
(1920, 140, 0, 'link_1', NULL, 0, '2014-10-18 20:48:36', NULL, '', 207, 131, 'texto', 'desktop'),
(1921, 140, 0, 'image_1', NULL, 0, '2014-10-18 20:48:36', 'pierlivechat_s1.png', '', 207, 131, 'texto', 'desktop'),
(1922, 140, 0, 'layout_1', NULL, 0, '2014-10-18 20:48:36', 'up', '', 207, 131, 'texto', 'desktop'),
(1923, 140, 0, 'cor_1', NULL, 0, '2014-10-18 20:48:36', '', '', 207, 131, 'texto', 'desktop'),
(1924, 140, 0, 'cor_2', NULL, 0, '2014-10-18 20:48:36', '', '', 207, 131, 'texto', 'desktop'),
(1925, 140, 0, 'cor_3', NULL, 0, '2014-10-18 20:48:36', '', '', 207, 131, 'texto', 'desktop'),
(1926, 140, 0, 'alinhamento_1', NULL, 0, '2014-10-18 20:48:36', 'left', '', 207, 131, 'texto', 'desktop'),
(1927, 140, 0, 'alinhamento_2', NULL, 0, '2014-10-18 20:48:36', 'left', '', 207, 131, 'texto', 'desktop'),
(1928, 140, 0, 'alinhamento_3', NULL, 0, '2014-10-18 20:48:36', 'left', '', 207, 131, 'texto', 'desktop'),
(1929, 140, 0, 'margin_top', 0, 0, '2014-10-18 20:48:36', NULL, '', 207, 131, 'inteiro', 'desktop'),
(1930, 140, 0, 'margin_bottom', 0, 0, '2014-10-18 20:48:36', NULL, '', 207, 131, 'inteiro', 'desktop'),
(1931, 140, 0, 'padding_top', 0, 0, '2014-10-18 20:48:36', NULL, '', 207, 131, 'inteiro', 'desktop'),
(1932, 140, 0, 'padding_bottom', 0, 0, '2014-10-18 20:48:36', NULL, '', 207, 131, 'inteiro', 'desktop'),
(1933, 140, 0, 'is_full', 0, 0, '2014-10-18 20:48:36', NULL, '', 207, 131, 'inteiro', 'desktop'),
(1934, 140, 0, 'titulo_componente', NULL, 0, '2014-10-18 20:48:36', 'Pier Chat', '', 207, 131, 'texto', 'desktop'),
(1935, 140, 0, 'background_type', 0, 0, '2014-10-18 20:48:36', NULL, '', 207, 131, 'inteiro', 'desktop'),
(1936, 140, 0, 'background', NULL, 0, '2014-10-18 20:48:36', '', '', 207, 131, 'texto', 'desktop'),
(1937, 140, 0, 'titulo_1', NULL, 0, '2014-10-18 20:49:01', NULL, 'São vários Aplicativos com diferentes funcionalidades para as paginas do Web Site ', 207, 132, 'texto', 'desktop'),
(1938, 140, 0, 'subtitulo_1', NULL, 0, '2014-10-18 20:49:01', NULL, '', 207, 132, 'texto', 'desktop'),
(1939, 140, 0, 'texto_1', NULL, 0, '2014-10-18 20:49:01', NULL, '', 207, 132, 'texto', 'desktop'),
(1940, 140, 0, 'link_1', NULL, 0, '2014-10-18 20:49:01', NULL, '', 207, 132, 'texto', 'desktop'),
(1941, 140, 0, 'image_1', NULL, 0, '2014-10-18 20:49:01', 'piergestao_z2.png', '', 207, 132, 'texto', 'desktop'),
(1942, 140, 0, 'layout_1', NULL, 0, '2014-10-18 20:49:01', 'down', '', 207, 132, 'texto', 'desktop'),
(1943, 140, 0, 'cor_1', NULL, 0, '2014-10-18 20:49:01', '', '', 207, 132, 'texto', 'desktop'),
(1944, 140, 0, 'cor_2', NULL, 0, '2014-10-18 20:49:01', '', '', 207, 132, 'texto', 'desktop'),
(1945, 140, 0, 'cor_3', NULL, 0, '2014-10-18 20:49:01', '', '', 207, 132, 'texto', 'desktop'),
(1946, 140, 0, 'alinhamento_1', NULL, 0, '2014-10-18 20:49:01', 'center', '', 207, 132, 'texto', 'desktop'),
(1947, 140, 0, 'alinhamento_2', NULL, 0, '2014-10-18 20:49:01', 'left', '', 207, 132, 'texto', 'desktop'),
(1948, 140, 0, 'alinhamento_3', NULL, 0, '2014-10-18 20:49:01', 'left', '', 207, 132, 'texto', 'desktop'),
(1949, 140, 0, 'margin_top', 30, 0, '2014-10-18 20:49:01', NULL, '', 207, 132, 'inteiro', 'desktop'),
(1950, 140, 0, 'margin_bottom', 0, 0, '2014-10-18 20:49:01', NULL, '', 207, 132, 'inteiro', 'desktop'),
(1951, 140, 0, 'padding_top', 10, 0, '2014-10-18 20:49:01', NULL, '', 207, 132, 'inteiro', 'desktop'),
(1952, 140, 0, 'padding_bottom', 20, 0, '2014-10-18 20:49:01', NULL, '', 207, 132, 'inteiro', 'desktop'),
(1953, 140, 0, 'is_full', 0, 0, '2014-10-18 20:49:01', NULL, '', 207, 132, 'inteiro', 'desktop'),
(1954, 140, 0, 'titulo_componente', NULL, 0, '2014-10-18 20:49:01', 'Pier Gestão', '', 207, 132, 'texto', 'desktop'),
(1955, 140, 0, 'background_type', 0, 0, '2014-10-18 20:49:01', NULL, '', 207, 132, 'inteiro', 'desktop'),
(1956, 140, 0, 'background', NULL, 0, '2014-10-18 20:49:01', '', '', 207, 132, 'texto', 'desktop'),
(1957, 140, 0, 'titulo_1', NULL, 0, '2014-10-18 20:49:20', NULL, '', 207, 133, 'texto', 'desktop'),
(1958, 140, 0, 'subtitulo_1', NULL, 0, '2014-10-18 20:49:20', NULL, '', 207, 133, 'texto', 'desktop'),
(1959, 140, 0, 'texto_1', NULL, 0, '2014-10-18 20:49:20', NULL, '', 207, 133, 'texto', 'desktop'),
(1960, 140, 0, 'link_1', NULL, 0, '2014-10-18 20:49:20', NULL, '', 207, 133, 'texto', 'desktop'),
(1961, 140, 0, 'image_1', NULL, 0, '2014-10-18 20:49:20', 'f_900', '', 207, 133, 'image', 'desktop'),
(1962, 140, 0, 'layout_1', NULL, 0, '2014-10-18 20:49:20', 'up', '', 207, 133, 'texto', 'desktop'),
(1963, 140, 0, 'cor_1', NULL, 0, '2014-10-18 20:49:20', '', '', 207, 133, 'texto', 'desktop'),
(1964, 140, 0, 'cor_2', NULL, 0, '2014-10-18 20:49:20', '', '', 207, 133, 'texto', 'desktop'),
(1965, 140, 0, 'cor_3', NULL, 0, '2014-10-18 20:49:20', '', '', 207, 133, 'texto', 'desktop'),
(1966, 140, 0, 'alinhamento_1', NULL, 0, '2014-10-18 20:49:20', 'left', '', 207, 133, 'texto', 'desktop'),
(1967, 140, 0, 'alinhamento_2', NULL, 0, '2014-10-18 20:49:20', 'left', '', 207, 133, 'texto', 'desktop'),
(1968, 140, 0, 'alinhamento_3', NULL, 0, '2014-10-18 20:49:20', 'left', '', 207, 133, 'texto', 'desktop'),
(1969, 140, 0, 'margin_top', 0, 0, '2014-10-18 20:49:20', NULL, '', 207, 133, 'inteiro', 'desktop'),
(1970, 140, 0, 'margin_bottom', 0, 0, '2014-10-18 20:49:20', NULL, '', 207, 133, 'inteiro', 'desktop'),
(1971, 140, 0, 'padding_top', 0, 0, '2014-10-18 20:49:20', NULL, '', 207, 133, 'inteiro', 'desktop'),
(1972, 140, 0, 'padding_bottom', 0, 0, '2014-10-18 20:49:20', NULL, '', 207, 133, 'inteiro', 'desktop'),
(1973, 140, 0, 'is_full', 0, 0, '2014-10-18 20:49:20', NULL, '', 207, 133, 'inteiro', 'desktop'),
(1974, 140, 0, 'titulo_componente', NULL, 0, '2014-10-18 20:49:20', 'Pier Magazine', '', 207, 133, 'texto', 'desktop'),
(1975, 140, 0, 'background_type', 0, 0, '2014-10-18 20:49:20', NULL, '', 207, 133, 'inteiro', 'desktop'),
(1976, 140, 0, 'background', NULL, 0, '2014-10-18 20:49:20', '', '', 207, 133, 'texto', 'desktop'),
(1977, 140, 0, 'link_1', NULL, 0, '2014-10-18 20:51:08', NULL, '', 207, 31, 'texto', 'desktop'),
(1978, 140, 0, 'layout_1', NULL, 0, '2014-10-18 20:51:08', 'up', '', 207, 31, 'texto', 'desktop'),
(1979, 140, 0, 'is_full', 0, 0, '2014-10-18 20:51:08', NULL, '', 207, 31, 'inteiro', 'desktop'),
(1980, 140, 0, 'titulo_componente', NULL, 0, '2014-10-18 20:51:08', 'Paginas Avançadas', '', 207, 31, 'texto', 'desktop'),
(1981, 1, 0, 'qtd_blocos', 2, 0, '2014-10-18 22:40:46', NULL, '', 211, 135, 'inteiro', 'desktop'),
(1982, 1, 0, 'titulo_1', NULL, 0, '2014-10-18 22:40:46', NULL, '', 211, 135, 'texto', 'desktop'),
(1983, 1, 0, 'subtitulo_1', NULL, 0, '2014-10-18 22:40:46', NULL, '', 211, 135, 'texto', 'desktop'),
(1984, 1, 0, 'texto_1', NULL, 0, '2014-10-18 22:40:46', NULL, '', 211, 135, 'texto', 'desktop'),
(1985, 1, 0, 'titulo_2', NULL, 0, '2014-10-18 22:40:46', NULL, '', 211, 135, 'texto', 'desktop'),
(1986, 1, 0, 'subtitulo_2', NULL, 0, '2014-10-18 22:40:46', NULL, '', 211, 135, 'texto', 'desktop'),
(1987, 1, 0, 'texto_2', NULL, 0, '2014-10-18 22:40:46', NULL, '', 211, 135, 'texto', 'desktop'),
(1988, 1, 0, 'titulo_3', NULL, 0, '2014-10-18 22:40:46', NULL, '', 211, 135, 'texto', 'desktop'),
(1989, 1, 0, 'subtitulo_3', NULL, 0, '2014-10-18 22:40:46', NULL, '', 211, 135, 'texto', 'desktop'),
(1990, 1, 0, 'texto_3', NULL, 0, '2014-10-18 22:40:46', NULL, '', 211, 135, 'texto', 'desktop'),
(1991, 1, 0, 'titulo_4', NULL, 0, '2014-10-18 22:40:46', NULL, '', 211, 135, 'texto', 'desktop'),
(1992, 1, 0, 'subtitulo_4', NULL, 0, '2014-10-18 22:40:46', NULL, '', 211, 135, 'texto', 'desktop'),
(1993, 1, 0, 'texto_4', NULL, 0, '2014-10-18 22:40:46', NULL, '', 211, 135, 'texto', 'desktop'),
(1994, 1, 0, 'image_type_1', 1, 0, '2014-10-18 22:40:46', NULL, '', 211, 135, 'inteiro', 'desktop'),
(1995, 1, 0, 'image_1', NULL, 0, '2014-10-18 22:40:46', 'f_900', '', 211, 135, 'image', 'desktop'),
(1996, 1, 0, 'image_type_2', 1, 0, '2014-10-18 22:40:46', NULL, '', 211, 135, 'inteiro', 'desktop'),
(1997, 1, 0, 'image_2', NULL, 0, '2014-10-18 22:40:46', 'f_899', '', 211, 135, 'image', 'desktop'),
(1998, 1, 0, 'image_type_3', 1, 0, '2014-10-18 22:40:46', NULL, '', 211, 135, 'inteiro', 'desktop'),
(1999, 1, 0, 'image_3', NULL, 0, '2014-10-18 22:40:46', 'f_896', '', 211, 135, 'image', 'desktop'),
(2000, 1, 0, 'image_type_4', 1, 0, '2014-10-18 22:40:46', NULL, '', 211, 135, 'inteiro', 'desktop'),
(2001, 1, 0, 'image_4', NULL, 0, '2014-10-18 22:40:46', '', '', 211, 135, 'image', 'desktop'),
(2002, 1, 0, 'item1_cor_1', NULL, 0, '2014-10-18 22:40:46', '', '', 211, 135, 'texto', 'desktop'),
(2003, 1, 0, 'item1_alinhamento_1', NULL, 0, '2014-10-18 22:40:46', 'left', '', 211, 135, 'texto', 'desktop'),
(2004, 1, 0, 'item1_cor_2', NULL, 0, '2014-10-18 22:40:46', '', '', 211, 135, 'texto', 'desktop'),
(2005, 1, 0, 'item1_alinhamento_2', NULL, 0, '2014-10-18 22:40:46', 'left', '', 211, 135, 'texto', 'desktop'),
(2006, 1, 0, 'item1_cor_3', NULL, 0, '2014-10-18 22:40:46', '', '', 211, 135, 'texto', 'desktop'),
(2007, 1, 0, 'item1_alinhamento_3', NULL, 0, '2014-10-18 22:40:46', 'left', '', 211, 135, 'texto', 'desktop'),
(2008, 1, 0, 'item2_cor_1', NULL, 0, '2014-10-18 22:40:46', '', '', 211, 135, 'texto', 'desktop'),
(2009, 1, 0, 'item2_alinhamento_1', NULL, 0, '2014-10-18 22:40:46', 'left', '', 211, 135, 'texto', 'desktop'),
(2010, 1, 0, 'item2_cor_2', NULL, 0, '2014-10-18 22:40:46', '', '', 211, 135, 'texto', 'desktop'),
(2011, 1, 0, 'item2_alinhamento_2', NULL, 0, '2014-10-18 22:40:46', 'left', '', 211, 135, 'texto', 'desktop'),
(2012, 1, 0, 'item2_cor_3', NULL, 0, '2014-10-18 22:40:46', '', '', 211, 135, 'texto', 'desktop'),
(2013, 1, 0, 'item2_alinhamento_3', NULL, 0, '2014-10-18 22:40:46', 'left', '', 211, 135, 'texto', 'desktop'),
(2014, 1, 0, 'item3_cor_1', NULL, 0, '2014-10-18 22:40:46', '', '', 211, 135, 'texto', 'desktop'),
(2015, 1, 0, 'item3_alinhamento_1', NULL, 0, '2014-10-18 22:40:46', 'left', '', 211, 135, 'texto', 'desktop'),
(2016, 1, 0, 'item3_cor_2', NULL, 0, '2014-10-18 22:40:46', '', '', 211, 135, 'texto', 'desktop'),
(2017, 1, 0, 'item3_alinhamento_2', NULL, 0, '2014-10-18 22:40:46', 'left', '', 211, 135, 'texto', 'desktop'),
(2018, 1, 0, 'item3_cor_3', NULL, 0, '2014-10-18 22:40:46', '', '', 211, 135, 'texto', 'desktop'),
(2019, 1, 0, 'item3_alinhamento_3', NULL, 0, '2014-10-18 22:40:46', 'left', '', 211, 135, 'texto', 'desktop'),
(2020, 1, 0, 'item4_cor_1', NULL, 0, '2014-10-18 22:40:46', '', '', 211, 135, 'texto', 'desktop'),
(2021, 1, 0, 'item4_alinhamento_1', NULL, 0, '2014-10-18 22:40:46', 'left', '', 211, 135, 'texto', 'desktop'),
(2022, 1, 0, 'item4_cor_2', NULL, 0, '2014-10-18 22:40:46', '', '', 211, 135, 'texto', 'desktop'),
(2023, 1, 0, 'item4_alinhamento_2', NULL, 0, '2014-10-18 22:40:46', 'left', '', 211, 135, 'texto', 'desktop'),
(2024, 1, 0, 'item4_cor_3', NULL, 0, '2014-10-18 22:40:46', '', '', 211, 135, 'texto', 'desktop'),
(2025, 1, 0, 'item4_alinhamento_3', NULL, 0, '2014-10-18 22:40:46', 'left', '', 211, 135, 'texto', 'desktop'),
(2026, 1, 0, 'botao_exibe', 0, 0, '2014-10-18 22:40:46', NULL, '', 211, 135, 'inteiro', 'desktop'),
(2027, 1, 0, 'margin_top', 0, 0, '2014-10-18 22:40:46', NULL, '', 211, 135, 'inteiro', 'desktop'),
(2028, 1, 0, 'margin_bottom', 0, 0, '2014-10-18 22:40:46', NULL, '', 211, 135, 'inteiro', 'desktop'),
(2029, 1, 0, 'padding_top', 0, 0, '2014-10-18 22:40:46', NULL, '', 211, 135, 'inteiro', 'desktop'),
(2030, 1, 0, 'padding_bottom', 0, 0, '2014-10-18 22:40:46', NULL, '', 211, 135, 'inteiro', 'desktop'),
(2031, 1, 0, 'is_full', 0, 0, '2014-10-18 22:40:46', NULL, '', 211, 135, 'inteiro', 'desktop'),
(2032, 1, 0, 'background_type', 0, 0, '2014-10-18 22:40:46', NULL, '', 211, 135, 'inteiro', 'desktop'),
(2033, 1, 0, 'background', NULL, 0, '2014-10-18 22:40:46', '', '', 211, 135, 'texto', 'desktop'),
(2034, 1, 0, 'titulo_1', NULL, 0, '2014-10-18 22:45:39', NULL, '', 207, 134, 'texto', 'desktop'),
(2035, 1, 0, 'subtitulo_1', NULL, 0, '2014-10-18 22:45:39', NULL, '', 207, 134, 'texto', 'desktop'),
(2036, 1, 0, 'texto_1', NULL, 0, '2014-10-18 22:45:39', NULL, '', 207, 134, 'texto', 'desktop'),
(2037, 1, 0, 'link_1', NULL, 0, '2014-10-18 22:45:39', NULL, 'https://purplepier.com.br/paginas_avancadas', 207, 134, 'texto', 'desktop'),
(2038, 1, 0, 'image_1', NULL, 0, '2014-10-18 22:45:39', 'f_900', '', 207, 134, 'image', 'desktop'),
(2039, 1, 0, 'layout_1', NULL, 0, '2014-10-18 22:45:39', 'up', '', 207, 134, 'texto', 'desktop'),
(2040, 1, 0, 'cor_1', NULL, 0, '2014-10-18 22:45:39', '', '', 207, 134, 'texto', 'desktop'),
(2041, 1, 0, 'cor_2', NULL, 0, '2014-10-18 22:45:39', '', '', 207, 134, 'texto', 'desktop'),
(2042, 1, 0, 'cor_3', NULL, 0, '2014-10-18 22:45:39', '', '', 207, 134, 'texto', 'desktop'),
(2043, 1, 0, 'alinhamento_1', NULL, 0, '2014-10-18 22:45:39', 'left', '', 207, 134, 'texto', 'desktop'),
(2044, 1, 0, 'alinhamento_2', NULL, 0, '2014-10-18 22:45:39', 'left', '', 207, 134, 'texto', 'desktop'),
(2045, 1, 0, 'alinhamento_3', NULL, 0, '2014-10-18 22:45:39', 'left', '', 207, 134, 'texto', 'desktop'),
(2046, 1, 0, 'margin_top', 0, 0, '2014-10-18 22:45:39', NULL, '', 207, 134, 'inteiro', 'desktop'),
(2047, 1, 0, 'margin_bottom', 0, 0, '2014-10-18 22:45:39', NULL, '', 207, 134, 'inteiro', 'desktop'),
(2048, 1, 0, 'padding_top', 0, 0, '2014-10-18 22:45:39', NULL, '', 207, 134, 'inteiro', 'desktop'),
(2049, 1, 0, 'padding_bottom', 0, 0, '2014-10-18 22:45:39', NULL, '', 207, 134, 'inteiro', 'desktop'),
(2050, 1, 0, 'is_full', 0, 0, '2014-10-18 22:45:39', NULL, '', 207, 134, 'inteiro', 'desktop'),
(2051, 1, 0, 'titulo_componente', NULL, 0, '2014-10-18 22:45:39', 'Paginas Avançadas', '', 207, 134, 'texto', 'desktop'),
(2052, 1, 0, 'background_type', 0, 0, '2014-10-18 22:45:39', NULL, '', 207, 134, 'inteiro', 'desktop'),
(2053, 1, 0, 'background', NULL, 0, '2014-10-18 22:45:39', '', '', 207, 134, 'texto', 'desktop'),
(2054, 1, 0, 'titulo_1', NULL, 0, '2014-10-18 22:52:28', NULL, '', 255, 136, 'texto', 'desktop'),
(2055, 1, 0, 'subtitulo_1', NULL, 0, '2014-10-18 22:52:28', NULL, 'Tudo feito com Páginas Avançadas', 255, 136, 'texto', 'desktop'),
(2056, 1, 0, 'texto_1', NULL, 0, '2014-10-18 22:52:28', NULL, '', 255, 136, 'texto', 'desktop'),
(2057, 1, 0, 'cor_1', NULL, 0, '2014-10-18 22:52:28', '', '', 255, 136, 'texto', 'desktop'),
(2058, 1, 0, 'cor_2', NULL, 0, '2014-10-18 22:52:28', '#1e6bb8', '', 255, 136, 'texto', 'desktop'),
(2059, 1, 0, 'cor_3', NULL, 0, '2014-10-18 22:52:28', '', '', 255, 136, 'texto', 'desktop'),
(2060, 1, 0, 'galeria', NULL, 0, '2014-10-18 22:52:28', '93-114', '', 255, 136, 'texto', 'desktop'),
(2061, 1, 0, 'botao_exibe', 0, 0, '2014-10-18 22:52:28', NULL, '', 255, 136, 'inteiro', 'desktop'),
(2062, 1, 0, 'titulo_exibe', 0, 0, '2014-10-18 22:52:28', NULL, '', 255, 136, 'inteiro', 'desktop'),
(2063, 1, 0, 'margin_top', 30, 0, '2014-10-18 22:52:28', NULL, '', 255, 136, 'inteiro', 'desktop'),
(2064, 1, 0, 'margin_bottom', 10, 0, '2014-10-18 22:52:28', NULL, '', 255, 136, 'inteiro', 'desktop'),
(2065, 1, 0, 'is_full', 0, 0, '2014-10-18 22:52:28', NULL, '', 255, 136, 'inteiro', 'desktop'),
(2066, 1, 0, 'titulo_componente', NULL, 0, '2014-10-18 22:52:28', 'Paginas Avançadas', '', 255, 136, 'texto', 'desktop'),
(2067, 1, 0, 'background_type', 0, 0, '2014-10-18 22:52:28', NULL, '', 255, 136, 'inteiro', 'desktop'),
(2068, 1, 0, 'background', NULL, 0, '2014-10-18 22:52:28', '', '', 255, 136, 'texto', 'desktop'),
(2069, 146, 0, 'titulo_1', NULL, 0, '2014-10-20 17:01:29', NULL, 'Sejam bem vindos site da One Project', 187, 137, 'texto', 'desktop'),
(2070, 146, 0, 'subtitulo_1', NULL, 0, '2014-10-20 17:01:29', NULL, 'A máquina, o modelo que você precisa do jeito que você precisa!', 187, 137, 'texto', 'desktop'),
(2071, 146, 0, 'texto_1', NULL, 0, '2014-10-20 17:01:29', NULL, 'A máquina, o modelo que você precisa do jeito que você precisa!\r\nA One Project desenvolve equipamentos leves, flexíveis, com avançada tecnologia, agregando qualidade', 187, 137, 'texto', 'desktop'),
(2072, 146, 0, 'cor_1', NULL, 0, '2014-10-20 17:01:29', '#9d0c0c', '', 187, 137, 'texto', 'desktop'),
(2073, 146, 0, 'cor_2', NULL, 0, '2014-10-20 17:01:29', '', '', 187, 137, 'texto', 'desktop'),
(2074, 146, 0, 'cor_3', NULL, 0, '2014-10-20 17:01:29', '', '', 187, 137, 'texto', 'desktop'),
(2075, 146, 0, 'comecar_em', 0, 0, '2014-10-20 17:01:29', NULL, '', 187, 137, 'inteiro', 'desktop'),
(2076, 146, 0, 'qtd_items', 0, 0, '2014-10-20 17:01:29', NULL, '', 187, 137, 'inteiro', 'desktop'),
(2077, 146, 0, 'is_full', 0, 0, '2014-10-20 17:01:29', NULL, '', 187, 137, 'inteiro', 'desktop'),
(2078, 146, 0, 'titulo_1', NULL, 0, '2014-10-20 17:20:03', NULL, 'Sejam bem vindos site da One Project', 207, 138, 'texto', 'desktop'),
(2079, 146, 0, 'subtitulo_1', NULL, 0, '2014-10-20 17:20:03', NULL, 'Aqui você encontra Projetos, Criação e Fabricação de Máquinas CNC', 207, 138, 'texto', 'desktop'),
(2080, 146, 0, 'texto_1', NULL, 0, '2014-10-20 17:20:03', NULL, 'A máquina, o modelo que você precisa do jeito que você precisa!\r\nA One Project desenvolve equipamentos leves, flexíveis, com avançada tecnologia, agregando qualidade', 207, 138, 'texto', 'desktop'),
(2081, 146, 0, 'link_1', NULL, 0, '2014-10-20 17:20:03', NULL, '', 207, 138, 'texto', 'desktop'),
(2082, 146, 0, 'image_1', NULL, 0, '2014-10-20 17:20:03', 'f_900', '', 207, 138, 'image', 'desktop'),
(2083, 146, 0, 'layout_1', NULL, 0, '2014-10-20 17:20:03', 'down', '', 207, 138, 'texto', 'desktop'),
(2084, 146, 0, 'cor_1', NULL, 0, '2014-10-20 17:20:03', '#8e1016', '', 207, 138, 'texto', 'desktop'),
(2085, 146, 0, 'cor_2', NULL, 0, '2014-10-20 17:20:03', '#674c4d', '', 207, 138, 'texto', 'desktop'),
(2086, 146, 0, 'cor_3', NULL, 0, '2014-10-20 17:20:03', '', '', 207, 138, 'texto', 'desktop'),
(2087, 146, 0, 'alinhamento_1', NULL, 0, '2014-10-20 17:20:03', 'center', '', 207, 138, 'texto', 'desktop'),
(2088, 146, 0, 'alinhamento_2', NULL, 0, '2014-10-20 17:20:03', 'center', '', 207, 138, 'texto', 'desktop'),
(2089, 146, 0, 'alinhamento_3', NULL, 0, '2014-10-20 17:20:03', 'center', '', 207, 138, 'texto', 'desktop'),
(2090, 146, 0, 'margin_top', 0, 0, '2014-10-20 17:20:03', NULL, '', 207, 138, 'inteiro', 'desktop'),
(2091, 146, 0, 'margin_bottom', 0, 0, '2014-10-20 17:20:03', NULL, '', 207, 138, 'inteiro', 'desktop'),
(2092, 146, 0, 'padding_top', 0, 0, '2014-10-20 17:20:03', NULL, '', 207, 138, 'inteiro', 'desktop'),
(2093, 146, 0, 'padding_bottom', 0, 0, '2014-10-20 17:20:03', NULL, '', 207, 138, 'inteiro', 'desktop'),
(2094, 146, 0, 'is_full', 0, 0, '2014-10-20 17:20:03', NULL, '', 207, 138, 'inteiro', 'desktop'),
(2095, 146, 0, 'titulo_componente', NULL, 0, '2014-10-20 17:20:03', 'Sejam bem vindos', '', 207, 138, 'texto', 'desktop'),
(2096, 146, 0, 'background_type', 0, 0, '2014-10-20 17:20:03', NULL, '', 207, 138, 'inteiro', 'desktop'),
(2097, 146, 0, 'background', NULL, 0, '2014-10-20 17:20:03', '', '', 207, 138, 'texto', 'desktop'),
(2098, 146, 0, 'titulo_1', NULL, 0, '2014-10-20 17:22:19', NULL, 'Sejam bem vindos site da One Project', 255, 139, 'texto', 'desktop'),
(2099, 146, 0, 'subtitulo_1', NULL, 0, '2014-10-20 17:22:19', NULL, 'Sejam bem vindos site da One Project', 255, 139, 'texto', 'desktop'),
(2100, 146, 0, 'texto_1', NULL, 0, '2014-10-20 17:22:19', NULL, 'Sejam bem vindos site da One Project. Sejam bem vindos site da One Project', 255, 139, 'texto', 'desktop'),
(2101, 146, 0, 'cor_1', NULL, 0, '2014-10-20 17:22:19', '', '', 255, 139, 'texto', 'desktop'),
(2102, 146, 0, 'cor_2', NULL, 0, '2014-10-20 17:22:19', '', '', 255, 139, 'texto', 'desktop'),
(2103, 146, 0, 'cor_3', NULL, 0, '2014-10-20 17:22:19', '', '', 255, 139, 'texto', 'desktop'),
(2104, 146, 0, 'galeria', NULL, 0, '2014-10-20 17:22:19', '93-114', '', 255, 139, 'texto', 'desktop'),
(2105, 146, 0, 'botao_exibe', 0, 0, '2014-10-20 17:22:19', NULL, '', 255, 139, 'inteiro', 'desktop'),
(2106, 146, 0, 'titulo_exibe', 0, 0, '2014-10-20 17:22:19', NULL, '', 255, 139, 'inteiro', 'desktop'),
(2107, 146, 0, 'margin_top', 40, 0, '2014-10-20 17:22:19', NULL, '', 255, 139, 'inteiro', 'desktop'),
(2108, 146, 0, 'margin_bottom', 0, 0, '2014-10-20 17:22:19', NULL, '', 255, 139, 'inteiro', 'desktop'),
(2109, 146, 0, 'is_full', 1, 0, '2014-10-20 17:22:19', NULL, '', 255, 139, 'inteiro', 'desktop'),
(2110, 146, 0, 'titulo_componente', NULL, 0, '2014-10-20 17:22:19', 'Galeria de imagens', '', 255, 139, 'texto', 'desktop'),
(2111, 146, 0, 'background_type', 2, 0, '2014-10-20 17:22:19', NULL, '', 255, 139, 'inteiro', 'desktop'),
(2112, 146, 0, 'background', NULL, 0, '2014-10-20 17:22:19', 'effect18.png', '', 255, 139, 'texto', 'desktop'),
(2113, 146, 0, 'background_color', NULL, 0, '2014-10-20 17:26:35', '', '', 255, 139, 'texto', 'desktop'),
(2114, 145, 0, 'titulo_1', NULL, 0, '2014-10-22 20:47:42', NULL, 'Dicas de Downloads', 186, 140, 'texto', 'desktop'),
(2115, 145, 0, 'subtitulo_1', NULL, 0, '2014-10-22 20:47:42', NULL, '', 186, 140, 'texto', 'desktop'),
(2116, 145, 0, 'link_1', NULL, 0, '2014-10-22 20:47:42', NULL, '/dicas_downloads', 186, 140, 'texto', 'desktop'),
(2117, 145, 0, 'image_1', NULL, 0, '2014-10-22 20:47:42', '', '', 186, 140, 'texto', 'desktop'),
(2118, 145, 0, 'layout_1', NULL, 0, '2014-10-22 20:47:42', 'left', '', 186, 140, 'texto', 'desktop'),
(2119, 145, 0, 'cor_1', NULL, 0, '2014-10-22 20:47:43', '', '', 186, 140, 'texto', 'desktop'),
(2120, 145, 0, 'cor_2', NULL, 0, '2014-10-22 20:47:43', '', '', 186, 140, 'texto', 'desktop'),
(2121, 145, 0, 'cor_3', NULL, 0, '2014-10-22 20:47:43', '', '', 186, 140, 'texto', 'desktop'),
(2122, 145, 0, 'alinhamento_1', NULL, 0, '2014-10-22 20:47:43', 'left', '', 186, 140, 'texto', 'desktop'),
(2123, 145, 0, 'alinhamento_2', NULL, 0, '2014-10-22 20:47:43', 'left', '', 186, 140, 'texto', 'desktop'),
(2124, 145, 0, 'alinhamento_3', NULL, 0, '2014-10-22 20:47:43', 'left', '', 186, 140, 'texto', 'desktop'),
(2125, 145, 0, 'margin_top', 0, 0, '2014-10-22 20:47:43', NULL, '', 186, 140, 'inteiro', 'desktop'),
(2126, 145, 0, 'margin_bottom', 0, 0, '2014-10-22 20:47:43', NULL, '', 186, 140, 'inteiro', 'desktop'),
(2127, 145, 0, 'padding_top', 0, 0, '2014-10-22 20:47:43', NULL, '', 186, 140, 'inteiro', 'desktop'),
(2128, 145, 0, 'padding_bottom', 0, 0, '2014-10-22 20:47:43', NULL, '', 186, 140, 'inteiro', 'desktop'),
(2129, 145, 0, 'is_full', 0, 0, '2014-10-22 20:47:43', NULL, '', 186, 140, 'inteiro', 'desktop'),
(2130, 145, 0, 'titulo_componente', NULL, 0, '2014-10-22 20:47:43', 'Dicas de Downloads', '', 186, 140, 'texto', 'desktop'),
(2131, 145, 0, 'background_type', 0, 0, '2014-10-22 20:47:43', NULL, '', 186, 140, 'inteiro', 'desktop'),
(2132, 145, 0, 'background', NULL, 0, '2014-10-22 20:47:43', '', '', 186, 140, 'texto', 'desktop'),
(2133, 145, 0, 'texto_1', NULL, 0, '2014-10-22 20:51:36', NULL, 'Veja dicas para downloads', 186, 140, 'texto', 'desktop'),
(2134, 147, 0, 'titulo_1', NULL, 0, '2014-10-22 20:55:12', NULL, 'Passo - 1', 186, 141, 'texto', 'desktop'),
(2135, 147, 0, 'subtitulo_1', NULL, 0, '2014-10-22 20:55:12', NULL, 'Suba o arquivo no seu admin', 186, 141, 'texto', 'desktop'),
(2136, 147, 0, 'texto_1', NULL, 0, '2014-10-22 20:55:12', NULL, 'Depois de subir o arquivo, vá em downloads / listar. \r\nCopie o nome do arquivo, na tabela listar tem duas colunas: Nome e Arquivo... copie o nome da coluna \"arquivo\", pois o nome do arquivo vai estar otimizado removendo: espaços, acentos, caracteres especiais e etc.\r\n\r\nAgora basta adicionar esse nome de arquivo ao link abaixo.\r\n\r\nhttp://www.seudominio.com.br/media/user/downloads/\r\n\r\nVai ficar algo do tipo: http://www.seudominio.bz/media/user/downloads/seu_arquivo.ext\r\n\r\nCom esse link você pode baixar os arquivos que subiu em seu site.\r\n\r\nCaso não consiga pelas dicas acima digite no browser: http://www.seusite.com.br/downloads\r\nSerá exibido a lista de todos os downloads que você cadastrou no site agora basta encontrar aquele que você deseja baixar e clicar no link. \r\n\r\nVocê também pode copiar o link e colar no e-mail para enviar para seus usuários', 186, 141, 'texto', 'desktop'),
(2137, 147, 0, 'link_1', NULL, 0, '2014-10-22 20:55:12', NULL, '', 186, 141, 'texto', 'desktop'),
(2138, 147, 0, 'image_1', NULL, 0, '2014-10-22 20:55:12', '', '', 186, 141, 'texto', 'desktop'),
(2139, 147, 0, 'layout_1', NULL, 0, '2014-10-22 20:55:12', 'left', '', 186, 141, 'texto', 'desktop'),
(2140, 147, 0, 'cor_1', NULL, 0, '2014-10-22 20:55:12', '', '', 186, 141, 'texto', 'desktop'),
(2141, 147, 0, 'cor_2', NULL, 0, '2014-10-22 20:55:12', '', '', 186, 141, 'texto', 'desktop'),
(2142, 147, 0, 'cor_3', NULL, 0, '2014-10-22 20:55:12', '', '', 186, 141, 'texto', 'desktop'),
(2143, 147, 0, 'alinhamento_1', NULL, 0, '2014-10-22 20:55:12', 'left', '', 186, 141, 'texto', 'desktop'),
(2144, 147, 0, 'alinhamento_2', NULL, 0, '2014-10-22 20:55:13', 'left', '', 186, 141, 'texto', 'desktop'),
(2145, 147, 0, 'alinhamento_3', NULL, 0, '2014-10-22 20:55:13', 'left', '', 186, 141, 'texto', 'desktop'),
(2146, 147, 0, 'margin_top', 0, 0, '2014-10-22 20:55:13', NULL, '', 186, 141, 'inteiro', 'desktop'),
(2147, 147, 0, 'margin_bottom', 0, 0, '2014-10-22 20:55:13', NULL, '', 186, 141, 'inteiro', 'desktop'),
(2148, 147, 0, 'padding_top', 0, 0, '2014-10-22 20:55:13', NULL, '', 186, 141, 'inteiro', 'desktop'),
(2149, 147, 0, 'padding_bottom', 0, 0, '2014-10-22 20:55:13', NULL, '', 186, 141, 'inteiro', 'desktop'),
(2150, 147, 0, 'is_full', 0, 0, '2014-10-22 20:55:13', NULL, '', 186, 141, 'inteiro', 'desktop'),
(2151, 147, 0, 'titulo_componente', NULL, 0, '2014-10-22 20:55:13', '', '', 186, 141, 'texto', 'desktop'),
(2152, 147, 0, 'background_type', 0, 0, '2014-10-22 20:55:13', NULL, '', 186, 141, 'inteiro', 'desktop'),
(2153, 147, 0, 'background', NULL, 0, '2014-10-22 20:55:13', '', '', 186, 141, 'texto', 'desktop'),
(2154, 145, 0, 'titulo_1', NULL, 0, '2014-10-22 20:57:39', NULL, 'Dicas para Disparar e-mails pelo PierMail', 186, 142, 'texto', 'desktop'),
(2155, 145, 0, 'subtitulo_1', NULL, 0, '2014-10-22 20:57:39', NULL, '', 186, 142, 'texto', 'desktop'),
(2156, 145, 0, 'texto_1', NULL, 0, '2014-10-22 20:57:39', NULL, 'Veja dicas para criar templates, campanhas e tudo mais que você precisa saber para disparar seus e-mail', 186, 142, 'texto', 'desktop'),
(2157, 145, 0, 'link_1', NULL, 0, '2014-10-22 20:57:39', NULL, '/piermail_dicas', 186, 142, 'texto', 'desktop'),
(2158, 145, 0, 'image_1', NULL, 0, '2014-10-22 20:57:39', '', '', 186, 142, 'texto', 'desktop'),
(2159, 145, 0, 'layout_1', NULL, 0, '2014-10-22 20:57:39', 'left', '', 186, 142, 'texto', 'desktop'),
(2160, 145, 0, 'cor_1', NULL, 0, '2014-10-22 20:57:39', '', '', 186, 142, 'texto', 'desktop'),
(2161, 145, 0, 'cor_2', NULL, 0, '2014-10-22 20:57:39', '', '', 186, 142, 'texto', 'desktop'),
(2162, 145, 0, 'cor_3', NULL, 0, '2014-10-22 20:57:39', '', '', 186, 142, 'texto', 'desktop'),
(2163, 145, 0, 'alinhamento_1', NULL, 0, '2014-10-22 20:57:40', 'left', '', 186, 142, 'texto', 'desktop'),
(2164, 145, 0, 'alinhamento_2', NULL, 0, '2014-10-22 20:57:40', 'left', '', 186, 142, 'texto', 'desktop'),
(2165, 145, 0, 'alinhamento_3', NULL, 0, '2014-10-22 20:57:40', 'left', '', 186, 142, 'texto', 'desktop'),
(2166, 145, 0, 'margin_top', 0, 0, '2014-10-22 20:57:40', NULL, '', 186, 142, 'inteiro', 'desktop'),
(2167, 145, 0, 'margin_bottom', 0, 0, '2014-10-22 20:57:40', NULL, '', 186, 142, 'inteiro', 'desktop'),
(2168, 145, 0, 'padding_top', 0, 0, '2014-10-22 20:57:40', NULL, '', 186, 142, 'inteiro', 'desktop'),
(2169, 145, 0, 'padding_bottom', 0, 0, '2014-10-22 20:57:40', NULL, '', 186, 142, 'inteiro', 'desktop'),
(2170, 145, 0, 'is_full', 0, 0, '2014-10-22 20:57:40', NULL, '', 186, 142, 'inteiro', 'desktop'),
(2171, 145, 0, 'titulo_componente', NULL, 0, '2014-10-22 20:57:40', 'Dicas para PierMail', '', 186, 142, 'texto', 'desktop'),
(2172, 145, 0, 'background_type', 0, 0, '2014-10-22 20:57:40', NULL, '', 186, 142, 'inteiro', 'desktop'),
(2173, 145, 0, 'background', NULL, 0, '2014-10-22 20:57:41', '', '', 186, 142, 'texto', 'desktop'),
(2174, 148, 0, 'titulo_1', NULL, 0, '2014-10-23 11:10:00', NULL, 'Passo -1', 186, 143, 'texto', 'desktop'),
(2175, 148, 0, 'subtitulo_1', NULL, 0, '2014-10-23 11:10:00', NULL, 'Criação do aplicativo Facebook', 186, 143, 'texto', 'desktop'),
(2176, 148, 0, 'texto_1', NULL, 0, '2014-10-23 11:10:00', NULL, 'O PurplePier criará o aplicativo no Facebook para seu site,\r\n\r\nO Dono da página, quem criou a página deve Curtir a página do  Facebook do PurplePier e ser nosso amigo.\r\nEnviaremos um convite para esse amigo, dono da página ser um desenvolvedor/adminstrador.\r\n\r\nPara concluir esse deve ter sua conta Facebook confirmada: <a href=\"https://www.facebook.com/help/verify\">Central de ajuda</a> \r\nSerá enviado um sms para o usuário confirmar a conta, o formato do número do celular deve ser: 019991144649\r\n\r\nGeralmente demora para vir o sms com o link, aguarde\r\n', 186, 143, 'texto', 'desktop'),
(2177, 148, 0, 'link_1', NULL, 0, '2014-10-23 11:10:00', NULL, '', 186, 143, 'texto', 'desktop'),
(2178, 148, 0, 'image_1', NULL, 0, '2014-10-23 11:10:00', '', '', 186, 143, 'texto', 'desktop'),
(2179, 148, 0, 'layout_1', NULL, 0, '2014-10-23 11:10:00', 'left', '', 186, 143, 'texto', 'desktop'),
(2180, 148, 0, 'cor_1', NULL, 0, '2014-10-23 11:10:00', '', '', 186, 143, 'texto', 'desktop'),
(2181, 148, 0, 'cor_2', NULL, 0, '2014-10-23 11:10:00', '', '', 186, 143, 'texto', 'desktop'),
(2182, 148, 0, 'cor_3', NULL, 0, '2014-10-23 11:10:00', '', '', 186, 143, 'texto', 'desktop'),
(2183, 148, 0, 'alinhamento_1', NULL, 0, '2014-10-23 11:10:00', 'left', '', 186, 143, 'texto', 'desktop'),
(2184, 148, 0, 'alinhamento_2', NULL, 0, '2014-10-23 11:10:00', 'left', '', 186, 143, 'texto', 'desktop'),
(2185, 148, 0, 'alinhamento_3', NULL, 0, '2014-10-23 11:10:00', 'left', '', 186, 143, 'texto', 'desktop');
INSERT INTO `paginas_attribute` (`id`, `id_pagina`, `user_id`, `name`, `inteiro`, `number`, `estampa`, `texto`, `descricao`, `id_componente`, `id_row`, `tipo`, `plataforma`) VALUES
(2186, 148, 0, 'margin_top', 0, 0, '2014-10-23 11:10:00', NULL, '', 186, 143, 'inteiro', 'desktop'),
(2187, 148, 0, 'margin_bottom', 0, 0, '2014-10-23 11:10:00', NULL, '', 186, 143, 'inteiro', 'desktop'),
(2188, 148, 0, 'padding_top', 0, 0, '2014-10-23 11:10:00', NULL, '', 186, 143, 'inteiro', 'desktop'),
(2189, 148, 0, 'padding_bottom', 0, 0, '2014-10-23 11:10:00', NULL, '', 186, 143, 'inteiro', 'desktop'),
(2190, 148, 0, 'is_full', 0, 0, '2014-10-23 11:10:00', NULL, '', 186, 143, 'inteiro', 'desktop'),
(2191, 148, 0, 'titulo_componente', NULL, 0, '2014-10-23 11:10:00', 'Passo -1 ', '', 186, 143, 'texto', 'desktop'),
(2192, 148, 0, 'background_type', 0, 0, '2014-10-23 11:10:00', NULL, '', 186, 143, 'inteiro', 'desktop'),
(2193, 148, 0, 'background', NULL, 0, '2014-10-23 11:10:00', '', '', 186, 143, 'texto', 'desktop'),
(2194, 148, 0, 'titulo_1', NULL, 0, '2014-10-23 11:12:17', NULL, 'Passo - 2', 186, 144, 'texto', 'desktop'),
(2195, 148, 0, 'subtitulo_1', NULL, 0, '2014-10-23 11:12:17', NULL, 'Aceitar o aplicativo Facebook', 186, 144, 'texto', 'desktop'),
(2196, 148, 0, 'texto_1', NULL, 0, '2014-10-23 11:12:17', NULL, 'Após aceito o aplicativo acesse:\r\nNo Admin do seu site: Admin / Controle / Rede Sociais / Facebook / Configurar.\r\n\r\nOs dados devem estarão pre-configurados e não precisa ser editado.\r\n\r\nPasta clicar em \"Aceitar\"\r\n\r\nSerá aberto um popup do Facebook pedindo acesso aos dados da conta: e-mail, data nascimento...\r\n\r\nAceite!\r\n\r\nSerá exibido mais um pedido de autorização, desta vez para editar suas páginas.\r\n\r\nAceite!\r\n\r\nPronto! Agora seu site está pronto para publicar suas matérias, produtos, eventos direto no Facebook', 186, 144, 'texto', 'desktop'),
(2197, 148, 0, 'link_1', NULL, 0, '2014-10-23 11:12:17', NULL, '', 186, 144, 'texto', 'desktop'),
(2198, 148, 0, 'image_1', NULL, 0, '2014-10-23 11:12:17', '', '', 186, 144, 'texto', 'desktop'),
(2199, 148, 0, 'layout_1', NULL, 0, '2014-10-23 11:12:17', 'left', '', 186, 144, 'texto', 'desktop'),
(2200, 148, 0, 'cor_1', NULL, 0, '2014-10-23 11:12:17', '', '', 186, 144, 'texto', 'desktop'),
(2201, 148, 0, 'cor_2', NULL, 0, '2014-10-23 11:12:17', '', '', 186, 144, 'texto', 'desktop'),
(2202, 148, 0, 'cor_3', NULL, 0, '2014-10-23 11:12:17', '', '', 186, 144, 'texto', 'desktop'),
(2203, 148, 0, 'alinhamento_1', NULL, 0, '2014-10-23 11:12:17', 'left', '', 186, 144, 'texto', 'desktop'),
(2204, 148, 0, 'alinhamento_2', NULL, 0, '2014-10-23 11:12:17', 'left', '', 186, 144, 'texto', 'desktop'),
(2205, 148, 0, 'alinhamento_3', NULL, 0, '2014-10-23 11:12:17', 'left', '', 186, 144, 'texto', 'desktop'),
(2206, 148, 0, 'margin_top', 0, 0, '2014-10-23 11:12:17', NULL, '', 186, 144, 'inteiro', 'desktop'),
(2207, 148, 0, 'margin_bottom', 0, 0, '2014-10-23 11:12:17', NULL, '', 186, 144, 'inteiro', 'desktop'),
(2208, 148, 0, 'padding_top', 0, 0, '2014-10-23 11:12:17', NULL, '', 186, 144, 'inteiro', 'desktop'),
(2209, 148, 0, 'padding_bottom', 0, 0, '2014-10-23 11:12:17', NULL, '', 186, 144, 'inteiro', 'desktop'),
(2210, 148, 0, 'is_full', 0, 0, '2014-10-23 11:12:17', NULL, '', 186, 144, 'inteiro', 'desktop'),
(2211, 148, 0, 'titulo_componente', NULL, 0, '2014-10-23 11:12:17', 'Passo - 2', '', 186, 144, 'texto', 'desktop'),
(2212, 148, 0, 'background_type', 0, 0, '2014-10-23 11:12:17', NULL, '', 186, 144, 'inteiro', 'desktop'),
(2213, 148, 0, 'background', NULL, 0, '2014-10-23 11:12:17', '', '', 186, 144, 'texto', 'desktop'),
(2214, 145, 0, 'titulo_1', NULL, 0, '2014-10-23 11:15:18', NULL, 'Dicas para aceitar o aplicativo Facebook', 186, 145, 'texto', 'desktop'),
(2215, 145, 0, 'subtitulo_1', NULL, 0, '2014-10-23 11:15:18', NULL, '', 186, 145, 'texto', 'desktop'),
(2216, 145, 0, 'texto_1', NULL, 0, '2014-10-23 11:15:18', NULL, 'Veja as dicas para aceitar o aplicativo do Facebook e publicar, suas matérias, eventos, produtos utilizando a ferramenta\r\nde Publicação do PurplePier.', 186, 145, 'texto', 'desktop'),
(2217, 145, 0, 'link_1', NULL, 0, '2014-10-23 11:15:18', NULL, '/dicas_aplicativo_facebook', 186, 145, 'texto', 'desktop'),
(2218, 145, 0, 'image_1', NULL, 0, '2014-10-23 11:15:18', '', '', 186, 145, 'texto', 'desktop'),
(2219, 145, 0, 'layout_1', NULL, 0, '2014-10-23 11:15:18', 'left', '', 186, 145, 'texto', 'desktop'),
(2220, 145, 0, 'cor_1', NULL, 0, '2014-10-23 11:15:18', '', '', 186, 145, 'texto', 'desktop'),
(2221, 145, 0, 'cor_2', NULL, 0, '2014-10-23 11:15:18', '', '', 186, 145, 'texto', 'desktop'),
(2222, 145, 0, 'cor_3', NULL, 0, '2014-10-23 11:15:18', '', '', 186, 145, 'texto', 'desktop'),
(2223, 145, 0, 'alinhamento_1', NULL, 0, '2014-10-23 11:15:18', 'left', '', 186, 145, 'texto', 'desktop'),
(2224, 145, 0, 'alinhamento_2', NULL, 0, '2014-10-23 11:15:18', 'left', '', 186, 145, 'texto', 'desktop'),
(2225, 145, 0, 'alinhamento_3', NULL, 0, '2014-10-23 11:15:18', 'left', '', 186, 145, 'texto', 'desktop'),
(2226, 145, 0, 'margin_top', 0, 0, '2014-10-23 11:15:18', NULL, '', 186, 145, 'inteiro', 'desktop'),
(2227, 145, 0, 'margin_bottom', 0, 0, '2014-10-23 11:15:18', NULL, '', 186, 145, 'inteiro', 'desktop'),
(2228, 145, 0, 'padding_top', 0, 0, '2014-10-23 11:15:18', NULL, '', 186, 145, 'inteiro', 'desktop'),
(2229, 145, 0, 'padding_bottom', 0, 0, '2014-10-23 11:15:18', NULL, '', 186, 145, 'inteiro', 'desktop'),
(2230, 145, 0, 'is_full', 0, 0, '2014-10-23 11:15:18', NULL, '', 186, 145, 'inteiro', 'desktop'),
(2231, 145, 0, 'titulo_componente', NULL, 0, '2014-10-23 11:15:18', 'Dicas Aplicativo Facebook', '', 186, 145, 'texto', 'desktop'),
(2232, 145, 0, 'background_type', 0, 0, '2014-10-23 11:15:18', NULL, '', 186, 145, 'inteiro', 'desktop'),
(2233, 145, 0, 'background', NULL, 0, '2014-10-23 11:15:18', '', '', 186, 145, 'texto', 'desktop'),
(2234, 1, 0, 'item1_link_1', NULL, 0, '2014-10-23 17:57:44', '/website', '', 211, 24, 'texto', 'desktop'),
(2235, 1, 0, 'item2_link_1', NULL, 0, '2014-10-23 17:57:44', '/ecommerce', '', 211, 24, 'texto', 'desktop'),
(2236, 1, 0, 'item3_link_1', NULL, 0, '2014-10-23 17:57:44', '/webdesing', '', 211, 24, 'texto', 'desktop'),
(2237, 1, 0, 'item4_link_1', NULL, 0, '2014-10-23 17:57:45', '/paginasavancadas', '', 211, 24, 'texto', 'desktop'),
(2238, 1, 0, 'fullscreen', 0, 0, '2014-10-31 14:12:54', NULL, '', 255, 118, 'inteiro', 'desktop'),
(2239, 1, 0, 'autoplay', 0, 0, '2014-10-31 14:12:54', NULL, '', 255, 118, 'inteiro', 'desktop'),
(2240, 1, 0, 'lightbox', 0, 0, '2014-10-31 14:12:54', NULL, '', 255, 118, 'inteiro', 'desktop'),
(2241, 1, 0, 'sombra', 0, 0, '2014-10-31 14:12:54', NULL, '', 255, 118, 'inteiro', 'desktop'),
(2242, 1, 0, 'caption', 0, 0, '2014-10-31 14:12:54', NULL, '', 255, 118, 'inteiro', 'desktop'),
(2243, 140, 0, 'titulo_1', NULL, 0, '2014-10-31 14:18:31', NULL, '', 207, 147, 'texto', 'desktop'),
(2244, 140, 0, 'subtitulo_1', NULL, 0, '2014-10-31 14:18:31', NULL, '', 207, 147, 'texto', 'desktop'),
(2245, 140, 0, 'texto_1', NULL, 0, '2014-10-31 14:18:31', NULL, '', 207, 147, 'texto', 'desktop'),
(2246, 140, 0, 'link_1', NULL, 0, '2014-10-31 14:18:31', NULL, '', 207, 147, 'texto', 'desktop'),
(2247, 140, 0, 'image_1', NULL, 0, '2014-10-31 14:18:31', 'piergalerias_s3.png', '', 207, 147, 'texto', 'desktop'),
(2248, 140, 0, 'layout_1', NULL, 0, '2014-10-31 14:18:31', 'up', '', 207, 147, 'texto', 'desktop'),
(2249, 140, 0, 'cor_1', NULL, 0, '2014-10-31 14:18:31', '', '', 207, 147, 'texto', 'desktop'),
(2250, 140, 0, 'cor_2', NULL, 0, '2014-10-31 14:18:31', '', '', 207, 147, 'texto', 'desktop'),
(2251, 140, 0, 'cor_3', NULL, 0, '2014-10-31 14:18:31', '', '', 207, 147, 'texto', 'desktop'),
(2252, 140, 0, 'alinhamento_1', NULL, 0, '2014-10-31 14:18:31', 'left', '', 207, 147, 'texto', 'desktop'),
(2253, 140, 0, 'alinhamento_2', NULL, 0, '2014-10-31 14:18:31', 'left', '', 207, 147, 'texto', 'desktop'),
(2254, 140, 0, 'alinhamento_3', NULL, 0, '2014-10-31 14:18:31', 'left', '', 207, 147, 'texto', 'desktop'),
(2255, 140, 0, 'margin_top', 0, 0, '2014-10-31 14:18:31', NULL, '', 207, 147, 'inteiro', 'desktop'),
(2256, 140, 0, 'margin_bottom', 0, 0, '2014-10-31 14:18:31', NULL, '', 207, 147, 'inteiro', 'desktop'),
(2257, 140, 0, 'padding_top', 0, 0, '2014-10-31 14:18:31', NULL, '', 207, 147, 'inteiro', 'desktop'),
(2258, 140, 0, 'padding_bottom', 0, 0, '2014-10-31 14:18:31', NULL, '', 207, 147, 'inteiro', 'desktop'),
(2259, 140, 0, 'is_full', 0, 0, '2014-10-31 14:18:31', NULL, '', 207, 147, 'inteiro', 'desktop'),
(2260, 140, 0, 'titulo_componente', NULL, 0, '2014-10-31 14:18:31', 'Pier Galeria', '', 207, 147, 'texto', 'desktop'),
(2261, 140, 0, 'background_type', 0, 0, '2014-10-31 14:18:31', NULL, '', 207, 147, 'inteiro', 'desktop'),
(2262, 140, 0, 'background', NULL, 0, '2014-10-31 14:18:31', '', '', 207, 147, 'texto', 'desktop'),
(2263, 140, 0, 'titulo_1', NULL, 0, '2014-10-31 14:20:31', NULL, '', 207, 148, 'texto', 'desktop'),
(2264, 140, 0, 'subtitulo_1', NULL, 0, '2014-10-31 14:20:31', NULL, '', 207, 148, 'texto', 'desktop'),
(2265, 140, 0, 'texto_1', NULL, 0, '2014-10-31 14:20:31', NULL, '', 207, 148, 'texto', 'desktop'),
(2266, 140, 0, 'link_1', NULL, 0, '2014-10-31 14:20:31', NULL, '', 207, 148, 'texto', 'desktop'),
(2267, 140, 0, 'image_1', NULL, 0, '2014-10-31 14:20:31', 'banner_principal_houdini_y9.png', '', 207, 148, 'texto', 'desktop'),
(2268, 140, 0, 'layout_1', NULL, 0, '2014-10-31 14:20:31', 'up', '', 207, 148, 'texto', 'desktop'),
(2269, 140, 0, 'cor_1', NULL, 0, '2014-10-31 14:20:31', '', '', 207, 148, 'texto', 'desktop'),
(2270, 140, 0, 'cor_2', NULL, 0, '2014-10-31 14:20:31', '', '', 207, 148, 'texto', 'desktop'),
(2271, 140, 0, 'cor_3', NULL, 0, '2014-10-31 14:20:31', '', '', 207, 148, 'texto', 'desktop'),
(2272, 140, 0, 'alinhamento_1', NULL, 0, '2014-10-31 14:20:31', 'left', '', 207, 148, 'texto', 'desktop'),
(2273, 140, 0, 'alinhamento_2', NULL, 0, '2014-10-31 14:20:31', 'left', '', 207, 148, 'texto', 'desktop'),
(2274, 140, 0, 'alinhamento_3', NULL, 0, '2014-10-31 14:20:31', 'left', '', 207, 148, 'texto', 'desktop'),
(2275, 140, 0, 'margin_top', 0, 0, '2014-10-31 14:20:31', NULL, '', 207, 148, 'inteiro', 'desktop'),
(2276, 140, 0, 'margin_bottom', 0, 0, '2014-10-31 14:20:31', NULL, '', 207, 148, 'inteiro', 'desktop'),
(2277, 140, 0, 'padding_top', 0, 0, '2014-10-31 14:20:31', NULL, '', 207, 148, 'inteiro', 'desktop'),
(2278, 140, 0, 'padding_bottom', 0, 0, '2014-10-31 14:20:31', NULL, '', 207, 148, 'inteiro', 'desktop'),
(2279, 140, 0, 'is_full', 0, 0, '2014-10-31 14:20:31', NULL, '', 207, 148, 'inteiro', 'desktop'),
(2280, 140, 0, 'titulo_componente', NULL, 0, '2014-10-31 14:20:31', 'Banner Principal Hondini', '', 207, 148, 'texto', 'desktop'),
(2281, 140, 0, 'background_type', 0, 0, '2014-10-31 14:20:31', NULL, '', 207, 148, 'inteiro', 'desktop'),
(2282, 140, 0, 'background', NULL, 0, '2014-10-31 14:20:31', '', '', 207, 148, 'texto', 'desktop'),
(2283, 140, 0, 'titulo_1', NULL, 0, '2014-10-31 14:21:58', NULL, '', 207, 149, 'texto', 'desktop'),
(2284, 140, 0, 'subtitulo_1', NULL, 0, '2014-10-31 14:21:58', NULL, '', 207, 149, 'texto', 'desktop'),
(2285, 140, 0, 'texto_1', NULL, 0, '2014-10-31 14:21:58', NULL, '', 207, 149, 'texto', 'desktop'),
(2286, 140, 0, 'link_1', NULL, 0, '2014-10-31 14:21:58', NULL, '', 207, 149, 'texto', 'desktop'),
(2287, 140, 0, 'image_1', NULL, 0, '2014-10-31 14:21:58', 'banner_principal_jumbo_h9.png', '', 207, 149, 'texto', 'desktop'),
(2288, 140, 0, 'layout_1', NULL, 0, '2014-10-31 14:21:58', 'up', '', 207, 149, 'texto', 'desktop'),
(2289, 140, 0, 'cor_1', NULL, 0, '2014-10-31 14:21:58', '', '', 207, 149, 'texto', 'desktop'),
(2290, 140, 0, 'cor_2', NULL, 0, '2014-10-31 14:21:58', '', '', 207, 149, 'texto', 'desktop'),
(2291, 140, 0, 'cor_3', NULL, 0, '2014-10-31 14:21:58', '', '', 207, 149, 'texto', 'desktop'),
(2292, 140, 0, 'alinhamento_1', NULL, 0, '2014-10-31 14:21:58', 'left', '', 207, 149, 'texto', 'desktop'),
(2293, 140, 0, 'alinhamento_2', NULL, 0, '2014-10-31 14:21:58', 'left', '', 207, 149, 'texto', 'desktop'),
(2294, 140, 0, 'alinhamento_3', NULL, 0, '2014-10-31 14:21:58', 'left', '', 207, 149, 'texto', 'desktop'),
(2295, 140, 0, 'margin_top', 0, 0, '2014-10-31 14:21:58', NULL, '', 207, 149, 'inteiro', 'desktop'),
(2296, 140, 0, 'margin_bottom', 0, 0, '2014-10-31 14:21:58', NULL, '', 207, 149, 'inteiro', 'desktop'),
(2297, 140, 0, 'padding_top', 0, 0, '2014-10-31 14:21:58', NULL, '', 207, 149, 'inteiro', 'desktop'),
(2298, 140, 0, 'padding_bottom', 0, 0, '2014-10-31 14:21:58', NULL, '', 207, 149, 'inteiro', 'desktop'),
(2299, 140, 0, 'is_full', 0, 0, '2014-10-31 14:21:58', NULL, '', 207, 149, 'inteiro', 'desktop'),
(2300, 140, 0, 'titulo_componente', NULL, 0, '2014-10-31 14:21:58', 'Banner Principal Jumbo', '', 207, 149, 'texto', 'desktop'),
(2301, 140, 0, 'background_type', 0, 0, '2014-10-31 14:21:58', NULL, '', 207, 149, 'inteiro', 'desktop'),
(2302, 140, 0, 'background', NULL, 0, '2014-10-31 14:21:58', '', '', 207, 149, 'texto', 'desktop'),
(2303, 140, 0, 'titulo_1', NULL, 0, '2014-10-31 14:24:58', NULL, '', 207, 150, 'texto', 'desktop'),
(2304, 140, 0, 'subtitulo_1', NULL, 0, '2014-10-31 14:24:58', NULL, '', 207, 150, 'texto', 'desktop'),
(2305, 140, 0, 'texto_1', NULL, 0, '2014-10-31 14:24:58', NULL, '', 207, 150, 'texto', 'desktop'),
(2306, 140, 0, 'link_1', NULL, 0, '2014-10-31 14:24:58', NULL, '', 207, 150, 'texto', 'desktop'),
(2307, 140, 0, 'image_1', NULL, 0, '2014-10-31 14:24:58', 'pierdownloads_o4.png', '', 207, 150, 'texto', 'desktop'),
(2308, 140, 0, 'layout_1', NULL, 0, '2014-10-31 14:24:58', 'up', '', 207, 150, 'texto', 'desktop'),
(2309, 140, 0, 'cor_1', NULL, 0, '2014-10-31 14:24:58', '', '', 207, 150, 'texto', 'desktop'),
(2310, 140, 0, 'cor_2', NULL, 0, '2014-10-31 14:24:58', '', '', 207, 150, 'texto', 'desktop'),
(2311, 140, 0, 'cor_3', NULL, 0, '2014-10-31 14:24:58', '', '', 207, 150, 'texto', 'desktop'),
(2312, 140, 0, 'alinhamento_1', NULL, 0, '2014-10-31 14:24:58', 'left', '', 207, 150, 'texto', 'desktop'),
(2313, 140, 0, 'alinhamento_2', NULL, 0, '2014-10-31 14:24:58', 'left', '', 207, 150, 'texto', 'desktop'),
(2314, 140, 0, 'alinhamento_3', NULL, 0, '2014-10-31 14:24:58', 'left', '', 207, 150, 'texto', 'desktop'),
(2315, 140, 0, 'margin_top', 0, 0, '2014-10-31 14:24:58', NULL, '', 207, 150, 'inteiro', 'desktop'),
(2316, 140, 0, 'margin_bottom', 0, 0, '2014-10-31 14:24:58', NULL, '', 207, 150, 'inteiro', 'desktop'),
(2317, 140, 0, 'padding_top', 0, 0, '2014-10-31 14:24:58', NULL, '', 207, 150, 'inteiro', 'desktop'),
(2318, 140, 0, 'padding_bottom', 0, 0, '2014-10-31 14:24:58', NULL, '', 207, 150, 'inteiro', 'desktop'),
(2319, 140, 0, 'is_full', 0, 0, '2014-10-31 14:24:58', NULL, '', 207, 150, 'inteiro', 'desktop'),
(2320, 140, 0, 'titulo_componente', NULL, 0, '2014-10-31 14:24:58', 'Pier Download', '', 207, 150, 'texto', 'desktop'),
(2321, 140, 0, 'background_type', 0, 0, '2014-10-31 14:24:58', NULL, '', 207, 150, 'inteiro', 'desktop'),
(2322, 140, 0, 'background', NULL, 0, '2014-10-31 14:24:58', '', '', 207, 150, 'texto', 'desktop'),
(2323, 149, 0, 'titulo_1', NULL, 0, '2014-11-04 13:24:16', NULL, 'O que são as Tags e para que servem', 186, 151, 'texto', 'desktop'),
(2324, 149, 0, 'subtitulo_1', NULL, 0, '2014-11-04 13:24:16', NULL, 'As tags são responsáveis pelo nível de autorização de acesso do usuário', 186, 151, 'texto', 'desktop'),
(2325, 149, 0, 'texto_1', NULL, 0, '2014-11-04 13:24:16', NULL, 'As tags dizem o que o usuário é e o que pode fazer...\r\nProspectador: pode acessar a área de prospects\r\nColunista: pode escrever colunas\r\nAssociado: por ter acesso a Rede de Benefícios, Banco de currículos e etc.\r\nFuncionário: Tem especificações especiais como salário, profissão e entrar para a contabilidade do PierGestão\r\nCliente: Tem especificações especiais como site, logo, pedidos, valores entrar para a contabilidade do PierGestão\r\nFornecedores: Quem fornece suprimentos e entra para o Pier Gestão.\r\nRepresentantes: Faz as vendas dos serviços de sua empresa\r\nProfissionais: Tem especificações especiais como, profissão, atividades e usado para palestrantes, eventos e etc\r\n\r\n\r\nSe o usuário se cadastrou e não possui tag ele só pode ver os  eventos que participou... as tags são responsáveis pelo nível de autorização de acesso do usuário.\r\nCaso ele já seja cadastrado, basta adicionar ou remover tags... um usuário nunca precisa ser excluído da base de dados, somente ter sua tag removida', 186, 151, 'texto', 'desktop'),
(2326, 149, 0, 'link_1', NULL, 0, '2014-11-04 13:24:16', NULL, '', 186, 151, 'texto', 'desktop'),
(2327, 149, 0, 'image_1', NULL, 0, '2014-11-04 13:24:16', '', '', 186, 151, 'texto', 'desktop'),
(2328, 149, 0, 'layout_1', NULL, 0, '2014-11-04 13:24:16', 'left', '', 186, 151, 'texto', 'desktop'),
(2329, 149, 0, 'cor_1', NULL, 0, '2014-11-04 13:24:16', '', '', 186, 151, 'texto', 'desktop'),
(2330, 149, 0, 'cor_2', NULL, 0, '2014-11-04 13:24:16', '', '', 186, 151, 'texto', 'desktop'),
(2331, 149, 0, 'cor_3', NULL, 0, '2014-11-04 13:24:16', '', '', 186, 151, 'texto', 'desktop'),
(2332, 149, 0, 'alinhamento_1', NULL, 0, '2014-11-04 13:24:16', 'left', '', 186, 151, 'texto', 'desktop'),
(2333, 149, 0, 'alinhamento_2', NULL, 0, '2014-11-04 13:24:16', 'left', '', 186, 151, 'texto', 'desktop'),
(2334, 149, 0, 'alinhamento_3', NULL, 0, '2014-11-04 13:24:16', 'left', '', 186, 151, 'texto', 'desktop'),
(2335, 149, 0, 'margin_top', 0, 0, '2014-11-04 13:24:16', NULL, '', 186, 151, 'inteiro', 'desktop'),
(2336, 149, 0, 'margin_bottom', 0, 0, '2014-11-04 13:24:16', NULL, '', 186, 151, 'inteiro', 'desktop'),
(2337, 149, 0, 'padding_top', 0, 0, '2014-11-04 13:24:16', NULL, '', 186, 151, 'inteiro', 'desktop'),
(2338, 149, 0, 'padding_bottom', 0, 0, '2014-11-04 13:24:16', NULL, '', 186, 151, 'inteiro', 'desktop'),
(2339, 149, 0, 'is_full', 0, 0, '2014-11-04 13:24:16', NULL, '', 186, 151, 'inteiro', 'desktop'),
(2340, 149, 0, 'titulo_componente', NULL, 0, '2014-11-04 13:24:16', 'Dicas Tags - Passo 1', '', 186, 151, 'texto', 'desktop'),
(2341, 149, 0, 'background_type', 0, 0, '2014-11-04 13:24:16', NULL, '', 186, 151, 'inteiro', 'desktop'),
(2342, 149, 0, 'background', NULL, 0, '2014-11-04 13:24:16', '', '', 186, 151, 'texto', 'desktop'),
(2343, 145, 0, 'titulo_1', NULL, 0, '2014-11-04 13:25:26', NULL, 'Dicas tudo que você precisa saber sobre as Tags', 186, 152, 'texto', 'desktop'),
(2344, 145, 0, 'subtitulo_1', NULL, 0, '2014-11-04 13:25:26', NULL, '', 186, 152, 'texto', 'desktop'),
(2345, 145, 0, 'texto_1', NULL, 0, '2014-11-04 13:25:26', NULL, 'Veja o que são e para que servem as tags de usuário do PurplePier', 186, 152, 'texto', 'desktop'),
(2346, 145, 0, 'link_1', NULL, 0, '2014-11-04 13:25:26', NULL, '/dicas_tags', 186, 152, 'texto', 'desktop'),
(2347, 145, 0, 'image_1', NULL, 0, '2014-11-04 13:25:26', '', '', 186, 152, 'texto', 'desktop'),
(2348, 145, 0, 'layout_1', NULL, 0, '2014-11-04 13:25:27', 'left', '', 186, 152, 'texto', 'desktop'),
(2349, 145, 0, 'cor_1', NULL, 0, '2014-11-04 13:25:27', '', '', 186, 152, 'texto', 'desktop'),
(2350, 145, 0, 'cor_2', NULL, 0, '2014-11-04 13:25:27', '', '', 186, 152, 'texto', 'desktop'),
(2351, 145, 0, 'cor_3', NULL, 0, '2014-11-04 13:25:27', '', '', 186, 152, 'texto', 'desktop'),
(2352, 145, 0, 'alinhamento_1', NULL, 0, '2014-11-04 13:25:27', 'left', '', 186, 152, 'texto', 'desktop'),
(2353, 145, 0, 'alinhamento_2', NULL, 0, '2014-11-04 13:25:27', 'left', '', 186, 152, 'texto', 'desktop'),
(2354, 145, 0, 'alinhamento_3', NULL, 0, '2014-11-04 13:25:27', 'left', '', 186, 152, 'texto', 'desktop'),
(2355, 145, 0, 'margin_top', 0, 0, '2014-11-04 13:25:27', NULL, '', 186, 152, 'inteiro', 'desktop'),
(2356, 145, 0, 'margin_bottom', 0, 0, '2014-11-04 13:25:27', NULL, '', 186, 152, 'inteiro', 'desktop'),
(2357, 145, 0, 'padding_top', 0, 0, '2014-11-04 13:25:27', NULL, '', 186, 152, 'inteiro', 'desktop'),
(2358, 145, 0, 'padding_bottom', 0, 0, '2014-11-04 13:25:28', NULL, '', 186, 152, 'inteiro', 'desktop'),
(2359, 145, 0, 'is_full', 0, 0, '2014-11-04 13:25:28', NULL, '', 186, 152, 'inteiro', 'desktop'),
(2360, 145, 0, 'titulo_componente', NULL, 0, '2014-11-04 13:25:28', 'Dicas Tags', '', 186, 152, 'texto', 'desktop'),
(2361, 145, 0, 'background_type', 0, 0, '2014-11-04 13:25:28', NULL, '', 186, 152, 'inteiro', 'desktop'),
(2362, 145, 0, 'background', NULL, 0, '2014-11-04 13:25:28', '', '', 186, 152, 'texto', 'desktop'),
(2363, 145, 0, 'titulo_1', NULL, 0, '2014-11-07 11:30:21', NULL, 'Dicas para ter acesso as inscrições em eventos', 186, 153, 'texto', 'desktop'),
(2364, 145, 0, 'subtitulo_1', NULL, 0, '2014-11-07 11:30:21', NULL, '', 186, 153, 'texto', 'desktop'),
(2365, 145, 0, 'texto_1', NULL, 0, '2014-11-07 11:30:21', NULL, 'Veja como ter acesso a pagina de inscrições em eventos', 186, 153, 'texto', 'desktop'),
(2366, 145, 0, 'link_1', NULL, 0, '2014-11-07 11:30:21', NULL, '/dicas_eventos', 186, 153, 'texto', 'desktop'),
(2367, 145, 0, 'image_1', NULL, 0, '2014-11-07 11:30:21', '', '', 186, 153, 'texto', 'desktop'),
(2368, 145, 0, 'layout_1', NULL, 0, '2014-11-07 11:30:21', 'left', '', 186, 153, 'texto', 'desktop'),
(2369, 145, 0, 'cor_1', NULL, 0, '2014-11-07 11:30:21', '', '', 186, 153, 'texto', 'desktop'),
(2370, 145, 0, 'cor_2', NULL, 0, '2014-11-07 11:30:21', '', '', 186, 153, 'texto', 'desktop'),
(2371, 145, 0, 'cor_3', NULL, 0, '2014-11-07 11:30:21', '', '', 186, 153, 'texto', 'desktop'),
(2372, 145, 0, 'alinhamento_1', NULL, 0, '2014-11-07 11:30:21', 'left', '', 186, 153, 'texto', 'desktop'),
(2373, 145, 0, 'alinhamento_2', NULL, 0, '2014-11-07 11:30:21', 'left', '', 186, 153, 'texto', 'desktop'),
(2374, 145, 0, 'alinhamento_3', NULL, 0, '2014-11-07 11:30:21', 'left', '', 186, 153, 'texto', 'desktop'),
(2375, 145, 0, 'margin_top', 0, 0, '2014-11-07 11:30:21', NULL, '', 186, 153, 'inteiro', 'desktop'),
(2376, 145, 0, 'margin_bottom', 0, 0, '2014-11-07 11:30:21', NULL, '', 186, 153, 'inteiro', 'desktop'),
(2377, 145, 0, 'padding_top', 0, 0, '2014-11-07 11:30:21', NULL, '', 186, 153, 'inteiro', 'desktop'),
(2378, 145, 0, 'padding_bottom', 0, 0, '2014-11-07 11:30:21', NULL, '', 186, 153, 'inteiro', 'desktop'),
(2379, 145, 0, 'is_full', 0, 0, '2014-11-07 11:30:21', NULL, '', 186, 153, 'inteiro', 'desktop'),
(2380, 145, 0, 'titulo_componente', NULL, 0, '2014-11-07 11:30:21', 'Dicas Eventos', '', 186, 153, 'texto', 'desktop'),
(2381, 145, 0, 'background_type', 0, 0, '2014-11-07 11:30:21', NULL, '', 186, 153, 'inteiro', 'desktop'),
(2382, 145, 0, 'background', NULL, 0, '2014-11-07 11:30:21', '', '', 186, 153, 'texto', 'desktop'),
(2383, 150, 0, 'titulo_1', NULL, 0, '2014-11-07 12:54:27', NULL, 'Para ter acesso aos INSCRITOS NOS EVENTOS', 186, 154, 'texto', 'desktop'),
(2384, 150, 0, 'subtitulo_1', NULL, 0, '2014-11-07 12:54:28', NULL, '', 186, 154, 'texto', 'desktop'),
(2385, 150, 0, 'texto_1', NULL, 0, '2014-11-07 12:54:28', NULL, 'Para ter acesso a pagina dos INSCRITOS NOS EVENTOS acesse:\r\n\r\nNa barra de menu - <b>CONTEÚDO / EVENTOS / LISTAR</b>\r\n\r\nAbrirá a pagina: <b>Listagem de Eventos</b>\r\n\r\nOs eventos serão listados de acordo com a <b>DATA DO EVENTO</b>. Para ver todos os eventos sem utilizar o filtro, selecione <b>TODOS.</b>\r\n\r\nAbrirá a pagina com todos os eventos cadastrados no sistema. As informações mostradas são:\r\n\r\n<b>- Títulos -</b> nome do evento/curso/palestra\r\n\r\n<b>- Local - </b>onde será o evento. Esta informação não é publicada no site, só você terá acesso.\r\n\r\n<b>- Data do evento - </b>após o termino do dia cadastrado, o evento deixará de ser exibido no site.\r\n\r\n<b>- Inscritos -  </b>numero de inscritos no evento.\r\n\r\n<b>- Realização - </b>evento é próprio ou de outra instituição.\r\n\r\n<b>- Editar - </b>sessão com ícones para editar o evento.\r\n\r\n\r\nNa sessão <b>EDITAR,</b> ao passar o mouse em cima dos ícones o sistema mostrará as funções:\r\n\r\n<b>- Corneta (publicar e compartilhar)- </b>redireciona para pagina de publicação nas redes sociais\r\n\r\n<b>- Ver inscritos - </b>aparece o numero de pessoas inscritas no curso, selecionado o ícone, abre a pagina de inscrição no evento.\r\n\r\n<b>- Editar - </b>pagina de edição do conteúdo do evento, o que será divulgado no site.\r\n\r\n<b>- Excluir - </b>ícone para excluir o evento.\r\n\r\nLembre-se sempre de salvar a pagina após todas as alterações.\r\n\r\n\r\n\r\n', 186, 154, 'texto', 'desktop'),
(2386, 150, 0, 'link_1', NULL, 0, '2014-11-07 12:54:28', NULL, '', 186, 154, 'texto', 'desktop'),
(2387, 150, 0, 'image_1', NULL, 0, '2014-11-07 12:54:28', '', '', 186, 154, 'image', 'desktop'),
(2388, 150, 0, 'layout_1', NULL, 0, '2014-11-07 12:54:29', 'left', '', 186, 154, 'texto', 'desktop'),
(2389, 150, 0, 'cor_1', NULL, 0, '2014-11-07 12:54:29', '', '', 186, 154, 'texto', 'desktop'),
(2390, 150, 0, 'cor_2', NULL, 0, '2014-11-07 12:54:29', '', '', 186, 154, 'texto', 'desktop'),
(2391, 150, 0, 'cor_3', NULL, 0, '2014-11-07 12:54:29', '', '', 186, 154, 'texto', 'desktop'),
(2392, 150, 0, 'alinhamento_1', NULL, 0, '2014-11-07 12:54:29', 'left', '', 186, 154, 'texto', 'desktop'),
(2393, 150, 0, 'alinhamento_2', NULL, 0, '2014-11-07 12:54:29', 'left', '', 186, 154, 'texto', 'desktop'),
(2394, 150, 0, 'alinhamento_3', NULL, 0, '2014-11-07 12:54:29', 'left', '', 186, 154, 'texto', 'desktop'),
(2395, 150, 0, 'margin_top', 0, 0, '2014-11-07 12:54:29', NULL, '', 186, 154, 'inteiro', 'desktop'),
(2396, 150, 0, 'margin_bottom', 0, 0, '2014-11-07 12:54:29', NULL, '', 186, 154, 'inteiro', 'desktop'),
(2397, 150, 0, 'padding_top', 0, 0, '2014-11-07 12:54:30', NULL, '', 186, 154, 'inteiro', 'desktop'),
(2398, 150, 0, 'padding_bottom', 0, 0, '2014-11-07 12:54:30', NULL, '', 186, 154, 'inteiro', 'desktop'),
(2399, 150, 0, 'is_full', 0, 0, '2014-11-07 12:54:30', NULL, '', 186, 154, 'inteiro', 'desktop'),
(2400, 150, 0, 'titulo_componente', NULL, 0, '2014-11-07 12:54:30', '', '', 186, 154, 'texto', 'desktop'),
(2401, 150, 0, 'background_type', 0, 0, '2014-11-07 12:54:30', NULL, '', 186, 154, 'inteiro', 'desktop'),
(2402, 150, 0, 'background', NULL, 0, '2014-11-07 12:54:30', '', '', 186, 154, 'texto', 'desktop'),
(2403, 152, 0, 'titulo_1', NULL, 0, '2014-11-07 13:25:33', NULL, 'Dicas de como ver ficha de inscrição em eventos', 186, 155, 'texto', 'desktop'),
(2404, 152, 0, 'subtitulo_1', NULL, 0, '2014-11-07 13:25:33', NULL, '', 186, 155, 'texto', 'desktop'),
(2405, 152, 0, 'texto_1', NULL, 0, '2014-11-07 13:25:33', NULL, 'Para ter acesso a pagina dos INSCRITOS NOS EVENTOS acesse:\r\n\r\nNa barra de menu - <b>CONTEÚDO / EVENTOS / LISTAR</b>\r\n\r\nAbrirá a pagina: <b>Listagem de Eventos</b>\r\n\r\nOs eventos serão listados de acordo com a <b>DATA DO EVENTO</b>. Para ver todos os eventos sem utilizar o filtro, selecione <b>TODOS.</b>\r\n\r\nAbrirá a pagina com todos os eventos cadastrados no sistema. As informações mostradas são:\r\n\r\n<b>- Títulos -</b> nome do evento/curso/palestra\r\n\r\n<b>- Local - </b>onde será o evento. Esta informação não é publicada no site, só você terá acesso.\r\n\r\n<b>- Data do evento - </b>após o termino do dia cadastrado, o evento deixará de ser exibido no site.\r\n\r\n<b>- Inscritos -  </b>numero de inscritos no evento.\r\n\r\n<b>- Realização - </b>evento é próprio ou de outra instituição.\r\n\r\n<b>- Editar - </b>sessão com ícones para editar o evento.\r\n\r\n\r\nNa sessão <b>EDITAR,</b> ao passar o mouse em cima dos ícones o sistema mostrará as funções:\r\n\r\n<b>- Corneta (publicar e compartilhar)- </b>redireciona para pagina de publicação nas redes sociais\r\n\r\n<b>- Ver inscritos - </b>aparece o numero de pessoas inscritas no curso, selecionado o ícone, abre a pagina de inscrição no evento.\r\n\r\n<b>- Editar - </b>pagina de edição do conteúdo do evento, o que será divulgado no site.\r\n\r\n<b>- Excluir - </b>ícone para excluir o evento.\r\n\r\nLembre-se sempre de salvar a pagina após todas as alterações.\r\n\r\n\r\n\r\n', 186, 155, 'texto', 'desktop'),
(2406, 152, 0, 'link_1', NULL, 0, '2014-11-07 13:25:34', NULL, '', 186, 155, 'texto', 'desktop'),
(2407, 152, 0, 'image_1', NULL, 0, '2014-11-07 13:25:34', '', '', 186, 155, 'texto', 'desktop'),
(2408, 152, 0, 'layout_1', NULL, 0, '2014-11-07 13:25:34', 'left', '', 186, 155, 'texto', 'desktop'),
(2409, 152, 0, 'cor_1', NULL, 0, '2014-11-07 13:25:34', '', '', 186, 155, 'texto', 'desktop'),
(2410, 152, 0, 'cor_2', NULL, 0, '2014-11-07 13:25:34', '', '', 186, 155, 'texto', 'desktop'),
(2411, 152, 0, 'cor_3', NULL, 0, '2014-11-07 13:25:34', '', '', 186, 155, 'texto', 'desktop'),
(2412, 152, 0, 'alinhamento_1', NULL, 0, '2014-11-07 13:25:34', 'left', '', 186, 155, 'texto', 'desktop'),
(2413, 152, 0, 'alinhamento_2', NULL, 0, '2014-11-07 13:25:34', 'left', '', 186, 155, 'texto', 'desktop'),
(2414, 152, 0, 'alinhamento_3', NULL, 0, '2014-11-07 13:25:35', 'left', '', 186, 155, 'texto', 'desktop'),
(2415, 152, 0, 'margin_top', 0, 0, '2014-11-07 13:25:35', NULL, '', 186, 155, 'inteiro', 'desktop'),
(2416, 152, 0, 'margin_bottom', 0, 0, '2014-11-07 13:25:35', NULL, '', 186, 155, 'inteiro', 'desktop'),
(2417, 152, 0, 'padding_top', 0, 0, '2014-11-07 13:25:35', NULL, '', 186, 155, 'inteiro', 'desktop'),
(2418, 152, 0, 'padding_bottom', 0, 0, '2014-11-07 13:25:35', NULL, '', 186, 155, 'inteiro', 'desktop'),
(2419, 152, 0, 'is_full', 0, 0, '2014-11-07 13:25:35', NULL, '', 186, 155, 'inteiro', 'desktop'),
(2420, 152, 0, 'titulo_componente', NULL, 0, '2014-11-07 13:25:35', '', '', 186, 155, 'texto', 'desktop'),
(2421, 152, 0, 'background_type', 0, 0, '2014-11-07 13:25:36', NULL, '', 186, 155, 'inteiro', 'desktop'),
(2422, 152, 0, 'background', NULL, 0, '2014-11-07 13:25:36', '', '', 186, 155, 'texto', 'desktop'),
(2423, 153, 0, 'titulo_1', NULL, 0, '2014-11-07 14:51:36', NULL, 'O que é o menu especial?', 186, 156, 'texto', 'desktop'),
(2424, 153, 0, 'subtitulo_1', NULL, 0, '2014-11-07 14:51:36', NULL, 'Vários links de produtos e serviços para você seus clientes', 186, 156, 'texto', 'desktop'),
(2425, 153, 0, 'texto_1', NULL, 0, '2014-11-07 14:51:36', NULL, 'Com ele você pode exibir vários links de diferentes aplicativos e organiza-los da melhor forma possível.\r\nUtilizando o aplicativo de menu especial você pode criar um botão no seu menu principal e dentro dele exibir até quatro categorias divididas em colunas com título e adicionar nelas links para páginas, produtos, eventos, matérias, dicas e qualquer coisa que você queira criar e exibir', 186, 156, 'texto', 'desktop'),
(2426, 153, 0, 'link_1', NULL, 0, '2014-11-07 14:51:36', NULL, '', 186, 156, 'texto', 'desktop'),
(2427, 153, 0, 'image_1', NULL, 0, '2014-11-07 14:51:37', '', '', 186, 156, 'texto', 'desktop'),
(2428, 153, 0, 'layout_1', NULL, 0, '2014-11-07 14:51:37', 'left', '', 186, 156, 'texto', 'desktop'),
(2429, 153, 0, 'cor_1', NULL, 0, '2014-11-07 14:51:37', '', '', 186, 156, 'texto', 'desktop'),
(2430, 153, 0, 'cor_2', NULL, 0, '2014-11-07 14:51:37', '', '', 186, 156, 'texto', 'desktop'),
(2431, 153, 0, 'cor_3', NULL, 0, '2014-11-07 14:51:37', '', '', 186, 156, 'texto', 'desktop'),
(2432, 153, 0, 'alinhamento_1', NULL, 0, '2014-11-07 14:51:37', 'left', '', 186, 156, 'texto', 'desktop'),
(2433, 153, 0, 'alinhamento_2', NULL, 0, '2014-11-07 14:51:37', 'left', '', 186, 156, 'texto', 'desktop'),
(2434, 153, 0, 'alinhamento_3', NULL, 0, '2014-11-07 14:51:37', 'left', '', 186, 156, 'texto', 'desktop'),
(2435, 153, 0, 'margin_top', 0, 0, '2014-11-07 14:51:37', NULL, '', 186, 156, 'inteiro', 'desktop'),
(2436, 153, 0, 'margin_bottom', 0, 0, '2014-11-07 14:51:38', NULL, '', 186, 156, 'inteiro', 'desktop'),
(2437, 153, 0, 'padding_top', 0, 0, '2014-11-07 14:51:38', NULL, '', 186, 156, 'inteiro', 'desktop'),
(2438, 153, 0, 'padding_bottom', 0, 0, '2014-11-07 14:51:38', NULL, '', 186, 156, 'inteiro', 'desktop'),
(2439, 153, 0, 'is_full', 0, 0, '2014-11-07 14:51:38', NULL, '', 186, 156, 'inteiro', 'desktop'),
(2440, 153, 0, 'titulo_componente', NULL, 0, '2014-11-07 14:51:38', 'Passo - 1', '', 186, 156, 'texto', 'desktop'),
(2441, 153, 0, 'background_type', 0, 0, '2014-11-07 14:51:38', NULL, '', 186, 156, 'inteiro', 'desktop'),
(2442, 153, 0, 'background', NULL, 0, '2014-11-07 14:51:38', '', '', 186, 156, 'texto', 'desktop'),
(2443, 153, 0, 'titulo_1', NULL, 0, '2014-11-07 14:59:33', NULL, 'Como funciona o menu especial?', 186, 157, 'texto', 'desktop'),
(2444, 153, 0, 'subtitulo_1', NULL, 0, '2014-11-07 14:59:33', NULL, 'É simples e facil de utlizar basta seguir os passos', 186, 157, 'texto', 'desktop'),
(2445, 153, 0, 'texto_1', NULL, 0, '2014-11-07 14:59:33', NULL, 'O Menu especial funciona utilizando uma página simples de apoio, mais um menu especial que você tenha criado previamente.\r\nPara criar um menu especial siga os passos a seguir e para criar uma página veja os passos abaixo\r\n\r\nImagine que você queira criar um botão no menu para exibir seus serviços. Esses são muitos e divididos por categorias, então você cria uma página que vai se chamar Serviços por exemplo e adiciona o menu especial nela. veja os passos abaixo: \r\n\r\nPasso - 1\r\nAdicione o nome da página exemplo: Serviços\r\n\r\nPasso - 2 \r\nEm definições deixe selecione o checkbox \"grupo\" e adicione o id do seu menu especial no campo \"extra\".\r\n\r\nPronto só isso!', 186, 157, 'texto', 'desktop'),
(2446, 153, 0, 'link_1', NULL, 0, '2014-11-07 14:59:33', NULL, '', 186, 157, 'texto', 'desktop'),
(2447, 153, 0, 'image_1', NULL, 0, '2014-11-07 14:59:33', '', '', 186, 157, 'texto', 'desktop'),
(2448, 153, 0, 'layout_1', NULL, 0, '2014-11-07 14:59:33', 'left', '', 186, 157, 'texto', 'desktop'),
(2449, 153, 0, 'cor_1', NULL, 0, '2014-11-07 14:59:34', '', '', 186, 157, 'texto', 'desktop'),
(2450, 153, 0, 'cor_2', NULL, 0, '2014-11-07 14:59:34', '', '', 186, 157, 'texto', 'desktop'),
(2451, 153, 0, 'cor_3', NULL, 0, '2014-11-07 14:59:34', '', '', 186, 157, 'texto', 'desktop'),
(2452, 153, 0, 'alinhamento_1', NULL, 0, '2014-11-07 14:59:34', 'left', '', 186, 157, 'texto', 'desktop'),
(2453, 153, 0, 'alinhamento_2', NULL, 0, '2014-11-07 14:59:34', 'left', '', 186, 157, 'texto', 'desktop'),
(2454, 153, 0, 'alinhamento_3', NULL, 0, '2014-11-07 14:59:34', 'left', '', 186, 157, 'texto', 'desktop'),
(2455, 153, 0, 'margin_top', 0, 0, '2014-11-07 14:59:34', NULL, '', 186, 157, 'inteiro', 'desktop'),
(2456, 153, 0, 'margin_bottom', 0, 0, '2014-11-07 14:59:34', NULL, '', 186, 157, 'inteiro', 'desktop'),
(2457, 153, 0, 'padding_top', 0, 0, '2014-11-07 14:59:34', NULL, '', 186, 157, 'inteiro', 'desktop'),
(2458, 153, 0, 'padding_bottom', 0, 0, '2014-11-07 14:59:35', NULL, '', 186, 157, 'inteiro', 'desktop'),
(2459, 153, 0, 'is_full', 0, 0, '2014-11-07 14:59:35', NULL, '', 186, 157, 'inteiro', 'desktop'),
(2460, 153, 0, 'titulo_componente', NULL, 0, '2014-11-07 14:59:35', 'Passo - 2', '', 186, 157, 'texto', 'desktop'),
(2461, 153, 0, 'background_type', 0, 0, '2014-11-07 14:59:35', NULL, '', 186, 157, 'inteiro', 'desktop'),
(2462, 153, 0, 'background', NULL, 0, '2014-11-07 14:59:35', '', '', 186, 157, 'texto', 'desktop'),
(2463, 153, 0, 'titulo_1', NULL, 0, '2014-11-07 15:08:04', NULL, 'Ok, parece fácil por onde começo', 186, 158, 'texto', 'desktop'),
(2464, 153, 0, 'subtitulo_1', NULL, 0, '2014-11-07 15:08:04', NULL, 'Instalando o aplicativo e criando seu primeiro menu especial', 186, 158, 'texto', 'desktop'),
(2465, 153, 0, 'texto_1', NULL, 0, '2014-11-07 15:08:04', NULL, 'Primeiro você deve ter o PierLayout instalado, instale-o.\r\n\r\nApós instalado o PierLayout instale também MenuMega que vai liberar as opções para você criar os menus especiais.\r\n\r\nCom ambos instalados vá em Layout / Menu agora deve aparecer a opção \"Menu Especial\"\r\nNessa opção você pode listar ou cadastrar. Caso queira editar algo que já está pronto, como adicionar novos items a uma categoria ou remover, alterar título, link e etc utilize listar para ver todos seus menus, no nosso caso vamos criar um novo.\r\n\r\nClique em cadastrar a tela ao lado será exibida onde você irá criar o menu container, apenas uma referencia que irá guardar as categorias e os itens destas categorias.\r\n\r\nVamos dar o nome de Menu de serviços e descrição você coloca se desejar\r\n\r\n', 186, 158, 'texto', 'desktop'),
(2466, 153, 0, 'link_1', NULL, 0, '2014-11-07 15:08:04', NULL, '', 186, 158, 'texto', 'desktop'),
(2467, 153, 0, 'image_1', NULL, 0, '2014-11-07 15:08:04', '', '', 186, 158, 'texto', 'desktop'),
(2468, 153, 0, 'layout_1', NULL, 0, '2014-11-07 15:08:04', 'left', '', 186, 158, 'texto', 'desktop'),
(2469, 153, 0, 'cor_1', NULL, 0, '2014-11-07 15:08:04', '', '', 186, 158, 'texto', 'desktop'),
(2470, 153, 0, 'cor_2', NULL, 0, '2014-11-07 15:08:04', '', '', 186, 158, 'texto', 'desktop'),
(2471, 153, 0, 'cor_3', NULL, 0, '2014-11-07 15:08:04', '', '', 186, 158, 'texto', 'desktop'),
(2472, 153, 0, 'alinhamento_1', NULL, 0, '2014-11-07 15:08:04', 'left', '', 186, 158, 'texto', 'desktop'),
(2473, 153, 0, 'alinhamento_2', NULL, 0, '2014-11-07 15:08:04', 'left', '', 186, 158, 'texto', 'desktop'),
(2474, 153, 0, 'alinhamento_3', NULL, 0, '2014-11-07 15:08:04', 'left', '', 186, 158, 'texto', 'desktop'),
(2475, 153, 0, 'margin_top', 0, 0, '2014-11-07 15:08:04', NULL, '', 186, 158, 'inteiro', 'desktop'),
(2476, 153, 0, 'margin_bottom', 0, 0, '2014-11-07 15:08:04', NULL, '', 186, 158, 'inteiro', 'desktop'),
(2477, 153, 0, 'padding_top', 0, 0, '2014-11-07 15:08:04', NULL, '', 186, 158, 'inteiro', 'desktop'),
(2478, 153, 0, 'padding_bottom', 0, 0, '2014-11-07 15:08:04', NULL, '', 186, 158, 'inteiro', 'desktop'),
(2479, 153, 0, 'is_full', 0, 0, '2014-11-07 15:08:04', NULL, '', 186, 158, 'inteiro', 'desktop'),
(2480, 153, 0, 'titulo_componente', NULL, 0, '2014-11-07 15:08:04', 'Passo - 3', '', 186, 158, 'texto', 'desktop'),
(2481, 153, 0, 'background_type', 0, 0, '2014-11-07 15:08:04', NULL, '', 186, 158, 'inteiro', 'desktop'),
(2482, 153, 0, 'background', NULL, 0, '2014-11-07 15:08:04', '', '', 186, 158, 'texto', 'desktop'),
(2483, 153, 0, 'titulo_1', NULL, 0, '2014-11-07 15:15:05', NULL, 'Criando uma categoria para seus itens', 186, 159, 'texto', 'desktop'),
(2484, 153, 0, 'subtitulo_1', NULL, 0, '2014-11-07 15:15:05', NULL, 'Você pode criar quantas categorias quiser, mas 4 é que fica melhor', 186, 159, 'texto', 'desktop'),
(2485, 153, 0, 'texto_1', NULL, 0, '2014-11-07 15:15:05', NULL, 'Após criar seu menu container você deve editá-lo para criar as categorias e os itens para essa categoria.\r\nClique em listar seu menu container irá aparecer na na listagem, clique no ícone de edição roxo, para listar as categorias para este menu container.\r\nNão deve ter nenhuma pois ainda não criamos nenhuma, vamos criar então, clique novo:\r\nUma tela idêntica a anterior irá aparecer: Crie as categorias que desejar por exemplo: Embalagens, Alimentos e Bebidas\r\n\r\nApós criada as categorias você deve lista-las para poder edita-las ou adicionar seus itens', 186, 159, 'texto', 'desktop'),
(2486, 153, 0, 'link_1', NULL, 0, '2014-11-07 15:15:05', NULL, '', 186, 159, 'texto', 'desktop'),
(2487, 153, 0, 'image_1', NULL, 0, '2014-11-07 15:15:05', '', '', 186, 159, 'texto', 'desktop'),
(2488, 153, 0, 'layout_1', NULL, 0, '2014-11-07 15:15:05', 'left', '', 186, 159, 'texto', 'desktop'),
(2489, 153, 0, 'cor_1', NULL, 0, '2014-11-07 15:15:05', '', '', 186, 159, 'texto', 'desktop'),
(2490, 153, 0, 'cor_2', NULL, 0, '2014-11-07 15:15:05', '', '', 186, 159, 'texto', 'desktop'),
(2491, 153, 0, 'cor_3', NULL, 0, '2014-11-07 15:15:05', '', '', 186, 159, 'texto', 'desktop'),
(2492, 153, 0, 'alinhamento_1', NULL, 0, '2014-11-07 15:15:05', 'left', '', 186, 159, 'texto', 'desktop'),
(2493, 153, 0, 'alinhamento_2', NULL, 0, '2014-11-07 15:15:05', 'left', '', 186, 159, 'texto', 'desktop'),
(2494, 153, 0, 'alinhamento_3', NULL, 0, '2014-11-07 15:15:05', 'left', '', 186, 159, 'texto', 'desktop'),
(2495, 153, 0, 'margin_top', 0, 0, '2014-11-07 15:15:05', NULL, '', 186, 159, 'inteiro', 'desktop'),
(2496, 153, 0, 'margin_bottom', 0, 0, '2014-11-07 15:15:05', NULL, '', 186, 159, 'inteiro', 'desktop'),
(2497, 153, 0, 'padding_top', 0, 0, '2014-11-07 15:15:05', NULL, '', 186, 159, 'inteiro', 'desktop'),
(2498, 153, 0, 'padding_bottom', 0, 0, '2014-11-07 15:15:05', NULL, '', 186, 159, 'inteiro', 'desktop'),
(2499, 153, 0, 'is_full', 0, 0, '2014-11-07 15:15:05', NULL, '', 186, 159, 'inteiro', 'desktop'),
(2500, 153, 0, 'titulo_componente', NULL, 0, '2014-11-07 15:15:05', 'Passo - 4', '', 186, 159, 'texto', 'desktop'),
(2501, 153, 0, 'background_type', 0, 0, '2014-11-07 15:15:05', NULL, '', 186, 159, 'inteiro', 'desktop'),
(2502, 153, 0, 'background', NULL, 0, '2014-11-07 15:15:05', '', '', 186, 159, 'texto', 'desktop'),
(2503, 153, 0, 'titulo_1', NULL, 0, '2014-11-07 15:21:56', NULL, 'Adicionando items as suas categorias', 186, 160, 'texto', 'desktop'),
(2504, 153, 0, 'subtitulo_1', NULL, 0, '2014-11-07 15:21:56', NULL, 'Os items podem ter links que levam para qualquer lugar', 186, 160, 'texto', 'desktop'),
(2505, 153, 0, 'texto_1', NULL, 0, '2014-11-07 15:21:56', NULL, 'O sistema menu especial basicamente funciona navegando entre elementos que você criou.\r\nVocê cria, lista e adiciona novos, navegando nos níveis de cada elemento.\r\nPara criar o items de suas categorias basta ir acessando até menu categorias e escolher qual categoria deseja adicionar novos. \r\n\r\nVamos supor que você queira adicionar 4 items na sua categoria Categoria-1, você clica na categoria no botão editar amarelo, onde irá exibir todos os items que tem nessa categoria. No nosso caso não terá nenhum, então vamos adicionar, clique em novo.\r\n\r\nIrá ser exibido uma tela como as demais onde a única diferença é que nessa tem também o campo link.\r\nCrie os itens Item-1, Item-2, Item-3 um de cada vez e adicione links neles como por exemplo: /contato, /rss, /mapa_site e etc.\r\n\r\nPronto você já tem um menu especial para adicionar em sua página.', 186, 160, 'texto', 'desktop'),
(2506, 153, 0, 'link_1', NULL, 0, '2014-11-07 15:21:56', NULL, '', 186, 160, 'texto', 'desktop'),
(2507, 153, 0, 'image_1', NULL, 0, '2014-11-07 15:21:56', '', '', 186, 160, 'texto', 'desktop'),
(2508, 153, 0, 'layout_1', NULL, 0, '2014-11-07 15:21:56', 'left', '', 186, 160, 'texto', 'desktop'),
(2509, 153, 0, 'cor_1', NULL, 0, '2014-11-07 15:21:56', '', '', 186, 160, 'texto', 'desktop'),
(2510, 153, 0, 'cor_2', NULL, 0, '2014-11-07 15:21:56', '', '', 186, 160, 'texto', 'desktop'),
(2511, 153, 0, 'cor_3', NULL, 0, '2014-11-07 15:21:56', '', '', 186, 160, 'texto', 'desktop'),
(2512, 153, 0, 'alinhamento_1', NULL, 0, '2014-11-07 15:21:56', 'left', '', 186, 160, 'texto', 'desktop'),
(2513, 153, 0, 'alinhamento_2', NULL, 0, '2014-11-07 15:21:57', 'left', '', 186, 160, 'texto', 'desktop'),
(2514, 153, 0, 'alinhamento_3', NULL, 0, '2014-11-07 15:21:57', 'left', '', 186, 160, 'texto', 'desktop'),
(2515, 153, 0, 'margin_top', 0, 0, '2014-11-07 15:21:57', NULL, '', 186, 160, 'inteiro', 'desktop'),
(2516, 153, 0, 'margin_bottom', 0, 0, '2014-11-07 15:21:57', NULL, '', 186, 160, 'inteiro', 'desktop'),
(2517, 153, 0, 'padding_top', 0, 0, '2014-11-07 15:21:57', NULL, '', 186, 160, 'inteiro', 'desktop'),
(2518, 153, 0, 'padding_bottom', 0, 0, '2014-11-07 15:21:57', NULL, '', 186, 160, 'inteiro', 'desktop'),
(2519, 153, 0, 'is_full', 0, 0, '2014-11-07 15:21:57', NULL, '', 186, 160, 'inteiro', 'desktop'),
(2520, 153, 0, 'titulo_componente', NULL, 0, '2014-11-07 15:21:57', 'Passo - 5', '', 186, 160, 'texto', 'desktop'),
(2521, 153, 0, 'background_type', 0, 0, '2014-11-07 15:21:57', NULL, '', 186, 160, 'inteiro', 'desktop'),
(2522, 153, 0, 'background', NULL, 0, '2014-11-07 15:21:57', '', '', 186, 160, 'texto', 'desktop'),
(2523, 153, 0, 'titulo_1', NULL, 0, '2014-11-07 15:25:58', NULL, 'Ultimos passos para exibiçao', 186, 161, 'texto', 'desktop'),
(2524, 153, 0, 'subtitulo_1', NULL, 0, '2014-11-07 15:25:58', NULL, 'Agora basta adicionar o menu especial na página', 186, 161, 'texto', 'desktop'),
(2525, 153, 0, 'texto_1', NULL, 0, '2014-11-07 15:25:58', NULL, 'Após criar seu menu especial com: menu container, menu categorias e menu items, agora você deve adicionar o ID deste na página que você criou para esta exibir seu menu.\r\nListe todos seus menus especiais: Layout / Menu / Menu Especial / Lsitar\r\nEncontre o seu menu, Menu de serviços e copie o ID deste.\r\n\r\nAgora acesse sua página: Páginas / Listar encontre a página serviços e adicione esse ID dentro do campo Extra.\r\n\r\nProntinho', 186, 161, 'texto', 'desktop'),
(2526, 153, 0, 'link_1', NULL, 0, '2014-11-07 15:25:58', NULL, '', 186, 161, 'texto', 'desktop'),
(2527, 153, 0, 'image_1', NULL, 0, '2014-11-07 15:25:58', '', '', 186, 161, 'texto', 'desktop'),
(2528, 153, 0, 'layout_1', NULL, 0, '2014-11-07 15:25:58', 'left', '', 186, 161, 'texto', 'desktop'),
(2529, 153, 0, 'cor_1', NULL, 0, '2014-11-07 15:25:58', '', '', 186, 161, 'texto', 'desktop'),
(2530, 153, 0, 'cor_2', NULL, 0, '2014-11-07 15:25:58', '', '', 186, 161, 'texto', 'desktop'),
(2531, 153, 0, 'cor_3', NULL, 0, '2014-11-07 15:25:58', '', '', 186, 161, 'texto', 'desktop'),
(2532, 153, 0, 'alinhamento_1', NULL, 0, '2014-11-07 15:25:58', 'left', '', 186, 161, 'texto', 'desktop'),
(2533, 153, 0, 'alinhamento_2', NULL, 0, '2014-11-07 15:25:59', 'left', '', 186, 161, 'texto', 'desktop'),
(2534, 153, 0, 'alinhamento_3', NULL, 0, '2014-11-07 15:25:59', 'left', '', 186, 161, 'texto', 'desktop'),
(2535, 153, 0, 'margin_top', 0, 0, '2014-11-07 15:25:59', NULL, '', 186, 161, 'inteiro', 'desktop'),
(2536, 153, 0, 'margin_bottom', 0, 0, '2014-11-07 15:25:59', NULL, '', 186, 161, 'inteiro', 'desktop'),
(2537, 153, 0, 'padding_top', 0, 0, '2014-11-07 15:25:59', NULL, '', 186, 161, 'inteiro', 'desktop'),
(2538, 153, 0, 'padding_bottom', 0, 0, '2014-11-07 15:25:59', NULL, '', 186, 161, 'inteiro', 'desktop'),
(2539, 153, 0, 'is_full', 0, 0, '2014-11-07 15:25:59', NULL, '', 186, 161, 'inteiro', 'desktop'),
(2540, 153, 0, 'titulo_componente', NULL, 0, '2014-11-07 15:25:59', 'Passo - 6', '', 186, 161, 'texto', 'desktop'),
(2541, 153, 0, 'background_type', 0, 0, '2014-11-07 15:26:00', NULL, '', 186, 161, 'inteiro', 'desktop'),
(2542, 153, 0, 'background', NULL, 0, '2014-11-07 15:26:00', '', '', 186, 161, 'texto', 'desktop'),
(2543, 145, 0, 'titulo_1', NULL, 0, '2014-11-07 15:28:30', NULL, 'Dicas para criação de Menu Especial', 186, 162, 'texto', 'desktop'),
(2544, 145, 0, 'subtitulo_1', NULL, 0, '2014-11-07 15:28:31', NULL, '', 186, 162, 'texto', 'desktop'),
(2545, 145, 0, 'texto_1', NULL, 0, '2014-11-07 15:28:31', NULL, 'Veja o passo para criar menus com várias categorias e vários itens.', 186, 162, 'texto', 'desktop'),
(2546, 145, 0, 'link_1', NULL, 0, '2014-11-07 15:28:31', NULL, '/dicas_menu_especial', 186, 162, 'texto', 'desktop'),
(2547, 145, 0, 'image_1', NULL, 0, '2014-11-07 15:28:31', '', '', 186, 162, 'texto', 'desktop'),
(2548, 145, 0, 'layout_1', NULL, 0, '2014-11-07 15:28:31', 'left', '', 186, 162, 'texto', 'desktop'),
(2549, 145, 0, 'cor_1', NULL, 0, '2014-11-07 15:28:31', '', '', 186, 162, 'texto', 'desktop'),
(2550, 145, 0, 'cor_2', NULL, 0, '2014-11-07 15:28:32', '', '', 186, 162, 'texto', 'desktop'),
(2551, 145, 0, 'cor_3', NULL, 0, '2014-11-07 15:28:32', '', '', 186, 162, 'texto', 'desktop'),
(2552, 145, 0, 'alinhamento_1', NULL, 0, '2014-11-07 15:28:32', 'left', '', 186, 162, 'texto', 'desktop'),
(2553, 145, 0, 'alinhamento_2', NULL, 0, '2014-11-07 15:28:32', 'left', '', 186, 162, 'texto', 'desktop'),
(2554, 145, 0, 'alinhamento_3', NULL, 0, '2014-11-07 15:28:32', 'left', '', 186, 162, 'texto', 'desktop'),
(2555, 145, 0, 'margin_top', 0, 0, '2014-11-07 15:28:32', NULL, '', 186, 162, 'inteiro', 'desktop'),
(2556, 145, 0, 'margin_bottom', 0, 0, '2014-11-07 15:28:32', NULL, '', 186, 162, 'inteiro', 'desktop'),
(2557, 145, 0, 'padding_top', 0, 0, '2014-11-07 15:28:33', NULL, '', 186, 162, 'inteiro', 'desktop'),
(2558, 145, 0, 'padding_bottom', 0, 0, '2014-11-07 15:28:33', NULL, '', 186, 162, 'inteiro', 'desktop'),
(2559, 145, 0, 'is_full', 0, 0, '2014-11-07 15:28:33', NULL, '', 186, 162, 'inteiro', 'desktop'),
(2560, 145, 0, 'titulo_componente', NULL, 0, '2014-11-07 15:28:33', 'Dicas Menu Especial', '', 186, 162, 'texto', 'desktop'),
(2561, 145, 0, 'background_type', 0, 0, '2014-11-07 15:28:33', NULL, '', 186, 162, 'inteiro', 'desktop'),
(2562, 145, 0, 'background', NULL, 0, '2014-11-07 15:28:33', '', '', 186, 162, 'texto', 'desktop'),
(2563, 136, 0, 'titulo_1', NULL, 0, '2014-11-09 04:24:56', NULL, '', 254, 125, 'texto', 'desktop'),
(2564, 136, 0, 'subtitulo_1', NULL, 0, '2014-11-09 04:24:56', NULL, '', 254, 125, 'texto', 'desktop'),
(2565, 136, 0, 'texto_1', NULL, 0, '2014-11-09 04:24:56', NULL, '', 254, 125, 'texto', 'desktop'),
(2566, 136, 0, 'cor_1', NULL, 0, '2014-11-09 04:24:56', '', '', 254, 125, 'texto', 'desktop'),
(2567, 136, 0, 'cor_2', NULL, 0, '2014-11-09 04:24:56', '', '', 254, 125, 'texto', 'desktop'),
(2568, 136, 0, 'cor_3', NULL, 0, '2014-11-09 04:24:56', '', '', 254, 125, 'texto', 'desktop'),
(2569, 136, 0, 'galeria', NULL, 0, '2014-11-09 04:24:56', '6', '', 254, 125, 'texto', 'desktop'),
(2570, 136, 0, 'botao_exibe', 0, 0, '2014-11-09 04:24:56', NULL, '', 254, 125, 'inteiro', 'desktop'),
(2571, 136, 0, 'titulo_exibe', 0, 0, '2014-11-09 04:24:56', NULL, '', 254, 125, 'inteiro', 'desktop'),
(2572, 136, 0, 'fullscreen', 0, 0, '2014-11-09 04:24:57', NULL, '', 254, 125, 'inteiro', 'desktop'),
(2573, 136, 0, 'autoplay', 0, 0, '2014-11-09 04:24:57', NULL, '', 254, 125, 'inteiro', 'desktop'),
(2574, 136, 0, 'lightbox', 0, 0, '2014-11-09 04:24:57', NULL, '', 254, 125, 'inteiro', 'desktop'),
(2575, 136, 0, 'sombra', 0, 0, '2014-11-09 04:24:57', NULL, '', 254, 125, 'inteiro', 'desktop'),
(2576, 136, 0, 'caption', 0, 0, '2014-11-09 04:24:57', NULL, '', 254, 125, 'inteiro', 'desktop'),
(2577, 136, 0, 'margin_top', 0, 0, '2014-11-09 04:24:57', NULL, '', 254, 125, 'inteiro', 'desktop'),
(2578, 136, 0, 'margin_bottom', 0, 0, '2014-11-09 04:24:57', NULL, '', 254, 125, 'inteiro', 'desktop'),
(2579, 136, 0, 'is_full', 0, 0, '2014-11-09 04:24:57', NULL, '', 254, 125, 'inteiro', 'desktop'),
(2580, 136, 0, 'titulo_componente', NULL, 0, '2014-11-09 04:24:57', '', '', 254, 125, 'texto', 'desktop'),
(2581, 136, 0, 'background_type', 0, 0, '2014-11-09 04:24:57', NULL, '', 254, 125, 'inteiro', 'desktop'),
(2582, 136, 0, 'background', NULL, 0, '2014-11-09 04:24:57', '', '', 254, 125, 'texto', 'desktop'),
(2583, 145, 0, 'titulo_1', NULL, 0, '2014-11-11 10:41:51', NULL, 'Dicas para ver Comentários e Depoimentos', 186, 164, 'texto', 'desktop'),
(2584, 145, 0, 'subtitulo_1', NULL, 0, '2014-11-11 10:41:51', NULL, '', 186, 164, 'texto', 'desktop'),
(2585, 145, 0, 'texto_1', NULL, 0, '2014-11-11 10:41:51', NULL, 'Veja como ler, aprovar e publicar depoimentos e comentários realizados em seu site.', 186, 164, 'texto', 'desktop');
INSERT INTO `paginas_attribute` (`id`, `id_pagina`, `user_id`, `name`, `inteiro`, `number`, `estampa`, `texto`, `descricao`, `id_componente`, `id_row`, `tipo`, `plataforma`) VALUES
(2586, 145, 0, 'link_1', NULL, 0, '2014-11-11 10:41:51', NULL, '/dicas_para_ver_comentarios_e_depoimentos', 186, 164, 'texto', 'desktop'),
(2587, 145, 0, 'image_1', NULL, 0, '2014-11-11 10:41:51', '', '', 186, 164, 'texto', 'desktop'),
(2588, 145, 0, 'layout_1', NULL, 0, '2014-11-11 10:41:51', 'left', '', 186, 164, 'texto', 'desktop'),
(2589, 145, 0, 'cor_1', NULL, 0, '2014-11-11 10:41:51', '', '', 186, 164, 'texto', 'desktop'),
(2590, 145, 0, 'cor_2', NULL, 0, '2014-11-11 10:41:51', '', '', 186, 164, 'texto', 'desktop'),
(2591, 145, 0, 'cor_3', NULL, 0, '2014-11-11 10:41:51', '', '', 186, 164, 'texto', 'desktop'),
(2592, 145, 0, 'alinhamento_1', NULL, 0, '2014-11-11 10:41:51', 'left', '', 186, 164, 'texto', 'desktop'),
(2593, 145, 0, 'alinhamento_2', NULL, 0, '2014-11-11 10:41:51', 'left', '', 186, 164, 'texto', 'desktop'),
(2594, 145, 0, 'alinhamento_3', NULL, 0, '2014-11-11 10:41:51', 'left', '', 186, 164, 'texto', 'desktop'),
(2595, 145, 0, 'margin_top', 0, 0, '2014-11-11 10:41:51', NULL, '', 186, 164, 'inteiro', 'desktop'),
(2596, 145, 0, 'margin_bottom', 0, 0, '2014-11-11 10:41:51', NULL, '', 186, 164, 'inteiro', 'desktop'),
(2597, 145, 0, 'padding_top', 0, 0, '2014-11-11 10:41:51', NULL, '', 186, 164, 'inteiro', 'desktop'),
(2598, 145, 0, 'padding_bottom', 0, 0, '2014-11-11 10:41:51', NULL, '', 186, 164, 'inteiro', 'desktop'),
(2599, 145, 0, 'is_full', 0, 0, '2014-11-11 10:41:51', NULL, '', 186, 164, 'inteiro', 'desktop'),
(2600, 145, 0, 'titulo_componente', NULL, 0, '2014-11-11 10:41:51', 'Dica Comentários e Depoimentos', '', 186, 164, 'texto', 'desktop'),
(2601, 145, 0, 'background_type', 0, 0, '2014-11-11 10:41:51', NULL, '', 186, 164, 'inteiro', 'desktop'),
(2602, 145, 0, 'background', NULL, 0, '2014-11-11 10:41:51', '', '', 186, 164, 'texto', 'desktop'),
(2603, 154, 0, 'titulo_1', NULL, 0, '2014-11-11 10:46:14', NULL, 'Dicas para ver Comentários e Depoimentos', 207, 165, 'texto', 'desktop'),
(2604, 154, 0, 'subtitulo_1', NULL, 0, '2014-11-11 10:46:14', NULL, 'Basta Ler, Aprovar (\"corrigir\") e publicar.', 207, 165, 'texto', 'desktop'),
(2605, 154, 0, 'texto_1', NULL, 0, '2014-11-11 10:46:14', NULL, 'Qualquer pessoa que estiver navegando no site poderá deixar registrado um comentário ou depoimento. O registro ficará armazenado no seu banco de dados, aguardando sua aprovação para ser publicado no site. A edição e resposta ao comentário ou depoimento também é possível.\r\n\r\nCOMENTÁRIOS -  são registrados em paginas de publicação de matéria, artigos, produtos e eventos.\r\n\r\nDEPOIMENTO - são registrados apenas na pagina de depoimentos sobre sua empresa.\r\n\r\nPara ver seus comentários e depoimentos, acesse no menu CONTEÚDO / COMENTÁRIOS\r\n\r\n\r\n', 207, 165, 'texto', 'desktop'),
(2606, 154, 0, 'link_1', NULL, 0, '2014-11-11 10:46:14', NULL, '', 207, 165, 'texto', 'desktop'),
(2607, 154, 0, 'image_1', NULL, 0, '2014-11-11 10:46:14', '', '', 207, 165, 'image', 'desktop'),
(2608, 154, 0, 'layout_1', NULL, 0, '2014-11-11 10:46:14', 'up', '', 207, 165, 'texto', 'desktop'),
(2609, 154, 0, 'cor_1', NULL, 0, '2014-11-11 10:46:14', '', '', 207, 165, 'texto', 'desktop'),
(2610, 154, 0, 'cor_2', NULL, 0, '2014-11-11 10:46:14', '', '', 207, 165, 'texto', 'desktop'),
(2611, 154, 0, 'cor_3', NULL, 0, '2014-11-11 10:46:14', '', '', 207, 165, 'texto', 'desktop'),
(2612, 154, 0, 'alinhamento_1', NULL, 0, '2014-11-11 10:46:14', 'left', '', 207, 165, 'texto', 'desktop'),
(2613, 154, 0, 'alinhamento_2', NULL, 0, '2014-11-11 10:46:14', 'left', '', 207, 165, 'texto', 'desktop'),
(2614, 154, 0, 'alinhamento_3', NULL, 0, '2014-11-11 10:46:14', 'left', '', 207, 165, 'texto', 'desktop'),
(2615, 154, 0, 'margin_top', 0, 0, '2014-11-11 10:46:14', NULL, '', 207, 165, 'inteiro', 'desktop'),
(2616, 154, 0, 'margin_bottom', 0, 0, '2014-11-11 10:46:14', NULL, '', 207, 165, 'inteiro', 'desktop'),
(2617, 154, 0, 'padding_top', 0, 0, '2014-11-11 10:46:14', NULL, '', 207, 165, 'inteiro', 'desktop'),
(2618, 154, 0, 'padding_bottom', 0, 0, '2014-11-11 10:46:14', NULL, '', 207, 165, 'inteiro', 'desktop'),
(2619, 154, 0, 'is_full', 0, 0, '2014-11-11 10:46:14', NULL, '', 207, 165, 'inteiro', 'desktop'),
(2620, 154, 0, 'titulo_componente', NULL, 0, '2014-11-11 10:46:14', '', '', 207, 165, 'texto', 'desktop'),
(2621, 154, 0, 'background_type', 0, 0, '2014-11-11 10:46:14', NULL, '', 207, 165, 'inteiro', 'desktop'),
(2622, 154, 0, 'background', NULL, 0, '2014-11-11 10:46:14', '', '', 207, 165, 'texto', 'desktop'),
(2623, 155, 0, 'titulo_1', NULL, 0, '2014-11-11 11:29:00', NULL, 'Dicas para ver comentários e depoimentos', 207, 166, 'texto', 'desktop'),
(2624, 155, 0, 'subtitulo_1', NULL, 0, '2014-11-11 11:29:00', NULL, 'Basta ler, aprovar (corrigir) e publicar', 207, 166, 'texto', 'desktop'),
(2625, 155, 0, 'texto_1', NULL, 0, '2014-11-11 11:29:00', NULL, 'Qualquer pessoa que estiver navegando no site poderá deixar registrado um comentário ou depoimento. O registro ficará armazenado no seu banco de dados, aguardando sua aprovação para ser publicado no site. A edição e resposta ao comentário ou depoimento também é possível.\r\n\r\n<b>COMENTÁRIOS </b>-  são registrados em paginas de publicação de matéria, artigos, produtos e eventos.\r\n\r\n<b>DEPOIMENTO </b> - são registrados apenas na pagina de depoimentos sobre sua empresa.\r\n\r\nPara ver seus comentários e depoimentos, acesse no menu <b>CONTEÚDO / COMENTÁRIOS </b>\r\n\r\n<h3>Comentário</h3>\r\nNa sessão Comentários abrirá a listagem de todos os registros. \r\n\r\nCom a opção de filtro, você poderá escolher e selecionar os registros feitos em diferentes paginas, como: matéria, artigos, produtos e eventos.\r\n\r\nO sistema também mostra em diferentes paginas os comentários <b>Já Aprovados </b>e os <b>Esperando Aprovação</b>.\r\n\r\nNa sessão <b>EDITAR</b>, ao passar o mouse em cima dos ícones o sistema mostrará as funções:\r\n\r\n<b>Aprovar </b>- o registro (comentário) será publicado no site\r\n\r\n<b>Reprovar</b>- o registro (comentário) não será publicado no site, mas ficará armazenado em seu banco de dados\r\n\r\n<b>Editar</b>- para ler o registro (comentário) antes de ser publicar no site, poderá editar (ex.: um erro de português) e também tem a opção de responder ao comentário, ambos os registros serão publicados no site, o comentário e a resposta para ele. Ao termino da edição, salve e volte na pagina para selecionar a opção de <b>Aprovar</b>.\r\n\r\n<b>Excluir</b>- o registro (comentário) será excluído do armazenado em seu banco de dados.\r\n\r\nLembre-se sempre de salvar a pagina após todas as alterações.\r\n\r\n<h3>Depoimento</h3>\r\nNa sessão Depoimentos abrirá a opção de <b>CADASTRAR / LISTAR </b> \r\n\r\n<b>Listar</b>- abrirá pagina de listagem de todos os depoimentos registrados no site.\r\n\r\n<b>Cadastrar</b>- registro de depoimentos feitos por você, administrador do site, via sistema Admin, só serão registrados para clientes já cadastrados no seu site. Esta sessão serve para você publicar em seu site os depoimentos que foram enviados por emails pelos seus clientes, registro registrados por seus clientes.\r\n\r\nAo selecionar esta opção abrirá a pagina de <B>EDITAR DEPOIMENTO</B>, nesta pagina você poderá editar:\r\n\r\n<B>Cliente</B>- já cadastrado em seu banco de dados.\r\n\r\n<b>Email</b>- conforme selecionado o cliente, o sistema já fornece email do cliente, não será publicado no site.\r\n\r\n<b>Nome</b>- conforme selecionado o nome cliente, o sistema já fornece nome do cliente.\r\n\r\n<b>Título</b>- título do depoimento\r\n\r\n<b>Comentário</b>- depoimento registrado pelo cliente\r\n\r\n<b>Resposta</b>- sua reposta ao depoimento registrado, será publicado e visível no site.\r\n\r\nLembre-se sempre de salvar a pagina após todas as alterações.\r\n\r\nO depoimento já esta armazenado no seu banco de dados, mas ainda não foi publicado no site. Pois, após salvar todas as alterações o sistema volta para a pagina de exibição de todos os depoimentos e agora sim você poderá <b>APROVAR</b> para ser visivel em seu web site.\r\n\r\nProntinho!! Aperte F5 ou atualize sua pagina e verá como ficou publicado.\r\n\r\nOk? Viu como é tudo simples, fácil e prático de fazer no Admin.\r\n\r\n', 207, 166, 'texto', 'desktop'),
(2626, 155, 0, 'link_1', NULL, 0, '2014-11-11 11:29:00', NULL, '', 207, 166, 'texto', 'desktop'),
(2627, 155, 0, 'image_1', NULL, 0, '2014-11-11 11:29:00', '', '', 207, 166, 'texto', 'desktop'),
(2628, 155, 0, 'layout_1', NULL, 0, '2014-11-11 11:29:00', 'up', '', 207, 166, 'texto', 'desktop'),
(2629, 155, 0, 'cor_1', NULL, 0, '2014-11-11 11:29:00', '', '', 207, 166, 'texto', 'desktop'),
(2630, 155, 0, 'cor_2', NULL, 0, '2014-11-11 11:29:00', '', '', 207, 166, 'texto', 'desktop'),
(2631, 155, 0, 'cor_3', NULL, 0, '2014-11-11 11:29:00', '', '', 207, 166, 'texto', 'desktop'),
(2632, 155, 0, 'alinhamento_1', NULL, 0, '2014-11-11 11:29:00', 'left', '', 207, 166, 'texto', 'desktop'),
(2633, 155, 0, 'alinhamento_2', NULL, 0, '2014-11-11 11:29:00', 'left', '', 207, 166, 'texto', 'desktop'),
(2634, 155, 0, 'alinhamento_3', NULL, 0, '2014-11-11 11:29:00', 'left', '', 207, 166, 'texto', 'desktop'),
(2635, 155, 0, 'margin_top', 0, 0, '2014-11-11 11:29:00', NULL, '', 207, 166, 'inteiro', 'desktop'),
(2636, 155, 0, 'margin_bottom', 0, 0, '2014-11-11 11:29:00', NULL, '', 207, 166, 'inteiro', 'desktop'),
(2637, 155, 0, 'padding_top', 0, 0, '2014-11-11 11:29:00', NULL, '', 207, 166, 'inteiro', 'desktop'),
(2638, 155, 0, 'padding_bottom', 0, 0, '2014-11-11 11:29:00', NULL, '', 207, 166, 'inteiro', 'desktop'),
(2639, 155, 0, 'is_full', 0, 0, '2014-11-11 11:29:00', NULL, '', 207, 166, 'inteiro', 'desktop'),
(2640, 155, 0, 'titulo_componente', NULL, 0, '2014-11-11 11:29:00', '', '', 207, 166, 'texto', 'desktop'),
(2641, 155, 0, 'background_type', 0, 0, '2014-11-11 11:29:00', NULL, '', 207, 166, 'inteiro', 'desktop'),
(2642, 155, 0, 'background', NULL, 0, '2014-11-11 11:29:00', '', '', 207, 166, 'texto', 'desktop'),
(2643, 1, 0, 'padding_top', 0, 0, '2014-11-12 21:27:12', NULL, '', 216, 25, 'inteiro', 'desktop'),
(2644, 1, 0, 'padding_bottom', 0, 0, '2014-11-12 21:27:12', NULL, '', 216, 25, 'inteiro', 'desktop'),
(2645, 1, 0, 'titulo_componente', NULL, 0, '2014-11-12 21:27:12', '', '', 216, 25, 'texto', 'desktop'),
(2646, 1, 0, 'alinhamento_1', NULL, 0, '2014-11-12 21:28:30', 'left', '', 255, 118, 'texto', 'desktop'),
(2647, 1, 0, 'alinhamento_2', NULL, 0, '2014-11-12 21:28:30', 'left', '', 255, 118, 'texto', 'desktop'),
(2648, 1, 0, 'alinhamento_3', NULL, 0, '2014-11-12 21:28:31', 'left', '', 255, 118, 'texto', 'desktop'),
(2649, 1, 0, 'padding_top', 0, 0, '2014-11-12 21:28:31', NULL, '', 255, 118, 'inteiro', 'desktop'),
(2650, 1, 0, 'padding_bottom', 0, 0, '2014-11-12 21:28:32', NULL, '', 255, 118, 'inteiro', 'desktop'),
(2651, 1, 0, 'alinhamento_1', NULL, 0, '2014-11-12 21:31:33', 'left', '', 255, 136, 'texto', 'desktop'),
(2652, 1, 0, 'alinhamento_2', NULL, 0, '2014-11-12 21:31:33', 'left', '', 255, 136, 'texto', 'desktop'),
(2653, 1, 0, 'alinhamento_3', NULL, 0, '2014-11-12 21:31:34', 'left', '', 255, 136, 'texto', 'desktop'),
(2654, 1, 0, 'fullscreen', 0, 0, '2014-11-12 21:31:34', NULL, '', 255, 136, 'inteiro', 'desktop'),
(2655, 1, 0, 'autoplay', 0, 0, '2014-11-12 21:31:34', NULL, '', 255, 136, 'inteiro', 'desktop'),
(2656, 1, 0, 'lightbox', 0, 0, '2014-11-12 21:31:34', NULL, '', 255, 136, 'inteiro', 'desktop'),
(2657, 1, 0, 'sombra', 0, 0, '2014-11-12 21:31:34', NULL, '', 255, 136, 'inteiro', 'desktop'),
(2658, 1, 0, 'caption', 0, 0, '2014-11-12 21:31:34', NULL, '', 255, 136, 'inteiro', 'desktop'),
(2659, 1, 0, 'padding_top', 0, 0, '2014-11-12 21:31:35', NULL, '', 255, 136, 'inteiro', 'desktop'),
(2660, 1, 0, 'padding_bottom', 0, 0, '2014-11-12 21:31:35', NULL, '', 255, 136, 'inteiro', 'desktop'),
(2661, 1, 0, 'alinhamento_1', NULL, 0, '2014-11-12 21:32:15', 'left', '', 219, 29, 'texto', 'desktop'),
(2662, 1, 0, 'alinhamento_2', NULL, 0, '2014-11-12 21:32:16', 'left', '', 219, 29, 'texto', 'desktop'),
(2663, 1, 0, 'alinhamento_3', NULL, 0, '2014-11-12 21:32:16', 'left', '', 219, 29, 'texto', 'desktop'),
(2664, 1, 0, 'botao_label', NULL, 0, '2014-11-12 21:32:17', '', '', 219, 29, 'texto', 'desktop'),
(2665, 1, 0, 'fullscreen', 0, 0, '2014-11-12 21:32:17', NULL, '', 219, 29, 'inteiro', 'desktop'),
(2666, 1, 0, 'autoplay', 0, 0, '2014-11-12 21:32:17', NULL, '', 219, 29, 'inteiro', 'desktop'),
(2667, 1, 0, 'lightbox', 0, 0, '2014-11-12 21:32:18', NULL, '', 219, 29, 'inteiro', 'desktop'),
(2668, 1, 0, 'sombra', 0, 0, '2014-11-12 21:32:18', NULL, '', 219, 29, 'inteiro', 'desktop'),
(2669, 1, 0, 'caption', 0, 0, '2014-11-12 21:32:18', NULL, '', 219, 29, 'inteiro', 'desktop'),
(2670, 1, 0, 'padding_top', 0, 0, '2014-11-12 21:32:18', NULL, '', 219, 29, 'inteiro', 'desktop'),
(2671, 1, 0, 'padding_bottom', 0, 0, '2014-11-12 21:32:18', NULL, '', 219, 29, 'inteiro', 'desktop'),
(2672, 1, 0, 'titulo_componente', NULL, 0, '2014-11-12 21:32:18', '', '', 219, 29, 'texto', 'desktop'),
(2673, 1, 0, 'padding_top', 0, 0, '2014-11-12 21:32:57', NULL, '', 215, 30, 'inteiro', 'desktop'),
(2674, 1, 0, 'padding_bottom', 0, 0, '2014-11-12 21:32:58', NULL, '', 215, 30, 'inteiro', 'desktop'),
(2675, 1, 0, 'is_full', 0, 0, '2014-11-12 21:32:58', NULL, '', 215, 30, 'inteiro', 'desktop'),
(2676, 1, 0, 'titulo_componente', NULL, 0, '2014-11-12 21:32:58', '', '', 215, 30, 'texto', 'desktop'),
(2677, 1, 0, 'titulo_1', NULL, 0, '2014-11-12 21:33:14', NULL, '', 218, 26, 'texto', 'desktop'),
(2678, 1, 0, 'subtitulo_1', NULL, 0, '2014-11-12 21:33:14', NULL, '', 218, 26, 'texto', 'desktop'),
(2679, 1, 0, 'texto_1', NULL, 0, '2014-11-12 21:33:14', NULL, '', 218, 26, 'texto', 'desktop'),
(2680, 1, 0, 'link_1', NULL, 0, '2014-11-12 21:33:14', NULL, '', 218, 26, 'texto', 'desktop'),
(2681, 1, 0, 'cor_1', NULL, 0, '2014-11-12 21:33:14', '', '', 218, 26, 'texto', 'desktop'),
(2682, 1, 0, 'cor_2', NULL, 0, '2014-11-12 21:33:14', '', '', 218, 26, 'texto', 'desktop'),
(2683, 1, 0, 'cor_3', NULL, 0, '2014-11-12 21:33:14', '', '', 218, 26, 'texto', 'desktop'),
(2684, 1, 0, 'alinhamento_1', NULL, 0, '2014-11-12 21:33:14', 'left', '', 218, 26, 'texto', 'desktop'),
(2685, 1, 0, 'alinhamento_2', NULL, 0, '2014-11-12 21:33:14', 'left', '', 218, 26, 'texto', 'desktop'),
(2686, 1, 0, 'alinhamento_3', NULL, 0, '2014-11-12 21:33:14', 'left', '', 218, 26, 'texto', 'desktop'),
(2687, 1, 0, 'margin_top', 0, 0, '2014-11-12 21:33:14', NULL, '', 218, 26, 'inteiro', 'desktop'),
(2688, 1, 0, 'margin_bottom', 30, 0, '2014-11-12 21:33:14', NULL, '', 218, 26, 'inteiro', 'desktop'),
(2689, 1, 0, 'padding_top', 0, 0, '2014-11-12 21:33:14', NULL, '', 218, 26, 'inteiro', 'desktop'),
(2690, 1, 0, 'padding_bottom', 0, 0, '2014-11-12 21:33:14', NULL, '', 218, 26, 'inteiro', 'desktop'),
(2691, 1, 0, 'is_full', 0, 0, '2014-11-12 21:33:14', NULL, '', 218, 26, 'inteiro', 'desktop'),
(2692, 1, 0, 'titulo_componente', NULL, 0, '2014-11-12 21:33:14', '', '', 218, 26, 'texto', 'desktop'),
(2693, 1, 0, 'background_type', 0, 0, '2014-11-12 21:33:14', NULL, '', 218, 26, 'inteiro', 'desktop'),
(2694, 1, 0, 'background', NULL, 0, '2014-11-12 21:33:14', '', '', 218, 26, 'texto', 'desktop'),
(2695, 145, 0, 'titulo_1', NULL, 0, '2014-11-12 21:49:19', NULL, 'Teste', 186, 167, 'texto', 'desktop'),
(2696, 145, 0, 'subtitulo_1', NULL, 0, '2014-11-12 21:49:19', NULL, 'TEste', 186, 167, 'texto', 'desktop'),
(2697, 145, 0, 'texto_1', NULL, 0, '2014-11-12 21:49:19', NULL, 'Veja dicas para downloads', 186, 167, 'texto', 'desktop'),
(2698, 145, 0, 'link_1', NULL, 0, '2014-11-12 21:49:19', NULL, '', 186, 167, 'texto', 'desktop'),
(2699, 145, 0, 'image_1', NULL, 0, '2014-11-12 21:49:19', '', '', 186, 167, 'texto', 'desktop'),
(2700, 145, 0, 'layout_1', NULL, 0, '2014-11-12 21:49:19', 'left', '', 186, 167, 'texto', 'desktop'),
(2701, 145, 0, 'cor_1', NULL, 0, '2014-11-12 21:49:19', '', '', 186, 167, 'texto', 'desktop'),
(2702, 145, 0, 'cor_2', NULL, 0, '2014-11-12 21:49:20', '', '', 186, 167, 'texto', 'desktop'),
(2703, 145, 0, 'cor_3', NULL, 0, '2014-11-12 21:49:20', '', '', 186, 167, 'texto', 'desktop'),
(2704, 145, 0, 'alinhamento_1', NULL, 0, '2014-11-12 21:49:20', 'left', '', 186, 167, 'texto', 'desktop'),
(2705, 145, 0, 'alinhamento_2', NULL, 0, '2014-11-12 21:49:20', 'left', '', 186, 167, 'texto', 'desktop'),
(2706, 145, 0, 'alinhamento_3', NULL, 0, '2014-11-12 21:49:20', 'left', '', 186, 167, 'texto', 'desktop'),
(2707, 145, 0, 'margin_top', 0, 0, '2014-11-12 21:49:20', NULL, '', 186, 167, 'inteiro', 'desktop'),
(2708, 145, 0, 'margin_bottom', 0, 0, '2014-11-12 21:49:20', NULL, '', 186, 167, 'inteiro', 'desktop'),
(2709, 145, 0, 'padding_top', 0, 0, '2014-11-12 21:49:20', NULL, '', 186, 167, 'inteiro', 'desktop'),
(2710, 145, 0, 'padding_bottom', 0, 0, '2014-11-12 21:49:20', NULL, '', 186, 167, 'inteiro', 'desktop'),
(2711, 145, 0, 'is_full', 0, 0, '2014-11-12 21:49:20', NULL, '', 186, 167, 'inteiro', 'desktop'),
(2712, 145, 0, 'titulo_componente', NULL, 0, '2014-11-12 21:49:20', '', '', 186, 167, 'texto', 'desktop'),
(2713, 145, 0, 'background_type', 0, 0, '2014-11-12 21:49:20', NULL, '', 186, 167, 'inteiro', 'desktop'),
(2714, 145, 0, 'background', NULL, 0, '2014-11-12 21:49:21', '', '', 186, 167, 'texto', 'desktop'),
(2715, 145, 0, 'label_1', NULL, 0, '2014-11-12 23:04:57', 'Dicas Downloads', '', 186, 140, 'texto', 'desktop'),
(2716, 134, 0, 'image_type_1', 1, 0, '2014-11-12 23:05:43', NULL, '', 234, 116, 'inteiro', 'desktop'),
(2717, 134, 0, 'image_1', NULL, 0, '2014-11-12 23:05:43', '', '', 234, 116, 'texto', 'desktop'),
(2718, 134, 0, 'titulo_componente', NULL, 0, '2014-11-12 23:05:44', '', '', 234, 116, 'texto', 'desktop'),
(2719, 145, 0, 'label_1', NULL, 0, '2014-11-12 23:06:14', 'Dicas para disparar e-mails', '', 186, 142, 'texto', 'desktop'),
(2720, 145, 0, 'label_1', NULL, 0, '2014-11-12 23:08:57', 'Dicas aplicativo Facebook', '', 186, 145, 'texto', 'desktop'),
(2721, 145, 0, 'label_1', NULL, 0, '2014-11-12 23:09:24', 'Dicas o que são e para que servem as tags', '', 186, 152, 'texto', 'desktop'),
(2722, 145, 0, 'label_1', NULL, 0, '2014-11-12 23:09:55', 'Dicas para ter acesso as inscrições em eventos', '', 186, 153, 'texto', 'desktop'),
(2723, 145, 0, 'label_1', NULL, 0, '2014-11-12 23:10:32', 'Dicas Menu Especial', '', 186, 162, 'texto', 'desktop'),
(2724, 145, 0, 'label_1', NULL, 0, '2014-11-12 23:11:04', 'Dicas para ver Comentários e Depoimentos', '', 186, 164, 'texto', 'desktop'),
(2725, 143, 0, 'link_1', NULL, 0, '2014-11-12 23:11:43', NULL, '', 207, 101, 'texto', 'desktop'),
(2726, 143, 0, 'titulo_componente', NULL, 0, '2014-11-12 23:11:43', 'Passo - 1 O disparador', '', 207, 101, 'texto', 'desktop'),
(2727, 143, 0, 'label_1', NULL, 0, '2014-11-12 23:12:06', '', '', 186, 89, 'texto', 'desktop'),
(2728, 143, 0, 'link_1', NULL, 0, '2014-11-12 23:12:06', NULL, '', 186, 89, 'texto', 'desktop'),
(2729, 143, 0, 'titulo_componente', NULL, 0, '2014-11-12 23:12:06', '', '', 186, 89, 'texto', 'desktop'),
(2730, 143, 0, 'label_1', NULL, 0, '2014-11-12 23:12:16', '', '', 186, 90, 'texto', 'desktop'),
(2731, 143, 0, 'link_1', NULL, 0, '2014-11-12 23:12:16', NULL, '', 186, 90, 'texto', 'desktop'),
(2732, 143, 0, 'titulo_componente', NULL, 0, '2014-11-12 23:12:16', '', '', 186, 90, 'texto', 'desktop'),
(2733, 143, 0, 'label_1', NULL, 0, '2014-11-12 23:12:34', '', '', 186, 91, 'texto', 'desktop'),
(2734, 143, 0, 'link_1', NULL, 0, '2014-11-12 23:12:34', NULL, '', 186, 91, 'texto', 'desktop'),
(2735, 143, 0, 'titulo_componente', NULL, 0, '2014-11-12 23:12:34', '', '', 186, 91, 'texto', 'desktop'),
(2736, 143, 0, 'label_1', NULL, 0, '2014-11-12 23:14:54', '', '', 186, 92, 'texto', 'desktop'),
(2737, 143, 0, 'link_1', NULL, 0, '2014-11-12 23:14:54', NULL, '', 186, 92, 'texto', 'desktop'),
(2738, 143, 0, 'titulo_componente', NULL, 0, '2014-11-12 23:14:54', '', '', 186, 92, 'texto', 'desktop'),
(2739, 143, 0, 'label_1', NULL, 0, '2014-11-12 23:15:16', '', '', 186, 100, 'texto', 'desktop'),
(2740, 143, 0, 'link_1', NULL, 0, '2014-11-12 23:15:16', NULL, '', 186, 100, 'texto', 'desktop'),
(2741, 143, 0, 'titulo_componente', NULL, 0, '2014-11-12 23:15:16', 'Passo - 5', '', 186, 100, 'texto', 'desktop'),
(2742, 143, 0, 'label_1', NULL, 0, '2014-11-12 23:15:25', '', '', 186, 93, 'texto', 'desktop'),
(2743, 143, 0, 'link_1', NULL, 0, '2014-11-12 23:15:25', NULL, '', 186, 93, 'texto', 'desktop'),
(2744, 143, 0, 'titulo_componente', NULL, 0, '2014-11-12 23:15:25', '', '', 186, 93, 'texto', 'desktop'),
(2745, 143, 0, 'label_1', NULL, 0, '2014-11-12 23:15:35', '', '', 186, 94, 'texto', 'desktop'),
(2746, 143, 0, 'link_1', NULL, 0, '2014-11-12 23:15:35', NULL, '', 186, 94, 'texto', 'desktop'),
(2747, 143, 0, 'titulo_componente', NULL, 0, '2014-11-12 23:15:35', '', '', 186, 94, 'texto', 'desktop'),
(2748, 143, 0, 'label_1', NULL, 0, '2014-11-12 23:15:45', '', '', 186, 95, 'texto', 'desktop'),
(2749, 143, 0, 'link_1', NULL, 0, '2014-11-12 23:15:45', NULL, '', 186, 95, 'texto', 'desktop'),
(2750, 143, 0, 'titulo_componente', NULL, 0, '2014-11-12 23:15:45', '', '', 186, 95, 'texto', 'desktop'),
(2751, 143, 0, 'label_1', NULL, 0, '2014-11-12 23:15:54', '', '', 186, 97, 'texto', 'desktop'),
(2752, 143, 0, 'link_1', NULL, 0, '2014-11-12 23:15:54', NULL, '', 186, 97, 'texto', 'desktop'),
(2753, 143, 0, 'titulo_componente', NULL, 0, '2014-11-12 23:15:55', 'Dispara para um usuário', '', 186, 97, 'texto', 'desktop'),
(2754, 143, 0, 'label_1', NULL, 0, '2014-11-12 23:16:04', '', '', 186, 96, 'texto', 'desktop'),
(2755, 143, 0, 'link_1', NULL, 0, '2014-11-12 23:16:04', NULL, '', 186, 96, 'texto', 'desktop'),
(2756, 143, 0, 'titulo_componente', NULL, 0, '2014-11-12 23:16:04', '', '', 186, 96, 'texto', 'desktop'),
(2757, 143, 0, 'label_1', NULL, 0, '2014-11-12 23:16:21', '', '', 186, 98, 'texto', 'desktop'),
(2758, 143, 0, 'link_1', NULL, 0, '2014-11-12 23:16:21', NULL, '', 186, 98, 'texto', 'desktop'),
(2759, 143, 0, 'titulo_componente', NULL, 0, '2014-11-12 23:16:21', '', '', 186, 98, 'texto', 'desktop'),
(2760, 143, 0, 'label_1', NULL, 0, '2014-11-12 23:16:31', '', '', 186, 99, 'texto', 'desktop'),
(2761, 143, 0, 'link_1', NULL, 0, '2014-11-12 23:16:31', NULL, '', 186, 99, 'texto', 'desktop'),
(2762, 143, 0, 'titulo_componente', NULL, 0, '2014-11-12 23:16:31', '', '', 186, 99, 'texto', 'desktop'),
(2763, 148, 0, 'label_1', NULL, 0, '2014-11-12 23:17:14', '', '', 186, 143, 'texto', 'desktop'),
(2764, 148, 0, 'label_1', NULL, 0, '2014-11-12 23:17:21', '', '', 186, 144, 'texto', 'desktop'),
(2765, 149, 0, 'label_1', NULL, 0, '2014-11-12 23:17:56', '', '', 186, 151, 'texto', 'desktop'),
(2766, 152, 0, 'label_1', NULL, 0, '2014-11-12 23:18:35', '', '', 186, 155, 'texto', 'desktop'),
(2767, 142, 0, 'item1_link_1', NULL, 0, '2014-11-12 23:43:29', '', '', 211, 88, 'texto', 'desktop'),
(2768, 142, 0, 'item2_link_1', NULL, 0, '2014-11-12 23:43:29', '', '', 211, 88, 'texto', 'desktop'),
(2769, 142, 0, 'item3_link_1', NULL, 0, '2014-11-12 23:43:29', '', '', 211, 88, 'texto', 'desktop'),
(2770, 142, 0, 'item4_link_1', NULL, 0, '2014-11-12 23:43:29', '', '', 211, 88, 'texto', 'desktop'),
(2771, 136, 0, 'alinhamento_1', NULL, 0, '2014-11-12 23:46:12', 'left', '', 254, 125, 'texto', 'desktop'),
(2772, 136, 0, 'alinhamento_2', NULL, 0, '2014-11-12 23:46:12', 'left', '', 254, 125, 'texto', 'desktop'),
(2773, 136, 0, 'alinhamento_3', NULL, 0, '2014-11-12 23:46:12', 'left', '', 254, 125, 'texto', 'desktop'),
(2774, 136, 0, 'padding_top', 0, 0, '2014-11-12 23:46:12', NULL, '', 254, 125, 'inteiro', 'desktop'),
(2775, 136, 0, 'padding_bottom', 0, 0, '2014-11-12 23:46:12', NULL, '', 254, 125, 'inteiro', 'desktop'),
(2776, 142, 0, 'image_type_1', 1, 0, '2014-11-13 00:00:09', NULL, '', 234, 126, 'inteiro', 'desktop'),
(2777, 142, 0, 'image_1', NULL, 0, '2014-11-13 00:00:09', '', '', 234, 126, 'texto', 'desktop'),
(2778, 142, 0, 'titulo_componente', NULL, 0, '2014-11-13 00:00:09', '', '', 234, 126, 'texto', 'desktop'),
(2779, 142, 0, 'link_1', NULL, 0, '2014-11-13 00:01:25', NULL, '', 207, 72, 'texto', 'desktop'),
(2780, 142, 0, 'layout_1', NULL, 0, '2014-11-13 00:01:25', 'down', '', 207, 72, 'texto', 'desktop'),
(2781, 142, 0, 'titulo_componente', NULL, 0, '2014-11-13 00:01:25', 'Diferentes layouts com imagens, botões, links', '', 207, 72, 'texto', 'desktop'),
(2782, 142, 0, 'link_1', NULL, 0, '2014-11-13 00:02:26', NULL, '', 207, 73, 'texto', 'desktop'),
(2783, 142, 0, 'layout_1', NULL, 0, '2014-11-13 00:02:26', 'up', '', 207, 73, 'texto', 'desktop'),
(2784, 142, 0, 'titulo_componente', NULL, 0, '2014-11-13 00:02:26', 'topo simples', '', 207, 73, 'texto', 'desktop'),
(2785, 142, 0, 'link_1', NULL, 0, '2014-11-13 00:02:58', NULL, '', 207, 76, 'texto', 'desktop'),
(2786, 142, 0, 'layout_1', NULL, 0, '2014-11-13 00:02:58', 'down', '', 207, 76, 'texto', 'desktop'),
(2787, 142, 0, 'titulo_componente', NULL, 0, '2014-11-13 00:02:58', 'Várias formas de você publicar o seu conteúdo', '', 207, 76, 'texto', 'desktop'),
(2788, 142, 0, 'link_1', NULL, 0, '2014-11-13 00:04:03', NULL, '', 207, 74, 'texto', 'desktop'),
(2789, 142, 0, 'layout_1', NULL, 0, '2014-11-13 00:04:03', 'up', '', 207, 74, 'texto', 'desktop'),
(2790, 142, 0, 'titulo_componente', NULL, 0, '2014-11-13 00:04:03', 'topo detalhe', '', 207, 74, 'texto', 'desktop'),
(2791, 142, 0, 'link_1', NULL, 0, '2014-11-13 00:04:59', NULL, '', 207, 75, 'texto', 'desktop'),
(2792, 142, 0, 'layout_1', NULL, 0, '2014-11-13 00:04:59', 'up', '', 207, 75, 'texto', 'desktop'),
(2793, 142, 0, 'titulo_componente', NULL, 0, '2014-11-13 00:04:59', 'topo simples', '', 207, 75, 'texto', 'desktop'),
(2794, 142, 0, 'link_1', NULL, 0, '2014-11-13 00:11:34', NULL, '', 207, 83, 'texto', 'desktop'),
(2795, 142, 0, 'layout_1', NULL, 0, '2014-11-13 00:11:34', 'down', '', 207, 83, 'texto', 'desktop'),
(2796, 142, 0, 'titulo_componente', NULL, 0, '2014-11-13 00:11:34', 'rodape', '', 207, 83, 'texto', 'desktop'),
(2797, 142, 0, 'link_1', NULL, 0, '2014-11-13 00:12:14', NULL, '', 207, 84, 'texto', 'desktop'),
(2798, 142, 0, 'layout_1', NULL, 0, '2014-11-13 00:12:14', 'down', '', 207, 84, 'texto', 'desktop'),
(2799, 142, 0, 'titulo_componente', NULL, 0, '2014-11-13 00:12:14', 'Facebook', '', 207, 84, 'texto', 'desktop'),
(2800, 140, 0, 'link_1', NULL, 0, '2014-11-13 00:14:42', NULL, '', 207, 39, 'texto', 'desktop'),
(2801, 140, 0, 'layout_1', NULL, 0, '2014-11-13 00:14:42', 'down', '', 207, 39, 'texto', 'desktop'),
(2802, 140, 0, 'is_full', 0, 0, '2014-11-13 00:14:42', NULL, '', 207, 39, 'inteiro', 'desktop'),
(2803, 140, 0, 'titulo_componente', NULL, 0, '2014-11-13 00:14:42', '', '', 207, 39, 'texto', 'desktop'),
(2804, 142, 0, 'link_1', NULL, 0, '2014-11-13 00:15:37', NULL, '', 207, 77, 'texto', 'desktop'),
(2805, 142, 0, 'layout_1', NULL, 0, '2014-11-13 00:15:37', 'up', '', 207, 77, 'texto', 'desktop'),
(2806, 142, 0, 'titulo_componente', NULL, 0, '2014-11-13 00:15:37', 'artigo com foto', '', 207, 77, 'texto', 'desktop'),
(2807, 140, 0, 'link_1', NULL, 0, '2014-11-13 00:16:34', NULL, '', 207, 36, 'texto', 'desktop'),
(2808, 140, 0, 'layout_1', NULL, 0, '2014-11-13 00:16:34', 'up', '', 207, 36, 'texto', 'desktop'),
(2809, 140, 0, 'is_full', 0, 0, '2014-11-13 00:16:34', NULL, '', 207, 36, 'inteiro', 'desktop'),
(2810, 140, 0, 'titulo_componente', NULL, 0, '2014-11-13 00:16:34', 'ZAmbe', '', 207, 36, 'texto', 'desktop'),
(2811, 142, 0, 'link_1', NULL, 0, '2014-11-13 00:16:45', NULL, '', 207, 78, 'texto', 'desktop'),
(2812, 142, 0, 'layout_1', NULL, 0, '2014-11-13 00:16:45', 'up', '', 207, 78, 'texto', 'desktop'),
(2813, 142, 0, 'titulo_componente', NULL, 0, '2014-11-13 00:16:46', 'dois produtos', '', 207, 78, 'texto', 'desktop'),
(2814, 140, 0, 'link_1', NULL, 0, '2014-11-13 00:17:13', NULL, '', 207, 52, 'texto', 'desktop'),
(2815, 140, 0, 'layout_1', NULL, 0, '2014-11-13 00:17:13', 'up', '', 207, 52, 'texto', 'desktop'),
(2816, 140, 0, 'is_full', 0, 0, '2014-11-13 00:17:13', NULL, '', 207, 52, 'inteiro', 'desktop'),
(2817, 140, 0, 'titulo_componente', NULL, 0, '2014-11-13 00:17:13', 'PierPlataforma', '', 207, 52, 'texto', 'desktop'),
(2818, 140, 0, 'link_1', NULL, 0, '2014-11-13 00:17:49', NULL, '', 207, 49, 'texto', 'desktop'),
(2819, 140, 0, 'layout_1', NULL, 0, '2014-11-13 00:17:49', 'up', '', 207, 49, 'texto', 'desktop'),
(2820, 140, 0, 'is_full', 0, 0, '2014-11-13 00:17:49', NULL, '', 207, 49, 'inteiro', 'desktop'),
(2821, 140, 0, 'titulo_componente', NULL, 0, '2014-11-13 00:17:49', 'Banca de Revistas', '', 207, 49, 'texto', 'desktop'),
(2822, 142, 0, 'link_1', NULL, 0, '2014-11-13 00:17:52', NULL, '', 207, 79, 'texto', 'desktop'),
(2823, 142, 0, 'layout_1', NULL, 0, '2014-11-13 00:17:52', 'up', '', 207, 79, 'texto', 'desktop'),
(2824, 142, 0, 'titulo_componente', NULL, 0, '2014-11-13 00:17:53', '', '', 207, 79, 'texto', 'desktop'),
(2825, 142, 0, 'link_1', NULL, 0, '2014-11-13 00:18:24', NULL, '', 207, 81, 'texto', 'desktop'),
(2826, 142, 0, 'layout_1', NULL, 0, '2014-11-13 00:18:24', 'down', '', 207, 81, 'texto', 'desktop'),
(2827, 142, 0, 'titulo_componente', NULL, 0, '2014-11-13 00:18:24', 'separadores', '', 207, 81, 'texto', 'desktop'),
(2828, 140, 0, 'link_1', NULL, 0, '2014-11-13 00:18:25', NULL, '', 207, 51, 'texto', 'desktop'),
(2829, 140, 0, 'layout_1', NULL, 0, '2014-11-13 00:18:25', 'up', '', 207, 51, 'texto', 'desktop'),
(2830, 140, 0, 'is_full', 0, 0, '2014-11-13 00:18:25', NULL, '', 207, 51, 'inteiro', 'desktop'),
(2831, 140, 0, 'titulo_componente', NULL, 0, '2014-11-13 00:18:25', 'Produtos Barcelona', '', 207, 51, 'texto', 'desktop'),
(2832, 140, 0, 'link_1', NULL, 0, '2014-11-13 00:19:15', NULL, '', 207, 50, 'texto', 'desktop'),
(2833, 140, 0, 'layout_1', NULL, 0, '2014-11-13 00:19:15', 'up', '', 207, 50, 'texto', 'desktop'),
(2834, 140, 0, 'is_full', 0, 0, '2014-11-13 00:19:15', NULL, '', 207, 50, 'inteiro', 'desktop'),
(2835, 140, 0, 'titulo_componente', NULL, 0, '2014-11-13 00:19:15', 'Usuários Rotativos', '', 207, 50, 'texto', 'desktop'),
(2836, 140, 0, 'link_1', NULL, 0, '2014-11-13 00:24:20', NULL, '', 207, 48, 'texto', 'desktop'),
(2837, 140, 0, 'layout_1', NULL, 0, '2014-11-13 00:24:20', 'up', '', 207, 48, 'texto', 'desktop'),
(2838, 140, 0, 'is_full', 0, 0, '2014-11-13 00:24:20', NULL, '', 207, 48, 'inteiro', 'desktop'),
(2839, 140, 0, 'titulo_componente', NULL, 0, '2014-11-13 00:24:20', 'Tarjenta', '', 207, 48, 'texto', 'desktop'),
(2840, 140, 0, 'link_1', NULL, 0, '2014-11-13 00:24:52', NULL, '', 207, 47, 'texto', 'desktop'),
(2841, 140, 0, 'layout_1', NULL, 0, '2014-11-13 00:24:52', 'up', '', 207, 47, 'texto', 'desktop'),
(2842, 140, 0, 'is_full', 0, 0, '2014-11-13 00:24:53', NULL, '', 207, 47, 'inteiro', 'desktop'),
(2843, 140, 0, 'titulo_componente', NULL, 0, '2014-11-13 00:24:53', 'Outdoor Rotativo', '', 207, 47, 'texto', 'desktop'),
(2844, 142, 0, 'link_1', NULL, 0, '2014-11-13 00:25:55', NULL, '', 207, 82, 'texto', 'desktop'),
(2845, 142, 0, 'layout_1', NULL, 0, '2014-11-13 00:25:55', 'up', '', 207, 82, 'texto', 'desktop'),
(2846, 142, 0, 'titulo_componente', NULL, 0, '2014-11-13 00:25:55', 'oklahoma', '', 207, 82, 'texto', 'desktop'),
(2847, 140, 0, 'link_1', NULL, 0, '2014-11-13 00:26:04', NULL, '', 207, 46, 'texto', 'desktop'),
(2848, 140, 0, 'layout_1', NULL, 0, '2014-11-13 00:26:04', 'up', '', 207, 46, 'texto', 'desktop'),
(2849, 140, 0, 'is_full', 0, 0, '2014-11-13 00:26:04', NULL, '', 207, 46, 'inteiro', 'desktop'),
(2850, 140, 0, 'titulo_componente', NULL, 0, '2014-11-13 00:26:04', 'NewsLetter Easy', '', 207, 46, 'texto', 'desktop'),
(2851, 140, 0, 'link_1', NULL, 0, '2014-11-13 00:27:05', NULL, '', 207, 45, 'texto', 'desktop'),
(2852, 140, 0, 'layout_1', NULL, 0, '2014-11-13 00:27:05', 'up', '', 207, 45, 'texto', 'desktop'),
(2853, 140, 0, 'is_full', 0, 0, '2014-11-13 00:27:05', NULL, '', 207, 45, 'inteiro', 'desktop'),
(2854, 140, 0, 'titulo_componente', NULL, 0, '2014-11-13 00:27:05', 'Mural Notícias', '', 207, 45, 'texto', 'desktop'),
(2855, 140, 0, 'link_1', NULL, 0, '2014-11-13 00:27:37', NULL, '', 207, 35, 'texto', 'desktop'),
(2856, 140, 0, 'layout_1', NULL, 0, '2014-11-13 00:27:37', 'up', '', 207, 35, 'texto', 'desktop'),
(2857, 140, 0, 'is_full', 0, 0, '2014-11-13 00:27:37', NULL, '', 207, 35, 'inteiro', 'desktop'),
(2858, 140, 0, 'titulo_componente', NULL, 0, '2014-11-13 00:27:37', 'Massachussets Artigo', '', 207, 35, 'texto', 'desktop'),
(2859, 142, 0, 'titulo_1', NULL, 0, '2014-11-13 00:28:13', NULL, '', 207, 168, 'texto', 'desktop'),
(2860, 142, 0, 'subtitulo_1', NULL, 0, '2014-11-13 00:28:13', NULL, '', 207, 168, 'texto', 'desktop'),
(2861, 142, 0, 'texto_1', NULL, 0, '2014-11-13 00:28:13', NULL, '', 207, 168, 'texto', 'desktop'),
(2862, 142, 0, 'link_1', NULL, 0, '2014-11-13 00:28:13', NULL, '', 207, 168, 'texto', 'desktop'),
(2863, 142, 0, 'image_1', NULL, 0, '2014-11-13 00:28:13', 'artigo_washington_j2.png', '', 207, 168, 'texto', 'desktop'),
(2864, 142, 0, 'layout_1', NULL, 0, '2014-11-13 00:28:13', 'up', '', 207, 168, 'texto', 'desktop'),
(2865, 142, 0, 'cor_1', NULL, 0, '2014-11-13 00:28:13', '', '', 207, 168, 'texto', 'desktop'),
(2866, 142, 0, 'cor_2', NULL, 0, '2014-11-13 00:28:13', '', '', 207, 168, 'texto', 'desktop'),
(2867, 142, 0, 'cor_3', NULL, 0, '2014-11-13 00:28:13', '', '', 207, 168, 'texto', 'desktop'),
(2868, 142, 0, 'alinhamento_1', NULL, 0, '2014-11-13 00:28:13', 'left', '', 207, 168, 'texto', 'desktop'),
(2869, 142, 0, 'alinhamento_2', NULL, 0, '2014-11-13 00:28:13', 'left', '', 207, 168, 'texto', 'desktop'),
(2870, 142, 0, 'alinhamento_3', NULL, 0, '2014-11-13 00:28:13', 'left', '', 207, 168, 'texto', 'desktop'),
(2871, 142, 0, 'margin_top', 0, 0, '2014-11-13 00:28:13', NULL, '', 207, 168, 'inteiro', 'desktop'),
(2872, 142, 0, 'margin_bottom', 0, 0, '2014-11-13 00:28:13', NULL, '', 207, 168, 'inteiro', 'desktop'),
(2873, 142, 0, 'padding_top', 0, 0, '2014-11-13 00:28:13', NULL, '', 207, 168, 'inteiro', 'desktop'),
(2874, 142, 0, 'padding_bottom', 0, 0, '2014-11-13 00:28:13', NULL, '', 207, 168, 'inteiro', 'desktop'),
(2875, 142, 0, 'is_full', 0, 0, '2014-11-13 00:28:13', NULL, '', 207, 168, 'inteiro', 'desktop'),
(2876, 142, 0, 'titulo_componente', NULL, 0, '2014-11-13 00:28:13', 'artigo washington', '', 207, 168, 'texto', 'desktop'),
(2877, 142, 0, 'background_type', 0, 0, '2014-11-13 00:28:13', NULL, '', 207, 168, 'inteiro', 'desktop'),
(2878, 142, 0, 'background', NULL, 0, '2014-11-13 00:28:13', '', '', 207, 168, 'texto', 'desktop'),
(2879, 140, 0, 'link_1', NULL, 0, '2014-11-13 00:28:22', NULL, '', 207, 40, 'texto', 'desktop'),
(2880, 140, 0, 'layout_1', NULL, 0, '2014-11-13 00:28:22', 'up', '', 207, 40, 'texto', 'desktop'),
(2881, 140, 0, 'is_full', 0, 0, '2014-11-13 00:28:22', NULL, '', 207, 40, 'inteiro', 'desktop'),
(2882, 140, 0, 'titulo_componente', NULL, 0, '2014-11-13 00:28:22', 'Lampejo', '', 207, 40, 'texto', 'desktop'),
(2883, 140, 0, 'link_1', NULL, 0, '2014-11-13 00:28:43', NULL, '', 207, 38, 'texto', 'desktop'),
(2884, 140, 0, 'layout_1', NULL, 0, '2014-11-13 00:28:43', 'up', '', 207, 38, 'texto', 'desktop'),
(2885, 140, 0, 'is_full', 0, 0, '2014-11-13 00:28:43', NULL, '', 207, 38, 'inteiro', 'desktop'),
(2886, 140, 0, 'titulo_componente', NULL, 0, '2014-11-13 00:28:43', 'Colorado', '', 207, 38, 'texto', 'desktop'),
(2887, 140, 0, 'link_1', NULL, 0, '2014-11-13 00:29:12', NULL, '', 207, 60, 'texto', 'desktop'),
(2888, 140, 0, 'layout_1', NULL, 0, '2014-11-13 00:29:12', 'up', '', 207, 60, 'texto', 'desktop'),
(2889, 140, 0, 'is_full', 0, 0, '2014-11-13 00:29:12', NULL, '', 207, 60, 'inteiro', 'desktop'),
(2890, 140, 0, 'titulo_componente', NULL, 0, '2014-11-13 00:29:12', 'NY Artigo', '', 207, 60, 'texto', 'desktop'),
(2891, 140, 0, 'link_1', NULL, 0, '2014-11-13 00:29:52', NULL, '', 207, 37, 'texto', 'desktop'),
(2892, 140, 0, 'layout_1', NULL, 0, '2014-11-13 00:29:52', 'down', '', 207, 37, 'texto', 'desktop'),
(2893, 140, 0, 'is_full', 0, 0, '2014-11-13 00:29:52', NULL, '', 207, 37, 'inteiro', 'desktop'),
(2894, 140, 0, 'titulo_componente', NULL, 0, '2014-11-13 00:29:52', 'Banner Bilboard', '', 207, 37, 'texto', 'desktop'),
(2895, 140, 0, 'link_1', NULL, 0, '2014-11-13 00:30:21', NULL, '', 207, 61, 'texto', 'desktop'),
(2896, 140, 0, 'layout_1', NULL, 0, '2014-11-13 00:30:21', 'up', '', 207, 61, 'texto', 'desktop'),
(2897, 140, 0, 'is_full', 0, 0, '2014-11-13 00:30:21', NULL, '', 207, 61, 'inteiro', 'desktop'),
(2898, 140, 0, 'titulo_componente', NULL, 0, '2014-11-13 00:30:21', 'NewOrleans', '', 207, 61, 'texto', 'desktop'),
(2899, 140, 0, 'link_1', NULL, 0, '2014-11-13 00:31:00', NULL, '', 207, 69, 'texto', 'desktop'),
(2900, 140, 0, 'layout_1', NULL, 0, '2014-11-13 00:31:00', 'up', '', 207, 69, 'texto', 'desktop'),
(2901, 140, 0, 'is_full', 0, 0, '2014-11-13 00:31:00', NULL, '', 207, 69, 'inteiro', 'desktop'),
(2902, 140, 0, 'titulo_componente', NULL, 0, '2014-11-13 00:31:00', 'E-mail SuperNova', '', 207, 69, 'texto', 'desktop'),
(2903, 140, 0, 'link_1', NULL, 0, '2014-11-13 00:31:42', NULL, '', 207, 68, 'texto', 'desktop'),
(2904, 140, 0, 'layout_1', NULL, 0, '2014-11-13 00:31:42', 'up', '', 207, 68, 'texto', 'desktop'),
(2905, 140, 0, 'is_full', 0, 0, '2014-11-13 00:31:42', NULL, '', 207, 68, 'inteiro', 'desktop'),
(2906, 140, 0, 'titulo_componente', NULL, 0, '2014-11-13 00:31:42', 'E-mail Topod detalhe', '', 207, 68, 'texto', 'desktop'),
(2907, 140, 0, 'link_1', NULL, 0, '2014-11-13 00:32:17', NULL, '', 207, 67, 'texto', 'desktop'),
(2908, 140, 0, 'layout_1', NULL, 0, '2014-11-13 00:32:17', 'up', '', 207, 67, 'texto', 'desktop'),
(2909, 140, 0, 'is_full', 0, 0, '2014-11-13 00:32:17', NULL, '', 207, 67, 'inteiro', 'desktop'),
(2910, 140, 0, 'titulo_componente', NULL, 0, '2014-11-13 00:32:17', 'E-mail Produto Venezza', '', 207, 67, 'texto', 'desktop'),
(2911, 140, 0, 'link_1', NULL, 0, '2014-11-13 00:32:43', NULL, '', 207, 66, 'texto', 'desktop'),
(2912, 140, 0, 'layout_1', NULL, 0, '2014-11-13 00:32:43', 'up', '', 207, 66, 'texto', 'desktop'),
(2913, 140, 0, 'is_full', 0, 0, '2014-11-13 00:32:43', NULL, '', 207, 66, 'inteiro', 'desktop'),
(2914, 140, 0, 'titulo_componente', NULL, 0, '2014-11-13 00:32:43', 'E-mail Separadores', '', 207, 66, 'texto', 'desktop'),
(2915, 140, 0, 'link_1', NULL, 0, '2014-11-13 00:33:16', NULL, '', 207, 65, 'texto', 'desktop'),
(2916, 140, 0, 'layout_1', NULL, 0, '2014-11-13 00:33:16', 'up', '', 207, 65, 'texto', 'desktop'),
(2917, 140, 0, 'is_full', 0, 0, '2014-11-13 00:33:16', NULL, '', 207, 65, 'inteiro', 'desktop'),
(2918, 140, 0, 'titulo_componente', NULL, 0, '2014-11-13 00:33:16', 'E-mail Rodapé Simples', '', 207, 65, 'texto', 'desktop'),
(2919, 140, 0, 'link_1', NULL, 0, '2014-11-13 00:33:51', NULL, '', 207, 64, 'texto', 'desktop'),
(2920, 140, 0, 'layout_1', NULL, 0, '2014-11-13 00:33:51', 'up', '', 207, 64, 'texto', 'desktop'),
(2921, 140, 0, 'is_full', 0, 0, '2014-11-13 00:33:51', NULL, '', 207, 64, 'inteiro', 'desktop'),
(2922, 140, 0, 'titulo_componente', NULL, 0, '2014-11-13 00:33:51', 'E-mail Topo Simples', '', 207, 64, 'texto', 'desktop'),
(2923, 140, 0, 'link_1', NULL, 0, '2014-11-13 00:34:18', NULL, '', 207, 63, 'texto', 'desktop'),
(2924, 140, 0, 'layout_1', NULL, 0, '2014-11-13 00:34:18', 'up', '', 207, 63, 'texto', 'desktop'),
(2925, 140, 0, 'is_full', 0, 0, '2014-11-13 00:34:18', NULL, '', 207, 63, 'inteiro', 'desktop'),
(2926, 140, 0, 'titulo_componente', NULL, 0, '2014-11-13 00:34:18', 'E-mail Topo Tarja', '', 207, 63, 'texto', 'desktop'),
(2927, 156, 0, 'titulo_1', NULL, 0, '2014-11-13 15:16:05', NULL, 'O que são as páginas avançadas?', 186, 169, 'texto', 'desktop'),
(2928, 156, 0, 'subtitulo_1', NULL, 0, '2014-11-13 15:16:06', NULL, 'Uma infinidade de opções para criar, editar e mudar seu site', 186, 169, 'texto', 'desktop'),
(2929, 156, 0, 'texto_1', NULL, 0, '2014-11-13 15:16:06', NULL, 'As páginas avançadas são a nova maravilha do PurplePier, como ela você pode usar dos componentes para enriquecer suas páginas e criar conteúdos do jeito que você sempre sonhou.\r\n\r\nAs páginas avançadas utilizam componentes que utilizam de conteúdos dinâmicos para exibir toda informação que você deseja.\r\n\r\nVocê pode criar uma página com várias imagens e textos e adicionar cores aos seus textos, fotos do tamanho que desejar e se não quiser exibir um conteúdo em um terminado periodo pode optar por oculta-lo, sem a necessidade de apagar, ele está salvo mais não será exibido.\r\n\r\n', 186, 169, 'texto', 'desktop'),
(2930, 156, 0, 'label_1', NULL, 0, '2014-11-13 15:16:06', '', '', 186, 169, 'texto', 'desktop'),
(2931, 156, 0, 'link_1', NULL, 0, '2014-11-13 15:16:06', NULL, '', 186, 169, 'texto', 'desktop'),
(2932, 156, 0, 'image_1', NULL, 0, '2014-11-13 15:16:06', '', '', 186, 169, 'texto', 'desktop'),
(2933, 156, 0, 'layout_1', NULL, 0, '2014-11-13 15:16:06', 'left', '', 186, 169, 'texto', 'desktop'),
(2934, 156, 0, 'cor_1', NULL, 0, '2014-11-13 15:16:06', '', '', 186, 169, 'texto', 'desktop'),
(2935, 156, 0, 'cor_2', NULL, 0, '2014-11-13 15:16:06', '', '', 186, 169, 'texto', 'desktop'),
(2936, 156, 0, 'cor_3', NULL, 0, '2014-11-13 15:16:06', '', '', 186, 169, 'texto', 'desktop'),
(2937, 156, 0, 'alinhamento_1', NULL, 0, '2014-11-13 15:16:06', 'left', '', 186, 169, 'texto', 'desktop'),
(2938, 156, 0, 'alinhamento_2', NULL, 0, '2014-11-13 15:16:06', 'left', '', 186, 169, 'texto', 'desktop'),
(2939, 156, 0, 'alinhamento_3', NULL, 0, '2014-11-13 15:16:06', 'left', '', 186, 169, 'texto', 'desktop'),
(2940, 156, 0, 'margin_top', 0, 0, '2014-11-13 15:16:06', NULL, '', 186, 169, 'inteiro', 'desktop'),
(2941, 156, 0, 'margin_bottom', 0, 0, '2014-11-13 15:16:06', NULL, '', 186, 169, 'inteiro', 'desktop'),
(2942, 156, 0, 'padding_top', 0, 0, '2014-11-13 15:16:06', NULL, '', 186, 169, 'inteiro', 'desktop'),
(2943, 156, 0, 'padding_bottom', 0, 0, '2014-11-13 15:16:06', NULL, '', 186, 169, 'inteiro', 'desktop'),
(2944, 156, 0, 'is_full', 0, 0, '2014-11-13 15:16:06', NULL, '', 186, 169, 'inteiro', 'desktop'),
(2945, 156, 0, 'titulo_componente', NULL, 0, '2014-11-13 15:16:06', 'Passo -1 ', '', 186, 169, 'texto', 'desktop'),
(2946, 156, 0, 'background_type', 0, 0, '2014-11-13 15:16:06', NULL, '', 186, 169, 'inteiro', 'desktop'),
(2947, 156, 0, 'background', NULL, 0, '2014-11-13 15:16:06', '', '', 186, 169, 'texto', 'desktop'),
(2948, 145, 0, 'titulo_1', NULL, 0, '2014-11-13 15:18:56', NULL, 'Dicas para Criar/Editar as Páginas Avançadas', 186, 170, 'texto', 'desktop'),
(2949, 145, 0, 'subtitulo_1', NULL, 0, '2014-11-13 15:18:56', NULL, '', 186, 170, 'texto', 'desktop'),
(2950, 145, 0, 'texto_1', NULL, 0, '2014-11-13 15:18:57', NULL, 'As páginas avançadas é a forma mais dinâmica e criativa de exibir seu conteúdo, leia as dicas e aprenda como funciona', 186, 170, 'texto', 'desktop'),
(2951, 145, 0, 'label_1', NULL, 0, '2014-11-13 15:18:57', 'Dicas páginas avançada', '', 186, 170, 'texto', 'desktop'),
(2952, 145, 0, 'link_1', NULL, 0, '2014-11-13 15:18:57', NULL, '/dicas_paginas_avancadas', 186, 170, 'texto', 'desktop'),
(2953, 145, 0, 'image_1', NULL, 0, '2014-11-13 15:18:58', '', '', 186, 170, 'texto', 'desktop'),
(2954, 145, 0, 'layout_1', NULL, 0, '2014-11-13 15:18:58', 'left', '', 186, 170, 'texto', 'desktop'),
(2955, 145, 0, 'cor_1', NULL, 0, '2014-11-13 15:18:58', '', '', 186, 170, 'texto', 'desktop'),
(2956, 145, 0, 'cor_2', NULL, 0, '2014-11-13 15:18:58', '', '', 186, 170, 'texto', 'desktop'),
(2957, 145, 0, 'cor_3', NULL, 0, '2014-11-13 15:18:58', '', '', 186, 170, 'texto', 'desktop'),
(2958, 145, 0, 'alinhamento_1', NULL, 0, '2014-11-13 15:18:59', 'left', '', 186, 170, 'texto', 'desktop'),
(2959, 145, 0, 'alinhamento_2', NULL, 0, '2014-11-13 15:18:59', 'left', '', 186, 170, 'texto', 'desktop'),
(2960, 145, 0, 'alinhamento_3', NULL, 0, '2014-11-13 15:18:59', 'left', '', 186, 170, 'texto', 'desktop'),
(2961, 145, 0, 'margin_top', 0, 0, '2014-11-13 15:18:59', NULL, '', 186, 170, 'inteiro', 'desktop'),
(2962, 145, 0, 'margin_bottom', 0, 0, '2014-11-13 15:19:00', NULL, '', 186, 170, 'inteiro', 'desktop'),
(2963, 145, 0, 'padding_top', 0, 0, '2014-11-13 15:19:00', NULL, '', 186, 170, 'inteiro', 'desktop'),
(2964, 145, 0, 'padding_bottom', 0, 0, '2014-11-13 15:19:00', NULL, '', 186, 170, 'inteiro', 'desktop'),
(2965, 145, 0, 'is_full', 0, 0, '2014-11-13 15:19:00', NULL, '', 186, 170, 'inteiro', 'desktop'),
(2966, 145, 0, 'titulo_componente', NULL, 0, '2014-11-13 15:19:00', 'Dicas Páginas Avançadas', '', 186, 170, 'texto', 'desktop'),
(2967, 145, 0, 'background_type', 0, 0, '2014-11-13 15:19:01', NULL, '', 186, 170, 'inteiro', 'desktop'),
(2968, 145, 0, 'background', NULL, 0, '2014-11-13 15:19:01', '', '', 186, 170, 'texto', 'desktop'),
(2969, 156, 0, 'titulo_1', NULL, 0, '2014-11-13 15:26:55', NULL, 'Como começar a criar páginas avançadas', 186, 171, 'texto', 'desktop'),
(2970, 156, 0, 'subtitulo_1', NULL, 0, '2014-11-13 15:26:55', NULL, 'Caso não tenha instalado o Páginas Avançadas ou não possua a PierPlataforma você deve faze-lô', 186, 171, 'texto', 'desktop'),
(2971, 156, 0, 'texto_1', NULL, 0, '2014-11-13 15:26:55', NULL, 'As páginas avançadas só funcionam corretamente na nova plataforma, PierPlataforma.\r\nAs páginas avançadas são páginas, comuns que foram trocadas através do combobox TIPO de Comum para Avançada.\r\nEsse combobox só será exibido caso você tenha instala-do o Páginas Avançadas e possuo o PierPlataforma.\r\n\r\nCrie uma nova página e troque o TIPO de comum para avançada.\r\nA página será recarregada e uma opção de aplicar será exibido na tela.\r\n\r\nAdicione primeiramente o nome da sua página. \r\nSalve!\r\nAgora clique em listar e encontre a página que acabou de criar, clique em editar.\r\nPronto agora você pode adicionar quantos componentes quiser e manuseá-los da forma que desejar', 186, 171, 'texto', 'desktop'),
(2972, 156, 0, 'label_1', NULL, 0, '2014-11-13 15:26:55', '', '', 186, 171, 'texto', 'desktop'),
(2973, 156, 0, 'link_1', NULL, 0, '2014-11-13 15:26:55', NULL, '', 186, 171, 'texto', 'desktop'),
(2974, 156, 0, 'image_1', NULL, 0, '2014-11-13 15:26:55', '', '', 186, 171, 'texto', 'desktop'),
(2975, 156, 0, 'layout_1', NULL, 0, '2014-11-13 15:26:55', 'left', '', 186, 171, 'texto', 'desktop'),
(2976, 156, 0, 'cor_1', NULL, 0, '2014-11-13 15:26:55', '', '', 186, 171, 'texto', 'desktop'),
(2977, 156, 0, 'cor_2', NULL, 0, '2014-11-13 15:26:55', '', '', 186, 171, 'texto', 'desktop'),
(2978, 156, 0, 'cor_3', NULL, 0, '2014-11-13 15:26:55', '', '', 186, 171, 'texto', 'desktop'),
(2979, 156, 0, 'alinhamento_1', NULL, 0, '2014-11-13 15:26:56', 'left', '', 186, 171, 'texto', 'desktop'),
(2980, 156, 0, 'alinhamento_2', NULL, 0, '2014-11-13 15:26:56', 'left', '', 186, 171, 'texto', 'desktop'),
(2981, 156, 0, 'alinhamento_3', NULL, 0, '2014-11-13 15:26:56', 'left', '', 186, 171, 'texto', 'desktop'),
(2982, 156, 0, 'margin_top', 0, 0, '2014-11-13 15:26:56', NULL, '', 186, 171, 'inteiro', 'desktop'),
(2983, 156, 0, 'margin_bottom', 0, 0, '2014-11-13 15:26:56', NULL, '', 186, 171, 'inteiro', 'desktop'),
(2984, 156, 0, 'padding_top', 0, 0, '2014-11-13 15:26:56', NULL, '', 186, 171, 'inteiro', 'desktop'),
(2985, 156, 0, 'padding_bottom', 0, 0, '2014-11-13 15:26:56', NULL, '', 186, 171, 'inteiro', 'desktop'),
(2986, 156, 0, 'is_full', 0, 0, '2014-11-13 15:26:56', NULL, '', 186, 171, 'inteiro', 'desktop'),
(2987, 156, 0, 'titulo_componente', NULL, 0, '2014-11-13 15:26:57', 'Passo - 2 - Inicie criando uma página', '', 186, 171, 'texto', 'desktop'),
(2988, 156, 0, 'background_type', 0, 0, '2014-11-13 15:26:57', NULL, '', 186, 171, 'inteiro', 'desktop'),
(2989, 156, 0, 'background', NULL, 0, '2014-11-13 15:26:57', '', '', 186, 171, 'texto', 'desktop'),
(2990, 137, 0, 'margin_top', 15, 0, '2014-11-13 23:40:23', NULL, '', 206, 14, 'inteiro', 'desktop'),
(2991, 137, 0, 'margin_bottom', 15, 0, '2014-11-13 23:40:23', NULL, '', 206, 14, 'inteiro', 'desktop'),
(2992, 137, 0, 'padding_top', 0, 0, '2014-11-13 23:40:23', NULL, '', 206, 14, 'inteiro', 'desktop'),
(2993, 137, 0, 'padding_bottom', 0, 0, '2014-11-13 23:40:23', NULL, '', 206, 14, 'inteiro', 'desktop'),
(2994, 137, 0, 'is_full', 0, 0, '2014-11-13 23:40:23', NULL, '', 206, 14, 'inteiro', 'desktop'),
(2995, 137, 0, 'titulo_componente', NULL, 0, '2014-11-13 23:40:23', '', '', 206, 14, 'texto', 'desktop'),
(2996, 137, 0, 'background_type', 0, 0, '2014-11-13 23:40:23', NULL, '', 206, 14, 'inteiro', 'desktop'),
(2997, 137, 0, 'background', NULL, 0, '2014-11-13 23:40:23', '', '', 206, 14, 'texto', 'desktop'),
(2998, 147, 0, 'label_1', NULL, 0, '2014-11-13 23:51:53', '', '', 186, 141, 'texto', 'desktop'),
(2999, 157, 0, 'titulo_1', NULL, 0, '2014-11-17 14:33:22', NULL, 'O que são os banners?', 186, 172, 'texto', 'desktop'),
(3000, 157, 0, 'subtitulo_1', NULL, 0, '2014-11-17 14:33:22', NULL, 'Os banners são containers que carregam imagens, links, título e descrição', 186, 172, 'texto', 'desktop'),
(3001, 157, 0, 'texto_1', NULL, 0, '2014-11-17 14:33:22', NULL, 'O banners são containeres que aceitam, uma ou mais imagens e podem ter links, ter créditos, palavras-chaves, tamanhos específicos e propriedades peculizares para serem exibidos ou não.\r\nEles ainda podem ter título e descrição e podem ter vários tamanhos como: 200px, 250px 350px, 450px, 720px, 980px e 1170px', 186, 172, 'texto', 'desktop'),
(3002, 157, 0, 'label_1', NULL, 0, '2014-11-17 14:33:22', '', '', 186, 172, 'texto', 'desktop'),
(3003, 157, 0, 'link_1', NULL, 0, '2014-11-17 14:33:22', NULL, '', 186, 172, 'texto', 'desktop'),
(3004, 157, 0, 'image_1', NULL, 0, '2014-11-17 14:33:22', '', '', 186, 172, 'texto', 'desktop'),
(3005, 157, 0, 'layout_1', NULL, 0, '2014-11-17 14:33:22', 'left', '', 186, 172, 'texto', 'desktop'),
(3006, 157, 0, 'cor_1', NULL, 0, '2014-11-17 14:33:22', '', '', 186, 172, 'texto', 'desktop'),
(3007, 157, 0, 'cor_2', NULL, 0, '2014-11-17 14:33:22', '', '', 186, 172, 'texto', 'desktop'),
(3008, 157, 0, 'cor_3', NULL, 0, '2014-11-17 14:33:22', '', '', 186, 172, 'texto', 'desktop'),
(3009, 157, 0, 'alinhamento_1', NULL, 0, '2014-11-17 14:33:22', 'left', '', 186, 172, 'texto', 'desktop'),
(3010, 157, 0, 'alinhamento_2', NULL, 0, '2014-11-17 14:33:22', 'left', '', 186, 172, 'texto', 'desktop'),
(3011, 157, 0, 'alinhamento_3', NULL, 0, '2014-11-17 14:33:22', 'left', '', 186, 172, 'texto', 'desktop'),
(3012, 157, 0, 'margin_top', 0, 0, '2014-11-17 14:33:22', NULL, '', 186, 172, 'inteiro', 'desktop'),
(3013, 157, 0, 'margin_bottom', 0, 0, '2014-11-17 14:33:22', NULL, '', 186, 172, 'inteiro', 'desktop'),
(3014, 157, 0, 'padding_top', 0, 0, '2014-11-17 14:33:22', NULL, '', 186, 172, 'inteiro', 'desktop'),
(3015, 157, 0, 'padding_bottom', 0, 0, '2014-11-17 14:33:22', NULL, '', 186, 172, 'inteiro', 'desktop'),
(3016, 157, 0, 'is_full', 0, 0, '2014-11-17 14:33:22', NULL, '', 186, 172, 'inteiro', 'desktop'),
(3017, 157, 0, 'titulo_componente', NULL, 0, '2014-11-17 14:33:22', 'Passo - 1', '', 186, 172, 'texto', 'desktop');
INSERT INTO `paginas_attribute` (`id`, `id_pagina`, `user_id`, `name`, `inteiro`, `number`, `estampa`, `texto`, `descricao`, `id_componente`, `id_row`, `tipo`, `plataforma`) VALUES
(3018, 157, 0, 'background_type', 0, 0, '2014-11-17 14:33:22', NULL, '', 186, 172, 'inteiro', 'desktop'),
(3019, 157, 0, 'background', NULL, 0, '2014-11-17 14:33:22', '', '', 186, 172, 'texto', 'desktop'),
(3020, 157, 0, 'titulo_1', NULL, 0, '2014-11-17 14:38:09', NULL, 'Para que servem os banners', 186, 173, 'texto', 'desktop'),
(3021, 157, 0, 'subtitulo_1', NULL, 0, '2014-11-17 14:38:09', NULL, 'São ideais para exibir publicidade de produtos, serviços, parceiros, promoções e etc', 186, 173, 'texto', 'desktop'),
(3022, 157, 0, 'texto_1', NULL, 0, '2014-11-17 14:38:09', NULL, 'Essa publicidade pode ser: Publicidade Online e Publicidade\r\nA diferença é o meio de exibi-la:\r\nA <b>publicidade online</b> é a exibição de banners utilizando créditos, \r\nA <b>publicidade dirigida</b> é a exibição de banners em uma determinada página\r\n\r\nA publicidade online utiliza-se de créditos, palavras-chaves, lance e valor máximo por dia.\r\nPara criar publicidades on-line você deve criar o banner e adicionar créditos a ele, o valor do lance, onde os valores maiores terão maior chance de serem exibidos e o valor máximo por dia.\r\nAs publicidades online são exibidas de acordo com as palavras chaves sorteadas no acesso do usuário. De acordo com as palavras chaves um lote de banners serão selecionados e a ordem é o lance desses.\r\nNO caso o lance de um banner seja R$0.10 centavos cada vez que esse banner for selecionado para ser exibido esse valor é creditado no valor máximo por dia que ele possui. Quanto esse valor máximo for atingido ele não entrará mais nos lotes do dia corrente. A cada noite uma rotina zera todos os valores máximos e esse começam a entrar novamente nos lotes de banners até o valor máximo ser atingido novamente. Quando os créditos destes se esgotarem ele não serão mais exibidos.\r\n\r\nA publicidade dirigida é mais simples, onde os banners são selecionados para serem exibidos em uma determinada página. Na listagem de banners do lado esquerdo existe um botão de um megafone. Ao clica-lo um popup será exibido com a listagem de todas as páginas de seu site. \r\nSão exibidos um checkbox e um campo de texto. O checkbox é para dizer que aquele banner deve ser exibido naquela página e o campo de texto é para informar qual o índice que o banner deve ser exibido. Como o nome mesmo diz, publicidade dirigida você talvez queira que um banner apareça antes de um outro, ou entre dois diferentes, então você pode utilizar estes campos para dizer a ordem que esse deve ser exibido.\r\n', 186, 173, 'texto', 'desktop'),
(3023, 157, 0, 'label_1', NULL, 0, '2014-11-17 14:38:09', '', '', 186, 173, 'texto', 'desktop'),
(3024, 157, 0, 'link_1', NULL, 0, '2014-11-17 14:38:09', NULL, '', 186, 173, 'texto', 'desktop'),
(3025, 157, 0, 'image_1', NULL, 0, '2014-11-17 14:38:09', '', '', 186, 173, 'texto', 'desktop'),
(3026, 157, 0, 'layout_1', NULL, 0, '2014-11-17 14:38:09', 'left', '', 186, 173, 'texto', 'desktop'),
(3027, 157, 0, 'cor_1', NULL, 0, '2014-11-17 14:38:09', '', '', 186, 173, 'texto', 'desktop'),
(3028, 157, 0, 'cor_2', NULL, 0, '2014-11-17 14:38:09', '', '', 186, 173, 'texto', 'desktop'),
(3029, 157, 0, 'cor_3', NULL, 0, '2014-11-17 14:38:09', '', '', 186, 173, 'texto', 'desktop'),
(3030, 157, 0, 'alinhamento_1', NULL, 0, '2014-11-17 14:38:09', 'left', '', 186, 173, 'texto', 'desktop'),
(3031, 157, 0, 'alinhamento_2', NULL, 0, '2014-11-17 14:38:09', 'left', '', 186, 173, 'texto', 'desktop'),
(3032, 157, 0, 'alinhamento_3', NULL, 0, '2014-11-17 14:38:09', 'left', '', 186, 173, 'texto', 'desktop'),
(3033, 157, 0, 'margin_top', 0, 0, '2014-11-17 14:38:09', NULL, '', 186, 173, 'inteiro', 'desktop'),
(3034, 157, 0, 'margin_bottom', 0, 0, '2014-11-17 14:38:09', NULL, '', 186, 173, 'inteiro', 'desktop'),
(3035, 157, 0, 'padding_top', 0, 0, '2014-11-17 14:38:09', NULL, '', 186, 173, 'inteiro', 'desktop'),
(3036, 157, 0, 'padding_bottom', 0, 0, '2014-11-17 14:38:09', NULL, '', 186, 173, 'inteiro', 'desktop'),
(3037, 157, 0, 'is_full', 0, 0, '2014-11-17 14:38:09', NULL, '', 186, 173, 'inteiro', 'desktop'),
(3038, 157, 0, 'titulo_componente', NULL, 0, '2014-11-17 14:38:09', 'Passo - 2', '', 186, 173, 'texto', 'desktop'),
(3039, 157, 0, 'background_type', 0, 0, '2014-11-17 14:38:09', NULL, '', 186, 173, 'inteiro', 'desktop'),
(3040, 157, 0, 'background', NULL, 0, '2014-11-17 14:38:09', '', '', 186, 173, 'texto', 'desktop'),
(3041, 145, 0, 'titulo_1', NULL, 0, '2014-11-17 14:40:42', NULL, 'Veja dicas do que são os banners e como usuá-los', 186, 175, 'texto', 'desktop'),
(3042, 145, 0, 'subtitulo_1', NULL, 0, '2014-11-17 14:40:42', NULL, '', 186, 175, 'texto', 'desktop'),
(3043, 145, 0, 'texto_1', NULL, 0, '2014-11-17 14:40:42', NULL, 'Você entenderá o que são os banners, os atributos que possuiem, o tipo de publicidade que podem atuar e como utulizá-los', 186, 175, 'texto', 'desktop'),
(3044, 145, 0, 'label_1', NULL, 0, '2014-11-17 14:40:42', 'Dicas Banners', '', 186, 175, 'texto', 'desktop'),
(3045, 145, 0, 'link_1', NULL, 0, '2014-11-17 14:40:42', NULL, '/dicas_banners', 186, 175, 'texto', 'desktop'),
(3046, 145, 0, 'image_1', NULL, 0, '2014-11-17 14:40:42', '', '', 186, 175, 'texto', 'desktop'),
(3047, 145, 0, 'layout_1', NULL, 0, '2014-11-17 14:40:42', 'left', '', 186, 175, 'texto', 'desktop'),
(3048, 145, 0, 'cor_1', NULL, 0, '2014-11-17 14:40:42', '', '', 186, 175, 'texto', 'desktop'),
(3049, 145, 0, 'cor_2', NULL, 0, '2014-11-17 14:40:42', '', '', 186, 175, 'texto', 'desktop'),
(3050, 145, 0, 'cor_3', NULL, 0, '2014-11-17 14:40:42', '', '', 186, 175, 'texto', 'desktop'),
(3051, 145, 0, 'alinhamento_1', NULL, 0, '2014-11-17 14:40:42', 'left', '', 186, 175, 'texto', 'desktop'),
(3052, 145, 0, 'alinhamento_2', NULL, 0, '2014-11-17 14:40:42', 'left', '', 186, 175, 'texto', 'desktop'),
(3053, 145, 0, 'alinhamento_3', NULL, 0, '2014-11-17 14:40:42', 'left', '', 186, 175, 'texto', 'desktop'),
(3054, 145, 0, 'margin_top', 0, 0, '2014-11-17 14:40:42', NULL, '', 186, 175, 'inteiro', 'desktop'),
(3055, 145, 0, 'margin_bottom', 0, 0, '2014-11-17 14:40:42', NULL, '', 186, 175, 'inteiro', 'desktop'),
(3056, 145, 0, 'padding_top', 0, 0, '2014-11-17 14:40:42', NULL, '', 186, 175, 'inteiro', 'desktop'),
(3057, 145, 0, 'padding_bottom', 0, 0, '2014-11-17 14:40:42', NULL, '', 186, 175, 'inteiro', 'desktop'),
(3058, 145, 0, 'is_full', 0, 0, '2014-11-17 14:40:42', NULL, '', 186, 175, 'inteiro', 'desktop'),
(3059, 145, 0, 'titulo_componente', NULL, 0, '2014-11-17 14:40:42', 'Dicas Banners', '', 186, 175, 'texto', 'desktop'),
(3060, 145, 0, 'background_type', 0, 0, '2014-11-17 14:40:42', NULL, '', 186, 175, 'inteiro', 'desktop'),
(3061, 145, 0, 'background', NULL, 0, '2014-11-17 14:40:42', '', '', 186, 175, 'texto', 'desktop'),
(3062, 157, 0, 'titulo_1', NULL, 0, '2014-11-17 14:58:39', NULL, '', 186, 174, 'texto', 'desktop'),
(3063, 157, 0, 'subtitulo_1', NULL, 0, '2014-11-17 14:58:39', NULL, '', 186, 174, 'texto', 'desktop'),
(3064, 157, 0, 'texto_1', NULL, 0, '2014-11-17 14:58:39', NULL, '', 186, 174, 'texto', 'desktop'),
(3065, 157, 0, 'label_1', NULL, 0, '2014-11-17 14:58:39', '', '', 186, 174, 'texto', 'desktop'),
(3066, 157, 0, 'link_1', NULL, 0, '2014-11-17 14:58:39', NULL, '', 186, 174, 'texto', 'desktop'),
(3067, 157, 0, 'image_1', NULL, 0, '2014-11-17 14:58:39', '', '', 186, 174, 'texto', 'desktop'),
(3068, 157, 0, 'layout_1', NULL, 0, '2014-11-17 14:58:39', 'left', '', 186, 174, 'texto', 'desktop'),
(3069, 157, 0, 'cor_1', NULL, 0, '2014-11-17 14:58:39', '', '', 186, 174, 'texto', 'desktop'),
(3070, 157, 0, 'cor_2', NULL, 0, '2014-11-17 14:58:39', '', '', 186, 174, 'texto', 'desktop'),
(3071, 157, 0, 'cor_3', NULL, 0, '2014-11-17 14:58:39', '', '', 186, 174, 'texto', 'desktop'),
(3072, 157, 0, 'alinhamento_1', NULL, 0, '2014-11-17 14:58:39', 'left', '', 186, 174, 'texto', 'desktop'),
(3073, 157, 0, 'alinhamento_2', NULL, 0, '2014-11-17 14:58:39', 'left', '', 186, 174, 'texto', 'desktop'),
(3074, 157, 0, 'alinhamento_3', NULL, 0, '2014-11-17 14:58:39', 'left', '', 186, 174, 'texto', 'desktop'),
(3075, 157, 0, 'margin_top', 0, 0, '2014-11-17 14:58:39', NULL, '', 186, 174, 'inteiro', 'desktop'),
(3076, 157, 0, 'margin_bottom', 0, 0, '2014-11-17 14:58:39', NULL, '', 186, 174, 'inteiro', 'desktop'),
(3077, 157, 0, 'padding_top', 0, 0, '2014-11-17 14:58:39', NULL, '', 186, 174, 'inteiro', 'desktop'),
(3078, 157, 0, 'padding_bottom', 0, 0, '2014-11-17 14:58:39', NULL, '', 186, 174, 'inteiro', 'desktop'),
(3079, 157, 0, 'is_full', 0, 0, '2014-11-17 14:58:39', NULL, '', 186, 174, 'inteiro', 'desktop'),
(3080, 157, 0, 'titulo_componente', NULL, 0, '2014-11-17 14:58:39', 'Passo - 3', '', 186, 174, 'texto', 'desktop'),
(3081, 157, 0, 'background_type', 0, 0, '2014-11-17 14:58:39', NULL, '', 186, 174, 'inteiro', 'desktop'),
(3082, 157, 0, 'background', NULL, 0, '2014-11-17 14:58:39', '', '', 186, 174, 'texto', 'desktop'),
(3083, 145, 0, 'titulo_1', NULL, 0, '2014-11-17 21:16:14', NULL, 'Dicas Promoções', 186, 176, 'texto', 'desktop'),
(3084, 145, 0, 'subtitulo_1', NULL, 0, '2014-11-17 21:16:14', NULL, '', 186, 176, 'texto', 'desktop'),
(3085, 145, 0, 'texto_1', NULL, 0, '2014-11-17 21:16:14', NULL, 'Veja como criar e administrar promoções, programas de fidelidade para seus produtos, serviços e tudo mais que desejar', 186, 176, 'texto', 'desktop'),
(3086, 145, 0, 'label_1', NULL, 0, '2014-11-17 21:16:14', 'Dicas Promoções', '', 186, 176, 'texto', 'desktop'),
(3087, 145, 0, 'link_1', NULL, 0, '2014-11-17 21:16:14', NULL, '/dicas_promocoes', 186, 176, 'texto', 'desktop'),
(3088, 145, 0, 'image_1', NULL, 0, '2014-11-17 21:16:14', '', '', 186, 176, 'texto', 'desktop'),
(3089, 145, 0, 'layout_1', NULL, 0, '2014-11-17 21:16:14', 'left', '', 186, 176, 'texto', 'desktop'),
(3090, 145, 0, 'cor_1', NULL, 0, '2014-11-17 21:16:14', '', '', 186, 176, 'texto', 'desktop'),
(3091, 145, 0, 'cor_2', NULL, 0, '2014-11-17 21:16:14', '', '', 186, 176, 'texto', 'desktop'),
(3092, 145, 0, 'cor_3', NULL, 0, '2014-11-17 21:16:14', '', '', 186, 176, 'texto', 'desktop'),
(3093, 145, 0, 'alinhamento_1', NULL, 0, '2014-11-17 21:16:14', 'left', '', 186, 176, 'texto', 'desktop'),
(3094, 145, 0, 'alinhamento_2', NULL, 0, '2014-11-17 21:16:14', 'left', '', 186, 176, 'texto', 'desktop'),
(3095, 145, 0, 'alinhamento_3', NULL, 0, '2014-11-17 21:16:14', 'left', '', 186, 176, 'texto', 'desktop'),
(3096, 145, 0, 'margin_top', 0, 0, '2014-11-17 21:16:14', NULL, '', 186, 176, 'inteiro', 'desktop'),
(3097, 145, 0, 'margin_bottom', 0, 0, '2014-11-17 21:16:14', NULL, '', 186, 176, 'inteiro', 'desktop'),
(3098, 145, 0, 'padding_top', 0, 0, '2014-11-17 21:16:14', NULL, '', 186, 176, 'inteiro', 'desktop'),
(3099, 145, 0, 'padding_bottom', 0, 0, '2014-11-17 21:16:14', NULL, '', 186, 176, 'inteiro', 'desktop'),
(3100, 145, 0, 'is_full', 0, 0, '2014-11-17 21:16:14', NULL, '', 186, 176, 'inteiro', 'desktop'),
(3101, 145, 0, 'titulo_componente', NULL, 0, '2014-11-17 21:16:14', 'Dicas Promoções', '', 186, 176, 'texto', 'desktop'),
(3102, 145, 0, 'background_type', 0, 0, '2014-11-17 21:16:14', NULL, '', 186, 176, 'inteiro', 'desktop'),
(3103, 145, 0, 'background', NULL, 0, '2014-11-17 21:16:14', '', '', 186, 176, 'texto', 'desktop'),
(3104, 158, 0, 'titulo_1', NULL, 0, '2014-11-17 21:23:36', NULL, 'O que são promoções?', 186, 177, 'texto', 'desktop'),
(3105, 158, 0, 'subtitulo_1', NULL, 0, '2014-11-17 21:23:36', NULL, 'Ações com objetivos em busca de bons resultados', 186, 177, 'texto', 'desktop'),
(3106, 158, 0, 'texto_1', NULL, 0, '2014-11-17 21:23:36', NULL, 'São ações que visam vender, divulgar, arrecadar divulgar entre outros objetivos direcionados.\r\n\r\nA PurplePier está criando uma ferramenta exclusiva para essas ações onde você poderá criar diferentes promoções e geri-las de forma fácil e rápida.\r\nInicialmente estamos criando a ferramenta para criar Programas de Fidelidade, mas estamos planejando ferramentas para Promoções com sorteios, com concurso culturais, com likes do Facebook entre outras. ', 186, 177, 'texto', 'desktop'),
(3107, 158, 0, 'label_1', NULL, 0, '2014-11-17 21:23:36', '', '', 186, 177, 'texto', 'desktop'),
(3108, 158, 0, 'link_1', NULL, 0, '2014-11-17 21:23:36', NULL, '', 186, 177, 'texto', 'desktop'),
(3109, 158, 0, 'image_1', NULL, 0, '2014-11-17 21:23:36', '', '', 186, 177, 'texto', 'desktop'),
(3110, 158, 0, 'layout_1', NULL, 0, '2014-11-17 21:23:36', 'left', '', 186, 177, 'texto', 'desktop'),
(3111, 158, 0, 'cor_1', NULL, 0, '2014-11-17 21:23:36', '', '', 186, 177, 'texto', 'desktop'),
(3112, 158, 0, 'cor_2', NULL, 0, '2014-11-17 21:23:36', '', '', 186, 177, 'texto', 'desktop'),
(3113, 158, 0, 'cor_3', NULL, 0, '2014-11-17 21:23:36', '', '', 186, 177, 'texto', 'desktop'),
(3114, 158, 0, 'alinhamento_1', NULL, 0, '2014-11-17 21:23:36', 'left', '', 186, 177, 'texto', 'desktop'),
(3115, 158, 0, 'alinhamento_2', NULL, 0, '2014-11-17 21:23:36', 'left', '', 186, 177, 'texto', 'desktop'),
(3116, 158, 0, 'alinhamento_3', NULL, 0, '2014-11-17 21:23:36', 'left', '', 186, 177, 'texto', 'desktop'),
(3117, 158, 0, 'margin_top', 0, 0, '2014-11-17 21:23:36', NULL, '', 186, 177, 'inteiro', 'desktop'),
(3118, 158, 0, 'margin_bottom', 0, 0, '2014-11-17 21:23:36', NULL, '', 186, 177, 'inteiro', 'desktop'),
(3119, 158, 0, 'padding_top', 0, 0, '2014-11-17 21:23:36', NULL, '', 186, 177, 'inteiro', 'desktop'),
(3120, 158, 0, 'padding_bottom', 0, 0, '2014-11-17 21:23:36', NULL, '', 186, 177, 'inteiro', 'desktop'),
(3121, 158, 0, 'is_full', 0, 0, '2014-11-17 21:23:36', NULL, '', 186, 177, 'inteiro', 'desktop'),
(3122, 158, 0, 'titulo_componente', NULL, 0, '2014-11-17 21:23:36', 'O que são promoções', '', 186, 177, 'texto', 'desktop'),
(3123, 158, 0, 'background_type', 0, 0, '2014-11-17 21:23:36', NULL, '', 186, 177, 'inteiro', 'desktop'),
(3124, 158, 0, 'background', NULL, 0, '2014-11-17 21:23:36', '', '', 186, 177, 'texto', 'desktop'),
(3125, 158, 0, 'titulo_1', NULL, 0, '2014-11-17 21:30:42', NULL, 'Porque utilizar Promoções', 186, 178, 'texto', 'desktop'),
(3126, 158, 0, 'subtitulo_1', NULL, 0, '2014-11-17 21:30:42', NULL, 'Para gerar resultados e quantifica-los de forma organizada', 186, 178, 'texto', 'desktop'),
(3127, 158, 0, 'texto_1', NULL, 0, '2014-11-17 21:30:42', NULL, 'Utilizando promoções você pode obter resultados incríveis e aumentar seu faturamento\r\n \r\nPara começar a gerir suas Promoções você deve ter um plano onde seu objetivo esteja bem definido, vamos supor que seu plano seja fidelizar seus clientes criando ações que os estimulem a permanecer fazendo negócios com sua empresa.\r\n\r\nPara isso criamos a ferramenta Promoção - Programa de Fidelidade, que nada mais é que uma ferramenta para ajuda-lo a organizar e gerir sua ação para incentivar as seus clientes a retornarem ou continuarem a negociar com sua empresa afim de receber um prêmio, um bônus, um brinde ou qualquer outra forma de estimula-lo. ', 186, 178, 'texto', 'desktop'),
(3128, 158, 0, 'label_1', NULL, 0, '2014-11-17 21:30:42', '', '', 186, 178, 'texto', 'desktop'),
(3129, 158, 0, 'link_1', NULL, 0, '2014-11-17 21:30:42', NULL, '', 186, 178, 'texto', 'desktop'),
(3130, 158, 0, 'image_1', NULL, 0, '2014-11-17 21:30:42', '', '', 186, 178, 'texto', 'desktop'),
(3131, 158, 0, 'layout_1', NULL, 0, '2014-11-17 21:30:42', 'left', '', 186, 178, 'texto', 'desktop'),
(3132, 158, 0, 'cor_1', NULL, 0, '2014-11-17 21:30:42', '', '', 186, 178, 'texto', 'desktop'),
(3133, 158, 0, 'cor_2', NULL, 0, '2014-11-17 21:30:42', '', '', 186, 178, 'texto', 'desktop'),
(3134, 158, 0, 'cor_3', NULL, 0, '2014-11-17 21:30:42', '', '', 186, 178, 'texto', 'desktop'),
(3135, 158, 0, 'alinhamento_1', NULL, 0, '2014-11-17 21:30:42', 'left', '', 186, 178, 'texto', 'desktop'),
(3136, 158, 0, 'alinhamento_2', NULL, 0, '2014-11-17 21:30:43', 'left', '', 186, 178, 'texto', 'desktop'),
(3137, 158, 0, 'alinhamento_3', NULL, 0, '2014-11-17 21:30:43', 'left', '', 186, 178, 'texto', 'desktop'),
(3138, 158, 0, 'margin_top', 0, 0, '2014-11-17 21:30:43', NULL, '', 186, 178, 'inteiro', 'desktop'),
(3139, 158, 0, 'margin_bottom', 0, 0, '2014-11-17 21:30:43', NULL, '', 186, 178, 'inteiro', 'desktop'),
(3140, 158, 0, 'padding_top', 0, 0, '2014-11-17 21:30:43', NULL, '', 186, 178, 'inteiro', 'desktop'),
(3141, 158, 0, 'padding_bottom', 0, 0, '2014-11-17 21:30:43', NULL, '', 186, 178, 'inteiro', 'desktop'),
(3142, 158, 0, 'is_full', 0, 0, '2014-11-17 21:30:43', NULL, '', 186, 178, 'inteiro', 'desktop'),
(3143, 158, 0, 'titulo_componente', NULL, 0, '2014-11-17 21:30:43', 'Como gerir suas campanhas?', '', 186, 178, 'texto', 'desktop'),
(3144, 158, 0, 'background_type', 0, 0, '2014-11-17 21:30:43', NULL, '', 186, 178, 'inteiro', 'desktop'),
(3145, 158, 0, 'background', NULL, 0, '2014-11-17 21:30:43', '', '', 186, 178, 'texto', 'desktop'),
(3146, 158, 0, 'titulo_1', NULL, 0, '2014-11-17 21:36:20', NULL, 'Como começar a criar e gerir Promoções', 186, 179, 'texto', 'desktop'),
(3147, 158, 0, 'subtitulo_1', NULL, 0, '2014-11-17 21:36:20', NULL, 'Com o PierPromoções tudo fica organizado e facil de controlar ', 186, 179, 'texto', 'desktop'),
(3148, 158, 0, 'texto_1', NULL, 0, '2014-11-17 21:36:20', NULL, 'Para começar a criar sua campanha instale o aplicativo PierPromoções. \r\nUma nova opção irá aparecer em seu menu de conteúdo com o nome de promoções. Clique em cadastrar.\r\nUma tela irá ser exibida onde o Título da promoção deve ser digitado, uma descrição para fácil identificação mais a data do encerramento e o tipo da campanha. Inicialmente só temos o Programa de Fidelidade mais estamos planejando mais tipos de promoção.\r\n\r\nPreencha todos os campos e clique em salvar', 186, 179, 'texto', 'desktop'),
(3149, 158, 0, 'label_1', NULL, 0, '2014-11-17 21:36:20', '', '', 186, 179, 'texto', 'desktop'),
(3150, 158, 0, 'link_1', NULL, 0, '2014-11-17 21:36:20', NULL, '', 186, 179, 'texto', 'desktop'),
(3151, 158, 0, 'image_1', NULL, 0, '2014-11-17 21:36:20', '', '', 186, 179, 'texto', 'desktop'),
(3152, 158, 0, 'layout_1', NULL, 0, '2014-11-17 21:36:20', 'left', '', 186, 179, 'texto', 'desktop'),
(3153, 158, 0, 'cor_1', NULL, 0, '2014-11-17 21:36:20', '', '', 186, 179, 'texto', 'desktop'),
(3154, 158, 0, 'cor_2', NULL, 0, '2014-11-17 21:36:20', '', '', 186, 179, 'texto', 'desktop'),
(3155, 158, 0, 'cor_3', NULL, 0, '2014-11-17 21:36:20', '', '', 186, 179, 'texto', 'desktop'),
(3156, 158, 0, 'alinhamento_1', NULL, 0, '2014-11-17 21:36:20', 'left', '', 186, 179, 'texto', 'desktop'),
(3157, 158, 0, 'alinhamento_2', NULL, 0, '2014-11-17 21:36:20', 'left', '', 186, 179, 'texto', 'desktop'),
(3158, 158, 0, 'alinhamento_3', NULL, 0, '2014-11-17 21:36:20', 'left', '', 186, 179, 'texto', 'desktop'),
(3159, 158, 0, 'margin_top', 0, 0, '2014-11-17 21:36:20', NULL, '', 186, 179, 'inteiro', 'desktop'),
(3160, 158, 0, 'margin_bottom', 0, 0, '2014-11-17 21:36:20', NULL, '', 186, 179, 'inteiro', 'desktop'),
(3161, 158, 0, 'padding_top', 0, 0, '2014-11-17 21:36:20', NULL, '', 186, 179, 'inteiro', 'desktop'),
(3162, 158, 0, 'padding_bottom', 0, 0, '2014-11-17 21:36:20', NULL, '', 186, 179, 'inteiro', 'desktop'),
(3163, 158, 0, 'is_full', 0, 0, '2014-11-17 21:36:20', NULL, '', 186, 179, 'inteiro', 'desktop'),
(3164, 158, 0, 'titulo_componente', NULL, 0, '2014-11-17 21:36:20', 'Começando', '', 186, 179, 'texto', 'desktop'),
(3165, 158, 0, 'background_type', 0, 0, '2014-11-17 21:36:20', NULL, '', 186, 179, 'inteiro', 'desktop'),
(3166, 158, 0, 'background', NULL, 0, '2014-11-17 21:36:20', '', '', 186, 179, 'texto', 'desktop'),
(3167, 158, 0, 'titulo_1', NULL, 0, '2014-11-17 21:44:43', NULL, 'Após criado sua campanha você pode clicar em listar para pegar o ID dela', 186, 180, 'texto', 'desktop'),
(3168, 158, 0, 'subtitulo_1', NULL, 0, '2014-11-17 21:44:43', NULL, 'Com o ID você pode utlizar de componente para exibi-la e deixar os usuários participarem', 186, 180, 'texto', 'desktop'),
(3169, 158, 0, 'texto_1', NULL, 0, '2014-11-17 21:44:43', NULL, 'Depois de cadastrada a campanha terá um ID, marque esse ID para poder criar um componente que permita que os usuários se inscrevam na sua promoção ou que possam realizar outras ações dependendo do tipo da promoção.\r\n\r\nCom o ID vamos criar um nova página avançada e adicionar um componente de participação do programa de fidelidade. Encontre o componente Promoção Space, que é um componente com um formulário exclusivo para o usuário participar da promoção. Quando o usuário preencher este formulário ele irá ser cadastrado em seu banco de dados como um cliente, ele irá ser cadastrado na promoção como um participante e terá seu e-mail cadastrado no Newsletter para você poder enviar informações a ele via PierMail.\r\n\r\nApós ele se cadastrar na promoção seu nome irá aparecer na listagem de usuários da promoção. Ícone de dois usuários. Ao clicar nesse ícone todos os participantes da promoção serão exibidos e você pode ver quem está participando, seu e-mail e seu telefone.', 186, 180, 'texto', 'desktop'),
(3170, 158, 0, 'label_1', NULL, 0, '2014-11-17 21:44:43', '', '', 186, 180, 'texto', 'desktop'),
(3171, 158, 0, 'link_1', NULL, 0, '2014-11-17 21:44:43', NULL, '', 186, 180, 'texto', 'desktop'),
(3172, 158, 0, 'image_1', NULL, 0, '2014-11-17 21:44:43', '', '', 186, 180, 'texto', 'desktop'),
(3173, 158, 0, 'layout_1', NULL, 0, '2014-11-17 21:44:43', 'left', '', 186, 180, 'texto', 'desktop'),
(3174, 158, 0, 'cor_1', NULL, 0, '2014-11-17 21:44:43', '', '', 186, 180, 'texto', 'desktop'),
(3175, 158, 0, 'cor_2', NULL, 0, '2014-11-17 21:44:43', '', '', 186, 180, 'texto', 'desktop'),
(3176, 158, 0, 'cor_3', NULL, 0, '2014-11-17 21:44:43', '', '', 186, 180, 'texto', 'desktop'),
(3177, 158, 0, 'alinhamento_1', NULL, 0, '2014-11-17 21:44:43', 'left', '', 186, 180, 'texto', 'desktop'),
(3178, 158, 0, 'alinhamento_2', NULL, 0, '2014-11-17 21:44:43', 'left', '', 186, 180, 'texto', 'desktop'),
(3179, 158, 0, 'alinhamento_3', NULL, 0, '2014-11-17 21:44:43', 'left', '', 186, 180, 'texto', 'desktop'),
(3180, 158, 0, 'margin_top', 0, 0, '2014-11-17 21:44:43', NULL, '', 186, 180, 'inteiro', 'desktop'),
(3181, 158, 0, 'margin_bottom', 0, 0, '2014-11-17 21:44:43', NULL, '', 186, 180, 'inteiro', 'desktop'),
(3182, 158, 0, 'padding_top', 0, 0, '2014-11-17 21:44:43', NULL, '', 186, 180, 'inteiro', 'desktop'),
(3183, 158, 0, 'padding_bottom', 0, 0, '2014-11-17 21:44:43', NULL, '', 186, 180, 'inteiro', 'desktop'),
(3184, 158, 0, 'is_full', 0, 0, '2014-11-17 21:44:43', NULL, '', 186, 180, 'inteiro', 'desktop'),
(3185, 158, 0, 'titulo_componente', NULL, 0, '2014-11-17 21:44:43', 'Listar as campanhas', '', 186, 180, 'texto', 'desktop'),
(3186, 158, 0, 'background_type', 0, 0, '2014-11-17 21:44:43', NULL, '', 186, 180, 'inteiro', 'desktop'),
(3187, 158, 0, 'background', NULL, 0, '2014-11-17 21:44:43', '', '', 186, 180, 'texto', 'desktop'),
(3188, 158, 0, 'titulo_1', NULL, 0, '2014-11-17 21:53:38', NULL, 'Adicionando pontos de fidelidade', 186, 181, 'texto', 'desktop'),
(3189, 158, 0, 'subtitulo_1', NULL, 0, '2014-11-17 21:53:38', NULL, 'O programa de fidelidade concede um benefício ao atingir a marca de 10 pontos', 186, 181, 'texto', 'desktop'),
(3190, 158, 0, 'texto_1', NULL, 0, '2014-11-17 21:53:38', NULL, 'Ao listar todos os usuários participantes do programa você poderá notar que existem dois ícones do lado direito de cada usuário. O ícone tradicional de editar onde ao ser clicado abre a tela de edição dos dados do usuários e um ícone cor de rosa com o símbolo do megafone. Esse ícone ao ser clicado exibe um popup com a quantidade de pontos que esse usuário possui. \r\n\r\nNa base do popup existe u botão adicionar ponto. Ao clicar nesse botão um novo ponto será adicionado a listagem de pontos do usuário. Esses pontos são exibidos com o dia e a hora de concessão para ficar facil de identifica-los e não adicionar pontos por engano.\r\n\r\nO sistema não permite a remoção dos pontos e somente o Administrados do sistema poderá conceder esses pontos.\r\nCaso o usuário queira se cadastrar duas vezes o sistema identifica o e-mail do usuário e não permite o cadastro em duplicidade.', 186, 181, 'texto', 'desktop'),
(3191, 158, 0, 'label_1', NULL, 0, '2014-11-17 21:53:38', '', '', 186, 181, 'texto', 'desktop'),
(3192, 158, 0, 'link_1', NULL, 0, '2014-11-17 21:53:38', NULL, '', 186, 181, 'texto', 'desktop'),
(3193, 158, 0, 'image_1', NULL, 0, '2014-11-17 21:53:38', '', '', 186, 181, 'texto', 'desktop'),
(3194, 158, 0, 'layout_1', NULL, 0, '2014-11-17 21:53:38', 'left', '', 186, 181, 'texto', 'desktop'),
(3195, 158, 0, 'cor_1', NULL, 0, '2014-11-17 21:53:38', '', '', 186, 181, 'texto', 'desktop'),
(3196, 158, 0, 'cor_2', NULL, 0, '2014-11-17 21:53:38', '', '', 186, 181, 'texto', 'desktop'),
(3197, 158, 0, 'cor_3', NULL, 0, '2014-11-17 21:53:38', '', '', 186, 181, 'texto', 'desktop'),
(3198, 158, 0, 'alinhamento_1', NULL, 0, '2014-11-17 21:53:38', 'left', '', 186, 181, 'texto', 'desktop'),
(3199, 158, 0, 'alinhamento_2', NULL, 0, '2014-11-17 21:53:38', 'left', '', 186, 181, 'texto', 'desktop'),
(3200, 158, 0, 'alinhamento_3', NULL, 0, '2014-11-17 21:53:38', 'left', '', 186, 181, 'texto', 'desktop'),
(3201, 158, 0, 'margin_top', 0, 0, '2014-11-17 21:53:38', NULL, '', 186, 181, 'inteiro', 'desktop'),
(3202, 158, 0, 'margin_bottom', 0, 0, '2014-11-17 21:53:38', NULL, '', 186, 181, 'inteiro', 'desktop'),
(3203, 158, 0, 'padding_top', 0, 0, '2014-11-17 21:53:38', NULL, '', 186, 181, 'inteiro', 'desktop'),
(3204, 158, 0, 'padding_bottom', 0, 0, '2014-11-17 21:53:38', NULL, '', 186, 181, 'inteiro', 'desktop'),
(3205, 158, 0, 'is_full', 0, 0, '2014-11-17 21:53:39', NULL, '', 186, 181, 'inteiro', 'desktop'),
(3206, 158, 0, 'titulo_componente', NULL, 0, '2014-11-17 21:53:39', 'Adicionando pontos', '', 186, 181, 'texto', 'desktop'),
(3207, 158, 0, 'background_type', 0, 0, '2014-11-17 21:53:39', NULL, '', 186, 181, 'inteiro', 'desktop'),
(3208, 158, 0, 'background', NULL, 0, '2014-11-17 21:53:39', '', '', 186, 181, 'texto', 'desktop'),
(3209, 158, 0, 'titulo_1', NULL, 0, '2014-11-17 21:58:22', NULL, 'O que acontece ao atingir 10 pontos?', 186, 182, 'texto', 'desktop'),
(3210, 158, 0, 'subtitulo_1', NULL, 0, '2014-11-17 21:58:22', NULL, 'Cliente com direito a benefício', 186, 182, 'texto', 'desktop'),
(3211, 158, 0, 'texto_1', NULL, 0, '2014-11-17 21:58:22', NULL, 'Ao atingir 10 pontos o botão de adicionar pontos não é mais exibido e em seu lugar um novo botão será mostrado.\r\n<b>conceder benefício</b>\r\nEsse botão é exclusivo para os usuários que atingiram os 10 pontos e já podem obter o benefício. Nesse caso basta o Administrador clicar no botão conceder benefício que o o sistema irá enviar um e-mail ao cliente dizendo que o benefício foi concedido e a contagem de pontos foi zerada.\r\n\r\nCom a contagem zerada ele poderá participar novamente ou até que o programa atinja a data de encerramento ou a campanha seja removida. ', 186, 182, 'texto', 'desktop'),
(3212, 158, 0, 'label_1', NULL, 0, '2014-11-17 21:58:22', '', '', 186, 182, 'texto', 'desktop'),
(3213, 158, 0, 'link_1', NULL, 0, '2014-11-17 21:58:22', NULL, '', 186, 182, 'texto', 'desktop'),
(3214, 158, 0, 'image_1', NULL, 0, '2014-11-17 21:58:22', '', '', 186, 182, 'texto', 'desktop'),
(3215, 158, 0, 'layout_1', NULL, 0, '2014-11-17 21:58:22', 'left', '', 186, 182, 'texto', 'desktop'),
(3216, 158, 0, 'cor_1', NULL, 0, '2014-11-17 21:58:22', '', '', 186, 182, 'texto', 'desktop'),
(3217, 158, 0, 'cor_2', NULL, 0, '2014-11-17 21:58:22', '', '', 186, 182, 'texto', 'desktop'),
(3218, 158, 0, 'cor_3', NULL, 0, '2014-11-17 21:58:22', '', '', 186, 182, 'texto', 'desktop'),
(3219, 158, 0, 'alinhamento_1', NULL, 0, '2014-11-17 21:58:22', 'left', '', 186, 182, 'texto', 'desktop'),
(3220, 158, 0, 'alinhamento_2', NULL, 0, '2014-11-17 21:58:22', 'left', '', 186, 182, 'texto', 'desktop'),
(3221, 158, 0, 'alinhamento_3', NULL, 0, '2014-11-17 21:58:22', 'left', '', 186, 182, 'texto', 'desktop'),
(3222, 158, 0, 'margin_top', 0, 0, '2014-11-17 21:58:22', NULL, '', 186, 182, 'inteiro', 'desktop'),
(3223, 158, 0, 'margin_bottom', 0, 0, '2014-11-17 21:58:22', NULL, '', 186, 182, 'inteiro', 'desktop'),
(3224, 158, 0, 'padding_top', 0, 0, '2014-11-17 21:58:22', NULL, '', 186, 182, 'inteiro', 'desktop'),
(3225, 158, 0, 'padding_bottom', 0, 0, '2014-11-17 21:58:22', NULL, '', 186, 182, 'inteiro', 'desktop'),
(3226, 158, 0, 'is_full', 0, 0, '2014-11-17 21:58:22', NULL, '', 186, 182, 'inteiro', 'desktop'),
(3227, 158, 0, 'titulo_componente', NULL, 0, '2014-11-17 21:58:22', 'Chegou a 10 pontos', '', 186, 182, 'texto', 'desktop'),
(3228, 158, 0, 'background_type', 0, 0, '2014-11-17 21:58:22', NULL, '', 186, 182, 'inteiro', 'desktop'),
(3229, 158, 0, 'background', NULL, 0, '2014-11-17 21:58:22', '', '', 186, 182, 'texto', 'desktop'),
(3230, 158, 0, 'titulo_1', NULL, 0, '2014-11-17 22:09:37', NULL, 'Dicas para sua promoção', 186, 183, 'texto', 'desktop'),
(3231, 158, 0, 'subtitulo_1', NULL, 0, '2014-11-17 22:09:37', NULL, 'Veja abaixo algumas dicas para tornar sua Promoção Profissional', 186, 183, 'texto', 'desktop'),
(3232, 158, 0, 'texto_1', NULL, 0, '2014-11-17 22:09:37', NULL, 'Sempre deixe o Regulamento de sua promoção bem claro e transparente.\r\nDefina uma data de encerramento para sua Promoção\r\nCrie publicidade para divulga-la: PierMail, Banners, Campanhas no Facebook, informações no seu banner principal.\r\n\r\nO PurplePier criou um banner Principal chamado Cosmo, com ele você pode adicionar uma imagem pequena sobre seu banner e adicionar um link para sua promoção. Essa imagem pode ser alterado sempre que desejar é bem fácil de gerenciar ou cria-la.', 186, 183, 'texto', 'desktop'),
(3233, 158, 0, 'label_1', NULL, 0, '2014-11-17 22:09:37', '', '', 186, 183, 'texto', 'desktop'),
(3234, 158, 0, 'link_1', NULL, 0, '2014-11-17 22:09:37', NULL, '', 186, 183, 'texto', 'desktop'),
(3235, 158, 0, 'image_1', NULL, 0, '2014-11-17 22:09:37', '', '', 186, 183, 'texto', 'desktop'),
(3236, 158, 0, 'layout_1', NULL, 0, '2014-11-17 22:09:37', 'left', '', 186, 183, 'texto', 'desktop'),
(3237, 158, 0, 'cor_1', NULL, 0, '2014-11-17 22:09:37', '', '', 186, 183, 'texto', 'desktop'),
(3238, 158, 0, 'cor_2', NULL, 0, '2014-11-17 22:09:37', '', '', 186, 183, 'texto', 'desktop'),
(3239, 158, 0, 'cor_3', NULL, 0, '2014-11-17 22:09:37', '', '', 186, 183, 'texto', 'desktop'),
(3240, 158, 0, 'alinhamento_1', NULL, 0, '2014-11-17 22:09:37', 'left', '', 186, 183, 'texto', 'desktop'),
(3241, 158, 0, 'alinhamento_2', NULL, 0, '2014-11-17 22:09:37', 'left', '', 186, 183, 'texto', 'desktop'),
(3242, 158, 0, 'alinhamento_3', NULL, 0, '2014-11-17 22:09:37', 'left', '', 186, 183, 'texto', 'desktop'),
(3243, 158, 0, 'margin_top', 0, 0, '2014-11-17 22:09:37', NULL, '', 186, 183, 'inteiro', 'desktop'),
(3244, 158, 0, 'margin_bottom', 0, 0, '2014-11-17 22:09:37', NULL, '', 186, 183, 'inteiro', 'desktop'),
(3245, 158, 0, 'padding_top', 0, 0, '2014-11-17 22:09:37', NULL, '', 186, 183, 'inteiro', 'desktop'),
(3246, 158, 0, 'padding_bottom', 0, 0, '2014-11-17 22:09:37', NULL, '', 186, 183, 'inteiro', 'desktop'),
(3247, 158, 0, 'is_full', 0, 0, '2014-11-17 22:09:37', NULL, '', 186, 183, 'inteiro', 'desktop'),
(3248, 158, 0, 'titulo_componente', NULL, 0, '2014-11-17 22:09:37', 'Dica', '', 186, 183, 'texto', 'desktop'),
(3249, 158, 0, 'background_type', 0, 0, '2014-11-17 22:09:37', NULL, '', 186, 183, 'inteiro', 'desktop'),
(3250, 158, 0, 'background', NULL, 0, '2014-11-17 22:09:37', '', '', 186, 183, 'texto', 'desktop'),
(3251, 153, 0, 'label_1', NULL, 0, '2014-11-18 12:05:59', '', '', 186, 156, 'texto', 'desktop'),
(3252, 153, 0, 'label_1', NULL, 0, '2014-11-18 12:07:08', '', '', 186, 157, 'texto', 'desktop'),
(3253, 153, 0, 'label_1', NULL, 0, '2014-11-18 12:07:17', '', '', 186, 158, 'texto', 'desktop'),
(3254, 153, 0, 'label_1', NULL, 0, '2014-11-18 12:07:27', '', '', 186, 159, 'texto', 'desktop'),
(3255, 153, 0, 'label_1', NULL, 0, '2014-11-18 12:07:44', '', '', 186, 160, 'texto', 'desktop'),
(3256, 153, 0, 'label_1', NULL, 0, '2014-11-18 12:07:57', '', '', 186, 161, 'texto', 'desktop'),
(3257, 59, 0, 'evt_form_type', NULL, 0, NULL, 'formulario', '', 0, 0, '0', '0'),
(3258, 59, 0, 'evt_date', 1, 0, NULL, NULL, '', 0, 0, '0', '0'),
(3259, 59, 0, 'gel_fr_initial', NULL, 0, NULL, NULL, '', 0, 0, '0', '0'),
(3260, 1, 0, 'titulo_componente', NULL, 0, '2014-11-24 18:05:12', '', '', 211, 24, 'texto', 'desktop'),
(3261, 159, 0, 'titulo_1', NULL, 0, '2014-11-26 14:50:19', NULL, 'Como criar um Combo grupo dentro do menu', 186, 184, 'texto', 'desktop'),
(3262, 159, 0, 'subtitulo_1', NULL, 0, '2014-11-26 14:50:19', NULL, 'Comece criando uma página comum sem conteúdo sem template nada', 186, 184, 'texto', 'desktop'),
(3263, 159, 0, 'texto_1', NULL, 0, '2014-11-26 14:50:19', NULL, 'Crie uma pagina em conteúdo (não precisa de nenhum conteúdo para ela) ela será somente a representação do seu menu.\r\nEm DEFINIÇÕES da pagina deixar selecionado GRUPO\r\nPara ele ser exibido no menu, ainda em DEFINIÇÕES, selecione o MENU que deseja exibir\r\nATUALIZE - SALVE suas alterações\r\nPara salvar as alterações, no final da página tem o botão ATUALIZAR, ou na lateral o desenho de um disquete.', 186, 184, 'texto', 'desktop'),
(3264, 159, 0, 'label_1', NULL, 0, '2014-11-26 14:50:19', '', '', 186, 184, 'texto', 'desktop'),
(3265, 159, 0, 'link_1', NULL, 0, '2014-11-26 14:50:19', NULL, '', 186, 184, 'texto', 'desktop'),
(3266, 159, 0, 'image_1', NULL, 0, '2014-11-26 14:50:19', 'captura_de_tela_2014_11_26_124205_f6.png', '', 186, 184, 'texto', 'desktop'),
(3267, 159, 0, 'layout_1', NULL, 0, '2014-11-26 14:50:19', 'left', '', 186, 184, 'texto', 'desktop'),
(3268, 159, 0, 'cor_1', NULL, 0, '2014-11-26 14:50:19', '', '', 186, 184, 'texto', 'desktop'),
(3269, 159, 0, 'cor_2', NULL, 0, '2014-11-26 14:50:19', '', '', 186, 184, 'texto', 'desktop'),
(3270, 159, 0, 'cor_3', NULL, 0, '2014-11-26 14:50:19', '', '', 186, 184, 'texto', 'desktop'),
(3271, 159, 0, 'alinhamento_1', NULL, 0, '2014-11-26 14:50:19', 'left', '', 186, 184, 'texto', 'desktop'),
(3272, 159, 0, 'alinhamento_2', NULL, 0, '2014-11-26 14:50:19', 'left', '', 186, 184, 'texto', 'desktop'),
(3273, 159, 0, 'alinhamento_3', NULL, 0, '2014-11-26 14:50:19', 'left', '', 186, 184, 'texto', 'desktop'),
(3274, 159, 0, 'margin_top', 0, 0, '2014-11-26 14:50:19', NULL, '', 186, 184, 'inteiro', 'desktop'),
(3275, 159, 0, 'margin_bottom', 0, 0, '2014-11-26 14:50:19', NULL, '', 186, 184, 'inteiro', 'desktop'),
(3276, 159, 0, 'padding_top', 0, 0, '2014-11-26 14:50:19', NULL, '', 186, 184, 'inteiro', 'desktop'),
(3277, 159, 0, 'padding_bottom', 0, 0, '2014-11-26 14:50:19', NULL, '', 186, 184, 'inteiro', 'desktop'),
(3278, 159, 0, 'is_full', 0, 0, '2014-11-26 14:50:19', NULL, '', 186, 184, 'inteiro', 'desktop'),
(3279, 159, 0, 'titulo_componente', NULL, 0, '2014-11-26 14:50:19', 'Passo - 1 - crie uma página', '', 186, 184, 'texto', 'desktop'),
(3280, 159, 0, 'background_type', 0, 0, '2014-11-26 14:50:19', NULL, '', 186, 184, 'inteiro', 'desktop'),
(3281, 159, 0, 'background', NULL, 0, '2014-11-26 14:50:19', '', '', 186, 184, 'texto', 'desktop'),
(3282, 159, 0, 'titulo_1', NULL, 0, '2014-11-26 14:55:21', NULL, 'Crie a categoria que irá juntar todos as páginas que deseja exibir no menu retrátil', 186, 185, 'texto', 'desktop'),
(3283, 159, 0, 'subtitulo_1', NULL, 0, '2014-11-26 14:55:21', NULL, 'Essa categoria serve para dizer ao sistema que todos as páginas que tem essa devem ser exibidas juntas', 186, 185, 'texto', 'desktop'),
(3284, 159, 0, 'texto_1', NULL, 0, '2014-11-26 14:55:21', NULL, 'No CONTEÚDO selecione CATEGORIA, CADASTRAR uma categoria\r\nPágina - selecione onde vc quer criar a categoria obrigatoriamente deve ser em PÁGINA\r\nNome - é o nome que vc quer para a categoria, coloque um nome representativo, pois será mais fácil para você encontra-lo caso tenha mais de um.\r\nEsse nome de categoria não será exibido, ele somente serve para a representação do grupo\r\nClique SALVAR', 186, 185, 'texto', 'desktop'),
(3285, 159, 0, 'label_1', NULL, 0, '2014-11-26 14:55:21', '', '', 186, 185, 'texto', 'desktop'),
(3286, 159, 0, 'link_1', NULL, 0, '2014-11-26 14:55:21', NULL, '', 186, 185, 'texto', 'desktop'),
(3287, 159, 0, 'image_1', NULL, 0, '2014-11-26 14:55:21', 'captura_de_tela_2014_11_26_125438_t5.png', '', 186, 185, 'texto', 'desktop'),
(3288, 159, 0, 'layout_1', NULL, 0, '2014-11-26 14:55:21', 'left', '', 186, 185, 'texto', 'desktop'),
(3289, 159, 0, 'cor_1', NULL, 0, '2014-11-26 14:55:21', '', '', 186, 185, 'texto', 'desktop'),
(3290, 159, 0, 'cor_2', NULL, 0, '2014-11-26 14:55:21', '', '', 186, 185, 'texto', 'desktop'),
(3291, 159, 0, 'cor_3', NULL, 0, '2014-11-26 14:55:21', '', '', 186, 185, 'texto', 'desktop'),
(3292, 159, 0, 'alinhamento_1', NULL, 0, '2014-11-26 14:55:21', 'left', '', 186, 185, 'texto', 'desktop'),
(3293, 159, 0, 'alinhamento_2', NULL, 0, '2014-11-26 14:55:21', 'left', '', 186, 185, 'texto', 'desktop'),
(3294, 159, 0, 'alinhamento_3', NULL, 0, '2014-11-26 14:55:21', 'left', '', 186, 185, 'texto', 'desktop'),
(3295, 159, 0, 'margin_top', 0, 0, '2014-11-26 14:55:21', NULL, '', 186, 185, 'inteiro', 'desktop'),
(3296, 159, 0, 'margin_bottom', 0, 0, '2014-11-26 14:55:21', NULL, '', 186, 185, 'inteiro', 'desktop'),
(3297, 159, 0, 'padding_top', 0, 0, '2014-11-26 14:55:21', NULL, '', 186, 185, 'inteiro', 'desktop'),
(3298, 159, 0, 'padding_bottom', 0, 0, '2014-11-26 14:55:21', NULL, '', 186, 185, 'inteiro', 'desktop'),
(3299, 159, 0, 'is_full', 0, 0, '2014-11-26 14:55:21', NULL, '', 186, 185, 'inteiro', 'desktop'),
(3300, 159, 0, 'titulo_componente', NULL, 0, '2014-11-26 14:55:21', 'Passo - 2 - Crie uma Categoria', '', 186, 185, 'texto', 'desktop'),
(3301, 159, 0, 'background_type', 0, 0, '2014-11-26 14:55:21', NULL, '', 186, 185, 'inteiro', 'desktop'),
(3302, 159, 0, 'background', NULL, 0, '2014-11-26 14:55:21', '', '', 186, 185, 'texto', 'desktop'),
(3303, 159, 0, 'titulo_1', NULL, 0, '2014-11-26 15:03:06', NULL, 'Adicionando sua categorias as Páginas que devem ser exibidas juntas', 186, 186, 'texto', 'desktop'),
(3304, 159, 0, 'subtitulo_1', NULL, 0, '2014-11-26 15:03:06', NULL, 'Agora basta trocar o combobox para a categoria do seu menu para exibi-las juntas', 186, 186, 'texto', 'desktop'),
(3305, 159, 0, 'texto_1', NULL, 0, '2014-11-26 15:03:06', NULL, 'No combo de CONTEÚDO, selecione PÁGINAS / LISTAR\r\nEscolha a página que deseja que seja exibida dentro do menu retrátil.\r\nTroque o combobox escolhendo a categoria que voc6e criou. Faça isso com todos que devem ser exibidos nesse grupo\r\nPronto ao voltar ao site seu menu agora deve ter um link que possui itens retráteis\r\n\r\nCaso deseja adicionar produtos no menu também é possível leia o próximo passo\r\n\r\n', 186, 186, 'texto', 'desktop'),
(3306, 159, 0, 'label_1', NULL, 0, '2014-11-26 15:03:06', '', '', 186, 186, 'texto', 'desktop'),
(3307, 159, 0, 'link_1', NULL, 0, '2014-11-26 15:03:06', NULL, '', 186, 186, 'texto', 'desktop'),
(3308, 159, 0, 'image_1', NULL, 0, '2014-11-26 15:03:06', 'captura_de_tela_2014_11_26_130211_j0.png', '', 186, 186, 'texto', 'desktop'),
(3309, 159, 0, 'layout_1', NULL, 0, '2014-11-26 15:03:06', 'left', '', 186, 186, 'texto', 'desktop'),
(3310, 159, 0, 'cor_1', NULL, 0, '2014-11-26 15:03:06', '', '', 186, 186, 'texto', 'desktop'),
(3311, 159, 0, 'cor_2', NULL, 0, '2014-11-26 15:03:06', '', '', 186, 186, 'texto', 'desktop'),
(3312, 159, 0, 'cor_3', NULL, 0, '2014-11-26 15:03:06', '', '', 186, 186, 'texto', 'desktop'),
(3313, 159, 0, 'alinhamento_1', NULL, 0, '2014-11-26 15:03:06', 'left', '', 186, 186, 'texto', 'desktop'),
(3314, 159, 0, 'alinhamento_2', NULL, 0, '2014-11-26 15:03:06', 'left', '', 186, 186, 'texto', 'desktop'),
(3315, 159, 0, 'alinhamento_3', NULL, 0, '2014-11-26 15:03:06', 'left', '', 186, 186, 'texto', 'desktop'),
(3316, 159, 0, 'margin_top', 0, 0, '2014-11-26 15:03:06', NULL, '', 186, 186, 'inteiro', 'desktop'),
(3317, 159, 0, 'margin_bottom', 0, 0, '2014-11-26 15:03:06', NULL, '', 186, 186, 'inteiro', 'desktop'),
(3318, 159, 0, 'padding_top', 0, 0, '2014-11-26 15:03:06', NULL, '', 186, 186, 'inteiro', 'desktop'),
(3319, 159, 0, 'padding_bottom', 0, 0, '2014-11-26 15:03:06', NULL, '', 186, 186, 'inteiro', 'desktop'),
(3320, 159, 0, 'is_full', 0, 0, '2014-11-26 15:03:06', NULL, '', 186, 186, 'inteiro', 'desktop'),
(3321, 159, 0, 'titulo_componente', NULL, 0, '2014-11-26 15:03:06', 'Passo - 3 - adicionando categorias as páginas', '', 186, 186, 'texto', 'desktop'),
(3322, 159, 0, 'background_type', 0, 0, '2014-11-26 15:03:06', NULL, '', 186, 186, 'inteiro', 'desktop'),
(3323, 159, 0, 'background', NULL, 0, '2014-11-26 15:03:06', '', '', 186, 186, 'texto', 'desktop'),
(3324, 159, 0, 'titulo_1', NULL, 0, '2014-11-26 15:06:28', NULL, 'Adicionar um produto ao seu item do menu retrátil', 186, 187, 'texto', 'desktop'),
(3325, 159, 0, 'subtitulo_1', NULL, 0, '2014-11-26 15:06:28', NULL, 'É possível adicionar produtos ao item também, veja os passos abaixo', 186, 187, 'texto', 'desktop'),
(3326, 159, 0, 'texto_1', NULL, 0, '2014-11-26 15:06:28', NULL, 'O próximo passo é ir PRODUTOS, CATEGORIAS, CADASTRAR\r\nSALVAR\r\nApós cadastra a CATEGORIA dentro de produtos, aperte F5.\r\nPara criar um novo produto para esta categoria, na página PRODUTOS\r\n\r\n- ITEM / CADASTRAR\r\n\r\nNo item DESCRIÇÃO\r\nPreencha os dados NOME / MARCA / PALAVRA CHAVE (colocar o nome do produto) CATEGORIA (selecionar a categoria que será exibida o produto)\r\nSALVE\r\n\r\nNo item IMAGENS\r\nClique em ENVIAR ARQUIVO (aguarde o sistema fazer donwload da imagem para carregar outra)\r\nPoderá ser exibido até 6 imagens para cada produto cadastrado.\r\nApós carregar as imagens selecionadas, clique em SALVAR.\r\n\r\nNo item OUTRAS INFORMAÇÕES\r\nSelecione o item EXIBIR EM PRODUTOS\r\nEm EXIBIR NO MENU escolha o nome da categoria que será exibido.\r\n\r\nApós todas as alterações clique em SALVAR.', 186, 187, 'texto', 'desktop'),
(3327, 159, 0, 'label_1', NULL, 0, '2014-11-26 15:06:28', '', '', 186, 187, 'texto', 'desktop'),
(3328, 159, 0, 'link_1', NULL, 0, '2014-11-26 15:06:28', NULL, '', 186, 187, 'texto', 'desktop'),
(3329, 159, 0, 'image_1', NULL, 0, '2014-11-26 15:06:28', 'captura_de_tela_2014_11_26_130459_h0.png', '', 186, 187, 'texto', 'desktop'),
(3330, 159, 0, 'layout_1', NULL, 0, '2014-11-26 15:06:28', 'left', '', 186, 187, 'texto', 'desktop'),
(3331, 159, 0, 'cor_1', NULL, 0, '2014-11-26 15:06:28', '', '', 186, 187, 'texto', 'desktop'),
(3332, 159, 0, 'cor_2', NULL, 0, '2014-11-26 15:06:28', '', '', 186, 187, 'texto', 'desktop'),
(3333, 159, 0, 'cor_3', NULL, 0, '2014-11-26 15:06:28', '', '', 186, 187, 'texto', 'desktop'),
(3334, 159, 0, 'alinhamento_1', NULL, 0, '2014-11-26 15:06:28', 'left', '', 186, 187, 'texto', 'desktop'),
(3335, 159, 0, 'alinhamento_2', NULL, 0, '2014-11-26 15:06:28', 'left', '', 186, 187, 'texto', 'desktop'),
(3336, 159, 0, 'alinhamento_3', NULL, 0, '2014-11-26 15:06:28', 'left', '', 186, 187, 'texto', 'desktop'),
(3337, 159, 0, 'margin_top', 0, 0, '2014-11-26 15:06:28', NULL, '', 186, 187, 'inteiro', 'desktop'),
(3338, 159, 0, 'margin_bottom', 0, 0, '2014-11-26 15:06:28', NULL, '', 186, 187, 'inteiro', 'desktop'),
(3339, 159, 0, 'padding_top', 0, 0, '2014-11-26 15:06:28', NULL, '', 186, 187, 'inteiro', 'desktop'),
(3340, 159, 0, 'padding_bottom', 0, 0, '2014-11-26 15:06:28', NULL, '', 186, 187, 'inteiro', 'desktop'),
(3341, 159, 0, 'is_full', 0, 0, '2014-11-26 15:06:28', NULL, '', 186, 187, 'inteiro', 'desktop'),
(3342, 159, 0, 'titulo_componente', NULL, 0, '2014-11-26 15:06:28', 'Passo - 4 - adicionar produtos ao menu', '', 186, 187, 'texto', 'desktop'),
(3343, 159, 0, 'background_type', 0, 0, '2014-11-26 15:06:28', NULL, '', 186, 187, 'inteiro', 'desktop'),
(3344, 159, 0, 'background', NULL, 0, '2014-11-26 15:06:28', '', '', 186, 187, 'texto', 'desktop'),
(3345, 145, 0, 'titulo_1', NULL, 0, '2014-11-26 15:09:10', NULL, 'Dicas como crair menus retráteis', 186, 188, 'texto', 'desktop'),
(3346, 145, 0, 'subtitulo_1', NULL, 0, '2014-11-26 15:09:10', NULL, '', 186, 188, 'texto', 'desktop'),
(3347, 145, 0, 'texto_1', NULL, 0, '2014-11-26 15:09:10', NULL, 'Veja as dicas de como criar os menus retráteis onde ao passar o mouse mais opções são mostradas', 186, 188, 'texto', 'desktop'),
(3348, 145, 0, 'label_1', NULL, 0, '2014-11-26 15:09:10', 'Dicas menu retrátil', '', 186, 188, 'texto', 'desktop'),
(3349, 145, 0, 'link_1', NULL, 0, '2014-11-26 15:09:10', NULL, '/dicasmenuretratil', 186, 188, 'texto', 'desktop'),
(3350, 145, 0, 'image_1', NULL, 0, '2014-11-26 15:09:10', '', '', 186, 188, 'texto', 'desktop'),
(3351, 145, 0, 'layout_1', NULL, 0, '2014-11-26 15:09:10', 'left', '', 186, 188, 'texto', 'desktop'),
(3352, 145, 0, 'cor_1', NULL, 0, '2014-11-26 15:09:10', '', '', 186, 188, 'texto', 'desktop'),
(3353, 145, 0, 'cor_2', NULL, 0, '2014-11-26 15:09:10', '', '', 186, 188, 'texto', 'desktop'),
(3354, 145, 0, 'cor_3', NULL, 0, '2014-11-26 15:09:10', '', '', 186, 188, 'texto', 'desktop'),
(3355, 145, 0, 'alinhamento_1', NULL, 0, '2014-11-26 15:09:10', 'left', '', 186, 188, 'texto', 'desktop'),
(3356, 145, 0, 'alinhamento_2', NULL, 0, '2014-11-26 15:09:10', 'left', '', 186, 188, 'texto', 'desktop'),
(3357, 145, 0, 'alinhamento_3', NULL, 0, '2014-11-26 15:09:10', 'left', '', 186, 188, 'texto', 'desktop'),
(3358, 145, 0, 'margin_top', 0, 0, '2014-11-26 15:09:10', NULL, '', 186, 188, 'inteiro', 'desktop'),
(3359, 145, 0, 'margin_bottom', 0, 0, '2014-11-26 15:09:10', NULL, '', 186, 188, 'inteiro', 'desktop'),
(3360, 145, 0, 'padding_top', 0, 0, '2014-11-26 15:09:10', NULL, '', 186, 188, 'inteiro', 'desktop'),
(3361, 145, 0, 'padding_bottom', 0, 0, '2014-11-26 15:09:10', NULL, '', 186, 188, 'inteiro', 'desktop'),
(3362, 145, 0, 'is_full', 0, 0, '2014-11-26 15:09:10', NULL, '', 186, 188, 'inteiro', 'desktop'),
(3363, 145, 0, 'titulo_componente', NULL, 0, '2014-11-26 15:09:10', 'Dicas Menu retrátil', '', 186, 188, 'texto', 'desktop'),
(3364, 145, 0, 'background_type', 0, 0, '2014-11-26 15:09:10', NULL, '', 186, 188, 'inteiro', 'desktop'),
(3365, 145, 0, 'background', NULL, 0, '2014-11-26 15:09:10', '', '', 186, 188, 'texto', 'desktop'),
(3366, 140, 0, 'titulo_1', NULL, 0, '2014-11-27 14:07:59', NULL, '', 207, 189, 'texto', 'desktop'),
(3367, 140, 0, 'subtitulo_1', NULL, 0, '2014-11-27 14:07:59', NULL, '', 207, 189, 'texto', 'desktop'),
(3368, 140, 0, 'texto_1', NULL, 0, '2014-11-27 14:07:59', NULL, '', 207, 189, 'texto', 'desktop'),
(3369, 140, 0, 'link_1', NULL, 0, '2014-11-27 14:08:00', NULL, '', 207, 189, 'texto', 'desktop'),
(3370, 140, 0, 'image_1', NULL, 0, '2014-11-27 14:08:00', 'piermail_e9.png', '', 207, 189, 'texto', 'desktop'),
(3371, 140, 0, 'layout_1', NULL, 0, '2014-11-27 14:08:00', 'up', '', 207, 189, 'texto', 'desktop'),
(3372, 140, 0, 'cor_1', NULL, 0, '2014-11-27 14:08:00', '', '', 207, 189, 'texto', 'desktop'),
(3373, 140, 0, 'cor_2', NULL, 0, '2014-11-27 14:08:00', '', '', 207, 189, 'texto', 'desktop'),
(3374, 140, 0, 'cor_3', NULL, 0, '2014-11-27 14:08:00', '', '', 207, 189, 'texto', 'desktop'),
(3375, 140, 0, 'alinhamento_1', NULL, 0, '2014-11-27 14:08:00', 'left', '', 207, 189, 'texto', 'desktop'),
(3376, 140, 0, 'alinhamento_2', NULL, 0, '2014-11-27 14:08:00', 'left', '', 207, 189, 'texto', 'desktop'),
(3377, 140, 0, 'alinhamento_3', NULL, 0, '2014-11-27 14:08:00', 'left', '', 207, 189, 'texto', 'desktop'),
(3378, 140, 0, 'margin_top', 0, 0, '2014-11-27 14:08:00', NULL, '', 207, 189, 'inteiro', 'desktop'),
(3379, 140, 0, 'margin_bottom', 0, 0, '2014-11-27 14:08:01', NULL, '', 207, 189, 'inteiro', 'desktop'),
(3380, 140, 0, 'padding_top', 0, 0, '2014-11-27 14:08:01', NULL, '', 207, 189, 'inteiro', 'desktop'),
(3381, 140, 0, 'padding_bottom', 0, 0, '2014-11-27 14:08:01', NULL, '', 207, 189, 'inteiro', 'desktop'),
(3382, 140, 0, 'is_full', 0, 0, '2014-11-27 14:08:01', NULL, '', 207, 189, 'inteiro', 'desktop'),
(3383, 140, 0, 'titulo_componente', NULL, 0, '2014-11-27 14:08:01', 'Pier Mail', '', 207, 189, 'texto', 'desktop'),
(3384, 140, 0, 'background_type', 0, 0, '2014-11-27 14:08:01', NULL, '', 207, 189, 'inteiro', 'desktop'),
(3385, 140, 0, 'background', NULL, 0, '2014-11-27 14:08:01', '', '', 207, 189, 'texto', 'desktop'),
(3386, 140, 0, 'titulo_1', NULL, 0, '2014-11-27 14:09:42', NULL, '', 207, 190, 'texto', 'desktop'),
(3387, 140, 0, 'subtitulo_1', NULL, 0, '2014-11-27 14:09:42', NULL, '', 207, 190, 'texto', 'desktop'),
(3388, 140, 0, 'texto_1', NULL, 0, '2014-11-27 14:09:42', NULL, '', 207, 190, 'texto', 'desktop'),
(3389, 140, 0, 'link_1', NULL, 0, '2014-11-27 14:09:42', NULL, '', 207, 190, 'texto', 'desktop'),
(3390, 140, 0, 'image_1', NULL, 0, '2014-11-27 14:09:42', '10_banner_buscafacil_y4.png', '', 207, 190, 'texto', 'desktop'),
(3391, 140, 0, 'layout_1', NULL, 0, '2014-11-27 14:09:42', 'up', '', 207, 190, 'texto', 'desktop'),
(3392, 140, 0, 'cor_1', NULL, 0, '2014-11-27 14:09:42', '', '', 207, 190, 'texto', 'desktop'),
(3393, 140, 0, 'cor_2', NULL, 0, '2014-11-27 14:09:42', '', '', 207, 190, 'texto', 'desktop'),
(3394, 140, 0, 'cor_3', NULL, 0, '2014-11-27 14:09:42', '', '', 207, 190, 'texto', 'desktop'),
(3395, 140, 0, 'alinhamento_1', NULL, 0, '2014-11-27 14:09:42', 'left', '', 207, 190, 'texto', 'desktop'),
(3396, 140, 0, 'alinhamento_2', NULL, 0, '2014-11-27 14:09:42', 'left', '', 207, 190, 'texto', 'desktop'),
(3397, 140, 0, 'alinhamento_3', NULL, 0, '2014-11-27 14:09:42', 'left', '', 207, 190, 'texto', 'desktop'),
(3398, 140, 0, 'margin_top', 0, 0, '2014-11-27 14:09:42', NULL, '', 207, 190, 'inteiro', 'desktop'),
(3399, 140, 0, 'margin_bottom', 0, 0, '2014-11-27 14:09:42', NULL, '', 207, 190, 'inteiro', 'desktop'),
(3400, 140, 0, 'padding_top', 0, 0, '2014-11-27 14:09:42', NULL, '', 207, 190, 'inteiro', 'desktop'),
(3401, 140, 0, 'padding_bottom', 0, 0, '2014-11-27 14:09:42', NULL, '', 207, 190, 'inteiro', 'desktop'),
(3402, 140, 0, 'is_full', 0, 0, '2014-11-27 14:09:42', NULL, '', 207, 190, 'inteiro', 'desktop'),
(3403, 140, 0, 'titulo_componente', NULL, 0, '2014-11-27 14:09:43', 'Busca Facil', '', 207, 190, 'texto', 'desktop'),
(3404, 140, 0, 'background_type', 0, 0, '2014-11-27 14:09:43', NULL, '', 207, 190, 'inteiro', 'desktop'),
(3405, 140, 0, 'background', NULL, 0, '2014-11-27 14:09:43', '', '', 207, 190, 'texto', 'desktop'),
(3406, 140, 0, 'titulo_1', NULL, 0, '2014-11-27 14:12:12', NULL, '', 207, 191, 'texto', 'desktop'),
(3407, 140, 0, 'subtitulo_1', NULL, 0, '2014-11-27 14:12:12', NULL, '', 207, 191, 'texto', 'desktop'),
(3408, 140, 0, 'texto_1', NULL, 0, '2014-11-27 14:12:12', NULL, '', 207, 191, 'texto', 'desktop'),
(3409, 140, 0, 'link_1', NULL, 0, '2014-11-27 14:12:12', NULL, '', 207, 191, 'texto', 'desktop'),
(3410, 140, 0, 'image_1', NULL, 0, '2014-11-27 14:12:12', '11_rampage_s4.png', '', 207, 191, 'texto', 'desktop');
INSERT INTO `paginas_attribute` (`id`, `id_pagina`, `user_id`, `name`, `inteiro`, `number`, `estampa`, `texto`, `descricao`, `id_componente`, `id_row`, `tipo`, `plataforma`) VALUES
(3411, 140, 0, 'layout_1', NULL, 0, '2014-11-27 14:12:12', 'up', '', 207, 191, 'texto', 'desktop'),
(3412, 140, 0, 'cor_1', NULL, 0, '2014-11-27 14:12:12', '', '', 207, 191, 'texto', 'desktop'),
(3413, 140, 0, 'cor_2', NULL, 0, '2014-11-27 14:12:12', '', '', 207, 191, 'texto', 'desktop'),
(3414, 140, 0, 'cor_3', NULL, 0, '2014-11-27 14:12:12', '', '', 207, 191, 'texto', 'desktop'),
(3415, 140, 0, 'alinhamento_1', NULL, 0, '2014-11-27 14:12:12', 'left', '', 207, 191, 'texto', 'desktop'),
(3416, 140, 0, 'alinhamento_2', NULL, 0, '2014-11-27 14:12:12', 'left', '', 207, 191, 'texto', 'desktop'),
(3417, 140, 0, 'alinhamento_3', NULL, 0, '2014-11-27 14:12:12', 'left', '', 207, 191, 'texto', 'desktop'),
(3418, 140, 0, 'margin_top', 0, 0, '2014-11-27 14:12:12', NULL, '', 207, 191, 'inteiro', 'desktop'),
(3419, 140, 0, 'margin_bottom', 0, 0, '2014-11-27 14:12:12', NULL, '', 207, 191, 'inteiro', 'desktop'),
(3420, 140, 0, 'padding_top', 0, 0, '2014-11-27 14:12:12', NULL, '', 207, 191, 'inteiro', 'desktop'),
(3421, 140, 0, 'padding_bottom', 0, 0, '2014-11-27 14:12:12', NULL, '', 207, 191, 'inteiro', 'desktop'),
(3422, 140, 0, 'is_full', 0, 0, '2014-11-27 14:12:12', NULL, '', 207, 191, 'inteiro', 'desktop'),
(3423, 140, 0, 'titulo_componente', NULL, 0, '2014-11-27 14:12:12', 'Rampage', '', 207, 191, 'texto', 'desktop'),
(3424, 140, 0, 'background_type', 0, 0, '2014-11-27 14:12:12', NULL, '', 207, 191, 'inteiro', 'desktop'),
(3425, 140, 0, 'background', NULL, 0, '2014-11-27 14:12:12', '', '', 207, 191, 'texto', 'desktop'),
(3426, 140, 0, 'titulo_1', NULL, 0, '2014-11-27 14:13:19', NULL, '', 207, 192, 'texto', 'desktop'),
(3427, 140, 0, 'subtitulo_1', NULL, 0, '2014-11-27 14:13:19', NULL, '', 207, 192, 'texto', 'desktop'),
(3428, 140, 0, 'texto_1', NULL, 0, '2014-11-27 14:13:19', NULL, '', 207, 192, 'texto', 'desktop'),
(3429, 140, 0, 'link_1', NULL, 0, '2014-11-27 14:13:19', NULL, '', 207, 192, 'texto', 'desktop'),
(3430, 140, 0, 'image_1', NULL, 0, '2014-11-27 14:13:19', '12_cosmo_p5.png', '', 207, 192, 'texto', 'desktop'),
(3431, 140, 0, 'layout_1', NULL, 0, '2014-11-27 14:13:19', 'up', '', 207, 192, 'texto', 'desktop'),
(3432, 140, 0, 'cor_1', NULL, 0, '2014-11-27 14:13:19', '', '', 207, 192, 'texto', 'desktop'),
(3433, 140, 0, 'cor_2', NULL, 0, '2014-11-27 14:13:19', '', '', 207, 192, 'texto', 'desktop'),
(3434, 140, 0, 'cor_3', NULL, 0, '2014-11-27 14:13:19', '', '', 207, 192, 'texto', 'desktop'),
(3435, 140, 0, 'alinhamento_1', NULL, 0, '2014-11-27 14:13:19', 'left', '', 207, 192, 'texto', 'desktop'),
(3436, 140, 0, 'alinhamento_2', NULL, 0, '2014-11-27 14:13:19', 'left', '', 207, 192, 'texto', 'desktop'),
(3437, 140, 0, 'alinhamento_3', NULL, 0, '2014-11-27 14:13:19', 'left', '', 207, 192, 'texto', 'desktop'),
(3438, 140, 0, 'margin_top', 0, 0, '2014-11-27 14:13:19', NULL, '', 207, 192, 'inteiro', 'desktop'),
(3439, 140, 0, 'margin_bottom', 0, 0, '2014-11-27 14:13:19', NULL, '', 207, 192, 'inteiro', 'desktop'),
(3440, 140, 0, 'padding_top', 0, 0, '2014-11-27 14:13:20', NULL, '', 207, 192, 'inteiro', 'desktop'),
(3441, 140, 0, 'padding_bottom', 0, 0, '2014-11-27 14:13:20', NULL, '', 207, 192, 'inteiro', 'desktop'),
(3442, 140, 0, 'is_full', 0, 0, '2014-11-27 14:13:20', NULL, '', 207, 192, 'inteiro', 'desktop'),
(3443, 140, 0, 'titulo_componente', NULL, 0, '2014-11-27 14:13:20', 'Cosmos', '', 207, 192, 'texto', 'desktop'),
(3444, 140, 0, 'background_type', 0, 0, '2014-11-27 14:13:20', NULL, '', 207, 192, 'inteiro', 'desktop'),
(3445, 140, 0, 'background', NULL, 0, '2014-11-27 14:13:20', '', '', 207, 192, 'texto', 'desktop'),
(3446, 140, 0, 'titulo_1', NULL, 0, '2014-11-27 14:15:54', NULL, '', 207, 193, 'texto', 'desktop'),
(3447, 140, 0, 'subtitulo_1', NULL, 0, '2014-11-27 14:15:54', NULL, '', 207, 193, 'texto', 'desktop'),
(3448, 140, 0, 'texto_1', NULL, 0, '2014-11-27 14:15:54', NULL, '', 207, 193, 'texto', 'desktop'),
(3449, 140, 0, 'link_1', NULL, 0, '2014-11-27 14:15:54', NULL, '', 207, 193, 'texto', 'desktop'),
(3450, 140, 0, 'image_1', NULL, 0, '2014-11-27 14:15:54', '8_banners_klondike_p1.png', '', 207, 193, 'texto', 'desktop'),
(3451, 140, 0, 'layout_1', NULL, 0, '2014-11-27 14:15:54', 'up', '', 207, 193, 'texto', 'desktop'),
(3452, 140, 0, 'cor_1', NULL, 0, '2014-11-27 14:15:54', '', '', 207, 193, 'texto', 'desktop'),
(3453, 140, 0, 'cor_2', NULL, 0, '2014-11-27 14:15:54', '', '', 207, 193, 'texto', 'desktop'),
(3454, 140, 0, 'cor_3', NULL, 0, '2014-11-27 14:15:54', '', '', 207, 193, 'texto', 'desktop'),
(3455, 140, 0, 'alinhamento_1', NULL, 0, '2014-11-27 14:15:54', 'left', '', 207, 193, 'texto', 'desktop'),
(3456, 140, 0, 'alinhamento_2', NULL, 0, '2014-11-27 14:15:54', 'left', '', 207, 193, 'texto', 'desktop'),
(3457, 140, 0, 'alinhamento_3', NULL, 0, '2014-11-27 14:15:54', 'left', '', 207, 193, 'texto', 'desktop'),
(3458, 140, 0, 'margin_top', 0, 0, '2014-11-27 14:15:54', NULL, '', 207, 193, 'inteiro', 'desktop'),
(3459, 140, 0, 'margin_bottom', 0, 0, '2014-11-27 14:15:54', NULL, '', 207, 193, 'inteiro', 'desktop'),
(3460, 140, 0, 'padding_top', 0, 0, '2014-11-27 14:15:54', NULL, '', 207, 193, 'inteiro', 'desktop'),
(3461, 140, 0, 'padding_bottom', 0, 0, '2014-11-27 14:15:54', NULL, '', 207, 193, 'inteiro', 'desktop'),
(3462, 140, 0, 'is_full', 0, 0, '2014-11-27 14:15:54', NULL, '', 207, 193, 'inteiro', 'desktop'),
(3463, 140, 0, 'titulo_componente', NULL, 0, '2014-11-27 14:15:54', 'Klondike', '', 207, 193, 'texto', 'desktop'),
(3464, 140, 0, 'background_type', 0, 0, '2014-11-27 14:15:54', NULL, '', 207, 193, 'inteiro', 'desktop'),
(3465, 140, 0, 'background', NULL, 0, '2014-11-27 14:15:54', '', '', 207, 193, 'texto', 'desktop'),
(3466, 140, 0, 'titulo_1', NULL, 0, '2014-11-27 14:18:25', NULL, '', 207, 194, 'texto', 'desktop'),
(3467, 140, 0, 'subtitulo_1', NULL, 0, '2014-11-27 14:18:25', NULL, '', 207, 194, 'texto', 'desktop'),
(3468, 140, 0, 'texto_1', NULL, 0, '2014-11-27 14:18:25', NULL, '', 207, 194, 'texto', 'desktop'),
(3469, 140, 0, 'link_1', NULL, 0, '2014-11-27 14:18:25', NULL, '', 207, 194, 'texto', 'desktop'),
(3470, 140, 0, 'image_1', NULL, 0, '2014-11-27 14:18:25', 'redesocial_facebook_v4.png', '', 207, 194, 'texto', 'desktop'),
(3471, 140, 0, 'layout_1', NULL, 0, '2014-11-27 14:18:25', 'up', '', 207, 194, 'texto', 'desktop'),
(3472, 140, 0, 'cor_1', NULL, 0, '2014-11-27 14:18:25', '', '', 207, 194, 'texto', 'desktop'),
(3473, 140, 0, 'cor_2', NULL, 0, '2014-11-27 14:18:25', '', '', 207, 194, 'texto', 'desktop'),
(3474, 140, 0, 'cor_3', NULL, 0, '2014-11-27 14:18:25', '', '', 207, 194, 'texto', 'desktop'),
(3475, 140, 0, 'alinhamento_1', NULL, 0, '2014-11-27 14:18:25', 'left', '', 207, 194, 'texto', 'desktop'),
(3476, 140, 0, 'alinhamento_2', NULL, 0, '2014-11-27 14:18:25', 'left', '', 207, 194, 'texto', 'desktop'),
(3477, 140, 0, 'alinhamento_3', NULL, 0, '2014-11-27 14:18:25', 'left', '', 207, 194, 'texto', 'desktop'),
(3478, 140, 0, 'margin_top', 0, 0, '2014-11-27 14:18:25', NULL, '', 207, 194, 'inteiro', 'desktop'),
(3479, 140, 0, 'margin_bottom', 0, 0, '2014-11-27 14:18:25', NULL, '', 207, 194, 'inteiro', 'desktop'),
(3480, 140, 0, 'padding_top', 0, 0, '2014-11-27 14:18:25', NULL, '', 207, 194, 'inteiro', 'desktop'),
(3481, 140, 0, 'padding_bottom', 0, 0, '2014-11-27 14:18:25', NULL, '', 207, 194, 'inteiro', 'desktop'),
(3482, 140, 0, 'is_full', 0, 0, '2014-11-27 14:18:25', NULL, '', 207, 194, 'inteiro', 'desktop'),
(3483, 140, 0, 'titulo_componente', NULL, 0, '2014-11-27 14:18:25', 'Facebook', '', 207, 194, 'texto', 'desktop'),
(3484, 140, 0, 'background_type', 0, 0, '2014-11-27 14:18:25', NULL, '', 207, 194, 'inteiro', 'desktop'),
(3485, 140, 0, 'background', NULL, 0, '2014-11-27 14:18:25', '', '', 207, 194, 'texto', 'desktop'),
(3486, 140, 0, 'titulo_1', NULL, 0, '2014-11-27 14:23:50', NULL, '', 207, 195, 'texto', 'desktop'),
(3487, 140, 0, 'subtitulo_1', NULL, 0, '2014-11-27 14:23:50', NULL, '', 207, 195, 'texto', 'desktop'),
(3488, 140, 0, 'texto_1', NULL, 0, '2014-11-27 14:23:50', NULL, '', 207, 195, 'texto', 'desktop'),
(3489, 140, 0, 'link_1', NULL, 0, '2014-11-27 14:23:50', NULL, '', 207, 195, 'texto', 'desktop'),
(3490, 140, 0, 'image_1', NULL, 0, '2014-11-27 14:23:50', 'artigo_oklahoma_m7.png', '', 207, 195, 'texto', 'desktop'),
(3491, 140, 0, 'layout_1', NULL, 0, '2014-11-27 14:23:50', 'up', '', 207, 195, 'texto', 'desktop'),
(3492, 140, 0, 'cor_1', NULL, 0, '2014-11-27 14:23:50', '', '', 207, 195, 'texto', 'desktop'),
(3493, 140, 0, 'cor_2', NULL, 0, '2014-11-27 14:23:50', '', '', 207, 195, 'texto', 'desktop'),
(3494, 140, 0, 'cor_3', NULL, 0, '2014-11-27 14:23:50', '', '', 207, 195, 'texto', 'desktop'),
(3495, 140, 0, 'alinhamento_1', NULL, 0, '2014-11-27 14:23:50', 'left', '', 207, 195, 'texto', 'desktop'),
(3496, 140, 0, 'alinhamento_2', NULL, 0, '2014-11-27 14:23:50', 'left', '', 207, 195, 'texto', 'desktop'),
(3497, 140, 0, 'alinhamento_3', NULL, 0, '2014-11-27 14:23:50', 'left', '', 207, 195, 'texto', 'desktop'),
(3498, 140, 0, 'margin_top', 0, 0, '2014-11-27 14:23:50', NULL, '', 207, 195, 'inteiro', 'desktop'),
(3499, 140, 0, 'margin_bottom', 0, 0, '2014-11-27 14:23:50', NULL, '', 207, 195, 'inteiro', 'desktop'),
(3500, 140, 0, 'padding_top', 0, 0, '2014-11-27 14:23:50', NULL, '', 207, 195, 'inteiro', 'desktop'),
(3501, 140, 0, 'padding_bottom', 0, 0, '2014-11-27 14:23:50', NULL, '', 207, 195, 'inteiro', 'desktop'),
(3502, 140, 0, 'is_full', 0, 0, '2014-11-27 14:23:50', NULL, '', 207, 195, 'inteiro', 'desktop'),
(3503, 140, 0, 'titulo_componente', NULL, 0, '2014-11-27 14:23:50', 'Oklahoma', '', 207, 195, 'texto', 'desktop'),
(3504, 140, 0, 'background_type', 0, 0, '2014-11-27 14:23:50', NULL, '', 207, 195, 'inteiro', 'desktop'),
(3505, 140, 0, 'background', NULL, 0, '2014-11-27 14:23:50', '', '', 207, 195, 'texto', 'desktop'),
(3506, 140, 0, 'titulo_1', NULL, 0, '2014-11-27 14:34:59', NULL, '', 207, 196, 'texto', 'desktop'),
(3507, 140, 0, 'subtitulo_1', NULL, 0, '2014-11-27 14:35:00', NULL, '', 207, 196, 'texto', 'desktop'),
(3508, 140, 0, 'texto_1', NULL, 0, '2014-11-27 14:35:00', NULL, '', 207, 196, 'texto', 'desktop'),
(3509, 140, 0, 'link_1', NULL, 0, '2014-11-27 14:35:00', NULL, '', 207, 196, 'texto', 'desktop'),
(3510, 140, 0, 'image_1', NULL, 0, '2014-11-27 14:35:00', 'artigo_washington_h3.png', '', 207, 196, 'texto', 'desktop'),
(3511, 140, 0, 'layout_1', NULL, 0, '2014-11-27 14:35:00', 'up', '', 207, 196, 'texto', 'desktop'),
(3512, 140, 0, 'cor_1', NULL, 0, '2014-11-27 14:35:00', '', '', 207, 196, 'texto', 'desktop'),
(3513, 140, 0, 'cor_2', NULL, 0, '2014-11-27 14:35:01', '', '', 207, 196, 'texto', 'desktop'),
(3514, 140, 0, 'cor_3', NULL, 0, '2014-11-27 14:35:01', '', '', 207, 196, 'texto', 'desktop'),
(3515, 140, 0, 'alinhamento_1', NULL, 0, '2014-11-27 14:35:01', 'left', '', 207, 196, 'texto', 'desktop'),
(3516, 140, 0, 'alinhamento_2', NULL, 0, '2014-11-27 14:35:01', 'left', '', 207, 196, 'texto', 'desktop'),
(3517, 140, 0, 'alinhamento_3', NULL, 0, '2014-11-27 14:35:01', 'left', '', 207, 196, 'texto', 'desktop'),
(3518, 140, 0, 'margin_top', 0, 0, '2014-11-27 14:35:01', NULL, '', 207, 196, 'inteiro', 'desktop'),
(3519, 140, 0, 'margin_bottom', 0, 0, '2014-11-27 14:35:01', NULL, '', 207, 196, 'inteiro', 'desktop'),
(3520, 140, 0, 'padding_top', 0, 0, '2014-11-27 14:35:01', NULL, '', 207, 196, 'inteiro', 'desktop'),
(3521, 140, 0, 'padding_bottom', 0, 0, '2014-11-27 14:35:01', NULL, '', 207, 196, 'inteiro', 'desktop'),
(3522, 140, 0, 'is_full', 0, 0, '2014-11-27 14:35:01', NULL, '', 207, 196, 'inteiro', 'desktop'),
(3523, 140, 0, 'titulo_componente', NULL, 0, '2014-11-27 14:35:01', 'Artigo Washigton', '', 207, 196, 'texto', 'desktop'),
(3524, 140, 0, 'background_type', 0, 0, '2014-11-27 14:35:02', NULL, '', 207, 196, 'inteiro', 'desktop'),
(3525, 140, 0, 'background', NULL, 0, '2014-11-27 14:35:02', '', '', 207, 196, 'texto', 'desktop'),
(3526, 140, 0, 'titulo_1', NULL, 0, '2014-11-27 14:41:23', NULL, '', 207, 197, 'texto', 'desktop'),
(3527, 140, 0, 'subtitulo_1', NULL, 0, '2014-11-27 14:41:24', NULL, '', 207, 197, 'texto', 'desktop'),
(3528, 140, 0, 'texto_1', NULL, 0, '2014-11-27 14:41:24', NULL, '', 207, 197, 'texto', 'desktop'),
(3529, 140, 0, 'link_1', NULL, 0, '2014-11-27 14:41:24', NULL, '', 207, 197, 'texto', 'desktop'),
(3530, 140, 0, 'image_1', NULL, 0, '2014-11-27 14:41:24', '14_menu_mega_e3.png', '', 207, 197, 'texto', 'desktop'),
(3531, 140, 0, 'layout_1', NULL, 0, '2014-11-27 14:41:24', 'up', '', 207, 197, 'texto', 'desktop'),
(3532, 140, 0, 'cor_1', NULL, 0, '2014-11-27 14:41:24', '', '', 207, 197, 'texto', 'desktop'),
(3533, 140, 0, 'cor_2', NULL, 0, '2014-11-27 14:41:24', '', '', 207, 197, 'texto', 'desktop'),
(3534, 140, 0, 'cor_3', NULL, 0, '2014-11-27 14:41:24', '', '', 207, 197, 'texto', 'desktop'),
(3535, 140, 0, 'alinhamento_1', NULL, 0, '2014-11-27 14:41:25', 'left', '', 207, 197, 'texto', 'desktop'),
(3536, 140, 0, 'alinhamento_2', NULL, 0, '2014-11-27 14:41:25', 'left', '', 207, 197, 'texto', 'desktop'),
(3537, 140, 0, 'alinhamento_3', NULL, 0, '2014-11-27 14:41:25', 'left', '', 207, 197, 'texto', 'desktop'),
(3538, 140, 0, 'margin_top', 0, 0, '2014-11-27 14:41:25', NULL, '', 207, 197, 'inteiro', 'desktop'),
(3539, 140, 0, 'margin_bottom', 0, 0, '2014-11-27 14:41:25', NULL, '', 207, 197, 'inteiro', 'desktop'),
(3540, 140, 0, 'padding_top', 0, 0, '2014-11-27 14:41:25', NULL, '', 207, 197, 'inteiro', 'desktop'),
(3541, 140, 0, 'padding_bottom', 0, 0, '2014-11-27 14:41:25', NULL, '', 207, 197, 'inteiro', 'desktop'),
(3542, 140, 0, 'is_full', 0, 0, '2014-11-27 14:41:26', NULL, '', 207, 197, 'inteiro', 'desktop'),
(3543, 140, 0, 'titulo_componente', NULL, 0, '2014-11-27 14:41:26', 'Mega Menu', '', 207, 197, 'texto', 'desktop'),
(3544, 140, 0, 'background_type', 0, 0, '2014-11-27 14:41:26', NULL, '', 207, 197, 'inteiro', 'desktop'),
(3545, 140, 0, 'background', NULL, 0, '2014-11-27 14:41:26', '', '', 207, 197, 'texto', 'desktop'),
(3546, 140, 0, 'titulo_1', NULL, 0, '2014-11-27 14:45:37', NULL, '', 207, 198, 'texto', 'desktop'),
(3547, 140, 0, 'subtitulo_1', NULL, 0, '2014-11-27 14:45:37', NULL, '', 207, 198, 'texto', 'desktop'),
(3548, 140, 0, 'texto_1', NULL, 0, '2014-11-27 14:45:37', NULL, '', 207, 198, 'texto', 'desktop'),
(3549, 140, 0, 'link_1', NULL, 0, '2014-11-27 14:45:37', NULL, '', 207, 198, 'texto', 'desktop'),
(3550, 140, 0, 'image_1', NULL, 0, '2014-11-27 14:45:37', '13_pierboletos_b3.png', '', 207, 198, 'texto', 'desktop'),
(3551, 140, 0, 'layout_1', NULL, 0, '2014-11-27 14:45:37', 'up', '', 207, 198, 'texto', 'desktop'),
(3552, 140, 0, 'cor_1', NULL, 0, '2014-11-27 14:45:37', '', '', 207, 198, 'texto', 'desktop'),
(3553, 140, 0, 'cor_2', NULL, 0, '2014-11-27 14:45:37', '', '', 207, 198, 'texto', 'desktop'),
(3554, 140, 0, 'cor_3', NULL, 0, '2014-11-27 14:45:37', '', '', 207, 198, 'texto', 'desktop'),
(3555, 140, 0, 'alinhamento_1', NULL, 0, '2014-11-27 14:45:38', 'left', '', 207, 198, 'texto', 'desktop'),
(3556, 140, 0, 'alinhamento_2', NULL, 0, '2014-11-27 14:45:38', 'left', '', 207, 198, 'texto', 'desktop'),
(3557, 140, 0, 'alinhamento_3', NULL, 0, '2014-11-27 14:45:38', 'left', '', 207, 198, 'texto', 'desktop'),
(3558, 140, 0, 'margin_top', 0, 0, '2014-11-27 14:45:38', NULL, '', 207, 198, 'inteiro', 'desktop'),
(3559, 140, 0, 'margin_bottom', 0, 0, '2014-11-27 14:45:38', NULL, '', 207, 198, 'inteiro', 'desktop'),
(3560, 140, 0, 'padding_top', 0, 0, '2014-11-27 14:45:38', NULL, '', 207, 198, 'inteiro', 'desktop'),
(3561, 140, 0, 'padding_bottom', 0, 0, '2014-11-27 14:45:38', NULL, '', 207, 198, 'inteiro', 'desktop'),
(3562, 140, 0, 'is_full', 0, 0, '2014-11-27 14:45:39', NULL, '', 207, 198, 'inteiro', 'desktop'),
(3563, 140, 0, 'titulo_componente', NULL, 0, '2014-11-27 14:45:39', 'Pier boletos', '', 207, 198, 'texto', 'desktop'),
(3564, 140, 0, 'background_type', 0, 0, '2014-11-27 14:45:39', NULL, '', 207, 198, 'inteiro', 'desktop'),
(3565, 140, 0, 'background', NULL, 0, '2014-11-27 14:45:39', '', '', 207, 198, 'texto', 'desktop'),
(3566, 140, 0, 'titulo_1', NULL, 0, '2014-11-27 14:49:08', NULL, '', 207, 199, 'texto', 'desktop'),
(3567, 140, 0, 'subtitulo_1', NULL, 0, '2014-11-27 14:49:08', NULL, '', 207, 199, 'texto', 'desktop'),
(3568, 140, 0, 'texto_1', NULL, 0, '2014-11-27 14:49:08', NULL, '', 207, 199, 'texto', 'desktop'),
(3569, 140, 0, 'link_1', NULL, 0, '2014-11-27 14:49:08', NULL, '', 207, 199, 'texto', 'desktop'),
(3570, 140, 0, 'image_1', NULL, 0, '2014-11-27 14:49:08', '7_tarjenta_london_phone_b6.png', '', 207, 199, 'texto', 'desktop'),
(3571, 140, 0, 'layout_1', NULL, 0, '2014-11-27 14:49:08', 'up', '', 207, 199, 'texto', 'desktop'),
(3572, 140, 0, 'cor_1', NULL, 0, '2014-11-27 14:49:08', '', '', 207, 199, 'texto', 'desktop'),
(3573, 140, 0, 'cor_2', NULL, 0, '2014-11-27 14:49:08', '', '', 207, 199, 'texto', 'desktop'),
(3574, 140, 0, 'cor_3', NULL, 0, '2014-11-27 14:49:08', '', '', 207, 199, 'texto', 'desktop'),
(3575, 140, 0, 'alinhamento_1', NULL, 0, '2014-11-27 14:49:08', 'left', '', 207, 199, 'texto', 'desktop'),
(3576, 140, 0, 'alinhamento_2', NULL, 0, '2014-11-27 14:49:08', 'left', '', 207, 199, 'texto', 'desktop'),
(3577, 140, 0, 'alinhamento_3', NULL, 0, '2014-11-27 14:49:08', 'left', '', 207, 199, 'texto', 'desktop'),
(3578, 140, 0, 'margin_top', 0, 0, '2014-11-27 14:49:08', NULL, '', 207, 199, 'inteiro', 'desktop'),
(3579, 140, 0, 'margin_bottom', 0, 0, '2014-11-27 14:49:08', NULL, '', 207, 199, 'inteiro', 'desktop'),
(3580, 140, 0, 'padding_top', 0, 0, '2014-11-27 14:49:08', NULL, '', 207, 199, 'inteiro', 'desktop'),
(3581, 140, 0, 'padding_bottom', 0, 0, '2014-11-27 14:49:08', NULL, '', 207, 199, 'inteiro', 'desktop'),
(3582, 140, 0, 'is_full', 0, 0, '2014-11-27 14:49:08', NULL, '', 207, 199, 'inteiro', 'desktop'),
(3583, 140, 0, 'titulo_componente', NULL, 0, '2014-11-27 14:49:08', 'Tarjeta london', '', 207, 199, 'texto', 'desktop'),
(3584, 140, 0, 'background_type', 0, 0, '2014-11-27 14:49:08', NULL, '', 207, 199, 'inteiro', 'desktop'),
(3585, 140, 0, 'background', NULL, 0, '2014-11-27 14:49:08', '', '', 207, 199, 'texto', 'desktop'),
(3586, 140, 0, 'titulo_1', NULL, 0, '2014-11-27 14:50:12', NULL, '', 207, 200, 'texto', 'desktop'),
(3587, 140, 0, 'subtitulo_1', NULL, 0, '2014-11-27 14:50:12', NULL, '', 207, 200, 'texto', 'desktop'),
(3588, 140, 0, 'texto_1', NULL, 0, '2014-11-27 14:50:12', NULL, '', 207, 200, 'texto', 'desktop'),
(3589, 140, 0, 'link_1', NULL, 0, '2014-11-27 14:50:12', NULL, '', 207, 200, 'texto', 'desktop'),
(3590, 140, 0, 'image_1', NULL, 0, '2014-11-27 14:50:12', '9_folha_pedidos_r8.png', '', 207, 200, 'texto', 'desktop'),
(3591, 140, 0, 'layout_1', NULL, 0, '2014-11-27 14:50:12', 'up', '', 207, 200, 'texto', 'desktop'),
(3592, 140, 0, 'cor_1', NULL, 0, '2014-11-27 14:50:12', '', '', 207, 200, 'texto', 'desktop'),
(3593, 140, 0, 'cor_2', NULL, 0, '2014-11-27 14:50:12', '', '', 207, 200, 'texto', 'desktop'),
(3594, 140, 0, 'cor_3', NULL, 0, '2014-11-27 14:50:12', '', '', 207, 200, 'texto', 'desktop'),
(3595, 140, 0, 'alinhamento_1', NULL, 0, '2014-11-27 14:50:12', 'left', '', 207, 200, 'texto', 'desktop'),
(3596, 140, 0, 'alinhamento_2', NULL, 0, '2014-11-27 14:50:12', 'left', '', 207, 200, 'texto', 'desktop'),
(3597, 140, 0, 'alinhamento_3', NULL, 0, '2014-11-27 14:50:12', 'left', '', 207, 200, 'texto', 'desktop'),
(3598, 140, 0, 'margin_top', 0, 0, '2014-11-27 14:50:12', NULL, '', 207, 200, 'inteiro', 'desktop'),
(3599, 140, 0, 'margin_bottom', 0, 0, '2014-11-27 14:50:12', NULL, '', 207, 200, 'inteiro', 'desktop'),
(3600, 140, 0, 'padding_top', 0, 0, '2014-11-27 14:50:12', NULL, '', 207, 200, 'inteiro', 'desktop'),
(3601, 140, 0, 'padding_bottom', 0, 0, '2014-11-27 14:50:12', NULL, '', 207, 200, 'inteiro', 'desktop'),
(3602, 140, 0, 'is_full', 0, 0, '2014-11-27 14:50:12', NULL, '', 207, 200, 'inteiro', 'desktop'),
(3603, 140, 0, 'titulo_componente', NULL, 0, '2014-11-27 14:50:12', 'Folha de pedidos', '', 207, 200, 'texto', 'desktop'),
(3604, 140, 0, 'background_type', 0, 0, '2014-11-27 14:50:12', NULL, '', 207, 200, 'inteiro', 'desktop'),
(3605, 140, 0, 'background', NULL, 0, '2014-11-27 14:50:12', '', '', 207, 200, 'texto', 'desktop'),
(3606, 140, 0, 'titulo_1', NULL, 0, '2014-11-27 14:52:10', NULL, '', 207, 201, 'texto', 'desktop'),
(3607, 140, 0, 'subtitulo_1', NULL, 0, '2014-11-27 14:52:10', NULL, '', 207, 201, 'texto', 'desktop'),
(3608, 140, 0, 'texto_1', NULL, 0, '2014-11-27 14:52:10', NULL, '', 207, 201, 'texto', 'desktop'),
(3609, 140, 0, 'link_1', NULL, 0, '2014-11-27 14:52:10', NULL, '', 207, 201, 'texto', 'desktop'),
(3610, 140, 0, 'image_1', NULL, 0, '2014-11-27 14:52:10', '1_cincinnati_artigo_k1.png', '', 207, 201, 'texto', 'desktop'),
(3611, 140, 0, 'layout_1', NULL, 0, '2014-11-27 14:52:10', 'up', '', 207, 201, 'texto', 'desktop'),
(3612, 140, 0, 'cor_1', NULL, 0, '2014-11-27 14:52:10', '', '', 207, 201, 'texto', 'desktop'),
(3613, 140, 0, 'cor_2', NULL, 0, '2014-11-27 14:52:10', '', '', 207, 201, 'texto', 'desktop'),
(3614, 140, 0, 'cor_3', NULL, 0, '2014-11-27 14:52:10', '', '', 207, 201, 'texto', 'desktop'),
(3615, 140, 0, 'alinhamento_1', NULL, 0, '2014-11-27 14:52:10', 'left', '', 207, 201, 'texto', 'desktop'),
(3616, 140, 0, 'alinhamento_2', NULL, 0, '2014-11-27 14:52:10', 'left', '', 207, 201, 'texto', 'desktop'),
(3617, 140, 0, 'alinhamento_3', NULL, 0, '2014-11-27 14:52:10', 'left', '', 207, 201, 'texto', 'desktop'),
(3618, 140, 0, 'margin_top', 0, 0, '2014-11-27 14:52:10', NULL, '', 207, 201, 'inteiro', 'desktop'),
(3619, 140, 0, 'margin_bottom', 0, 0, '2014-11-27 14:52:10', NULL, '', 207, 201, 'inteiro', 'desktop'),
(3620, 140, 0, 'padding_top', 0, 0, '2014-11-27 14:52:10', NULL, '', 207, 201, 'inteiro', 'desktop'),
(3621, 140, 0, 'padding_bottom', 0, 0, '2014-11-27 14:52:10', NULL, '', 207, 201, 'inteiro', 'desktop'),
(3622, 140, 0, 'is_full', 0, 0, '2014-11-27 14:52:10', NULL, '', 207, 201, 'inteiro', 'desktop'),
(3623, 140, 0, 'titulo_componente', NULL, 0, '2014-11-27 14:52:10', 'Cincinnati', '', 207, 201, 'texto', 'desktop'),
(3624, 140, 0, 'background_type', 0, 0, '2014-11-27 14:52:10', NULL, '', 207, 201, 'inteiro', 'desktop'),
(3625, 140, 0, 'background', NULL, 0, '2014-11-27 14:52:10', '', '', 207, 201, 'texto', 'desktop'),
(3626, 140, 0, 'titulo_1', NULL, 0, '2014-11-27 14:54:04', NULL, '', 207, 202, 'texto', 'desktop'),
(3627, 140, 0, 'subtitulo_1', NULL, 0, '2014-11-27 14:54:04', NULL, '', 207, 202, 'texto', 'desktop'),
(3628, 140, 0, 'texto_1', NULL, 0, '2014-11-27 14:54:04', NULL, '', 207, 202, 'texto', 'desktop'),
(3629, 140, 0, 'link_1', NULL, 0, '2014-11-27 14:54:04', NULL, '', 207, 202, 'texto', 'desktop'),
(3630, 140, 0, 'image_1', NULL, 0, '2014-11-27 14:54:04', '5_newsletter_portland_h0.png', '', 207, 202, 'texto', 'desktop'),
(3631, 140, 0, 'layout_1', NULL, 0, '2014-11-27 14:54:04', 'up', '', 207, 202, 'texto', 'desktop'),
(3632, 140, 0, 'cor_1', NULL, 0, '2014-11-27 14:54:04', '', '', 207, 202, 'texto', 'desktop'),
(3633, 140, 0, 'cor_2', NULL, 0, '2014-11-27 14:54:04', '', '', 207, 202, 'texto', 'desktop'),
(3634, 140, 0, 'cor_3', NULL, 0, '2014-11-27 14:54:04', '', '', 207, 202, 'texto', 'desktop'),
(3635, 140, 0, 'alinhamento_1', NULL, 0, '2014-11-27 14:54:04', 'left', '', 207, 202, 'texto', 'desktop'),
(3636, 140, 0, 'alinhamento_2', NULL, 0, '2014-11-27 14:54:04', 'left', '', 207, 202, 'texto', 'desktop'),
(3637, 140, 0, 'alinhamento_3', NULL, 0, '2014-11-27 14:54:04', 'left', '', 207, 202, 'texto', 'desktop'),
(3638, 140, 0, 'margin_top', 0, 0, '2014-11-27 14:54:04', NULL, '', 207, 202, 'inteiro', 'desktop'),
(3639, 140, 0, 'margin_bottom', 0, 0, '2014-11-27 14:54:04', NULL, '', 207, 202, 'inteiro', 'desktop'),
(3640, 140, 0, 'padding_top', 0, 0, '2014-11-27 14:54:04', NULL, '', 207, 202, 'inteiro', 'desktop'),
(3641, 140, 0, 'padding_bottom', 0, 0, '2014-11-27 14:54:04', NULL, '', 207, 202, 'inteiro', 'desktop'),
(3642, 140, 0, 'is_full', 0, 0, '2014-11-27 14:54:04', NULL, '', 207, 202, 'inteiro', 'desktop'),
(3643, 140, 0, 'titulo_componente', NULL, 0, '2014-11-27 14:54:04', 'Newsletter Portland', '', 207, 202, 'texto', 'desktop'),
(3644, 140, 0, 'background_type', 0, 0, '2014-11-27 14:54:04', NULL, '', 207, 202, 'inteiro', 'desktop'),
(3645, 140, 0, 'background', NULL, 0, '2014-11-27 14:54:04', '', '', 207, 202, 'texto', 'desktop'),
(3646, 140, 0, 'titulo_1', NULL, 0, '2014-11-27 14:56:06', NULL, '', 207, 203, 'texto', 'desktop'),
(3647, 140, 0, 'subtitulo_1', NULL, 0, '2014-11-27 14:56:06', NULL, '', 207, 203, 'texto', 'desktop'),
(3648, 140, 0, 'texto_1', NULL, 0, '2014-11-27 14:56:06', NULL, '', 207, 203, 'texto', 'desktop'),
(3649, 140, 0, 'link_1', NULL, 0, '2014-11-27 14:56:06', NULL, '', 207, 203, 'texto', 'desktop'),
(3650, 140, 0, 'image_1', NULL, 0, '2014-11-27 14:56:06', '4_tarjenta_destaque_s4.png', '', 207, 203, 'texto', 'desktop'),
(3651, 140, 0, 'layout_1', NULL, 0, '2014-11-27 14:56:06', 'up', '', 207, 203, 'texto', 'desktop'),
(3652, 140, 0, 'cor_1', NULL, 0, '2014-11-27 14:56:06', '', '', 207, 203, 'texto', 'desktop'),
(3653, 140, 0, 'cor_2', NULL, 0, '2014-11-27 14:56:06', '', '', 207, 203, 'texto', 'desktop'),
(3654, 140, 0, 'cor_3', NULL, 0, '2014-11-27 14:56:06', '', '', 207, 203, 'texto', 'desktop'),
(3655, 140, 0, 'alinhamento_1', NULL, 0, '2014-11-27 14:56:06', 'left', '', 207, 203, 'texto', 'desktop'),
(3656, 140, 0, 'alinhamento_2', NULL, 0, '2014-11-27 14:56:06', 'left', '', 207, 203, 'texto', 'desktop'),
(3657, 140, 0, 'alinhamento_3', NULL, 0, '2014-11-27 14:56:06', 'left', '', 207, 203, 'texto', 'desktop'),
(3658, 140, 0, 'margin_top', 0, 0, '2014-11-27 14:56:06', NULL, '', 207, 203, 'inteiro', 'desktop'),
(3659, 140, 0, 'margin_bottom', 0, 0, '2014-11-27 14:56:06', NULL, '', 207, 203, 'inteiro', 'desktop'),
(3660, 140, 0, 'padding_top', 0, 0, '2014-11-27 14:56:06', NULL, '', 207, 203, 'inteiro', 'desktop'),
(3661, 140, 0, 'padding_bottom', 0, 0, '2014-11-27 14:56:06', NULL, '', 207, 203, 'inteiro', 'desktop'),
(3662, 140, 0, 'is_full', 0, 0, '2014-11-27 14:56:06', NULL, '', 207, 203, 'inteiro', 'desktop'),
(3663, 140, 0, 'titulo_componente', NULL, 0, '2014-11-27 14:56:06', 'Tarjeta Destaque', '', 207, 203, 'texto', 'desktop'),
(3664, 140, 0, 'background_type', 0, 0, '2014-11-27 14:56:06', NULL, '', 207, 203, 'inteiro', 'desktop'),
(3665, 140, 0, 'background', NULL, 0, '2014-11-27 14:56:06', '', '', 207, 203, 'texto', 'desktop'),
(3666, 140, 0, 'titulo_1', NULL, 0, '2014-11-27 14:58:16', NULL, '', 207, 204, 'texto', 'desktop'),
(3667, 140, 0, 'subtitulo_1', NULL, 0, '2014-11-27 14:58:16', NULL, '', 207, 204, 'texto', 'desktop'),
(3668, 140, 0, 'texto_1', NULL, 0, '2014-11-27 14:58:16', NULL, '', 207, 204, 'texto', 'desktop'),
(3669, 140, 0, 'link_1', NULL, 0, '2014-11-27 14:58:16', NULL, '', 207, 204, 'texto', 'desktop'),
(3670, 140, 0, 'image_1', NULL, 0, '2014-11-27 14:58:16', '2_galeria_lasvegas_u4.png', '', 207, 204, 'texto', 'desktop'),
(3671, 140, 0, 'layout_1', NULL, 0, '2014-11-27 14:58:16', 'up', '', 207, 204, 'texto', 'desktop'),
(3672, 140, 0, 'cor_1', NULL, 0, '2014-11-27 14:58:16', '', '', 207, 204, 'texto', 'desktop'),
(3673, 140, 0, 'cor_2', NULL, 0, '2014-11-27 14:58:16', '', '', 207, 204, 'texto', 'desktop'),
(3674, 140, 0, 'cor_3', NULL, 0, '2014-11-27 14:58:16', '', '', 207, 204, 'texto', 'desktop'),
(3675, 140, 0, 'alinhamento_1', NULL, 0, '2014-11-27 14:58:16', 'left', '', 207, 204, 'texto', 'desktop'),
(3676, 140, 0, 'alinhamento_2', NULL, 0, '2014-11-27 14:58:16', 'left', '', 207, 204, 'texto', 'desktop'),
(3677, 140, 0, 'alinhamento_3', NULL, 0, '2014-11-27 14:58:16', 'left', '', 207, 204, 'texto', 'desktop'),
(3678, 140, 0, 'margin_top', 0, 0, '2014-11-27 14:58:16', NULL, '', 207, 204, 'inteiro', 'desktop'),
(3679, 140, 0, 'margin_bottom', 0, 0, '2014-11-27 14:58:16', NULL, '', 207, 204, 'inteiro', 'desktop'),
(3680, 140, 0, 'padding_top', 0, 0, '2014-11-27 14:58:16', NULL, '', 207, 204, 'inteiro', 'desktop'),
(3681, 140, 0, 'padding_bottom', 0, 0, '2014-11-27 14:58:16', NULL, '', 207, 204, 'inteiro', 'desktop'),
(3682, 140, 0, 'is_full', 0, 0, '2014-11-27 14:58:16', NULL, '', 207, 204, 'inteiro', 'desktop'),
(3683, 140, 0, 'titulo_componente', NULL, 0, '2014-11-27 14:58:16', 'Galeria Las Vesgas', '', 207, 204, 'texto', 'desktop'),
(3684, 140, 0, 'background_type', 0, 0, '2014-11-27 14:58:16', NULL, '', 207, 204, 'inteiro', 'desktop'),
(3685, 140, 0, 'background', NULL, 0, '2014-11-27 14:58:16', '', '', 207, 204, 'texto', 'desktop'),
(3686, 140, 0, 'titulo_1', NULL, 0, '2014-11-27 15:01:40', NULL, '', 207, 205, 'texto', 'desktop'),
(3687, 140, 0, 'subtitulo_1', NULL, 0, '2014-11-27 15:01:40', NULL, '', 207, 205, 'texto', 'desktop'),
(3688, 140, 0, 'texto_1', NULL, 0, '2014-11-27 15:01:40', NULL, '', 207, 205, 'texto', 'desktop'),
(3689, 140, 0, 'link_1', NULL, 0, '2014-11-27 15:01:40', NULL, '', 207, 205, 'texto', 'desktop'),
(3690, 140, 0, 'image_1', NULL, 0, '2014-11-27 15:01:40', '3_kansas_artigo_i1.png', '', 207, 205, 'texto', 'desktop'),
(3691, 140, 0, 'layout_1', NULL, 0, '2014-11-27 15:01:40', 'up', '', 207, 205, 'texto', 'desktop'),
(3692, 140, 0, 'cor_1', NULL, 0, '2014-11-27 15:01:40', '', '', 207, 205, 'texto', 'desktop'),
(3693, 140, 0, 'cor_2', NULL, 0, '2014-11-27 15:01:40', '', '', 207, 205, 'texto', 'desktop'),
(3694, 140, 0, 'cor_3', NULL, 0, '2014-11-27 15:01:40', '', '', 207, 205, 'texto', 'desktop'),
(3695, 140, 0, 'alinhamento_1', NULL, 0, '2014-11-27 15:01:40', 'left', '', 207, 205, 'texto', 'desktop'),
(3696, 140, 0, 'alinhamento_2', NULL, 0, '2014-11-27 15:01:41', 'left', '', 207, 205, 'texto', 'desktop'),
(3697, 140, 0, 'alinhamento_3', NULL, 0, '2014-11-27 15:01:41', 'left', '', 207, 205, 'texto', 'desktop'),
(3698, 140, 0, 'margin_top', 0, 0, '2014-11-27 15:01:41', NULL, '', 207, 205, 'inteiro', 'desktop'),
(3699, 140, 0, 'margin_bottom', 0, 0, '2014-11-27 15:01:41', NULL, '', 207, 205, 'inteiro', 'desktop'),
(3700, 140, 0, 'padding_top', 0, 0, '2014-11-27 15:01:41', NULL, '', 207, 205, 'inteiro', 'desktop'),
(3701, 140, 0, 'padding_bottom', 0, 0, '2014-11-27 15:01:41', NULL, '', 207, 205, 'inteiro', 'desktop'),
(3702, 140, 0, 'is_full', 0, 0, '2014-11-27 15:01:41', NULL, '', 207, 205, 'inteiro', 'desktop'),
(3703, 140, 0, 'titulo_componente', NULL, 0, '2014-11-27 15:01:41', 'Kansas Parallass', '', 207, 205, 'texto', 'desktop'),
(3704, 140, 0, 'background_type', 0, 0, '2014-11-27 15:01:41', NULL, '', 207, 205, 'inteiro', 'desktop'),
(3705, 140, 0, 'background', NULL, 0, '2014-11-27 15:01:41', '', '', 207, 205, 'texto', 'desktop'),
(3706, 140, 0, 'titulo_1', NULL, 0, '2014-11-27 15:04:06', NULL, '', 207, 206, 'texto', 'desktop'),
(3707, 140, 0, 'subtitulo_1', NULL, 0, '2014-11-27 15:04:06', NULL, '', 207, 206, 'texto', 'desktop'),
(3708, 140, 0, 'texto_1', NULL, 0, '2014-11-27 15:04:06', NULL, '', 207, 206, 'texto', 'desktop'),
(3709, 140, 0, 'link_1', NULL, 0, '2014-11-27 15:04:06', NULL, '', 207, 206, 'texto', 'desktop'),
(3710, 140, 0, 'image_1', NULL, 0, '2014-11-27 15:04:06', '6_promocao_space_x6.png', '', 207, 206, 'texto', 'desktop'),
(3711, 140, 0, 'layout_1', NULL, 0, '2014-11-27 15:04:06', 'up', '', 207, 206, 'texto', 'desktop'),
(3712, 140, 0, 'cor_1', NULL, 0, '2014-11-27 15:04:06', '', '', 207, 206, 'texto', 'desktop'),
(3713, 140, 0, 'cor_2', NULL, 0, '2014-11-27 15:04:06', '', '', 207, 206, 'texto', 'desktop'),
(3714, 140, 0, 'cor_3', NULL, 0, '2014-11-27 15:04:06', '', '', 207, 206, 'texto', 'desktop'),
(3715, 140, 0, 'alinhamento_1', NULL, 0, '2014-11-27 15:04:06', 'left', '', 207, 206, 'texto', 'desktop'),
(3716, 140, 0, 'alinhamento_2', NULL, 0, '2014-11-27 15:04:06', 'left', '', 207, 206, 'texto', 'desktop'),
(3717, 140, 0, 'alinhamento_3', NULL, 0, '2014-11-27 15:04:06', 'left', '', 207, 206, 'texto', 'desktop'),
(3718, 140, 0, 'margin_top', 0, 0, '2014-11-27 15:04:06', NULL, '', 207, 206, 'inteiro', 'desktop'),
(3719, 140, 0, 'margin_bottom', 0, 0, '2014-11-27 15:04:06', NULL, '', 207, 206, 'inteiro', 'desktop'),
(3720, 140, 0, 'padding_top', 0, 0, '2014-11-27 15:04:06', NULL, '', 207, 206, 'inteiro', 'desktop'),
(3721, 140, 0, 'padding_bottom', 0, 0, '2014-11-27 15:04:06', NULL, '', 207, 206, 'inteiro', 'desktop'),
(3722, 140, 0, 'is_full', 0, 0, '2014-11-27 15:04:06', NULL, '', 207, 206, 'inteiro', 'desktop'),
(3723, 140, 0, 'titulo_componente', NULL, 0, '2014-11-27 15:04:06', 'Promoção Space', '', 207, 206, 'texto', 'desktop'),
(3724, 140, 0, 'background_type', 0, 0, '2014-11-27 15:04:06', NULL, '', 207, 206, 'inteiro', 'desktop'),
(3725, 140, 0, 'background', NULL, 0, '2014-11-27 15:04:06', '', '', 207, 206, 'texto', 'desktop'),
(3726, 140, 0, 'titulo_1', NULL, 0, '2014-11-27 15:06:40', NULL, '', 207, 207, 'texto', 'desktop'),
(3727, 140, 0, 'subtitulo_1', NULL, 0, '2014-11-27 15:06:40', NULL, '', 207, 207, 'texto', 'desktop'),
(3728, 140, 0, 'texto_1', NULL, 0, '2014-11-27 15:06:41', NULL, '', 207, 207, 'texto', 'desktop'),
(3729, 140, 0, 'link_1', NULL, 0, '2014-11-27 15:06:41', NULL, '', 207, 207, 'texto', 'desktop'),
(3730, 140, 0, 'image_1', NULL, 0, '2014-11-27 15:06:41', '15_pierpromocao_p8.png', '', 207, 207, 'texto', 'desktop'),
(3731, 140, 0, 'layout_1', NULL, 0, '2014-11-27 15:06:41', 'up', '', 207, 207, 'texto', 'desktop'),
(3732, 140, 0, 'cor_1', NULL, 0, '2014-11-27 15:06:41', '', '', 207, 207, 'texto', 'desktop'),
(3733, 140, 0, 'cor_2', NULL, 0, '2014-11-27 15:06:41', '', '', 207, 207, 'texto', 'desktop'),
(3734, 140, 0, 'cor_3', NULL, 0, '2014-11-27 15:06:41', '', '', 207, 207, 'texto', 'desktop'),
(3735, 140, 0, 'alinhamento_1', NULL, 0, '2014-11-27 15:06:42', 'left', '', 207, 207, 'texto', 'desktop'),
(3736, 140, 0, 'alinhamento_2', NULL, 0, '2014-11-27 15:06:42', 'left', '', 207, 207, 'texto', 'desktop'),
(3737, 140, 0, 'alinhamento_3', NULL, 0, '2014-11-27 15:06:42', 'left', '', 207, 207, 'texto', 'desktop'),
(3738, 140, 0, 'margin_top', 0, 0, '2014-11-27 15:06:42', NULL, '', 207, 207, 'inteiro', 'desktop'),
(3739, 140, 0, 'margin_bottom', 0, 0, '2014-11-27 15:06:42', NULL, '', 207, 207, 'inteiro', 'desktop'),
(3740, 140, 0, 'padding_top', 0, 0, '2014-11-27 15:06:42', NULL, '', 207, 207, 'inteiro', 'desktop'),
(3741, 140, 0, 'padding_bottom', 0, 0, '2014-11-27 15:06:42', NULL, '', 207, 207, 'inteiro', 'desktop'),
(3742, 140, 0, 'is_full', 0, 0, '2014-11-27 15:06:42', NULL, '', 207, 207, 'inteiro', 'desktop'),
(3743, 140, 0, 'titulo_componente', NULL, 0, '2014-11-27 15:06:42', 'Pier Promoção ', '', 207, 207, 'texto', 'desktop'),
(3744, 140, 0, 'background_type', 0, 0, '2014-11-27 15:06:42', NULL, '', 207, 207, 'inteiro', 'desktop'),
(3745, 140, 0, 'background', NULL, 0, '2014-11-27 15:06:42', '', '', 207, 207, 'texto', 'desktop'),
(3746, 140, 0, 'titulo_1', NULL, 0, '2014-11-27 15:10:48', NULL, '', 207, 208, 'texto', 'desktop'),
(3747, 140, 0, 'subtitulo_1', NULL, 0, '2014-11-27 15:10:48', NULL, '', 207, 208, 'texto', 'desktop'),
(3748, 140, 0, 'texto_1', NULL, 0, '2014-11-27 15:10:48', NULL, '', 207, 208, 'texto', 'desktop'),
(3749, 140, 0, 'link_1', NULL, 0, '2014-11-27 15:10:48', NULL, '', 207, 208, 'texto', 'desktop'),
(3750, 140, 0, 'image_1', NULL, 0, '2014-11-27 15:10:48', 'piervideos_o5.png', '', 207, 208, 'texto', 'desktop'),
(3751, 140, 0, 'layout_1', NULL, 0, '2014-11-27 15:10:48', 'up', '', 207, 208, 'texto', 'desktop'),
(3752, 140, 0, 'cor_1', NULL, 0, '2014-11-27 15:10:48', '', '', 207, 208, 'texto', 'desktop'),
(3753, 140, 0, 'cor_2', NULL, 0, '2014-11-27 15:10:48', '', '', 207, 208, 'texto', 'desktop'),
(3754, 140, 0, 'cor_3', NULL, 0, '2014-11-27 15:10:48', '', '', 207, 208, 'texto', 'desktop'),
(3755, 140, 0, 'alinhamento_1', NULL, 0, '2014-11-27 15:10:48', 'left', '', 207, 208, 'texto', 'desktop'),
(3756, 140, 0, 'alinhamento_2', NULL, 0, '2014-11-27 15:10:48', 'left', '', 207, 208, 'texto', 'desktop'),
(3757, 140, 0, 'alinhamento_3', NULL, 0, '2014-11-27 15:10:48', 'left', '', 207, 208, 'texto', 'desktop'),
(3758, 140, 0, 'margin_top', 0, 0, '2014-11-27 15:10:48', NULL, '', 207, 208, 'inteiro', 'desktop'),
(3759, 140, 0, 'margin_bottom', 0, 0, '2014-11-27 15:10:48', NULL, '', 207, 208, 'inteiro', 'desktop'),
(3760, 140, 0, 'padding_top', 0, 0, '2014-11-27 15:10:48', NULL, '', 207, 208, 'inteiro', 'desktop'),
(3761, 140, 0, 'padding_bottom', 0, 0, '2014-11-27 15:10:48', NULL, '', 207, 208, 'inteiro', 'desktop'),
(3762, 140, 0, 'is_full', 0, 0, '2014-11-27 15:10:48', NULL, '', 207, 208, 'inteiro', 'desktop'),
(3763, 140, 0, 'titulo_componente', NULL, 0, '2014-11-27 15:10:48', 'Pier Videos', '', 207, 208, 'texto', 'desktop'),
(3764, 140, 0, 'background_type', 0, 0, '2014-11-27 15:10:48', NULL, '', 207, 208, 'inteiro', 'desktop'),
(3765, 140, 0, 'background', NULL, 0, '2014-11-27 15:10:48', '', '', 207, 208, 'texto', 'desktop'),
(3766, 140, 0, 'titulo_1', NULL, 0, '2014-11-27 15:15:52', NULL, '', 207, 209, 'texto', 'desktop'),
(3767, 140, 0, 'subtitulo_1', NULL, 0, '2014-11-27 15:15:52', NULL, '', 207, 209, 'texto', 'desktop'),
(3768, 140, 0, 'texto_1', NULL, 0, '2014-11-27 15:15:52', NULL, '', 207, 209, 'texto', 'desktop'),
(3769, 140, 0, 'link_1', NULL, 0, '2014-11-27 15:15:52', NULL, '', 207, 209, 'texto', 'desktop'),
(3770, 140, 0, 'image_1', NULL, 0, '2014-11-27 15:15:52', 'pierprodutos_d3.png', '', 207, 209, 'texto', 'desktop'),
(3771, 140, 0, 'layout_1', NULL, 0, '2014-11-27 15:15:52', 'up', '', 207, 209, 'texto', 'desktop'),
(3772, 140, 0, 'cor_1', NULL, 0, '2014-11-27 15:15:52', '', '', 207, 209, 'texto', 'desktop'),
(3773, 140, 0, 'cor_2', NULL, 0, '2014-11-27 15:15:52', '', '', 207, 209, 'texto', 'desktop'),
(3774, 140, 0, 'cor_3', NULL, 0, '2014-11-27 15:15:52', '', '', 207, 209, 'texto', 'desktop'),
(3775, 140, 0, 'alinhamento_1', NULL, 0, '2014-11-27 15:15:52', 'left', '', 207, 209, 'texto', 'desktop'),
(3776, 140, 0, 'alinhamento_2', NULL, 0, '2014-11-27 15:15:52', 'left', '', 207, 209, 'texto', 'desktop'),
(3777, 140, 0, 'alinhamento_3', NULL, 0, '2014-11-27 15:15:52', 'left', '', 207, 209, 'texto', 'desktop'),
(3778, 140, 0, 'margin_top', 0, 0, '2014-11-27 15:15:52', NULL, '', 207, 209, 'inteiro', 'desktop'),
(3779, 140, 0, 'margin_bottom', 0, 0, '2014-11-27 15:15:53', NULL, '', 207, 209, 'inteiro', 'desktop'),
(3780, 140, 0, 'padding_top', 0, 0, '2014-11-27 15:15:53', NULL, '', 207, 209, 'inteiro', 'desktop'),
(3781, 140, 0, 'padding_bottom', 0, 0, '2014-11-27 15:15:53', NULL, '', 207, 209, 'inteiro', 'desktop'),
(3782, 140, 0, 'is_full', 0, 0, '2014-11-27 15:15:53', NULL, '', 207, 209, 'inteiro', 'desktop'),
(3783, 140, 0, 'titulo_componente', NULL, 0, '2014-11-27 15:15:53', 'Pier Produtos', '', 207, 209, 'texto', 'desktop'),
(3784, 140, 0, 'background_type', 0, 0, '2014-11-27 15:15:53', NULL, '', 207, 209, 'inteiro', 'desktop'),
(3785, 140, 0, 'background', NULL, 0, '2014-11-27 15:15:53', '', '', 207, 209, 'texto', 'desktop'),
(3786, 140, 0, 'titulo_1', NULL, 0, '2014-11-27 15:17:47', NULL, '', 207, 210, 'texto', 'desktop'),
(3787, 140, 0, 'subtitulo_1', NULL, 0, '2014-11-27 15:17:47', NULL, '', 207, 210, 'texto', 'desktop'),
(3788, 140, 0, 'texto_1', NULL, 0, '2014-11-27 15:17:47', NULL, '', 207, 210, 'texto', 'desktop'),
(3789, 140, 0, 'link_1', NULL, 0, '2014-11-27 15:17:47', NULL, '', 207, 210, 'texto', 'desktop'),
(3790, 140, 0, 'image_1', NULL, 0, '2014-11-27 15:17:47', 'pierhiperlinks_t7.png', '', 207, 210, 'texto', 'desktop'),
(3791, 140, 0, 'layout_1', NULL, 0, '2014-11-27 15:17:47', 'up', '', 207, 210, 'texto', 'desktop'),
(3792, 140, 0, 'cor_1', NULL, 0, '2014-11-27 15:17:47', '', '', 207, 210, 'texto', 'desktop'),
(3793, 140, 0, 'cor_2', NULL, 0, '2014-11-27 15:17:47', '', '', 207, 210, 'texto', 'desktop'),
(3794, 140, 0, 'cor_3', NULL, 0, '2014-11-27 15:17:47', '', '', 207, 210, 'texto', 'desktop'),
(3795, 140, 0, 'alinhamento_1', NULL, 0, '2014-11-27 15:17:47', 'left', '', 207, 210, 'texto', 'desktop'),
(3796, 140, 0, 'alinhamento_2', NULL, 0, '2014-11-27 15:17:47', 'left', '', 207, 210, 'texto', 'desktop'),
(3797, 140, 0, 'alinhamento_3', NULL, 0, '2014-11-27 15:17:47', 'left', '', 207, 210, 'texto', 'desktop'),
(3798, 140, 0, 'margin_top', 0, 0, '2014-11-27 15:17:47', NULL, '', 207, 210, 'inteiro', 'desktop'),
(3799, 140, 0, 'margin_bottom', 0, 0, '2014-11-27 15:17:47', NULL, '', 207, 210, 'inteiro', 'desktop'),
(3800, 140, 0, 'padding_top', 0, 0, '2014-11-27 15:17:47', NULL, '', 207, 210, 'inteiro', 'desktop'),
(3801, 140, 0, 'padding_bottom', 0, 0, '2014-11-27 15:17:47', NULL, '', 207, 210, 'inteiro', 'desktop'),
(3802, 140, 0, 'is_full', 0, 0, '2014-11-27 15:17:47', NULL, '', 207, 210, 'inteiro', 'desktop'),
(3803, 140, 0, 'titulo_componente', NULL, 0, '2014-11-27 15:17:47', 'Pier Hiperlinks', '', 207, 210, 'texto', 'desktop'),
(3804, 140, 0, 'background_type', 0, 0, '2014-11-27 15:17:47', NULL, '', 207, 210, 'inteiro', 'desktop'),
(3805, 140, 0, 'background', NULL, 0, '2014-11-27 15:17:47', '', '', 207, 210, 'texto', 'desktop'),
(3806, 140, 0, 'titulo_1', NULL, 0, '2014-11-27 15:31:01', NULL, '', 207, 211, 'texto', 'desktop'),
(3807, 140, 0, 'subtitulo_1', NULL, 0, '2014-11-27 15:31:01', NULL, '', 207, 211, 'texto', 'desktop'),
(3808, 140, 0, 'texto_1', NULL, 0, '2014-11-27 15:31:01', NULL, '', 207, 211, 'texto', 'desktop'),
(3809, 140, 0, 'link_1', NULL, 0, '2014-11-27 15:31:01', NULL, '', 207, 211, 'texto', 'desktop'),
(3810, 140, 0, 'image_1', NULL, 0, '2014-11-27 15:31:01', '16_multichip_z9.png', '', 207, 211, 'texto', 'desktop'),
(3811, 140, 0, 'layout_1', NULL, 0, '2014-11-27 15:31:01', 'up', '', 207, 211, 'texto', 'desktop'),
(3812, 140, 0, 'cor_1', NULL, 0, '2014-11-27 15:31:01', '', '', 207, 211, 'texto', 'desktop'),
(3813, 140, 0, 'cor_2', NULL, 0, '2014-11-27 15:31:01', '', '', 207, 211, 'texto', 'desktop'),
(3814, 140, 0, 'cor_3', NULL, 0, '2014-11-27 15:31:01', '', '', 207, 211, 'texto', 'desktop'),
(3815, 140, 0, 'alinhamento_1', NULL, 0, '2014-11-27 15:31:01', 'left', '', 207, 211, 'texto', 'desktop'),
(3816, 140, 0, 'alinhamento_2', NULL, 0, '2014-11-27 15:31:01', 'left', '', 207, 211, 'texto', 'desktop'),
(3817, 140, 0, 'alinhamento_3', NULL, 0, '2014-11-27 15:31:02', 'left', '', 207, 211, 'texto', 'desktop'),
(3818, 140, 0, 'margin_top', 0, 0, '2014-11-27 15:31:02', NULL, '', 207, 211, 'inteiro', 'desktop'),
(3819, 140, 0, 'margin_bottom', 0, 0, '2014-11-27 15:31:02', NULL, '', 207, 211, 'inteiro', 'desktop'),
(3820, 140, 0, 'padding_top', 0, 0, '2014-11-27 15:31:02', NULL, '', 207, 211, 'inteiro', 'desktop'),
(3821, 140, 0, 'padding_bottom', 0, 0, '2014-11-27 15:31:02', NULL, '', 207, 211, 'inteiro', 'desktop'),
(3822, 140, 0, 'is_full', 0, 0, '2014-11-27 15:31:02', NULL, '', 207, 211, 'inteiro', 'desktop'),
(3823, 140, 0, 'titulo_componente', NULL, 0, '2014-11-27 15:31:02', 'Multi Chip', '', 207, 211, 'texto', 'desktop'),
(3824, 140, 0, 'background_type', 0, 0, '2014-11-27 15:31:02', NULL, '', 207, 211, 'inteiro', 'desktop'),
(3825, 140, 0, 'background', NULL, 0, '2014-11-27 15:31:02', '', '', 207, 211, 'texto', 'desktop'),
(3826, 140, 0, 'titulo_1', NULL, 0, '2014-11-27 15:32:37', NULL, '', 207, 212, 'texto', 'desktop'),
(3827, 140, 0, 'subtitulo_1', NULL, 0, '2014-11-27 15:32:37', NULL, '', 207, 212, 'texto', 'desktop'),
(3828, 140, 0, 'texto_1', NULL, 0, '2014-11-27 15:32:37', NULL, '', 207, 212, 'texto', 'desktop'),
(3829, 140, 0, 'link_1', NULL, 0, '2014-11-27 15:32:37', NULL, '', 207, 212, 'texto', 'desktop'),
(3830, 140, 0, 'image_1', NULL, 0, '2014-11-27 15:32:37', 'pierecommerce_g8.png', '', 207, 212, 'texto', 'desktop'),
(3831, 140, 0, 'layout_1', NULL, 0, '2014-11-27 15:32:37', 'up', '', 207, 212, 'texto', 'desktop'),
(3832, 140, 0, 'cor_1', NULL, 0, '2014-11-27 15:32:37', '', '', 207, 212, 'texto', 'desktop'),
(3833, 140, 0, 'cor_2', NULL, 0, '2014-11-27 15:32:38', '', '', 207, 212, 'texto', 'desktop'),
(3834, 140, 0, 'cor_3', NULL, 0, '2014-11-27 15:32:38', '', '', 207, 212, 'texto', 'desktop'),
(3835, 140, 0, 'alinhamento_1', NULL, 0, '2014-11-27 15:32:38', 'left', '', 207, 212, 'texto', 'desktop'),
(3836, 140, 0, 'alinhamento_2', NULL, 0, '2014-11-27 15:32:38', 'left', '', 207, 212, 'texto', 'desktop'),
(3837, 140, 0, 'alinhamento_3', NULL, 0, '2014-11-27 15:32:38', 'left', '', 207, 212, 'texto', 'desktop'),
(3838, 140, 0, 'margin_top', 0, 0, '2014-11-27 15:32:38', NULL, '', 207, 212, 'inteiro', 'desktop'),
(3839, 140, 0, 'margin_bottom', 0, 0, '2014-11-27 15:32:38', NULL, '', 207, 212, 'inteiro', 'desktop'),
(3840, 140, 0, 'padding_top', 0, 0, '2014-11-27 15:32:38', NULL, '', 207, 212, 'inteiro', 'desktop'),
(3841, 140, 0, 'padding_bottom', 0, 0, '2014-11-27 15:32:38', NULL, '', 207, 212, 'inteiro', 'desktop'),
(3842, 140, 0, 'is_full', 0, 0, '2014-11-27 15:32:38', NULL, '', 207, 212, 'inteiro', 'desktop'),
(3843, 140, 0, 'titulo_componente', NULL, 0, '2014-11-27 15:32:38', 'Pier Ecommerce', '', 207, 212, 'texto', 'desktop'),
(3844, 140, 0, 'background_type', 0, 0, '2014-11-27 15:32:38', NULL, '', 207, 212, 'inteiro', 'desktop'),
(3845, 140, 0, 'background', NULL, 0, '2014-11-27 15:32:38', '', '', 207, 212, 'texto', 'desktop'),
(3846, 140, 0, 'titulo_1', NULL, 0, '2014-11-27 15:35:10', NULL, '', 207, 213, 'texto', 'desktop'),
(3847, 140, 0, 'subtitulo_1', NULL, 0, '2014-11-27 15:35:10', NULL, '', 207, 213, 'texto', 'desktop'),
(3848, 140, 0, 'texto_1', NULL, 0, '2014-11-27 15:35:10', NULL, '', 207, 213, 'texto', 'desktop'),
(3849, 140, 0, 'link_1', NULL, 0, '2014-11-27 15:35:10', NULL, '', 207, 213, 'texto', 'desktop'),
(3850, 140, 0, 'image_1', NULL, 0, '2014-11-27 15:35:10', 'piereventos_k3.png', '', 207, 213, 'texto', 'desktop'),
(3851, 140, 0, 'layout_1', NULL, 0, '2014-11-27 15:35:10', 'up', '', 207, 213, 'texto', 'desktop'),
(3852, 140, 0, 'cor_1', NULL, 0, '2014-11-27 15:35:10', '', '', 207, 213, 'texto', 'desktop'),
(3853, 140, 0, 'cor_2', NULL, 0, '2014-11-27 15:35:10', '', '', 207, 213, 'texto', 'desktop'),
(3854, 140, 0, 'cor_3', NULL, 0, '2014-11-27 15:35:10', '', '', 207, 213, 'texto', 'desktop'),
(3855, 140, 0, 'alinhamento_1', NULL, 0, '2014-11-27 15:35:10', 'left', '', 207, 213, 'texto', 'desktop'),
(3856, 140, 0, 'alinhamento_2', NULL, 0, '2014-11-27 15:35:10', 'left', '', 207, 213, 'texto', 'desktop'),
(3857, 140, 0, 'alinhamento_3', NULL, 0, '2014-11-27 15:35:10', 'left', '', 207, 213, 'texto', 'desktop'),
(3858, 140, 0, 'margin_top', 0, 0, '2014-11-27 15:35:10', NULL, '', 207, 213, 'inteiro', 'desktop'),
(3859, 140, 0, 'margin_bottom', 0, 0, '2014-11-27 15:35:10', NULL, '', 207, 213, 'inteiro', 'desktop'),
(3860, 140, 0, 'padding_top', 0, 0, '2014-11-27 15:35:10', NULL, '', 207, 213, 'inteiro', 'desktop'),
(3861, 140, 0, 'padding_bottom', 0, 0, '2014-11-27 15:35:10', NULL, '', 207, 213, 'inteiro', 'desktop'),
(3862, 140, 0, 'is_full', 0, 0, '2014-11-27 15:35:10', NULL, '', 207, 213, 'inteiro', 'desktop'),
(3863, 140, 0, 'titulo_componente', NULL, 0, '2014-11-27 15:35:10', 'Pier Eventos', '', 207, 213, 'texto', 'desktop'),
(3864, 140, 0, 'background_type', 0, 0, '2014-11-27 15:35:10', NULL, '', 207, 213, 'inteiro', 'desktop'),
(3865, 140, 0, 'background', NULL, 0, '2014-11-27 15:35:10', '', '', 207, 213, 'texto', 'desktop'),
(3866, 140, 0, 'titulo_1', NULL, 0, '2014-11-27 15:36:31', NULL, '', 207, 214, 'texto', 'desktop'),
(3867, 140, 0, 'subtitulo_1', NULL, 0, '2014-11-27 15:36:31', NULL, '', 207, 214, 'texto', 'desktop'),
(3868, 140, 0, 'texto_1', NULL, 0, '2014-11-27 15:36:31', NULL, '', 207, 214, 'texto', 'desktop'),
(3869, 140, 0, 'link_1', NULL, 0, '2014-11-27 15:36:31', NULL, '', 207, 214, 'texto', 'desktop'),
(3870, 140, 0, 'image_1', NULL, 0, '2014-11-27 15:36:31', 'pierlayout_y0.png', '', 207, 214, 'texto', 'desktop'),
(3871, 140, 0, 'layout_1', NULL, 0, '2014-11-27 15:36:31', 'up', '', 207, 214, 'texto', 'desktop'),
(3872, 140, 0, 'cor_1', NULL, 0, '2014-11-27 15:36:31', '', '', 207, 214, 'texto', 'desktop'),
(3873, 140, 0, 'cor_2', NULL, 0, '2014-11-27 15:36:32', '', '', 207, 214, 'texto', 'desktop'),
(3874, 140, 0, 'cor_3', NULL, 0, '2014-11-27 15:36:32', '', '', 207, 214, 'texto', 'desktop'),
(3875, 140, 0, 'alinhamento_1', NULL, 0, '2014-11-27 15:36:32', 'left', '', 207, 214, 'texto', 'desktop'),
(3876, 140, 0, 'alinhamento_2', NULL, 0, '2014-11-27 15:36:32', 'left', '', 207, 214, 'texto', 'desktop'),
(3877, 140, 0, 'alinhamento_3', NULL, 0, '2014-11-27 15:36:32', 'left', '', 207, 214, 'texto', 'desktop'),
(3878, 140, 0, 'margin_top', 0, 0, '2014-11-27 15:36:32', NULL, '', 207, 214, 'inteiro', 'desktop'),
(3879, 140, 0, 'margin_bottom', 0, 0, '2014-11-27 15:36:32', NULL, '', 207, 214, 'inteiro', 'desktop'),
(3880, 140, 0, 'padding_top', 0, 0, '2014-11-27 15:36:32', NULL, '', 207, 214, 'inteiro', 'desktop'),
(3881, 140, 0, 'padding_bottom', 0, 0, '2014-11-27 15:36:32', NULL, '', 207, 214, 'inteiro', 'desktop'),
(3882, 140, 0, 'is_full', 0, 0, '2014-11-27 15:36:32', NULL, '', 207, 214, 'inteiro', 'desktop'),
(3883, 140, 0, 'titulo_componente', NULL, 0, '2014-11-27 15:36:32', 'Pier Layout', '', 207, 214, 'texto', 'desktop'),
(3884, 140, 0, 'background_type', 0, 0, '2014-11-27 15:36:32', NULL, '', 207, 214, 'inteiro', 'desktop'),
(3885, 140, 0, 'background', NULL, 0, '2014-11-27 15:36:33', '', '', 207, 214, 'texto', 'desktop'),
(3886, 140, 0, 'titulo_1', NULL, 0, '2014-11-27 15:38:44', NULL, '', 207, 215, 'texto', 'desktop'),
(3887, 140, 0, 'subtitulo_1', NULL, 0, '2014-11-27 15:38:44', NULL, '', 207, 215, 'texto', 'desktop'),
(3888, 140, 0, 'texto_1', NULL, 0, '2014-11-27 15:38:44', NULL, '', 207, 215, 'texto', 'desktop'),
(3889, 140, 0, 'link_1', NULL, 0, '2014-11-27 15:38:44', NULL, '', 207, 215, 'texto', 'desktop'),
(3890, 140, 0, 'image_1', NULL, 0, '2014-11-27 15:38:44', 'piermaterias_r8.png', '', 207, 215, 'texto', 'desktop'),
(3891, 140, 0, 'layout_1', NULL, 0, '2014-11-27 15:38:44', 'up', '', 207, 215, 'texto', 'desktop'),
(3892, 140, 0, 'cor_1', NULL, 0, '2014-11-27 15:38:44', '', '', 207, 215, 'texto', 'desktop'),
(3893, 140, 0, 'cor_2', NULL, 0, '2014-11-27 15:38:44', '', '', 207, 215, 'texto', 'desktop'),
(3894, 140, 0, 'cor_3', NULL, 0, '2014-11-27 15:38:45', '', '', 207, 215, 'texto', 'desktop'),
(3895, 140, 0, 'alinhamento_1', NULL, 0, '2014-11-27 15:38:45', 'left', '', 207, 215, 'texto', 'desktop'),
(3896, 140, 0, 'alinhamento_2', NULL, 0, '2014-11-27 15:38:45', 'left', '', 207, 215, 'texto', 'desktop'),
(3897, 140, 0, 'alinhamento_3', NULL, 0, '2014-11-27 15:38:45', 'left', '', 207, 215, 'texto', 'desktop'),
(3898, 140, 0, 'margin_top', 0, 0, '2014-11-27 15:38:45', NULL, '', 207, 215, 'inteiro', 'desktop'),
(3899, 140, 0, 'margin_bottom', 0, 0, '2014-11-27 15:38:45', NULL, '', 207, 215, 'inteiro', 'desktop'),
(3900, 140, 0, 'padding_top', 0, 0, '2014-11-27 15:38:45', NULL, '', 207, 215, 'inteiro', 'desktop'),
(3901, 140, 0, 'padding_bottom', 0, 0, '2014-11-27 15:38:45', NULL, '', 207, 215, 'inteiro', 'desktop'),
(3902, 140, 0, 'is_full', 0, 0, '2014-11-27 15:38:45', NULL, '', 207, 215, 'inteiro', 'desktop'),
(3903, 140, 0, 'titulo_componente', NULL, 0, '2014-11-27 15:38:45', 'Pier Materias', '', 207, 215, 'texto', 'desktop');
INSERT INTO `paginas_attribute` (`id`, `id_pagina`, `user_id`, `name`, `inteiro`, `number`, `estampa`, `texto`, `descricao`, `id_componente`, `id_row`, `tipo`, `plataforma`) VALUES
(3904, 140, 0, 'background_type', 0, 0, '2014-11-27 15:38:45', NULL, '', 207, 215, 'inteiro', 'desktop'),
(3905, 140, 0, 'background', NULL, 0, '2014-11-27 15:38:45', '', '', 207, 215, 'texto', 'desktop'),
(3906, 140, 0, 'titulo_1', NULL, 0, '2014-11-27 15:43:54', NULL, '', 207, 216, 'texto', 'desktop'),
(3907, 140, 0, 'subtitulo_1', NULL, 0, '2014-11-27 15:43:54', NULL, '', 207, 216, 'texto', 'desktop'),
(3908, 140, 0, 'texto_1', NULL, 0, '2014-11-27 15:43:54', NULL, '', 207, 216, 'texto', 'desktop'),
(3909, 140, 0, 'link_1', NULL, 0, '2014-11-27 15:43:54', NULL, '', 207, 216, 'texto', 'desktop'),
(3910, 140, 0, 'image_1', NULL, 0, '2014-11-27 15:43:54', 'pierdownloads_m8.png', '', 207, 216, 'texto', 'desktop'),
(3911, 140, 0, 'layout_1', NULL, 0, '2014-11-27 15:43:54', 'up', '', 207, 216, 'texto', 'desktop'),
(3912, 140, 0, 'cor_1', NULL, 0, '2014-11-27 15:43:55', '', '', 207, 216, 'texto', 'desktop'),
(3913, 140, 0, 'cor_2', NULL, 0, '2014-11-27 15:43:55', '', '', 207, 216, 'texto', 'desktop'),
(3914, 140, 0, 'cor_3', NULL, 0, '2014-11-27 15:43:55', '', '', 207, 216, 'texto', 'desktop'),
(3915, 140, 0, 'alinhamento_1', NULL, 0, '2014-11-27 15:43:55', 'left', '', 207, 216, 'texto', 'desktop'),
(3916, 140, 0, 'alinhamento_2', NULL, 0, '2014-11-27 15:43:55', 'left', '', 207, 216, 'texto', 'desktop'),
(3917, 140, 0, 'alinhamento_3', NULL, 0, '2014-11-27 15:43:55', 'left', '', 207, 216, 'texto', 'desktop'),
(3918, 140, 0, 'margin_top', 0, 0, '2014-11-27 15:43:55', NULL, '', 207, 216, 'inteiro', 'desktop'),
(3919, 140, 0, 'margin_bottom', 0, 0, '2014-11-27 15:43:55', NULL, '', 207, 216, 'inteiro', 'desktop'),
(3920, 140, 0, 'padding_top', 0, 0, '2014-11-27 15:43:55', NULL, '', 207, 216, 'inteiro', 'desktop'),
(3921, 140, 0, 'padding_bottom', 0, 0, '2014-11-27 15:43:56', NULL, '', 207, 216, 'inteiro', 'desktop'),
(3922, 140, 0, 'is_full', 0, 0, '2014-11-27 15:43:56', NULL, '', 207, 216, 'inteiro', 'desktop'),
(3923, 140, 0, 'titulo_componente', NULL, 0, '2014-11-27 15:43:56', 'Pier Download', '', 207, 216, 'texto', 'desktop'),
(3924, 140, 0, 'background_type', 0, 0, '2014-11-27 15:43:56', NULL, '', 207, 216, 'inteiro', 'desktop'),
(3925, 140, 0, 'background', NULL, 0, '2014-11-27 15:43:56', '', '', 207, 216, 'texto', 'desktop'),
(3926, 160, 0, 'titulo_1', NULL, 0, '2014-12-01 15:56:40', NULL, 'Como funciona a parte de cadastro de perguntas frequentes?', 186, 217, 'texto', 'desktop'),
(3927, 160, 0, 'subtitulo_1', NULL, 0, '2014-12-01 15:56:40', NULL, 'Criando um guia de perguntas frequentes', 186, 217, 'texto', 'desktop'),
(3928, 160, 0, 'texto_1', NULL, 0, '2014-12-01 15:56:41', NULL, 'Muito simples basta entrar em Admin / Controle / FAQ.\r\nClique em cadastrar e preencha os campos com a pergunta e a resposta que você deseja que seja exibido no seu site na página de FAQ - Perguntas Frequentes.\r\nCrie quantas perguntas e respostas você desejar, pois assim seus usuários podem utilizar desta página para saber como que seu serviço/produto funciona.\r\n\r\nEssa sessão também permite que seus usuários enviem perguntas que ficam salvas e se você aprovar irão ser exibidas em seu site', 186, 217, 'texto', 'desktop'),
(3929, 160, 0, 'label_1', NULL, 0, '2014-12-01 15:56:41', '', '', 186, 217, 'texto', 'desktop'),
(3930, 160, 0, 'link_1', NULL, 0, '2014-12-01 15:56:41', NULL, '', 186, 217, 'texto', 'desktop'),
(3931, 160, 0, 'image_1', NULL, 0, '2014-12-01 15:56:41', '', '', 186, 217, 'texto', 'desktop'),
(3932, 160, 0, 'layout_1', NULL, 0, '2014-12-01 15:56:41', 'left', '', 186, 217, 'texto', 'desktop'),
(3933, 160, 0, 'cor_1', NULL, 0, '2014-12-01 15:56:41', '', '', 186, 217, 'texto', 'desktop'),
(3934, 160, 0, 'cor_2', NULL, 0, '2014-12-01 15:56:41', '', '', 186, 217, 'texto', 'desktop'),
(3935, 160, 0, 'cor_3', NULL, 0, '2014-12-01 15:56:41', '', '', 186, 217, 'texto', 'desktop'),
(3936, 160, 0, 'alinhamento_1', NULL, 0, '2014-12-01 15:56:41', 'left', '', 186, 217, 'texto', 'desktop'),
(3937, 160, 0, 'alinhamento_2', NULL, 0, '2014-12-01 15:56:41', 'left', '', 186, 217, 'texto', 'desktop'),
(3938, 160, 0, 'alinhamento_3', NULL, 0, '2014-12-01 15:56:41', 'left', '', 186, 217, 'texto', 'desktop'),
(3939, 160, 0, 'margin_top', 0, 0, '2014-12-01 15:56:41', NULL, '', 186, 217, 'inteiro', 'desktop'),
(3940, 160, 0, 'margin_bottom', 0, 0, '2014-12-01 15:56:41', NULL, '', 186, 217, 'inteiro', 'desktop'),
(3941, 160, 0, 'padding_top', 0, 0, '2014-12-01 15:56:42', NULL, '', 186, 217, 'inteiro', 'desktop'),
(3942, 160, 0, 'padding_bottom', 0, 0, '2014-12-01 15:56:42', NULL, '', 186, 217, 'inteiro', 'desktop'),
(3943, 160, 0, 'is_full', 0, 0, '2014-12-01 15:56:42', NULL, '', 186, 217, 'inteiro', 'desktop'),
(3944, 160, 0, 'titulo_componente', NULL, 0, '2014-12-01 15:56:42', 'Como funciona FAQ', '', 186, 217, 'texto', 'desktop'),
(3945, 160, 0, 'background_type', 0, 0, '2014-12-01 15:56:42', NULL, '', 186, 217, 'inteiro', 'desktop'),
(3946, 160, 0, 'background', NULL, 0, '2014-12-01 15:56:42', '', '', 186, 217, 'texto', 'desktop'),
(3947, 160, 0, 'titulo_1', NULL, 0, '2014-12-01 15:59:22', NULL, 'Como aprovar uma pergunta frequente recebida pelo site?', 186, 218, 'texto', 'desktop'),
(3948, 160, 0, 'subtitulo_1', NULL, 0, '2014-12-01 15:59:22', NULL, 'Entendendo os ícones de edição e aprovação do FAQ', 186, 218, 'texto', 'desktop'),
(3949, 160, 0, 'texto_1', NULL, 0, '2014-12-01 15:59:23', NULL, 'Basta você entrar em Admin / Controle / FAQ / listar.\r\nSerá exibido todas as perguntas que foram enviadas ao seu site. \r\nExiste 4 botões em cada linha do item:\r\nO botão com o símbolo em verde aprova a pergunta e ela já é exibida automaticamente no FAQ.\r\nO botão com o símbolo em vermelho é de reprovar o FAQ, ele não apaga a apenas remove este da exibição.\r\nO botão com o lápis edita o FAQ e ao salvar já aprova automáticamente, se não deseja exibir basta clicar em reprovar O botão com o x em vermelho remove o item permanentemente ', 186, 218, 'texto', 'desktop'),
(3950, 160, 0, 'label_1', NULL, 0, '2014-12-01 15:59:23', '', '', 186, 218, 'texto', 'desktop'),
(3951, 160, 0, 'link_1', NULL, 0, '2014-12-01 15:59:23', NULL, '', 186, 218, 'texto', 'desktop'),
(3952, 160, 0, 'image_1', NULL, 0, '2014-12-01 15:59:23', '', '', 186, 218, 'texto', 'desktop'),
(3953, 160, 0, 'layout_1', NULL, 0, '2014-12-01 15:59:23', 'left', '', 186, 218, 'texto', 'desktop'),
(3954, 160, 0, 'cor_1', NULL, 0, '2014-12-01 15:59:23', '', '', 186, 218, 'texto', 'desktop'),
(3955, 160, 0, 'cor_2', NULL, 0, '2014-12-01 15:59:23', '', '', 186, 218, 'texto', 'desktop'),
(3956, 160, 0, 'cor_3', NULL, 0, '2014-12-01 15:59:24', '', '', 186, 218, 'texto', 'desktop'),
(3957, 160, 0, 'alinhamento_1', NULL, 0, '2014-12-01 15:59:24', 'left', '', 186, 218, 'texto', 'desktop'),
(3958, 160, 0, 'alinhamento_2', NULL, 0, '2014-12-01 15:59:24', 'left', '', 186, 218, 'texto', 'desktop'),
(3959, 160, 0, 'alinhamento_3', NULL, 0, '2014-12-01 15:59:24', 'left', '', 186, 218, 'texto', 'desktop'),
(3960, 160, 0, 'margin_top', 0, 0, '2014-12-01 15:59:24', NULL, '', 186, 218, 'inteiro', 'desktop'),
(3961, 160, 0, 'margin_bottom', 0, 0, '2014-12-01 15:59:25', NULL, '', 186, 218, 'inteiro', 'desktop'),
(3962, 160, 0, 'padding_top', 0, 0, '2014-12-01 15:59:25', NULL, '', 186, 218, 'inteiro', 'desktop'),
(3963, 160, 0, 'padding_bottom', 0, 0, '2014-12-01 15:59:25', NULL, '', 186, 218, 'inteiro', 'desktop'),
(3964, 160, 0, 'is_full', 0, 0, '2014-12-01 15:59:25', NULL, '', 186, 218, 'inteiro', 'desktop'),
(3965, 160, 0, 'titulo_componente', NULL, 0, '2014-12-01 15:59:25', 'Como aprovar uma pergunta frequente', '', 186, 218, 'texto', 'desktop'),
(3966, 160, 0, 'background_type', 0, 0, '2014-12-01 15:59:25', NULL, '', 186, 218, 'inteiro', 'desktop'),
(3967, 160, 0, 'background', NULL, 0, '2014-12-01 15:59:26', '', '', 186, 218, 'texto', 'desktop'),
(3968, 145, 0, 'titulo_1', NULL, 0, '2014-12-01 16:01:13', NULL, 'Dicas para utilizar o FAQ - Perguntas Frequentes', 186, 219, 'texto', 'desktop'),
(3969, 145, 0, 'subtitulo_1', NULL, 0, '2014-12-01 16:01:13', NULL, '', 186, 219, 'texto', 'desktop'),
(3970, 145, 0, 'texto_1', NULL, 0, '2014-12-01 16:01:13', NULL, 'Acesse o link abaixo e entenda como criar um guia de perguntas frequentes para seu site', 186, 219, 'texto', 'desktop'),
(3971, 145, 0, 'label_1', NULL, 0, '2014-12-01 16:01:13', 'Dicas FAQ - Perguntas Frequentes', '', 186, 219, 'texto', 'desktop'),
(3972, 145, 0, 'link_1', NULL, 0, '2014-12-01 16:01:13', NULL, '/dicasfaq', 186, 219, 'texto', 'desktop'),
(3973, 145, 0, 'image_1', NULL, 0, '2014-12-01 16:01:13', '', '', 186, 219, 'texto', 'desktop'),
(3974, 145, 0, 'layout_1', NULL, 0, '2014-12-01 16:01:13', 'left', '', 186, 219, 'texto', 'desktop'),
(3975, 145, 0, 'cor_1', NULL, 0, '2014-12-01 16:01:13', '', '', 186, 219, 'texto', 'desktop'),
(3976, 145, 0, 'cor_2', NULL, 0, '2014-12-01 16:01:13', '', '', 186, 219, 'texto', 'desktop'),
(3977, 145, 0, 'cor_3', NULL, 0, '2014-12-01 16:01:13', '', '', 186, 219, 'texto', 'desktop'),
(3978, 145, 0, 'alinhamento_1', NULL, 0, '2014-12-01 16:01:13', 'left', '', 186, 219, 'texto', 'desktop'),
(3979, 145, 0, 'alinhamento_2', NULL, 0, '2014-12-01 16:01:13', 'left', '', 186, 219, 'texto', 'desktop'),
(3980, 145, 0, 'alinhamento_3', NULL, 0, '2014-12-01 16:01:13', 'left', '', 186, 219, 'texto', 'desktop'),
(3981, 145, 0, 'margin_top', 0, 0, '2014-12-01 16:01:13', NULL, '', 186, 219, 'inteiro', 'desktop'),
(3982, 145, 0, 'margin_bottom', 0, 0, '2014-12-01 16:01:13', NULL, '', 186, 219, 'inteiro', 'desktop'),
(3983, 145, 0, 'padding_top', 0, 0, '2014-12-01 16:01:13', NULL, '', 186, 219, 'inteiro', 'desktop'),
(3984, 145, 0, 'padding_bottom', 0, 0, '2014-12-01 16:01:13', NULL, '', 186, 219, 'inteiro', 'desktop'),
(3985, 145, 0, 'is_full', 0, 0, '2014-12-01 16:01:13', NULL, '', 186, 219, 'inteiro', 'desktop'),
(3986, 145, 0, 'titulo_componente', NULL, 0, '2014-12-01 16:01:13', 'Dicas FAQ', '', 186, 219, 'texto', 'desktop'),
(3987, 145, 0, 'background_type', 0, 0, '2014-12-01 16:01:13', NULL, '', 186, 219, 'inteiro', 'desktop'),
(3988, 145, 0, 'background', NULL, 0, '2014-12-01 16:01:13', '', '', 186, 219, 'texto', 'desktop'),
(3989, 1, 0, 'titulo_1', NULL, 0, '2014-12-02 17:59:30', NULL, 'Você escolhe quais aplicativos deseja instalar no seu site!', 207, 220, 'texto', 'desktop'),
(3990, 1, 0, 'subtitulo_1', NULL, 0, '2014-12-02 17:59:30', NULL, 'São vários componentes disponíveis para você incrementar seu site', 207, 220, 'texto', 'desktop'),
(3991, 1, 0, 'texto_1', NULL, 0, '2014-12-02 17:59:30', NULL, 'São dezenas de opções que vão deste gerenciadores de layout a emissão de boletos bancários.\r\nAdicione e gerencie qual aplicativo você que em sua plataforma, ative e desative dependendo de sua necessidade, adquira quantos desejar e fique atento as promoções', 207, 220, 'texto', 'desktop'),
(3992, 1, 0, 'link_1', NULL, 0, '2014-12-02 17:59:30', NULL, '/paginasavancadas', 207, 220, 'texto', 'desktop'),
(3993, 1, 0, 'image_1', NULL, 0, '2014-12-02 17:59:30', 'bn_aplicativos_s1.jpg', '', 207, 220, 'texto', 'desktop'),
(3994, 1, 0, 'layout_1', NULL, 0, '2014-12-02 17:59:31', 'down', '', 207, 220, 'texto', 'desktop'),
(3995, 1, 0, 'cor_1', NULL, 0, '2014-12-02 17:59:31', '', '', 207, 220, 'texto', 'desktop'),
(3996, 1, 0, 'cor_2', NULL, 0, '2014-12-02 17:59:31', '#2075cb', '', 207, 220, 'texto', 'desktop'),
(3997, 1, 0, 'cor_3', NULL, 0, '2014-12-02 17:59:31', '', '', 207, 220, 'texto', 'desktop'),
(3998, 1, 0, 'alinhamento_1', NULL, 0, '2014-12-02 17:59:31', 'left', '', 207, 220, 'texto', 'desktop'),
(3999, 1, 0, 'alinhamento_2', NULL, 0, '2014-12-02 17:59:31', 'left', '', 207, 220, 'texto', 'desktop'),
(4000, 1, 0, 'alinhamento_3', NULL, 0, '2014-12-02 17:59:31', 'left', '', 207, 220, 'texto', 'desktop'),
(4001, 1, 0, 'margin_top', 40, 0, '2014-12-02 17:59:31', NULL, '', 207, 220, 'inteiro', 'desktop'),
(4002, 1, 0, 'margin_bottom', 15, 0, '2014-12-02 17:59:31', NULL, '', 207, 220, 'inteiro', 'desktop'),
(4003, 1, 0, 'padding_top', 0, 0, '2014-12-02 17:59:31', NULL, '', 207, 220, 'inteiro', 'desktop'),
(4004, 1, 0, 'padding_bottom', 0, 0, '2014-12-02 17:59:31', NULL, '', 207, 220, 'inteiro', 'desktop'),
(4005, 1, 0, 'is_full', 0, 0, '2014-12-02 17:59:31', NULL, '', 207, 220, 'inteiro', 'desktop'),
(4006, 1, 0, 'titulo_componente', NULL, 0, '2014-12-02 17:59:31', 'Veja todos os aplicativos', '', 207, 220, 'texto', 'desktop'),
(4007, 1, 0, 'background_type', 0, 0, '2014-12-02 17:59:31', NULL, '', 207, 220, 'inteiro', 'desktop'),
(4008, 1, 0, 'background', NULL, 0, '2014-12-02 17:59:31', '', '', 207, 220, 'texto', 'desktop'),
(4009, 1, 0, 'titulo_1', NULL, 0, '2014-12-02 19:11:10', NULL, 'PierFotos', 207, 221, 'texto', 'desktop'),
(4010, 1, 0, 'subtitulo_1', NULL, 0, '2014-12-02 19:11:10', NULL, 'Fotografia de produtos para Lojas Ecommerce / M-Ecommerce', 207, 221, 'texto', 'desktop'),
(4011, 1, 0, 'texto_1', NULL, 0, '2014-12-02 19:11:10', NULL, 'O objetivo do Pier Fotos é fornecer fotos de produtos com qualidade profissional para qualquer finalidade, como produção de catálogos, folders, sites e-commerce e material de divulgação.\r\n\r\nPara este tipo de trabalho, nós não trabalhamos com cenários personalizados, as fotos são sobre fundo branco, azul, vermelho ou preto. Desta forma conseguimos unir qualidade e produtividade, resultando em baixo investimento. Por essa razão as fotos são produzidas sempre com uma iluminação padrão, sobre um fundo padrão.\r\n\r\nGarantimos fotos de qualidade, fazemos os tratamentos na imagem para entregar um produto perfeito.', 207, 221, 'texto', 'desktop'),
(4012, 1, 0, 'link_1', NULL, 0, '2014-12-02 19:11:10', NULL, '/fotografia', 207, 221, 'texto', 'desktop'),
(4013, 1, 0, 'image_1', NULL, 0, '2014-12-02 19:11:10', 'banner_pierfotos_e0.jpg', '', 207, 221, 'texto', 'desktop'),
(4014, 1, 0, 'layout_1', NULL, 0, '2014-12-02 19:11:10', 'up', '', 207, 221, 'texto', 'desktop'),
(4015, 1, 0, 'cor_1', NULL, 0, '2014-12-02 19:11:10', '', '', 207, 221, 'texto', 'desktop'),
(4016, 1, 0, 'cor_2', NULL, 0, '2014-12-02 19:11:10', '#2075cb', '', 207, 221, 'texto', 'desktop'),
(4017, 1, 0, 'cor_3', NULL, 0, '2014-12-02 19:11:10', '', '', 207, 221, 'texto', 'desktop'),
(4018, 1, 0, 'alinhamento_1', NULL, 0, '2014-12-02 19:11:10', 'left', '', 207, 221, 'texto', 'desktop'),
(4019, 1, 0, 'alinhamento_2', NULL, 0, '2014-12-02 19:11:10', 'left', '', 207, 221, 'texto', 'desktop'),
(4020, 1, 0, 'alinhamento_3', NULL, 0, '2014-12-02 19:11:10', 'left', '', 207, 221, 'texto', 'desktop'),
(4021, 1, 0, 'margin_top', 30, 0, '2014-12-02 19:11:10', NULL, '', 207, 221, 'inteiro', 'desktop'),
(4022, 1, 0, 'margin_bottom', 0, 0, '2014-12-02 19:11:10', NULL, '', 207, 221, 'inteiro', 'desktop'),
(4023, 1, 0, 'padding_top', 0, 0, '2014-12-02 19:11:10', NULL, '', 207, 221, 'inteiro', 'desktop'),
(4024, 1, 0, 'padding_bottom', 0, 0, '2014-12-02 19:11:10', NULL, '', 207, 221, 'inteiro', 'desktop'),
(4025, 1, 0, 'is_full', 0, 0, '2014-12-02 19:11:10', NULL, '', 207, 221, 'inteiro', 'desktop'),
(4026, 1, 0, 'titulo_componente', NULL, 0, '2014-12-02 19:11:10', 'Pier Fotos', '', 207, 221, 'texto', 'desktop'),
(4027, 1, 0, 'background_type', 0, 0, '2014-12-02 19:11:10', NULL, '', 207, 221, 'inteiro', 'desktop'),
(4028, 1, 0, 'background', NULL, 0, '2014-12-02 19:11:10', '', '', 207, 221, 'texto', 'desktop'),
(4029, 1, 0, 'dc_title', NULL, 0, NULL, 'Um Pier Digital especial para você', '', 0, 0, '0', '0'),
(4030, 1, 0, 'dc_description', NULL, 0, NULL, NULL, 'soluções em internet, identidade visual, Registro de Domínios, Hospedagem de Site, Criação de Sites, Logotipos, Divulgação de Sites, Links Patrocinados, Mala Direta, Lojas Virtuais, Construtor de Sites, aplicativos,componentes, fotografia, site,', 0, 0, '0', '0'),
(4031, 1, 0, 'dc_lastupdate', NULL, 0, NULL, '2015-04-27', '', 0, 0, '0', '0'),
(4032, 1, 0, 'dc_language', NULL, 0, NULL, 'PT', '', 0, 0, '0', '0'),
(4033, 1, 0, 'dc_publisher', NULL, 0, NULL, 'PurplePier ME', '', 0, 0, '0', '0'),
(4034, 1, 0, 'dc_email', NULL, 0, NULL, 'contato@purplepier.com.br', '', 0, 0, '0', '0'),
(4035, 1, 0, 'dc_creator', NULL, 0, NULL, 'Carlos Garcia', '', 0, 0, '0', '0'),
(4036, 1, 0, 'dc_contributor', NULL, 0, NULL, 'Paula Beatriz', '', 0, 0, '0', '0'),
(4037, 1, 0, 'dc_relation', NULL, 0, NULL, 'site e suas páginas internas', '', 0, 0, '0', '0'),
(4038, 1, 0, 'dc_coverage', NULL, 0, NULL, 'PurplePier Me, Locaweb', '', 0, 0, '0', '0'),
(4039, 1, 0, 'dc_copyright', NULL, 0, NULL, NULL, 'Copyright 2012, PurplePier Me, Todos os direitos reservados', 0, 0, '0', '0'),
(4040, 79, 0, 'dc_title', NULL, 0, NULL, 'Digital Pier', '', 0, 0, '0', '0'),
(4041, 79, 0, 'dc_description', NULL, 0, NULL, NULL, 'Registro de Domínios, hospedagem de Sites, Criação de Sites, Logotipos, Divulgação de Sites, links Patrocinados, Mala Direta, Lojas Virtuais, Sessão de fotografia de produtos para ecommerce, Gerenciamento de Conteúdo (CMS), Desenvolvimento de Sistemas Web TI, Obtenção de Certificado Digital SSL e mais.', 0, 0, '0', '0'),
(4042, 79, 0, 'dc_lastupdate', NULL, 0, NULL, '2015-04-22', '', 0, 0, '0', '0'),
(4043, 28, 0, 'dc_title', NULL, 0, NULL, 'Blog', '', 0, 0, '0', '0'),
(4044, 28, 0, 'dc_lastupdate', NULL, 0, NULL, '2016-08-15', '', 0, 0, '0', '0'),
(4045, 58, 0, 'dc_title', NULL, 0, NULL, 'Blog', '', 0, 0, '0', '0'),
(4046, 58, 0, 'dc_lastupdate', NULL, 0, NULL, '2014-12-04', '', 0, 0, '0', '0'),
(4047, 58, 0, 'gel_fr_initial', NULL, 0, NULL, NULL, 'Veja as ultimas notícias de nosso Blog', 0, 0, '0', '0'),
(4048, 50, 0, 'dc_lastupdate', NULL, 0, NULL, '2015-02-28', '', 0, 0, '0', '0'),
(4049, 58, 0, 'dc_description', NULL, 0, NULL, NULL, 'blog, matérias, novidades, PurplePier, site, fotos, identidade visual, ecommerce, componentes, aplicativos', 0, 0, '0', '0'),
(4050, 28, 0, 'dc_description', NULL, 0, NULL, NULL, 'blog, matérias, novidades, artigos, promoções', 0, 0, '0', '0'),
(4051, 28, 0, 'gel_fr_initial', NULL, 0, NULL, NULL, 'Blog de notícias, dicas e novidades', 0, 0, '0', '0'),
(4052, 7, 0, 'dc_title', NULL, 0, NULL, 'Tire suas dúvidas e entre em contato', '', 0, 0, '0', '0'),
(4053, 7, 0, 'dc_description', NULL, 0, NULL, NULL, 'contato, telefone, e-mail, endereço', 0, 0, '0', '0'),
(4054, 7, 0, 'dc_lastupdate', NULL, 0, NULL, '2016-08-15', '', 0, 0, '0', '0'),
(4055, 1, 0, 'descricao_exibe', 0, 0, '2014-12-05 18:37:04', NULL, '', 219, 29, 'inteiro', 'desktop'),
(4056, 1, 0, 'exibe_extra_1', 0, 0, '2014-12-05 18:37:04', NULL, '', 219, 29, 'inteiro', 'desktop'),
(4057, 1, 0, 'exibe_extra_2', 0, 0, '2014-12-05 18:37:04', NULL, '', 219, 29, 'inteiro', 'desktop'),
(4058, 1, 0, 'exibe_extra_3', 0, 0, '2014-12-05 18:37:04', NULL, '', 219, 29, 'inteiro', 'desktop'),
(4059, 1, 0, 'exibe_extra_4', 0, 0, '2014-12-05 18:37:04', NULL, '', 219, 29, 'inteiro', 'desktop'),
(4060, 97, 0, 'dc_title', NULL, 0, NULL, 'Meus links favoritos', '', 0, 0, '0', '0'),
(4061, 97, 0, 'dc_lastupdate', NULL, 0, NULL, '2014-12-06', '', 0, 0, '0', '0'),
(4062, 97, 0, 'gel_fr_initial', NULL, 0, NULL, NULL, 'Veja alguns links interessantes', 0, 0, '0', '0'),
(4063, 161, 0, 'dc_title', NULL, 0, NULL, 'Wiki de ajuda', '', 0, 0, '0', '0'),
(4064, 161, 0, 'dc_lastupdate', NULL, 0, NULL, '2015-04-27', '', 0, 0, '0', '0'),
(4065, 161, 0, 'dc_description', NULL, 0, NULL, NULL, 'Wiki, ajuda, Dicas, Informações, Suporte, Tutoriais', 0, 0, '0', '0'),
(4066, 161, 0, 'gel_fr_initial', NULL, 0, NULL, NULL, 'Aprenda como utilizar os recursos', 0, 0, '0', '0'),
(4067, 145, 0, 'dc_title', NULL, 0, NULL, 'Dicas', '', 0, 0, '0', '0'),
(4068, 145, 0, 'dc_lastupdate', NULL, 0, NULL, '2014-12-11', '', 0, 0, '0', '0'),
(4069, 140, 0, 'titulo_1', NULL, 0, '2014-12-11 19:36:38', NULL, '', 207, 222, 'texto', 'desktop'),
(4070, 140, 0, 'subtitulo_1', NULL, 0, '2014-12-11 19:36:39', NULL, '', 207, 222, 'texto', 'desktop'),
(4071, 140, 0, 'texto_1', NULL, 0, '2014-12-11 19:36:39', NULL, '', 207, 222, 'texto', 'desktop'),
(4072, 140, 0, 'link_1', NULL, 0, '2014-12-11 19:36:39', NULL, '', 207, 222, 'texto', 'desktop'),
(4073, 140, 0, 'image_1', NULL, 0, '2014-12-11 19:36:39', '17_pier_comboshare_w7.png', '', 207, 222, 'texto', 'desktop'),
(4074, 140, 0, 'layout_1', NULL, 0, '2014-12-11 19:36:39', 'up', '', 207, 222, 'texto', 'desktop'),
(4075, 140, 0, 'cor_1', NULL, 0, '2014-12-11 19:36:39', '', '', 207, 222, 'texto', 'desktop'),
(4076, 140, 0, 'cor_2', NULL, 0, '2014-12-11 19:36:40', '', '', 207, 222, 'texto', 'desktop'),
(4077, 140, 0, 'cor_3', NULL, 0, '2014-12-11 19:36:40', '', '', 207, 222, 'texto', 'desktop'),
(4078, 140, 0, 'alinhamento_1', NULL, 0, '2014-12-11 19:36:40', 'left', '', 207, 222, 'texto', 'desktop'),
(4079, 140, 0, 'alinhamento_2', NULL, 0, '2014-12-11 19:36:40', 'left', '', 207, 222, 'texto', 'desktop'),
(4080, 140, 0, 'alinhamento_3', NULL, 0, '2014-12-11 19:36:40', 'left', '', 207, 222, 'texto', 'desktop'),
(4081, 140, 0, 'margin_top', 0, 0, '2014-12-11 19:36:40', NULL, '', 207, 222, 'inteiro', 'desktop'),
(4082, 140, 0, 'margin_bottom', 0, 0, '2014-12-11 19:36:41', NULL, '', 207, 222, 'inteiro', 'desktop'),
(4083, 140, 0, 'padding_top', 0, 0, '2014-12-11 19:36:41', NULL, '', 207, 222, 'inteiro', 'desktop'),
(4084, 140, 0, 'padding_bottom', 0, 0, '2014-12-11 19:36:41', NULL, '', 207, 222, 'inteiro', 'desktop'),
(4085, 140, 0, 'is_full', 0, 0, '2014-12-11 19:36:41', NULL, '', 207, 222, 'inteiro', 'desktop'),
(4086, 140, 0, 'titulo_componente', NULL, 0, '2014-12-11 19:36:41', 'Pier Combo Share', '', 207, 222, 'texto', 'desktop'),
(4087, 140, 0, 'background_type', 0, 0, '2014-12-11 19:36:41', NULL, '', 207, 222, 'inteiro', 'desktop'),
(4088, 140, 0, 'background', NULL, 0, '2014-12-11 19:36:41', '', '', 207, 222, 'texto', 'desktop'),
(4089, 140, 0, 'titulo_1', NULL, 0, '2014-12-11 19:43:20', NULL, '', 207, 223, 'texto', 'desktop'),
(4090, 140, 0, 'subtitulo_1', NULL, 0, '2014-12-11 19:43:20', NULL, '', 207, 223, 'texto', 'desktop'),
(4091, 140, 0, 'texto_1', NULL, 0, '2014-12-11 19:43:20', NULL, '', 207, 223, 'texto', 'desktop'),
(4092, 140, 0, 'link_1', NULL, 0, '2014-12-11 19:43:20', NULL, '', 207, 223, 'texto', 'desktop'),
(4093, 140, 0, 'image_1', NULL, 0, '2014-12-11 19:43:20', 'pier_bugfree_18_r7.png', '', 207, 223, 'texto', 'desktop'),
(4094, 140, 0, 'layout_1', NULL, 0, '2014-12-11 19:43:20', 'up', '', 207, 223, 'texto', 'desktop'),
(4095, 140, 0, 'cor_1', NULL, 0, '2014-12-11 19:43:21', '', '', 207, 223, 'texto', 'desktop'),
(4096, 140, 0, 'cor_2', NULL, 0, '2014-12-11 19:43:21', '', '', 207, 223, 'texto', 'desktop'),
(4097, 140, 0, 'cor_3', NULL, 0, '2014-12-11 19:43:21', '', '', 207, 223, 'texto', 'desktop'),
(4098, 140, 0, 'alinhamento_1', NULL, 0, '2014-12-11 19:43:21', 'left', '', 207, 223, 'texto', 'desktop'),
(4099, 140, 0, 'alinhamento_2', NULL, 0, '2014-12-11 19:43:21', 'left', '', 207, 223, 'texto', 'desktop'),
(4100, 140, 0, 'alinhamento_3', NULL, 0, '2014-12-11 19:43:21', 'left', '', 207, 223, 'texto', 'desktop'),
(4101, 140, 0, 'margin_top', 0, 0, '2014-12-11 19:43:21', NULL, '', 207, 223, 'inteiro', 'desktop'),
(4102, 140, 0, 'margin_bottom', 0, 0, '2014-12-11 19:43:21', NULL, '', 207, 223, 'inteiro', 'desktop'),
(4103, 140, 0, 'padding_top', 0, 0, '2014-12-11 19:43:21', NULL, '', 207, 223, 'inteiro', 'desktop'),
(4104, 140, 0, 'padding_bottom', 0, 0, '2014-12-11 19:43:22', NULL, '', 207, 223, 'inteiro', 'desktop'),
(4105, 140, 0, 'is_full', 0, 0, '2014-12-11 19:43:22', NULL, '', 207, 223, 'inteiro', 'desktop'),
(4106, 140, 0, 'titulo_componente', NULL, 0, '2014-12-11 19:43:22', 'Pier BugFree', '', 207, 223, 'texto', 'desktop'),
(4107, 140, 0, 'background_type', 0, 0, '2014-12-11 19:43:22', NULL, '', 207, 223, 'inteiro', 'desktop'),
(4108, 140, 0, 'background', NULL, 0, '2014-12-11 19:43:22', '', '', 207, 223, 'texto', 'desktop'),
(4109, 140, 0, 'titulo_1', NULL, 0, '2014-12-11 19:48:24', NULL, '', 207, 224, 'texto', 'desktop'),
(4110, 140, 0, 'subtitulo_1', NULL, 0, '2014-12-11 19:48:24', NULL, '', 207, 224, 'texto', 'desktop'),
(4111, 140, 0, 'texto_1', NULL, 0, '2014-12-11 19:48:24', NULL, '', 207, 224, 'texto', 'desktop'),
(4112, 140, 0, 'link_1', NULL, 0, '2014-12-11 19:48:24', NULL, '', 207, 224, 'texto', 'desktop'),
(4113, 140, 0, 'image_1', NULL, 0, '2014-12-11 19:48:24', 'pierfaq_19_e6.png', '', 207, 224, 'texto', 'desktop'),
(4114, 140, 0, 'layout_1', NULL, 0, '2014-12-11 19:48:24', 'up', '', 207, 224, 'texto', 'desktop'),
(4115, 140, 0, 'cor_1', NULL, 0, '2014-12-11 19:48:24', '', '', 207, 224, 'texto', 'desktop'),
(4116, 140, 0, 'cor_2', NULL, 0, '2014-12-11 19:48:24', '', '', 207, 224, 'texto', 'desktop'),
(4117, 140, 0, 'cor_3', NULL, 0, '2014-12-11 19:48:24', '', '', 207, 224, 'texto', 'desktop'),
(4118, 140, 0, 'alinhamento_1', NULL, 0, '2014-12-11 19:48:25', 'left', '', 207, 224, 'texto', 'desktop'),
(4119, 140, 0, 'alinhamento_2', NULL, 0, '2014-12-11 19:48:25', 'left', '', 207, 224, 'texto', 'desktop'),
(4120, 140, 0, 'alinhamento_3', NULL, 0, '2014-12-11 19:48:25', 'left', '', 207, 224, 'texto', 'desktop'),
(4121, 140, 0, 'margin_top', 0, 0, '2014-12-11 19:48:25', NULL, '', 207, 224, 'inteiro', 'desktop'),
(4122, 140, 0, 'margin_bottom', 0, 0, '2014-12-11 19:48:25', NULL, '', 207, 224, 'inteiro', 'desktop'),
(4123, 140, 0, 'padding_top', 0, 0, '2014-12-11 19:48:25', NULL, '', 207, 224, 'inteiro', 'desktop'),
(4124, 140, 0, 'padding_bottom', 0, 0, '2014-12-11 19:48:25', NULL, '', 207, 224, 'inteiro', 'desktop'),
(4125, 140, 0, 'is_full', 0, 0, '2014-12-11 19:48:25', NULL, '', 207, 224, 'inteiro', 'desktop'),
(4126, 140, 0, 'titulo_componente', NULL, 0, '2014-12-11 19:48:25', 'Pier Faq', '', 207, 224, 'texto', 'desktop'),
(4127, 140, 0, 'background_type', 0, 0, '2014-12-11 19:48:25', NULL, '', 207, 224, 'inteiro', 'desktop'),
(4128, 140, 0, 'background', NULL, 0, '2014-12-11 19:48:26', '', '', 207, 224, 'texto', 'desktop'),
(4129, 140, 0, 'titulo_1', NULL, 0, '2014-12-11 19:50:43', NULL, '', 207, 225, 'texto', 'desktop'),
(4130, 140, 0, 'subtitulo_1', NULL, 0, '2014-12-11 19:50:44', NULL, '', 207, 225, 'texto', 'desktop'),
(4131, 140, 0, 'texto_1', NULL, 0, '2014-12-11 19:50:44', NULL, '', 207, 225, 'texto', 'desktop'),
(4132, 140, 0, 'link_1', NULL, 0, '2014-12-11 19:50:44', NULL, '', 207, 225, 'texto', 'desktop'),
(4133, 140, 0, 'image_1', NULL, 0, '2014-12-11 19:50:44', 'pierwiki_19_w8.png', '', 207, 225, 'texto', 'desktop'),
(4134, 140, 0, 'layout_1', NULL, 0, '2014-12-11 19:50:44', 'up', '', 207, 225, 'texto', 'desktop'),
(4135, 140, 0, 'cor_1', NULL, 0, '2014-12-11 19:50:44', '', '', 207, 225, 'texto', 'desktop'),
(4136, 140, 0, 'cor_2', NULL, 0, '2014-12-11 19:50:45', '', '', 207, 225, 'texto', 'desktop'),
(4137, 140, 0, 'cor_3', NULL, 0, '2014-12-11 19:50:45', '', '', 207, 225, 'texto', 'desktop'),
(4138, 140, 0, 'alinhamento_1', NULL, 0, '2014-12-11 19:50:45', 'left', '', 207, 225, 'texto', 'desktop'),
(4139, 140, 0, 'alinhamento_2', NULL, 0, '2014-12-11 19:50:45', 'left', '', 207, 225, 'texto', 'desktop'),
(4140, 140, 0, 'alinhamento_3', NULL, 0, '2014-12-11 19:50:45', 'left', '', 207, 225, 'texto', 'desktop'),
(4141, 140, 0, 'margin_top', 0, 0, '2014-12-11 19:50:45', NULL, '', 207, 225, 'inteiro', 'desktop'),
(4142, 140, 0, 'margin_bottom', 0, 0, '2014-12-11 19:50:45', NULL, '', 207, 225, 'inteiro', 'desktop'),
(4143, 140, 0, 'padding_top', 0, 0, '2014-12-11 19:50:45', NULL, '', 207, 225, 'inteiro', 'desktop'),
(4144, 140, 0, 'padding_bottom', 0, 0, '2014-12-11 19:50:45', NULL, '', 207, 225, 'inteiro', 'desktop'),
(4145, 140, 0, 'is_full', 0, 0, '2014-12-11 19:50:45', NULL, '', 207, 225, 'inteiro', 'desktop'),
(4146, 140, 0, 'titulo_componente', NULL, 0, '2014-12-11 19:50:45', 'Pier Wiki', '', 207, 225, 'texto', 'desktop'),
(4147, 140, 0, 'background_type', 0, 0, '2014-12-11 19:50:45', NULL, '', 207, 225, 'inteiro', 'desktop'),
(4148, 140, 0, 'background', NULL, 0, '2014-12-11 19:50:46', '', '', 207, 225, 'texto', 'desktop'),
(4149, 140, 0, 'titulo_1', NULL, 0, '2014-12-11 19:52:45', NULL, '', 207, 226, 'texto', 'desktop'),
(4150, 140, 0, 'subtitulo_1', NULL, 0, '2014-12-11 19:52:45', NULL, '', 207, 226, 'texto', 'desktop'),
(4151, 140, 0, 'texto_1', NULL, 0, '2014-12-11 19:52:45', NULL, '', 207, 226, 'texto', 'desktop'),
(4152, 140, 0, 'link_1', NULL, 0, '2014-12-11 19:52:45', NULL, '', 207, 226, 'texto', 'desktop'),
(4153, 140, 0, 'image_1', NULL, 0, '2014-12-11 19:52:45', 'video_hollywood_20_r0.png', '', 207, 226, 'texto', 'desktop'),
(4154, 140, 0, 'layout_1', NULL, 0, '2014-12-11 19:52:45', 'up', '', 207, 226, 'texto', 'desktop'),
(4155, 140, 0, 'cor_1', NULL, 0, '2014-12-11 19:52:45', '', '', 207, 226, 'texto', 'desktop'),
(4156, 140, 0, 'cor_2', NULL, 0, '2014-12-11 19:52:46', '', '', 207, 226, 'texto', 'desktop'),
(4157, 140, 0, 'cor_3', NULL, 0, '2014-12-11 19:52:46', '', '', 207, 226, 'texto', 'desktop'),
(4158, 140, 0, 'alinhamento_1', NULL, 0, '2014-12-11 19:52:46', 'left', '', 207, 226, 'texto', 'desktop'),
(4159, 140, 0, 'alinhamento_2', NULL, 0, '2014-12-11 19:52:46', 'left', '', 207, 226, 'texto', 'desktop'),
(4160, 140, 0, 'alinhamento_3', NULL, 0, '2014-12-11 19:52:46', 'left', '', 207, 226, 'texto', 'desktop'),
(4161, 140, 0, 'margin_top', 0, 0, '2014-12-11 19:52:46', NULL, '', 207, 226, 'inteiro', 'desktop'),
(4162, 140, 0, 'margin_bottom', 0, 0, '2014-12-11 19:52:46', NULL, '', 207, 226, 'inteiro', 'desktop'),
(4163, 140, 0, 'padding_top', 0, 0, '2014-12-11 19:52:46', NULL, '', 207, 226, 'inteiro', 'desktop'),
(4164, 140, 0, 'padding_bottom', 0, 0, '2014-12-11 19:52:47', NULL, '', 207, 226, 'inteiro', 'desktop'),
(4165, 140, 0, 'is_full', 0, 0, '2014-12-11 19:52:47', NULL, '', 207, 226, 'inteiro', 'desktop'),
(4166, 140, 0, 'titulo_componente', NULL, 0, '2014-12-11 19:52:47', 'Video  Hollywood ', '', 207, 226, 'texto', 'desktop'),
(4167, 140, 0, 'background_type', 0, 0, '2014-12-11 19:52:47', NULL, '', 207, 226, 'inteiro', 'desktop'),
(4168, 140, 0, 'background', NULL, 0, '2014-12-11 19:52:47', '', '', 207, 226, 'texto', 'desktop'),
(4169, 162, 0, 'dc_title', NULL, 0, NULL, 'Páginas Avançadas', '', 0, 0, '0', '0'),
(4170, 162, 0, 'dc_lastupdate', NULL, 0, NULL, '2014-12-13', '', 0, 0, '0', '0'),
(4171, 162, 0, 'gel_fr_initial', NULL, 0, NULL, NULL, 'Updates para sua plataforma de negócios', 0, 0, '0', '0'),
(4172, 163, 0, 'dc_date', NULL, 0, NULL, '2014-12-18', '', 0, 0, '0', '0'),
(4173, 163, 0, 'dc_title', NULL, 0, NULL, 'Vizualização do componente', '', 0, 0, '0', '0'),
(4174, 163, 0, 'dc_lastupdate', NULL, 0, NULL, '2014-12-29', '', 0, 0, '0', '0'),
(4175, 163, 0, 'gel_fr_initial', NULL, 0, NULL, NULL, 'Veja como ele funciona', 0, 0, '0', '0'),
(4176, 163, 0, 'titulo_1', NULL, 0, '2014-12-18 19:46:41', NULL, 'Ok, legal!', 323, 227, 'texto', 'desktop'),
(4177, 163, 0, 'subtitulo_1', NULL, 0, '2014-12-18 19:46:41', NULL, 'Deu tudo certo até aqui', 323, 227, 'texto', 'desktop'),
(4178, 163, 0, 'texto_1', NULL, 0, '2014-12-18 19:46:42', NULL, 'Mensagem de sucesso para seus usuários\r\n', 323, 227, 'texto', 'desktop'),
(4179, 163, 0, 'link_1', NULL, 0, '2014-12-18 19:46:42', NULL, '', 323, 227, 'texto', 'desktop'),
(4180, 163, 0, 'layout_1', NULL, 0, '2014-12-18 19:46:42', 'success', '', 323, 227, 'texto', 'desktop'),
(4181, 163, 0, 'cor_1', NULL, 0, '2014-12-18 19:46:43', '', '', 323, 227, 'texto', 'desktop'),
(4182, 163, 0, 'cor_2', NULL, 0, '2014-12-18 19:46:43', '', '', 323, 227, 'texto', 'desktop'),
(4183, 163, 0, 'cor_3', NULL, 0, '2014-12-18 19:46:43', '', '', 323, 227, 'texto', 'desktop'),
(4184, 163, 0, 'alinhamento_1', NULL, 0, '2014-12-18 19:46:43', 'left', '', 323, 227, 'texto', 'desktop'),
(4185, 163, 0, 'alinhamento_2', NULL, 0, '2014-12-18 19:46:43', 'left', '', 323, 227, 'texto', 'desktop'),
(4186, 163, 0, 'alinhamento_3', NULL, 0, '2014-12-18 19:46:43', 'left', '', 323, 227, 'texto', 'desktop'),
(4187, 163, 0, 'margin_top', 20, 0, '2014-12-18 19:46:44', NULL, '', 323, 227, 'inteiro', 'desktop'),
(4188, 163, 0, 'margin_bottom', 20, 0, '2014-12-18 19:46:44', NULL, '', 323, 227, 'inteiro', 'desktop'),
(4189, 163, 0, 'padding_top', 0, 0, '2014-12-18 19:46:44', NULL, '', 323, 227, 'inteiro', 'desktop'),
(4190, 163, 0, 'padding_bottom', 0, 0, '2014-12-18 19:46:44', NULL, '', 323, 227, 'inteiro', 'desktop'),
(4191, 163, 0, 'is_full', 0, 0, '2014-12-18 19:46:44', NULL, '', 323, 227, 'inteiro', 'desktop'),
(4192, 163, 0, 'titulo_componente', NULL, 0, '2014-12-18 19:46:44', 'Sucesso', '', 323, 227, 'texto', 'desktop'),
(4193, 163, 0, 'background_type', 0, 0, '2014-12-18 19:46:44', NULL, '', 323, 227, 'inteiro', 'desktop'),
(4194, 163, 0, 'background', NULL, 0, '2014-12-18 19:46:44', '', '', 323, 227, 'texto', 'desktop'),
(4195, 1, 0, 'titulo_1', NULL, 0, '2014-12-18 19:48:35', NULL, '', 207, 232, 'texto', 'desktop'),
(4196, 1, 0, 'subtitulo_1', NULL, 0, '2014-12-18 19:48:35', NULL, '', 207, 232, 'texto', 'desktop'),
(4197, 1, 0, 'texto_1', NULL, 0, '2014-12-18 19:48:36', NULL, '', 207, 232, 'texto', 'desktop'),
(4198, 1, 0, 'link_1', NULL, 0, '2014-12-18 19:48:36', NULL, '', 207, 232, 'texto', 'desktop'),
(4199, 1, 0, 'image_1', NULL, 0, '2014-12-18 19:48:36', 'site_natal_h8.png', '', 207, 232, 'texto', 'desktop'),
(4200, 1, 0, 'layout_1', NULL, 0, '2014-12-18 19:48:36', 'up', '', 207, 232, 'texto', 'desktop'),
(4201, 1, 0, 'cor_1', NULL, 0, '2014-12-18 19:48:36', '', '', 207, 232, 'texto', 'desktop'),
(4202, 1, 0, 'cor_2', NULL, 0, '2014-12-18 19:48:36', '', '', 207, 232, 'texto', 'desktop'),
(4203, 1, 0, 'cor_3', NULL, 0, '2014-12-18 19:48:36', '', '', 207, 232, 'texto', 'desktop'),
(4204, 1, 0, 'alinhamento_1', NULL, 0, '2014-12-18 19:48:36', 'left', '', 207, 232, 'texto', 'desktop'),
(4205, 1, 0, 'alinhamento_2', NULL, 0, '2014-12-18 19:48:36', 'left', '', 207, 232, 'texto', 'desktop'),
(4206, 1, 0, 'alinhamento_3', NULL, 0, '2014-12-18 19:48:36', 'left', '', 207, 232, 'texto', 'desktop'),
(4207, 1, 0, 'margin_top', 0, 0, '2014-12-18 19:48:36', NULL, '', 207, 232, 'inteiro', 'desktop'),
(4208, 1, 0, 'margin_bottom', 0, 0, '2014-12-18 19:48:36', NULL, '', 207, 232, 'inteiro', 'desktop'),
(4209, 1, 0, 'padding_top', 0, 0, '2014-12-18 19:48:36', NULL, '', 207, 232, 'inteiro', 'desktop'),
(4210, 1, 0, 'padding_bottom', 0, 0, '2014-12-18 19:48:36', NULL, '', 207, 232, 'inteiro', 'desktop'),
(4211, 1, 0, 'is_full', 0, 0, '2014-12-18 19:48:36', NULL, '', 207, 232, 'inteiro', 'desktop'),
(4212, 1, 0, 'titulo_componente', NULL, 0, '2014-12-18 19:48:36', '', '', 207, 232, 'texto', 'desktop'),
(4213, 1, 0, 'background_type', 0, 0, '2014-12-18 19:48:36', NULL, '', 207, 232, 'inteiro', 'desktop'),
(4214, 1, 0, 'background', NULL, 0, '2014-12-18 19:48:36', '', '', 207, 232, 'texto', 'desktop'),
(4215, 163, 0, 'titulo_1', NULL, 0, '2014-12-18 19:53:46', NULL, 'Ops, não faça desse modo', 323, 228, 'texto', 'desktop'),
(4216, 163, 0, 'subtitulo_1', NULL, 0, '2014-12-18 19:53:46', NULL, '- evite desperdício', 323, 228, 'texto', 'desktop'),
(4217, 163, 0, 'texto_1', NULL, 0, '2014-12-18 19:53:46', NULL, 'Mensagem de erro, perigo ou alerta máximo', 323, 228, 'texto', 'desktop'),
(4218, 163, 0, 'link_1', NULL, 0, '2014-12-18 19:53:46', NULL, '', 323, 228, 'texto', 'desktop'),
(4219, 163, 0, 'layout_1', NULL, 0, '2014-12-18 19:53:46', 'danger', '', 323, 228, 'texto', 'desktop'),
(4220, 163, 0, 'cor_1', NULL, 0, '2014-12-18 19:53:46', '', '', 323, 228, 'texto', 'desktop'),
(4221, 163, 0, 'cor_2', NULL, 0, '2014-12-18 19:53:47', '', '', 323, 228, 'texto', 'desktop'),
(4222, 163, 0, 'cor_3', NULL, 0, '2014-12-18 19:53:47', '', '', 323, 228, 'texto', 'desktop'),
(4223, 163, 0, 'alinhamento_1', NULL, 0, '2014-12-18 19:53:47', 'left', '', 323, 228, 'texto', 'desktop'),
(4224, 163, 0, 'alinhamento_2', NULL, 0, '2014-12-18 19:53:47', 'left', '', 323, 228, 'texto', 'desktop'),
(4225, 163, 0, 'alinhamento_3', NULL, 0, '2014-12-18 19:53:47', 'left', '', 323, 228, 'texto', 'desktop'),
(4226, 163, 0, 'margin_top', 20, 0, '2014-12-18 19:53:48', NULL, '', 323, 228, 'inteiro', 'desktop'),
(4227, 163, 0, 'margin_bottom', 20, 0, '2014-12-18 19:53:48', NULL, '', 323, 228, 'inteiro', 'desktop'),
(4228, 163, 0, 'padding_top', 0, 0, '2014-12-18 19:53:48', NULL, '', 323, 228, 'inteiro', 'desktop'),
(4229, 163, 0, 'padding_bottom', 0, 0, '2014-12-18 19:53:48', NULL, '', 323, 228, 'inteiro', 'desktop'),
(4230, 163, 0, 'is_full', 0, 0, '2014-12-18 19:53:48', NULL, '', 323, 228, 'inteiro', 'desktop'),
(4231, 163, 0, 'titulo_componente', NULL, 0, '2014-12-18 19:53:48', 'Erro', '', 323, 228, 'texto', 'desktop'),
(4232, 163, 0, 'background_type', 0, 0, '2014-12-18 19:53:48', NULL, '', 323, 228, 'inteiro', 'desktop'),
(4233, 163, 0, 'background', NULL, 0, '2014-12-18 19:53:49', '', '', 323, 228, 'texto', 'desktop'),
(4234, 163, 0, 'titulo_1', NULL, 0, '2014-12-18 19:55:46', NULL, 'Hey, olhe isso!', 323, 229, 'texto', 'desktop'),
(4235, 163, 0, 'subtitulo_1', NULL, 0, '2014-12-18 19:55:46', NULL, 'você pode gostar desse texto', 323, 229, 'texto', 'desktop'),
(4236, 163, 0, 'texto_1', NULL, 0, '2014-12-18 19:55:46', NULL, 'Mensagem de destaque sem fazer muito alarde', 323, 229, 'texto', 'desktop'),
(4237, 163, 0, 'link_1', NULL, 0, '2014-12-18 19:55:46', NULL, '', 323, 229, 'texto', 'desktop'),
(4238, 163, 0, 'layout_1', NULL, 0, '2014-12-18 19:55:46', 'info', '', 323, 229, 'texto', 'desktop'),
(4239, 163, 0, 'cor_1', NULL, 0, '2014-12-18 19:55:46', '', '', 323, 229, 'texto', 'desktop'),
(4240, 163, 0, 'cor_2', NULL, 0, '2014-12-18 19:55:46', '', '', 323, 229, 'texto', 'desktop'),
(4241, 163, 0, 'cor_3', NULL, 0, '2014-12-18 19:55:46', '', '', 323, 229, 'texto', 'desktop'),
(4242, 163, 0, 'alinhamento_1', NULL, 0, '2014-12-18 19:55:46', 'left', '', 323, 229, 'texto', 'desktop'),
(4243, 163, 0, 'alinhamento_2', NULL, 0, '2014-12-18 19:55:46', 'left', '', 323, 229, 'texto', 'desktop'),
(4244, 163, 0, 'alinhamento_3', NULL, 0, '2014-12-18 19:55:46', 'left', '', 323, 229, 'texto', 'desktop'),
(4245, 163, 0, 'margin_top', 20, 0, '2014-12-18 19:55:46', NULL, '', 323, 229, 'inteiro', 'desktop'),
(4246, 163, 0, 'margin_bottom', 20, 0, '2014-12-18 19:55:46', NULL, '', 323, 229, 'inteiro', 'desktop'),
(4247, 163, 0, 'padding_top', 0, 0, '2014-12-18 19:55:46', NULL, '', 323, 229, 'inteiro', 'desktop'),
(4248, 163, 0, 'padding_bottom', 0, 0, '2014-12-18 19:55:46', NULL, '', 323, 229, 'inteiro', 'desktop'),
(4249, 163, 0, 'is_full', 0, 0, '2014-12-18 19:55:46', NULL, '', 323, 229, 'inteiro', 'desktop'),
(4250, 163, 0, 'titulo_componente', NULL, 0, '2014-12-18 19:55:46', 'Destaque', '', 323, 229, 'texto', 'desktop'),
(4251, 163, 0, 'background_type', 0, 0, '2014-12-18 19:55:46', NULL, '', 323, 229, 'inteiro', 'desktop'),
(4252, 163, 0, 'background', NULL, 0, '2014-12-18 19:55:46', '', '', 323, 229, 'texto', 'desktop'),
(4253, 163, 0, 'titulo_1', NULL, 0, '2014-12-18 19:57:12', NULL, 'Informação', 323, 230, 'texto', 'desktop'),
(4254, 163, 0, 'subtitulo_1', NULL, 0, '2014-12-18 19:57:12', NULL, 'Preste atenção nos sinais', 323, 230, 'texto', 'desktop'),
(4255, 163, 0, 'texto_1', NULL, 0, '2014-12-18 19:57:12', NULL, 'Mensagem de alerta com nível moderado de atenção', 323, 230, 'texto', 'desktop'),
(4256, 163, 0, 'link_1', NULL, 0, '2014-12-18 19:57:12', NULL, '', 323, 230, 'texto', 'desktop'),
(4257, 163, 0, 'layout_1', NULL, 0, '2014-12-18 19:57:12', 'warning', '', 323, 230, 'texto', 'desktop'),
(4258, 163, 0, 'cor_1', NULL, 0, '2014-12-18 19:57:12', '', '', 323, 230, 'texto', 'desktop'),
(4259, 163, 0, 'cor_2', NULL, 0, '2014-12-18 19:57:12', '', '', 323, 230, 'texto', 'desktop'),
(4260, 163, 0, 'cor_3', NULL, 0, '2014-12-18 19:57:12', '', '', 323, 230, 'texto', 'desktop'),
(4261, 163, 0, 'alinhamento_1', NULL, 0, '2014-12-18 19:57:12', 'left', '', 323, 230, 'texto', 'desktop'),
(4262, 163, 0, 'alinhamento_2', NULL, 0, '2014-12-18 19:57:12', 'left', '', 323, 230, 'texto', 'desktop'),
(4263, 163, 0, 'alinhamento_3', NULL, 0, '2014-12-18 19:57:12', 'left', '', 323, 230, 'texto', 'desktop'),
(4264, 163, 0, 'margin_top', 0, 0, '2014-12-18 19:57:12', NULL, '', 323, 230, 'inteiro', 'desktop'),
(4265, 163, 0, 'margin_bottom', 0, 0, '2014-12-18 19:57:12', NULL, '', 323, 230, 'inteiro', 'desktop'),
(4266, 163, 0, 'padding_top', 0, 0, '2014-12-18 19:57:12', NULL, '', 323, 230, 'inteiro', 'desktop'),
(4267, 163, 0, 'padding_bottom', 0, 0, '2014-12-18 19:57:12', NULL, '', 323, 230, 'inteiro', 'desktop'),
(4268, 163, 0, 'is_full', 0, 0, '2014-12-18 19:57:12', NULL, '', 323, 230, 'inteiro', 'desktop'),
(4269, 163, 0, 'titulo_componente', NULL, 0, '2014-12-18 19:57:12', 'Informação', '', 323, 230, 'texto', 'desktop'),
(4270, 163, 0, 'background_type', 0, 0, '2014-12-18 19:57:12', NULL, '', 323, 230, 'inteiro', 'desktop'),
(4271, 163, 0, 'background', NULL, 0, '2014-12-18 19:57:12', '', '', 323, 230, 'texto', 'desktop'),
(4272, 163, 0, 'titulo_1', NULL, 0, '2014-12-18 19:58:19', NULL, 'Dica', 323, 231, 'texto', 'desktop'),
(4273, 163, 0, 'subtitulo_1', NULL, 0, '2014-12-18 19:58:19', NULL, 'Uma boa idéia nunca deve ficar na gaveta', 323, 231, 'texto', 'desktop'),
(4274, 163, 0, 'texto_1', NULL, 0, '2014-12-18 19:58:19', NULL, 'Mensagem de dica com informação importante que deve ser memorizada ', 323, 231, 'texto', 'desktop'),
(4275, 163, 0, 'link_1', NULL, 0, '2014-12-18 19:58:19', NULL, '', 323, 231, 'texto', 'desktop'),
(4276, 163, 0, 'layout_1', NULL, 0, '2014-12-18 19:58:19', 'tip', '', 323, 231, 'texto', 'desktop'),
(4277, 163, 0, 'cor_1', NULL, 0, '2014-12-18 19:58:19', '', '', 323, 231, 'texto', 'desktop'),
(4278, 163, 0, 'cor_2', NULL, 0, '2014-12-18 19:58:19', '', '', 323, 231, 'texto', 'desktop'),
(4279, 163, 0, 'cor_3', NULL, 0, '2014-12-18 19:58:19', '', '', 323, 231, 'texto', 'desktop'),
(4280, 163, 0, 'alinhamento_1', NULL, 0, '2014-12-18 19:58:19', 'left', '', 323, 231, 'texto', 'desktop'),
(4281, 163, 0, 'alinhamento_2', NULL, 0, '2014-12-18 19:58:19', 'left', '', 323, 231, 'texto', 'desktop'),
(4282, 163, 0, 'alinhamento_3', NULL, 0, '2014-12-18 19:58:19', 'left', '', 323, 231, 'texto', 'desktop'),
(4283, 163, 0, 'margin_top', 20, 0, '2014-12-18 19:58:19', NULL, '', 323, 231, 'inteiro', 'desktop'),
(4284, 163, 0, 'margin_bottom', 20, 0, '2014-12-18 19:58:19', NULL, '', 323, 231, 'inteiro', 'desktop'),
(4285, 163, 0, 'padding_top', 0, 0, '2014-12-18 19:58:19', NULL, '', 323, 231, 'inteiro', 'desktop'),
(4286, 163, 0, 'padding_bottom', 0, 0, '2014-12-18 19:58:19', NULL, '', 323, 231, 'inteiro', 'desktop'),
(4287, 163, 0, 'is_full', 0, 0, '2014-12-18 19:58:19', NULL, '', 323, 231, 'inteiro', 'desktop'),
(4288, 163, 0, 'titulo_componente', NULL, 0, '2014-12-18 19:58:19', 'Dica', '', 323, 231, 'texto', 'desktop'),
(4289, 163, 0, 'background_type', 0, 0, '2014-12-18 19:58:19', NULL, '', 323, 231, 'inteiro', 'desktop'),
(4290, 163, 0, 'background', NULL, 0, '2014-12-18 19:58:19', '', '', 323, 231, 'texto', 'desktop'),
(4291, 1, 0, 'titulo_1', NULL, 0, '2014-12-18 20:19:52', NULL, '', 207, 233, 'texto', 'desktop'),
(4292, 1, 0, 'subtitulo_1', NULL, 0, '2014-12-18 20:19:52', NULL, '', 207, 233, 'texto', 'desktop'),
(4293, 1, 0, 'texto_1', NULL, 0, '2014-12-18 20:19:52', NULL, '', 207, 233, 'texto', 'desktop'),
(4294, 1, 0, 'link_1', NULL, 0, '2014-12-18 20:19:52', NULL, '', 207, 233, 'texto', 'desktop'),
(4295, 1, 0, 'image_1', NULL, 0, '2014-12-18 20:19:52', 'feliz_natal_digital_pier_x7.jpg', '', 207, 233, 'texto', 'desktop'),
(4296, 1, 0, 'layout_1', NULL, 0, '2014-12-18 20:19:52', 'up', '', 207, 233, 'texto', 'desktop'),
(4297, 1, 0, 'cor_1', NULL, 0, '2014-12-18 20:19:52', 'FFFFFF', '', 207, 233, 'texto', 'desktop'),
(4298, 1, 0, 'cor_2', NULL, 0, '2014-12-18 20:19:52', 'FFFFFF', '', 207, 233, 'texto', 'desktop'),
(4299, 1, 0, 'cor_3', NULL, 0, '2014-12-18 20:19:52', 'FFFFFF', '', 207, 233, 'texto', 'desktop'),
(4300, 1, 0, 'alinhamento_1', NULL, 0, '2014-12-18 20:19:52', 'left', '', 207, 233, 'texto', 'desktop'),
(4301, 1, 0, 'alinhamento_2', NULL, 0, '2014-12-18 20:19:52', 'left', '', 207, 233, 'texto', 'desktop'),
(4302, 1, 0, 'alinhamento_3', NULL, 0, '2014-12-18 20:19:52', 'left', '', 207, 233, 'texto', 'desktop'),
(4303, 1, 0, 'margin_top', 0, 0, '2014-12-18 20:19:52', NULL, '', 207, 233, 'inteiro', 'desktop'),
(4304, 1, 0, 'margin_bottom', 0, 0, '2014-12-18 20:19:52', NULL, '', 207, 233, 'inteiro', 'desktop'),
(4305, 1, 0, 'padding_top', 0, 0, '2014-12-18 20:19:52', NULL, '', 207, 233, 'inteiro', 'desktop'),
(4306, 1, 0, 'padding_bottom', 0, 0, '2014-12-18 20:19:52', NULL, '', 207, 233, 'inteiro', 'desktop'),
(4307, 1, 0, 'is_full', 0, 0, '2014-12-18 20:19:52', NULL, '', 207, 233, 'inteiro', 'desktop'),
(4308, 1, 0, 'titulo_componente', NULL, 0, '2014-12-18 20:19:52', 'banner natal', '', 207, 233, 'texto', 'desktop'),
(4309, 1, 0, 'background_type', 0, 0, '2014-12-18 20:19:52', NULL, '', 207, 233, 'inteiro', 'desktop'),
(4310, 1, 0, 'background', NULL, 0, '2014-12-18 20:19:52', '', '', 207, 233, 'texto', 'desktop'),
(4311, 163, 0, 'titulo_1', NULL, 0, '2014-12-30 17:49:47', NULL, '', 318, 234, 'texto', 'desktop'),
(4312, 163, 0, 'subtitulo_1', NULL, 0, '2014-12-30 17:49:47', NULL, '', 318, 234, 'texto', 'desktop'),
(4313, 163, 0, 'texto_1', NULL, 0, '2014-12-30 17:49:47', NULL, '', 318, 234, 'texto', 'desktop'),
(4314, 163, 0, 'link_1', NULL, 0, '2014-12-30 17:49:47', NULL, '<iframe width=\"560\" height=\"315\" src=\"//www.youtube.com/embed/pFI2lW66ooo\" frameborder=\"0\" allowfullscreen></iframe>', 318, 234, 'texto', 'desktop'),
(4315, 163, 0, 'layout_1', NULL, 0, '2014-12-30 17:49:48', 'up', '', 318, 234, 'texto', 'desktop'),
(4316, 163, 0, 'cor_1', NULL, 0, '2014-12-30 17:49:48', '', '', 318, 234, 'texto', 'desktop'),
(4317, 163, 0, 'cor_2', NULL, 0, '2014-12-30 17:49:48', '', '', 318, 234, 'texto', 'desktop'),
(4318, 163, 0, 'cor_3', NULL, 0, '2014-12-30 17:49:48', '', '', 318, 234, 'texto', 'desktop'),
(4319, 163, 0, 'alinhamento_1', NULL, 0, '2014-12-30 17:49:48', 'left', '', 318, 234, 'texto', 'desktop'),
(4320, 163, 0, 'alinhamento_2', NULL, 0, '2014-12-30 17:49:48', 'left', '', 318, 234, 'texto', 'desktop'),
(4321, 163, 0, 'alinhamento_3', NULL, 0, '2014-12-30 17:49:48', 'left', '', 318, 234, 'texto', 'desktop'),
(4322, 163, 0, 'margin_top', 0, 0, '2014-12-30 17:49:48', NULL, '', 318, 234, 'inteiro', 'desktop'),
(4323, 163, 0, 'margin_bottom', 0, 0, '2014-12-30 17:49:48', NULL, '', 318, 234, 'inteiro', 'desktop'),
(4324, 163, 0, 'padding_top', 0, 0, '2014-12-30 17:49:48', NULL, '', 318, 234, 'inteiro', 'desktop'),
(4325, 163, 0, 'padding_bottom', 0, 0, '2014-12-30 17:49:48', NULL, '', 318, 234, 'inteiro', 'desktop'),
(4326, 163, 0, 'is_full', 0, 0, '2014-12-30 17:49:48', NULL, '', 318, 234, 'inteiro', 'desktop'),
(4327, 163, 0, 'titulo_componente', NULL, 0, '2014-12-30 17:49:48', '', '', 318, 234, 'texto', 'desktop'),
(4328, 163, 0, 'background_type', 0, 0, '2014-12-30 17:49:48', NULL, '', 318, 234, 'inteiro', 'desktop'),
(4329, 163, 0, 'background', NULL, 0, '2014-12-30 17:49:48', '', '', 318, 234, 'texto', 'desktop'),
(4330, 1, 0, 'titulo_1', NULL, 0, '2014-12-30 19:35:50', NULL, '', 207, 236, 'texto', 'desktop'),
(4331, 1, 0, 'subtitulo_1', NULL, 0, '2014-12-30 19:35:50', NULL, '', 207, 236, 'texto', 'desktop'),
(4332, 1, 0, 'texto_1', NULL, 0, '2014-12-30 19:35:50', NULL, '', 207, 236, 'texto', 'desktop'),
(4333, 1, 0, 'link_1', NULL, 0, '2014-12-30 19:35:50', NULL, '', 207, 236, 'texto', 'desktop'),
(4334, 1, 0, 'image_1', NULL, 0, '2014-12-30 19:35:50', 'msg2015gd_w4.png', '', 207, 236, 'texto', 'desktop'),
(4335, 1, 0, 'layout_1', NULL, 0, '2014-12-30 19:35:50', 'up', '', 207, 236, 'texto', 'desktop'),
(4336, 1, 0, 'cor_1', NULL, 0, '2014-12-30 19:35:50', '', '', 207, 236, 'texto', 'desktop'),
(4337, 1, 0, 'cor_2', NULL, 0, '2014-12-30 19:35:50', '', '', 207, 236, 'texto', 'desktop'),
(4338, 1, 0, 'cor_3', NULL, 0, '2014-12-30 19:35:50', '', '', 207, 236, 'texto', 'desktop'),
(4339, 1, 0, 'alinhamento_1', NULL, 0, '2014-12-30 19:35:50', 'left', '', 207, 236, 'texto', 'desktop'),
(4340, 1, 0, 'alinhamento_2', NULL, 0, '2014-12-30 19:35:50', 'left', '', 207, 236, 'texto', 'desktop'),
(4341, 1, 0, 'alinhamento_3', NULL, 0, '2014-12-30 19:35:50', 'left', '', 207, 236, 'texto', 'desktop'),
(4342, 1, 0, 'margin_top', 0, 0, '2014-12-30 19:35:50', NULL, '', 207, 236, 'inteiro', 'desktop'),
(4343, 1, 0, 'margin_bottom', 0, 0, '2014-12-30 19:35:50', NULL, '', 207, 236, 'inteiro', 'desktop'),
(4344, 1, 0, 'padding_top', 0, 0, '2014-12-30 19:35:50', NULL, '', 207, 236, 'inteiro', 'desktop'),
(4345, 1, 0, 'padding_bottom', 0, 0, '2014-12-30 19:35:50', NULL, '', 207, 236, 'inteiro', 'desktop'),
(4346, 1, 0, 'is_full', 0, 0, '2014-12-30 19:35:50', NULL, '', 207, 236, 'inteiro', 'desktop'),
(4347, 1, 0, 'titulo_componente', NULL, 0, '2014-12-30 19:35:50', 'banner ano novo 2015', '', 207, 236, 'texto', 'desktop'),
(4348, 1, 0, 'background_type', 0, 0, '2014-12-30 19:35:50', NULL, '', 207, 236, 'inteiro', 'desktop'),
(4349, 1, 0, 'background', NULL, 0, '2014-12-30 19:35:50', '', '', 207, 236, 'texto', 'desktop'),
(4350, 1, 0, 'dc_subject', NULL, 0, NULL, NULL, 'Criação de Site Digital Pier', 0, 0, '0', '0'),
(4351, 137, 0, 'qtd_blocos', 1, 0, '2015-01-21 17:36:43', NULL, '', 206, 237, 'inteiro', 'desktop'),
(4352, 137, 0, 'titulo_1', NULL, 0, '2015-01-21 17:36:44', NULL, 'Plano Pier 2 - Funcionalidades Loja Virtual', 206, 237, 'texto', 'desktop'),
(4353, 137, 0, 'subtitulo_1', NULL, 0, '2015-01-21 17:36:44', NULL, 'Ferramentas do sistema Ecommerce - Loja Virtual ', 206, 237, 'texto', 'desktop');
INSERT INTO `paginas_attribute` (`id`, `id_pagina`, `user_id`, `name`, `inteiro`, `number`, `estampa`, `texto`, `descricao`, `id_componente`, `id_row`, `tipo`, `plataforma`) VALUES
(4354, 137, 0, 'texto_1', NULL, 0, '2015-01-21 17:36:44', NULL, '<B><RED>Estrutura básica para loja virtual</RED></B>\r\n\r\n-Pagina Inicial (home) com opção de colocar vitrine de produtos\r\n-Pagina da Empresa - exibimos o histórico de sua empresa, com fotos e descrição de: missão, visão, valores e certificados de qualidade.\r\n-Pagina de Depoimentos\r\n-Pagina de Noticias - pode ser usado como um Blog em seu website\r\n-Pagina de contato\r\n-Pagina de políticas de venda (pagina onde explicará todo o processo de compra no website)\r\n\r\n\r\n<B><RED>Aplicativos do website disponibilizados:</RED></B>\r\n\r\n-PierGestão ERP - Sistema integrado de gestão empresarial;\r\n-PierLayout - Alteração completa em todo layout (cores fontes, cores paginas, topo, rodapé, texturas, logos, menu);\r\n-PierMaterias - Publique matérias, dicas, notícias e novidades (opção de poder receber comentários e curtidas)\r\n-PierDepoimentos - possibilidade de clientes interagirem, os depoimentos ficaram salvos no banco de dados aguardando publicação\r\n-PierProdutos - você cria/edita/remove produtos com categorias, imagens, vídeos de demonstração, detalhes, descrição, lançamentos e vitrine. \r\n-PierEcommerce - todos os aplicativos de gerenciamento para loja virtual descrito abaixo.\r\n\r\n<B><RED>Aplicativos do sistema Ecommerce:</RED></B>\r\n\r\n-Carrinho de Compra; \r\n-Cadastro de Cliente; \r\n-Cadastro de Pedidos; \r\n-Acompanhamento de Pedido por Clientes e número de rastreamento dos correios; \r\n-Envio automático para cada cliente com alteração de status de pedido; \r\n-Formas de Pagamento Personalizadas; \r\n-Compartilhamento com Redes Sociais (Twitter, Facebook, Google Plus); \r\n-Menu configurável; \r\n-Busca de produtos por palavra-chave, categoria e departamento; \r\n-Integração com Pag Seguro, podendo ser utilizados diversos tipos de cartões de créditos, boletos... sem a necessidade de ter convênio com -Bancos e Operadoras de Cartões. Esses recursos são oferecidos a pessoas físicas e jurídicas; \r\n-Envio de e-mail alertando sobre novos pedidos; \r\n-Configuração da quantidade de itens na vitrine; \r\n-Cálculo de frete por pedido, produto ou peso (diretamente pelo sistema dos correios); \r\n-Frete especial para determinadas faixas de CEPs e/ou por valor total de pedido; \r\n-Produtos promocionais; \r\n-Produtos em Destaque; \r\n-Vitrine de produtos na tela inicial do site; \r\n-Configuração de \"qual item será exibido\" na vitrine; \r\n-Exibição do valor do produto parcelado na loja; \r\n-Possibilidade de controlar estoque; \r\n-Permite até 6 fotos por produtos, as thumbs (imagem reduzidas) são criadas automaticamente; \r\n-Destaque para produtos com desconto; \r\n-Destaque para produtos de lançamento;\r\n \r\n<B><RED>Área Administrador Completo</RED></B>\r\n\r\n-Cadastro Categoria \r\n-Cadastro Produto \r\n-Cadastramento de Forma de Pagamento Pag Seguro - Acompanhamento de Pedidos \r\n-Acompanhamento de Clientes \r\n-Possibilidade de alterar Cores, Imagens, Banner, entre outros de maneira simples \r\n-Templates de cores pré-definidos \r\n-Opção de alterar meta tags \r\n-Controle de estatística de visitas do site\r\n\r\n<B><RED>Base Plataforma Purplepier Admin3.0</RED></B>\r\n\r\n-Hospedagem em nosso provedor;\r\n-Site em Tecnologia PHP- HTML - JavaScript - Base de dados MySQL;\r\n-Padrão W3C;\r\n-Sistema de Gerenciamento de conteúdo;\r\n-Cadastro de contas de email ilimitado;\r\n-Interface gráfica simplificada, amigável;\r\n-Número de Páginas de Conteúdo Ilimitadas;\r\n-Integração com Redes Sociais (Facebook, Twitter, Google Plus);\r\n-Suporte por telefone/e-mail e Google Hangouts;\r\n-Relatório de uso do site (matérias publicadas, currículos cadastrados, pageviews, browsers, etc);\r\n-Estatísticas de número de visita por mês, dia e total;\r\n-Recebimento semanal de relatório de desempenho do site;\r\n-Relatório de acessos de páginas visitadas;\r\n-Cadastro para Google Analytics;\r\n-Cadastro de Gerenciador Google Tags Managers;\r\n-Cadastro de Meta Tags;\r\n-Cadastro Favicon;\r\n-Opção de habilitar ‘Indique para um amigo’\r\n-Cadastro de usuários (pessoa física ou jurídica);\r\n-Controle de usuários com Tags (administrador, colunista, cliente, parceiro, associado);\r\n-Criação de chamados ou tarefas para cada usuário interno - Intranet;\r\n-RSS Feeds (ideal para sites que terão artigos ou noticias publicadas regularmente);\r\n-Uso de aplicativo com o Facebook (Curtir e compartilhamento e publicação de matérias e produtos);\r\n-Integração de um mapa do Google;\r\n-Cópia de Banco de dados com todos seus textos e fotos;\r\n-Cópia de Banco de todo conteúdo do diretório mídia/user;\r\n-Proteção com senha para acesso ao ADMIN 3.0 (controle total do site).\r\n\r\n<b>Este plano contém os aplicativos e componentes básicos de uma loja on line no mercado web. Contudo, ele é compatível com todos os outros aplicativos e componentes do sistema. \r\n\r\nPara a implementação dos demais recursos, basta solicitar orçamento para a liberação junto a equipe de vendas da DigitalPier. \r\n\r\nPara ver mais detalhes de todos os aplicativos e componentes disponíveis no sistema, você pode acessar direto o link:</b>\r\n<a href=\"https://www.purplepier.com.br/paginasavancadas\" target= \"blank\"><RED>CLIQUE AQUI PARA TER ACESSO A TODAS AS NOSSAS PAGINAS AVANÇADAS</RED></a>\r\n\r\n\r\n\r\n', 206, 237, 'texto', 'desktop'),
(4355, 137, 0, 'valor_1', 0, 0, '2015-01-21 17:36:44', NULL, '', 206, 237, 'inteiro', 'desktop'),
(4356, 137, 0, 'centavo_1', NULL, 0, '2015-01-21 17:36:44', '', '', 206, 237, 'texto', 'desktop'),
(4357, 137, 0, 'unidade_1', NULL, 0, '2015-01-21 17:36:44', '', '', 206, 237, 'texto', 'desktop'),
(4358, 137, 0, 'frequencia_1', NULL, 0, '2015-01-21 17:36:44', '', '', 206, 237, 'texto', 'desktop'),
(4359, 137, 0, 'label_1', NULL, 0, '2015-01-21 17:36:44', '', '', 206, 237, 'texto', 'desktop'),
(4360, 137, 0, 'link_1', NULL, 0, '2015-01-21 17:36:44', '', '', 206, 237, 'texto', 'desktop'),
(4361, 137, 0, 'destaque_1', 0, 0, '2015-01-21 17:36:44', NULL, '', 206, 237, 'inteiro', 'desktop'),
(4362, 137, 0, 'titulo_2', NULL, 0, '2015-01-21 17:36:44', NULL, '', 206, 237, 'texto', 'desktop'),
(4363, 137, 0, 'subtitulo_2', NULL, 0, '2015-01-21 17:36:44', NULL, '', 206, 237, 'texto', 'desktop'),
(4364, 137, 0, 'texto_2', NULL, 0, '2015-01-21 17:36:44', NULL, '', 206, 237, 'texto', 'desktop'),
(4365, 137, 0, 'valor_2', 0, 0, '2015-01-21 17:36:44', NULL, '', 206, 237, 'inteiro', 'desktop'),
(4366, 137, 0, 'centavo_2', NULL, 0, '2015-01-21 17:36:44', '', '', 206, 237, 'texto', 'desktop'),
(4367, 137, 0, 'unidade_2', NULL, 0, '2015-01-21 17:36:44', '', '', 206, 237, 'texto', 'desktop'),
(4368, 137, 0, 'frequencia_2', NULL, 0, '2015-01-21 17:36:44', '', '', 206, 237, 'texto', 'desktop'),
(4369, 137, 0, 'label_2', NULL, 0, '2015-01-21 17:36:44', '', '', 206, 237, 'texto', 'desktop'),
(4370, 137, 0, 'link_2', NULL, 0, '2015-01-21 17:36:44', '', '', 206, 237, 'texto', 'desktop'),
(4371, 137, 0, 'destaque_2', 0, 0, '2015-01-21 17:36:44', NULL, '', 206, 237, 'inteiro', 'desktop'),
(4372, 137, 0, 'titulo_3', NULL, 0, '2015-01-21 17:36:44', NULL, '', 206, 237, 'texto', 'desktop'),
(4373, 137, 0, 'subtitulo_3', NULL, 0, '2015-01-21 17:36:44', NULL, '', 206, 237, 'texto', 'desktop'),
(4374, 137, 0, 'texto_3', NULL, 0, '2015-01-21 17:36:44', NULL, '', 206, 237, 'texto', 'desktop'),
(4375, 137, 0, 'valor_3', 0, 0, '2015-01-21 17:36:44', NULL, '', 206, 237, 'inteiro', 'desktop'),
(4376, 137, 0, 'centavo_3', NULL, 0, '2015-01-21 17:36:45', '', '', 206, 237, 'texto', 'desktop'),
(4377, 137, 0, 'unidade_3', NULL, 0, '2015-01-21 17:36:45', '', '', 206, 237, 'texto', 'desktop'),
(4378, 137, 0, 'frequencia_3', NULL, 0, '2015-01-21 17:36:45', '', '', 206, 237, 'texto', 'desktop'),
(4379, 137, 0, 'label_3', NULL, 0, '2015-01-21 17:36:45', '', '', 206, 237, 'texto', 'desktop'),
(4380, 137, 0, 'link_3', NULL, 0, '2015-01-21 17:36:45', '', '', 206, 237, 'texto', 'desktop'),
(4381, 137, 0, 'destaque_3', 0, 0, '2015-01-21 17:36:45', NULL, '', 206, 237, 'inteiro', 'desktop'),
(4382, 137, 0, 'titulo_4', NULL, 0, '2015-01-21 17:36:45', NULL, '', 206, 237, 'texto', 'desktop'),
(4383, 137, 0, 'subtitulo_4', NULL, 0, '2015-01-21 17:36:45', NULL, '', 206, 237, 'texto', 'desktop'),
(4384, 137, 0, 'texto_4', NULL, 0, '2015-01-21 17:36:45', NULL, '', 206, 237, 'texto', 'desktop'),
(4385, 137, 0, 'valor_4', 0, 0, '2015-01-21 17:36:45', NULL, '', 206, 237, 'inteiro', 'desktop'),
(4386, 137, 0, 'centavo_4', NULL, 0, '2015-01-21 17:36:45', '', '', 206, 237, 'texto', 'desktop'),
(4387, 137, 0, 'unidade_4', NULL, 0, '2015-01-21 17:36:45', '', '', 206, 237, 'texto', 'desktop'),
(4388, 137, 0, 'frequencia_4', NULL, 0, '2015-01-21 17:36:45', '', '', 206, 237, 'texto', 'desktop'),
(4389, 137, 0, 'label_4', NULL, 0, '2015-01-21 17:36:45', '', '', 206, 237, 'texto', 'desktop'),
(4390, 137, 0, 'link_4', NULL, 0, '2015-01-21 17:36:45', '', '', 206, 237, 'texto', 'desktop'),
(4391, 137, 0, 'destaque_4', 0, 0, '2015-01-21 17:36:46', NULL, '', 206, 237, 'inteiro', 'desktop'),
(4392, 137, 0, 'cor_1', NULL, 0, '2015-01-21 17:36:46', 'FFFFFF', '', 206, 237, 'texto', 'desktop'),
(4393, 137, 0, 'cor_2', NULL, 0, '2015-01-21 17:36:46', 'FFFFFF', '', 206, 237, 'texto', 'desktop'),
(4394, 137, 0, 'cor_3', NULL, 0, '2015-01-21 17:36:46', 'FFFFFF', '', 206, 237, 'texto', 'desktop'),
(4395, 137, 0, 'cor_block_1', NULL, 0, '2015-01-21 17:36:46', 'FFFFFF', '', 206, 237, 'texto', 'desktop'),
(4396, 137, 0, 'cor_block_2', NULL, 0, '2015-01-21 17:36:46', 'FFFFFF', '', 206, 237, 'texto', 'desktop'),
(4397, 137, 0, 'cor_block_3', NULL, 0, '2015-01-21 17:36:46', 'FFFFFF', '', 206, 237, 'texto', 'desktop'),
(4398, 137, 0, 'cor_block_4', NULL, 0, '2015-01-21 17:36:46', 'FFFFFF', '', 206, 237, 'texto', 'desktop'),
(4399, 137, 0, 'margin_top', 30, 0, '2015-01-21 17:36:46', NULL, '', 206, 237, 'inteiro', 'desktop'),
(4400, 137, 0, 'margin_bottom', 0, 0, '2015-01-21 17:36:46', NULL, '', 206, 237, 'inteiro', 'desktop'),
(4401, 137, 0, 'padding_top', 0, 0, '2015-01-21 17:36:46', NULL, '', 206, 237, 'inteiro', 'desktop'),
(4402, 137, 0, 'padding_bottom', 0, 0, '2015-01-21 17:36:46', NULL, '', 206, 237, 'inteiro', 'desktop'),
(4403, 137, 0, 'is_full', 0, 0, '2015-01-21 17:36:47', NULL, '', 206, 237, 'inteiro', 'desktop'),
(4404, 137, 0, 'titulo_componente', NULL, 0, '2015-01-21 17:36:47', 'Pier 2 - Loja Virtual ', '', 206, 237, 'texto', 'desktop'),
(4405, 137, 0, 'background_type', 0, 0, '2015-01-21 17:36:47', NULL, '', 206, 237, 'inteiro', 'desktop'),
(4406, 137, 0, 'background', NULL, 0, '2015-01-21 17:36:47', '', '', 206, 237, 'texto', 'desktop'),
(4407, 137, 0, 'margin_top', 30, 0, '2015-01-21 21:00:16', NULL, '', 206, 20, 'inteiro', 'desktop'),
(4408, 137, 0, 'margin_bottom', 0, 0, '2015-01-21 21:00:16', NULL, '', 206, 20, 'inteiro', 'desktop'),
(4409, 137, 0, 'padding_top', 0, 0, '2015-01-21 21:00:16', NULL, '', 206, 20, 'inteiro', 'desktop'),
(4410, 137, 0, 'padding_bottom', 0, 0, '2015-01-21 21:00:16', NULL, '', 206, 20, 'inteiro', 'desktop'),
(4411, 137, 0, 'is_full', 0, 0, '2015-01-21 21:00:16', NULL, '', 206, 20, 'inteiro', 'desktop'),
(4412, 137, 0, 'titulo_componente', NULL, 0, '2015-01-21 21:00:16', 'Pier 4 - Mini sites', '', 206, 20, 'texto', 'desktop'),
(4413, 137, 0, 'background_type', 0, 0, '2015-01-21 21:00:16', NULL, '', 206, 20, 'inteiro', 'desktop'),
(4414, 137, 0, 'background', NULL, 0, '2015-01-21 21:00:16', '', '', 206, 20, 'texto', 'desktop'),
(4415, 205, 0, 'dc_title', NULL, 0, NULL, 'Bem Vindo ao nosso site', '', 0, 0, '0', '0'),
(4416, 205, 0, 'dc_lastupdate', NULL, 0, NULL, '2015-01-27', '', 0, 0, '0', '0'),
(4417, 204, 0, 'dc_title', NULL, 0, NULL, 'Tire suas dúvidas e entre em contato', '', 0, 0, '0', '0'),
(4418, 204, 0, 'dc_lastupdate', NULL, 0, NULL, '2015-01-27', '', 0, 0, '0', '0'),
(4419, 202, 0, 'dc_title', NULL, 0, NULL, 'Nossa empresa', '', 0, 0, '0', '0'),
(4420, 202, 0, 'dc_lastupdate', NULL, 0, NULL, '2015-02-04', '', 0, 0, '0', '0'),
(4421, 206, 0, 'dc_date', NULL, 0, NULL, '2015-01-24', '', 0, 0, '0', '0'),
(4422, 206, 0, 'dc_title', NULL, 0, NULL, 'Serviços', '', 0, 0, '0', '0'),
(4423, 206, 0, 'dc_lastupdate', NULL, 0, NULL, '2015-02-04', '', 0, 0, '0', '0'),
(4424, 207, 0, 'dc_date', NULL, 0, NULL, '2015-01-24', '', 0, 0, '0', '0'),
(4425, 207, 0, 'dc_title', NULL, 0, NULL, 'Socorro 24h', '', 0, 0, '0', '0'),
(4426, 207, 0, 'dc_lastupdate', NULL, 0, NULL, '2015-01-26', '', 0, 0, '0', '0'),
(4427, 208, 0, 'dc_title', NULL, 0, NULL, 'Veja nossas matérias', '', 0, 0, '0', '0'),
(4428, 208, 0, 'dc_lastupdate', NULL, 0, NULL, '2015-01-26', '', 0, 0, '0', '0'),
(4429, 208, 0, 'mat_lk_rcn_qtd', 4, 0, NULL, NULL, '', 0, 0, '0', '0'),
(4430, 208, 0, 'mat_lk_rcn_afi', NULL, 0, NULL, 'afinidade', '', 0, 0, '0', '0'),
(4431, 208, 0, 'mat_lk_rcn_adv', 1, 0, NULL, NULL, '', 0, 0, '0', '0'),
(4432, 208, 0, 'mat_lk_rcn_blc', 4, 0, NULL, NULL, '', 0, 0, '0', '0'),
(4433, 94, 0, 'dc_lastupdate', NULL, 0, NULL, '2015-01-26', '', 0, 0, '0', '0'),
(4434, 201, 0, 'dc_title', NULL, 0, NULL, 'Orçamento', '', 0, 0, '0', '0'),
(4435, 201, 0, 'dc_lastupdate', NULL, 0, NULL, '2015-01-26', '', 0, 0, '0', '0'),
(4436, 206, 0, 'dc_description', NULL, 0, NULL, NULL, 'Mecânica e Injeção em Geral, Embreagem, Troca de oleo, Limpeza de bicos, Suspensão, Bomba de combustivel', 0, 0, '0', '0'),
(4437, 79, 0, 'titulo_rs_fb', NULL, 0, NULL, 'PurplePier - Plataforma de Negócios', '', 0, 0, '0', '0'),
(4438, 79, 0, 'texto_rs_fb', NULL, 0, NULL, NULL, 'Tudo que você precisa para gerir, organizar e divulgar sua empresa na web.\nUma plataforma unificada com Site, ERP, E-commerce, Responsiva e preparada para suas campanhas de marketing.', 0, 0, '0', '0'),
(4439, 211, 0, 'dc_date', NULL, 0, NULL, '2015-02-06', '', 0, 0, '0', '0'),
(4440, 211, 0, 'dc_title', NULL, 0, NULL, 'PurplePier', '', 0, 0, '0', '0'),
(4441, 211, 0, 'dc_lastupdate', NULL, 0, NULL, '2015-02-06', '', 0, 0, '0', '0'),
(4442, 211, 0, 'titulo_rs_fb', NULL, 0, NULL, 'PurplePier - Plataforma de Negócios', '', 0, 0, '0', '0'),
(4443, 211, 0, 'texto_rs_fb', NULL, 0, NULL, NULL, 'Uma plataforma que reuni tudo que você precisa para divulgar e gerir sua empresa.\nSite, ERP, Campanhas de Marketing, Promoções e responsiva, para todos os dispositivos móveis', 0, 0, '0', '0'),
(4444, 211, 0, 'slot_fb_1', NULL, 0, NULL, 'bn_tip_artigo_d0.png', '', 0, 0, '0', '0'),
(4445, 141, 0, 'dc_title', NULL, 0, NULL, 'Web Design', '', 0, 0, '0', '0'),
(4446, 141, 0, 'dc_lastupdate', NULL, 0, NULL, '2015-02-08', '', 0, 0, '0', '0'),
(4447, 1, 0, 'titulo_1', NULL, 0, '2015-02-13 17:02:30', NULL, '', 341, 239, 'texto', 'desktop'),
(4448, 1, 0, 'subtitulo_1', NULL, 0, '2015-02-13 17:02:30', NULL, '', 341, 239, 'texto', 'desktop'),
(4449, 1, 0, 'texto_1', NULL, 0, '2015-02-13 17:02:30', NULL, '', 341, 239, 'texto', 'desktop'),
(4450, 1, 0, 'cor_1', NULL, 0, '2015-02-13 17:02:30', '', '', 341, 239, 'texto', 'desktop'),
(4451, 1, 0, 'cor_2', NULL, 0, '2015-02-13 17:02:31', '', '', 341, 239, 'texto', 'desktop'),
(4452, 1, 0, 'cor_3', NULL, 0, '2015-02-13 17:02:31', '', '', 341, 239, 'texto', 'desktop'),
(4453, 1, 0, 'comecar_em', 0, 0, '2015-02-13 17:02:31', NULL, '', 341, 239, 'inteiro', 'desktop'),
(4454, 1, 0, 'qtd_items', 10, 0, '2015-02-13 17:02:31', NULL, '', 341, 239, 'inteiro', 'desktop'),
(4455, 1, 0, 'alinhamento_1', NULL, 0, '2015-02-13 17:02:31', 'left', '', 341, 239, 'texto', 'desktop'),
(4456, 1, 0, 'alinhamento_2', NULL, 0, '2015-02-13 17:02:31', 'left', '', 341, 239, 'texto', 'desktop'),
(4457, 1, 0, 'alinhamento_3', NULL, 0, '2015-02-13 17:02:31', 'left', '', 341, 239, 'texto', 'desktop'),
(4458, 1, 0, 'margin_top', 0, 0, '2015-02-13 17:02:32', NULL, '', 341, 239, 'inteiro', 'desktop'),
(4459, 1, 0, 'margin_bottom', 0, 0, '2015-02-13 17:02:32', NULL, '', 341, 239, 'inteiro', 'desktop'),
(4460, 1, 0, 'padding_top', 0, 0, '2015-02-13 17:02:32', NULL, '', 341, 239, 'inteiro', 'desktop'),
(4461, 1, 0, 'padding_bottom', 0, 0, '2015-02-13 17:02:32', NULL, '', 341, 239, 'inteiro', 'desktop'),
(4462, 1, 0, 'is_full', 0, 0, '2015-02-13 17:02:32', NULL, '', 341, 239, 'inteiro', 'desktop'),
(4463, 1, 0, 'titulo_componente', NULL, 0, '2015-02-13 17:02:32', 'Madagascar', '', 341, 239, 'texto', 'desktop'),
(4464, 1, 0, 'background_type', 0, 0, '2015-02-13 17:02:32', NULL, '', 341, 239, 'inteiro', 'desktop'),
(4465, 1, 0, 'background', NULL, 0, '2015-02-13 17:02:33', '', '', 341, 239, 'texto', 'desktop'),
(4466, 142, 0, 'titulo_componente', NULL, 0, '2015-02-13 18:09:42', '', '', 211, 88, 'texto', 'desktop'),
(4467, 137, 0, 'margin_top', 30, 0, '2015-02-16 18:51:31', NULL, '', 206, 18, 'inteiro', 'desktop'),
(4468, 137, 0, 'margin_bottom', 0, 0, '2015-02-16 18:51:31', NULL, '', 206, 18, 'inteiro', 'desktop'),
(4469, 137, 0, 'padding_top', 0, 0, '2015-02-16 18:51:31', NULL, '', 206, 18, 'inteiro', 'desktop'),
(4470, 137, 0, 'padding_bottom', 0, 0, '2015-02-16 18:51:31', NULL, '', 206, 18, 'inteiro', 'desktop'),
(4471, 137, 0, 'is_full', 0, 0, '2015-02-16 18:51:31', NULL, '', 206, 18, 'inteiro', 'desktop'),
(4472, 137, 0, 'titulo_componente', NULL, 0, '2015-02-16 18:51:31', 'Pier 1 - completo', '', 206, 18, 'texto', 'desktop'),
(4473, 137, 0, 'background_type', 0, 0, '2015-02-16 18:51:31', NULL, '', 206, 18, 'inteiro', 'desktop'),
(4474, 137, 0, 'background', NULL, 0, '2015-02-16 18:51:31', '', '', 206, 18, 'texto', 'desktop'),
(4475, 137, 0, 'titulo_1', NULL, 0, '2015-02-16 19:03:57', NULL, 'Plano Pier 1 ', 207, 240, 'texto', 'desktop'),
(4476, 137, 0, 'subtitulo_1', NULL, 0, '2015-02-16 19:03:57', NULL, 'Web Site Responsivo + ERP + Loja Virtual + Identidade Visual', 207, 240, 'texto', 'desktop'),
(4477, 137, 0, 'texto_1', NULL, 0, '2015-02-16 19:03:57', NULL, '•	Hospedagem em nosso provedor; \r\n•	Site em Tecnologia PHP- HTML - JavaScript - Base de dados MySQL;\r\n•	Padrão W3C;\r\n•	Sistema de Gerenciamento de conteúdo;\r\n•	Cadastro de contas de email ilimitado;\r\n•	Interface gráfica simplificada, amigável; \r\n•	Número de Páginas de Conteúdo Ilimitadas; \r\n•	Integração com Redes Sociais (Facebook, Twitter, Google Plus);\r\n•	Suporte por telefone/e-mail e Google Hangouts; \r\n•	Relatório de uso do site (matérias publicadas, currículos cadastrados, pageviews, browsers, etc);\r\n•	Estatísticas de número de visita por mês, dia e total;\r\n•	Recebimento semanal de relatório de desempenho do site;\r\n•	Relatório de acessos de páginas visitadas; \r\n•	Cadastro para Google Analytics;\r\n•	Cadastro de Gerenciador Google Tags Managers;\r\n•	Cadastro de Meta Tags;\r\n•       Cadastro Favicon;\r\n•	Opção de habilitar ‘Indique para um amigo’\r\n•	Cadastro de usuários (pessoa física ou jurídica);\r\n•	Controle de usuários com Tags (administrador, colunista, cliente, parceiro, associado);\r\n•	Criação de chamados ou tarefas para cada usuário interno - Intranet;\r\n•	RSS Feeds (ideal para sites que terão artigos ou noticias publicadas regularmente);\r\n•	Uso de aplicativo com o Facebook (Curtir e compartilhamento e publicação de matérias e produtos); \r\n•	Integração de um mapa do Google; \r\n•	Cópia de Banco de dados com todos seus textos e fotos; \r\n•	Cópia de Banco de todo conteúdo do diretório mídia/user; \r\n•	Proteção com senha para acesso ao ADMIN 3.0 (controle total do site).\r\n\r\nAplicativos disponíveis:\r\n\r\n•	Pier Gestão ERP - Sistema integrado de gestão empresarial;\r\n•       PierMail - Email-Marketing (disponibilizado de acordo com o plano contratado);\r\n•	Pier Layout - Alteração completa em todo layout (cores fontes, cores paginas, topo, rodapé, texturas, logos, menu);\r\n\r\nComponentes disponíveis:\r\n\r\n•       Aplicativo para criação de Banners;\r\n•	 Banner principal com troca ilimitada de imagens;\r\n• 	 Newsletter, emails cadastrados serão salvos no banco de dados, enviados para email master;\r\n•	 Personalização de Logos para email de Newsletter;\r\n•	Listagem de contatos e emails recebidos pela pagina CONTATO, salvos no banco de dados;\r\n•	Banco de Currículos; \r\n•	Divulgação de Vagas; \r\n•	Publicação de eventos (cursos, palestras, viagens e workshop) com link de INSCRIÇÃO para usuários;\r\n•	Pagina de exibição de Galeria de imagens;\r\n•	Exibição de Redes Sociais - Combo Share;\r\n•	Página de exibição de matérias, artigos, notícias;\r\n•	Cadastro de Comentários em matérias (com opção de edição e moderação para publicação);\r\n•	Cadastro de Depoimentos com fotos (com opção de edição e moderação para publicação);\r\n•	Cadastro de FAQ (Frequently Asked Questions - Perguntas mais frequentes), com interação de usuário;\r\n\r\n\r\n', 207, 240, 'texto', 'desktop'),
(4478, 137, 0, 'link_1', NULL, 0, '2015-02-16 19:03:57', NULL, '', 207, 240, 'texto', 'desktop'),
(4479, 137, 0, 'image_1', NULL, 0, '2015-02-16 19:03:57', '', '', 207, 240, 'texto', 'desktop'),
(4480, 137, 0, 'layout_1', NULL, 0, '2015-02-16 19:03:57', 'up', '', 207, 240, 'texto', 'desktop'),
(4481, 137, 0, 'cor_1', NULL, 0, '2015-02-16 19:03:57', '', '', 207, 240, 'texto', 'desktop'),
(4482, 137, 0, 'cor_2', NULL, 0, '2015-02-16 19:03:57', '', '', 207, 240, 'texto', 'desktop'),
(4483, 137, 0, 'cor_3', NULL, 0, '2015-02-16 19:03:57', '', '', 207, 240, 'texto', 'desktop'),
(4484, 137, 0, 'alinhamento_1', NULL, 0, '2015-02-16 19:03:57', 'center', '', 207, 240, 'texto', 'desktop'),
(4485, 137, 0, 'alinhamento_2', NULL, 0, '2015-02-16 19:03:57', 'center', '', 207, 240, 'texto', 'desktop'),
(4486, 137, 0, 'alinhamento_3', NULL, 0, '2015-02-16 19:03:57', 'left', '', 207, 240, 'texto', 'desktop'),
(4487, 137, 0, 'margin_top', 0, 0, '2015-02-16 19:03:57', NULL, '', 207, 240, 'inteiro', 'desktop'),
(4488, 137, 0, 'margin_bottom', 0, 0, '2015-02-16 19:03:57', NULL, '', 207, 240, 'inteiro', 'desktop'),
(4489, 137, 0, 'padding_top', 0, 0, '2015-02-16 19:03:57', NULL, '', 207, 240, 'inteiro', 'desktop'),
(4490, 137, 0, 'padding_bottom', 0, 0, '2015-02-16 19:03:57', NULL, '', 207, 240, 'inteiro', 'desktop'),
(4491, 137, 0, 'is_full', 0, 0, '2015-02-16 19:03:57', NULL, '', 207, 240, 'inteiro', 'desktop'),
(4492, 137, 0, 'titulo_componente', NULL, 0, '2015-02-16 19:03:57', '', '', 207, 240, 'texto', 'desktop'),
(4493, 137, 0, 'background_type', 0, 0, '2015-02-16 19:03:57', NULL, '', 207, 240, 'inteiro', 'desktop'),
(4494, 137, 0, 'background', NULL, 0, '2015-02-16 19:03:57', '', '', 207, 240, 'texto', 'desktop'),
(4495, 137, 0, 'qtd_blocos', 1, 0, '2015-02-16 19:08:22', NULL, '', 206, 241, 'inteiro', 'desktop'),
(4496, 137, 0, 'titulo_1', NULL, 0, '2015-02-16 19:08:22', NULL, 'tetst', 206, 241, 'texto', 'desktop'),
(4497, 137, 0, 'subtitulo_1', NULL, 0, '2015-02-16 19:08:22', NULL, '', 206, 241, 'texto', 'desktop'),
(4498, 137, 0, 'texto_1', NULL, 0, '2015-02-16 19:08:22', NULL, '- Plano completo com todas funcionalidades do sistema liberados;\r\n- Gerenciamento de Conteúdo - Pier Admin 3.0;\r\n- ERP -  Sistema integrado de gestão empresarial;\r\n- Loja Virtual;\r\n- Identidade Visual (3 Banners, Logotipo e +1000 cartões de visita);\r\n- Layout Responsivo.', 206, 241, 'texto', 'desktop'),
(4499, 137, 0, 'valor_1', 0, 0, '2015-02-16 19:08:22', NULL, '', 206, 241, 'inteiro', 'desktop'),
(4500, 137, 0, 'centavo_1', NULL, 0, '2015-02-16 19:08:22', '', '', 206, 241, 'texto', 'desktop'),
(4501, 137, 0, 'unidade_1', NULL, 0, '2015-02-16 19:08:22', '', '', 206, 241, 'texto', 'desktop'),
(4502, 137, 0, 'frequencia_1', NULL, 0, '2015-02-16 19:08:22', '', '', 206, 241, 'texto', 'desktop'),
(4503, 137, 0, 'label_1', NULL, 0, '2015-02-16 19:08:22', '', '', 206, 241, 'texto', 'desktop'),
(4504, 137, 0, 'link_1', NULL, 0, '2015-02-16 19:08:22', '', '', 206, 241, 'texto', 'desktop'),
(4505, 137, 0, 'destaque_1', 0, 0, '2015-02-16 19:08:22', NULL, '', 206, 241, 'inteiro', 'desktop'),
(4506, 137, 0, 'titulo_2', NULL, 0, '2015-02-16 19:08:22', NULL, '', 206, 241, 'texto', 'desktop'),
(4507, 137, 0, 'subtitulo_2', NULL, 0, '2015-02-16 19:08:22', NULL, '', 206, 241, 'texto', 'desktop'),
(4508, 137, 0, 'texto_2', NULL, 0, '2015-02-16 19:08:22', NULL, '', 206, 241, 'texto', 'desktop'),
(4509, 137, 0, 'valor_2', 0, 0, '2015-02-16 19:08:22', NULL, '', 206, 241, 'inteiro', 'desktop'),
(4510, 137, 0, 'centavo_2', NULL, 0, '2015-02-16 19:08:22', '', '', 206, 241, 'texto', 'desktop'),
(4511, 137, 0, 'unidade_2', NULL, 0, '2015-02-16 19:08:22', '', '', 206, 241, 'texto', 'desktop'),
(4512, 137, 0, 'frequencia_2', NULL, 0, '2015-02-16 19:08:22', '', '', 206, 241, 'texto', 'desktop'),
(4513, 137, 0, 'label_2', NULL, 0, '2015-02-16 19:08:22', '', '', 206, 241, 'texto', 'desktop'),
(4514, 137, 0, 'link_2', NULL, 0, '2015-02-16 19:08:22', '', '', 206, 241, 'texto', 'desktop'),
(4515, 137, 0, 'destaque_2', 0, 0, '2015-02-16 19:08:22', NULL, '', 206, 241, 'inteiro', 'desktop'),
(4516, 137, 0, 'titulo_3', NULL, 0, '2015-02-16 19:08:22', NULL, '', 206, 241, 'texto', 'desktop'),
(4517, 137, 0, 'subtitulo_3', NULL, 0, '2015-02-16 19:08:22', NULL, '', 206, 241, 'texto', 'desktop'),
(4518, 137, 0, 'texto_3', NULL, 0, '2015-02-16 19:08:22', NULL, '', 206, 241, 'texto', 'desktop'),
(4519, 137, 0, 'valor_3', 0, 0, '2015-02-16 19:08:22', NULL, '', 206, 241, 'inteiro', 'desktop'),
(4520, 137, 0, 'centavo_3', NULL, 0, '2015-02-16 19:08:22', '', '', 206, 241, 'texto', 'desktop'),
(4521, 137, 0, 'unidade_3', NULL, 0, '2015-02-16 19:08:22', '', '', 206, 241, 'texto', 'desktop'),
(4522, 137, 0, 'frequencia_3', NULL, 0, '2015-02-16 19:08:22', '', '', 206, 241, 'texto', 'desktop'),
(4523, 137, 0, 'label_3', NULL, 0, '2015-02-16 19:08:22', '', '', 206, 241, 'texto', 'desktop'),
(4524, 137, 0, 'link_3', NULL, 0, '2015-02-16 19:08:22', '', '', 206, 241, 'texto', 'desktop'),
(4525, 137, 0, 'destaque_3', 0, 0, '2015-02-16 19:08:22', NULL, '', 206, 241, 'inteiro', 'desktop'),
(4526, 137, 0, 'titulo_4', NULL, 0, '2015-02-16 19:08:22', NULL, '', 206, 241, 'texto', 'desktop'),
(4527, 137, 0, 'subtitulo_4', NULL, 0, '2015-02-16 19:08:22', NULL, '', 206, 241, 'texto', 'desktop'),
(4528, 137, 0, 'texto_4', NULL, 0, '2015-02-16 19:08:22', NULL, '', 206, 241, 'texto', 'desktop'),
(4529, 137, 0, 'valor_4', 0, 0, '2015-02-16 19:08:22', NULL, '', 206, 241, 'inteiro', 'desktop'),
(4530, 137, 0, 'centavo_4', NULL, 0, '2015-02-16 19:08:22', '', '', 206, 241, 'texto', 'desktop'),
(4531, 137, 0, 'unidade_4', NULL, 0, '2015-02-16 19:08:22', '', '', 206, 241, 'texto', 'desktop'),
(4532, 137, 0, 'frequencia_4', NULL, 0, '2015-02-16 19:08:22', '', '', 206, 241, 'texto', 'desktop'),
(4533, 137, 0, 'label_4', NULL, 0, '2015-02-16 19:08:22', '', '', 206, 241, 'texto', 'desktop'),
(4534, 137, 0, 'link_4', NULL, 0, '2015-02-16 19:08:22', '', '', 206, 241, 'texto', 'desktop'),
(4535, 137, 0, 'destaque_4', 0, 0, '2015-02-16 19:08:22', NULL, '', 206, 241, 'inteiro', 'desktop'),
(4536, 137, 0, 'cor_1', NULL, 0, '2015-02-16 19:08:22', '', '', 206, 241, 'texto', 'desktop'),
(4537, 137, 0, 'cor_2', NULL, 0, '2015-02-16 19:08:22', '', '', 206, 241, 'texto', 'desktop'),
(4538, 137, 0, 'cor_3', NULL, 0, '2015-02-16 19:08:22', '', '', 206, 241, 'texto', 'desktop'),
(4539, 137, 0, 'cor_block_1', NULL, 0, '2015-02-16 19:08:22', '', '', 206, 241, 'texto', 'desktop'),
(4540, 137, 0, 'cor_block_2', NULL, 0, '2015-02-16 19:08:22', '', '', 206, 241, 'texto', 'desktop'),
(4541, 137, 0, 'cor_block_3', NULL, 0, '2015-02-16 19:08:22', '', '', 206, 241, 'texto', 'desktop'),
(4542, 137, 0, 'cor_block_4', NULL, 0, '2015-02-16 19:08:22', '', '', 206, 241, 'texto', 'desktop'),
(4543, 137, 0, 'margin_top', 0, 0, '2015-02-16 19:08:22', NULL, '', 206, 241, 'inteiro', 'desktop'),
(4544, 137, 0, 'margin_bottom', 0, 0, '2015-02-16 19:08:22', NULL, '', 206, 241, 'inteiro', 'desktop'),
(4545, 137, 0, 'padding_top', 0, 0, '2015-02-16 19:08:22', NULL, '', 206, 241, 'inteiro', 'desktop'),
(4546, 137, 0, 'padding_bottom', 0, 0, '2015-02-16 19:08:22', NULL, '', 206, 241, 'inteiro', 'desktop'),
(4547, 137, 0, 'is_full', 0, 0, '2015-02-16 19:08:22', NULL, '', 206, 241, 'inteiro', 'desktop'),
(4548, 137, 0, 'titulo_componente', NULL, 0, '2015-02-16 19:08:22', '', '', 206, 241, 'texto', 'desktop'),
(4549, 137, 0, 'background_type', 0, 0, '2015-02-16 19:08:22', NULL, '', 206, 241, 'inteiro', 'desktop'),
(4550, 137, 0, 'background', NULL, 0, '2015-02-16 19:08:22', '', '', 206, 241, 'texto', 'desktop'),
(4551, 137, 0, 'dc_title', NULL, 0, NULL, 'Tabela de Preços', '', 0, 0, '0', '0'),
(4552, 137, 0, 'dc_description', NULL, 0, NULL, NULL, 'precos', 0, 0, '0', '0'),
(4553, 137, 0, 'dc_lastupdate', NULL, 0, NULL, '2015-02-16', '', 0, 0, '0', '0'),
(4554, 137, 0, 'qtd_blocos', 1, 0, '2015-02-16 21:03:36', NULL, '', 206, 242, 'inteiro', 'desktop'),
(4555, 137, 0, 'titulo_1', NULL, 0, '2015-02-16 21:03:36', NULL, 'Plano Pier 3 - Funcionalidades para Website', 206, 242, 'texto', 'desktop'),
(4556, 137, 0, 'subtitulo_1', NULL, 0, '2015-02-16 21:03:36', NULL, 'Plano com estrutura básica para website', 206, 242, 'texto', 'desktop'),
(4557, 137, 0, 'texto_1', NULL, 0, '2015-02-16 21:03:36', NULL, '<b><red>Estrutura básica disponibilizada</red></b>\r\n\r\n-Pagina Inicial (home) \r\n-Pagina da Empresa - exibimos o histórico de sua empresa, com fotos e descrição de: missão, visão, valores e certificados de qualidade.\r\n-Pagina de exibição de produtos ou serviços\r\n-Pagina de Depoimentos\r\n-Pagina de Noticias - pode ser usado como um Blog em seu website\r\n-Pagina de contato com mapa do Google Maps\r\n\r\n<b><red>Aplicativos disponibilizados:</red></b>\r\n\r\n-PierGestão ERP - Sistema integrado de gestão empresarial;\r\n-PierLayout - Alteração completa em todo layout (cores fontes, cores paginas, topo, rodapé, texturas, logos, menu);\r\n-PierMaterias - Publique matérias, dicas, notícias e novidades (opção de poder receber comentários e curtidas)\r\n-PierDepoimentos - possibilidade de clientes interagirem, os depoimentos ficaram salvos no banco de dados aguardando publicação\r\n\r\n<B><RED>Base Plataforma Purplepier Admin3.0</RED></B>\r\n\r\n-Hospedagem em nosso provedor;\r\n-Site em Tecnologia PHP- HTML - JavaScript - Base de dados MySQL;\r\n-Padrão W3C;\r\n-Sistema de Gerenciamento de conteúdo;\r\n-Cadastro de contas de email ilimitado;\r\n-Interface gráfica simplificada, amigável;\r\n-Integração com Redes Sociais (Facebook, Twitter, Google Plus);\r\n-Suporte por telefone/e-mail e Google Hangouts;\r\n-Relatório de uso do site (matérias publicadas, currículos cadastrados, pageviews, browsers, etc);\r\n-Estatísticas de número de visita por mês, dia e total;\r\n-Recebimento semanal de relatório de desempenho do site;\r\n-Relatório de acessos de páginas visitadas;\r\n-Cadastro para Google Analytics;\r\n-Cadastro de Gerenciador Google Tags Managers;\r\n-Cadastro de Meta Tags;\r\n-Cadastro Favicon;\r\n-Opção de habilitar ‘Indique para um amigo’\r\n-Cadastro de usuários (pessoa física ou jurídica);\r\n-Controle de usuários com Tags (administrador, colunista, cliente, parceiro, associado);\r\n-Criação de chamados ou tarefas para cada usuário interno - Intranet;\r\n-RSS Feeds (ideal para sites que terão artigos ou noticias publicadas regularmente);\r\n-Uso de aplicativo com o Facebook (Curtir e compartilhamento e publicação de matérias e produtos);\r\n-Integração de um mapa do Google;\r\n-Cópia de Banco de dados com todos seus textos e fotos;\r\n-Cópia de Banco de todo conteúdo do diretório mídia/user;\r\n-Proteção com senha para acesso ao ADMIN 3.0 (controle total do site).\r\n\r\n<b>Este plano contém os aplicativos e componentes básicos para exibição de website. Contudo, ele é compatível com todos os outros aplicativos e componentes do sistema. <red>Também aceita a implementação da Plataforma Responsiva.</red>\r\n\r\nPara a implementação dos demais recursos, basta solicitar orçamento para a liberação junto a equipe de vendas da DigitalPier.\r\n\r\nPara ver mais detalhes de todos os aplicativos e componentes disponíveis no sistema, você pode acessar direto o link:</b>\r\n<a href=\"https://www.purplepier.com.br/paginasavancadas\" target= \"blank\"><RED>CLIQUE AQUI PARA TER ACESSO A TODAS AS NOSSAS PAGINAS AVANÇADAS</RED></a>\r\n\r\n', 206, 242, 'texto', 'desktop'),
(4558, 137, 0, 'valor_1', 0, 0, '2015-02-16 21:03:36', NULL, '', 206, 242, 'inteiro', 'desktop'),
(4559, 137, 0, 'centavo_1', NULL, 0, '2015-02-16 21:03:37', '', '', 206, 242, 'texto', 'desktop'),
(4560, 137, 0, 'unidade_1', NULL, 0, '2015-02-16 21:03:37', '', '', 206, 242, 'texto', 'desktop'),
(4561, 137, 0, 'frequencia_1', NULL, 0, '2015-02-16 21:03:37', '', '', 206, 242, 'texto', 'desktop'),
(4562, 137, 0, 'label_1', NULL, 0, '2015-02-16 21:03:37', '', '', 206, 242, 'texto', 'desktop'),
(4563, 137, 0, 'link_1', NULL, 0, '2015-02-16 21:03:37', '', '', 206, 242, 'texto', 'desktop'),
(4564, 137, 0, 'destaque_1', 0, 0, '2015-02-16 21:03:38', NULL, '', 206, 242, 'inteiro', 'desktop'),
(4565, 137, 0, 'titulo_2', NULL, 0, '2015-02-16 21:03:38', NULL, '', 206, 242, 'texto', 'desktop'),
(4566, 137, 0, 'subtitulo_2', NULL, 0, '2015-02-16 21:03:38', NULL, '', 206, 242, 'texto', 'desktop'),
(4567, 137, 0, 'texto_2', NULL, 0, '2015-02-16 21:03:38', NULL, '', 206, 242, 'texto', 'desktop'),
(4568, 137, 0, 'valor_2', 0, 0, '2015-02-16 21:03:38', NULL, '', 206, 242, 'inteiro', 'desktop'),
(4569, 137, 0, 'centavo_2', NULL, 0, '2015-02-16 21:03:38', '', '', 206, 242, 'texto', 'desktop'),
(4570, 137, 0, 'unidade_2', NULL, 0, '2015-02-16 21:03:39', '', '', 206, 242, 'texto', 'desktop'),
(4571, 137, 0, 'frequencia_2', NULL, 0, '2015-02-16 21:03:39', '', '', 206, 242, 'texto', 'desktop'),
(4572, 137, 0, 'label_2', NULL, 0, '2015-02-16 21:03:39', '', '', 206, 242, 'texto', 'desktop'),
(4573, 137, 0, 'link_2', NULL, 0, '2015-02-16 21:03:39', '', '', 206, 242, 'texto', 'desktop'),
(4574, 137, 0, 'destaque_2', 0, 0, '2015-02-16 21:03:39', NULL, '', 206, 242, 'inteiro', 'desktop'),
(4575, 137, 0, 'titulo_3', NULL, 0, '2015-02-16 21:03:39', NULL, '', 206, 242, 'texto', 'desktop'),
(4576, 137, 0, 'subtitulo_3', NULL, 0, '2015-02-16 21:03:39', NULL, '', 206, 242, 'texto', 'desktop'),
(4577, 137, 0, 'texto_3', NULL, 0, '2015-02-16 21:03:39', NULL, '', 206, 242, 'texto', 'desktop'),
(4578, 137, 0, 'valor_3', 0, 0, '2015-02-16 21:03:40', NULL, '', 206, 242, 'inteiro', 'desktop'),
(4579, 137, 0, 'centavo_3', NULL, 0, '2015-02-16 21:03:40', '', '', 206, 242, 'texto', 'desktop'),
(4580, 137, 0, 'unidade_3', NULL, 0, '2015-02-16 21:03:40', '', '', 206, 242, 'texto', 'desktop'),
(4581, 137, 0, 'frequencia_3', NULL, 0, '2015-02-16 21:03:40', '', '', 206, 242, 'texto', 'desktop'),
(4582, 137, 0, 'label_3', NULL, 0, '2015-02-16 21:03:40', '', '', 206, 242, 'texto', 'desktop'),
(4583, 137, 0, 'link_3', NULL, 0, '2015-02-16 21:03:40', '', '', 206, 242, 'texto', 'desktop'),
(4584, 137, 0, 'destaque_3', 0, 0, '2015-02-16 21:03:40', NULL, '', 206, 242, 'inteiro', 'desktop'),
(4585, 137, 0, 'titulo_4', NULL, 0, '2015-02-16 21:03:40', NULL, '', 206, 242, 'texto', 'desktop'),
(4586, 137, 0, 'subtitulo_4', NULL, 0, '2015-02-16 21:03:40', NULL, '', 206, 242, 'texto', 'desktop'),
(4587, 137, 0, 'texto_4', NULL, 0, '2015-02-16 21:03:41', NULL, '', 206, 242, 'texto', 'desktop'),
(4588, 137, 0, 'valor_4', 0, 0, '2015-02-16 21:03:41', NULL, '', 206, 242, 'inteiro', 'desktop'),
(4589, 137, 0, 'centavo_4', NULL, 0, '2015-02-16 21:03:41', '', '', 206, 242, 'texto', 'desktop'),
(4590, 137, 0, 'unidade_4', NULL, 0, '2015-02-16 21:03:41', '', '', 206, 242, 'texto', 'desktop'),
(4591, 137, 0, 'frequencia_4', NULL, 0, '2015-02-16 21:03:41', '', '', 206, 242, 'texto', 'desktop'),
(4592, 137, 0, 'label_4', NULL, 0, '2015-02-16 21:03:41', '', '', 206, 242, 'texto', 'desktop'),
(4593, 137, 0, 'link_4', NULL, 0, '2015-02-16 21:03:41', '', '', 206, 242, 'texto', 'desktop'),
(4594, 137, 0, 'destaque_4', 0, 0, '2015-02-16 21:03:41', NULL, '', 206, 242, 'inteiro', 'desktop'),
(4595, 137, 0, 'cor_1', NULL, 0, '2015-02-16 21:03:41', '', '', 206, 242, 'texto', 'desktop'),
(4596, 137, 0, 'cor_2', NULL, 0, '2015-02-16 21:03:42', '', '', 206, 242, 'texto', 'desktop'),
(4597, 137, 0, 'cor_3', NULL, 0, '2015-02-16 21:03:42', '', '', 206, 242, 'texto', 'desktop'),
(4598, 137, 0, 'cor_block_1', NULL, 0, '2015-02-16 21:03:42', '', '', 206, 242, 'texto', 'desktop'),
(4599, 137, 0, 'cor_block_2', NULL, 0, '2015-02-16 21:03:42', '', '', 206, 242, 'texto', 'desktop'),
(4600, 137, 0, 'cor_block_3', NULL, 0, '2015-02-16 21:03:42', '', '', 206, 242, 'texto', 'desktop'),
(4601, 137, 0, 'cor_block_4', NULL, 0, '2015-02-16 21:03:42', '', '', 206, 242, 'texto', 'desktop'),
(4602, 137, 0, 'margin_top', 30, 0, '2015-02-16 21:03:42', NULL, '', 206, 242, 'inteiro', 'desktop'),
(4603, 137, 0, 'margin_bottom', 0, 0, '2015-02-16 21:03:42', NULL, '', 206, 242, 'inteiro', 'desktop'),
(4604, 137, 0, 'padding_top', 0, 0, '2015-02-16 21:03:43', NULL, '', 206, 242, 'inteiro', 'desktop'),
(4605, 137, 0, 'padding_bottom', 0, 0, '2015-02-16 21:03:43', NULL, '', 206, 242, 'inteiro', 'desktop'),
(4606, 137, 0, 'is_full', 0, 0, '2015-02-16 21:03:43', NULL, '', 206, 242, 'inteiro', 'desktop'),
(4607, 137, 0, 'titulo_componente', NULL, 0, '2015-02-16 21:03:43', 'Pier 3 - website básico', '', 206, 242, 'texto', 'desktop'),
(4608, 137, 0, 'background_type', 0, 0, '2015-02-16 21:03:43', NULL, '', 206, 242, 'inteiro', 'desktop'),
(4609, 137, 0, 'background', NULL, 0, '2015-02-16 21:03:43', '', '', 206, 242, 'texto', 'desktop'),
(4610, 1, 0, 'link_target_1', NULL, 0, '2015-02-20 19:30:27', '_self', '', 207, 22, 'texto', 'desktop'),
(4611, 212, 0, 'dc_date', NULL, 0, NULL, '2015-02-23', '', 0, 0, '0', '0'),
(4612, 212, 0, 'dc_lastupdate', NULL, 0, NULL, '2015-04-22', '', 0, 0, '0', '0'),
(4613, 212, 0, 'dc_description', NULL, 0, NULL, NULL, '', 0, 0, '0', '0'),
(4614, 212, 0, 'dc_title', NULL, 0, NULL, 'Plataforma Responsiva', '', 0, 0, '0', '0'),
(4615, 212, 0, 'titulo_1', NULL, 0, '2015-02-23 20:16:06', NULL, '', 207, 243, 'texto', 'desktop'),
(4616, 212, 0, 'subtitulo_1', NULL, 0, '2015-02-23 20:16:06', NULL, '', 207, 243, 'texto', 'desktop'),
(4617, 212, 0, 'texto_1', NULL, 0, '2015-02-23 20:16:06', NULL, '', 207, 243, 'texto', 'desktop'),
(4618, 212, 0, 'link_1', NULL, 0, '2015-02-23 20:16:06', NULL, '', 207, 243, 'texto', 'desktop'),
(4619, 212, 0, 'link_target_1', NULL, 0, '2015-02-23 20:16:06', '_self', '', 207, 243, 'texto', 'desktop'),
(4620, 212, 0, 'image_1', NULL, 0, '2015-02-23 20:16:06', 'bn_plataforma_responsiva_k7_k3.jpg', '', 207, 243, 'texto', 'desktop'),
(4621, 212, 0, 'layout_1', NULL, 0, '2015-02-23 20:16:06', 'up', '', 207, 243, 'texto', 'desktop'),
(4622, 212, 0, 'cor_1', NULL, 0, '2015-02-23 20:16:06', '', '', 207, 243, 'texto', 'desktop'),
(4623, 212, 0, 'cor_2', NULL, 0, '2015-02-23 20:16:06', '', '', 207, 243, 'texto', 'desktop'),
(4624, 212, 0, 'cor_3', NULL, 0, '2015-02-23 20:16:06', '', '', 207, 243, 'texto', 'desktop'),
(4625, 212, 0, 'alinhamento_1', NULL, 0, '2015-02-23 20:16:06', 'left', '', 207, 243, 'texto', 'desktop'),
(4626, 212, 0, 'alinhamento_2', NULL, 0, '2015-02-23 20:16:06', 'left', '', 207, 243, 'texto', 'desktop'),
(4627, 212, 0, 'alinhamento_3', NULL, 0, '2015-02-23 20:16:06', 'left', '', 207, 243, 'texto', 'desktop'),
(4628, 212, 0, 'margin_top', 50, 0, '2015-02-23 20:16:06', NULL, '', 207, 243, 'inteiro', 'desktop'),
(4629, 212, 0, 'margin_bottom', 0, 0, '2015-02-23 20:16:06', NULL, '', 207, 243, 'inteiro', 'desktop'),
(4630, 212, 0, 'padding_top', 0, 0, '2015-02-23 20:16:06', NULL, '', 207, 243, 'inteiro', 'desktop'),
(4631, 212, 0, 'padding_bottom', 0, 0, '2015-02-23 20:16:06', NULL, '', 207, 243, 'inteiro', 'desktop'),
(4632, 212, 0, 'is_full', 0, 0, '2015-02-23 20:16:06', NULL, '', 207, 243, 'inteiro', 'desktop'),
(4633, 212, 0, 'titulo_componente', NULL, 0, '2015-02-23 20:16:06', '', '', 207, 243, 'texto', 'desktop'),
(4634, 212, 0, 'background_type', 0, 0, '2015-02-23 20:16:06', NULL, '', 207, 243, 'inteiro', 'desktop'),
(4635, 212, 0, 'background', NULL, 0, '2015-02-23 20:16:06', '', '', 207, 243, 'texto', 'desktop'),
(4636, 1, 0, 'titulo_rs_fb', NULL, 0, NULL, 'Purplepier', '', 0, 0, '0', '0'),
(4637, 1, 0, 'texto_rs_fb', NULL, 0, NULL, NULL, 'Um Pier Digital especialmente para o seu negócio', 0, 0, '0', '0'),
(4638, 1, 0, 'slot_fb_1', NULL, 0, NULL, 'purplepier_redes_sociais_y4.png', '', 0, 0, '0', '0'),
(4639, 79, 0, 'dc_language', NULL, 0, NULL, 'PT', '', 0, 0, '0', '0'),
(4640, 79, 0, 'dc_publisher', NULL, 0, NULL, 'Purple Pier Lda Me', '', 0, 0, '0', '0'),
(4641, 79, 0, 'dc_email', NULL, 0, NULL, 'contato@purplepier.com.br', '', 0, 0, '0', '0'),
(4642, 79, 0, 'dc_creator', NULL, 0, NULL, 'Purplepier', '', 0, 0, '0', '0'),
(4643, 79, 0, 'dc_subject', NULL, 0, NULL, NULL, 'Criação de Website e Marketing Digital', 0, 0, '0', '0'),
(4644, 79, 0, 'dc_contributor', NULL, 0, NULL, 'Paula Beatriz', '', 0, 0, '0', '0'),
(4645, 79, 0, 'dc_relation', NULL, 0, NULL, 'criação de website, gerenciamento de conteúdo,', '', 0, 0, '0', '0'),
(4646, 79, 0, 'dc_copyright', NULL, 0, NULL, NULL, 'Direitos Autorais Purplepier', 0, 0, '0', '0'),
(4647, 79, 0, 'slot_fb_1', NULL, 0, NULL, 'purplepier_redes_sociais_y4.png', '', 0, 0, '0', '0'),
(4648, 142, 0, 'dc_title', NULL, 0, NULL, 'PierMail Marketing', '', 0, 0, '0', '0'),
(4649, 142, 0, 'dc_lastupdate', NULL, 0, NULL, '2015-02-25', '', 0, 0, '0', '0'),
(4650, 142, 0, 'titulo_rs_fb', NULL, 0, NULL, 'Purplepier', '', 0, 0, '0', '0'),
(4651, 142, 0, 'texto_rs_fb', NULL, 0, NULL, NULL, 'Tudo que você precisa para gerir, organizar e divulgar sua empresa na web.\nUma plataforma unificada com Site, ERP, E-commerce, Responsiva e preparada para suas campanhas de marketing.', 0, 0, '0', '0'),
(4652, 142, 0, 'slot_fb_1', NULL, 0, NULL, 'purplepier_redes_sociais_y4.png', '', 0, 0, '0', '0'),
(4653, 212, 0, 'titulo_1', NULL, 0, '2015-02-25 20:50:06', NULL, 'O Design Responsivo', 323, 244, 'texto', 'desktop'),
(4654, 212, 0, 'subtitulo_1', NULL, 0, '2015-02-25 20:50:06', NULL, 'não é apenas uma moda passageira, é uma resposta real à necessidade dos sites se adaptarem aos usuários de vários dispositivos, de forma eficiente e escalável.', 323, 244, 'texto', 'desktop'),
(4655, 212, 0, 'texto_1', NULL, 0, '2015-02-25 20:50:06', NULL, '', 323, 244, 'texto', 'desktop'),
(4656, 212, 0, 'link_1', NULL, 0, '2015-02-25 20:50:06', NULL, '', 323, 244, 'texto', 'desktop'),
(4657, 212, 0, 'layout_1', NULL, 0, '2015-02-25 20:50:06', 'info', '', 323, 244, 'texto', 'desktop'),
(4658, 212, 0, 'cor_1', NULL, 0, '2015-02-25 20:50:06', '', '', 323, 244, 'texto', 'desktop'),
(4659, 212, 0, 'cor_2', NULL, 0, '2015-02-25 20:50:06', '', '', 323, 244, 'texto', 'desktop'),
(4660, 212, 0, 'cor_3', NULL, 0, '2015-02-25 20:50:06', '', '', 323, 244, 'texto', 'desktop'),
(4661, 212, 0, 'alinhamento_1', NULL, 0, '2015-02-25 20:50:06', 'left', '', 323, 244, 'texto', 'desktop'),
(4662, 212, 0, 'alinhamento_2', NULL, 0, '2015-02-25 20:50:06', 'left', '', 323, 244, 'texto', 'desktop'),
(4663, 212, 0, 'alinhamento_3', NULL, 0, '2015-02-25 20:50:06', 'left', '', 323, 244, 'texto', 'desktop'),
(4664, 212, 0, 'margin_top', 0, 0, '2015-02-25 20:50:06', NULL, '', 323, 244, 'inteiro', 'desktop'),
(4665, 212, 0, 'margin_bottom', 0, 0, '2015-02-25 20:50:06', NULL, '', 323, 244, 'inteiro', 'desktop'),
(4666, 212, 0, 'padding_top', 0, 0, '2015-02-25 20:50:06', NULL, '', 323, 244, 'inteiro', 'desktop'),
(4667, 212, 0, 'padding_bottom', 0, 0, '2015-02-25 20:50:06', NULL, '', 323, 244, 'inteiro', 'desktop'),
(4668, 212, 0, 'is_full', 0, 0, '2015-02-25 20:50:06', NULL, '', 323, 244, 'inteiro', 'desktop'),
(4669, 212, 0, 'titulo_componente', NULL, 0, '2015-02-25 20:50:06', '', '', 323, 244, 'texto', 'desktop'),
(4670, 212, 0, 'background_type', 0, 0, '2015-02-25 20:50:06', NULL, '', 323, 244, 'inteiro', 'desktop'),
(4671, 212, 0, 'background', NULL, 0, '2015-02-25 20:50:06', '', '', 323, 244, 'texto', 'desktop'),
(4672, 212, 0, 'qtd_blocos', 0, 0, '2015-02-25 21:00:14', NULL, '', 212, 245, 'inteiro', 'desktop'),
(4673, 212, 0, 'titulo_1', NULL, 0, '2015-02-25 21:00:14', NULL, 'O Google ama sites Responsivos – isso significa menos trabalho para o Googlebot. Sendo assim, o Google recomenda que você utilize o design responsivo.', 212, 245, 'texto', 'desktop'),
(4674, 212, 0, 'subtitulo_1', NULL, 0, '2015-02-25 21:00:14', NULL, '', 212, 245, 'texto', 'desktop'),
(4675, 212, 0, 'texto_1', NULL, 0, '2015-02-25 21:00:14', NULL, '', 212, 245, 'texto', 'desktop'),
(4676, 212, 0, 'titulo_2', NULL, 0, '2015-02-25 21:00:14', NULL, 'O tráfego móvel global é responsável por 15% de todo o tráfico web. Está estimado que o uso da internet móvel vai ultrapassar o uso da internet desktop em 2015.', 212, 245, 'texto', 'desktop'),
(4677, 212, 0, 'subtitulo_2', NULL, 0, '2015-02-25 21:00:14', NULL, '', 212, 245, 'texto', 'desktop'),
(4678, 212, 0, 'texto_2', NULL, 0, '2015-02-25 21:00:14', NULL, '', 212, 245, 'texto', 'desktop'),
(4679, 212, 0, 'titulo_3', NULL, 0, '2015-02-25 21:00:14', NULL, 'tualmente 25% dos resultados de buscas e quase 50% das aberturas de e-mail acontecem em dispositivos móveis.', 212, 245, 'texto', 'desktop'),
(4680, 212, 0, 'subtitulo_3', NULL, 0, '2015-02-25 21:00:14', NULL, '', 212, 245, 'texto', 'desktop'),
(4681, 212, 0, 'texto_3', NULL, 0, '2015-02-25 21:00:14', NULL, '', 212, 245, 'texto', 'desktop'),
(4682, 212, 0, 'titulo_4', NULL, 0, '2015-02-25 21:00:14', NULL, 'O futuro é agora! Este ano haverá mais dispositivos móveis do que pessoas na Terra. Tudo está se tornando Smart: relógios, carros, casas, microondas, máquinas de lavar louça. Esta é a Era de dispositivos móveis.', 212, 245, 'texto', 'desktop'),
(4683, 212, 0, 'subtitulo_4', NULL, 0, '2015-02-25 21:00:14', NULL, '', 212, 245, 'texto', 'desktop'),
(4684, 212, 0, 'texto_4', NULL, 0, '2015-02-25 21:00:14', NULL, '', 212, 245, 'texto', 'desktop'),
(4685, 212, 0, 'image_type_1', 1, 0, '2015-02-25 21:00:14', NULL, '', 212, 245, 'inteiro', 'desktop'),
(4686, 212, 0, 'image_1', NULL, 0, '2015-02-25 21:00:14', '', '', 212, 245, 'texto', 'desktop'),
(4687, 212, 0, 'image_type_2', 1, 0, '2015-02-25 21:00:14', NULL, '', 212, 245, 'inteiro', 'desktop'),
(4688, 212, 0, 'image_2', NULL, 0, '2015-02-25 21:00:14', '', '', 212, 245, 'texto', 'desktop'),
(4689, 212, 0, 'image_type_3', 1, 0, '2015-02-25 21:00:14', NULL, '', 212, 245, 'inteiro', 'desktop'),
(4690, 212, 0, 'image_3', NULL, 0, '2015-02-25 21:00:14', '', '', 212, 245, 'texto', 'desktop'),
(4691, 212, 0, 'image_type_4', 1, 0, '2015-02-25 21:00:14', NULL, '', 212, 245, 'inteiro', 'desktop'),
(4692, 212, 0, 'image_4', NULL, 0, '2015-02-25 21:00:14', '', '', 212, 245, 'texto', 'desktop'),
(4693, 212, 0, 'item1_cor_1', NULL, 0, '2015-02-25 21:00:14', '', '', 212, 245, 'texto', 'desktop'),
(4694, 212, 0, 'item1_alinhamento_1', NULL, 0, '2015-02-25 21:00:14', 'left', '', 212, 245, 'texto', 'desktop'),
(4695, 212, 0, 'item1_cor_2', NULL, 0, '2015-02-25 21:00:14', '', '', 212, 245, 'texto', 'desktop'),
(4696, 212, 0, 'item1_alinhamento_2', NULL, 0, '2015-02-25 21:00:14', 'left', '', 212, 245, 'texto', 'desktop'),
(4697, 212, 0, 'item1_cor_3', NULL, 0, '2015-02-25 21:00:14', '', '', 212, 245, 'texto', 'desktop'),
(4698, 212, 0, 'item1_alinhamento_3', NULL, 0, '2015-02-25 21:00:14', 'left', '', 212, 245, 'texto', 'desktop'),
(4699, 212, 0, 'item2_cor_1', NULL, 0, '2015-02-25 21:00:14', '', '', 212, 245, 'texto', 'desktop'),
(4700, 212, 0, 'item2_alinhamento_1', NULL, 0, '2015-02-25 21:00:14', 'left', '', 212, 245, 'texto', 'desktop'),
(4701, 212, 0, 'item2_cor_2', NULL, 0, '2015-02-25 21:00:14', '', '', 212, 245, 'texto', 'desktop'),
(4702, 212, 0, 'item2_alinhamento_2', NULL, 0, '2015-02-25 21:00:14', 'left', '', 212, 245, 'texto', 'desktop'),
(4703, 212, 0, 'item2_cor_3', NULL, 0, '2015-02-25 21:00:14', '', '', 212, 245, 'texto', 'desktop'),
(4704, 212, 0, 'item2_alinhamento_3', NULL, 0, '2015-02-25 21:00:14', 'left', '', 212, 245, 'texto', 'desktop'),
(4705, 212, 0, 'item3_cor_1', NULL, 0, '2015-02-25 21:00:14', '', '', 212, 245, 'texto', 'desktop'),
(4706, 212, 0, 'item3_alinhamento_1', NULL, 0, '2015-02-25 21:00:14', 'left', '', 212, 245, 'texto', 'desktop'),
(4707, 212, 0, 'item3_cor_2', NULL, 0, '2015-02-25 21:00:14', '', '', 212, 245, 'texto', 'desktop'),
(4708, 212, 0, 'item3_alinhamento_2', NULL, 0, '2015-02-25 21:00:14', 'left', '', 212, 245, 'texto', 'desktop'),
(4709, 212, 0, 'item3_cor_3', NULL, 0, '2015-02-25 21:00:14', '', '', 212, 245, 'texto', 'desktop'),
(4710, 212, 0, 'item3_alinhamento_3', NULL, 0, '2015-02-25 21:00:14', 'left', '', 212, 245, 'texto', 'desktop'),
(4711, 212, 0, 'item4_cor_1', NULL, 0, '2015-02-25 21:00:14', '', '', 212, 245, 'texto', 'desktop'),
(4712, 212, 0, 'item4_alinhamento_1', NULL, 0, '2015-02-25 21:00:14', 'left', '', 212, 245, 'texto', 'desktop'),
(4713, 212, 0, 'item4_cor_2', NULL, 0, '2015-02-25 21:00:15', '', '', 212, 245, 'texto', 'desktop'),
(4714, 212, 0, 'item4_alinhamento_2', NULL, 0, '2015-02-25 21:00:15', 'left', '', 212, 245, 'texto', 'desktop'),
(4715, 212, 0, 'item4_cor_3', NULL, 0, '2015-02-25 21:00:15', '', '', 212, 245, 'texto', 'desktop'),
(4716, 212, 0, 'item4_alinhamento_3', NULL, 0, '2015-02-25 21:00:15', 'left', '', 212, 245, 'texto', 'desktop'),
(4717, 212, 0, 'botao_exibe', 0, 0, '2015-02-25 21:00:15', NULL, '', 212, 245, 'inteiro', 'desktop'),
(4718, 212, 0, 'margin_top', 0, 0, '2015-02-25 21:00:15', NULL, '', 212, 245, 'inteiro', 'desktop'),
(4719, 212, 0, 'margin_bottom', 0, 0, '2015-02-25 21:00:15', NULL, '', 212, 245, 'inteiro', 'desktop'),
(4720, 212, 0, 'is_full', 0, 0, '2015-02-25 21:00:15', NULL, '', 212, 245, 'inteiro', 'desktop'),
(4721, 212, 0, 'background_type', 0, 0, '2015-02-25 21:00:15', NULL, '', 212, 245, 'inteiro', 'desktop'),
(4722, 212, 0, 'background', NULL, 0, '2015-02-25 21:00:15', '', '', 212, 245, 'texto', 'desktop'),
(4723, 1, 0, 'link_target_1', NULL, 0, '2015-02-25 21:02:10', '_self', '', 207, 130, 'texto', 'desktop'),
(4724, 212, 0, 'titulo_rs_fb', NULL, 0, NULL, 'Plataforma Responsiva ', '', 0, 0, '0', '0'),
(4725, 212, 0, 'texto_rs_fb', NULL, 0, NULL, NULL, 'Razões para fazer o site da sua empresa responsivo:1 - O Google ama sites Responsivos – isso significa menos trabalho para o Googlebot. Sendo assim, o Google recomenda que você utilize o design responsivo.\n2 - O tráfego móvel global é responsável por 15% de todo o tráfico web. Está estimado que o uso da internet móvel vai ultrapassar o uso da internet desktop em 2015.\n3 - Atualmente 25% dos resultados de buscas e quase 50% das aberturas de e-mail acontecem em dispositivos móveis.\n4 - O futuro é agora! Este ano haverá mais dispositivos móveis do que pessoas na Terra. Tudo está se tornando Smart: relógios, carros, casas, microondas, máquinas de lavar louça. \nEsta é a Era de dispositivos móveis.', 0, 0, '0', '0');
INSERT INTO `paginas_attribute` (`id`, `id_pagina`, `user_id`, `name`, `inteiro`, `number`, `estampa`, `texto`, `descricao`, `id_componente`, `id_row`, `tipo`, `plataforma`) VALUES
(4726, 212, 0, 'slot_fb_1', NULL, 0, NULL, 'bn_plataforma_responsiva_k7_k3.jpg', '', 0, 0, '0', '0'),
(4727, 1, 0, 'titulo_1', NULL, 0, '2015-02-25 23:39:32', NULL, '', 207, 246, 'texto', 'desktop'),
(4728, 1, 0, 'subtitulo_1', NULL, 0, '2015-02-25 23:39:32', NULL, '', 207, 246, 'texto', 'desktop'),
(4729, 1, 0, 'texto_1', NULL, 0, '2015-02-25 23:39:32', NULL, '', 207, 246, 'texto', 'desktop'),
(4730, 1, 0, 'link_1', NULL, 0, '2015-02-25 23:39:32', NULL, '', 207, 246, 'texto', 'desktop'),
(4731, 1, 0, 'link_target_1', NULL, 0, '2015-02-25 23:39:33', '_self', '', 207, 246, 'texto', 'desktop'),
(4732, 1, 0, 'image_1', NULL, 0, '2015-02-25 23:39:33', 'pier_sms_f9.jpg', '', 207, 246, 'texto', 'desktop'),
(4733, 1, 0, 'layout_1', NULL, 0, '2015-02-25 23:39:33', 'up', '', 207, 246, 'texto', 'desktop'),
(4734, 1, 0, 'cor_1', NULL, 0, '2015-02-25 23:39:33', '', '', 207, 246, 'texto', 'desktop'),
(4735, 1, 0, 'cor_2', NULL, 0, '2015-02-25 23:39:33', '', '', 207, 246, 'texto', 'desktop'),
(4736, 1, 0, 'cor_3', NULL, 0, '2015-02-25 23:39:33', '', '', 207, 246, 'texto', 'desktop'),
(4737, 1, 0, 'alinhamento_1', NULL, 0, '2015-02-25 23:39:33', 'left', '', 207, 246, 'texto', 'desktop'),
(4738, 1, 0, 'alinhamento_2', NULL, 0, '2015-02-25 23:39:33', 'left', '', 207, 246, 'texto', 'desktop'),
(4739, 1, 0, 'alinhamento_3', NULL, 0, '2015-02-25 23:39:33', 'left', '', 207, 246, 'texto', 'desktop'),
(4740, 1, 0, 'margin_top', 0, 0, '2015-02-25 23:39:34', NULL, '', 207, 246, 'inteiro', 'desktop'),
(4741, 1, 0, 'margin_bottom', 0, 0, '2015-02-25 23:39:34', NULL, '', 207, 246, 'inteiro', 'desktop'),
(4742, 1, 0, 'padding_top', 0, 0, '2015-02-25 23:39:34', NULL, '', 207, 246, 'inteiro', 'desktop'),
(4743, 1, 0, 'padding_bottom', 0, 0, '2015-02-25 23:39:34', NULL, '', 207, 246, 'inteiro', 'desktop'),
(4744, 1, 0, 'is_full', 0, 0, '2015-02-25 23:39:34', NULL, '', 207, 246, 'inteiro', 'desktop'),
(4745, 1, 0, 'titulo_componente', NULL, 0, '2015-02-25 23:39:34', '', '', 207, 246, 'texto', 'desktop'),
(4746, 1, 0, 'background_type', 0, 0, '2015-02-25 23:39:34', NULL, '', 207, 246, 'inteiro', 'desktop'),
(4747, 1, 0, 'background', NULL, 0, '2015-02-25 23:39:34', '', '', 207, 246, 'texto', 'desktop'),
(4748, 136, 0, 'dc_title', NULL, 0, NULL, 'Fotografia', '', 0, 0, '0', '0'),
(4749, 136, 0, 'dc_description', NULL, 0, NULL, NULL, 'fotografia, fotos para ecommerce', 0, 0, '0', '0'),
(4750, 136, 0, 'dc_lastupdate', NULL, 0, NULL, '2015-02-25', '', 0, 0, '0', '0'),
(4751, 136, 0, 'link_target_1', NULL, 0, '2015-02-26 00:04:16', '_self', '', 207, 124, 'texto', 'desktop'),
(4752, 59, 0, 'dc_description', NULL, 0, NULL, NULL, 'Cursos, workshop', 0, 0, '0', '0'),
(4753, 59, 0, 'dc_lastupdate', NULL, 0, NULL, '2015-04-25', '', 0, 0, '0', '0'),
(4754, 50, 0, 'dc_title', NULL, 0, NULL, 'Notícias', '', 0, 0, '0', '0'),
(4755, 1, 0, 'titulo_1', NULL, 0, '2015-03-16 18:20:27', NULL, 'PierPlayground', 207, 247, 'texto', 'desktop'),
(4756, 1, 0, 'subtitulo_1', NULL, 0, '2015-03-16 18:20:27', NULL, '', 207, 247, 'texto', 'desktop'),
(4757, 1, 0, 'texto_1', NULL, 0, '2015-03-16 18:20:27', NULL, 'Crie e edite, imagens, banners e tudo mais. Utilize dos recursos de filtros ou adesivos para incrementar suas artes!', 207, 247, 'texto', 'desktop'),
(4758, 1, 0, 'link_1', NULL, 0, '2015-03-16 18:20:27', NULL, 'https://www.purplepier.com.br/playground', 207, 247, 'texto', 'desktop'),
(4759, 1, 0, 'link_target_1', NULL, 0, '2015-03-16 18:20:27', '_blank', '', 207, 247, 'texto', 'desktop'),
(4760, 1, 0, 'image_1', NULL, 0, '2015-03-16 18:20:27', 'banner_playground_o0.png', '', 207, 247, 'texto', 'desktop'),
(4761, 1, 0, 'layout_1', NULL, 0, '2015-03-16 18:20:27', 'down', '', 207, 247, 'texto', 'desktop'),
(4762, 1, 0, 'cor_1', NULL, 0, '2015-03-16 18:20:27', '', '', 207, 247, 'texto', 'desktop'),
(4763, 1, 0, 'cor_2', NULL, 0, '2015-03-16 18:20:27', '', '', 207, 247, 'texto', 'desktop'),
(4764, 1, 0, 'cor_3', NULL, 0, '2015-03-16 18:20:27', '', '', 207, 247, 'texto', 'desktop'),
(4765, 1, 0, 'alinhamento_1', NULL, 0, '2015-03-16 18:20:27', 'center', '', 207, 247, 'texto', 'desktop'),
(4766, 1, 0, 'alinhamento_2', NULL, 0, '2015-03-16 18:20:27', 'left', '', 207, 247, 'texto', 'desktop'),
(4767, 1, 0, 'alinhamento_3', NULL, 0, '2015-03-16 18:20:27', 'center', '', 207, 247, 'texto', 'desktop'),
(4768, 1, 0, 'margin_top', 20, 0, '2015-03-16 18:20:27', NULL, '', 207, 247, 'inteiro', 'desktop'),
(4769, 1, 0, 'margin_bottom', 10, 0, '2015-03-16 18:20:27', NULL, '', 207, 247, 'inteiro', 'desktop'),
(4770, 1, 0, 'padding_top', 0, 0, '2015-03-16 18:20:27', NULL, '', 207, 247, 'inteiro', 'desktop'),
(4771, 1, 0, 'padding_bottom', 0, 0, '2015-03-16 18:20:27', NULL, '', 207, 247, 'inteiro', 'desktop'),
(4772, 1, 0, 'is_full', 0, 0, '2015-03-16 18:20:27', NULL, '', 207, 247, 'inteiro', 'desktop'),
(4773, 1, 0, 'titulo_componente', NULL, 0, '2015-03-16 18:20:27', 'Playground', '', 207, 247, 'texto', 'desktop'),
(4774, 1, 0, 'background_type', 0, 0, '2015-03-16 18:20:27', NULL, '', 207, 247, 'inteiro', 'desktop'),
(4775, 1, 0, 'background', NULL, 0, '2015-03-16 18:20:27', '', '', 207, 247, 'texto', 'desktop'),
(4776, 123, 0, 'dc_description', NULL, 0, NULL, NULL, 'PierPlaygournd', 0, 0, '0', '0'),
(4777, 123, 0, 'dc_lastupdate', NULL, 0, NULL, '2015-03-17', '', 0, 0, '0', '0'),
(4778, 123, 0, 'gel_fr_initial', NULL, 0, NULL, NULL, 'PerPlayground', 0, 0, '0', '0'),
(4779, 123, 0, 'titulo_rs_fb', NULL, 0, NULL, 'PierPlayground', '', 0, 0, '0', '0'),
(4780, 123, 0, 'texto_rs_fb', NULL, 0, NULL, NULL, 'Crie e edite suas imagens com: Filtros, adesivos, sobreposições, molduras e tudo mais\nEnvie para seus amigos, compartilhe e utilize em seus sites', 0, 0, '0', '0'),
(4781, 123, 0, 'slot_fb_1', NULL, 0, NULL, 'purplepier_redes_sociais_y4.png', '', 0, 0, '0', '0'),
(4782, 220, 0, 'dc_title', NULL, 0, NULL, 'HostMais', '', 0, 0, '0', '0'),
(4783, 220, 0, 'dc_lastupdate', NULL, 0, NULL, '2015-03-23', '', 0, 0, '0', '0'),
(4784, 219, 0, 'dc_title', NULL, 0, NULL, 'Tire suas dúvidas e entre em contato', '', 0, 0, '0', '0'),
(4785, 219, 0, 'dc_lastupdate', NULL, 0, NULL, '2015-03-23', '', 0, 0, '0', '0'),
(4786, 217, 0, 'dc_title', NULL, 0, NULL, 'Nossa missão e visão', '', 0, 0, '0', '0'),
(4787, 217, 0, 'dc_lastupdate', NULL, 0, NULL, '2015-03-23', '', 0, 0, '0', '0'),
(4788, 221, 0, 'dc_date', NULL, 0, NULL, '2015-03-23', '', 0, 0, '0', '0'),
(4789, 221, 0, 'dc_title', NULL, 0, NULL, 'Nossa estrutura', '', 0, 0, '0', '0'),
(4790, 221, 0, 'dc_lastupdate', NULL, 0, NULL, '2015-03-23', '', 0, 0, '0', '0'),
(4791, 222, 0, 'dc_date', NULL, 0, NULL, '2015-03-23', '', 0, 0, '0', '0'),
(4792, 222, 0, 'dc_title', NULL, 0, NULL, 'A EMpresa', '', 0, 0, '0', '0'),
(4793, 222, 0, 'dc_lastupdate', NULL, 0, NULL, '2015-04-01', '', 0, 0, '0', '0'),
(4794, 223, 0, 'dc_date', NULL, 0, NULL, '2015-03-23', '', 0, 0, '0', '0'),
(4795, 223, 0, 'dc_title', NULL, 0, NULL, 'Nossa História', '', 0, 0, '0', '0'),
(4796, 223, 0, 'dc_lastupdate', NULL, 0, NULL, '2015-03-23', '', 0, 0, '0', '0'),
(4797, 220, 0, 'qtd_blocos', 3, 0, '2015-03-23 21:37:56', NULL, '', 206, 249, 'inteiro', 'desktop'),
(4798, 220, 0, 'titulo_1', NULL, 0, '2015-03-23 21:37:56', NULL, 'Mensal', 206, 249, 'texto', 'desktop'),
(4799, 220, 0, 'subtitulo_1', NULL, 0, '2015-03-23 21:37:56', NULL, 'Valor mensal', 206, 249, 'texto', 'desktop'),
(4800, 220, 0, 'texto_1', NULL, 0, '2015-03-23 21:37:56', NULL, 'Espaço em disco - 5 Gb\r\nTransferência - 25Gb\r\nE-mails - ilimitados', 206, 249, 'texto', 'desktop'),
(4801, 220, 0, 'valor_1', 27, 0, '2015-03-23 21:37:56', NULL, '', 206, 249, 'inteiro', 'desktop'),
(4802, 220, 0, 'centavo_1', NULL, 0, '2015-03-23 21:37:56', ',90', '', 206, 249, 'texto', 'desktop'),
(4803, 220, 0, 'unidade_1', NULL, 0, '2015-03-23 21:37:56', 'R$', '', 206, 249, 'texto', 'desktop'),
(4804, 220, 0, 'frequencia_1', NULL, 0, '2015-03-23 21:37:56', '/mês', '', 206, 249, 'texto', 'desktop'),
(4805, 220, 0, 'label_1', NULL, 0, '2015-03-23 21:37:56', 'ver mais', '', 206, 249, 'texto', 'desktop'),
(4806, 220, 0, 'link_1', NULL, 0, '2015-03-23 21:37:56', '/hospedagem_de_sites', '', 206, 249, 'texto', 'desktop'),
(4807, 220, 0, 'destaque_1', 0, 0, '2015-03-23 21:37:56', NULL, '', 206, 249, 'inteiro', 'desktop'),
(4808, 220, 0, 'titulo_2', NULL, 0, '2015-03-23 21:37:56', NULL, 'Trimestral', 206, 249, 'texto', 'desktop'),
(4809, 220, 0, 'subtitulo_2', NULL, 0, '2015-03-23 21:37:56', NULL, 'Com 10% de desconto. Valor trimestral de R$ 72,90', 206, 249, 'texto', 'desktop'),
(4810, 220, 0, 'texto_2', NULL, 0, '2015-03-23 21:37:56', NULL, 'Espaço em disco - 5Gb\r\nTransferencia - 25Gb\r\nE-mails - ilimitados', 206, 249, 'texto', 'desktop'),
(4811, 220, 0, 'valor_2', 24, 0, '2015-03-23 21:37:56', NULL, '', 206, 249, 'inteiro', 'desktop'),
(4812, 220, 0, 'centavo_2', NULL, 0, '2015-03-23 21:37:56', ',90', '', 206, 249, 'texto', 'desktop'),
(4813, 220, 0, 'unidade_2', NULL, 0, '2015-03-23 21:37:56', 'R$', '', 206, 249, 'texto', 'desktop'),
(4814, 220, 0, 'frequencia_2', NULL, 0, '2015-03-23 21:37:56', '/mes', '', 206, 249, 'texto', 'desktop'),
(4815, 220, 0, 'label_2', NULL, 0, '2015-03-23 21:37:56', 'ver mais', '', 206, 249, 'texto', 'desktop'),
(4816, 220, 0, 'link_2', NULL, 0, '2015-03-23 21:37:56', '/hospedagem_de_sites', '', 206, 249, 'texto', 'desktop'),
(4817, 220, 0, 'destaque_2', 1, 0, '2015-03-23 21:37:56', NULL, '', 206, 249, 'inteiro', 'desktop'),
(4818, 220, 0, 'titulo_3', NULL, 0, '2015-03-23 21:37:56', NULL, 'Anual', 206, 249, 'texto', 'desktop'),
(4819, 220, 0, 'subtitulo_3', NULL, 0, '2015-03-23 21:37:56', NULL, 'Com 20% de desconto. Valor anual de R$ 259,20', 206, 249, 'texto', 'desktop'),
(4820, 220, 0, 'texto_3', NULL, 0, '2015-03-23 21:37:56', NULL, 'Espaço em disco - 5GB\r\nTransferência - 25GB\r\nE-mails - ilimitados', 206, 249, 'texto', 'desktop'),
(4821, 220, 0, 'valor_3', 21, 0, '2015-03-23 21:37:56', NULL, '', 206, 249, 'inteiro', 'desktop'),
(4822, 220, 0, 'centavo_3', NULL, 0, '2015-03-23 21:37:56', ',90', '', 206, 249, 'texto', 'desktop'),
(4823, 220, 0, 'unidade_3', NULL, 0, '2015-03-23 21:37:56', 'R$', '', 206, 249, 'texto', 'desktop'),
(4824, 220, 0, 'frequencia_3', NULL, 0, '2015-03-23 21:37:56', '/mês', '', 206, 249, 'texto', 'desktop'),
(4825, 220, 0, 'label_3', NULL, 0, '2015-03-23 21:37:56', 'ver mais', '', 206, 249, 'texto', 'desktop'),
(4826, 220, 0, 'link_3', NULL, 0, '2015-03-23 21:37:56', '/hospedagem_de_sites', '', 206, 249, 'texto', 'desktop'),
(4827, 220, 0, 'destaque_3', 0, 0, '2015-03-23 21:37:56', NULL, '', 206, 249, 'inteiro', 'desktop'),
(4828, 220, 0, 'titulo_4', NULL, 0, '2015-03-23 21:37:56', NULL, '', 206, 249, 'texto', 'desktop'),
(4829, 220, 0, 'subtitulo_4', NULL, 0, '2015-03-23 21:37:56', NULL, '', 206, 249, 'texto', 'desktop'),
(4830, 220, 0, 'texto_4', NULL, 0, '2015-03-23 21:37:56', NULL, '', 206, 249, 'texto', 'desktop'),
(4831, 220, 0, 'valor_4', 0, 0, '2015-03-23 21:37:56', NULL, '', 206, 249, 'inteiro', 'desktop'),
(4832, 220, 0, 'centavo_4', NULL, 0, '2015-03-23 21:37:56', '', '', 206, 249, 'texto', 'desktop'),
(4833, 220, 0, 'unidade_4', NULL, 0, '2015-03-23 21:37:56', '', '', 206, 249, 'texto', 'desktop'),
(4834, 220, 0, 'frequencia_4', NULL, 0, '2015-03-23 21:37:56', '', '', 206, 249, 'texto', 'desktop'),
(4835, 220, 0, 'label_4', NULL, 0, '2015-03-23 21:37:56', '', '', 206, 249, 'texto', 'desktop'),
(4836, 220, 0, 'link_4', NULL, 0, '2015-03-23 21:37:56', '', '', 206, 249, 'texto', 'desktop'),
(4837, 220, 0, 'destaque_4', 0, 0, '2015-03-23 21:37:56', NULL, '', 206, 249, 'inteiro', 'desktop'),
(4838, 220, 0, 'cor_1', NULL, 0, '2015-03-23 21:37:56', 'FFFFFF', '', 206, 249, 'texto', 'desktop'),
(4839, 220, 0, 'cor_2', NULL, 0, '2015-03-23 21:37:56', 'FFFFFF', '', 206, 249, 'texto', 'desktop'),
(4840, 220, 0, 'cor_3', NULL, 0, '2015-03-23 21:37:56', 'FFFFFF', '', 206, 249, 'texto', 'desktop'),
(4841, 220, 0, 'cor_block_1', NULL, 0, '2015-03-23 21:37:56', '1B5793', '', 206, 249, 'texto', 'desktop'),
(4842, 220, 0, 'cor_block_2', NULL, 0, '2015-03-23 21:37:56', '16406A', '', 206, 249, 'texto', 'desktop'),
(4843, 220, 0, 'cor_block_3', NULL, 0, '2015-03-23 21:37:56', '1B5793', '', 206, 249, 'texto', 'desktop'),
(4844, 220, 0, 'cor_block_4', NULL, 0, '2015-03-23 21:37:56', 'FFFFFF', '', 206, 249, 'texto', 'desktop'),
(4845, 220, 0, 'margin_top', 30, 0, '2015-03-23 21:37:56', NULL, '', 206, 249, 'inteiro', 'desktop'),
(4846, 220, 0, 'margin_bottom', 40, 0, '2015-03-23 21:37:56', NULL, '', 206, 249, 'inteiro', 'desktop'),
(4847, 220, 0, 'padding_top', 0, 0, '2015-03-23 21:37:56', NULL, '', 206, 249, 'inteiro', 'desktop'),
(4848, 220, 0, 'padding_bottom', 0, 0, '2015-03-23 21:37:56', NULL, '', 206, 249, 'inteiro', 'desktop'),
(4849, 220, 0, 'is_full', 0, 0, '2015-03-23 21:37:56', NULL, '', 206, 249, 'inteiro', 'desktop'),
(4850, 220, 0, 'titulo_componente', NULL, 0, '2015-03-23 21:37:56', 'Preços', '', 206, 249, 'texto', 'desktop'),
(4851, 220, 0, 'background_type', 0, 0, '2015-03-23 21:37:56', NULL, '', 206, 249, 'inteiro', 'desktop'),
(4852, 220, 0, 'background', NULL, 0, '2015-03-23 21:37:56', '', '', 206, 249, 'texto', 'desktop'),
(4853, 220, 0, 'titulo_1', NULL, 0, '2015-03-23 21:44:26', NULL, '', 207, 250, 'texto', 'desktop'),
(4854, 220, 0, 'subtitulo_1', NULL, 0, '2015-03-23 21:44:26', NULL, '', 207, 250, 'texto', 'desktop'),
(4855, 220, 0, 'texto_1', NULL, 0, '2015-03-23 21:44:26', NULL, '', 207, 250, 'texto', 'desktop'),
(4856, 220, 0, 'link_1', NULL, 0, '2015-03-23 21:44:26', NULL, '', 207, 250, 'texto', 'desktop'),
(4857, 220, 0, 'link_target_1', NULL, 0, '2015-03-23 21:44:26', '_self', '', 207, 250, 'texto', 'desktop'),
(4858, 220, 0, 'image_1', NULL, 0, '2015-03-23 21:44:26', 'servicos_n4.jpg', '', 207, 250, 'texto', 'desktop'),
(4859, 220, 0, 'layout_1', NULL, 0, '2015-03-23 21:44:26', 'up', '', 207, 250, 'texto', 'desktop'),
(4860, 220, 0, 'cor_1', NULL, 0, '2015-03-23 21:44:26', '', '', 207, 250, 'texto', 'desktop'),
(4861, 220, 0, 'cor_2', NULL, 0, '2015-03-23 21:44:26', '', '', 207, 250, 'texto', 'desktop'),
(4862, 220, 0, 'cor_3', NULL, 0, '2015-03-23 21:44:26', '', '', 207, 250, 'texto', 'desktop'),
(4863, 220, 0, 'alinhamento_1', NULL, 0, '2015-03-23 21:44:26', 'left', '', 207, 250, 'texto', 'desktop'),
(4864, 220, 0, 'alinhamento_2', NULL, 0, '2015-03-23 21:44:26', 'left', '', 207, 250, 'texto', 'desktop'),
(4865, 220, 0, 'alinhamento_3', NULL, 0, '2015-03-23 21:44:26', 'left', '', 207, 250, 'texto', 'desktop'),
(4866, 220, 0, 'margin_top', 20, 0, '2015-03-23 21:44:26', NULL, '', 207, 250, 'inteiro', 'desktop'),
(4867, 220, 0, 'margin_bottom', 20, 0, '2015-03-23 21:44:26', NULL, '', 207, 250, 'inteiro', 'desktop'),
(4868, 220, 0, 'padding_top', 0, 0, '2015-03-23 21:44:26', NULL, '', 207, 250, 'inteiro', 'desktop'),
(4869, 220, 0, 'padding_bottom', 0, 0, '2015-03-23 21:44:26', NULL, '', 207, 250, 'inteiro', 'desktop'),
(4870, 220, 0, 'is_full', 0, 0, '2015-03-23 21:44:26', NULL, '', 207, 250, 'inteiro', 'desktop'),
(4871, 220, 0, 'titulo_componente', NULL, 0, '2015-03-23 21:44:26', 'Tecnologias', '', 207, 250, 'texto', 'desktop'),
(4872, 220, 0, 'background_type', 0, 0, '2015-03-23 21:44:26', NULL, '', 207, 250, 'inteiro', 'desktop'),
(4873, 220, 0, 'background', NULL, 0, '2015-03-23 21:44:26', '', '', 207, 250, 'texto', 'desktop'),
(4874, 220, 0, 'titulo_1', NULL, 0, '2015-03-23 22:04:39', NULL, '', 207, 251, 'texto', 'desktop'),
(4875, 220, 0, 'subtitulo_1', NULL, 0, '2015-03-23 22:04:39', NULL, '', 207, 251, 'texto', 'desktop'),
(4876, 220, 0, 'texto_1', NULL, 0, '2015-03-23 22:04:39', NULL, '', 207, 251, 'texto', 'desktop'),
(4877, 220, 0, 'link_1', NULL, 0, '2015-03-23 22:04:39', NULL, '', 207, 251, 'texto', 'desktop'),
(4878, 220, 0, 'link_target_1', NULL, 0, '2015-03-23 22:04:39', '_self', '', 207, 251, 'texto', 'desktop'),
(4879, 220, 0, 'image_1', NULL, 0, '2015-03-23 22:04:39', 'banner_solucao_z5.jpg', '', 207, 251, 'texto', 'desktop'),
(4880, 220, 0, 'layout_1', NULL, 0, '2015-03-23 22:04:39', 'up', '', 207, 251, 'texto', 'desktop'),
(4881, 220, 0, 'cor_1', NULL, 0, '2015-03-23 22:04:39', '', '', 207, 251, 'texto', 'desktop'),
(4882, 220, 0, 'cor_2', NULL, 0, '2015-03-23 22:04:39', '', '', 207, 251, 'texto', 'desktop'),
(4883, 220, 0, 'cor_3', NULL, 0, '2015-03-23 22:04:39', '', '', 207, 251, 'texto', 'desktop'),
(4884, 220, 0, 'alinhamento_1', NULL, 0, '2015-03-23 22:04:39', 'left', '', 207, 251, 'texto', 'desktop'),
(4885, 220, 0, 'alinhamento_2', NULL, 0, '2015-03-23 22:04:39', 'left', '', 207, 251, 'texto', 'desktop'),
(4886, 220, 0, 'alinhamento_3', NULL, 0, '2015-03-23 22:04:39', 'left', '', 207, 251, 'texto', 'desktop'),
(4887, 220, 0, 'margin_top', 20, 0, '2015-03-23 22:04:39', NULL, '', 207, 251, 'inteiro', 'desktop'),
(4888, 220, 0, 'margin_bottom', 20, 0, '2015-03-23 22:04:39', NULL, '', 207, 251, 'inteiro', 'desktop'),
(4889, 220, 0, 'padding_top', 0, 0, '2015-03-23 22:04:39', NULL, '', 207, 251, 'inteiro', 'desktop'),
(4890, 220, 0, 'padding_bottom', 0, 0, '2015-03-23 22:04:39', NULL, '', 207, 251, 'inteiro', 'desktop'),
(4891, 220, 0, 'is_full', 0, 0, '2015-03-23 22:04:39', NULL, '', 207, 251, 'inteiro', 'desktop'),
(4892, 220, 0, 'titulo_componente', NULL, 0, '2015-03-23 22:04:39', 'Banner Soluções', '', 207, 251, 'texto', 'desktop'),
(4893, 220, 0, 'background_type', 0, 0, '2015-03-23 22:04:39', NULL, '', 207, 251, 'inteiro', 'desktop'),
(4894, 220, 0, 'background', NULL, 0, '2015-03-23 22:04:39', '', '', 207, 251, 'texto', 'desktop'),
(4895, 224, 0, 'dc_date', NULL, 0, NULL, '2015-03-23', '', 0, 0, '0', '0'),
(4896, 224, 0, 'dc_title', NULL, 0, NULL, 'Seja um de nossos parceiros', '', 0, 0, '0', '0'),
(4897, 224, 0, 'dc_lastupdate', NULL, 0, NULL, '2015-04-01', '', 0, 0, '0', '0'),
(4898, 224, 0, 'titulo_1', NULL, 0, '2015-03-23 22:20:27', NULL, '', 207, 252, 'texto', 'desktop'),
(4899, 224, 0, 'subtitulo_1', NULL, 0, '2015-03-23 22:20:27', NULL, '', 207, 252, 'texto', 'desktop'),
(4900, 224, 0, 'texto_1', NULL, 0, '2015-03-23 22:20:27', NULL, '', 207, 252, 'texto', 'desktop'),
(4901, 224, 0, 'link_1', NULL, 0, '2015-03-23 22:20:27', NULL, '', 207, 252, 'texto', 'desktop'),
(4902, 224, 0, 'link_target_1', NULL, 0, '2015-03-23 22:20:27', '_self', '', 207, 252, 'texto', 'desktop'),
(4903, 224, 0, 'image_1', NULL, 0, '2015-03-23 22:20:27', 'tabela_indicacao_b9.png', '', 207, 252, 'texto', 'desktop'),
(4904, 224, 0, 'layout_1', NULL, 0, '2015-03-23 22:20:27', 'up', '', 207, 252, 'texto', 'desktop'),
(4905, 224, 0, 'cor_1', NULL, 0, '2015-03-23 22:20:27', '', '', 207, 252, 'texto', 'desktop'),
(4906, 224, 0, 'cor_2', NULL, 0, '2015-03-23 22:20:27', '', '', 207, 252, 'texto', 'desktop'),
(4907, 224, 0, 'cor_3', NULL, 0, '2015-03-23 22:20:27', '', '', 207, 252, 'texto', 'desktop'),
(4908, 224, 0, 'alinhamento_1', NULL, 0, '2015-03-23 22:20:27', 'left', '', 207, 252, 'texto', 'desktop'),
(4909, 224, 0, 'alinhamento_2', NULL, 0, '2015-03-23 22:20:27', 'left', '', 207, 252, 'texto', 'desktop'),
(4910, 224, 0, 'alinhamento_3', NULL, 0, '2015-03-23 22:20:27', 'left', '', 207, 252, 'texto', 'desktop'),
(4911, 224, 0, 'margin_top', 0, 0, '2015-03-23 22:20:27', NULL, '', 207, 252, 'inteiro', 'desktop'),
(4912, 224, 0, 'margin_bottom', 0, 0, '2015-03-23 22:20:27', NULL, '', 207, 252, 'inteiro', 'desktop'),
(4913, 224, 0, 'padding_top', 0, 0, '2015-03-23 22:20:27', NULL, '', 207, 252, 'inteiro', 'desktop'),
(4914, 224, 0, 'padding_bottom', 0, 0, '2015-03-23 22:20:27', NULL, '', 207, 252, 'inteiro', 'desktop'),
(4915, 224, 0, 'is_full', 0, 0, '2015-03-23 22:20:27', NULL, '', 207, 252, 'inteiro', 'desktop'),
(4916, 224, 0, 'titulo_componente', NULL, 0, '2015-03-23 22:20:27', '', '', 207, 252, 'texto', 'desktop'),
(4917, 224, 0, 'background_type', 0, 0, '2015-03-23 22:20:27', NULL, '', 207, 252, 'inteiro', 'desktop'),
(4918, 224, 0, 'background', NULL, 0, '2015-03-23 22:20:27', '', '', 207, 252, 'texto', 'desktop'),
(4919, 224, 0, 'titulo_1', NULL, 0, '2015-03-23 22:27:25', NULL, 'Como solicito a bonificação?', 207, 253, 'texto', 'desktop'),
(4920, 224, 0, 'subtitulo_1', NULL, 0, '2015-03-23 22:27:25', NULL, 'Simples e fácil, basta sugerir seu contato para conferencia', 207, 253, 'texto', 'desktop'),
(4921, 224, 0, 'texto_1', NULL, 0, '2015-03-23 22:27:25', NULL, 'Basta que você solicite à pessoa que você indicou, a inserção seu nome ou domínio no contrato de venda! Não esqueça que essa é a única forma de garantir suas indicações. O crédito é automático, cada cliente indicado vale muito para você.', 207, 253, 'texto', 'desktop'),
(4922, 224, 0, 'link_1', NULL, 0, '2015-03-23 22:27:25', NULL, '', 207, 253, 'texto', 'desktop'),
(4923, 224, 0, 'link_target_1', NULL, 0, '2015-03-23 22:27:25', '_self', '', 207, 253, 'texto', 'desktop'),
(4924, 224, 0, 'image_1', NULL, 0, '2015-03-23 22:27:25', '', '', 207, 253, 'texto', 'desktop'),
(4925, 224, 0, 'layout_1', NULL, 0, '2015-03-23 22:27:25', 'up', '', 207, 253, 'texto', 'desktop'),
(4926, 224, 0, 'cor_1', NULL, 0, '2015-03-23 22:27:25', '', '', 207, 253, 'texto', 'desktop'),
(4927, 224, 0, 'cor_2', NULL, 0, '2015-03-23 22:27:25', '', '', 207, 253, 'texto', 'desktop'),
(4928, 224, 0, 'cor_3', NULL, 0, '2015-03-23 22:27:25', '', '', 207, 253, 'texto', 'desktop'),
(4929, 224, 0, 'alinhamento_1', NULL, 0, '2015-03-23 22:27:25', 'left', '', 207, 253, 'texto', 'desktop'),
(4930, 224, 0, 'alinhamento_2', NULL, 0, '2015-03-23 22:27:25', 'left', '', 207, 253, 'texto', 'desktop'),
(4931, 224, 0, 'alinhamento_3', NULL, 0, '2015-03-23 22:27:25', 'left', '', 207, 253, 'texto', 'desktop'),
(4932, 224, 0, 'margin_top', 30, 0, '2015-03-23 22:27:25', NULL, '', 207, 253, 'inteiro', 'desktop'),
(4933, 224, 0, 'margin_bottom', 20, 0, '2015-03-23 22:27:25', NULL, '', 207, 253, 'inteiro', 'desktop'),
(4934, 224, 0, 'padding_top', 0, 0, '2015-03-23 22:27:25', NULL, '', 207, 253, 'inteiro', 'desktop'),
(4935, 224, 0, 'padding_bottom', 0, 0, '2015-03-23 22:27:25', NULL, '', 207, 253, 'inteiro', 'desktop'),
(4936, 224, 0, 'is_full', 0, 0, '2015-03-23 22:27:25', NULL, '', 207, 253, 'inteiro', 'desktop'),
(4937, 224, 0, 'titulo_componente', NULL, 0, '2015-03-23 22:27:25', 'Texto Bonificação', '', 207, 253, 'texto', 'desktop'),
(4938, 224, 0, 'background_type', 0, 0, '2015-03-23 22:27:25', NULL, '', 207, 253, 'inteiro', 'desktop'),
(4939, 224, 0, 'background', NULL, 0, '2015-03-23 22:27:25', '', '', 207, 253, 'texto', 'desktop'),
(4940, 213, 0, 'dc_title', NULL, 0, NULL, 'Veja nossas matérias', '', 0, 0, '0', '0'),
(4941, 213, 0, 'dc_lastupdate', NULL, 0, NULL, '2015-03-23', '', 0, 0, '0', '0'),
(4942, 213, 0, 'mat_lk_rcn_qtd', 4, 0, NULL, NULL, '', 0, 0, '0', '0'),
(4943, 213, 0, 'mat_lk_rcn_afi', NULL, 0, NULL, 'afinidade', '', 0, 0, '0', '0'),
(4944, 213, 0, 'mat_lk_rcn_adv', 1, 0, NULL, NULL, '', 0, 0, '0', '0'),
(4945, 213, 0, 'mat_lk_rcn_blc', 4, 0, NULL, NULL, '', 0, 0, '0', '0'),
(4946, 225, 0, 'dc_date', NULL, 0, NULL, '2015-03-23', '', 0, 0, '0', '0'),
(4947, 225, 0, 'dc_title', NULL, 0, NULL, 'Suporte e Cobrança', '', 0, 0, '0', '0'),
(4948, 225, 0, 'dc_lastupdate', NULL, 0, NULL, '2015-03-23', '', 0, 0, '0', '0'),
(4949, 226, 0, 'dc_date', NULL, 0, NULL, '2015-03-23', '', 0, 0, '0', '0'),
(4950, 226, 0, 'dc_title', NULL, 0, NULL, 'Veja as perguntas frequentes', '', 0, 0, '0', '0'),
(4951, 226, 0, 'dc_lastupdate', NULL, 0, NULL, '2015-03-23', '', 0, 0, '0', '0'),
(4952, 227, 0, 'dc_date', NULL, 0, NULL, '2015-03-23', '', 0, 0, '0', '0'),
(4953, 227, 0, 'dc_title', NULL, 0, NULL, 'Imprima seu boleto', '', 0, 0, '0', '0'),
(4954, 227, 0, 'dc_lastupdate', NULL, 0, NULL, '2015-03-23', '', 0, 0, '0', '0'),
(4955, 228, 0, 'dc_date', NULL, 0, NULL, '2015-03-23', '', 0, 0, '0', '0'),
(4956, 228, 0, 'dc_title', NULL, 0, NULL, 'Segunda via do Boleto', '', 0, 0, '0', '0'),
(4957, 228, 0, 'dc_lastupdate', NULL, 0, NULL, '2015-03-23', '', 0, 0, '0', '0'),
(4958, 229, 0, 'dc_date', NULL, 0, NULL, '2015-03-23', '', 0, 0, '0', '0'),
(4959, 229, 0, 'dc_title', NULL, 0, NULL, 'Hospedagem de Sites', '', 0, 0, '0', '0'),
(4960, 229, 0, 'dc_lastupdate', NULL, 0, NULL, '2015-04-01', '', 0, 0, '0', '0'),
(4961, 229, 0, 'titulo_1', NULL, 0, '2015-03-23 22:47:45', NULL, '', 207, 254, 'texto', 'desktop'),
(4962, 229, 0, 'subtitulo_1', NULL, 0, '2015-03-23 22:47:45', NULL, '', 207, 254, 'texto', 'desktop'),
(4963, 229, 0, 'texto_1', NULL, 0, '2015-03-23 22:47:45', NULL, '', 207, 254, 'texto', 'desktop'),
(4964, 229, 0, 'link_1', NULL, 0, '2015-03-23 22:47:45', NULL, '', 207, 254, 'texto', 'desktop'),
(4965, 229, 0, 'link_target_1', NULL, 0, '2015-03-23 22:47:45', '_self', '', 207, 254, 'texto', 'desktop'),
(4966, 229, 0, 'image_1', NULL, 0, '2015-03-23 22:47:45', 'tabela_planos_c9.jpg', '', 207, 254, 'texto', 'desktop'),
(4967, 229, 0, 'layout_1', NULL, 0, '2015-03-23 22:47:45', 'up', '', 207, 254, 'texto', 'desktop'),
(4968, 229, 0, 'cor_1', NULL, 0, '2015-03-23 22:47:45', '', '', 207, 254, 'texto', 'desktop'),
(4969, 229, 0, 'cor_2', NULL, 0, '2015-03-23 22:47:45', '', '', 207, 254, 'texto', 'desktop'),
(4970, 229, 0, 'cor_3', NULL, 0, '2015-03-23 22:47:45', '', '', 207, 254, 'texto', 'desktop'),
(4971, 229, 0, 'alinhamento_1', NULL, 0, '2015-03-23 22:47:45', 'left', '', 207, 254, 'texto', 'desktop'),
(4972, 229, 0, 'alinhamento_2', NULL, 0, '2015-03-23 22:47:45', 'left', '', 207, 254, 'texto', 'desktop'),
(4973, 229, 0, 'alinhamento_3', NULL, 0, '2015-03-23 22:47:45', 'left', '', 207, 254, 'texto', 'desktop'),
(4974, 229, 0, 'margin_top', 0, 0, '2015-03-23 22:47:45', NULL, '', 207, 254, 'inteiro', 'desktop'),
(4975, 229, 0, 'margin_bottom', 0, 0, '2015-03-23 22:47:45', NULL, '', 207, 254, 'inteiro', 'desktop'),
(4976, 229, 0, 'padding_top', 0, 0, '2015-03-23 22:47:45', NULL, '', 207, 254, 'inteiro', 'desktop'),
(4977, 229, 0, 'padding_bottom', 0, 0, '2015-03-23 22:47:45', NULL, '', 207, 254, 'inteiro', 'desktop'),
(4978, 229, 0, 'is_full', 0, 0, '2015-03-23 22:47:45', NULL, '', 207, 254, 'inteiro', 'desktop'),
(4979, 229, 0, 'titulo_componente', NULL, 0, '2015-03-23 22:47:45', 'Tabela', '', 207, 254, 'texto', 'desktop'),
(4980, 229, 0, 'background_type', 0, 0, '2015-03-23 22:47:45', NULL, '', 207, 254, 'inteiro', 'desktop'),
(4981, 229, 0, 'background', NULL, 0, '2015-03-23 22:47:45', '', '', 207, 254, 'texto', 'desktop'),
(4982, 229, 0, 'titulo_1', NULL, 0, '2015-03-23 22:48:47', NULL, '', 207, 255, 'texto', 'desktop'),
(4983, 229, 0, 'subtitulo_1', NULL, 0, '2015-03-23 22:48:47', NULL, 'Outras informações', 207, 255, 'texto', 'desktop'),
(4984, 229, 0, 'texto_1', NULL, 0, '2015-03-23 22:48:47', NULL, '*Os planos de Hospedagem da HostMais possuem domínios hospedados, sem custo adicional, bastando apenas serem domínios registrados.\r\nUm dos domínios hospedados é o site principal e os outros podem ser:\r\n\r\n- Apontamento para site principal: exibe o conteúdo do site principal;.  \r\n- Site adicional: exibe o conteúdo de um subdiretório da área de hospedagem existente;\r\n- Redirecionamento: redireciona para um site externo.\r\n- Contas de FTP adicionais: R$ 10,00 por conta de FTP.', 207, 255, 'texto', 'desktop'),
(4985, 229, 0, 'link_1', NULL, 0, '2015-03-23 22:48:47', NULL, '', 207, 255, 'texto', 'desktop'),
(4986, 229, 0, 'link_target_1', NULL, 0, '2015-03-23 22:48:47', '_self', '', 207, 255, 'texto', 'desktop'),
(4987, 229, 0, 'image_1', NULL, 0, '2015-03-23 22:48:47', '', '', 207, 255, 'texto', 'desktop'),
(4988, 229, 0, 'layout_1', NULL, 0, '2015-03-23 22:48:47', 'up', '', 207, 255, 'texto', 'desktop'),
(4989, 229, 0, 'cor_1', NULL, 0, '2015-03-23 22:48:47', '', '', 207, 255, 'texto', 'desktop'),
(4990, 229, 0, 'cor_2', NULL, 0, '2015-03-23 22:48:47', '', '', 207, 255, 'texto', 'desktop'),
(4991, 229, 0, 'cor_3', NULL, 0, '2015-03-23 22:48:47', '', '', 207, 255, 'texto', 'desktop'),
(4992, 229, 0, 'alinhamento_1', NULL, 0, '2015-03-23 22:48:47', 'left', '', 207, 255, 'texto', 'desktop'),
(4993, 229, 0, 'alinhamento_2', NULL, 0, '2015-03-23 22:48:47', 'left', '', 207, 255, 'texto', 'desktop'),
(4994, 229, 0, 'alinhamento_3', NULL, 0, '2015-03-23 22:48:47', 'left', '', 207, 255, 'texto', 'desktop'),
(4995, 229, 0, 'margin_top', 0, 0, '2015-03-23 22:48:47', NULL, '', 207, 255, 'inteiro', 'desktop'),
(4996, 229, 0, 'margin_bottom', 0, 0, '2015-03-23 22:48:47', NULL, '', 207, 255, 'inteiro', 'desktop'),
(4997, 229, 0, 'padding_top', 0, 0, '2015-03-23 22:48:47', NULL, '', 207, 255, 'inteiro', 'desktop'),
(4998, 229, 0, 'padding_bottom', 0, 0, '2015-03-23 22:48:47', NULL, '', 207, 255, 'inteiro', 'desktop'),
(4999, 229, 0, 'is_full', 0, 0, '2015-03-23 22:48:47', NULL, '', 207, 255, 'inteiro', 'desktop'),
(5000, 229, 0, 'titulo_componente', NULL, 0, '2015-03-23 22:48:47', 'Leganda da tabela', '', 207, 255, 'texto', 'desktop'),
(5001, 229, 0, 'background_type', 0, 0, '2015-03-23 22:48:47', NULL, '', 207, 255, 'inteiro', 'desktop'),
(5002, 229, 0, 'background', NULL, 0, '2015-03-23 22:48:47', '', '', 207, 255, 'texto', 'desktop'),
(5003, 230, 0, 'dc_date', NULL, 0, NULL, '2015-03-23', '', 0, 0, '0', '0'),
(5004, 230, 0, 'dc_title', NULL, 0, NULL, 'Planos', '', 0, 0, '0', '0'),
(5005, 230, 0, 'dc_lastupdate', NULL, 0, NULL, '2015-03-23', '', 0, 0, '0', '0'),
(5006, 231, 0, 'dc_date', NULL, 0, NULL, '2015-03-23', '', 0, 0, '0', '0'),
(5007, 231, 0, 'dc_title', NULL, 0, NULL, 'Collocation', '', 0, 0, '0', '0'),
(5008, 231, 0, 'dc_lastupdate', NULL, 0, NULL, '2015-03-23', '', 0, 0, '0', '0'),
(5009, 232, 0, 'dc_date', NULL, 0, NULL, '2015-03-23', '', 0, 0, '0', '0'),
(5010, 232, 0, 'dc_title', NULL, 0, NULL, 'Servidores Dedicados', '', 0, 0, '0', '0'),
(5011, 232, 0, 'dc_lastupdate', NULL, 0, NULL, '2015-03-23', '', 0, 0, '0', '0'),
(5012, 216, 0, 'dc_title', NULL, 0, NULL, 'Orçamento', '', 0, 0, '0', '0'),
(5013, 216, 0, 'dc_lastupdate', NULL, 0, NULL, '2015-04-01', '', 0, 0, '0', '0'),
(5014, 232, 0, 'titulo_1', NULL, 0, '2015-03-23 23:03:56', NULL, '', 207, 256, 'texto', 'desktop'),
(5015, 232, 0, 'subtitulo_1', NULL, 0, '2015-03-23 23:03:56', NULL, 'Mais informações', 207, 256, 'texto', 'desktop'),
(5016, 232, 0, 'texto_1', NULL, 0, '2015-03-23 23:03:57', NULL, '- Contrato mínimo de 12 meses\r\n- O cliente poderá optar pela contratação de Link (conforme descrito acima), ou consulte preços para um limite de transferência mensal calculada em GBs.  \r\n- Todas as licenças dos softwares instalados nos servidores dedicados são de responsabilidade do cliente.\r\n\r\nNecessita de maiores detalhes? Entre em contato pelo e-mail atendimento@hostmais.com.br . ', 207, 256, 'texto', 'desktop'),
(5017, 232, 0, 'link_1', NULL, 0, '2015-03-23 23:03:57', NULL, '', 207, 256, 'texto', 'desktop'),
(5018, 232, 0, 'link_target_1', NULL, 0, '2015-03-23 23:03:57', '_self', '', 207, 256, 'texto', 'desktop'),
(5019, 232, 0, 'image_1', NULL, 0, '2015-03-23 23:03:57', '', '', 207, 256, 'texto', 'desktop'),
(5020, 232, 0, 'layout_1', NULL, 0, '2015-03-23 23:03:57', 'up', '', 207, 256, 'texto', 'desktop'),
(5021, 232, 0, 'cor_1', NULL, 0, '2015-03-23 23:03:57', '', '', 207, 256, 'texto', 'desktop'),
(5022, 232, 0, 'cor_2', NULL, 0, '2015-03-23 23:03:58', '', '', 207, 256, 'texto', 'desktop'),
(5023, 232, 0, 'cor_3', NULL, 0, '2015-03-23 23:03:58', '', '', 207, 256, 'texto', 'desktop'),
(5024, 232, 0, 'alinhamento_1', NULL, 0, '2015-03-23 23:03:58', 'left', '', 207, 256, 'texto', 'desktop'),
(5025, 232, 0, 'alinhamento_2', NULL, 0, '2015-03-23 23:03:58', 'left', '', 207, 256, 'texto', 'desktop'),
(5026, 232, 0, 'alinhamento_3', NULL, 0, '2015-03-23 23:03:58', 'left', '', 207, 256, 'texto', 'desktop'),
(5027, 232, 0, 'margin_top', 20, 0, '2015-03-23 23:03:58', NULL, '', 207, 256, 'inteiro', 'desktop'),
(5028, 232, 0, 'margin_bottom', 20, 0, '2015-03-23 23:03:58', NULL, '', 207, 256, 'inteiro', 'desktop'),
(5029, 232, 0, 'padding_top', 0, 0, '2015-03-23 23:03:59', NULL, '', 207, 256, 'inteiro', 'desktop'),
(5030, 232, 0, 'padding_bottom', 0, 0, '2015-03-23 23:03:59', NULL, '', 207, 256, 'inteiro', 'desktop'),
(5031, 232, 0, 'is_full', 0, 0, '2015-03-23 23:03:59', NULL, '', 207, 256, 'inteiro', 'desktop'),
(5032, 232, 0, 'titulo_componente', NULL, 0, '2015-03-23 23:03:59', 'Tabela Dedicados', '', 207, 256, 'texto', 'desktop'),
(5033, 232, 0, 'background_type', 0, 0, '2015-03-23 23:03:59', NULL, '', 207, 256, 'inteiro', 'desktop'),
(5034, 232, 0, 'background', NULL, 0, '2015-03-23 23:03:59', '', '', 207, 256, 'texto', 'desktop'),
(5035, 233, 0, 'dc_title', NULL, 0, NULL, 'Pier Planos', '', 0, 0, '0', '0'),
(5036, 233, 0, 'dc_lastupdate', NULL, 0, NULL, '2015-03-26', '', 0, 0, '0', '0'),
(5037, 233, 0, 'qtd_blocos', 4, 0, '2015-03-26 22:01:26', NULL, '', 206, 258, 'inteiro', 'desktop'),
(5038, 233, 0, 'titulo_1', NULL, 0, '2015-03-26 22:01:26', NULL, 'Plano Pier - 1', 206, 258, 'texto', 'desktop'),
(5039, 233, 0, 'subtitulo_1', NULL, 0, '2015-03-26 22:01:26', NULL, 'WebSite Responsivo + ERP + Loja Virtual + Integração Mercado Livre + Identidade Visual', 206, 258, 'texto', 'desktop'),
(5040, 233, 0, 'texto_1', NULL, 0, '2015-03-26 22:01:26', NULL, '- Plano completo com todas funcionalidades do sistema liberados;\r\n- Gerenciamento de Conteúdo - Pier Admin 3.0;\r\n- ERP - Sistema integrado de gestão empresarial;\r\n- Loja Virtual;\r\n- Identidade Visual (3 Banners, Logotipo e +1000 cartões de visita);\r\n- Layout Responsivo.\r\n\r\nValor de hospedagem sobre consulta ', 206, 258, 'texto', 'desktop'),
(5041, 233, 0, 'valor_1', 0, 0, '2015-03-26 22:01:27', NULL, '', 206, 258, 'inteiro', 'desktop'),
(5042, 233, 0, 'centavo_1', NULL, 0, '2015-03-26 22:01:27', '', '', 206, 258, 'texto', 'desktop'),
(5043, 233, 0, 'unidade_1', NULL, 0, '2015-03-26 22:01:27', '', '', 206, 258, 'texto', 'desktop'),
(5044, 233, 0, 'frequencia_1', NULL, 0, '2015-03-26 22:01:27', '', '', 206, 258, 'texto', 'desktop'),
(5045, 233, 0, 'label_1', NULL, 0, '2015-03-26 22:01:28', 'Quanto Custa?', '', 206, 258, 'texto', 'desktop'),
(5046, 233, 0, 'link_1', NULL, 0, '2015-03-26 22:01:28', '/orcamento', '', 206, 258, 'texto', 'desktop'),
(5047, 233, 0, 'destaque_1', 0, 0, '2015-03-26 22:01:28', NULL, '', 206, 258, 'inteiro', 'desktop'),
(5048, 233, 0, 'titulo_2', NULL, 0, '2015-03-26 22:01:28', NULL, 'Plano Pier - 2', 206, 258, 'texto', 'desktop'),
(5049, 233, 0, 'subtitulo_2', NULL, 0, '2015-03-26 22:01:28', NULL, 'WebSite Responsivo + ERP + Loja Virtual + Identidade Visual', 206, 258, 'texto', 'desktop'),
(5050, 233, 0, 'texto_2', NULL, 0, '2015-03-26 22:01:29', NULL, '- Plano com estrutura básica para loja virtual;\r\n- Gerenciamento de Conteúdo - Pier Admin 3.0;\r\n- ERP - Sistema integrado de gestão empresarial;\r\n- Loja Virtual;\r\n- Identidade Visual (3 Banners, Logotipo e +1000 cartões de visita)\r\n- Layout Responsivo.\r\n\r\nValor de hospedagem sobre consulta ', 206, 258, 'texto', 'desktop'),
(5051, 233, 0, 'valor_2', 0, 0, '2015-03-26 22:01:29', NULL, '', 206, 258, 'inteiro', 'desktop'),
(5052, 233, 0, 'centavo_2', NULL, 0, '2015-03-26 22:01:29', '', '', 206, 258, 'texto', 'desktop'),
(5053, 233, 0, 'unidade_2', NULL, 0, '2015-03-26 22:01:29', '', '', 206, 258, 'texto', 'desktop'),
(5054, 233, 0, 'frequencia_2', NULL, 0, '2015-03-26 22:01:29', '', '', 206, 258, 'texto', 'desktop'),
(5055, 233, 0, 'label_2', NULL, 0, '2015-03-26 22:01:30', 'Quanto Custa?', '', 206, 258, 'texto', 'desktop'),
(5056, 233, 0, 'link_2', NULL, 0, '2015-03-26 22:01:30', '/orcamento', '', 206, 258, 'texto', 'desktop'),
(5057, 233, 0, 'destaque_2', 0, 0, '2015-03-26 22:01:30', NULL, '', 206, 258, 'inteiro', 'desktop'),
(5058, 233, 0, 'titulo_3', NULL, 0, '2015-03-26 22:01:30', NULL, 'Plano Pier - 3', 206, 258, 'texto', 'desktop'),
(5059, 233, 0, 'subtitulo_3', NULL, 0, '2015-03-26 22:01:31', NULL, 'WebSite Responsivo + ERP + Identidade Visual', 206, 258, 'texto', 'desktop'),
(5060, 233, 0, 'texto_3', NULL, 0, '2015-03-26 22:01:31', NULL, '- Plano com estrutura básica de website;\r\n- Gerenciamento de Conteúdo - Pier Admin 3.0;\r\n- ERP - Sistema integrado de gestão empresarial;\r\n- Identidade Visual (3 Banners, Logotipo e +1000 cartões de visita)\r\n- Vários modelos de Layout disponíveis;\r\n- Layout Responsivo\r\n\r\nValor de hospedagem sobre consulta ', 206, 258, 'texto', 'desktop'),
(5061, 233, 0, 'valor_3', 0, 0, '2015-03-26 22:01:31', NULL, '', 206, 258, 'inteiro', 'desktop'),
(5062, 233, 0, 'centavo_3', NULL, 0, '2015-03-26 22:01:31', '', '', 206, 258, 'texto', 'desktop'),
(5063, 233, 0, 'unidade_3', NULL, 0, '2015-03-26 22:01:31', '', '', 206, 258, 'texto', 'desktop'),
(5064, 233, 0, 'frequencia_3', NULL, 0, '2015-03-26 22:01:31', '', '', 206, 258, 'texto', 'desktop'),
(5065, 233, 0, 'label_3', NULL, 0, '2015-03-26 22:01:31', 'Quanto Custa?', '', 206, 258, 'texto', 'desktop'),
(5066, 233, 0, 'link_3', NULL, 0, '2015-03-26 22:01:32', '/orcamento', '', 206, 258, 'texto', 'desktop'),
(5067, 233, 0, 'destaque_3', 0, 0, '2015-03-26 22:01:32', NULL, '', 206, 258, 'inteiro', 'desktop'),
(5068, 233, 0, 'titulo_4', NULL, 0, '2015-03-26 22:01:32', NULL, 'Plano Pier - 4', 206, 258, 'texto', 'desktop'),
(5069, 233, 0, 'subtitulo_4', NULL, 0, '2015-03-26 22:01:32', NULL, 'Plano Econômico - Ideal para empresas que já possuem Identidade Visual', 206, 258, 'texto', 'desktop'),
(5070, 233, 0, 'texto_4', NULL, 0, '2015-03-26 22:01:32', NULL, '- Vários modelos de Layout disponíveis;\r\n- Email personalizado;\r\n- Layout não Responsivo.\r\n\r\nSem Gerenciamento de Conteúdo\r\n\r\nValor de hospedagem sobre consulta ', 206, 258, 'texto', 'desktop'),
(5071, 233, 0, 'valor_4', 0, 0, '2015-03-26 22:01:32', NULL, '', 206, 258, 'inteiro', 'desktop'),
(5072, 233, 0, 'centavo_4', NULL, 0, '2015-03-26 22:01:32', '', '', 206, 258, 'texto', 'desktop'),
(5073, 233, 0, 'unidade_4', NULL, 0, '2015-03-26 22:01:33', '', '', 206, 258, 'texto', 'desktop'),
(5074, 233, 0, 'frequencia_4', NULL, 0, '2015-03-26 22:01:33', '', '', 206, 258, 'texto', 'desktop'),
(5075, 233, 0, 'label_4', NULL, 0, '2015-03-26 22:01:33', 'Quanto Custa?', '', 206, 258, 'texto', 'desktop'),
(5076, 233, 0, 'link_4', NULL, 0, '2015-03-26 22:01:33', '/orcamento', '', 206, 258, 'texto', 'desktop'),
(5077, 233, 0, 'destaque_4', 0, 0, '2015-03-26 22:01:34', NULL, '', 206, 258, 'inteiro', 'desktop'),
(5078, 233, 0, 'cor_1', NULL, 0, '2015-03-26 22:01:34', '', '', 206, 258, 'texto', 'desktop'),
(5079, 233, 0, 'cor_2', NULL, 0, '2015-03-26 22:01:34', '', '', 206, 258, 'texto', 'desktop'),
(5080, 233, 0, 'cor_3', NULL, 0, '2015-03-26 22:01:34', '', '', 206, 258, 'texto', 'desktop'),
(5081, 233, 0, 'cor_block_1', NULL, 0, '2015-03-26 22:01:34', '', '', 206, 258, 'texto', 'desktop'),
(5082, 233, 0, 'cor_block_2', NULL, 0, '2015-03-26 22:01:35', '', '', 206, 258, 'texto', 'desktop'),
(5083, 233, 0, 'cor_block_3', NULL, 0, '2015-03-26 22:01:35', '', '', 206, 258, 'texto', 'desktop'),
(5084, 233, 0, 'cor_block_4', NULL, 0, '2015-03-26 22:01:35', '', '', 206, 258, 'texto', 'desktop'),
(5085, 233, 0, 'margin_top', 30, 0, '2015-03-26 22:01:35', NULL, '', 206, 258, 'inteiro', 'desktop'),
(5086, 233, 0, 'margin_bottom', 0, 0, '2015-03-26 22:01:36', NULL, '', 206, 258, 'inteiro', 'desktop'),
(5087, 233, 0, 'padding_top', 0, 0, '2015-03-26 22:01:36', NULL, '', 206, 258, 'inteiro', 'desktop'),
(5088, 233, 0, 'padding_bottom', 0, 0, '2015-03-26 22:01:36', NULL, '', 206, 258, 'inteiro', 'desktop'),
(5089, 233, 0, 'is_full', 0, 0, '2015-03-26 22:01:36', NULL, '', 206, 258, 'inteiro', 'desktop'),
(5090, 233, 0, 'titulo_componente', NULL, 0, '2015-03-26 22:01:36', 'Planos', '', 206, 258, 'texto', 'desktop'),
(5091, 233, 0, 'background_type', 0, 0, '2015-03-26 22:01:37', NULL, '', 206, 258, 'inteiro', 'desktop'),
(5092, 233, 0, 'background', NULL, 0, '2015-03-26 22:01:37', '', '', 206, 258, 'texto', 'desktop'),
(5093, 233, 0, 'qtd_blocos', 1, 0, '2015-03-26 22:07:09', NULL, '', 206, 259, 'inteiro', 'desktop'),
(5094, 233, 0, 'titulo_1', NULL, 0, '2015-03-26 22:07:09', NULL, 'Plano Pier 1 - Funcionalidades do sistema Pier Admin 3.0', 206, 259, 'texto', 'desktop'),
(5095, 233, 0, 'subtitulo_1', NULL, 0, '2015-03-26 22:07:09', NULL, 'Plano completo com todas funcionalidades do sistema liberados', 206, 259, 'texto', 'desktop'),
(5096, 233, 0, 'texto_1', NULL, 0, '2015-03-26 22:07:09', NULL, '<h3><b><red>Este plano, garante ao seu website, Update das novas versões e aplicativos gratuitamente durante 1 ano! </red></b>\r\n</h3>\r\n<B><RED>Aplicativos disponíveis:</RED></B>\r\n\r\n-PierGestão ERP - Sistema integrado de gestão empresarial;\r\n-PierMail - Email-Marketing (disponibilizado de acordo com o plano contratado);\r\n-PierLayout - Alteração completa em todo layout (cores fontes, cores paginas, topo, rodapé, texturas, logos, menu);\r\n-PierLiveChat - Atendimento Online (Atenda seus clientes online, com chat pelo Admin)\r\n-PierMagazine - Revistas Online (Crie revistas, livros e apresentações com esse componente)\r\n-PierDownloads - Disponibilize Arquivos aos seus clientes, podendo baixar via download (Word, MP3, Pdf, Excel, Zip...) \r\n-PierHiperLinks - adicione seus links favoritos (essencial para começar a adquirir Link building)\r\n-PierEventos - Crie e organize com fichas de inscrições, eventos, palestras, cursos, workshops, viagens. \r\n-PierGalerias - Galeiras de Fotos e usuários \r\n-PierVídeos - Vídeos do YouTube e Vimeo\r\n-PierMaterias - Publique matérias, dicas, notícias e novidades (opção de poder receber comentários e curtidas)\r\n-PierProdutos - Adicione seus produtos a seu site (cria/edita/remove produtos com categorias, imagens, vídeos de demonstração, detalhes, descrição, lançamentos, vitrine e mais uma infinidade de opções)\r\n-PierEcommerce - Venda seus produtos em sua loja virtual\r\n-PierPromoções - Crie promoções no seu site (Programas de fidelidade, gere vouchers, concursos culturais, post no seu Facebook)\r\n-PierFórum - Discussões, informações e arquivos. Ideal para grupos de BenchMarking.\r\n-PierBoletos - Gerador de Boletos (Com vários bancos: Bradesco, Banco do Brasil, Itaú entre outros)\r\n-PierComboShare - Combobox lateral com as principais redes sociais e diferentes forma de compartilhamento\r\n-PierWiki - Componente de ajuda para usuários. \r\n-PierBugFree - Monitora os possíveis erros do seu site\r\n-PierFaq - Perguntas Frequentes (cadastro de respostas as perguntas frequentes, interagindo com usuários)\r\n-PierComunicador - Ideal para realizar a conversa interna de sua empresa, time ou usuários do seu site.\r\n-PierPesquisas - Saiba a opinião de seus clientes através dos formulários de pesquisa\r\n-PierAgenda - é uma extensão para o PierGestão, como ele você consegue gerenciar sua agenda de atividades.\r\n-PierSMS - Envie mensagem de texto para celulares de seus clientes\r\n\r\n\r\n<B><RED>Componentes disponíveis</RED></B>\r\n\r\n-Aplicativo para criação de Banners;\r\n-Banner principal com troca ilimitada de imagens;\r\n-Newsletter, emails cadastrados serão salvos no banco de dados, enviados para email master;\r\n-Personalização de Logos para email de Newsletter;\r\n-Listagem de contatos e emails recebidos pela pagina CONTATO, salvos no banco de dados;\r\n-Banco de Currículos; \r\n-Divulgação de Vagas; \r\n-Cadastro de Comentários em matérias (com opção de edição e moderação para publicação);\r\n-Cadastro de Depoimentos com fotos (com opção de edição e moderação para publicação);\r\n-Cadastro \"Seja Fornecedor\" no banco de dados de acordo com as necessidades do seu negocio.\r\ne muito mais...\r\n\r\n<b><red>Aplicativos do sistema Ecommerce:</red></b>\r\n\r\n-Integrado com Mercado Livre\r\n-Carrinho de Compra;\r\n-Cadastro de Cliente;\r\n-Cadastro de Pedidos;\r\n-Acompanhamento de Pedido por Clientes e número de rastreamento dos correios;\r\n-Envio automático para cada cliente com alteração de status de pedido;\r\n-Formas de Pagamento Personalizadas;\r\n-Compartilhamento com Redes Sociais (Twitter, Facebook, Google Plus);\r\n-Menu configurável;\r\n-Busca de produtos por palavra-chave, categoria e departamento;\r\n-Integração com Pag Seguro, podendo ser utilizados diversos tipos de cartões de créditos, boletos... sem a necessidade de ter convênio com -Bancos e Operadoras de Cartões. Esses recursos são oferecidos a pessoas físicas e jurídicas;\r\n-Envio de e-mail alertando sobre novos pedidos;\r\n-Configuração da quantidade de itens na vitrine;\r\n-Cálculo de frete por pedido, produto ou peso (diretamente pelo sistema dos correios);\r\n-Frete especial para determinadas faixas de CEPs e/ou por valor total de pedido;\r\n-Produtos promocionais;\r\n-Produtos em Destaque;\r\n-Vitrine de produtos na tela inicial do site;\r\n-Configuração de \"qual item será exibido\" na vitrine;\r\n-Exibição do valor do produto parcelado na loja;\r\n-Possibilidade de controlar estoque;\r\n-Permite até 6 fotos por produtos, as thumbs (imagem reduzidas) são criadas automaticamente;\r\n-Destaque para produtos com desconto;\r\n-Destaque para produtos de lançamento;\r\n\r\n<b><red>Área Administrador Completo</red></b>\r\n\r\n-Cadastro Categoria\r\n-Cadastro Produto\r\n-Cadastramento de Forma de Pagamento Pag Seguro - Acompanhamento de Pedidos\r\n-Acompanhamento de Clientes\r\n-Possibilidade de alterar Cores, Imagens, Banner, entre outros de maneira simples\r\n-Templates de cores pré-definidos\r\n-Opção de alterar meta tags\r\n-Controle de estatística de visitas do site\r\n\r\n\r\n<b><red>Base Plataforma Purplepier Admin3.0</red></b>\r\n\r\n-Hospedagem em nosso provedor;\r\n-Site em Tecnologia PHP- HTML - JavaScript - Base de dados MySQL;\r\n-Padrão W3C;\r\n-Sistema de Gerenciamento de conteúdo;\r\n-Cadastro de contas de email ilimitado;\r\n-Interface gráfica simplificada, amigável;\r\n-Número de Páginas de Conteúdo Ilimitadas;\r\n-Integração com Redes Sociais (Facebook, Twitter, Google Plus);\r\n-Suporte por telefone/e-mail e Google Hangouts;\r\n-Relatório de uso do site (matérias publicadas, currículos cadastrados, pageviews, browsers, etc);\r\n-Estatísticas de número de visita por mês, dia e total;\r\n-Recebimento semanal de relatório de desempenho do site;\r\n-Relatório de acessos de páginas visitadas;\r\n-Cadastro para Google Analytics;\r\n-Cadastro de Gerenciador Google Tags Managers;\r\n-Cadastro de Meta Tags;\r\n-Cadastro Favicon;\r\n-Opção de habilitar ‘Indique para um amigo’\r\n-Cadastro de usuários (pessoa física ou jurídica);\r\n-Controle de usuários com Tags (administrador, colunista, cliente, parceiro, associado);\r\n-Criação de chamados ou tarefas para cada usuário interno - Intranet;\r\n-RSS Feeds (ideal para sites que terão artigos ou noticias publicadas regularmente);\r\n-Uso de aplicativo com o Facebook (Curtir e compartilhamento e publicação de matérias e produtos);\r\n-Integração de um mapa do Google;\r\n-Cópia de Banco de dados com todos seus textos e fotos;\r\n-Cópia de Banco de todo conteúdo do diretório mídia/user;\r\n-Proteção com senha para acesso ao ADMIN 3.0 (controle total do site).\r\n\r\nPara ver mais detalhes de todos os aplicativos e componentes disponíveis neste plano, você pode acessar direto o link: \r\n<a href=\"https://www.purplepier.com.br/paginasavancadas\" target= \"blank\"><RED>CLIQUE AQUI PARA TER ACESSO A TODAS AS NOSSAS PAGINAS AVANÇADAS</RED></a>', 206, 259, 'texto', 'desktop'),
(5097, 233, 0, 'valor_1', 0, 0, '2015-03-26 22:07:09', NULL, '', 206, 259, 'inteiro', 'desktop'),
(5098, 233, 0, 'centavo_1', NULL, 0, '2015-03-26 22:07:09', '', '', 206, 259, 'texto', 'desktop'),
(5099, 233, 0, 'unidade_1', NULL, 0, '2015-03-26 22:07:09', '', '', 206, 259, 'texto', 'desktop'),
(5100, 233, 0, 'frequencia_1', NULL, 0, '2015-03-26 22:07:09', '', '', 206, 259, 'texto', 'desktop'),
(5101, 233, 0, 'label_1', NULL, 0, '2015-03-26 22:07:09', '', '', 206, 259, 'texto', 'desktop'),
(5102, 233, 0, 'link_1', NULL, 0, '2015-03-26 22:07:09', '', '', 206, 259, 'texto', 'desktop'),
(5103, 233, 0, 'destaque_1', 0, 0, '2015-03-26 22:07:09', NULL, '', 206, 259, 'inteiro', 'desktop'),
(5104, 233, 0, 'titulo_2', NULL, 0, '2015-03-26 22:07:09', NULL, '', 206, 259, 'texto', 'desktop'),
(5105, 233, 0, 'subtitulo_2', NULL, 0, '2015-03-26 22:07:09', NULL, '', 206, 259, 'texto', 'desktop'),
(5106, 233, 0, 'texto_2', NULL, 0, '2015-03-26 22:07:09', NULL, '', 206, 259, 'texto', 'desktop'),
(5107, 233, 0, 'valor_2', 0, 0, '2015-03-26 22:07:09', NULL, '', 206, 259, 'inteiro', 'desktop'),
(5108, 233, 0, 'centavo_2', NULL, 0, '2015-03-26 22:07:09', '', '', 206, 259, 'texto', 'desktop'),
(5109, 233, 0, 'unidade_2', NULL, 0, '2015-03-26 22:07:09', '', '', 206, 259, 'texto', 'desktop'),
(5110, 233, 0, 'frequencia_2', NULL, 0, '2015-03-26 22:07:09', '', '', 206, 259, 'texto', 'desktop'),
(5111, 233, 0, 'label_2', NULL, 0, '2015-03-26 22:07:09', '', '', 206, 259, 'texto', 'desktop'),
(5112, 233, 0, 'link_2', NULL, 0, '2015-03-26 22:07:09', '', '', 206, 259, 'texto', 'desktop'),
(5113, 233, 0, 'destaque_2', 0, 0, '2015-03-26 22:07:09', NULL, '', 206, 259, 'inteiro', 'desktop'),
(5114, 233, 0, 'titulo_3', NULL, 0, '2015-03-26 22:07:09', NULL, '', 206, 259, 'texto', 'desktop'),
(5115, 233, 0, 'subtitulo_3', NULL, 0, '2015-03-26 22:07:09', NULL, '', 206, 259, 'texto', 'desktop'),
(5116, 233, 0, 'texto_3', NULL, 0, '2015-03-26 22:07:09', NULL, '', 206, 259, 'texto', 'desktop'),
(5117, 233, 0, 'valor_3', 0, 0, '2015-03-26 22:07:09', NULL, '', 206, 259, 'inteiro', 'desktop'),
(5118, 233, 0, 'centavo_3', NULL, 0, '2015-03-26 22:07:09', '', '', 206, 259, 'texto', 'desktop'),
(5119, 233, 0, 'unidade_3', NULL, 0, '2015-03-26 22:07:09', '', '', 206, 259, 'texto', 'desktop'),
(5120, 233, 0, 'frequencia_3', NULL, 0, '2015-03-26 22:07:09', '', '', 206, 259, 'texto', 'desktop'),
(5121, 233, 0, 'label_3', NULL, 0, '2015-03-26 22:07:09', '', '', 206, 259, 'texto', 'desktop'),
(5122, 233, 0, 'link_3', NULL, 0, '2015-03-26 22:07:09', '', '', 206, 259, 'texto', 'desktop'),
(5123, 233, 0, 'destaque_3', 0, 0, '2015-03-26 22:07:09', NULL, '', 206, 259, 'inteiro', 'desktop'),
(5124, 233, 0, 'titulo_4', NULL, 0, '2015-03-26 22:07:09', NULL, '', 206, 259, 'texto', 'desktop'),
(5125, 233, 0, 'subtitulo_4', NULL, 0, '2015-03-26 22:07:09', NULL, '', 206, 259, 'texto', 'desktop'),
(5126, 233, 0, 'texto_4', NULL, 0, '2015-03-26 22:07:09', NULL, '', 206, 259, 'texto', 'desktop'),
(5127, 233, 0, 'valor_4', 0, 0, '2015-03-26 22:07:09', NULL, '', 206, 259, 'inteiro', 'desktop'),
(5128, 233, 0, 'centavo_4', NULL, 0, '2015-03-26 22:07:09', '', '', 206, 259, 'texto', 'desktop'),
(5129, 233, 0, 'unidade_4', NULL, 0, '2015-03-26 22:07:09', '', '', 206, 259, 'texto', 'desktop'),
(5130, 233, 0, 'frequencia_4', NULL, 0, '2015-03-26 22:07:09', '', '', 206, 259, 'texto', 'desktop'),
(5131, 233, 0, 'label_4', NULL, 0, '2015-03-26 22:07:09', '', '', 206, 259, 'texto', 'desktop'),
(5132, 233, 0, 'link_4', NULL, 0, '2015-03-26 22:07:09', '', '', 206, 259, 'texto', 'desktop');
INSERT INTO `paginas_attribute` (`id`, `id_pagina`, `user_id`, `name`, `inteiro`, `number`, `estampa`, `texto`, `descricao`, `id_componente`, `id_row`, `tipo`, `plataforma`) VALUES
(5133, 233, 0, 'destaque_4', 0, 0, '2015-03-26 22:07:09', NULL, '', 206, 259, 'inteiro', 'desktop'),
(5134, 233, 0, 'cor_1', NULL, 0, '2015-03-26 22:07:09', '', '', 206, 259, 'texto', 'desktop'),
(5135, 233, 0, 'cor_2', NULL, 0, '2015-03-26 22:07:09', '', '', 206, 259, 'texto', 'desktop'),
(5136, 233, 0, 'cor_3', NULL, 0, '2015-03-26 22:07:09', '', '', 206, 259, 'texto', 'desktop'),
(5137, 233, 0, 'cor_block_1', NULL, 0, '2015-03-26 22:07:09', '', '', 206, 259, 'texto', 'desktop'),
(5138, 233, 0, 'cor_block_2', NULL, 0, '2015-03-26 22:07:09', '', '', 206, 259, 'texto', 'desktop'),
(5139, 233, 0, 'cor_block_3', NULL, 0, '2015-03-26 22:07:09', '', '', 206, 259, 'texto', 'desktop'),
(5140, 233, 0, 'cor_block_4', NULL, 0, '2015-03-26 22:07:09', '', '', 206, 259, 'texto', 'desktop'),
(5141, 233, 0, 'margin_top', 30, 0, '2015-03-26 22:07:09', NULL, '', 206, 259, 'inteiro', 'desktop'),
(5142, 233, 0, 'margin_bottom', 0, 0, '2015-03-26 22:07:09', NULL, '', 206, 259, 'inteiro', 'desktop'),
(5143, 233, 0, 'padding_top', 0, 0, '2015-03-26 22:07:09', NULL, '', 206, 259, 'inteiro', 'desktop'),
(5144, 233, 0, 'padding_bottom', 0, 0, '2015-03-26 22:07:09', NULL, '', 206, 259, 'inteiro', 'desktop'),
(5145, 233, 0, 'is_full', 0, 0, '2015-03-26 22:07:09', NULL, '', 206, 259, 'inteiro', 'desktop'),
(5146, 233, 0, 'titulo_componente', NULL, 0, '2015-03-26 22:07:09', 'Pier 1 - completo', '', 206, 259, 'texto', 'desktop'),
(5147, 233, 0, 'background_type', 0, 0, '2015-03-26 22:07:09', NULL, '', 206, 259, 'inteiro', 'desktop'),
(5148, 233, 0, 'background', NULL, 0, '2015-03-26 22:07:09', '', '', 206, 259, 'texto', 'desktop'),
(5149, 233, 0, 'qtd_blocos', 1, 0, '2015-03-26 22:21:13', NULL, '', 206, 260, 'inteiro', 'desktop'),
(5150, 233, 0, 'titulo_1', NULL, 0, '2015-03-26 22:21:13', NULL, 'Plano Pier 2 - Funcionalidades Loja Virtual', 206, 260, 'texto', 'desktop'),
(5151, 233, 0, 'subtitulo_1', NULL, 0, '2015-03-26 22:21:13', NULL, 'Ferramentas do sistema Ecommerce - Loja Virtual', 206, 260, 'texto', 'desktop'),
(5152, 233, 0, 'texto_1', NULL, 0, '2015-03-26 22:21:13', NULL, '<B><RED>Estrutura básica para loja virtual</RED></B>\r\n\r\n-Pagina Inicial (home) com opção de colocar vitrine de produtos\r\n-Pagina da Empresa - exibimos o histórico de sua empresa, com fotos e descrição de: missão, visão, valores e certificados de qualidade.\r\n-Pagina de Depoimentos\r\n-Pagina de Noticias - pode ser usado como um Blog em seu website\r\n-Pagina de contato\r\n-Pagina de políticas de venda (pagina onde explicará todo o processo de compra no website)\r\n\r\n\r\n<B><RED>Aplicativos do website disponibilizados:</RED></B>\r\n\r\n-PierGestão ERP - Sistema integrado de gestão empresarial;\r\n-PierLayout - Alteração completa em todo layout (cores fontes, cores paginas, topo, rodapé, texturas, logos, menu);\r\n-PierMaterias - Publique matérias, dicas, notícias e novidades (opção de poder receber comentários e curtidas)\r\n-PierDepoimentos - possibilidade de clientes interagirem, os depoimentos ficaram salvos no banco de dados aguardando publicação\r\n-PierProdutos - você cria/edita/remove produtos com categorias, imagens, vídeos de demonstração, detalhes, descrição, lançamentos e vitrine. \r\n-PierEcommerce - todos os aplicativos de gerenciamento para loja virtual descrito abaixo.\r\n\r\n<B><RED>Aplicativos do sistema Ecommerce:</RED></B>\r\n\r\n-Carrinho de Compra; \r\n-Cadastro de Cliente; \r\n-Cadastro de Pedidos; \r\n-Acompanhamento de Pedido por Clientes e número de rastreamento dos correios; \r\n-Envio automático para cada cliente com alteração de status de pedido; \r\n-Formas de Pagamento Personalizadas; \r\n-Compartilhamento com Redes Sociais (Twitter, Facebook, Google Plus); \r\n-Menu configurável; \r\n-Busca de produtos por palavra-chave, categoria e departamento; \r\n-Integração com Pag Seguro, podendo ser utilizados diversos tipos de cartões de créditos, boletos... sem a necessidade de ter convênio com -Bancos e Operadoras de Cartões. Esses recursos são oferecidos a pessoas físicas e jurídicas; \r\n-Envio de e-mail alertando sobre novos pedidos; \r\n-Configuração da quantidade de itens na vitrine; \r\n-Cálculo de frete por pedido, produto ou peso (diretamente pelo sistema dos correios); \r\n-Frete especial para determinadas faixas de CEPs e/ou por valor total de pedido; \r\n-Produtos promocionais; \r\n-Produtos em Destaque; \r\n-Vitrine de produtos na tela inicial do site; \r\n-Configuração de \"qual item será exibido\" na vitrine; \r\n-Exibição do valor do produto parcelado na loja; \r\n-Possibilidade de controlar estoque; \r\n-Permite até 6 fotos por produtos, as thumbs (imagem reduzidas) são criadas automaticamente; \r\n-Destaque para produtos com desconto; \r\n-Destaque para produtos de lançamento;\r\n \r\n<B><RED>Área Administrador Completo</RED></B>\r\n\r\n-Cadastro Categoria \r\n-Cadastro Produto \r\n-Cadastramento de Forma de Pagamento Pag Seguro - Acompanhamento de Pedidos \r\n-Acompanhamento de Clientes \r\n-Possibilidade de alterar Cores, Imagens, Banner, entre outros de maneira simples \r\n-Templates de cores pré-definidos \r\n-Opção de alterar meta tags \r\n-Controle de estatística de visitas do site\r\n\r\n<B><RED>Base Plataforma Purplepier Admin3.0</RED></B>\r\n\r\n-Hospedagem em nosso provedor;\r\n-Site em Tecnologia PHP- HTML - JavaScript - Base de dados MySQL;\r\n-Padrão W3C;\r\n-Sistema de Gerenciamento de conteúdo;\r\n-Cadastro de contas de email ilimitado;\r\n-Interface gráfica simplificada, amigável;\r\n-Número de Páginas de Conteúdo Ilimitadas;\r\n-Integração com Redes Sociais (Facebook, Twitter, Google Plus);\r\n-Suporte por telefone/e-mail e Google Hangouts;\r\n-Relatório de uso do site (matérias publicadas, currículos cadastrados, pageviews, browsers, etc);\r\n-Estatísticas de número de visita por mês, dia e total;\r\n-Recebimento semanal de relatório de desempenho do site;\r\n-Relatório de acessos de páginas visitadas;\r\n-Cadastro para Google Analytics;\r\n-Cadastro de Gerenciador Google Tags Managers;\r\n-Cadastro de Meta Tags;\r\n-Cadastro Favicon;\r\n-Opção de habilitar ‘Indique para um amigo’\r\n-Cadastro de usuários (pessoa física ou jurídica);\r\n-Controle de usuários com Tags (administrador, colunista, cliente, parceiro, associado);\r\n-Criação de chamados ou tarefas para cada usuário interno - Intranet;\r\n-RSS Feeds (ideal para sites que terão artigos ou noticias publicadas regularmente);\r\n-Uso de aplicativo com o Facebook (Curtir e compartilhamento e publicação de matérias e produtos);\r\n-Integração de um mapa do Google;\r\n-Cópia de Banco de dados com todos seus textos e fotos;\r\n-Cópia de Banco de todo conteúdo do diretório mídia/user;\r\n-Proteção com senha para acesso ao ADMIN 3.0 (controle total do site).\r\n\r\n<b>Este plano contém os aplicativos e componentes básicos de uma loja on line no mercado web. Contudo, ele é compatível com todos os outros aplicativos e componentes do sistema. \r\n\r\nPara a implementação dos demais recursos, basta solicitar orçamento para a liberação junto a equipe de vendas da DigitalPier. \r\n\r\nPara ver mais detalhes de todos os aplicativos e componentes disponíveis no sistema, você pode acessar direto o link:</b>\r\n<a href=\"https://www.purplepier.com.br/paginasavancadas\" target= \"blank\"><RED>CLIQUE AQUI PARA TER ACESSO A TODAS AS NOSSAS PAGINAS AVANÇADAS</RED></a>\r\n\r\n', 206, 260, 'texto', 'desktop'),
(5153, 233, 0, 'valor_1', 0, 0, '2015-03-26 22:21:13', NULL, '', 206, 260, 'inteiro', 'desktop'),
(5154, 233, 0, 'centavo_1', NULL, 0, '2015-03-26 22:21:13', '', '', 206, 260, 'texto', 'desktop'),
(5155, 233, 0, 'unidade_1', NULL, 0, '2015-03-26 22:21:13', '', '', 206, 260, 'texto', 'desktop'),
(5156, 233, 0, 'frequencia_1', NULL, 0, '2015-03-26 22:21:13', '', '', 206, 260, 'texto', 'desktop'),
(5157, 233, 0, 'label_1', NULL, 0, '2015-03-26 22:21:13', '', '', 206, 260, 'texto', 'desktop'),
(5158, 233, 0, 'link_1', NULL, 0, '2015-03-26 22:21:13', '', '', 206, 260, 'texto', 'desktop'),
(5159, 233, 0, 'destaque_1', 0, 0, '2015-03-26 22:21:13', NULL, '', 206, 260, 'inteiro', 'desktop'),
(5160, 233, 0, 'titulo_2', NULL, 0, '2015-03-26 22:21:13', NULL, '', 206, 260, 'texto', 'desktop'),
(5161, 233, 0, 'subtitulo_2', NULL, 0, '2015-03-26 22:21:13', NULL, '', 206, 260, 'texto', 'desktop'),
(5162, 233, 0, 'texto_2', NULL, 0, '2015-03-26 22:21:13', NULL, '', 206, 260, 'texto', 'desktop'),
(5163, 233, 0, 'valor_2', 0, 0, '2015-03-26 22:21:13', NULL, '', 206, 260, 'inteiro', 'desktop'),
(5164, 233, 0, 'centavo_2', NULL, 0, '2015-03-26 22:21:13', '', '', 206, 260, 'texto', 'desktop'),
(5165, 233, 0, 'unidade_2', NULL, 0, '2015-03-26 22:21:13', '', '', 206, 260, 'texto', 'desktop'),
(5166, 233, 0, 'frequencia_2', NULL, 0, '2015-03-26 22:21:13', '', '', 206, 260, 'texto', 'desktop'),
(5167, 233, 0, 'label_2', NULL, 0, '2015-03-26 22:21:13', '', '', 206, 260, 'texto', 'desktop'),
(5168, 233, 0, 'link_2', NULL, 0, '2015-03-26 22:21:13', '', '', 206, 260, 'texto', 'desktop'),
(5169, 233, 0, 'destaque_2', 0, 0, '2015-03-26 22:21:13', NULL, '', 206, 260, 'inteiro', 'desktop'),
(5170, 233, 0, 'titulo_3', NULL, 0, '2015-03-26 22:21:13', NULL, '', 206, 260, 'texto', 'desktop'),
(5171, 233, 0, 'subtitulo_3', NULL, 0, '2015-03-26 22:21:13', NULL, '', 206, 260, 'texto', 'desktop'),
(5172, 233, 0, 'texto_3', NULL, 0, '2015-03-26 22:21:13', NULL, '', 206, 260, 'texto', 'desktop'),
(5173, 233, 0, 'valor_3', 0, 0, '2015-03-26 22:21:13', NULL, '', 206, 260, 'inteiro', 'desktop'),
(5174, 233, 0, 'centavo_3', NULL, 0, '2015-03-26 22:21:13', '', '', 206, 260, 'texto', 'desktop'),
(5175, 233, 0, 'unidade_3', NULL, 0, '2015-03-26 22:21:13', '', '', 206, 260, 'texto', 'desktop'),
(5176, 233, 0, 'frequencia_3', NULL, 0, '2015-03-26 22:21:13', '', '', 206, 260, 'texto', 'desktop'),
(5177, 233, 0, 'label_3', NULL, 0, '2015-03-26 22:21:13', '', '', 206, 260, 'texto', 'desktop'),
(5178, 233, 0, 'link_3', NULL, 0, '2015-03-26 22:21:13', '', '', 206, 260, 'texto', 'desktop'),
(5179, 233, 0, 'destaque_3', 0, 0, '2015-03-26 22:21:13', NULL, '', 206, 260, 'inteiro', 'desktop'),
(5180, 233, 0, 'titulo_4', NULL, 0, '2015-03-26 22:21:13', NULL, '', 206, 260, 'texto', 'desktop'),
(5181, 233, 0, 'subtitulo_4', NULL, 0, '2015-03-26 22:21:13', NULL, '', 206, 260, 'texto', 'desktop'),
(5182, 233, 0, 'texto_4', NULL, 0, '2015-03-26 22:21:13', NULL, '', 206, 260, 'texto', 'desktop'),
(5183, 233, 0, 'valor_4', 0, 0, '2015-03-26 22:21:13', NULL, '', 206, 260, 'inteiro', 'desktop'),
(5184, 233, 0, 'centavo_4', NULL, 0, '2015-03-26 22:21:13', '', '', 206, 260, 'texto', 'desktop'),
(5185, 233, 0, 'unidade_4', NULL, 0, '2015-03-26 22:21:13', '', '', 206, 260, 'texto', 'desktop'),
(5186, 233, 0, 'frequencia_4', NULL, 0, '2015-03-26 22:21:13', '', '', 206, 260, 'texto', 'desktop'),
(5187, 233, 0, 'label_4', NULL, 0, '2015-03-26 22:21:13', '', '', 206, 260, 'texto', 'desktop'),
(5188, 233, 0, 'link_4', NULL, 0, '2015-03-26 22:21:13', '', '', 206, 260, 'texto', 'desktop'),
(5189, 233, 0, 'destaque_4', 0, 0, '2015-03-26 22:21:13', NULL, '', 206, 260, 'inteiro', 'desktop'),
(5190, 233, 0, 'cor_1', NULL, 0, '2015-03-26 22:21:13', '', '', 206, 260, 'texto', 'desktop'),
(5191, 233, 0, 'cor_2', NULL, 0, '2015-03-26 22:21:13', '', '', 206, 260, 'texto', 'desktop'),
(5192, 233, 0, 'cor_3', NULL, 0, '2015-03-26 22:21:13', '', '', 206, 260, 'texto', 'desktop'),
(5193, 233, 0, 'cor_block_1', NULL, 0, '2015-03-26 22:21:13', '', '', 206, 260, 'texto', 'desktop'),
(5194, 233, 0, 'cor_block_2', NULL, 0, '2015-03-26 22:21:13', '', '', 206, 260, 'texto', 'desktop'),
(5195, 233, 0, 'cor_block_3', NULL, 0, '2015-03-26 22:21:13', '', '', 206, 260, 'texto', 'desktop'),
(5196, 233, 0, 'cor_block_4', NULL, 0, '2015-03-26 22:21:13', '', '', 206, 260, 'texto', 'desktop'),
(5197, 233, 0, 'margin_top', 30, 0, '2015-03-26 22:21:13', NULL, '', 206, 260, 'inteiro', 'desktop'),
(5198, 233, 0, 'margin_bottom', 0, 0, '2015-03-26 22:21:13', NULL, '', 206, 260, 'inteiro', 'desktop'),
(5199, 233, 0, 'padding_top', 0, 0, '2015-03-26 22:21:13', NULL, '', 206, 260, 'inteiro', 'desktop'),
(5200, 233, 0, 'padding_bottom', 0, 0, '2015-03-26 22:21:13', NULL, '', 206, 260, 'inteiro', 'desktop'),
(5201, 233, 0, 'is_full', 0, 0, '2015-03-26 22:21:13', NULL, '', 206, 260, 'inteiro', 'desktop'),
(5202, 233, 0, 'titulo_componente', NULL, 0, '2015-03-26 22:21:13', 'Pier 2 - Loja Virtual', '', 206, 260, 'texto', 'desktop'),
(5203, 233, 0, 'background_type', 0, 0, '2015-03-26 22:21:13', NULL, '', 206, 260, 'inteiro', 'desktop'),
(5204, 233, 0, 'background', NULL, 0, '2015-03-26 22:21:13', '', '', 206, 260, 'texto', 'desktop'),
(5205, 233, 0, 'qtd_blocos', 1, 0, '2015-03-26 22:29:44', NULL, '', 206, 261, 'inteiro', 'desktop'),
(5206, 233, 0, 'titulo_1', NULL, 0, '2015-03-26 22:29:44', NULL, 'Plano Pier 3 - Funcionalidades para Website', 206, 261, 'texto', 'desktop'),
(5207, 233, 0, 'subtitulo_1', NULL, 0, '2015-03-26 22:29:44', NULL, 'Plano com estrutura básica para website', 206, 261, 'texto', 'desktop'),
(5208, 233, 0, 'texto_1', NULL, 0, '2015-03-26 22:29:44', NULL, '<b><red>Estrutura básica disponibilizada</red></b>\r\n\r\n-Pagina Inicial (home) \r\n-Pagina da Empresa - exibimos o histórico de sua empresa, com fotos e descrição de: missão, visão, valores e certificados de qualidade.\r\n-Pagina de exibição de produtos ou serviços\r\n-Pagina de Depoimentos\r\n-Pagina de Noticias - pode ser usado como um Blog em seu website\r\n-Pagina de contato com mapa do Google Maps\r\n\r\n<b><red>Aplicativos disponibilizados:</red></b>\r\n\r\n-PierGestão ERP - Sistema integrado de gestão empresarial;\r\n-PierLayout - Alteração completa em todo layout (cores fontes, cores paginas, topo, rodapé, texturas, logos, menu);\r\n-PierMaterias - Publique matérias, dicas, notícias e novidades (opção de poder receber comentários e curtidas)\r\n-PierDepoimentos - possibilidade de clientes interagirem, os depoimentos ficaram salvos no banco de dados aguardando publicação\r\n\r\n<B><RED>Base Plataforma Purplepier Admin3.0</RED></B>\r\n\r\n-Hospedagem em nosso provedor;\r\n-Site em Tecnologia PHP- HTML - JavaScript - Base de dados MySQL;\r\n-Padrão W3C;\r\n-Sistema de Gerenciamento de conteúdo;\r\n-Cadastro de contas de email ilimitado;\r\n-Interface gráfica simplificada, amigável;\r\n-Integração com Redes Sociais (Facebook, Twitter, Google Plus);\r\n-Suporte por telefone/e-mail e Google Hangouts;\r\n-Relatório de uso do site (matérias publicadas, currículos cadastrados, pageviews, browsers, etc);\r\n-Estatísticas de número de visita por mês, dia e total;\r\n-Recebimento semanal de relatório de desempenho do site;\r\n-Relatório de acessos de páginas visitadas;\r\n-Cadastro para Google Analytics;\r\n-Cadastro de Gerenciador Google Tags Managers;\r\n-Cadastro de Meta Tags;\r\n-Cadastro Favicon;\r\n-Opção de habilitar ‘Indique para um amigo’\r\n-Cadastro de usuários (pessoa física ou jurídica);\r\n-Controle de usuários com Tags (administrador, colunista, cliente, parceiro, associado);\r\n-Criação de chamados ou tarefas para cada usuário interno - Intranet;\r\n-RSS Feeds (ideal para sites que terão artigos ou noticias publicadas regularmente);\r\n-Uso de aplicativo com o Facebook (Curtir e compartilhamento e publicação de matérias e produtos);\r\n-Integração de um mapa do Google;\r\n-Cópia de Banco de dados com todos seus textos e fotos;\r\n-Cópia de Banco de todo conteúdo do diretório mídia/user;\r\n-Proteção com senha para acesso ao ADMIN 3.0 (controle total do site).\r\n\r\n<b>Este plano contém os aplicativos e componentes básicos para exibição de website. Contudo, ele é compatível com todos os outros aplicativos e componentes do sistema. <red>Também aceita a implementação da Plataforma Responsiva.</red>\r\n\r\nPara a implementação dos demais recursos, basta solicitar orçamento para a liberação junto a equipe de vendas da DigitalPier.\r\n\r\nPara ver mais detalhes de todos os aplicativos e componentes disponíveis no sistema, você pode acessar direto o link:</b>\r\n<a href=\"https://www.purplepier.com.br/paginasavancadas\" target= \"blank\"><RED>CLIQUE AQUI PARA TER ACESSO A TODAS AS NOSSAS PAGINAS AVANÇADAS</RED></a>\r\n', 206, 261, 'texto', 'desktop'),
(5209, 233, 0, 'valor_1', 0, 0, '2015-03-26 22:29:45', NULL, '', 206, 261, 'inteiro', 'desktop'),
(5210, 233, 0, 'centavo_1', NULL, 0, '2015-03-26 22:29:45', '', '', 206, 261, 'texto', 'desktop'),
(5211, 233, 0, 'unidade_1', NULL, 0, '2015-03-26 22:29:45', '', '', 206, 261, 'texto', 'desktop'),
(5212, 233, 0, 'frequencia_1', NULL, 0, '2015-03-26 22:29:45', '', '', 206, 261, 'texto', 'desktop'),
(5213, 233, 0, 'label_1', NULL, 0, '2015-03-26 22:29:45', '', '', 206, 261, 'texto', 'desktop'),
(5214, 233, 0, 'link_1', NULL, 0, '2015-03-26 22:29:45', '', '', 206, 261, 'texto', 'desktop'),
(5215, 233, 0, 'destaque_1', 0, 0, '2015-03-26 22:29:46', NULL, '', 206, 261, 'inteiro', 'desktop'),
(5216, 233, 0, 'titulo_2', NULL, 0, '2015-03-26 22:29:46', NULL, '', 206, 261, 'texto', 'desktop'),
(5217, 233, 0, 'subtitulo_2', NULL, 0, '2015-03-26 22:29:46', NULL, '', 206, 261, 'texto', 'desktop'),
(5218, 233, 0, 'texto_2', NULL, 0, '2015-03-26 22:29:47', NULL, '', 206, 261, 'texto', 'desktop'),
(5219, 233, 0, 'valor_2', 0, 0, '2015-03-26 22:29:47', NULL, '', 206, 261, 'inteiro', 'desktop'),
(5220, 233, 0, 'centavo_2', NULL, 0, '2015-03-26 22:29:47', '', '', 206, 261, 'texto', 'desktop'),
(5221, 233, 0, 'unidade_2', NULL, 0, '2015-03-26 22:29:47', '', '', 206, 261, 'texto', 'desktop'),
(5222, 233, 0, 'frequencia_2', NULL, 0, '2015-03-26 22:29:47', '', '', 206, 261, 'texto', 'desktop'),
(5223, 233, 0, 'label_2', NULL, 0, '2015-03-26 22:29:47', '', '', 206, 261, 'texto', 'desktop'),
(5224, 233, 0, 'link_2', NULL, 0, '2015-03-26 22:29:47', '', '', 206, 261, 'texto', 'desktop'),
(5225, 233, 0, 'destaque_2', 0, 0, '2015-03-26 22:29:48', NULL, '', 206, 261, 'inteiro', 'desktop'),
(5226, 233, 0, 'titulo_3', NULL, 0, '2015-03-26 22:29:48', NULL, '', 206, 261, 'texto', 'desktop'),
(5227, 233, 0, 'subtitulo_3', NULL, 0, '2015-03-26 22:29:48', NULL, '', 206, 261, 'texto', 'desktop'),
(5228, 233, 0, 'texto_3', NULL, 0, '2015-03-26 22:29:48', NULL, '', 206, 261, 'texto', 'desktop'),
(5229, 233, 0, 'valor_3', 0, 0, '2015-03-26 22:29:48', NULL, '', 206, 261, 'inteiro', 'desktop'),
(5230, 233, 0, 'centavo_3', NULL, 0, '2015-03-26 22:29:48', '', '', 206, 261, 'texto', 'desktop'),
(5231, 233, 0, 'unidade_3', NULL, 0, '2015-03-26 22:29:49', '', '', 206, 261, 'texto', 'desktop'),
(5232, 233, 0, 'frequencia_3', NULL, 0, '2015-03-26 22:29:49', '', '', 206, 261, 'texto', 'desktop'),
(5233, 233, 0, 'label_3', NULL, 0, '2015-03-26 22:29:49', '', '', 206, 261, 'texto', 'desktop'),
(5234, 233, 0, 'link_3', NULL, 0, '2015-03-26 22:29:49', '', '', 206, 261, 'texto', 'desktop'),
(5235, 233, 0, 'destaque_3', 0, 0, '2015-03-26 22:29:50', NULL, '', 206, 261, 'inteiro', 'desktop'),
(5236, 233, 0, 'titulo_4', NULL, 0, '2015-03-26 22:29:50', NULL, '', 206, 261, 'texto', 'desktop'),
(5237, 233, 0, 'subtitulo_4', NULL, 0, '2015-03-26 22:29:50', NULL, '', 206, 261, 'texto', 'desktop'),
(5238, 233, 0, 'texto_4', NULL, 0, '2015-03-26 22:29:50', NULL, '', 206, 261, 'texto', 'desktop'),
(5239, 233, 0, 'valor_4', 0, 0, '2015-03-26 22:29:50', NULL, '', 206, 261, 'inteiro', 'desktop'),
(5240, 233, 0, 'centavo_4', NULL, 0, '2015-03-26 22:29:51', '', '', 206, 261, 'texto', 'desktop'),
(5241, 233, 0, 'unidade_4', NULL, 0, '2015-03-26 22:29:51', '', '', 206, 261, 'texto', 'desktop'),
(5242, 233, 0, 'frequencia_4', NULL, 0, '2015-03-26 22:29:51', '', '', 206, 261, 'texto', 'desktop'),
(5243, 233, 0, 'label_4', NULL, 0, '2015-03-26 22:29:51', '', '', 206, 261, 'texto', 'desktop'),
(5244, 233, 0, 'link_4', NULL, 0, '2015-03-26 22:29:51', '', '', 206, 261, 'texto', 'desktop'),
(5245, 233, 0, 'destaque_4', 0, 0, '2015-03-26 22:29:52', NULL, '', 206, 261, 'inteiro', 'desktop'),
(5246, 233, 0, 'cor_1', NULL, 0, '2015-03-26 22:29:52', '', '', 206, 261, 'texto', 'desktop'),
(5247, 233, 0, 'cor_2', NULL, 0, '2015-03-26 22:29:52', '', '', 206, 261, 'texto', 'desktop'),
(5248, 233, 0, 'cor_3', NULL, 0, '2015-03-26 22:29:52', '', '', 206, 261, 'texto', 'desktop'),
(5249, 233, 0, 'cor_block_1', NULL, 0, '2015-03-26 22:29:52', '', '', 206, 261, 'texto', 'desktop'),
(5250, 233, 0, 'cor_block_2', NULL, 0, '2015-03-26 22:29:52', '', '', 206, 261, 'texto', 'desktop'),
(5251, 233, 0, 'cor_block_3', NULL, 0, '2015-03-26 22:29:52', '', '', 206, 261, 'texto', 'desktop'),
(5252, 233, 0, 'cor_block_4', NULL, 0, '2015-03-26 22:29:52', '', '', 206, 261, 'texto', 'desktop'),
(5253, 233, 0, 'margin_top', 30, 0, '2015-03-26 22:29:52', NULL, '', 206, 261, 'inteiro', 'desktop'),
(5254, 233, 0, 'margin_bottom', 0, 0, '2015-03-26 22:29:52', NULL, '', 206, 261, 'inteiro', 'desktop'),
(5255, 233, 0, 'padding_top', 0, 0, '2015-03-26 22:29:53', NULL, '', 206, 261, 'inteiro', 'desktop'),
(5256, 233, 0, 'padding_bottom', 0, 0, '2015-03-26 22:29:53', NULL, '', 206, 261, 'inteiro', 'desktop'),
(5257, 233, 0, 'is_full', 0, 0, '2015-03-26 22:29:53', NULL, '', 206, 261, 'inteiro', 'desktop'),
(5258, 233, 0, 'titulo_componente', NULL, 0, '2015-03-26 22:29:53', 'Pier 3 - website estrutura básica ', '', 206, 261, 'texto', 'desktop'),
(5259, 233, 0, 'background_type', 0, 0, '2015-03-26 22:29:53', NULL, '', 206, 261, 'inteiro', 'desktop'),
(5260, 233, 0, 'background', NULL, 0, '2015-03-26 22:29:53', '', '', 206, 261, 'texto', 'desktop'),
(5261, 233, 0, 'qtd_blocos', 1, 0, '2015-03-26 22:50:48', NULL, '', 206, 262, 'inteiro', 'desktop'),
(5262, 233, 0, 'titulo_1', NULL, 0, '2015-03-26 22:50:49', NULL, 'Plano Pier 4 - Funcionalidades para o Mini Site ', 206, 262, 'texto', 'desktop'),
(5263, 233, 0, 'subtitulo_1', NULL, 0, '2015-03-26 22:50:49', NULL, 'Funcionalidades do sistema Pier Mini Site ', 206, 262, 'texto', 'desktop'),
(5264, 233, 0, 'texto_1', NULL, 0, '2015-03-26 22:50:49', NULL, 'Este plano é ideal para empresas que já possuem toda identidade visual criada. Isso inclui, imagens para banner principal do website, imagens de produtos, logotipo, etc. Também todo conteúdo descritivo do website.\r\n\r\nEstrutura básica do website:\r\n\r\n-Pagina Inicial (home)\r\n-Pagina da Empresa - exibimos o histórico de sua empresa, com fotos e descrição de: missão, visão, valores e certificados de qualidade.\r\n-Pagina de contato\r\n-Hospedagem em nosso provedor;\r\n-Cadastro de 1 conta de email;\r\n-Cadastro Favicon;\r\n-Suporte por telefone/e-mail e Google Hangouts; \r\n\r\nOs sites não contém Gerenciamento de Conteúdo. Toda e qualquer alteração no website será necessária a contratação dos nossos serviços.\r\n\r\n<b>Este plano contém os aplicativos e componentes básicos para exibição de website. Contudo, ele é compatível com todos os outros aplicativos e componentes do sistema. <red>Também aceita a implementação da Plataforma Responsiva.</red>\r\n\r\nPara a implementação dos demais recursos, basta solicitar orçamento para a liberação junto a equipe de vendas da DigitalPier.\r\n\r\nPara ver mais detalhes de todos os aplicativos e componentes disponíveis no sistema, você pode acessar direto o link:</b>\r\n<a href=\"https://www.purplepier.com.br/paginasavancadas\" target= \"blank\"><RED>CLIQUE AQUI PARA TER ACESSO A TODAS AS NOSSAS PAGINAS AVANÇADAS</RED></a>\r\n', 206, 262, 'texto', 'desktop'),
(5265, 233, 0, 'valor_1', 0, 0, '2015-03-26 22:50:49', NULL, '', 206, 262, 'inteiro', 'desktop'),
(5266, 233, 0, 'centavo_1', NULL, 0, '2015-03-26 22:50:49', '', '', 206, 262, 'texto', 'desktop'),
(5267, 233, 0, 'unidade_1', NULL, 0, '2015-03-26 22:50:50', '', '', 206, 262, 'texto', 'desktop'),
(5268, 233, 0, 'frequencia_1', NULL, 0, '2015-03-26 22:50:50', '', '', 206, 262, 'texto', 'desktop'),
(5269, 233, 0, 'label_1', NULL, 0, '2015-03-26 22:50:50', '', '', 206, 262, 'texto', 'desktop'),
(5270, 233, 0, 'link_1', NULL, 0, '2015-03-26 22:50:50', '', '', 206, 262, 'texto', 'desktop'),
(5271, 233, 0, 'destaque_1', 0, 0, '2015-03-26 22:50:50', NULL, '', 206, 262, 'inteiro', 'desktop'),
(5272, 233, 0, 'titulo_2', NULL, 0, '2015-03-26 22:50:50', NULL, '', 206, 262, 'texto', 'desktop'),
(5273, 233, 0, 'subtitulo_2', NULL, 0, '2015-03-26 22:50:50', NULL, '', 206, 262, 'texto', 'desktop'),
(5274, 233, 0, 'texto_2', NULL, 0, '2015-03-26 22:50:50', NULL, '', 206, 262, 'texto', 'desktop'),
(5275, 233, 0, 'valor_2', 0, 0, '2015-03-26 22:50:51', NULL, '', 206, 262, 'inteiro', 'desktop'),
(5276, 233, 0, 'centavo_2', NULL, 0, '2015-03-26 22:50:51', '', '', 206, 262, 'texto', 'desktop'),
(5277, 233, 0, 'unidade_2', NULL, 0, '2015-03-26 22:50:52', '', '', 206, 262, 'texto', 'desktop'),
(5278, 233, 0, 'frequencia_2', NULL, 0, '2015-03-26 22:50:52', '', '', 206, 262, 'texto', 'desktop'),
(5279, 233, 0, 'label_2', NULL, 0, '2015-03-26 22:50:52', '', '', 206, 262, 'texto', 'desktop'),
(5280, 233, 0, 'link_2', NULL, 0, '2015-03-26 22:50:52', '', '', 206, 262, 'texto', 'desktop'),
(5281, 233, 0, 'destaque_2', 0, 0, '2015-03-26 22:50:52', NULL, '', 206, 262, 'inteiro', 'desktop'),
(5282, 233, 0, 'titulo_3', NULL, 0, '2015-03-26 22:50:53', NULL, '', 206, 262, 'texto', 'desktop'),
(5283, 233, 0, 'subtitulo_3', NULL, 0, '2015-03-26 22:50:53', NULL, '', 206, 262, 'texto', 'desktop'),
(5284, 233, 0, 'texto_3', NULL, 0, '2015-03-26 22:50:53', NULL, '', 206, 262, 'texto', 'desktop'),
(5285, 233, 0, 'valor_3', 0, 0, '2015-03-26 22:50:53', NULL, '', 206, 262, 'inteiro', 'desktop'),
(5286, 233, 0, 'centavo_3', NULL, 0, '2015-03-26 22:50:54', '', '', 206, 262, 'texto', 'desktop'),
(5287, 233, 0, 'unidade_3', NULL, 0, '2015-03-26 22:50:54', '', '', 206, 262, 'texto', 'desktop'),
(5288, 233, 0, 'frequencia_3', NULL, 0, '2015-03-26 22:50:54', '', '', 206, 262, 'texto', 'desktop'),
(5289, 233, 0, 'label_3', NULL, 0, '2015-03-26 22:50:54', '', '', 206, 262, 'texto', 'desktop'),
(5290, 233, 0, 'link_3', NULL, 0, '2015-03-26 22:50:54', '', '', 206, 262, 'texto', 'desktop'),
(5291, 233, 0, 'destaque_3', 0, 0, '2015-03-26 22:50:54', NULL, '', 206, 262, 'inteiro', 'desktop'),
(5292, 233, 0, 'titulo_4', NULL, 0, '2015-03-26 22:50:54', NULL, '', 206, 262, 'texto', 'desktop'),
(5293, 233, 0, 'subtitulo_4', NULL, 0, '2015-03-26 22:50:54', NULL, '', 206, 262, 'texto', 'desktop'),
(5294, 233, 0, 'texto_4', NULL, 0, '2015-03-26 22:50:55', NULL, '', 206, 262, 'texto', 'desktop'),
(5295, 233, 0, 'valor_4', 0, 0, '2015-03-26 22:50:55', NULL, '', 206, 262, 'inteiro', 'desktop'),
(5296, 233, 0, 'centavo_4', NULL, 0, '2015-03-26 22:50:55', '', '', 206, 262, 'texto', 'desktop'),
(5297, 233, 0, 'unidade_4', NULL, 0, '2015-03-26 22:50:55', '', '', 206, 262, 'texto', 'desktop'),
(5298, 233, 0, 'frequencia_4', NULL, 0, '2015-03-26 22:50:55', '', '', 206, 262, 'texto', 'desktop'),
(5299, 233, 0, 'label_4', NULL, 0, '2015-03-26 22:50:56', '', '', 206, 262, 'texto', 'desktop'),
(5300, 233, 0, 'link_4', NULL, 0, '2015-03-26 22:50:56', '', '', 206, 262, 'texto', 'desktop'),
(5301, 233, 0, 'destaque_4', 0, 0, '2015-03-26 22:50:56', NULL, '', 206, 262, 'inteiro', 'desktop'),
(5302, 233, 0, 'cor_1', NULL, 0, '2015-03-26 22:50:56', '', '', 206, 262, 'texto', 'desktop'),
(5303, 233, 0, 'cor_2', NULL, 0, '2015-03-26 22:50:57', '', '', 206, 262, 'texto', 'desktop'),
(5304, 233, 0, 'cor_3', NULL, 0, '2015-03-26 22:50:57', '', '', 206, 262, 'texto', 'desktop'),
(5305, 233, 0, 'cor_block_1', NULL, 0, '2015-03-26 22:50:57', '', '', 206, 262, 'texto', 'desktop'),
(5306, 233, 0, 'cor_block_2', NULL, 0, '2015-03-26 22:50:57', '', '', 206, 262, 'texto', 'desktop'),
(5307, 233, 0, 'cor_block_3', NULL, 0, '2015-03-26 22:50:58', '', '', 206, 262, 'texto', 'desktop'),
(5308, 233, 0, 'cor_block_4', NULL, 0, '2015-03-26 22:50:58', '', '', 206, 262, 'texto', 'desktop'),
(5309, 233, 0, 'margin_top', 30, 0, '2015-03-26 22:50:59', NULL, '', 206, 262, 'inteiro', 'desktop'),
(5310, 233, 0, 'margin_bottom', 0, 0, '2015-03-26 22:50:59', NULL, '', 206, 262, 'inteiro', 'desktop'),
(5311, 233, 0, 'padding_top', 0, 0, '2015-03-26 22:50:59', NULL, '', 206, 262, 'inteiro', 'desktop'),
(5312, 233, 0, 'padding_bottom', 0, 0, '2015-03-26 22:50:59', NULL, '', 206, 262, 'inteiro', 'desktop'),
(5313, 233, 0, 'is_full', 0, 0, '2015-03-26 22:51:00', NULL, '', 206, 262, 'inteiro', 'desktop'),
(5314, 233, 0, 'titulo_componente', NULL, 0, '2015-03-26 22:51:00', 'Pier 4 - Mini Site ', '', 206, 262, 'texto', 'desktop'),
(5315, 233, 0, 'background_type', 0, 0, '2015-03-26 22:51:00', NULL, '', 206, 262, 'inteiro', 'desktop'),
(5316, 233, 0, 'background', NULL, 0, '2015-03-26 22:51:00', '', '', 206, 262, 'texto', 'desktop'),
(5317, 220, 0, 'titulo_1', NULL, 0, '2015-04-01 16:15:38', NULL, 'Registro de domínios', 367, 263, 'texto', 'desktop'),
(5318, 220, 0, 'subtitulo_1', NULL, 0, '2015-04-01 16:15:38', NULL, 'Confira se o domínio que você deseja está disponível para registro', 367, 263, 'texto', 'desktop'),
(5319, 220, 0, 'texto_1', NULL, 0, '2015-04-01 16:15:38', NULL, '', 367, 263, 'texto', 'desktop'),
(5320, 220, 0, 'link_1', NULL, 0, '2015-04-01 16:15:38', NULL, '', 367, 263, 'texto', 'desktop'),
(5321, 220, 0, 'link_target_1', NULL, 0, '2015-04-01 16:15:38', '_self', '', 367, 263, 'texto', 'desktop'),
(5322, 220, 0, 'image_1', NULL, 0, '2015-04-01 16:15:38', '', '', 367, 263, 'texto', 'desktop'),
(5323, 220, 0, 'layout_1', NULL, 0, '2015-04-01 16:15:38', 'up', '', 367, 263, 'texto', 'desktop'),
(5324, 220, 0, 'cor_1', NULL, 0, '2015-04-01 16:15:38', '', '', 367, 263, 'texto', 'desktop'),
(5325, 220, 0, 'cor_2', NULL, 0, '2015-04-01 16:15:38', '', '', 367, 263, 'texto', 'desktop'),
(5326, 220, 0, 'cor_3', NULL, 0, '2015-04-01 16:15:38', '', '', 367, 263, 'texto', 'desktop'),
(5327, 220, 0, 'alinhamento_1', NULL, 0, '2015-04-01 16:15:38', 'center', '', 367, 263, 'texto', 'desktop'),
(5328, 220, 0, 'alinhamento_2', NULL, 0, '2015-04-01 16:15:38', 'center', '', 367, 263, 'texto', 'desktop'),
(5329, 220, 0, 'alinhamento_3', NULL, 0, '2015-04-01 16:15:38', 'left', '', 367, 263, 'texto', 'desktop'),
(5330, 220, 0, 'margin_top', 20, 0, '2015-04-01 16:15:38', NULL, '', 367, 263, 'inteiro', 'desktop'),
(5331, 220, 0, 'margin_bottom', 30, 0, '2015-04-01 16:15:38', NULL, '', 367, 263, 'inteiro', 'desktop'),
(5332, 220, 0, 'padding_top', 0, 0, '2015-04-01 16:15:38', NULL, '', 367, 263, 'inteiro', 'desktop'),
(5333, 220, 0, 'padding_bottom', 0, 0, '2015-04-01 16:15:38', NULL, '', 367, 263, 'inteiro', 'desktop'),
(5334, 220, 0, 'is_full', 0, 0, '2015-04-01 16:15:38', NULL, '', 367, 263, 'inteiro', 'desktop'),
(5335, 220, 0, 'titulo_componente', NULL, 0, '2015-04-01 16:15:38', 'Regsitro', '', 367, 263, 'texto', 'desktop'),
(5336, 220, 0, 'background_type', 0, 0, '2015-04-01 16:15:38', NULL, '', 367, 263, 'inteiro', 'desktop'),
(5337, 220, 0, 'background', NULL, 0, '2015-04-01 16:15:38', '', '', 367, 263, 'texto', 'desktop'),
(5338, 234, 0, 'dc_date', NULL, 0, NULL, '2015-04-01', '', 0, 0, '0', '0'),
(5339, 234, 0, 'dc_title', NULL, 0, NULL, 'Crie seu site', '', 0, 0, '0', '0'),
(5340, 234, 0, 'dc_lastupdate', NULL, 0, NULL, '2015-04-01', '', 0, 0, '0', '0'),
(5341, 237, 0, 'dc_title', NULL, 0, NULL, 'Orçamento', '', 0, 0, '0', '0'),
(5342, 237, 0, 'dc_lastupdate', NULL, 0, NULL, '2015-04-01', '', 0, 0, '0', '0'),
(5343, 234, 0, 'gel_fr_initial', NULL, 0, NULL, NULL, 'Preencha os dados abaixo para orçar', 0, 0, '0', '0'),
(5344, 216, 0, 'gel_fr_initial', NULL, 0, NULL, NULL, 'Peça seu orçamento aqui!', 0, 0, '0', '0'),
(5345, 248, 340, 'dc_title', NULL, 0, NULL, 'Um Pier Digital especial para você', '', 0, 0, '0', '0'),
(5346, 248, 340, 'dc_lastupdate', NULL, 0, NULL, '2015-04-02', '', 0, 0, '0', '0'),
(5347, 219, 229, 'dc_title', NULL, 0, NULL, 'Tire suas dúvidas e entre em contato', '', 0, 0, '0', '0'),
(5348, 219, 229, 'dc_lastupdate', NULL, 0, NULL, '2015-04-06', '', 0, 0, '0', '0'),
(5349, 229, 229, 'dc_title', NULL, 0, NULL, 'Planos de Hospedagem', '', 0, 0, '0', '0'),
(5350, 229, 229, 'dc_lastupdate', NULL, 0, NULL, '2015-04-07', '', 0, 0, '0', '0'),
(5351, 228, 229, 'dc_title', NULL, 0, NULL, 'Segunda via do Boleto', '', 0, 0, '0', '0'),
(5352, 228, 229, 'dc_lastupdate', NULL, 0, NULL, '2015-04-06', '', 0, 0, '0', '0'),
(5353, 227, 229, 'dc_title', NULL, 0, NULL, 'Imprima seu boleto', '', 0, 0, '0', '0'),
(5354, 227, 229, 'dc_lastupdate', NULL, 0, NULL, '2015-04-06', '', 0, 0, '0', '0'),
(5355, 219, 229, 'dc_description', NULL, 0, NULL, NULL, 'contato, telefone', 0, 0, '0', '0'),
(5356, 219, 229, 'ctt_company_name', NULL, 0, NULL, 'HostMais LTDA', '', 0, 0, '0', '0'),
(5357, 219, 229, 'ctt_address', NULL, 0, NULL, NULL, 'Av. Benedito Storani, 1.314', 0, 0, '0', '0'),
(5358, 219, 229, 'ctt_tel_1', NULL, 0, NULL, '(19) 3826-4110', '', 0, 0, '0', '0'),
(5359, 219, 229, 'ctt_cidade', NULL, 0, NULL, 'Vinhedo', '', 0, 0, '0', '0'),
(5360, 219, 229, 'ctt_estado', NULL, 0, NULL, 'SP', '', 0, 0, '0', '0'),
(5361, 219, 229, 'ctt_site', NULL, 0, NULL, 'www.hostmais.com.br', '', 0, 0, '0', '0'),
(5362, 219, 229, 'gel_fr_initial', NULL, 0, NULL, NULL, 'Entre em contato', 0, 0, '0', '0'),
(5363, 222, 229, 'dc_title', NULL, 0, NULL, 'A EMpresa', '', 0, 0, '0', '0'),
(5364, 222, 229, 'dc_lastupdate', NULL, 0, NULL, '2015-04-07', '', 0, 0, '0', '0'),
(5365, 217, 229, 'dc_title', NULL, 0, NULL, 'Nossa missão e visão', '', 0, 0, '0', '0'),
(5366, 217, 229, 'dc_lastupdate', NULL, 0, NULL, '2015-04-07', '', 0, 0, '0', '0'),
(5367, 234, 229, 'dc_title', NULL, 0, NULL, 'Crie seu site', '', 0, 0, '0', '0'),
(5368, 234, 229, 'dc_lastupdate', NULL, 0, NULL, '2015-04-07', '', 0, 0, '0', '0'),
(5369, 226, 229, 'dc_title', NULL, 0, NULL, 'Veja as perguntas frequentes', '', 0, 0, '0', '0'),
(5370, 226, 229, 'dc_lastupdate', NULL, 0, NULL, '2015-04-07', '', 0, 0, '0', '0'),
(5371, 249, 0, 'dc_date', NULL, 0, NULL, '2015-04-09', '', 0, 0, '0', '0'),
(5372, 249, 0, 'dc_title', NULL, 0, NULL, 'PierPlayground', '', 0, 0, '0', '0'),
(5373, 249, 0, 'dc_lastupdate', NULL, 0, NULL, '2015-04-09', '', 0, 0, '0', '0'),
(5374, 249, 0, 'titulo_1', NULL, 0, '2015-04-09 12:36:34', NULL, 'O que é o Playground?', 186, 264, 'texto', 'desktop'),
(5375, 249, 0, 'subtitulo_1', NULL, 0, '2015-04-09 12:36:34', NULL, 'Uma ferramenta especial para você criar e editar suas imagens', 186, 264, 'texto', 'desktop'),
(5376, 249, 0, 'texto_1', NULL, 0, '2015-04-09 12:36:34', NULL, 'O Playground ou PierPlayground é uma ferramenta exclusiva PurplePier para você criar ou editar suas imagens.\r\nCom ele você pode criar suas imagens ou editar alguma que você já possui, mudando tamanho, adicionando textos, adesivos, filtros do Instagram e etc.\r\n\r\nTodas as imagens ficam salvas no seu banco de dados e podem ser utilizadas em qualquer parte do seu site.\r\nCom o Playground você pode criar banners, capas de Facebook, avatares, imagens para seu e-mail marketing e muitas outras imagens basta trocar o tamanho no topo da ferramenta', 186, 264, 'texto', 'desktop'),
(5377, 249, 0, 'label_1', NULL, 0, '2015-04-09 12:36:34', '', '', 186, 264, 'texto', 'desktop'),
(5378, 249, 0, 'link_1', NULL, 0, '2015-04-09 12:36:34', NULL, '', 186, 264, 'texto', 'desktop'),
(5379, 249, 0, 'image_1', NULL, 0, '2015-04-09 12:36:34', 'playground1_p8.jpg', '', 186, 264, 'texto', 'desktop'),
(5380, 249, 0, 'layout_1', NULL, 0, '2015-04-09 12:36:34', 'left', '', 186, 264, 'texto', 'desktop'),
(5381, 249, 0, 'cor_1', NULL, 0, '2015-04-09 12:36:35', '', '', 186, 264, 'texto', 'desktop'),
(5382, 249, 0, 'cor_2', NULL, 0, '2015-04-09 12:36:35', '', '', 186, 264, 'texto', 'desktop'),
(5383, 249, 0, 'cor_3', NULL, 0, '2015-04-09 12:36:35', '', '', 186, 264, 'texto', 'desktop'),
(5384, 249, 0, 'alinhamento_1', NULL, 0, '2015-04-09 12:36:35', 'left', '', 186, 264, 'texto', 'desktop'),
(5385, 249, 0, 'alinhamento_2', NULL, 0, '2015-04-09 12:36:35', 'left', '', 186, 264, 'texto', 'desktop'),
(5386, 249, 0, 'alinhamento_3', NULL, 0, '2015-04-09 12:36:35', 'left', '', 186, 264, 'texto', 'desktop'),
(5387, 249, 0, 'margin_top', 20, 0, '2015-04-09 12:36:35', NULL, '', 186, 264, 'inteiro', 'desktop'),
(5388, 249, 0, 'margin_bottom', 30, 0, '2015-04-09 12:36:35', NULL, '', 186, 264, 'inteiro', 'desktop'),
(5389, 249, 0, 'padding_top', 0, 0, '2015-04-09 12:36:35', NULL, '', 186, 264, 'inteiro', 'desktop'),
(5390, 249, 0, 'padding_bottom', 0, 0, '2015-04-09 12:36:35', NULL, '', 186, 264, 'inteiro', 'desktop'),
(5391, 249, 0, 'is_full', 0, 0, '2015-04-09 12:36:35', NULL, '', 186, 264, 'inteiro', 'desktop'),
(5392, 249, 0, 'titulo_componente', NULL, 0, '2015-04-09 12:36:36', 'O que é', '', 186, 264, 'texto', 'desktop'),
(5393, 249, 0, 'background_type', 0, 0, '2015-04-09 12:36:36', NULL, '', 186, 264, 'inteiro', 'desktop'),
(5394, 249, 0, 'background', NULL, 0, '2015-04-09 12:36:36', '', '', 186, 264, 'texto', 'desktop'),
(5395, 249, 0, 'titulo_1', NULL, 0, '2015-04-09 12:46:05', NULL, 'Como utilizar o Playground', 186, 265, 'texto', 'desktop'),
(5396, 249, 0, 'subtitulo_1', NULL, 0, '2015-04-09 12:46:05', NULL, 'Basta escolher o que deseja criar e montar sua imagem', 186, 265, 'texto', 'desktop'),
(5397, 249, 0, 'texto_1', NULL, 0, '2015-04-09 12:46:05', NULL, 'O Playground é um aplicativo de criação de imagens com funcionalidades avançadas de criação de imagens.\r\nCom ele você pode subir uma imagem qualquer e aplicar filtros, trocar o tamanho, girar, adicionar um texto sobre ela entre outras opções.\r\nPor padrão o Playground vem definido com tamanho padrão, 640x480.\r\nMas possui vários outros tamanhos veja a imagem ao lado.\r\n\r\n<b>Para seu Admin também tem uma versão exclusiva para você utilizar</b>\r\nPara você que é cliente PurplePier nós criamos uma maneira de você utilizar o Playground dentro do seu próprio Admin, basta você ter o PierPlayground instalado e acessar <b>Admin / Imagens / PierPlayground </b>\r\nO mesmo aplicativo irá abrir dentro do seu admin e permitir que você crie suas imagens e utilize em qualquer parte de seu site. ', 186, 265, 'texto', 'desktop'),
(5398, 249, 0, 'label_1', NULL, 0, '2015-04-09 12:46:05', '', '', 186, 265, 'texto', 'desktop'),
(5399, 249, 0, 'link_1', NULL, 0, '2015-04-09 12:46:05', NULL, '', 186, 265, 'texto', 'desktop'),
(5400, 249, 0, 'image_1', NULL, 0, '2015-04-09 12:46:05', 'playground2_f6.png', '', 186, 265, 'texto', 'desktop'),
(5401, 249, 0, 'layout_1', NULL, 0, '2015-04-09 12:46:05', 'left', '', 186, 265, 'texto', 'desktop'),
(5402, 249, 0, 'cor_1', NULL, 0, '2015-04-09 12:46:05', '', '', 186, 265, 'texto', 'desktop'),
(5403, 249, 0, 'cor_2', NULL, 0, '2015-04-09 12:46:05', '', '', 186, 265, 'texto', 'desktop'),
(5404, 249, 0, 'cor_3', NULL, 0, '2015-04-09 12:46:05', '', '', 186, 265, 'texto', 'desktop'),
(5405, 249, 0, 'alinhamento_1', NULL, 0, '2015-04-09 12:46:05', 'left', '', 186, 265, 'texto', 'desktop'),
(5406, 249, 0, 'alinhamento_2', NULL, 0, '2015-04-09 12:46:05', 'left', '', 186, 265, 'texto', 'desktop'),
(5407, 249, 0, 'alinhamento_3', NULL, 0, '2015-04-09 12:46:05', 'left', '', 186, 265, 'texto', 'desktop'),
(5408, 249, 0, 'margin_top', 20, 0, '2015-04-09 12:46:05', NULL, '', 186, 265, 'inteiro', 'desktop'),
(5409, 249, 0, 'margin_bottom', 30, 0, '2015-04-09 12:46:05', NULL, '', 186, 265, 'inteiro', 'desktop'),
(5410, 249, 0, 'padding_top', 0, 0, '2015-04-09 12:46:05', NULL, '', 186, 265, 'inteiro', 'desktop'),
(5411, 249, 0, 'padding_bottom', 0, 0, '2015-04-09 12:46:05', NULL, '', 186, 265, 'inteiro', 'desktop'),
(5412, 249, 0, 'is_full', 0, 0, '2015-04-09 12:46:05', NULL, '', 186, 265, 'inteiro', 'desktop'),
(5413, 249, 0, 'titulo_componente', NULL, 0, '2015-04-09 12:46:05', 'Como utilizar', '', 186, 265, 'texto', 'desktop'),
(5414, 249, 0, 'background_type', 0, 0, '2015-04-09 12:46:05', NULL, '', 186, 265, 'inteiro', 'desktop'),
(5415, 249, 0, 'background', NULL, 0, '2015-04-09 12:46:05', '', '', 186, 265, 'texto', 'desktop'),
(5416, 249, 0, 'titulo_1', NULL, 0, '2015-04-09 13:07:29', NULL, 'Funções básicas', 186, 266, 'texto', 'desktop'),
(5417, 249, 0, 'subtitulo_1', NULL, 0, '2015-04-09 13:07:29', NULL, 'Veja algumas funções básicas de utilização do Playground', 186, 266, 'texto', 'desktop'),
(5418, 249, 0, 'texto_1', NULL, 0, '2015-04-09 13:07:29', NULL, '<b>1</b> Criar nova imagem, abre um novo stage\r\n<b>2</b> Remover contorno do stage para visualização\r\n<b>3</b> Adicionar régua para controle visualização de alinhamento\r\n<b>4</b> Aumenta a altura do stage\r\n<b>5</b> Diminui a altura do stage\r\n<b>6</b> Tamanho do stage, você pode utilizar as ferramentas 4 e 5 para aumentar a altura\r\n<b>7</b> Escolhe o tamanho da fonte do item selecionado\r\n<b>8</b> Escolhe o estilo da fonte do item selecionado\r\n<b>9</b> Abre a paleta de cores para trocar a cor do item selecionado\r\n<b>10</b> Menu propriedades, abre o menu de edição do item selecionado\r\n<b>11</b> Enviar arquivo, abre a caixa para subir um nova imagem que será aberta no stage\r\n<b>12</b> Apaga o item selecionado do stage\r\n<b>13</b> Remove a marca de seleção do item selecionado\r\n<b>14</b> Permite desenhar por cima do stage\r\n<b>15</b> Adiciona um dos filtros a sua imagem, Vintage, Sépia, Preto e Branco...\r\n<b>16</b> Abre a paleta de cores, mesma opção da anterior\r\n<b>17</b> Adiciona um parágrafo ao stage\r\n<b>18</b> Adiciona um texto ao parágrafo, um título, uma frase simples\r\n<b>19</b> Espelha uma imagem horizontalmente\r\n<b>20</b> Espelha uma imagem verticalmente\r\n<b>21</b> Sobe um item do canvas para uma camada acima\r\n<b>22</b> Desce um item do canvas para uma camada abaixo\r\n<b>23</b> Gira o item selecionado para a direita\r\n<b>24</b> Gira o item selecionado para a esquerda', 186, 266, 'texto', 'desktop'),
(5419, 249, 0, 'label_1', NULL, 0, '2015-04-09 13:07:29', '', '', 186, 266, 'texto', 'desktop'),
(5420, 249, 0, 'link_1', NULL, 0, '2015-04-09 13:07:29', NULL, '', 186, 266, 'texto', 'desktop'),
(5421, 249, 0, 'image_1', NULL, 0, '2015-04-09 13:07:30', 'playground4_s0.jpg', '', 186, 266, 'texto', 'desktop'),
(5422, 249, 0, 'layout_1', NULL, 0, '2015-04-09 13:07:30', 'left', '', 186, 266, 'texto', 'desktop'),
(5423, 249, 0, 'cor_1', NULL, 0, '2015-04-09 13:07:30', '', '', 186, 266, 'texto', 'desktop'),
(5424, 249, 0, 'cor_2', NULL, 0, '2015-04-09 13:07:30', '', '', 186, 266, 'texto', 'desktop'),
(5425, 249, 0, 'cor_3', NULL, 0, '2015-04-09 13:07:30', '', '', 186, 266, 'texto', 'desktop'),
(5426, 249, 0, 'alinhamento_1', NULL, 0, '2015-04-09 13:07:30', 'left', '', 186, 266, 'texto', 'desktop'),
(5427, 249, 0, 'alinhamento_2', NULL, 0, '2015-04-09 13:07:30', 'left', '', 186, 266, 'texto', 'desktop'),
(5428, 249, 0, 'alinhamento_3', NULL, 0, '2015-04-09 13:07:30', 'left', '', 186, 266, 'texto', 'desktop'),
(5429, 249, 0, 'margin_top', 20, 0, '2015-04-09 13:07:30', NULL, '', 186, 266, 'inteiro', 'desktop'),
(5430, 249, 0, 'margin_bottom', 30, 0, '2015-04-09 13:07:30', NULL, '', 186, 266, 'inteiro', 'desktop'),
(5431, 249, 0, 'padding_top', 0, 0, '2015-04-09 13:07:30', NULL, '', 186, 266, 'inteiro', 'desktop'),
(5432, 249, 0, 'padding_bottom', 0, 0, '2015-04-09 13:07:30', NULL, '', 186, 266, 'inteiro', 'desktop'),
(5433, 249, 0, 'is_full', 0, 0, '2015-04-09 13:07:30', NULL, '', 186, 266, 'inteiro', 'desktop'),
(5434, 249, 0, 'titulo_componente', NULL, 0, '2015-04-09 13:07:30', 'Funções básicas', '', 186, 266, 'texto', 'desktop'),
(5435, 249, 0, 'background_type', 0, 0, '2015-04-09 13:07:31', NULL, '', 186, 266, 'inteiro', 'desktop'),
(5436, 249, 0, 'background', NULL, 0, '2015-04-09 13:07:31', '', '', 186, 266, 'texto', 'desktop'),
(5437, 249, 0, 'titulo_1', NULL, 0, '2015-04-09 13:22:46', NULL, 'Adicionando items no stage', 186, 267, 'texto', 'desktop'),
(5438, 249, 0, 'subtitulo_1', NULL, 0, '2015-04-09 13:22:46', NULL, 'Cada item que você adiciona no stage é uma arte a mais na sua criação', 186, 267, 'texto', 'desktop'),
(5439, 249, 0, 'texto_1', NULL, 0, '2015-04-09 13:22:46', NULL, 'O Playground funciona basicamente por adicionar e manusear items no stage.\r\n\r\n<b>Stage</b> é o palco da sua arte, ele é formado pelo tamanho que você definiu mais a altura que você editou. Quando você clicar em salvar ele salvar a sua arte exatamente como ela se encontra, respeitando o tamanho e posição dos itens ali adicionado\r\n\r\n<b>Items</b> Tudo que é adicionado no stage é um item. Quando você passa o mouse sobre um item ele mostra uma caixa de marcação para mostra que ele pode ser selecionado e pode ser editado. Um item pode ser editado quando ele esta selecionado.\r\n\r\nToda vez que você adiciona um item no stage ele será adicionado ao nível mais alto da hierarquia de itens sobre todos os outros, caso você queira que ele fica abaixo de algum outro você deve trocar o nível deste.\r\n\r\nTodo item selecionado possui as propriedades específicas deles no menu de propriedades. Você pode editar algumas propriedades apenas trocando os valores destas no menu de propriedades e clicando em aplicar', 186, 267, 'texto', 'desktop'),
(5440, 249, 0, 'label_1', NULL, 0, '2015-04-09 13:22:46', '', '', 186, 267, 'texto', 'desktop'),
(5441, 249, 0, 'link_1', NULL, 0, '2015-04-09 13:22:47', NULL, '', 186, 267, 'texto', 'desktop'),
(5442, 249, 0, 'image_1', NULL, 0, '2015-04-09 13:22:47', 'playground3_x4.png', '', 186, 267, 'texto', 'desktop'),
(5443, 249, 0, 'layout_1', NULL, 0, '2015-04-09 13:22:47', 'left', '', 186, 267, 'texto', 'desktop'),
(5444, 249, 0, 'cor_1', NULL, 0, '2015-04-09 13:22:47', '', '', 186, 267, 'texto', 'desktop'),
(5445, 249, 0, 'cor_2', NULL, 0, '2015-04-09 13:22:47', '', '', 186, 267, 'texto', 'desktop'),
(5446, 249, 0, 'cor_3', NULL, 0, '2015-04-09 13:22:47', '', '', 186, 267, 'texto', 'desktop'),
(5447, 249, 0, 'alinhamento_1', NULL, 0, '2015-04-09 13:22:47', 'left', '', 186, 267, 'texto', 'desktop'),
(5448, 249, 0, 'alinhamento_2', NULL, 0, '2015-04-09 13:22:47', 'left', '', 186, 267, 'texto', 'desktop'),
(5449, 249, 0, 'alinhamento_3', NULL, 0, '2015-04-09 13:22:47', 'left', '', 186, 267, 'texto', 'desktop'),
(5450, 249, 0, 'margin_top', 20, 0, '2015-04-09 13:22:47', NULL, '', 186, 267, 'inteiro', 'desktop'),
(5451, 249, 0, 'margin_bottom', 30, 0, '2015-04-09 13:22:47', NULL, '', 186, 267, 'inteiro', 'desktop'),
(5452, 249, 0, 'padding_top', 0, 0, '2015-04-09 13:22:47', NULL, '', 186, 267, 'inteiro', 'desktop'),
(5453, 249, 0, 'padding_bottom', 0, 0, '2015-04-09 13:22:47', NULL, '', 186, 267, 'inteiro', 'desktop'),
(5454, 249, 0, 'is_full', 0, 0, '2015-04-09 13:22:47', NULL, '', 186, 267, 'inteiro', 'desktop'),
(5455, 249, 0, 'titulo_componente', NULL, 0, '2015-04-09 13:22:47', 'Adicionado items no stage', '', 186, 267, 'texto', 'desktop'),
(5456, 249, 0, 'background_type', 0, 0, '2015-04-09 13:22:47', NULL, '', 186, 267, 'inteiro', 'desktop'),
(5457, 249, 0, 'background', NULL, 0, '2015-04-09 13:22:47', '', '', 186, 267, 'texto', 'desktop'),
(5458, 103, 0, 'dc_title', NULL, 0, NULL, 'Conta', '', 0, 0, '0', '0'),
(5459, 103, 0, 'dc_lastupdate', NULL, 0, NULL, '2015-04-10', '', 0, 0, '0', '0'),
(5460, 9, 0, 'dc_title', NULL, 0, NULL, 'Trabalhe conosco', '', 0, 0, '0', '0'),
(5461, 9, 0, 'dc_lastupdate', NULL, 0, NULL, '2015-04-11', '', 0, 0, '0', '0'),
(5462, 8, 0, 'dc_title', NULL, 0, NULL, 'Seja um de nossos fornecedores', '', 0, 0, '0', '0'),
(5463, 8, 0, 'dc_lastupdate', NULL, 0, NULL, '2015-04-11', '', 0, 0, '0', '0'),
(5464, 0, 0, 'dc_title', NULL, 0, NULL, 'Teste', '', 0, 0, '0', '0'),
(5465, 0, 0, 'dc_lastupdate', NULL, 0, NULL, '2015-04-24', '', 0, 0, '0', '0'),
(5466, 261, 0, 'dc_title', NULL, 0, NULL, 'Processo de Vendas', '', 0, 0, '0', '0'),
(5467, 261, 0, 'dc_lastupdate', NULL, 0, NULL, '2015-04-22', '', 0, 0, '0', '0'),
(5468, 212, 0, 'dc_language', NULL, 0, NULL, 'PT', '', 0, 0, '0', '0'),
(5469, 212, 0, 'dc_publisher', NULL, 0, NULL, 'PurplePier Me', '', 0, 0, '0', '0'),
(5470, 212, 0, 'dc_email', NULL, 0, NULL, 'contato@purplepier.com.br', '', 0, 0, '0', '0'),
(5471, 212, 0, 'dc_creator', NULL, 0, NULL, 'PurplePier', '', 0, 0, '0', '0'),
(5472, 257, 341, 'dc_title', NULL, 0, NULL, 'Um Pier Digital especial para você', '', 0, 0, '0', '0'),
(5473, 257, 341, 'dc_lastupdate', NULL, 0, NULL, '2015-04-23', '', 0, 0, '0', '0'),
(5474, 252, 341, 'dc_lastupdate', NULL, 0, NULL, '2015-04-23', '', 0, 0, '0', '0'),
(5475, 252, 341, 'gel_fr_initial', NULL, 0, NULL, NULL, 'Aguardem!', 0, 0, '0', '0'),
(5476, 257, 0, 'titulo_1', NULL, 0, '2015-04-23 18:45:27', NULL, 'Newsletter', 218, 269, 'texto', 'desktop'),
(5477, 257, 0, 'subtitulo_1', NULL, 0, '2015-04-23 18:45:27', NULL, 'Cadastre-se na nossa newsletter', 218, 269, 'texto', 'desktop'),
(5478, 257, 0, 'texto_1', NULL, 0, '2015-04-23 18:45:27', NULL, '', 218, 269, 'texto', 'desktop'),
(5479, 257, 0, 'link_1', NULL, 0, '2015-04-23 18:45:27', NULL, '', 218, 269, 'texto', 'desktop'),
(5480, 257, 0, 'cor_1', NULL, 0, '2015-04-23 18:45:27', '', '', 218, 269, 'texto', 'desktop'),
(5481, 257, 0, 'cor_2', NULL, 0, '2015-04-23 18:45:27', '', '', 218, 269, 'texto', 'desktop'),
(5482, 257, 0, 'cor_3', NULL, 0, '2015-04-23 18:45:27', '', '', 218, 269, 'texto', 'desktop'),
(5483, 257, 0, 'alinhamento_1', NULL, 0, '2015-04-23 18:45:27', 'left', '', 218, 269, 'texto', 'desktop'),
(5484, 257, 0, 'alinhamento_2', NULL, 0, '2015-04-23 18:45:27', 'left', '', 218, 269, 'texto', 'desktop'),
(5485, 257, 0, 'alinhamento_3', NULL, 0, '2015-04-23 18:45:27', 'left', '', 218, 269, 'texto', 'desktop'),
(5486, 257, 0, 'margin_top', 20, 0, '2015-04-23 18:45:27', NULL, '', 218, 269, 'inteiro', 'desktop'),
(5487, 257, 0, 'margin_bottom', 30, 0, '2015-04-23 18:45:27', NULL, '', 218, 269, 'inteiro', 'desktop'),
(5488, 257, 0, 'padding_top', 0, 0, '2015-04-23 18:45:27', NULL, '', 218, 269, 'inteiro', 'desktop'),
(5489, 257, 0, 'padding_bottom', 0, 0, '2015-04-23 18:45:27', NULL, '', 218, 269, 'inteiro', 'desktop'),
(5490, 257, 0, 'is_full', 0, 0, '2015-04-23 18:45:27', NULL, '', 218, 269, 'inteiro', 'desktop'),
(5491, 257, 0, 'titulo_componente', NULL, 0, '2015-04-23 18:45:27', '', '', 218, 269, 'texto', 'desktop'),
(5492, 257, 0, 'background_type', 0, 0, '2015-04-23 18:45:27', NULL, '', 218, 269, 'inteiro', 'desktop'),
(5493, 257, 0, 'background', NULL, 0, '2015-04-23 18:45:27', '', '', 218, 269, 'texto', 'desktop'),
(5494, 257, 0, 'titulo_1', NULL, 0, '2015-04-24 12:50:58', NULL, '', 370, 268, 'texto', 'desktop'),
(5495, 257, 0, 'subtitulo_1', NULL, 0, '2015-04-24 12:50:59', NULL, '', 370, 268, 'texto', 'desktop'),
(5496, 257, 0, 'texto_1', NULL, 0, '2015-04-24 12:50:59', NULL, '', 370, 268, 'texto', 'desktop'),
(5497, 257, 0, 'link_1', NULL, 0, '2015-04-24 12:50:59', NULL, '', 370, 268, 'texto', 'desktop'),
(5498, 257, 0, 'link_target_1', NULL, 0, '2015-04-24 12:50:59', '_self', '', 370, 268, 'texto', 'desktop');
INSERT INTO `paginas_attribute` (`id`, `id_pagina`, `user_id`, `name`, `inteiro`, `number`, `estampa`, `texto`, `descricao`, `id_componente`, `id_row`, `tipo`, `plataforma`) VALUES
(5499, 257, 0, 'image_1', NULL, 0, '2015-04-24 12:50:59', 'orcamentus_f0_g9.jpg', '', 370, 268, 'texto', 'desktop'),
(5500, 257, 0, 'layout_1', NULL, 0, '2015-04-24 12:50:59', 'note', '', 370, 268, 'texto', 'desktop'),
(5501, 257, 0, 'cor_1', NULL, 0, '2015-04-24 12:50:59', '', '', 370, 268, 'texto', 'desktop'),
(5502, 257, 0, 'cor_2', NULL, 0, '2015-04-24 12:50:59', '', '', 370, 268, 'texto', 'desktop'),
(5503, 257, 0, 'cor_3', NULL, 0, '2015-04-24 12:50:59', '', '', 370, 268, 'texto', 'desktop'),
(5504, 257, 0, 'alinhamento_1', NULL, 0, '2015-04-24 12:50:59', 'left', '', 370, 268, 'texto', 'desktop'),
(5505, 257, 0, 'alinhamento_2', NULL, 0, '2015-04-24 12:50:59', 'left', '', 370, 268, 'texto', 'desktop'),
(5506, 257, 0, 'alinhamento_3', NULL, 0, '2015-04-24 12:50:59', 'left', '', 370, 268, 'texto', 'desktop'),
(5507, 257, 0, 'margin_top', 0, 0, '2015-04-24 12:50:59', NULL, '', 370, 268, 'inteiro', 'desktop'),
(5508, 257, 0, 'margin_bottom', 0, 0, '2015-04-24 12:50:59', NULL, '', 370, 268, 'inteiro', 'desktop'),
(5509, 257, 0, 'padding_top', 0, 0, '2015-04-24 12:50:59', NULL, '', 370, 268, 'inteiro', 'desktop'),
(5510, 257, 0, 'padding_bottom', 0, 0, '2015-04-24 12:50:59', NULL, '', 370, 268, 'inteiro', 'desktop'),
(5511, 257, 0, 'is_full', 0, 0, '2015-04-24 12:50:59', NULL, '', 370, 268, 'inteiro', 'desktop'),
(5512, 257, 0, 'titulo_componente', NULL, 0, '2015-04-24 12:50:59', 'Orcamentus', '', 370, 268, 'texto', 'desktop'),
(5513, 257, 0, 'background_type', 0, 0, '2015-04-24 12:50:59', NULL, '', 370, 268, 'inteiro', 'desktop'),
(5514, 257, 0, 'background', NULL, 0, '2015-04-24 12:50:59', '', '', 370, 268, 'texto', 'desktop'),
(5515, 254, 341, 'dc_title', NULL, 0, NULL, 'Digital Pier', '', 0, 0, '0', '0'),
(5516, 254, 341, 'dc_lastupdate', NULL, 0, NULL, '2015-04-24', '', 0, 0, '0', '0'),
(5517, 250, 341, 'dc_title', NULL, 0, NULL, 'Veja nossas matérias', '', 0, 0, '0', '0'),
(5518, 250, 341, 'dc_lastupdate', NULL, 0, NULL, '2015-04-24', '', 0, 0, '0', '0'),
(5519, 250, 341, 'mat_lk_rcn_qtd', 4, 0, NULL, NULL, '', 0, 0, '0', '0'),
(5520, 250, 341, 'mat_lk_rcn_afi', NULL, 0, NULL, 'afinidade', '', 0, 0, '0', '0'),
(5521, 250, 341, 'mat_lk_rcn_adv', 1, 0, NULL, NULL, '', 0, 0, '0', '0'),
(5522, 250, 341, 'mat_lk_rcn_blc', 4, 0, NULL, NULL, '', 0, 0, '0', '0'),
(5523, 256, 341, 'dc_title', NULL, 0, NULL, 'Tire suas dúvidas e entre em contato', '', 0, 0, '0', '0'),
(5524, 256, 341, 'dc_lastupdate', NULL, 0, NULL, '2015-04-24', '', 0, 0, '0', '0'),
(5525, 0, 0, 'titulo_1', NULL, 0, '2015-04-24 17:50:59', NULL, '', 370, 270, 'texto', 'desktop'),
(5526, 0, 0, 'subtitulo_1', NULL, 0, '2015-04-24 17:50:59', NULL, '', 370, 270, 'texto', 'desktop'),
(5527, 0, 0, 'texto_1', NULL, 0, '2015-04-24 17:50:59', NULL, '', 370, 270, 'texto', 'desktop'),
(5528, 0, 0, 'label_1', NULL, 0, '2015-04-24 17:50:59', '', '', 370, 270, 'texto', 'desktop'),
(5529, 0, 0, 'link_1', NULL, 0, '2015-04-24 17:50:59', NULL, '', 370, 270, 'texto', 'desktop'),
(5530, 0, 0, 'image_1', NULL, 0, '2015-04-24 17:50:59', '', '', 370, 270, 'texto', 'desktop'),
(5531, 0, 0, 'layout_1', NULL, 0, '2015-04-24 17:50:59', 'left', '', 370, 270, 'texto', 'desktop'),
(5532, 0, 0, 'cor_1', NULL, 0, '2015-04-24 17:50:59', '', '', 370, 270, 'texto', 'desktop'),
(5533, 0, 0, 'cor_2', NULL, 0, '2015-04-24 17:50:59', '', '', 370, 270, 'texto', 'desktop'),
(5534, 0, 0, 'cor_3', NULL, 0, '2015-04-24 17:50:59', '', '', 370, 270, 'texto', 'desktop'),
(5535, 0, 0, 'alinhamento_1', NULL, 0, '2015-04-24 17:50:59', 'left', '', 370, 270, 'texto', 'desktop'),
(5536, 0, 0, 'alinhamento_2', NULL, 0, '2015-04-24 17:50:59', 'left', '', 370, 270, 'texto', 'desktop'),
(5537, 0, 0, 'alinhamento_3', NULL, 0, '2015-04-24 17:50:59', 'left', '', 370, 270, 'texto', 'desktop'),
(5538, 0, 0, 'margin_top', 0, 0, '2015-04-24 17:50:59', NULL, '', 370, 270, 'inteiro', 'desktop'),
(5539, 0, 0, 'margin_bottom', 0, 0, '2015-04-24 17:50:59', NULL, '', 370, 270, 'inteiro', 'desktop'),
(5540, 0, 0, 'padding_top', 0, 0, '2015-04-24 17:50:59', NULL, '', 370, 270, 'inteiro', 'desktop'),
(5541, 0, 0, 'padding_bottom', 0, 0, '2015-04-24 17:50:59', NULL, '', 370, 270, 'inteiro', 'desktop'),
(5542, 0, 0, 'is_full', 0, 0, '2015-04-24 17:50:59', NULL, '', 370, 270, 'inteiro', 'desktop'),
(5543, 0, 0, 'titulo_componente', NULL, 0, '2015-04-24 17:50:59', 'Orcamentus', '', 370, 270, 'texto', 'desktop'),
(5544, 0, 0, 'background_type', 0, 0, '2015-04-24 17:50:59', NULL, '', 370, 270, 'inteiro', 'desktop'),
(5545, 0, 0, 'background', NULL, 0, '2015-04-24 17:50:59', '', '', 370, 270, 'texto', 'desktop'),
(5546, 263, 0, 'titulo_1', NULL, 0, '2015-04-24 17:51:44', NULL, '', 370, 271, 'texto', 'desktop'),
(5547, 263, 0, 'subtitulo_1', NULL, 0, '2015-04-24 17:51:44', NULL, '', 370, 271, 'texto', 'desktop'),
(5548, 263, 0, 'texto_1', NULL, 0, '2015-04-24 17:51:44', NULL, '', 370, 271, 'texto', 'desktop'),
(5549, 263, 0, 'link_1', NULL, 0, '2015-04-24 17:51:44', NULL, '', 370, 271, 'texto', 'desktop'),
(5550, 263, 0, 'link_target_1', NULL, 0, '2015-04-24 17:51:44', '_self', '', 370, 271, 'texto', 'desktop'),
(5551, 263, 0, 'image_1', NULL, 0, '2015-04-24 17:51:44', '', '', 370, 271, 'texto', 'desktop'),
(5552, 263, 0, 'layout_1', NULL, 0, '2015-04-24 17:51:44', 'note', '', 370, 271, 'texto', 'desktop'),
(5553, 263, 0, 'cor_1', NULL, 0, '2015-04-24 17:51:44', '', '', 370, 271, 'texto', 'desktop'),
(5554, 263, 0, 'cor_2', NULL, 0, '2015-04-24 17:51:44', '', '', 370, 271, 'texto', 'desktop'),
(5555, 263, 0, 'cor_3', NULL, 0, '2015-04-24 17:51:44', '', '', 370, 271, 'texto', 'desktop'),
(5556, 263, 0, 'alinhamento_1', NULL, 0, '2015-04-24 17:51:44', 'left', '', 370, 271, 'texto', 'desktop'),
(5557, 263, 0, 'alinhamento_2', NULL, 0, '2015-04-24 17:51:44', 'left', '', 370, 271, 'texto', 'desktop'),
(5558, 263, 0, 'alinhamento_3', NULL, 0, '2015-04-24 17:51:44', 'left', '', 370, 271, 'texto', 'desktop'),
(5559, 263, 0, 'margin_top', 0, 0, '2015-04-24 17:51:44', NULL, '', 370, 271, 'inteiro', 'desktop'),
(5560, 263, 0, 'margin_bottom', 0, 0, '2015-04-24 17:51:44', NULL, '', 370, 271, 'inteiro', 'desktop'),
(5561, 263, 0, 'padding_top', 0, 0, '2015-04-24 17:51:44', NULL, '', 370, 271, 'inteiro', 'desktop'),
(5562, 263, 0, 'padding_bottom', 0, 0, '2015-04-24 17:51:44', NULL, '', 370, 271, 'inteiro', 'desktop'),
(5563, 263, 0, 'is_full', 0, 0, '2015-04-24 17:51:44', NULL, '', 370, 271, 'inteiro', 'desktop'),
(5564, 263, 0, 'titulo_componente', NULL, 0, '2015-04-24 17:51:44', 'Orcamentus', '', 370, 271, 'texto', 'desktop'),
(5565, 263, 0, 'background_type', 0, 0, '2015-04-24 17:51:44', NULL, '', 370, 271, 'inteiro', 'desktop'),
(5566, 263, 0, 'background', NULL, 0, '2015-04-24 17:51:44', '', '', 370, 271, 'texto', 'desktop'),
(5567, 263, 0, 'titulo_1', NULL, 0, '2015-04-24 19:12:08', NULL, 'O que é?', 375, 272, 'texto', 'desktop'),
(5568, 263, 0, 'subtitulo_1', NULL, 0, '2015-04-24 19:12:08', NULL, '', 375, 272, 'texto', 'desktop'),
(5569, 263, 0, 'texto_1', NULL, 0, '2015-04-24 19:12:08', NULL, 'Um sistema de oportunidades para empresas e possoas que visa juntar o útil ao agradável', 375, 272, 'texto', 'desktop'),
(5570, 263, 0, 'link_1', NULL, 0, '2015-04-24 19:12:08', NULL, '', 375, 272, 'texto', 'desktop'),
(5571, 263, 0, 'link_target_1', NULL, 0, '2015-04-24 19:12:08', '_self', '', 375, 272, 'texto', 'desktop'),
(5572, 263, 0, 'image_1', NULL, 0, '2015-04-24 19:12:08', '', '', 375, 272, 'texto', 'desktop'),
(5573, 263, 0, 'layout_1', NULL, 0, '2015-04-24 19:12:08', 'up', '', 375, 272, 'texto', 'desktop'),
(5574, 263, 0, 'cor_1', NULL, 0, '2015-04-24 19:12:08', '', '', 375, 272, 'texto', 'desktop'),
(5575, 263, 0, 'cor_2', NULL, 0, '2015-04-24 19:12:08', '', '', 375, 272, 'texto', 'desktop'),
(5576, 263, 0, 'cor_3', NULL, 0, '2015-04-24 19:12:08', '', '', 375, 272, 'texto', 'desktop'),
(5577, 263, 0, 'alinhamento_1', NULL, 0, '2015-04-24 19:12:08', 'left', '', 375, 272, 'texto', 'desktop'),
(5578, 263, 0, 'alinhamento_2', NULL, 0, '2015-04-24 19:12:08', 'left', '', 375, 272, 'texto', 'desktop'),
(5579, 263, 0, 'alinhamento_3', NULL, 0, '2015-04-24 19:12:08', 'left', '', 375, 272, 'texto', 'desktop'),
(5580, 263, 0, 'margin_top', 20, 0, '2015-04-24 19:12:08', NULL, '', 375, 272, 'inteiro', 'desktop'),
(5581, 263, 0, 'margin_bottom', 30, 0, '2015-04-24 19:12:08', NULL, '', 375, 272, 'inteiro', 'desktop'),
(5582, 263, 0, 'padding_top', 0, 0, '2015-04-24 19:12:08', NULL, '', 375, 272, 'inteiro', 'desktop'),
(5583, 263, 0, 'padding_bottom', 0, 0, '2015-04-24 19:12:08', NULL, '', 375, 272, 'inteiro', 'desktop'),
(5584, 263, 0, 'is_full', 0, 0, '2015-04-24 19:12:08', NULL, '', 375, 272, 'inteiro', 'desktop'),
(5585, 263, 0, 'titulo_componente', NULL, 0, '2015-04-24 19:12:08', 'Display Nevada', '', 375, 272, 'texto', 'desktop'),
(5586, 263, 0, 'background_type', 0, 0, '2015-04-24 19:12:08', NULL, '', 375, 272, 'inteiro', 'desktop'),
(5587, 263, 0, 'background', NULL, 0, '2015-04-24 19:12:08', '', '', 375, 272, 'texto', 'desktop'),
(5588, 263, 0, 'titulo_1', NULL, 0, '2015-04-25 12:16:28', NULL, 'Seu site é otimizado para os dispositivos móveis?', 376, 273, 'texto', 'desktop'),
(5589, 263, 0, 'subtitulo_1', NULL, 0, '2015-04-25 12:16:28', NULL, 'Verifique agora seu site no Google', 376, 273, 'texto', 'desktop'),
(5590, 263, 0, 'texto_1', NULL, 0, '2015-04-25 12:16:28', NULL, 'Digite seu site e clique em verificar para ver a análise do seu site', 376, 273, 'texto', 'desktop'),
(5591, 263, 0, 'link_1', NULL, 0, '2015-04-25 12:16:28', NULL, '', 376, 273, 'texto', 'desktop'),
(5592, 263, 0, 'link_target_1', NULL, 0, '2015-04-25 12:16:28', '_self', '', 376, 273, 'texto', 'desktop'),
(5593, 263, 0, 'image_1', NULL, 0, '2015-04-25 12:16:28', '', '', 376, 273, 'texto', 'desktop'),
(5594, 263, 0, 'layout_1', NULL, 0, '2015-04-25 12:16:28', 'up', '', 376, 273, 'texto', 'desktop'),
(5595, 263, 0, 'cor_1', NULL, 0, '2015-04-25 12:16:28', '', '', 376, 273, 'texto', 'desktop'),
(5596, 263, 0, 'cor_2', NULL, 0, '2015-04-25 12:16:28', '', '', 376, 273, 'texto', 'desktop'),
(5597, 263, 0, 'cor_3', NULL, 0, '2015-04-25 12:16:28', '', '', 376, 273, 'texto', 'desktop'),
(5598, 263, 0, 'alinhamento_1', NULL, 0, '2015-04-25 12:16:28', 'left', '', 376, 273, 'texto', 'desktop'),
(5599, 263, 0, 'alinhamento_2', NULL, 0, '2015-04-25 12:16:28', 'left', '', 376, 273, 'texto', 'desktop'),
(5600, 263, 0, 'alinhamento_3', NULL, 0, '2015-04-25 12:16:28', 'left', '', 376, 273, 'texto', 'desktop'),
(5601, 263, 0, 'margin_top', 0, 0, '2015-04-25 12:16:28', NULL, '', 376, 273, 'inteiro', 'desktop'),
(5602, 263, 0, 'margin_bottom', 0, 0, '2015-04-25 12:16:29', NULL, '', 376, 273, 'inteiro', 'desktop'),
(5603, 263, 0, 'padding_top', 0, 0, '2015-04-25 12:16:29', NULL, '', 376, 273, 'inteiro', 'desktop'),
(5604, 263, 0, 'padding_bottom', 0, 0, '2015-04-25 12:16:29', NULL, '', 376, 273, 'inteiro', 'desktop'),
(5605, 263, 0, 'is_full', 0, 0, '2015-04-25 12:16:29', NULL, '', 376, 273, 'inteiro', 'desktop'),
(5606, 263, 0, 'titulo_componente', NULL, 0, '2015-04-25 12:16:29', 'Busca Silicon Valley', '', 376, 273, 'texto', 'desktop'),
(5607, 263, 0, 'background_type', 0, 0, '2015-04-25 12:16:29', NULL, '', 376, 273, 'inteiro', 'desktop'),
(5608, 263, 0, 'background', NULL, 0, '2015-04-25 12:16:29', '', '', 376, 273, 'texto', 'desktop'),
(5609, 6, 0, 'dc_title', NULL, 0, NULL, 'Orçamento', '', 0, 0, '0', '0'),
(5610, 6, 0, 'dc_lastupdate', NULL, 0, NULL, '2015-04-25', '', 0, 0, '0', '0'),
(5611, 268, 0, 'dc_title', NULL, 0, NULL, 'Cadastrar', '', 0, 0, '0', '0'),
(5612, 268, 0, 'dc_description', NULL, 0, NULL, NULL, 'cadastro, conta', 0, 0, '0', '0'),
(5613, 268, 0, 'dc_lastupdate', NULL, 0, NULL, '2016-08-15', '', 0, 0, '0', '0'),
(5614, 270, 0, 'dc_title', NULL, 0, NULL, 'Anunciar', '', 0, 0, '0', '0'),
(5615, 270, 0, 'dc_description', NULL, 0, NULL, NULL, 'anuncie, anúncios, anuncie aqui, faça sua propaganda conosco, publicidade online, publicidade dirigida', 0, 0, '0', '0'),
(5616, 270, 0, 'dc_lastupdate', NULL, 0, NULL, '2016-08-15', '', 0, 0, '0', '0'),
(5617, 264, 0, 'dc_title', NULL, 0, NULL, 'App', '', 0, 0, '0', '0'),
(5618, 264, 0, 'dc_description', NULL, 0, NULL, NULL, 'app, aplicativo, web app', 0, 0, '0', '0'),
(5619, 264, 0, 'dc_lastupdate', NULL, 0, NULL, '2016-08-15', '', 0, 0, '0', '0'),
(5620, 271, 0, 'dc_title', NULL, 0, NULL, 'Veículos', '', 0, 0, '0', '0'),
(5621, 271, 0, 'dc_description', NULL, 0, NULL, NULL, 'automóveis, veículos, motos, carros, caminhões', 0, 0, '0', '0'),
(5622, 271, 0, 'dc_lastupdate', NULL, 0, NULL, '2016-08-15', '', 0, 0, '0', '0'),
(5623, 238, 0, 'dc_title', NULL, 0, NULL, 'Buscar', '', 0, 0, '0', '0'),
(5624, 238, 0, 'dc_description', NULL, 0, NULL, NULL, 'busca, buscador, palavras-chave', 0, 0, '0', '0'),
(5625, 238, 0, 'dc_lastupdate', NULL, 0, NULL, '2016-08-15', '', 0, 0, '0', '0'),
(5626, 269, 0, 'dc_title', NULL, 0, NULL, 'Clientes', '', 0, 0, '0', '0'),
(5627, 269, 0, 'dc_description', NULL, 0, NULL, NULL, 'clientes, usuários, nossos clientes,', 0, 0, '0', '0'),
(5628, 269, 0, 'dc_lastupdate', NULL, 0, NULL, '2016-08-15', '', 0, 0, '0', '0'),
(5629, 266, 0, 'dc_title', NULL, 0, NULL, 'Contratar', '', 0, 0, '0', '0'),
(5630, 266, 0, 'dc_description', NULL, 0, NULL, NULL, 'contratar, serviços, produtos', 0, 0, '0', '0'),
(5631, 266, 0, 'dc_lastupdate', NULL, 0, NULL, '2016-08-15', '', 0, 0, '0', '0'),
(5632, 44, 0, 'dc_title', NULL, 0, NULL, 'Vídeos', '', 0, 0, '0', '0'),
(5633, 44, 0, 'dc_lastupdate', NULL, 0, NULL, '2016-08-15', '', 0, 0, '0', '0'),
(5634, 44, 0, 'video_lk_rcn_qtd', 0, 0, NULL, NULL, '', 0, 0, '0', '0'),
(5635, 44, 0, 'video_lk_rcn_afi', NULL, 0, NULL, 'afinidade', '', 0, 0, '0', '0'),
(5636, 44, 0, 'video_lk_rcn_adv', 1, 0, NULL, NULL, '', 0, 0, '0', '0'),
(5637, 96, 0, 'dc_title', NULL, 0, NULL, 'Downloads e arquivos', '', 0, 0, '0', '0'),
(5638, 96, 0, 'dc_lastupdate', NULL, 0, NULL, '2016-08-15', '', 0, 0, '0', '0'),
(5639, 102, 0, 'dc_lastupdate', NULL, 0, NULL, '2016-08-15', '', 0, 0, '0', '0'),
(5640, 55, 0, 'dc_title', NULL, 0, NULL, 'Produtos', '', 0, 0, '0', '0'),
(5641, 55, 0, 'dc_lastupdate', NULL, 0, NULL, '2016-08-15', '', 0, 0, '0', '0');

-- --------------------------------------------------------

--
-- Estrutura da tabela `paginas_data`
--

CREATE TABLE `paginas_data` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `n_index` int(11) NOT NULL,
  `nome` varchar(255) DEFAULT NULL,
  `label` varchar(50) NOT NULL,
  `icon` varchar(50) NOT NULL,
  `layout` varchar(60) NOT NULL,
  `plataforma` varchar(40) NOT NULL DEFAULT 'desktop',
  `tipo` varchar(100) NOT NULL,
  `controller` varchar(50) NOT NULL,
  `action` varchar(255) NOT NULL,
  `keywords` longtext NOT NULL,
  `menu_principal` int(11) NOT NULL,
  `menu_2` int(11) NOT NULL,
  `menu_3` int(11) NOT NULL,
  `id_categoria` int(11) DEFAULT NULL,
  `titulo` varchar(255) DEFAULT NULL,
  `titulo_01` varchar(150) NOT NULL,
  `titulo_02` varchar(150) NOT NULL,
  `titulo_03` varchar(150) NOT NULL,
  `titulo_04` varchar(150) NOT NULL,
  `titulo_05` varchar(150) NOT NULL,
  `titulo_06` varchar(150) NOT NULL,
  `texto_01` text,
  `texto_02` text,
  `texto_03` text,
  `texto_04` text NOT NULL,
  `texto_05` text NOT NULL,
  `texto_06` text NOT NULL,
  `subtitulo_01` varchar(255) NOT NULL DEFAULT '',
  `subtitulo_02` varchar(255) NOT NULL DEFAULT '',
  `subtitulo_03` varchar(255) NOT NULL DEFAULT '',
  `subtitulo_04` varchar(255) NOT NULL DEFAULT '',
  `subtitulo_05` varchar(255) NOT NULL DEFAULT '',
  `subtitulo_06` varchar(255) NOT NULL DEFAULT '',
  `label_link_01` varchar(50) NOT NULL,
  `label_link_02` varchar(50) NOT NULL,
  `label_link_03` varchar(50) NOT NULL,
  `label_link_04` varchar(50) NOT NULL,
  `label_link_05` varchar(50) NOT NULL,
  `label_link_06` varchar(50) NOT NULL,
  `banner` varchar(30) NOT NULL,
  `banner_exibe` int(2) NOT NULL DEFAULT '1',
  `dica_exibe` int(2) NOT NULL DEFAULT '0',
  `network_exibe` int(2) NOT NULL DEFAULT '0',
  `video_exibe` int(2) NOT NULL DEFAULT '0',
  `main_for_group` int(2) DEFAULT NULL,
  `container_1` varchar(25) DEFAULT NULL,
  `container_2` varchar(25) DEFAULT NULL,
  `container_3` varchar(25) DEFAULT NULL,
  `container_4` varchar(25) DEFAULT NULL,
  `container_5` varchar(25) DEFAULT NULL,
  `container_6` varchar(25) DEFAULT NULL,
  `container_7` varchar(25) DEFAULT NULL,
  `container_8` varchar(25) DEFAULT NULL,
  `container_9` varchar(25) DEFAULT NULL,
  `container_10` varchar(25) DEFAULT NULL,
  `link_01` varchar(100) NOT NULL,
  `link_02` varchar(100) NOT NULL,
  `link_03` varchar(100) NOT NULL,
  `link_04` varchar(100) NOT NULL,
  `link_05` varchar(100) NOT NULL,
  `link_06` varchar(100) NOT NULL,
  `link_special` varchar(400) DEFAULT NULL,
  `titulo_pagina` varchar(400) DEFAULT NULL,
  `exibe` int(2) NOT NULL DEFAULT '1',
  `modelo` int(2) NOT NULL DEFAULT '0',
  `minisite` int(2) NOT NULL DEFAULT '0',
  `hotsite` int(11) NOT NULL DEFAULT '0',
  `breadcrumb_exibe` int(2) NOT NULL DEFAULT '0',
  `views` int(11) NOT NULL DEFAULT '0',
  `template` int(2) DEFAULT NULL,
  `titulo_pagina_seo` varchar(200) NOT NULL DEFAULT '0',
  `link_special_modo` int(2) NOT NULL DEFAULT '0',
  `opiniao_exibe` int(2) NOT NULL DEFAULT '0',
  `language` varchar(10) NOT NULL DEFAULT '0',
  `last_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_creation` datetime NOT NULL,
  `reputation_count` int(11) NOT NULL DEFAULT '0',
  `reputation_total` int(11) NOT NULL DEFAULT '0',
  `reputation_higher` int(2) NOT NULL DEFAULT '0',
  `reputation_lower` int(2) NOT NULL DEFAULT '0',
  `reputation` int(2) NOT NULL DEFAULT '0',
  `nr_comentarios` int(11) NOT NULL DEFAULT '0',
  `seguidores` int(11) NOT NULL DEFAULT '0',
  `foto_square` varchar(100) NOT NULL DEFAULT '0',
  `layout_modelo` varchar(100) NOT NULL DEFAULT '0',
  `cidade` varchar(100) NOT NULL DEFAULT '0',
  `bairro` varchar(100) NOT NULL DEFAULT '0',
  `id_template` int(11) NOT NULL DEFAULT '0',
  `json` longtext NOT NULL,
  `conversao` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `paginas_data`
--

INSERT INTO `paginas_data` (`id`, `id_user`, `n_index`, `nome`, `label`, `icon`, `layout`, `plataforma`, `tipo`, `controller`, `action`, `keywords`, `menu_principal`, `menu_2`, `menu_3`, `id_categoria`, `titulo`, `titulo_01`, `titulo_02`, `titulo_03`, `titulo_04`, `titulo_05`, `titulo_06`, `texto_01`, `texto_02`, `texto_03`, `texto_04`, `texto_05`, `texto_06`, `subtitulo_01`, `subtitulo_02`, `subtitulo_03`, `subtitulo_04`, `subtitulo_05`, `subtitulo_06`, `label_link_01`, `label_link_02`, `label_link_03`, `label_link_04`, `label_link_05`, `label_link_06`, `banner`, `banner_exibe`, `dica_exibe`, `network_exibe`, `video_exibe`, `main_for_group`, `container_1`, `container_2`, `container_3`, `container_4`, `container_5`, `container_6`, `container_7`, `container_8`, `container_9`, `container_10`, `link_01`, `link_02`, `link_03`, `link_04`, `link_05`, `link_06`, `link_special`, `titulo_pagina`, `exibe`, `modelo`, `minisite`, `hotsite`, `breadcrumb_exibe`, `views`, `template`, `titulo_pagina_seo`, `link_special_modo`, `opiniao_exibe`, `language`, `last_update`, `date_creation`, `reputation_count`, `reputation_total`, `reputation_higher`, `reputation_lower`, `reputation`, `nr_comentarios`, `seguidores`, `foto_square`, `layout_modelo`, `cidade`, `bairro`, `id_template`, `json`, `conversao`) VALUES
(1, 0, 0, 'home', 'Home', '', 'vevo', 'desktop', 'home', 'vevo', '', '', 1, 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 1, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 1, 1, 0, 0, 0, 0, NULL, '0', 0, 0, '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0, 0, 0, 0, 0, '0', '0', '0', '0', 0, '', 0),
(264, 0, 0, 'app', 'App', '', 'app', 'desktop', 'app', 'app', 'app', 'app, aplicativo, web app', 0, 0, 0, NULL, 'App', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 1, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'App', 0, 0, 0, 0, 0, 0, NULL, 'Aplicativo para administradores\nEssa é uma área-restrita para administradores e funcionários', 0, 0, '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0, 0, 0, 0, 0, '0', '0', '0', '0', 0, '', 0),
(9, 0, 3, 'trabalheconosco', 'Trabalhe Conosco', '', 'trabalhe_conosco_html5', 'desktop', 'trabalhe_conosco', 'trabalhe_conosco', 'trabalhe_conosco', '', 0, 1, 1, 0, 'Trabalhe conosco', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 1, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, NULL, '0', 0, 0, '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0, 0, 0, 0, 0, '0', '0', '0', '0', 0, '', 0),
(59, 0, 0, 'eventos', 'Eventos', '', 'eventos_html5', 'desktop', 'eventos', 'eventos_html5', '', 'Cursos, workshop', 0, 0, 0, NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 1, 0, 1, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 1, 0, NULL, '0', 0, 0, '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0, 0, 0, 0, 0, '0', '0', '0', '0', 0, '', 0),
(47, 0, 0, 'images', 'Images', '', '', 'desktop', 'images', 'images', '', '', 0, 0, 0, NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 1, 0, 0, 0, NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, 0, 0, 0, 0, 0, 0, NULL, '0', 0, 0, '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0, 0, 0, 0, 0, '0', '0', '0', '0', 0, '', 0),
(57, 0, 0, 'vazio', 'Vazio', '', 'vertical_banner_likebox', 'desktop', 'vazio', 'verticalbanner', '', '', 0, 0, 0, NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 1, 0, 0, 0, NULL, 'f_409', 'b_124', '', '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, 1, 0, 0, 0, 0, 0, NULL, '0', 0, 0, '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0, 0, 0, 0, 0, '0', '0', '0', '0', 0, '', 0),
(28, 0, 21, 'blog', 'Blog', '', 'blog_california', 'desktop', 'blog', 'blog', '', 'blog, matérias, novidades, artigos, promoções', 0, 0, 0, NULL, 'Blog', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 1, 0, 1, 0, 0, 'logo_promocao2.jpg', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'Blog', 0, 0, 0, 0, 0, 0, NULL, 'Confira nosso Blog de notícias\nFique por dentro de todas as novidades e lançamento de nossa empresa', 0, 0, '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0, 0, 0, 0, 0, '0', '0', '0', '0', 0, '', 0),
(268, 0, 0, 'cadastrarse', 'Cadastrar', '', 'cadastrar_simples', 'desktop', 'cadastrar', 'cadastrar', 'cadastrar', 'cadastro, conta', 0, 0, 0, NULL, 'Cadastrar', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 1, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'Cadastrar', 0, 0, 0, 0, 0, 0, NULL, 'Faça seu cadastro em nosso site e tenha sua conta\nReceba com exclusividade nossas promoções e lançamentos', 0, 0, '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0, 0, 0, 0, 0, '0', '0', '0', '0', 0, '', 0),
(269, 0, 0, 'clientes', 'Clientes', '', 'clientes_simple', 'desktop', 'clientes', 'clientes', 'clientes', 'clientes, usuários, nossos clientes,', 0, 0, 0, NULL, 'Clientes', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 1, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'Clientes', 0, 0, 0, 0, 0, 1, NULL, 'Veja nosso clientes satisfeitos\nEsse são alguns clientes que confiam em nossa marca', 0, 0, '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0, 0, 0, 0, 0, '0', '0', '0', '0', 0, '', 0),
(7, 0, 22, 'contato', 'Contato', '', 'contact_map', 'desktop', 'contato', 'contato', '', 'contato, telefone, e-mail, endereço', 1, 0, 1, NULL, 'Tire suas dúvidas e entre em contato', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 1, 0, 1, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'Informações para contato', 1, 0, 0, 0, 0, 0, NULL, 'Entre em contato conosco para tirar suas dúvidas.\nSaiba tudo que nossa empresa pode fazer por você', 0, 0, '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0, 0, 0, 0, 0, '0', '0', '0', '0', 0, '', 0),
(161, 0, 5, 'wiki', 'Tutoriais', '', 'wiki_simple', 'desktop', 'wiki', 'materias', '', 'Wiki, ajuda, Dicas, Informações, Suporte, Tutoriais', 0, 0, 0, NULL, 'Wiki de ajuda', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 1, 0, 1, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'Wiki de ajuda', 0, 0, 0, 0, 0, 0, NULL, '0', 0, 0, '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0, 0, 0, 0, 0, '0', '0', '0', '0', 0, '', 0),
(6, 0, 6, 'orcamento', 'Orçamento', '', 'orcamentos_html5', 'desktop', 'orcamento', 'orcamento', 'pedidos', '', 0, 0, 1, NULL, 'Orçamento', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 1, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, NULL, '0', 0, 0, '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0, 0, 0, 0, 0, '0', '0', '0', '0', 0, '', 0),
(55, 0, 0, 'produtos', 'Produtos', '', 'ecommerce_simple_html5', 'desktop', 'produtos', 'ecommerce_simple_html5', '', '', 0, 0, 0, NULL, 'Produtos ', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 1, 0, 0, 0, 0, 'f_414', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, NULL, '', 0, 0, '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0, 0, 0, 0, 0, '0', '0', '0', '0', 0, '', 0),
(60, 0, 0, 'reclamar', 'Reclamações', '', 'vertical_banner', 'desktop', 'suporte', 'verticalbanner', '', '', 0, 0, 0, NULL, NULL, '', '', '', '', '', '', '', NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 1, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', NULL, NULL, 0, 0, 0, 0, 0, 0, NULL, '0', 0, 0, '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0, 0, 0, 0, 0, '0', '0', '0', '0', 0, '', 0),
(44, 0, 0, 'videos', 'Vídeos', '', 'video_holland', 'desktop', 'videos', 'videos', '', '', 0, 0, 0, NULL, 'Vídeos', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 1, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, NULL, '', 0, 0, '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0, 0, 0, 0, 0, '0', '0', '0', '0', 0, '', 0),
(50, 0, 5, 'noticias', 'Notícias', '', 'materias_advertiser_html5', 'desktop', 'materias', 'materias', 'noticias', '', 0, 0, 0, NULL, 'Notícias', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 1, 0, 1, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'Notícias', 0, 0, 0, 0, 0, 0, NULL, '0', 0, 0, '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0, 0, 0, 0, 0, '0', '0', '0', '0', 0, '', 0),
(56, 0, 0, 'produtos_detalhes', 'Produtos Detalhes', '', 'produtos_detalhes_html5', 'desktop', 'produtos', '', '', '', 0, 0, 0, NULL, 'Detalhes do produto', '', '', '', '', '', '', NULL, NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 1, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', NULL, NULL, 0, 0, 0, 0, 0, 0, NULL, '0', 0, 0, '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0, 0, 0, 0, 0, '0', '0', '0', '0', 0, '', 0),
(8, 0, 4, 'sejafornecedor', 'Seja um Fornecedor', '', 'seja_fornecedor_html5', 'desktop', 'fornecedor', 'fornecedor', '', '', 0, 1, 1, 0, 'Seja um de nossos fornecedores', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 1, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 1, NULL, '0', 0, 0, '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0, 0, 0, 0, 0, '0', '0', '0', '0', 0, '', 0),
(107, 0, 0, 'curriculum', 'Curriculum', '', 'curriculum_simple', 'desktop', 'curriculum', 'curriculum', 'curriculum', '', 0, 0, 0, NULL, NULL, '', '', '', '', '', '', NULL, NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 1, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', NULL, NULL, 0, 0, 0, 0, 0, 0, NULL, '0', 0, 0, '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0, 0, 0, 0, 0, '0', '0', '0', '0', 0, '', 0),
(94, 0, 0, 'intro', 'Intro', '', 'countdown', 'desktop', 'intro', 'intro', '', '', 0, 0, 0, NULL, '', 'Intro', '', '', '', '', '', 'Sua empresa\n\nFone: [19] 0000-0000\ne-mail: contato@suaempresa.com.br\n\nacesse: <a href=\"www.purplepier.com.br\">www.purplepier.com.br</a>', '', '', '', '', '', 'Introdução do site', '', '', '', '', '', '', '', '', '', '', '', '', 1, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, NULL, '0', 0, 0, '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0, 0, 0, 0, 0, '0', '0', '0', '0', 0, '', 0),
(93, 0, 0, 'galeria', 'Galeria', '', 'galeria_simple', 'desktop', 'galeria', 'galeria', 'galeria', '', 0, 0, 0, NULL, NULL, '', '', '', '', '', '', NULL, NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 1, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', NULL, NULL, 0, 0, 0, 0, 0, 0, NULL, '0', 0, 0, '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0, 0, 0, 0, 0, '0', '0', '0', '0', 0, '', 0),
(96, 0, 0, 'downloads', 'Downloads', '', 'downloads_html5', 'desktop', 'downloads', 'downloads', 'downloads', '', 0, 0, 0, NULL, 'Downloads e arquivos', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 1, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, NULL, '', 0, 0, '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0, 0, 0, 0, 0, '0', '0', '0', '0', 0, '', 0),
(97, 0, 0, 'hiperlinks', 'Hiperlinks', '', 'hiperlinks_html5', 'desktop', 'hiperlinks', 'hiperlinks', 'hiperlinks', '', 0, 0, 0, NULL, 'Meus links favoritos', 'Links interessantes ', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 1, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'Links Interessantes', 0, 0, 0, 0, 0, 0, NULL, '0', 0, 0, '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0, 0, 0, 0, 0, '0', '0', '0', '0', 0, '', 0),
(11, 0, 0, 'termos', 'Termos e condições', '', 'horizontal_banner_html5', 'desktop', 'termos', 'verticalbanner', 'termos', 'termos', 0, 0, 0, NULL, 'Termos e condições', 'Acordo de Uso do Site', 'Conduta Online', 'Garantias; Limitação de Responsabilidade', 'Mudança no Site', 'Senhas', '', 'Por favor, leia cuidadosamente este Termo de aceite de Site de Internet.\r\n \r\nAo acessar qualquer área deste Site ou solicitar qualquer produto ou serviço através do uso deste Site, você concorda com os termos e condições estabelecidas neste Termo de aceite.\r\n\r\nEste Termo de aceite inclui, entre outras coisas, condições aplicáveis ao uso deste Site, condições aplicáveis à compra de produtos e serviços, e condições relativas a assuntos de direitos autorais e de marcas registradas.\r\n\r\nSe você não desejar assumir as obrigações destas condições, você não deve acessar ou utilizar este Site.\r\n\r\nNossa empresa pode modificar este Termo de aceite a qualquer tempo, e tais modificações serão imediatamente eficazes mediante a publicação do Termo de aceite modificado neste Site.\r\n\r\nVocê concorda em rever este Termo de aceite periodicamente para estar informado de tais modificações e a sua continuidade de acesso ou de uso deste Site será considerada como a sua aceitação incontroversa do Termo de aceite modificado.\r\n\r\n\r\n<b>Encerramento de Acesso; Sobrevivência de Condições</b>\r\n\r\nNossa empresa pode encerrar o seu acesso a todo ou parte deste Site sem notificação e sem responsabilidade com você, por qualquer conduta sua que nossa empresa, a seu exclusivo critério, acreditar que esteja violando este Termo de aceite.\r\n', 'É proibida qualquer conduta do Usuário que, a exclusivo critério de nossa empresa, viole qualquer direito de propriedade ou de terceiras partes, ou restrinja ou iniba qualquer outro usuário de usar ou desfrutar do Site. O Usuário somente usará o Site para propósitos legais.\r\n\r\nO Usuário não pode enviar ou transmitir por este Site qualquer material ilegal, prejudicial, ameaçador, abusivo, molestador, difamatório, vulgar, obsceno, sexualmente explícito, profano, odioso, racial, étnico, discriminatório ou de qualquer maneira censurável de qualquer forma, incluindo qualquer material que encoraja condutas que venham a constituir um delito criminal, dê origem a responsabilidade civil, ou de qualquer maneira viole as leis aplicáveis.\r\n\r\nÉ proibida qualquer conduta, comunicação, ou Conteúdo que seja (i) prejudicial ou censurável aos usuários individuais, ou seus afiliados, (ii) infração de qualquer direito ou de qualquer terceira parte, ou (iii) violação de qualquer lei aplicável.\r\nA determinação precedente estará sujeita ao exclusivo critério de nossa empresa.\r\n\r\nNão obstante o acima, nossa empresa não pode assegurar a imediata edição ou remoção do Conteúdo questionável depois de publicar online.', 'O uso deste Site é de risco exclusivo do Usuário.\r\nNossa empresa não garante que o uso deste Site estará ininterruptamente livre de erro; nem dá qualquer garantia acerca dos resultados que possam ser obtidos do uso deste Site, ou sobre a precisão, confiabilidade, ou atualidade de qualquer informação, conteúdo ou serviço.\r\n\r\nNOSSA EMPRESA ESTÁ PROVENDO ESTE SITE E SEU CONTEÚDO EM BASES \"COMO É, COMO ESTÁ DISPONÍVEL\" E NÃO FAZ NENHUMA REPRESENTAÇÃO OU DÁ GARANTIAS DE QUALQUER TIPO COM RESPEITO A ESTE SITE OU SEU CONTEÚDO.\r\n\r\nNOSSA EMPRESA  AQUI NEGA QUAISQUER REPRESENTAÇÕES E GARANTIAS, INCLUINDO MAS NÃO SE LIMITANDO A QUALQUER GARANTIA IMPLÍCITA DE QUALIDADE DE PRODUTO, APTIDÃO PARA UM PROPÓSITO PARTICULAR, DOCUMENTAÇÃO OU NÃO VIOLAÇÃO DE DIREITOS AUTORIAS.\r\n\r\nADEMAIS, NOSSA EMPRESA  NÃO REPRESENTA OU GARANTE QUE A INFORMAÇÃO ACESSÍVEL EM OU POR MEIO DESTE SITE É PRECISA, COMPLETA OU ATUAL, E TODA A INFORMAÇÃO, INCLUINDO PREÇOS E DISPONIBILIDADE, ESTÁ SUJEITA A MUDANÇA SEM NOTIFICAÇÃO PRÉVIA.\r\n\r\nNossa empresa não é responsável por danos que surjam do ou com relação ao uso deste Site, incluindo quaisquer falhas, omissões, interrupções, apagamentos de arquivos ou e-mail, erros, defeitos, vírus, ou demoras na operação ou transmissão. \r\n\r\nEsta é uma limitação que compreende a responsabilidade que se aplica a todos os danos de qualquer tipo, incluindo os compensatórios, e os danos diretos, indiretos ou conseqüentes, materiais ou morais, perdas de dados, rendas ou lucros cessantes, perdas de ou danificação de propriedade e reivindicações de terceiras partes.\r\nPolítica de Privacidade.\r\n\r\nNossa empresa respeita a privacidade dos usuários deste Site e a comunicação eletrônica pessoal de forma geral.\r\n\r\nNossa empresa não compartilha seu endereço de e-mail ou outra informação de perfil pessoal, como nome, endereço, sexo ou idade, com terceiras partes para propósitos de comercialização sem o seu consentimento prévio.\r\n\r\nO Usuário pode, de tempos em tempos, prover informações relativas aos seus gostos, avaliações, e preferências.\r\n\r\nNossa empresa não usa as suas informações de perfil pessoal do Usuário para criar um conteúdo, serviços, e propagandas personalizadas.\r\n\r\nNão obstante o acima e conforme as leis aplicáveis, nossa empresa (1) coopera completamente com o Estado, com funcionários locais e federais em qualquer investigação relativa a qualquer conteúdo (incluindo comunicações eletrônicas pessoais ou privadas transmitidas nossa empresa no ou por meio deste Site ou supostas atividades ilegais de qualquer usuário e (2) toma as medidas razoáveis para proteger seus direitos proprietários.\r\n\r\nPara os propósitos limitados de atender tal cooperação e medidas e conforme as leis aplicáveis, nossa empresa pode ser solicitada para revelar informação pessoal.\r\n\r\nAdicionalmente, nossa empresa pode escolher monitorar as áreas deste Site nas quais os usuários podem submeter materiais, e podem revelar qualquer Conteúdo, registros, ou comunicação eletrônica de qualquer tipo (i) para satisfazer qualquer lei, regulamento, ou pedido de governo; (ii) se tal revelação for necessária ou apropriada para operação de nossa empresa; ou (iii) para proteger os direitos ou propriedade da nossa empresa ou de outros.\r\n', 'Este Site está sujeito a mudança sem notificação prévia.', 'Para oferecer serviços personalizados, o Site poderá solicitar a criação de uma ou mais senhas para permitir o acesso a certos serviços ou seções.\nNinguém está autorizado a solicitar sua senha, sob qualquer pretexto, nem pessoalmente, nem por telefone, nem por e-mail.\n\nVocê é o único responsável pelo controle e utilização de cada senha criada.', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 1, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, NULL, '0', 0, 0, '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0, 0, 0, 0, 0, '0', '0', '0', '0', 0, '', 0),
(267, 0, 0, 'mural', 'Mural', '', 'mural_simples', 'desktop', 'mural', 'mural', 'mural', '', 0, 0, 0, NULL, 'Mural', '', '', '', '', '', '', NULL, NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 1, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', NULL, 'Mural', 0, 0, 0, 0, 0, 0, NULL, '0', 0, 0, '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0, 0, 0, 0, 0, '0', '0', '0', '0', 0, '', 0),
(105, 0, 0, 'politicaprivacidade', 'Política de privacidade', '', 'horizontal_banner_html5', 'desktop', 'politica_privacidade', 'verticalbanner', 'politica_privacidade', '', 0, 0, 0, NULL, 'Política de privacidade', 'Informações do Usuário', 'Sua privacidade é nossa preocupação. ', 'Sobre o Cadastro', 'Cookies', 'Segurança das Informações', '', 'Suas informações são importantes, pois nos ajudam a tornar o site um lugar melhor e cada vez mais direcionado à você, usuário, na busca de sua total satisfação.', 'Nossa política de privacidade visa assegurar a garantia de que, quaisquer informações relativas aos usuários, não serão fornecidas, publicadas ou comercializadas em quaisquer circunstâncias.\n\nNós obtemos informações dos usuários de duas maneiras: Cadastro e Cookies.', 'Para usufruir dos benefícios adicionais do site e receber o email com oportunidades, você precisa se cadastrar em nosso site. Este cadastro é armazenado em um banco de dados protegido e sigiloso. Qualquer comunicação enviada para seu email será através do boletim periódico. Seu email não será divulgado.', 'Coletamos informações através de cookies (informações enviadas pelo servidor ao computador do usuário, para identificá-lo). Os cookies servem unicamente para controle interno de audiência e de navegação e jamais para controlar, identificar ou rastrear preferências do internauta, exceto quando este desrespeitar alguma regra de segurança ou exercer alguma atividade prejudicial ao bom funcionamento do site, como por exemplo tentativas de hackear o serviço. \n\nA aceitação dos cookies pode ser livremente alterada na configuração de seu navegador.', 'Todos os dados pessoais informados ao nosso site são armazenados em um banco de dados reservado e com acesso restrito a alguns funcionários habilitados, que são obrigados, por contrato, a manter a confidencialidade das informações e não utilizá-las inadequadamente.\n\nAssegurar a sua privacidade é mais um compromisso nosso com você!', '', 'Porque optamos por armazenar algumas informações do usuário', 'Temos o compromisso de preservar sua privacidade.', 'Um bem necessário', 'Algumas preferências são salvas para melhorar desempenho de acesso e personalização de páginas', 'Dados armazenados com sigilo e segurança ', '', '', '', '', '', '', '', '', 1, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, NULL, '0', 0, 0, '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0, 0, 0, 0, 0, '0', '0', '0', '0', 0, '', 0),
(102, 0, 0, 'faq', 'FAQ', '', 'faq_simple_html5', 'desktop', 'faq', 'faq', 'faq', '', 0, 0, 0, NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 1, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, NULL, '', 0, 0, '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0, 0, 0, 0, 0, '0', '0', '0', '0', 0, '', 0),
(103, 0, 0, 'conta', 'Conta', '', 'login_simple', 'desktop', 'conta', 'conta', 'conta', '', 0, 0, 0, NULL, 'Conta', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 1, 0, 0, 0, 0, 'f_737', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, NULL, '0', 0, 0, '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0, 0, 0, 0, 0, '0', '0', '0', '0', 0, '', 0),
(104, 0, 0, 'loja_detalhes', 'Loja detalhes', '', 'detalhes_common_html5', 'desktop', 'loja_detalhes', 'loja', '', '', 0, 0, 0, NULL, 'Loja E-commerce', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 1, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, NULL, '0', 0, 0, '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0, 0, 0, 0, 0, '0', '0', '0', '0', 0, '', 0),
(265, 0, 0, 'loja', 'Loja', '', 'store_lines_cat_html5', 'desktop', 'loja', 'loja', 'loja', '', 0, 0, 0, NULL, 'Loja', '', '', '', '', '', '', NULL, NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 1, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', NULL, NULL, 0, 0, 0, 0, 0, 0, NULL, '0', 0, 0, '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0, 0, 0, 0, 0, '0', '0', '0', '0', 0, '', 0),
(116, 0, 0, 'users', 'Users', '', 'users', 'desktop', 'users', 'users', 'users', '', 0, 0, 0, NULL, NULL, '', '', '', '', '', '', NULL, NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 1, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', NULL, NULL, 0, 0, 0, 0, 0, 0, NULL, '0', 0, 0, '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0, 0, 0, 0, 0, '0', '0', '0', '0', 0, '', 0),
(122, 0, 0, 'showcase', 'Showcase', '', 'store_lines_cat_html5', 'desktop', 'loja', 'loja', 'loja', '', 0, 0, 0, NULL, 'Veja a listagem de nossos produtos', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 1, 0, 0, 0, NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, 0, 0, 0, 0, 0, 0, NULL, '0', 0, 0, '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0, 0, 0, 0, 0, '0', '0', '0', '0', 0, '', 0),
(128, 0, 0, 'rss', 'Rss', '', '', 'desktop', 'rss', 'rss', 'rss', '', 0, 0, 0, NULL, 'Rss', '', '', '', '', '', '', NULL, NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 1, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', NULL, 'RssFeeds', 0, 0, 0, 0, 0, 0, NULL, '0', 0, 0, '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0, 0, 0, 0, 0, '0', '0', '0', '0', 0, '', 0),
(266, 0, 0, 'contratar', 'Contratar', '', 'contratar_web', 'desktop', 'contratar', 'contratar', 'contratar', 'contratar, serviços, produtos', 0, 0, 0, NULL, 'Contratar', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 1, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'Contratar', 0, 0, 0, 0, 0, 0, NULL, 'Contrate nossos serviços utilizando essa página\nPreencha o formulário e aceites nossos termos para contratar', 0, 0, '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0, 0, 0, 0, 0, '0', '0', '0', '0', 0, '', 0),
(2, 0, 0, 'paginas', 'Paginas', '', '', 'desktop', 'categorias', 'paginas', 'paginas', '', 0, 0, 0, 0, NULL, '', '', '', '', '', '', NULL, NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 1, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', NULL, NULL, 0, 0, 0, 0, 0, 0, NULL, '0', 0, 0, '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0, 0, 0, 0, 0, '0', '0', '0', '0', 0, '', 0),
(131, 0, 0, 'depoimentos', 'Depoimentos', '', 'depoimentos_simples_html5', 'desktop', 'depoimentos', 'depoimentos', 'depoimentos', 'depoimentos', 0, 0, 0, 0, 'Depoimentos', 'Depoimentos de nossos usuários', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 1, 0, 1, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, NULL, '0', 0, 0, '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0, 0, 0, 0, 0, '0', '0', '0', '0', 0, '', 0),
(10, 0, 0, 'mapasite', 'Mapa site', '', 'mapa_site', 'desktop', '', 'mapa_site', 'mapa_site', 'mapa_site', 0, 0, 0, 0, 'Mapa do site', 'Veja todos nossos links e mais', '', '', '', '', '', '', '', '', '', '', '', 'Utilize-os para rápido acesso', '', '', '', '', '', '', '', '', '', '', '', '', 1, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'Mapa do site', '', 0, 0, 0, 0, 0, 0, NULL, '0', 0, 0, '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0, 0, 0, 0, 0, '0', '0', '0', '0', 0, '', 0),
(137, 0, 0, 'precos', 'Preços', '', 'precos_html5', 'desktop', 'precos', 'precos', 'precos', 'precos', 0, 0, 0, NULL, 'Tabela de Preços', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 1, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'Tabela de Preços', 0, 1, 0, 0, 0, 17, NULL, '0', 0, 0, '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0, 0, 0, 0, 0, '0', '0', '0', '0', 0, '', 0),
(138, 0, 0, 'erp_0', 'ERP', '', '', 'desktop', 'erp', 'erp', 'erp', '', 0, 0, 0, NULL, NULL, '', '', '', '', '', '', NULL, NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 1, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', NULL, NULL, 0, 0, 0, 0, 0, 0, NULL, '0', 0, 0, '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0, 0, 0, 0, 0, '0', '0', '0', '0', 0, '', 0),
(139, 0, 0, 'erp_1', 'ERP', '', '', 'desktop', 'erp', 'erp', 'erp', '', 0, 0, 0, NULL, NULL, '', '', '', '', '', '', NULL, NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 1, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', NULL, NULL, 0, 0, 0, 0, 0, 0, NULL, '0', 0, 0, '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0, 0, 0, 0, 0, '0', '0', '0', '0', 0, '', 0),
(210, 0, 0, 'pesquisas', 'Pesquisas', '', 'pesquisas_html5', 'desktop', 'pesquisas', 'pesquisas', 'pesquisas', '', 0, 0, 0, NULL, 'Pesquisas', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 1, 0, 1, 0, 0, 'f_978', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'Pesquisas', 0, 2, 0, 0, 0, 1, NULL, '0', 0, 0, '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0, 0, 0, 0, 0, '0', '0', '0', '0', 0, '', 0),
(238, 0, 0, 'buscar', 'Buscar', '', 'buscar', 'desktop', 'buscar', 'buscar', '', 'busca, buscador, palavras-chave', 0, 0, 0, 0, 'Buscar', 'Buscas', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 1, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'Busca', 0, 0, 0, 0, 0, 0, 1, 'Página de busca de nosso site\nPrecisa de algo mais específico? Faça uma busca', 0, 0, '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0, 0, 0, 0, 0, '0', '0', '0', '0', 0, '', 0),
(262, 0, 0, 'orcamentus', 'Orcamentus', '', 'orcamentus', 'desktop', 'orcamentus', 'orcamentus', 'orcamentus', '', 0, 0, 0, NULL, 'Orcamentus', '', '', '', '', '', '', NULL, NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 1, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', NULL, NULL, 0, 0, 0, 0, 0, 0, NULL, '0', 0, 0, '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0, 0, 0, 0, 0, '0', '0', '0', '0', 0, '', 0),
(270, 0, 0, 'anunciar', 'Anunciar', '', 'anunciar', 'desktop', 'anunciar', 'anunciar', '', 'anuncie, anúncios, anuncie aqui, faça sua propaganda conosco, publicidade online, publicidade dirigida', 0, 0, 0, NULL, 'Anunciar', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 1, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'Anunciar', 0, 0, 0, 0, 0, 0, NULL, 'Anuncie em nosso site e seja visto por milhares de pessoas\nAcesse nossa página e veja como é fácil anunciar aqui', 0, 0, '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0, 0, 0, 0, 0, '0', '0', '0', '0', 0, '', 0),
(271, 0, 0, 'autos', 'Autos', '', 'auto_simples', 'desktop', 'autos', 'autos', '', 'automóveis, veículos, motos, carros, caminhões', 0, 0, 0, NULL, 'Veículos', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 1, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'Veículos', 0, 0, 0, 0, 0, 0, NULL, 'Veja nossa sessão de Veículos\nConfira tudo que separamos para você, seu próximo veículo pode estar aqui', 0, 0, '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0, 0, 0, 0, 0, '0', '0', '0', '0', 0, '', 0),
(272, 0, 0, 'autos_detalhes', 'Veículo Detalhes', '', 'autos_detalhes_simples', 'desktop', 'autos', 'autos', '', '', 0, 0, 0, NULL, 'Detalhes do veículo', '', '', '', '', '', '', NULL, NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 1, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', NULL, 'Veículos', 0, 0, 0, 0, 0, 0, NULL, 'Veículos', 0, 0, '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0, 0, 0, 0, 0, '0', '0', '0', '0', 0, '', 0),
(275, 0, 0, 'portfolio', 'Portfólio', '', 'portfolio_simples', 'desktop', 'portfolio', 'portfolio', '', 'portfolio', 0, 0, 0, NULL, 'Portfólio', '', '', '', '', '', '', NULL, NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 1, 0, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', NULL, 'Portfólio', 0, 0, 0, 0, 0, 0, NULL, 'Portfólio', 0, 1, '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0, 0, 0, 0, 0, '0', '0', '0', '0', 0, '', 0),
(273, 0, 0, 'servicos', 'Serviços', '', 'servicos_simples', 'desktop', 'servicos', 'servicos', '', 'serviços, consultorias, ', 0, 0, 0, NULL, 'Serviços', '', '', '', '', '', '', NULL, NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 1, 0, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', NULL, 'Serviços', 0, 0, 0, 0, 0, 0, NULL, 'Serviços', 0, 1, '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0, 0, 0, 0, 0, '0', '0', '0', '0', 0, '', 0),
(274, 0, 0, 'servicos_detalhes', 'Detalhes do serviço', '', 'servicos_simples_detalhes', 'desktop', 'servicos', 'servicos', '', 'servicos', 0, 0, 0, NULL, 'Serviços detalhes', '', '', '', '', '', '', NULL, NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 1, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', NULL, 'Serviços', 0, 0, 0, 0, 0, 0, NULL, 'Serviços', 0, 1, '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0, 0, 0, 0, 0, '0', '0', '0', '0', 0, '', 0),
(276, 0, 0, 'portfolio_detalhes', 'Portfolio Detalhes', '', 'portfolio_simples_detalhes', 'desktop', 'portfolio', 'portfolio', '', 'portfolio', 0, 0, 0, NULL, 'Portfólio', '', '', '', '', '', '', NULL, NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 1, 0, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', NULL, 'Portfólio detalhes', 0, 0, 0, 0, 0, 0, NULL, 'Portfólio Detalhes', 0, 0, '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0, 0, 0, 0, 0, '0', '0', '0', '0', 0, '', 0),
(277, 0, 0, 'ensino', 'Ensino', '', 'ensino_simples', 'desktop', 'ensino', 'ensino', '', 'ensino', 0, 0, 0, NULL, 'Ensino', '', '', '', '', '', '', NULL, NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 1, 0, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', NULL, 'Ensino', 0, 0, 0, 0, 0, 0, NULL, 'Ensino', 0, 1, '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0, 0, 0, 0, 0, '0', '0', '0', '0', 0, '', 0),
(278, 0, 0, 'forum', 'Fórum', '', 'forum_simple', 'desktop', 'forum', 'forum', '', 'forum', 0, 0, 0, NULL, 'Fórum', '', '', '', '', '', '', NULL, NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 1, 0, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', NULL, 'Fórum', 0, 0, 0, 0, 1, 0, NULL, 'Fórum', 0, 1, '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0, 0, 0, 0, 0, '0', '0', '0', '0', 0, '', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `paginas_modulos`
--

CREATE TABLE `paginas_modulos` (
  `id` int(11) NOT NULL,
  `id_row` int(11) NOT NULL,
  `layout` varchar(50) NOT NULL,
  `tipo` varchar(50) NOT NULL,
  `amount` int(11) NOT NULL,
  `divider` int(11) NOT NULL DEFAULT '0',
  `extra` varchar(100) DEFAULT NULL,
  `titulo` varchar(150) NOT NULL DEFAULT '0',
  `descricao` varchar(1000) NOT NULL DEFAULT '0',
  `id_menu` int(11) NOT NULL DEFAULT '0',
  `link_special` varchar(150) NOT NULL DEFAULT '0',
  `n_index` int(2) NOT NULL DEFAULT '0',
  `exibe` int(2) NOT NULL DEFAULT '0',
  `exibe_horizontal` int(2) NOT NULL DEFAULT '0',
  `layout2` int(2) NOT NULL DEFAULT '0',
  `flag1` int(2) NOT NULL DEFAULT '0',
  `flag2` int(2) NOT NULL DEFAULT '0',
  `image` varchar(200) NOT NULL DEFAULT '0',
  `link_modo` int(2) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `paginas_rows`
--

CREATE TABLE `paginas_rows` (
  `id` int(11) NOT NULL,
  `id_page` int(11) NOT NULL,
  `layout` varchar(50) NOT NULL,
  `slots` int(2) NOT NULL,
  `n_index` int(11) NOT NULL,
  `titulo` varchar(100) NOT NULL DEFAULT '0',
  `tipo` varchar(50) NOT NULL DEFAULT '0',
  `exibe` int(2) NOT NULL DEFAULT '0',
  `id_componente` int(11) NOT NULL DEFAULT '0',
  `json` longtext NOT NULL,
  `cool` varchar(150) NOT NULL DEFAULT '0',
  `label` varchar(300) NOT NULL DEFAULT '0',
  `p_x_un` int(11) NOT NULL DEFAULT '0',
  `p_y_un` int(2) NOT NULL DEFAULT '0',
  `p_x` int(11) NOT NULL DEFAULT '0',
  `p_y` int(11) NOT NULL DEFAULT '0',
  `posin_x` int(11) NOT NULL DEFAULT '0',
  `posin_y` int(11) NOT NULL DEFAULT '0',
  `posin_x_un` int(2) NOT NULL DEFAULT '0',
  `posin_y_un` int(2) NOT NULL DEFAULT '0',
  `iniciar` int(11) NOT NULL DEFAULT '0',
  `saida` int(11) NOT NULL DEFAULT '0',
  `duracao_in` int(11) NOT NULL DEFAULT '0',
  `show_until` int(11) NOT NULL DEFAULT '0',
  `width` int(11) NOT NULL DEFAULT '0',
  `height` int(11) NOT NULL DEFAULT '0',
  `width_un` int(2) NOT NULL DEFAULT '0',
  `height_un` int(2) NOT NULL DEFAULT '0',
  `fade` int(2) NOT NULL DEFAULT '0',
  `texto` longtext NOT NULL,
  `descricao` longtext NOT NULL,
  `fonte` varchar(400) NOT NULL DEFAULT '0',
  `tamanho` varchar(400) NOT NULL DEFAULT '0',
  `alinhamento` varchar(50) NOT NULL DEFAULT '0',
  `color` varchar(50) NOT NULL DEFAULT '0',
  `color2` varchar(50) NOT NULL DEFAULT '0',
  `tema` varchar(50) NOT NULL DEFAULT '0',
  `sombra` int(2) NOT NULL DEFAULT '0',
  `src` varchar(300) NOT NULL DEFAULT '0',
  `link` varchar(1000) NOT NULL DEFAULT '0',
  `target` int(2) NOT NULL DEFAULT '0',
  `efeito` varchar(300) NOT NULL DEFAULT '0',
  `modelo` int(3) NOT NULL DEFAULT '0',
  `is_container` int(2) NOT NULL DEFAULT '0',
  `is_centered` int(2) NOT NULL DEFAULT '0',
  `subtitulo` varchar(400) NOT NULL DEFAULT '0',
  `fonte_titulo` varchar(100) NOT NULL DEFAULT '0',
  `fonte_subtitulo` varchar(100) NOT NULL DEFAULT '0',
  `alinhamento_titulo` varchar(50) NOT NULL DEFAULT '0',
  `alinhamento_subtitulo` varchar(50) NOT NULL DEFAULT '0',
  `color_titulo` varchar(50) NOT NULL DEFAULT '0',
  `color_subtitulo` varchar(50) NOT NULL DEFAULT '0',
  `tamanho_titulo` varchar(50) NOT NULL DEFAULT '0',
  `tamanho_subtitulo` varchar(50) NOT NULL DEFAULT '0',
  `sombra_titulo` int(2) NOT NULL DEFAULT '0',
  `sombra_subtitulo` int(2) NOT NULL DEFAULT '0',
  `tema_titulo` varchar(50) NOT NULL DEFAULT '0',
  `tema_subtitulo` varchar(50) NOT NULL DEFAULT '0',
  `color_botao` varchar(50) NOT NULL DEFAULT '0',
  `tema_botao` varchar(50) NOT NULL DEFAULT '0',
  `alinhamento_botao` varchar(50) NOT NULL DEFAULT '0',
  `color_label` varchar(50) NOT NULL DEFAULT '0',
  `df_titulo` longtext NOT NULL,
  `df_subtitulo` longtext NOT NULL,
  `df_texto` longtext NOT NULL,
  `df_bloco` longtext NOT NULL,
  `titulo_bl_1` varchar(400) NOT NULL DEFAULT '0',
  `titulo_bl_2` varchar(400) NOT NULL DEFAULT '0',
  `titulo_bl_3` varchar(400) NOT NULL DEFAULT '0',
  `titulo_bl_4` varchar(400) NOT NULL DEFAULT '0',
  `subtitulo_bl_1` varchar(400) NOT NULL DEFAULT '0',
  `subtitulo_bl_2` varchar(400) NOT NULL DEFAULT '0',
  `subtitulo_bl_3` varchar(400) NOT NULL DEFAULT '0',
  `subtitulo_bl_4` varchar(400) NOT NULL DEFAULT '0',
  `texto_bl_1` longtext NOT NULL,
  `texto_bl_2` longtext NOT NULL,
  `texto_bl_3` longtext NOT NULL,
  `texto_bl_4` longtext NOT NULL,
  `qtd_blocos` int(3) NOT NULL DEFAULT '0',
  `borda_componente` varchar(50) NOT NULL DEFAULT '0',
  `background` varchar(100) NOT NULL DEFAULT '0',
  `df_titulo_bl_1` longtext NOT NULL,
  `df_titulo_bl_2` longtext NOT NULL,
  `df_titulo_bl_3` longtext NOT NULL,
  `df_titulo_bl_4` longtext NOT NULL,
  `df_subtitulo_bl_1` longtext NOT NULL,
  `df_subtitulo_bl_2` longtext NOT NULL,
  `df_subtitulo_bl_3` longtext NOT NULL,
  `df_subtitulo_bl_4` longtext NOT NULL,
  `df_texto_bl_1` longtext NOT NULL,
  `df_texto_bl_2` longtext NOT NULL,
  `df_texto_bl_3` longtext NOT NULL,
  `df_texto_bl_4` longtext NOT NULL,
  `df_bl_1` longtext NOT NULL,
  `df_bl_2` longtext NOT NULL,
  `df_bl_3` longtext NOT NULL,
  `df_bl_4` longtext NOT NULL,
  `url` varchar(100) NOT NULL DEFAULT '0',
  `margin_top` varchar(50) NOT NULL DEFAULT '0',
  `margin_bottom` varchar(50) NOT NULL DEFAULT '0',
  `padding_top` varchar(50) NOT NULL DEFAULT '0',
  `padding_bottom` varchar(50) NOT NULL DEFAULT '0',
  `df_componente` longtext NOT NULL,
  `id_general` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `pedidos_attribute`
--

CREATE TABLE `pedidos_attribute` (
  `id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `value_string` varchar(45) DEFAULT NULL,
  `value_int` int(11) DEFAULT NULL,
  `value_float` float DEFAULT NULL,
  `parent` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `pedidos_attribute`
--

INSERT INTO `pedidos_attribute` (`id`, `name`, `value_string`, `value_int`, `value_float`, `parent`) VALUES
(1, 'especializacao', 'Administra??o Geral', NULL, NULL, '392'),
(2, 'especializacao', 'Arquivo', NULL, NULL, '392'),
(3, 'especializacao', 'Contas ? pagar e receber', NULL, NULL, '392'),
(4, 'especializacao', 'Departamento Pessoal', NULL, NULL, '392'),
(5, 'especializacao', 'Mensageiros', NULL, NULL, '392'),
(6, 'especializacao', 'Outros', NULL, NULL, '392'),
(7, 'especializacao', 'Recep?', NULL, NULL, '392'),
(8, 'especializacao', 'Secretariado', NULL, NULL, '392'),
(9, 'especializacao', 'Tesouraria', NULL, NULL, '392'),
(10, 'especializacao', 'Agricultura', NULL, NULL, '393'),
(11, 'especializacao', 'Agronomia, Agrobusiness', NULL, NULL, '393'),
(12, 'especializacao', 'Ca?a e pesca', NULL, NULL, '393'),
(13, 'especializacao', 'Enologia / Viticultura', NULL, NULL, '393'),
(14, 'especializacao', 'Outros', NULL, NULL, '393'),
(15, 'especializacao', 'Pecu?ria', NULL, NULL, '393'),
(16, 'especializacao', 'Veterin?ria', NULL, NULL, '393'),
(17, 'especializacao', 'Zootecnia', NULL, NULL, '393'),
(18, 'especializacao', 'A?ougue', NULL, NULL, '394'),
(19, 'especializacao', 'Atendente / Recep??o / Gar?om', NULL, NULL, '394'),
(20, 'especializacao', 'Confeiteiro', NULL, NULL, '394'),
(21, 'especializacao', 'Copa', NULL, NULL, '394'),
(22, 'especializacao', 'Cozinha', NULL, NULL, '394'),
(23, 'especializacao', 'Degusta?', NULL, NULL, '394'),
(24, 'especializacao', 'Gastronomia', NULL, NULL, '394'),
(25, 'especializacao', 'Outros', NULL, NULL, '394'),
(26, 'especializacao', 'Padaria', NULL, NULL, '394'),
(27, 'especializacao', 'Arquitetura, urbanismo', NULL, NULL, '395'),
(28, 'especializacao', 'Desenho industrial', NULL, NULL, '395'),
(29, 'especializacao', 'Desenho de interiores / Decora?', NULL, NULL, '395'),
(30, 'especializacao', 'Outros', NULL, NULL, '395'),
(31, 'especializacao', 'Paisagismo', NULL, NULL, '395'),
(32, 'especializacao', 'Projetista', NULL, NULL, '395'),
(33, 'especializacao', 'Artes c?nicas', NULL, NULL, '396'),
(34, 'especializacao', 'Artes gr?ficas', NULL, NULL, '396'),
(35, 'especializacao', 'Artes pl?sticas', NULL, NULL, '396'),
(36, 'especializacao', 'Artesanato', NULL, NULL, '396'),
(37, 'especializacao', 'M?sica', NULL, NULL, '396'),
(38, 'especializacao', 'Outros', NULL, NULL, '396'),
(39, 'especializacao', 'Auditoria externa', NULL, NULL, '397'),
(40, 'especializacao', 'Auditoria interna', NULL, NULL, '397'),
(41, 'especializacao', 'Outros', NULL, NULL, '397'),
(42, 'especializacao', 'Antropologia', NULL, NULL, '398'),
(43, 'especializacao', 'Arquivologia', NULL, NULL, '398'),
(44, 'especializacao', 'Astronomia', NULL, NULL, '398'),
(45, 'especializacao', 'Atu?ria', NULL, NULL, '398'),
(46, 'especializacao', 'Biblioteconomia', NULL, NULL, '398'),
(47, 'especializacao', 'Biotecnologia', NULL, NULL, '398'),
(48, 'especializacao', 'Metereologia', NULL, NULL, '398'),
(49, 'especializacao', 'Outros', NULL, NULL, '398'),
(50, 'especializacao', 'Pesquisa / Desenvolvimento', NULL, NULL, '398'),
(51, 'especializacao', 'Topografia', NULL, NULL, '398'),
(52, 'especializacao', 'Atendimento', NULL, NULL, '399'),
(53, 'especializacao', 'Cartazista', NULL, NULL, '399'),
(54, 'especializacao', 'Corretagem', NULL, NULL, '399'),
(55, 'especializacao', 'Demonstrador / Promotor', NULL, NULL, '399'),
(56, 'especializacao', 'Lojas / Shopping / Varejo', NULL, NULL, '399'),
(57, 'especializacao', 'Outros', NULL, NULL, '399'),
(58, 'especializacao', 'Panfletagem', NULL, NULL, '399'),
(59, 'especializacao', 'Representa??o comercial', NULL, NULL, '399'),
(60, 'especializacao', 'Venda externa', NULL, NULL, '399'),
(61, 'especializacao', 'Venda interna', NULL, NULL, '399'),
(62, 'especializacao', 'Venda t?cnica', NULL, NULL, '399'),
(63, 'especializacao', 'Com?rcio exterior / Trader', NULL, NULL, '400'),
(64, 'especializacao', 'Importa??o / Exporta?', NULL, NULL, '400'),
(65, 'especializacao', 'Outros', NULL, NULL, '400'),
(66, 'especializacao', 'Rela??es internacionais', NULL, NULL, '400'),
(67, 'especializacao', 'Almoxarifado', NULL, NULL, '401'),
(68, 'especializacao', 'Compras', NULL, NULL, '401'),
(69, 'especializacao', 'Outros', NULL, NULL, '401'),
(70, 'especializacao', 'Suprimentos', NULL, NULL, '401'),
(71, 'especializacao', 'Assessoria de imprensa', NULL, NULL, '402'),
(72, 'especializacao', 'Audiovisual', NULL, NULL, '402'),
(73, 'especializacao', 'Cenografia', NULL, NULL, '402'),
(74, 'especializacao', 'Cinema', NULL, NULL, '402'),
(75, 'especializacao', 'Editora?', NULL, NULL, '402'),
(76, 'especializacao', 'Fotografia', NULL, NULL, '402'),
(77, 'especializacao', 'Jornalismo', NULL, NULL, '402'),
(78, 'especializacao', 'Outros', NULL, NULL, '402'),
(79, 'especializacao', 'Produ?', NULL, NULL, '402'),
(80, 'especializacao', 'Publicidade e propaganda', NULL, NULL, '402'),
(81, 'especializacao', 'R?dio', NULL, NULL, '402'),
(82, 'especializacao', 'Rela??es p?blicas', NULL, NULL, '402'),
(83, 'especializacao', 'Televis', NULL, NULL, '402'),
(84, 'especializacao', 'Bombeiro', NULL, NULL, '403'),
(85, 'especializacao', 'Constru??o civ', NULL, NULL, '403'),
(86, 'especializacao', 'Eletricista', NULL, NULL, '403'),
(87, 'especializacao', 'Encanamento', NULL, NULL, '403'),
(88, 'especializacao', 'Instala??es em geral', NULL, NULL, '403'),
(89, 'especializacao', 'Lavagem de autom?veis', NULL, NULL, '403'),
(90, 'especializacao', 'Manuten??o de maquinar', NULL, NULL, '403'),
(91, 'especializacao', 'Manuten??o e instala??es', NULL, NULL, '403'),
(92, 'especializacao', 'Manuten??o el?trica', NULL, NULL, '403'),
(93, 'especializacao', 'Manuten??o em geral', NULL, NULL, '403'),
(94, 'especializacao', 'Manuten??o hidr?ulica', NULL, NULL, '403'),
(95, 'especializacao', 'Manuten??o mec?nica', NULL, NULL, '403'),
(96, 'especializacao', 'Mec?nica de autom?veis', NULL, NULL, '403'),
(97, 'especializacao', 'Outros', NULL, NULL, '403'),
(98, 'especializacao', 'Pintura', NULL, NULL, '403'),
(99, 'especializacao', 'Polimento', NULL, NULL, '403'),
(100, 'especializacao', 'Banc?ria', NULL, NULL, '404'),
(101, 'especializacao', 'Contabilidade', NULL, NULL, '404'),
(102, 'especializacao', 'Controladoria', NULL, NULL, '404'),
(103, 'especializacao', 'Cr?dito e cobran', NULL, NULL, '404'),
(104, 'especializacao', 'Custos', NULL, NULL, '404'),
(105, 'especializacao', 'Economia', NULL, NULL, '404'),
(106, 'especializacao', 'Finan?as', NULL, NULL, '404'),
(107, 'especializacao', 'Fiscal', NULL, NULL, '404'),
(108, 'especializacao', 'Outros', NULL, NULL, '404'),
(109, 'especializacao', 'Anima??o / Recrea??o cultural', NULL, NULL, '405'),
(110, 'especializacao', 'Entretenimento', NULL, NULL, '405'),
(111, 'especializacao', 'Outros', NULL, NULL, '405'),
(112, 'especializacao', 'Biologia', NULL, NULL, '406'),
(113, 'especializacao', 'Biotecnologia', NULL, NULL, '406'),
(114, 'especializacao', 'Ci?ncias sociais', NULL, NULL, '406'),
(115, 'especializacao', 'Creche', NULL, NULL, '406'),
(116, 'especializacao', 'Educa??o de jovens e adultos', NULL, NULL, '406'),
(117, 'especializacao', 'Educa??o especial', NULL, NULL, '406'),
(118, 'especializacao', 'Educa??o f?sica', NULL, NULL, '406'),
(119, 'especializacao', 'Educa??o infantil', NULL, NULL, '406'),
(120, 'especializacao', 'Ensino fundamental', NULL, NULL, '406'),
(121, 'especializacao', 'Ensino m?dio', NULL, NULL, '406'),
(122, 'especializacao', 'Ensino particular', NULL, NULL, '406'),
(123, 'especializacao', 'Ensino superior', NULL, NULL, '406'),
(124, 'especializacao', 'Ensino t?cnico profissionalizante', NULL, NULL, '406'),
(125, 'especializacao', 'Esportes', NULL, NULL, '406'),
(126, 'especializacao', 'Estat?stica', NULL, NULL, '406'),
(127, 'especializacao', 'Filosofia', NULL, NULL, '406'),
(128, 'especializacao', 'F?sica', NULL, NULL, '406'),
(129, 'especializacao', 'Geografia, Geologia, Geof?sica', NULL, NULL, '406'),
(130, 'especializacao', 'Inspetor de alunos', NULL, NULL, '406'),
(131, 'especializacao', 'Instrutor / Monitor', NULL, NULL, '406'),
(132, 'especializacao', 'Letras', NULL, NULL, '406'),
(133, 'especializacao', 'L?ngua estrangeira: Alem', NULL, NULL, '406'),
(134, 'especializacao', 'L?ngua estrangeira: Espanhol', NULL, NULL, '406'),
(135, 'especializacao', 'L?ngua estrangeira: Franc', NULL, NULL, '406'),
(136, 'especializacao', 'L?ngua estrangeira: Ingl', NULL, NULL, '406'),
(137, 'especializacao', 'L?ngua estrangeira: Italiano', NULL, NULL, '406'),
(138, 'especializacao', 'L?ngua estrangeira: outros', NULL, NULL, '406'),
(139, 'especializacao', 'Matem?tica', NULL, NULL, '406'),
(140, 'especializacao', 'Metereologia', NULL, NULL, '406'),
(141, 'especializacao', 'Museologia', NULL, NULL, '406'),
(142, 'especializacao', 'Oceanografia', NULL, NULL, '406'),
(143, 'especializacao', 'Outros', NULL, NULL, '406'),
(144, 'especializacao', 'Pr?-escola', NULL, NULL, '406'),
(145, 'especializacao', 'Secretariado escolar', NULL, NULL, '406'),
(146, 'especializacao', 'Sociologia', NULL, NULL, '406'),
(147, 'especializacao', 'Tradu?', NULL, NULL, '406'),
(148, 'especializacao', 'Engenharia aeroespacial, aeron?utica', NULL, NULL, '407'),
(149, 'especializacao', 'Engenharia agron?mica', NULL, NULL, '407'),
(150, 'especializacao', 'Engenharia de alimentos', NULL, NULL, '407'),
(151, 'especializacao', 'Engenharia ambiental, ecologia', NULL, NULL, '407'),
(152, 'especializacao', 'Engenharia da computa?', NULL, NULL, '407'),
(153, 'especializacao', 'Engenharia de automa?', NULL, NULL, '407'),
(154, 'especializacao', 'Engenharia el?trica, eletr?nica', NULL, NULL, '407'),
(155, 'especializacao', 'Engenharia geol?gica / Mineira', NULL, NULL, '407'),
(156, 'especializacao', 'Engenharia industrial, produ?', NULL, NULL, '407'),
(157, 'especializacao', 'Engenharia mec?nica, mecatr?nica', NULL, NULL, '407'),
(158, 'especializacao', 'Engenharia metalurgica e de materiais', NULL, NULL, '407'),
(159, 'especializacao', 'Engenharia naval', NULL, NULL, '407'),
(160, 'especializacao', 'Engenharia nuclear', NULL, NULL, '407'),
(161, 'especializacao', 'Engenharia petroleira', NULL, NULL, '407'),
(162, 'especializacao', 'Engenharia qu?mica', NULL, NULL, '407'),
(163, 'especializacao', 'Engenharia de seguran?a do trabalho', NULL, NULL, '407'),
(164, 'especializacao', 'Engenharia de telecomunica??es', NULL, NULL, '407'),
(165, 'especializacao', 'Engenharia t?xtil', NULL, NULL, '407'),
(166, 'especializacao', 'Outros', NULL, NULL, '407'),
(167, 'especializacao', 'Pl?stico', NULL, NULL, '407'),
(168, 'especializacao', 'Cabeleireiro', NULL, NULL, '408'),
(169, 'especializacao', 'Depila?', NULL, NULL, '408'),
(170, 'especializacao', 'Est?tica corporal', NULL, NULL, '408'),
(171, 'especializacao', 'Esteticista', NULL, NULL, '408'),
(172, 'especializacao', 'Manicure / Pedicure', NULL, NULL, '408'),
(173, 'especializacao', 'Maquiagem', NULL, NULL, '408'),
(174, 'especializacao', 'Outros', NULL, NULL, '408'),
(175, 'especializacao', 'Pod?logo / Calista', NULL, NULL, '408'),
(176, 'especializacao', 'Camareiro, servente de limpeza', NULL, NULL, '409'),
(177, 'especializacao', 'Ecoturismo', NULL, NULL, '409'),
(178, 'especializacao', 'Hotelaria', NULL, NULL, '409'),
(179, 'especializacao', 'Outros', NULL, NULL, '409'),
(180, 'especializacao', 'Recep?', NULL, NULL, '409'),
(181, 'especializacao', 'Turismo', NULL, NULL, '409'),
(182, 'especializacao', 'Viagens', NULL, NULL, '409'),
(183, 'especializacao', 'Automa??o industrial', NULL, NULL, '410'),
(184, 'especializacao', 'Caldeira', NULL, NULL, '410'),
(185, 'especializacao', 'Carpintaria / Montagem de m?veis', NULL, NULL, '410'),
(186, 'especializacao', 'Colorista / Colorimetrista', NULL, NULL, '410'),
(187, 'especializacao', 'Embalador', NULL, NULL, '410'),
(188, 'especializacao', 'Ferramentaria', NULL, NULL, '410'),
(189, 'especializacao', 'Fresaria', NULL, NULL, '410'),
(190, 'especializacao', 'Fundi?', NULL, NULL, '410'),
(191, 'especializacao', 'Impress', NULL, NULL, '410'),
(192, 'especializacao', 'Instrumenta??o industrial', NULL, NULL, '410'),
(193, 'especializacao', 'Lubrifica??o de m?quinas e equipamentos', NULL, NULL, '410'),
(194, 'especializacao', 'Mandrilagem', NULL, NULL, '410'),
(195, 'especializacao', 'Metrologia', NULL, NULL, '410'),
(196, 'especializacao', 'Operador de dobradeira', NULL, NULL, '410'),
(197, 'especializacao', 'Operador de eletroeros', NULL, NULL, '410'),
(198, 'especializacao', 'Operador de empilhadeira', NULL, NULL, '410'),
(199, 'especializacao', 'Operador de guilhotina', NULL, NULL, '410'),
(200, 'especializacao', 'Operador de injetora', NULL, NULL, '410'),
(201, 'especializacao', 'Operador de m?quinas', NULL, NULL, '410'),
(202, 'especializacao', 'Operador de torno', NULL, NULL, '410'),
(203, 'especializacao', 'Outros', NULL, NULL, '410'),
(204, 'especializacao', 'PCP', NULL, NULL, '410'),
(205, 'especializacao', 'Preparador de m?quinas e equipamentos', NULL, NULL, '410'),
(206, 'especializacao', 'Produ?', NULL, NULL, '410'),
(207, 'especializacao', 'Retificador', NULL, NULL, '410'),
(208, 'especializacao', 'Serigrafista', NULL, NULL, '410'),
(209, 'especializacao', 'Serralheiro', NULL, NULL, '410'),
(210, 'especializacao', 'Usinagem', NULL, NULL, '410'),
(211, 'especializacao', 'Admnistrador de banco de dados', NULL, NULL, '411'),
(212, 'especializacao', 'Admnistrador de redes', NULL, NULL, '411'),
(213, 'especializacao', 'An?lise de sistema', NULL, NULL, '411'),
(214, 'especializacao', 'Arquitetura de solu??es', NULL, NULL, '411'),
(215, 'especializacao', 'CRM / Sistemas integrados', NULL, NULL, '411'),
(216, 'especializacao', 'Diagrama?', NULL, NULL, '411'),
(217, 'especializacao', 'Digitador', NULL, NULL, '411'),
(218, 'especializacao', 'E-commerce', NULL, NULL, '411'),
(219, 'especializacao', 'E-learning', NULL, NULL, '411'),
(220, 'especializacao', 'Hardware', NULL, NULL, '411'),
(221, 'especializacao', 'Inform?tica', NULL, NULL, '411'),
(222, 'especializacao', 'Instrutor / Monitor', NULL, NULL, '411'),
(223, 'especializacao', 'Internet', NULL, NULL, '411'),
(224, 'especializacao', 'Montagem e manuten??o de micros', NULL, NULL, '411'),
(225, 'especializacao', 'Operador de computador', NULL, NULL, '411'),
(226, 'especializacao', 'Outros', NULL, NULL, '411'),
(227, 'especializacao', 'Processamento de dados', NULL, NULL, '411'),
(228, 'especializacao', 'Produ?', NULL, NULL, '411'),
(229, 'especializacao', 'Programador / Desenvolvedor', NULL, NULL, '411'),
(230, 'especializacao', 'Rob?tica', NULL, NULL, '411'),
(231, 'especializacao', 'Seguran?a da informa?', NULL, NULL, '411'),
(232, 'especializacao', 'Software house', NULL, NULL, '411'),
(233, 'especializacao', 'Suporte t?cnico', NULL, NULL, '411'),
(234, 'especializacao', 'Telecom', NULL, NULL, '411'),
(235, 'especializacao', 'Telecomunica??es', NULL, NULL, '411'),
(236, 'especializacao', 'TI', NULL, NULL, '411'),
(237, 'especializacao', 'Web Design', NULL, NULL, '411'),
(238, 'especializacao', 'Admnistrativo', NULL, NULL, '412'),
(239, 'especializacao', 'Advocacia geral', NULL, NULL, '412'),
(240, 'especializacao', 'Cart?rio', NULL, NULL, '412'),
(241, 'especializacao', 'C?vil', NULL, NULL, '412'),
(242, 'especializacao', 'Criminal', NULL, NULL, '412'),
(243, 'especializacao', 'Direitos autorais', NULL, NULL, '412'),
(244, 'especializacao', 'Imobili?rio', NULL, NULL, '412'),
(245, 'especializacao', 'Outros', NULL, NULL, '412'),
(246, 'especializacao', 'Previdenci?rio', NULL, NULL, '412'),
(247, 'especializacao', 'Trabalhista', NULL, NULL, '412'),
(248, 'especializacao', 'Tribut?rio', NULL, NULL, '412'),
(249, 'especializacao', 'Armazenagem', NULL, NULL, '413'),
(250, 'especializacao', 'Distribu??', NULL, NULL, '413'),
(251, 'especializacao', 'Estoque', NULL, NULL, '413'),
(252, 'especializacao', 'Log?stica', NULL, NULL, '413'),
(253, 'especializacao', 'Operadores', NULL, NULL, '413'),
(254, 'especializacao', 'Outros', NULL, NULL, '413'),
(255, 'especializacao', 'Rotas', NULL, NULL, '413'),
(256, 'especializacao', 'Transporte', NULL, NULL, '413'),
(257, 'especializacao', 'Comunica?', NULL, NULL, '414'),
(258, 'especializacao', 'Desenvolvimento de produto', NULL, NULL, '414'),
(259, 'especializacao', 'Estrat?gia', NULL, NULL, '414'),
(260, 'especializacao', 'Intelig?ncia de mercado', NULL, NULL, '414'),
(261, 'especializacao', 'Marca', NULL, NULL, '414'),
(262, 'especializacao', 'Marketing', NULL, NULL, '414'),
(263, 'especializacao', 'Outros', NULL, NULL, '414'),
(264, 'especializacao', 'Propaganda', NULL, NULL, '414'),
(265, 'especializacao', 'Auditoria ambiental', NULL, NULL, '415'),
(266, 'especializacao', 'Ecologia', NULL, NULL, '415'),
(267, 'especializacao', 'Gest?o ambiental', NULL, NULL, '415'),
(268, 'especializacao', 'Metereologia', NULL, NULL, '415'),
(269, 'especializacao', 'Outros', NULL, NULL, '415'),
(270, 'especializacao', 'Saneamento ambiental', NULL, NULL, '415'),
(271, 'especializacao', 'Vigil?ncia sanit?ria e sa?de ambiental', NULL, NULL, '415'),
(272, 'especializacao', 'Costura', NULL, NULL, '416'),
(273, 'especializacao', 'Estilismo', NULL, NULL, '416'),
(274, 'especializacao', 'Moda', NULL, NULL, '416'),
(275, 'especializacao', 'Modelo, Manequim', NULL, NULL, '416'),
(276, 'especializacao', 'Outros', NULL, NULL, '416'),
(277, 'especializacao', 'Vitrinismo', NULL, NULL, '416'),
(278, 'especializacao', 'Controle de qualidade', NULL, NULL, '417'),
(279, 'especializacao', 'Outros', NULL, NULL, '417'),
(280, 'especializacao', 'Qualidade', NULL, NULL, '417'),
(281, 'especializacao', 'Qualidade de servi?os', NULL, NULL, '417'),
(282, 'especializacao', 'Qualidade industrial', NULL, NULL, '417'),
(283, 'especializacao', 'An?lise qu?mica', NULL, NULL, '418'),
(284, 'especializacao', 'Bioqu?mica', NULL, NULL, '418'),
(285, 'especializacao', 'Laboratorista', NULL, NULL, '418'),
(286, 'especializacao', 'Manipulador de medicamentos', NULL, NULL, '418'),
(287, 'especializacao', 'Outros', NULL, NULL, '418'),
(288, 'especializacao', 'Petroqu?mica', NULL, NULL, '418'),
(289, 'especializacao', 'Qu?mica', NULL, NULL, '418'),
(290, 'especializacao', 'Qu?mica industrial', NULL, NULL, '418'),
(291, 'especializacao', 'Cargos e sal?rios', NULL, NULL, '417'),
(292, 'especializacao', 'Comunica??o interna', NULL, NULL, '417'),
(293, 'especializacao', 'Departamento pessoal', NULL, NULL, '417'),
(294, 'especializacao', 'Desenvolvimento', NULL, NULL, '417'),
(295, 'especializacao', 'Educa??o corporativa', NULL, NULL, '417'),
(296, 'especializacao', 'Hunting', NULL, NULL, '417'),
(297, 'especializacao', 'Outros', NULL, NULL, '417'),
(298, 'especializacao', 'Recrutamento e sele?', NULL, NULL, '417'),
(299, 'especializacao', 'Recursos humanos', NULL, NULL, '417'),
(300, 'especializacao', 'Remunera?', NULL, NULL, '417'),
(301, 'especializacao', 'Treinamento', NULL, NULL, '417'),
(302, 'especializacao', 'An?lise cl?nica', NULL, NULL, '418'),
(303, 'especializacao', 'Anestesia', NULL, NULL, '418'),
(304, 'especializacao', 'Angiologia', NULL, NULL, '418'),
(305, 'especializacao', 'Biomedicina', NULL, NULL, '418'),
(306, 'especializacao', 'Biotecnologia', NULL, NULL, '418'),
(307, 'especializacao', 'Cardiologia', NULL, NULL, '418'),
(308, 'especializacao', 'Cirurgia geral', NULL, NULL, '418'),
(309, 'especializacao', 'Cirurgia pl?stica', NULL, NULL, '418'),
(310, 'especializacao', 'Endocrinologia', NULL, NULL, '418'),
(311, 'especializacao', 'Enfermagem', NULL, NULL, '418'),
(312, 'especializacao', 'Farm?cia', NULL, NULL, '418'),
(313, 'especializacao', 'Fisioterapia', NULL, NULL, '418'),
(314, 'especializacao', 'Fonoaudiologia', NULL, NULL, '418'),
(315, 'especializacao', 'Gastrologia', NULL, NULL, '418'),
(316, 'especializacao', 'Geriatria', NULL, NULL, '418'),
(317, 'especializacao', 'Ginecologia / Obstetric', NULL, NULL, '418'),
(318, 'especializacao', 'Homeopatia', NULL, NULL, '418'),
(319, 'especializacao', 'Instrumenta??o cir?rgica', NULL, NULL, '418'),
(320, 'especializacao', 'Medicina', NULL, NULL, '418'),
(321, 'especializacao', 'Medicina do trabalho', NULL, NULL, '418'),
(322, 'especializacao', 'Medicina legal', NULL, NULL, '418'),
(323, 'especializacao', 'Neurologia', NULL, NULL, '418'),
(324, 'especializacao', 'Odontologia', NULL, NULL, '418'),
(325, 'especializacao', 'Oftalmologia', NULL, NULL, '418'),
(326, 'especializacao', 'Oncologia', NULL, NULL, '418'),
(327, 'especializacao', 'Ortopedia / Traumatorpedia', NULL, NULL, '418'),
(328, 'especializacao', 'Otorrinolaringologia', NULL, NULL, '418'),
(329, 'especializacao', 'Outras especialidades', NULL, NULL, '418'),
(330, 'especializacao', 'Outros', NULL, NULL, '418'),
(331, 'especializacao', 'Patologia cl?nica', NULL, NULL, '418'),
(332, 'especializacao', 'Pediatria', NULL, NULL, '418'),
(333, 'especializacao', 'Proctologia', NULL, NULL, '418'),
(334, 'especializacao', 'Pr?tese dent?ria', NULL, NULL, '418'),
(335, 'especializacao', 'Pr?teses', NULL, NULL, '418'),
(336, 'especializacao', 'Psicologia', NULL, NULL, '418'),
(337, 'especializacao', 'Radiologia', NULL, NULL, '418'),
(338, 'especializacao', 'Ultra-som', NULL, NULL, '418'),
(339, 'especializacao', 'Urologia', NULL, NULL, '418'),
(340, 'especializacao', 'Fiscalizacao', NULL, NULL, '419'),
(341, 'especializacao', 'Outros', NULL, NULL, '419'),
(342, 'especializacao', 'Portaria industrial', NULL, NULL, '419'),
(343, 'especializacao', 'Rastreamento', NULL, NULL, '419'),
(344, 'especializacao', 'Seguran', NULL, NULL, '419'),
(345, 'especializacao', 'Seguran?a patrimonial', NULL, NULL, '419'),
(346, 'especializacao', 'Transporte de valores', NULL, NULL, '419'),
(347, 'especializacao', 'Vigil?ncia', NULL, NULL, '419'),
(348, 'especializacao', 'Acompanhante de idosos', NULL, NULL, '420'),
(349, 'especializacao', 'Ascensorista', NULL, NULL, '420'),
(350, 'especializacao', 'Bab', NULL, NULL, '420'),
(351, 'especializacao', 'Caseiro', NULL, NULL, '420'),
(352, 'especializacao', 'Copa', NULL, NULL, '420'),
(353, 'especializacao', 'Cozinheiro', NULL, NULL, '420'),
(354, 'especializacao', 'Governan', NULL, NULL, '420'),
(355, 'especializacao', 'Higieniza??o / Esteriliza?', NULL, NULL, '420'),
(356, 'especializacao', 'Jardinagem', NULL, NULL, '420'),
(357, 'especializacao', 'Lavanderia', NULL, NULL, '420'),
(358, 'especializacao', 'Limpeza', NULL, NULL, '420'),
(359, 'especializacao', 'Limpeza dom?stica', NULL, NULL, '420'),
(360, 'especializacao', 'Outros', NULL, NULL, '420'),
(361, 'especializacao', 'Zeladoria', NULL, NULL, '420'),
(362, 'especializacao', 'Outros', NULL, NULL, '421'),
(363, 'especializacao', 'Servi?os sociais e comunit?rios', NULL, NULL, '421'),
(364, 'especializacao', 'Trabalhos volunt?rios', NULL, NULL, '421'),
(365, 'especializacao', 'Atendimento ? clientes', NULL, NULL, '422'),
(366, 'especializacao', 'Backoffice', NULL, NULL, '422'),
(367, 'especializacao', 'Cobran', NULL, NULL, '422'),
(368, 'especializacao', 'Monitoria', NULL, NULL, '422'),
(369, 'especializacao', 'Outros', NULL, NULL, '422'),
(370, 'especializacao', 'SAC', NULL, NULL, '422'),
(371, 'especializacao', 'Telemarketing / Call Center ativo', NULL, NULL, '422'),
(372, 'especializacao', 'Telemarketing / Call Center receptivo', NULL, NULL, '422'),
(373, 'especializacao', 'Ajudante de motorista', NULL, NULL, '423'),
(374, 'especializacao', 'Copiloto', NULL, NULL, '423'),
(375, 'especializacao', 'Cobrador', NULL, NULL, '423'),
(376, 'especializacao', 'Comiss?rio de bordo', NULL, NULL, '423'),
(377, 'especializacao', 'Condutor ferrovi?rio', NULL, NULL, '423'),
(378, 'especializacao', 'Controle de tr?fego', NULL, NULL, '423'),
(379, 'especializacao', 'Encarregado de transporte', NULL, NULL, '423'),
(380, 'especializacao', 'Manobrista', NULL, NULL, '423'),
(381, 'especializacao', 'Marinheiro', NULL, NULL, '423'),
(382, 'especializacao', 'Motoboy', NULL, NULL, '423'),
(383, 'especializacao', 'Motorista', NULL, NULL, '423'),
(384, 'especializacao', 'Motorista - Hab B', NULL, NULL, '423'),
(385, 'especializacao', 'Motorista - Hab C', NULL, NULL, '423'),
(386, 'especializacao', 'Motorista - Hab D', NULL, NULL, '423'),
(387, 'especializacao', 'Transporte escolar', NULL, NULL, '423'),
(388, 'especializacao', 'Transporte executivo', NULL, NULL, '423'),
(389, 'especializacao', 'Transporte hospitalar', NULL, NULL, '423'),
(390, 'especializacao', 'Outros', NULL, NULL, '423'),
(391, 'especializacao', 'Piloto', NULL, NULL, '423'),
(392, 'area', 'Administra?', NULL, NULL, NULL),
(393, 'area', 'Agricultura, Pecu?ria, Veterin?ria', NULL, NULL, NULL),
(394, 'area', 'Alimenta??o / Gastronomia', NULL, NULL, NULL),
(395, 'area', 'Arquitetura, Decora??o, Design', NULL, NULL, NULL),
(396, 'area', 'Artes', NULL, NULL, NULL),
(397, 'area', 'Auditoria', NULL, NULL, NULL),
(398, 'area', 'Ci?ncias, Pesquisa', NULL, NULL, NULL),
(399, 'area', 'Comercial, Vendas', NULL, NULL, NULL),
(400, 'area', 'Com?rcio Exterior, Importa??o, Exporta?', NULL, NULL, NULL),
(401, 'area', 'Compras', NULL, NULL, NULL),
(402, 'area', 'Comunica??o, TV, Cinema', NULL, NULL, NULL),
(403, 'area', 'Constru??o, Manuten?', NULL, NULL, NULL),
(404, 'area', 'Cont?bil, Finan?as, Economia', NULL, NULL, NULL),
(405, 'area', 'Cultura, Lazer, Entretenimento', NULL, NULL, NULL),
(406, 'area', 'Educa??o, Ensino, Idiomas', NULL, NULL, NULL),
(407, 'area', 'Engenharia', NULL, NULL, NULL),
(408, 'area', 'Est?tica', NULL, NULL, NULL),
(409, 'area', 'Hotelaria / Turismo', NULL, NULL, NULL),
(410, 'area', 'Industrial, Produ??o, F?brica', NULL, NULL, NULL),
(411, 'area', 'Inform?tica, TI, Telecomunica??es', NULL, NULL, NULL),
(412, 'area', 'Jur?dica', NULL, NULL, NULL),
(413, 'area', 'Log?stica', NULL, NULL, NULL),
(414, 'area', 'Marketing', NULL, NULL, NULL),
(415, 'area', 'Meio Ambiente / Ecologia', NULL, NULL, NULL),
(416, 'area', 'Moda', NULL, NULL, NULL),
(417, 'area', 'Qualidade', NULL, NULL, NULL),
(418, 'area', 'Qu?mica, Petroqu?mica', NULL, NULL, NULL),
(419, 'area', 'Recursos Humanos', NULL, NULL, NULL),
(420, 'area', 'Sa?de', NULL, NULL, NULL),
(421, 'area', 'Seguran', NULL, NULL, NULL),
(422, 'area', 'Servi?os Gerais', NULL, NULL, NULL),
(423, 'area', 'Servi?os Sociais e Comunit?rios', NULL, NULL, NULL),
(424, 'area', 'Telemarketing', NULL, NULL, NULL),
(425, 'area', 'Transportes', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `pesquisa_data`
--

CREATE TABLE `pesquisa_data` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL COMMENT 'pode ser usuario',
  `id_produto` int(11) NOT NULL,
  `tipo` int(2) NOT NULL DEFAULT '0',
  `nome` varchar(300) NOT NULL,
  `tempo` int(11) NOT NULL,
  `nivel` int(2) NOT NULL,
  `data` datetime NOT NULL,
  `descricao` longtext NOT NULL,
  `shorturl` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `pesquisa_info`
--

CREATE TABLE `pesquisa_info` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `inteiro` int(11) DEFAULT NULL,
  `number` float NOT NULL,
  `estampa` timestamp NULL DEFAULT NULL,
  `texto` longtext,
  `descricao` longtext NOT NULL,
  `id_pesquisa` int(11) NOT NULL,
  `nota` float NOT NULL DEFAULT '0',
  `resposta` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `pesquisa_items`
--

CREATE TABLE `pesquisa_items` (
  `id` int(11) NOT NULL,
  `id_produto` int(11) NOT NULL,
  `id_pergunta` int(11) NOT NULL,
  `n_index` int(11) NOT NULL,
  `titulo` varchar(200) NOT NULL,
  `n_option` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `pesquisa_participantes`
--

CREATE TABLE `pesquisa_participantes` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `id_pesquisa` int(11) NOT NULL,
  `id_produto` int(11) DEFAULT NULL,
  `data` datetime NOT NULL,
  `last_update` datetime NOT NULL,
  `nota` float NOT NULL,
  `codigo` varchar(200) DEFAULT NULL,
  `status` int(2) NOT NULL DEFAULT '0',
  `json` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `pesquisa_perguntas`
--

CREATE TABLE `pesquisa_perguntas` (
  `id` int(11) NOT NULL,
  `id_pesquisa` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `n_index` int(3) NOT NULL,
  `layout` int(11) NOT NULL,
  `titulo` varchar(1000) NOT NULL,
  `resposta` longtext NOT NULL,
  `valor` float DEFAULT NULL,
  `data` datetime NOT NULL,
  `container_1` varchar(10) DEFAULT NULL,
  `enunciado` varchar(500) NOT NULL DEFAULT '0',
  `html` longtext NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `pesquisa_tempo`
--

CREATE TABLE `pesquisa_tempo` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_produto` int(11) NOT NULL,
  `id_pesquisa` int(11) NOT NULL,
  `tipo` varchar(100) NOT NULL,
  `data_simple` date NOT NULL,
  `data_criacao` datetime NOT NULL,
  `last_update` datetime NOT NULL,
  `total` float NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `preferencias_attribute`
--

CREATE TABLE `preferencias_attribute` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `plataforma` varchar(40) NOT NULL DEFAULT 'desktop',
  `name` varchar(45) NOT NULL,
  `inteiro` int(11) DEFAULT NULL,
  `number` float NOT NULL,
  `estampa` timestamp NULL DEFAULT NULL,
  `texto` varchar(255) DEFAULT NULL,
  `descricao` longtext NOT NULL,
  `id_general` int(11) NOT NULL DEFAULT '0',
  `tipo` varchar(100) DEFAULT NULL,
  `extra` varchar(200) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `preferencias_attribute`
--

INSERT INTO `preferencias_attribute` (`id`, `user_id`, `plataforma`, `name`, `inteiro`, `number`, `estampa`, `texto`, `descricao`, `id_general`, `tipo`, `extra`) VALUES
(1, 0, 'desktop', 'bt_logar_owner', NULL, 0, NULL, 'bt_logar_purplepier.png', '', 0, NULL, '0'),
(2, 0, 'desktop', 'bt_shopcart', NULL, 0, '2013-04-05 19:06:52', 'cart_white_dark_3.png', '', 0, NULL, '0'),
(3, 0, 'desktop', 'cadastro_usuarios', NULL, 0, '2012-03-24 13:13:10', 'cadastro_rapido', '', 0, NULL, '0'),
(4, 0, 'desktop', 'dispositivo_smartphone', NULL, 0, '2012-07-23 17:42:50', '0', '', 0, NULL, '0'),
(5, 0, 'desktop', 'dispositivo_tablet', NULL, 0, '2012-07-23 17:42:50', '0', '', 0, NULL, '0'),
(6, 0, 'desktop', 'dividers', NULL, 0, '2013-04-23 12:08:21', 'divider_limiter_shadow', '', 0, NULL, '0'),
(7, 0, 'desktop', 'divider_color', NULL, 0, '2013-04-23 12:08:21', '#000000', '', 0, NULL, '0'),
(8, 0, 'desktop', 'divider_espessura', NULL, 0, '2013-04-23 12:08:21', '1px', '', 0, NULL, '0'),
(9, 0, 'desktop', 'email_ceos', NULL, 0, '2012-06-27 14:42:51', '', '', 0, NULL, '0'),
(10, 0, 'desktop', 'email_pagseguro', NULL, 0, '2012-02-29 20:07:16', 'publicidade.exe@gmail.com', '', 0, NULL, '0'),
(11, 0, 'desktop', 'emkt_padrao', 175, 0, '2012-11-06 22:40:09', '148', '', 0, NULL, '0'),
(12, 0, 'desktop', 'frame_vitrine', NULL, 0, '2013-04-05 19:06:52', '', '', 0, NULL, '0'),
(13, 0, 'desktop', 'id_app_fb', NULL, 0, '2012-04-05 13:12:51', '', '', 0, NULL, '0'),
(14, 0, 'desktop', 'id_page_fb', NULL, 0, '2012-05-16 14:27:42', '', '', 0, NULL, '0'),
(15, 0, 'desktop', 'logo_app', NULL, 0, '2012-03-23 15:49:09', '', '', 0, NULL, '0'),
(16, 0, 'desktop', 'logo_email', NULL, 0, '2012-03-08 21:18:51', 'f_2', '', 0, NULL, '0'),
(17, 0, 'desktop', 'logo_mobile', NULL, 0, '2012-05-25 18:06:32', '', '', 0, NULL, '0'),
(18, 0, 'desktop', 'logo_redes_sociais', NULL, 0, '2012-03-08 21:18:51', 'f_2', '', 0, NULL, '0'),
(19, 0, 'desktop', 'logo_tablet', NULL, 0, '2012-03-08 21:18:51', '', '', 0, NULL, '0'),
(20, 0, 'desktop', 'logo_tablet_intro', NULL, 0, '2012-03-08 21:18:51', '', '', 0, NULL, '0'),
(21, 0, 'desktop', 'menu_loja', NULL, 0, '2013-04-23 12:07:51', 'black', '', 0, NULL, '0'),
(22, 0, 'desktop', 'message_board', NULL, 0, '2012-04-24 17:44:22', 'black_triangle', '', 0, NULL, '0'),
(23, 0, 'desktop', 'more', NULL, 0, '2012-05-28 17:17:54', 'arrow_black_hard.png', '', 0, NULL, '0'),
(24, 0, 'desktop', 'secret_fb', NULL, 0, '2012-04-05 13:12:51', '', '', 0, NULL, '0'),
(25, 0, 'mobile', 'side_button', NULL, 0, '2012-05-28 20:16:37', 'side_simple_arrow.png', '', 0, NULL, '0'),
(26, 0, 'desktop', 'text_popup', NULL, 0, '2012-05-23 18:56:36', '404040', '', 0, NULL, '0'),
(27, 0, 'desktop', 'title_popup', NULL, 0, '2012-05-23 18:56:36', '731925', '', 0, NULL, '0'),
(28, 0, 'desktop', 'token_fb', NULL, 0, '2012-04-05 15:23:58', '', '', 0, NULL, '0'),
(29, 0, 'desktop', 'token_pagseguro', NULL, 0, '2012-02-29 20:07:16', '', '', 0, NULL, '0'),
(30, 0, 'desktop', 'menu_space', NULL, 0, '2014-02-08 21:38:41', '17', '', 0, NULL, '0'),
(31, 0, 'desktop', 'menu_total', NULL, 0, '2014-02-08 21:39:53', 'true', '', 0, NULL, '0'),
(32, 0, 'desktop', 'menu_align', NULL, 0, '2014-02-08 21:39:57', 'right', '', 0, NULL, '0'),
(33, 0, 'desktop', 'moderador', NULL, 0, '2014-03-09 15:28:42', 'Paula', '', 0, NULL, '0'),
(34, 0, 'desktop', 'chamada_lc', NULL, 0, '2014-03-09 15:28:42', 'Posso te ajudar?', '', 0, NULL, '0'),
(35, 0, 'desktop', 'welcome1', NULL, 0, '2014-03-09 15:28:42', NULL, 'Bem vindo ao nosso site, estamos muito felizes de você nos visitar', 0, NULL, '0'),
(36, 0, 'desktop', 'welcome2', NULL, 0, '2014-03-09 15:28:42', NULL, 'Posso te ajudar a encontrar as melhores opções para fazer seu site decolar na web?', 0, NULL, '0'),
(37, 0, 'desktop', 'cor_lc', NULL, 0, '2014-03-09 15:28:42', 'base_black_bevel.png', '', 0, NULL, '0'),
(38, 0, 'desktop', 'exibe_combo_share', 1, 0, '2014-05-01 22:06:13', NULL, '', 0, NULL, '0'),
(39, 0, 'desktop', 'combo_share_position', NULL, 0, '2014-05-01 22:06:13', 'page_top', '', 0, NULL, '0'),
(40, 0, 'desktop', 'combo_share_color', NULL, 0, '2014-05-01 22:06:13', 'preto', '', 0, NULL, '0'),
(41, 0, 'desktop', 'email_title', NULL, 0, '2014-05-02 02:19:41', 'Sanbox', '', 0, NULL, '0'),
(42, 0, 'desktop', 'rss_exibe_materia', 1, 0, '2014-05-05 12:52:37', NULL, '', 0, NULL, '0'),
(43, 0, 'desktop', 'rss_titulo_materia', NULL, 0, '2014-05-05 12:52:37', 'Matérias', '', 0, NULL, '0'),
(44, 0, 'desktop', 'rss_texto_materia', NULL, 0, '2014-05-05 12:52:37', NULL, 'Assine nosso feeds de produtos e fique por dentro de todos os produtos que lançamos assim como promoções e lançamentos. Com o RSS feeds de produtos você acompanha em tempo real tudo que lançamos e pode nos visitar sempre que algo novo acontecer.', 0, NULL, '0'),
(45, 0, 'desktop', 'rss_exibe_eventos', 0, 0, '2014-05-05 12:52:37', NULL, '', 0, NULL, '0'),
(46, 0, 'desktop', 'rss_titulo_eventos', NULL, 0, '2014-05-05 12:52:37', '', '', 0, NULL, '0'),
(47, 0, 'desktop', 'rss_texto_eventos', NULL, 0, '2014-05-05 12:52:37', NULL, '', 0, NULL, '0'),
(48, 0, 'desktop', 'rss_exibe_produtos', 1, 0, '2014-05-05 12:52:37', NULL, '', 0, NULL, '0'),
(49, 0, 'desktop', 'rss_titulo_produtos', NULL, 0, '2014-05-05 12:52:37', 'Produtos', '', 0, NULL, '0'),
(50, 0, 'desktop', 'rss_texto_produtos', NULL, 0, '2014-05-05 12:52:37', NULL, 'Assine nosso feeds de produtos e fique por dentro de todos os produtos que lançamos assim como promoções e lançamentos. Com o RSS feeds de produtos você acompanha em tempo real tudo que lançamos e pode nos visitar sempre que algo novo acontecer.', 0, NULL, '0'),
(51, 0, 'desktop', 'menu_sombra_texto', NULL, 0, '2014-05-06 12:34:12', 'false', '', 0, NULL, '0'),
(52, 0, 'desktop', 'menu_dividers', NULL, 0, '2014-05-06 12:34:29', 'false', '', 0, NULL, '0'),
(53, 0, 'desktop', 'altura_main_banner', 300, 0, '2014-05-20 17:13:54', NULL, '', 0, NULL, '0'),
(54, 0, 'desktop', 'combo_share_position_py', 150, 0, '2014-05-20 17:14:06', NULL, '', 0, NULL, '0'),
(55, 0, 'desktop', 'cep_origem', NULL, 0, '2014-07-03 15:00:18', '', '', 0, NULL, '0'),
(56, 0, 'desktop', 'vitrine_layout', NULL, 0, '2014-07-03 15:00:18', 'vitrine_simple', '', 0, NULL, '0'),
(57, 0, 'desktop', 'categorias_home', 0, 0, '2014-07-03 15:00:18', NULL, '', 0, NULL, '0'),
(58, 0, 'desktop', 'outras_informacoes', NULL, 0, '2014-07-03 15:00:18', NULL, '', 0, NULL, '0'),
(59, 0, 'desktop', 'prazo_entrega', NULL, 0, '2014-07-03 15:00:18', NULL, '', 0, NULL, '0'),
(60, 0, 'desktop', 'mensagem', NULL, 0, '2014-07-03 15:00:18', NULL, '', 0, NULL, '0'),
(61, 0, 'desktop', 'categoria_home_layout', NULL, 0, '2014-07-03 15:00:18', 'simples', '', 0, NULL, '0'),
(62, 0, 'desktop', 'twitter_consumer_key', NULL, 0, '2014-07-15 21:14:16', '', '', 0, NULL, '0'),
(63, 0, 'desktop', 'twitter_consumer_secret', NULL, 0, '2014-07-15 21:14:17', '', '', 0, NULL, '0'),
(64, 0, 'desktop', 'twitter_access_token', NULL, 0, '2014-07-15 21:14:17', '', '', 0, NULL, '0'),
(65, 0, 'desktop', 'twitter_access_secret', NULL, 0, '2014-07-15 21:14:17', '', '', 0, NULL, '0'),
(66, 0, 'desktop', 'logo_site', NULL, 0, '2014-08-07 21:19:19', 'f_2', '', 0, NULL, '0'),
(67, 0, 'desktop', 'logo_impressao', NULL, 0, '2014-08-07 21:19:19', 'f_2', '', 0, NULL, '0'),
(68, 0, 'desktop', 'exibe_facebook_likebox', 0, 0, '2014-08-07 21:36:24', NULL, '', 0, NULL, '0'),
(69, 0, 'desktop', 'facebook_likebox_position', NULL, 0, '2014-08-07 21:36:24', 'leftP', '', 0, NULL, '0'),
(70, 0, 'desktop', 'facebook_likebox_color', NULL, 0, '2014-08-07 21:36:24', 'preto', '', 0, NULL, '0'),
(71, 0, 'desktop', 'facebook_likebox_position_py', 0, 0, '2014-08-07 21:36:24', NULL, '', 0, NULL, '0'),
(72, 0, 'desktop', 'menu_background_color', NULL, 0, '2014-08-07 21:45:51', '999999', '', 0, NULL, '0'),
(73, 0, 'desktop', 'menu_background_active', NULL, 0, '2014-08-07 21:45:51', '000000', '', 0, NULL, '0'),
(74, 0, 'desktop', 'margin_menu_pos_x', 0, 0, '2014-08-07 21:45:51', NULL, '', 0, NULL, '0'),
(75, 0, 'desktop', 'rodape_copyright', NULL, 0, '2014-08-07 21:52:36', NULL, '', 0, NULL, '0'),
(76, 0, 'desktop', 'ft_menu', NULL, 0, '2014-08-07 21:52:36', 'bg_white_pilow.png', '', 0, NULL, '0'),
(77, 0, 'desktop', 'ft_line2', NULL, 0, '2014-08-07 21:52:36', 'themes_bg.jpg', '', 0, NULL, '0'),
(78, 0, 'desktop', 'ft_txt_line2', NULL, 0, '2014-08-07 21:52:36', 'FCFCFC', '', 0, NULL, '0'),
(79, 0, 'desktop', 'ft_txt_menu', NULL, 0, '2014-08-07 21:52:36', 'FFFFFF', '', 0, NULL, '0'),
(80, 0, 'desktop', 'ft_txt_menu1', NULL, 0, '2014-08-07 21:52:36', '383838', '', 0, NULL, '0'),
(81, 0, 'desktop', 'ft_txt_menu2', NULL, 0, '2014-08-07 21:52:36', 'preto', '', 0, NULL, '0'),
(82, 0, 'desktop', 'ft_menu2_espacamento', 0, 0, '2014-08-07 21:52:36', NULL, '', 0, NULL, '0'),
(83, 0, 'desktop', 'ft_fb_bg', NULL, 0, '2014-08-07 21:52:36', '', '', 0, NULL, '0'),
(84, 0, 'desktop', 'ft_ln_company_bg', NULL, 0, '2014-08-07 21:52:36', 'bg_black_iron.png', '', 0, NULL, '0'),
(85, 0, 'desktop', 'ft_txt_line_company', NULL, 0, '2014-08-07 21:52:36', 'FFFFFF', '', 0, NULL, '0'),
(86, 0, 'desktop', 'side_button', NULL, 0, '2014-09-08 17:00:07', 'side_simple_arrow.png', '', 0, NULL, '0'),
(87, 0, 'desktop', 'logo_site_string', NULL, 0, '2014-09-17 13:39:22', 'pierlogo_azul_b8.png', '', 0, NULL, '0'),
(88, 0, 'desktop', 'wallpaper_texture_type', NULL, 0, '2014-09-18 15:09:57', '', '', 0, NULL, '0'),
(89, 0, 'desktop', 'welcome3', NULL, 0, '2014-09-18 16:18:15', NULL, 'Não estamos online no momento, mas deixe seu contato que retornaremos o quanto antes.', 0, NULL, '0'),
(90, 0, 'desktop', 'canal_youtube', NULL, 0, '2014-09-19 14:55:37', '', '', 0, NULL, '0'),
(91, 0, 'desktop', 'flickr', NULL, 0, '2014-09-19 14:55:37', '', '', 0, NULL, '0'),
(92, 0, 'desktop', 'instagram', NULL, 0, '2014-09-19 14:55:37', '', '', 0, NULL, '0'),
(93, 0, 'desktop', 'pinterest', NULL, 0, '2014-09-19 14:55:37', '', '', 0, NULL, '0'),
(94, 0, 'desktop', 'home', NULL, 0, '2014-09-19 14:55:37', '', '', 0, NULL, '0'),
(95, 0, 'desktop', 'skype', NULL, 0, '2014-09-19 14:55:37', '', '', 0, NULL, '0'),
(96, 0, 'desktop', 'rss', NULL, 0, '2014-09-19 14:55:37', '', '', 0, NULL, '0'),
(97, 0, 'desktop', 'telefone_contato', NULL, 0, '2014-09-19 14:55:37', '', '', 0, NULL, '0'),
(98, 0, 'desktop', 'email_contato', NULL, 0, '2014-09-19 14:55:37', '', '', 0, NULL, '0'),
(99, 0, 'desktop', 'topo_texture_type', NULL, 0, '2014-09-24 13:06:43', '', '', 0, NULL, '0'),
(100, 0, 'desktop', 'email_emkt', NULL, 0, '2014-09-26 22:38:12', '', '', 0, NULL, '0'),
(101, 0, 'desktop', 'chamada_cor', NULL, 0, '2014-10-17 00:00:43', 'A60F14', '', 0, NULL, '0'),
(102, 0, 'desktop', 'menu_background_exibe', 1, 0, '2014-10-17 00:04:16', NULL, '', 0, NULL, '0'),
(103, 0, 'desktop', 'menu_active_exibe', 1, 0, '2014-10-17 00:04:16', NULL, '', 0, NULL, '0'),
(105, 0, 'desktop', 'email_emkt_teste', NULL, 0, '2014-10-23 21:50:39', '', '', 0, NULL, '0'),
(113, 0, 'desktop', 'componente_site', 1, 0, '2014-10-27 21:56:13', 'PierLayout - Edite tudo do seu site', 'Controle todos as cores, texturas e layout de seu site. \nEsse aplicativo você pode alterar: botões, menu, topos e rodapés entre outras cores e ícones', 273, 'pierlayout', '0'),
(119, 0, 'desktop', 'site_map', NULL, 0, '2014-11-12 20:12:53', '', '', 0, NULL, '0'),
(121, 0, 'desktop', 'barra_social_distancia', 20, 0, '2014-11-13 23:44:55', NULL, '', 0, NULL, '0'),
(122, 0, 'desktop', 'barra_social_lado', NULL, 0, '2014-11-13 23:44:55', 'left', '', 0, NULL, '0'),
(123, 0, 'desktop', 'barra_social_redes_sociais', 1, 0, '2014-11-13 23:44:55', NULL, '', 0, NULL, '0'),
(124, 0, 'desktop', 'barra_social_type_background', 0, 0, '2014-11-13 23:44:55', NULL, '', 0, NULL, '0'),
(125, 0, 'desktop', 'barra_social_background', NULL, 0, '2014-11-13 23:44:55', '', '', 0, NULL, '0'),
(126, 0, 'desktop', 'barra_social_background_color', NULL, 0, '2014-11-13 23:44:55', 'FFFFFF', '', 0, NULL, '0'),
(127, 0, 'desktop', 'title_size', NULL, 0, '2014-11-21 11:11:04', '', '', 0, NULL, '0'),
(128, 0, 'desktop', 'text_size', NULL, 0, '2014-11-21 11:11:04', '', '', 0, NULL, '0'),
(129, 0, 'desktop', 'text_line_height', NULL, 0, '2014-11-21 11:11:04', '', '', 0, NULL, '0'),
(130, 0, 'desktop', 'text_alignment', NULL, 0, '2014-11-21 11:11:04', 'left', '', 0, NULL, '0'),
(131, 0, 'desktop', 'chamada_size', NULL, 1.4, '2014-11-21 11:11:04', NULL, '', 0, NULL, '0'),
(132, 0, 'desktop', 'chamada_line', NULL, 0, '2014-11-21 11:11:04', NULL, '', 0, NULL, '0'),
(133, 0, 'desktop', 'chamada_alinhamento', NULL, 0, '2014-11-21 11:11:04', 'left', '', 0, NULL, '0'),
(134, 0, 'desktop', 'chamada_fonte', NULL, 0, '2014-11-21 11:11:04', '', '', 0, NULL, '0'),
(135, 0, 'desktop', 'efeitos_texture_type', NULL, 0, '2014-11-21 11:23:16', '', '', 0, NULL, '0'),
(136, 0, 'desktop', 'mensagem_texture_type', NULL, 0, '2014-11-21 20:46:08', '', '', 0, NULL, '0'),
(139, 0, 'desktop', 'subtitulo_size', NULL, 0, '2014-12-04 12:37:27', NULL, '', 0, NULL, '0'),
(140, 0, 'desktop', 'subtitulo_line', NULL, 0, '2014-12-04 12:37:27', NULL, '', 0, NULL, '0'),
(141, 0, 'desktop', 'subtitulo_alinhamento', NULL, 0, '2014-12-04 12:37:27', 'left', '', 0, NULL, '0'),
(142, 0, 'desktop', 'subtitulo_fonte', NULL, 0, '2014-12-04 12:37:27', '', '', 0, NULL, '0'),
(143, 0, 'desktop', 'taxa_boleto', NULL, 0, '2014-12-09 17:03:47', NULL, '', 0, NULL, '0'),
(144, 0, 'desktop', 'nr_conta', 12802, 0, '2014-12-09 17:03:47', NULL, '', 0, NULL, '0'),
(145, 0, 'desktop', 'nr_conta_digito', 3, 0, '2014-12-09 17:03:47', NULL, '', 0, NULL, '0'),
(146, 0, 'desktop', 'nr_agencia', 2917, 0, '2014-12-09 17:03:47', NULL, '', 0, NULL, '0'),
(147, 0, 'desktop', 'nr_agencia_digito', 3, 0, '2014-12-09 17:03:47', NULL, '', 0, NULL, '0'),
(148, 0, 'desktop', 'nr_cedente', 12802, 0, '2014-12-09 17:03:47', NULL, '', 0, NULL, '0'),
(149, 0, 'desktop', 'nr_cedente_digito', 3, 0, '2014-12-09 17:03:47', NULL, '', 0, NULL, '0'),
(150, 0, 'desktop', 'nr_carteira', NULL, 0, '2014-12-09 17:03:47', '25', '', 0, NULL, '0'),
(151, 0, 'desktop', 'boleto_documento', NULL, 0, '2014-12-09 17:03:47', '', '', 0, NULL, '0'),
(152, 0, 'desktop', 'boleto_razao_social', NULL, 0, '2014-12-09 17:03:47', '', '', 0, NULL, '0'),
(153, 0, 'desktop', 'boleto_endereco', NULL, 0, '2014-12-09 17:03:47', '', '', 0, NULL, '0'),
(154, 0, 'desktop', 'boleto_informativo', NULL, 0, '2014-12-09 17:03:47', 'Boleto de Cobrança', '', 0, NULL, '0'),
(155, 0, 'desktop', 'boleto_cidade', NULL, 0, '2014-12-09 17:03:47', '', '', 0, NULL, '0'),
(156, 0, 'desktop', 'boleto_uf', NULL, 0, '2014-12-09 17:03:47', '', '', 0, NULL, '0'),
(157, 0, 'desktop', 'boleto_instrucao1', NULL, 0, '2014-12-09 17:03:47', '- Sr. Caixa, cobrar multa de 2% após o vencimento', '', 0, NULL, '0'),
(158, 0, 'desktop', 'boleto_instrucao2', NULL, 0, '2014-12-09 17:03:47', '- Receber até 10 dias após o vencimento', '', 0, NULL, '0'),
(159, 0, 'desktop', 'boleto_instrucao3', NULL, 0, '2014-12-09 17:03:47', '- Em caso de dúvidas entre em contato conosco: contato@purplepier.com.br', '', 0, NULL, '0'),
(160, 0, 'desktop', 'boleto_instrucao4', NULL, 0, '2014-12-09 17:03:47', '', '', 0, NULL, '0'),
(165, 324, 'desktop', 'altura_main_banner', 120, 0, '2015-01-24 14:58:21', NULL, '', 0, NULL, '0'),
(166, 324, 'desktop', 'site_release', NULL, 0, '2015-01-24 16:21:24', '00/00/0000', '', 0, NULL, '0'),
(167, 324, 'desktop', 'site_release_inverse', NULL, 0, '2015-01-24 16:21:24', '00/00/0000', '', 0, NULL, '0'),
(168, 324, 'desktop', 'title_popup', NULL, 0, '2015-01-24 16:31:47', 'FFFFFF', '', 0, NULL, '0'),
(169, 324, 'desktop', 'text_popup', NULL, 0, '2015-01-24 16:31:47', 'FFFFFF', '', 0, NULL, '0'),
(170, 324, 'desktop', 'rodape_copyright', NULL, 0, '2015-01-24 17:18:18', NULL, 'É proibida a cópia de todo e qualquer conteúdo do site sem prévia autorização da RodeBem\nRodeBem - AutoMecânica', 0, NULL, '0'),
(171, 324, 'desktop', 'ft_menu', NULL, 0, '2015-01-24 17:18:18', 'bg_white_pilow.png', '', 0, NULL, '0'),
(172, 324, 'desktop', 'ft_line2', NULL, 0, '2015-01-24 17:18:18', 'black_losango.png', '', 0, NULL, '0'),
(173, 324, 'desktop', 'ft_txt_line2', NULL, 0, '2015-01-24 17:18:18', 'FFFFFF', '', 0, NULL, '0'),
(174, 324, 'desktop', 'ft_txt_menu', NULL, 0, '2015-01-24 17:18:18', 'FFFFFF', '', 0, NULL, '0'),
(175, 324, 'desktop', 'ft_txt_menu1', NULL, 0, '2015-01-24 17:18:18', '474747', '', 0, NULL, '0'),
(176, 324, 'desktop', 'ft_txt_menu2', NULL, 0, '2015-01-24 17:18:18', 'branco', '', 0, NULL, '0'),
(177, 324, 'desktop', 'ft_menu2_espacamento', 0, 0, '2015-01-24 17:18:18', NULL, '', 0, NULL, '0'),
(178, 324, 'desktop', 'ft_fb_bg', NULL, 0, '2015-01-24 17:18:18', '', '', 0, NULL, '0'),
(179, 324, 'desktop', 'ft_ln_company_bg', NULL, 0, '2015-01-24 17:18:18', 'rachura_branca_bg.png', '', 0, NULL, '0'),
(180, 324, 'desktop', 'ft_txt_line_company', NULL, 0, '2015-01-24 17:18:18', '4A4A4A', '', 0, NULL, '0'),
(181, 324, 'desktop', 'logo_email', NULL, 0, '2015-01-24 18:29:22', 'f_1006', '', 0, NULL, '0'),
(182, 324, 'desktop', 'logo_redes_sociais', NULL, 0, '2015-01-24 18:29:22', 'f_1006', '', 0, NULL, '0'),
(183, 324, 'desktop', 'logo_tablet_intro', NULL, 0, '2015-01-24 18:29:22', '', '', 0, NULL, '0'),
(184, 324, 'desktop', 'logo_tablet', NULL, 0, '2015-01-24 18:29:22', '', '', 0, NULL, '0'),
(185, 324, 'desktop', 'logo_app', NULL, 0, '2015-01-24 18:29:22', '', '', 0, NULL, '0'),
(186, 324, 'desktop', 'logo_mobile', NULL, 0, '2015-01-24 18:29:22', '', '', 0, NULL, '0'),
(187, 324, 'desktop', 'logo_site', NULL, 0, '2015-01-24 18:29:22', 'f_1011', '', 0, NULL, '0'),
(188, 324, 'desktop', 'logo_site_string', NULL, 0, '2015-01-24 18:29:22', 'logo_rodebem_i9.png', '', 0, NULL, '0'),
(189, 324, 'desktop', 'logo_impressao', NULL, 0, '2015-01-24 18:29:22', 'f_1006', '', 0, NULL, '0'),
(190, 324, 'desktop', 'topo_altura', 120, 0, '2015-01-24 18:29:53', NULL, '', 0, NULL, '0'),
(191, 324, 'desktop', 'logo_altura', 0, 0, '2015-01-24 18:29:53', NULL, '', 0, NULL, '0'),
(192, 324, 'desktop', 'logo_largura', 0, 0, '2015-01-24 18:29:53', NULL, '', 0, NULL, '0'),
(193, 324, 'desktop', 'logo_pos_x', 0, 0, '2015-01-24 18:29:54', NULL, '', 0, NULL, '0'),
(194, 324, 'desktop', 'logo_pos_y', 0, 0, '2015-01-24 18:29:54', NULL, '', 0, NULL, '0'),
(195, 324, 'desktop', 'dividers', NULL, 0, '2015-01-24 20:19:33', 'divider_limiter_shadow', '', 0, NULL, '0'),
(196, 324, 'desktop', 'divider_color', NULL, 0, '2015-01-24 20:19:33', '#000000', '', 0, NULL, '0'),
(197, 324, 'desktop', 'divider_espessura', NULL, 0, '2015-01-24 20:19:33', '1px', '', 0, NULL, '0'),
(198, 0, 'desktop', 'site_texture_type', NULL, 0, '2015-01-26 18:02:21', '', '', 0, NULL, '0'),
(199, 0, 'desktop', 'site_texture_type', NULL, 0, '2015-01-26 18:02:21', '', '', 0, NULL, '0'),
(205, 0, 'desktop', 'intro_texture_type', NULL, 0, '2015-02-03 11:43:20', '', '', 0, NULL, '0'),
(206, 0, 'desktop', 'site_release', NULL, 0, '2015-02-06 19:45:15', '00/00/0000', '', 0, NULL, '0'),
(207, 0, 'desktop', 'site_release_inverse', NULL, 0, '2015-02-06 19:45:15', '00/00/0000', '', 0, NULL, '0'),
(209, 229, 'desktop', 'altura_main_banner', 120, 0, '2015-03-23 17:54:18', NULL, '', 0, NULL, '0'),
(210, 229, 'desktop', 'menu_total', NULL, 0, '2015-03-23 20:08:24', 'true', '', 0, NULL, '0'),
(211, 229, 'desktop', 'menu_align', NULL, 0, '2015-03-23 20:08:33', 'left', '', 0, NULL, '0'),
(212, 229, 'desktop', 'menu_altura', NULL, 0, '2015-03-23 20:08:40', '20', '', 0, NULL, '0'),
(213, 229, 'desktop', 'topo_altura', 120, 0, '2015-03-23 20:09:10', NULL, '', 0, NULL, '0'),
(214, 229, 'desktop', 'logo_altura', 110, 0, '2015-03-23 20:09:10', NULL, '', 0, NULL, '0'),
(215, 229, 'desktop', 'logo_largura', 0, 0, '2015-03-23 20:09:10', NULL, '', 0, NULL, '0'),
(216, 229, 'desktop', 'logo_pos_x', 0, 0, '2015-03-23 20:09:10', NULL, '', 0, NULL, '0'),
(217, 229, 'desktop', 'logo_pos_y', 10, 0, '2015-03-23 20:09:10', NULL, '', 0, NULL, '0'),
(218, 229, 'desktop', 'logo_email', NULL, 0, '2015-03-23 20:20:05', '', '', 0, NULL, '0'),
(219, 229, 'desktop', 'logo_redes_sociais', NULL, 0, '2015-03-23 20:20:05', '', '', 0, NULL, '0'),
(220, 229, 'desktop', 'logo_tablet_intro', NULL, 0, '2015-03-23 20:20:05', '', '', 0, NULL, '0'),
(221, 229, 'desktop', 'logo_tablet', NULL, 0, '2015-03-23 20:20:05', '', '', 0, NULL, '0'),
(222, 229, 'desktop', 'logo_app', NULL, 0, '2015-03-23 20:20:05', '', '', 0, NULL, '0'),
(223, 229, 'desktop', 'logo_mobile', NULL, 0, '2015-03-23 20:20:05', '', '', 0, NULL, '0'),
(224, 229, 'desktop', 'logo_site', NULL, 0, '2015-03-23 20:20:05', 'f_1078', '', 0, NULL, '0'),
(225, 229, 'desktop', 'logo_site_string', NULL, 0, '2015-03-23 20:20:05', 'logo_hostmais_j7.png', '', 0, NULL, '0'),
(226, 229, 'desktop', 'logo_impressao', NULL, 0, '2015-03-23 20:20:05', '', '', 0, NULL, '0'),
(227, 229, 'desktop', 'rodape_copyright', NULL, 0, '2015-03-23 20:27:43', NULL, '', 0, NULL, '0'),
(228, 229, 'desktop', 'ft_menu', NULL, 0, '2015-03-23 20:27:43', 'bg_white_pilow.png', '', 0, NULL, '0'),
(229, 229, 'desktop', 'ft_line2', NULL, 0, '2015-03-23 20:27:43', 'bg_hari_flat.jpg', '', 0, NULL, '0'),
(230, 229, 'desktop', 'ft_txt_line2', NULL, 0, '2015-03-23 20:27:43', 'FFFFFF', '', 0, NULL, '0'),
(231, 229, 'desktop', 'ft_txt_menu', NULL, 0, '2015-03-23 20:27:43', 'FFFFFF', '', 0, NULL, '0'),
(232, 229, 'desktop', 'ft_txt_menu1', NULL, 0, '2015-03-23 20:27:43', '4F4F4F', '', 0, NULL, '0'),
(233, 229, 'desktop', 'ft_txt_menu2', NULL, 0, '2015-03-23 20:27:43', 'branco', '', 0, NULL, '0'),
(234, 229, 'desktop', 'ft_menu2_espacamento', 0, 0, '2015-03-23 20:27:43', NULL, '', 0, NULL, '0'),
(235, 229, 'desktop', 'ft_fb_bg', NULL, 0, '2015-03-23 20:27:43', '', '', 0, NULL, '0'),
(236, 229, 'desktop', 'ft_ln_company_bg', NULL, 0, '2015-03-23 20:27:43', 'fundoazul.jpg', '', 0, NULL, '0'),
(237, 229, 'desktop', 'ft_txt_line_company', NULL, 0, '2015-03-23 20:27:43', 'FFFFFF', '', 0, NULL, '0'),
(238, 229, 'desktop', 'site_release', NULL, 0, '2015-03-23 20:38:51', '00/00/0000', '', 0, NULL, '0'),
(239, 229, 'desktop', 'site_release_inverse', NULL, 0, '2015-03-23 20:38:51', '00/00/0000', '', 0, NULL, '0'),
(240, 229, 'desktop', 'title_popup', NULL, 0, '2015-03-23 23:18:50', 'FFFFFF', '', 0, NULL, '0'),
(241, 229, 'desktop', 'text_popup', NULL, 0, '2015-03-23 23:18:50', 'FFFFFF', '', 0, NULL, '0'),
(242, 0, 'desktop', 'menu_altura', NULL, 0, '2015-03-25 14:03:24', '22', '', 0, NULL, '0'),
(243, 229, 'desktop', 'topo_fit', 0, 0, '2015-04-01 17:04:13', NULL, '', 0, NULL, '0'),
(244, 340, 'desktop', 'altura_main_banner', 120, 0, '2015-04-02 18:29:49', NULL, '', 0, NULL, '0'),
(246, 229, 'desktop', 'canal_youtube', NULL, 0, '2015-04-06 14:28:12', '', '', 0, NULL, '0'),
(247, 229, 'desktop', 'flickr', NULL, 0, '2015-04-06 14:28:12', '', '', 0, NULL, '0'),
(248, 229, 'desktop', 'instagram', NULL, 0, '2015-04-06 14:28:12', '', '', 0, NULL, '0'),
(249, 229, 'desktop', 'pinterest', NULL, 0, '2015-04-06 14:28:12', '', '', 0, NULL, '0'),
(250, 229, 'desktop', 'home', NULL, 0, '2015-04-06 14:28:12', '', '', 0, NULL, '0'),
(251, 229, 'desktop', 'skype', NULL, 0, '2015-04-06 14:28:12', '', '', 0, NULL, '0'),
(252, 229, 'desktop', 'rss', NULL, 0, '2015-04-06 14:28:12', '', '', 0, NULL, '0'),
(255, 229, 'desktop', 'site_map', NULL, 0, '2015-04-06 14:28:12', '/mapa_site', '', 0, NULL, '0'),
(256, 229, 'desktop', 'email_ceos', NULL, 0, '2015-04-06 16:24:03', '', '', 0, NULL, '0'),
(257, 229, 'desktop', 'email_title', NULL, 0, '2015-04-06 16:24:03', 'HostMais', '', 0, NULL, '0'),
(258, 229, 'desktop', 'email_emkt', NULL, 0, '2015-04-06 16:24:03', '', '', 0, NULL, '0'),
(259, 229, 'desktop', 'email_emkt_teste', NULL, 0, '2015-04-06 16:24:03', '', '', 0, NULL, '0'),
(260, 0, 'desktop', 'ft_menu_type', 0, 0, '2015-04-09 13:44:59', NULL, '', 0, NULL, '0'),
(261, 0, 'desktop', 'ft_titulo_menu', NULL, 0, '2015-04-09 13:44:59', 'FFFFFF', '', 0, NULL, '0'),
(262, 0, 'desktop', 'ft_subtitulo_menu', NULL, 0, '2015-04-09 13:44:59', 'FFFFFF', '', 0, NULL, '0'),
(264, 341, 'desktop', 'altura_main_banner', 120, 0, '2015-04-18 12:31:49', NULL, '', 0, NULL, '0'),
(266, 0, 'desktop', 'flutuante_page_show', NULL, 0, '2015-04-22 23:13:05', 'home', '', 0, NULL, '0'),
(267, 0, 'desktop', 'flutuante_frequency', NULL, 0, '2015-04-22 23:13:05', 'once', '', 0, NULL, '0'),
(268, 341, 'desktop', 'menu_total', NULL, 0, '2015-04-23 12:38:27', 'true', '', 0, NULL, '0'),
(269, 341, 'desktop', 'topo_altura', 60, 0, '2015-04-23 12:38:27', NULL, '', 0, NULL, '0'),
(270, 341, 'desktop', 'frase_searchbox', NULL, 0, '2015-04-23 12:38:27', 'O que você precisa?', '', 0, NULL, '0'),
(271, 341, 'desktop', 'rodape_copyright', NULL, 0, '2015-04-23 12:38:27', NULL, 'Todos os direitos reservados', 0, NULL, '0'),
(272, 341, 'desktop', 'ft_menu', NULL, 0, '2015-04-23 12:38:27', 'bg_white_pilow.png', '', 0, NULL, '0'),
(273, 341, 'desktop', 'ft_menu_type', 3, 0, '2015-04-23 12:38:27', NULL, '', 0, NULL, '0'),
(274, 341, 'desktop', 'ft_menu_color', NULL, 0, '2015-04-23 12:38:27', 'FFFFFF', '', 0, NULL, '0'),
(275, 341, 'desktop', 'ft_line2', NULL, 0, '2015-04-23 12:38:27', 'fundoazul.jpg', '', 0, NULL, '0'),
(276, 341, 'desktop', 'ft_txt_line2', NULL, 0, '2015-04-23 12:38:27', 'FFFFFF', '', 0, NULL, '0'),
(277, 341, 'desktop', 'ft_titulo_menu', NULL, 0, '2015-04-23 12:38:27', '000000', '', 0, NULL, '0'),
(278, 341, 'desktop', 'ft_subtitulo_menu', NULL, 0, '2015-04-23 12:38:27', '333333', '', 0, NULL, '0'),
(279, 341, 'desktop', 'ft_txt_menu', NULL, 0, '2015-04-23 12:38:27', 'FFFFFF', '', 0, NULL, '0'),
(280, 341, 'desktop', 'ft_txt_menu1', NULL, 0, '2015-04-23 12:38:27', '191919', '', 0, NULL, '0'),
(281, 341, 'desktop', 'ft_txt_menu2', NULL, 0, '2015-04-23 12:38:27', 'preto', '', 0, NULL, '0'),
(282, 341, 'desktop', 'ft_menu2_espacamento', 0, 0, '2015-04-23 12:38:27', NULL, '', 0, NULL, '0'),
(283, 341, 'desktop', 'ft_fb_bg', NULL, 0, '2015-04-23 12:38:27', 'branco.jpg', '', 0, NULL, '0'),
(284, 341, 'desktop', 'ft_ln_company_bg', NULL, 0, '2015-04-23 12:38:27', 'themes_bg.jpg', '', 0, NULL, '0'),
(285, 341, 'desktop', 'ft_txt_line_company', NULL, 0, '2015-04-23 12:38:27', 'FFFFFF', '', 0, NULL, '0'),
(286, 341, 'desktop', 'site_release', NULL, 0, '2015-04-23 15:30:06', '23/06/2015', '', 0, NULL, '0'),
(287, 341, 'desktop', 'site_release_inverse', NULL, 0, '2015-04-23 15:30:06', '06/23/2015', '', 0, NULL, '0'),
(288, 341, 'desktop', 'logo_email', NULL, 0, '2015-04-23 16:43:34', '', '', 0, NULL, '0'),
(289, 341, 'desktop', 'logo_redes_sociais', NULL, 0, '2015-04-23 16:43:34', '', '', 0, NULL, '0'),
(290, 341, 'desktop', 'logo_tablet_intro', NULL, 0, '2015-04-23 16:43:34', '', '', 0, NULL, '0'),
(291, 341, 'desktop', 'logo_tablet', NULL, 0, '2015-04-23 16:43:34', '', '', 0, NULL, '0'),
(292, 341, 'desktop', 'logo_app', NULL, 0, '2015-04-23 16:43:34', '', '', 0, NULL, '0'),
(293, 341, 'desktop', 'logo_mobile', NULL, 0, '2015-04-23 16:43:34', '', '', 0, NULL, '0'),
(294, 341, 'desktop', 'logo_site', NULL, 0, '2015-04-23 16:43:34', 'f_1099', '', 0, NULL, '0'),
(295, 341, 'desktop', 'logo_site_string', NULL, 0, '2015-04-23 16:43:34', 'fonte_di_vitta_i8.png', '', 0, NULL, '0'),
(296, 341, 'desktop', 'logo_impressao', NULL, 0, '2015-04-23 16:43:34', '', '', 0, NULL, '0'),
(297, 341, 'desktop', 'topo_cor_1', NULL, 0, '2015-04-23 18:59:38', 'FFFFFF', '', 0, NULL, '0'),
(298, 341, 'desktop', 'topo_cor_2', NULL, 0, '2015-04-23 18:59:38', 'FFFFFF', '', 0, NULL, '0'),
(299, 341, 'desktop', 'topo_cor_3', NULL, 0, '2015-04-23 18:59:38', '292929', '', 0, NULL, '0'),
(300, 341, 'desktop', 'topo_cor_4', NULL, 0, '2015-04-23 18:59:38', 'FFFFFF', '', 0, NULL, '0'),
(301, 341, 'desktop', 'topo_cor_5', NULL, 0, '2015-04-23 18:59:38', '383838', '', 0, NULL, '0'),
(302, 341, 'desktop', 'topo_cor_6', NULL, 0, '2015-04-23 18:59:38', '3D3D3D', '', 0, NULL, '0'),
(303, 341, 'desktop', 'topo_layout', NULL, 0, '2015-04-23 18:59:38', 'reverse', '', 0, NULL, '0'),
(304, 341, 'desktop', 'topo_fit', 0, 0, '2015-04-24 14:56:26', NULL, '', 0, NULL, '0'),
(305, 341, 'desktop', 'logo_altura', 50, 0, '2015-04-24 14:56:26', NULL, '', 0, NULL, '0'),
(306, 341, 'desktop', 'logo_largura', 0, 0, '2015-04-24 14:56:26', NULL, '', 0, NULL, '0'),
(307, 341, 'desktop', 'logo_pos_x', 0, 0, '2015-04-24 14:56:26', NULL, '', 0, NULL, '0'),
(308, 341, 'desktop', 'logo_pos_y', 3, 0, '2015-04-24 14:56:26', NULL, '', 0, NULL, '0'),
(309, 0, 'desktop', 'button_type_special', 1, 0, '2015-04-25 21:11:54', NULL, '', 0, NULL, '0'),
(310, 0, 'desktop', 'button_main_special', NULL, 0, '2015-04-25 21:11:54', 'btn-black', '', 0, NULL, '0'),
(311, 0, 'desktop', 'button_success_special', NULL, 0, '2015-04-25 21:11:54', 'btn-green', '', 0, NULL, '0'),
(312, 0, 'desktop', 'button_second_special', NULL, 0, '2015-04-25 21:11:54', 'btn-white', '', 0, NULL, '0'),
(313, 0, 'desktop', 'menu_texture_type', NULL, 0, '2015-04-25 21:29:28', '', '', 0, NULL, '0'),
(315, 0, 'desktop', 'topo_cor_1', NULL, 0, '2015-04-27 17:29:47', '363636', '', 0, NULL, '0'),
(316, 0, 'desktop', 'topo_cor_2', NULL, 0, '2015-04-27 17:29:47', '2E2E2E', '', 0, NULL, '0'),
(317, 0, 'desktop', 'topo_cor_3', NULL, 0, '2015-04-27 17:29:47', 'FFFFFF', '', 0, NULL, '0'),
(318, 0, 'desktop', 'topo_cor_4', NULL, 0, '2015-04-27 17:29:47', 'FFFFFF', '', 0, NULL, '0'),
(319, 0, 'desktop', 'topo_cor_5', NULL, 0, '2015-04-27 17:29:47', '4A4A4A', '', 0, NULL, '0'),
(320, 0, 'desktop', 'topo_cor_6', NULL, 0, '2015-04-27 17:29:47', '292929', '', 0, NULL, '0'),
(321, 0, 'desktop', 'topo_layout', NULL, 0, '2015-04-27 17:29:47', 'reverse', '', 0, NULL, '0'),
(322, 0, 'desktop', 'topo_altura', 100, 0, '2015-04-27 17:30:51', NULL, '', 0, NULL, '0'),
(323, 0, 'desktop', 'topo_fit', 0, 0, '2015-04-27 17:30:51', NULL, '', 0, NULL, '0'),
(324, 0, 'desktop', 'logo_altura', 0, 0, '2015-04-27 17:30:51', NULL, '', 0, NULL, '0'),
(325, 0, 'desktop', 'logo_largura', 0, 0, '2015-04-27 17:30:51', NULL, '', 0, NULL, '0'),
(326, 0, 'desktop', 'logo_pos_x', 0, 0, '2015-04-27 17:30:51', NULL, '', 0, NULL, '0'),
(327, 0, 'desktop', 'logo_pos_y', 0, 0, '2015-04-27 17:30:51', NULL, '', 0, NULL, '0'),
(328, 0, 'desktop', 'logo_container_width', 0, 0, '2015-04-27 17:30:51', NULL, '', 0, NULL, '0'),
(329, 0, 'desktop', 'logo_container_height', 0, 0, '2015-04-27 17:30:51', NULL, '', 0, NULL, '0'),
(330, 0, 'desktop', 'frase_searchbox', NULL, 0, '2015-04-27 17:30:51', 'O que você precisa?', '', 0, NULL, '0'),
(331, 0, 'desktop', 'componente_site', 1, 0, '2015-05-22 20:45:37', 'Pier Relacionamento', 'Aplicativo padrão de gerenciamento das interações com usuários.\nPara gerenciar e visualizar e-mails recebidos, contatos e etc.\nO PierMail e o PierSMS são gerenciados por esse aplicativo', 401, 'pier_relacionamento', '0'),
(332, 0, 'desktop', 'componente_site', 1, 0, '2015-05-22 20:45:44', 'Pier Páginas', 'Aplicativo padrão de gerenciamento de páginas\nPara gerenciar todas as páginas, menus e conteúdo exclusivo', 405, 'pier_paginas', '0'),
(333, 0, 'desktop', 'componente_site', 1, 0, '2015-05-22 20:45:49', 'Pier Banners', 'Aplicativo padrão de gerenciamento das interações com usuários.\nPara gerenciar todos os banners e publicidade de seu site ou sistema\nO banner principal também é gerenciado por esse aplicativo', 402, 'pier_banners', '0'),
(334, 0, 'desktop', 'componente_site', 1, 0, '2015-05-22 20:46:29', 'Pier Imagens', 'Aplicativo padrão de gerenciamento de imagens\nPara gerenciar todas as imagens cadastradas em seu site ou sistema', 404, 'pier_imagens', '0'),
(335, 0, 'desktop', 'componente_site', 1, 0, '2016-01-27 19:20:13', 'Pier Categorias', 'Aplicativo padrão de gerenciamento de categorias\nPara gerenciar todas as categorias cadastradas em seu site ou sistema', 403, 'pier_categorias', '0'),
(336, 0, 'desktop', 'weather', NULL, 0, '2016-01-28 23:59:36', NULL, '{\"city\":{\"id\":3467865,\"name\":\"Campinas\",\"coord\":{\"lon\":-47.060829,\"lat\":-22.90556},\"country\":\"BR\",\"population\":0,\"sys\":{\"population\":0}},\"cod\":\"200\",\"message\":0.0136,\"cnt\":37,\"list\":[{\"dt\":1471348800,\"main\":{\"temp\":21.41,\"temp_min\":18.43,\"temp_max\":21.41,\"pressure\":959.74,\"sea_level\":1027.43,\"grnd_level\":959.74,\"humidity\":84,\"temp_kf\":2.98},\"weather\":[{\"id\":500,\"main\":\"Rain\",\"description\":\"chuva fraca\",\"icon\":\"10d\"}],\"clouds\":{\"all\":80},\"wind\":{\"speed\":4.91,\"deg\":0.500702},\"rain\":{\"3h\":0.55},\"sys\":{\"pod\":\"d\"},\"dt_txt\":\"2016-08-16 12:00:00\"},{\"dt\":1471359600,\"main\":{\"temp\":25.62,\"temp_min\":22.8,\"temp_max\":25.62,\"pressure\":959.19,\"sea_level\":1026.56,\"grnd_level\":959.19,\"humidity\":64,\"temp_kf\":2.82},\"weather\":[{\"id\":804,\"main\":\"Clouds\",\"description\":\"tempo nublado\",\"icon\":\"04d\"}],\"clouds\":{\"all\":92},\"wind\":{\"speed\":4.2,\"deg\":337.501},\"rain\":{},\"sys\":{\"pod\":\"d\"},\"dt_txt\":\"2016-08-16 15:00:00\"},{\"dt\":1471370400,\"main\":{\"temp\":26.57,\"temp_min\":23.9,\"temp_max\":26.57,\"pressure\":957.44,\"sea_level\":1024.51,\"grnd_level\":957.44,\"humidity\":66,\"temp_kf\":2.67},\"weather\":[{\"id\":500,\"main\":\"Rain\",\"description\":\"chuva fraca\",\"icon\":\"10d\"}],\"clouds\":{\"all\":8},\"wind\":{\"speed\":4.67,\"deg\":326.501},\"rain\":{\"3h\":0.485},\"sys\":{\"pod\":\"d\"},\"dt_txt\":\"2016-08-16 18:00:00\"},{\"dt\":1471381200,\"main\":{\"temp\":25.36,\"temp_min\":22.85,\"temp_max\":25.36,\"pressure\":957.54,\"sea_level\":1024.84,\"grnd_level\":957.54,\"humidity\":66,\"temp_kf\":2.51},\"weather\":[{\"id\":800,\"main\":\"Clear\",\"description\":\"céu claro\",\"icon\":\"01n\"}],\"clouds\":{\"all\":0},\"wind\":{\"speed\":1.7,\"deg\":310.509},\"rain\":{},\"sys\":{\"pod\":\"n\"},\"dt_txt\":\"2016-08-16 21:00:00\"},{\"dt\":1471392000,\"main\":{\"temp\":20.18,\"temp_min\":17.83,\"temp_max\":20.18,\"pressure\":959.04,\"sea_level\":1026.9,\"grnd_level\":959.04,\"humidity\":83,\"temp_kf\":2.35},\"weather\":[{\"id\":800,\"main\":\"Clear\",\"description\":\"céu claro\",\"icon\":\"01n\"}],\"clouds\":{\"all\":0},\"wind\":{\"speed\":1.91,\"deg\":304.007},\"rain\":{},\"sys\":{\"pod\":\"n\"},\"dt_txt\":\"2016-08-17 00:00:00\"},{\"dt\":1471402800,\"main\":{\"temp\":17.6,\"temp_min\":15.4,\"temp_max\":17.6,\"pressure\":959.38,\"sea_level\":1027.66,\"grnd_level\":959.38,\"humidity\":87,\"temp_kf\":2.2},\"weather\":[{\"id\":800,\"main\":\"Clear\",\"description\":\"céu claro\",\"icon\":\"01n\"}],\"clouds\":{\"all\":0},\"wind\":{\"speed\":1.94,\"deg\":37.5011},\"rain\":{},\"sys\":{\"pod\":\"n\"},\"dt_txt\":\"2016-08-17 03:00:00\"},{\"dt\":1471413600,\"main\":{\"temp\":16.11,\"temp_min\":14.07,\"temp_max\":16.11,\"pressure\":958.69,\"sea_level\":1027.13,\"grnd_level\":958.69,\"humidity\":89,\"temp_kf\":2.04},\"weather\":[{\"id\":800,\"main\":\"Clear\",\"description\":\"céu claro\",\"icon\":\"01n\"}],\"clouds\":{\"all\":0},\"wind\":{\"speed\":1.66,\"deg\":54.0028},\"rain\":{},\"sys\":{\"pod\":\"n\"},\"dt_txt\":\"2016-08-17 06:00:00\"},{\"dt\":1471424400,\"main\":{\"temp\":15.84,\"temp_min\":13.96,\"temp_max\":15.84,\"pressure\":958.76,\"sea_level\":1027.2,\"grnd_level\":958.76,\"humidity\":94,\"temp_kf\":1.88},\"weather\":[{\"id\":800,\"main\":\"Clear\",\"description\":\"céu claro\",\"icon\":\"01n\"}],\"clouds\":{\"all\":0},\"wind\":{\"speed\":2.07,\"deg\":38.0027},\"rain\":{},\"sys\":{\"pod\":\"n\"},\"dt_txt\":\"2016-08-17 09:00:00\"},{\"dt\":1471435200,\"main\":{\"temp\":22.68,\"temp_min\":20.95,\"temp_max\":22.68,\"pressure\":960.07,\"sea_level\":1027.81,\"grnd_level\":960.07,\"humidity\":74,\"temp_kf\":1.73},\"weather\":[{\"id\":800,\"main\":\"Clear\",\"description\":\"céu claro\",\"icon\":\"01d\"}],\"clouds\":{\"all\":0},\"wind\":{\"speed\":3.31,\"deg\":20.501},\"rain\":{},\"sys\":{\"pod\":\"d\"},\"dt_txt\":\"2016-08-17 12:00:00\"},{\"dt\":1471446000,\"main\":{\"temp\":29.26,\"temp_min\":27.69,\"temp_max\":29.26,\"pressure\":959.56,\"sea_level\":1026.57,\"grnd_level\":959.56,\"humidity\":62,\"temp_kf\":1.57},\"weather\":[{\"id\":800,\"main\":\"Clear\",\"description\":\"céu claro\",\"icon\":\"01d\"}],\"clouds\":{\"all\":0},\"wind\":{\"speed\":3.66,\"deg\":341.001},\"rain\":{},\"sys\":{\"pod\":\"d\"},\"dt_txt\":\"2016-08-17 15:00:00\"},{\"dt\":1471456800,\"main\":{\"temp\":31.35,\"temp_min\":29.94,\"temp_max\":31.35,\"pressure\":957.33,\"sea_level\":1023.99,\"grnd_level\":957.33,\"humidity\":44,\"temp_kf\":1.41},\"weather\":[{\"id\":800,\"main\":\"Clear\",\"description\":\"céu claro\",\"icon\":\"01d\"}],\"clouds\":{\"all\":0},\"wind\":{\"speed\":6.01,\"deg\":286.005},\"rain\":{},\"sys\":{\"pod\":\"d\"},\"dt_txt\":\"2016-08-17 18:00:00\"},{\"dt\":1471467600,\"main\":{\"temp\":27.8,\"temp_min\":26.54,\"temp_max\":27.8,\"pressure\":957.5,\"sea_level\":1024.28,\"grnd_level\":957.5,\"humidity\":38,\"temp_kf\":1.26},\"weather\":[{\"id\":800,\"main\":\"Clear\",\"description\":\"céu claro\",\"icon\":\"01n\"}],\"clouds\":{\"all\":0},\"wind\":{\"speed\":3.86,\"deg\":282.001},\"rain\":{},\"sys\":{\"pod\":\"n\"},\"dt_txt\":\"2016-08-17 21:00:00\"},{\"dt\":1471478400,\"main\":{\"temp\":21.4,\"temp_min\":20.3,\"temp_max\":21.4,\"pressure\":958.86,\"sea_level\":1026.19,\"grnd_level\":958.86,\"humidity\":62,\"temp_kf\":1.1},\"weather\":[{\"id\":801,\"main\":\"Clouds\",\"description\":\"Algumas nuvens\",\"icon\":\"02n\"}],\"clouds\":{\"all\":12},\"wind\":{\"speed\":1.52,\"deg\":314.502},\"rain\":{},\"sys\":{\"pod\":\"n\"},\"dt_txt\":\"2016-08-18 00:00:00\"},{\"dt\":1471489200,\"main\":{\"temp\":19.53,\"temp_min\":18.59,\"temp_max\":19.53,\"pressure\":959.17,\"sea_level\":1026.88,\"grnd_level\":959.17,\"humidity\":72,\"temp_kf\":0.94},\"weather\":[{\"id\":801,\"main\":\"Clouds\",\"description\":\"Algumas nuvens\",\"icon\":\"02n\"}],\"clouds\":{\"all\":24},\"wind\":{\"speed\":1.25,\"deg\":24.0021},\"rain\":{},\"sys\":{\"pod\":\"n\"},\"dt_txt\":\"2016-08-18 03:00:00\"},{\"dt\":1471500000,\"main\":{\"temp\":19.19,\"temp_min\":18.41,\"temp_max\":19.19,\"pressure\":958.48,\"sea_level\":1026.55,\"grnd_level\":958.48,\"humidity\":68,\"temp_kf\":0.78},\"weather\":[{\"id\":803,\"main\":\"Clouds\",\"description\":\"nuvens quebrados\",\"icon\":\"04n\"}],\"clouds\":{\"all\":56},\"wind\":{\"speed\":2.52,\"deg\":22.5017},\"rain\":{},\"sys\":{\"pod\":\"n\"},\"dt_txt\":\"2016-08-18 06:00:00\"},{\"dt\":1471510800,\"main\":{\"temp\":17.16,\"temp_min\":16.54,\"temp_max\":17.16,\"pressure\":959.72,\"sea_level\":1028.07,\"grnd_level\":959.72,\"humidity\":93,\"temp_kf\":0.63},\"weather\":[{\"id\":500,\"main\":\"Rain\",\"description\":\"chuva fraca\",\"icon\":\"10n\"}],\"clouds\":{\"all\":44},\"wind\":{\"speed\":1.43,\"deg\":155.501},\"rain\":{\"3h\":0.17},\"sys\":{\"pod\":\"n\"},\"dt_txt\":\"2016-08-18 09:00:00\"},{\"dt\":1471521600,\"main\":{\"temp\":20.37,\"temp_min\":19.9,\"temp_max\":20.37,\"pressure\":961.74,\"sea_level\":1029.5,\"grnd_level\":961.74,\"humidity\":78,\"temp_kf\":0.47},\"weather\":[{\"id\":500,\"main\":\"Rain\",\"description\":\"chuva fraca\",\"icon\":\"10d\"}],\"clouds\":{\"all\":64},\"wind\":{\"speed\":1.51,\"deg\":184.003},\"rain\":{\"3h\":0.03},\"sys\":{\"pod\":\"d\"},\"dt_txt\":\"2016-08-18 12:00:00\"},{\"dt\":1471532400,\"main\":{\"temp\":27.16,\"temp_min\":26.85,\"temp_max\":27.16,\"pressure\":960.92,\"sea_level\":1028.33,\"grnd_level\":960.92,\"humidity\":62,\"temp_kf\":0.31},\"weather\":[{\"id\":500,\"main\":\"Rain\",\"description\":\"chuva fraca\",\"icon\":\"10d\"}],\"clouds\":{\"all\":12},\"wind\":{\"speed\":1.97,\"deg\":58.0003},\"rain\":{\"3h\":0.12},\"sys\":{\"pod\":\"d\"},\"dt_txt\":\"2016-08-18 15:00:00\"},{\"dt\":1471543200,\"main\":{\"temp\":29.34,\"temp_min\":29.19,\"temp_max\":29.34,\"pressure\":958.78,\"sea_level\":1026,\"grnd_level\":958.78,\"humidity\":51,\"temp_kf\":0.16},\"weather\":[{\"id\":500,\"main\":\"Rain\",\"description\":\"chuva fraca\",\"icon\":\"10d\"}],\"clouds\":{\"all\":32},\"wind\":{\"speed\":2.57,\"deg\":143},\"rain\":{\"3h\":0.1475},\"sys\":{\"pod\":\"d\"},\"dt_txt\":\"2016-08-18 18:00:00\"},{\"dt\":1471554000,\"main\":{\"temp\":24.05,\"temp_min\":24.05,\"temp_max\":24.05,\"pressure\":959.66,\"sea_level\":1027.38,\"grnd_level\":959.66,\"humidity\":61,\"temp_kf\":0},\"weather\":[{\"id\":500,\"main\":\"Rain\",\"description\":\"chuva fraca\",\"icon\":\"10n\"}],\"clouds\":{\"all\":44},\"wind\":{\"speed\":1.55,\"deg\":231.007},\"rain\":{\"3h\":0.6375},\"sys\":{\"pod\":\"n\"},\"dt_txt\":\"2016-08-18 21:00:00\"},{\"dt\":1471564800,\"main\":{\"temp\":19.85,\"temp_min\":19.85,\"temp_max\":19.85,\"pressure\":960.96,\"sea_level\":1029.04,\"grnd_level\":960.96,\"humidity\":79,\"temp_kf\":0},\"weather\":[{\"id\":500,\"main\":\"Rain\",\"description\":\"chuva fraca\",\"icon\":\"10n\"}],\"clouds\":{\"all\":32},\"wind\":{\"speed\":1.21,\"deg\":111.006},\"rain\":{\"3h\":0.3375},\"sys\":{\"pod\":\"n\"},\"dt_txt\":\"2016-08-19 00:00:00\"},{\"dt\":1471575600,\"main\":{\"temp\":18.57,\"temp_min\":18.57,\"temp_max\":18.57,\"pressure\":960.67,\"sea_level\":1028.86,\"grnd_level\":960.67,\"humidity\":84,\"temp_kf\":0},\"weather\":[{\"id\":802,\"main\":\"Clouds\",\"description\":\"nuvens dispersas\",\"icon\":\"03n\"}],\"clouds\":{\"all\":32},\"wind\":{\"speed\":3.01,\"deg\":134.007},\"rain\":{},\"sys\":{\"pod\":\"n\"},\"dt_txt\":\"2016-08-19 03:00:00\"},{\"dt\":1471586400,\"main\":{\"temp\":17.6,\"temp_min\":17.6,\"temp_max\":17.6,\"pressure\":958.82,\"sea_level\":1027.04,\"grnd_level\":958.82,\"humidity\":89,\"temp_kf\":0},\"weather\":[{\"id\":803,\"main\":\"Clouds\",\"description\":\"nuvens quebrados\",\"icon\":\"04n\"}],\"clouds\":{\"all\":68},\"wind\":{\"speed\":2.56,\"deg\":109.502},\"rain\":{},\"sys\":{\"pod\":\"n\"},\"dt_txt\":\"2016-08-19 06:00:00\"},{\"dt\":1471597200,\"main\":{\"temp\":16,\"temp_min\":16,\"temp_max\":16,\"pressure\":958.27,\"sea_level\":1026.53,\"grnd_level\":958.27,\"humidity\":93,\"temp_kf\":0},\"weather\":[{\"id\":800,\"main\":\"Clear\",\"description\":\"céu claro\",\"icon\":\"01n\"}],\"clouds\":{\"all\":0},\"wind\":{\"speed\":1.45,\"deg\":116.501},\"rain\":{},\"sys\":{\"pod\":\"n\"},\"dt_txt\":\"2016-08-19 09:00:00\"},{\"dt\":1471608000,\"main\":{\"temp\":19.57,\"temp_min\":19.57,\"temp_max\":19.57,\"pressure\":959.88,\"sea_level\":1027.74,\"grnd_level\":959.88,\"humidity\":90,\"temp_kf\":0},\"weather\":[{\"id\":500,\"main\":\"Rain\",\"description\":\"chuva fraca\",\"icon\":\"10d\"}],\"clouds\":{\"all\":20},\"wind\":{\"speed\":3.67,\"deg\":166.502},\"rain\":{\"3h\":0.5125},\"sys\":{\"pod\":\"d\"},\"dt_txt\":\"2016-08-19 12:00:00\"},{\"dt\":1471618800,\"main\":{\"temp\":22.4,\"temp_min\":22.4,\"temp_max\":22.4,\"pressure\":960.61,\"sea_level\":1028.05,\"grnd_level\":960.61,\"humidity\":76,\"temp_kf\":0},\"weather\":[{\"id\":500,\"main\":\"Rain\",\"description\":\"chuva fraca\",\"icon\":\"10d\"}],\"clouds\":{\"all\":92},\"wind\":{\"speed\":3.52,\"deg\":206.5},\"rain\":{\"3h\":0.7375},\"sys\":{\"pod\":\"d\"},\"dt_txt\":\"2016-08-19 15:00:00\"},{\"dt\":1471629600,\"main\":{\"temp\":24.07,\"temp_min\":24.07,\"temp_max\":24.07,\"pressure\":958.47,\"sea_level\":1025.75,\"grnd_level\":958.47,\"humidity\":63,\"temp_kf\":0},\"weather\":[{\"id\":500,\"main\":\"Rain\",\"description\":\"chuva fraca\",\"icon\":\"10d\"}],\"clouds\":{\"all\":88},\"wind\":{\"speed\":2.57,\"deg\":197.001},\"rain\":{\"3h\":0.15},\"sys\":{\"pod\":\"d\"},\"dt_txt\":\"2016-08-19 18:00:00\"},{\"dt\":1471640400,\"main\":{\"temp\":24.3,\"temp_min\":24.3,\"temp_max\":24.3,\"pressure\":956.52,\"sea_level\":1023.93,\"grnd_level\":956.52,\"humidity\":56,\"temp_kf\":0},\"weather\":[{\"id\":803,\"main\":\"Clouds\",\"description\":\"nuvens quebrados\",\"icon\":\"04n\"}],\"clouds\":{\"all\":76},\"wind\":{\"speed\":2.52,\"deg\":28.0031},\"rain\":{},\"sys\":{\"pod\":\"n\"},\"dt_txt\":\"2016-08-19 21:00:00\"},{\"dt\":1471651200,\"main\":{\"temp\":22.47,\"temp_min\":22.47,\"temp_max\":22.47,\"pressure\":957.27,\"sea_level\":1024.87,\"grnd_level\":957.27,\"humidity\":64,\"temp_kf\":0},\"weather\":[{\"id\":803,\"main\":\"Clouds\",\"description\":\"nuvens quebrados\",\"icon\":\"04n\"}],\"clouds\":{\"all\":64},\"wind\":{\"speed\":4.17,\"deg\":23.0009},\"rain\":{},\"sys\":{\"pod\":\"n\"},\"dt_txt\":\"2016-08-20 00:00:00\"},{\"dt\":1471662000,\"main\":{\"temp\":20.21,\"temp_min\":20.21,\"temp_max\":20.21,\"pressure\":956.78,\"sea_level\":1024.48,\"grnd_level\":956.78,\"humidity\":78,\"temp_kf\":0},\"weather\":[{\"id\":500,\"main\":\"Rain\",\"description\":\"chuva fraca\",\"icon\":\"10n\"}],\"clouds\":{\"all\":80},\"wind\":{\"speed\":1.61,\"deg\":10.0043},\"rain\":{\"3h\":0.1875},\"sys\":{\"pod\":\"n\"},\"dt_txt\":\"2016-08-20 03:00:00\"},{\"dt\":1471672800,\"main\":{\"temp\":18.86,\"temp_min\":18.86,\"temp_max\":18.86,\"pressure\":956.37,\"sea_level\":1024.25,\"grnd_level\":956.37,\"humidity\":89,\"temp_kf\":0},\"weather\":[{\"id\":500,\"main\":\"Rain\",\"description\":\"chuva fraca\",\"icon\":\"10n\"}],\"clouds\":{\"all\":92},\"wind\":{\"speed\":1.51,\"deg\":8.50012},\"rain\":{\"3h\":0.85},\"sys\":{\"pod\":\"n\"},\"dt_txt\":\"2016-08-20 06:00:00\"},{\"dt\":1471683600,\"main\":{\"temp\":18.24,\"temp_min\":18.24,\"temp_max\":18.24,\"pressure\":956.53,\"sea_level\":1024.59,\"grnd_level\":956.53,\"humidity\":90,\"temp_kf\":0},\"weather\":[{\"id\":500,\"main\":\"Rain\",\"description\":\"chuva fraca\",\"icon\":\"10n\"}],\"clouds\":{\"all\":80},\"wind\":{\"speed\":1.38,\"deg\":45.0002},\"rain\":{\"3h\":0.75},\"sys\":{\"pod\":\"n\"},\"dt_txt\":\"2016-08-20 09:00:00\"},{\"dt\":1471694400,\"main\":{\"temp\":18.77,\"temp_min\":18.77,\"temp_max\":18.77,\"pressure\":960.41,\"sea_level\":1028.48,\"grnd_level\":960.41,\"humidity\":95,\"temp_kf\":0},\"weather\":[{\"id\":500,\"main\":\"Rain\",\"description\":\"chuva fraca\",\"icon\":\"10d\"}],\"clouds\":{\"all\":92},\"wind\":{\"speed\":4.18,\"deg\":231.504},\"rain\":{\"3h\":1.5},\"sys\":{\"pod\":\"d\"},\"dt_txt\":\"2016-08-20 12:00:00\"},{\"dt\":1471705200,\"main\":{\"temp\":17.79,\"temp_min\":17.79,\"temp_max\":17.79,\"pressure\":960.95,\"sea_level\":1028.94,\"grnd_level\":960.95,\"humidity\":100,\"temp_kf\":0},\"weather\":[{\"id\":501,\"main\":\"Rain\",\"description\":\"Chuva moderada\",\"icon\":\"10d\"}],\"clouds\":{\"all\":92},\"wind\":{\"speed\":3.49,\"deg\":191.001},\"rain\":{\"3h\":11.25},\"sys\":{\"pod\":\"d\"},\"dt_txt\":\"2016-08-20 15:00:00\"},{\"dt\":1471716000,\"main\":{\"temp\":17.04,\"temp_min\":17.04,\"temp_max\":17.04,\"pressure\":960.06,\"sea_level\":1027.67,\"grnd_level\":960.06,\"humidity\":100,\"temp_kf\":0},\"weather\":[{\"id\":501,\"main\":\"Rain\",\"description\":\"Chuva moderada\",\"icon\":\"10d\"}],\"clouds\":{\"all\":92},\"wind\":{\"speed\":3.06,\"deg\":132.008},\"rain\":{\"3h\":7.9},\"sys\":{\"pod\":\"d\"},\"dt_txt\":\"2016-08-20 18:00:00\"},{\"dt\":1471726800,\"main\":{\"temp\":17.53,\"temp_min\":17.53,\"temp_max\":17.53,\"pressure\":959.39,\"sea_level\":1027.32,\"grnd_level\":959.39,\"humidity\":99,\"temp_kf\":0},\"weather\":[{\"id\":501,\"main\":\"Rain\",\"description\":\"Chuva moderada\",\"icon\":\"10n\"}],\"clouds\":{\"all\":92},\"wind\":{\"speed\":2.51,\"deg\":84.0049},\"rain\":{\"3h\":6.5},\"sys\":{\"pod\":\"n\"},\"dt_txt\":\"2016-08-20 21:00:00\"},{\"dt\":1471737600,\"main\":{\"temp\":17.44,\"temp_min\":17.44,\"temp_max\":17.44,\"pressure\":960.37,\"sea_level\":1028.63,\"grnd_level\":960.37,\"humidity\":99,\"temp_kf\":0},\"weather\":[{\"id\":501,\"main\":\"Rain\",\"description\":\"Chuva moderada\",\"icon\":\"10n\"}],\"clouds\":{\"all\":92},\"wind\":{\"speed\":3.16,\"deg\":43.0045},\"rain\":{\"3h\":8.425},\"sys\":{\"pod\":\"n\"},\"dt_txt\":\"2016-08-21 00:00:00\"}]}', 0, NULL, '0'),
(337, 0, 'desktop', 'componente_site', 1, 0, '2016-08-15 19:10:39', 'Pier CSS Editor', 'Com esse aplicativo você consegue criar um CSS para adicionar a seu site e poder editar todas as características do seu site\nInstale já e troque ou crie novos estilos CSS para modificar a aparência do seu site ', 474, 'css_editor', '0'),
(338, 0, 'desktop', 'componente_site', 1, 0, '2016-08-15 19:10:51', 'Pier Tutoriais', 'Adicione o PierTutoriais no seu Admin\nÉ exibido os mesmos tutoriais com mesmas funcionalidades do Wiki PurplePier também no Admin.\nPossui recurso de tirar dúvidas', 505, 'pier_tutoriais', '0');

-- --------------------------------------------------------

--
-- Estrutura da tabela `preferencias_data`
--

CREATE TABLE `preferencias_data` (
  `id` int(11) NOT NULL,
  `tipo` varchar(100) DEFAULT NULL,
  `id_user` int(11) NOT NULL,
  `topo` int(11) DEFAULT NULL,
  `topo_tipo` varchar(100) DEFAULT NULL,
  `rodape` int(11) DEFAULT NULL,
  `rodape_tipo` varchar(100) DEFAULT NULL,
  `banner` varchar(60) NOT NULL,
  `design_site` varchar(100) NOT NULL,
  `layout_site` varchar(50) DEFAULT NULL,
  `layout_home` varchar(100) NOT NULL,
  `logos` varchar(100) NOT NULL,
  `icons` varchar(50) NOT NULL,
  `flags` varchar(50) NOT NULL,
  `classe_container` varchar(100) NOT NULL,
  `textura_topo` varchar(100) NOT NULL,
  `textura_rodape` varchar(100) NOT NULL,
  `textura_site` varchar(70) DEFAULT NULL,
  `textura_paginas` varchar(70) DEFAULT NULL,
  `textura_menu` varchar(70) NOT NULL,
  `textura_botao` varchar(70) NOT NULL,
  `textura_detalhe` varchar(70) NOT NULL,
  `textura_sombras` varchar(70) NOT NULL,
  `textura_overlay` varchar(70) NOT NULL,
  `textura_intro` varchar(100) NOT NULL,
  `textura_mensagem` varchar(100) NOT NULL,
  `textura_textos` varchar(150) NOT NULL,
  `textura_rodape_email` varchar(100) NOT NULL,
  `textura_topo_email` varchar(100) NOT NULL,
  `botao_cor` varchar(15) NOT NULL,
  `botao_cor_hover` varchar(15) NOT NULL,
  `titulo_cor` varchar(15) NOT NULL,
  `subtitulo_cor` varchar(15) NOT NULL,
  `texto_cor` varchar(15) NOT NULL,
  `link_cor` varchar(15) NOT NULL,
  `link_cor_hover` varchar(15) NOT NULL,
  `menu_cor` varchar(15) NOT NULL,
  `menu_cor_hover` varchar(15) NOT NULL,
  `input_text_cor` varchar(20) NOT NULL,
  `textura_vertical_block` varchar(70) NOT NULL,
  `textura_vertical_block2` varchar(70) NOT NULL,
  `textura_horizontal_block` varchar(70) NOT NULL,
  `textura_horizontal_block2` varchar(70) NOT NULL,
  `tipo_textura_topo` int(11) NOT NULL,
  `tipo_textura_rodape` int(11) NOT NULL,
  `tipo_textura_paginas` int(11) NOT NULL,
  `tipo_textura_site` int(11) NOT NULL,
  `tipo_textura_menu` int(11) NOT NULL,
  `tipo_textura_botao` int(11) NOT NULL,
  `tipo_textura_overlay` int(11) NOT NULL,
  `tipo_textura_sombra` int(11) NOT NULL,
  `tipo_textura_intro` int(11) NOT NULL,
  `tipo_textura_mensagem` int(11) NOT NULL,
  `tipo_textura_textos` int(11) NOT NULL,
  `tipo_textura_topo_email` int(11) NOT NULL,
  `tipo_textura_rodape_email` int(11) NOT NULL,
  `tipo_textura_vertical_block1` varchar(11) NOT NULL,
  `tipo_textura_vertical_block2` varchar(11) NOT NULL,
  `tipo_textura_horizontal_block1` varchar(11) NOT NULL,
  `tipo_textura_horizontal_block2` varchar(11) NOT NULL,
  `cor_textura_site` varchar(20) NOT NULL,
  `cor_textura_paginas` varchar(20) NOT NULL,
  `cor_textura_intro` varchar(20) NOT NULL,
  `classe_alerta` varchar(100) NOT NULL,
  `menu_exibe` int(2) DEFAULT '1',
  `google_maps` longtext NOT NULL,
  `facebook` varchar(400) NOT NULL,
  `twitter` varchar(400) NOT NULL,
  `linkedin` varchar(255) NOT NULL,
  `google_analytics` varchar(400) NOT NULL,
  `orkut` varchar(400) NOT NULL,
  `rss` int(2) NOT NULL DEFAULT '1',
  `titulo` varchar(100) NOT NULL,
  `descricao` varchar(400) NOT NULL DEFAULT '',
  `metatags` longtext NOT NULL,
  `email_contato` varchar(150) NOT NULL,
  `email_sender` varchar(100) DEFAULT NULL,
  `google_mais_um` varchar(400) NOT NULL,
  `google_tags_manager` varchar(50) DEFAULT NULL,
  `valor_free` int(2) NOT NULL DEFAULT '0',
  `produtos_qtd` int(2) NOT NULL DEFAULT '0',
  `embrulho` int(2) NOT NULL DEFAULT '0',
  `showcase` int(2) NOT NULL DEFAULT '0',
  `envio` int(2) NOT NULL DEFAULT '0',
  `parcelamento` int(2) NOT NULL DEFAULT '0',
  `online_admin` int(2) NOT NULL DEFAULT '0',
  `status` varchar(30) NOT NULL DEFAULT 'ok',
  `hotsite` varchar(100) NOT NULL DEFAULT '0',
  `hotsite_url` varchar(100) NOT NULL DEFAULT '0',
  `textura_efeitos` varchar(100) NOT NULL DEFAULT '0',
  `textura_wallpaper` varchar(100) NOT NULL DEFAULT '0',
  `tipo_textura_wallpaper` int(11) NOT NULL DEFAULT '0',
  `tipo_textura_efeitos` int(11) NOT NULL DEFAULT '0',
  `google_analytics_view` varchar(200) NOT NULL DEFAULT '0',
  `concorda` int(2) NOT NULL DEFAULT '0',
  `css_cliente` int(2) NOT NULL DEFAULT '0',
  `textura_conteudo` varchar(100) NOT NULL DEFAULT '0',
  `tipo_textura_conteudo` int(2) NOT NULL DEFAULT '0',
  `cor_textura_conteudo` varchar(20) NOT NULL DEFAULT '0',
  `json` longtext NOT NULL,
  `language` varchar(2) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `preferencias_data`
--

INSERT INTO `preferencias_data` (`id`, `tipo`, `id_user`, `topo`, `topo_tipo`, `rodape`, `rodape_tipo`, `banner`, `design_site`, `layout_site`, `layout_home`, `logos`, `icons`, `flags`, `classe_container`, `textura_topo`, `textura_rodape`, `textura_site`, `textura_paginas`, `textura_menu`, `textura_botao`, `textura_detalhe`, `textura_sombras`, `textura_overlay`, `textura_intro`, `textura_mensagem`, `textura_textos`, `textura_rodape_email`, `textura_topo_email`, `botao_cor`, `botao_cor_hover`, `titulo_cor`, `subtitulo_cor`, `texto_cor`, `link_cor`, `link_cor_hover`, `menu_cor`, `menu_cor_hover`, `input_text_cor`, `textura_vertical_block`, `textura_vertical_block2`, `textura_horizontal_block`, `textura_horizontal_block2`, `tipo_textura_topo`, `tipo_textura_rodape`, `tipo_textura_paginas`, `tipo_textura_site`, `tipo_textura_menu`, `tipo_textura_botao`, `tipo_textura_overlay`, `tipo_textura_sombra`, `tipo_textura_intro`, `tipo_textura_mensagem`, `tipo_textura_textos`, `tipo_textura_topo_email`, `tipo_textura_rodape_email`, `tipo_textura_vertical_block1`, `tipo_textura_vertical_block2`, `tipo_textura_horizontal_block1`, `tipo_textura_horizontal_block2`, `cor_textura_site`, `cor_textura_paginas`, `cor_textura_intro`, `classe_alerta`, `menu_exibe`, `google_maps`, `facebook`, `twitter`, `linkedin`, `google_analytics`, `orkut`, `rss`, `titulo`, `descricao`, `metatags`, `email_contato`, `email_sender`, `google_mais_um`, `google_tags_manager`, `valor_free`, `produtos_qtd`, `embrulho`, `showcase`, `envio`, `parcelamento`, `online_admin`, `status`, `hotsite`, `hotsite_url`, `textura_efeitos`, `textura_wallpaper`, `tipo_textura_wallpaper`, `tipo_textura_efeitos`, `google_analytics_view`, `concorda`, `css_cliente`, `textura_conteudo`, `tipo_textura_conteudo`, `cor_textura_conteudo`, `json`, `language`) VALUES
(1, 'desktop', 0, 1, 'rattatouli', 2, 'vevo', '109', 'rattatouli', 'rattatouli', 'home_columns_block', 'pierlogo_azul_b8.png', 'circle_black.png', 'arrow_black.png', 'empty', '', 'white_half.png', 'branco.jpg', 'transparent_50.png', 'bg2.jpg', 'bt_purplepier_3.png', '262', '', '', 'intro_purplepier.jpg', 'statusd7.png', 'input_text_white_dark.png', 'email_footer_playground.jpg', 'topo_white_rectangle.png', 'FFFFFF', 'FFFFFF', '0C1636', '8A2039', '3B3B3B', '850B0B', '731115', '5C5C5C', '000000', '404040', '297', '195', '298', '197', 0, 3, 1, 1, 1, 2, 0, 0, 2, 2, 2, 2, 2, '', '', '', '', '', '', '', 'alert_black_simple', 1, '', 'PurplePier', 'PurplePier', '', '', '', 1, 'Purplepier', 'Desenvolvimento Sites, Loja Virtual E-commerce, Fotografia de Produtos, Sistemas de Gerenciamento de Conteúdo Online, Marketing Digital e Identidade Visual\n', 'gerenciamento de conteúdo, criação de site, Registro de Domínios, Hospedagem de Sites, Criação de Sites, Logotipos, divulgação de Sites, Links Patrocinados, Mala Direta, lojas Virtuais, Fotografia de produtos para ecommerce, Gerenciamento de Conteúdo (CMS), desenvolvimento de Sistemas Web TI, Obtenção de Certificado Digital SSL, agencia campinas', 'contato@purplepier.com.br', 'contato@verpreview.com.br', '+PurplepierBr', '', 0, 1, 0, 0, 0, 0, 0, '0', '0', '0', 'pixel.png', 'blured_black.jpg', 2, 1, '0', 0, 0, '0', 0, '0', '', '0');

-- --------------------------------------------------------

--
-- Estrutura da tabela `promocao_data`
--

CREATE TABLE `promocao_data` (
  `id` int(11) NOT NULL,
  `titulo` varchar(100) NOT NULL,
  `descricao` varchar(400) NOT NULL,
  `data` datetime NOT NULL,
  `encerramento` datetime NOT NULL,
  `directory` varchar(50) NOT NULL,
  `url` varchar(50) NOT NULL,
  `premios` longtext NOT NULL,
  `estimativa_pageviews` int(11) NOT NULL,
  `estimativa_lojas` int(11) NOT NULL,
  `estimativa_promocao` int(11) NOT NULL,
  `estimativa_redes_sociais` int(11) NOT NULL,
  `tipo` int(2) NOT NULL DEFAULT '0',
  `extra` varchar(400) NOT NULL DEFAULT '0',
  `container_1` varchar(200) NOT NULL DEFAULT '0',
  `link_special` varchar(300) NOT NULL DEFAULT '0',
  `container_2` varchar(100) NOT NULL DEFAULT '0',
  `regulamento` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `promocao_parceiros`
--

CREATE TABLE `promocao_parceiros` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_general` int(11) NOT NULL,
  `nome` varchar(150) NOT NULL,
  `data` datetime NOT NULL,
  `tipo` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `promocao_participantes`
--

CREATE TABLE `promocao_participantes` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_voucher` int(11) NOT NULL,
  `id_promocao` int(11) DEFAULT NULL,
  `ip` varchar(50) DEFAULT NULL,
  `titulo` varchar(100) NOT NULL,
  `tipo` varchar(50) NOT NULL COMMENT 'Sasional, fixa',
  `nome` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `voucher` varchar(100) NOT NULL,
  `frase` varchar(400) NOT NULL,
  `loja` varchar(150) NOT NULL,
  `data` datetime NOT NULL,
  `compartilhar` int(2) DEFAULT NULL,
  `reputacao` int(11) NOT NULL DEFAULT '0',
  `status` int(2) NOT NULL,
  `telefone` varchar(20) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `promocao_vouchers`
--

CREATE TABLE `promocao_vouchers` (
  `id` int(11) NOT NULL,
  `codigo` varchar(20) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_general` int(11) NOT NULL,
  `receiver` varchar(150) DEFAULT NULL,
  `last_update` datetime NOT NULL,
  `data_creation` datetime NOT NULL,
  `tipo` varchar(100) NOT NULL,
  `status` int(2) NOT NULL DEFAULT '0',
  `titulo` varchar(200) NOT NULL DEFAULT '0',
  `discount` float NOT NULL DEFAULT '0',
  `parcelas` int(2) NOT NULL DEFAULT '0',
  `json` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `redesocial_posts`
--

CREATE TABLE `redesocial_posts` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `user_name` varchar(200) NOT NULL,
  `user_avatar` varchar(200) NOT NULL,
  `message` longtext NOT NULL,
  `image` varchar(1000) NOT NULL,
  `date` datetime NOT NULL,
  `last_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `tipo` int(11) NOT NULL,
  `likes` int(11) NOT NULL,
  `unlikes` int(11) NOT NULL,
  `json` longtext NOT NULL,
  `id_general` int(11) NOT NULL DEFAULT '0',
  `exibir` int(2) NOT NULL DEFAULT '1',
  `id_pagina` int(11) NOT NULL DEFAULT '0',
  `id_page` int(11) NOT NULL DEFAULT '0',
  `label` int(11) NOT NULL DEFAULT '0',
  `id_postagem` int(11) NOT NULL DEFAULT '0',
  `layout_tipo` int(3) NOT NULL DEFAULT '0',
  `id_content` int(11) NOT NULL DEFAULT '0',
  `image_square` varchar(100) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `sms_data`
--

CREATE TABLE `sms_data` (
  `id` int(11) NOT NULL,
  `nome` varchar(200) NOT NULL,
  `celular` varchar(100) NOT NULL,
  `message` varchar(600) NOT NULL,
  `data_envio` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `templates_attribute`
--

CREATE TABLE `templates_attribute` (
  `id` int(11) NOT NULL,
  `id_template` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `inteiro` int(11) DEFAULT NULL,
  `number` float NOT NULL,
  `estampa` timestamp NULL DEFAULT NULL,
  `texto` varchar(255) DEFAULT NULL,
  `descricao` longtext NOT NULL,
  `id_componente` int(11) NOT NULL DEFAULT '0',
  `id_row` int(11) NOT NULL DEFAULT '0',
  `tipo` varchar(50) NOT NULL DEFAULT '0',
  `plataforma` varchar(50) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `templates_data`
--

CREATE TABLE `templates_data` (
  `id` int(11) NOT NULL,
  `id_categoria` int(11) DEFAULT NULL,
  `titulo` varchar(150) CHARACTER SET latin1 NOT NULL,
  `descricao` longtext CHARACTER SET latin1 NOT NULL,
  `detalhes` longtext,
  `tipo` varchar(50) CHARACTER SET latin1 NOT NULL,
  `data` datetime NOT NULL,
  `last_update` datetime NOT NULL,
  `container_1` varchar(150) DEFAULT NULL,
  `container_2` varchar(150) DEFAULT NULL,
  `urk` varchar(1000) NOT NULL DEFAULT '0',
  `n_index` int(11) NOT NULL DEFAULT '1',
  `next_id` int(11) NOT NULL DEFAULT '0',
  `group_id` int(11) NOT NULL DEFAULT '0',
  `df_componente` longtext NOT NULL,
  `id_campanha` int(11) NOT NULL DEFAULT '0',
  `text_plain` longtext NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `templates_rows`
--

CREATE TABLE `templates_rows` (
  `id` int(11) NOT NULL,
  `id_template` int(11) NOT NULL,
  `layout` varchar(50) NOT NULL,
  `slots` int(2) NOT NULL,
  `n_index` int(11) NOT NULL,
  `titulo` varchar(100) NOT NULL DEFAULT '0',
  `tipo` varchar(50) NOT NULL DEFAULT '0',
  `exibe` int(2) NOT NULL DEFAULT '0',
  `id_componente` int(11) NOT NULL DEFAULT '0',
  `json` longtext NOT NULL,
  `cool` varchar(200) NOT NULL DEFAULT '0',
  `label` varchar(300) NOT NULL DEFAULT '0',
  `p_x_un` int(2) NOT NULL DEFAULT '0',
  `p_y_un` int(2) NOT NULL DEFAULT '0',
  `p_x` int(11) NOT NULL DEFAULT '0',
  `p_y` int(11) NOT NULL DEFAULT '0',
  `posin_x` int(11) NOT NULL DEFAULT '0',
  `posin_y` int(11) NOT NULL DEFAULT '0',
  `posin_x_un` int(2) NOT NULL DEFAULT '0',
  `posin_y_un` int(2) NOT NULL DEFAULT '0',
  `iniciar` int(11) NOT NULL DEFAULT '0',
  `sair` int(11) NOT NULL DEFAULT '0',
  `saida` int(11) NOT NULL DEFAULT '0',
  `duracao_in` int(11) NOT NULL DEFAULT '0',
  `show_until` int(11) NOT NULL DEFAULT '0',
  `width` int(11) NOT NULL DEFAULT '0',
  `height` int(11) NOT NULL DEFAULT '0',
  `width_un` int(11) NOT NULL DEFAULT '0',
  `height_un` int(11) NOT NULL DEFAULT '0',
  `fade` int(2) NOT NULL DEFAULT '0',
  `texto` varchar(500) NOT NULL DEFAULT '0',
  `descricao` longtext NOT NULL,
  `fonte` varchar(400) NOT NULL DEFAULT '0',
  `tamanho` varchar(400) NOT NULL DEFAULT '0',
  `alinhamento` varchar(400) NOT NULL DEFAULT '0',
  `color` varchar(400) NOT NULL DEFAULT '0',
  `tema` varchar(100) NOT NULL DEFAULT '0',
  `sombra` int(2) NOT NULL DEFAULT '0',
  `src` varchar(300) NOT NULL DEFAULT '0',
  `color2` varchar(100) NOT NULL DEFAULT '0',
  `link` varchar(1000) NOT NULL DEFAULT '0',
  `target` int(2) NOT NULL DEFAULT '0',
  `efeito` varchar(300) NOT NULL DEFAULT '0',
  `modelo` int(3) NOT NULL DEFAULT '0',
  `is_container` int(2) NOT NULL DEFAULT '0',
  `is_centered` int(2) NOT NULL DEFAULT '0',
  `subtitulo` varchar(400) NOT NULL DEFAULT '0',
  `fote_titulo` varchar(100) NOT NULL DEFAULT '0',
  `fote_subtitulo` varchar(100) NOT NULL DEFAULT '0',
  `fonte_titulo` varchar(100) NOT NULL DEFAULT '0',
  `fonte_subtitulo` varchar(100) NOT NULL DEFAULT '0',
  `alinhamento_titulo` varchar(100) NOT NULL DEFAULT '0',
  `alinhamento_subtitulo` varchar(100) NOT NULL DEFAULT '0',
  `color_titulo` varchar(100) NOT NULL DEFAULT '0',
  `color_subtitulo` varchar(100) NOT NULL DEFAULT '0',
  `tamanho_titulo` varchar(50) NOT NULL DEFAULT '0',
  `tamanho_subtitulo` varchar(50) NOT NULL DEFAULT '0',
  `sombra_titulo` int(2) NOT NULL DEFAULT '0',
  `tema_titulo` varchar(50) NOT NULL DEFAULT '0',
  `tema_subtitulo` varchar(50) NOT NULL DEFAULT '0',
  `sombra_subtitulo` int(2) NOT NULL DEFAULT '0',
  `color_botao` varchar(50) NOT NULL DEFAULT '0',
  `tema_botao` varchar(100) NOT NULL DEFAULT '0',
  `alinhamento_botao` varchar(50) NOT NULL DEFAULT '0',
  `color_label` varchar(50) NOT NULL DEFAULT '0',
  `defnicoes_titulo` longtext NOT NULL,
  `df_titulo` longtext NOT NULL,
  `titulo_bl_1` varchar(400) NOT NULL DEFAULT '0',
  `titulo_bl_2` varchar(400) NOT NULL DEFAULT '0',
  `titulo_bl_3` varchar(400) NOT NULL DEFAULT '0',
  `titulo_bl_4` varchar(400) NOT NULL DEFAULT '0',
  `df_titulo_bl_1` longtext NOT NULL,
  `df_bl_1` longtext NOT NULL,
  `df_subtitulo_bl_1` longtext NOT NULL,
  `subtitulo_bl_1` varchar(400) NOT NULL DEFAULT '0',
  `texto_bl_1` longtext NOT NULL,
  `texto_bl_2` longtext NOT NULL,
  `texto_bl_3` longtext NOT NULL,
  `texto_bl_4` longtext NOT NULL,
  `df_texto_bl_1` longtext NOT NULL,
  `df_texto_bl_2` longtext NOT NULL,
  `df_texto_bl_3` longtext NOT NULL,
  `df_texto_bl_4` longtext NOT NULL,
  `qtd_blocos` int(3) NOT NULL DEFAULT '0',
  `borda_componente` varchar(100) NOT NULL DEFAULT '0',
  `background` varchar(100) NOT NULL DEFAULT '0',
  `df_titulo_bl_2` longtext NOT NULL,
  `df_titulo_bl_3` longtext NOT NULL,
  `df_titulo_bl_4` longtext NOT NULL,
  `subtitulo_bl_2` longtext NOT NULL,
  `subtitulo_bl_3` longtext NOT NULL,
  `subtitulo_bl_4` longtext NOT NULL,
  `df_subtitulo_bl_2` longtext NOT NULL,
  `df_subtitulo_bl_3` longtext NOT NULL,
  `df_subtitulo_bl_4` longtext NOT NULL,
  `df_bl_2` longtext NOT NULL,
  `df_bl_3` longtext NOT NULL,
  `df_bl_4` longtext NOT NULL,
  `margin_top` varchar(50) NOT NULL DEFAULT '0',
  `margin_bottom` varchar(50) NOT NULL DEFAULT '0',
  `padding_top` varchar(50) NOT NULL DEFAULT '0',
  `padding_bottom` varchar(50) NOT NULL DEFAULT '0',
  `df_componente` longtext NOT NULL,
  `canal` varchar(100) NOT NULL DEFAULT '0',
  `df_subtitulo` longtext NOT NULL,
  `df_texto` longtext NOT NULL,
  `df_botao` longtext NOT NULL,
  `id_general` int(11) NOT NULL DEFAULT '0',
  `id_pagerows` int(11) NOT NULL DEFAULT '0',
  `json2` longtext NOT NULL,
  `df_componente2` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `user_address`
--

CREATE TABLE `user_address` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `zip` varbinary(255) NOT NULL COMMENT 'Ex 13098342',
  `address` varbinary(255) NOT NULL COMMENT 'Ex: r Embu',
  `number` varbinary(255) NOT NULL COMMENT 'Ex: 30',
  `complement` varbinary(255) DEFAULT NULL COMMENT 'Ex: Fundos',
  `city` varbinary(255) NOT NULL COMMENT 'Ex: Campinas',
  `bairro` varbinary(155) NOT NULL,
  `state_id` int(11) NOT NULL,
  `address_types_id` int(11) NOT NULL,
  `pais` varchar(4) NOT NULL DEFAULT '0',
  `id_city` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `user_address`
--

INSERT INTO `user_address` (`id`, `user_id`, `zip`, `address`, `number`, `complement`, `city`, `bairro`, `state_id`, `address_types_id`, `pais`, `id_city`) VALUES
(1, 54, 0xbdbbf61aa6a685158f74c6025525f6c2, 0x2cbbe09091ddce5ee9c747be34a651b758a170be00fa195285d095480741ccf7, 0x8713bba366191b4084242e2d2db7b5bb, 0xebac5074a6352be66a0ce82105d43c68876a370077e959d542fb28e0a2001415, 0xb8eb82b6a4a20b3bd39b21f7895d86e760b73066268a9b85ff6748520297c44dd850b314b425fe47dccbe22d4f777ebe, 0xa9a4e5275074da62b39975fcafa054b4, 26, 1, '0', 0),
(2, 54, 0x12139bc83fb398f96266a023b0585c4f, 0x2f8982da84449d1173f9c63cc8b862ed, 0x4a6979b48ecdb128004c511a93e481fd, 0x13f2cf1097cbbbcdecc89676d05bfcf4, 0xb4acaf7ef3b1e695321c6411a10b1ee4, 0xce11d69c97fd9f7bd96d06a5de602864, 26, 2, '0', 0),
(3, 54, 0xbdbbf61aa6a685158f74c6025525f6c2, 0x18aa908fcef018a7fbb8f74fde2657c80b3f989e6a6f8998abe0f7575116add3, 0xea64a58a3f85a4dbdbe376a52384a341, 0x876a370077e959d542fb28e0a2001415, 0x28943d18187331d07a6731b2709c42cd, 0xaee619491f33cae9f5d22b47bf23fc1c, 26, 0, '0', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `user_attribute`
--

CREATE TABLE `user_attribute` (
  `user_id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `inteiro` bigint(13) DEFAULT '0',
  `number` float DEFAULT '0',
  `estampa` timestamp NULL DEFAULT NULL,
  `texto` varbinary(600) DEFAULT NULL,
  `descricao` longtext,
  `date_time` datetime DEFAULT NULL,
  `datetime` datetime DEFAULT NULL,
  `date` date DEFAULT NULL,
  `datefull` datetime DEFAULT NULL,
  `data` date DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `user_company`
--

CREATE TABLE `user_company` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_company` int(11) NOT NULL,
  `tipo` varchar(100) DEFAULT NULL,
  `razao_social` varbinary(155) NOT NULL,
  `nome_fantasia` varbinary(255) NOT NULL,
  `endereco` varbinary(255) NOT NULL,
  `numero` varbinary(255) NOT NULL,
  `bairro` varbinary(255) NOT NULL,
  `cidade` varbinary(255) NOT NULL,
  `estado` varbinary(255) NOT NULL,
  `cep` varbinary(255) NOT NULL,
  `email` varbinary(255) NOT NULL,
  `telefone_1` varbinary(255) NOT NULL,
  `telefone_2` varbinary(255) NOT NULL,
  `cnpj` varbinary(255) NOT NULL,
  `id_ramo_atuacao` int(11) DEFAULT NULL,
  `ramo_atividade` varchar(100) NOT NULL,
  `data_aniversario` date NOT NULL,
  `numero_funcionarios` int(11) NOT NULL,
  `porte_empresa` varchar(20) NOT NULL,
  `valor_empresa` float DEFAULT NULL,
  `site` varbinary(255) DEFAULT NULL,
  `descricao` varbinary(255) DEFAULT NULL,
  `nome` varbinary(255) NOT NULL,
  `cpf` varbinary(255) NOT NULL,
  `rg` varbinary(255) NOT NULL,
  `sexo` varchar(1) NOT NULL,
  `profissao` varchar(100) NOT NULL DEFAULT '',
  `date_creation` datetime DEFAULT NULL,
  `last_update` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `data_retorno` datetime DEFAULT NULL,
  `status` int(2) DEFAULT NULL,
  `origem` int(11) NOT NULL DEFAULT '0',
  `newsletter` int(2) NOT NULL DEFAULT '1',
  `obiz` int(2) NOT NULL DEFAULT '0',
  `alfa` varchar(5) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Faz parte das tabelas user, específicamente agrega valore a ';

-- --------------------------------------------------------

--
-- Estrutura da tabela `user_data`
--

CREATE TABLE `user_data` (
  `id` int(11) NOT NULL,
  `id_ramo_atuacao` int(11) DEFAULT NULL,
  `field1` varbinary(255) NOT NULL,
  `field2` varbinary(255) NOT NULL,
  `email` varbinary(320) NOT NULL,
  `avatar` varbinary(255) NOT NULL,
  `frase` varbinary(600) NOT NULL,
  `keywords` varchar(100) NOT NULL,
  `reputation` int(11) NOT NULL,
  `birthday` varbinary(100) NOT NULL,
  `lance` float NOT NULL,
  `password` varchar(45) NOT NULL COMMENT 'md5(<senha>)',
  `account_states_id` int(11) NOT NULL DEFAULT '0',
  `profile_level` int(11) NOT NULL,
  `type` int(11) NOT NULL COMMENT '0 Pessoa Fisica\n1 Pessoa Juridica',
  `departamento` int(11) DEFAULT NULL,
  `ramo_atuacao` varchar(100) DEFAULT NULL,
  `creation` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Data de Criacao',
  `account_locked` int(11) NOT NULL DEFAULT '0' COMMENT '0 Destravada\n1 Travada',
  `email_hash` varchar(45) NOT NULL COMMENT 'hash do email de confirmacao enviado',
  `receive_news` int(11) DEFAULT NULL COMMENT '0 False\n1 True',
  `concorda` int(2) DEFAULT '1' COMMENT 'Concorda com termos e condiçoes do site',
  `cidade` varbinary(255) NOT NULL DEFAULT '\0',
  `bairro` varbinary(255) NOT NULL DEFAULT '\0',
  `estado` varbinary(100) NOT NULL DEFAULT '\0',
  `extra_1` int(11) NOT NULL DEFAULT '0',
  `extra_2` int(11) NOT NULL DEFAULT '0',
  `extra_3` int(11) NOT NULL DEFAULT '0',
  `extra_4` int(11) NOT NULL DEFAULT '0',
  `concorda_purplepier` int(2) NOT NULL DEFAULT '0',
  `last_update` datetime DEFAULT NULL,
  `n_index` int(2) NOT NULL DEFAULT '0',
  `capa` varchar(100) NOT NULL DEFAULT '0',
  `extra_5` varchar(400) NOT NULL DEFAULT '0',
  `dominio` varchar(200) NOT NULL DEFAULT '0',
  `company` varchar(400) NOT NULL DEFAULT '0',
  `frequencia_cobranca` int(2) NOT NULL DEFAULT '0',
  `emails_extra` varchar(1000) NOT NULL DEFAULT '0',
  `status` int(2) NOT NULL DEFAULT '1',
  `seguidores` int(11) NOT NULL DEFAULT '0',
  `id_pier` int(11) NOT NULL DEFAULT '0',
  `date_extra` date NOT NULL,
  `is_client` int(2) NOT NULL DEFAULT '0',
  `is_resume` int(2) NOT NULL DEFAULT '0',
  `is_student` int(2) NOT NULL DEFAULT '0',
  `is_employee` int(2) NOT NULL DEFAULT '0',
  `is_suplyer` int(2) NOT NULL DEFAULT '0',
  `is_licitante` int(2) NOT NULL DEFAULT '0',
  `documento` varbinary(100) NOT NULL DEFAULT '\0',
  `assinatura` date NOT NULL,
  `name_full` varbinary(255) NOT NULL DEFAULT '\0',
  `descricao` varchar(400) NOT NULL DEFAULT '0',
  `json` varbinary(2000) DEFAULT NULL,
  `reputation_lower` int(11) NOT NULL,
  `reputation_higher` int(11) NOT NULL,
  `reputation_total` int(11) NOT NULL,
  `reputation_count` int(11) NOT NULL,
  `resume` longtext NOT NULL,
  `vencimento` int(2) NOT NULL DEFAULT '0',
  `is_cobrar` int(2) NOT NULL DEFAULT '1',
  `is_nota` int(1) NOT NULL DEFAULT '0',
  `login` datetime NOT NULL,
  `pais` varchar(4) NOT NULL DEFAULT '0',
  `obiz` int(2) NOT NULL DEFAULT '0',
  `alfa` varchar(5) NOT NULL DEFAULT '0',
  `pid` varchar(20) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `user_data`
--

INSERT INTO `user_data` (`id`, `id_ramo_atuacao`, `field1`, `field2`, `email`, `avatar`, `frase`, `keywords`, `reputation`, `birthday`, `lance`, `password`, `account_states_id`, `profile_level`, `type`, `departamento`, `ramo_atuacao`, `creation`, `account_locked`, `email_hash`, `receive_news`, `concorda`, `cidade`, `bairro`, `estado`, `extra_1`, `extra_2`, `extra_3`, `extra_4`, `concorda_purplepier`, `last_update`, `n_index`, `capa`, `extra_5`, `dominio`, `company`, `frequencia_cobranca`, `emails_extra`, `status`, `seguidores`, `id_pier`, `date_extra`, `is_client`, `is_resume`, `is_student`, `is_employee`, `is_suplyer`, `is_licitante`, `documento`, `assinatura`, `name_full`, `descricao`, `json`, `reputation_lower`, `reputation_higher`, `reputation_total`, `reputation_count`, `resume`, `vencimento`, `is_cobrar`, `is_nota`, `login`, `pais`, `obiz`, `alfa`, `pid`) VALUES
(1, 0, 0x04560b461883f27d0d88da7bda50f813, 0x8b2e7731183d57ab3333570a64966584, 0x27375c5b4a94b651a37f5502c26d8e606b92773998154a622ab0f2fadc5d7d15, 0x17d88ebe20db965a37824d2f19f8960f61ac5154ba88de0d9a65590ac484c65fe758d6acb9c42b2d374a46b3a3f2bc18, 0x30, '', 5, 0x7ebe7561057f784fb2cc881c3edfac4f, 0, '76155769a951968312d950729c356edc', 1, 2, 2, 0, '0', '2011-06-30 02:58:55', 4, '95691f7797fc8b094ec86cef011b7d2f', 0, 1, 0xb40f0c6612cfdbb9b7a4718c60fa81a8, 0xf51a1d01a60a7101e17caf2896ff57ef, 0x6a95598cd918d823710e8520bd57c0be, 0, 0, 0, 0, 1, '2021-04-29 17:17:35', 0, '586f90e13f95a_54.png', '0', '', '', 0, '0', 1, 10, 77212, '2017-07-13', 0, 1, 0, 0, 1, 0, 0x439c48d9289be90792ad023665037ace, '2018-01-08', 0x04560b461883f27d0d88da7bda50f813, '', 0x1081f42051491397729a17a12d81ff72677b6b60aa0a7036a3c762248712d8683bdd69f49d39841f9cf6f6e343ac6453e86bc14d0eb631ff79d170f13afbdc5c4c9c4be85563f2e5dd24797d02734726505938b8ad824c5102fc96dbf64b962e3e7ac3082ed1eda892d2ff35331fda109bd761ed81a8b6329d6dc522d2234feae8fa732ea085c5eff3783a91283b16ae91eb7eda8485b345a1d1d8a51ee3278ecce9a419dc7222086c863c741a7e467d4648e438a59f1b93d21b7d5599b4855eadcda2c2365052e70079ea45b6f131a13f604556908cae351cb9ff38e2d8c79abd753a42da269f4ef4250f0374dbe9c20f39b1e378ef9da2a562139df41429712afbe20e99e766f6e9cb6d9f6e399cf4a9d77881a46453d364257ca4a9ae8beb6aa37e13c68c510dbd8a4efefa0c947e, 5, 5, 15, 3, '', 0, 1, 0, '2021-05-19 11:56:10', '0', 1, '0', '0');

-- --------------------------------------------------------

--
-- Estrutura da tabela `user_followers`
--

CREATE TABLE `user_followers` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_follower` varchar(11) NOT NULL,
  `tipo` varchar(50) NOT NULL,
  `data` datetime NOT NULL,
  `status` int(2) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `user_type`
--

CREATE TABLE `user_type` (
  `id` smallint(6) NOT NULL,
  `role` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `activity_2`
--
ALTER TABLE `activity_2`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `activity_count`
--
ALTER TABLE `activity_count`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `activity_log`
--
ALTER TABLE `activity_log`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `activity_milestone`
--
ALTER TABLE `activity_milestone`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `activity_recent`
--
ALTER TABLE `activity_recent`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `activity_server`
--
ALTER TABLE `activity_server`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `banners_attribute`
--
ALTER TABLE `banners_attribute`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user_atrribute_user1` (`id`);

--
-- Índices para tabela `banners_data`
--
ALTER TABLE `banners_data`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `banners_items`
--
ALTER TABLE `banners_items`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `conteudo_categorias`
--
ALTER TABLE `conteudo_categorias`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `conteudo_downloads`
--
ALTER TABLE `conteudo_downloads`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `conteudo_forum`
--
ALTER TABLE `conteudo_forum`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `conteudo_hiperlinks`
--
ALTER TABLE `conteudo_hiperlinks`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `conteudo_images`
--
ALTER TABLE `conteudo_images`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `conteudo_materias`
--
ALTER TABLE `conteudo_materias`
  ADD PRIMARY KEY (`titulo`),
  ADD KEY `id_materia` (`id`);

--
-- Índices para tabela `conteudo_videos`
--
ALTER TABLE `conteudo_videos`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `controle_attribute`
--
ALTER TABLE `controle_attribute`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `controle_chamados`
--
ALTER TABLE `controle_chamados`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `controle_pedidos`
--
ALTER TABLE `controle_pedidos`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `controle_propostas`
--
ALTER TABLE `controle_propostas`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `date_attribute`
--
ALTER TABLE `date_attribute`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `label` (`label`);

--
-- Índices para tabela `date_controller`
--
ALTER TABLE `date_controller`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `date_items`
--
ALTER TABLE `date_items`
  ADD PRIMARY KEY (`id_item`),
  ADD KEY `fk_user_atrribute_user1` (`id`);

--
-- Índices para tabela `ecommerce_caracteristicas`
--
ALTER TABLE `ecommerce_caracteristicas`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `ecommerce_carrinho`
--
ALTER TABLE `ecommerce_carrinho`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `ecommerce_categorias`
--
ALTER TABLE `ecommerce_categorias`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Índices para tabela `ecommerce_estoque`
--
ALTER TABLE `ecommerce_estoque`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `ecommerce_pagamentos`
--
ALTER TABLE `ecommerce_pagamentos`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `ecommerce_participantes`
--
ALTER TABLE `ecommerce_participantes`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `ecommerce_pedidos`
--
ALTER TABLE `ecommerce_pedidos`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `ecommerce_produtos`
--
ALTER TABLE `ecommerce_produtos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_pool_category1` (`id_categoria`),
  ADD KEY `fk_pool_user1` (`id_user`),
  ADD KEY `fk_pool_pool_states1` (`status`);

--
-- Índices para tabela `ecommerce_regions`
--
ALTER TABLE `ecommerce_regions`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `ecommerce_states`
--
ALTER TABLE `ecommerce_states`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `ecommerce_subcategorias`
--
ALTER TABLE `ecommerce_subcategorias`
  ADD PRIMARY KEY (`id_subcategoria`);

--
-- Índices para tabela `ecommerce_subitems`
--
ALTER TABLE `ecommerce_subitems`
  ADD PRIMARY KEY (`id_subitem`);

--
-- Índices para tabela `erp_boletos`
--
ALTER TABLE `erp_boletos`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `erp_categorias`
--
ALTER TABLE `erp_categorias`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `erp_faturas`
--
ALTER TABLE `erp_faturas`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `erp_faturas_items`
--
ALTER TABLE `erp_faturas_items`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `erp_financeiro`
--
ALTER TABLE `erp_financeiro`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `erp_insumos`
--
ALTER TABLE `erp_insumos`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `erp_recorrentes`
--
ALTER TABLE `erp_recorrentes`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `eventos_attribute`
--
ALTER TABLE `eventos_attribute`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `eventos_data`
--
ALTER TABLE `eventos_data`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `general_apontamento`
--
ALTER TABLE `general_apontamento`
  ADD PRIMARY KEY (`id_apontamento`);

--
-- Índices para tabela `general_campanhas`
--
ALTER TABLE `general_campanhas`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `general_city`
--
ALTER TABLE `general_city`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `general_comentarios`
--
ALTER TABLE `general_comentarios`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `general_contador`
--
ALTER TABLE `general_contador`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `general_contador_items`
--
ALTER TABLE `general_contador_items`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `general_contato`
--
ALTER TABLE `general_contato`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `general_faq`
--
ALTER TABLE `general_faq`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `general_galerias`
--
ALTER TABLE `general_galerias`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `general_galerias_subcategorias`
--
ALTER TABLE `general_galerias_subcategorias`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `general_likes`
--
ALTER TABLE `general_likes`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `general_messages`
--
ALTER TABLE `general_messages`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `general_newsletter`
--
ALTER TABLE `general_newsletter`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Índices para tabela `general_newsletter_tracker`
--
ALTER TABLE `general_newsletter_tracker`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `general_ofertas`
--
ALTER TABLE `general_ofertas`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `general_reputation`
--
ALTER TABLE `general_reputation`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `general_shorturl`
--
ALTER TABLE `general_shorturl`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `general_state`
--
ALTER TABLE `general_state`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_states_countries1` (`countries_id`);

--
-- Índices para tabela `inhamer_data`
--
ALTER TABLE `inhamer_data`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `inhamer_messages`
--
ALTER TABLE `inhamer_messages`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `paginas_attribute`
--
ALTER TABLE `paginas_attribute`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `paginas_data`
--
ALTER TABLE `paginas_data`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `paginas_modulos`
--
ALTER TABLE `paginas_modulos`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `paginas_rows`
--
ALTER TABLE `paginas_rows`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `pedidos_attribute`
--
ALTER TABLE `pedidos_attribute`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `pesquisa_data`
--
ALTER TABLE `pesquisa_data`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `pesquisa_info`
--
ALTER TABLE `pesquisa_info`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user_atrribute_user1` (`user_id`);

--
-- Índices para tabela `pesquisa_items`
--
ALTER TABLE `pesquisa_items`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `pesquisa_participantes`
--
ALTER TABLE `pesquisa_participantes`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `pesquisa_perguntas`
--
ALTER TABLE `pesquisa_perguntas`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `pesquisa_tempo`
--
ALTER TABLE `pesquisa_tempo`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `preferencias_attribute`
--
ALTER TABLE `preferencias_attribute`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user_atrribute_user1` (`user_id`);

--
-- Índices para tabela `preferencias_data`
--
ALTER TABLE `preferencias_data`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `promocao_data`
--
ALTER TABLE `promocao_data`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `promocao_parceiros`
--
ALTER TABLE `promocao_parceiros`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `promocao_participantes`
--
ALTER TABLE `promocao_participantes`
  ADD KEY `id` (`id`);

--
-- Índices para tabela `promocao_vouchers`
--
ALTER TABLE `promocao_vouchers`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `redesocial_posts`
--
ALTER TABLE `redesocial_posts`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `sms_data`
--
ALTER TABLE `sms_data`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `templates_attribute`
--
ALTER TABLE `templates_attribute`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `templates_data`
--
ALTER TABLE `templates_data`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `templates_rows`
--
ALTER TABLE `templates_rows`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `user_address`
--
ALTER TABLE `user_address`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user_address_user1` (`user_id`),
  ADD KEY `fk_user_address_state1` (`state_id`),
  ADD KEY `fk_users_address_address_types1` (`address_types_id`);

--
-- Índices para tabela `user_attribute`
--
ALTER TABLE `user_attribute`
  ADD PRIMARY KEY (`user_id`,`name`);

--
-- Índices para tabela `user_company`
--
ALTER TABLE `user_company`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `user_data`
--
ALTER TABLE `user_data`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Índices para tabela `user_followers`
--
ALTER TABLE `user_followers`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `user_type`
--
ALTER TABLE `user_type`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `activity_2`
--
ALTER TABLE `activity_2`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `activity_count`
--
ALTER TABLE `activity_count`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `activity_log`
--
ALTER TABLE `activity_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `activity_milestone`
--
ALTER TABLE `activity_milestone`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT de tabela `activity_recent`
--
ALTER TABLE `activity_recent`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `activity_server`
--
ALTER TABLE `activity_server`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `banners_attribute`
--
ALTER TABLE `banners_attribute`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `banners_data`
--
ALTER TABLE `banners_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `banners_items`
--
ALTER TABLE `banners_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `conteudo_categorias`
--
ALTER TABLE `conteudo_categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `conteudo_downloads`
--
ALTER TABLE `conteudo_downloads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `conteudo_forum`
--
ALTER TABLE `conteudo_forum`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `conteudo_hiperlinks`
--
ALTER TABLE `conteudo_hiperlinks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `conteudo_images`
--
ALTER TABLE `conteudo_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `conteudo_materias`
--
ALTER TABLE `conteudo_materias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `conteudo_videos`
--
ALTER TABLE `conteudo_videos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `controle_attribute`
--
ALTER TABLE `controle_attribute`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `controle_chamados`
--
ALTER TABLE `controle_chamados`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT de tabela `controle_pedidos`
--
ALTER TABLE `controle_pedidos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `controle_propostas`
--
ALTER TABLE `controle_propostas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `date_attribute`
--
ALTER TABLE `date_attribute`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `date_controller`
--
ALTER TABLE `date_controller`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `date_items`
--
ALTER TABLE `date_items`
  MODIFY `id_item` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `ecommerce_caracteristicas`
--
ALTER TABLE `ecommerce_caracteristicas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `ecommerce_carrinho`
--
ALTER TABLE `ecommerce_carrinho`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `ecommerce_categorias`
--
ALTER TABLE `ecommerce_categorias`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `ecommerce_estoque`
--
ALTER TABLE `ecommerce_estoque`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `ecommerce_pagamentos`
--
ALTER TABLE `ecommerce_pagamentos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `ecommerce_participantes`
--
ALTER TABLE `ecommerce_participantes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `ecommerce_pedidos`
--
ALTER TABLE `ecommerce_pedidos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `ecommerce_produtos`
--
ALTER TABLE `ecommerce_produtos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `ecommerce_regions`
--
ALTER TABLE `ecommerce_regions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT de tabela `ecommerce_states`
--
ALTER TABLE `ecommerce_states`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `ecommerce_subcategorias`
--
ALTER TABLE `ecommerce_subcategorias`
  MODIFY `id_subcategoria` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `ecommerce_subitems`
--
ALTER TABLE `ecommerce_subitems`
  MODIFY `id_subitem` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `erp_boletos`
--
ALTER TABLE `erp_boletos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `erp_categorias`
--
ALTER TABLE `erp_categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT de tabela `erp_faturas`
--
ALTER TABLE `erp_faturas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `erp_faturas_items`
--
ALTER TABLE `erp_faturas_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `erp_financeiro`
--
ALTER TABLE `erp_financeiro`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `erp_insumos`
--
ALTER TABLE `erp_insumos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de tabela `erp_recorrentes`
--
ALTER TABLE `erp_recorrentes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `eventos_attribute`
--
ALTER TABLE `eventos_attribute`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `eventos_data`
--
ALTER TABLE `eventos_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `general_apontamento`
--
ALTER TABLE `general_apontamento`
  MODIFY `id_apontamento` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `general_campanhas`
--
ALTER TABLE `general_campanhas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `general_city`
--
ALTER TABLE `general_city`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `general_comentarios`
--
ALTER TABLE `general_comentarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `general_contador`
--
ALTER TABLE `general_contador`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `general_contador_items`
--
ALTER TABLE `general_contador_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de tabela `general_contato`
--
ALTER TABLE `general_contato`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `general_faq`
--
ALTER TABLE `general_faq`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `general_galerias`
--
ALTER TABLE `general_galerias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `general_galerias_subcategorias`
--
ALTER TABLE `general_galerias_subcategorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `general_likes`
--
ALTER TABLE `general_likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `general_messages`
--
ALTER TABLE `general_messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT de tabela `general_newsletter`
--
ALTER TABLE `general_newsletter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `general_newsletter_tracker`
--
ALTER TABLE `general_newsletter_tracker`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `general_ofertas`
--
ALTER TABLE `general_ofertas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `general_reputation`
--
ALTER TABLE `general_reputation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `general_shorturl`
--
ALTER TABLE `general_shorturl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `general_state`
--
ALTER TABLE `general_state`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de tabela `inhamer_data`
--
ALTER TABLE `inhamer_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `inhamer_messages`
--
ALTER TABLE `inhamer_messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `paginas_attribute`
--
ALTER TABLE `paginas_attribute`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5642;

--
-- AUTO_INCREMENT de tabela `paginas_data`
--
ALTER TABLE `paginas_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=279;

--
-- AUTO_INCREMENT de tabela `paginas_modulos`
--
ALTER TABLE `paginas_modulos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `paginas_rows`
--
ALTER TABLE `paginas_rows`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `pedidos_attribute`
--
ALTER TABLE `pedidos_attribute`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=426;

--
-- AUTO_INCREMENT de tabela `pesquisa_data`
--
ALTER TABLE `pesquisa_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `pesquisa_info`
--
ALTER TABLE `pesquisa_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `pesquisa_items`
--
ALTER TABLE `pesquisa_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `pesquisa_participantes`
--
ALTER TABLE `pesquisa_participantes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `pesquisa_perguntas`
--
ALTER TABLE `pesquisa_perguntas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `pesquisa_tempo`
--
ALTER TABLE `pesquisa_tempo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `preferencias_attribute`
--
ALTER TABLE `preferencias_attribute`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=339;

--
-- AUTO_INCREMENT de tabela `preferencias_data`
--
ALTER TABLE `preferencias_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `promocao_data`
--
ALTER TABLE `promocao_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `promocao_parceiros`
--
ALTER TABLE `promocao_parceiros`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `promocao_participantes`
--
ALTER TABLE `promocao_participantes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `promocao_vouchers`
--
ALTER TABLE `promocao_vouchers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `redesocial_posts`
--
ALTER TABLE `redesocial_posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `sms_data`
--
ALTER TABLE `sms_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `templates_attribute`
--
ALTER TABLE `templates_attribute`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `templates_data`
--
ALTER TABLE `templates_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `templates_rows`
--
ALTER TABLE `templates_rows`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `user_address`
--
ALTER TABLE `user_address`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `user_company`
--
ALTER TABLE `user_company`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `user_data`
--
ALTER TABLE `user_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `user_followers`
--
ALTER TABLE `user_followers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `user_type`
--
ALTER TABLE `user_type`
  MODIFY `id` smallint(6) NOT NULL AUTO_INCREMENT;
