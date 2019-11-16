<?php


namespace App\Socket;


use App\Device;
use Ratchet\ConnectionInterface;

/**
 * @property null|Device device
 * @property null|boolean uuid
 * @property boolean is_authorized
 * @property mixed resourceId
 * @property ConnectionInterface connection
 */
class Client
{
    /**
     * @param $name
     * @return mixed
     */
    public function __get($name)
    {
        switch ($name) {
            case 'connection': return $this->connection;
            case 'resourceId': return $this->connection->resourceId;
            case 'is_authorized': return $this->locator_uuid !== null;
            case 'uuid': return $this->locator_uuid;
            case 'device': return $this->locator_uuid ? Device::whereUuid($this->locator_uuid)->first() : null;
        }
    }

    /**
     * @var ConnectionInterface
     */
    private $connection;

    /**
     * @var string|null
     */
    private $locator_uuid;

    /**
     * Client constructor.
     * @param ConnectionInterface $connection
     */
    public function __construct(ConnectionInterface $connection)
    {
        $this->connection = $connection;
    }

    /**
     * Send data to the connection
     * @param  string $data
     * @return ConnectionInterface
     */
    public function send(string $data)
    {
        return $this->connection->send($data);
    }
    
    /**
     * Close the connection
     */
    public function close()
    {
        $this->connection->close();
    }

    /**
     * Perform Authorization
     * 
     * @param string $token
     * @return bool
     */
    public function authorize(string $token)
    {
        $locator = Device::whereCcid($token)->first();
        
        if($locator === null)
            return false;
        
        $this->locator_uuid = $locator->uuid;
        return true;
    }
}