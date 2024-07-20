<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;
use App\Models\Country;
use App\Enums\FlowEnum;
use App\Enums\TransportEnum;
use App\Messages\ComexFilterMessage;

class ComexFilterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'country' => ['integer', 'exists:' . Country::class . ',id'],
            'flow' => [new Enum(FlowEnum::class)],
            'transport' => [new Enum(TransportEnum::class)],
            'year.from' => ['integer'],
            'year.to' => ['integer', 'gte:year.from'],
            'amount.from' => ['decimal:0,2'],
            'amount.to' => ['decimal:0,2', 'gte:amount.from'],
        ];
    }

    public function messages(): array
    {
        return [
            'country.integer' => ComexFilterMessage::MUST_BE_INTEGER_COUNTRY->value,
            'country.exists' => ComexFilterMessage::NOT_EXISTS_COUNTRY->value,
            'flow' => ComexFilterMessage::INVALID_FLOW->value,
            'transport' => ComexFilterMessage::INVALID_TRANSPORT->value,
            'year.from.integer' => ComexFilterMessage::MUST_BE_INTEGER_YEAR_FROM->value,
            'year.to.integer' => ComexFilterMessage::MUST_BE_INTEGER_YEAR_TO->value,
            'year.to.gte' => ComexFilterMessage::GREATER_OR_EQUAL_YEAR_TO_THAN_YEAR_FROM->value,
            'amount.from.decimal' => ComexFilterMessage::MUST_BE_DECIMAL_AMOUNT_FROM->value,
            'amount.to.decimal' => ComexFilterMessage::MUST_BE_DECIMAL_AMOUNT_TO->value,
            'amount.to.gte' => ComexFilterMessage::GREATER_OR_EQUAL_AMOUT_TO_THAN_AMOUT_FROM->value,
        ];
    }
}
