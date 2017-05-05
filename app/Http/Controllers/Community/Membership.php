<?php

namespace App\Http\Controllers\Community;

use App\Models\Community\Group;
use App\Http\Controllers\BaseController;
use App\Http\Requests\Community\DeployToCommunityGroupRequest;

class Membership extends BaseController
{
    protected $redirectTo = 'mship/manage/dashboard';

    public function getDeploy()
    {
        $this->authorize('deploy', new \App\Models\Community\Membership());

        $defaultGroup = Group::isDefault()->first();
        $groups = Group::notDefault()->inRandomOrder()->get();

        return $this->viewMake('community.site.membership.deploy')
                    ->with('defaultGroup', $defaultGroup)
                    ->with('isDefaultGroupMember', $defaultGroup->hasMember(\Auth::user()))
                    ->with('groups', $groups);
    }

    public function postDeploy(DeployToCommunityGroupRequest $request)
    {
        $chosenGroup = Group::find($request->input('group'));

        \Auth::user()->addCommunityGroup($chosenGroup);

        if (!$chosenGroup->default) {
            \Auth::user()->syncWithDefaultCommunityGroup();
        }

        return redirect($this->redirectPath())->withSuccess("You have successfully been deployed to this '".$chosenGroup->name."' Group!");
    }
}