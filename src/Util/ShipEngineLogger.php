<?php declare(strict_types=1);

namespace ShipEngine\Util;

use Psr\Log\LoggerInterface;
use Psr\Log\LoggerTrait;
use Psr\Log\LogLevel;
use Stringable;

/**
 * Class ShipEngineLogger
 *
 * @package ShipEngine\Util
 */
final class ShipEngineLogger implements LoggerInterface
{
    use LoggerTrait;

    public function log($level, Stringable|string $message, array $context = []): void
    {
        $message = (string)$message;

        switch ($level) {
            case LogLevel::EMERGENCY:
                $this->emergency($message, $context);
                break;
            case LogLevel::ALERT:
                $this->alert($message, $context);
                break;
            case LogLevel::CRITICAL:
                $this->critical($message, $context);
                break;
            case LogLevel::ERROR:
                $this->error($message, $context);
                break;
            case LogLevel::WARNING:
                $this->warning($message, $context);
                break;
            case LogLevel::NOTICE:
                $this->notice($message, $context);
                break;
            case LogLevel::INFO:
                $this->info($message, $context);
                break;
            case LogLevel::DEBUG:
                $this->debug($message, $context);
                break;
            default:
                throw new \Psr\Log\InvalidArgumentException(
                    'Severity level not recognized - must be emergency, alert, critical,
                    error, warning, notice, info, or debug.'
                );
        }
    }
}
