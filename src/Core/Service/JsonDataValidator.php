<?php

namespace LinkReducer\Core\Service;

use LinkReducer\Core\Exceptions\ApplicationException;

class JsonDataValidator {

    /**
     * @throws ApplicationException
     */
    public static function validateAndDecode(string $json): array
    {
        $json = trim($json);

        if ($json === '') {
            throw new ApplicationException('Input data is empty.');
        }

        $decodedJson = json_decode($json, true);

        if (!is_array($decodedJson)) {
            throw new ApplicationException('Input json is invalid.');
        }

        if (count($decodedJson) === 0) {
            throw new ApplicationException('Input json is valid but empty');
        }

        if (! isset($decodedJson['sourceLink'])) {
            throw new ApplicationException('Json property sourceLink not set.');
        }

        $sourceLink = trim($decodedJson['sourceLink']);

        if ($sourceLink === '') {
            throw new ApplicationException('sourceLink is empty.');
        }

        if (filter_var($sourceLink, FILTER_VALIDATE_URL) === false) {
            throw new ApplicationException('sourceLink is set but invalid');
        }

        $decodedJson['sourceLink'] = $sourceLink;

        return $decodedJson;
    }
}
