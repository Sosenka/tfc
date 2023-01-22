<?php

namespace App\Core\Entity;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\HasLifecycleCallbacks;
use Doctrine\ORM\Mapping\MappedSuperclass;
use Doctrine\ORM\Mapping\PrePersist;
use Doctrine\ORM\Mapping\PreUpdate;

#[HasLifecycleCallbacks]
#[MappedSuperclass]
class BaseEntity
{
    #[Column(type: 'datetime')]
    protected $created;

    #[Column(type: 'datetime')]
    protected $updated;

    /**
     * @return mixed
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * @param mixed $created
     */
    public function setCreated($created)
    {
        $this->created = $created;
    }

    /**
     * @return mixed
     */
    public function getUpdated()
    {
        return $this->updated;
    }

    /**
     * @param mixed $updated
     */
    public function setUpdated($updated): void
    {
        $this->updated = $updated;
    }

    #[PreUpdate]
    #[PrePersist]
    final function update()
    {
        $now = new \DateTime();
        if ($this->created == null) {
            $this->setCreated($now);
        }
        $this->setUpdated($now);
    }
}