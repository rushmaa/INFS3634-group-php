<?php
require_once("dao/UserDao.php");
require_once("dao/JournalDao.php");

// Routes

$app->get('/users', function ($request, $response, $args) {
  return $response->withJson(UserDao::getUsers());
});

$app->get('/students', function ($request, $response, $args) {
  return $response->withJson(UserDao::getStudents());
});

$app->get('/admins', function ($request, $response, $args) {
  return $response->withJson(UserDao::getAdmins());
});

$app->post('/users/login', function ($request, $response, $args) {
  $username = $request->getParam('username');
  $password = $request->getParam('password');
  $obj = UserDao::login($username, $password);
  if ($obj != NULL) {
    return $response->withJson($obj);
  } else {
    return $response->withStatus(404, 'Not FOund');
  }
});

$app->post('/users', function ($request, $response, $args) {
  $user = array(
    'userId' => $request->getParam('userId'),
    'username' => $request->getParam('username'),
    'password' => $request->getParam('password'),
    'name' => $request->getParam('name'),
    'isAdmin' => $request->getParam('isAdmin')
  );
  return $response->withJson(UserDao::saveOrUpdate($user));
});

$app->delete('/users/[{id}]', function ($request, $response, $args) {
  $obj = UserDao::delete($request->getAttribute('id'));
});


$app->get('/users/{id}/journals', function ($request, $response, $args) {
  return $response->withJson(JournalDao::getJournalsByUserId($request->getAttribute('id')));
});

$app->get('/users/[{id}]', function ($request, $response, $args) {
  $obj = UserDao::getById($request->getAttribute('id'));
  if ($obj != NULL) {
    return $response->withJson($obj);
  } else {
    return $response->withStatus(404);
  }
});

$app->get('/journals', function ($request, $response, $args) {
    return $response->withJson(JournalDao::getJournals());
});

$app->get('/journals/[{id}]', function ($request, $response, $args) {
  $obj = JournalDao::getById($request->getAttribute('id'));
  if ($obj != NULL) {
    return $response->withJson($obj);
  } else {
    return $response->withStatus(404);
  }
});

$app->delete('/journals/[{id}]', function ($request, $response, $args) {
  $obj = JournalDao::delete($request->getAttribute('id'));
});

$app->post('/journals', function ($request, $response, $args) {
  $journal = array(
    'journalId' => $request->getParam('journalId'),
    'journalTitle' => $request->getParam('journalTitle'),
    'journalContent' => $request->getParam('journalContent'),
    'journalCreated' => $request->getParam('journalCreated'),
    'userId' => $request->getParam('userId')
  );
  return $response->withJson(JournalDao::saveOrUpdate($journal));
});

$app->get('/[{name}]', function ($request, $response, $args) {
    // Sample log message
    $this->logger->info("Slim-Skeleton '/' route");

    // Render index view
    return $this->renderer->render($response, 'index.phtml', $args);
});
