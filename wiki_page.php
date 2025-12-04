<?php
// wiki_page.php
require_once 'verifica_sessao.php';
require_once 'markdown.php';
verificaLogin();
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wiki de Jogo - Honkai Star Rail</title>
    
    <!-- Inclui o Tailwind CSS via CDN (Necessário para a maioria das classes de layout e cores) -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Link para os estilos customizados da wiki -->
    <link rel="stylesheet" href="css/wiki_style.css">

    <!-- Link para estilos gerais da aplicação (para consistência, usado para os botões de nav) -->
    <link rel="stylesheet" href="css/style.css"> 
</head>
<body class="p-4 sm:p-8 bg-[#0d1117] text-[#c9d1d9]">

    <!-- Link de navegação rápida de volta ao Dashboard e Logout -->
    <div class="max-w-7xl mx-auto mb-4 flex justify-between items-center">
        <a href="dashboard.php" class="btn-nav-return">← Voltar ao Dashboard</a>
        <a href="logout.php" class="btn-logout">Sair</a>
    </div>

    <!-- Container Principal do Conteúdo -->
    <div class="max-w-7xl mx-auto bg-[#161b22] shadow-2xl rounded-xl overflow-hidden">
        
        <!-- Cabeçalho do Jogo (Banner/Título) -->
        <header class="relative h-60 md:h-80 bg-cover bg-center" 
                style="background-image: url('img/banner.jpg');">
            <div class="absolute inset-0 bg-black bg-opacity-60 flex items-end p-6">
                <div class="flex flex-col md:flex-row items-start md:items-center w-full">
                    <!-- Icone/Logo do Jogo -->
                    <img src="img/logo.jpg" alt="Logo Honkai Star Rail" 
                         class="w-24 h-24 md:w-32 md:h-32 rounded-lg shadow-xl border-4 border-gray-700 -mb-12 md:-mb-16 md:mr-6 object-cover bg-gray-900" 
                    />
                    <!-- Título e Meta Dados -->
                    <div class="mt-4 md:mt-0 md:ml-24 pt-4 md:pt-0">
                        <h1 class="text-4xl md:text-5xl font-extrabold text-white leading-tight">Honkai: Star Rail</h1>
                        <p class="text-yellow-400 text-lg">RPG de Turnos Estratégico • Desenvolvedora HoYoverse</p>
                    </div>
                </div>
            </div>
        </header>

        <!-- Corpo da Página (Abaixo do Icone/Logo) -->
        <main class="p-4 sm:p-8 mt-12 md:mt-16">
            
            <!-- Barra de Navegação de Abas -->
            <nav class="border-b border-gray-700 mb-6">
                <div class="flex space-x-4 overflow-x-auto">
                    <!-- Botões das Abas -->
                    <button id="tab-news-btn" class="tab-btn active" data-tab="news">Novidades</button>
                    <button id="tab-characters-btn" class="tab-btn" data-tab="characters">Personagens</button>
                    <button id="tab-comments-btn" class="tab-btn" data-tab="comments">Comentários</button>
                </div>
            </nav>

            <!-- Conteúdo da Aba 1: NOVIDADES (Informações Gerais) -->
            <div id="tab-news" class="tab-content block">
                <section class="mb-8">
                    <h2 class="text-3xl font-bold mb-4 text-yellow-500">Sinopse e Expansão</h2>
                    <p class="text-gray-400 leading-relaxed mb-4">
                        <?php $sinopse = 'Você assume o papel do **Desbravador**, um ser infundido com um Stellaron, a bordo do Astral Express, uma locomotiva estelar que viaja entre planetas para desvendar os mistérios dos Aeons. Atualmente, a jornada principal concentra-se na busca por novos mundos e na resolução de conflitos interestelares.';
                        echo processaMarkdownSimples($sinopse);
                        ?>
                        
                    </p>
                    <p class="text-gray-400 italic">
                        Lançamento Global: 26 de Abril de 2023 | Gênero: RPG de Turnos, Fantasia Espacial.
                    </p>
                </section>
                
                <!-- Novidades Recentes -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <div class="lg:col-span-2">
                        <h2 class="text-3xl font-bold mb-4 text-yellow-500">Destaques da Última Atualização (v3.6/3.7)</h2>
                        <ul class="list-disc list-inside space-y-3 text-gray-400 ml-4">
                            <?php   
                            $novidades ='
                            <li>**Continuidade no desbravamento: De volta à terra da noite eterna** </li>
                            <li>**Novo modo de jogo permanente: Arbitragem de anomalias:** A Arbitragem de anomalias é um modo de desafio permanente de alta dificuldade, atualizado uma vez por versão. O modo é composto por três estágios de "Cavalo" e um "Rei", cada cavalo será derrotado com uma equipe distinta das anteriores, derrotar os três estágios de "Cavalo" enfraquece o "Rei" o transformando em "Rei em cheque"</li>
                            <li>**Horário de atualização:** Início em: 24/09/2025 06:00 (UTC+8) A atualização está prevista para durar 5 horas.</li>
                            <li>**Novos Personagens 5 Estrelas:** Introdução de **Noite Eterna** (A Recordação) e **<Dan Heng Permansor Terrae>** (A Preservação) nos banners de Salto.</li>
                            ';
                            ?>
                        <ul class="list-disc list-inside space-y-3 text-gray-400 ml-4">
                            <?php echo processaMarkdownSimples($novidades);?>
                        </ul>
                    </div>
                    
                    <div>
                        <h2 class="text-3xl font-bold mb-4 text-yellow-500">Mídia de Destaque</h2>
                        <div class="aspect-video bg-gray-800 rounded-lg overflow-hidden flex items-center justify-center">
                            <!-- Placeholder para Vídeo/Trailer -->
                            <p class="text-gray-500 text-center p-4">Trailer da Versão Mais Recente (Placeholder)</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Conteúdo da Aba 2: PERSONAGENS -->
            <div id="tab-characters" class="tab-content hidden">
                <h2 class="text-3xl font-bold mb-6 text-yellow-500">Elenco de Personagens Jogáveis</h2>
                <p class="text-gray-400 mb-8">Navegue pelas fichas de alguns dos personagens mais populares da tripulação do Astral Express e seus aliados. Clique em um card para ver a ficha completa (funcionalidade futura).</p>

                <!-- Grid de Cards de Personagens -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    
                    <!-- Card Placeholder 1: March 7th -->
                    <div class="bg-[#1e2329] rounded-lg shadow-lg hover:shadow-yellow-500/30 transition duration-300 transform hover:scale-[1.02] cursor-pointer border border-gray-700">
                        <div class="p-4">
                            <h3 class="text-xl font-bold text-white mb-1">March 7th</h3>
                            <p class="text-yellow-400 text-sm mb-3">A Preservação</p>
                            <div class="h-40 bg-gray-800 rounded-md mb-3 flex items-center justify-center">
                                <span class="text-gray-500">Arte do Personagem (Placeholder)</span>
                            </div>
                            <p class="text-sm text-gray-400 line-clamp-3">
                                Uma garota energética e otimista, resgatada do gelo espacial. Seu passado é um mistério, mas ela documenta fervorosamente sua vida presente com sua câmera.
                            </p>
                        </div>
                    </div>

                    <!-- Card Placeholder 2: Dan Heng -->
                    <div class="bg-[#1e2329] rounded-lg shadow-lg hover:shadow-yellow-500/30 transition duration-300 transform hover:scale-[1.02] cursor-pointer border border-gray-700">
                        <div class="p-4">
                            <h3 class="text-xl font-bold text-white mb-1">Dan Heng</h3>
                            <p class="text-yellow-400 text-sm mb-3">A Caça</p>
                            <div class="h-40 bg-gray-800 rounded-md mb-3 flex items-center justify-center">
                                <span class="text-gray-500">Arte do Personagem (Placeholder)</span>
                            </div>
                            <p class="text-sm text-gray-400 line-clamp-3">
                                Um guarda silencioso e reservado do Astral Express. Ele empunha uma lança e raramente fala sobre seu passado, mantendo-se sempre vigilante.
                            </p>
                        </div>
                    </div>

                    <!-- Card Placeholder 3: Himeko -->
                    <div class="bg-[#1e2329] rounded-lg shadow-lg hover:shadow-yellow-500/30 transition duration-300 transform hover:scale-[1.02] cursor-pointer border border-gray-700">
                        <div class="p-4">
                            <h3 class="text-xl font-bold text-white mb-1">Himeko</h3>
                            <p class="text-yellow-400 text-sm mb-3">A Erudição</p>
                            <div class="h-40 bg-gray-800 rounded-md mb-3 flex items-center justify-center">
                                <span class="text-gray-500">Arte do Personagem (Placeholder)</span>
                            </div>
                            <p class="text-sm text-gray-400 line-clamp-3">
                                Uma cientista aventureira que consertou o Astral Express. Ela é uma pioneira confiável e usa o seu vasto conhecimento para guiar a expedição.
                            </p>
                        </div>
                    </div>

                    <!-- Card Placeholder 4: Welt -->
                    <div class="bg-[#1e2329] rounded-lg shadow-lg hover:shadow-yellow-500/30 transition duration-300 transform hover:scale-[1.02] cursor-pointer border border-gray-700">
                        <div class="p-4">
                            <h3 class="text-xl font-bold text-white mb-1">Welt Yang</h3>
                            <p class="text-yellow-400 text-sm mb-3">A Inexistência</p>
                            <div class="h-40 bg-gray-800 rounded-md mb-3 flex items-center justify-center">
                                <span class="text-gray-500">Arte do Personagem (Placeholder)</span>
                            </div>
                            <p class="text-sm text-gray-400 line-clamp-3">
                                Um antigo Herói de outro mundo. Welt juntou-se ao Express para evitar que a crise voltasse a acontecer em novas galáxias.
                            </p>
                        </div>
                    </div>

                    <!-- Card Placeholder 5: Kafka -->
                    <div class="bg-[#1e2329] rounded-lg shadow-lg hover:shadow-yellow-500/30 transition duration-300 transform hover:scale-[1.02] cursor-pointer border border-gray-700">
                        <div class="p-4">
                            <h3 class="text-xl font-bold text-white mb-1">Kafka</h3>
                            <p class="text-yellow-400 text-sm mb-3">A Inexistência</p>
                            <div class="h-40 bg-gray-800 rounded-md mb-3 flex items-center justify-center">
                                <span class="text-gray-500">Arte do Personagem (Placeholder)</span>
                            </div>
                            <p class="text-sm text-gray-400 line-clamp-3">
                                Membro dos Caçadores de Stellaron. Sua reputação é conhecida em toda a galáxia por seus métodos pouco ortodoxos e seu charme perigoso.
                            </p>
                        </div>
                    </div>

                    <!-- Card Placeholder 6: Blade -->
                    <div class="bg-[#1e2329] rounded-lg shadow-lg hover:shadow-yellow-500/30 transition duration-300 transform hover:scale-[1.02] cursor-pointer border border-gray-700">
                        <div class="p-4">
                            <h3 class="text-xl font-bold text-white mb-1">Blade</h3>
                            <p class="text-yellow-400 text-sm mb-3">A Destruição</p>
                            <div class="h-40 bg-gray-800 rounded-md mb-3 flex items-center justify-center">
                                <span class="text-gray-500">Arte do Personagem (Placeholder)</span>
                            </div>
                            <p class="text-sm text-gray-400 line-clamp-3">
                                Espadachim misterioso e perigoso, também membro dos Caçadores de Stellaron. Vive em constante dor e com sede de combate.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Conteúdo da Aba 3: COMENTÁRIOS (Giscus) -->
            <div id="tab-comments" class="tab-content hidden">   
                <h2 class="text-3xl font-bold mb-4 text-yellow-500">Comentários da Comunidade</h2>
                <div class="p-2 bg-[#1e2329] rounded-lg border border-gray-700 giscus-container">
                    <!-- 
                        INTEGRAÇÃO GISCUS (Sistema de Comentários)
                        
                        IMPORTANTE: Você precisará substituir os valores abaixo pelos seus próprios:
                        data-repo, data-repo-id, data-category, data-category-id
                    -->
                    <script src="https://giscus.app/client.js"
                        data-repo="[SEU_USERNAME]/[SEU_REPO]" 
                        data-repo-id="[SEU_REPO_ID]"
                        data-category="[SUA_CATEGORIA_DE_DISCUSSAO]"
                        data-category-id="[SEU_CATEGORY_ID]"
                        data-mapping="pathname"
                        data-strict="0"
                        data-reactions-enabled="1"
                        data-emit-metadata="0"
                        data-input-position="top"
                        data-theme="dark_protanopia"
                        data-lang="pt"
                        crossorigin="anonymous"
                        async>
                    </script>
                </div>
                <p class="text-sm text-gray-500 mt-4 text-center">Os comentários são fornecidos pela API Giscus, integrando-se diretamente com as Discussões do GitHub. O que significa que para comentar, você precisa de uma conta no GitHub também.</p>
            </div>

        </main>

    </div>

    <!-- Link para o JavaScript de Controle de Abas -->
    <script src="js/wiki_script.js"></script>
</body>
</html>