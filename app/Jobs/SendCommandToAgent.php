<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

class SendCommandToAgent implements ShouldQueue
{
    use Queueable;

    protected string $agentId;

    protected array $command;

    /**
     * Create a new job instance.
     */
    public function __construct(string $agentId, array $command)
    {
        $this->agentId = $agentId;
        $this->command = $command;
    }

    /**
     * Execute the job.
     *
     * @throws \Exception
     */
    public function handle(): void
    {
        // Connect to RabbitMQ
        $connection = new AMQPStreamConnection(
            config('queue.connections.rabbitmq.hosts')[0]['host'],
            config('queue.connections.rabbitmq.hosts')[0]['port'],
            config('queue.connections.rabbitmq.hosts')[0]['user'],
            config('queue.connections.rabbitmq.hosts')[0]['password'],
            config('queue.connections.rabbitmq.hosts')[0]['vhost']
        );
        $channel = $connection->channel();
        $exchange = 'commands_exchange';

        // Khai báo exchange
        $channel->exchange_declare($exchange, 'direct', false, false, false);

        // Khai báo routingKey
        $routingKey = "commands.{$this->agentId}";

        // Chuẩn bị message
        $msg = new AMQPMessage(json_encode($this->command), [
            'content_type' => 'application/json',
            'delivery_mode' => AMQPMessage::DELIVERY_MODE_PERSISTENT,
        ]);

        // Gửi message
        $channel->basic_publish($msg, $exchange, $routingKey);

        // Đóng kết nối
        $channel->close();
        $connection->close();
    }
}
