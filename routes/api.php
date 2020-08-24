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

/* Characters Routes */
Route::get('/character/list', 'Api\CharacterController@getAllCharacters');
Route::get('/character/show/{id}', 'Api\CharacterController@getOneCharacterById');
Route::get('/character/discord/{discordId}', 'Api\CharacterController@getOneCharacterByDiscordId');
Route::post('character/new', 'Api\CharacterController@createCharacter');
Route::post('/character/edit', 'Api\CharacterController@editCharacter');
Route::post('/character/kill/{id}', 'Api\CharacterController@kill');

/* Job Routes */
Route::get('/job/list', 'Api\JobController@getAllJobs');
Route::get('/job/show/{id}', 'Api\JobController@getJobById');
Route::post('/job/create', 'Api\JobController@createJob');
Route::post('/job/edit', 'Api\JobController@editJob');
Route::post('/job/delete', 'Api\JobController@deleteJob');

/* Inventory Routes */
Route::get('/inventory/list', 'Api\InventoryController@getInventories');
Route::get('/inventory/character/{id}', 'Api\InventoryController@getInventoriesByCharacter');
Route::post('/inventory/add', 'Api\InventoryController@createInventory');
Route::post('/inventory/edit', 'Api\InventoryController@editInventory');
Route::post('/inventory/destroy/{id}', 'Api\InventoryController@destroy');

/* Inventory Pieces Routes */
Route::get('/inventory/pieces', 'Api\InventoryController@getInventoryPieces');
Route::get('/inventory/pieces/show/{id}', 'Api\InventoryController@getOneInventoryPiece');
Route::post('/inventory/pieces/new', 'Api\InventoryController@createInventoryPiece');
Route::post('/inventory/pieces/edit', 'Api\InventoryController@editInventoryPiece');
Route::post('/inventory/pieces/delete/{id}', 'Api\InventoryController@deleteInventoryPiece');

/* Family Routes */
Route::get('/family/list', 'Api\FamilyController@getFamilies');
Route::get('/family/show/{id}', 'Api\FamilyController@getFamiliesByCharacter');
Route::post('/family/new', 'Api\FamilyController@createFamily');
Route::post('/family/edit', 'Api\FamilyController@editFamily');
Route::post('/family/kill', 'Api\FamilyController@kill');

/* Family Member Routes */
Route::get('/family/member/list', 'Api\FamilyController@getFamilyMembers');
Route::get('/family/member/show/{id}', 'Api\FamilyController@getOneFamilyMember');
Route::post('/family/member/create', 'Api\FamilyController@createFamilyMember');
Route::post('/family/member/edit', 'Api\FamilyController@editFamilyMember');
Route::post('/family/member/delete/{id}', 'Api\FamilyController@deleteFamilyMember');

/* Skill Routes */

Route::get('/skill/list', 'Api\SkillController@getSkills');
Route::get('skill/job/show/{short}', 'Api\SkillController@getSkillsByJob');
Route::get('/skill/character/show/{id}', 'Api\SkillController@getSkillsByCharacter');
Route::post('/skill/new', 'Api\SkillController@createSkill');
Route::post('/skill/character/add', 'Api\SkillController@addSkillToCharacter');
Route::post('/skill/character/update', 'Api\SkillController@updateSkillLevel');
Route::post('/skill/character/delete', 'Api\SkillController@deleteSkillLevel');
Route::post('/skill/job/add', 'Api\SkillController@addSkillToJob');
Route::post('/skill/job/delete/{id}', 'Api\SkillController@deleteSkillJob');
Route::post('/skill/edit', 'Api\SkillController@editSkill');
Route::post('/skill/delete', 'Api\SkillController@deleteSkill');

/* Conviction Routes */

Route::get('/conviction/list', 'Api\ConvictionController@getConvictions');
Route::get('/conviction/character/id', 'Api\ConvictionController@getConvictionByCharacter');
Route::post('/conviction/new', 'Api\ConvictionController@addConviction');
Route::post('/conviction/edit', 'Api\ConvictionController@editConviction');
Route::post('/conviction/delete', 'Api\ConvictionController@deleteConviction');