<?php declare(strict_types=1);

use LinkReducer\Core\Service\JsonDataValidator;
use LinkReducer\Core\Service\LinkReducer;
use PHPUnit\Framework\TestCase;

final class ReducerTest extends TestCase
{
    public function testGetShortLink(): void
    {
        $inputData = '{
           "sourceLink": "https://github.com/php/php-src/blob/php-8.1.0RC2/NEWS"
        }';

        try {
            $data = JsonDataValidator::validateAndDecode($inputData);
            $shortLink = (new LinkReducer)->getShortLink($data);
        } catch (\Exception $exception) {
            var_dump($exception->getMessage());
        }

        $this->assertIsString($shortLink);
    }
}
