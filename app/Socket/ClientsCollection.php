<?php


namespace App\Socket;


use Ratchet\ConnectionInterface;

class ClientsCollection
{
    /**
     * @var \Illuminate\Support\Collection|Client[]
     */
    protected $clients;
    
    /**
     * ClientsCollection constructor.
     */
    public function __construct()
    {
        $this->clients = collect();
    }


    /**
     * @param ConnectionInterface $connection
     * @return Client
     */
    public function get(ConnectionInterface $connection)
    {
        $existing = $this->clients->filter(function (Client $client) use (&$connection) {
            return $client->connection === $connection;
        });
        
        if($existing->count())
            return $existing->first();

        $client = new Client($connection);
        $this->clients->add($client);
        return $client;
    }


    /**
     * @param ConnectionInterface $connection
     */
    public function delete(ConnectionInterface $connection)
    {
        $this->clients = $this->other($connection);
    }

    /**
     * @return \Illuminate\Support\Collection|Client[]
     */
    public function all()
    {
        return $this->clients;
    }


    /**
     * @param ConnectionInterface $connection
     * @return \Illuminate\Support\Collection|Client[]
     */
    public function other(ConnectionInterface $connection)
    {
        return $this->clients->filter(function (Client $client) use (&$connection) {
            return $client->connection !== $connection;
        });
    }
}