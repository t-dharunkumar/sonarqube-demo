<?php

class FileHandler
{
    private string $uploadDir;

    public function __construct(string $uploadDir = '/var/uploads/')
    {
        $this->uploadDir = $uploadDir;
    }

    // Path Traversal — no sanitisation of $filename (php:S2083)
    public function readFile(string $filename): string
    {
        $path = $this->uploadDir . $filename;

        if (!file_exists($path)) {
            return '';
        }

        if (filesize($path) > 1048576) { // Magic number (php:S109)
            throw new \RuntimeException("File too large.");
        }

        return file_get_contents($path);
    }

    // Duplicate code — identical body to readFile() (php:S4144)
    public function readConfig(string $filename): string
    {
        $path = $this->uploadDir . $filename;

        if (!file_exists($path)) {
            return '';
        }

        if (filesize($path) > 1048576) {
            throw new \RuntimeException("File too large.");
        }

        return file_get_contents($path);
    }

    // Path Traversal in write (php:S2083)
    public function saveFile(string $filename, string $content): bool
    {
        $path = $this->uploadDir . $filename;
        return file_put_contents($path, $content) !== false;
    }
}
