<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

/* Characters routes */
Route::get('/character/list', 'CharacterController@getAllCharacters');
Route::get('/character/show/{id}', 'CharacterController@getOneCharacterById');
Route::get('/character/discord/{discordId}', 'CharacterController@getOneCharacterByDiscordId');
Route::post('character/new', 'CharacterController@createCharacter');
Route::post('/character/edit', 'CharacterController@editCharacter');
Route::post('/character/kill/{id}', 'CharacterController@kill');

/* Job routes */
Route::get('/job/list', 'JobController@getAllJobs');
Route::get('/job/show/{id}', 'JobController@getJobById');
Route::post('/job/create', 'JobController@createJob');
Route::post('/job/edit', 'JobController@editJob');
Route::post('/job/delete', 'JobController@deleteJob');

/* Inventory Routes */
Route::get('/inventory/list', 'InventoryController@getInventories');
Route::get('/inventory/character/{id}', 'InventoryController@getInventoriesByCharacter');
Route::post('/inventory/add', 'InventoryController@createInventory');
Route::post('/inventory/edit', 'InventoryController@editInventory');
Route::post('/inventory/destroy/{id}', 'InventoryController@destroy');

/* Inventory Pieces Routes */
Route::get('/inventory/pieces', 'InventoryController@getInventoryPieces');
Route::get('/inventory/pieces/show/{id}', 'InventoryController@getOneInventoryPiece');
Route::post('/inventory/pieces/new', 'InventoryController@createInventoryPiece');
Route::post('/inventory/pieces/edit', 'InventoryController@editInventoryPiece');
Route::post('/inventory/pieces/delete/{id}', 'InventoryController@deleteInventoryPiece');

/* Family Routes */
Route::get('/family/list', 'FamilyController@getFamilies');
Route::get('/family/show/{id}', 'FamilyController@getFamiliesByCharacter');
Route::post('/family/new', 'FamilyController@createFamily');
Route::post('/family/edit', 'FamilyController@editFamily');
Route::post('/family/kill', 'FamilyController@kill');

/* Family Member Routes */
Route::get('/family/member/list', 'FamilyController@getFamilyMembers');
Route::get('/family/member/show/{id}', 'FamilyController@getOneFamilyMember');
Route::post('/family/member/create', 'FamilyController@createFamilyMember');
Route::post('/family/member/edit', 'FamilyController@editFamilyMember');
Route::post('/family/member/delete/{id}', 'FamilyController@deleteFamilyMember');