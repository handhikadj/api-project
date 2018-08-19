<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Repositories\Contracts\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Auth;
use Illuminate\Validation\Rule;

class UserController extends Controller
{

    /**
     * Instance of UserRepository
     *
     * @var UserRepository
     */
    private $userRepository;

    /**
     * Constructor
     *
     * @param UserRepository $userRepository
     * @param UserTransformer $userTransformer
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;

        parent::__construct();
    }

    public function register(Request $request) 
    {
        $rules = [
            'name'             => 'required',
            'email'             => 'email|required|unique:users',
            'password'      => 'required|min:8',
        ];
        $message = [
            'name.required' => 'Field nama dibutuhkan',
            'email.email' => 'Harus email',
            'email.required' => 'Field email dibutuhkan',
            'email.unique' => 'Email sudah ada',
            'password.required' => 'Field Password Dibutuhkan',
            'password.min' => 'Password minimal 8',            
        ];

        $this->validate($request, $rules, $message);

        $data = $request->all();

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        $token = $user->createToken('User Token', ['*'])->accessToken;

        return $this->sendResponseApiToken($token);
    }

    public function login(Request $request) 
    { 
        $rules = [
            'email'                 => 'email|required|exists:users,email',
            'password'              => 'required|min:8'
        ];
        $message = [
            'email.email' => 'Harus email',
            'email.required' => 'Field email dibutuhkan',
            'email.exists' => 'Email tidak benar',
            'password.required' => 'Field Password Dibutuhkan',
            'password.min' => 'Password minimal 8',
        ];

        $this->validate($request, $rules, $message);

        $email = $request->email;
        $pass =  $request->password;

        $user = User::where('email' , $email)->first();

        if ( Hash::check($pass, $user->password) ) {
            $token =  $user->createToken('User Token', ['*'])->accessToken; 
            return $this->sendResponseApiToken($token);
        }

        return $this->sendUnauthorizedResponse();
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $users = User::all();

        return $users;
    }

    /**
     * Display the specified resource.
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse|string
     */
    public function show($id)
    {
        $user = $this->userRepository->findOne($id);

        if (!$user instanceof User) {
            return $this->sendNotFoundResponse("The user with id {$id} doesn't exist");
        }

        return $user;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|string
     */
    public function store(Request $request)
    {
        // Validation
        $validatorResponse = $this->validateRequest($request, $this->storeRequestValidationRules($request));

        // Send failed response if validation fails
        if ($validatorResponse !== true) {
            return $this->sendInvalidFieldResponse($validatorResponse);
        }

        $user = $this->userRepository->save($request->all());

        if (!$user instanceof User) {
            return $this->sendCustomResponse(500, 'Error occurred on creating User');
        }

        return $user;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'name'             => 'required',
            'email'             => 'email|required|unique:users',
            'password'      => 'required|min:5',
            'role'              => [  'required',
                                            Rule::in([
                                                'BASIC_USER',
                                                'ADMIN_USER'
                                            ])
                                        ]
        ];
        $message = [
            'name.required' => 'Field nama dibutuhkan',
            'email.email' => 'Harus email',
            'email.required' => 'Field email dibutuhkan',
            'email.unique' => 'Email sudah ada',
            'password.required' => 'Field Password Dibutuhkan',
            'password.min' => 'Password minimal 5',
            'role.required' => 'Field Role Dibutuhkan',
            'role.in' => 'Harus Memilih Role',
        ];

        $validatorResponse = $this->validateRequest($request, $rules, $message);

        // Send failed response if validation fails
        if ($validatorResponse !== true) {
            return $this->sendInvalidFieldResponse($validatorResponse);
        }

        $user = $this->userRepository->findOne($id);

        if (!$user instanceof User) {
            return $this->sendNotFoundResponse("The user with id {$id} doesn't exist");
        }

        // Authorization
        // $this->authorize('update', $user);


        $user = $this->userRepository->update($user, $request->all());

        return $user;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse|string
     */
    public function destroy($id)
    {
        $user = $this->userRepository->findOne($id);

        if (!$user instanceof User) {
            return $this->sendNotFoundResponse("The user with id {$id} doesn't exist");
        }

        $this->userRepository->delete($user);

        return $this->sendCustomResponse(200, 'Data is Deleted');
    }

    /**
     * Store Request Validation Rules
     *
     * @param Request $request
     * @return array
     */
    private function storeRequestValidationRules(Request $request)
    {
        $rules = [
            'name'                  => 'required',
            'email'                 => 'email|required|unique:users',
            'password'              => 'min:5'
        ];

        $requestUser = $request->user();

        // Only admin user can set admin role.
        if ($requestUser instanceof User && $requestUser->role === User::ADMIN_ROLE) {
            $rules['role'] = 'in:BASIC_USER,ADMIN_USER';
        } else {
            $rules['role'] = 'in:BASIC_USER';
        }

        return $rules;
    }

    /**
     * Update Request validation Rules
     *
     * @param Request $request
     * @return array
     */
    private function updateRequestValidationRules(Request $request)
    {
        $userId = $request->segment(2);
        $rules = [
            'email'                 => 'email|unique:users,email,'. $userId,
            'firstName'             => 'max:100',
            'middleName'            => 'max:50',
            'lastName'              => 'max:100',
            'username'              => 'max:50',
            'address'               => 'max:255',
            'zipCode'               => 'max:10',
            'phone'                 => 'max:20',
            'mobile'                => 'max:20',
            'city'                  => 'max:100',
            'state'                 => 'max:100',
            'country'               => 'max:100',
            'password'              => 'min:5'
        ];

        $requestUser = $request->user();

        // Only admin user can update admin role.
        if ($requestUser instanceof User && $requestUser->role === User::ADMIN_ROLE) {
            $rules['role'] = 'in:BASIC_USER,ADMIN_USER';
        } else {
            $rules['role'] = 'in:BASIC_USER';
        }

        return $rules;
    }
}