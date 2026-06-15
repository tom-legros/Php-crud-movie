<?php

declare(strict_types=1);

namespace Html;

class AppWebPage extends WebPage
{
    public function __construct(string $title = '')
    {
        parent::__construct($title);
        $this->appendCssUrl('/css/style.css');
    }
    public function toHTML(): string
    {
        return <<<HTML
    <!doctype html>
    <html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>{$this->getTitle()}</title>
        {$this->getHead()}
    </head>
    <body>
        <div class="header">
            <h1>{$this->getTitle()}</h1>
        </div>
        <div class="content">
            <div class="list">
                {$this->getBody()}
            </div>
        </div>
          <div class="footer">
            {$this->getLastModification()}
        </div>
    </body>
    </html>
    HTML;
    }
}
