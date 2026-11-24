<?php
declare(strict_types=1);
session_start();
$usuario = $_SESSION['usuario'] ?? null;
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PurpleSprint — Apresentação do Projeto</title>
  <link rel="icon" type="image/png" href="assets/logo-purplesprint.png">
  <link rel="stylesheet" href="assets/style.css">
</head>
<body>

<header class="header">
  <div class="logo-area">
    <a class="logo-home" href="index.php" aria-label="Página de apresentação">
      <span class="logo-icon">PurpleSprint</span>
    </a>
    <div>
      <strong>PurpleSprint EAM</strong><br>
      <small style="color: var(--texto-suave);">Fábrica de Software &amp; Esteira Inteligente</small>
    </div>
  </div>
  <nav class="top-nav" aria-label="Navegação">
    <a class="nav-link" href="#sobre">Sobre</a>
    <a class="nav-link" href="#como-funciona">Como funciona</a>
    <?php if ($usuario): ?>
      <a class="nav-link" href="cliente.php">Meus projetos</a>
      <a class="nav-button" href="app.php">Enviar ideia</a>
      <?php if (($usuario['perfil'] ?? '') === 'admin'): ?><a class="nav-link" href="admin.php">Área ADM</a><?php endif; ?>
      <a class="nav-link" href="logout.php">Sair</a>
    <?php else: ?>
      <a class="nav-link" href="login.php">Entrar</a>
      <a class="nav-button" href="cadastro.php">Inscreva-se</a>
    <?php endif; ?>
  </nav>
</header>

<main class="container">

  <!-- Primeira coisa da página: link para se inscrever -->
  <section class="card signup-top" aria-label="Inscreva-se na plataforma">
    <div class="signup-inner">
      <div>
        <a class="btn btn-assado" style="width:auto;" href="cadastro.php">Inscreva-se agora — criar minha conta gratuita</a>
      </div>
      <p>Cadastre-se para enviar suas ideias, acompanhar cada etapa do projeto e validar as entregas. Já tem conta? <a href="login.php"><strong>Entrar</strong></a>.</p>
    </div>
  </section>

  <section class="card landing-hero" aria-label="Apresentação">
    <div class="hero-copy">
      <span class="hero-badge">INTEGRA SENAI 2026 · Fábrica de Software</span>
      <h1>Transformamos ideias em soluções reais com organização, cuidado e presença humana</h1>
      <p>O <strong>PurpleSprint EAM</strong> é uma plataforma web que organiza solicitações e projetos em uma esteira inteligente, inspirada na linha de montagem do <em>Purble Place</em>. Cada ideia vira um protocolo, percorre etapas claras, recebe acompanhamento transparente e só avança quando o cliente valida o que foi produzido.</p>
      <p>Nosso trabalho une tecnologia, método, acessibilidade e atendimento próximo para que pessoas e equipes consigam tirar necessidades do papel e transformá-las em software de forma ágil, rastreável e inclusiva.</p>
      <div class="hero-actions">
        <a class="btn btn-assado" style="width:auto;" href="cadastro.php">Quero me inscrever</a>
        <?php if ($usuario): ?>
          <a class="btn btn-zoom" href="app.php">Enviar minha ideia</a>
        <?php else: ?>
          <a class="btn btn-zoom" href="login.php">Já tenho conta</a>
        <?php endif; ?>
      </div>
    </div>
    <div class="hero-media">
      <img class="hero-logo" src="assets/logo-purplesprint.png" alt="Logo do PurpleSprint">
      <figure class="hero-figure">
        <img src="assets/hero-ilustracao.svg" alt="Ilustração da esteira PurpleSprint mostrando as etapas da ideia até a entrega">
      </figure>
    </div>
  </section>

  <section class="card text-block" id="sobre">
    <h2 class="section-title">O que é o PurpleSprint?</h2>
    <p>O PurpleSprint nasceu no contexto do <strong>INTEGRA SENAI 2026</strong> (Categoria INTEGRA Soluções Industriais) como um projeto de <strong>Fábrica de Software</strong>. A proposta é simples de entender e poderosa na prática: organizar o caminho entre uma necessidade e sua solução digital, como em uma confeitaria de software, onde cada “ingrediente” entra na hora certa e cada estação tem uma função bem definida.</p>
    <p>Mais do que receber pedidos, nós estruturamos o trabalho. Cada solicitação recebe identificação própria, é acompanhada em etapas, mantém histórico e pode ser validada pelo cliente ao longo do processo. Isso traz clareza para quem pede, organização para quem executa e confiança para todos os envolvidos.</p>
    <p>Nosso propósito é transformar ideias, demandas e chamados em projetos concretos — com começo, meio e fim — reduzindo ruídos, evitando perdas de informação e colocando as pessoas no centro de cada decisão.</p>
  </section>

  <section class="card">
    <h2 class="section-title">Nossa solução na prática</h2>
    <p class="section-lead">Reunimos em um só lugar o que é essencial para acompanhar uma ideia do início à entrega: cadastro, envio, etapas, validação e comunicação.</p>
    <div class="feature-grid">
      <article class="feature"><h3>Inscrição simples</h3><p>Qualquer pessoa interessada pode se inscrever, criar sua conta e começar a participar da plataforma em poucos passos.</p></article>
      <article class="feature"><h3>Esteira transparente</h3><p>O cliente visualiza o andamento do projeto etapa por etapa, com clareza sobre o que já foi feito e o que vem a seguir.</p></article>
      <article class="feature"><h3>Validação em cada fase</h3><p>Nada avança sem conferência: você revisa as entregas e autoriza a continuidade, garantindo alinhamento com sua necessidade.</p></article>
      <article class="feature"><h3>Atendimento humano</h3><p>Quando necessário, oferecemos briefing por chamada de vídeo 1 a 1 para entender melhor o contexto e acolher cada pessoa.</p></article>
      <article class="feature"><h3>Acessibilidade e inclusão</h3><p>O processo pode contar com intérprete de Libras, legendas ao vivo e escolha de idioma, ampliando o acesso e a compreensão.</p></article>
      <article class="feature"><h3>Rastreabilidade</h3><p>Cada solicitação possui identificação e registro do percurso, facilitando acompanhamento, comunicação e histórico do trabalho.</p></article>
    </div>
  </section>

  <section class="card text-block" id="como-funciona">
    <h2 class="section-title">Como funciona a esteira do PurpleSprint?</h2>
    <p>Depois de se inscrever e acessar a plataforma, você envia sua ideia e acompanha um fluxo organizado em etapas. Essa lógica de “uma estação por vez” dá segurança, mantém o foco e permite construir cada avanço sobre uma base já conferida:</p>
    <div class="steps-grid">
      <div class="step-item"><div class="step-num">1</div><div><h3>Envio da ideia e briefing</h3><p>Você descreve o que precisa, escolhe o tipo de solução (landing page, e-commerce, app, automação, entre outras possibilidades) e define se prefere enviar sem chamada, falar imediatamente por vídeo ou agendar um horário. Assim, o ponto de partida fica registrado com clareza.</p></div></div>
      <div class="step-item"><div class="step-num">2</div><div><h3>Revisão do protótipo</h3><p>A equipe prepara uma proposta visual e estrutural para a sua ideia. Você confere a direção do projeto antes que a construção avance, o que reduz retrabalho e alinha expectativas.</p></div></div>
      <div class="step-item"><div class="step-num">3</div><div><h3>Revisão do software</h3><p>Com o caminho validado, a solução evolui para uma versão funcional. Nessa fase, é possível avaliar comportamento, conteúdo e aderência ao que foi solicitado.</p></div></div>
      <div class="step-item"><div class="step-num">4</div><div><h3>Validação do cliente</h3><p>Você confirma se o protótipo e o software atendem de fato à necessidade apresentada. Esse momento garante que o resultado faça sentido para quem vai usar.</p></div></div>
      <div class="step-item"><div class="step-num">5</div><div><h3>Aprovação final e conclusão</h3><p>Após a sua aprovação, o projeto é concluído e publicado dentro do fluxo da plataforma, encerrando o ciclo com registro, visibilidade e entrega organizada.</p></div></div>
    </div>
  </section>

  <section class="split">
    <article class="card text-block">
      <h2 class="section-title">Presença humana, acessibilidade e inclusão</h2>
      <p>Acreditamos que tecnologia eficiente deve incluir pessoas. No PurpleSprint, o <strong>Zoom</strong> é utilizado como canal oficial de atendimento 1 a 1 para briefings imediatos ou agendados, sempre que a conversa direta ajuda a entender melhor a necessidade.</p>
      <p>Durante o atendimento, é possível indicar preferência de idioma (Português, English, Español ou Libras) e contar com recursos como <strong>intérprete de Libras</strong> e <strong>legendas ao vivo com apoio de inteligência artificial</strong>. Essas escolhas tornam o processo mais acolhedor e acessível para diferentes perfis de usuários.</p>
      <p>Nosso compromisso é manter a presença humana constante: o sistema organiza e acelera, mas são as pessoas que escutam, decidem e validam.</p>
    </article>
    <article class="card text-block">
      <h2 class="section-title">Privacidade, cuidado e confiança</h2>
      <p>Levamos a sério a responsabilidade sobre as informações compartilhadas na plataforma. Buscamos adotar boas práticas alinhadas aos princípios da <strong>LGPD (Lei Geral de Proteção de Dados)</strong>, evitando exposição desnecessária de dados e utilizando as informações para o acompanhamento e a execução das solicitações.</p>
      <p>Ao centralizar pedidos em um ambiente próprio, reduzimos a dependência de canais informais e fortalecemos a segurança do histórico, da comunicação e da rastreabilidade.</p>
      <p>Queremos que cada usuário saiba, com transparência, o que está acontecendo com sua solicitação, em que etapa ela está e como participar das validações.</p>
    </article>
  </section>

  <section class="card text-block">
    <h2 class="section-title">Para quem é o PurpleSprint e como trabalhamos</h2>
    <p>O PurpleSprint foi pensado para cenários em que organização, rapidez e clareza são fundamentais. Ele pode apoiar <strong>equipes e ambientes industriais</strong> na gestão de chamados e melhorias, <strong>clientes e solicitantes</strong> que desejam tirar ideias do papel, <strong>gestores</strong> que precisam de visão sobre andamento e conclusões, e <strong>pessoas que valorizam acessibilidade</strong> em cada etapa da comunicação.</p>
    <p>Trabalhamos com mentalidade de <strong>fábrica de software</strong>: processos definidos, colaboração entre etapas, foco em resultado e melhoria contínua. A inspiração no <em>Purble Place</em> traz leveza à experiência, mas nosso compromisso é sério — entregar soluções úteis, compreensíveis e alinhadas ao que cada pessoa realmente precisa.</p>
    <p>Valorizamos <strong>transparência</strong>, <strong>colaboração</strong>, <strong>inclusão</strong>, <strong>agilidade com responsabilidade</strong> e <strong>qualidade</strong>. É essa combinação que define o jeito PurpleSprint de trabalhar e o cuidado que colocamos em cada projeto.</p>
  </section>

  <section class="card" style="text-align:center;">
    <h2 class="section-title">Pronto para começar?</h2>
    <p class="section-lead">O primeiro passo é se inscrever na plataforma. Depois disso, você poderá enviar sua ideia, escolher a melhor forma de briefing e acompanhar todo o progresso na esteira PurpleSprint.</p>
    <div class="hero-actions" style="justify-content:center;">
      <a class="btn btn-assado" style="width:auto;" href="cadastro.php">Inscreva-se agora</a>
      <?php if ($usuario): ?>
        <a class="btn btn-zoom" href="app.php">Enviar minha ideia</a>
      <?php else: ?>
        <a class="btn btn-zoom" href="login.php">Entrar na conta</a>
      <?php endif; ?>
    </div>
  </section>

</main>

<script src="https://cdn.jsdelivr.net/npm/sienna-accessibility/dist/sienna-accessibility.umd.js" async></script>
</body>
</html>