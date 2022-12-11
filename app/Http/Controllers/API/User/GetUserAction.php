<?php

namespace App\Http\Controllers\API\User;

use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Resources\Json\ResourceCollection;

use App\Models\User;

class GetUserAction extends Controller
{
    /**
     * Get user action.
     * 
     * @param  string $name
     * @param  string $email
     * @return App\Models\User
     */
    public function __invoke(Request $request)
    {
        if ($request->exists('name') && $request->exists('email')) {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string',
                'email' => 'required|email'
            ]);

            if ($validator->fails()) {
                return $validator->errors();
            }

            $validatedParams = $validator->validated();

            $name = Arr::get($validatedParams, 'name');
            $email = Arr::get($validatedParams, 'email');
            $limit = Arr::get($validatedParams, 'limit', 10);

            $users = new ResourceCollection(User::where('name', 'like', '%' . $name . '%')
                ->where('email', $email)
                ->paginate($limit));

            return $users;
        }

        $users = new ResourceCollection(User::paginate(10));

        return $users;
    }
}
