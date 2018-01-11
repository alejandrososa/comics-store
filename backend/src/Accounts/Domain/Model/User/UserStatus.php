<?php
/**
 * Created by PhpStorm.
 * User: alejandro
 * Date: 27/12/17
 * Time: 15:55
 */

namespace App\Accounts\Domain\Model\User;


class UserStatus
{
    const PENDING = 5;
    const LOCKED = 10;
    const ACTIVE = 20;
    const INACTIVE = 30;
    const DELETED = 40;

    private $status;

    /**
     * UserStatus constructor.
     * @param null $aStatus
     */
    public function __construct($aStatus = null)
    {
        $this->status = $aStatus;
    }

    /**
     * @return null
     */
    public function status()
    {
        return $this->status;
    }

    /**
     * @return UserStatus
     */
    public static function pending()
    {
        return new self(self::PENDING);
    }

    /**
     * @return UserStatus
     */
    public static function locked()
    {
        return new self(self::LOCKED);
    }

    /**
     * @return UserStatus
     */
    public static function activated()
    {
        return new self(self::ACTIVE);
    }

    /**
     * @return UserStatus
     */
    public static function inactivated()
    {
        return new self(self::INACTIVE);
    }

    /**
     * @return UserStatus
     */
    public static function deleted()
    {
        return new self(self::DELETED);
    }

    /**
     * @param UserStatus $aStatus
     * @return bool
     */
    public function equalsTo(self $aStatus)
    {
        return $this->status === $aStatus->status;
    }
}