<?php
declare(strict_types=1);
session_start();
require_once __DIR__ . '/config.php';
$pdo = conectarBanco();
$erro = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = strtolower(trim($_POST['email'] ?? ''));
    $senha = $_POST['senha'] ?? '';
    $q = $pdo->prepare('SELECT id,nome,email,senha_hash,perfil FROM usuarios WHERE email=:e');
    $q->execute([':e'=>$email]);
    $u = $q->fetch();
    if ($u && password_verify($senha, $u['senha_hash'])) {
        session_regenerate_id(true);
        unset($u['senha_hash']);
        $_SESSION['usuario'] = $u;
        header('Location: app.php'); exit;
    }
    $erro = 'E-mail ou senha incorretos. Confira os dados e tente novamente.';
}
?>
<!doctype html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Entrar — PurpleSprint</title>
  <link rel="icon" type="image/png" href="assets/logo-purplesprint.png">
  <link rel="stylesheet" href="assets/style.css">
  <style>
    .auth-container { max-width: 760px; margin: 0 auto; }
    .auth-topo { margin-bottom: 1.5rem; }
    .auth-topo .voltar { display: inline-block; margin-bottom: 1rem; color: var(--petroleo); font-weight: 700; text-decoration: none; }
    .auth-brand { display: flex; align-items: center; gap: 1rem; }
    .auth-brand img { width: 72px; height: 72px; object-fit: contain; }
    .auth-brand h1 { color: var(--ameixa); font-size: 2rem; margin-bottom: .2rem; }
    .auth-brand p { color: var(--texto-suave); font-size: 1.02rem; }
    .auth-card { padding: 2.2rem; }
    .auth-card h2 { color: var(--ameixa); font-size: 1.6rem; margin-bottom: .35rem; }
    .auth-card .desc { color: var(--texto-suave); margin-bottom: 1.2rem; }
    .auth-card label { display:block; font-weight:600; color: var(--texto-suave); font-size:.92rem; margin: .2rem 0 .35rem; }
    .auth-card input { margin-bottom: 1rem; padding: .95rem 1rem; font-size: 1rem; }
    .auth-card .btn { width: 100%; min-height: 54px; font-size: 1rem; margin-top: .2rem; }
    .erro-geral { color: #8b1f1f; background: #F8EAEA; border: 1px solid #E7C6C6; padding: .9rem 1rem; border-radius: 12px; margin: 0 0 1.2rem; }
    .alt-link { margin-top: 1.2rem; text-align: center; color: var(--texto-suave); }
    .alt-link a { color: var(--petroleo); font-weight: 700; }
    @media (max-width: 640px) { .auth-brand h1 { font-size: 1.7rem; } .auth-card { padding: 1.5rem; } }
  </style>
</head>
<body>
  <main class="container auth-container">
    <div class="auth-topo">
      <a class="voltar" href="index.php">← Voltar para a apresentação</a>
      <div class="auth-brand">
        <img src="assets/logo-purplesprint.png" alt="Logo PurpleSprint">
        <div>
          <h1>Entrar na sua conta</h1>
          <p>Acesse sua conta para enviar ideias e acompanhar seus projetos no PurpleSprint.</p>
        </div>
      </div>
    </div>

    <?php if($erro): ?><p class="erro-geral" role="alert"><?=e($erro)?></p><?php endif; ?>

    <section class="card auth-card" aria-label="Entrar">
      <h2>Entrar</h2>
      <p class="desc">Informe seu e-mail e senha para acessar a plataforma.</p>
      <form method="post">
        <label for="login-email">E-mail</label>
        <input id="login-email" type="email" name="email" required autocomplete="username">

        <label for="login-senha">Senha</label>
        <input id="login-senha" type="password" name="senha" required autocomplete="current-password">

        <button class="btn btn-assado" type="submit">Entrar na minha conta</button>
      </form>
      <p class="alt-link">Ainda não tem conta? <a href="cadastro.php">Inscreva-se</a></p>
    </section>
  </main>
  <script>document.addEventListener('submit',function(e){const f=e.target;const b=e.submitter||f.querySelector('button[type="submit"],button:not([type])');if(!b||f.dataset.submitting==='1'){e.preventDefault();return}f.dataset.submitting='1';b.textContent='Enviando…';b.disabled=true;f.querySelectorAll('button[type="submit"],button:not([type])').forEach(i=>i.disabled=true)});</script>
</body>
</html>