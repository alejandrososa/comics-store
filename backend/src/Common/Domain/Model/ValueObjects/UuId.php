<?php
/**
 * Created by PhpStorm.
 * User: grace
 * Date: 26/12/17
 * Time: 22:12
 */

namespace App\Common\Domain\Model\ValueObjects;

use Ramsey\Uuid\Uuid as UID;

/**
 * Class UuId
 * @package App\Common\Domain\Model\User\ValueObject
 */
class UuId
{
    private $id;

    /**
     * UuId constructor.
     * @param string $id
     */
    public function __construct(string $id = null)
    {
//        $this->guard($id);
        $this->id = $id ? : UID::uuid4()->toString();
    }

    private function guard($id): void
    {
        if (!UID::isValid($id)) {
            throw new \InvalidArgumentException(
                sprintf('<%s> does not allow the value <%s>.', static::class, is_scalar($id) ? $id : gettype($id))
            );
        }
    }

    /**
     * @return string
     */
    public function id()
    {
        return $this->id;
    }

    /**
     * @param null $anId
     * @return static
     */
    public static function create($anId = null)
    {
        return new static($anId);
    }

    /**
     * @param UuId $anId
     * @return bool
     */
    public function equals(UuId $anId)
    {
        return $this->id === $anId->id();
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return (string) $this->id;
    }
}