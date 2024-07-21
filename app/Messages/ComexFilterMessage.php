<?php

namespace App\Messages;

enum ComexFilterMessage: string
{
    case NOT_EXISTS_COUNTRY = 'País não Existe.';

    case MUST_BE_INTEGER_COUNTRY = 'País deve ser um número inteiro';
    case MUST_BE_INTEGER_YEAR_FROM = 'Ano inicial deve ser um número inteiro';
    case MUST_BE_INTEGER_YEAR_TO = 'Ano final deve ser um número inteiro';
    case MUST_BE_DECIMAL_AMOUNT_FROM = 'Valor inicial deve ser um número decimal com 2 casas';
    case MUST_BE_DECIMAL_AMOUNT_TO = 'Valor final deve ser um número decimal com 2 casas';

    case GREATER_OR_EQUAL_YEAR_TO_THAN_YEAR_FROM = 'Ano final deve ser maior ou igual do que o ano inicial';
    case GREATER_OR_EQUAL_AMOUT_TO_THAN_AMOUT_FROM = 'Valor final deve ser maior ou igual do que o valor inicial';

    case INVALID_FLOW = 'Flow Inválido. Deve ser E=Exportação | I=Importação.';
    case INVALID_TRANSPORT = 'Transporte Inválido. Deve ser A=Aéreo | M=Marítimo | R=Rodoviário | F=Ferroviário.';
}
