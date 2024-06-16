<?php

namespace App\Http\Requests;

use App\Enums\LetterType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreLetterRequest extends FormRequest
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
            'nomor_agenda' => __('model.letter.nomor_agenda'),
            'pengirim' => __('model.letter.from'),
            'penerima' => __('model.letter.to'),
            'bidang' => __('model.letter.bidang'),
            'nomor_dokument' => __('model.letter.nomor_dokument'),
            'tgl_diterima' => __('model.letter.tgl_diterima'),
            'tgl_dokument' => __('model.letter.tgl_dokument'),
            'description' => __('model.letter.description'),
            'note' => __('model.letter.note'),
            'klasifikasi_kode' => __('model.letter.klasifikasi_kode'),
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
            'nomor_agenda' => ['required'],
            'pengirim' => [Rule::requiredIf($this->type == LetterType::INCOMING->type())],
            'penerima' => [Rule::requiredIf($this->type == LetterType::OUTGOING->type())],
            'bidang' => [Rule::requiredIf($this->type == LetterType::BIDANG->type())],
            'type' => ['required'],
            'nomor_dokument' => ['required', Rule::unique('dokument')],
            'tgl_diterima' => [Rule::requiredIf($this->type == LetterType::INCOMING->type())],
            'tgl_dokument' => ['required'],
            'description' => ['required'],
            'note' => ['nullable'],
            'klasifikasi_kode' => ['nullable'],
        ];
    }
}
