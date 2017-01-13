<?php
	Route::get('/', 'apiController@lista');
	Route::get('/API', 'apiController@lista');
	Route::get('/API/id/{id}', 'apiController@busca');
	Route::get('/API/label/{label}', 'apiController@buscaLabel');
	Route::get('/scene', 'sceneController@lista');
	Route::get('/scene/lista', 'sceneController@lista');
	Route::get('/scene/novo', 'sceneController@novo');
	Route::get('/scene/edita/{scene}', 'sceneController@edita');
	Route::get('/scene/remove/{scene}', 'sceneController@remove');
	Route::post('/scene/adiciona', 'sceneController@adiciona');

	Route::get('/info', function() {
	  return phpinfo();
	});
