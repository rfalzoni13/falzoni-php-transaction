<?php

namespace App\Http\Middleware;

use Closure;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;

class ValidateSchema
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        try {
            if(empty($request->all())) {
                Log::error('Objeto nulo ou inválido');
                return response()->noContent(400);
            }

            $request->validate([
                'valor' => [
                    'required',
                    'numeric',
                    'min:0'
                ],
                'dataHora' => [
                    'required',
                    'before:now',
                    Rule::date()->format(DATE_ATOM)
                ],
            ], [
                'valor.required' => 'O valor deve ser preenchido',
                'valor.numeric' => 'O campo valor deve ser um número.',
                'valor.min' => 'A transação não deve possuir valor negativo',
                'dataHora.required' => 'A data e hora devem ser preenchidas',
                'dataHora.before' => 'A transação deve ocorrer em uma data anterior à atual',
                'dataHora.date_format' => 'O campo data e hora deve estar no formato ISO 8601'
            ]);
            return $next($request);
        } catch (ValidationException $e) {
            $errors =  $e->errors();
            $errorMessage = '';
            foreach ($errors as $field => $messages) {
                $errorMessage .= ' '.$field . ' => [' . implode(', ', $messages).'],';
            }
            
            Log::error(trim($errorMessage, "\n \,"));
            return response()->noContent(422);
        }


    }
}
