<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class MovieRequest extends FormRequest
{
  /**
   * Determine if the user is authorized to make this request.
   *
   * @return bool
   */
  public function authorize()
  {
    return true;
  }

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array<string, mixed>
   */
  public function rules()
  {
    // Note: I didn't require image here, because I intend to use this request
    // for edit movie too
    return [
      'title' => 'required|unique:movies|min:5|max:31',
      'release_year' => 'required|integer|min:1980|max:2024',
      'duration' => 'required|date_format:H:i',
      'lang' => ['required', Rule::in(['ar', 'en', 'hu'])],
      // TODO: validate number of decimals
      'rating' => 'required|numeric',
      'genre' => ['required', Rule::in(config('constants.genres'))],
      'desc' => 'required|min:15|max:511|',
      'poster-img' => 'image|max:512',
    ];
  }

  /**
   * Get custom attributes for validator errors.
   *
   * @return array
   */
  public function attributes()
  {
    return [
      'desc' => 'description',
      'poster-img' => 'poster image',
    ];
  }
}
