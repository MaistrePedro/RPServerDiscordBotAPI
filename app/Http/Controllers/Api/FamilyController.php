<?php

namespace App\Http\Controllers\Api;

use App\Family;
use App\FamilyMember;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FamilyController extends Controller
{
    public function getFamilies()
    {
        return Family::all();
    }

    public function getFamiliesByCharacter(Request $request)
    {
        $character = $request->input('character_id');
        return Family::where('character_id', $character);
    }

    public function createFamily(Request $request)
    {
        $member = FamilyMember::where('short', $request->input('member'));
        $memberId = $member->id;

        $family = new Family();
        $family->name = $request->input('name');
        $family->family_member_id = $memberId;
        $family->character_id = $request->input('character_id');
        $family->save();

        return Controller::SUCCESS;
    }

    public function editFamily(Request $request)
    {
        $family = Family::where('id', $request->input('id'));
        $field = $request->input('field');
        $value = $request->input('value');

        switch ($field) {
            case Family::NAME:
                $family->name = $value;
                break;
            case Family::MEMBER:
                $member = FamilyMember::where('short', $request->input('member'));
                $memberId = $member->id;
                $family->family_member_id = $memberId;
                break;
            default:
                return Controller::ERROR;
                break;
        }
        $family->save();

        return Controller::SUCCESS;
    }

    public function kill(Request $request)
    {
        $id = $request->input('id');
        Family::destroy($id);
    }

    public function getFamilyMembers()
    {
        return FamilyMember::all();
    }

    public function getOneFamilyMember(Request $request)
    {
        return FamilyMember::where('id', $request->input('id'));
    }

    public function createFamilyMember(Request $request)
    {
        $familyMember = new FamilyMember;
        $familyMember->label = $request->input('label');
        $familyMember->short = $request->input('short');
        $familyMember->save();

        return Controller::SUCCESS;
    }

    public function editFamilyMember(Request $request)
    {
        $familyMember = FamilyMember::where('id', $request->input('id'));
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
        return Controller::SUCCESS;
    }

    public function deleteFamilyMember(integer $id)
    {
        FamilyMember::destroy($id);

        return Controller::SUCCESS;
    }
}
