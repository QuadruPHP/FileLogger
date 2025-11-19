<?php

namespace QuadruPHP\FileLogger;

use Psr\Log\AbstractLogger;

/**
 * @author Christophe DALOZ - DE LOS RIOS <christophedlr@gmail.com>
 * @version 1.0.0
 * @license MIT
 */
class FileLogger extends AbstractLogger
{
    private string $path;

    public function __construct(string $path)
    {
        $this->path = $path;
    }

    /**
     * @inheritDoc
     */
    public function log($level, \Stringable|string $message, array $context = []): void
    {
        $result = '[' . date_format(date_create(), "yy-m-d H:i:s O") . '] ' . $level . ': ' . $message;
        if (isset($context['exception'])) {
            if ($context['exception'] instanceof \Exception) {
                $result .= ' - Exception: ' .
                    get_class($context['exception']) . '" ' .
                    $context['exception']->getMessage() . '" Code ' .
                    $context['exception']->getCode() . ' in ' .
                    $context['exception']->getFile() . ':' .
                    $context['exception']->getLine();
                unset($context['exception']);
            }
        }
        $result .= ((!empty($context)) ? ' Context: '.json_encode($context, JSON_UNESCAPED_UNICODE) : '').PHP_EOL;

        file_put_contents($this->path, $result, FILE_APPEND);
    }
}
