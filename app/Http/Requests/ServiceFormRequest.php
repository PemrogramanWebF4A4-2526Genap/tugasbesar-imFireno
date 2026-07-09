<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class ServiceFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'duration' => 'required|string|max:100',
            'service_type' => 'required|in:online,offline',
            'location' => 'required_if:service_type,offline|nullable|string|max:255',
            'revision' => 'required|integer|min:0',
            'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'status' => 'required|in:draft,active,inactive',
        ];

        return $rules;
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Nama jasa wajib diisi',
            'category_id.required' => 'Kategori wajib dipilih',
            'category_id.exists' => 'Kategori tidak valid',
            'description.required' => 'Deskripsi wajib diisi',
            'price.required' => 'Harga wajib diisi',
            'price.numeric' => 'Harga harus berupa angka',
            'price.min' => 'Harga tidak boleh negatif',
            'duration.required' => 'Estimasi pengerjaan wajib diisi',
            'service_type.required' => 'Tipe jasa wajib dipilih',
            'service_type.in' => 'Tipe jasa tidak valid',
            'location.required_if' => 'Lokasi wajib diisi untuk jasa offline',
            'revision.required' => 'Jumlah revisi wajib diisi',
            'revision.integer' => 'Jumlah revisi harus berupa angka',
            'revision.min' => 'Jumlah revisi tidak boleh negatif',
            'thumbnail.image' => 'Thumbnail harus berupa gambar',
            'thumbnail.mimes' => 'Thumbnail harus berformat JPG, JPEG, PNG, atau WEBP',
            'thumbnail.max' => 'Ukuran thumbnail maksimal 2 MB',
            'status.required' => 'Status wajib dipilih',
            'status.in' => 'Status tidak valid',
        ];
    }
}
