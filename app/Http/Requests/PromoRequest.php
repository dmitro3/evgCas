<?php
namespace App\Http\Requests;

use App\Rules\PromoAbuseRule;
use App\Rules\PromoExistRule;
use Illuminate\Foundation\Http\FormRequest;

class PromoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'promo' => ['required', 'string', 'max:255', new PromoExistRule, new PromoAbuseRule],
        ];
    }
}
