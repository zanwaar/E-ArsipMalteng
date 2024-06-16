<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDispositionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    public function attributes(): array
    {
        return [
            'penerima' => __('model.disposition.to'),
            'content' => __('model.disposition.content'),
            'batas_waktu' => __('model.disposition.batas_waktu'),
            'status_dokument' => __('model.disposition.status'),
            'note' => __('model.disposition.note'),
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'penerima' => ['required'],
            'content' => ['required'],
            'batas_waktu' => ['required'],
            'status_dokument' => ['required'],
            'note' => ['nullable'],
        ];
    }
}
