<?php

namespace App\Http\Controllers;

use App\Services\UserService;


class UserController extends Controller
{
    public functin __construct(public UserService $user)
    {}

    public function index(): JsonResponse
    {
        return UserResource::collection($this->userService->list())->response();
    }
 
    public function show(int $id): JsonResponse
    {
        $user = $this->userService->find($id);
 
        if (! $user) {
            return response()->json(['message' => 'Usuário não encontrado.'], 404);
        }
 
        return (new UserResource($user))->response();
    }
 
    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:8'],
        ]);
 
        try {
            $user = $this->userService->register($data);
        } catch (EmailAlreadyExistsException $e) {
            return response()->json(['message' => $e->getMessage()], 422);
        }
 
        return (new UserResource($user))->response()->setStatusCode(201);
    }
 
    public function update(Request $request, int $id): JsonResponse
    {
        $user = $this->userService->find($id);
 
        if (! $user) {
            return response()->json(['message' => 'Usuário não encontrado.'], 404);
        }
 
        $data = $request->validate([
            'name' => ['sometimes', 'string', 'max:255'],
            'email' => ['sometimes', 'email', 'max:255', Rule::unique('users', 'email')->ignore($user->id)],
            'password' => ['sometimes', 'string', 'min:8'],
        ]);
 
        return (new UserResource($this->userService->update($user, $data)))->response();
    }
 
    public function destroy(int $id): JsonResponse
    {
        $user = $this->userService->find($id);
 
        if (! $user) {
            return response()->json(['message' => 'Usuário não encontrado.'], 404);
        }
 
        $this->userService->delete($user);
 
        return response()->json(null, 204);
    }
 
    /**
     * Endpoint interno, chamado pelo serviço de Orders (Symfony) para
     * confirmar que um usuário existe antes de criar um pedido.
     * Protegido por segredo compartilhado (ver middleware ServiceAuth).
     */
    public function existsCheck(int $id): JsonResponse
    {
        $user = $this->userService->find($id);
 
        return response()->json([
            'exists' => (bool) $user,
            'id' => $user?->id,
        ]);
    }
}
