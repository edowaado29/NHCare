-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 30, 2023 at 04:16 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_nhcare`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_acara`
--

CREATE TABLE `tb_acara` (
  `id_acara` int(11) NOT NULL,
  `judul` varchar(64) NOT NULL,
  `deskripsi` text NOT NULL,
  `tanggal_acara` datetime NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_anakasuh`
--

CREATE TABLE `tb_anakasuh` (
  `id_anakasuh` varchar(20) NOT NULL,
  `nik_anak` char(16) NOT NULL,
  `nama` varchar(64) NOT NULL,
  `jenis_kelamin` varchar(10) NOT NULL,
  `tempat_lahir` varchar(64) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `alamat` varchar(128) NOT NULL,
  `keterangan` varchar(64) NOT NULL,
  `asrama` varchar(64) NOT NULL,
  `no_akta` varchar(32) NOT NULL,
  `img_akta` blob NOT NULL,
  `no_kk` char(16) NOT NULL,
  `img_kk` blob NOT NULL,
  `no_skko` varchar(32) NOT NULL,
  `img_skko` blob NOT NULL,
  `status` varchar(16) NOT NULL,
  `img_anak` blob NOT NULL,
  `nama_sekolah` varchar(32) NOT NULL,
  `tingkat` varchar(32) NOT NULL,
  `kelas` varchar(32) NOT NULL,
  `cabang` varchar(32) NOT NULL,
  `deskripsi` text NOT NULL,
  `nama_ayah` varchar(64) NOT NULL,
  `nik_ayah` char(16) NOT NULL,
  `nama_ibu` varchar(64) NOT NULL,
  `nik_ibu` char(16) NOT NULL,
  `nama_wali` varchar(64) NOT NULL,
  `nik_wali` char(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_donasi`
--

CREATE TABLE `tb_donasi` (
  `transaction_id` varchar(50) NOT NULL,
  `gross_amount` double NOT NULL,
  `order_id` varchar(15) NOT NULL,
  `settlement_time` datetime NOT NULL,
  `id_donatur` varchar(20) NOT NULL,
  `nama_donatur` varchar(60) NOT NULL,
  `keterangan` varchar(20) NOT NULL,
  `doa` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_donatur`
--

CREATE TABLE `tb_donatur` (
  `id_donatur` varchar(20) NOT NULL,
  `nama` varchar(64) NOT NULL,
  `email` varchar(64) NOT NULL,
  `password` varchar(64) NOT NULL,
  `no_hp` varchar(13) NOT NULL,
  `alamat` varchar(128) NOT NULL,
  `jenis_kelamin` varchar(12) NOT NULL,
  `img_profil` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_faq`
--

CREATE TABLE `tb_faq` (
  `id_faq` int(11) NOT NULL,
  `pertanyaan` varchar(64) NOT NULL,
  `jawaban` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_jabatan_pegawai`
--

CREATE TABLE `tb_jabatan_pegawai` (
  `id_jabatan` int(11) NOT NULL,
  `nama_jabatan` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_jabatan_pegawai`
--

INSERT INTO `tb_jabatan_pegawai` (`id_jabatan`, `nama_jabatan`) VALUES
(6, 'Admin');

-- --------------------------------------------------------

--
-- Table structure for table `tb_pegawai`
--

CREATE TABLE `tb_pegawai` (
  `id_pegawai` varchar(20) NOT NULL,
  `nbm` varchar(16) NOT NULL,
  `nama` varchar(64) NOT NULL,
  `jenis_kelamin` varchar(12) NOT NULL,
  `tempat_lahir` varchar(64) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `pendidikan_terakhir` varchar(8) NOT NULL,
  `status_kepegawaian` varchar(64) NOT NULL,
  `alamat` varchar(128) NOT NULL,
  `no_hp` varchar(13) NOT NULL,
  `email` varchar(64) NOT NULL,
  `tanggal_masuk` date NOT NULL,
  `tanggal_keluar` date NOT NULL,
  `img_kk` blob NOT NULL,
  `img_ktp` blob NOT NULL,
  `status` varchar(16) NOT NULL,
  `img_pegawai` blob NOT NULL,
  `id_jabatan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_program`
--

CREATE TABLE `tb_program` (
  `id_program` int(11) NOT NULL,
  `judul` varchar(64) NOT NULL,
  `deskripsi` text NOT NULL,
  `img_program` blob NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `id_user` int(11) NOT NULL,
  `nama` varchar(64) NOT NULL,
  `email` varchar(64) NOT NULL,
  `password` varchar(64) NOT NULL,
  `no_hp` varchar(13) NOT NULL,
  `img_profile` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`id_user`, `nama`, `email`, `password`, `no_hp`, `img_profile`) VALUES
(1, 'NHCare', 'nhcoree@gmail.com', 'asdasdasd', '082234514937', 0xffd8ffe000104a46494600010100000100010000ffdb00840009060712121215121212151515151517151515171717151517151517171715171515181d2820181d251d151521312125292b2e2e2e171f3338332d37282d2e2b010a0a0a0e0d0e170f10152d1d151d2d2d2d2d2d2d2d2d2d2d2d2d2d2d2d2d2d2d2d2d2d2d2d2d2d2d2d2d2d2d2d2d2d2d2d2d2d2d2d2d2d2d2d2d2d2d2d2d372dffc000110800e100e103012200021101031101ffc4001b00000105010100000000000000000000000100020304050607ffc400381000020102040306040308030100000000000102031104052131124151061322617191143281a12362b1071533425272c1f063d1f124ffc400190100030101010000000000000000000000000102030405ffc4002111010100020202030101010000000000000001021103122131134151223204ffda000c03010002110311003f00d9fde50feb8fba1df1b1fea5ee71f4e9dddbcd1af569ae2678b94923d3e8d958b4f67ec3fe2bd4cccbe1afd4d19c0cf52a329a3962474b14889407700f5092ac5798962c8bbb17761a8127c5096246280ee01ea16ea4f8a07c50cee831a62d41b3be246fc58bbb0f763eb06e93c48962bd42a98bbb0eb06e9bdffa8be27d42a03fbb1758368fe23c98df89d7664ca987ba0eb06d03c47a8bbff52654c77763eb06eabfc4fa85d6f264ea98ee11782dd547887d1fb01d77d1fb173bb0aa63d43da92aefa314ab3e8fd8bca98bbb0f03754bbe7d1fb08d0ee9087b89dd705865e2f6362afcccc7c3bf1a352adef2f50cfd3b2fb5cc02f11a3233b2f5e2fa2345911966686c1414524121d61d42939be18abb26ad839c37561eafb45aae9058074490514384c480cd1f64015c6343c22b04480838475809858685868eb0241680c905a1445611524161482d0036c2b0f881b1e8121c041b881c206be410f05b79ee163f8b05d5a36386d292f37fa99197eb5a1ea6a62d5a727f98bcfd3ad7305f31a1233b02fc4683338cb2f622b8105022aee553e19c5f9ea754e1192b35738da13b3b9d3e598ae34ba9d9c194d6ab0e497dab66196412bad0c2a90e1763b59c535666266396b4db8eab7f41f3717dc1c7c8c5112c70d64dc9dadc8854d72d8e4b34da6e8a08d4c5716c1c98465c72900d08502c100120b62131c03108d41b88a9e82307819a8724041b94058db84221a1b845a7fb710cb4f3eca1fe341fe635310ef525eaccac9d7e2c3d4d693bce5eac7c9e9d3f6b182f98d2666e09ebec693338cf3f60142684081b96b078d7069950499ae196aa6cdbafc3636328a7732b3eed02a49c62f5b19d86c438dd727b9cef6a78ae9fb79a3a72cedc53871cec5fbe273959bdc9e58ee1491894a94b8535ff0080ef249eaf9a39329baec924746f19e15aee40f1126fe6d0c9a55db7af425ef3855edabd88d68b536d594df527a5376dcc69d676d77ff25aa75ad103b8c6b52afb1656bb18d4b156db51af379c5e8d2f5299dc1bee93e836c62e1f36a937f36cae474f195a726a376ba8e63b475fd6e3762e65f87e392be8b999997e06736b89b7fa23a8a34d423636e3e2fd659555cd28462970ab19a8d5c7bbc527ea6411cd35461450e4002216709004841208421879f649ad58fab34d4bc52f36ff005337267f8cbcaefec68437fab0e4f4e85dc0fcc685ccdc07cccd16462cf3be450989b045dc693832836b400f53b58bc215acb9d59c2450ceb19c70e0b6bf73731767ad91ce66da3d0ab955e325332eaf64d3e5fe48269b9b51577cbfc952b57e05a3dcbf954fc0e5fcef664eafb6db59c250507e369b6ed61f521294ae97862afee65d3ad295551dda7fa9dbe0b037c3bbad6ecbc30db3cf3eae6f2fa327c4df37a731f5e2e1a32697142aa515a6b72be6be24ecf54ccf29aaac6ec954e18df9bb99b89c5712f42dceed474e5a956a538bfa7dc78e9561986cc382fcdbb2476f9150e38c6cad74aece3b24caa55eaf1356845ee7a6e028aa71492d91be3239f92e96a8d250565b8d72bf3248d44f9875bddc4de787328e3a5f6338bd8da9bf86de6ca099c9cb7cb4c0e030a158c97407c465c7418a1c49ee2104ad969e7d92afc5ff007a17e0b57ea53c83f8baff004bfd0b7196b6ead8f91d2bd80dd97ca3815b97999c6591063a0d0dca4ece4194465c996a8db0c7c33b556b3d3ec62e329b96b6d8dac53b68470c2717ebea171698e5a71f89c236f6bb6fd8e8b21c9e4e95dc75e4bcde868c3276e49db9ebe475d96e194209595d1a638279397f1cf651d99eee129cd5ea4b4fed5e46e51c3a8c144d2922a631f0abfa9af591cf73b6b93c6e1382a4f9f13ba3966e53acd2d933abc4b954e2d7c5fa1532ec028293b5e52765ff00672f23b78eea2863229248a35b0527a7b237a7844f7dd16f0f825f539edad664192c3862b4d6c6cc3137d0828e1ac4d1c34a5b2b5cdf8b6e6e4b3ed2d1c5c6f68eaf635a9464d36f4d0ab96e5d185baf366ba8d96c76e31cf9e53e9cfe3afadccd4cbf9bcbc56338e0e4bfd35c0e424212666b10a1b70dca349708c08c9c1e44fc77fcacb317adcab913f1bf28c8b301f2366a65dccbad9472ee65d891233cd9999e754a85f89b6d2d52ff002ce4731edb557754a2a2baeeec33b5353ffa250fab31249f43bf8b8b1d6ec72679ddf87a36458a94e11949ead2b9bf464ac794e0b3cad49ad9a5cb63a5cbfb634dab4ef17eebdcab81ccdd3d78f148d2a11f0af231b0399539ea9a77e8cd8a5593488b8e95db6d3c2c743468cec8cfc34d58b1c7e11a2cdadc1ea3719478a2369cb424e2ba657b4fdb9aa3826b89f36f6f243285269b6faec6e386a51c7c2daae6639e0df1cf6a7f0dab7d7626842c0a13e2b2f32ff74ac6178edf51af790cc3c8d1a3033e9d27746ae174b1b7161630e4cb69e92b135f420c5558c62e4dd9224c0568d4a6a4b54d1d9239ed73199b7c6fd4aa99d2e6795a95dc5599ce56a2e0eccf3f9b8ee36d74f1e72cd1a828084632b510a0242199e20fd043270992fcd3f28bfb96a256c8fe69ff006b2c44ae46d1a5966ccba52cb568cb8999c465edc176bf0fc38952e528fdcc4923b8ed8e5aead2e38fcd0d57a1c2a775d1f4f33d1e2cb78c71e78eaa29909254e644d9bc454b86c4ce0ef0934ce932eed8ce365357b735a1cadc0c7a953b7ac65ddaea724bc493e8cd07da1868f897b9e350849ed71cd4d68db33bc50fe4af5fc6f6d68c379afa6accaaff00b4d8a56a7093f37a1e6ad11f1b2b1e39076dbb8aff00b47c43f921049f5bb650c476cf1935ac927e48e514f5248d465f5943a2a5da7c5ad7bcfb1768f6c318b79a7f43945518e55da26e327d0bb76d4bb7b5e3f324fe875fd97cf7118a5750518afe66ac9fa1e45807c752317b3924cf6dc9671a74d46292492b11750e4b5b1572e5563c329cadceda234b2fc346941538bd119f86c5df52fd3ac984ca26e2b4cc9cf30e9c6f6d4d58c8ad9853e28343ce76c68c6eab8f00fab1b3686a3cab355db2f80b8e486a0828ff00f77102e843270f926f51fe526a322b64eff89fda4d48bcdb46c65cb49168ad80d9964ca7a465ec9ed67b1c2f69b239424ead3578bdd2e4772d87babab3574f7f335e2cee358e78ede3f264133bfcefb20a4dca8e8fa1c9e3322af07ac19e8e194ae7ca56571124137627865b55bfe1bf63abecf766250b55aab5fe58bfd595739214c6d5becbf679f0f1cd6afa8eed3766ed17384755ae8769808ab22f4e82945a7ccc3bddeda5c3c69e075159dbe80e0b9d8f6afb33284a53847c3abd0e4541add1be376cbd227484a04a148bd8dc46a209225921d4e9b93b462e4df242b41f96623bba919b49d99ead80c7714636d9ab9c2e53d90ad57c553c11fb9dd659858d182a6aed4568d9cdc9635e38d9a188e15e76357015ed6d7d4e6abd469a7cb997f0588bb5632eda5e51d8519dd12357465e1313cae69537a23ab1bb8e6ca69839c606cf8923151d963e971459c8d783526ba1c5ff00461abe1d1c396e23b85802736db88875c41b0e13285e1a9fda89e9b2b653f2547e5625a6f637cda46ce5fb32d15f00bc2cb0611390245b8408294752fc63a1b613c32a85a4314137668964ac31dcd77a1ada4861217bf0a062b0b75a72d810af6dcb54ea26b4612a278ac4a58c941f0bfb9a397e3a753e55757df64439ae1232b7ea696574a318a48b8d32ca58b33c329ab496fb9cbe6dd8aa551b70f0bfb1d826392b972e9cd66de5788fd9fd4be93d3d86d3fd9f56e73d0f589532b554877929cc6380c1f6069afe2cdcbd0e932fc92850f929abf57ab357841c065792d54c62170453ad4ac694a043561d48548a54a375663a9cb839106327c3b6fe435d5b59b1346fe5989527d19d1519e88e4b2d9c774ce8f0d55686fc55cdc91a1ba39bcdf0d66ddb99d1d396852cde9271b97cb8f6c51865aae4ae06c7d6d1d869e659a76c3ae219c4105389ca9782a7d07c2c43943f055f543a86e6d9348dfcbfe42c732b65ff0021730f1bb33c59e553e1e9f32da4320b427844de20ce0192813b8814468aa356911c1f0f234fbb23952b882b4529f327c3de232585153c3496cc72868c2b12aae8cff8797525841ec5cc91a5ca9897b22250e7717737428506ba8aec691f1c53dee0956fcac99619741ce8a168f6ab29c9eda1055849f32fb890d510db22bd157f32595156d47ca179fa165c01a4f4a7868f0bf236f0359f528c289730b4ecd0f1ba6793a1c34ee86e3e1c51760e1e3644957e57e875cff2e6fb7178a5e264122de3978994ee7959cf35dd8fa3c42110a733c4926924973d3723524b9222a9321750dd6bb1c43d9336f2aa6ed77cce7b034dce692fa9d752a7a2b688a91156211f327822184113459b6b4c6d09c6c048b095c6ca3a86895e4ec3a0c7cc8a534b76912af69a2ae392ea434eb45bb264aacb56f61e92925c295d90e1a9bbb6c745c66ecb958b318d9be88345b04edbe818544f6154871475191828ab22827882488155b0f53b8b40268ab5892b54b15e33e29d8930a34f9f5248409386c18211ef434a96a5ba14ecc6d345ba08bc7146557a83d0924b46434c9f91d53d31bfae671b08f13d0afdd47a163327c33653550e0ce7f4eac2f84bdcc7a7dc447defa083ac53cf2731b1bb674cfb25ff002fd8970fd968a77752ff00414b34d6d419060ac9c9f3d8e8e952161f06a36b722751639948caec15921eb865e628cb4192a6af75a17de23ad2eeba3b10d7af2868d5cb3119528a96e1f241d68ef1bae867d5a57776f52faa7656444b08b76db0f921eab3a7525192518dcbd42b29de36db72c2c320d2c3a8bba17782ca9a9c5475ea19d6493239c5be62846dabd5a1f7c53d2a4727c3d0af4632726dbf0f25cc92ac78b9830f4781bd5ea2ef0fad3e74972428f424722054b5bdc3e4c475a188822be1e094d17ad718a293bd85df1fd3eb467123a71b325925b8921768571a969a2d512a46687aaf6349c98fea32c6d69c09e265471ad72439664fa2369cd8feb3bc7928e7f4ed2bf5315d4d0dec7cd55b5f4287eed83fe6672e765be1be12c9e59b7f311a3fba61fd52113e5a6d2582817d0319187669a3c57236c78761a240e20261b6a1d868f62889822c5d8b43161686c770dc3b1e8eb82e2020ee5d44371a83242ec344848024299090e616c6098fb1e86e0b886a176d8d1f715c0c2d8fb0d0053197020d97549710d0dc7321d4930a646d810f67a5ab08878c43d9691b040423350b247c84202a68e6210e7b338084215010131080a9442c420327b8a42104070d8ee21125082842182635084107d0b1ac420a62c0210104798fe421150cc605c8421c070842292fffd9);

-- --------------------------------------------------------

--
-- Table structure for table `tb_video`
--

CREATE TABLE `tb_video` (
  `id_video` int(11) NOT NULL,
  `judul_video` varchar(128) NOT NULL,
  `url_video` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_website`
--

CREATE TABLE `tb_website` (
  `id_website` int(11) NOT NULL,
  `judul_website` varchar(128) NOT NULL,
  `url_website` varchar(128) NOT NULL,
  `img_website` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_acara`
--
ALTER TABLE `tb_acara`
  ADD PRIMARY KEY (`id_acara`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `tb_anakasuh`
--
ALTER TABLE `tb_anakasuh`
  ADD PRIMARY KEY (`id_anakasuh`);

--
-- Indexes for table `tb_donasi`
--
ALTER TABLE `tb_donasi`
  ADD PRIMARY KEY (`transaction_id`),
  ADD KEY `id_donatur` (`id_donatur`);

--
-- Indexes for table `tb_donatur`
--
ALTER TABLE `tb_donatur`
  ADD PRIMARY KEY (`id_donatur`);

--
-- Indexes for table `tb_faq`
--
ALTER TABLE `tb_faq`
  ADD PRIMARY KEY (`id_faq`);

--
-- Indexes for table `tb_jabatan_pegawai`
--
ALTER TABLE `tb_jabatan_pegawai`
  ADD PRIMARY KEY (`id_jabatan`);

--
-- Indexes for table `tb_pegawai`
--
ALTER TABLE `tb_pegawai`
  ADD PRIMARY KEY (`id_pegawai`),
  ADD KEY `id_jabatan` (`id_jabatan`);

--
-- Indexes for table `tb_program`
--
ALTER TABLE `tb_program`
  ADD PRIMARY KEY (`id_program`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id_user`);

--
-- Indexes for table `tb_video`
--
ALTER TABLE `tb_video`
  ADD PRIMARY KEY (`id_video`);

--
-- Indexes for table `tb_website`
--
ALTER TABLE `tb_website`
  ADD PRIMARY KEY (`id_website`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_acara`
--
ALTER TABLE `tb_acara`
  MODIFY `id_acara` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tb_faq`
--
ALTER TABLE `tb_faq`
  MODIFY `id_faq` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tb_jabatan_pegawai`
--
ALTER TABLE `tb_jabatan_pegawai`
  MODIFY `id_jabatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tb_program`
--
ALTER TABLE `tb_program`
  MODIFY `id_program` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `tb_video`
--
ALTER TABLE `tb_video`
  MODIFY `id_video` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tb_website`
--
ALTER TABLE `tb_website`
  MODIFY `id_website` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_acara`
--
ALTER TABLE `tb_acara`
  ADD CONSTRAINT `user_acara_c1` FOREIGN KEY (`id_user`) REFERENCES `tb_user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_donasi`
--
ALTER TABLE `tb_donasi`
  ADD CONSTRAINT `donatur_donasi_c1` FOREIGN KEY (`id_donatur`) REFERENCES `tb_donatur` (`id_donatur`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_pegawai`
--
ALTER TABLE `tb_pegawai`
  ADD CONSTRAINT `jabatan_pegawai_c1` FOREIGN KEY (`id_jabatan`) REFERENCES `tb_jabatan_pegawai` (`id_jabatan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_program`
--
ALTER TABLE `tb_program`
  ADD CONSTRAINT `user_program_c1` FOREIGN KEY (`id_user`) REFERENCES `tb_user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
