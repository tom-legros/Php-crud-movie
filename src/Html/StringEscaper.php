<?php

declare(strict_types=1);

namespace Html;

trait StringEscaper
{
    public function escapeString(?string $string): string
    {
        if (null === $string) {
            return '';
        }

        return htmlspecialchars($string, ENT_QUOTES | ENT_HTML5, 'UTF-8');
    }

    public function stripTagsAndTrim(?string $string): string
    {
        if (null === $string) {
            return '';
        }
        return trim(strip_tags($string));
    }
}
