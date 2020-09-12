<?php

namespace App\Http\Controllers\Api;

use App\Family;
use App\FamilyMember;
use App\Character;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FamilyController extends Controller
{
    public function getFamilies()
    {
        return Family::all();
    }

    public function getFamiliesByCharacter(string $discord_id)
    {
        $character = Character::where('discord_id', $discord_id)->first();
        $results = [
            'character_name' => $character->name,
            'family' => Family::where('character_id', $character->id)->get()
        ];
        return $results;
    }

    public function createFamily(Request $request)
    {
        $member = FamilyMember::where('short', $request->input('member'));
        $memberId = $member->id;
        $character = Character::where('discord_id', $request->input('character'));

        if (!$character) {
            return \response()->json([
                'status' => Controller::ERROR,
                'message' => 'Le personnage est inconnu'
            ]);
        }

        if (!$member) {
            return \response()->json([
                'status' => Controller::ERROR,
                'message' => 'Le membre de famille est inconnu'
            ]);
        }

        $family = new Family();
        $family->name = $request->input('name');
        $family->family_member_id = $memberId;
        $family->character_id = $character->id;
        $family->save();

        return response()->json([
            'status' => Controller::SUCCESS,
            'character' => $character,
            'member' => $family,
        ]);
    }

    public function editFamily(Request $request)
    {
        $family = Family::where('id', $request->input('id'))->first();
        $field = $request->input('field');
        $value = $request->input('value');

        switch ($field) {
            case Family::NAME:
                $family->name = $value;
                break;
            case Family::MEMBER:
                $member = FamilyMember::where('short', $request->input('member'))->first();
                $memberId = $member->id;
                $family->family_member_id = $memberId;
                break;
            default:
                return Controller::ERROR;
                break;
        }
        $family->save();

        return response()->json([
            'status' => Controller::SUCCESS,
            'member' => $family,
        ]);;
    }

    public function kill(int $id)
    {
        Family::where('id', $id)->first()->delete();
        return Controller::SUCCESS;
    }

    public function getFamilyMembers()
    {
        return FamilyMember::all();
    }

    public function getOneFamilyMember(int $id)
    {
        return FamilyMember::where('id', $id);
    }

    public function createFamilyMember(Request $request)
    {
        $familyMember = new FamilyMember;
        $familyMember->label = $request->input('label');
        $familyMember->short = $request->input('short');
        $familyMember->save();

        return response()->json([
            'status' => Controller::SUCCESS,
        ]);
    }

    public function editFamilyMember(Request $request)
    {
        $familyMember = FamilyMember::where('short', $request->input('short'))->first();
        $field = $request->input('field');
        $value = $request->input('value');
        switch ($field) {
            case FamilyMember::LABEL:
                $familyMember->label = $value;
                break;
            case FamilyMember::SHORT:
                $familyMember->short = $value;
                break;
            default:
                return Controller::ERROR;
                break;
        }
        $familyMember->save();
        return response()->json([
            'status' => Controller::SUCCESS,
            'member' => $familyMember,
        ]);
    }

    public function deleteFamilyMember(int $id)
    {
        FamilyMember::where('id', $id)->first()->delete();
        return response()->json([
            'status' => Controller::SUCCESS,
        ]);
    }
}
