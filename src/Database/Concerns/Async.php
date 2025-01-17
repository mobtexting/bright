<?php

declare(strict_types=1);

namespace Diviky\Bright\Database\Concerns;

trait Async
{
    /**
     * Run the query in async mode.
     *
     * @param null|string $queue
     * @param null|string $connection
     *
     * @return static
     */
    public function async($queue = null, $connection = null)
    {
        $config = $this->asyncConfig();
        if (!empty($config['enable']) || !empty($config['all'])) {
            $queue = $queue ?? $config['queue'];
            $connection = $connection ?? $config['connection'];

            $this->connection->async($connection, $queue);
        }

        return $this;
    }

    /**
     * Get the async config.
     *
     * @return array
     */
    protected function asyncConfig()
    {
        $bright = $this->getConfig();

        return isset($bright['async']) ? $bright['async'] : [];
    }
}
