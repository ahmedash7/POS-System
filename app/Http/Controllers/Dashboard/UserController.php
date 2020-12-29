<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\User;
use Faker\Provider\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Intervention\Image\ImageManager;
use Intervention\Image\Facades\Image as InterventionImage;
use Intervention\Image\ImageManagerStatic;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware(['permission:users-read'])->only('index');
        $this->middleware(['permission:users-create'])->only('create');
        $this->middleware(['permission:users-update'])->only('edit');
        $this->middleware(['permission:users-create'])->only('destroy');
    }

    public function index(Request $request)
    {

        $users = User::whereRoleIs('admin')->where(function ($q) use ($request){


            return $q->when($request->search,function ($query) use ($request){

                return $query->where('first_name','like','%' .$request->search. '%')

                    ->orWhere('last_name','like','%' .$request->search. '%');

            });

        })->latest()->paginate(5);

        return view('dashboard.users.home',compact('users'));

    }


    public function create()
    {
        return view('dashboard.users.create');
    }


    public function store(Request $request)
    {

        $request->validate([

            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|unique:users',
            'image' => 'image',
            'password' => 'required|confirmed',
            'permissions' => 'required|min:1',

        ]);

        $request_data = $request->except(['password', 'password_confirmation', 'permissions', 'image']);
        $request_data['password'] = bcrypt($request->password);

        if ($request->image) {

            ImageManagerStatic::make($request->image)

                ->resize(300, null, function ($constraint) {
                    $constraint->aspectRatio();
                })
                ->save(public_path('uploads/user_images/' .  $request->image->hashName()));

            $request_data['image'] = $request->image->hashName();

        }


        $user = User::create($request_data);
        $user->attachRole('admin');
        $user->syncPermissions($request->permissions);

        session()->flash('success', __('site.add_successfully'));
        return redirect()->route('dashboard.users.index');



    }

    public function edit(User $user)
    {
        return view('dashboard.users.edit',compact('user'));
    }


    public function update(Request $request, User $user)
    {
        $request->validate([

            'first_name' => 'required',
            'last_name' => 'required',
            'email' => ['required',Rule::unique('users')->ignore($user->id),],
            'image' => 'image',
            'permissions' => 'required|min:1',


        ]);

        $request_data = $request->except(['permissions','image']);

        if ($request->image) {

            if ($user->image != 'default.png'){

                Storage::disk('public_uploads')->delete('/user_images/'.$user->image);

            }

            ImageManagerStatic::make($request->image)

                ->resize(300, null, function ($constraint) {
                    $constraint->aspectRatio();
                })
                ->save(public_path('uploads/user_images/' .  $request->image->hashName()));

            $request_data['image'] = $request->image->hashName();

        }

        $user->update($request_data);
        $user->syncPermissions($request->permissions);

        session()->flash('success',__('site.edit_successfully'));
        return redirect()->route('dashboard.users.index');



    }


    public function destroy(User $user)
    {
        if ($user->image !=  'default.png') {

            Storage::disk('public_uploads')->delete('/user_images/'.$user->image);

        }
        $user->delete();
        session()->flash('success',__('site.delete_successfully'));
        return redirect()->route('dashboard.users.index');
    }
}
