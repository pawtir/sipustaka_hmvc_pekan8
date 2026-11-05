<?php

namespace Modules\UserManagement\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    private function akunSendiri(): bool
    {
        return $this->route('user')->id === $this->user()->id;
    }

    public function rules(): array
    {
        $user = $this->route('user');

        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')->ignore($user->id)],
            'role' => ['required', $this->akunSendiri() ? 'in:admin' : 'in:admin,user'],
            'password' => ['nullable', 'confirmed', 'min:8'],
        ];
    }

    public function messages(): array
    {
        return [
            'role.in' => $this->akunSendiri()
                ? 'Anda tidak bisa menurunkan role akun sendiri.'
                : 'Role harus admin atau user.',
        ];
    }
}
