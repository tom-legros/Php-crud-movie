<?php

declare(strict_types=1);

namespace Html;

class WebPage
{

    private string $head;
    private string $title;
    private string $body;

    public function __construct(string $title = '')
    {
        $this->head = '';
        $this->title = $title;
        $this->body = '';
    }

    public function getHead(): string
    {
        return $this->head;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getBody(): string
    {
        return $this->body;
    }

    public function appendToHead(string $content): void
    {
        $this->head = $this->head.$content;
    }

    public function appendCss(string $css): void
    {
        $this->head .= "<style>{$css}</style>";
    }

    public function appendCssUrl(string $url): void
    {
        $this->head .= '<link rel="stylesheet"href="'.$url.'">';
    }

    public function appendJs(string $js): void
    {
        $this->head .= '<script>'.$js.'</script>';
    }

    public function appendJsUrl(string $url): void
    {
        $this->head .= '<script src="'.$url.'"></script>';
    }

    public function appendContent(string $content): void
    {
        $this->body = $this->body.$content;
    }

    public function toHTML(): string
    {
        return <<<HTML
        <!doctype html>
        <html lang="fr">
        <head>
            <meta charset="utf-8">
            <meta name="viewport">
            <title>{$this->title}</title>
            {$this->head}
        </head>
        <body>
            {$this->body}
            <div class="footer">
            {$this->getLastModification()}
        </div>
        </body>
        </html>
        HTML;
    }

    public function getLastModification(): string
    {
        return 'Dernière modification : '.date('F d Y H:i:s.', getlastmod());
    }
}
