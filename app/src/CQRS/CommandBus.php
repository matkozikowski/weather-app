<?php

declare(strict_types=1);

namespace App\CQRS;

use Psr\Container\ContainerInterface;

final class CommandBus implements CommandHandleInterface
{
    private const HANDLER_PREFIX = 'Handler';

    /**
     * @var ContainerInterface
     */
    private $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function handle(CommandInterface $command): void
    {
        $handler = $this->handlerFromCommand($command->commandName());
        $handler->handle($command);
    }

    private function handlerFromCommand(string $commandName): CommandHandleInterface
    {
        $handlerName = $this->getHandlerName($commandName);

        if ($this->container->has($handlerName)) {
            return $this->container->get($handlerName);
        }

        throw new \Exception(\sprintf('Missing handler for command %s', $commandName));
    }

    private function getHandlerName(string $commandName): string
    {
        return str_replace('Command', self::HANDLER_PREFIX, $commandName) . self::HANDLER_PREFIX;
    }
}
