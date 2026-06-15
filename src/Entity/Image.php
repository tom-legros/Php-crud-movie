<?php
declare(strict_types=1);

namespace Entity;

class Image {
    private int $imageId;
    private string $jpeg;

    public function getJpeg(): string
    {
        return $this->jpeg;
    }

    public function setJpeg(string $jpeg): void
    {
        $this->jpeg = $jpeg;
    }

    public function getImageId(): int
    {
        return $this->imageId;
    }

    public function setImageId(int $imageId): void
    {
        $this->imageId = $imageId;
    }

}