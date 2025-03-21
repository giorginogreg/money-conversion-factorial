<?php

declare(strict_types=1);

namespace App\Controller;

use App\Models\Amount;
use App\Service\MoneyConverterService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapQueryParameter;
use Symfony\Component\Routing\Attribute\Route;

class MoneyConverterController extends AbstractController {

    public const REGEX_VALIDATION_VALUE = "/([0-9]+)p([0-9]+)s([0-9]+)d/i";


    #[Route('/sum')]
    public function addition(
        #[MapQueryParameter] string $firstValue,
        #[MapQueryParameter] string $secondValue,
    ): JsonResponse {
        //TODO: check that the query parameters are not empty, that the structure is the following:

        // [int](pP)[int](sS)[int](dD)

        $firstValueMatches = [];
        $secondValueMatches = [];

        // Validate if the string matches the structure.
        $firstRegexMatch = preg_match(self::REGEX_VALIDATION_VALUE, $firstValue, $firstValueMatches);
        $secondRegexMatch = preg_match(self::REGEX_VALIDATION_VALUE, $secondValue, $secondValueMatches);

        //TODO: Assert that the firstValueMatches and secondValueMatches has 4 values respectively.
        [$echoString, $poundsFirstValue, $shillingsFirstValue, $pencesFirstValue] = $firstValueMatches;
        [$echoString, $poundsSecondValue, $shillingsSecondValue, $pencesSecondValue] = $secondValueMatches;

        // Conversion from strings already validated into integers
        $poundsFirstValue = intval($poundsFirstValue);
        $shillingsFirstValue = intval($shillingsFirstValue);
        $pencesFirstValue = intval($pencesFirstValue);
        $poundsSecondValue = intval($poundsSecondValue);
        $shillingsSecondValue = intval($shillingsSecondValue);
        $pencesSecondValue = intval($pencesSecondValue);


        $firstAmount = new Amount($poundsFirstValue, $shillingsFirstValue, $pencesFirstValue);
        $secondAmount = new Amount($poundsSecondValue, $shillingsSecondValue, $pencesSecondValue);

        return $this->json(
            [
                "result" => MoneyConverterService::sumAmounts($firstAmount, $secondAmount)->__toString(),
            ]
        );

        /*
         *
                "firstValueDestructured" => [
                    "Pounds" => $poundsFirstValue,
                    "Shillings" => $shillingsFirstValue,
                    "Pences" => $pencesFirstValue,
                ],
                "secondValueDestructured" => [
                    "Pounds" => $poundsSecondValue,
                    "Shillings" => $shillingsSecondValue,
                    "Pences" => $pencesSecondValue,
                ]
         */
    }

    #[Route('/subtraction')]
    public function subtraction(
        #[MapQueryParameter] string $firstValue,
        #[MapQueryParameter] string $secondValue,
    ): JsonResponse {

        $firstValueMatches = [];
        $secondValueMatches = [];

        // Validate if the string matches the structure.
        $firstRegexMatch = preg_match(self::REGEX_VALIDATION_VALUE, $firstValue, $firstValueMatches);
        $secondRegexMatch = preg_match(self::REGEX_VALIDATION_VALUE, $secondValue, $secondValueMatches);

        //TODO: Assert that the firstValueMatches and secondValueMatches has 4 values respectively.
        [$echoString, $poundsFirstValue, $shillingsFirstValue, $pencesFirstValue] = $firstValueMatches;
        [$echoString, $poundsSecondValue, $shillingsSecondValue, $pencesSecondValue] = $secondValueMatches;

        // Conversion from strings already validated into integers
        $poundsFirstValue = intval($poundsFirstValue);
        $shillingsFirstValue = intval($shillingsFirstValue);
        $pencesFirstValue = intval($pencesFirstValue);
        $poundsSecondValue = intval($poundsSecondValue);
        $shillingsSecondValue = intval($shillingsSecondValue);
        $pencesSecondValue = intval($pencesSecondValue);

        $firstAmount = new Amount($poundsFirstValue, $shillingsFirstValue, $pencesFirstValue);
        $secondAmount = new Amount($poundsSecondValue, $shillingsSecondValue, $pencesSecondValue);

        return $this->json(
            [
                "result" => MoneyConverterService::subtractAmounts($firstAmount, $secondAmount)->__toString(),
            ]
        );

        /*
         *
                "firstValueDestructured" => [
                    "Pounds" => $poundsFirstValue,
                    "Shillings" => $shillingsFirstValue,
                    "Pences" => $pencesFirstValue,
                ],
                "secondValueDestructured" => [
                    "Pounds" => $poundsSecondValue,
                    "Shillings" => $shillingsSecondValue,
                    "Pences" => $pencesSecondValue,
                ]
         */
    }

    #[Route('/multiplication')]
    public function multiplication(
        #[MapQueryParameter] string $firstValue,
        #[MapQueryParameter] int $multiplier,
    ): JsonResponse {

        $firstValueMatches = [];

        // Validate if the string matches the structure.
        $firstRegexMatch = preg_match(self::REGEX_VALIDATION_VALUE, $firstValue, $firstValueMatches);

        //TODO: Assert that the firstValueMatches and secondValueMatches has 4 values respectively.
        [$echoString, $poundsFirstValue, $shillingsFirstValue, $pencesFirstValue] = $firstValueMatches;

        // Conversion from strings already validated into integers
        $poundsFirstValue = intval($poundsFirstValue);
        $shillingsFirstValue = intval($shillingsFirstValue);
        $pencesFirstValue = intval($pencesFirstValue);

        $firstAmount = new Amount($poundsFirstValue, $shillingsFirstValue, $pencesFirstValue);

        return $this->json(
            [
                "result" => MoneyConverterService::multiplyAmounts($firstAmount, $multiplier)->__toString(),
            ]
        );

        /*
         *
                "firstValueDestructured" => [
                    "Pounds" => $poundsFirstValue,
                    "Shillings" => $shillingsFirstValue,
                    "Pences" => $pencesFirstValue,
                ],
                "secondValueDestructured" => [
                    "Pounds" => $poundsSecondValue,
                    "Shillings" => $shillingsSecondValue,
                    "Pences" => $pencesSecondValue,
                ]
         */
    }

    #[Route('/division')]
    public function division(
        #[MapQueryParameter] string $firstValue,
        #[MapQueryParameter] int $divider,
    ): JsonResponse {

        $firstValueMatches = [];

        // Validate if the string matches the structure.
        $firstRegexMatch = preg_match(self::REGEX_VALIDATION_VALUE, $firstValue, $firstValueMatches);

        //TODO: Assert that the firstValueMatches and secondValueMatches has 4 values respectively.
        [$echoString, $poundsFirstValue, $shillingsFirstValue, $pencesFirstValue] = $firstValueMatches;

        // Conversion from strings already validated into integers
        $poundsFirstValue = intval($poundsFirstValue);
        $shillingsFirstValue = intval($shillingsFirstValue);
        $pencesFirstValue = intval($pencesFirstValue);

        $firstAmount = new Amount($poundsFirstValue, $shillingsFirstValue, $pencesFirstValue);

        return $this->json(
            [
                "result" => MoneyConverterService::divideAmount($firstAmount, $divider)[0]->__toString(),
                "remainder" => MoneyConverterService::divideAmount($firstAmount, $divider)[1]->__toString(),
            ]
        );

        /*
         *
                "firstValueDestructured" => [
                    "Pounds" => $poundsFirstValue,
                    "Shillings" => $shillingsFirstValue,
                    "Pences" => $pencesFirstValue,
                ],
                "secondValueDestructured" => [
                    "Pounds" => $poundsSecondValue,
                    "Shillings" => $shillingsSecondValue,
                    "Pences" => $pencesSecondValue,
                ]
         */
    }

}
