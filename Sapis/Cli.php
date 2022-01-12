<?php

namespace IgorValidator\Sapis;

use IgorValidator\Contractors\SapiInterface;
use IgorValidator\EmailValidator;
use IgorValidator\StringHelper;

class Cli implements SapiInterface
{

    public function run()
    {
        echo 'Input string with some email(s): '.PHP_EOL;

        $line         = $this->getEnteredLine();
        $cleaned_data = $this->cleanData($line);

        foreach ($cleaned_data as $maybe_email) {
            $emailValidator = new EmailValidator($maybe_email);
            if ($emailValidator->verify()) {
                echo "Detected valid email: ".$maybe_email.PHP_EOL;
            }
        }
    }

    private function getEnteredLine()
    {
        $handle = fopen("php://stdin", "r");

        return fgets($handle);
    }

    private function cleanData($line)
    {
        $string_helper = new StringHelper($line);

        return $string_helper->getCleanedPieces();
    }
}