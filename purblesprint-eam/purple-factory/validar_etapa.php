<?php
declare(strict_types=1);
session_start();
require_once __DIR__ . '/config.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST' || empty($_SESSION['usuario']) || !in_array($_SESSION['usuario']['perfil'], ['cliente', 'admin'], true)) {
    http_response_code(403);
    exit('A validação exige uma conta de cliente conectada.');
}
$tokenSessao = $_SESSION['csrf_token'] ?? '';
if ($tokenSessao === '' || !hash_equals($tokenSessao, (string)($_POST['csrf_token'] ?? ''))) {
    http_response_code(403);
    exit('Não foi possível validar esta solicitação. Atualize a página e tente novamente.');
}

$pdo = conectarBanco();
$codigo = trim((string)($_POST['codigo'] ?? ''));
$etapaEnviada = filter_var($_POST['etapa'] ?? '', FILTER_VALIDATE_INT);
$ehAdmin = $_SESSION['usuario']['perfil'] === 'admin';
$consulta = $pdo->prepare($ehAdmin
    ? 'SELECT etapa_atual FROM sprints WHERE codigo = :codigo'
    : 'SELECT etapa_atual FROM sprints WHERE codigo = :codigo AND usuario_id = :usuario');
$parametros = [':codigo' => $codigo];
if (!$ehAdmin) { $parametros[':usuario'] = $_SESSION['usuario']['id']; }
$consulta->execute($parametros);
$sprint = $consulta->fetch();
if (!$sprint || $etapaEnviada !== (int)$sprint['etapa_atual']) {
    http_response_code(409);
    exit('A etapa mudou ou este projeto não pertence à sua conta. Atualize a página.');
}

$proximaEtapa = (int)$sprint['etapa_atual'] + 1;
if ($proximaEtapa > 5) {
    $sql = "UPDATE sprints SET etapa_atual = 6, status_aprovacao = 'Publicado em Produção' WHERE codigo = :codigo AND etapa_atual = :etapa" . ($ehAdmin ? '' : ' AND usuario_id = :usuario');
    $alterar = $pdo->prepare($sql);
    $parametros = [':codigo' => $codigo, ':etapa' => $etapaEnviada];
    if (!$ehAdmin) { $parametros[':usuario'] = $_SESSION['usuario']['id']; }
    $alterar->execute($parametros);
} else {
    $sql = "UPDATE sprints SET etapa_atual = :proxima, status_aprovacao = 'Em Produção' WHERE codigo = :codigo AND etapa_atual = :etapa" . ($ehAdmin ? '' : ' AND usuario_id = :usuario');
    $alterar = $pdo->prepare($sql);
    $parametros = [':proxima' => $proximaEtapa, ':codigo' => $codigo, ':etapa' => $etapaEnviada];
    if (!$ehAdmin) { $parametros[':usuario'] = $_SESSION['usuario']['id']; }
    $alterar->execute($parametros);
}

header('Location: cliente.php?validacao=ok');
exit;
