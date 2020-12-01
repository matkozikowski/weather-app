<?php

declare(strict_types=1);

namespace App\CQRS;

use Exception;
use Psr\Log\LoggerInterface;
use Throwable;
use App\Application\Query\Query;
use function get_class;

final class System implements SystemInterface
{
    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @var CommandBus
     */
    private $commandBus;

    /**
     * @var Queries
     */
    private $queries;

    public function __construct(LoggerInterface $logger, CommandBus $commandBus, Queries $queries)
    {
        $this->logger = $logger;
        $this->commandBus = $commandBus;
        $this->queries = $queries;
    }

    public function handle(CommandInterface $command): void
    {
        try {
            $this->commandBus->handle($command);
        } catch (Throwable $exception) {
            $this->logger->error(
                sprintf('Failed to handle command %s', get_class($command)),
                [
                    'exception' => get_class($exception),
                    'message' => $exception->getMessage(),
                    'code' => $exception->getCode(),
                    'trace' => $exception->getTraceAsString(),
                ]
            );

            throw new Exception($exception->getMessage(), $exception->getCode(), $exception);
        }
    }

    public function query(string $queryClass): Query
    {
        return $this->queries->get($queryClass);
    }
}
