<?php

namespace App\Services;

use App\Contracts\LoggableContract;
use App\Contracts\LoggerContract;
use DateTime;

class FileLogger implements LoggerContract
{
    const LOGS_PATH = ROOT_PATH . '/logs';
    const LOG_FILE = self::LOGS_PATH . '/app.log';

    /**
     * @param string|\App\Contracts\LoggableContract $message
     * @return void
     */
    public function write($message): void
    {
        if ($message instanceof LoggableContract) {
            $message = $message->toLogMessage();
        }

        $this->writeToLogFile($message);
    }

    /**
     * @param string $message
     * @return void
     */
    private function writeToLogFile(string $message): void
    {
        is_dir(self::LOGS_PATH) || mkdir(self::LOGS_PATH);

        $fh = fopen(self::LOG_FILE, "a+");
        fwrite($fh, $this->formatMessage($message));
        fclose($fh);
    }

    /**
     * @param string $message
     * @return string
     */
    private function formatMessage(string $message): string
    {
        $date = (new DateTime())->format("y-m-d h:i:s");

        return "[$date]: $message" . PHP_EOL;
    }
}
