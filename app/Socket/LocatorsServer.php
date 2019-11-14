<?php


namespace App\Socket;


use App\Events\ReceivedNewDataFromLocator;
use App\IncomingData;
use Illuminate\Support\Str;
use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;



class LocatorsServer implements MessageComponentInterface
{
    /**
     * @var ClientsCollection
     */
    protected $clients;
    
    /**
     * @var callable
     */
    private $logger;

    /**
     * LocatorsServer constructor.
     * @param callable|null $logger
     */
    public function __construct(callable $logger = null) {
        $this->clients = new ClientsCollection;
        $this->logger = $logger;
    }

    public function onOpen(ConnectionInterface $conn) {
        $client = $this->clients->get($conn);

        $this->log("New connection! ({$client->resourceId})");
    }

    public function onMessage(ConnectionInterface $conn, $message) {
        $client = $this->clients->get($conn);
        
        if(!$client->is_authorized){
            if(Str::startsWith($message, 'AUTH=')){
                $token = trim(Str::after($message, 'AUTH='));
                if(!$client->authorize($token)) {
                    $client->send("ERR:INVALID_AUTH\n");
                    $conn->close();
                    $this->log("Unsuccessful authorization with token={$token} - disconnecting! ({$client->resourceId})", true);
                    return;
                }

                $this->log("Successful authorization with token={$token} - {$client->locator->name}! ({$client->resourceId})");
                return;
            } 
            
            $client->send("Please authorize first with \"AUTH=<TOKEN>\" command!\n");
            $conn->close();
            $this->log("Unauthorized pushes - disconnecting! ({$client->resourceId})", true);
            return;
        }

        $message = trim($message);
        if(!$message) return;
        
        if(Str::startsWith($message, '<') && Str::contains($message, '|') && Str::endsWith($message, '>')) {
            $frame = new IncomingData;
            $frame->frame = $message;
            $client->locator->IncomingData()->save($frame);
            event(new ReceivedNewDataFromLocator($frame));
            $this->log("Location frame received: {$message} ({$client->resourceId})");
            return;
        }
        
        $this->log("Incorrect message received: {$message} ({$client->resourceId})", true);
        
//        $other_clients = $this->clients->other($conn);
//        $numRecv = $other_clients->count();
//        $this->log(sprintf('Connection %d sending message "%s" to %d other connection%s', $from_client->resourceId, trim($msg), $numRecv, $numRecv == 1 ? '' : 's'));
//        $other_clients->each(function (Client $client) use ($msg) { $client->send($msg); });
    }

    public function onClose(ConnectionInterface $conn) {
        $client = $this->clients->get($conn);
        $this->clients->delete($conn);
        $this->log("Connection {$client->resourceId} has disconnected");
    }

    public function onError(ConnectionInterface $conn, \Exception $e) {
        $this->log("An error has occurred: {$e->getMessage()}", true);
        $conn->close();
    }

    public function log($string, bool $is_error = false)
    {
        if(is_callable($this->logger)){
            call_user_func($this->logger, $string, $is_error);
        }
    }
}