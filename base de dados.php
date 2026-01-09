-- --------------------------------------------------------
-- Base de Dados: `religioes_mundo_db`
-- Criada para a aplicação Atlas Cultural
-- --------------------------------------------------------

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Criação da Base de Dados
--
CREATE DATABASE IF NOT EXISTS `religioes_mundo_db` 
DEFAULT CHARACTER SET utf8mb4 
COLLATE utf8mb4_unicode_ci;

USE `religioes_mundo_db`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `religions`
--
CREATE TABLE `religions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `icon` varchar(50) NOT NULL COMMENT 'Armazena emojis ou códigos de ícones',
  `followers` varchar(50) NOT NULL,
  `people_img_url` varchar(500) NOT NULL,
  `food_img_url` varchar(500) NOT NULL,
  `description` text NOT NULL COMMENT 'Descrição curta para o card',
  `details` text NOT NULL COMMENT 'Texto longo para o off-canvas',
  `origin` varchar(100) NOT NULL,
  `holy_book` varchar(100) NOT NULL,
  `philosophy` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `religion_tags`
-- (Tabela secundária para relação One-to-Many)
--
CREATE TABLE `religion_tags` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `religion_id` int(11) NOT NULL,
  `tag_name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `religion_id` (`religion_id`),
  CONSTRAINT `fk_religion` FOREIGN KEY (`religion_id`) REFERENCES `religions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Inserindo dados na tabela `religions`
--

INSERT INTO `religions` (`id`, `name`, `icon`, `followers`, `people_img_url`, `food_img_url`, `description`, `details`, `origin`, `holy_book`, `philosophy`) VALUES
(1, 'Cristianismo', '✝️', '~2.4 Bilhões', 'https://images.unsplash.com/photo-1438032005730-c779502df39b?w=1200&q=80', 'https://images.unsplash.com/photo-1509440159596-0249088772ff?w=800&q=80', 'Centrado na figura de Jesus Cristo, enfatiza o amor, a redenção e a vida eterna através da comunhão sagrada.', 'O Cristianismo é a maior religião do mundo, com uma vasta diversidade de denominações, desde o Catolicismo Romano às igrejas Ortodoxas e Protestantes. A sua arte e arquitectura definiram a estética ocidental por milénios.', 'Judeia (Médio Oriente)', 'Bíblia Sagrada', 'Monoteísmo, Trindade, Salvação'),

(2, 'Islamismo', '☪️', '~1.9 Bilhões', 'https://images.unsplash.com/photo-1544005313-94ddf0286df2?w=1200&q=80', 'https://images.unsplash.com/photo-1529006557810-274b9b2fc783?w=800&q=80', 'Baseado na submissão à vontade de Allah e nos ensinamentos do Profeta Muhammad descritos no Alcorão.', 'Estruturado sobre os cinco pilares (Fé, Oração, Caridade, Jejum e Peregrinação), o Islão promove uma vida de disciplina espiritual e justiça social profunda.', 'Meca (Arábia Saudita)', 'Alcorão Sagrado', 'Tawhid (Unicidade), Submissão'),

(3, 'Hinduísmo', '🕉️', '~1.2 Bilhões', 'https://images.unsplash.com/photo-1524504388940-b1c1722653e1?w=1200&q=80', 'https://images.unsplash.com/photo-1546833998-877b37c2e5c6?w=800&q=80', 'Uma síntese complexa de caminhos espirituais que busca a libertação do ciclo de reencarnação através do Dharma.', 'Considerada por muitos como a religião viva mais antiga, o Hinduísmo não possui um fundador único, funcionando como uma filosofia vasta que abrange milhões de divindades sob uma realidade suprema (Brahman).', 'Vale do Indo (Índia)', 'Vedas & Upanishads', 'Dharma, Karma, Moksha'),

(4, 'Budismo', '☸️', '~520 Milhões', 'https://images.unsplash.com/photo-1494790108377-be9c29b29330?w=1200&q=80', 'https://images.unsplash.com/photo-1512058564366-18510be2db19?w=800&q=80', 'Um caminho de autotransformação focado na superação do sofrimento e no alcance do Nirvana através da consciência plena.', 'Fundado por Siddhartha Gautama, o Buda, este ensinamento propõe as Quatro Nobres Verdades e o Caminho Óctuplo como guias para a iluminação espiritual sem a necessidade de um deus criador.', 'Nepal / Índia', 'Tripitaka', 'Não-eu, Impermanência'),

(5, 'Judaísmo', '✡️', '~15 Milhões', 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=1200&q=80', 'https://images.unsplash.com/photo-1555939594-58d7cb561ad1?w=800&q=80', 'A mais antiga das religiões abraâmicas, focada na Aliança entre Deus e o povo através da lei e da tradição.', 'Mais do que uma fé, o Judaísmo é uma identidade cultural e ética robusta, onde o estudo da Torá e a prática da justiça (Tzedakah) são os alicerces da vida quotidiana.', 'Canaã (Médio Oriente)', 'Torá (Tanakh)', 'Ética, Aliança, Tikkun Olam'),

(6, 'Sikhismo', '☬', '~30 Milhões', 'https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?w=1200&q=80', 'https://images.unsplash.com/photo-1588166524941-3bf61a9c41db?w=800&q=80', 'Enfatiza a igualdade de toda a humanidade, o serviço altruísta e a devoção a um único Deus sem forma.', 'Os Sikhs são conhecidos pelo seu compromisso inabalável com a justiça social. Os seus templos (Gurdwaras) são famosos por servirem refeições gratuitas a todos, independentemente da casta ou religião.', 'Punjab (Índia/Paquistão)', 'Guru Granth Sahib', 'Igualdade Radical, Serviço');

-- --------------------------------------------------------

--
-- Inserindo dados na tabela `religion_tags`
--

INSERT INTO `religion_tags` (`religion_id`, `tag_name`) VALUES
-- Cristianismo (ID 1)
(1, 'Catolicismo'),
(1, 'Ortodoxia'),
(1, 'Protestantismo'),

-- Islamismo (ID 2)
(2, 'Sunitas'),
(2, 'Xiitas'),
(2, 'Sufismo'),

-- Hinduísmo (ID 3)
(3, 'Karma'),
(3, 'Yoga'),
(3, 'Vedanta'),

-- Budismo (ID 4)
(4, 'Zen'),
(4, 'Theravada'),
(4, 'Mahayana'),

-- Judaísmo (ID 5)
(5, 'Ortodoxo'),
(5, 'Reformista'),
(5, 'Conservador'),

-- Sikhismo (ID 6)
(6, 'Kirpan'),
(6, 'Kaur'),
(6, 'Singh');

COMMIT;         
-- --------------------------------------------------------